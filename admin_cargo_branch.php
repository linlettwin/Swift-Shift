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
				height:30px;
				margin-top:30px;
	  }
    </style>

  </head>

  <?php 
  include 'connect.php';
  if (isset($_POST["delete"]))
 { 
  
    $c_bname = $_POST["action_id"];
    $dquery=$dbconnection->prepare("DELETE FROM cargo_branch WHERE branch_name='$c_bname'");
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
      <li  class="active">
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
                    <h5>Manage Cargo Information</h5>
                    <form method="post" action="admin_cargo_branch.php">
                        <button type="submit" name="addbtn" class="add_btn d-flex flex-row">
                          <i class="fa-solid fa-plus" style="color: #ffffff; margin-top:5px;margin-right:10px;"></i> Add
                        </button>
                    </form>  
                  </div>
                  <div class="search_part" style="margin:20px; float:right;">
                      <form method="post" action="admin_cargo_branch.php">
                        <input type="text" placeholder="Search.." name="search">
                        <button type="submit" name="search_bt" class="search"><i class="fa fa-search"></i></button>
                      </form>
                  </div>
            <div>
				    <div class="table-wrapper" style="background-color:#E7EEF4;">
              <div class="whole" style="background-color:#E7EEF4;">
                
                  <div class="display-info ">
                    <?php
                        if (isset($_POST['addbtn']) || isset($_POST['edit']) || isset($_POST['search_bt'])) {
                          if(isset($_POST['addbtn']))
                          { 
                            add_form();
                          }
                          
                         
                          else if(isset($_POST['edit']))
                          {
                            $e_bname = $_POST['action_id'];
                            //echo $e_aid;
                            $edit_row_query= "SELECT * FROM cargo_branch WHERE branch_name = '$e_bname'";
                            $erow=$dbconnection->query($edit_row_query);
                            $ebname=$e_bname;
                            while($edit_row = $erow->fetch_assoc()){
                            $ebname=$edit_row["branch_name"];
                            $edivision=$edit_row["division"];
                            $ebphone=$edit_row["branch_phone"];
                            $ebadd=$edit_row["branch_address"];
                           
                            show_edit_form($ebname,$edivision,$ebphone,$ebadd);
                          }
                        }
                        else if (isset($_POST['search_bt'])) {
                          $search = $_POST['search'];
                          $sql = "SELECT * FROM cargo_branch WHERE branch_name LIKE '%$search%' OR division LIKE '%$search%' OR branch_phone LIKE '%$search%' OR branch_address LIKE '%$search%'";
                          $result = $dbconnection->query($sql);
                          search_show();
                        }
                        } else if( (!isset($_POST['add_btn'])) && ( !isset($_POST['edit_btn'])) ) {
                          display_table();
                        }    
                        if (isset($_POST["edit_btn"]))
                        {
               
                          $cbname=$_POST["cbname"];
                          $division=$_POST["division"];
                          $cbphone=$_POST["cbphone"];
                          $cbadd=$_POST["cbadd"];
                          
                          $prev_name=$_POST["previous_edit_name"];
                          echo "<script> window.alert($prev_name);</script>";
                          echo "<script> window.alert($cbname);</script>"; 
                          $x = ($cbname == $prev_name) ? "true" : "false" ;
                          
              
                            try {
                              //Prepare the UPDATE statement
                              if($cbname == $prev_name){
                              $sql = 'UPDATE cargo_branch SET branch_name =:branch_name, division =:division, branch_phone =:branch_phone ,branch_address=:branch_address WHERE branch_name = :branch_name';
                            $st=$conn->prepare($sql);
                            $st-> bindValue( ":branch_name", $cbname, PDO::PARAM_STR );
                            $st-> bindValue( ":division", $division, PDO::PARAM_STR);
                            $st-> bindValue( ":branch_phone", $cbphone, PDO::PARAM_STR);
                            $st-> bindValue( ":branch_address", $cbadd, PDO::PARAM_STR);
                            
                            $st->execute();
                            display_table();
                            } else {
                              $check_cbname = "SELECT * FROM cargo_branch WHERE branch_name=?";
                                      $stmt_check_cbname= $dbconnection->prepare($check_cbname);
                                      $stmt_check_cbname->bind_param("s", $cbname);
                                      $stmt_check_cbname->execute();
                                      $result_check_cbname = $stmt_check_cbname->get_result();
                                  
                                      if ($result_check_cbname->num_rows > 0 && $x="false") {
                                        show_edit_form($cbname,$division,$cbphone,$cbadd);
                                        echo "<script>window.alert('The branch name already exists in the table. Please enter a different name.'); </script>";                                                      
                                      }
                                      else{
                                        echo "<script> window.alert('update');</script>"; 
                                        // Prepare the UPDATE statement
                                        $sql = 'UPDATE cargo_branch SET branch_name =:branch_name, division =:division, branch_phone =:branch_phone ,branch_address=:branch_address WHERE branch_name = :prev_name';
                                        $st=$conn->prepare($sql);
                                        $st-> bindValue( ":branch_name", $cbname, PDO::PARAM_STR );
                                        $st-> bindValue( ":division", $division, PDO::PARAM_STR);
                                        $st-> bindValue( ":branch_phone", $cbphone, PDO::PARAM_STR);
                                        $st-> bindValue( ":branch_address", $cbadd, PDO::PARAM_STR);
                                        $st-> bindValue( ":prev_name", $prev_name, PDO::PARAM_STR );
                                        $st->execute();
                                        display_table();
                            }
                          }    
                        } catch ( PDOException $e ) {
                          echo "Query failed: " . $e-> getMessage();
                          display_table();
                        }
                      } 
                    
                    if(isset($_POST["add_btn"]))
                          {
                            $cbname=$_POST["cbname"];
                            $division=$_POST["division"];
                            $cbphone=$_POST["cbphone"];
                            $cbadd=$_POST["cbadd"];

                                try {
                                    $check_cbname = "SELECT * FROM cargo_branch WHERE branch_name=?";
                                    $stmt_check_cbname= $dbconnection->prepare($check_cbname);
                                    $stmt_check_cbname->bind_param("s", $cbname);
                                    $stmt_check_cbname->execute();
                                    $result_check_cbname = $stmt_check_cbname->get_result();
                                
                                    if ($result_check_cbname->num_rows > 0 && $x="false") {
                                      show_add_again($cbname,$division,$cbphone,$cbadd);
                                      echo "<script>window.alert('The branch name already exists in the table. Please enter a different name.'); </script>";                                                      
                                    }
                                else {
                                            $add_query = 'INSERT INTO cargo_branch(branch_name,division,branch_phone,branch_address) VALUES (:branch_name,:division,:branch_phone,:branch_address)  ';
                                           $sta=$conn->prepare($add_query);
                                           $sta-> bindValue( ":branch_name", $cbname, PDO::PARAM_STR );
                                        $sta-> bindValue( ":division", $division, PDO::PARAM_STR);
                                            $sta-> bindValue( ":branch_phone", $cbphone, PDO::PARAM_STR);
                                            $sta-> bindValue( ":branch_address", $cbadd, PDO::PARAM_STR);
                                            $sta->execute();
                                           display_table();
                                        }
                                          } catch ( PDOException $e ) {
                                            echo "Query failed: " . $e-> getMessage();
                                          }
                                         
                                          } 
                          
            
                    ?>



                    <?php function display_table(){ ?>
                      <table class="table" cellspacing="5px" border="0"  id="table_part">
                        <thead>
                        <tr>
                          <!--<th><input type="checkbox" name="hchc[]" class="check_box"></th>-->
                          
                          <th>Branch Name</th>
                          <th>Division</th>
                          <th>Phone</th>
                          <th>Address</th>
                          
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
                                $sql = "SELECT COUNT(*) as total FROM cargo_branch";
                                $result = $dbconnection->query($sql);
                                $row = $result->fetch_assoc();
                                $total_rows = $row['total'];
                                $total_pages = ceil($total_rows / $records_per_page);   
                                 
                                $sql = "SELECT * FROM cargo_branch LIMIT $start, $records_per_page";
                                $result = $dbconnection->query($sql);

                             
                          
                              if ($result->num_rows > 0) {
                                  // Fetch data from each row
                                  while ($row = $result->fetch_assoc()) {
                                      $cbname = $row["branch_name"];
                                      $division = $row["division"];
                                      $cbphone=$row["branch_phone"];
                                      $cbadd=$row["branch_address"];
                                    
                            ?>
                            <tr class="first_row" >
                              <!--<td><input type="checkbox" name="crow[]" class="check_box" id="select_row"></td>-->
                              <td><?php  echo $cbname; ?></td>
                              <td><?php  echo $division; ?></td>
                              <td><?php  echo $cbphone; ?></td>
                              <td><?php  echo $cbadd; ?></td>
                              
                              <td class="d-flex flex-row justify-content-center">
                            
                                <form action="admin_cargo_branch.php" method="post" class="d-flex flex-row justify-content-evenly">
                                  <input type="hidden" value="<?php echo $cbname; ?>" name="action_id">
                                  <button type="submit" class="action_btn" name="edit"> <i class="fa-solid fa-pen-to-square"></i></button>
                                  <button type="submit" class="action_btn" name="delete"onclick="return Dconfirm()" > <i class="fa-solid fa-trash"></i> </button> 
                                </form>
                              </td>
                              
                            </tr>
                          
                            <?php }
                            } else {
                                      echo "No data found";
                            }
                          



                              //delete
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
                      <?php 
                          }?>
                  <?php function search_show() {  ?>
                           <table class="table" cellspacing="5px" border="0"  id="table_part">
                           <thead>
                           <tr>
                           <th>Branch Name</th>
                          <th>Division</th>
                          <th>Phone</th>
                          <th>Address</th>
                          
                          <th>Action</th>
                           </tr>
                           </thead>
                           <tbody>
                            <?php  include 'connect.php';
                               $search = $_POST['search'];
                               $sql = "SELECT * FROM cargo_branch WHERE branch_name LIKE '%$search%' OR division LIKE '%$search%' OR branch_phone LIKE '%$search%' OR branch_address LIKE '%$search%'";
                               $result = $dbconnection->query($sql);
                               if ($result->num_rows > 0) {
                                // Fetch data from each row
                                while ($row = $result->fetch_assoc()) {
                                    $cbname = $row["branch_name"];
                                    $division = $row["division"];
                                    $cbphone=$row["branch_phone"];
                                    $cbadd=$row["branch_address"];
                        ?>
                                  <tr class="first_row" >
                                  <!--<td><input type="checkbox" name="crow[]" class="check_box" id="select_row"></td>-->
                                  <td><?php  echo $cbname; ?></td>
                              <td><?php  echo $division; ?></td>
                              <td><?php  echo $cbphone; ?></td>
                              <td><?php  echo $cbadd; ?></td>
                              <td class="d-flex flex-row justify-content-center">
                            
                            <form action="admin_cargo_branch.php" method="post" class="d-flex flex-row justify-content-evenly">
                              <input type="hidden" value="<?php echo $cbname; ?>" name="action_id">
                              <button type="submit" class="action_btn" name="edit"> <i class="fa-solid fa-pen-to-square"></i></button>
                              <button type="submit" class="action_btn" name="delete"onclick="return Dconfirm()" > <i class="fa-solid fa-trash"></i> </button> 
                            </form>
                                  
                                  </tr>
                              
                                  <?php  }
                                
                              } else {
                                    echo "No data found";
                              }
                              ?>
                       
            
        
                              </tbody>
                              </table>
                              <form method="post" action="admin_cargo_branch.php" >
                                <button type="submit" style="margin: 10px 0px 30px 30px; background-color:#7895CB; border:none;" name="search_back" > <<< Back </button>
                              </form>
    
                              
                            <?php 
                              }
    
                              if (isset($_POST['search_back'])){
                                 echo '<script> window.location("admin_cargo_branch.php")';
                              } 
                            
                            ?>

          <?php function add_form(){ ?>
          <!-- add info from -->
            <div class="add-on" id="add_info_show">
                <h5>Add Cargo Information </h5>
                

                <form method="post" action="admin_cargo_branch.php"  enctype="multipart/form-data" >      
                <table cellspacing="10px" border="0" class="add_table">
                <tr>
                    <td>Branch name: <td>
                    <td><input type="text" name="cbname" value=""> </td>
                </tr>
                <tr>
                    <td>Division: <td>
                    <td><input type="text" name="division" value="" required> </td>
                </tr>
                
                <tr>
                    <td>Phone: <td>
                    <td><input type="text" name="cbphone" value="" required> </td>
                </tr>
                <tr>
                    <td>Address: <td>
                    <td><input type="text" name="cbadd" value="" required> </td>
                </tr>
                
                
                    <td> </td>
                    <td> </td>
                </tr>
                </table>
                <a href="admin_cargo_branch.php" style="text-decoration:none;"><button type="button" class="back-btn" name="search_back"> <<< Back </button><a>
                <button type="submit" name="add_btn" value="Add" class="btn_add" style="margin-bottom:40px;"> Add </button> </td>
                </form>
            </div>
          <?php } ?>
         

          
          <?php function show_edit_form($cbname,$division,$cbphone,$cbadd){ ?>
          <!-- edit info from -->
            <div class="add-on" id="add_info_show">
                <h4>Edit Cargo Information </h4>
                <div style="border-bottom:1px solid black">
                </div>

                <form method="post" action="admin_cargo_branch.php"  enctype="multipart/form-data" >      
                <table cellspacing="10px" border="0" class="add_table">
                <tr>
                    <td>Branch Name: <td>
                    <td><input type="text" name="cbname" value="<?php echo $cbname; ?>"> </td>
                </tr>
                <tr>
                    <td>Division: <td>
                    <td><input type="text" name="division" value="<?php echo $division; ?>"> </td>
                </tr>
                
                <tr>
                    <td>Phone: <td>
                    <td><input type="text" name="cbphone" value="<?php echo $cbphone; ?>"> </td>
                </tr>
                <tr>
                    <td>Address: <td>
                    <td><input type="text" name="cbadd" value="<?php echo $cbadd; ?>"> </td>
                </tr>
    
                <tr>
                    <td> </td>
                    <td> </td>
                </tr>
                </table>
                <a href="admin_cargo_branch.php" style="text-decoration:none;"><button type="button" class="back-btn" name="search_back"> <<< Back </button><a>
                <input type="hidden" name="previous_edit_name" value="<?php echo $cbname; ?>">
                <button type="submit" name="edit_btn" value="Edit" class="btn_add" style="margin-bottom:40px;">Save </button> </td>
                </form>
            </div>
          <?php } ?>
          <?php function show_add_again($cbname,$division,$cbphone,$cbadd) { ?>
                        <!-- add info from -->
                            <div class="add-on" id="add_info_show">
                                <h5>Add Cargo Information </h5>
                                

                                <form method="post" action="admin_cargo_branch.php">      
                                <table cellspacing="10px" border="0" class="add_table">
                                <<tr>
                    <td>Branch Name: <td>
                    <td><input type="text" name="aid" value="<?php echo $cbname; ?>"> </td>
                </tr>
                <tr>
                    <td>Division: <td>
                    <td><input type="text" name="aname" value="<?php echo $division; ?>"> </td>
                </tr>
                
                <tr>
                    <td>Phone: <td>
                    <td><input type="email" name="aemail" value="<?php echo $cbphone; ?>"> </td>
                </tr>
                <tr>
                    <td>Address: <td>
                    <td><input type="password" name="apw" value="<?php echo $cbadd; ?>"> </td>
                </tr>
                    <td> </td>
                    <td> </td>
                                </tr>
                                </table>
                                <a href="admin_cargo_branch.php" style="text-decoration:none;"><button type="button" class="back-btn" name="search_back"> <<< Back </button><a>
                                <input type="hidden" name="previous_edit_name" value="<?php echo $cbname; ?>">
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
  
</script>
  
 
  </html>


