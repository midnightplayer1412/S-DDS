<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
// ini_set('log_errors', 1);
// ini_set('error_log', './error.log');
session_start();
require_once 'connection.php';
require_once 'functions.php';

if (!isset($_SESSION['user_id']) || !isset($_SESSION['user_age'])) {
    header('Location: index.php');
    exit();
}

$questions = get_questions($conn, $_SESSION['user_id'], $_SESSION['user_age']);
$total_questions = count($questions);

$current_question = isset($_SESSION['current_question']) ? $_SESSION['current_question'] : 0;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_POST['action'] ?? '';
    
    if ($action == 'save_answer') {
        $question_id = $_POST['question_id'];
        $answer = $_POST['answer'];
        $result = save_response($conn, $_SESSION['user_id'], $question_id, $answer);
        if ($result) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to save response']);
        }
        exit;
    } elseif ($action == 'get_question') {
        $direction = $_POST['direction'];
        if ($direction == 'next') {
            $current_question++;
        } elseif ($direction == 'previous') {
            $current_question--;
        }
        
        if ($current_question < 0) {
            $current_question = 0;
        } elseif ($current_question >= $total_questions) {
            echo json_encode(['redirect' => 'result.php']);
            exit;
        }
        
        $_SESSION['current_question'] = $current_question;
        $question = $questions[$current_question];
        $previous_answer = get_user_response($conn, $_SESSION['user_id'], $question['id']);
        
        echo json_encode([
            'question_number' => $current_question + 1,
            'total_questions' => $total_questions,
            'disorder_category' => $question['disorder_category'],
            'question_text' => $question['question_text'],
            'question_id' => $question['id'],
            'question_weight' => $question['question_weight'],
            'previous_answer' => $previous_answer
        ]);
        exit;
    } elseif ($action == 'reset') {
        $tables = ['users', 'user_responses', 'user_cf_values'];
        $messages = reset_table($conn, $tables);
        session_destroy();
        echo json_encode(['status' => 'success', 'messages' => $messages]);
        exit;
    }
}

