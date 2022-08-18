<?php
$dbcon = mysqli_connect("localhost", "woolleyja", "jollyship44", "woolleyja_cafe");
if(mysqli_connect_errno()){
    echo "Failed to connect to MySQL:".mysqli_connect_error(); die();}
else{
    echo "connected to database";}

if(isset($_GET['drink'])){
    $id = $_GET['drink'];
}else{
    $id = 1;
}

$this_drink_query = "SELECT drink, cost FROM drinks WHERE drink_id = '" . $id ."'";
$this_drink_result = mysqli_query($dbcon, $this_drink_query);
$this_drink_record = mysqli_fetch_assoc($this_drink_result);

$all_drinks_query = "SELECT drink_id, drink FROM drinks";
$all_drinks_results = mysqli_query($dbcon, $all_drinks_query);
?>

<!DOCTYPE html>

<html lang="en">

<head>
    <title> JJ's Cafe </title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="style.css"
</head>

<body>
    <header>
        <h1> JJ's Cafe</h1>
        <nav>
            <ul>
                <li> <a href="index_cafe.php"> HOME </a> </li>
                <li> <a href="drinks_cafe.php"> DRINKS </a> </li>
                <li> <a href="orders_cafe.php"> ORDERS </a> </li>
                <li> <a href="customers_cafe.php"> CUSTOMER </a> </li>
            </ul>
        </nav>
    </header>

    <main>
        <h2> Drinks Information</h2>

        <?php

            echo "<p> Drink Name: " . $this_drink_record['drink'] . "<br>";
            echo "<p> Cost: " . $this_drink_record['cost'] . "<br>";
        ?>

        <h2> Select Another Drink </h2>

        <!-- Drinks Form -->
        <form name="drinks_form" id="drinks_form" method="get" action="drinks_cafe.php">
            <select id="drink" name="drink">
                <!-- options -->
                <?php
                while($all_drinks_record = mysqli_fetch_assoc($all_drinks_results)){
                    echo "<option value = '". $all_drinks_record['drink_id'] . "'>";
                    echo $all_drinks_record['drink'];
                    echo "</option>";
                }
                ?>
            </select>

            <input type="submit" name="drinks_button" value="Show me the drinks info">
        </form>

        <h2> Search A Drink </h2>

        <form action="" method="post">
            <input type="text" name="search">
            <input type="submit" name="submit" value="Search">
        </form>
        <?php
        if (isset($_POST['search'])){
            $search = $_POST['search'];

            $query1 = "SELECT * FROM drinks WHERE drink LIKE '%$search%'";
            $query = mysqli_query($dbcon, $query1);
            $count = mysqli_num_rows($query);

            if($count == 0){
                echo "There were no search results!";
            }else{
                while($row = mysqli_fetch_array($query)){
                    echo $row['drink'];
                    echo "<br>";
                }
            }
        }
        ?>
    </main>
</body>
</html>