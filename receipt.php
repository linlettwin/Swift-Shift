<?php
session_start();
if (!isset($_SESSION["customer"])) {
    $_SESSION["path"]="bus_page_2.php";
    echo "<script> window.alert('Please Login or Signup first!''); </script>";
    header("Location: SignUP.php");
    exit();
}

function connect()
{
    try{
        $conn = new PDO( "mysql:dbname=transport", "root", "" );
        $conn->setAttribute( PDO::ATTR_PERSISTENT, true );
        $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    }catch ( PDOException $e ){
        die( "Connection failed: " . $e->getMessage() );
    }
     
     return $conn;
}

function unsetSESSION($fieldName)
{
    if (isset($_SESSION[$fieldName]))
    {
        unset($_SESSION[$fieldName]);
    }
}

if(isset($_POST["logout"])){
  
 
  unset($_SESSION["customer"]);
  unsetSESSION("from");
  unsetSESSION("to");
  unsetSESSION("date");
  unsetSESSION("time");
  unsetSESSION("passno");
  unsetSESSION("price");
  unsetSESSION("pid");
  unsetSESSION("oname");
  unsetSESSION("ddate");
  unsetSESSION("dtime");
  unsetSESSION("Texts");
  unsetSESSION("Totals");
  unsetSESSION("tname");
  unsetSESSION("tphone");
  unsetSESSION("special");
  unsetSESSION("paymethod");
  unsetSESSION("payimage");
  unsetSESSION("sourceaddress");
  unsetSESSION("destinationaddress");
  unsetSESSION("crid");
  unsetSESSION("departureDate");
  unsetSESSION("weight");
  unsetSESSION("categories");
  unsetSESSION("totalamounts");
  unsetSESSION("note");
  unsetSESSION("sname");
  unsetSESSION("semail");
  unsetSESSION("stele");
  unsetSESSION("rname");
  unsetSESSION("remail");
  unsetSESSION("rtele");
  unsetSESSION("screenshot");
  unsetSESSION("cargo_source1");
  unsetSESSION("cargo_destination1");
  unsetSESSION("cargo_source2");
  unsetSESSION("cargo_destination2");

  header("Location: home.php");
  exit();


}

$profile_pic = "default_user.png";
// Access the admin object stored in the session variable
$customer = $_SESSION["customer"];

include "connect.php";
// Query the database to get the admin's information
$sql = "SELECT * FROM customer WHERE cid = ?";
$stmt = $dbconnection->prepare($sql);
$stmt->bind_param("i", $customer);
$stmt->execute();
$result = $stmt->get_result();

// Check if the query was successful
if ($result === false) {
    die("Query failed: " . $conn->error);
}

// Fetch the admin's information from the result set
$customer = $result->fetch_assoc();
if (isset($customer['photo']))
{  $profile_pic= $customer['photo']; }

$photo = $customer['photo'];
$cid=$customer['cid'];
$name = $customer['name'];
$_SESSION['email']=$customer['email'];

$sql = "SELECT count(*) as count FROM get_cargo_service WHERE ((status = 'Approved' AND seen='No') OR (status='Disapproved' AND seen='No')) AND cid = :customer;";

