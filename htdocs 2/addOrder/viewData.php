<?php
	$dataQuery = '';
	$searchText = '';
	if (isset($_GET['deleteId'])) {
		$id = $_GET['deleteId'];
		try {
            $db = new SQLite3('../LustrousJewelers.db');

			$query = "Delete from Orders where o_orderID = " .$id;
			$db->exec($query);

        }catch (Exception $e) {
            echo $e->getMessage();
        }
        finally
        {
            $db = null;
        }
		$dataQuery ='select * from Orders';
	}
	else if (isset($_POST['btnSearch'])) {
		$searchText = $_POST['txtSearch'];
		$dataQuery = "select * from Orders where o_orderID like '%".$searchText."%'";
	}
	else if (isset($_POST['txtSearch'])) {
		$searchText = $_POST['txtSearch'];
		$dataQuery = "select * from Orders where o_orderID like '%".$searchText."%'";
	}
	else{
		$dataQuery ='select * from Orders';
	}
?>

<!DOCTYPE html>    
<html>    
<head>    
    <title>Orders</title>    
	<link rel="stylesheet" type="text/css" href="viewData.css">    
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
</head>    

<body>    
    <h2 style="margin-left:-90px;font-size: 50px;">Orders</h2><br> 

	<form id='formSearch' method='POST' action = 'viewData.php'>
		<input type = 'text' name='txtSearch' id='txtSearch' placeholder='Search by Order ID...' 
			value=<?php echo $searchText; ?> > <input type = 'submit' name='btnSearch' id='btnSearch' value = 'Search'><br>
	</form><br/>

	<table class='center' style="width: 60%; ">
	  <tr>
		<th>Order ID</th>
		<th>Customer ID</th>
		<th>Total Cost</th>
		<th>Product ID</th>
		<th>Actions</th>
	  </tr>
	  
	<?php
		try {
			//code...

			$db = new PDO('sqlite:../LustrousJewelers.db');

			$result = $db->query($dataQuery);
			foreach ($result as $row ) {
				# code...
				echo "<tr><td>".$row['o_orderID']."</td>".
				"<td>".$row['o_customerID']."</td>".
				"<td>".$row['o_totalcost']."</td>".
				"<td>".$row['o_productID']."</td>".
				"<td><a href='viewData.php?deleteId=".$row['o_orderID']."'>Delete</a> "."</td></tr>";
				"<a href='../addOrder/addOrder.php?id=".$row['o_orderID'] ."'>Edit</a></td></tr>";
			}
		} catch (PDOException $e) {
			echo $e->getMessage();
		}
		finally{
			$db = null;
		}
	?>

	</table>
</div>    
</body>    
</html>  