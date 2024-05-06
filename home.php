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
	<p>Testing Page</p>
	<p>Another paragraph</p>
	<div>
		<button id="start">Start</button>
	</div>
	<div id="question-container" class="hidden container">
	<?php
    $result = mysqli_query($conn, "SELECT * FROM questions WHERE question_category = 'other'") or die(mysqli_error($conn));
    if (mysqli_num_rows($result) > 0) {
			while ($row = mysqli_fetch_assoc($result)){
				?>
				<div class='row d-flex justify-content-center'>
					<?php
				if($row ["question_id"] == "gender"){
					echo "<div class='row'>".$row["question_question"]."</div>";
					?>
					<div class="row w-100 justify-content-center">
					<div class="col">
					<input type='button' value='Male'>
					</div>
					<div class="col">
					<input type='button' value='Female'>
					</div>
					</div>
					<?php
				}else{
					echo "<div class='row'>".$row["question_question"]."</div>";
					echo "<div class='row'><input type='text'></div>";
				}
				?>
				</div>
				<?php
			}
    }
    ?>
    </div>
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