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
    $gid = $_POST["action_id"];
    $cpdate= $_POST["action_id3"];

    // Get current date and time
    $current_datetime = date("Y-m-d");


        if ($current_datetime > $cpdate) {
   
            echo '<script>alert("Are you sure you want to delete?");</script>';

           
            $dquery = $dbconnection->prepare("DELETE FROM get_cargo_service WHERE gid = ?");
            $dquery->bind_param("s", $gid);
            $dquery->execute();
            echo '<script>alert("Record deleted successfully!");</script>';
        } else {
            echo '<script>alert("Cannot delete! Current time is not late.");</script>';
        }
    } 
if (isset($_POST["dok"])){
  echo "<script> alert('done');</script>";
  $text=$_POST["dmessage"];
  $one=$_POST["one"];
 
  //echo "<script> alert('$text');</script>";
  
        $sql_update = "UPDATE get_cargo_service SET status = 'disapproved', message='$text' WHERE gid = '$one'";
        $result_update = $dbconnection->query($sql_update);

} 
// if (isset($_POST['approve']) ) {
    
//   include 'connect.php';
  

//   $pid = $_POST['action_id'];
//   $time =$_POST['action_id1'];
//   $date =$_POST['action_id2'];
// //   $time_timestamp = strtotime($btime);
// //   $btime = date('H:i:s', $time_timestamp);
// // $bdate = date('d-m-Y', strtotime($bdate));
  
 
//   $sql_update = "UPDATE btickets SET status = 'approved' WHERE pid = $pid and bdate='$date' and btime = '$time'";
//   $result_update = $dbconnection->query($sql_update);
  
 
//   if ($result_update) {

   
//       echo "Status updated successfully.";
//       // display_table();
      
//   } else {
//       echo "Error updating status: " . $dbconnection->error;
//   }
// }

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
      <li  class="" >
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
      <li  class="active">
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
                    <h5>Manage Cargo Payment Information</h5>
                    <form method="post" action="admin_cargo_checkpayment.php">
                        <!-- <button type="submit" name="addbtn" class="add_btn d-flex flex-row">
                          <i class="fa-solid fa-plus" style="color: #ffffff; margin-top:5px;"></i> Add New
                        </button> -->
                    </form>  
                  </div>
                  <div class="search_part" style="margin:20px; float:right;">
                      <form method="post" action="admin_cargo_checkpayment.php">
                        <input type="text" placeholder="Search.." name="search">
                        <button type="submit" name="search_bt" class="search"><i class="fa fa-search"></i></button>
                      </form>
                  </div>

                <div class="table-wrapper" style="background-color:#E7EEF4;">
                <div class="whole" style="background-color:#E7EEF4;">
                <div class="display-info" id="table_part">
                        <?php
                            if ( isset($_POST['search_bt']) || (isset($_POST['view_more'])) || (isset($_POST['approve'])) || (isset($_POST['screenshot'])) || (isset($_POST['disapprove'])) )  {
                                // if(isset($_POST['addbtn']))
                                // {    
                                //     add_form();
                                // }
                                if (isset($_POST['approve']) ) {
    
                                    include 'connect.php';
                                    
                                  
                                    $gid = $_POST['action_id'];
                                    
                                    
                                   
                                    $sql_update = "UPDATE get_cargo_service SET status = 'approved' WHERE gid = '$gid' ";
                                    $result_update = $dbconnection->query($sql_update);
                                    
                                   
                                    if ($result_update) {
                                  
                                     
                                        
                                        display_table();
                                        
                                    } else {
                                        echo "Error updating status: " . $dbconnection->error;
                                    }
                                  }
                                  else if (isset($_POST["disapprove"])) {
                                  
                                  
                                    $gid = $_POST['action_id'];
                                    
                                    show_message_part($gid);
                                    
                                   
                                    
                                }
                                  else if(isset($_POST['screenshot']))
                                {
                                  $photo = $_POST['action_id4'];
                                  echo"hello";
                                  ?>
                                  <img src='./uploads/ <?php echo $photo?> '>
                                  <?php
                                  
                        

                                }
                                
                                
                                else if(isset($_POST['search_bt']))
                                {
                                  $search = $_POST['search'];
                                  $sql = "SELECT * FROM get_cargo_service WHERE crid LIKE '%$search%' OR cid LIKE '%$search%' OR sname LIKE '%$search%' OR gdate LIKE '%$search%' OR gtime LIKE '%$search%' OR totalcost LIKE '%$search%' OR categories LIKE '%$search%' OR rname LIKE '%$search%'";
                                  $result = $dbconnection->query($sql);
                                   search_show();
                                }
                                else if (isset($_POST['view_more']))
                                {
                                  detail();
                                }
//                                 else if (isset($_POST['approve']) ) {
    
//                                   include 'connect.php';
                                  
                                
//                                   $pid = $_POST['action_id'];
//                                   $time =$_POST['action_id1'];
//                                   $date =$_POST['action_id2'];
//                                 //   $time_timestamp = strtotime($btime);
//                                 //   $btime = date('H:i:s', $time_timestamp);
//                                 // $bdate = date('d-m-Y', strtotime($bdate));
                                  
                                 
//                                   $sql_update = "UPDATE btickets SET status = 'approved' WHERE pid = $pid and bdate=$date and btime = $time";
//                                   $result_update = $dbconnection->query($sql_update);
                                  
                                 
//                                   if ($result_update) {
                                
                                   
//                                       echo "Status updated successfully.";
//                                       // display_table();
                                      
//                                   } else {
//                                       echo "Error updating status: " . $dbconnection->error;
//                                   }
                               }
                                
                                
                              
                              else if( (!isset($_POST['add_btn']))  ) {
                                display_table();
                            }  
                            
                            

