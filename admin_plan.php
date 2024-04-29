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
    .back-btn a{
				/*margin-left:10px;*/
				border:none;
				background-color: #7895CB;
                text-decoration:none;
				width:130px;
				height:35px;
				margin-top:30px;
			}
    </style>

  </head>

  <?php 

include 'connect.php';
if (isset($_POST["edit_btn"]))
  {
    

                $flag1 = true;
                $flag2 = true;
                $flag3 = true;
                $flag4 = true;
                $flag5 = true;
                $flag6 = true;
                $flag7 = true;                
                
                $opid=$_POST["opid"];               
                $osrc=$_POST["osrc"];                
                $odesti=$_POST["odesti"];                
                $ooperator=$_POST["ooperator"];
                $obusno=$_POST["obusno"];
                $odate=$_POST["odate"];
                //echo $odate;
                $otime=$_POST["otime"];
                //echo $otime;
                
                                
                $opid_origin = $_POST["opid_origin"];
                $osrc_origin = $_POST["osrc_origin"];
                $odesti_origin = $_POST["odesti_origin"];
                $op_origin = $_POST["op_origin"];
                $bus_origin = $_POST["bus_origin"];
                $date_origin = $_POST["date_origin"];
                $time_origin = $_POST["time_origin"];


                
                
                //check src and desti are same
                if($osrc == $odesti)
                {
                    $_SESSION["opid"] = $_POST["opid"];
                    $_SESSION["osrc"] = $_POST["osrc"];
                    $_SESSION["odesti"] = $_POST["odesti"];
                    $_SESSION["ooperator"] = $_POST["ooperator"];
                    $_SESSION["obusno"] = $_POST["obusno"];
                    $_SESSION["odate"] = $_POST["odate"];
                    $_SESSION["otime"] = $_POST["otime"];

                    $_SESSION["opid_origin"] = $_POST["opid_origin"];
                    $_SESSION["osrc_origin"] = $_POST["osrc_origin"];
                    $_SESSION["odesti_origin"] = $_POST["odesti_origin"];
                    $_SESSION["op_origin"] = $_POST["op_origin"];
                    $_SESSION["bus_origin"] = $_POST["bus_origin"];
                    $_SESSION["date_origin"] = $_POST["date_origin"];
                    $_SESSION["time_origin"] = $_POST["time_origin"];
                  $flag1 = false;
                  echo "<script>alert('Source and destination must be different.');</script>";
                  echo "<script>window.location.href='admin_plan.php?editerror=editerror'</script>";
                  exit;
                }

                
                //check unique pid
                $sql = "select pid from plan";
                $sdus = $conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
                foreach($sdus as $sdu)
                {
                  if($sdu["pid"] == $opid_origin)
                  {
                    continue;
                  }

                  if($sdu["pid"] == $opid)
                  {
                    $_SESSION["opid"] = $_POST["opid"];
                    $_SESSION["osrc"] = $_POST["osrc"];
                    $_SESSION["odesti"] = $_POST["odesti"];
                    $_SESSION["ooperator"] = $_POST["ooperator"];
                    $_SESSION["obusno"] = $_POST["obusno"];
                    $_SESSION["odate"] = $_POST["odate"];
                    $_SESSION["otime"] = $_POST["otime"];

                    $_SESSION["opid_origin"] = $_POST["opid_origin"];
                    $_SESSION["osrc_origin"] = $_POST["osrc_origin"];
                    $_SESSION["odesti_origin"] = $_POST["odesti_origin"];
                    $_SESSION["op_origin"] = $_POST["op_origin"];
                    $_SESSION["bus_origin"] = $_POST["bus_origin"];
                    $_SESSION["date_origin"] = $_POST["date_origin"];
                    $_SESSION["time_origin"] = $_POST["time_origin"];
                    $flag2 = false;
                    echo "<script>alert('This Id= " . htmlspecialchars($sdu['pid'], ENT_QUOTES, 'UTF-8') . "already exists.');</script>";
                    echo "<script>window.location.href='admin_plan.php?editerror=editerror'</script>";
                    break;
                  }
                }

                
                $src_id="SELECT cg.cgid FROM cargate cg WHERE cg.town=?";
                $desti_id="SELECT cg.cgid FROM cargate cg WHERE cg.town=?";

                //get src id with src name
                $get_sid =$dbconnection->prepare($src_id);
                $get_sid->bind_param("s", $osrc);
                $get_sid->execute();
                $get_sid_result = $get_sid->get_result();
                $get_sid_row = $get_sid_result->fetch_assoc();
                $get_sid = $get_sid_row["cgid"];

                //get did id with desti name
                $get_did =$dbconnection->prepare($desti_id);
                $get_did->bind_param("s", $odesti);
                $get_did->execute();
                $get_did_result = $get_did->get_result();
                $get_did_row = $get_did_result->fetch_assoc();
                $get_did = $get_did_row["cgid"];
                
                //get rid with src and desti
                $sr="SELECT r.rid FROM route r WHERE r.source=? and r.destination=?";
                $n_rid=$dbconnection->prepare($sr);
                $n_rid->bind_param("ii", $get_sid, $get_did);
                $n_rid->execute();
                $n_rid_result = $n_rid->get_result();                                            
                $n_rid_row = $n_rid_result->fetch_assoc();

                //check src and desti is route table rid
                if ( $n_rid_row > 0){
                    $n_rid = $n_rid_row["rid"];                  
                }
                else{
                  $_SESSION["opid"] = $_POST["opid"];
                  $_SESSION["osrc"] = $_POST["osrc"];
                  $_SESSION["odesti"] = $_POST["odesti"];
                  $_SESSION["ooperator"] = $_POST["ooperator"];
                  $_SESSION["obusno"] = $_POST["obusno"];
                  $_SESSION["odate"] = $_POST["odate"];
                  $_SESSION["otime"] = $_POST["otime"];

                  $_SESSION["opid_origin"] = $_POST["opid_origin"];
                  $_SESSION["osrc_origin"] = $_POST["osrc_origin"];
                  $_SESSION["odesti_origin"] = $_POST["odesti_origin"];
                  $_SESSION["op_origin"] = $_POST["op_origin"];
                  $_SESSION["bus_origin"] = $_POST["bus_origin"];
                  $_SESSION["date_origin"] = $_POST["date_origin"];
                  $_SESSION["time_origin"] = $_POST["time_origin"];
                  $flag3 = false;
                  echo "<script>window.alert('The source and destination are not in the route table. Please check!!'); </script>"; 
                  echo "<script>window.location.href='admin_plan.php?editerror=editerror'</script>";
                  exit;
                }

                        //get oid match with operator for input
                        $s2="SELECT o.oid FROM operator o WHERE o.oname=?";
                        $check_oid =$dbconnection->prepare($s2);
                        $check_oid->bind_param("s", $ooperator);
                        $check_oid->execute();
                        $check_oid_result = $check_oid->get_result();
                        $check_oid_row = $check_oid_result->fetch_assoc();
                        $check_oid = $check_oid_row["oid"];
                        //echo "<script>window.alert('$check_oid ');</script>";
                        

                        //get bus id for input
                        $s3="SELECT b.oid FROM bus b WHERE b.busno=?";
                        $get_oid =$dbconnection->prepare($s3);
                        $get_oid->bind_param("s", $obusno);
                        $get_oid->execute();
                        $check_busno_result =  $get_oid->get_result();
                        $check_busno_row = $check_busno_result->fetch_assoc();
                        $bus_oid = $check_busno_row["oid"];
                        //echo "<script>window.alert('$bus_oid');</script>";

                
                if($check_oid != $bus_oid){
                  
                  $_SESSION["opid"] = $_POST["opid"];
                  $_SESSION["osrc"] = $_POST["osrc"];
                  $_SESSION["odesti"] = $_POST["odesti"];
                  $_SESSION["ooperator"] = $_POST["ooperator"];
                  $_SESSION["obusno"] = $_POST["obusno"];
                  $_SESSION["odate"] = $_POST["odate"];
                  $_SESSION["otime"] = $_POST["otime"];

                  $_SESSION["opid_origin"] = $_POST["opid_origin"];
                  $_SESSION["osrc_origin"] = $_POST["osrc_origin"];
                  $_SESSION["odesti_origin"] = $_POST["odesti_origin"];
                  $_SESSION["op_origin"] = $_POST["op_origin"];
                  $_SESSION["bus_origin"] = $_POST["bus_origin"];
                  $_SESSION["date_origin"] = $_POST["date_origin"];
                  $_SESSION["time_origin"] = $_POST["time_origin"];
                  $flag4 = false;
                  echo "<script>window.alert('The bus no is not match with operator. Please check!!'); </script>"; 
                  echo "<script>window.location.href='admin_plan.php?editerror=editerror'</script>";
                  exit;
                 
                }

               
              //Check rid busno date are unique flag 5   
              if($osrc==$osrc_origin && $odesti==$odesti_origin && $ooperator==$op_origin && $obusno==$bus_origin && $odate==$date_origin) {
                $flag5 =true;
                //echo "<script> alert('same ');</script>";
                
              } 
              else 
              {           
                  $sql5 = "SELECT COUNT(*) FROM plan WHERE rid=? AND busno = ? AND ddate = ?  ";
                  $stmt5 = $dbconnection->prepare($sql5);
                  $stmt5->bind_param("iss", $n_rid, $obusno, $odate,);
                  $stmt5->execute();
                  $result5 = $stmt5->get_result();
                  $row5 = $result5->fetch_assoc();
                  if ($row5['COUNT(*)'] > 0) { 
                      
                      $_SESSION["opid"] = $_POST["opid"];
                      $_SESSION["osrc"] = $_POST["osrc"];
                      $_SESSION["odesti"] = $_POST["odesti"];
                      $_SESSION["ooperator"] = $_POST["ooperator"];
                      $_SESSION["obusno"] = $_POST["obusno"];
                      $_SESSION["odate"] = $_POST["odate"];
                      $_SESSION["otime"] = $_POST["otime"];

                      $_SESSION["opid_origin"] = $_POST["opid_origin"];
                      $_SESSION["osrc_origin"] = $_POST["osrc_origin"];
                      $_SESSION["odesti_origin"] = $_POST["odesti_origin"];
                      $_SESSION["op_origin"] = $_POST["op_origin"];
                      $_SESSION["bus_origin"] = $_POST["bus_origin"];
                      $_SESSION["date_origin"] = $_POST["date_origin"];
                      $_SESSION["time_origin"] = $_POST["time_origin"];             
                    $flag5 = false;
                    echo "<script>window.alert('The route, date, busNo values must be unique in the plan table.'); </script>";
                    echo "<script>window.location.href='admin_plan.php?editerror=editerror'</script>";
                    exit;
                  }
                }

                
            //check cost info flag 6
            $sql6 = "SELECT c.costid FROM cost c WHERE c.rid = ? AND c.oid= ? ";            
            $stmt6 = $dbconnection->prepare($sql6);
            $stmt6->bind_param("ii", $n_rid, $bus_oid);
            $stmt6->execute();
            $result6 = $stmt6->get_result();
            if ($result6->num_rows > 0) {
               $flag6 = true;               
            } else {
              $_SESSION["opid"] = $_POST["opid"];
              $_SESSION["osrc"] = $_POST["osrc"];
              $_SESSION["odesti"] = $_POST["odesti"];
              $_SESSION["ooperator"] = $_POST["ooperator"];
              $_SESSION["obusno"] = $_POST["obusno"];
              $_SESSION["odate"] = $_POST["odate"];
              $_SESSION["otime"] = $_POST["otime"];

              $_SESSION["opid_origin"] = $_POST["opid_origin"];
              $_SESSION["osrc_origin"] = $_POST["osrc_origin"];
              $_SESSION["odesti_origin"] = $_POST["odesti_origin"];
              $_SESSION["op_origin"] = $_POST["op_origin"];
              $_SESSION["bus_origin"] = $_POST["bus_origin"];
              $_SESSION["date_origin"] = $_POST["date_origin"];
              $_SESSION["time_origin"] = $_POST["time_origin"];       
                $flag6 = false;                
                echo "<script>window.alert('There is no cost information about the route and operator in cost table.');</script>";
                echo "<script>window.location.href='admin_plan.php?editerror=editerror'</script>";
                exit;
            }
      
                
                //check pid is in bticket table flag 7                
                if ($stmt = $dbconnection->prepare("SELECT COUNT(*) FROM btickets WHERE pid = ?")) {
                    $stmt->bind_param("i", $opid);
                    $stmt->execute();
                    $count = $stmt->get_result()->fetch_row()[0];
                    $stmt->close();
                  } else {                    
                    echo "Error: " . $dbconnection->error;
                  }
                
                  if ($count == 0) {
                    $flag7 = true;                 
                
                  } else {
                  $_SESSION["opid"] = $_POST["opid"];
                  $_SESSION["osrc"] = $_POST["osrc"];
                  $_SESSION["odesti"] = $_POST["odesti"];
                  $_SESSION["ooperator"] = $_POST["ooperator"];
                  $_SESSION["obusno"] = $_POST["obusno"];
                  $_SESSION["odate"] = $_POST["odate"];
                  $_SESSION["otime"] = $_POST["otime"];

                  $_SESSION["opid_origin"] = $_POST["opid_origin"];
                  $_SESSION["osrc_origin"] = $_POST["osrc_origin"];
                  $_SESSION["odesti_origin"] = $_POST["odesti_origin"];
                  $_SESSION["op_origin"] = $_POST["op_origin"];
                  $_SESSION["bus_origin"] = $_POST["bus_origin"];
                  $_SESSION["date_origin"] = $_POST["date_origin"];
                  $_SESSION["time_origin"] = $_POST["time_origin"];
                    $flag7 = false;
                    echo "<script> window.alert('Cannot edit pid= $opid because bookings already reserved in the btickets table.'); </script>";
                    echo "<script>window.location.href='admin_plan.php?editerror=editerror'</script>";
                    exit;
                }

                //update table query  final
                if($flag1 == true && $flag2 == true && $flag3 == true && $flag4 == true && $flag5 == true && $flag6 == true && $flag7 == true)
                {
                  
                  try {
                   
                    $sql = 'UPDATE plan SET pid=:pid, rid =:rid, busno =:busno, ddate =:ddate, dtime=:dtime WHERE pid=:opid_origin';
                    $st=$conn->prepare($sql);
                    $st-> bindValue( ":pid", $opid, PDO::PARAM_INT );
                    $st-> bindValue( ":opid_origin", $opid_origin, PDO::PARAM_INT );
                    $st-> bindValue( ":rid", $n_rid, PDO::PARAM_INT );
                    $st->bindValue(':busno', $obusno, PDO::PARAM_STR);
                    $st->bindValue(':ddate', $odate, PDO::PARAM_STR);
                    $st->bindValue(':dtime', $otime, PDO::PARAM_STR);
                   
                    $st->execute();
                    echo "<script>window.location.href='admin_plan.php'</script>";
                    } catch ( PDOException $e ) {
                      echo "Query failed: " . $e-> getMessage();
                    }     
                }
            
  }