// Initial question load
$question = $questions[$current_question];
$disorder_category = $question['disorder_category'];
$question_weight = $question['question_weight'];
$previous_answer = get_user_response($conn, $_SESSION['user_id'], $question['id']);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Survey</title>
    <style>
        body{
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .btn {
            padding: 10px 20px;
            margin: 5px;
            font-size: 16px;
            cursor: pointer;
        }
        .selected {
            background-color: #4CAF50;
            color: white;
        }
        #reset_btn {
            background-color: #f44336;
            color: white;
            float: right;
        }
        #disorder_category {
            color: #4a4a4a;
            font-size: 1.2em;
            margin-bottom: 10px;
            text-transform: capitalize;
        }
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            width: 100%;
            min-height: 400px;
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .question-text{
            padding: 20px 0px;
            min-height: 200px;
        }
        .question-button{
            display: flex;
            justify-content: space-between;
        }
        p {
            color: #555;
            font-size: 18px;
            margin-bottom: 20px;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="container">
        <div class="question-text">
            <h1>Survey Question <span id="question_number"></span> of <span id="total_questions"></span></h1>
            <!-- <h2 id="disorder_category"></h2> -->
            <p id="question_text"></p>
        </div>
        <div class="question-button">
            <div>
                <button type="button" class="btn" id="btn_yes" onclick="submitAnswer('YES')">YES</button>
                <button type="button" class="btn" id="btn_no" onclick="submitAnswer('NO')">NO</button>
            
                <button type="button" class="btn" id="btn_next" onclick="navigateQuestion('next')">Next</button>
                <button type="button" class="btn" id="btn_previous" onclick="navigateQuestion('previous')" <?php echo $current_question == 0 ? 'style="display:none;"' : ''; ?>>Previous</button>
            </div>
            <div>
                <button type="button" class="btn" id="reset_btn" onclick="resetSurvey()">RESET</button>
            </div>
        </div>
    </div>

    <script>
        let currentQuestionId = <?php echo $question['id']; ?>;
        let currentAnswer = '<?php echo $previous_answer; ?>';
        // let currentDisorderCategory = '<?php echo $disorder_category; ?>';
        let currentQuestionWeight = <?php echo $question_weight; ?>;

        let currentDisorderCategory = '';

        function updateQuestion(data) {
            $('#question_number').text(data.question_number);
            $('#total_questions').text(data.total_questions);
            $('#disorder_category').text(data.disorder_category);
            $('#question_text').text(data.question_text);
            currentQuestionId = data.question_id;
            currentDisorderCategory = data.disorder_category;
            currentQuestionWeight = data.question_weight;
            currentAnswer = data.previous_answer;
            updateButtons();
        }

        function submitAnswer(answer) {
            $.post('questions.php', {
                action: 'save_answer',
                question_id: currentQuestionId,
                answer: answer,
                disorder_category: currentDisorderCategory,
                question_weight: currentQuestionWeight
            }, function(response) {
                let data = JSON.parse(response);
                if (data.status === 'success') {
                    currentAnswer = answer;
                    updateButtons();
                    // Update questions if they've changed
                    if (data.new_questions) {
                        questions = data.new_questions;
                        totalQuestions = questions.length;
                        $('#total_questions').text(totalQuestions);
                        
                        // If we're on the last question and new questions were added, allow moving to the next question
                        if (currentQuestionIndex === questions.length - 1) {
                            $('#btn_next').show();
                        }
                    }
                } else {
                    alert('Failed to save answer. Please try again.');
                }
            }).fail(function(jqXHR, textStatus, errorThrown) {
                console.error("AJAX request failed: " + textStatus, errorThrown);
                alert('Error saving answer. Please check the console for more information.');
            });
        }

        function navigateQuestion(direction) {
            $.post('questions.php', {
                action: 'get_question',
                direction: direction
            }, function(response) {
                let data = JSON.parse(response);
                if (data.redirect) {
                    window.location.href = data.redirect;
                } else {
                    // $('#question_number').text(data.question_number);
                    // $('#total_questions').text(data.total_questions);
                    // $('#question_text').text(data.question_text);
                    // currentQuestionId = data.question_id;
                    // currentAnswer = data.previous_answer;
                    // currentDisorderCategory = data.disorder_category;
                    // currentQuestionWeight = data.question_weight;
                    // updateButtons();
                    
                    // if (data.question_number > 1) {
                    //     $('#btn_previous').show();
                    // } else {
                    //     $('#btn_previous').hide();
                    // }
                    updateQuestion(data);
                    if (data.question_number > 1) {
                        $('#btn_previous').show();
                    } else {
                        $('#btn_previous').hide();
                    }
                }
            });
        }

        function updateButtons() {
            $('#btn_yes').removeClass('selected');
            $('#btn_no').removeClass('selected');
            if (currentAnswer === 'YES') {
                $('#btn_yes').addClass('selected');
            } else if (currentAnswer === 'NO') {
                $('#btn_no').addClass('selected');
            }
        }

        function resetSurvey() {
            if (confirm('Are you sure you want to reset all survey data? This action cannot be undone.')) {
                $.post('questions.php', {
                    action: 'reset'
                }, function(response) {
                    let data = JSON.parse(response);
                    if (data.status === 'success') {
                        // alert(data.messages.join('\n'));
                        window.location.href = 'index.php';
                    } else {
                        alert('Error resetting survey data');
                    }
                }).fail(function(jqXHR, textStatus, errorThrown) {
                    console.error("AJAX request failed: " + textStatus, errorThrown);
                    alert('Error resetting survey data. Please check the console for more information.');
                });
            }
        }

        $(document).ready(function() {
            let initialData = {
                question_number: <?php echo $current_question + 1; ?>,
                total_questions: <?php echo $total_questions; ?>,
                disorder_category: '<?php echo $question['disorder_category']; ?>',
                question_text: '<?php echo $question['question_text']; ?>',
                question_id: <?php echo $question['id']; ?>,
                question_weight: <?php echo $question['question_weight']; ?>,
                previous_answer: '<?php echo $previous_answer; ?>'
            };
            updateQuestion(initialData);
            updateButtons();
        });
    </script>
</body>
</html>