try 
{
    $stmt = $conn->prepare($sql);
    // Assuming $customer is an integer. Use PARAM_STR if it's a string.
    $stmt->bindParam(':customer', $customer, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result !== false) {
        // Access the count using the alias
        $count1 = $result['count'];
    } 
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$sql = "SELECT COUNT(DISTINCT CONCAT(bpname, bdate, btime)) AS group_count FROM btickets WHERE ((status = 'Approved' AND seen='No') OR (status='Disapproved' AND seen='No')) AND cid = :customer;";

try {
    $stmt = $conn->prepare($sql);
    // Assuming $customer is an integer. Use PARAM_STR if it's a string.
    $stmt->bindParam(':customer', $customer, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result !== false) {
        // Access the count using the alias
        $count2 = $result['group_count'];
    } 
} catch (PDOException $e) {
   // echo "Error: " . $e->getMessage();
}

$count = $count1 + $count2;
//echo $count;


if(isset($_GET["gid"])) {
    $gid = $_GET["gid"];
    $sql = "SELECT * FROM get_cargo_service WHERE gid = :gid";

    try {
        $conn = connect(); // Assuming connect() is a function that returns a PDO connection
        
        $stmt = $conn->prepare($sql);
        
        // Bind the :gid parameter to the $gid variable
        $stmt->bindParam(':gid', $gid, PDO::PARAM_STR);
        
        // Execute the prepared statement
        $stmt->execute();
        
        // Fetch all results
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
    } catch (PDOException $e) {
        // Consider logging the error instead of displaying it directly
        error_log("Query failed: " . $e->getMessage());
        // Show a generic error message to the user
        echo "An error occurred while fetching data. Please try again later.";
    }

    $sql8 = "SELECT cr.cargo_src, cr.cargo_dest 
        FROM cargo_route cr, get_cargo_service g 
        WHERE g.crid = cr.crid AND g.gid = :gid";

        try {
        $conn = connect(); // Assuming connect() is a function that returns a PDO connection
        $stmt = $conn->prepare($sql8);

        
        // Bind the :gid parameter to the $gid variable
        $stmt->bindParam(':gid', $gid, PDO::PARAM_STR);

        // Execute the prepared statement
        $stmt->execute();

        // Fetch the first result row
        $place = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($place) { // Check if any result was found
            $cargo_source = $place['cargo_src'];
            $cargo_destination = $place['cargo_dest'];

            // Use $cargo_source and $cargo_destination as needed
        } else {
            // Handle the case where no matching row was found
            echo "No results found.";
        }
        } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
        }
}


if (isset($_FILES["image"]["name"])) {
  $file_name = $_FILES['image']['name'];
  $tempname = $_FILES['image']['tmp_name'];
  $folder = 'images/user/' . $file_name;

  
  $stmt = $conn->prepare("UPDATE customer SET photo=? Where cid=$cid");
  $stmt->execute([$file_name]);
  move_uploaded_file($tempname,$folder);
  header("Location: bus_page_2.php");

}

function setValue($fieldName)
{
    if (isset($_SESSION[$fieldName]))
    {
        return $_SESSION[$fieldName];
    }
}


if(isset($_GET["bpname"])) {
    $bpname = $_GET["bpname"];
   // echo "bpname: " . $bpname . "<br>";
}
if(isset($_GET["bdate"])) {
    $bdate = $_GET["bdate"];
   // echo "bdate: " . $bdate . "<br>";
}
if(isset($_GET["btime"])) {
    $btime = $_GET["btime"];
    //echo "btime: " . $btime . "<br>";
}
try {
    $conn = connect();

    $sql3 = "SELECT numberofseats, pid, GROUP_CONCAT(seatno) AS seatnos, status, screenshot, seen, bpname, bpphone, bdate, btime, bcost, paymethod, special, message 
             FROM btickets 
             WHERE bpname=:bpname AND bdate=:bdate AND btime=:btime
             GROUP BY bpname, bdate, btime  
             ORDER BY bdate DESC, btime DESC";

    $stmt = $conn->prepare($sql3);
    $stmt->bindParam(':bpname', $bpname, PDO::PARAM_STR);
    $stmt->bindParam(':bdate', $bdate, PDO::PARAM_STR);
    $stmt->bindParam(':btime', $btime, PDO::PARAM_STR);
    
    $stmt->execute();

    $historys = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Query failed: " . $e->getMessage());
}

$sql4 = "SELECT cg.town AS source, cg.cgaddress AS sourceaddress
         FROM cargate cg
         JOIN route r ON r.source = cg.cgid
         JOIN plan p ON p.rid = r.rid
         WHERE p.pid = :pid";

