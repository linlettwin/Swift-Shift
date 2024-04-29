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
  /*

  if (isset($_POST["edit_btn"]))
  {
                //echo "click edit";
                //if( isset($_POST["oid"]) and isset($_POST["ocname"]) and isset($_POST["oemail"]) and isset($_POST["opw"]) and isset($_POST["opw2"]) ) {
                $orid=$_POST["orid"];
                $osrc=$_POST["osrc"];
                $odesti=$_POST["odesti"];
                $oduration=$_POST["oduration"];
                $odistance=$_POST["odistance"];
                //$ofile1=$_POST["opc_file"];
                
                
    
                  try {
                    //Prepare the UPDATE statement
                    
                  $sql = 'UPDATE route SET source =:source, destination =:destination, duration =:duration, distance=:distance WHERE rid = :rid';
                  $st=$conn->prepare($sql);
                  $st-> bindValue( ":rid", $orid, PDO::PARAM_INT );
                  $st-> bindValue( ":source", $osrc, PDO::PARAM_STR);
                  $st-> bindValue( ":destination", $odesti, PDO::PARAM_STR);
                  $st-> bindValue( ":duration", $oduration, PDO::PARAM_STR);
                  $st-> bindValue( ":distance", $odistance, PDO::PARAM_STR);
                  $st->execute();
                  } catch ( PDOException $e ) {
                    echo "Query failed: " . $e-> getMessage();
                  }    
                
              //}
              //else {
              //   echo "<script> window.alert ('Please fill the required field') </script>";}
  }        

if (isset($_POST["add_btn"]))
  {
     // if( isset($_POST["cid"]) and isset($_POST["ncname"]) and isset($_POST["nemail"]) and isset($_POST["npw"]) and isset($_POST["npw2"]) ) {
                $rid=$_POST["nrid"];
                $nsrc=$_POST["nsrc"];
                $ndesti=$_POST["ndesti"];
                $nduration=$_POST["nduration"];
                $ndistance=$_POST["ndistance"];
                
                
                  try {
                    //Prepare the UPDATE statement
                   $add_query = 'INSERT INTO route(rid,source,destination,duration,distance) VALUES (:rid, :source, :destination, :duration, :distance)  ';
                   $sta=$conn->prepare($add_query);
                   $sta-> bindValue( ":rid", $rid, PDO::PARAM_INT );
                   $sta-> bindValue( ":source", $nsrc, PDO::PARAM_STR);
                   $sta-> bindValue( ":destination", $ndesti, PDO::PARAM_STR);
                   $sta-> bindValue( ":duration", $nduration, PDO::PARAM_STR);
                   $sta-> bindValue( ":distance", $ndistance, PDO::PARAM_STR);
                   $sta->execute();
                  } catch ( PDOException $e ) {
                    echo "Query failed: " . $e-> getMessage();
                  }
                 
                //} else {
                 // echo "<script> window.alert ('Please fill the required field') </script>";
                //}
 }

 if (isset($_POST["delete"]))
 {
    

      echo "<script> var x = window.confirm('Do you want to delete?') ; 
     if (x == true){";
     
       $d_rid = $_POST["action_id"];
       
       
       $dquery=$dbconnection->prepare("DELETE FROM route WHERE rid=$d_rid");

       $dquery->execute();  
       
       
     echo '  } </script>';

   
      
 }      */                              
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
                <h3><img src="images/user/girl.jpg" class="img-fluid"/><span> Lin Let </span></h3>
            </div>
            <ul class="list-unstyled components">
			<li  class="">
                    <a href="admin_dashboard.php" class="dashboard"><i class="fa-solid fa-gauge-simple-high" style="margin-bottom: 15px; font-size: 25px;margin-left: 3px;"></i>
					<span style="margin-top: 30px; font-weight: bold; margin-left: 8px;">Dashboard</span></a>
                </li>
		

                <li  class="">
                    <a href="admin_customer.php"
					class=""><i class="fa-solid fa-users" style="margin-left: 7px; font-size: 20px;"></i><span style="margin-left: 15px; font-weight: bold; font-size: 15px;">Customers</span></a>
                </li> 
                
                <li  class="">
                    <a href="#" data-toggle="collapse" aria-expanded="false" 
					class="">
					<i class="fa-solid fa-user-tie" style="margin-left: 8px; font-size: 20px;"></i><span style="margin-left: 19px; font-weight: bold; font-size: 15px;">Admins</span></a>
                </li>    
				
                <li  class="">
                  <a href="#homeSubmenu1" data-toggle="collapse" aria-expanded="false" 
        class=""><i class="fa-solid fa-business-time" style="margin-left: 7px; font-size: 20px;"></i><span style="margin-left: 15px; font-weight: bold; font-size: 15px;">Operators</span></a>
              </li> 
				
              <li  class="">
                <a href="#homeSubmenu1" data-toggle="collapse" aria-expanded="false" 
      class=""><i class="fa-solid fa-bus" style="margin-left: 7px; font-size: 20px;"></i><span style="margin-left: 15px; font-weight: bold; font-size: 15px;">Buses</span></a>
            </li> 

            <li  class="">
              <a href="admin_route" 
    class=""><i class="fa-solid fa-route" style="margin-left: 7px; font-size: 20px;"></i><span style="margin-left: 15px; font-weight: bold; font-size: 15px;">Routes</span></a>
          </li> 
				
			<li  class="">
            <a href="#homeSubmenu1" data-toggle="collapse" aria-expanded="false" 
  class=""><i class="fa-regular fa-clock" style="margin-left: 7px; font-size: 20px;"></i><span style="margin-left: 15px; font-weight: bold; font-size: 15px;">Plans</span></a>
        </li> 

        <li  class="">
          <a href="#homeSubmenu1" data-toggle="collapse" aria-expanded="false" 
