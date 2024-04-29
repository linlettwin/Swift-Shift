<?php
session_start();
if (!isset($_SESSION["customer"])) {
    $_SESSION["path"]="cargo_page_2.php";
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
  header("Location: cargo_page_2.php");

}

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

function setSelected($fieldName, $fieldValue)
{
    if (isset($_SESSION[$fieldName]) && $_SESSION[$fieldName] == $fieldValue) {
        return 'selected="selected"';
    }
    return '';
 }



if (isset($_POST['cargo2_back']))
{

    if(isset($_SESSION["cargo_source2"]))
  {
    if($_SESSION["cargo_source2"] != setPost("cargo_source2"))
    {
      unset($_SESSION["weight"]);
      unset($_SESSION["totalamounts"]);
    }
  }

  if(isset($_SESSION["cargo_destination2"]))
  {
    if($_SESSION["cargo_destination2"] != setPost("cargo_destination2"))
    {
      unset($_SESSION["weight"]);
      unset($_SESSION["totalamounts"]);
    }
  }

  $_SESSION["cargo_source2"] = setPost("cargo_source2");
  $_SESSION["cargo_destination2"] = setPost("cargo_destination2");
  $_SESSION["departureDate"] = setPost("departureDate");
  header("Location: cargo_page_1.php");
  exit();
}