try {
    $conn = connect();

    // Assuming $historys contains the booking history array
    $stmt = $conn->prepare($sql4);
    $stmt->bindParam(':pid', $historys[0]['pid'], PDO::PARAM_INT); // Assuming there's only one booking in $historys
    $stmt->execute();

    // Fetch the result
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    // Assign values to variables
    $source = $result['source'];
    $sourceaddress = $result['sourceaddress'];
} catch (PDOException $e) {
    die("Query failed: " . $e->getMessage());
}

                
$sql5 = "SELECT cg.town AS destination, cg.cgaddress AS destinationaddress
FROM cargate cg
JOIN route r ON r.destination = cg.cgid
JOIN plan p ON p.rid = r.rid
WHERE p.pid = :pid";

try {
$conn = connect();

// Assuming $historys contains the booking history array
$stmt = $conn->prepare($sql5);
$stmt->bindParam(':pid', $historys[0]['pid'], PDO::PARAM_INT); // Assuming there's only one booking in $historys
$stmt->execute();

// Fetch the result
$result = $stmt->fetch(PDO::FETCH_ASSOC);

// Assign values to variables
$destination = $result['destination'];
$destinationaddress = $result['destinationaddress'];
} catch (PDOException $e) {
die("Query failed: " . $e->getMessage());
}


$sql6 = "SELECT ddate, dtime,busno FROM plan WHERE pid = :pid";

