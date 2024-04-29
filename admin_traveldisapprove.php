<?php
session_start();

if (!isset($_SESSION["admin"])) {
    // Redirect to login page or display an error message
    header("Location: SignUP.php");
    exit();
}

// Access the admin object stored in the session variable
$admin = $_SESSION["admin"];

include "connect.php";
// Query the database to get the admin's information
$sql = "SELECT * FROM admin WHERE aid = ?";
$stmt = $dbconnection->prepare($sql);
$stmt->bind_param("i", $admin);
$stmt->execute();
$result = $stmt->get_result();

// Check if the query was successful
if ($result === false) {
    die("Query failed: " . $conn->error);
}

// Fetch the admin's information from the result set
$admin = $result->fetch_assoc();

// Use the admin object to perform actions that require admin privileges
?>
<!doctype html>
<html lang="en">

  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
      <title>SwiftShift Admin</title>
        <link rel="icon" type="image/png" href="images/bc_logo.png" />
	    <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="css/bootstrap.min.css">
	    <!----css3---->
        <link rel="stylesheet" href="css/custom.css">
		
		
		<!--google fonts -->
	
	    <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
	
	
	<!--google material icon-->
      <link href="https://fonts.googleapis.com/css2?family=Material+Icons"rel="stylesheet">


    <link href="https://netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/094c1a5071.js" crossorigin="anonymous"></script>

    <style>
      .display_info{
        margin-bottom:20px;
      }
      .table tr{
				border-left:3px solid #7895CB;
				border-right:3px solid #7895CB;
			}
      .add-on{
				margin-left:20px;
			}
      .add_table{
        margin-top:30px;
      }
      .btn_add{
				background-color: #7895CB;
				border:none;
				width:100px;
				height:35px;
				margin-top:10px;
	  }
    .back-btn{
				/*margin-left:10px;*/
				border:none;
				background-color: #7895CB;
				width:100px;
				height:35px;
				margin-top:10px;
			}
    </style>

  </head>

  <?php 
  include 'connect.php';
  

   
              
  

if (isset($_POST["delete"])) {
    $pid = $_POST["action_id"];

    // Get current date and time
    $current_datetime = date("Y-m-d H:i:s");

    // Prepare and execute query to fetch ddate and dtime from plan table
    $plan_query = $dbconnection->prepare("SELECT ddate, dtime FROM plan WHERE pid = ?");
    $plan_query->bind_param("i", $pid);
    $plan_query->execute();
    $plan_result = $plan_query->get_result();

    if ($plan_result->num_rows > 0) {
        $row = $plan_result->fetch_assoc();
        $ddate = $row["ddate"];
        $dtime = $row["dtime"];

        // Compare current date and time with ddate and dtime
        if ($current_datetime > "$ddate $dtime") {
            // Show alert for confirmation
            echo '<script>alert("Are you sure you want to delete?");</script>';

            // If confirmed, delete the record
            $dquery = $dbconnection->prepare("DELETE FROM btickets WHERE pid = ?");
            $dquery->bind_param("i", $pid);
            $dquery->execute();
            echo '<script>alert("Record deleted successfully!");</script>';
        } else {
            echo '<script>alert("Cannot delete! Current time is not late.");</script>';
        }
    } else {
        echo '<script>alert("Error: Plan data not found!");</script>';
    }
}

  ?>
  
