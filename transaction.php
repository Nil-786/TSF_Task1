<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>unitBank</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Rampart+One&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/1c62ecd995.js" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="CSS/Styles.css">
</head>

<body>
	<div class="container-fluid">
		<!-- navbar -->
		<div class="container">
			<nav class="navbar navbar-expand-lg navbar-dark">
			  <a class="navbar-brand" href=""><i class="fa-solid fa-piggy-bank"></i>unitBank</a>
			  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01"
				aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			  </button>
			  <div class="collapse navbar-collapse " id="navbarTogglerDemo01">
				<ul class="navbar-nav ms-auto">
				  <li class="nav-item ">
					<a class="nav-link px-2" href="index.html">Home</a>
				  </li>
				  <li class="nav-item">
					<a class="nav-link px-2" href="customers.php">Customers</a>
				  </li>
				  <li class="nav-item">
					<a class="nav-link px-2" href="#">Transactions</a>
				  </li>
				</ul>
			  </div>
			</nav>
		</div>
		<!-- Transactions -->
		<div class="container customers">
			<h1>Transactions</h1>
			<?php
			// Connect to the database
			$servername = "localhost";
			$username = "root";
			$password = "";
			$dbname = "bankingSystem";

			$conn = new mysqli($servername, $username, $password, $dbname);

			if ($conn->connect_error) {
				die("Connection failed: " . $conn->connect_error);
			}

			// Execute a SELECT statement to retrieve the data
			$sql = "SELECT * FROM transactions";
			$result = $conn->query($sql);

			if ($result->num_rows > 0) {
				// Output the data in an HTML table
				echo "<table class='table table-striped table-hover '>";
				echo "<thead><tr><th>ID</th><th>From</th><th>To</th><th>Amount</th></tr></thead>";
				echo "<tbody class='table-group-divider'>";
				while ($row = $result->fetch_assoc()) {
					echo "<tr><td>" . $row["Trns_id"] . "</td><td>" . $row["n_from"] . "</td><td>" . $row["n_to"] . "</td><td>" . $row["amount"] . "</td></tr>";
				}
				echo "</tbody>";
				echo "</table>";
			} else {
				echo "0 results";
			}

			$conn->close();
			?>
		</div>
	</div>
</body>

</html>