class=""><i class="fa-solid fa-address-card" style="margin-left: 7px; font-size: 20px;"></i><span style="margin-left: 15px; font-weight: bold; font-size: 15px;">Booked Tickets</span></a>
      </li> 

        <li  class="active">
          <a href="#homeSubmenu1" data-toggle="collapse" aria-expanded="false" 
class=""><i class="fa-solid fa-address-card" style="margin-left: 7px; font-size: 20px;"></i><span style="margin-left: 15px; font-weight: bold; font-size: 15px;">Bus Ticket Cost</span></a>
      </li>
      
      <li  class="">
          <a href="#homeSubmenu1" data-toggle="collapse" aria-expanded="false" 
class=""><i class="fa-solid fa-address-card" style="margin-left: 7px; font-size: 20px;"></i><span style="margin-left: 15px; font-weight: bold; font-size: 15px;">Cargo2</span></a>
      </li> 


      <li  class="">
          <a href="#homeSubmenu1" data-toggle="collapse" aria-expanded="false" 
class=""><i class="fa-solid fa-address-card" style="margin-left: 7px; font-size: 20px;"></i><span style="margin-left: 15px; font-weight: bold; font-size: 15px;">Cargo 3</span></a>
      </li> 

      <li  class="">
          <a href="#homeSubmenu1" data-toggle="collapse" aria-expanded="false" 
class=""><i class="fa-solid fa-address-card" style="margin-left: 7px; font-size: 20px;"></i><span style="margin-left: 15px; font-weight: bold; font-size: 15px;">Cargo 4</span></a>
      </li> 

      <li  class="">
          <a href="#homeSubmenu1" data-toggle="collapse" aria-expanded="false" 
