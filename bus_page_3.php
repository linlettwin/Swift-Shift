<?php
session_start();
if (!isset($_SESSION["customer"])) {
    $_SESSION["path"]="bus_page_3.php";
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
  header("Location: bus_page_3.php");

}


function setValue($fieldName)
{
    if (isset($_SESSION[$fieldName]))
    {
        return $_SESSION[$fieldName];
    }
}

?>

<?php
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


function getSeats($pid)
{
    if( isset($_SESSION["pid"]) )
    {
        if( $pid != $_SESSION["pid"] )
        {
            if( isset($_SESSION["Texts"]) || isset($_SESSION["Totals"]) )
            {
                unset($_SESSION["Texts"]);
                unset($_SESSION["Totals"]);
            }
            
        }
    }

    

    $conn = connect();
    $sql1 = "select b.maxpassenger from bus b, plan p where p.pid = '$pid' and p.busno = b.busno";
    $sql2 = "select bt.seatno from btickets bt, plan p where p.pid = '$pid' and p.pid = bt.pid and (bt.status = 'Pending' OR bt.status = 'Approved')";

    try
    {
        $rows1 = $conn->query($sql1);
        $rows2 = $conn->query($sql2);

        $maxpassenger = '';
        foreach( $rows1 as $row1 )
        {
            $maxpassenger = $row1["maxpassenger"];
        }

        $seatno = array();
        foreach( $rows2 as $row2 )
        {
            $seatno[] = $row2["seatno"];
        }
       
        return array($maxpassenger, $seatno);

    }catch(PDOException $e)
    {
        die( "query failed: " . $e->getMessage() );
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="bus_page_3.css">

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

.div_2_col{
   padding-top:30px;
   display :flex;
   flex-direction:row;
   justify-content:space-between;
   margin-left:60px;
   margin-right:60px;
   max-width:6500px;
   margin-bottom:50px;
}

.seat_select{
    width:600px;
    height:auto;
    background-color:#D8E5F2;
}
.title1{
    background-color:#7895CB;
    color:white;
    align-items:center;
    padding:20px;
}
.title1 h5{
    color:white;
    text-align:center;
}




/*seat display*/
.seat_display{
    display:flex;
    flex-direction:column;
    flex-direction:space-between;
    
}
.show_choosen_seat{
    background-color:#D8E5F2;
    padding:20px;
}
.show_choosen_seat h5{
    color:black;
    text-align:center;
}
.show_text{
    height:50px;
    width:270px;
    padding:5px;
    font-size:18px;
    background-color:white;
    margin-top:20px;
    margin-bottom:20px;
}
.show_total{
    border-top: 3px dashed black;
    margin-top:20px;
}
.show_total h5{
     color:black;
     text-align:center;
     margin-top:30px;
}

.continue_btn{
    background-color:#D8E5F2;
    margin-top:30px;
    height:50px;

}
.continue_btn .btnc{
    border:none;
    width:310px;
    height:50px;
    background-color:#D8E5F2;
    color:black;
    text-align:center;
    font-weight:bold;
}

@media (max-width: 850px){
    .div_2_col{
        flex-direction:column;
        justify-content:center;
        margin:0px;
        
    }
    .seat_select{
        max-width:500px;
        max-height:1000px;
        background-color:#D8E5F2;
        margin-left:60px;
    }
    .seat_display{
        margin-top:30px;
        max-width:500px;
        height:auto;
        margin-left:60px;
    }
    .show_text{
        height:50px;
        width:450px;
        background-color:white;
        margin-top:20px;
        margin-bottom:20px;
    }
    .continue_btn{
        background-color:#D8E5F2;
        margin-top:30px;
        margin-bottom:30px;
        height:60px;
    
    }
    .continue_btn .btnc{
        border:none;
        width:500px;
        height:60px;
        background-color:#D8E5F2;
        color:black;
        text-align:center;
        font-weight:bold;
    }
}

@media (max-width: 500px){
    .div_2_col{
        flex-direction:column;
        justify-content:center;  
        margin-left:0px;
        margin-right:0px;  
    }
    .seat_select{
        width:500px;
        height:950px;
        background-color:#D8E5F2;
    }
    .seat_display{
        margin-top:30px;
        width:500px;
        height:auto;
    }
    .show_text{
        height:50px;
        width:500px;
        background-color:white;
        margin-top:20px;
        margin-bottom:20px;
    }
    .continue_btn{
        background-color:#D8E5F2;
        margin-top:30px;
        margin-bottom:30px;
        height:60px;
    
    }
    .continue_btn .btnc{
        border:none;
        width:500px;
        height:60px;
        background-color:#D8E5F2;
        color:black;
        text-align:center;
        font-weight:bold;
    }
}

/*seats button*/
.seats{
    display:flex;
    flex-direction:column;
    justify-content:space-between;
    margin:20px;
}
.driver{
    background-color:#923C3C;
    color:white;
    width:220px;
    height:40px;
    text-align:center;
    padding:5px;
}
.driver p{
    font-size:20px;
    text-align:center;
}
.col1{
    display:flex;
    flex-direction:row;
    justify-content:space-between;
    margin-top:18px;
    width:auto;
}
.row1_1{
    display:flex;
    flex-direction:row;
    justify-content:flex-start;
    width:auto;
}
.row1_2{
    display:flex;
    display:flex;
    flex-direction:row;
    justify-content:flex-start;
}
.btn1{
    width:100px;
    height:40px;
    border:none;
    font-weight:bold;
}
.btn1{
    padding:8px;
    text-align:center;
}
.btn_sp{
    margin-left:20px;
}

.explain
{
    width:30px;
    height:30px;
    background-color:#89CFF0;
    border:none;
    position:relative;
    margin-top:30px;
}
label {
    position:absolute;
    margin-top:-25px;
    margin-left:50px;
    font-size:18px;
}


@media (max-width: 1080px){
    .btn1{
        width:80px;
        height:40px;
        border:none;
    }
}
@media (max-width: 500px){
    .btn1{
        width:60px;
        height:40px;
        border:none;
    }
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
        


    <!--whole container for seat select and display-->
    <div class="div_2_col">
           <div class="seat_select">

              <div class="title1">
                 <h5>Please select  Seats(s)</h5>
              </div>

              <div class="seats">
                 <div class="col1">
                    <div class="driver"><p>Driver</p></div>
                 </div>


                 <?php
                      
                      if (isset($_POST["page2_next"]))
                      {
                      
                        list($maxpassenger, $seatno) = getSeats( $_POST['pid'] );
                        $price = $_POST['price'];
                        $passno = $_POST['passno'];
                        $_SESSION["price"] = $_POST["price"];
                        $_SESSION["pid"] = $_POST['pid'];
                        $_SESSION["oname"] = $_POST["oname"];
                        $_SESSION["ddate"] = $_POST["ddate"];
                        $_SESSION["dtime"] = $_POST["dtime"];
                        
                          echo "<form>";
                          for ($i = 1; $i <= $maxpassenger; $i = $i + 4)
                          {
                              echo "<div class='col'>";
                      
                              echo "<div class='row1_1'>";
                              echo "<p style='background: #89CFF0; text-align:center;' class='btn1' id='$i' onclick='changeColor($i,$price)' name='bttn'>&nbsp$i</p>";
                              echo "<p style='background: #89CFF0; text-align:center;' class='btn1 btn_sp' id='" . ($i + 1) . "' onclick='changeColor(" . ($i + 1) . ",$price)' name='bttn'>&nbsp" . ($i + 1) . "</p>";
                              echo "</div>";
                      
                              echo "<div class='row1_2'>";
                              echo "<p style='background: #89CFF0; text-align:center;' class='btn1' id='" . ($i + 2) . "' onclick='changeColor(" . ($i + 2) . ",$price)' name='bttn'>&nbsp" . ($i + 2) . "</p>";
                              echo "<p style='background: #89CFF0; text-align:center;' class='btn1 btn_sp' id='" . ($i + 3) . "' onclick='changeColor(" . ($i + 3) . ",$price)' name='bttn'>&nbsp" . ($i + 3) . "</p>";
                              echo "</div>";

                              echo "</div>";
                          }

                          
                              for ($i = 1; $i <= $maxpassenger; $i++)
                              {
                                  foreach ($seatno as $sn)
                                  {
                                      if ($i == $sn)
                                      {
                                          echo "<script>";
                                          echo "document.getElementById($i).style.background='grey';";
                                          echo "document.getElementById($i).onclick = null;";
                                          echo "</script>";
                                          break;
                                      }
                                  }
                              }

                          echo "</form>";
                      }


                      if (isset($_POST["page4_back"]))
                      {
                        
                        $_SESSION["tname"] = $_POST["tbname"];
                        $_SESSION["tphone"] = $_POST["tbphone"];
                        $_SESSION["special"] = $_POST["tbspecial"];
                        
                        list($maxpassenger, $seatno) = getSeats( $_SESSION['pid'] );
                        $price = $_SESSION['price'];
                        $passno = $_SESSION['passno'];
                        
                          echo "<form>";
                          for ($i = 1; $i <= $maxpassenger; $i = $i + 4)
                          {
                              echo "<div class='col1'>";
                      
                              echo "<div class='row1_1'>";
                              echo "<p style='background: #89CFF0; text-align:center;' class='btn1' id='$i' onclick='changeColor($i,$price)' name='bttn'>&nbsp$i</p>";
                              echo "<p style='background: #89CFF0; text-align:center;' class='btn1 btn_sp'style='margin-left:20p;' id='" . ($i + 1) . "' onclick='changeColor(" . ($i + 1) . ",$price)' name='bttn'>&nbsp" . ($i + 1) . "</p>";
                              echo "</div>";
                      
                              echo "<div class='row1_2'>";
                              echo "<p style='background: #89CFF0; text-align:center;' class='btn1' id='" . ($i + 2) . "' onclick='changeColor(" . ($i + 2) . ",$price)' name='bttn'>&nbsp" . ($i + 2) . "</p>";
                              echo "<p style='background: #89CFF0; text-align:center;' class='btn1 btn_sp' style='margin-left:20p;' id='" . ($i + 3) . "' onclick='changeColor(" . ($i + 3) . ",$price)' name='bttn'>&nbsp" . ($i + 3) . "</p>";
                              echo "</div>";

                              echo "</div>";
                          }

                          
                              for ($i = 1; $i <= $maxpassenger; $i++)
                              {
                                  foreach ($seatno as $sn)
                                  {
                                      if ($i == $sn)
                                      {
                                          echo "<script>";
                                          echo "document.getElementById($i).style.background='grey';";
                                          echo "document.getElementById($i).onclick = null;";
                                          echo "</script>";
                                          break;
                                      }
                                  }
                              }

                          echo "</form>";
                      }
                     
                  ?>

              </div>

            </div>
           
           <div class="seat_display">
               <div class="show_choosen_seat">
                  <h5>Seat No.</h5>
                  <form>
                    <div class="show_text" id="showText"><?php echo setValue("Texts"); ?></div>
                  </form>
                  <div class="show_total">
                    <h5>Total : </h5><h5 id="total"><?php echo setValue("Totals"); ?></h5>
                   
                  </div>
               </div>
               <div class="continue_btn">
                   

                <form method="post" action = "bus_page_2.php" style="background-color:#D8E5F2;">
                    <input type="submit" name="page3_back" value='&lt;Back' id="btn" class="btnc" onclick="carryback3()">
                    <input type="hidden" name="Textss" value="" id="Textss">
                    <input type="hidden" name="Totalss" value="" id="Totalss">
                </form><br>

                   <form method="post" action="bus_page_4.php" style="background-color:#D8E5F2;">
                    <input type="submit" name="page3_next" value="Continue&gt;" id="btn" class="btnc" onclick="return carrynext3()">
                    
                    <input type="hidden" name="Texts" value="" id="Texts">
                    <input type="hidden" name="Totals" value="" id="Totals">
                   </form>
                   
                
                   
                   
               </div>
               <div class="expl" style="margin-bottom:50px; margin-top:100px;">
                 <form>
                  
                  <div style="background-color: #89CFF0;" class="explain"></div> 
                  <label>Available Seats</label>

                  <div style="background-color: #0BCE07;" class="explain"></div> 
                  <label>Selected Seats</label>

                  <div style="background-color:#000000; opacity:25%;" class="explain"></div> 
                  <label>Already Booked</label>
  
      

                 </form> 
               </div>
           </div>
           
    </div>

    <!--Footer
        <div class="footerb">
            <div class="container text-center custom-bg-gray text-white ">
            <div class="row align-items-center">
                <div class="col ">
                    <div class="d-flex flex-column mt-2">
                        <img src='images/logo1.png' height="70px" width="100px" alt="Logo">
                        <div class="d-flex">
                            <div class="icon_2 "><i class="fa-solid fa-location-dot icon2"></i></div>
                            <a href=" " class="link_info"><p class="mb-0 fw-bold">Head Office</p></a>
                        </div>
                        <div class="d-flex">
                            <div class="icon_2 "><i class="fa-solid fa-phone icon2" ></i></div>
                            <a href=" " class="link_info"><p class="mb-0 fw-bold"> 09766270791</p></a>
                        </div>
                    </div>
                </div>
        
                <div class="col">
                    <div class="d-flex flex-column mt-5">
                        <p class=" mb-1 fw-bold">Our Services</p>
                        <div class="service mt-2">
                            <a href="#" class="link_info"><p class="mb-0">Bus Ticket</p></a>
                        </div>
                    
                        <div class="service mt-2">
                            <a href="#" class="link_info">Cargo</p></a>
                        </div>
                    </div>
                </div>
        
                <div class="col">
                    <div class="d-flex flex-column align-items-end mt-5" >
                        <div class="s1 mt-0 mb-0">
                        <a href="#" class="link_info"><p class="mb-1 fw-bold text-start">About us</p></a>
                    </div>
                    <div class="s1 mt-0">
                        <a href="#" class="link_info"><p class="mb-1 fw-bold text-start">Legal</p></a>
                    </div>
                    <div class="s1 mt-0">
                        <a href="#" class="link_info"><p class="mb-1 fw-bold text-end">Terms and Conditions</p></a>
                    </div>
                    <div class="s1 mt-0">
                        <a href="#" class="link_info"><p class="mb-1 fw-bold text-start">Privacy Policy</p></a>
                    </div>
                    </div>
                </div>
            </div>
        
             Container for the border line 
            <div class="row mt-3">
                <div class="border-bottom">
                     Empty column for the border
                    <p class=" border-bottom"></p>
                    <div class="social">
                        <a href="https://www.facebook.com"><i class="fa fa-facebook linkIcn"></i></a>
                        <a href="https://www.instagramcom"><i class="fa fa-instagram linkIcn"></i></a>
                        <a href="https://www.twitter"><i class="fa fa-twitter linkIcn"></i></a>
                    </div>
                    <div class="copyright">
                        <small>Copyright © 2023 Swift Shift</small>
                    </div>
                </div>
            </div>
        </div>
    </div> -->





<script type="text/javascript">

if( document.getElementById('showText').innerHTML == "" )
{
    var start = 0;
}
else
{
    var text1 =  document.getElementById('showText').innerHTML;
    var array1 = text1.split(",");
    var start = array1.length;
    for(var i = 0; i < start; i++)
    {
        var arr = array1[i];
        document.getElementById(arr).style.background = "#0BCE07";
    }
}

var passno = parseInt(<?php echo $passno; ?>);


function changeColor($i, $price)
{

    var element = document.getElementById($i);
    var showTextElement = document.getElementById('showText');
    var totalElement = document.getElementById('total');

    if(element.style.background == 'rgb(11, 206, 7)')
    {
       element.style.background = '#89CFF0';
       start--;

       var text = showTextElement.innerHTML;
       var textarray = text.split(",");
       
       if(textarray.length)
       {
       
            for(i=0; i<textarray.length; i++)
            {
              if(textarray[i] == $i)
              {
                textarray.splice(i, 1);
                break;
              }
            }
            //alert(textarray);
            showTextElement.innerHTML = textarray.toString();
            totalElement.innerHTML = parseInt(totalElement.innerHTML) - parseInt($price);

       }
       

    }
    else
    {

        if(start >= passno)
        {
            alert("You say you will buy only " + passno + " tickets.");
        }
        else
        {
            element.style.background = '#0BCE07';
            start++;

            if (showTextElement.innerHTML)
            {
                showTextElement.innerHTML += ',' + $i;
                totalElement.innerHTML = parseInt(totalElement.innerHTML) + parseInt($price);
            }
            else 
            {
                showTextElement.innerHTML = $i.toString();
                totalElement.innerHTML = $price;
            }
        }

    }

  
}

function carrynext3()
{
    //alert("hello");
    if(start == passno)
    {
        document.getElementById("Texts").value = document.getElementById("showText").innerHTML;
        document.getElementById("Totals").value = document.getElementById("total").innerHTML;
        
    }
    else
    {
        //alert("hello");
        alert("You say you will buy " + passno + " tickets.");
        return false;
    }
    
}

 function carryback3()
 {
    document.getElementById("Textss").value = document.getElementById("showText").innerHTML;
    document.getElementById("Totalss").value = document.getElementById("total").innerHTML;
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
</body>
</html>