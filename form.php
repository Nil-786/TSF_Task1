<?php

// Step 1: Create a connection to the MySQL database
$host = "localhost";
$username = "root";
$password = "";
$database = "bankingSystem";

$conn = mysqli_connect($host, $username, $password, $database);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Step 2: Get the form data
$from = $_POST['from'];
$to = $_POST['Fto'];
$amount = $_POST['Tamt'];

// echo $from;
// echo $to;
// echo $amount;

// Step 3: Validate and sanitize the form data
$from = mysqli_real_escape_string($conn, $from);
$to = mysqli_real_escape_string($conn, $to);
$amount = mysqli_real_escape_string($conn, $amount);

// Step 4: Insert the form data into the MySQL database
$sql = "INSERT INTO transactions (n_from, n_to, amount  ) VALUES ('$from', '$to', '$amount')";
if (mysqli_query($conn, $sql)) {
    if(isset($to) && isset($amount)) {
        $balance_query = "SELECT balance FROM customers WHERE `name` = '$to'";
        $balance_result = mysqli_query($conn, $balance_query);
        $current_balance = mysqli_fetch_assoc($balance_result)['balance'];
        $updated_balance = $current_balance + $amount;
        $update_query = "UPDATE customers SET balance = $updated_balance WHERE `name` = '$to'";
        $update_result = mysqli_query($conn, $update_query);
      }
      if ($update_result) {
        // The update was successful
        header("Location: customers.php");
        exit;
      } else {
        // The update failed
        echo "Error updating balance";
      }
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

// Step 5: Close the database connection
mysqli_close($conn);

?>