try {
    $conn = connect();

    // Assuming $historys contains the booking history array
    $stmt = $conn->prepare($sql6);
    $stmt->bindParam(':pid', $historys[0]['pid'], PDO::PARAM_INT); // Assuming there's only one booking in $historys
    $stmt->execute();

    // Fetch the result
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    // Check if a row is returned
    if ($result) {
        // Assign values to variables
        $ddate = $result['ddate'];
        $dtime = $result['dtime'];
        $busno = $result["busno"];
        $dateTime = new DateTime("$ddate $dtime");
        $formattedDateTime = $dateTime->format('j M Y h:ia');
    } else {
        // Handle case where no rows are returned
        // For example, set $formattedDateTime to a default value or display an error message
        $formattedDateTime = "Departure date and time not found";
    }
} catch (PDOException $e) {
    die("Query failed: " . $e->getMessage());
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="receipt.css">
  <link rel="icon" type="image/png" href="images/bc_logo.png" />
  <title>Swift Shift</title>

  <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
  rel="stylesheet">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2"
    crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>

    <!--google fonts -->
	
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    <style>
        body,html{
            font-family: "Poppins", sans-serif;
        }

        *{
    box-sizing: border-box;
    margin: 0;
    padding: 0;
 

}
body {
    font-family: "Poppins", sans-serif;
    --color1: #FFF ;
    --color2:  #688dc4;
    background-color:#E7EEF4;
   

}
@import url('https://fonts.googleapis.com/css2?family=Itim&display=swap');


/*general nav*/
.nav-bar {
    width: auto;
    display: flex;
    justify-content: space-between;
    align-items: center;
    list-style: none;
    position: relative;
    background-color: #7895CB;
    padding: 12px 20px;
    z-index:2px;
    
  }
  
  /* Styles for the logo */
  .logo img {
    width: 40px;
  }
  .nav-bar img{
    width:100px;
    height:60px;
    margin-left:40px;
    
  }
  
  /* Styles for the main menu */
  .menu {
    display: flex;
    margin-right: 0px;
    position: relative; 
    margin-left:85px;
  }
  
  .menu li {
    position: relative;
    padding-left: 15px;
    padding-right: 15px;
    margin-right:40px;
  }
  
  .menu li a {
    display: inline-block;
    text-decoration: none;
    color: var(--color1);
    text-align: center;
    /*transition: 0.15s ease-in-out;*/
    position: relative;
    text-transform: uppercase;
    font-size: 13px;
    font-weight: bold;
  }
  
  /* Styles for the submenu */
  .submenu {
    left: 0;
    right:0;
    z-index:5;
    opacity: 0;
    position: absolute;
    top: 100%;
    visibility: hidden;
    z-index:5;
    list-style: none; 
    padding:0; 
    background-color: #D8E5F2; 
    
    /*transition: 0.15s ease-in-out;*/
    max-height: 150px; /* Set a maximum height for the submenu */
    /*overflow-y: auto;*/
    scrollbar-width: thin; 
    scrollbar-color: var(--color2) var(--color1);
  
    }
  
    .submenu::-webkit-scrollbar {
        width: 10px; /* Width of the scrollbar */
    }
    
    .submenu::-webkit-scrollbar-thumb {
        background-color:white; /* Color of the scrollbar thumb */
    }
  
  .submenu li {
    float: none;
    width: 100%;
    list-style: none;
    padding-top: 6px;
    background-color:#7895CB;
    
  }
  .menu li:hover .submenu {
    opacity: 1;
    visibility: visible;
    top: 100%;
    width:100px;
    background-color:#7895CB ;
    color:white;
    text-align:center;
  
  }
  .menu li:hover a{
    color:white;
    
  }
  .submenu li:hover {
    background-color: #7895CB; 
    border:2px solid white;
  }
  .submenu li:hover .submenu li a{
    color:black;
  }
  
  .menu li a::after {
    content: "";
    position: absolute;
    bottom: 0;
    left: 0;
    width: 0;
    height: 1px;
    background-color:white; /* underline effect*/
    transition: 0.15s ease-in-out;
  }
  .drop_list{
    text-align:center;
    padding:0px;
  }
  
  .menu li:hover a::after {
    width: 100%;
  }
  .submenu li a::after {
    content: none; 
  }
  
  /* Styles for the menu toggle icons */
  .open-menu, .close-menu {
    background-color:#7895CB;
    position: absolute;
    color: var(--color1);
    cursor: pointer;
    font-size: 1.5rem;
    display: none;
  }
  
  .open-menu {
    top: 50%;
    right: 20px;
    transform: translateY(-50%);
  }
  
  .close-menu {
    top: 20px;
    right: 20px;
  }
  
  /* Hide the checkbox input */
  #check {
    display: none;
  }
  #login_user{
    width:40px;
    height:40px;
    border-radius:50%;
    align-items:center;
    margin-right:0px;
    margin-left:0px;
  }
  #login_user:hover{
    text-decoration: none;
  }
  
  /* Media query for mobile responsiveness */
  @media (max-width: 800px) {
    .menu {
        flex-direction: column;
        align-items: center;
        justify-content: center;
        width: 80%;
        height: 100vh;
        position: fixed;
        top: 0;
        right: -100%;
        z-index: 100;
        background-color: var(--color2);
        transition: all 0.2s ease-in-out;
    }
  
    .menu li {
        margin-top: 40px;
    }
  
    .menu li a {
        padding: 10px;
        font-size: 15px;
        text-align:center;
    }
  
    /* Display the menu toggle icons */
    .open-menu, .close-menu {
        display: block;
    }
  
    /* Show the menu when the checkbox is checked */
    #check:checked ~ .menu {
        right: 0;
    }
    .submenu {
        width:auto;
        background-color:#E7EEF4;
        overflow-y: auto;
        max-height: 150px;
        overflow-x:hidden;
        scrollbar-width: thin; 
        scrollbar-color: var(--color2) var(--color1);
        }
        .submenu::-webkit-scrollbar {
            width: 6px; /* Width of the scrollbar */
            
        }
        
        .submenu::-webkit-scrollbar-thumb {
            background-color: var(--color1); /* Color of the scrollbar thumb */
        }
    
    .submenu li {
        float: none;
        width: 150px;
        list-style: none;
        padding-top: 6px;
        background-color:#7895CB ;
        color:black;
        
    }
    .menu li:hover .submenu {
        opacity: 1;
        visibility: visible;
        top: 100%;
        width:150px;
        height:auto;
        background-color:#7895CB ;
    
    }
    .menu li:hover .submenu a{
        color:white;
        
    }
    menu li a::after {
        content: "";
        position: absolute;
        bottom: 0;
        left: 0;
        width: 0;
        height: 1px;
        background-color: var(--color1);
        transition: 0.15s ease-in-out;
    }
  
    .menu li:hover a::after {
        width: 100%;
    }
    .submenu li a::after {
        content: none; 
    }
  }

