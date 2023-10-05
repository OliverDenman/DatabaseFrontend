<!DOCTYPE html>
<html>
	<head>
		<!-- link the file script.php to the php index file -->
		<?php 
		include "script.php";
		?>
		<!-- link the style sheet to the html -->
		<link rel="stylesheet" href="style.css">

 	</head>
	<body>
		<!-- send the form to the php script functions via _POST -->
		<?php 
			displayActors();

			if (isset($_POST['apply'])){
				if ($_POST['actName'] == ''){
					displayActors();
				}
				elseif ($_POST['tableDropdown'] == 'Add'){
					actAdd($_POST);
				}
				elseif ($_POST['tableDropdown'] == 'Remove'){
					actRemove($_POST);
				}
			}

			?>
			<!-- div for navigation bar -->
		<div id="navbar">
			<ul>
				<li><a href="index.php">View DataBase</a></li>
				<li><a href="modAct.php">Modify Actors</a></li>
				<li><a href="modMov.php">Modify Movies</a></li>
			</ul>
		</div>

		<!-- div for form selection and input fields -->
		<div class='search'>
			<form method="POST" action="">
				<select name="tableDropdown" id="table">
  					<option value="Add">Add</option>
  					<option value="Remove">Remove</option>
				</select>
				<input type="text" id="actName" name="actName" placeholder="Actor Name" autocomplete="off">
				<input type="submit" value="Apply" name="apply">
			</form>
		</div>
	</body>
</html>
