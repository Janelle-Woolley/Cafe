<?php
$dbcon = mysqli_connect("localhost", "woolleyja", "jollyship44", "woolleyja_cafe");
if(mysqli_connect_errno()){
    echo "Failed to connect to MySQL:".mysqli_connect_error(); die();}
else{
    echo "connected to database";}

/* Drinks Query */
/* SELECT drink_id, drink FROM drinks */
$all_drinks_query = "SELECT drink_id, drink FROM drinks";
$all_drinks_results = mysqli_query($dbcon, $all_drinks_query);

$all_orders_query = "SELECT orders_id FROM orders ORDER BY orders_id ASC";
$all_orders_results = mysqli_query($dbcon, $all_orders_query);

$all_cust_query = "SELECT cust_id, fname FROM customers";
$all_cust_results = mysqli_query($dbcon, $all_cust_query);
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

            <!-- Customers Form -->
            <form name="customers_form" id="customers_form" method="get" action="customers_cafe.php">
                <select id="customer" name="customer">
                    <!-- options -->
                    <?php
                        while($all_cust_record = mysqli_fetch_assoc($all_cust_results)){
                            echo "<option value = '". $all_cust_record['cust_id'] . "'>";
                            echo $all_cust_record['fname'];
                            echo "</option>";
                        }
                    ?>
                </select>
                <input type="submit" name="customer_button" value="Show me the customer info">
            </form>
        </main>
    </body>
</html>
