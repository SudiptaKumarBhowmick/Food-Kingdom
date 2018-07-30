<?php
session_start();
if(empty($_SESSION['pid'])){
	header("refresh:0; url=login.php");
}
 $connect = mysqli_connect("localhost", "root", "", "food kingdom"); 
 
  if(isset($_POST['assign_supplier'])){ 			//for submit button
	 if(isset($_POST['assignedSupplier'])){ 		//for dropdown list
		$customerID = $_POST['customerID'];
		$dropdownValue = $_POST['assignedSupplier'];
		$supplierID = $dropdownValue[0];
		$supplier_Name = '';
		$supplierInfo = "SELECT supplierName from supplier where supplier_ID = '$supplierID'";  
        $qr = mysqli_query($connect, $supplierInfo);
		if(mysqli_num_rows($qr) > 0)  
           {  
               while($row = mysqli_fetch_array($qr))  
				   $supplier_Name = $row[0];
		   }

		$of = "update order_food set supplier_ID = '$supplierID', supplierName = '$supplier_Name' WHERE customer_ID = '$customerID' and supplier_ID IS NULL and supplierName IS NULL";  
        $res = mysqli_query($connect, $of);
		$supplierState = "update supplier set DeliveryState = 'InDelivery' WHERE supplier_ID = '$supplierID'";  
        $qres = mysqli_query($connect, $supplierState);
		header("refresh:0; url=CustomerList.php");
				
	 }
 }
?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="assets/img/favicon.ico">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>Admin panel</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


    <!-- Bootstrap core CSS     -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="assets/css/animate.min.css" rel="stylesheet"/>

    <!--  Light Bootstrap Table core CSS    -->
    <link href="assets/css/light-bootstrap-dashboard.css" rel="stylesheet"/>


    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="assets/css/demo.css" rel="stylesheet" />


    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="assets/css/pe-icon-7-stroke.css" rel="stylesheet" />
	<link href="css/admin.css" rel="stylesheet" />
</head>
<body>

<div class="wrapper">
    <div class="sidebar" data-color="purple" data-image="assets/img/sidebar-5.jpg">

    <!--   you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple" -->


    	<div class="sidebar-wrapper">
            <div class="logo">
                <a href="http://www.google.com" class="simple-text">
                    Admin panel
                </a>
            </div>

            <ul class="nav">
                <li>
                    <a href="user.php">
                        <i class="pe-7s-user"></i>
                        <p>User Profile</p>
                    </a>
                </li>
                <li class="active">
                    <a href="typography.php">
                        <i class="pe-7s-news-paper"></i>
                        <p>Customer List</p>
                    </a>
                </li>
            </ul>
    	</div>
    </div>

    <div class="main-panel">
        


        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Customer List</h4>
                            </div>
                            <div class="content">

                <?php  
                $orderFoodquery = "SELECT customer_ID, customerName, customerEmail, customerPhone from customer where customer_ID IN (SELECT DISTINCT customer_ID FROM order_food where supplierName IS NULL and supplier_ID IS NULL)";  
                $result = mysqli_query($connect, $orderFoodquery);
				$supplierQuery = "SELECT supplier_ID, supplierName from supplier where DeliveryState = 'NotInDelivery'";
				$result1 = mysqli_query($connect, $supplierQuery);
                if(mysqli_num_rows($result) > 0 && mysqli_num_rows($result1) > 0)  
                {  
                     while($row = mysqli_fetch_array($result))  
                     {  
                ?>  
                <div class="col-md-4">  
                     <form method="post" action="CustomerList.php">  
                          <div style="border:1px solid #333; background-color:#f1f1f1; border-radius:5px; padding:16px;" align="center">  
                               <input type="hidden" name="customerID" value="<?php echo $row["customer_ID"]; ?>" />
							   <p style="text-align: left;font-weight: bold;font-size: 21px;">Customer</p>
							   <p style="float: left;margin-right: 1px;font-size: 14px;">Customer Name</p>
                               <input disabled style="color: #ff0035 !important;background-color: #F1F1F1;border-top: #F1F1F1;border-left: #F1F1F1;border-bottom: #F1F1F1;padding-bottom: 15px;" name="customerName" class="text-info" value="<?php echo $row["customerName"]; ?>" />  
							   <p style="float: left;margin-right: 1px;font-size: 14px;">Customer Email</p>
                               <input disabled style="color: #ff0035 !important;background-color: #F1F1F1;border-top: #F1F1F1;border-left: #F1F1F1;border-bottom: #F1F1F1;padding-bottom: 15px;" name="customerEmail" class="text-info" value= "<?php echo $row["customerEmail"]; ?>" /> 
							   <p style="text-align: left;font-weight: bold;font-size: 21px;">Supplier</p>
							   
							   <select name="assignedSupplier" style="font-size:20px">
							   <?php
							   $result1 = mysqli_query($connect, $supplierQuery);
							   while($row = mysqli_fetch_array($result1)){
							   ?>
							   <option name="supplierName" value="<?php echo $row["supplier_ID"]; ?>"><?php echo $row["supplierName"]; ?></option>
							   <?php 
							   }
							   ?>
							   </select></br>
                               <input type="submit" name="assign_supplier" style="margin-top:5px;" class="btn btn-success" value="Assign a Supplier" />  
                          </div>  
                     </form>  
                </div>  
                <?php  
                     }  
                }  
                ?>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

       


    </div>
</div>


</body>

        <!--   Core JS Files   -->
    <script src="assets/js/jquery-1.10.2.js" type="text/javascript"></script>
	<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>

	<!--  Checkbox, Radio & Switch Plugins -->
	<script src="assets/js/bootstrap-checkbox-radio-switch.js"></script>

	<!--  Charts Plugin -->
	<script src="assets/js/chartist.min.js"></script>

    <!--  Notifications Plugin    -->
    <script src="assets/js/bootstrap-notify.js"></script>

    <!--  Google Maps Plugin    -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>

    <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
	<script src="assets/js/light-bootstrap-dashboard.js"></script>

	<!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
	<script src="assets/js/demo.js"></script>

</html>