.whole{
    padding-top:30px;
    display:flex;
    flex-direction:column;
    justify-content:center;
    margin-bottom:30px;
}
.progress-bar-place{
    margin-left:60px;
    margin-right:60px;
}
.step-wizard {   
    width: 100%;
    margin-left:60px;
    margin-right:60px;
}
.step-wizard-list{
    color: #333;
    list-style-type: none;
    display: flex;
    padding: 20px 10px;
    position: relative;
    z-index:1;
}

.step-wizard-item{
    padding: 0 20px;
    flex-basis: 0;
    -webkit-box-flex: 1;
    -ms-flex-positive:1;
    flex-grow: 1;
    max-width: 100%;
    display: flex;
    flex-direction: column;
    text-align: center;
    width: 170px;               /*max-width*/
    position: relative;
}
.step-wizard-item + .step-wizard-item:after{
    content: "";
    position: absolute;
    left: 0;
    top: 19px;
    background: #21d4fd;  
    width: 100%;
    height: 2px;
    transform: translateX(-50%);
    z-index: -10;
}
.progress-count{
    height: 40px;
    width:40px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;  
    font-weight: 600;
    margin: 0 auto;
    position: relative;
    z-index:10;
    color: transparent;
}
.progress-count:after{
    content: "";
    height: 40px;
    width: 40px;
   background: #21d4fd; 
    position: absolute;
    left: 50%;
    top: 50%;
    transform: translate(-50%, -50%);
    border-radius: 50%;
    z-index: -10;
}
.progress-count:before{
    content: "";
    height: 10px;
    width: 20px;
    border-left: 3px solid #fff;
    border-bottom: 3px solid #fff;
    position: absolute;
    left: 50%;
    top: 50%;
    transform: translate(-50%, -60%) rotate(-45deg);
    transform-origin: center center;
}   
.progress-label{
    font-size: 14px;
    font-weight: 600;
    margin-top: 10px;
}
.current-item .progress-count:before,
.current-item ~ .step-wizard-item .progress-count:before{
    display: none;
}
.current-item ~ .step-wizard-item .progress-count:after{
    height:10px;
    width:10px;
}
.current-item ~ .step-wizard-item .progress-label{
    opacity: 0.5;
}
/* finished background all blue */
.current-item .progress-count:after{
    background: #fff;
    border: 2px solid #21d4fd;
}  
.current-item .progress-count{
    color: #21d4fd;
} 


/* Responsive Css  */

@media (max-width: 850px) {
    .progress-bar-place{
        margin-left:0px;
        margin-right:0px
    }
    .step-wizard{
        min-width:300px;
        margin-left:20px;
        margin-right:20px;
    }
    .step-wizard-item{
        width:100%;
    }
    .step-wizard-list{
        width:100%;
    }
    .step-wizard-item + .step-wizard-item:after{
       max-width:100%;
    }
}
.div_2_col {
    margin-top: 50px;
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    margin-left: auto;
    margin-right: auto; /* Center the element horizontally */
    max-width: 650px; /* Adjust the maximum width as needed */
    margin-bottom: 50px;
}

.info_place {
    width: 600px;
    height: auto;
    background-color: #D8E5F2;
}

.title1 {
    background-color: #7895CB;
    color: white;
    align-items: center;
    padding: 20px;
    justify-content: space-between;
}

.logo-and-receipt {
    display: flex;
    align-items: center;
}

.receiptNo {
    margin-left: 250px;
}

.logo {
    margin-right: 20px;
}

.title1 h5 {
    color: white;
    text-align: center;
}

.user_info {
    display: flex;
    flex-direction: column;
    justify-content: center;
}

@media (max-width: 850px) {
    .div_2_col {
        flex-direction: column;
        justify-content: space-between;
        margin-left: 20px; /* Adjust margin for smaller screens */
        margin-right: 20px;
        margin-top: 30px;
        
        
    }

    .info_place {
        max-width: 600px;
        max-height: 1050px;
        background-color: #D8E5F2;
        margin-left: 0; /* Remove left margin for smaller screens */
    }
}

