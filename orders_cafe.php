<?php
$dbcon = mysqli_connect("localhost", "woolleyja", "jollyship44", "woolleyja_cafe");
if(mysqli_connect_errno()){
    echo "Failed to connect to MySQL:".mysqli_connect_error(); die();}
else{
    echo "connected to database";}

if(isset($_GET['order'])){
    $id = $_GET['order'];
}else{
    $id = 1;
}



$this_order_query = "SELECT orders.orders_id, customers.fname, customers.lname, drinks.drink
FROM customers, orders, drinks
WHERE customers.cust_id = orders.cust_id
AND orders.drink_id = drinks.drink_id AND orders.orders_id = '" . $id . "'";
$this_order_result = mysqli_query($dbcon, $this_order_query);
$this_order_record = mysqli_fetch_assoc($this_order_result);

$all_orders_query = "SELECT orders_id FROM orders ORDER BY orders_id ASC";
$all_orders_results = mysqli_query($dbcon, $all_orders_query);
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
        <h2> Order Information</h2>

        <?php

        echo "<p> Order Number: ". $this_order_record['orders_id'] . "<br>";
        echo "<p> Customer First Name: ". $this_order_record['fname'] . "<br>";
        echo "<p> Customer Last Name: ". $this_order_record['lname'] . "<br>";
        echo "<p> Drink: ". $this_order_record['drink'] . "<br>";
        ?>

        <h2> Select Another Order </h2>

        <!-- Orders Form -->
        <form name="orders_form" id="orders_form" method="get" action="orders_cafe.php">
            <select id="order" name="order">
                <!-- options -->
                <?php
                while($all_orders_record = mysqli_fetch_assoc($all_orders_results)){
                    echo "<option value = '". $all_orders_record['orders_id'] . "'>";
                    echo $all_orders_record['orders_id'];
                    echo "</option>";
                }
                ?>
            </select>
            <input type="submit" name="orders_button" value="Show me the orders info">
        </form>
    </main>
</body>
</html>