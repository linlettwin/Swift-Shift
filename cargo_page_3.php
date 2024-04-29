<?php
session_start();
if (!isset($_SESSION["customer"])) {
    $_SESSION["path"]="cargo_page_3.php";
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
  header("Location: cargo_page_3.php");

}
include "connect.php";

function setValue($fieldName)
{
    if (isset($_SESSION[$fieldName]))
    {
        return $_SESSION[$fieldName];
    }
}

function setPost($fieldName)
{
    if (isset($_POST[$fieldName]))
    {
        return $_POST[$fieldName];
    }
}

if (isset($_POST['cargo3_back']))
{
    $categories = "";

    if (isset($_POST["ctype"])) {
        foreach ($_POST["ctype"] as $ct) {
            $categories .= $ct . ", ";
        }
    }
   
  $categories = rtrim($categories, ", ");

  $_SESSION["categories"] = $categories;
  $_SESSION["weight"] = setPost("weight");
  $_SESSION["totalamounts"] = setPost("totalamounts");
  $_SESSION["note"] = setPost("note");
  header("Location: cargo_page_2.php");
  exit();
}


if (isset($_POST['cargo3_next']))
{
    $categories = "";

    if (isset($_POST["ctype"])) {
        foreach ($_POST["ctype"] as $ct) {
            $categories .= $ct . ", ";
        }
    }
   
    $categories = rtrim($categories, ", ");
    
    $_SESSION["categories"] = $categories;
    $_SESSION["weight"] = setPost("weight");
    $_SESSION["totalamounts"] = setPost("totalamounts");
    $_SESSION["note"] = setPost("note");
    header("Location: cargo_page_4.php");
    exit();
}

function setSelected($fieldName, $fieldValue) 
{
    if (isset($_SESSION[$fieldName]) && $_SESSION[$fieldName] == $fieldValue) {
        return 'selected="selected"';
    }
    return '';
 }


$categoryValue = setValue("categories");
$categoryArray = array();
if (isset($categoryValue)) {
    $categoryArray = explode(", ", $categoryValue);
    //echo $categoryArray[0];
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="cargo_page2.css">
  <script src="sweetalert.min.js"></script>
  <link rel="icon" type="image/png" href="images/bc_logo.png" />
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

  <title>Styled Table</title>
<style>

*{
    box-sizing: border-box;
    margin: 0;
    padding: 0;
    
}
body,html {
   
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
    margin-right:20px;
    margin-left:20px;
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

.container {
    margin-top: 20px; /* Adjust margin as needed */
    display: flex;
    flex-direction:column;
    margin-left:65px;
    margin-right:65px;
}

@media (max-width: 550px){
    .container{
        margin-left:0px;
        margin-right:0px;
    }
}
.cargo-section {
    text-align: center;
    margin-top: 20px; /* Adjust margin as needed */
}

.cargo-section i {
    display: block;
    font-size: 36px; /* Adjust icon size as needed */
    margin: 0 auto; /* Center the icon horizontally */
}

.cargo-section span {
    display: block;
    font-size: 18px; /* Adjust text size as needed */
    margin-top: 10px; /* Adjust margin as needed */
}
.box{
    margin-top:20px;
    margin-bottom:20px;
    display:flex;
    flex-direction:row;
}
.line_head{
    width:44.5%;
    border-bottom:2px solid black;
}

.section_container{
    
    width:100%;
    height:auto;
    margin:0px;
    padding:0px;
    background-color:#E7EEF4;
}
.topic{
    margin-top:20px;
    margin-bottom:20px;
}

#parcelTable {
    width: 100%;
    padding: 20px;
    background-color:#E7EEF4;
    border-collapse: collapse;
    border: 1px solid black;
}
#parcelTable th {
   font-weight:bold;
}
  
  #parcelTable th,
  #parcelTable td {
    padding: 10px;
    text-align: center;
    width:auto;
    border: 1px solid black;
  }

  #parcelTable input {
    width:150px;
    height:auto;
  }
  .slt{
    width:200px;
    height:auto;
  }

  .btn_part{
    margin-top:30px;
    display:flex;
    justify-content:flex-end;
  }

  .add-button{
    background-color:#A0BFE0;  
    padding:10px;
    width:120px;
    height:50px;
  }
  
.bottom_part{
   margin-top:30px;
   margin-bottom:30px;
   display:flex;
   flex-direction:row; 
   justify-content:space-between; 
}

.btn_part2{
    margin-top:30px;
    display:flex;
    justify-content:flex-end;
  }
  
