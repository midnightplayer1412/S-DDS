<?php
session_start();

// Check if the session exists and hasn't expired
if(isset($_SESSION['username']) && isset($_SESSION['expire_time']) && time() < $_SESSION['expire_time']) {
    echo "Session value: " . $_SESSION['username'];
} else {
    echo "No session";
}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>S-DDS</title>
		<!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
		<!-- Bootstrap -->
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
		<link rel="stylesheet" href="/assets/css/style.css">
    <style>
        .show {
            display: block;
        }
        /* .hidden {
            display: none;
        } */
    </style>
</head>
<body>
	<form id="question-container" class="container">
	<?php
	// Program Begin, call the other category question from the question based
    if (mysqli_num_rows($other_result) > 0) {
			while ($row = mysqli_fetch_assoc($other_result)){
				?>
				<div class="row">
					<?php
					echo $row['question_question'];
					if($row['question_id'] == 'gender'){
					?>
						<div class="container">
							<div class="row">
								<div class="col">
									<input type="radio" class="form-check-radio" name="gender">
									<label for="Male" class="form-check-lable">Male</label>
								</div>
								<div class="col">
									<input type="radio" class="form-check-radio" name="gender">
									<label for="Female" class="form-check-lable">Female</label>
								</div>
							</div>
						</div>
					<?php
					}elseif($row['question_id'] == 'name'){
					?>
						<div class="container">
							<div class="row">
								<input type="text">
							</div>
						</div>
					<?php	
					}elseif($row['question_id'] == 'age'){
					?>
						<div class="container">
							<div class="row">
								<input type="text" pattern="[0-9]">
							</div>
						</div>
					<?php	
					}
					?>
				</div>
				<?php
			}
    }
    ?>
    </form>
    <script>
			$(document).ready(function(){
				$('#start').click(function(){
					$('#question-container').removeClass('hidden');
					$('#question-container').toggleClass('show');
				});
			});
    </script>
</body>
</html>