<body>
<div class="wrapper">


        <div class="body-overlay"></div>
		
		<!-------------------------sidebar------------>
		     <!-- Sidebar  -->
        <!-------------------------sidebar------------>
		     <!-- Sidebar  -->
             <nav id="sidebar" >
            <div class="sidebar-header">
                <h3><img src="images/user/<?php echo $admin["pic"]; ?>" class="img-fluid"/><span> <?php echo $admin["name"]; ?> </span></h3>
            </div>
            <ul class="list-unstyled components">
			<li  class="">
                    <a href="admin_dashboard.php" class="dashboard"><i class="fa-solid fa-gauge-simple-high" style="margin-bottom: 15px; font-size: 25px;margin-left: 3px;"></i>
					<span style="margin-top: 30px; font-weight: bold; margin-left: 8px;">Dashboard</span></a>
                </li>
		

                <li  class="">
                    <a href="admin_customer.php"  class=""> 
                        <i class="fa-solid fa-users" style="margin-left: 7px; font-size: 20px;"></i>
                        <span style="margin-left: 15px; font-weight: bold; font-size: 15px;">Customers</span>
                    </a>
                </li> 
                
                <li  class="">
                    <a href="admin.php"  
					class="">
					<i class="fa-solid fa-user-tie" style="margin-left: 8px; font-size: 20px;"></i><span style="margin-left: 19px; font-weight: bold; font-size: 15px;">Admins</span></a>
                </li>    
                <div class="line_head" style="border-bottom:1px solid black;"> </div>
                <li  class="">
                  <a href="admin_operator.php"  
                    class=""><i class="fa-solid fa-business-time" style="margin-left: 7px; font-size: 20px;"></i><span style="margin-left: 15px; font-weight: bold; font-size: 15px;">Operators</span></a>
              </li> 
				
              <li  class="">
                <a href="admin_bus.php" 
                    class=""><i class="fa-solid fa-bus" style="margin-left: 7px; font-size: 20px;"></i><span style="margin-left: 15px; font-weight: bold; font-size: 15px;">Buses</span></a>
            </li> 
            	
            <li  class="">
                <a href="admin_gate.php" 
                    class=""><i class="fa-solid fa-torii-gate" style="margin-left: 7px; font-size: 20px;"></i><span style="margin-left: 15px; font-weight: bold; font-size: 15px;">Bus Gate</span></a>
            </li> 

            <li  class="">
              <a href="admin_route.php"  
                class=""><i class="fa-solid fa-route" style="margin-left: 7px; font-size: 20px;"></i><span style="margin-left: 15px; font-weight: bold; font-size: 15px;">Routes</span></a>
          </li> 
				
		  <li  class="">
            <a href="admin_plan.php" 
                 class=""><i class="fa-regular fa-clock" style="margin-left: 7px; font-size: 20px;"></i><span style="margin-left: 15px; font-weight: bold; font-size: 15px;">Plans</span></a>
              </li> 

        <li  class="">
          <a href="admin_bticket.php"
                class=""><i class="fa-solid fa-address-card" style="margin-left: 7px; font-size: 20px;"></i><span style="margin-left: 15px; font-weight: bold; font-size: 15px;">Booked Tickets</span></a>
            </li> 
      <li  class="">
          <a href="admin_checkpayment.php"
            class=""><i class="fa-solid fa-money-check-dollar" style="margin-left: 7px; font-size: 20px;"></i><span style="margin-left: 15px; font-weight: bold; font-size: 15px;">Payment(Travel)</span></a>
      </li>
      <li  class="active" >
          <a href="admin_traveldisapprove.php"
            class=""><i class="fa-solid fa-ban" style="margin-left: 7px; font-size: 20px;"></i><span style="margin-left: 15px; font-weight: bold; font-size: 15px;">Declined payment</span></a>
      </li> 
      
        <li  class="">
          <a href="admin_cost.php" 
            class=""><i class="fa-solid fa-dollar-sign" style="margin-left: 7px; font-size: 20px;"></i><span style="margin-left: 15px; font-weight: bold; font-size: 15px;">Bus Ticket Cost</span></a>
      </li>
      <div class="line_head" style="border-bottom:1px solid black;"> </div>
      <li  class="">
          <a href="admin_cargo_branch.php" 
            class=""><i class="fa-solid fa-code-branch" style="margin-left: 7px; font-size: 20px;"></i><span style="margin-left: 15px; font-weight: bold; font-size: 15px;">Cargo Branch</span></a>
      </li> 


      <li  class="">
          <a href="admin_cargo_route.php" 
        class=""><i class="fa-solid fa-road" style="margin-left: 7px; font-size: 20px;"></i><span style="margin-left: 15px; font-weight: bold; font-size: 15px;">Cargo Route</span></a>
      </li> 

      <li  class="">
          <a href="admin_cargo_plan.php"
            class=""><i class="fa-solid fa-clock" style="margin-left: 7px; font-size: 20px;"></i><span style="margin-left: 15px; font-weight: bold; font-size: 15px;">Cargo Plan</span></a>
      </li> 
      <li  class="">
          <a href="admin_cargo_truck.php"
        class=""><i class="fa-solid fa-truck" style="margin-left: 7px; font-size: 20px;"></i><span style="margin-left: 15px; font-weight: bold; font-size: 15px;">Cargo Truck</span></a>
      </li>
      <li  class="">
          <a href="admin_cargo_ticket.php"
            class=""><i class="fa-solid fa-address-card" style="margin-left: 7px; font-size: 20px;"></i><span style="margin-left: 15px; font-weight: bold; font-size: 15px;">Cargo Service</span></a>
      </li>
      <li  class="">
          <a href="admin_cargo_checkpayment.php"
        class=""><i class="fa-solid fa-money-check-dollar" style="margin-left: 7px; font-size: 20px;"></i><span style="margin-left: 15px; font-weight: bold; font-size: 15px;">Payment(Cargo)</span></a>
      </li>
      <li  class="">
          <a href="admin_cargodisapprove.php"
            class=""><i class="fa-solid fa-ban" style="margin-left: 7px; font-size: 20px;"></i><span style="margin-left: 15px; font-weight: bold; font-size: 15px;">Declined Payment</span></a>
      </li>
      
      

      <div class="line_head" style="border-bottom:1px solid black;"> </div>
      <li  class="">
          <a href="admin_feedback.php" 
            class=""><i class="fa-solid fa-comments" style="margin-left: 7px; font-size: 20px;"></i><span style="margin-left: 15px; font-weight: bold; font-size: 15px;">View Feedback</span></a>
      </li> 

      <li  class="">
          <a href="admin_logout.php" 
            class=""><i class="fa-solid fa-right-from-bracket" style="margin-left: 7px; font-size: 20px;"></i><span style="margin-left: 15px; font-weight: bold; font-size: 15px;">Log out</span></a>
      </li> 
               
            </ul>

