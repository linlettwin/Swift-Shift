

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
  

  
 
              //}
              //else {
              //   echo "<script> window.alert ('Please fill the required field') </script>";}
          



      if (isset($_POST["delete"])) {
        
        $bno = $_POST["action_id"];
        $oid = $_POST["action_id2"];
    
        $dquery = $dbconnection->prepare("DELETE FROM bus WHERE busno='$bno' and oid=$oid");
         //$dquery->bindValue(":busno", $bno, PDO::PARAM_STR);
         //$dquery->bindValue(":oid", $oid, PDO::PARAM_INT);
        $dquery->execute();
        //display_table();
    
       
    }
                                             
?>  
  <body>
  

<div class="wrapper">


        <div class="body-overlay"></div>
		
		<!-------------------------sidebar------------>
		     <!-- Sidebar  -->
        <!-------------------------sidebar------------>
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
				
              <li  class="active">
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
                    <h5>Manage Bus Information</h5>
                    <form method="post" action="admin_bus.php">
                        <button type="submit" name="addbtn" class="add_btn d-flex flex-row">
                          <i class="fa-solid fa-plus" style="color: #ffffff; margin-top:5px;margin-right:10px;"></i> Add
                        </button>
                    </form>  
                  </div>
                  <div class="search_part" style="margin:20px; float:right;">
                      <form method="post" action="admin_bus.php">
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
                                {    // Assuming there's a function to get the next available customer ID
                                    add_form();
                                }
                           
                              
                         
                              else if(isset($_POST['edit'])) {
                                $e_bno = $_POST["action_id"];
                            
                                // Fetch bus details including operator ID
                                $edit_row_query = "SELECT * FROM bus WHERE busno = '$e_bno'";
                                $erow = $dbconnection->query($edit_row_query);
                            
                                if ($edit_row = $erow->fetch_assoc()) {
                                    $e_bno = $edit_row["busno"];
                                    $e_oid = $edit_row["oid"];
                                    $emaxp = $edit_row["maxpassenger"];
                                    $ebtype = $edit_row["bustype"];
                                    $ebcolor = $edit_row["buscolor"];
                            
                                    // Fetch operator name associated with the operator ID
                                    $operator_query = "SELECT oname FROM operator WHERE oid = '$e_oid'";
                                    $operator_result = $dbconnection->query($operator_query);
                                    if ($operator_row = $operator_result->fetch_assoc()) {
                                        $e_oname = $operator_row["oname"];
                                    } else {
                                        // Handle the case where operator name is not found
                                        $e_oname = "Operator Not Found";
                                    }
                            
                                    // Display the edit form with operator name instead of ID
                                    show_edit_form($e_bno, $e_oname, $emaxp, $ebtype, $ebcolor, $e_oid);
                                }
                            }
                            
                                else if(isset($_POST['search_bt']))
                                {
                                  $search = $_POST['search'];
                                  $sql = "SELECT * FROM bus WHERE busno LIKE '%$search%' OR bustype LIKE '%$search%'";
                                  $result = $dbconnection->query($sql);
                                   search_show();
                                 } 
                                }else if( (!isset($_POST['add_btn'])) && ( !isset($_POST['edit_btn'])) ) {
                                    display_table();
                                  }  
                                  if (isset($_POST["edit_btn"])) {
                                    $obno = $_POST["obno"];
                                    $operator_name = $_POST["operator_name"];
                                    $obmaxp = $_POST["obmaxp"];
                                    $obtype = $_POST["obtype"];
                                    $obcolor = $_POST["obcolor"];
                                    $prev_bno=$_POST["previous_edit_bno"];
                                    echo "<script> window.alert($prev_bno);</script>";
                                    echo "<script> window.alert($obno);</script>"; 
                                    $x = ($obno == $prev_bno) ? "true" : "false" ;
                                    $sql_operator_id = "SELECT oid FROM operator WHERE oname = :oname";
                                          $stmt_operator_id = $conn->prepare($sql_operator_id);
                                          $stmt_operator_id->bindValue(":oname", $operator_name, PDO::PARAM_STR);
                                          $stmt_operator_id->execute();
                                          $row_operator_id = $stmt_operator_id->fetch(PDO::FETCH_ASSOC);
                                          $ooid = $row_operator_id['oid'];
                                    try {
                                     
                                        
                                        
                                        if($obno == $prev_bno){
                                           
                                            $sql = "UPDATE bus SET oid = :oid, maxpassenger = :maxpassenger, bustype = :bustype, buscolor = :buscolor WHERE busno = :busno";
                                          $st=$conn->prepare($sql);
                                          $st-> bindValue( ":oid", $ooid, PDO::PARAM_INT );
                                          $st-> bindValue( ":busno", $obno, PDO::PARAM_STR);
                                          $st-> bindValue( ":maxpassenger", $obmaxp, PDO::PARAM_STR);
                                          $st-> bindValue( ":bustype", $obtype, PDO::PARAM_STR);
                                         
                                          $st-> bindValue( ":buscolor", $obcolor, PDO::PARAM_STR);
                                          $st->execute();
                                          display_table();
                                        }else{
                                            

                                            $check_bno = "SELECT * FROM bus WHERE busno=?";
                                          $stmt_check_bno = $dbconnection->prepare($check_bno);
                                          $stmt_check_bno->bind_param("s", $obno);
                                          $stmt_check_bno->execute();
                                          $result_check_bno = $stmt_check_bno->get_result();
                                        
                                       
                                          if ($result_check_bno->num_rows > 0 && $x="false") {
                                            show_edit_form($obno,$operator_name,$obmaxp,$obtype,$obcolor,$ooid);
                                            echo "<script>window.alert('The bus no already exists in the table. Please enter a different bus no.'); </script>";                                                      
                                          }
                                        
                                          else{
                                            echo "<script> window.alert('update');</script>"; 
                                           
                                           

                                        $sql_update = "UPDATE bus SET oid = :oid, maxpassenger = :maxpassenger, bustype = :bustype, buscolor = :buscolor,busno = :busno WHERE busno = :prev_bno";
                                        $stmt_update = $conn->prepare($sql_update);
                                        $stmt_update->bindValue(":oid", $ooid, PDO::PARAM_INT);
                                        $stmt_update->bindValue(":busno", $obno, PDO::PARAM_STR);
                                        $stmt_update->bindValue(":maxpassenger", $obmaxp, PDO::PARAM_STR);
                                        $stmt_update->bindValue(":bustype", $obtype, PDO::PARAM_STR);
                                        $stmt_update->bindValue(":buscolor", $obcolor, PDO::PARAM_STR);
                                        $stmt_update->bindValue(":prev_bno", $prev_bno, PDO::PARAM_STR);
                                        $stmt_update->execute();
                                        display_table();
                            }
                                          }
                                    } catch (PDOException $e) {
                                        echo "Query failed: " . $e->getMessage();
                                        display_table();
                                    }    
                                }
        
                            if(isset($_POST["add_btn"])) 
                            {
                                $oname = $_POST["operator_name"];
                                $bno = $_POST["bno"];
                                $maxp = $_POST["bmaxp"];
                                $btype = $_POST["btype"];
                                $bcolor = $_POST["bcolor"];
                            
                                try {
                                    $check_bno = "SELECT * FROM bus WHERE busno=?";
                                          $stmt_check_bno = $dbconnection->prepare($check_bno);
                                          $stmt_check_bno->bind_param("s", $bno);
                                          $stmt_check_bno->execute();
                                          $result_check_bno = $stmt_check_bno->get_result();
                                      
                                          if ($result_check_bno->num_rows > 0) {
                                            show_add_again($bno,$oname,$maxp,$btype,$bcolor);
                                            echo "<script>window.alert('The bus no already exists in the table. Please enter a different bus no.'); </script>";                                                      
                                          }
                                 
                                         else {

                                    // Fetch the operator ID based on the selected operator name
                                    $operator_query = 'SELECT oid FROM operator WHERE oname = :oname';
                                    $operator_statement = $conn->prepare($operator_query);
                                    $operator_statement->bindValue(":oname", $oname, PDO::PARAM_STR);
                                    $operator_statement->execute();
                                    $operator_row = $operator_statement->fetch(PDO::FETCH_ASSOC);
                                    $oid = $operator_row['oid'];
                            
                                    // Prepare the INSERT statement
                                    $add_query = 'INSERT INTO bus(busno, oid, maxpassenger, bustype, buscolor) VALUES (:busno, :oid, :maxpassenger, :bustype, :buscolor)';
                                    $sta = $conn->prepare($add_query);
                                    $sta->bindValue(":oid", $oid, PDO::PARAM_INT);
                                    $sta->bindValue(":busno", $bno, PDO::PARAM_STR);
                                    $sta->bindValue(":maxpassenger", $maxp, PDO::PARAM_STR);
                                    $sta->bindValue(":bustype", $btype, PDO::PARAM_STR);
                                    $sta->bindValue(":buscolor", $bcolor, PDO::PARAM_STR);
                            
                                    // Execute the INSERT statement
                                    $sta->execute();
                                    display_table();
                                }
                             } catch (PDOException $e) {
                                    echo "Query failed: " . $e->getMessage();
                                }
                                // Display the updated table
                            }
                            
                
                        ?>
                          
            
                          <?php
