<?php
session_start();
if (!isset($_SESSION["customer"])) {
    $_SESSION["path"]="paymentkbz.php";
    echo "<script> window.alert('Please Login or Signup first!''); </script>";
    header("Location: SignUP.php");
    exit();
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


if (isset($_FILES["image"]["name"])) {
  $file_name = $_FILES['image']['name'];
  $tempname = $_FILES['image']['tmp_name'];
  $folder = 'images/user/' . $file_name;

  
  $stmt = $conn->prepare("UPDATE customer SET photo=? Where cid=$cid");
  $stmt->execute([$file_name]);
  move_uploaded_file($tempname,$folder);
  header("Location: paymentkbz.php");

}

function setValue($fieldName)
{
    if (isset($_SESSION[$fieldName]))
    {
        return $_SESSION[$fieldName];
    }
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

if (isset($_SESSION["Texts"])) {
    $seatsnos = $_SESSION["Texts"];
    $seatsnos = explode(",", $seatsnos);
}


// if( isset($_POST["cancel"]) )
// {
//     unset($_SESSION["from"]);
//     unset($_SESSION["to"]);
//     unset($_SESSION["date"]);
//     unset($_SESSION["passno"]);
//     unset($_SESSION["price"]);
//     unset($_SESSION["pid"]);
//     unset($_SESSION["oname"]);
//     unset($_SESSION["ddate"]);
//     unset($_SESSION["dtime"]);
//     unset($_SESSION["Texts"]);
//     unset($_SESSION["Totals"]);
//     unset($_SESSION["tname"]);
//     unset($_SESSION["tphone"]);
//     unset($_SESSION["special"]);
//     unset($_SESSION["paymethod"]);
//     unset($_SESSION["payimage"]);
//     unset($_SESSION["sourceaddress"]);
//     unset($_SESSION["destinationaddress"]);

//     header("Location: bus_page_1.php");
// }

$_SESSION["paymethod"] = htmlspecialchars("KBZ");
$_SESSION["payimage"] = htmlspecialchars("images/payment/kpay.jpg");

if(isset($_POST["done"]))
{
$conn = connect();
$sql = "INSERT INTO btickets VALUES (:btid, :numberofseats, :pid, :seatno, :cid, :status, :screenshot, :seen, :bpname, :bpphone, :bdate, :btime, :bcost, :paymethod, :special, :message)";

try{
    $st = $conn->prepare($sql);

    for ($i = 0; $i < $_SESSION["passno"]; $i++) {
        $btid = date("YmdHis") . $i+1;

        $st->bindValue(":btid", $btid, PDO::PARAM_STR);
        $st->bindValue(":numberofseats", $_SESSION["passno"], PDO::PARAM_INT);
        $st->bindValue(":pid", $_SESSION["pid"], PDO::PARAM_INT);
        $st->bindValue(":seatno", $seatsnos[$i], PDO::PARAM_INT);
        $st->bindValue(":cid", $_SESSION["customer"], PDO::PARAM_INT);
        $st->bindValue(":status", "Pending", PDO::PARAM_STR);
        $st->bindValue(":screenshot", $_SESSION["screenshot"], PDO::PARAM_STR);
        $st->bindValue(":seen", "No", PDO::PARAM_STR);
        $st->bindValue(":bpname", $_SESSION["tname"], PDO::PARAM_STR);
        $st->bindValue(":bpphone", $_SESSION["tphone"], PDO::PARAM_STR);
        $st->bindValue(":bdate", date("Y-m-d"), PDO::PARAM_STR);
        $st->bindValue(":btime", date("H:i:s"), PDO::PARAM_STR);
        $st->bindValue(":bcost", $_SESSION["price"], PDO::PARAM_STR);
        $st->bindValue(":paymethod", $_SESSION["paymethod"], PDO::PARAM_STR);
        $st->bindValue(":special", $_SESSION["special"], PDO::PARAM_STR);
        $st->bindValue(":message", "", PDO::PARAM_STR);

        $st->execute();
    }

    $conn = null;
    unset($_SESSION["from"]);
    unset($_SESSION["to"]);
    unset($_SESSION["date"]);
    unset($_SESSION["time"]);
    unset($_SESSION["passno"]);
    unset($_SESSION["price"]);
    unset($_SESSION["pid"]);
    unset($_SESSION["oname"]);
    unset($_SESSION["ddate"]);
    unset($_SESSION["dtime"]);
    unset($_SESSION["Texts"]);
    unset($_SESSION["Totals"]);
    unset($_SESSION["tname"]);
    unset($_SESSION["tphone"]);
    unset($_SESSION["special"]);
    unset($_SESSION["paymethod"]);
    unset($_SESSION["payimage"]);
    unset($_SESSION["sourceaddress"]);
    unset($_SESSION["destinationaddress"]);

    header("Location: bookingReceived.php");
} catch (PDOException $e) {
    $conn = null;
    die("Query failed: " . $e->getMessage());
}
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="paymentkbz.css">
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
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--google fonts -->
	
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    <style>
        body,html{
            font-family: "Poppins", sans-serif;
        }
        #login_user{
            width: 40px;
            height:40px;
            align-items:center;
            border-radius:50%;
            /*margin-left:20px;
            margin-right:20px; */
            
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
    text-align: center;
}
.progress-bar-place{
    margin-left:0px;
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

.section-container {
    position: relative; /* Set position to relative */
    width: 60%; /* Adjust the width as needed */
    margin: 0 auto; /* Center the section */
    margin-bottom:40px;
    text-align: center;
  }

  .section-with-background {
    background-color: #A0BFE0; /* Choose your background color */
    padding: 20px;
    margin-top: 20px;
    position: relative;
    height: auto; /* Set position to relative */
  }
  .line {
    width: 100%; /* Adjust the width of the line */
    height: 0.5px; /* Adjust the height of the line */
    background-color: #ffffff; /* Choose your line color */
    margin: 30px auto 20px auto;

  }
  .pay {
    display: flex;
    flex-direction:column;
    align-items: center;
    justify-content: center;
    text-align: center;
    font-weight: bold;
}

.pay img {
    margin-bottom: 10px; /* Adjust the margin as needed */
    width:300px;
    height:250px;
}

.cancel-button {
    margin-top: 10px;
    padding: 5px 10px;
    background-color: #F18D65;
    font-weight: bold;/* Adjust the margin as needed */
    border-radius: 10px;
}

.qr_part{
    display:flex;
    flex-direction:row;
    justify-content:space-between;
    margin:20px 65px 0px 65px;
}

.drag-area{
    border: 2px dashed #fff;
    height: 250px;
    width: 300px;
    border-radius: 5px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    
  }
  .drag-area.active{
    border: 2px solid #fff;
  }
  .drag-area .icon{
    font-size: 30px;
    color: #fff;
  }
  .drag-area header{
    font-size: 20px;
    font-weight: 500;
    color: #fff;
  }
  .drag-area span{
    font-size: 15px;
    font-weight: 500;
    color: #fff;
    margin: 10px 0 15px 0;
  }
  .drag-area button{
    padding: 10px 25px;
    font-size: 15px;
    font-weight: 500;
    border: none;
    outline: none;
    background: #fff;
    color: #5256ad;
    border-radius: 5px;
    cursor: pointer;
    transition: all 0.5s;
  }
  
  .drag-area button:hover{
    background: rgb(228, 220, 220);
  }
  
  .drag-area img{
    height: 100%;
    width: 100%;
    object-fit: contain;
    border-radius: 5px;
  }
  
  .btns{
    display:flex;
    flex-direction:row;
    justify-content:space-between;
    margin:20px 150px 20px 150px;
    
  }
  .last_btn{
    margin:20px 0px 20px 0px;
  }
  
@media (max-width: 745px) {

    .section-with-background {
       height:auto;
    }
    
    .qr_part{
   
     flex-direction:column;   
     align-items:center; 
     justify-content:center;
    margin:inherit;
   }

  
    .drag-area button{
      padding: 8px 20px;
      font-size: 15px;
      font-weight: 450;
    }
  
  .drag-area{
    margin-top:40px;
    height: 200px;
    width: 250px;
    display:flex;
    justify-content:center;
  }

  
  .drag-area header{
    font-size: 18px;
    font-weight: 450;
    color: #fff;
  }
  
  .drag-area .icon{
    font-size: 30px;
  }
  .btns{
    display:flex;
    flex-direction:row;
    justify-content:space-evenly;
    margin:20px 10px 20px 10px;
    
  }
  
  }
  
@media (max-width: 500px) {

.section-with-background {
   height:auto;
}
.qr_part{
display:flex;
flex-direction:column;
justify-content:space-between;
margin:30px 0px 30px 0px;
}


.drag-area button{
  padding: 8px 20px;
  font-size: 15px;
  font-weight: 450;
}

.drag-area{
margin-top:40px;
height: 200px;
width: 250px;
}

.drag-area header{
font-size: 18px;
font-weight: 450;
color: #fff;
}

.drag-area .icon{
font-size: 30px;
}

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

    <div class="whole">
    <div class="progress-bar-place">
        <section class="step-wizard">
                <ul class="step-wizard-list">
                    <li class="one step-wizard-item">
                        <span class="progress-count">1</span>
                        <span class="progress-label">Traveller Info</span>
                    </li>
                    <li class="two step-wizard-item ">
                        <span class="progress-count">2</span>
                        <span class="progress-label">Confirmation</span>
                    </li>
                    <li class="three step-wizard-item current-item">
                        <span class="progress-count">3</span>
                        <span class="progress-label">Payment</span>
                    </li>
                    <li class="step-wizard-item">
                        <span class="progress-count">4</span>
                        <span class="progress-label">Complete</span>
                    </li>
                </ul>
        </section>
     </div>
     </div>
     <div class="section-container">
      <div class="section-with-background">
        <img src="images/payment/kbzpay.jpg" style="width: 60px; height: 60px;"><span style="margin-left: 10px; font-size: 20px; font-weight: bold; color:white;">KBZ Pay</span>
        <div class="line"></div>
        <div class="pay">
          <p>Amount</p>
          <p><?php echo setValue("Totals"); ?> MMK</p>
        </div>
        <div class="qr_part" id="qr">
             <div>
                <img src="images/payment/kpayqr.jpg" style="width: 250px; height:250px;">
                
            </div>
            
            <div class="drag-area" ondrop="upload_file(event)" ondragover="return false">
                <div class="icon"><i class="fas fa-cloud-upload-alt"></i></div>
                <header>Drag & Drop to Upload Image</header>
                <span>OR</span>
                <button>Browse File</button>
                
                <input type="file" name="file" id="file" hidden>
                </div>
        </div>
        
        <div class="btns">
        <button class="cancel-button" onclick="goToAnotherPage()" id="kbzback">&lt;Back</button>

            <form action="paymentkbz.php" method="post">
            <button type="submit" class="cancel-button" name="done" id="done" onclick="return check()" >Done</button>
            </form>
        </div>
        
        </div>
    </div>


    <script type="text/javascript">
        function goToAnotherPage()
        {
            window.location.href = "bus_page_5.php";
        }

        function Sure()
        {
            var sure = confirm("Are you sure?");
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

<script src="script.js"></script>

<script>

function check() {
   // alert("hello");
   
    const fileInput = document.getElementById('file');
    if (fileInput.files.length === 0) {
        alert('Please upload a screenshot.');       
        return false;
    }

   
   // document.getElementById("screenshot").value = document.getElementById("file").value;
};






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

<?php 
// if(isset($_POST["done"])){
//   echo "<script> window.location.href = 'book_confirm.php';</script>";

// }
?>
</body>
</html>