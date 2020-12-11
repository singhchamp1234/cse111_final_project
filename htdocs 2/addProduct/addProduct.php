<?php

    $name    = '';
    $quantity   = '';
    $cost   = '';
    $custID = '';
    $update = false;
    $id = 0;
    $success = '';

    if(isset($_POST['Save']))
    {
        $name    = $_POST["Pname"];
        $quantity   = $_POST["Quantity"];
        $cost   = $_POST["Cost"];
        $custID = $_POST["custID"];

        try {
            //code...

            $db = new SQLite3('../LustrousJewelers.db');

            $query = "INSERT INTO Products(p_name,p_quantity,p_cost,p_customerID) values('".$name."', '".$quantity."', '".$cost."', '".$custID."' )";
            $db->exec($query);

            $name    = '';
            $quantity   = '';
            $cost   = '';
            $custID = '';
            $success = 'Product details are saved.';

        }catch (Exception $e) {
            echo $e->getMessage();
        }
        finally
        {
            $db = null;
        }
    }

    if(isset($_POST['Update']))
    {
        $id      = $_POST["Id"];
        $name    = $_POST["Pname"];
        $quantity= $_POST["Quantity"];
        $cost    = $_POST["Cost"];
        $custID    = $_POST["custID"];
        $success = 'Product details are updated.';

        try {
        
            $db = new SQLite3('../LustrousJewelers.db');

            $query = "Update Products set p_name = '".$name."',
            p_quantity  = '".$quantity."' ,
            p_cost= '".$cost."' ,
            p_customerID= '".$custID."'
            where p_productID = ".$id ;
            $db->exec($query);

            $name    = '';
            $quantity   = '';
            $cost   = '';
            $custID   = '';
            
        }catch (Exception $e) {
            echo $e->getMessage();
        }
        finally
        {
            $db = null;
        }
    }

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $update = true;
		try {
            $db = new PDO('sqlite:../LustrousJewelers.db');

			$result = $db->query('select * from Products where p_productID = '.$id);
            
            $row = $result->fetch(PDO::FETCH_ASSOC);

            $name    = $row["p_name"];
            $quantity   = $row["p_quantity"];
            $cost   = $row["p_cost"];
            $custID   = $row["p_customerID"];
        }catch (Exception $e) {
            echo $e->getMessage();
        }
        finally
        {
            $db = null;
        }
	}

?>

<!DOCTYPE html>    
<html>    
<head>    
    <title>Product details</title>    
    <link rel="stylesheet" type="text/css" href="addProduct.css">    
</head>    
<body>    
    <h2 style="font-size: 50px;">Product details</h2><br>    
    <div class="login">    
    <form id="login" method="POST" action="addProduct.php">    
        <input type="hidden"
            style="margin-left: 26px;"		name="Id" id="Id" 
            value = <?php echo $id ?> >
        
        <label id="SuccessMessage"><b><?php echo $success; ?>     
        </b>    
        </label><br><br>
        
        <label><b>Name     
        </b>    
        </label>    
        <input type="text"
            style="margin-left: 26px;"		name="Pname" id="Pname" placeholder="Name"
            value = <?php echo $name ?> >    
        <br><br>  
		<label><b>Quantity     
        </b>    
        </label>    
        <input type="number" 
            style="margin-left: 10px;" name="Quantity" id="Quantity" placeholder="Quantity"
            value = <?php echo $quantity ?> >
        <br><br>  	
		<label><b>Cost     
        </b>    
        </label>    
        <input type="number"
            style="margin-left: 40px;" name="Cost" id="Cost" placeholder="Cost"
            value = <?php echo $cost ?> >    
        <br><br> 
        <label><b>custID     
        </b>    
        </label>    
        <input type="number"
            style="margin-left: 75px; "	name="custID" id="custID" placeholder="custID"
            value = <?php echo $custID ?> >    
        <br><br>

        <br><br> 
        <?php 
        if ($update == true) :
        ?>
            <input type='submit' name='Update' id='Update'
            style='margin-left: 47px;' value= 'Update'>
        <?php
        else:
        ?>
            <input type='submit' name='Save' id='Save'
            style='margin-left: 47px;' value= 'Save'>
        <?php endif; ?>
        <br><br>    
        <a id='back' href='../menu/menu.php'><-Back</a>
        <a id='viewAll' href='viewData.php'>View All-></a> 
        
           
    </form>     
</div>    
</body>    
</html>  