@media (max-width: 500px) {
    .div_2_col {
        flex-direction: column;
        justify-content: center;
        margin-left: 0; /* Remove left margin for smaller screens */
        margin-right: 0;
        margin-top: 30px;
        width: 600px;
    }

    .info_place {
        width: 300px;
        max-height: 400px;
        background-color: #D8E5F2;
    }
}




    .user_info{
        display:flex;
        flex-direction:column;
        justify-content:center;
        margin:20px;
        padding:20px;
    }
    
    .payment{
        display:none;
    }
    
    
    th{
        font-weight:bold;
        width:200px;
        height:20px;
        text-align:center;
        font-size:17px;
        padding:5px;
    }
    td{
        width:100px;
        height:20px;
        text-align:left;
        font-size:17px;
        padding:5px 60px;
        margin-left: 90px;
    }
    tr{
        border-spacing:20px;
        margin-bottom:100px;
    }
    .line{
        border-top: 2px dashed grey;
        padding-top:20px;
        width: 70%;
    }
    .for_btn{
        display:flex;
        flex-direction:column;
        justify-content:center;
        margin-top:40px;
        
    }
    .show_btn{
        width:100%;
        height:50px;
        text-align:center;
        background-color:#7895CB;
        color:white;
        border:none;
    }
    .ok_button{
        margin-left: 20px;
        padding: 8px 15px;
        background-color: #7895CB;
    }  
    
    
    
    /*footer*/
    .footerb{
        background-color: #4c4d4b;
    }
    .link_info{
        text-decoration:none;
        color:white;
     }
     .col a:hover {
         color:#7895CB;
         text-decoration:underline;
         text-decoration-color: white;
     
     }
    .social {
        font-size: 30px;
        padding: 5px;
        justify-content: space-between;
        align-items: center;
    }
    .linkIcn {
        padding: 10px 30px;
        color: white;
    }
    .copyright{
        font-size: 10px;
    }
    .custom-bg-gray {
        background-color: #4c4d4b;
        /*margin-top: 30px;*/
        
    }
    .container-fluid{
        margin-top: 20px;
    }
    .row{
        margin-top: 30px; 
    } 
    .custom-border {
        border-bottom: 1px solid #ffffff; 
    }


    /* Initially hide the div */
 .hidden-div {
                display: none;
                position: absolute;
                top: 56px;
                right: 0;
                width: 80%;
                max-width: 350px;
                height: 80%;
                max-height: 300px;
                padding: 15px;
                background: rgba(232, 232, 232, 1);
                border-radius: 12px;
                text-align: center;
                z-index:10;
            }

            /* Show the div when it's targeted */
            .hidden-div:target {
                display: block;
            }

            .hidden-div .round {
                position: absolute;
                top: 72px;
                right: 40%;
                background: #00B4FF;
                width: 22px;
                height: 22px;
                line-height: 23px;
                text-align: center;
                border-radius: 50%;
                overflow: hidden;
                
            }

            .hidden-div .round input[type="file"] {
                position: absolute;
                transform: scale(2);
                opacity: 0;
                

            }

            .accountIcon {
                width: 50px;
                height:50px;
                border-radius: 50%;
            }

            .accountIconInside {
                width: 80px;
                height: 80px;
                border-radius: 50%;
                border: 3px solid #DCDCDC;
            }

            input[type=file]::-webkit-file-upload-button {
                cursor: pointer;
            }

            .hidden-div h3{
                position: absolute;
                top: calc(50% - 50px);
                left: 40%;
                font-size:18px;
                
            }

            .manage {
                font-size: 14px;
                position: absolute;
                top: calc(50% + 20px);
                width: 70%;
                border-radius: 15px;
                padding: 8px;
                left: 50%;
                transform: translateX(-50%);
                outline: 1px solid white;
                background: #7895CB;
                color: white;
                cursor: pointer;
                margin-top:-30px;
            }

            

            .history {
                font-size: 14px;
                position: absolute;
                top: calc(50% + 70px);
                width: 70%;
                left: 50%;
                transform: translateX(-50%);
                outline: 1px solid white;
                background: #7895CB;
                color: white;
                border-radius: 15px;
                padding: 8px;
                cursor: pointer;
                margin-top:-30px;
            }

            .logout {
                font-size: 14px;
                position: absolute;
                top: calc(50% + 130px);
                width: 70%;
                left: 50%;
                transform: translateX(-50%);
                outline: 1px solid white;
                text-decoration: none;
                background: #7895CB;
                color: white;
                border-radius: 15px;
                padding: 8px;
                cursor: pointer;
                margin-top:-40px;
               
            }

        #subt{
        background-color:#F18D65;
        width:200px;
        height:40px;
        text-align:center;
        padding:5px;
        border-radius:5px;
        border-color:#F18D65;        
        margin-top:10px;
      }

        .notification-container {
            display: inline-block;
          }

          .badge {
            top: -5px;
            left: 10px;
            right: -5px;
            background-color: red; /* Choose the background color */
            color: white;
            padding: 5px;
            border-radius: 50%; /* To create a circular shape for the badge */
            font-size: 12px; /* Adjust the font size as needed */
          }

    
    </style>

