<?php

// function to display all the movies in the database

function displayMovies(){
    // information to connect to the database
    $db_host = "mysql.cs.nott.ac.uk";
    $db_user = "efyod2_comp1004";
    $db_pass = "password";
    $db_name = "efyod2_comp1004";
    // object of new connection to the database
    $connect = new mysqli($db_host, $db_user, $db_pass, $db_name) or die("Error connecting to SQL");
    //query the database about all movies
    $results = $connect -> query("SELECT * FROM Movie");
    //display the movies in a table, setting up the headers
    echo"<div class = 'div-1' id='tablecss'>";
    echo "<table border='1'>
        <tr>
            <th>Movie ID</th>
            <th>Movie Title</th>
            <th>Movie Price (£)</th>
            <th>Movie Genre</th>
            <th>Movie Year</th>
        </tr>";
    //displaying the data from the database into the headers
    while($row = mysqli_fetch_array($results)) {
        echo "<tr>";
        echo "<td>" . $row['mvID'] . "</td>";
        echo "<td>" . $row['mvTitle'] . "</td>";
        echo "<td>" . $row['mvPrice'] . "</td>";
        echo "<td>" . $row['mvGenre'] . "</td>";
        echo "<td>" . $row['mvYear'] . "</td>";

    }
    //clsoe the div and the table
    echo "</table>";
    echo "</div>";
    //close the connection to the database
    mysqli_close($connect);
}

function displayAll(){
    $db_host = "mysql.cs.nott.ac.uk";
    $db_user = "efyod2_comp1004";
    $db_pass = "password";
    $db_name = "efyod2_comp1004";
    $connect = new mysqli($db_host, $db_user, $db_pass, $db_name) or die("Error connecting to SQL");
    $results = $connect -> query("SELECT Movie.*, Actor.actName FROM Movie, Actor WHERE Movie.actID = Actor.actID");

    echo"<div class = 'div-3' id='tablecss'>";
    echo "<table border='1'>
        <tr>
            <th>Movie ID</th>
            <th>Movie Title</th>
            <th>Movie Price (£)</th>
            <th>Movie Genre</th>
            <th>Movie Year</th>
            <th>Actor ID</th>
            <th>Actor Name</th>
        </tr>";
    while($row = mysqli_fetch_array($results)) {
        echo "<tr>";
        echo "<td>" . $row['mvID'] . "</td>";
        echo "<td>" . $row['mvTitle'] . "</td>";
        echo "<td>" . $row['mvPrice'] . "</td>";
        echo "<td>" . $row['mvGenre'] . "</td>";
        echo "<td>" . $row['mvYear'] . "</td>";
        echo "<td>" . $row['actID'] . "</td>";
        echo "<td>" . $row['actName'] . "</td>";

    }
    echo "</table>";
    echo "</div>";
    mysqli_close($connect);
}