</nav>
        <div id="content">
		   
		   <!--top--navbar----design--------->
		   
		   <div class="top-navbar">
		      <div class="xp-topbar">

                <!-- Start XP Row -->
                <div class="row"> 
                    <!-- Start XP Col -->
                    <div class="col-3 col-md-1 col-lg-1 order-2 order-md-1 align-self-center">
                       <div class="nav_wrapper d-flex flex-row justify-content-start">
                          <div class="xp-menubar">
                                <span class="material-icons text-white">signal_cellular_alt</span>
                          </div>
                          <!--<div class="img_logo d-flex flex-row justify-content-center">
                            <img src='images/logo1.png' height="40px" width="60px" alt="Logo">
                            <p class="text-white d-flex flex-row" style="text-align:center; font-size:15px; font-weight:bold;">Swift Shift Admin Pannel</p>
                          </div>  -->
                        </div>

                         
                    </div> 
                    <!-- End XP Col -->
                </div>
              </div>
           </div>
            
    <div class="main-content">

		<div class="row">
          
          <div class="table-title" style="background-color:#7895CB;">
                    <div class="row" style="background-color:#7895CB; height:20px; width:100%; margin:0;" >
                      
                      <div class="col-sm-6 p-0 d-flex justify-content-lg-start justify-content-center">
                        
                      </div>
            
                    </div>
          </div>
          <!--line-->
          <div class="col-md-12">
            <div class="table-title" style="background-color:#7895CB;">
                    <div class="row" style="background-color:#7895CB; height:20px; width:100%; margin:0;" >
                      
                      <div class="col-sm-6 p-0 d-flex justify-content-lg-start justify-content-center">
                        
                      </div>
            
                    </div>
          </div>
           <div class="bottom_work" style="background-color:#E7EEF4;">
                  <div class="header_part d-flex flex-row justify-content-between" style="border-bottom:2px solid black; padding:20px">
                    <h5>View Declined Ticket Information</h5>
                    <form method="post" action="admin_traveldisapprove.php">
                        <!-- <button type="submit" name="addbtn" class="add_btn d-flex flex-row">
                          <i class="fa-solid fa-plus" style="color: #ffffff; margin-top:5px;"></i> Add New
                        </button> -->
                    </form>  
                  </div>
                  <div class="search_part" style="margin:20px; float:right;">
                      <form method="post" action="admin_traveldisapprove.php">
                        <input type="text" placeholder="Search.." name="search">
                        <button type="submit" name="search_bt" class="search"><i class="fa fa-search"></i></button>
                      </form>
                  </div>

                <div class="table-wrapper" style="background-color:#E7EEF4;">
                <div class="whole" style="background-color:#E7EEF4;">
                <div class="display-info" id="table_part">
                        <?php
                            if (isset($_POST['addbtn']) || isset($_POST['search_bt']) || (isset($_POST['view_more'])) )  {
                                if(isset($_POST['addbtn']))
                                {    
                                    add_form();
                                }
                                
                                
                                else if(isset($_POST['search_bt']))
                                {
                                  $search = $_POST['search'];
                                  $sql = "SELECT * FROM btickets WHERE pid LIKE '%$search%' OR seatno LIKE '$search%' OR bpname LIKE '%$search%' OR bdate LIKE '%$search%' OR btime LIKE '%$search%' OR numberofseats LIKE '%$search%'";
                                  $result = $dbconnection->query($sql);
                                   search_show();
                                }
                                else if (isset($_POST['view_more']))
                                {
                                  detail();
                                }
                                
                              } 
                              else if( (!isset($_POST['add_btn'])) ) {
                                display_table();
                              }  
                              
                            
