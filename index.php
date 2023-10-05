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
		if (isset($_POST['submit'])){
			if ($_POST['searchField'] == ''){
				displayAll();
			}
			elseif ($_POST['tableDropdown'] == 'Movie'){
				movSearch($_POST);
			}
			elseif ($_POST['tableDropdown'] == 'Actor'){
				actSearch($_POST);
			}
			// dispSearch($_POST);
		}else{
			displayAll();
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
			<form method="POST" action="" autocomplete="off" onsubmit = 'val()'>
				<select name="tableDropdown" id="tableDropdown">
  					<option value="Movie">Movies</option>
  					<option value="Actor">Actors</option>
				</select>
				<input type="text" id="searchField" name="searchField" placeholder="Search Field" autocomplete="off">
				<input type="submit" value="Search" name="submit" id="submit">
			</form>
		</div>

		
	</body>
</html>