// ?>

<!-- // if (isset($_POST['approve']) ) {
    
//   include 'connect.php';
  

//   $pid = $_POST['action_id'];
//   $time =$_POST['action_id1'];
//   $date =$_POST['action_id2'];
// //   $time_timestamp = strtotime($btime);
// //   $btime = date('H:i:s', $time_timestamp);
// // $bdate = date('d-m-Y', strtotime($bdate));
  
 
//   $sql_update = "UPDATE btickets SET status = 'approved' WHERE pid = $pid and bdate=$date and btime = $time";
//   $result_update = $dbconnection->query($sql_update);
  
 
//   if ($result_update) {

   
//       echo "Status updated successfully.";
//       display_table();
      
//   } else {
//       echo "Error updating status: " . $dbconnection->error;
//   }
// } -->


             <?php
function display_table()
{
?>
    <table class="table" cellspacing="5px" border="0" id="table_part">
        <thead>
            <tr>
                <!--<th><input type="checkbox" name="hchc[]" class="check_box"></th>-->
                <th>Plan ID</th>
                <th>Customer ID</th>
                
                <th>Categories </th>
                <th>Cost</th>
                <th>Status</th>
                <th>screenshot</th>
                <th>Check</th>
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
            $sql = "SELECT COUNT(*) as total FROM get_cargo_service";
            $result = $dbconnection->query($sql);
            $row = $result->fetch_assoc();
            $total_rows = $row['total'];
            $total_pages = ceil($total_rows / $records_per_page);

            $sql = "SELECT crid, cid, categories,screenshot,status, gdate,gtime,gid,cpdate, totalcost,sname,stele,rname,rtele,note
            FROM get_cargo_service
            WHERE status = 'Pending'
            
            LIMIT $start, $records_per_page";
            $result = $dbconnection->query($sql);

            if ($result->num_rows > 0) {
              
                while ($row = $result->fetch_assoc()) {
                    $crid = $row["crid"];
                    $cid = $row["cid"];
                    $categories = $row["categories"];
                    $gdate = $row["gdate"];
                    $gtime = $row["gtime"];
                    $tcost= $row["totalcost"];
                    $sname=$row["sname"];
                    $stele=$row["stele"];
                    $rname=$row["rname"];
                    $rtele=$row["rtele"];
                    $note=$row["note"];
                    $gid=$row["gid"];
                    $cpdate=$row["cpdate"];
                    $status=$row["status"];
                    $photo=$row["screenshot"];
                    ?>
           
                    <tr class="first_row">
                      
                        <td><?php echo $crid; ?></td>
                        <td><?php echo $cid; ?></td>
                    
                        <td><?php echo $categories; ?></td>

                        <td><?php echo $tcost; ?></td>
                        <td><?php echo $status; ?></td>
                        <td>
                        
                      
                        <button type="button" name="screenshot" onclick="showLargeImage('<?php echo $photo ?>')" style="border:none; background:none;">
    <img src='./uploads/<?php echo $photo ?>' height="60px" width="40px">
</button>

<script>
    function showLargeImage(photo) {
        var imageUrl = './uploads/' + photo;
        window.open(imageUrl, '_blank');
    }
</script>

<!-- Modal -->
<!-- <div id="screenshotModal" class="modal">
    <span class="close" onclick="closeModal()">&times;</span>
    <img class="modal-content" id="modalScreenshot">
</div> -->
                        
                      </td>
                        <td>
                        <form action="admin_cargo_checkpayment.php" method="post">
                        <input type="hidden" value="<?php echo $gid; ?>" name="action_id">
                        <input type="hidden" value="<?php echo $gtime; ?>" name="action_id1">
                        <input type="hidden" value="<?php echo $gdate; ?>" name="action_id2">
                        <input type="hidden" value="<?php echo $cpdate; ?>" name="action_id3">
                        <button type="submit" class="" name="approve" style="padding:10px 21px;display:flex;font-size:10px;margin-bottom:3px;background-color:#22CD6E;border:0;border-radius:6px;" >Approve</button>
                        <button type="submit" class="" name="disapprove" style="padding:10px 14px;display:flex;font-size:10px;background-color:#F20213;border:0;border-radius:6px;" >Disapprove</button>                         
                        </form>
                </td>
                        <td class="d-flex flex-row justify-content-center">
                            <form action="admin_cargo_checkpayment.php" method="post" class="d-flex flex-row justify-content-evenly">
                                <input type="hidden" value="<?php echo $gid; ?>" name="action_id">
                                <input type="hidden" value="<?php echo $gtime; ?>" name="action_id1">
                                <input type="hidden" value="<?php echo $gdate; ?>" name="action_id2">
                                <input type="hidden" value="<?php echo $cpdate; ?>" name="action_id3">
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
                           <th>Plan ID</th>
                            <th>Customer ID</th>
                            
                            <th>Categories </th>
                            <th>Cost</th>
                            <th>Status</th>
                            <th>screenshot</th>
                            <th>Check</th>
                            <th>Action</th>
                           </tr>
                           </thead>
                           <tbody>
                            <?php  include 'connect.php';
                               $search = $_POST['search'];
                               $sql = "SELECT crid, cid, categories, gdate,gtime,gid,status,cpdate, totalcost,sname,stele,rname,rtele,note
        FROM get_cargo_service
        WHERE status ='Pending' and (crid LIKE '%$search%' OR cid LIKE '%$search%' OR sname LIKE '%$search%' OR gdate LIKE '%$search%' OR gtime LIKE '%$search%' OR totalcost LIKE '%$search%' OR categories LIKE '%$search%' OR rname LIKE '%$search%')";

                               $result = $dbconnection->query($sql);
                               if ($result->num_rows > 0) {
                                // Fetch data from each row
                                while ($row = $result->fetch_assoc()) {
                                    $crid = $row["crid"];
                                    $cid = $row["cid"];
                                    $categories = $row["categories"];
                                    $gdate = $row["gdate"];
                                    $gtime = $row["gtime"];
                                    $tcost= $row["totalcost"];
                                    $sname=$row["sname"];
                                    $stele=$row["stele"];
                                    $rname=$row["rname"];
                                    $rtele=$row["rtele"];
                                    $note=$row["note"];
                                    $gid=$row["gid"];
                                    $cpdate=$row["cpdate"];
                                    $status=$row["status"];
                                    ?>
                                    <tr class="first_row">
                      
                      <td><?php echo $crid; ?></td>
                      <td><?php echo $cid; ?></td>
                  
                      <td><?php echo $categories; ?></td>

                      <td><?php echo $tcost; ?></td>
                      <td><?php echo $status; ?></td>
                      <td>
                      
                    
                      <button type="button" name="screenshot" onclick="showLargeImage('<?php echo $photo ?>')" style="border:none; background:none;">
  <img src='./uploads/<?php echo $photo ?>' height="60px" width="40px">
</button>

<script>
  function showLargeImage(photo) {
      var imageUrl = './uploads/' + photo;
      window.open(imageUrl, '_blank');
  }
</script>

<!-- Modal -->
<!-- <div id="screenshotModal" class="modal">
  <span class="close" onclick="closeModal()">&times;</span>
  <img class="modal-content" id="modalScreenshot">
</div> -->
                      
                    </td>
                      <td>
                      <form action="admin_cargo_checkpayment.php" method="post">
                      <input type="hidden" value="<?php echo $gid; ?>" name="action_id">
                      <input type="hidden" value="<?php echo $gtime; ?>" name="action_id1">
                      <input type="hidden" value="<?php echo $gdate; ?>" name="action_id2">
                      <input type="hidden" value="<?php echo $cpdate; ?>" name="action_id3">
                      <button type="submit" class="" name="approve" style="padding:10px 21px;display:flex;font-size:10px;margin-bottom:3px;background-color:#22CD6E;border:0;border-radius:6px;" >Approve</button>
                      <button type="submit" class="" name="disapprove" style="padding:10px 14px;display:flex;font-size:10px;background-color:#F20213;border:0;border-radius:6px;" >Disapprove</button>                         
                      </form>
              </td>
                      <td class="d-flex flex-row justify-content-center">
                          <form action="admin_cargo_checkpayment.php" method="post" class="d-flex flex-row justify-content-evenly">
                              <input type="hidden" value="<?php echo $gid; ?>" name="action_id">
                              <input type="hidden" value="<?php echo $gtime; ?>" name="action_id1">
                              <input type="hidden" value="<?php echo $gdate; ?>" name="action_id2">
                              <input type="hidden" value="<?php echo $cpdate; ?>" name="action_id3">

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
                          <form method="post" action="admin_cargo_checkpayment.php" >
                            <button type="submit" style="margin: 10px 0px 30px 30px; background-color:#7895CB; border:none;" name="search_back" > <<< Back </button>
                          </form>
                          <?php 
                          }

                          if (isset($_POST['search_back'])){
                             echo '<script> window.location("admin_cargo_checkpayment.php")';
                          } 
                        ?>
                          <?php function detail(){?>
                          <table class="table" cellspacing="5px" border="0"  id="table_part">
                            <thead>
                            <tr>
                            <!--<th><input type="checkbox" name="hchc[]" class="check_box"></th>-->
                            
                            <th>Sender Name</th>
                              <th>Sender Phone</th>                            
                              
                              <th>Receiver Name</th>
                              <th>Receiver Phone</th>
                              <th>Special resquest</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php
                                
                                include 'connect.php';
                                $gtime = $_POST['action_id1'];
                                $gdate = $_POST['action_id2'];
                              
                                $sql = "SELECT sname,stele,rname,rtele,note
                                FROM get_cargo_service
                                WHERE gdate = '$gdate' AND gtime = '$gtime'";
                                  $result = $dbconnection->query($sql); 
                                  $firstRow = true;
                                        if ($result->num_rows > 0){
                                        while ($row = $result->fetch_assoc()) {
                                            $sname=$row["sname"];
                                            $stele=$row["stele"];
                                            $rname=$row["rname"];
                                            $rtele=$row["rtele"];
                                            $note=$row["note"];
                                            ?>
                                            <tr class="first_row" >
                                            <td><?php  echo $sname; ?></td>
                                            <td><?php  echo $stele; ?></td>
                                            <td><?php  echo $rname; ?></td>
                                            <td><?php  echo $rtele; ?></td>
                                            <td><?php  echo $note; ?></td>
                                            
                                            
                                            
                                            
                                    
                                    </tr>
                                
                                    <?php  }
                                  
                                } else {
                                      echo "No data found";
                                }
                          
                              
                            
                           ?>
                           </tbody>
                            </table>
                            <form method="post" action="admin_cargo_checkpayment.php" >
                              <button type="submit" style="margin: 10px 0px 30px 30px; background-color:#7895CB; border:none;" name="search_back" > <<< Back </button>
                            </form>
                            <?php 
                            } ?>
                            <?php function show_message_part($gid) { ?>
                              <form method="post" action="admin_cargo_checkpayment.php" >
                               <?php //echo "<script> alert('$gid');</script>"; ?>
                               <label for="inputField">Enter a message:</label><br>
                               <input type="text" id="inputField" name="dmessage" required><br>
                               <input type="hidden" id="inputField" name="one" value="<?php echo $gid; ?>" required><br>
                               
                               <button type="submit" value="Submit"  name="dok">Submit</button>
                            </form>

                            <?php } 

                            
                            
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
    function showLargeImage(photo) {
    var modal = document.getElementById('screenshotModal');
    modal.style.max-width= 100%;
    modal.style.max-height= 100%;
    modal.style.display = "block";
    
}



</script> 
 
  </html>