class=""><i class="fa-solid fa-comments" style="margin-left: 7px; font-size: 20px;"></i><span style="margin-left: 15px; font-weight: bold; font-size: 15px;">View Feedback</span></a>
      </li> 

      <li  class="">
          <a href="#homeSubmenu1" data-toggle="collapse" aria-expanded="false" 
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
                    <form method="post" action="test_cost.php">
                        <button type="submit" name="addbtn" class="add_btn d-flex flex-row">
                          <i class="fa-solid fa-plus" style="color: #ffffff; margin-top:5px;"></i> Add New
                        </button>
                    </form>  
                  </div>
                  <div class="search_part" style="margin:20px; float:right;">
                      <form method="post" action="test_cost.php">
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
                                {   $next_costid = getNextCostId(); // Assuming there's a function to get the next available customer ID
                                    add_form($next_costid);
                                }
                                else if(isset($_POST['edit']))
                                {
                                   /* $e_costid = $_POST['action_id'];
                                    //echo $e_cid;
                                    $edit_row_query= "SELECT * FROM cost WHERE costid = $e_costid";
                                    $erow=$dbconnection->query($edit_row_query);
                                    $ecostid=$e_costid;
                                    while($edit_row = $erow->fetch_assoc())
                                    {
                                      $esrc=$edit_row["source"];
                                      $edesti=$edit_row["destination"];
                                      $eduration=$edit_row["duration"];
                                      $edistance=$edit_row["distance"];

                                      show_edit_form($e_rid,$esrc,$edesti,$eduration,$edistance);
                                    } */
                                }
                                else if(isset($_POST['search_bt']))
                                {
                                  $search = $_POST['search'];
                                  $sql = "SELECT Distinct c.costid, r.source, r.destination, o.oname, c.cost FROM cost c, bus b, route r, operator o WHERE c.rid=r.rid and c.busno=b.busno and b.oid=o.oid and (r.source LIKE '%$search%' OR r.destination LIKE '%$search%' OR c.costid LIKE '%$search%' OR o.oname LIKE '%$search%' OR c.cost LIKE '%$search%') ";
                                  $result = $dbconnection->query($sql);
                                   search_show();
                                }
                           
                            } else {
                             display_table();
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
                                
                                $records_per_page = 5;
                                $current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                                $start = ($current_page - 1) * $records_per_page;
                                $total_rows = 0;
                                
                                  include 'connect.php';                                        
                                  $sql = "SELECT COUNT(*) as total FROM cost";
                                  $result = $dbconnection->query($sql);
                                  $row = $result->fetch_assoc();
                                  $total_rows = $row['total'];
                                  $total_pages = ceil($total_rows / $records_per_page);   
                                   
                                  $sql = "SELECT c.costid, r.source, r.destination, o.oname, c.cost FROM cost c, bus b, route r, operator o WHERE c.rid=r.rid and c.busno=b.busno and b.oid=o.oid LIMIT $start, $records_per_page";
                                  $result = $dbconnection->query($sql);                                
                                                            
                                                                
                               
                                    if ($result->num_rows > 0) {
                                        // Fetch data from each row
                                        while ($row = $result->fetch_assoc()) {
                                            $costid = $row["costid"];
                                            $src = $row["source"];
                                            $desti=$row["destination"];
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
                                              <form action="test_cost.php" method="post" class="d-flex flex-row justify-content-evenly">
                                              <input type="hidden" value="<?php echo $costid; ?>" name="action_id">
                                              <!--<button type="submit" class="action_btn" name="view_more"><i class="fa-solid fa-eye"></i></button>-->
                                              <button type="submit" class="action_btn" name="edit"> <i class="fa-solid fa-pen-to-square"></i></button>
                                              <button type="submit" class="action_btn" name="delete" > <i class="fa-solid fa-trash"></i> </button> 
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
                            <?php  include 'connect.php';
                               $search = $_POST['search'];
                               $sql = "SELECT Distinct c.costid, r.source, r.destination, o.oname, c.cost FROM cost c, bus b, route r, operator o WHERE c.rid=r.rid and c.busno=b.busno and b.oid=o.oid and (r.source LIKE '%$search%' OR r.destination LIKE '%$search%' OR c.costid LIKE '%$search%' OR o.oname LIKE '%$search%' OR c.cost LIKE '%$search') ";
                               $result = $dbconnection->query($sql);
                               if ($result->num_rows > 0) {
                                // Fetch data from each row
                                while ($row = $result->fetch_assoc()) {
                                    $costid = $row["costid"];
                                    $src = $row["source"];
                                    $desti=$row["destination"];
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
                                        <form action="test_cost.php" method="post" class="d-flex flex-row justify-content-evenly">
                                        <input type="hidden" value="<?php echo $costid; ?>" name="action_id">
                                        <!--<button type="submit" class="action_btn" name="view_more"><i class="fa-solid fa-eye"></i></button> -->
                                        <button type="submit" class="action_btn" name="edit"> <i class="fa-solid fa-pen-to-square"></i></button>
                                        <button type="submit" class="action_btn" name="delete" > <i class="fa-solid fa-trash"></i> </button> 
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
                          <form method="post" action="test_cost.php" >
                            <button type="submit" style="margin: 10px 0px 30px 30px; background-color:#7895CB; border:none;" name="search_back" > <<< Back </button>
                          </form>

                          
                        <?php   
                          }

                          if (isset($_POST['search_back'])){
                             echo '<script> window.location("test_cost.php")';
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