</head>
<body>
<header>
        
        <nav>
            <ul class='nav-bar'>
                    <img src='./images/logo1.png'>
                <input type='checkbox' id='check' />
                <span class="menu">
                  
                    <li><a href="home.php">Home</a></li>
                    <li><a href="bus_page_1.php">Bus Ticket</a>
                      
                    </li>
                    <li><a href="cargo_page_1.php">Cargo</a>
                      
                    </li>
                    <li><a href="home.php#cont_us">Contact Us</a></li>
                    <li>
                      <?php 
                         echo '<a href="#hidden-div" class="trigger"><img src="images/user/'. $profile_pic . '" id="login_user"> </a>';
                      ?>
                      
                    </li>
                     <?php if(isset($_SESSION["customer"])) { ?>
                    <li>
                      <div class="notification-container"style="margin-top:5px;">
                      <a href="historyClick.php"><i class="fas fa-bell fa-xl"></i><span class="badge" id="badge" <?php if($count == 0) echo "hidden" ?>><?php if($count) { echo $count; } ?></span></a>
                      </div>
                     
                    </li>
                    <?php } ?>
                    <label for="check" class="close-menu"><i class="fas fa-times"></i></label>
                  
                </span>
                <label for="check" class="open-menu"><i class="fas fa-bars"></i></label>
            </ul>
        </nav>
        </header>
    
        <!-- Div to show/hide (targeted by the link) -->
        <div id="hidden-div" class="hidden-div">
              <form id="form" class="form" enctype="multipart/form-data" method="post" action="">
                  <img src="images/user/<?php echo $customer['photo']; ?>" class="accountIconInside" title="<?php echo $customer['photo']; ?>">
                  <div class="round">
                      <input type="hidden" name="id" value="<?php echo $_SESSION['customer']; ?>">
                      <input type="hidden" name="name" value="<?php echo $name; ?>">
                      <input type="file" name="image" id="image" accept=".jpg, .jpeg, .png">
                      <i class="fa fa-camera" style="color: #fff;"></i>
                  </div>
                  <h5>Hi, <?php echo $name; ?>!</h5>
                  <button type="submit" class="manage" name="manage" value="manage">Manage your Account Info</button>
                  <button type="submit" class="history" name="history" value="history">View your Previous History</button>
                  <button type="submit" class="logout" name="logout"  id="logout" onclick="return check_logout()">Log Out</button>
              </form>
      </div>

    <!--whole container for info and payment-->
    <div class="whole">
       
       
         <div class="div_2_col"> 
            <div class="info_place">

                <div class="title1">
                    <h5>Thank You for trusting Us!</h5>
                    <div class="logo-and-receipt"style="display:flex;justify-content:center;">
                        <div class="logo" style="display:flex;justify-content:center;aligh-items:center;">
                            <img src="./images/logo1.png" style="width: 100px; height: 70px;">
                        </div>
                        
                    </div>
                </div>
                
                
             
                
                <div class="user_info">
                    <div class="show_info_booking">
                       <table>
                        <tr>
                            <th>Name: </th>
                            <td><?php echo $historys[0]['bpname'] ?></td>
                            
                        </tr>
                        <tr>
                            <th>Phone Number: </th>
                            <td><?php echo $historys[0]['bpphone'] ?></td>
                            
                        </tr>
                        <tr>
                            <th>Email: </th>
                            <td><?php echo setValue("email"); ?></td>
                            <td> </td>
                        </tr>
                        <tr class="line"></tr>
                        <tr>
                            <th>Busno: </th>
                            <td><?php echo $busno; ?></td>
                            
                        </tr>
                        <tr>
                            <th>Route:</th>
                            <td><?php echo $source; ?> - <?php echo $destination; ?></td>
                            
                        </tr>
                        <tr>
                            <th>Departure Time:</th>
                            <td><?php echo $formattedDateTime; ?></td>
                            <td> </td>
                        </tr>
                        <tr class="line"></tr>
                        <tr>
                            <th>Number of Seats:</th>
                            <td><?php echo $historys[0]['numberofseats'] ?></td>
                           
                        </tr>
                        <tr>
                            <th>Seat Number(s):</th>
                            <td><?php echo $historys[0]['seatnos'] ?></td>
                            <td> </td>
                        </tr>
                        <tr class="line"></tr>
                        <tr>
                            <th>Total:</th>
                            <td><?php echo $historys[0]['bcost'] ?> MMK</td>
                            <td> </td>
                        </tr>
                        <tr>
                            <th>Source Address:</th>
                            <td><?php echo $sourceaddress; ?></td>
                            <td> </td>
                           
                        </tr>
                        <tr>
                            <th>Destination Address:</th>
                            <td><?php echo $destinationaddress; ?></td>
                            <td> </td>
                           
                        </tr>
                        
                       </table>
                       <img src="images/payment/sign.png" style="height: 40px; width: 100px; margin-left: 300px;">
                       
                       
                       
                    </div>
                    
                    
                    
                </div>
                <div style="display:flex;justify-content:center;">
                <a href="historyClick.php"><button type="submit" name="receiptOK" class="ok_button" style="margin-left: 20px;padding: 8px 20px;background-color: #F18D65;margin-bottom:20px; ">OK</button></a>
                </div>
            </div>
           
        </div>    
        
          
            
        

        
