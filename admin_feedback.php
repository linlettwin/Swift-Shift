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
<?php
// Rest of your PHP code...
function displayBox() { 
    ?>
    <script>
        var box = document.createElement('div');
        var message = document.createElement('div');

        message.textContent = "Password mismatch!";
        message.style.marginTop = "30px";
        message.style.fontWeight ="bold"; 
        box.appendChild(message);

        var okButton = document.createElement('button');
        okButton.textContent = "OK";
        okButton.style.marginTop = "20px";
        okButton.style.padding ="5px 15px";
        okButton.style.backgroundColor ="#F18D65";
        okButton.style.borderRadius ="5px";

        okButton.addEventListener('click', function() {
            document.body.removeChild(box);
            window.location.href = "test.php";
        });

        box.appendChild(okButton);

        box.style.backgroundColor = "#ffffff"; 
        box.style.color = "#000000"; 
        box.style.width = "300px"; 
        box.style.height = "auto"; 
        box.style.border = "2px solid #000000"; 
        box.style.borderRadius = "10px"; 
        box.style.position = "fixed"; 
        box.style.top = "50%"; 
        box.style.left = "50%"; 
        box.style.transform = "translate(-50%, -50%)"; 
        box.style.textAlign = "center";
        box.style.padding = "20px"; 

        document.body.appendChild(box);
    </script>
    <?php
}
?>
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
				width:130px;
				height:35px;
				margin-top:30px;
	  }
    .back-btn{
				/*margin-left:10px;*/
				border:none;
				background-color: #7895CB;
				width:130px;
				height:35px;
				margin-top:30px;
			}

      
    </style>

  </head>

  <?php 
  include 'connect.php';   
  
  
  if (isset($_POST["delete"]))
  {
                             
     $d_fid= $_POST["action_id"];                             
     $dquery=$dbconnection->prepare("DELETE FROM feedback WHERE fid=$d_fid");
     $dquery->execute();
                                
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
      <li  class="active">
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
                    <h5>Manage Customers' Feedback</h5>
                    <form method="post" action="admin_feedback.php">
                        <!--<button type="submit" name="addbtn" class="add_btn d-flex flex-row">
                          <i class="fa-solid fa-plus" style="color: #ffffff; margin-top:5px;"></i> Add New
                        </button> -->
                    </form>  
                  </div>
                  <div class="search_part" style="margin:20px; float:right;">
                      <form method="post" action="admin_feedback.php">
                        <input type="text" placeholder="Search.." name="search">
                        <button type="submit" name="search_bt" class="search"><i class="fa fa-search"></i></button>
                      </form>
                  </div>

                <div class="table-wrapper" style="background-color:#E7EEF4;">
                <div class="whole" style="background-color:#E7EEF4;">
                    
                    <div class="display-info" id="table_part">
                        <?php
                           
                               if(isset($_POST['search_bt']))
                                {
                                  $search = $_POST['search'];
                                  $sql = "SELECT f.fid, f.cid, c.name, f.feedback, f.times FROM feedback f, customer c Where f.cid = c.cid and (f.fid LIKE '$search' OR f.cid LIKE '$search' OR c.name LIKE '$search%')";
                                  $result = $dbconnection->query($sql);
                                   search_show(); 
                                }
                                
                           
                                else {
                                display_table();
                                }  


                        ?>

                        

                        <?php function display_table(){ ?>
                         <table class="table" cellspacing="5px" border="0"  id="table_part">
                            <thead>
                            <tr>
                            <!--<th><input type="checkbox" name="hchc[]" class="check_box"></th>-->
                            <th>No</th>  
                            <th>Customer Id</th>                                                                               
                            <th>Customer Name</th>
                            <th>Feedback</th>
                            <th>Timestamp</th>
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
                                  $sql = "SELECT COUNT(*) as total FROM feedback";
                                  $result = $dbconnection->query($sql);
                                  $row = $result->fetch_assoc();
                                  $total_rows = $row['total'];
                                  $total_pages = ceil($total_rows / $records_per_page);   
                                   
                                  $sql = "SELECT f.fid, f.cid, c.name, f.feedback, f.ftime FROM feedback f, customer c Where c.cid=f.cid ORDER BY f.fid LIMIT $start, $records_per_page";
                                  $result = $dbconnection->query($sql);                                
                                           
                                    if ($result->num_rows > 0) {
                                        // Fetch data from each row
                                        while ($row = $result->fetch_assoc()) {
                                            $fid = $row["fid"];
                                            $cid = $row["cid"];
                                            $name = $row["name"];
                                            $feedback = $row["feedback"];
                                            $time = $row["ftime"];
                                            
                                            
                                          ?>
                                          <tr class="first_row" >
                                          <!--<td><input type="checkbox" name="crow[]" class="check_box" id="select_row"></td>-->
                                          <td><?php  echo $fid; ?></td>
                                          <td><?php  echo $cid; ?></td>
                                          <td><?php  echo $name; ?></td>
                                          <td><?php  echo $feedback; ?></td>
                                          <td><?php  echo $time; ?></td>
                                         
                                          <td class="d-flex flex-row justify-content-center"> 
                                              <form action="admin_feedback.php" method="post" class="d-flex flex-row justify-content-evenly">
                                              <input type="hidden" value="<?php echo $fid; ?>" name="action_id">
                                              <!--<button type="submit" class="action_btn" name="view_more"><i class="fa-solid fa-eye"></i></button>-->
                                              <!--<button type="submit" class="action_btn" name="edit"> <i class="fa-solid fa-pen-to-square"></i></button>-->
                                              <button type="submit" class="action_btn" name="delete" onclick="return Dconfirm()"> <i class="fa-solid fa-trash"></i> </button> 
                                              </form>
                                          </td>
                                          
                                          </tr>
                                      
                                          <?php  }
                                        
                                      } else {
                                        echo "<tr><td>No data found</td></tr>";
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
                           <th>No</th>  
                            <th>Customer Id</th>                                                                               
                            <th>Customer Name</th>
                            <th>Feedback</th>
                            <th>Timestamp</th>
                            <th>Action</th>
                           </tr>
                           </thead>
                           <tbody>
                            <?php  include 'connect.php';
                               $search = $_POST['search'];
                               $sql = "SELECT f.fid, f.cid, c.name, f.feedback, f.ftime FROM feedback f, customer c Where f.cid = c.cid and (f.fid LIKE '$search' OR f.cid LIKE '$search' OR c.name LIKE '$search%')";
                               $result = $dbconnection->query($sql);
                               if ($result->num_rows > 0) {
                                // Fetch data from each row
                                while ($row = $result->fetch_assoc()) {
                                    $fid = $row["fid"];
                                    $cid = $row["cid"];
                                    $name = $row["name"];
                                    $feedback = $row["feedback"];
                                    $time = $row["ftime"];                                 
                                    
                        ?>
                                    <tr class="first_row" >                                    
                                          <td><?php  echo $fid; ?></td>
                                          <td><?php  echo $cid; ?></td>
                                          <td><?php  echo $name; ?></td>
                                          <td><?php  echo $feedback; ?></td>
                                          <td><?php  echo $time; ?></td>                                 
                                    
                                                                    
                                    <td class="d-flex flex-row justify-content-center"> 
                                        <form action="admin_feedback.php" method="post" class="d-flex flex-row justify-content-evenly">
                                        <input type="hidden" value="<?php echo $fid; ?>" name="action_id">
                                        <!--<button type="submit" class="action_btn" name="view_more"><i class="fa-solid fa-eye"></i></button> -->
                                        <button type="submit" class="action_btn" name="edit"> <i class="fa-solid fa-pen-to-square"></i></button>
                                        <button type="submit" class="action_btn" name="delete" onclick="return Dconfirm()" > <i class="fa-solid fa-trash"></i> </button> 
                                        </form>
                                    </td>
                                    
                                    </tr>
                                
                                    <?php   }
                                
                                } else {
                                        echo "<tr><td>No data found</td></tr>";
                                }

                         ?>
                       
            
        
                          </tbody>
                          </table>
                          <form method="post" action="admin_feedback.php" >
                            <button type="submit" style="margin: 10px 0px 30px 30px; background-color:#7895CB; border:none;" name="search_back" > <<< Back </button>
                          </form>

                          
                        <?php   
                          }

                          if (isset($_POST['search_back'])){
                             echo '<script> window.location("admin_feedback.php")';
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
  
  



</body>
<?php


?>  
  
 
</html>