.save-button, .cancel-button{
    padding: 10px 20px;
    margin-left: 40px;
    margin-top:70px;
    background-color: #F18D65;
    font-weight: bold;
    width:100px;
    height:45px;
}
.ta{
    background: #D9D9D9;
    font-weight: bold;
    width:750px;
}

@media (max-width: 650px){
    #parcelTable input, .slt {
        width:130px;
        height:auto;
    }
    .bottom_part{
        flex-direction:column;
    }
}
@media (max-width: 580px){
    #parcelTable input, .slt {
        width:100px;
        height:auto;
    }
    .container{
        margin-left:0px;
        margin-right:0px;
    }
    .save-button, .cancel-button{
        margin-top:0px;
        padding-top:0px;
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

<?php
$sql1 = "SELECT crid, cargo_cost FROM cargo_route WHERE cargo_src = ? AND cargo_dest = ?";

try {
    
    $stmt = $dbconnection->prepare($sql1);

    // Bind parameters
    $stmt->bind_param("ss", $_SESSION["cargo_source2"], $_SESSION["cargo_destination2"]);

    // Execute the statement
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $crid = $row["crid"];
        $cargoCost = $row['cargo_cost'];

        $_SESSION["crid"] = $crid;
        //echo "<script>swal('$cargoCost')</script>";
    } else {
        echo "<script>alert('Sorry! There is no cargo service for this route currently. Choose another branch.')</script>";
        echo "<script>window.location.href = 'cargo_page_2.php';</script>";
        exit();
    }

    $stmt->close();
} catch (mysqli_sql_exception $e) {
    echo "Error: " . $e->getMessage();
}



$sql2 = "SELECT t.max_weight 
FROM cargo_truck t, cargo_route r, cargo_plan p 
WHERE r.cargo_src = ? 
  AND r.cargo_dest = ?
  AND r.crid = p.crid 
  AND p.cpdate = ? 
  AND p.truckno = t.truckno";

try {
    $stmt2 = $dbconnection->prepare($sql2);

    // Bind parameters
    $stmt2->bind_param("sss", $_SESSION["cargo_source2"], $_SESSION["cargo_destination2"], $_SESSION["departureDate"]);

    // Execute the statement
    $stmt2->execute();

    // Get the result
    $result2 = $stmt2->get_result();
    $maxWeight = 0;

    if ($result2->num_rows > 0) {
        while ($row = $result2->fetch_assoc()) {
            $maxWeight += $row["max_weight"];
        }
        //echo $maxWeight;
    } else {
        echo "<script>alert('Sorry! There is no cargo service on " . $_SESSION["departureDate"] . ". Please select another day.')</script>";
        echo "<script>window.location.href = 'cargo_page_2.php';</script>";
        exit();
    }
    $stmt2->close();

} catch (mysqli_sql_exception $e) {
    // Handle any potential errors
    echo "Error: " . $e->getMessage();
}





$sql3 = "SELECT g.totalweight 
         FROM get_cargo_service g, cargo_route r 
         WHERE r.cargo_src = ? 
           AND r.cargo_dest = ? 
           AND r.crid = g.crid 
           AND g.cpdate = ?";

try {
    $stmt3 = $dbconnection->prepare($sql3);

    // Bind parameters
    $stmt3->bind_param("sss", $_SESSION["cargo_source2"], $_SESSION["cargo_destination2"], $_SESSION["departureDate"]);

    // Execute the statement
    $stmt3->execute();

    // Get the result
    $result3 = $stmt3->get_result();
    $occupied = 0;

    if ($result3->num_rows > 0) {
        while ($row = $result3->fetch_assoc()) {
            $occupied += $row["totalweight"];
        }
        //echo $occupied;
    }
    $stmt3->close();

} catch (mysqli_sql_exception $e) {
    // Handle any potential errors
    echo "Error: " . $e->getMessage();
}




$available = $maxWeight - $occupied;
//echo $available;

if($available == 0)
{
    echo "<script>alert('Sorry! Full Weight. Change date or route.')</script>";
    echo "<script>window.location.href = 'cargo_page_2.php';</script>";
    exit();
}

?>



