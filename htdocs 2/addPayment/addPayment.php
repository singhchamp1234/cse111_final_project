<?php

    $customerID    = '';
    $orderID   = '';
    $amount   = '';
    $status = '';
    $update = false;
    $id = 0;
    $success = '';

    if(isset($_POST['Save']))
    {
        $customerID    = $_POST["customerID"];
        $orderID   = $_POST["orderID"];
        $amount   = $_POST["amount"];
        $status = $_POST["status"];

        try {
            //code...

            $db = new SQLite3('../LustrousJewelers.db');

            $query = "INSERT INTO Payment(py_customerID, py_orderID, py_amount, py_status) values('".$customerID."', '".$orderID."', '".$amount."', '".$status."')";
            $db->exec($query);

            $customerID    = '';
            $orderID   = '';
            $amount   = '';
            $status = '';
            $success = 'Payment details saved.';

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
        $customerID    = $_POST["customerID"];
        $orderID   = $_POST["orderID"];
        $amount   = $_POST["amount"];
        $status = $_POST["status"];
        $success = 'Payment details Updated.';

        try {
        
            $db = new SQLite3('../LustrousJewelers.db');

            $query = "Update Payment set py_customerID = '".$customerID."',
            py_orderID  = '".$orderID."' ,
            py_amount= '".$amount."' , 
            py_status ='".$status."' where py_paymentID = ".$id ;
            $db->exec($query);

            $customerID    = '';
            $orderID   = '';
            $amount   = '';
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

			$result = $db->query('select * from Payment where py_paymentID = '.$id);
            
            $row = $result->fetch(PDO::FETCH_ASSOC);

            $customerID    = $row["py_customerID"];
            $orderID   = $row["py_orderID"];
            $amount   = $row["py_amount"];
            $status = $row["py_status"];
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
    <title>Payment details</title>    
    <link rel="stylesheet" type="text/css" href="addPayment.css">    
</head>    
<body>    
    <h2 style="font-size: 50px;">Payment details</h2><br>    
    <div class="login">    
    <form id="login" method="POST" action="addPayment.php">    
        <input type="hidden"
            style="margin-left: 26px;"		name="Id" id="Id" 
            value = <?php echo $id ?> >
        
        <label id="SuccessMessage"><b><?php echo $success; ?>     
        </b>    
        </label><br><br>
        
        <label><b>Customer ID     
        </b>    
        </label>    
        <input type="number"
            style="margin-left: 26px;"		name="customerID" id="customerID" placeholder="customerID"
            value = <?php echo $customerID ?> >    
        <br><br>  
		<label><b>Order ID     
        </b>    
        </label>    
        <input type="number" 
            style="margin-left: 26px;" name="orderID" id="orderID" placeholder="orderID"
            value = <?php echo $orderID ?> >
        <br><br>  	
		<label><b>Amount     
        </b>    
        </label>    
        <input type="number"
            style="margin-left: 20px;" name="amount" id="amount" placeholder="amount"
            value = <?php echo $amount ?> >    
        <br><br>     
        <label><b>Status     
        </b>    
        </label>    
        <textarea type="text"
            style="margin-left: 7px;" name="status" id="status" 
            placeholder="status" ><?php echo $status ?>
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
        <a id='viewAll' href='../addPayment/viewData.php'>View All-></a>    
    </form>     
</div>    
</body>    
</html>  