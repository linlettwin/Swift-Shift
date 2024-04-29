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
        <link rel="stylesheet" href="css/admin_dashboard.css">
		
		
		<!--google fonts -->
	
	    <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
	
	
	<!--google material icon-->
      <link href="https://fonts.googleapis.com/css2?family=Material+Icons"rel="stylesheet">


      <link href="https://netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/094c1a5071.js" crossorigin="anonymous"></script>
    <style>
    .box1,.box2,.box3,.box4,.box5,.box6,.box7,.box8,.box9,.box10,.box11,.box12 {
        outline: none;
        cursor: pointer;
        transition: box-shadow 0.3s ease;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.3); /* Initial box shadow */
    }

    .box1:hover,.box2:hover,.box3:hover,.box4:hover,.box5:hover,.box6:hover {
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.8); /* Adjust shadow color and intensity */
    }
    .box7:hover,.box8:hover,.box9:hover,.box10:hover,.box11:hover,.box12:hover {
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.8); /* Adjust shadow color and intensity */
    }

</style>
  </head>
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
			<li  class="active">
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
            class=""><i class="fa-solid fa-address-card" style="margin-left: 7px; font-size: 20px;"></i><span style="margin-left: 15px; font-weight: bold; font-size: 15px;">Cargo Serivce</span></a>
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

		
		
		
		
