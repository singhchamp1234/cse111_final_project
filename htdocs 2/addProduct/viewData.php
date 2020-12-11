<?php
	$dataQuery = '';
	$searchText = '';
	if (isset($_GET['deleteId'])) {
		$id = $_GET['deleteId'];
		try {
            $db = new SQLite3('../LustrousJewelers.db');

			$query = "Delete from Products where p_productID = ". $id;
			$db->exec($query);

        }catch (Exception $e) {
            echo $e->getMessage();
        }
        finally
        {
            $db = null;
		}
		$dataQuery ='select * from products';
	}
	else if (isset($_POST['btnSearch'])) {
		$searchText = $_POST['txtSearch'];
		$dataQuery = "select * from products where p_name like '%".$searchText."%'";
	}
	else if (isset($_POST['txtSearch'])) {
		$searchText = $_POST['txtSearch'];
		$dataQuery = "select * from products where p_name like '%".$searchText."%'";
	}
	else{
		$dataQuery ='select * from products';
	}
?>

<!DOCTYPE html>    
<html>    
<head>    
    <title>Customers</title>    
	<link rel="stylesheet" type="text/css" href="viewData.css">    
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
</head>    

<body>    
    <h2 style="margin-left:-90px;font-size: 50px;">Products</h2><br> 

	<form id='formSearch' method='POST' action = 'viewData.php'>
		<input type = 'text' name='txtSearch' id='txtSearch' placeholder='Search by product name...' 
			value=<?php echo $searchText; ?> > <input type = 'submit' name='btnSearch' id='btnSearch' value = 'Search'><br>
	</form><br/>

	<table class='center' style="width: 60%; ">
	  <tr>
		<th>Product ID</th>
		<th>Customer ID</th>
		<th>Name</th>
		<th>Quantity</th>
		<th>Cost</th>
		<th>Actions</th>
	  </tr>
	  
	<?php
		try {
			//code...

			$db = new PDO('sqlite:../LustrousJewelers.db');

			$result = $db->query($dataQuery);
			foreach ($result as $row ) {
				# code...
				echo "<tr><td>".$row['p_productID']."</td>".
				"<td>".$row['p_customerID']."</td>".
				"<td>".$row['p_name']."</td>".
				"<td>".$row['p_quantity']."</td>".
				"<td>".$row['p_cost']."</td>".
				"<td><a href='viewData.php?deleteId=".$row['p_productID'] ."'>Delete</a> "
				."<a href='addProduct.php?id=".$row['p_productID'] ."'>Edit</a>
				</td></tr>";
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