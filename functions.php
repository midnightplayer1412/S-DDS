<?php
function save_user_details($conn, $email, $name, $age) {
    $stmt = $conn->prepare("INSERT INTO users (email, name, age) VALUES (?, ?, ?)");
    $stmt->bind_param("ssi", $email, $name, $age);
    $stmt->execute();
    return $stmt->insert_id;
}

function get_user_age($conn, $user_id) {
    $stmt = $conn->prepare("SELECT age FROM users WHERE id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    return $row['age'];
}

function get_user_name($conn, $user_id) {
    $stmt = $conn->prepare("SELECT name FROM users WHERE id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    return $row['name'] ?? 'Unknown User';
}

// function get_questions($conn, $user_id, $age) {
//     $adult_phrases = "'phrase-1', 'phrase-1a', 'phrase-2', 'phrase-2a', 'phrase-3a'";
//     $child_phrases = "'phrase-1', 'phrase-1c', 'phrase-2', 'phrase-2c', 'phrase-3c'";
    
//     $phrases = $age >= 18 ? $adult_phrases : $child_phrases;
    
//     $sql = "SELECT id, question_text, question_phrase, disorder_category, question_weight FROM questions WHERE question_phrase IN ($phrases) ORDER BY FIELD(question_phrase, $phrases)";
//     $result = $conn->query($sql);
//     $questions = $result->fetch_all(MYSQLI_ASSOC);
    
//     // Get CF values
//     $cf_values = get_cf_values($conn, $user_id);
    
//     // Check if we need to add phrase-3 questions
//     $need_phrase_3 = false;
//     foreach ($cf_values as $key => $value) {
//         if (strpos($key, 'cf_') === 0 && $value >= 0.4) {
//             $need_phrase_3 = true;
//             break;
//         }
//     }
    
//     if ($need_phrase_3) {
//         $phrase_3 = $age >= 18 ? 'phrase-3a' : 'phrase-3c';
//         $sql = "SELECT * FROM questions WHERE question_phrase = '$phrase_3' ORDER BY RAND() LIMIT 2";
//         $result = $conn->query($sql);
//         $phrase_3_questions = $result->fetch_all(MYSQLI_ASSOC);
//         $questions = array_merge($questions, $phrase_3_questions);
//     }
    
//     return array_values($questions);
// }

function get_questions($conn, $user_id, $age) {
    $adult_phrases = "'phrase-1', 'phrase-1a', 'phrase-2', 'phrase-2a'";
    $child_phrases = "'phrase-1', 'phrase-1c', 'phrase-2', 'phrase-2c'";
    
    $age_specific_phrases = $age >= 18 ? $adult_phrases : $child_phrases;
    $age_specific_phrase_3 = $age >= 18 ? 'phrase-3a' : 'phrase-3c';
    
    // Get initial questions
    $sql = "SELECT id, question_text, question_phrase, disorder_category, question_weight 
            FROM questions 
            WHERE question_phrase IN ($age_specific_phrases)
            ORDER BY FIELD(question_phrase, $age_specific_phrases)";
    
    $result = $conn->query($sql);
    $questions = $result->fetch_all(MYSQLI_ASSOC);
    
    // Get CF values
    $cf_values = get_cf_values($conn, $user_id);
    
    // Check each disorder category
    $disorder_categories = ['mdd', 'apd', 'ed', 'dd', 'bpd', 'sp', 'pd', 'gd'];
    foreach ($disorder_categories as $category) {
        $cf_key = "cf_$category";
        if (isset($cf_values[$cf_key]) && $cf_values[$cf_key] >= 0.4) {
            // If CF value is >= 0.4, add phrase-3 questions for this category
            $sql = "SELECT id, question_text, question_phrase, disorder_category, question_weight 
                    FROM questions 
                    WHERE question_phrase = 'phrase-3' AND disorder_category = ?
                    ORDER BY RAND()";
        } else {
            // If CF value is < 0.4, add 2 age-specific phrase-3 questions for this category
            $sql = "SELECT id, question_text, question_phrase, disorder_category, question_weight 
                    FROM questions 
                    WHERE question_phrase = ? AND disorder_category = ?
                    ORDER BY RAND()
                    LIMIT 2";
        }
        
        $stmt = $conn->prepare($sql);
        if (isset($cf_values[$cf_key]) && $cf_values[$cf_key] >= 0.4) {
            $stmt->bind_param("s", $category);
        } else {
            $stmt->bind_param("ss", $age_specific_phrase_3, $category);
        }
        $stmt->execute();
        $result = $stmt->get_result();
        $additional_questions = $result->fetch_all(MYSQLI_ASSOC);
        
        $questions = array_merge($questions, $additional_questions);
    }
    
    return $questions;
}

function initialize_cf_values($conn, $user_id, $age) {
    $stmt = $conn->prepare("INSERT INTO user_cf_values (user_id, cf_dmdd, cf_odd) VALUES (?, ?, ?)");
    if ($age >= 18) {
        $cf_dmdd = -1.0;
        $cf_odd = 0.0;
    } else {
        $cf_dmdd = 0.0;
        $cf_odd = -1.0;
    }
    $stmt->bind_param("idd", $user_id, $cf_dmdd, $cf_odd);
    $stmt->execute();
    
    if ($stmt->error) {
        error_log("Error initializing CF values: " . $stmt->error);
        return false;
    }
    return true;
}

function update_cf_value($conn, $user_id, $disorder_category, $weight, $answer) {
    $cf_column = "cf_" . strtolower($disorder_category);
    $value = $answer === 'YES' ? $weight : -$weight;
    
    $stmt = $conn->prepare("UPDATE user_cf_values SET $cf_column = $cf_column + ? WHERE user_id = ?");
    $stmt->bind_param("di", $value, $user_id);
    $stmt->execute();
    
    if ($stmt->error) {
        error_log("Error updating CF value: " . $stmt->error);
        return false;
    }
    return true;
}

function get_cf_values($conn, $user_id) {
    $stmt = $conn->prepare("SELECT * FROM user_cf_values WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}
function save_response($conn, $user_id, $question_id, $answer) {
    // Check if a response already exists
    $stmt = $conn->prepare("SELECT id FROM user_responses WHERE user_id = ? AND question_id = ?");
    $stmt->bind_param("ii", $user_id, $question_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Update existing response
        $row = $result->fetch_assoc();
        $response_id = $row['id'];
        $stmt = $conn->prepare("UPDATE user_responses SET answer = ? WHERE id = ?");
        $stmt->bind_param("si", $answer, $response_id);
    } else {
        // Insert new response
        $stmt = $conn->prepare("INSERT INTO user_responses (user_id, question_id, answer) VALUES (?, ?, ?)");
        $stmt->bind_param("iis", $user_id, $question_id, $answer);
    }

    $stmt->execute();
    
    if ($stmt->affected_rows > 0) {
        // Get question details and update CF value
        $question_stmt = $conn->prepare("SELECT disorder_category, question_weight FROM questions WHERE id = ?");
        $question_stmt->bind_param("i", $question_id);
        $question_stmt->execute();
        $question_result = $question_stmt->get_result();
        $question_data = $question_result->fetch_assoc();

        update_cf_value($conn, $user_id, $question_data['disorder_category'], $question_data['question_weight'], $answer);

        // Recalculate questions
        $user_age = get_user_age($conn, $user_id);
        $new_questions = get_questions($conn, $user_id, $user_age);
        
        return ['success' => true, 'new_questions' => $new_questions];
    } else {
        return ['success' => false];
    }
}

function get_user_results($conn, $user_id) {
    $stmt = $conn->prepare("SELECT q.question_text, ur.answer FROM user_responses ur JOIN questions q ON ur.question_id = q.id WHERE ur.user_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
}

function get_user_email($conn, $user_id) {
    $stmt = $conn->prepare("SELECT email FROM users WHERE id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    return $row['email'];
}

function email_results($email, $results) {
    $subject = "Your Survey Results";
    $message = "Here are your survey results:\n\n";
    foreach ($results as $result) {
        $message .= "Q: {$result['question_text']}\n";
        $message .= "A: {$result['answer']}\n\n";
    }
    mail($email, $subject, $message);
}

function get_user_response($conn, $user_id, $question_id) {
  $stmt = $conn->prepare("SELECT answer FROM user_responses WHERE user_id = ? AND question_id = ?");
  $stmt->bind_param("ii", $user_id, $question_id);
  $stmt->execute();
  $result = $stmt->get_result();
  if ($row = $result->fetch_assoc()) {
      return $row['answer'];
  }
  return null;
}

function reset_table($conn, $tables) {
    $conn->query("SET foreign_key_checks = 0");
    $messages = [];
    foreach($tables as $table) {
        $sql = "TRUNCATE TABLE `$table`";
        if ($conn->query($sql) === TRUE) {
            $messages[] = "Table $table truncated successfully.";
        } else {
            $messages[] = "Error truncating table $table: " . $conn->error;
        }
    }
    $conn->query("SET foreign_key_checks = 1");
    return $messages;
}