<!--------page-content---------------->
		
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
          <div class="col-md-12">
                <div style="background-color:#E7EEF4; padding:30px 0px 0px 30px;">
                    <h5>BUS DASHBOARD</h5>
                    <div class="table-wrapper">
                    <div class="travel d-flex justify-content-between">
                    <?php
            include "connect.php";
            $sql = "SELECT COUNT(*) AS bus_count FROM bus";
            $result = mysqli_query($dbconnection, $sql);
            if ($result) {
                $row = mysqli_fetch_assoc($result);
                $busCount = $row['bus_count'];
                ?>
                      <div class="col-sm-3" style="margin-bottom:30px;">
                          <div class=" button box1" onclick="window.location.href='admin_bus.php'" style="outline: none; cursor: pointer; transition: background-color 0.3s ease;">
    
                              <span class="text-left">Total Buses</span><br>
                              <div>
                                  <span class="number-text"><?php echo $busCount;?></span>
                                  <i class="fa-solid fa-bus"></i>
                              </div>
                            </div>
                          </div>
                          <?php
                        } else {
    echo "Error: " . mysqli_error($dbconnection);
}
mysqli_close($dbconnection);

                    include "connect.php";
                    $sql = "SELECT COUNT(*) AS gate_count FROM cargate";
                    $result = mysqli_query($dbconnection, $sql);
                    if ($result) {
                        $row = mysqli_fetch_assoc($result);
                        $gateCount = $row['gate_count'];
                        ?>
                      <div class="col-sm-3" style="margin-bottom:30px;">
                      <div class=" button box2" onclick="window.location.href='admin_gate.php'">
                          <span class="text-left">Total Bus Gates</span><br>
                          <div>
                              <span class="number-text"><?php echo $gateCount;?></span>
                              <i class="fa-solid fa-torii-gate"></i>
                          </div>
                          </div>
                      </div>
                      <?php
                    } else {
    echo "Error: " . mysqli_error($dbconnection);
}
mysqli_close($dbconnection);

                include "connect.php";
                $sql = "SELECT COUNT(*) AS c_count FROM customer";
                $result = mysqli_query($dbconnection, $sql);
                if ($result) {
                    $row = mysqli_fetch_assoc($result);
                    $cCount = $row['c_count'];
                    ?>
                      <div class="col-sm-3" style="margin-bottom:30px;">
                      <div class=" button box3" onclick="window.location.href='admin_customer.php'">
                          <span class="text-left">Total</span>
                          <span class="text-left">Customers</span><br>
                          <div> 
                              <span class="number-text"><?php echo $cCount;?></span>
                              <i class="fa-solid fa-users"></i><span>                           
                          </div>
                          </div>
                      </div>
                      <?php
                    } else {
                echo "Error: " . mysqli_error($dbconnection);
            }
            mysqli_close($dbconnection);
            include "connect.php";
            $sql = "SELECT COUNT(*) AS r_count FROM route";
            $result = mysqli_query($dbconnection, $sql);
            if ($result) {
                $row = mysqli_fetch_assoc($result);
                $rCount = $row['r_count'];
                ?>
                      <div class="col-sm-3" style="margin-bottom:30px;">
                      <div class=" button box4" onclick="window.location.href='admin_route.php'">
                          <span class="text-left">Total Routes</span><br>
                          <div> 
                              <span class="number-text"><?php echo $rCount;?></span>
                              <i class="fa-solid fa-route"></i>
                          </div>
                          
                          </div>
                      </div>
                      <?php
                    } else {
                echo "Error: " . mysqli_error($dbconnection);
            }
            mysqli_close($dbconnection);
            ?>
                    </div>




                    <div class="travel d-flex ">
                    <?php
                    include "connect.php";
                    $sql = "SELECT COUNT(*) AS o_count FROM operator";
                    $result = mysqli_query($dbconnection, $sql);
                    if ($result) {
                        $row = mysqli_fetch_assoc($result);
                        $oCount = $row['o_count'];
                        ?>
                      <div class="col-sm-3" style="margin-bottom:30px;">
                      <div class=" button box5" onclick="window.location.href='admin_operator.php'">
                              <span class="text-left">Total Operators</span><br>
                              <div>
                                  <span class="number-text"><?php echo $oCount;?></span>
                                  <i class="fa-solid fa-business-time"></i>
                              </div>
                          </div>
                          </div>
                          <?php
                    } else {
                echo "Error: " . mysqli_error($dbconnection);
            }
            mysqli_close($dbconnection);
            include "connect.php";
                    $sql = "SELECT COUNT(*) AS p_count FROM plan";
                    $result = mysqli_query($dbconnection, $sql);
                    if ($result) {
                        $row = mysqli_fetch_assoc($result);
                        $pCount = $row['p_count'];
                        ?>
                      <div class="col-sm-3" style="margin-bottom:30px;">
                      <div class=" button box6" onclick="window.location.href='admin_plan.php'">
                          <span class="text-left">Plans</span><br>
                          <div>
                              <span class="number-text"><?php echo $pCount;?></span>
                              <i class="fa-regular fa-clock"></i>
                          </div>
                          </div>
                      </div>
                      <?php
                    } else {
                echo "Error: " . mysqli_error($dbconnection);
            }
            mysqli_close($dbconnection);

            include "connect.php";
            $sql="SELECT count(btid) as bt_count FROM btickets Where status='approved' GROUP BY bdate, btime";
            $result = mysqli_query($dbconnection, $sql);
            $data = [];
            while ($row = mysqli_fetch_assoc($result)) {
             $data[] = $row;
            }
