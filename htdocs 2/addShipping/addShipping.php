<?php

    $paymentID    = '';
    $orderID   = '';
    $customerID   = '';
    $status = '';
    $update = false;
    $id = 0;
    $success = '';

    if(isset($_POST['Save']))
    {
        $paymentID    = $_POST["paymentID"];
        $orderID   = $_POST["orderID"];
        $customerID   = $_POST["customerID"];
        $status = $_POST["status"];

        try {
            //code...

            $db = new SQLite3('../LustrousJewelers.db');

            $query = "INSERT INTO Shipping(s_paymentID, s_orderID, s_customerID, s_status) values('".$paymentID."', '".$orderID."', '".$customerID."', '".$status."')";
            $db->exec($query);

            $paymentID    = '';
            $orderID   = '';
            $customerID   = '';
            $status = '';
            $success = 'Shipping details saved.';

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
        $paymentID    = $_POST["paymentID"];
        $orderID   = $_POST["orderID"];
        $customerID   = $_POST["customerID"];
        $status = $_POST["status"];
        $success = 'Customer details Updated.';

        try {
        
            $db = new SQLite3('../LustrousJewelers.db');

            $query = "Update Shipping set s_paymentID = '".$paymentID."',
            s_orderID  = '".$orderID."' ,
            s_customerID = '".$customerID."' , 
            s_status ='".$status."' where s_shippingID = ".$id ;
            $db->exec($query);

            $paymentID    = '';
            $orderID   = '';
            $customerID   = '';
            $status = '';

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

			$result = $db->query('select * from Shipping where s_shippingID = '.$id);
            
            $row = $result->fetch(PDO::FETCH_ASSOC);

            $paymentID    = $row["s_paymentID"];
            $orderID   = $row["s_orderID"];
            $customerID   = $row["s_customerID"];
            $status = $row["status"];
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
    <title>Shipping details</title>    
    <link rel="stylesheet" type="text/css" href="addShipping.css">    
</head>    
<body>    
    <h2 style="font-size: 50px;">Shipping details</h2><br>    
    <div class="login">    
    <form id="login" method="POST" action="addShipping.php">    
        <input type="hidden"
            style="margin-left: 26px;"		name="Id" id="Id" 
            value = <?php echo $id ?> >
        
        <label id="SuccessMessage"><b><?php echo $success; ?>     
        </b>    
        </label><br><br>
        
        <label><b>Payment ID     
        </b>    
        </label>    
        <input type="number"
            style="margin-left: 26px;"		name="paymentID" id="paymentID" placeholder="paymentID"
            value = <?php echo $paymentID ?> >    
        <br><br>  
		<label><b>Order ID     
        </b>    
        </label>    
        <input type="number" 
            style="margin-left: 26px;" name="orderID" id="orderID" placeholder="orderID"
            value = <?php echo $orderID ?> >
        <br><br>  	
		<label><b>Customer ID     
        </b>    
        </label>    
        <input type="number"
            style="margin-left: 20px;" name="customerID" id="customerID" placeholder="customerID"
            value = <?php echo $customerID ?> >    
        <br><br>     
        <label><b>Status     
        </b>    
        </label>    
        <textarea type="text"
            style="margin-left: 7px;" name="status" id="status" placeholder="status" ><?php echo $status ?>
        </textarea>
        <br><br><br><br> 
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
        <a id='viewAll' href='../addShipping/viewData.php'>View All-></a>    
    </form>     
</div>    
</body>    
</html>  