if (isset($_POST["add_btn"]))
{ 
                $flag1 = true;
                $flag2 = true;
                $flag3 = true;
                $flag4 = true;
                $flag5 = true;
                $flag6 = true;
                $flag7 = true; 
                
                $npid=$_POST["npid"];
                $nsrc=$_POST["nsrc"];
                $ndesti=$_POST["ndesti"];
                $noperator=$_POST["noperator"];
                $nbusno=$_POST["nbusno"];
                $ndate=$_POST["ndate"];
                $ntime=$_POST["ntime"];

                $ntime_timestamp = strtotime($ntime);
                $ntime = date('H:i:s', $ntime_timestamp);

                $ndate = date('Y-m-d', strtotime($ndate));

                //check src and desti are same
                if($nsrc == $ndesti)
                {
                    $_SESSION["npid"] = $_POST["npid"];
                    $_SESSION["nsrc"] = $_POST["nsrc"];
                    $_SESSION["ndesti"] = $_POST["ndesti"];
                    $_SESSION["noperator"] = $_POST["noperator"];
                    $_SESSION["nbusno"] = $_POST["nbusno"];
                    $_SESSION["ndate"] = $_POST["ndate"];
                    $_SESSION["ntime"] = $_POST["ntime"];

                    
                  $flag1 = false;
                  echo "<script>alert('Source and destination must be different.');</script>";
                  echo "<script>window.location.href='admin_plan.php?add=add'</script>";
                  exit;
                }

                
                //check unique pid
                $sql = "select pid from plan";
                $sdus = $conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
                foreach($sdus as $sdu)
                {
                  

                  if($sdu["pid"] == $npid)
                  {
                    $_SESSION["npid"] = $_POST["npid"];
                    $_SESSION["nsrc"] = $_POST["nsrc"];
                    $_SESSION["ndesti"] = $_POST["ndesti"];
                    $_SESSION["noperator"] = $_POST["noperator"];
                    $_SESSION["nbusno"] = $_POST["nbusno"];
                    $_SESSION["ndate"] = $_POST["ndate"];
                    $_SESSION["ntime"] = $_POST["ntime"];
                    $flag2 = false;
                    echo "<script>alert('This Id= " . htmlspecialchars($sdu['pid'], ENT_QUOTES, 'UTF-8') . "already exists.');</script>";
                    echo "<script>window.location.href='admin_plan.php?add=add'</script>";
                    break;
                  }
                }

                
                $src_id="SELECT cg.cgid FROM cargate cg WHERE cg.town=?";
                $desti_id="SELECT cg.cgid FROM cargate cg WHERE cg.town=?";

                //get src id with src name
                $get_sid =$dbconnection->prepare($src_id);
                $get_sid->bind_param("s", $nsrc);
                $get_sid->execute();
                $get_sid_result = $get_sid->get_result();
                $get_sid_row = $get_sid_result->fetch_assoc();
                $get_sid = $get_sid_row["cgid"];

                //get did id with desti name
                $get_did =$dbconnection->prepare($desti_id);
                $get_did->bind_param("s", $ndesti);
                $get_did->execute();
                $get_did_result = $get_did->get_result();
                $get_did_row = $get_did_result->fetch_assoc();
                $get_did = $get_did_row["cgid"];
                
                //get rid with src and desti
                $sr="SELECT r.rid FROM route r WHERE r.source=? and r.destination=?";
                $n_rid=$dbconnection->prepare($sr);
                $n_rid->bind_param("ii", $get_sid, $get_did);
                $n_rid->execute();
                $n_rid_result = $n_rid->get_result();                                            
                $n_rid_row = $n_rid_result->fetch_assoc();

                //check src and desti is route table rid
                if ( $n_rid_row > 0){
                    $n_rid = $n_rid_row["rid"];                  
                }
                else{
                    $_SESSION["npid"] = $_POST["npid"];
                    $_SESSION["nsrc"] = $_POST["nsrc"];
                    $_SESSION["ndesti"] = $_POST["ndesti"];
                    $_SESSION["noperator"] = $_POST["noperator"];
                    $_SESSION["nbusno"] = $_POST["nbusno"];
                    $_SESSION["ndate"] = $_POST["ndate"];
                    $_SESSION["ntime"] = $_POST["ntime"];
                  $flag3 = false;
                  echo "<script>window.alert('The source and destination are not in the route table. Please check!!'); </script>"; 
                  echo "<script>window.location.href='admin_plan.php?add=add'</script>";
                  exit;
                }


                

                        //get oid match with operator for input
                        $s2="SELECT o.oid FROM operator o WHERE o.oname=?";
                        $check_oid =$dbconnection->prepare($s2);
                        $check_oid->bind_param("s", $noperator);
                        $check_oid->execute();
                        $check_oid_result = $check_oid->get_result();
                        $check_oid_row = $check_oid_result->fetch_assoc();
                        $check_oid = $check_oid_row["oid"];
                        //echo "<script>window.alert('$check_oid ');</script>";
                        

                        //get bus id for input
                        $s3="SELECT b.oid FROM bus b WHERE b.busno=?";
                        $get_oid =$dbconnection->prepare($s3);
                        $get_oid->bind_param("s", $nbusno);
                        $get_oid->execute();
                        $check_busno_result =  $get_oid->get_result();
                        $check_busno_row = $check_busno_result->fetch_assoc();
                        $bus_oid = $check_busno_row["oid"];
                        //echo "<script>window.alert('$bus_oid');</script>";

                
                if($check_oid != $bus_oid){
                  
                  $_SESSION["npid"] = $_POST["npid"];
                  $_SESSION["nsrc"] = $_POST["nsrc"];
                  $_SESSION["ndesti"] = $_POST["ndesti"];
                  $_SESSION["noperator"] = $_POST["noperator"];
                  $_SESSION["nbusno"] = $_POST["nbusno"];
                  $_SESSION["ndate"] = $_POST["ndate"];
                  $_SESSION["ntime"] = $_POST["ntime"];
                  $flag4 = false;
                  echo "<script>window.alert('The bus no is not match with operator. Please check!!'); </script>"; 
                  echo "<script>window.location.href='admin_plan.php?add=add'</script>";
                  exit;
                 
                }

                
              //Check rid busno date are unique flag 5                
              $sql5 = "SELECT COUNT(*) FROM plan WHERE rid=? AND busno = ? AND ddate = ?  ";
              $stmt5 = $dbconnection->prepare($sql5);
              $stmt5->bind_param("iss",  $n_rid, $nbusno, $ndate);
              $stmt5->execute();
              $result5 = $stmt5->get_result();
              $row5 = $result5->fetch_assoc();
              if ($row5['COUNT(*)'] > 0) { 
                    $_SESSION["npid"] = $_POST["npid"];
                    $_SESSION["nsrc"] = $_POST["nsrc"];
                    $_SESSION["ndesti"] = $_POST["ndesti"];
                    $_SESSION["noperator"] = $_POST["noperator"];
                    $_SESSION["nbusno"] = $_POST["nbusno"];
                    $_SESSION["ndate"] = $_POST["ndate"];
                    $_SESSION["ntime"] = $_POST["ntime"];             
                $flag5 = false;
                echo "<script>window.alert('The route, date, busNo values must be unique in the plan table.'); </script>";
                echo "<script>window.location.href='admin_plan.php?add=add'</script>";
                exit;
              }


            //check cost info flag 6
            $sql6 = "SELECT c.costid FROM cost c WHERE c.rid = ? AND c.oid= ? ";            
            $stmt6 = $dbconnection->prepare($sql6);
            $stmt6->bind_param("ii", $n_rid, $bus_oid);
            $stmt6->execute();
            $result6 = $stmt6->get_result();
            //$x=$result6['costid'];
            //echo "<script>window.alert($x);</script>";
            if ($result6->num_rows > 0) {
               $flag6 = true;               
            } else {
                    $_SESSION["npid"] = $_POST["npid"];
                    $_SESSION["nsrc"] = $_POST["nsrc"];
                    $_SESSION["ndesti"] = $_POST["ndesti"];
                    $_SESSION["noperator"] = $_POST["noperator"];
                    $_SESSION["nbusno"] = $_POST["nbusno"];
                    $_SESSION["ndate"] = $_POST["ndate"];
                    $_SESSION["ntime"] = $_POST["ntime"];      
                $flag6 = false;                
                echo "<script>window.alert('There is no cost information about the route and operator in cost table.');</script>";
                echo "<script>window.location.href='admin_plan.php?add=add'</script>";
                exit;
            }
      
                
                //check pid is in bticket table flag 7                
                if ($stmt = $dbconnection->prepare("SELECT COUNT(*) FROM btickets WHERE pid = ?")) {
                    $stmt->bind_param("i", $npid);
                    $stmt->execute();
                    $count = $stmt->get_result()->fetch_row()[0];
                    $stmt->close();
                  } else {                    
                    echo "Error: " . $dbconnection->error;
                  }
                
                  if ($count == 0) {
                    $flag7 = true;                 
                
                  } else {
                    $_SESSION["npid"] = $_POST["npid"];
                    $_SESSION["nsrc"] = $_POST["nsrc"];
                    $_SESSION["ndesti"] = $_POST["ndesti"];
                    $_SESSION["noperator"] = $_POST["noperator"];
                    $_SESSION["nbusno"] = $_POST["nbusno"];
                    $_SESSION["ndate"] = $_POST["ndate"];
                    $_SESSION["ntime"] = $_POST["ntime"];
                    $flag7 = false;
                    echo "<script> window.alert('Cannot edit pid= $npid because bookings already reserved in the btickets table.'); </script>";
                    echo "<script>window.location.href='admin_plan.php?add=add'</script>";
                    exit;
                }


                if($flag1 == true && $flag2 == true && $flag3 == true && $flag4 == true && $flag5 == true && $flag6 == true && $flag7 == true)
                {
                  try {
                    
                   $add_query = 'INSERT INTO plan(pid,rid,busno,ddate,dtime) VALUES (:pid, :rid, :busno, :ddate, :dtime)  ';
                   $sta=$conn->prepare($add_query);
                   $sta-> bindValue(":pid", $npid, PDO::PARAM_INT );
                   $sta-> bindValue(":rid", $n_rid, PDO::PARAM_INT);
                   $sta->bindValue(':busno', $nbusno, PDO::PARAM_STR);
                   $sta->bindValue(':ddate', $ndate, PDO::PARAM_STR);
                   $sta->bindValue(':dtime', $ntime, PDO::PARAM_STR);

                   $sta->execute();
                   echo "<script>window.location.href='admin_plan.php'</script>";
                  } catch ( PDOException $e ) {
                    echo "Query failed: " . $e-> getMessage();
                  }
                }
}
  
