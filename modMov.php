<!DOCTYPE html>
<html>
	<head>
		<?php 
		include "script.php";
		?>

		<link rel="stylesheet" href="style.css">

 	</head>
	<body>
		<?php 
            displayMovies();

            if (isset($_POST['apply'])){
                if ($_POST['movName'] == ''){
					displayMovies();
				}
				elseif ($_POST['tableDropdown'] == 'Add'){
					movAdd($_POST);
				}
				elseif ($_POST['tableDropdown'] == 'Remove'){
					movRemove($_POST);
				}
            }
			?>

			<!-- Javascript to hide and make visable the nessacary elements in the html -->
			<script>
				function test(){
					var hideVar = document.getElementById("tableDropdown")
					if(hideVar.value == "Remove"){
						document.getElementById("movPrice").style.display = "none";
						document.getElementById("movGenre").style.display = "none";
						document.getElementById("movYear").style.display = "none";
						document.getElementById("movActor").style.display = "none";
					}
					if(hideVar.value == "Add"){
						document.getElementById("movPrice").style.display = "inline";
						document.getElementById("movGenre").style.display = "inline";
						document.getElementById("movYear").style.display = "inline";
						document.getElementById("movActor").style.display = "inline";
					}
				}
			</script>

        <div id="navbar">
			<ul>
				<li><a href="index.php">View DataBase</a></li>
				<li><a href="modAct.php">Modify Actors</a></li>
				<li><a href="modMov.php">Modify Movies</a></li>
			</ul>
		</div>
        <div class='search'>
            <form method="POST" action="">
				<select name="tableDropdown" id="tableDropdown" onchange="test()">
  					<option value="Add">Add</option>
  					<option value="Remove">Remove</option>
				</select>
				<input type="text" id="movName" name="movName" placeholder="Movie Name" autocomplete="off">
                <input type="text" id="movPrice" name="movPrice" placeholder="Movie Price" autocomplete="off">
                <input type="text" id="movGenre" name="movGenre" placeholder="Movie Genre" autocomplete="off">
                <input type="text" id="movYear" name="movYear" placeholder="Movie Year" autocomplete="off">
                <input type="text" id="movActor" name="movActor" placeholder="Actor Name" autocomplete="off">
				<input type="submit" value="Apply" name="apply">
			</form>
        </div>
	</body>
</html>