function display_table()
{
?>
    <table class="table" cellspacing="5px" border="0" id="table_part">
        <thead>
            <tr>
                <th>Bus No</th>
                <th>Operator Name</th>
                <th>Max passenger</th>
                <th>Bus Type</th>
                <th>Bus Color</th>
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

            $sql = "SELECT COUNT(*) as total FROM bus";
            $result = $dbconnection->query($sql);
            $row = $result->fetch_assoc();
            $total_rows = $row['total'];
            $total_pages = ceil($total_rows / $records_per_page);

            $sql = "SELECT b.busno,b.oid, o.oname, b.maxpassenger, b.bustype, b.buscolor FROM bus b INNER JOIN operator o ON b.oid = o.oid LIMIT $start, $records_per_page";
            $result = $dbconnection->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $bno = $row["busno"];
                    $oname = $row["oname"];
                    $bmax = $row["maxpassenger"];
                    $btype = $row["bustype"];
                    $bcolor = $row["buscolor"];
                    $oid= $row["oid"];
            ?>
                    <tr class="first_row">
                        <td><?php echo $bno; ?></td>
                        <td><?php echo $oname; ?></td>
                        <td><?php echo $bmax; ?></td>
                        <td><?php echo $btype; ?></td>
                        <td><?php echo $bcolor; ?></td>
                        <td class="d-flex flex-row justify-content-center">
                            <form action="admin_bus.php" method="post" class="d-flex flex-row justify-content-evenly">
                                <input type="hidden" value="<?php echo $bno; ?>" name="action_id">
                                <input type="hidden" value="<?php echo $oid; ?>" name="action_id2">
                                <button type="submit" class="action_btn" name="view_more"><i class="fa-solid fa-eye"></i></button>
                                <button type="submit" class="action_btn" name="edit"> <i class="fa-solid fa-pen-to-square"></i></button>
                                <button type="submit" class="action_btn" name="delete" onclick="return Dconfirm()"> <i class="fa-solid fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
            <?php
                }
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
                <li class="page-item <?php if ($i == $current_page) {
                                            echo 'active';
                                        } ?>">
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
<?php
}
?>

                          
                          
