
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

?>

<!doctype html>
<html lang="en">

  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
        <title>SwiftShift Admin</title>
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
    .btn button{
				/*margin-left:10px;*/
				border:none;
				background-color: #7895CB;
				width:100px;
				height:35px;
				margin-top:10px;
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

      <li  class="active">
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
          <!--line-->
          <div class="col-md-12">
            <div class="table-title" style="background-color:#7895CB;">
                    <div class="row" style="background-color:#7895CB; height:20px; width:100%; margin:0;" >
                      
                      <div class="col-sm-6 p-0 d-flex justify-content-lg-start justify-content-center">
                        
                      </div>
            
                    </div>
          </div>
           <div class="bottom_work" style="background-color:#E7EEF4;">
                <div class="header_part d-flex  justify-content-center" style="border-bottom:2px solid black; padding:20px">
                    

                       
                <form action="admin_logout.php" method="post" >
                 <p>Are you sure you want to logout?</p>
                 <div class="btn">
                 <button type="submit" name="confirm" value="1">Confirm</button>
                 <button type="button" onclick="window.location.href='admin_dashboard.php';">Cancel</button>
                </div>
                </form>
            
                       

                <?php
                   
                    // Check if the form has been submitted
                    if (isset($_POST["confirm"]) && $_POST["confirm"] == 1) {
                        // Unset the session variable
                        unset($_SESSION["admin"]);

                        // Destroy the session
                        session_destroy();
                        
                        echo "<script> window.location.href='SignUp.php'; </script>";
                        
                        exit();
                    }
                    
                ?>
                        
                
                        

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



?>  
  
 
</html>


