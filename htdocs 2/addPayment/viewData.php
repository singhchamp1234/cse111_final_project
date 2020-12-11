<?php
	$dataQuery = '';
	$searchText = '';
	if (isset($_GET['deleteId'])) {
		$id = $_GET['deleteId'];
		try {
            $db = new SQLite3('../LustrousJewelers.db');

			$query = "Delete from Payment where py_paymentID = ". $id;
			$db->exec($query);

        }catch (Exception $e) {
            echo $e->getMessage();
        }
        finally
        {
            $db = null;
        }
		$dataQuery ='select * from Payment';
	}
	else if (isset($_POST['btnSearch'])) {
		$searchText = $_POST['txtSearch'];
		$dataQuery = "select * from Payment where py_orderID like '%".$searchText."%'";
	}
	else if (isset($_POST['txtSearch'])) {
		$searchText = $_POST['txtSearch'];
		$dataQuery = "select * from Payment where py_orderID like '%".$searchText."%'";
	}
	else{
		$dataQuery ='select * from Payment';
	}
?>

<!DOCTYPE html>    
<html>    
<head>    
    <title>Payment</title>    
	<link rel="stylesheet" type="text/css" href="viewData.css">    
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
</head>    

<body>    
    <h2 style="margin-left:-90px;font-size: 50px;">Payments</h2><br> 

	<form id='formSearch' method='POST' action = 'viewData.php'>
		<input type = 'text' name='txtSearch' id='txtSearch' placeholder='Search by Order Id...' 
			value=<?php echo $searchText; ?> > <input type = 'submit' name='btnSearch' id='btnSearch' value = 'Search'><br>
	</form><br/>

	<table class='center' style="width: 60%; ">
	  <tr>
		<th>Payment Id</th>
		<th>Customer Id</th>
		<th>Order Id</th>
		<th>Amount</th>
		<th>Status</th>
		<th>Actions</th>
	  </tr>
	  
	<?php
		try {
			//code...

			$db = new PDO('sqlite:../LustrousJewelers.db');

			$result = $db->query($dataQuery);
			foreach ($result as $row ) {
				# code...
				echo "<tr><td>".$row['py_paymentID']."</td>".
				"<td>".$row['py_customerID']."</td>".
				"<td>".$row['py_orderID']."</td>".
				"<td>".$row['py_amount']."</td>".
				"<td>".$row['py_status']."</td>".
				"<td><a href='viewData.php?deleteId=".$row['py_paymentID'] ."'>Delete</a> "."</td></tr>";
				//"<a href='../addCustomer/addCustomer.php?id=".$row['py_paymentID'] ."'>Edit</a></td></tr>";
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