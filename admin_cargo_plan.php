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
                             
     $d_truckno= $_POST["action_id"];                             
     $dquery=$dbconnection->prepare("DELETE FROM cargo_plan WHERE cpid='$d_truckno'");
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

      <li  class="active">
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
                    <h5>Manage Cargo Plan Information</h5>
                    <form method="post" action="admin_cargo_plan.php">
                        <button type="submit" name="addbtn" class="add_btn d-flex flex-row">
                          <i class="fa-solid fa-plus" style="color: #ffffff; margin-top:5px;margin-right:10px;"></i> Add
                        </button>
                    </form>  
                  </div>
                  <div class="search_part" style="margin:20px; float:right;">
                      <form method="post" action="admin_cargo_plan.php">
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
                                    $next_planid = getNextPlanNo(); // Assuming there's a function to get the next available customer ID
                                    add_form($next_planid);// Assuming there's a function to get the next available customer ID
                                   
                                }
                                else if(isset($_POST['edit']))
                                {
                                    $e_pid = $_POST['action_id'];
                                    //echo $e_pid;
                                    $edit_row_query= "SELECT p.cpid, r.cargo_src, r.cargo_dest, p.truckno, p.cpdate FROM cargo_plan p, cargo_route r WHERE p.crid=r.crid and p.cpid= $e_pid";
                                    $erow=$dbconnection->query($edit_row_query);
                                    $epid=$e_pid;
                                    while($edit_row = $erow->fetch_assoc())
                                    {
                                      $epid=$edit_row["cpid"];
                                      $esrc=$edit_row["cargo_src"];
                                      $edesti=$edit_row["cargo_dest"];
                                      $etruck=$edit_row["truckno"];
                                      $edate=$edit_row["cpdate"];    
                                    
                                                                                                                
                                    } 
                                    show_edit_form($epid,$esrc,$edesti,$etruck,$edate,$e_pid);
                                   
                                }
                                else if(isset($_POST['search_bt']))
                                {
                                  $search = $_POST['search'];
                                  $sql = "SELECT p.cpid, r.cargo_src, r.cargo_dest, p.truckno, p.cpdate FROM cargo_plan p, cargo_route r WHERE p.crid=r.crid and (p.cpid LIKE '$search' OR r.cargo_src LIKE '%$search%' OR p.truckno LIKE '$search%' OR r.cargo_dest LIKE '%$search%' OR p.cpdate LIKE '%[0-9]$search%' )";
                                  $result = $dbconnection->query($sql);
                                   search_show(); 
                                }
                                
                           
                            } else if( (!isset($_POST['add_btn'])) && ( !isset($_POST['edit_btn'])) ){
                             display_table();
                            }  


                            if (isset($_POST["add_btn"]))
                            {
                                
                                include 'connect.php';                                
                                $npid=$_POST["npid"];
                                $nsrc=$_POST["nsrc"];
                                $ndesti=$_POST["ndesti"];
                                $ntruck=$_POST["ntruck"];
                                $ndate=$_POST["ndate"];                           
                             
                                if($nsrc == $ndesti)
                                {
                                    echo "<script>window.alert('Source and Destination should not be the same.'); </script>";                                    
                                    show_add_again($npid, $nsrc, $ndesti, $ntruck, $ndate);
                                    exit;
                                    
                                }
                                else 
                                {
                                    $sr="SELECT crid FROM cargo_route WHERE cargo_src=? and cargo_dest=?";                                   
                                                                                                               
                                    $g_rid=$dbconnection->prepare($sr);
                                    $g_rid->bind_param("ss", $nsrc, $ndesti);
                                    $g_rid->execute();
                                    $g_rid_result = $g_rid->get_result();                                            
                                    $g_rid_row = $g_rid_result->fetch_assoc();

                                    if ( $g_rid_row > 0)
                                    {
                                      $g_rid = $g_rid_row["crid"];      //get rid
                                      //echo "<script>window.alert('$g_rid'); </script>"; 

                                                    $check_pid = "SELECT * FROM cargo_plan WHERE cpid=?";
                                                    $stmt_check_pid = $dbconnection->prepare($check_pid );
                                                    $stmt_check_pid->bind_param("i", $npid);
                                                    $stmt_check_pid->execute();
                                                    $result_check_pid = $stmt_check_pid->get_result();
        
                                                    if ($result_check_pid->num_rows > 0) {
                                                        
                                                        echo "<script>window.alert('The pid=$npid already exists in the table. Please enter a different plan id.'); </script>";
                                                        show_add_again($npid, $nsrc, $ndesti, $ntruck, $ndate);
                                                        exit;
                                                        
                                                    } else {

                                                        $sql_check = "SELECT * FROM cargo_plan WHERE crid = ? AND truckno = ? AND cpdate = ?";
                                                        $stmt_check = $dbconnection->prepare($sql_check);
                                                        $stmt_check->bind_param("iss", $g_rid, $ntruck, $ndate);
                                                        $stmt_check->execute();
                                                        $result_check = $stmt_check->get_result();
                                                        
                                                        if ($result_check->num_rows > 0) 
                                                        {                                              
                                                            echo "<script>window.alert('The combination of crid, truckno, and date already exists in the cargo_plan table. Please enter different values.'); </script>";
                                                            show_add_again($npid, $nsrc, $ndesti, $ntruck, $ndate);
                                                        }else 
                                                        {

                                                            try {
                                                                
                                                                
                                                                    //Prepare the INSERT statement
                                                                    $add_query = 'INSERT INTO cargo_plan(cpid,crid,truckno,cpdate) VALUES (:cpid, :crid, :truckno, :cpdate)  ';
                                                                    $sta=$conn->prepare($add_query);
                                                                    $sta-> bindValue( ":cpid", $npid, PDO::PARAM_INT );
                                                                    $sta-> bindValue( ":crid", $g_rid, PDO::PARAM_INT );
                                                                    $sta-> bindValue( ":truckno", $ntruck, PDO::PARAM_STR );
                                                                    $sta-> bindValue( ":cpdate", $ndate, PDO::PARAM_STR);                                                                    
                                                                    
                                                                    $sta->execute();
                                                                    echo "<script>window.alert('Truck added successfully'); </script>";
                                                                    display_table();
                                                                
                                                            } catch ( PDOException $e ) {
                                                                echo "Query failed: " . $e-> getMessage();
                                                            }
                                                        }
                                                    }
                                       
                                    }else{
                                        echo "<script>window.alert('The The Rid (source and destination) does not exist in the Route table. Please enter a valid Rid value.'); </script>";                                         
                                        show_add_again($npid, $nsrc, $ndesti, $ntruck, $ndate);
                                    }

                                }
                            }
                                
                                
                                
                            

                            
                            if (isset($_POST["edit_btn"]))
                            {
                                          
                                $opid=$_POST["opid"];
                                $osrc=$_POST["osrc"];
                                $odesti=$_POST["odesti"];
                                $otruck=$_POST["otruck"];
                                $odate=$_POST["odate"];                              
                                            
                                $prev_id=$_POST["previous_edit_id"];
                                $origin=$_POST['origin'];
                                echo "<script>window.alert($opid); </script>";    
                                echo "<script>window.alert($prev_id); </script>";      
                                echo "<script>window.alert($origin); </script>";    
                                $x=false;
                                if ($opid == $origin) 
                                {
                                    $x=true;
                                }  


                               
                                if($osrc == $odesti )
                                {
                                    echo "<script>window.alert('Source and Destination should not be the same.'); </script>";                                    
                                    show_edit_form($opid, $osrc, $odesti, $otruck, $odate, $origin);
                                    exit;                                    
                                }                               
                                else 
                                {   $flag1=true; }

                                
                                $sr="SELECT crid FROM cargo_route WHERE cargo_src=? and cargo_dest=?";                                                                                                               
                                $g_rid=$dbconnection->prepare($sr);
                                $g_rid->bind_param("ss", $osrc, $odesti);
                                $g_rid->execute();
                                $g_rid_result = $g_rid->get_result();                                            
                                $g_rid_row = $g_rid_result->fetch_assoc();

                                if ( $g_rid_row > 0)
                                {
                                    $g_rid = $g_rid_row["crid"];      //get rid
                                    //echo "<script>window.alert('$g_rid'); </script>"; 
                                    $flag2=true;
                                }else{
                                    echo "<script>window.alert('The The Rid (source and destination) does not exist in the Route table. Please enter a valid Rid value.'); </script>";                                         
                                    show_edit_form($opid, $osrc, $odesti, $otruck, $odate,$origin);
                                    exit;
                                }

                                       $check_pid = "SELECT * FROM cargo_plan WHERE cpid=?";
                                        $stmt_check_pid = $dbconnection->prepare($check_pid );
                                        $stmt_check_pid->bind_param("i", $opid);
                                        $stmt_check_pid->execute();
                                        $result_check_pid = $stmt_check_pid->get_result();

                                        if ($result_check_pid->num_rows > 0 && $x == false) {
                                            show_edit_form($opid, $osrc, $odesti, $otruck, $odate, $origin);
                                            echo "<script>window.alert('The pid=$opid already exists in the table. Please enter a different plan id.'); </script>";
                                            exit;
                                            
                                        } else {  $flag3= true; }

                                      $sql_check = "SELECT * FROM cargo_plan WHERE crid = ? AND truckno = ? AND cpdate = ?";
                                      $stmt_check = $dbconnection->prepare($sql_check);
                                      $stmt_check->bind_param("iss", $g_rid, $otruck, $odate);
                                      $stmt_check->execute();
                                      $result_check = $stmt_check->get_result();
                                      if ($result_check->num_rows > 0 && $x == false) 
                                        {                                              
                                                echo "<script>window.alert('The combination of crid, truckno, and date already exists in the cargo_plan table. Please enter different values.'); </script>";
                                                show_edit_form($opid, $osrc, $odesti, $otruck, $odate, $origin);
                                                exit;
                                        }else 
                                        {   $flag4=true;  }

                                        if($x == true){
                                            try{
                                                $sql = 'UPDATE cargo_plan SET crid =:crid, truckno=:truckno, cpdate=:cpdate WHERE cpid=:cpid';
                                                $st=$conn->prepare($sql);
                                                $st-> bindValue( ":cpid", $opid, PDO::PARAM_INT );
                                                $st-> bindValue( ":crid", $g_rid, PDO::PARAM_INT );
                                                $st-> bindValue( ":truckno", $otruck, PDO::PARAM_STR );
                                                $st-> bindValue( ":cpdate", $odate, PDO::PARAM_STR);                                                
                                                $st->execute(); 
                                                echo "<script>window.alert('Updated successfully'); </script>";
                                                display_table();
                                                }  catch ( PDOException $e ) {
                                                    echo "<script>window.alert('The combination of crid, truckno, and date already exists in the cargo_plan table. Please enter different values.'); </script>";
                                                    show_edit_form($opid, $osrc, $odesti, $otruck, $odate, $origin);
                                                    exit;
                                                } 

                                        }else if ( ($flag1 == true && $flag2 == true && $flag3 == true && $flag4 == true) )    
                                         {    
                                                                                    

                                                        try{
                                                            $sql = 'UPDATE cargo_plan SET cpid=:cpid, crid =:crid, truckno=:truckno, cpdate=:cpdate WHERE cpid=:prev_id';
                                                            $st=$conn->prepare($sql);
                                                            $st-> bindValue( ":cpid", $opid, PDO::PARAM_INT );
                                                            $st-> bindValue( ":crid", $g_rid, PDO::PARAM_INT );
                                                            $st-> bindValue( ":truckno", $otruck, PDO::PARAM_STR );
                                                            $st-> bindValue( ":cpdate", $odate, PDO::PARAM_STR);
                                                            $st-> bindValue( ":prev_id", $prev_id, PDO::PARAM_INT );
                                                            $st->execute();
                                                            echo "<script>window.alert('Updated successfully'); </script>";
                                                            display_table();
                                                            }  catch ( PDOException $e ) {
                                                            echo "Query failed: " . $e-> getMessage();
                                                            display_table();
                                                            } 
                                         }else if ( $flag1 == true && $flag2 == true && $flag3 == true && $flag4 == true && $x==true )    
                                         {    
                                                                                    

                                                        try{
                                                            $sql = 'UPDATE cargo_plan SET cpid=:cpid, crid =:crid, truckno=:truckno, cpdate=:cpdate WHERE cpid=:prev_id';
                                                            $st=$conn->prepare($sql);
                                                            $st-> bindValue( ":cpid", $opid, PDO::PARAM_INT );
                                                            $st-> bindValue( ":crid", $g_rid, PDO::PARAM_INT );
                                                            $st-> bindValue( ":truckno", $otruck, PDO::PARAM_STR );
                                                            $st-> bindValue( ":cpdate", $odate, PDO::PARAM_STR);
                                                            $st-> bindValue( ":prev_id", $prev_id, PDO::PARAM_INT );
                                                            $st->execute();
                                                            echo "<script>window.alert('Updated successfully'); </script>";
                                                            display_table();
                                                            }  catch ( PDOException $e ) {
                                                            echo "Query failed: " . $e-> getMessage();
                                                            display_table();
                                                            } 
                                         }
                            }
                                       
                                    

                              
                            


           
                        ?>

                        

                        <?php function display_table(){ ?>
                         <table class="table" cellspacing="5px" border="0"  id="table_part">
                            <thead>
                            <tr>
                            <!--<th><input type="checkbox" name="hchc[]" class="check_box"></th>-->
                            <th>Plan Id</th>
                            <th>Source</th>
                            <th>Destination</th> 
                            <th>Bus No</th>   
                            <th>Date</th>                                                           
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
                                  $sql = "SELECT COUNT(*) as total FROM cargo_plan";
                                  $result = $dbconnection->query($sql);
                                  $row = $result->fetch_assoc();
                                  $total_rows = $row['total'];
                                  $total_pages = ceil($total_rows / $records_per_page);   
                                   
                                  $sql = "SELECT p.cpid, r.cargo_src, r.cargo_dest, p.truckno, p.cpdate FROM cargo_plan p, cargo_route r WHERE p.crid=r.crid ORDER BY p.cpid LIMIT $start, $records_per_page";
                                  $result = $dbconnection->query($sql);                                
                                                            
                                                                
                               
                                    if ($result->num_rows > 0) {
                                        // Fetch data from each row
                                        while ($row = $result->fetch_assoc()) {
                                            $cpid = $row["cpid"];
                                            $src = $row["cargo_src"];
                                            $desti = $row["cargo_dest"];
                                            $truckno = $row["truckno"];
                                            $date = $row["cpdate"];                                           
                                            
                                          ?>
                                          <tr class="first_row" >
                                          <!--<td><input type="checkbox" name="crow[]" class="check_box" id="select_row"></td>-->
                                          <td><?php  echo $cpid; ?></td>
                                          <td><?php  echo $src; ?></td>
                                          <td><?php  echo $desti; ?></td>
                                          <td><?php  echo $truckno; ?></td>
                                          <td><?php  echo $date; ?></td>
                                         
                                          <td class="d-flex flex-row justify-content-center"> 
                                              <form action="admin_cargo_plan.php" method="post" class="d-flex flex-row justify-content-evenly">
                                              <input type="hidden" value="<?php echo $cpid; ?>" name="action_id">
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
                            <th>Plan Id</th>
                            <th>Source</th>
                            <th>Destination</th> 
                            <th>Bus No</th>   
                            <th>Date</th>                                                           
                            <th>Action</th>
                           </tr>
                           </thead>
                           <tbody>
                            <?php  include 'connect.php';
                               $search = $_POST['search'];
                               $sql = "SELECT p.cpid, r.cargo_src, r.cargo_dest, p.truckno, p.cpdate FROM cargo_plan p, cargo_route r WHERE p.crid=r.crid and (p.cpid LIKE '$search' OR r.cargo_src LIKE '%$search%' OR p.truckno LIKE '$search%' OR r.cargo_dest LIKE '%$search%' OR p.cpdate LIKE '$search' )";
                               $result = $dbconnection->query($sql);
                               if ($result->num_rows > 0) {
                                // Fetch data from each row
                                while ($row = $result->fetch_assoc()) {
                                    $cpid = $row["cpid"];
                                    $src = $row["cargo_src"];
                                    $desti = $row["cargo_dest"];
                                    $truckno = $row["truckno"];
                                    $date = $row["cpdate"];                                 
                                    
                        ?>
                                    <tr class="first_row" >                                    
                                          <td><?php  echo $cpid; ?></td>
                                          <td><?php  echo $src; ?></td>
                                          <td><?php  echo $desti; ?></td>
                                          <td><?php  echo $truckno; ?></td>
                                          <td><?php  echo $date; ?></td>                                  
                                    
                                                                    
                                    <td class="d-flex flex-row justify-content-center"> 
                                        <form action="admin_cargo_plan.php" method="post" class="d-flex flex-row justify-content-evenly">
                                        <input type="hidden" value="<?php echo $cpid; ?>" name="action_id">
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
                          <form method="post" action="admin_cargo_plan.php" >
                            <button type="submit" style="margin: 10px 0px 30px 30px; background-color:#7895CB; border:none;" name="search_back" > <<< Back </button>
                          </form>

                          
                        <?php   
                          }

                          if (isset($_POST['search_back'])){
                             echo '<script> window.location("admin_cargo_plan.php")';
                          }  
                        
                        ?>

                        <?php function add_form($next_planid) { 
                                  include 'connect.php';  
                                  
                                  $sql_src= "SELECT DISTINCT r.cargo_src FROM cargo_route r";
                                  $sql_desti= "SELECT DISTINCT r.cargo_dest FROM  cargo_route r";
                                  $sql_t="SELECT DISTINCT truckno FROM  cargo_truck";                                  
                                  
                                  
                                  $result_src=$dbconnection->query($sql_src);
                                  $result_desti=$dbconnection->query($sql_desti);
                                  $result_truck=$dbconnection->query($sql_t);                                                                 
                                                                     
                          ?>
                            <!-- add info from -->

                            <div class="add-on" id="add_info_show">
                                <h5>Add Cargo Plan Information </h5>
                                

                                <form method="post" action="admin_cargo_plan.php">      
                                <table cellspacing="10px" border="0" class="add_table">
                                <tr>
                                    <td>Plan Id: </td>
                                    <td><input type="text" name="npid" value="<?php echo $next_planid; ?>" required> </td>
                                </tr>                              
                                
                                <tr>
                                    <td>Source: </td>
                                    <td>                                       
                                       <select name="nsrc" id="nsrc" size="1" required>
                                          <?php foreach ($result_src as $resultr1) {  ?>                                          
                                          <option value="<?php echo $resultr1["cargo_src"] ?>" ><?php echo $resultr1["cargo_src"] ?> </option>
                                         <?php } ?>
                                      </select> 
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td>Destination: </td>
                                    <td>
                                    <select name="ndesti" id="ndesti" size="1" required>
                                         <?php foreach ($result_desti as $resultr2) {  ?>                                          
                                          <option value="<?php echo $resultr2["cargo_dest"] ?>" ><?php echo $resultr2["cargo_dest"] ?> </option>
                                         <?php } ?>
                                    </select>                                   
                                    </td>                                    
                                </tr>
                                
                                <tr>
                                    <td>Truck No: </td>
                                    <td>
                                      <select name="ntruck" id="op" size="1" required>
                                          <?php foreach ($result_truck as $resultr3) {  ?>                                          
                                            <option value="<?php echo $resultr3["truckno"] ?>" ><?php echo $resultr3["truckno"] ?> </option>
                                          <?php } ?>
                                      </select> 
                                    </td>                       
                              
                                </tr>


                                <tr>
                                    <td>Date: </td>
                                    <td><input type="date" name="ndate" value="" required> </td>
                                </tr>
                                
                                    <td> </td>                                      
                                    <td> </td>
                                </tr>
                                </table>
                                
                                <a href="admin_cargo_plan.php" style="text-decoration:none;"><button type="button" class="back-btn" name="search_back"> <<< Back </button><a>
                                <button type="submit" name="add_btn" value="Add" class="btn_add" style="margin-bottom:40px;"> Add </button> </td>
                                </form>
                            </div>
                        <?php } ?>
            
                        <!-- edit info from -->
                        <?php function show_edit_form($epid, $esrc, $edesti, $etruck, $edate, $e_pid){ 
                            include "connect.php";
                            $sql_src= "SELECT DISTINCT r.cargo_src FROM cargo_route r";
                            $sql_desti= "SELECT DISTINCT r.cargo_dest FROM  cargo_route r";
                            $sql_t="SELECT DISTINCT truckno FROM  cargo_truck";                                  
                            
                            
                            $result_src=$dbconnection->query($sql_src);
                            $result_desti=$dbconnection->query($sql_desti);
                            $result_truck=$dbconnection->query($sql_t);
                            
                            
                        ?>
                        <!-- edit info from -->
                            <div class="add-on" id="add_info_show">
                                <h4>Edit Cargo Plan Information </h4>
                                <div style="border-bottom:1px solid black">
                                </div>

                                <form method="post" action="admin_cargo_plan.php"  enctype="multipart/form-data">      
                                <table cellspacing="10px" border="0" class="add_table">
                                <tr>
                                    <td>Plan Id: </td>
                                    <td><input type="text" name="opid" value="<?php echo $epid; ?>" required> </td>
                                </tr>                                
                                <tr>
                                    <td>Source: </td>
                                    <td>                                       
                                    <select name="osrc" id="nsrc" size="1" value="<?php echo $esrc; ?>"required>
                                      <?php foreach ($result_src as $resultr1) {  ?>
                                      <option value="<?php echo $resultr1["cargo_src"] ?>" <?php if ($resultr1["cargo_src"] == "$esrc") { echo 'selected'; } ?> ><?php echo $resultr1["cargo_src"] ?> </option>
                                      <?php } ?>
                                    </select>
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td>Destination: </td>
                                    <td>
                                    <select name="odesti" id="ndesti" size="1"value="<?php echo $edesti; ?>" required>
                                         <?php foreach ($result_desti as $resultr2) {  ?>                                          
                                          <option value="<?php echo $resultr2["cargo_dest"] ?>" <?php if ($resultr2["cargo_dest"] == $edesti) { echo 'selected'; } ?> ><?php echo $resultr2["cargo_dest"] ?> </option>
                                         <?php } ?>
                                    </select>                                   
                                    </td>                                    
                                </tr>
                                

                                <tr>
                                    <td>Truck No: </td>
                                    <td>
                                      <select name="otruck" id="op" size="1" value="<?php echo $etruck; ?>" required>
                                          <?php foreach ($result_truck as $resultr3) {  ?>                                          
                                            <option value="<?php echo $resultr3["truckno"] ?>" <?php if ($resultr3["truckno"] == $etruck) { echo 'selected'; } ?>><?php echo $resultr3["truckno"] ?> </option>
                                          <?php } ?>
                                      </select> 
                                    </td>                       
                              
                                </tr>

                                <tr>
                                    <td>Date: </td>
                                    <td><input type="date" name="odate" value="<?php echo $edate; ?>" required> </td>
                                </tr>

                                <tr>
                                    <td> </td>                                      
                                    <td> </td>
                                </tr>
                                </table>
                                <a href="admin_cargo_plan.php" style="text-decoration:none;"><button type="button" class="back-btn" name="search_back"> <<< Back </button><a>
                                <input type="hidden" name="previous_edit_id" value="<?php echo $epid; ?>">
                                <input type="hidden" name="origin" value="<?php echo $e_pid; ?>">
                                <button type="submit" name="edit_btn" value="Edit" class="btn_add" style="margin-bottom:40px;">Save</button> </td>
                                </form>
                            </div>
                        <?php } ?>

                        <!-- when adding form fail -->
                        <?php function show_add_again($nnpid, $nnsrc, $nndesti, $nntruck, $nndate) { 
                                include 'connect.php'; 
                                $sql_src= "SELECT DISTINCT r.cargo_src FROM cargo_route r";
                                $sql_desti= "SELECT DISTINCT r.cargo_dest FROM  cargo_route r";
                                $sql_t="SELECT DISTINCT truckno FROM  cargo_truck";                                  
                            
                            
                                $result_src=$dbconnection->query($sql_src);
                                $result_desti=$dbconnection->query($sql_desti);
                                $result_truck=$dbconnection->query($sql_t);                                                                  
                                                                     
                          ?>
                            <!-- add info from -->

                            <div class="add-on" id="add_info_show">
                                <h5>Add Cargo Plan Information </h5>
                                

                                <form method="post" action="admin_cargo_plan.php">      
                                <table cellspacing="10px" border="0" class="add_table">
                                <tr>
                                    <td>Plan Id: </td>
                                    <td><input type="text" name="npid" value="<?php echo $nnpid; ?>" required> </td>
                                </tr>   

                                <tr>
                                    <td>Source: </td>
                                    <td>                                       
                                    <select name="nsrc" id="nsrc" size="1" required>
                                      <?php foreach ($result_src as $resultr1) {  ?>
                                      <option value="<?php echo $resultr1["cargo_src"] ?>" <?php if ($resultr1["cargo_src"] == $nnsrc) { echo 'selected'; } ?> ><?php echo $resultr1["cargo_src"] ?> </option>
                                      <?php } ?>
                                    </select>
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td>Destination: </td>
                                    <td>
                                    <select name="ndesti" id="ndesti" size="1" required>
                                         <?php foreach ($result_desti as $resultr2) {  ?>                                          
                                          <option value="<?php echo $resultr2["cargo_dest"] ?>" <?php if ($resultr2["cargo_dest"] == $nndesti) { echo 'selected'; } ?> ><?php echo $resultr2["cargo_dest"] ?> </option>
                                         <?php } ?>
                                    </select>                                   
                                    </td>                                    
                                </tr>
                                

                                <tr>
                                    <td>Truck No: </td>
                                    <td>
                                      <select name="ntruck" id="op" size="1" value="<?php echo $nntruck; ?>" required>
                                          <?php foreach ($result_truck as $resultr3) {  ?>                                          
                                            <option value="<?php echo $resultr3["truckno"] ?>" <?php if ($resultr3["truckno"] == $nntruck) { echo 'selected'; } ?>><?php echo $resultr3["truckno"] ?> </option>
                                          <?php } ?>
                                      </select> 
                                    </td>                       
                              
                                </tr>

                                <tr>
                                    <td>Date: </td>
                                    <td><input type="date" name="ndate" value="<?php echo $nndate; ?>" required> </td>
                                </tr>
                                
                                <tr>
                                    <td> </td>                                      
                                    <td> </td>
                                </tr>
                                </table>
                                <a href="admin_cargo_plan.php" style="text-decoration:none;"><button type="button" class="back-btn" name="search_back"> <<< Back </button><a>
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


function getNextPlanNo() {
    global $conn; 

    try {
        
        $sql2 = "SELECT MAX(cpid) AS max_planid FROM cargo_plan";
        $stmt2 = $conn->prepare($sql2);
        $stmt2->execute();
        
        
        $result2 = $stmt2->fetch(PDO::FETCH_ASSOC);

       
        if ($result2['max_planid'] === null) {
            return 1;
        } else {
            
            return $result2['max_planid'] + 1;
        }
    } catch (PDOException $e) {
        
        echo "Error: " . $e->getMessage();
        return null;
    }
}  
?>  
  
 
</html>


