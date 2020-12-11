<?php

    $productID    = '';
    $totalcost   = '';
    $customerID   = '';
    $update = false;
    $id = 0;
    $success = '';

    if(isset($_POST['Save']))
    {
        $productID    = $_POST["productID"];
        $totalcost  = $_POST["totalcost"];
        $customerID   = $_POST["customerID"];
        

        try {
            //code...

            $db = new SQLite3('../LustrousJewelers.db');

            $query = "INSERT INTO Orders(o_productID, o_totalcost, o_customerID) values('".$productID."', '".$totalcost."', '".$customerID."')";
            $db->exec($query);

            $productID    = '';
            $totalcost   = '';
            $customerID   = '';
            $success = 'Order details saved.';

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
        $productID    = $_POST["productID"];
        $totalcost  = $_POST["totalcost"];
        $customerID   = $_POST["customerID"];
        $success = 'Customer details Updated.';

        try {
        
            $db = new SQLite3('../LustrousJewelers.db');

            $query = "Update Orders set o_productID = '".$productID."',
            o_totalcost  = '".$totalcost."' ,
            o_customerID= '".$customerID."'
            where o_orderID = ".$id ;
            $db->exec($query);

            $productID    = '';
            $totalcost   = '';
            $customerID   = '';

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

			$result = $db->query('select * from Orders where o_orderID = '.$id);
            
            $row = $result->fetch(PDO::FETCH_ASSOC);

            $productID    = $row["o_productID"];
            $totalcost   = $row["o_totalcost"];
            $customerID   = $row["o_customerID"];
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
    <title>Order details</title>    
    <link rel="stylesheet" type="text/css" href="addOrder.css">    
</head>    
<body>    
    <h2 style="font-size: 50px;">Order details</h2><br>    
    <div class="login">    
    <form id="login" method="POST" action="addOrder.php">    
        <input type="hidden"
            style="margin-left: 26px;" name="Id" id="Id" 
            value = <?php echo $id ?> >
        
        <label id="SuccessMessage"><b><?php echo $success; ?>     
        </b>    
        </label><br><br>
        
        <label><b>Product ID   
        </b>    
        </label>    
        <input type="text"
            style="margin-left: 26px;"		name="productID" id="productID" placeholder="productID"
            value = <?php echo $productID ?> >    
        <br><br>  
		<label><b>Total Cost     
        </b>    
        </label>    
        <input type="text" 
            style="margin-left: 26px;" name="totalcost" id="totalcost" placeholder="totalcost"
            value = <?php echo $totalcost ?> >
        <br><br>  	
		<label><b>Customer ID     
        </b>    
        </label>    
        <input type="text"
            style="margin-left: 20px;" name="customerID" id="customerID" placeholder="customerID"
            value = <?php echo $customerID ?> >    
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
        <a id='viewAll' href='../addOrder/viewData.php'>View All-></a>   
    </form>     
</div>    
</body>    
</html>  