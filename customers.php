<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Rampart+One&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/1c62ecd995.js" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="CSS/Styles.css">
	<title>unitBank</title>
</head>

<body>
	<div class="container-fluid">
		<!-- navbar -->
		<div class="container">
			<nav class="navbar navbar-expand-lg navbar-dark">
				<a class="navbar-brand" href=""><i class="fa-solid fa-piggy-bank"></i>unitBank</a>
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse " id="navbarTogglerDemo01">
					<ul class="navbar-nav ms-auto">
						<li class="nav-item ">
							<a class="nav-link px-2" href="index.html">Home</a>
						</li>
						<li class="nav-item">
							<a class="nav-link px-2" href="#">Customers</a>
						</li>
						<li class="nav-item">
							<a class="nav-link px-2" href="transaction.php">Transactions</a>
						</li>
					</ul>
				</div>
			</nav>
		</div>
		<!-- customers -->
		<div class="container customers">
			<h1>Our valued customers</h1>
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
			$sql = "SELECT * FROM customers";
			$result = $conn->query($sql);

			if ($result->num_rows > 0) {
				// Output the data in an HTML table
				echo "<table class='table table-striped table-hover '>";
				echo "<thead><tr><th>ID</th><th>Name</th><th>Email</th><th>Balance</th><th>Transfer money</th></tr></thead>";
				echo "<tbody class='table-group-divider'>";
				while ($row = $result->fetch_assoc()) {
					$id = $row["id"];
					$name = $row["name"];
					echo "<tr><td>" . $row["id"] . "</td><td>" . $row["name"] . "</td><td>" . $row["email"] . "</td><td>" . $row["balance"] . "</td><td><button class='btn btn-outline-dark' id='btn-$id' onClick='showForm(\"$name\")'>Transfer</button></td></tr>";
				}
				echo "</tbody>";
				echo "</table>";
			} else {
				echo "0 results";
			}

			$conn->close();
			?>
		</div>
		<!-- Transfer form -->
		<div class="transfer-form" id="transfer-form" style="display: none;">
			<div class="transfer-form-header">
				<h1>Money Transfer</h1>
				<button id="close"><i class="fa-solid fa-circle-xmark"></i></button>
			</div>
			<form method="post" action="form.php">
				<label for="from">From:</label>
				<input type="text" class="form-control" id="from" name="from">
				<label for="to" class="mt-2">To:</label>
				<?php
				// Connect to MySQL database
				$conn = mysqli_connect("localhost", "root", "", "bankingSystem");

				// Retrieve names from MySQL table
				$sql = "SELECT name FROM customers";
				$result = mysqli_query($conn, $sql);
				
				echo "<select class='form-select' name='Fto'>";
				while ($row = $result->fetch_assoc()) {
					$name = $row["name"];
					echo "<option value='$name'>".$name."</option>";
				}
				echo "</select>";

				mysqli_close($conn);
				?>
				<br>
				<label for="amt">Amount:</label>
				<input type="text" class="form-control" placeholder="Amount" name="Tamt">
				<button type="submit" class="btn btn-outline-light mt-3" id="transfer">Transfer</button>
			</form>
		</div>

		<div class="Tsuccess" id="Tsuccess">
			<h1><i class="fa-sharp fa-solid fa-thumbs-up"></i> <br> Transaction <br> successful!!</h1>
			<button class="btn btn-outline-light"><a href="transaction.php" style="text-decoration: none; color: black;">Ok!!</a></button>
		</div>
	</div>

	<script src="JS/index.js"></script>
</body>

</html>