if (isset($_POST["delete"])) 
{
    $d_pid = $_POST["action_id"];
  
    if ($stmt = $dbconnection->prepare("SELECT COUNT(*) FROM btickets WHERE pid = ?")) {
      $stmt->bind_param("i", $d_pid);
      $stmt->execute();
      $count = $stmt->get_result()->fetch_row()[0];
      $stmt->close();
    } else {
      // Handle the error
      echo "Error: " . $dbconnection->error;
    }
  
    if ($count == 0) {
      $dquery=$dbconnection->prepare("DELETE FROM plan WHERE pid=?");
      $dquery->bind_param("i", $d_pid);
      $result = $dquery->execute();
      
      $dquery->close();
    } else {
      echo "<script> window.alert('Cannot delete pid= $d_pid because bookings already reserved in the btickets table.'); </script>";
    }
}

                         
?>  

  <body>
  

<div class="wrapper">


  <div class="body-overlay"></div>
		

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
				
		  <li  class="active">
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
                    <h5>Manage Bus Plan Information</h5>
                    <form method="post" action="admin_plan.php">
                        <button type="submit" name="addbtn" class="add_btn d-flex flex-row">
                          <i class="fa-solid fa-plus" style="color: #ffffff; margin-top:5px;margin-right:10px;"></i> Add 
                        </button>
                    </form>  
                  </div>
                  <div class="search_part" style="margin:20px; float:right;">
                      <form method="post" action="admin_plan.php">
                        <input type="text" placeholder="Search..." name="search">
                        <button type="submit" name="search_bt" class="search"><i class="fa fa-search"></i></button>
                      </form>
                  </div>

                <div class="table-wrapper" style="background-color:#E7EEF4;">
                <div class="whole" style="background-color:#E7EEF4;">
                    
                    <div class="display-info" id="table_part">
                        <?php
                            if (isset($_POST['addbtn']) || isset($_GET["add"]) || isset($_POST['edit']) || isset($_GET["editerror"]) || isset($_POST['search_bt']) )  {

                                if(isset($_POST['addbtn']) || isset($_GET["add"]) )
                                {
                                    $next_pid = getNextPlanId(); 
                                    add_form($next_pid);
                                }

                                else if(isset($_POST['edit']))
                                {
                                    $e_pid = $_POST['action_id'];
                                    //echo $e_pid;
                                    $edit_row_query= "Select Distinct p.pid, cg1.town as town1, cg2.town as town2, o.oname, p.busno, p.ddate, p.dtime from plan p, route r, operator o, cargate cg1, cargate cg2, bus b WHERE p.rid=r.rid and cg1.cgid=r.source and cg2.cgid=r.destination and
                                    b.oid=o.oid and b.busno=p.busno and p.pid = $e_pid";
                                    $erow=$dbconnection->query($edit_row_query);
                                    $epid=$e_pid;
                                    while($edit_row = $erow->fetch_assoc())
                                    {
                                      $epid=$edit_row["pid"];
                                      $esrc=$edit_row["town1"];
                                      $edesti=$edit_row["town2"];
                                      $eoperator=$edit_row["oname"];
                                      $ebusno=$edit_row["busno"];
                                      $edate=$edit_row["ddate"];
                                      $etime=$edit_row["dtime"];

                                      show_edit_form($epid,$esrc,$edesti,$eoperator,$ebusno,$edate,$etime);
                                    }
                                }
                                else if(isset($_GET["editerror"]))
                                {
                                  show_edit_form('', '', '', '','','','');
                                }

                                else if(isset($_POST['search_bt']))
                                {                      
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
                            <th>Plan Id</th>
                            <th>Source</th>
                            <th>Destination</th>
                            <th>Operator</th>
                            <th>Bus No.</th>
                            <th>Date</th>
                            <th>Time</th>                              
                            <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php

                                include "admin_plan_function.php";
                                $townNames = getTownNames();
                                
                                $records_per_page = 10;
                                $current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                                $start = ($current_page - 1) * $records_per_page;
                                $total_rows = 0;
                                
                                  include 'connect.php';
                                  $sql = "SELECT COUNT(*) as total FROM plan";
                                  $result = $dbconnection->query($sql);
                                  $row = $result->fetch_assoc();
                                  $total_rows = $row['total'];
                                  $total_pages = ceil($total_rows / $records_per_page);   
                                   
                                  $sql = "Select Distinct p.pid, cg1.town as town1, cg2.town as town2, o.oname, p.busno, p.ddate, p.dtime from plan p, route r, operator o, cargate cg1, cargate cg2, bus b WHERE p.rid=r.rid and cg1.cgid=r.source and cg2.cgid=r.destination and
                                   b.oid=o.oid and b.busno=p.busno ORDER BY pid LIMIT $start, $records_per_page";
                                  $result = $dbconnection->query($sql);                                
                                                            
                                                                
                               
                                    if ($result->num_rows > 0) {
                                        // Fetch data from each row
                                        while ($row = $result->fetch_assoc()) {
                                            $pid = $row["pid"];                                           
                                            $src = $row["town1"];
                                            $desti=$row["town2"];
                                            $operator=$row["oname"];
                                            $busno=$row["busno"];
                                            $date=$row["ddate"];
                                            $time=$row["dtime"];

                                            $time_timestamp = strtotime($time);
                                            $time = date('H:i:s', $time_timestamp);

                                            $date = date('d-m-Y', strtotime($date));
                                            
                                          ?>
                                          <tr class="first_row" >
                                          <!--<td><input type="checkbox" name="crow[]" class="check_box" id="select_row"></td>-->
                                          <td><?php  echo $pid; ?></td>
                                          <td><?php  echo $src; ?></td>
                                          <td><?php  echo $desti; ?></td>
                                          <td><?php  echo $operator; ?></td>
                                          <td><?php  echo $busno; ?></td>
                                          <td><?php  echo $date; ?></td>
                                          <td><?php  echo $time; ?></td>
                                         
                                          <td class="d-flex flex-row justify-content-center"> 
                                              <form action="admin_plan.php" method="post" class="d-flex flex-row justify-content-evenly">
                                              <input type="hidden" value="<?php echo $pid; ?>" name="action_id">
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
                           <!--<th><input type="checkbox" name="hchc[]" class="check_box"></th>-->
                           <th>Plan Id</th>
                            <th>Source</th>
                            <th>Destination</th>
                            <th>Operator</th>
                            <th>Bus No.</th>
                            <th>Date</th>
                            <th>Time</th>                              
                            <th>Action</th>
                           </tr>
                           </thead>
                           <tbody>
                            <?php

                               include 'connect.php';
                               $search = $_POST['search'];
                              
                               $sql = "Select Distinct p.pid, cg1.town as town1, cg2.town as town2, o.oname, p.busno, p.ddate, p.dtime from plan p, route r, operator o, cargate cg1, cargate cg2, bus b WHERE p.rid=r.rid and cg1.cgid=r.source and cg2.cgid=r.destination and
                                   b.oid=o.oid and b.busno=p.busno and (
                                   p.pid LIKE '$search' OR
                                   cg1.town LIKE '$search' OR
                                   cg2.town LIKE '%$search%' OR
                                   o.oname LIKE '%$search%' OR
                                   p.busno LIKE '$search%' OR
                                   p.ddate LIKE '$search' OR
                                   p.dtime LIKE '$search' )";
                                $result = $dbconnection->query($sql);                                  

                               if ($result->num_rows > 0) {
                                // Fetch data from each row
                                while ($row = $result->fetch_assoc()) {
                                 
                                  $pid = $row["pid"];                                           
                                  $src = $row["town1"];
                                  $desti=$row["town2"];
                                  $operator=$row["oname"];
                                  $busno=$row["busno"];
                                  $date=$row["ddate"];
                                  $time=$row["dtime"];

                                  $time_timestamp = strtotime($time);
                                  $time = date('H:i:s', $time_timestamp);
                                  $date = date('d-m-Y', strtotime($date));
                                   
                                    
                        ?>
                                    <tr class="first_row" >
                                    <!--<td><input type="checkbox" name="crow[]" class="check_box" id="select_row"></td>-->
                                    <td><?php  echo $pid; ?></td>
                                    <td><?php  echo $src; ?></td>
                                    <td><?php  echo $desti; ?></td>
                                    <td><?php  echo $operator; ?></td>
                                    <td><?php  echo $busno; ?></td>
                                    <td><?php  echo $date; ?></td>
                                    <td><?php  echo $time; ?></td>
                                    
                                                                    
                                    <td class="d-flex flex-row justify-content-center"> 
                                        <form action="admin_plan.php" method="post" class="d-flex flex-row justify-content-evenly">
                                        <input type="hidden" value="<?php echo $pid; ?>" name="action_id">
                                        <!--<button type="submit" class="action_btn" name="view_more"><i class="fa-solid fa-eye"></i></button> -->
                                        <button type="submit" class="action_btn" name="edit"> <i class="fa-solid fa-pen-to-square"></i></button>
                                        <button type="submit" class="action_btn" name="delete" onclick="return Dconfirm()"> <i class="fa-solid fa-trash"></i> </button> 
                                        </form>
                                    </td>
                                    
                                    </tr>
                                
                              <?php   }
                                
                                } else {
                                        echo "<tr><td>No data found</td></tr>";
                                }

                           
                        
                            //delete
                            /*
                            if (isset($_POST["delete"]))
                            {

                                //echo "<script> window.alert('delete') ; </script>";
                                
                                $d_cid = $_POST["action_id"];
                                
                                //echo "<script> window.alert('delete') ; </script>";
                                $dquery=$dbconnection->prepare("DELETE FROM customer WHERE cid=$d_cid");
                                $dquery->execute();   
                            }   */
                          
                         ?>
                       
            
        
                          </tbody>
                          </table>
                          <form method="post" action="admin_plan.php" >
                            <button type="submit" style="margin: 10px 0px 30px 30px; background-color:#7895CB; border:none;" name="search_back" > <<< Back </button>
                          </form>

                          
                        <?php 
                          }

                          if (isset($_POST['search_back'])){
                             echo '<script> window.location("admin_plan.php")';
                          } 
                        
                        ?>





                      <?php function add_form($next_pid) { 
                          

                          include "admin_plan_function.php";
                          $townNames = getTownNames();
                          $opNames = getOperator();
                          $bus_no    = getBusNo();


                          function setValue($fieldName, $defaultValue = '')
                          {
                         
                              if (isset($_SESSION[$fieldName])) {

                                $temp = $_SESSION[$fieldName];
                                unset($_SESSION[$fieldName]);
                                  return $temp;
                              }
                              
                              return $defaultValue;
                          }

                          function setSelected($fieldName, $fieldValue) 
                          {
                              if (isset($_SESSION[$fieldName]) && $_SESSION[$fieldName] == $fieldValue) {
                                unset($_SESSION[$fieldName]);
                                  return 'selected="selected"';
                              }
                              return '';
                          }
                        
                        
                      ?>
                      <!-- add info from -->
                          <div class="add-on" id="add_info_show">
                              <h5>Add Bus Plan Information </h5>
                              

                              <form method="post" action="admin_plan.php">      
                              <table cellspacing="10px" border="0" class="add_table">
                              <tr>
                                  <td>Plan Id: <td>
                                  <td><input type="text" name="npid" value="<?php echo htmlspecialchars(setValue('npid',$next_pid)); ?>" required> </td>
                              </tr>
                              <tr>
                                  <td>Source: <td>
                                  <td>
                                  <select name="nsrc" required>
                                   <?php
                                      foreach ($townNames as $tn) {
                                          echo "<option value='{$tn['town']}' " . setSelected('nsrc', $tn['town']) . ">{$tn['town']}</option>";
                                      }
                                   ?>
                                  </select>
                                  </td> 
                                  </td>
                              </tr>
                              
                              <tr>
                                  <td>Destination: <td>
                                  <td>
                                  <select name="ndesti" required>
                                      <?php
                                          foreach ($townNames as $tn) {
                                            echo "<option value='{$tn['town']}'" . setSelected('ndesti', $tn['town']) . ">{$tn['town']}</option>";
                                          }
                                      ?>
                                  </select>
                                  </td>                                     
                                  </td>
                              </tr>

                              <tr>
                                  <td>Operator: <td>
                                  <td>
                                  <select name="noperator" required>
                                      <?php
                                          foreach ($opNames as $op) {
                                            echo "<option value='{$op['oname']}'" . setSelected('noperator', $op['oname']) . ">{$op['oname']}</option>";
                                          }
                                      ?>
                                  </select>
                                  </td>                                     
                                  </td>
                              </tr>

                              <tr>
                                  <td>Bus No: <td>
                                  <td>
                                  <select name="nbusno" required>
                                      <?php
                                          foreach ($bus_no as $bn) {
                                            echo "<option value='{$bn['busno']}'" . setSelected('nbusno', $bn['busno']) . ">{$bn['busno']}</option>";
                                          }
                                      ?>
                                  </select>
                                  </td>                                     
                                  </td>
                              </tr>

                              <tr>
                                  <td>Date: <td>
                                  <td><input type="date" name="ndate" value="<?php echo htmlspecialchars(setValue('ndate')); ?>" required></td>
                              </tr>
                              <tr>
                                  <td>Time: <td>
                                  <td><input type="time" name="ntime" value="<?php echo htmlspecialchars(setValue('ntime')); ?>" required></td>
                              </tr>
                             
                                  <td> </td>
                                  <td> </td>
                              </tr>
                              </table>
                              <a href="admin_plan.php" style="text-decoration:none;"><button type="button" class="back-btn" name="search_back"> <<< Back </button></a>
                              <button type="submit" name="add_btn" value="Add" class="btn_add" style="margin-bottom:40px;"> Add </button> </td>
                              </form>
                          </div>
                      <?php } ?>
          
            

            
                        <?php function show_edit_form($epid,$esrc,$edesti,$eoperator,$ebusno,$edate,$etime){

                                include "admin_plan_function.php";
                                $townNames = getTownNames();
                                $opNames = getOperator();
                                $bus_no    = getBusNo();

                                function setValueedit($fieldName, $defaultValue = '')
                                {

                                    if (isset($_SESSION[$fieldName]))
                                    {

                                      $temp = $_SESSION[$fieldName];
                                      unset($_SESSION[$fieldName]);
                                        return $temp;
                                    }
                                    
                                    return $defaultValue;
                                }

                                function setSelectededit($fieldName, $fieldValue, $origin) 
                                {
                                    if (isset($_SESSION[$fieldName]) && $_SESSION[$fieldName] == $fieldValue)
                                    {
                                      unset($_SESSION[$fieldName]);
                                        return 'selected="selected"';
                                    }

                                    else if($fieldValue == $origin)
                                    {
                                      return 'selected="selected"';
                                    }
                                    return '';
                                }
                            
                                 /*echo $epid;
                                 echo $ebusno;
                                 echo $eoperator;
                                 echo $esrc;
                                 echo $edesti;*/
                          
                          
                          ?>
                        <!-- edit info from -->
                            <div class="add-on" id="add_info_show">
                                <h4>Edit Bus Plan Information </h4>
                                <div style="border-bottom:1px solid black">
                                </div>

                                

                                <form method="post" action="admin_plan.php"  enctype="multipart/form-data"> 
                                  <input type="hidden" name="opid_origin" value="<?php echo htmlspecialchars(setValueedit('opid_origin',$epid)); ?>">    
                                  <input type="hidden" name="osrc_origin" value="<?php echo htmlspecialchars(setValueedit('osrc_origin',$esrc)); ?>">
                                  <input type="hidden" name="odesti_origin" value="<?php echo htmlspecialchars(setValueedit('odesti_origin',$edesti)); ?>"> 
                                  <input type="hidden" name="op_origin" value="<?php echo htmlspecialchars(setValueedit('op_origin',$eoperator)); ?>">
                                  <input type="hidden" name="bus_origin" value="<?php echo htmlspecialchars(setValueedit('bus_origin',$ebusno)); ?>">
                                  <input type="hidden" name="date_origin" value="<?php echo htmlspecialchars(setValueedit('date_origin',$edate)); ?>">
                                  <input type="hidden" name="time_origin" value="<?php echo htmlspecialchars(setValueedit('time_origin',$etime)); ?>">  
                                <table cellspacing="10px" border="0" class="add_table">
                                <tr>
                                    <td>Plan Id: <td>
                                    <td><input type="text" name="opid" value="<?php echo htmlspecialchars(setValueedit('opid',$epid)); ?>" required> </td>
                                </tr>
                                <tr>
                                    <td>Source: <td>
                                    <td>
                                    <select name="osrc" required>
                                     <?php
                                        foreach ($townNames as $tn) {
                                            echo "<option value='{$tn['town']}' " . setSelectededit('osrc', $tn['town'], $esrc) . ">{$tn['town']}</option>";
                                        }
                                     ?>
                                    </select>
                                    </td>
                                </tr>

                                <tr>
                                    <td>Destination: <td>
                                    <td>
                                    <select name="odesti" required>
                                     <?php
                                        foreach ($townNames as $tn1) {
                                            echo "<option value='{$tn1['town']}' " . setSelectededit('odesti', $tn1['town'], $edesti) . ">{$tn1['town']}</option>";
                                        }
                                     ?>
                                    </select>
                                     </td>
                                </tr>
                                
                                <tr>
                                    <td>Operator: <td>
                                    <td>
                                    <select name="ooperator" required>
                                     <?php
                                        foreach ($opNames as $op) {
                                            echo "<option value='{$op['oname']}' " . setSelectededit('ooperator', $op['oname'], $eoperator) . ">{$op['oname']}</option>";
                                        }
                                     ?>
                                    </select>
                                     </td>
                                </tr>

                                <tr>
                                    <td>Bus No: <td>
                                    <td>
                                    <select name="obusno" required>
                                     <?php
                                        foreach ($bus_no as $bn) {
                                            echo "<option value='{$bn['busno']}' " . setSelectededit('obusno', $bn['busno'], $ebusno) . ">{$bn['busno']}</option>";
                                        }
                                     ?>
                                    </select>
                                     </td>
                                </tr>

                                <tr>
                                    <td>Date: <td>
                                    <td><input type="date" name="odate" value="<?php echo htmlspecialchars(setValueedit('odate',$edate)); ?>" required> </td>
                                </tr>
                                <tr>
                                    <td>Time: <td>
                                    <td><input type="time" name="otime" value="<?php echo htmlspecialchars(setValueedit('otime',$etime)); ?>" required> </td>
                                </tr>
                                
                                <tr>
                                    <td> </td>
                                    <td> </td>
                                </tr>
                                </table>
                                <a href="admin_plan.php" style="text-decoration:none; width:fit-content;" ><button type="button" name="search_back" class="back-btn"> <<< Back </button><a>
                                <button type="submit" name="edit_btn" value="Save Changes" class="btn_add" style="margin-bottom:40px;">Save</button> </td>
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


function getNextPlanId() {
    global $conn; 

    try {
        
        $sql2 = "SELECT MAX(pid) AS max_pid FROM plan";
        $stmt2 = $conn->prepare($sql2);
        $stmt2->execute();
        
        
        $result2 = $stmt2->fetch(PDO::FETCH_ASSOC);

       
        if ($result2['max_pid'] === null) {
            return 1;
        } else {
            
            return $result2['max_pid'] + 1;
        }
    } catch (PDOException $e) {
        
        echo "Error: " . $e->getMessage();
        return null;
    }
}
?>  
  
 
  </html>