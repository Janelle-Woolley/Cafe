<?php
$dbcon = mysqli_connect("localhost", "woolleyja", "jollyship44", "woolleyja_cafe");
if(mysqli_connect_errno()){
    echo "Failed to connect to MySQL:".mysqli_connect_error(); die();}
else{
    echo "connected to database";}

if(isset($_GET['customer'])){
    $id = $_GET['customer'];
}else{
    $id = 1;
}

$this_cust_query = "SELECT customers.fname, customers.lname, customers.phone, customers.dob, SUM(drinks.cost) 
FROM customers, drinks, orders
WHERE customers.cust_id = orders.cust_id
AND drinks.drink_id = orders.drink_id
AND customers.cust_id = '" . $id . "'";
$this_cust_result = mysqli_query($dbcon, $this_cust_query);
$this_cust_record = mysqli_fetch_assoc($this_cust_result);

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
            <h2> Customer Information </h2>

            <?php
            echo "<p> Customer First Name: ". $this_cust_record['fname'] . "<br>";
            echo "<p> Customer Last Name: ". $this_cust_record['lname'] . "<br>";
            echo "<p> Phone Number: ". $this_cust_record['phone'] . "<br>";
            echo "<p> DOB: ". $this_cust_record['dob'] . "<br>";
            echo "<p> Total: ". $this_cust_record['SUM(drinks.cost)'] . "<br>";
            ?>

            <h2> Select Another Customer </h2>
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
</html>
