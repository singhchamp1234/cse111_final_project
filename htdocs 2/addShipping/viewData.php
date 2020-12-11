<?php
	$dataQuery = '';
	$searchText = '';
	if (isset($_GET['deleteId'])) {
		$id = $_GET['deleteId'];
		try {
            $db = new SQLite3('../LustrousJewelers.db');

			$query = "Delete from Shipping where s_shippingID = ". $id;
			$db->exec($query);

        }catch (Exception $e) {
            echo $e->getMessage();
        }
        finally
        {
            $db = null;
		}
		$dataQuery ='select * from Shipping';
	}
	else if (isset($_POST['btnSearch'])) {
		$searchText = $_POST['txtSearch'];
		$dataQuery = "select * from Shipping where s_orderID like '%".$searchText."%'";
	}
	else if (isset($_POST['txtSearch'])) {
		$searchText = $_POST['txtSearch'];
		$dataQuery = "select * from Shipping where s_orderID like '%".$searchText."%'";
	}
	else{
		$dataQuery ='select * from Shipping';
	}
?>

<!DOCTYPE html>    
<html>    
<head>    
    <title>Shipping</title>    
	<link rel="stylesheet" type="text/css" href="viewData.css">    
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
</head>    

<body>    
    <h2 style="margin-left:-90px;font-size: 50px;">Shippings</h2><br> 

	<form id='formSearch' method='POST' action = 'viewData.php'>
		<input type = 'text' name='txtSearch' id='txtSearch' placeholder='Search by Order Id...' 
			value=<?php echo $searchText; ?> > <input type = 'submit' name='btnSearch' id='btnSearch' value = 'Search'><br>
	</form><br/>

	<table class='center' style="width: 60%; ">
	  <tr>
		<th>Shipping Id</th>
		<th>Payment Id</th>
		<th>Order Id</th>
		<th>Customer Id</th>
		<th>s_status</th>
		<th>Actions</th>
	  </tr>
	  
	<?php
		try {
			//code...

			$db = new PDO('sqlite:../LustrousJewelers.db');

			$result = $db->query($dataQuery);
			foreach ($result as $row ) {
				# code...
				echo "<tr><td>".$row['s_shippingID']."</td>".
				"<td>".$row['s_paymentID']."</td>".
				"<td>".$row['s_orderID']."</td>".
				"<td>".$row['s_customerID']."</td>".
				"<td>".$row['s_status']."</td>".
				"<td><a href='viewData.php?deleteId=".$row['s_shippingID'] ."'>Delete</a></td></tr>";
				"<a href='../addShipping/addShipping.php?id=".$row['s_shippingID'] ."'>Edit</a></td></tr>";
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