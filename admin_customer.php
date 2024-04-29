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
  
    $d_cid = $_POST["action_id"];
    $dquery=$dbconnection->prepare("DELETE FROM customer WHERE cid=$d_cid");
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
		

                <li  class="active">
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
                    <h5>Manage Customer Information</h5>
                    <form method="post" action="admin_customer.php">
                        <!-- <button type="submit" name="addbtn" class="add_btn d-flex flex-row">
                          <i class="fa-solid fa-plus" style="color: #ffffff; margin-top:5px;"></i> Add New
                        </button> -->
                    </form>  
                  </div>
                  <div class="search_part" style="margin:20px; float:right;">
                      <form method="post" action="admin_customer.php">
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
                                {   $next_cid = getNextCustomerId(); // Assuming there's a function to get the next available customer ID
                                    add_form($next_cid);
                                }
                                else if(isset($_POST['edit']))
                                {
                                    $e_cid = $_POST['action_id'];
                                    //echo $e_cid;
                                    $edit_row_query= "SELECT * FROM customer WHERE cid = $e_cid";
                                    $erow=$dbconnection->query($edit_row_query);
                                    $ecid=$e_cid;
                                    while($edit_row = $erow->fetch_assoc())
                                    {
                                      $ename=$edit_row["name"];
                                      $eemail=$edit_row["email"];
                                      $epassword=$edit_row["password"];
                                      $epic=$edit_row["photo"];

                                      show_edit_form($e_cid,$ename,$eemail,$epassword);
                                    }
                                }
                                else if(isset($_POST['search_bt']))
                                {
                                  $search = $_POST['search'];
                                  $sql = "SELECT * FROM customer WHERE name LIKE '%$search%' OR email LIKE '%$search%'";
                                  $result = $dbconnection->query($sql);
                                   search_show();
                                }
                           
                              } else if( (!isset($_POST['add_btn'])) && ( !isset($_POST['edit_btn'])) ){
                                display_table();
                              }  
                            
                            
                              if (isset($_POST["edit_btn"]))
                              {
                                $oid=$_POST["oid"];
                                $ocname=$_POST["ocname"];
                                $oemail=$_POST["oemail"];
                                $opw=$_POST["opw"];
                                $opw2=$_POST["opw2"];
                                
                                $prev_id=$_POST["previous_edit_id"];
                                //$x = ($oid == $prev_id) ? "true" : "false" ;
                                echo "<script> window.alert($prev_id);</script>";
                                echo "<script> window.alert($oid);</script>"; 
                                //echo "<script> window.alert($x);</script>"; 
                                $x = ($oid == $prev_id) ? "true" : "false" ;
                                if ($opw == $opw2) {
                                
                                  try {
                                      if($oid == $prev_id){

                                        $sql = 'UPDATE customer SET name =:name, email =:email, password =:password WHERE cid = :cid';
                                        $st=$conn->prepare($sql);
                                        $st-> bindValue( ":cid", $oid, PDO::PARAM_INT );
                                        $st-> bindValue( ":name", $ocname, PDO::PARAM_STR);
                                        $st-> bindValue( ":email", $oemail, PDO::PARAM_STR);
                                        $st-> bindValue( ":password", $opw, PDO::PARAM_STR);                                         
                                        $st->execute();  
                                        display_table();


                                      }else {
                                      // Check if the oid exists in the cost table
                                      $check_cid = "SELECT * FROM customer WHERE cid=?";
                                      $stmt_check_cid = $dbconnection->prepare($check_cid);
                                      $stmt_check_cid->bind_param("i", $oid);
                                      $stmt_check_cid->execute();
                                      $result_check_cid = $stmt_check_cid->get_result();
                                  
                                      if ($result_check_cid->num_rows > 0 && $x="false") {
                                        show_edit_form($oid,$ocname,$oemail,$opw);
                                        echo "<script>window.alert('The cid already exists in the table. Please enter a different cid.'); </script>";                                                      
                                      }
                                  
                                      else{
                                        echo "<script> window.alert('update');</script>"; 
                                        // Prepare the UPDATE statement
                                        $sql = 'UPDATE customer SET cid=:cid, name =:name, email =:email, password =:password WHERE cid = :prev_id';
                                        $st=$conn->prepare($sql);
                                        $st-> bindValue( ":cid", $oid, PDO::PARAM_INT );
                                        $st-> bindValue( ":name", $ocname, PDO::PARAM_STR);
                                        $st-> bindValue( ":email", $oemail, PDO::PARAM_STR);
                                        $st-> bindValue( ":password", $opw, PDO::PARAM_STR);
                                        $st-> bindValue( ":prev_id", $prev_id, PDO::PARAM_INT );
                                        $st->execute();  
                                        display_table();
                                      
                                        
                                      }
                                      } //else {
                                    //  display_table();
                                    //}
                                  } catch ( PDOException $e ) {
                                    echo "Query failed: " . $e-> getMessage();
                                    display_table();
                                  }
                                } else {
                                  echo '<script> window.alert("Password not match!!!");</script>';
                                  
                                  show_edit_form($oid,$ocname,$oemail,$opw);
                                }
                                          
                              }        
                            
                            if (isset($_POST["add_btn"]))
                              {
                                 
                                            $ncid = $_POST["ncid"];
                                            $ncname=$_POST["ncname"];
                                            $nemail=$_POST["nemail"];
                                            $npw1=$_POST["npw"];
                                            $npw2=$_POST["npw2"];
                                            
                                            if ($npw1 == $npw2) {
                                              try {


                                                $check_cid = "SELECT * FROM customer WHERE cid=?";
                                                $stmt_check_cid = $dbconnection->prepare($check_cid);
                                                $stmt_check_cid->bind_param("i", $ncid);
                                                $stmt_check_cid->execute();
                                                $result_check_cid = $stmt_check_cid->get_result();

                                                if ($result_check_cid->num_rows > 0) {
                                                      show_add_again($ncid,$ncname,$nemail,$npw1);
                                                      echo "<script>window.alert('The cid already exists in the table. Please enter a different cid.'); </script>";                                                      
                                                } else {
                                                
                                                  $add_query = 'INSERT INTO customer(cid,name,email,password) VALUES (:cid, :name, :email, :password)  ';
                                                  $sta=$conn->prepare($add_query);
                                                  $sta-> bindValue( ":cid", $ncid, PDO::PARAM_INT );
                                                  $sta-> bindValue( ":name", $ncname, PDO::PARAM_STR);
                                                  $sta-> bindValue( ":email", $nemail, PDO::PARAM_STR);
                                                  $sta-> bindValue( ":password", $npw1, PDO::PARAM_STR);
                                                  $sta->execute();
                                                  display_table();
                                                }
                                              } catch ( PDOException $e ) {
                                                echo "Query failed: " . $e-> getMessage();
                                              }
                                              } else {
                                                show_add_again($ncid,$ncname,$nemail,$npw1);
                                                echo '<script> window.alert("Password not match!!!");</script>';
                                                
                                              }
                               }

                               
                




                        ?>
                        <?php function display_table(){ ?>
                         <table class="table" cellspacing="5px" border="0"  id="table_part">
                            <thead>
                            <tr>
                            <!--<th><input type="checkbox" name="hchc[]" class="check_box"></th>-->
                            <th>Id</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Password</th>
                            <th>Pic</th>
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
                                  $sql = "SELECT COUNT(*) as total FROM customer";
                                  $result = $dbconnection->query($sql);
                                  $row = $result->fetch_assoc();
                                  $total_rows = $row['total'];
                                  $total_pages = ceil($total_rows / $records_per_page);   
                                   
                                  $sql = "SELECT * FROM customer LIMIT $start, $records_per_page";
                                  $result = $dbconnection->query($sql);                                
                                                            
                                                                
                               
                                    if ($result->num_rows > 0) {
                                        // Fetch data from each row
                                        while ($row = $result->fetch_assoc()) {
                                            $cid = $row["cid"];
                                            $cname = $row["name"];
                                            $email=$row["email"];
                                            $password=$row["password"];
                                            $hashpw=password_hash($password,PASSWORD_DEFAULT);

                                            if ($row["photo"] == NULL)
                                                {$profile_pic= "images\user\df_user.png";}
                                            else
                                                {$profile_pic= $row["photo"]; }
                                          ?>
                                          <tr class="first_row" >
                                          <!--<td><input type="checkbox" name="crow[]" class="check_box" id="select_row"></td>-->
                                          <td><?php  echo $cid; ?></td>
                                          <td><?php  echo $cname; ?></td>
                                          <td><?php  echo $email; ?></td>
                                          <td><?php  echo $hashpw; ?></td>
                                          <td><img src='images\user\<?php echo $profile_pic ?>' height="30px" width="30px" alt="User" class="user_profile"></td>
                                          <td class="d-flex flex-row justify-content-center"> 
                                              <form action="admin_customer.php" method="post" class="d-flex flex-row justify-content-evenly">
                                              <input type="hidden" value="<?php echo $cid; ?>" name="action_id">
                                              <!--<button type="submit" class="action_btn" name="view_more"><i class="fa-solid fa-eye"></i></button>-->
                                              <!-- <button type="submit" class="action_btn" name="edit"> <i class="fa-solid fa-pen-to-square"></i></button> -->
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
                           <th>Id</th>
                           <th>Name</th>
                           <th>Email</th>
                           <th>Password</th>
                           <th>Pic</th>
                           <th>Action</th>
                           </tr>
                           </thead>
                           <tbody>
                            <?php  include 'connect.php';
                               $search = $_POST['search'];
                               $sql = "SELECT * FROM customer WHERE name LIKE '%$search%' OR email LIKE '%$search%' OR cid LIKE '%$search%'";
                               $result = $dbconnection->query($sql);
                               if ($result->num_rows > 0) {
                                // Fetch data from each row
                                while ($row = $result->fetch_assoc()) {
                                    $cid = $row["cid"];
                                    $cname = $row["name"];
                                    $email=$row["email"];
                                    $password=$row["password"];
                                  $hashpw=password_hash($password,PASSWORD_DEFAULT);
                                    if ($row["photo"] == NULL)
                                        {$profile_pic= "images/user/df_user.png";}
                                    else
                                        {$profile_pic= $row["photo"]; }
                        ?>
                                  <tr class="first_row" >
                                  <!--<td><input type="checkbox" name="crow[]" class="check_box" id="select_row"></td>-->
                                  <td><?php  echo $cid; ?></td>
                                  <td><?php  echo $cname; ?></td>
                                  <td><?php  echo $email; ?></td>
                                  <td><?php  echo $hashpw; ?></td>
                                  <td><img src='<?php echo $profile_pic ?>' height="30px" width="30px" alt="User" class="user_profile"></td>
                                  <td class="d-flex flex-row justify-content-center"> 
                                      <form action="admin_customer.php" method="post" class="d-flex flex-row justify-content-evenly">
                                      <input type="hidden" value="<?php echo $cid; ?>" name="action_id">
                                      <!--<button type="submit" class="action_btn" name="view_more"><i class="fa-solid fa-eye"></i></button> -->
                                      <button type="submit" class="action_btn" name="edit"> <i class="fa-solid fa-pen-to-square"></i></button>
                                      <button type="submit" class="action_btn" name="delete" onclick="return Dconfirm()"> <i class="fa-solid fa-trash"></i> </button> 
                                      </form>
                                  </td>
                                  
                                  </tr>
                              
                                  <?php  }
                                
                              } else {
                                    echo "No data found";
                              }
                        
                            //delete
                            /*
                            if (isset($_POST["delete"]))
                          {
                              

                              echo "<script> var x = window.confirm('Do you want to delete?') ; 
                              if (x == true){";
                              
                                $d_cid = $_POST["action_id"];
                                
                                
                                $dquery=$dbconnection->prepare("DELETE FROM customer WHERE cid=$d_cid");

                                $dquery->execute();  
                                
                                
                              echo '  } else if (x == false) { } </script>';

                              
                                
                          }   */
                          
                         ?>
                       
            
        
                          </tbody>
                          </table>
                          <form method="post" action="admin_customer.php" >
                            <button type="submit" style="margin: 10px 0px 30px 30px; background-color:#7895CB; border:none;" name="search_back" > <<< Back </button>
                          </form>

                          
                        <?php 
                          }

                          if (isset($_POST['search_back'])){
                             echo '<script> window.location("admin_customer.php")';
                          } 
                        
                        ?>

                        <?php function add_form($next_cid) { ?>
                        <!-- add info from -->
                            <div class="add-on" id="add_info_show">
                                <h5>Add Customer Information </h5>
                                

                                <form method="post" action="admin_customer.php">      
                                <table cellspacing="10px" border="0" class="add_table">
                                <tr>
                                    <td>Customer Id: <td>
                                    <td><input type="text" name="ncid" value="<?php echo $next_cid; ?>" required> </td>
                                </tr>
                                <tr>
                                    <td>Name: <td>
                                    <td><input type="text" name="ncname" value="" required> </td>
                                </tr>
                                
                                <tr>
                                    <td>Email: <td>
                                    <td><input type="email" name="nemail" value="" required> </td>
                                </tr>
                                <tr>
                                    <td>Password: <td>
                                    <td><input type="password" name="npw" value="" required> </td>
                                </tr>
                                <tr>
                                    <td>Confirm Password: <td>
                                    <td><input type="password" name="npw2" value="" required> </td>
                                </tr>
                                <!--<tr>
                                    <td>Profile Pic: <td>
                                    <td><input type="file" name="npc_file" value=""> </td>
                                </tr>
                                <tr>-->
                                    <td> </td>
                                    <td> </td>
                                </tr>
                                </table>
                                <a href="admin_customer.php" style="text-decoration:none;"><button type="button" class="back-btn" name="search_back"> <<< Back </button><a>
                                <button type="submit" name="add_btn" value="Add" class="btn_add" style="margin-bottom:40px;"> Add </button> </td>
                                </form>
                            </div>
                        <?php } ?>
            

            
                        <?php function show_edit_form($eid, $ename, $eemail, $epassword){ ?>
                        <!-- edit info from -->
                            <div class="add-on" id="add_info_show">
                                <h4>Edit Customer Information </h4>
                                <div style="border-bottom:1px solid black">
                                </div>

                                <form method="post" action="admin_customer.php"  enctype="multipart/form-data">      
                                <table cellspacing="10px" border="0" class="add_table">
                                <tr>
                                    <td>Customer Id: <td>
                                    <td><input type="text" name="oid" value="<?php echo $eid; ?>" required> </td>
                                </tr>
                                <tr>
                                    <td>Name: <td>
                                    <td><input type="text" name="ocname" value="<?php echo $ename; ?>" required> </td>
                                </tr>
                                
                                <tr>
                                    <td>Email: <td>
                                    <td><input type="email" name="oemail" value="<?php echo $eemail; ?>" required> </td>
                                </tr>
                                <tr>
                                    <td>Password: <td>
                                    <td><input type="password" name="opw" value="<?php echo $epassword; ?>" required> </td>
                                </tr>
                                <tr>
                                    <td>Confirm Password: <td>
                                    <td><input type="password" name="opw2" value="<?php echo $epassword; ?>" required> </td>
                                </tr>
                                <!--<tr>
                                    <td>Profile Pic: <td>
                                    <td><input type="file" name="opc_file" value="<?php echo $epic; ?>"> </td>
                                </tr> -->
                                <tr>
                                    <td> </td>
                                    <td> </td>
                                </tr>
                                </table>
                                <a href="admin_customer.php" style="text-decoration:none;"><button type="button" class="back-btn" name="search_back"> <<< Back </button><a>
                                <input type="hidden" name="previous_edit_id" value="<?php echo $eid; ?>">
                                <button type="submit" name="edit_btn" value="Edit" class="btn_add" style="margin-bottom:40px;">Save Changes</button> </td>
                                </form>
                            </div>
                        <?php } ?>


                        <?php function show_add_again($nnid, $nnname, $nnemail, $nnpassword1) { ?>
                        <!-- add info from -->
                            <div class="add-on" id="add_info_show">
                                <h5>Add Customer Information </h5>
                                

                                <form method="post" action="admin_customer.php">      
                                <table cellspacing="10px" border="0" class="add_table">
                                <tr>
                                    <td>Customer Id: <td>
                                    <td><input type="text" name="ncid" value="<?php echo $nnid; ?>" required> </td>
                                </tr>
                                <tr>
                                    <td>Name: <td>
                                    <td><input type="text" name="ncname" value="<?php echo $nnname; ?>" required> </td>
                                </tr>
                                
                                <tr>
                                    <td>Email: <td>
                                    <td><input type="email" name="nemail" value="<?php echo $nnemail; ?>" required> </td>
                                </tr>
                                <tr>
                                    <td>Password: <td>
                                    <td><input type="password" name="npw" value="<?php echo $nnpassword1; ?>" required> </td>
                                </tr>
                                <tr>
                                    <td>Confirm Password: <td>
                                    <td><input type="password" name="npw2" value="" required> </td>
                                </tr>
                                <!--<tr>
                                    <td>Profile Pic: <td>
                                    <td><input type="file" name="npc_file" value=""> </td>
                                </tr>
                                <tr>-->
                                    <td> </td>
                                    <td> </td>
                                </tr>
                                </table>
                                <a href="admin_customer.php" style="text-decoration:none;"><button type="button" class="back-btn" name="search_back"> <<< Back </button><a>
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
  <?php


function getNextCustomerId() {
    global $conn; 

    try {
        
        $sql2 = "SELECT MAX(cid) AS max_cid FROM customer";
        $stmt2 = $conn->prepare($sql2);
        $stmt2->execute();
        
        
        $result2 = $stmt2->fetch(PDO::FETCH_ASSOC);

       
        if ($result2['max_cid'] === null) {
            return 1;
        } else {
            
            return $result2['max_cid'] + 1;
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