if (isset($_POST["add_btn"])) {
    // Get form input values
    $source = $_POST['source'];
    $destination = $_POST['destination'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    //$ntime= strtotime($time);
    //$time= date('H:i:s', $ntime);
    $seatno = $_POST['seatno'];
    $seat_no = explode(',', $seatno);
    $bpname=$_POST['cname'];
    //$cid=$_POST['cid'];
    $bpphone=$_POST['cphone'];
    $noseats=$_POST['noseats'];
    $special=$_POST['special'];
    $timestamp = time(); // Get the current Unix timestamp
    $timeFormatted = date('H:i:s', $timestamp);
    $datestamp = date('Y-m-d');
    // Other form inputs...
    if ($source === $destination) {
        show_add_again($source,$destination,$date,$time,$seatno,$bpname,$bpphone,$noseats,$special);
        echo "<script>alert('Source and destination cannot be the same. Please select different locations.');</script>";
    }else{
    
    $source_query = $dbconnection->prepare("SELECT cgid FROM cargate WHERE town = ?");
    $source_query->bind_param("s", $source);
    $source_query->execute();
    $source_result = $source_query->get_result();
    $source_row = $source_result->fetch_assoc();
    $source_cgid = $source_row['cgid'];

    $dest_query = $dbconnection->prepare("SELECT cgid FROM cargate WHERE town = ?");
    $dest_query->bind_param("s", $destination);
    $dest_query->execute();
    $dest_result = $dest_query->get_result();
    $dest_row = $dest_result->fetch_assoc();
    $dest_cgid = $dest_row['cgid'];

    // Fetch rid from routes table
    $route_query = $dbconnection->prepare("SELECT rid FROM route WHERE source = ? AND destination = ?");
    $route_query->bind_param("ii", $source_cgid, $dest_cgid);
    $route_query->execute();
    $route_result = $route_query->get_result();
    if ($route_result->num_rows > 0) {
    $route_row = $route_result->fetch_assoc();
    $rid = $route_row['rid'];
    }
    else {
       
        echo "<script>alert('rid is null');</script>";
        show_add_again($source,$destination,$date,$time,$seatno,$bpname,$bpphone,$noseats,$special);
            exit;
    }
    
    $plan_query = $dbconnection->prepare("SELECT pid, ddate, dtime FROM plan WHERE rid = ?");
$plan_query->bind_param("i", $rid);
$plan_query->execute();
$plan_result = $plan_query->get_result();

if ($plan_result->num_rows > 0) {
    $plan_row = $plan_result->fetch_assoc();
    $pid = $plan_row['pid'];
    $ddate = $plan_row['ddate'];
    $dtime = $plan_row['dtime'];
} else {
    
    echo "<script>alert('pid is null');</script>";
    show_add_again($source,$destination,$date,$time,$seatno,$bpname,$bpphone,$noseats,$special);
        exit;
}

    if ($ddate != $date || $dtime != $time) {
        
        echo "<script>alert('Selected date or time does not match the available schedule.');</script>";
        show_add_again($source,$destination,$date,$time,$seatno,$bpname,$bpphone,$noseats,$special);
        exit;
    }

    $seatno_query = $dbconnection->prepare("SELECT COUNT(*) AS count FROM btickets WHERE seatno = ?");
    $seatno_query->bind_param("s", $seatno);
    $seatno_query->execute();
    $seatno_result = $seatno_query->get_result();
    $seatno_row = $seatno_result->fetch_assoc();
    $seatno_count = $seatno_row['count'];
    if ($seatno_count > 0) {
        show_add_again($source,$destination,$date,$time,$seatno,$bpname,$bpphone,$noseats,$special);
        echo "<script>alert('Seat number $seatno is already booked. Please choose another seat.');</script>";
    }

   else {
        // Fetch oid from the operator table using the busno
        $plan_query = $dbconnection->prepare("SELECT rid, busno FROM plan WHERE pid = ?");
        $plan_query->bind_param("i", $pid);
        $plan_query->execute();
        $plan_result = $plan_query->get_result();
        $plan_row = $plan_result->fetch_assoc();
        $rid = $plan_row['rid'];
        $busno = $plan_row['busno'];
    
        // Prepare and execute the SQL query to retrieve oid from the operator table
        $operator_query = $dbconnection->prepare("SELECT oid FROM bus WHERE busno = ?");
        $operator_query->bind_param("s", $busno);
        $operator_query->execute();
        $operator_result = $operator_query->get_result();
        $operator_row = $operator_result->fetch_assoc();
        $oid = $operator_row['oid'];
    
        // Prepare and execute the SQL query to retrieve cost from the cost table
        $cost_query = $dbconnection->prepare("SELECT cost FROM cost WHERE oid = ? AND rid = ?");
        $cost_query->bind_param("ii", $oid, $rid);
        $cost_query->execute();
        $cost_result = $cost_query->get_result();
        $cost_row = $cost_result->fetch_assoc();
        $cost = $cost_row['cost'];

        $sql1 = "INSERT INTO btickets VALUES (:btid, :numberofseats, :pid, :seatno, :cid, :bpname, :bpphone, :bdate, :btime, :bcost, :paymethod, :special)";

try {
    $st = $conn->prepare($sql1);

    for ($i = 0; $i < $noseats; $i++) {
        $btid = date("YmdHis") . $i; // Concatenate using PHP

        $st->bindValue(":btid", $btid, PDO::PARAM_STR);
        $st->bindValue(":numberofseats", $noseats, PDO::PARAM_INT);
        $st->bindValue(":pid", $pid, PDO::PARAM_INT);
        $st->bindValue(":seatno", $seat_no[$i], PDO::PARAM_INT);
        $st->bindValue(":cid", 1, PDO::PARAM_INT);
        $st->bindValue(":bpname", $bpname, PDO::PARAM_STR);
        $st->bindValue(":bpphone", $bpphone, PDO::PARAM_STR);
        $st->bindValue(":bdate", date("Y-m-d"), PDO::PARAM_STR);
        $st->bindValue(":btime", date("H:i:s"), PDO::PARAM_STR);
        $st->bindValue(":bcost", $cost*$noseats, PDO::PARAM_STR);
        $st->bindValue(":paymethod", null, PDO::PARAM_STR);
        $st->bindValue(":special", $special, PDO::PARAM_STR);

        $st->execute();
    }

    $conn = null; // Close the connection
} catch (PDOException $e) {
    $conn = null; // Close the connection
    die("Query failed: " . $e->getMessage());
}
        
    //     foreach ($seat_no as $seat) {
    //         // Check if the seat number already exists in btickets table
    //         $check_query = $dbconnection->prepare("SELECT COUNT(*) AS count FROM btickets WHERE seatno = ?");
    //         $check_query->bind_param("s", $seat);
    //         $check_query->execute();
    //         $check_result = $check_query->get_result();
    //         $check_row = $check_result->fetch_assoc();
    //         $seat_exists = $check_row['count'];
        
    //         if ($seat_exists == 0) {
    //             // Insert the new ticket into btickets table
    //             $insert_query = $dbconnection->prepare("INSERT INTO btickets (pid, seatno, numberofseats, bdate, btime, bpname, bpphone, bcost, special) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    //             // Bind parameters
    //             // $bpname=$_POST['cname'];
    //             // $bpid=$_POST['cid'];
    //             // $bpphone=$_POST['cphone'];
    //             // $noseats=$_POST['noseats'];
    //             // $special=$_POST['special'];
    //             $insert_query->bind_param("iiissssis", $pid, $seat, $noseats, $datestamp, $timeFormatted, $bpname, $bpphone, $cost, $special);
    //             // Execute the query
                
    //             $insert_query->execute();
    //             display_table();
    //             // Check if the query was successful
    //             if ($insert_query->affected_rows > 0) {
    //                 echo "<script>alert('Ticket for seat number $seat added successfully.');</script>";
    //             } else {
    //                 echo "<script>alert('Failed to add ticket for seat number $seat.');</script>";
    //             }
           
    //     }
    // }
            
    }
}
}
?>
             <?php
function display_table()
{
?>
    <table class="table" cellspacing="5px" border="0" id="table_part">
        <thead>
            <tr>
                <!--<th><input type="checkbox" name="hchc[]" class="check_box"></th>-->
                <th>Plan ID</th>
                <th>Seat No</th>
                <th>Customer ID</th>
                <th>Numbers of seat </th>
                <th>Bought Date</th>
                <th>Bought Time</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php

            $records_per_page = 5;
            $current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
            $start = ($current_page - 1) * $records_per_page;
            $total_rows = 0;

            include 'connect.php';
            $sql = "SELECT COUNT(*) as total FROM btickets";
            $result = $dbconnection->query($sql);
            $row = $result->fetch_assoc();
            $total_rows = $row['total'];
            $total_pages = ceil($total_rows / $records_per_page);

            $sql = "SELECT pid, bpname, numberofseats, cid, GROUP_CONCAT(seatno) AS seat_no, bdate, btime
                    FROM btickets
                    WHERE status = 'disapprove'
                    GROUP BY bpname, bdate, btime
                    LIMIT $start, $records_per_page";
            $result = $dbconnection->query($sql);

            if ($result->num_rows > 0) {
              
                while ($row = $result->fetch_assoc()) {
                    $bpname = $row["bpname"];
                    $seatno = $row["seat_no"];
                    $cid = $row["cid"];
                    $numbers_of_seats = $row["numberofseats"];
                    $bdate = $row["bdate"];
                    $btime = $row["btime"];
                    $pid= $row["pid"];
?>
           
                    <tr class="first_row">
                      
                        <td><?php echo $pid; ?></td>
                        <td><?php echo $seatno; ?></td>
                        <td><?php echo $cid; ?></td>
                        <td><?php echo $numbers_of_seats; ?></td>
                        <td><?php echo $bdate; ?></td>
                        <td><?php echo $btime; ?></td>
                        <td class="d-flex flex-row justify-content-center">
                            <form action="admin_traveldisapprove.php" method="post" class="d-flex flex-row justify-content-evenly">
                                <input type="hidden" value="<?php echo $pid; ?>" name="action_id">
                                <input type="hidden" value="<?php echo $btime; ?>" name="action_id1">
                                <input type="hidden" value="<?php echo $bdate; ?>" name="action_id2">
                                <button type="submit" class="action_btn" name="view_more"><i class="fa-solid fa-eye"></i></button>

                                <button type="submit" class="action_btn" name="delete" onclick="return Dconfirm()"> <i class="fa-solid fa-trash"></i> </button>
                            </form>
                        </td>

                    </tr>

            <?php }
            } else {
                echo "No data found";
            }

            ?>
            </tbody>
                          </table>
                          
                            <!-- Navigation links -->
                            <div class="d-flex justify-content-end" style="color:black; margin:30px 5px 30px 0px;">
                                <ul class="pagination">
                                    <?php if ($current_page > 1) : ?>
                                    <li class="page-item">
                                        <a class="page-link" href="?page=<?php echo $current_page - 1; ?>#table_part" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                        <span>Previous</span>
                                        </a>
                                    </li>
                                    <?php endif; ?>
    
                                    <?php for ($i = 1; $i <= $total_pages; $i++) : ?>
                                    <li class="page-item <?php if ($i == $current_page) { echo 'active'; } ?>">
                                        <a class="page-link" href="?page=<?php echo $i; ?>#table_part"><?php echo $i; ?></a>
                                    </li>
                                    <?php endfor; ?>
    
                                    <?php if ($current_page < $total_pages) : ?>
                                    <li class="page-item">
                                        <a class="page-link" href="?page=<?php echo $current_page + 1; ?>#table_part" aria-label="Next">
                                        <span>Next</span>
                                        <span aria-hidden="true">&raquo;</span>
                                        </a>
                                    </li>
                                    <?php endif; ?>
                                    </ul>
                                    </div>
                                    
                                </ul>
                            </div>
                      <?php } ?>
                      <?php function search_show() {  ?>
                           <table class="table" cellspacing="5px" border="0"  id="table_part">
                           <thead>
                           <tr>
                           <!--<th><input type="checkbox" name="hchc[]" class="check_box"></th>-->
                           <th>Plan ID</th>
                            <th>Seat No</th>
                            <th>Customer ID</th>
                            <th>Numbers of seat </th>
                            <th>Bought Date</th>
                            <th>Bought Time</th>
                            <th>Action</th>
                           </tr>
                           </thead>
                           <tbody>
                            <?php  include 'connect.php';
                               $search = $_POST['search'];
                               $sql = "SELECT pid,btid, bpname, numberofseats, cid, GROUP_CONCAT(seatno) AS seat_no, bdate, btime
        FROM btickets
        WHERE status = 'disapprove' and (cid LIKE '%$search%' OR seatno LIKE '%$search%' OR bpname LIKE '%$search%' OR bdate LIKE '%$search%')
        GROUP BY bpname, bdate, btime";

                               $result = $dbconnection->query($sql);
                               if ($result->num_rows > 0) {
                                // Fetch data from each row
                                while ($row = $result->fetch_assoc()) {
                                    $pid = $row["pid"];
                                    $seatno = $row["seat_no"];
                                    $cid=$row["cid"];
                                    $noseat=$row["numberofseats"];
                                    $bdate=$row["bdate"];
                                    $btime=$row["btime"];
                                    $btid=$row["btid"];
                        ?>
                        <tr class="first_row" >
                                        
                                          <td><?php  echo $pid; ?></td>
                                          <td><?php  echo $seatno; ?></td>
                                          <td><?php  echo $cid; ?></td>
                                          <td><?php  echo $noseat; ?></td>
                                          <td><?php  echo $bdate; ?></td>
                                          <td><?php  echo $btime; ?></td>
                                  
                                          <td class="d-flex flex-row justify-content-center"> 
                                              <form action="admin_traveldisapprove.php" method="post" class="d-flex flex-row justify-content-evenly">
                                              <input type="hidden" value="<?php echo $pid; ?>" name="action_id">
                                              <button type="submit" class="action_btn" name="view_more"><i class="fa-solid fa-eye"></i></button>
                                              
                                              <button type="submit" class="action_btn" name="delete" onclick="return Dconfirm()"> <i class="fa-solid fa-trash"></i> </button> 
                                              </form>
                                          </td>
                                  
                                  </tr>
                              
                                  <?php  }
                                
                              } else {
                                    echo "No data found";
                              }
                        
                            
                          
                         ?>
                         </tbody>
                          </table>
                          <form method="post" action="admin_traveldisapprove.php" >
                            <button type="submit" style="margin: 10px 0px 30px 30px; background-color:#7895CB; border:none;" name="search_back" > <<< Back </button>
                          </form>
                          <?php 
                          }

                          if (isset($_POST['search_back'])){
                             echo '<script> window.location("admin_traveldisapprove.php")';
                          } 
                        ?>
                          <?php function detail(){?>
                          <table class="table" cellspacing="5px" border="0"  id="table_part">
                            <thead>
                            <tr>
                            <!--<th><input type="checkbox" name="hchc[]" class="check_box"></th>-->
                            
                              <th>Customer Name</th>
                              <th>Customer Phone</th>                            
                              
                              <th>Seat No</th>
                              <th>Cost</th>
                              <th>Special resquest</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php
                                
                               include 'connect.php';
                                
                                  $btime = $_POST['action_id1'];
                                  $bdate = $_POST['action_id2'];


                              
                                  $sql = "SELECT bpname, bpphone, GROUP_CONCAT(seatno) AS seatnos,bcost, special
                    FROM btickets
                    WHERE bdate = '$bdate' AND btime = '$btime'
                    GROUP BY bpname, bdate, btime";
                                  $result = $dbconnection->query($sql); 
                                  $firstRow = true;
                                        if ($result->num_rows > 0){
                                        while ($row = $result->fetch_assoc()) {
                                            $bpname= $row["bpname"];
                                            $bpphone= $row["bpphone"];
                                            $seatno=$row["seatnos"];
                                            $bcost=$row["bcost"];
                                            $special=$row["special"];
                                            ?>
                                            <tr class="first_row" >
                                            <td><?php  echo $bpname; ?></td>
                                            <td><?php  echo $bpphone; ?></td>
                                            <td><?php  echo $seatno; ?></td>
                                            <td><?php  echo $bcost; ?></td>
                                            <td><?php  echo $special; ?></td>
                                            
                                            
                                            
                                    
                                    </tr>
                                
                                    <?php  }
                                  
                                } else {
                                      echo "No data found";
                                }
                          
                              
                            
                           ?>
                           </tbody>
                            </table>
                            <form method="post" action="admin_traveldisapprove.php" >
                              <button type="submit" style="margin: 10px 0px 30px 30px; background-color:#7895CB; border:none;" name="search_back" > <<< Back </button>
                            </form>
                            <?php 
                            } ?>   
                     
                     
                     <?php
                     
                     function add_form() {
                         include 'connect.php'; // Include database connection
                     
                        
                         $town_query = $dbconnection->query("SELECT DISTINCT town FROM cargate ORDER BY town ASC");
                         $towns = array();
                         while ($row = $town_query->fetch_assoc()) {
                             $towns[] = $row['town'];
                         }
                     ?>
                       
                         <div class="add-on" id="add_info_show">
                             <h5>Add Bus Ticket Information</h5>
                             <form method="post" action="admin_traveldisapprove.php" enctype="multipart/form-data">
                                 <table cellspacing="10px" border="0" class="add_table">
                                     <tr>
                                         <td>Source:</td>
                                         <td>
                                             <select name="source" required>
                                                 <option value="">Select Source</option>
                                                 <?php foreach ($towns as $town) { ?>
                                                     <option value="<?php echo $town; ?>"><?php echo $town; ?></option>
                                                 <?php } ?>
                                             </select>
                                         </td>
                                     </tr>
                                     <tr>
                                         <td>Destination:</td>
                                         <td>
                                             <select name="destination" required>
                                                 <option value="">Select Destination</option>
                                                 <?php foreach ($towns as $town) { ?>
                                                     <option value="<?php echo $town; ?>"><?php echo $town; ?></option>
                                                 <?php } ?>
                                             </select>
                                         </td>
                                     </tr>
                                     <tr>
                                         <td>Date:</td>
                                         <td><input type="date" name="date"  required></td>
                                     </tr>
                                     <tr>
                                         <td>Time:</td>
                                         <td><input type="text" name="time" placeholder="00:00:00" required></td>
                                     </tr>
                                     <tr>
                                         <td>SeatNo:</td>
                                         <td><input type="text" name="seatno" value=""></td>
                                     </tr>
                                     <tr>
                                         <td>Customer ID:</td>
                                         <td><input type="text" name="cid" value="" required></td>
                                     </tr>
                                     <tr>
                                         <td>Customer name:</td>
                                         <td><input type="text" name="cname" value="" required></td>
                                     </tr>
                                     <tr>
                                         <td>Customer phone:</td>
                                         <td><input type="text" name="cphone" value="" required></td>
                                     </tr>
                                     <tr>
                                         <td>Number of seats:</td>
                                         <td><input type="text" name="noseats" value="" required></td>
                                     </tr>
                                     <tr>
                                         <td>Special:</td>
                                         <td><input type="text" name="special" value=""></td>
                                     </tr>
                                     <tr>
                                         <td></td>
                                         <td></td>
                                     </tr>
                                 </table>
                                 <a href="admin_traveldisapprove.php" style="text-decoration:none;"><button type="button" class="back-btn" name="search_back"> <<< Back </button><a>
                                 <button type="submit" name="add_btn" value="Add" class="btn_add" style="margin-bottom:40px;"> Add </button>
                             </form>
                         </div>
                     <?php
                     }
                     ?>
                     

                        <?php function show_add_again($source,$destination,$date,$time,$seatno,$bpname,$bpphone,$noseats,$special)
                          { 
                            include 'connect.php'; 
                     
                         
                         $town_query = $dbconnection->query("SELECT DISTINCT town FROM cargate ORDER BY town ASC");
                         $towns = array();
                         while ($row = $town_query->fetch_assoc()) {
                             $towns[] = $row['town'];
                         }?>
                        <!-- add info from -->
                            <!-- add info form -->
                         <div class="add-on" id="add_info_show">
                             <h5>Add Bus Ticket Information</h5>
                             <form method="post" action="admin_traveldisapprove.php" enctype="multipart/form-data">
                                 <table cellspacing="10px" border="0" class="add_table">
                                     <tr>
                                         <td>Source:</td>
                                         <td>
                                             <select name="source" required>
                                                 <option value="">Select Source</option>
                                                 <?php foreach ($towns as $town) { ?>
                                                     <option value="<?php echo $town; ?>"<?php if ($town == $source) { echo 'selected'; } ?>><?php echo $town; ?></option>
                                                 <?php } ?>
                                             </select>
                                         </td>
                                     </tr>
                                     <tr>
                                         <td>Destination:</td>
                                         <td>
                                             <select name="destination" required>
                                                 <option value="">Select Destination</option>
                                                 <?php foreach ($towns as $town) { ?>
                                                     <option value="<?php echo $town; ?>"<?php if ($town == $destination) { echo 'selected'; } ?>><?php echo $town; ?></option>
                                                 <?php } ?>
                                             </select>
                                         </td>
                                     </tr>
                                     <tr>
                                         <td>Date:</td>
                                         <td><input type="date" name="date" value="<?php echo $date; ?>" required></td>
                                     </tr>
                                     <tr>
                                         <td>Time:</td>
                                         <td><input type="text" name="time"value="<?php echo $time; ?>" placeholder="00:00:00" required></td>
                                     </tr>
                                     <tr>
                                         <td>SeatNo:</td>
                                         <td><input type="text" name="seatno" value="<?php echo $seatno; ?>"></td>
                                     </tr>
                                     <tr>
                                         <td>Customer ID:</td>
                                         <td><input type="text" name="cid" value="" required></td>
                                     </tr>
                                     <tr>
                                         <td>Customer name:</td>
                                         <td><input type="text" name="cname" value="<?php echo $bpname; ?>" required></td>
                                     </tr>
                                     <tr>
                                         <td>Customer phone:</td>
                                         <td><input type="text" name="cphone" value="<?php echo $bpphone; ?>" required></td>
                                     </tr>
                                     <tr>
                                         <td>Number of seats:</td>
                                         <td><input type="text" name="noseats" value="<?php echo $noseats; ?>" required></td>
                                     </tr>
                                     <tr>
                                         <td>Special:</td>
                                         <td><input type="text" name="special" value="<?php echo $special; ?>"></td>
                                     </tr>
                                     <tr>
                                         <td></td>
                                         <td></td>
                                     </tr>
                                 </table>
                                 <a href="admin_traveldisapprove.php" style="text-decoration:none;"><button type="button" class="back-btn" name="search_back"> <<< Back </button><a>
                                 <button type="submit" name="add_btn" value="Add" class="btn_add" style="margin-bottom:40px;"> Add </button>
                             </form>
                         </div>
                     <?php
                     }
                     ?>


                        
                    </div>
                </div>
                        

                </div>
            </div>


			
			 
        </div>
    </div>


</div>




<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
   <script src="js/jquery-3.3.1.slim.min.js"></script>
   <script src="js/popper.min.js"></script>
   <script src="js/bootstrap.min.js"></script>
   <script src="js/jquery-3.3.1.min.js"></script>
  
  
  <script type="text/javascript">
        
		$(document).ready(function(){
		  $(".xp-menubar").on('click',function(){
		    $('#sidebar').toggleClass('active');
			$('#content').toggleClass('active');
		  });
		  
		   $(".xp-menubar,.body-overlay").on('click',function(){
		     $('#sidebar,.body-overlay').toggleClass('show-nav');
		   });
		  
		});
		
</script>
  
  



  </body>
  <?php


function getNextOperatorId() {
    global $conn; 

    try {
        
        $sql2 = "SELECT MAX(oid) AS max_oid FROM operator";
        $stmt2 = $conn->prepare($sql2);
        $stmt2->execute();
        
        
        $result2 = $stmt2->fetch(PDO::FETCH_ASSOC);

       
        if ($result2['max_oid'] === null) {
            return 1;
        } else {
            
            return $result2['max_oid'] + 1;
        }
    } catch (PDOException $e) {
        
        echo "Error: " . $e->getMessage();
        return null;
    }
}
?>  
<script>
  function Dconfirm()
    {
      var sure = confirm("Are you sure to delete?");
            if(sure)
            {
                return true;
            }
            else
            {
                return false;
            } 
    }
  
</script> 
 
  </html>


