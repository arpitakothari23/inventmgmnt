<?php
	include('session.php');
    $sql = 'SELECT * FROM product';
	$result = mysqli_query($db,$sql); 
	$rows = array();
	
	while($row = mysqli_fetch_array($result)){
    	$rows[] = $row;	
	}
	include('inventoryAction.php');
?>

<html>

	<head>
		<title>Inventory</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

		<link rel="stylesheet" type="text/css" href="css/dashboard.css">
		<link rel="stylesheet" type="text/css" href="css/inventory.css">
		<script type="text/javascript">
			var products = <?php echo json_encode( $rows ) ?>;
		</script>
		<script src="js/dashboard.js"></script>
		<script src="js/inventory.js"></script>
	</head>

	<body>
		<div id="top-bar">
			<nav>
				<ul>
					<li><a href="dashboard.php">Home</a></li>
					<li><a href="comment.php">Message</a></li>
					<li><a href="reference.php" target="_blank">About</a></li>
					<li><a href="logout.php">Logout</a></li>
				</ul>
			</nav>
		</div>	
		<div id = "side-navagate-bar">
			<div class = "toggle-btn" onclick="toggleSideBar()">
				<span></span>
				<span></span>
				<span></span>
			</div>
			<ul>
				<li><h2 id="logo">Lab Stock Management</h2></li>
				<li><a href="sales.php">Sales</a></li>
				<li><a href="adminInventory.php">Admin Inventory</a>
					<ul><br>	
					<li><a href="inventory.php">Current Stock</a></li>
					<li><a href="inventory.php">Order Placed</a></li>
					<li><a href="inventory.php">Deprecated Stock</a></li>
					</ul>
				</li>
			</ul>
		</div>

		<div id="block">
			<div id="main-area">
				<div id="welcome">
					<h1>Welcome <?php echo $login_session; ?></h1>
				</div>
				<div id="addItem">
					<button id="editBtn" onclick="edit()">Edit</button>
					<button id="addBtn" class="Btn">Add Item</button>
					<button id="addBtn" class="Btn">Delete Item</button>
					<button id="updateBtn" class="Btn">Update Sale</button>
					<form id="submit" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
						<div id="addModal" onclick="model()" class="modal">
							<div class="modal-content">
    							<span class="close">&times;</span>
								<div class="modal-body">
									<table>	
										<tr><td>Item Name: </td><td><input type="text" placeholder="itemName" name="item"></td></tr>
										<tr><td>#In-Stock: </td><td><input type="text" placeholder="storage" name="storage"></td></tr>
										<tr><td>Unit Price: </td><td><input type="text" placeholder="unitPrice" name="unitPrice"></td></tr>
										<tr><td>Sell Price: </td><td><input type="text" placeholder="sellPrice" name="sellPrice"></td></tr>
										<tr><td>Date: </td><td><input type="date" placeholder="date" name="date"></td></tr>
									</table>
									<br>
									<button id="addBtn" name="add">Add</button>
								</div>
							</div>
						</div>
						<div>
							<?php echo $message; ?>
						</div>
						<div id="deleteModal" onclick="model()" class="modal">
							<div class="modal-content">
    							<span class="close">&times;</span>
								<div class="modal-body">
									<table>	
										<tr><td>Item ID: </td><td><input type="text" placeholder="itemId" name="itemId"></td></tr>
									</table>
									<br>
									<button id="addBtn" name="delete">Delete</button>
								</div>
							</div>
						</div>
						<div>
						</div>
					</form>
				</div>
				
				<br>
				
				<form id="submit" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
					<div id="Product_Panel">
						<button name="edit" id="editBtn">Submit Change</button>
						<div id="updateModal" onclick="model()" class="modal">
							<div class="modal-content">
								<span class="close">&times;</span>
								<div class="modal-body">
									<table>
										<tr><td>Item Id: </td><td><input type="text" placeholder="itemId" name="itemId"></td></tr>
										<tr><td>Item Name: </td><td><input type="text" placeholder="itemName" name="item"></td></tr>
										<tr><td>Quantity: </td><td><input type="text" placeholder="quantity" name="quantity"></td></tr>
										<tr><td>Date: </td><td><input type="date" placeholder="date" name="date"></td></tr>
									</table>
									<br>
									<button id="editBtn" name="updateSale">Update Sale</button>
								</div>
							</div>
						</div>
						<div>
						</div>
						<br>
					</div>	
				</form>
				
				
				<script>
					// Get the modal
					var modal = document.getElementsByClassName("modal");
					
					// Get the button that opens the modal
					var btn = document.getElementsByClassName("Btn");
					
					// Get the <span> element that closes the modal
					var span = document.getElementsByClassName("close");
					
					// When the user clicks the button, open the modal 
					btn[0].onclick = function() {
					    modal[0].style.display = "block";
					}
					
					btn[1].onclick = function() {
					    modal[1].style.display = "block";
					}
					
					btn[2].onclick = function() {
					    modal[2].style.display = "block";
					}
					
					
					// When the user clicks on <span> (x), close the modal
					span[0].onclick = function() {
					    modal[0].style.display = "none";
					}
					
					span[1].onclick = function() {
					    modal[1].style.display = "none";
					}
					
					span[2].onclick = function() {
					    modal[2].style.display = "none";
					}
					
					// When the user clicks anywhere outside of the modal, close it
					window.onclick = function(event) {
					    if (event.target == modal) {
					        modal.style.display = "none";
					    }
					}
				</script>
			</div>
		</div>
	</body>
</html>