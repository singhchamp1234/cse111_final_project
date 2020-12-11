<?php
	$dataQuery = '';
	$searchText = '';
	if (isset($_GET['deleteId'])) {
		$id = $_GET['deleteId'];
		try {
            $db = new SQLite3('../LustrousJewelers.db');

			$query = "Delete from Customer where c_customerID = ". $id;
			$db->exec($query);

        }catch (Exception $e) {
            echo $e->getMessage();
        }
        finally
        {
            $db = null;
        }
		$dataQuery ='select * from Customer';
	}
	else if (isset($_POST['btnSearch'])) {
		$searchText = $_POST['txtSearch'];
		$dataQuery = "select * from Customer where c_name like '%".$searchText."%'";
	}
	else if (isset($_POST['txtSearch'])) {
		$searchText = $_POST['txtSearch'];
		$dataQuery = "select * from Customer where c_name like '%".$searchText."%'";
	}
	else{
		$dataQuery ='select * from Customer';
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
    <h2 style="margin-left:-90px;font-size: 50px;">Customers</h2><br> 

	<form id='formSearch' method='POST' action = 'viewData.php'>
		<input type = 'text' name='txtSearch' id='txtSearch' placeholder='Search by customer name...' 
			value=<?php echo $searchText; ?> > <input type = 'submit' name='btnSearch' id='btnSearch' value = 'Search'><br>
	</form><br/>

	<table class='center' style="width: 60%; ">
	  <tr>
		<th>ID</th>
		<th>Name</th>
		<th>Email</th>
		<th>Phone</th>
		<th>Address</th>
		<th>Actions</th>
	  </tr>
	  
	<?php
		try {
			//code...

			$db = new PDO('sqlite:../LustrousJewelers.db');

			$result = $db->query($dataQuery);
			foreach ($result as $row ) {
				# code...
				echo "<tr><td>".$row['c_customerID']."</td>".
				"<td>".$row['c_name']."</td>".
				"<td>".$row['c_email']."</td>".
				"<td>".$row['c_phoneNumber']."</td>".
				"<td>".$row['c_address']."</td>".
				"<td><a href='viewData.php?deleteId=".$row['c_customerID'] ."'>Delete</a> ".
				"<a href='../addCustomer/addCustomer.php?id=".$row['c_customerID'] ."'>Edit</a></td></tr>";
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