<?php
function search_show()
{
?>
    <table class="table" cellspacing="5px" border="0" id="table_part">
        <thead>
            <tr>
                <!--<th><input type="checkbox" name="hchc[]" class="check_box"></th>-->
                <th>Bus No</th>
                <th>Operator Name</th>
                <th>Max passenger</th>
                <th>Bus Type</th>
                <th>Bus Color</th>

                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include 'connect.php';
            $search = $_POST['search'];
            $sql = "SELECT b.busno,b.oid, o.oname, b.maxpassenger, b.bustype, b.buscolor FROM bus b INNER JOIN operator o ON b.oid = o.oid WHERE b.busno LIKE '%$search%' OR o.oname LIKE '%$search%' OR b.bustype LIKE '%$search%' OR b.maxpassenger LIKE '%$search%' OR b.buscolor LIKE '%$search%'";
            $result = $dbconnection->query($sql);
            if ($result->num_rows > 0) {
                // Fetch data from each row
                while ($row = $result->fetch_assoc()) {
                    $bno = $row["busno"];
                    $oname = $row["oname"];
                    $bmax = $row["maxpassenger"];
                    $btype = $row["bustype"];
                    $bcolor = $row["buscolor"];
                    $oid= $row["oid"];
                    // if ($row["ophoto"] == NULL)
                    //     {$profile_pic= "images/user/df_user.png";}
                    // else
                    //     {$profile_pic= $row["ophoto"]; }
            ?>
                    <tr class="first_row">
                        <!--<td><input type="checkbox" name="crow[]" class="check_box" id="select_row"></td>-->
                        <td><?php echo $bno; ?></td>
                        <td><?php echo $oname; ?></td>
                        <td><?php echo $bmax; ?></td>
                        <td><?php echo $btype; ?></td>
                        <td><?php echo $bcolor; ?></td>
                        <!-- <td><img src='<?php echo $profile_pic ?>' height="30px" width="30px" alt="User" class="user_profile"></td> -->
                        <td class="d-flex flex-row justify-content-center">
                            <form action="admin_bus.php" method="post" class="d-flex flex-row justify-content-evenly">
                                <input type="hidden" value="<?php echo $bno; ?>" name="action_id">
                                <input type="hidden" value="<?php echo $oid; ?>" name="action_id2">
                                <button type="submit" class="action_btn" name="view_more"><i class="fa-solid fa-eye"></i></button>
                                <button type="submit" class="action_btn" name="edit"> <i class="fa-solid fa-pen-to-square"></i></button>
                                <button type="submit" class="action_btn" name="delete" onclick="return Dconfirm()"> <i class="fa-solid fa-trash"></i></button>
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
    <form method="post" action="admin_bus.php">
        <button type="submit" style="margin: 10px 0px 30px 30px; background-color:#7895CB; border:none;" name="search_back"> <<< Back </button>
    </form>

<?php
}

if (isset($_POST['search_back'])) {
    echo '<script> window.location("admin_bus.php")';
}
?>


<?php function add_form() { ?>
    <!-- add info from -->
    <div class="add-on" id="add_info_show">
        <h5>Add Bus Information </h5>
        <form method="post" action="admin_bus.php">      
            <table cellspacing="10px" border="0" class="add_table">
                <tr>
                    <td>Bus No: </td>
                    <td><input type="text" name="bno" value="" required></td>
                </tr>
                <tr>
                    <td>Max passenger: </td>
                    <td><input type="text" name="bmaxp" value="" required></td>
                </tr>
                <tr>
                    <td>Bus Type: </td>
                    <td><input type="text" name="btype" value="" required></td>
                </tr>
                <tr>
                    <td>Bus Color: </td>
                    <td><input type="text" name="bcolor" value="" required></td>
                </tr>
                <tr>
                    <td>Operator Name: </td>
                    <td>
                        <select name="operator_name" required>
                            <?php
                            include 'connect.php';
                            $sql = "SELECT oname FROM operator";
                            $result = $dbconnection->query($sql);
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<option value='" . $row['oname'] . "'>" . $row['oname'] . "</option>";
                                }
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                </tr>
            </table>
            <a href="admin_bus.php" style="text-decoration:none;"><button type="button" class="back-btn" name="search_back"> <<< Back </button></a>
            <button type="submit" name="add_btn" value="Add" class="btn_add" style="margin-bottom:40px;"> Add </button>
        </form>
    </div>
<?php } ?>

            

            
<?php function show_edit_form($e_bno, $e_oname, $emaxp, $ebtype, $ebcolor,$e_oid) { ?>
    <!-- edit info form -->
    <div class="add-on" id="add_info_show">
        <h4>Edit Bus Information </h4>
        <div style="border-bottom:1px solid black"></div>

        <form method="post" action="admin_bus.php" enctype="multipart/form-data">      
            <table cellspacing="10px" border="0" class="add_table">
                <tr>
                    <td>Bus No</td>
                    <td><input type="text" name="obno" value="<?php echo $e_bno; ?>" required></td>
                </tr>
                <tr>
                <td>Operator Name: </td>
                    <td>
                        <select name="operator_name" required value="<?php echo $e_oname; ?>">
                            <?php
                            include 'connect.php';
                            $sql = "SELECT oname FROM operator";
                            $result = $dbconnection->query($sql);
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<option value='" . $row['oname'] . "'>" . $row['oname'] . "</option>";
                                }
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Max passenger</td>
                    <td><input type="text" name="obmaxp" value="<?php echo $emaxp; ?>" required></td>
                </tr>
                <tr>
                    <td>Bus Type</td>
                    <td><input type="text" name="obtype" value="<?php echo $ebtype; ?>" required></td>
                </tr>
                <tr>
                    <td>Bus Color</td>
                    <td><input type="text" name="obcolor" value="<?php echo $ebcolor; ?>" required></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                </tr>
            </table>
            <a href="admin_bus.php" style="text-decoration:none;"><button type="button" class="back-btn" name="search_back"> <<< Back </button></a>
            <input type="hidden" name="previous_edit_bno" value="<?php echo $e_bno; ?>">
            
            <button type="submit" name="edit_btn" value="Edit" class="btn_add" style="margin-bottom:40px;">Save</button>
        </form>
    </div>
<?php } ?>