if (isset($_POST['cargo2_next']))
{

    if(isset($_SESSION["cargo_source2"]))
  {
    if($_SESSION["cargo_source2"] != setPost("cargo_source2"))
    {
      unset($_SESSION["weight"]);
      unset($_SESSION["totalamounts"]);
    }
  }

  if(isset($_SESSION["cargo_destination2"]))
  {
    if($_SESSION["cargo_destination2"] != setPost("cargo_destination2"))
    {
      unset($_SESSION["weight"]);
      unset($_SESSION["totalamounts"]);
    }
  }
  
  $_SESSION["cargo_source2"] = setPost("cargo_source2");
  $_SESSION["cargo_destination2"] = setPost("cargo_destination2");
  $_SESSION["departureDate"] = setPost("departureDate");
  header("Location: cargo_page_3.php");
  exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="cargo_page_2.css">
  <title>Swift Shift</title>
  <link rel="icon" type="image/png" href="images/bc_logo.png" />
  <script src="sweetalert.min.js"></script>
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


  <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
      @import url('https://fonts.googleapis.com/css2?family=Itim&display=swap');

      body,html {
    background-color:#E7EEF4;
    font-family: "Poppins", sans-serif;
    --color1: #FFF ;
    --color2:  #688dc4;
   
}

*{
    box-sizing: border-box;
    margin: 0;
    padding: 0;
    
  }
  body {
    background-color:#E7EEF4;
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
  .travel {
    margin: 0;
    padding: 0;
    background-image: url(images/cargo_bg1.jpg);
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover; /* Set the background size to cover */
    background-attachment: fixed; /* Ensure the background stays fixed while scrolling */
    height: 100vh; 
    display: flex;
    align-items: center;
    justify-content: center;
    font-family: Arial, sans-serif;
    color: #fff;
    flex-direction: column;
    flex: 1;
    margin-top: -50px;
    padding-top: -30px;
}
.glass-container {
    background-color: rgba(53, 52, 52, 0.8);
    padding: 20px;
    border-radius: 0px;
    text-align: center;
    width: 60%;
    height: 70%;
    max-width: 100%;
    box-sizing: border-box;
    display: flex;
    flex-direction: column;
    text-align: center;
    align-items:center;
    justify-content: center;
    
}
.columns {
    display: flex;
    /* justify-content: space-between; */
    margin-top: 20px; /* Adjust margin as needed */
    width: 80%;
}

.column {
    width: 90%;
    /* margin-left: 20px; */
}
@media (max-width: 800px) {
    .columns {
        flex-direction: column; /* Change flex direction to column for small screens */
        justify-content: center;
        align-items: center; /* Center the columns vertically */
    }

    .column {
        width: 100%; /* Set width to 100% for full width on small screens */
        
        margin-bottom: 20px; /* Add margin between columns on small screens */
    }
    .glass-container{
        height:80%;
    }
}
@media (max-width: 900px) {
    .columns {
        flex-direction: column; /* Change flex direction to column for small screens */
        justify-content: center;
        align-items: center; /* Center the columns vertically */
    }

    .column {
        width: 100%; /* Set width to 100% for full width on small screens */
        margin-bottom: 20px; /* Add margin between columns on small screens */
    }
    .glass-container{
        height:80%;
    }
}
.save-button, .cancel-button{
    padding: 5px 10px;
    margin-left: 30px; 
    background-color: #F18D65;
    font-weight: bold;
    width:150px;
    height:45px;
}
@media (max-width: 800px) {
  .save-button, .cancel-button{
   
    width:110px;
    height:auto;
    margin-bottom:20px;
}
.glass-container {
  height:auto;
}
}

.column select,input {
    
    border-radius: 5px;
    border: 1px solid #ccc; /* Border style */
    width:80%;
}
.column select{
    padding: 3px;
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

<body class="">
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

    <div class="travel">

    <?php
              include "connect.php";
              $selectedValue = setValue("cargo_source1");

              // Using a prepared statement to prevent SQL injection
              $sql = "SELECT branch_name FROM cargo_branch WHERE division = ?";
              $stmt = $dbconnection->prepare($sql);

              // Bind the parameter
              $stmt->bind_param("s", $selectedValue);

              // Execute the query
              $stmt->execute();

              // Get the result
              $result = $stmt->get_result();

              // Fetch the data
              $cargo_src_branches = array();
              while ($row = $result->fetch_assoc()) {
                $cargo_src_branches[] = $row['branch_name'];
              }



              $selectedValue = setValue("cargo_destination1");

              // Using a prepared statement to prevent SQL injection
              $sql = "SELECT branch_name FROM cargo_branch WHERE division = ?";
              $stmt = $dbconnection->prepare($sql);

              // Bind the parameter
              $stmt->bind_param("s", $selectedValue);

              // Execute the query
              $stmt->execute();

              // Get the result
              $result = $stmt->get_result();

              // Fetch the data
              $cargo_dest_branches = array();
              while ($row = $result->fetch_assoc()) {
                $cargo_dest_branches[] = $row['branch_name'];
              }


               //print_r( $cargo_dest_branches);
          ?>
      


    <div class="glass-container">
    <h4>Get Cargo Service</h4>
    <div class="d-flex justify-content-evenly columns">
        <div class="column">
            <label style="font-weight: bold; font-size: 20px">From Location</label>
            <input type="text" value="<?php echo setValue("cargo_source1") ?>" readonly><br>
            <label style="font-weight: bold; font-size: 20px">To Location</label>
            <input type="text" value="<?php echo setValue("cargo_destination1") ?>" readonly>
        </div>
        <form action="cargo_page_2.php" method="post">
            <div class="column">
                <label style="font-weight: bold; font-size: 20px">Branch Proceed</label>
                <select name="cargo_source2" id="category">
                    <option value="" disabled selected>Please select branch</option>
                    <?php
                    foreach ($cargo_src_branches as $cargo_src_branch) {
                        echo "<option value='{$cargo_src_branch}' " . setSelected('cargo_source2', $cargo_src_branch) . ">{$cargo_src_branch}</option>";
                    }
                    ?>
                </select>
                <label style="font-weight: bold; font-size: 20px">Pickup Branch</label>
                <select name="cargo_destination2" id="service">
                    <option value="" disabled selected>Please select branch</option>
                    <?php
                    foreach ($cargo_dest_branches as $cargo_dest_branch) {
                        echo "<option value='{$cargo_dest_branch}' " . setSelected('cargo_destination2', $cargo_dest_branch) . ">{$cargo_dest_branch}</option>";
                    }
                    ?>
                </select>
            </div>
            <label style="font-weight: bold; font-size: 20px">Choose Date</label>
            <div class="column" style="margin-bottom: 10px;">
            <input type="date" id="departureDate" name="departureDate" placeholder="Departure Date" value="<?php echo setValue("departureDate"); ?>">
            </div>
    </div>
    <div class="buttons-container" style="margin-top: 20px; margin-bottom: 10px; text-align: right;">
        <button class="cancel-button" type="submit" name="cargo2_back">&lt;Back</button>
        <button class="save-button" type="submit" name="cargo2_next" onclick="return check2()">Search&gt;</button>
    </div>
    </form>
    </div>

 
    <script type="text/javascript">
    function check2() {
    var sourceValue = document.getElementById("category").value;
    var destinationValue = document.getElementById("service").value;
    var departureDate = document.getElementById("departureDate").value.trim();

    if (sourceValue.trim() === "" || destinationValue.trim() === "") {
        swal("Please select branches first.");
        return false;
    } else if (departureDate === "") {
        swal("Please choose a date first.");
        return false;
    } else {
        return true;
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

  /*var s=new Date();
	var ed=new Date(s.setDate(s.getDate()+12));
  var myDate = document.getElementById('departureDate');
	myDate.min=new Date().toLocaleDateString('en-ca');
	myDate.max=ed.toLocaleDateString('en-ca');*/


  var today = new Date(); // Get today's date
var tomorrow = new Date(today); // Create a new date object for tomorrow
tomorrow.setDate(today.getDate() + 1); // Set the date to tomorrow

var s = new Date(); // Get today's date again
var ed = new Date(s.setDate(s.getDate() + 12)); // Get the date 12 days from now

var myDate = document.getElementById('departureDate'); // Get the departure date input field

// Set the minimum and maximum values for the departure date input field
myDate.min = tomorrow.toLocaleDateString('en-ca'); // Set the minimum date to tomorrow
myDate.max = ed.toLocaleDateString('en-ca'); // Set the maximum date to 12 days from now


    </script>
    </body>
    </html>