$numRows = count($data);
                
                        ?>
                      <div class="col-sm-3" style="margin-bottom:30px;">
                      <div class=" button box7" onclick="window.location.href='admin_bticket.php'">
                          <span class="text-left">Booked</span>
                          <span class="text-left">Tickets</span><br>
                          <div> 
                              <span class="number-text"><?php echo $numRows;?></span>
                              <i class="fa-solid fa-address-card"></i><span>                           
                          </div>
                        </div>
                      </div>
                     
                  
                    
                </div>
                </div>
          </div>

          <div class="col-md-12">
                <div style="background-color:#E7EEF4; padding:30px 0px 0px 30px;">
                    <h5>CARGO DASHBOARD</h5>
                    <div class="table-wrapper">
                    <div class="travel d-flex justify-content-between">
                    <?php
                    include "connect.php";
                    $sql = "SELECT COUNT(*) AS branch_count FROM cargo_branch";
                    $result = mysqli_query($dbconnection, $sql);
                    if ($result) {
                        $row = mysqli_fetch_assoc($result);
                        $branchCount = $row['branch_count'];
                        ?>
                      <div class="col-sm-3" style="margin-bottom:30px;">
                      <div class=" button box2" onclick="window.location.href='admin_cargo_branch.php'">
                              <span class="text-left">Total Branches</span><br>
                              <div>
                                  <span class="number-text"><?php echo $branchCount; ?></span>
                                  <i class="fa-solid fa-code-branch"></i>
                              </div>
                          </div>
                          </div>
                          <?php
} else {
    echo "Error: " . mysqli_error($dbconnection);
}
mysqli_close($dbconnection);
?>
            <?php
            include "connect.php";
            $sql = "SELECT COUNT(*) AS route_count FROM cargo_route";
            $result = mysqli_query($dbconnection, $sql);
            if ($result) {
                $row = mysqli_fetch_assoc($result);
                $routeCount = $row['route_count'];
                ?>
                      <div class="col-sm-3" style="margin-bottom:30px;">
                      <div class=" button box4" onclick="window.location.href='admin_cargo_route.php'">
                          <span class="text-left">Total Routes</span><br>
                          <div>
                              <span class="number-text"><?php echo $routeCount; ?></span>
                              <i class="fa-solid fa-road"></i>
                          </div>
                          </div>
                      </div>
                      <?php
                            } else {
            echo "Error: " . mysqli_error($dbconnection);
        }
        mysqli_close($dbconnection);
        ?>
        <?php
            include "connect.php";
            $sql = "SELECT COUNT(*) AS plan_count FROM cargo_plan";
            $result = mysqli_query($dbconnection, $sql);
            if ($result) {
                $row = mysqli_fetch_assoc($result);
                $planCount = $row['plan_count'];
                ?>
                      <div class="col-sm-3" style="margin-bottom:30px;">
                      <div class=" button box1" onclick="window.location.href='admin_cargo_plan.php'">
                          <span class="text-left">Total</span>
                          <span class="text-left">Plans</span><br>
                          <div> 
                              <span class="number-text"><?php echo $planCount; ?></span>
                              <i class="fa-solid fa-clock"></i><span>                           
                          </div>
                          </div>
                      </div>
                      <?php
                            } else {
            echo "Error: " . mysqli_error($dbconnection);
        }
        mysqli_close($dbconnection);
        ?>
        <?php
            include "connect.php";
            $sql = "SELECT COUNT(*) AS truck_count FROM cargo_truck";
            $result = mysqli_query($dbconnection, $sql);
            if ($result) {
                $row = mysqli_fetch_assoc($result);
                $truckCount = $row['truck_count'];
                ?>
        
                      <div class="col-sm-3" style="margin-bottom:30px;">
                      <div class=" button box3" onclick="window.location.href='admin_cargo_truck.php'">
                          <span class="text-left">Total Trucks</span><br>
                          <div> 
                              <span class="number-text"><?php echo $truckCount;?></span>
                              <i class="fa-solid fa-truck"></i>
                          </div>
                          
                          </div>
                      </div>
                      <?php
                            } else {
            echo "Error: " . mysqli_error($dbconnection);
        }
        mysqli_close($dbconnection);
        ?>
        </div>




<div class="travel d-flex justify-content-between">
        <?php
            include "connect.php";
            $sql = "SELECT COUNT(*) AS service_count FROM get_cargo_service Where status='approved'";
            $result = mysqli_query($dbconnection, $sql);
            if ($result) {
                $row = mysqli_fetch_assoc($result);
                $serviceCount = $row['service_count'];
                ?>
                <div class="col-sm-3" style="margin-bottom:30px;">
                      <div class=" button box3" onclick="window.location.href='admin_cargo_ticket.php'">
                          <span class="text-left">Cargo Service</span><br>
                          <div> 
                              <span class="number-text"><?php echo $serviceCount;?></span>
                              <i class="fa-solid fa-truck"></i>
                          </div>
                          
                          </div>
                      </div>
                      <?php
                            } else {
            echo "Error: " . mysqli_error($dbconnection);
        }
        mysqli_close($dbconnection);
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
  
  </html>