<?php function show_add_again($obno,$operator_name,$obmaxp,$obtype,$obcolor) { ?>
                        <!-- add info from -->
                        <div class="add-on" id="add_info_show">
        <h5>Add Bus Information </h5>
        <form method="post" action="admin_bus.php">      
            <table cellspacing="10px" border="0" class="add_table">
                <tr>
                    <td>Bus No: </td>
                    <td><input type="text" name="bno" value="<?php echo $obno; ?>" required></td>
                </tr>
                <tr>
                    <td>Max passenger: </td>
                    <td><input type="text" name="bmaxp" value="<?php echo $obmaxp; ?>" required></td>
                </tr>
                <tr>
                    <td>Bus Type: </td>
                    <td><input type="text" name="btype" value="<?php echo $obtype; ?>" required></td>
                </tr>
                <tr>
                    <td>Bus Color: </td>
                    <td><input type="text" name="bcolor" value="<?php echo $obcolor; ?>" required></td>
                </tr>
                <tr>
                    <td>Operator Name: </td>
                    <td>
                        <select name="operator_name" required>
                            <?php
                            include 'connect.php';
                            $sql = "SELECT oname FROM operator";
                            $result = $dbconnection->query($sql);
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<option value='" . $row['oname'] . "'>" . $row['oname'] . "</option>";
                                }
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                </tr>
            </table>
            <a href="admin_bus.php" style="text-decoration:none;"><button type="button" class="back-btn" name="search_back"> <<< Back </button></a>
            <button type="submit" name="add_btn" value="Add" class="btn_add" style="margin-bottom:40px;"> Add </button>
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



  </body>
  
 
  </html>