<div class="container">
    <div class="cargo-section">
            <i class="fas fa-truck"></i>
            <div class="box">
                <div class="line_head" > </div>
                <div class="text-with-lines">Cargo Services</div>
                <div class="line_head" > </div>
            </div>
    </div>
    


    <div class="section-container">
        <div class="section-with-background" style="background-color:#E7EEF4; padding:20px; margin-top:30px;">
            <div class="topic">
                <h5>Parcel Information</h5>
                <div class="line"></div>
            </div>
                <form action="cargo_page_3.php" method="post">
                <input type="hidden" name="available" id="available" value="<?php echo $available; ?>">
                <input type="hidden" name="cost" id="cost" value="<?php echo $cargoCost; ?>">
                    <table id="parcelTable" border="1">
                    <thead>
                        <tr>                
                        <th>Cargo Type</th>
                        <!--<th>Price</th> -->               
                        <th>Weight (kg)</th>
                        <th>Price<?php echo " (1kg = {$cargoCost} MMK)"; ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        
                        <td>
                        <form action="cargo_page_3.php" method="post">
                            <select class="slt" name="ctype[]" id="cargo_type" multiple>
                                <option value="Dry Food" <?php foreach ($categoryArray as $categoryA) { if ($categoryA == "Dry Food") echo "selected"; } ?>>Dry Food</option>
                                <option value="Fragile Items" <?php foreach ($categoryArray as $categoryA) { if ($categoryA == "Fragile Items") echo "selected"; } ?>>Fragile Items</option>
                                <option value="Clothes" <?php foreach ($categoryArray as $categoryA) { if ($categoryA == "Clothes") echo "selected"; } ?>>Clothes</option>
                                <option value="Goods" <?php foreach ($categoryArray as $categoryA) { if ($categoryA == "Goods") echo "selected"; } ?>>Goods</option>
                                <option value="Electronics" <?php foreach ($categoryArray as $categoryA) { if ($categoryA == "Electronics") echo "selected"; } ?>>Electcronics</option>
                                <option value="Others" <?php foreach ($categoryArray as $categoryA) { if ($categoryA == "Others") echo "selected"; } ?>>Others</option>
                            </select>
                       
                        </td>

                        <!--<td> 2000 </td>   -->

                        <td><input type="number" name="weight" id="weight" value="<?php echo setValue("weight") ?>" min="1" max="<?php echo $available ?>" onkeyup="calculate()" oninput="calculate2()"></td>

                        <td><input type="text" name="totalamounts" id="totalamounts" value="<?php echo setValue("totalamounts") ?>" readonly></td>

                        </tr>
                        
                    </tbody>
                    </table>
                 
                    <div class="btn_part">
                        <!--<button type="button" class="add-button" id="addRow"><i class="fa-solid fa-square-plus"></i>  Add Item</button> -->
                    </div> 
            
        </div>
        <div class="bottom_part">
        <textarea class="ta" id="add" name="note" placeholder="  Note:" rows="6" cols="70"><?php echo setValue("note"); ?></textarea>

            <div class="btn_part2">

                
                    <button type="submit" class="cancel-button" name="cargo3_back" id="cargo3_back">&lt;Back</button>
                    <button type="submit" class="save-button" name="cargo3_next" id="cargo3_next" onclick="return check3()">Next&gt;</button>
        </form>

            </div>
           
        </div>
    </div>
        
        
 </div>

<?php

?>
</body>

<script>
function calculate() {
    
    var a = document.getElementById("weight").value;

    if (event.which == 13 || event.which == 8 || event.which == 46) {
        document.getElementById("totalamounts").value = Number(a) * Number(document.getElementById("cost").value);
        return null;
    }

    var reg = /\d+/;
    if (!reg.test(a)) {
        alert("You entered an invalid value. Please enter a valid number.");
        document.getElementById("weight").value = null;
        document.getElementById("totalamounts").value = null;
        return null;
    }

    var b = document.getElementById("available").value;
    if (Number(a) > Number(b)) {
        alert("Only " + b + " kg will be available.");
        document.getElementById("weight").value = null;
        document.getElementById("totalamounts").value = null;
        return null;
    }
    document.getElementById("totalamounts").value = Number(a) * Number(document.getElementById("cost").value);
}


function calculate2()
{
    var a = document.getElementById("weight").value;
    document.getElementById("totalamounts").value = Number(a) * Number(document.getElementById("cost").value);
}


function check3()
{
    //alert("hello");
    var selectedOptions = document.getElementById("cargo_type").selectedOptions;
    if (selectedOptions.length === 0) {
        alert("Please select your product types first.");
        return false;
    }
    else if(document.getElementById("weight").value == null || Number(document.getElementById("weight").value) == 0)
    {
        alert("Please enter weight before proceeding.");
        return false;
    }
}

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