</body>
<script type="text/javascript" charset="utf-8">
const one = document.querySelectorAll(".one");
const two = document.querySelectorAll(".two");
const three = document.querySelectorAll(".three");

var div = document.getElementById("pay");
  
function show_payment()
{
    event.target.classList.remove("current-item");

    one.forEach(element => {
        element.classList.remove("current-item");
    });

    two.forEach(element => {
        element.classList.remove("current-item");
    });

    three.forEach(element => {
        element.classList.add("current-item");
    });

    div.style.display = "block";
}

    // function goToAnotherPage() {
    //     window.location.href = "bus_page_1.php";
    // }


</script>
<script type="text/javascript">
        document.getElementById("image").onchange = function () {
            document.getElementById("form").submit();
        };

        document.addEventListener('click', function (event) {
            // Check if the clicked element is not the hidden-div or its child
            if (!event.target.closest('#hidden-div')) {
                // Hide the hidden-div
                location.hash = ''; // Clears the fragment identifier
            }
        });
        document.querySelectorAll('.manage, .history').forEach(button => {
                button.addEventListener('click', function () {                  
                document.getElementById('form').action = this.value + 'Click.php';
            });
        });
        // document.querySelector('.manage').addEventListener('click',function(){
        //     document.getElementById('form').action='manageClick.php';
        // })
        
        // document.getElementById('logout').addEventListener('click',function(){
        //   var x=check_logout();
        //   if(x){
        //        document.getElementById("form").submit();
        //        location.hash = ''; 
        //   }
          
        // });

        function check_logout()
    {
      var check = confirm("Are you sure to logout?");
            if(check)
            {
              document.getElementById("form").submit();
               location.hash = ''; 
                return true;
               
            }
            else
            {
                return false;
            } 
    }
    </script>
</html>