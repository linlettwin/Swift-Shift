<?php
session_start();


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
  header("Location: bus_page_2.php");

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

$customer = $_SESSION["customer"];




?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/png" href="images/bc_logo.png" />
  <link rel="stylesheet" href="">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2"
    crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
     <!--placeholder icon -->
    <script src="https://kit.fontawesome.com/094c1a5071.js" crossorigin="anonymous"></script>


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

.whole{  
    background-color:aquamarine;
    display:flex;
    flex-direction:column;
    justify-content:flex-start;
    margin-left:60px;
    margin-right:60px;
}

/* upper to from choose part */
.upper{
    background-color:#e7eef4;
    width:100%;
    height:auto;
  
}



/*ticket show part*/
.lower
{
   
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
        <?php 
            try {
                
                $conn = connect();
            
                $sql3 = "SELECT numberofseats, pid, GROUP_CONCAT(seatno) AS seatnos, status, screenshot, seen, bpname, bpphone, bdate, btime, bcost, paymethod, special, message 
                         FROM btickets 
                         WHERE cid = :customer 
                         GROUP BY bpname, bdate, btime  
                         ORDER BY bdate DESC, btime DESC";
            
                $stmt = $conn->prepare($sql3);
                $stmt->bindParam(':customer', $customer, PDO::PARAM_INT);
                $stmt->execute();
            
                $historys = $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                die("Query failed: " . $e->getMessage());
            }
        ?>

        <div class="upper">
            <?php
                    foreach($historys as $history)
            {
                $sql4 = "SELECT cg.town AS source, cg.cgaddress AS sourceaddress
                FROM cargate cg, route r, plan p
                WHERE p.rid = r.rid AND r.source = cg.cgid AND p.pid = :pid";

                    try {
                    $conn = connect();

                    // Assuming $history['pid'] contains the value for :pid
                    $stmt = $conn->prepare($sql4);
                    $stmt->bindParam(':pid', $history['pid'], PDO::PARAM_INT);
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
                    FROM cargate cg, route r, plan p
                    WHERE p.rid = r.rid AND r.destination = cg.cgid AND p.pid = :pid";

                    try {
                        $conn = connect();

                        // Assuming $history['pid'] contains the value for :pid
                        $stmt = $conn->prepare($sql5);
                        $stmt->bindParam(':pid', $history['pid'], PDO::PARAM_INT);
                        $stmt->execute();

                        // Fetch the result
                        $result = $stmt->fetch(PDO::FETCH_ASSOC);

                        // Assign values to variables
                        $destination = $result['destination'];
                        $destinationaddress = $result['destinationaddress'];
                    } catch (PDOException $e) {
                        die("Query failed: " . $e->getMessage());
                    }

                    $sql6 = "SELECT ddate, dtime FROM plan WHERE pid = :pid";

                    try {
                        $conn = connect();

                        // Assuming $history['pid'] contains the value for :pid
                        $stmt = $conn->prepare($sql6);
                        $stmt->bindParam(':pid', $history['pid'], PDO::PARAM_INT);
                        $stmt->execute();

                        // Fetch the result
                        $result = $stmt->fetch(PDO::FETCH_ASSOC);

                        // Assign values to variables
                        $ddate = $result['ddate'];
                        $dtime = $result['dtime'];
                        $dateTime = new DateTime("$ddate $dtime");
                        $formattedDateTime = $dateTime->format('j M Y h:ia');
                    } catch (PDOException $e) {
                        die("Query failed: " . $e->getMessage());
                    }

                    
                
                    if(strtolower($history["status"]) == "approved")
                    {
                        echo "<div class='card'>Your booking is successful!! You have booked for {$history['numberofseats']} seats ({$history['seatnos']}) in a travel plan from 
                        $source to $destination which will set out on $formattedDateTime.<a href='receipt.php'>Get Receipt</a>
                        </div>";
                    }

                    if (strtolower($history["status"]) == "disapproved")
                    {
                        echo "<div class='card'>Sorry!! You have booked for {$history['numberofseats']} seats ({$history['seatnos']}) in a travel plan from 
                                $source to $destination which will set out on $formattedDateTime. Your booking is rejected because {$history['message']} 
                                You can contact at swiftshift123@gmail.com or on 09-557849838.
                            </div>";
                    }
                    
            }



            $sql7 = "SELECT * FROM get_cargo_service WHERE cid = :customer";

            try {
                $conn = connect(); // Assuming connect() is a function that returns a PDO connection
                $stmt = $conn->prepare($sql7);
                
                // Bind the :customer parameter to the $customer variable
                $stmt->bindParam(':customer', $customer, PDO::PARAM_INT);
                
                // Execute the prepared statement
                $stmt->execute();
                
                // Fetch all results
                $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                
            } catch (PDOException $e) {
                die("Query failed: " . $e->getMessage());
            }
                    

            ?>               
                    
                  
        </div>

        <div class="lower">
                <?php
                        foreach($results as $result)
                {
                        $sql8 = "SELECT cr.cargo_src, cr.cargo_dest 
                        FROM cargo_route cr, get_cargo_service g 
                        WHERE g.crid = cr.crid AND g.gid = :gid";

                        try {
                        $conn = connect(); // Assuming connect() is a function that returns a PDO connection
                        $stmt = $conn->prepare($sql8);

                        // Assuming $result['gid'] contains the value you want to bind to :gid
                        $gid = $result['gid'];

                        // Bind the :gid parameter to the $gid variable
                        $stmt->bindParam(':gid', $gid, PDO::PARAM_INT);

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


                        if(strtolower($result["status"]) == "approved") {
                            // Prepare the date in a variable to avoid complexity within the echo statement
                            $cpdate = $result['cpdate'];
                            
                            echo "<div class='card'>Your booking is successful!! You have booked for a cargo service from {$cargo_source} Branch to {$cargo_destination} Branch which will set out on {$cpdate}.
                            <a href='cargo_receipt.php'>Get Receipt</a></div>";
                        }
                        

                        if(strtolower($result["status"]) == "disapproved")
                        {
                            // Extracting variables for easier use
                            $cpdate = $result['cpdate'];
                            $message = $result['message'];

                            echo "<div class='card'>Sorry!! You have booked for a cargo service from {$cargo_source} Branch to {$cargo_destination} Branch
                            which will set out on {$cpdate}. Your booking is rejected because {$message} 
                            You can contact us at swiftshift123@gmail.com or on 09-557849838.
                            </div>";
                        }


                }


                $sql1 = "UPDATE btickets SET seen='Yes' WHERE seen='No' AND cid=?";
                $sql2 = "UPDATE get_cargo_service SET seen='Yes' WHERE seen='No' AND cid=?";

                try {
                    $conn = connect();
                    
                    // Prepare and execute the first query
                    $stmt1 = $conn->prepare($sql1);
                    $stmt1->execute([$customer]);

                    // Prepare and execute the second query
                    $stmt2 = $conn->prepare($sql2);
                    $stmt2->execute([$customer]);

                    // Close the connection
                    $conn = null;
                } catch (PDOException $e) {
                    die("Query failed: " . $e->getMessage());
                }

                ?>
            
            
            
        </div>

        <a href="home.php">Back to Home</a>
    </div>


        <!--Footer-->
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
                        <div class=" d-flex">
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
        
            <!-- Container for the border line -->
            <div class="row mt-3">
                <div class="col border-bottom">
                    <!-- Empty column for the border -->
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
    </div>


        





  

<script>
 // Get all checkboxes with the name "category"
 function myFunction()     {  
 var cbs = document.querySelectorAll('input[type=checkbox]');
for(var i = 0; i < cbs.length; i++) {
    cbs[i].addEventListener('change', function() {
        if(this.checked)
            console.log(this.value);
            window.alert{this.value};
    });
} }
</script>


<?php
if(isset($_POST['btt'])){
    $chosen_ticket = $_POST['in2'];
    echo $chosen_ticket;
}
?>



</body>
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

?>
</html>



























   