function displayActors(){
    $db_host = "mysql.cs.nott.ac.uk";
    $db_user = "efyod2_comp1004";
    $db_pass = "password";
    $db_name = "efyod2_comp1004";
    $connect = new mysqli($db_host, $db_user, $db_pass, $db_name) or die("Error connecting to SQL");
    $names = $connect -> query("SELECT * FROM Actor");
    echo"<div class = 'div-2' id='tablecss'>";
    echo "<table border='1'>
        <tr>
            <th>Actor ID</th>
            <th>Actor Name</th>

        </tr>";

    while($row = mysqli_fetch_array($names)){
        echo "<td>" . $row['actID'] . "</td>";
        echo "<td>" . $row['actName'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
    echo "</div>";
    mysqli_close($connect);

}

function movSearch($array){
    $db_host = "mysql.cs.nott.ac.uk";
    $db_user = "efyod2_comp1004";
    $db_pass = "password";
    $db_name = "efyod2_comp1004";
    $connect = new mysqli($db_host, $db_user, $db_pass, $db_name) or die("Error connecting to SQL");
    //query to get all movies from the database with the search movie name
    $text = "SELECT * FROM Movie WHERE mvTitle = '".$_POST["searchField"]."'";
    $results = $connect -> query($text);

    echo"<div class = 'div-1' id='tablecss'>";
    echo "<table border='1'>
        <tr>
            <th>Movie ID</th>
            <th>Movie Title</th>
            <th>Movie Price (£)</th>
            <th>Movie Genre</th>
            <th>Movie Year</th>
            <th>Actor</th>
        </tr>";

    while($row = mysqli_fetch_array($results)) {
        echo "<tr>";
        echo "<td>" . $row['mvID'] . "</td>";
        echo "<td>" . $row['mvTitle'] . "</td>";
        echo "<td>" . $row['mvPrice'] . "</td>";
        echo "<td>" . $row['mvGenre'] . "</td>";
        echo "<td>" . $row['mvYear'] . "</td>";
        echo "<td>" . $row['actID'] . "</td>";

    }
    echo "</table>";
    echo "</div>";
    mysqli_close($connect);

}

function actSearch($array){
    $db_host = "mysql.cs.nott.ac.uk";
    $db_user = "efyod2_comp1004";
    $db_pass = "password";
    $db_name = "efyod2_comp1004";
    $connect = new mysqli($db_host, $db_user, $db_pass, $db_name) or die("Error connecting to SQL");
    $text = "SELECT * FROM Actor WHERE actName = '".$_POST["searchField"]."'";
    $names = $connect -> query($text);

    echo"<div class = 'div-2' id='tablecss'>";
    echo "<table border='1'>
        <tr>
            <th>Actor ID</th>
            <th>Actor Name</th>

        </tr>";

    while($row = mysqli_fetch_array($names)){
        echo "<td>" . $row['actID'] . "</td>";
        echo "<td>" . $row['actName'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
    echo "</div>";
    mysqli_close($connect);

}

function actRemove($array){
    $db_host = "mysql.cs.nott.ac.uk";
    $db_user = "efyod2_comp1004";
    $db_pass = "password";
    $db_name = "efyod2_comp1004";
    $connect = new mysqli($db_host, $db_user, $db_pass, $db_name) or die("Error connecting to SQL");
    $result = $connect -> query("SELECT actID FROM Actor WHERE actName = '".$_POST["actName"]."'");
    $idStr = mysqli_fetch_assoc($result);
    $id = (int)$idStr["actID"];
    $connect -> query("SET FOREIGN_KEY_CHECKS=OFF");
    //removes the actor from the database
    $connect -> query("DELETE FROM Actor WHERE actName = '".$_POST["actName"]."'");
    //updates the movie table to remove the relation to the actor
    $connect -> query("UPDATE Movie SET actID = 0 WHERE actID = '".$id."'");
    $connect -> query("SET FOREIGN_KEY_CHECKS=ON");

    mysqli_close($connect);
    //refreshes the page
    header("Refresh:0");
}

function actAdd($array){
    $db_host = "mysql.cs.nott.ac.uk";
    $db_user = "efyod2_comp1004";
    $db_pass = "password";
    $db_name = "efyod2_comp1004";
    $connect = new mysqli($db_host, $db_user, $db_pass, $db_name) or die("Error connecting to SQL");
    // query the get all the actor ID's in an orderd list
    $freeNumArray = $connect->query("SELECT actID FROM Actor ORDER BY actID");
    $rowNumMax = mysqli_num_rows($freeNumArray);
    //finds the next free ID by iteration through the list
    $rowNum = 1;
    while($array = mysqli_fetch_array($freeNumArray)){
        if ($rowNum != $array['actID']){
            break;
        }else{
            $rowNum++;
        }
    }
    //adds the actor to the database
    $connect -> query("INSERT INTO Actor VALUES ('".$rowNum."','".$_POST["actName"]."')");
    mysqli_close($connect);
}

function movRemove($array){
    $db_host = "mysql.cs.nott.ac.uk";
    $db_user = "efyod2_comp1004";
    $db_pass = "password";
    $db_name = "efyod2_comp1004";
    $connect = new mysqli($db_host, $db_user, $db_pass, $db_name) or die("Error connecting to SQL");
    $connect -> query("SET FOREIGN_KEY_CHECKS=OFF");
    //removes the movies from the database
    $connect -> query("DELETE FROM Movie WHERE mvTitle = '".$_POST["movName"]."'");
    $connect -> query("SET FOREIGN_KEY_CHECKS=ON");



    mysqli_close($connect);
    header("Refresh:0");
}

function movAdd($array){
    $db_host = "mysql.cs.nott.ac.uk";
    $db_user = "efyod2_comp1004";
    $db_pass = "password";
    $db_name = "efyod2_comp1004";
    $connect = new mysqli($db_host, $db_user, $db_pass, $db_name) or die("Error connecting to SQL");
    $freeNumArray = $connect ->query("SELECT mvID FROM Movie ORDER BY mvID");
    $rowNumMax = mysqli_num_rows($freeNumArray);
    $rowNum = 0;
    //gets the actor ID
    $actID = $connect ->query("SELECT actID FROM Actor WHERE actName = '".$_POST["movActor"]."'");
    $actIDStr = mysqli_fetch_assoc($actID);
    $id = (int)$actIDStr["actID"];
    $movPrice = (float)$_POST["movPrice"];
    $movYear = (int)$_POST["movYear"];
    $movTitle = (string)$_POST["movName"];
    $movGenre = (string)$_POST["movGenre"];
    // finds the next free movie ID
    while($array = mysqli_fetch_array($freeNumArray)){
        if ($rowNum == $array['mvID']){
            $rowNum++;
        }else{
            break;
        }
    }
    if(($rowNumMax-1) == $rowNum){
        $rowNum++;
    }
    //adds the movie to the database
    $connect -> query("INSERT INTO Movie (mvID, actID, mvTitle, mvPrice, mvGenre, mvYear) VALUES ('".$rowNum."','".$id."','".$movTitle."','".$movPrice."','".$movGenre."','".$movYear."')");
    mysqli_close($connect);
    header("Refresh:0");
}

?>
