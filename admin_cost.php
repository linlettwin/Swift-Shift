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
                             
     $d_costid = $_POST["action_id"];                             
     $dquery=$dbconnection->prepare("DELETE FROM cost WHERE costid=$d_costid");
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
         <<nav id="sidebar" >
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
      
        <li  class="active">
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
                    <h5>Manage Bus Ticket Cost Information</h5>
                    <form method="post" action="admin_cost.php">
                        <button type="submit" name="addbtn" class="add_btn d-flex flex-row">
                          <i class="fa-solid fa-plus" style="color: #ffffff; margin-top:5px;"></i> Add
                        </button>
                    </form>  
                  </div>
                  <div class="search_part" style="margin:20px; float:right;">
                      <form method="post" action="admin_cost.php">
                        <input type="text" placeholder="Search.." name="search">
                        <button type="submit" name="search_bt" class="search"><i class="fa fa-search"></i></button>
                      </form>
                  </div>

                <div class="table-wrapper" style="background-color:#E7EEF4;">
                <div class="whole" style="background-color:#E7EEF4;">
                    
                    <div class="display-info" id="table_part">
                        <?php
                            if (isset($_POST['addbtn']) || isset($_POST['edit']) || isset($_POST['search_bt']) )  {
                                if(isset($_POST['addbtn']))
                                {   
                                    $next_costid = getNextCostId(); // Assuming there's a function to get the next available customer ID
                                    add_form($next_costid);
                                }
                                else if(isset($_POST['edit']))
                                {
                                    $e_costid = $_POST['action_id'];
                                    //echo $e_costid;
                                    $edit_row_query= "SELECT c.costid, cg1.town as town1, cg2.town as town2, o.oname, c.cost FROM cost c, route r, operator o, cargate cg1, cargate cg2 WHERE c.rid=r.rid and c.oid=o.oid and cg1.cgid=r.source and cg2.cgid=r.destination and c.costid = $e_costid";
                                    $erow=$dbconnection->query($edit_row_query);
                                    $ecostid=$e_costid;
                                    while($edit_row = $erow->fetch_assoc())
                                    {
                                      $ecostid=$edit_row["costid"];
                                      $esrc=$edit_row["town1"];
                                      $edesti=$edit_row["town2"];
                                      $eoperator=$edit_row["oname"];
                                      $ecost=$edit_row["cost"];

                                      show_edit_form($ecostid,$esrc,$edesti,$eoperator,$ecost);
                                    } 
                                }
                                else if(isset($_POST['search_bt']))
                                {
                                  $search = $_POST['search'];
                                  $sql = "SELECT Distinct c.costid, cg1.town as town1, cg2.town as town2, o.oname, c.cost FROM cost c, route r, operator o, cargate cg1, cargate cg2 WHERE c.rid=r.rid and c.oid=o.oid and cg1.cgid=r.source and cg2.cgid=r.destination and (cg1.town LIKE '%$search%' OR cg2.town LIKE '%$search%' OR c.costid LIKE '%$search%' OR o.oname LIKE '%$search%' OR c.cost LIKE '%$search') ";
                                  $result = $dbconnection->query($sql);
                                   search_show(); 
                                }
                                
                           
                            } else if( (!isset($_POST['add_btn'])) && ( !isset($_POST['edit_btn'])) ){
                             display_table();
                            }  


                            if (isset($_POST["add_btn"]))
                            {
                              include 'connect.php';
                                              
                                          $ncostid=$_POST["ncostid"];
                                          $nsrc=$_POST["nsrc"];
                                          //echo "<script>window.alert('$nsrc'); </script>";
                                          $ndesti=$_POST["ndesti"];
                                          //echo "<script>window.alert('$ndesti'); </script>";
                                          $noperator=$_POST["nop"];
                                          //echo "<script>window.alert('$noperator'); </script>";
                                          $ncost=$_POST["ncost"];
                                          $src_id="SELECT cg.cgid FROM cargate cg WHERE cg.town=?";
                                          $desti_id="SELECT cg.cgid FROM cargate cg WHERE cg.town=?";

                                              $get_sid =$dbconnection->prepare($src_id);
                                              $get_sid->bind_param("s", $nsrc);
                                              $get_sid->execute();
                                              $get_sid_result = $get_sid->get_result();
                                              $get_sid_row = $get_sid_result->fetch_assoc();
                                              $get_sid = $get_sid_row["cgid"];

                                              $get_did =$dbconnection->prepare($desti_id);
                                              $get_did->bind_param("s", $ndesti);
                                              $get_did->execute();
                                              $get_did_result = $get_did->get_result();
                                              $get_did_row = $get_did_result->fetch_assoc();
                                              $get_did = $get_did_row["cgid"];

                                          if($nsrc == $ndesti){
                                            echo "<script>window.alert('Source and Destination should not be the same.'); </script>";
                                            $next_costid = getNextCostId(); 
                                            show_add_again($ncostid, $nsrc, $ndesti, $noperator, $ncost);
                                            
                                          }
                                          else {
                                            $sr="SELECT r.rid FROM route r WHERE r.source=? and r.destination=?";
                                            $s2="SELECT o.oid FROM operator o WHERE o.oname=?";
                                                                                       
                                          

                                            $n_rid=$dbconnection->prepare($sr);
                                            $n_rid->bind_param("ii", $get_sid, $get_did);
                                            $n_rid->execute();
                                            $n_rid_result = $n_rid->get_result();                                            
                                            $n_rid_row = $n_rid_result->fetch_assoc();

                                            if ( $n_rid_row > 0){
                                              $n_rid = $n_rid_row["rid"];
                                              //echo "<script>window.alert('$n_rid'); </script>"; 
                                              $sql_check = "SELECT * FROM Route WHERE Rid=?";
                                              $stmt_check = $dbconnection->prepare($sql_check);
                                              $stmt_check->bind_param("i", $n_rid);
                                              $stmt_check->execute();
                                              $result_check = $stmt_check->get_result();


                                              $check_oid =$dbconnection->prepare($s2);
                                              $check_oid->bind_param("s", $noperator);
                                              $check_oid->execute();
                                              $check_oid_result = $check_oid->get_result();
                                              $check_oid_row = $check_oid_result->fetch_assoc();
                                              $check_oid = $check_oid_row["oid"];

                                              if ($result_check->num_rows > 0) {                                           
                                            
  
                                                try {

                                                  $check_costid = "SELECT * FROM cost WHERE costid=?";
                                                  $stmt_check_costid = $dbconnection->prepare($check_costid);
                                                  $stmt_check_costid->bind_param("i", $ncostid);
                                                  $stmt_check_costid->execute();
                                                  $result_check_costid = $stmt_check_costid->get_result();

                                                  if ($result_check_costid->num_rows > 0) {
                                                      show_add_again($ncostid, $nsrc, $ndesti, $noperator, $ncost);
                                                      echo "<script>window.alert('The costid already exists in the table. Please enter a different costid.'); </script>";                                                      
                                                  } else {
                                                      // Insert the new record
                                                      $add_query = 'INSERT INTO cost(costid,rid,oid,cost) VALUES (:costid, :rid, :oid, :cost )  ';
                                                      $sta=$conn->prepare($add_query);
                                                      $sta-> bindValue( ":costid", $ncostid, PDO::PARAM_INT );
                                                      $sta-> bindValue( ":rid", $n_rid, PDO::PARAM_INT);
                                                      $sta-> bindValue( ":oid", $check_oid, PDO::PARAM_STR);
                                                      $sta-> bindValue( ":cost", $ncost, PDO::PARAM_INT);
                                                      $sta->execute();
                                                      display_table();
                                                  }
                                                  
                                                } catch ( PDOException $e ) {
                                                  //echo "Query failed: " . $e-> getMessage();
                                                  show_add_again($ncostid, $nsrc, $ndesti, $noperator, $ncost);
                                                  echo "<script>window.alert('The cost and operator of the given route already exists in the table.'); </script>";
                                                                                                 
                                                  
                                                }   
                                                
  
                                              
  
                                              }
                                              else
                                              {
                                                echo "<script>window.alert('The Rid (source and destination) value does not exist in the Route table. Please enter a valid Rid value.');                                            
                                                </script>";
                                              } 
                                            } else{
                                              echo "<script>window.alert('The The Rid (source and destination) does not exist in the Route table. Please enter a valid Rid value.');                                            
                                              </script>"; 
                                              $next_costid = getNextCostId(); 
                                              show_add_again($ncostid, $nsrc, $ndesti, $noperator, $ncost);
                                            }
                                           
                                          }  
                                            
                            } 
                            
                            if (isset($_POST["edit_btn"]))
                            {
                                          
                                          $ocostid=$_POST["ocostid"];
                                          $osrc=$_POST["osrc"];
                                          $odesti=$_POST["odesti"];
                                          $ooperator=$_POST["ooperator"];
                                          $ocost=$_POST["ocost"];
                                          $prev_id=$_POST["previous_edit_id"];
                                          
                                          //echo "<script> window.alert($prev_id);</script>";
                                          //echo "<script> window.alert($ocostid);</script>"; 
                                          $x = ($ocostid == $prev_id) ? "true" : "false" ;
                                        
                                          try {
                                             
                                            $check_ecostid = "SELECT * FROM cost WHERE costid=?";
                                            $stmt_check_ecostid = $dbconnection->prepare($check_ecostid);
                                            $stmt_check_ecostid->bind_param("i", $ocostid);
                                            $stmt_check_ecostid->execute();
                                            $result_check_ecostid = $stmt_check_ecostid->get_result();

                                            if ($result_check_ecostid->num_rows > 0 && $x == "false") {
                                                show_edit_form($ocostid, $osrc, $odesti, $ooperator, $ocost);
                                                echo "<script>window.alert('The ecostid already exists in the table. Please enter a different ecostid.'); </script>";
                                                
                                            } else {
                                                $sql = 'UPDATE cost SET costid=:costid, cost =:cost WHERE costid = :prev_id';
                                                $st=$conn->prepare($sql);
                                                $st-> bindValue( ":costid", $ocostid, PDO::PARAM_INT );
                                                $st-> bindValue( ":cost", $ocost, PDO::PARAM_STR);
                                                $st-> bindValue( ":prev_id", $prev_id, PDO::PARAM_INT );
                                                $st->execute();
                                                display_table();
                                            }
                                          } catch ( PDOException $e ) {
                                              echo "Query failed: " . $e-> getMessage();
                                              display_table();
                                          }   
                                          
                                      
                            } 


                            
                                                       
                
                        ?>

                        

                        <?php function display_table(){ ?>
                         <table class="table" cellspacing="5px" border="0"  id="table_part">
                            <thead>
                            <tr>
                            <!--<th><input type="checkbox" name="hchc[]" class="check_box"></th>-->
                            <th>Cost Id</th>
                            <th>Source</th>
                            <th>Destination</th>
                            <th>Operator</th>
                            <th>Cost(MMK)</th>                              
                            <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php
                                
                                $records_per_page = 10;
                                $current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                                $start = ($current_page - 1) * $records_per_page;
                                $total_rows = 0;
                                
                                  include 'connect.php';                                        
                                  $sql = "SELECT COUNT(*) as total FROM cost";
                                  $result = $dbconnection->query($sql);
                                  $row = $result->fetch_assoc();
                                  $total_rows = $row['total'];
                                  $total_pages = ceil($total_rows / $records_per_page);   
                                   
                                  $sql = "SELECT c.costid, cg1.town as town1, cg2.town as town2, o.oname, c.cost FROM cost c, route r, operator o, cargate cg1, cargate cg2 WHERE c.rid=r.rid and c.oid=o.oid and cg1.cgid=r.source and cg2.cgid=r.destination ORDER BY costid LIMIT $start, $records_per_page";
                                  $result = $dbconnection->query($sql);                                
                                                            
                                                                
                               
                                    if ($result->num_rows > 0) {
                                        // Fetch data from each row
                                        while ($row = $result->fetch_assoc()) {
                                            $costid = $row["costid"];
                                            $src = $row["town1"];
                                            $desti=$row["town2"];
                                            $operator=$row["oname"];
                                            $cost=$row["cost"];
                                            
                                          ?>
                                          <tr class="first_row" >
                                          <!--<td><input type="checkbox" name="crow[]" class="check_box" id="select_row"></td>-->
                                          <td><?php  echo $costid; ?></td>
                                          <td><?php  echo $src; ?></td>
                                          <td><?php  echo $desti; ?></td>
                                          <td><?php  echo $operator; ?></td>
                                          <td><?php  echo $cost; ?></td>
                                         
                                          <td class="d-flex flex-row justify-content-center"> 
                                              <form action="admin_cost.php" method="post" class="d-flex flex-row justify-content-evenly">
                                              <input type="hidden" value="<?php echo $costid; ?>" name="action_id">
                                              <!--<button type="submit" class="action_btn" name="view_more"><i class="fa-solid fa-eye"></i></button>-->
                                              <button type="submit" class="action_btn" name="edit"> <i class="fa-solid fa-pen-to-square"></i></button>
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
                            <th>Cost Id</th>
                            <th>Source</th>
                            <th>Destination</th>
                            <th>Operator</th>
                            <th>Cost(MMK)</th>                              
                            <th>Action</th>
                           </tr>
                           </thead>
                           <tbody>
                            <?php  include 'connect.php';
                               $search = $_POST['search'];
                               $sql = "SELECT Distinct c.costid, cg1.town as town1, cg2.town as town2, o.oname, c.cost FROM cost c, route r, operator o, cargate cg1, cargate cg2 WHERE c.rid=r.rid and c.oid=o.oid and cg1.cgid=r.source and cg2.cgid=r.destination and (cg1.town LIKE '%$search%' OR cg2.town LIKE '%$search%' OR c.costid LIKE '%$search%' OR o.oname LIKE '%$search%' OR c.cost LIKE '$search%') ";
                               $result = $dbconnection->query($sql);
                               if ($result->num_rows > 0) {
                                // Fetch data from each row
                                while ($row = $result->fetch_assoc()) {
                                    $costid = $row["costid"];
                                    $src = $row["town1"];
                                    $desti=$row["town2"];
                                    $operator=$row["oname"];
                                    $cost=$row["cost"];
                                   
                                    
                        ?>
                                    <tr class="first_row" >                                    
                                    <td><?php  echo $costid; ?></td>
                                    <td><?php  echo $src; ?></td>
                                    <td><?php  echo $desti; ?></td>
                                    <td><?php  echo $operator; ?></td>
                                    <td><?php  echo $cost; ?></td>
                                    
                                                                    
                                    <td class="d-flex flex-row justify-content-center"> 
                                        <form action="admin_cost.php" method="post" class="d-flex flex-row justify-content-evenly">
                                        <input type="hidden" value="<?php echo $costid; ?>" name="action_id">
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
                          <form method="post" action="admin_cost.php" >
                            <button type="submit" style="margin: 10px 0px 30px 30px; background-color:#7895CB; border:none;" name="search_back" > <<< Back </button>
                          </form>

                          
                        <?php   
                          }

                          if (isset($_POST['search_back'])){
                             echo '<script> window.location("admin_cost.php")';
                          }  
                        
                        ?>

                        <?php function add_form($next_costid) { 
                                  include 'connect.php';
                                  $sqlr = "SELECT r.rid FROM route r";
                                  $sql_src= "SELECT DISTINCT cg.town FROM route r, cargate cg Where r.source=cg.cgid";
                                  $sql_desti= "SELECT DISTINCT cg.town FROM  route r, cargate cg Where r.destination=cg.cgid";
                                  $sql_op="SELECT DISTINCT oname FROM  operator";
                                  
                                  
                                  $resultr = $dbconnection->query($sqlr);  
                                  $result_src=$dbconnection->query($sql_src);
                                  $result_desti=$dbconnection->query($sql_desti);
                                  $result_operator=$dbconnection->query($sql_op);
                                  

                                  
                                                                     
                          ?>
                            <!-- add info from -->

                            <div class="add-on" id="add_info_show">
                                <h5>Add Bus Ticket Cost Information </h5>
                                

                                <form method="post" action="admin_cost.php">      
                                <table cellspacing="10px" border="0" class="add_table">
                                <tr>
                                    <td>Cost Id: </td>
                                    <td><input type="text" name="ncostid" value="<?php echo $next_costid; ?>" required> </td>
                                </tr>

                              
                                <tr>
                                    <td>Source: </td>
                                    <td>                                       
                                       <select name="nsrc" id="nsrc" size="1" required>
                                          <?php foreach ($result_src as $resultr1) {  ?>                                          
                                          <option value="<?php echo $resultr1["town"] ?>" ><?php echo $resultr1["town"] ?> </option>
                                         <?php } ?>
                                      </select> 
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td>Destination: </td>
                                    <td>
                                    <select name="ndesti" id="ndesti" size="1" required>
                                         <?php foreach ($result_desti as $resultr2) {  ?>                                          
                                          <option value="<?php echo $resultr2["town"] ?>" ><?php echo $resultr2["town"] ?> </option>
                                         <?php } ?>
                                    </select>                                   
                                    </td>                                    
                                </tr>
                                

                                <tr>
                                    <td>Operator: </td>
                                    <td>
                                      <select name="nop" id="op" size="1" required>
                                          <?php foreach ($result_operator as $resultr3) {  ?>                                          
                                            <option value="<?php echo $resultr3["oname"] ?>" ><?php echo $resultr3["oname"] ?> </option>
                                          <?php } ?>
                                      </select> 
                                    </td>                       
                              
                                </tr>

                                <tr>

                               
                                    <td>Cost </td>
                                    <td><input type="text" name="ncost" value="" required> </td>
                                </tr>

                                
                                
                                    <td> </td>                                      
                                    <td> </td>
                                </tr>
                                </table>
                                <a href="admin_cost.php" style="text-decoration:none;"><button type="button" class="back-btn" name="search_back"> <<< Back </button><a>
                                <button type="submit" name="add_btn" value="Add" class="btn_add" style="margin-bottom:40px;"> Add </button> </td>
                                </form>
                            </div>
                        <?php } ?>
            
                        <!-- edit info from -->
                        <?php function show_edit_form($ecostid, $esrc, $edesti, $eoperator, $ecost){ ?>
                        <!-- edit info from -->
                            <div class="add-on" id="add_info_show">
                                <h4>Edit Bus Ticket Cost Information </h4>
                                <div style="border-bottom:1px solid black">
                                </div>

                                <form method="post" action="admin_cost.php"  enctype="multipart/form-data">      
                                <table cellspacing="10px" border="0" class="add_table">
                                <tr>
                                    <td>Cost Id: <td>
                                    <td><input type="text" name="ocostid" value="<?php echo $ecostid; ?>" required> </td>
                                </tr>
                                <tr>
                                    <td>Source: <td>
                                    <td><input type="text" name="osrc" value="<?php echo $esrc; ?>" required readonly class="not_allow"> </td>
                                </tr>
                                
                                <tr>
                                    <td>Destination: <td>
                                    <td><input type="text" name="odesti" value="<?php echo $edesti; ?>" required readonly class="not_allow"> </td>
                                </tr>
                                <tr>
                                    <td>Operator: <td>
                                    <td><input type="text" name="ooperator" value="<?php echo $eoperator; ?>" required readonly class="not_allow"> </td>
                                </tr>
                                <tr>
                                    <td>Cost: <td>
                                    <td><input type="text" name="ocost" value="<?php echo $ecost; ?>" required> </td>
                                </tr>
                                
                                <tr>
                                    <td> </td>
                                    <td> </td>
                                </tr>
                                </table>
                                <a href="admin_cost.php" style="text-decoration:none;"><button type="button" class="back-btn" name="search_back"> <<< Back </button><a>
                                <input type="hidden" name="previous_edit_id" value="<?php echo $ecostid; ?>">
                                <button type="submit" name="edit_btn" value="Edit" class="btn_add" style="margin-bottom:40px;">Save</button> </td>
                                </form>
                            </div>
                        <?php } ?>

                        <!-- when adding form fail -->
                        <?php function show_add_again($nncostid, $nnsrc, $nndesti, $nnoperator, $nncost) { 
                                  include 'connect.php';
                                  $sqlr = "SELECT r.rid FROM route r";
                                  $sql_src= " SELECT DISTINCT cg.town FROM route r, cargate cg Where r.source=cg.cgid";
                                  $sql_desti= " SELECT DISTINCT cg.town FROM route r, cargate cg Where r.destination=cg.cgid";
                                  $sql_op="SELECT DISTINCT oname FROM  operator";
                                  //$sql_bus="SELECT DISTINCT busno FROM  bus b, operator o where b.oid=o.oid and o.oname=$_POST('op')";
                                  
                                  $resultr = $dbconnection->query($sqlr);  
                                  $result_src=$dbconnection->query($sql_src);
                                  $result_desti=$dbconnection->query($sql_desti);
                                  $result_operator=$dbconnection->query($sql_op);
                                  //$resultb=$dbconnection->query($sql_bus);


                                  
                                                                     
                          ?>
                            <!-- add info from -->

                            <div class="add-on" id="add_info_show">
                                <h5>Add Bus Ticket Cost Information </h5>
                                

                                <form method="post" action="admin_cost.php">      
                                <table cellspacing="10px" border="0" class="add_table">
                                <tr>
                                    <td>Cost Id: </td>
                                    <td><input type="text" name="ncostid" value="<?php echo $nncostid; ?>" required> </td>
                                </tr>

                              
                                <tr>
                                    <td>Source: </td>
                                    <td>                                       
                                    <select name="nsrc" id="nsrc" size="1" required>
                                      <?php foreach ($result_src as $resultr1) {  ?>
                                      <option value="<?php echo $resultr1["town"] ?>" <?php if ($resultr1["town"] == $nnsrc) { echo 'selected'; } ?> ><?php echo $resultr1["town"] ?> </option>
                                      <?php } ?>
                                    </select>
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td>Destination: </td>
                                    <td>
                                    <select name="ndesti" id="ndesti" size="1" required>
                                         <?php foreach ($result_desti as $resultr2) {  ?>                                          
                                          <option value="<?php echo $resultr2["town"] ?>" <?php if ($resultr2["town"] == $nndesti) { echo 'selected'; } ?> ><?php echo $resultr2["town"] ?> </option>
                                         <?php } ?>
                                    </select>                                   
                                    </td>                                    
                                </tr>
                                

                                <tr>
                                    <td>Operator: </td>
                                    <td>
                                      <select name="nop" id="op" size="1" value="<?php echo $nnoperator; ?>" required>
                                          <?php foreach ($result_operator as $resultr3) {  ?>                                          
                                            <option value="<?php echo $resultr3["oname"] ?>" <?php if ($resultr3["oname"] == $nnoperator) { echo 'selected'; } ?>><?php echo $resultr3["oname"] ?> </option>
                                          <?php } ?>
                                      </select> 
                                    </td>                       
                              
                                </tr>

                                <tr>

                               
                                    <td>Cost </td>
                                    <td><input type="text" name="ncost" value="<?php echo $nncost; ?>" required> </td>
                                </tr>

                                
                                
                                    <td> </td>                                      
                                    <td> </td>
                                </tr>
                                </table>
                                <a href="admin_cost.php" style="text-decoration:none;"><button type="button" class="back-btn" name="search_back"> <<< Back </button><a>
                                <button type="submit" name="add_btn" value="Add" class="btn_add" style="margin-bottom:40px;"> Add </button> </td>
                                </form>
                            </div>
                        <?php } ?>


                        
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


function getNextCostId() {
    global $conn; 

    try {
        
        $sql2 = "SELECT MAX(costid) AS max_costid FROM cost";
        $stmt2 = $conn->prepare($sql2);
        $stmt2->execute();
        
        
        $result2 = $stmt2->fetch(PDO::FETCH_ASSOC);

       
        if ($result2['max_costid'] === null) {
            return 1;
        } else {
            
            return $result2['max_costid'] + 1;
        }
    } catch (PDOException $e) {
        
        echo "Error: " . $e->getMessage();
        return null;
    }
}
?>  
  
 
</html>


