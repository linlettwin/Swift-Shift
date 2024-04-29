<?php
session_start();

if (isset($_SESSION["customer"])) 
{
   
 
  $customer = $_SESSION["customer"];
  
  include "connect.php";  
  $sql = "SELECT * FROM customer WHERE cid = ?";
  $stmt = $dbconnection->prepare($sql);
  $stmt->bind_param("i", $customer);
  $stmt->execute();
  $result = $stmt->get_result();
  
  
  if ($result === false) {
      die("Query failed: " . $conn->error);
  }
  
  
  $customer = $result->fetch_assoc(); 
 
  $photo = $customer['photo'];
  $cid=$customer['cid'];
  $name = $customer['name'];
  $_SESSION['email']=$customer['email'];

  $sql = "SELECT count(*) as count FROM get_cargo_service WHERE ((status = 'Approved' AND seen='No') OR (status='Disapproved' AND seen='No')) AND cid = :customer;";

  try {
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

      $sql = "SELECT COUNT(DISTINCT CONCAT(bpname, bdate, btime)) AS group_count
      FROM btickets
      WHERE ((status = 'Approved' AND seen='No') OR (status='Disapproved' AND seen='No'))
            AND cid = :customer;";

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
      header("Location: bus_page_1.php");

    }

} else {
  
  $_SESSION["path"]="bus_page_1.php";
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


 
                        

if(isset($_POST["page1_next"]))
{
  if( isset($_SESSION["passno"]) )
  {
      if( setPost("passno") < $_SESSION["passno"] )
      {
          if( isset($_SESSION["Texts"]) || isset($_SESSION["Totals"]) )
          {
              unset($_SESSION["Texts"]);
              unset($_SESSION["Totals"]);
          }
          
      }
  }
      $_SESSION["from"] = setPost("from");
      $_SESSION["to"] = setPost("to");
      $_SESSION["date"] = setPost("date");
      $_SESSION["time"] = setPost("time");
      $_SESSION["passno"] = setPost("passno");

      include "showPlan.class.php";
      $showPlan1 = new showPlan(array());
      list($sourceid, $sourceaddress) = $showPlan1->getSourceid(setValue("from"));
      list($destinationid, $destinationaddress) = $showPlan1->getDestinationid(setValue("to"));
      $plans = $showPlan1->getPlans($sourceid, $destinationid, setValue("date"), setValue("time") );
    
      $_SESSION["sourceaddress"] = $sourceaddress;
      $_SESSION["destinationaddress"] = $destinationaddress;

      if($plans)
      {
        if (!isset($_SESSION["customer"])) {
          //echo "<script> window.alert('Hey'); </script>";   
          $_SESSION["path"]="bus_page_1.php";  
          //echo "<script> window.alert('Please Login or Signup first!'); </script>";                  
          header("Location: SignUP.php");
        }
        else 
        {
          header("Location: bus_page_2.php?bus=1");
        }
      }
      else
      {
        echo "<script>alert('No Travel Plan.'); window.location.href='bus_page_1.php';</script>";

      }

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/png" href="images/bc_logo.png" />
  <link rel="stylesheet" href="bus_page_1.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2"
    crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    <link href="https://netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/094c1a5071.js" crossorigin="anonymous"></script>
    <!--for animation-->
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

  
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <!--google fonts -->
	
   <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    <title>Swift Shift</title>

    <style>
      @import url('https://fonts.googleapis.com/css2?family=Itim&display=swap');

      *{
  box-sizing: border-box;
  margin: 0;
  padding: 0;
  
}
body,html {
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

/*body*/

.travel {
  margin: 0;
  padding: 0;
  background-image: url(images/bus/bus_background.jpg);
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
  height: 75vh;
  color: #fff;
  margin-top: -50px;
  padding-top: -30px;
}
.form_container{
  padding-top:100px;
  display:flex;
  flex-direction:row;
  justify-content: center;  
  margin-left:60px;
  margin-right:60px;
}
.title_ticket{
  width:120px;
  padding:15px;
  background-color:#4c4d4b;
  color:white;
  text-align: center;
  font-size:25px;
}
.title_ticket h6{
  font-family:"Poppins";
  text-align: center;
  margin-top: 55px;
}

.glass-container {
  background-color: rgba(53, 52, 52, 0.8);
  padding: 10px;
  border-radius: 0px;
  text-align: center;
  width: 100%;
  max-width: 100%;
  box-sizing: border-box;
  display: flex;
  flex-direction: column;
  align-items: flex-start;
}
.src_btn{
  background-color:#7895CB;
  color:black;
  font-weight:bold;
  width:90px;
  display:flex;
  text-align:center;
  justify-content: center;
}
#sub_btn{
  background-color:#7895CB;
  width:90px;
  border:none;
  font-size:30px;
  color:white;
}
.glass-container p {
  font-size: 12px;
}

.glass-container h4 {
  font-weight: bold;
 
  margin-bottom: 5px;
  text-align: left;
  margin-left: 0px;
}
.way {
  display:flex;
  margin-left:0px;
}
.way input{
width:20px;
}

.label {
  display: flex;
  justify-content: space-between;
  width: 100%;
  box-sizing: border-box;
  margin-top: 10px; /* Adjust as needed */

}

/* Styles for portions within the glass container */
.row {
  display: flex;
  justify-content: space-between;
}

.portion {
  flex: 1;
  text-align: center;
  padding: 20px;
  box-sizing: border-box;
  display: inline;
}
.portion i{
  padding: auto;
  margin-right: 5px;
}
.portion p{
  font-family:"Poppins";
}
h4 {
  font-weight: bold;
}

input {
  margin-top: 10px;
  width: 100%;
  padding: 8px;
  box-sizing: border-box;
}
select {
  margin-top: 10px;
  width: 100%;
  padding: 8px;
  box-sizing: border-box;
}
#adate{
  display:none;
}


.passenger_div{
display:none;
position:absolute;
z-index:2;
background-color:white;
width:300px;
height:230px;
margin-top:-110px;
margin-left:580px;
}

.passenger_total{
padding-top:20px;
padding-left:20px;
padding-right:20px;
display:flex;
flex-direction:column;
justify-content:center;
}
.pass_pt{
display:flex;
flex-direction:row;
justify-content:space-between;
}
.lab{
 color:black;
 font-size:20px;
 margin-top:30px;
}
.slt{
width:90px;
height:30px;
margin-top:30px;

}
.pass-btn{
width:100px;
height:35px;
margin-top: 30px;
margin-left:80px;
text-align:center;
padding:5px;
}


@media (max-width: 800px){
    .travel{
      height:100vh;
    }
    .passenger_div{
       margin-left:-15px;
       padding:20px;
    }
}

@media (max-width: 600px){
  .travel{
    height:150vh;
  }
  .passenger_div{
    margin-top:70px;
    padding:20px;
 }
}


.whole_lower{
  background-color: #E7EEF4;
  height:auto;
}

   .gray-container {
      background-color: #E7EEF4;
      display: flex;
      margin-left:60px; /*change*/
      margin-right:60px;
      height: 100%;
      padding-bottom:80px;
    }
    
    .part {
      flex: 1;
      padding: 20px;
      box-sizing: border-box;
    }
    
    .gray-container img {
      height: 100px;
      width: 100px;
    }
    
    .part1,
    .part2,
    .part3 {
      display: flex;
      margin-top: 30px;
    }
    
    
    .part1 .text,
    .part2 .text,
    .part3 .text {
      margin-left: 10px;
    }
    
    
    
  
    @media (max-width: 768px) {
      .gray-container {
        flex-direction: column; 
      }
    
      .part1,
      .part2,
      .part3 {
        flex-direction: column;
        align-items: center; 
      }
    
      .part1,
      .part2,
      .part3 img {
        margin-left: 20px; 
        margin-bottom: 10px; 
      }
    }
    .icon {
      padding-left: 25px;
      background: url("https://fontawesome.com/icons/location-dot?f=classic&s=solid") no-repeat left;
      background-size: 20px;
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
                     if(isset($_SESSION["customer"])){
                      echo '<a href="#hidden-div" class="trigger"> <img src="images/user/'. $photo .'"id="login_user"> </a>';
                     }
                     else{
                      echo '<a href="SignUp.php"> Login <i class="fa-solid fa-user"></i></a>';
                     }
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
   <form class="form_container" method="post" action="bus_page_1.php">
      <div class="title_ticket">
        <h6>Book Bus Ticket</h6>
      </div>

      <div class="glass-container">
        <div class="row">
          <div class="portion">
              <div style="display:inline-flex;">
                <i class="fa-solid fa-bus"></i>
                <p>Departure</p>
              </div>
              <input list="from" name="from" id="fplace" required="required" class="int" placeholder="From" value="<?php echo setValue("from"); ?>"
                style="font-family:Poppins, FontAwesome" onkeyup="noNum(this) , test(this)" required>
                <datalist id="from">
                  <option value="Ahtet Min Hla">
                    Ahtet Min Hla (အထက်မင်းလှ)
                  </option>
  
                  <option value="Ann">
                    Ann (အမ်း)
                  </option>
  
                  <option value="AungLan">
                    AungLan (အောင်လံ)
                  </option>
  
                  <option value="Aungpan">
                    Aungpan (အောင်ပန်း)
                  </option>
  
                  <option value="Ayadaw">
                    Ayadaw (အရာတော်)
                  </option>
  
                  <option value="Ayetharyar">
                    Ayetharyar (အေးသာယာ)
                  </option>
  
                  <option value="Bagan">
                    Bagan/Nyaung-U (ပုဂံ/ညောင်ဦး)
                  </option>
  
                  <option value="Bago">
                    Bago (ပဲခူး)
                  </option>
  
                  <option value="Bahin">
                    Bahin (ဗဟင်း)
                  </option>
  
                  <option value="Banmauk">
                    Banmauk (ဗန်းမောက်)
                  </option>
  
                  <option value="Bhamo">
                    Bhamo (ဗန်းမော်)
                  </option>
  
                  <option value="Bilin">
                    Bilin (ဘီးလင်း)
                  </option>
  
                  <option value="Bokpyin">
                    Bokpyin (ဘုတ်ပြင်း)
                  </option>
  
                  <option value="Budalin">
                    Budalin (ဘုတလင်)
                  </option>
  
                  <option value="Chauk">
                    Chauk (ချောက်)
                  </option>
  
                  <option value="Chaung Thar">
                    Chaung Thar (ချောင်းသာ)
                  </option>
  
                  <option value="ChaungU">
                    ChaungU (ချောင်းဦး)
                  </option>
  
                  <option value="Chaungzon">
                    Chaungzon (ချောင်းဆုံ)
                  </option>
  
                  <option value="Dagonayar(Yangon)">
                    Dagonayar(Yangon) (ဒဂုံဧရာ(ရန်ကုန်))
                  </option>
  
                  <option value="Daik-U">
                    Daik-U (ဒိုက်ဦး)
                  </option>
  
                  <option value="Danai">
                    Danai (တနိုင်း)
                  </option>
  
                  <option value="Danubyu">
                    Danubyu (ဓနုဖြူ)
                  </option>
  
                  <option value="Dawei">
                    Dawei (ထားဝယ်)
                  </option>
  
                  <option value="Demoso">
                    Demoso (ဒီမောဆို)
                  </option>
  
                  <option value="Gangaw">
                    Gangaw (ဂန့်ဂေါ)
                  </option>
  
                  <option value="Gwa">
                    Gwa (ဂွ)
                  </option>
  
                  <option value="Gway Gone">
                    Gway Gone (ဂွေးကုန်း)
                  </option>
  
                  <option value="Gyobingauk">
                    Gyobingauk (ကြို့ပင်ကောက်)
                  </option>
  
                  <option value="Hakha">
                    Hakha (ဟားခါး)
                  </option>
  
                  <option value="HeHoe">
                    HeHoe (ဟဲဟိုး)
                  </option>
  
                  <option value="Hinthada">
                    Hinthada (ဟင်္သာတ)
                  </option>
  
                  <option value="Hlegu">
                    Hlegu (လှည်းကူး)
                  </option>
  
                  <option value="Hopin">
                    Hopin (ဟိုပင်)
                  </option>
  
                  <option value="Hopong">
                    Hopong (ဟိုပုံး)
                  </option>
  
                  <option value="Hpa-An">
                    Hpa-An (ဘားအံ)
                  </option>
  
                  <option value="Hpakan">
                    Hpakan (ဖားကန့်)
                  </option>
  
                  <option value="Hpayargyi">
                    Hpayargyi (ဘုရားကြီး)
                  </option>
  
                  <option value="Hsipaw">
                    Hsipaw (သီပေါ)
                  </option>
  
                  <option value="Htonebo">
                    Htonebo (ထုံးဘို)
                  </option>
  
                  <option value="Indaw">
                    Indaw (အင်းတော်)
                  </option>
  
                  <option value="Ingapu">
                    Ingapu (အင်္ဂပူ)
                  </option>
  
                  <option value="Inn Ta Kaw">
                    Inn Ta Kaw (အင်းတကော်)
                  </option>
  
                  <option value="InnMa">
                    InnMa (အင်းမ)
                  </option>
  
                  <option value="Kalaw">
                    Kalaw (ကလော)
                  </option>
  
                  <option value="Kale">
                    Kale (ကလေး)
                  </option>
  
                  <option value="Kalewa">
                    Kalewa (ကလေး၀)
                  </option>
  
                  <option value="Kamma">
                    Kamma (ကမ္မ)
                  </option>
  
                  <option value="Kanbalu">
                    Kanbalu (ကန့်ဘလူ)
                  </option>
  
                  <option value="Kanbya">
                    Kanbya (ကန်ပြား)
                  </option>
  
                  <option value="Kanpetlet">
                    Kanpetlet (ကန်ပက်လက်)
                  </option>
  
                  <option value="Katha">
                    Katha (ကသာ)
                  </option>
  
                  <option value="Kawkareik">
                    Kawkareik (ကော့ကရိတ်)
                  </option>
  
                  <option value="Kawthaung">
                    Kawthaung (ကော့သောင်း)
                  </option>
  
                  <option value="Keng Tung">
                    Keng Tung (ကျိုင်းတုံ)
                  </option>
  
                  <option value="Khin-U">
                    Khin-U (ခင်ဦး)
                  </option>
  
                  <option value="Kho Lam">
                    Kho Lam (ခိုလမ်)
                  </option>
  
                  <option value="Koebin">
                    Koebin (ကိုးပင်)
                  </option>
  
                  <option value="Kon Zaung">
                    Kon Zaung (ကုန်းဇောင်း)
                  </option>
  
                  <option value="Kume">
                    Kume (ကူမဲ)
                  </option>
  
                  <option value="Kwin Hla">
                    Kwin Hla (ကွင်းလှ)
                  </option>
  
                  <option value="Kyaikkami">
                    Kyaikkami (ကျိုက်ခမီ)
                  </option>
  
                  <option value="Kyaiklat">
                    Kyaiklat (ကျိုက်လတ်)
                  </option>
  
                  <option value="Kyaiktiyo">
                    Kyaiktiyo (ကျိုက်ထီးရိုး)
                  </option>
  
                  <option value="Kyaikto">
                    Kyaikto (ကျိုက်ထို)
                  </option>
  
                  <option value="Kyainseikgyi">
                    Kyainseikgyi (ကြာအင်းဆိပ်ကြီး)
                  </option>
  
                  <option value="Kyangin">
                    Kyangin (ကြံခင်း)
                  </option>
  
                  <option value="Kyauk Gyi">
                    Kyauk Gyi (ကျောက်ကြီး)
                  </option>
  
                  <option value="Kyaukme">
                    Kyaukme (ကျောက်မဲ)
                  </option>
  
                  <option value="Kyaukpadaung">
                    Kyaukpadaung (ကျောက်ပန်းတောင်း)
                  </option>
  
                  <option value="Kyaukphyu">
                    Kyaukphyu (ကျောက်ဖြူ)
                  </option>
  
                  <option value="Kyaukse">
                    Kyaukse (ကျောက်ဆည်)
                  </option>
  
                  <option value="Kyauktaga">
                    Kyauktaga (ကျောက်တံခါး)
                  </option>
  
                  <option value="Kyauktaw">
                    Kyauktaw (ကျောက်တော်)
                  </option>
  
                  <option value="Kyaw">
                    Kyaw (ကျော)
                  </option>
  
                  <option value="Kyeintali">
                    Kyeintali (ကျိန္တလီ)
                  </option>
  
                  <option value="Kyun Hla">
                    Kyun Hla (ကျွန်းလှ)
                  </option>
  
                  <option value="Kyunchaung">
                    Kyunchaung (ကျွန်းချောင်း)
                  </option>
  
                  <option value="Lashio">
                    Lashio (လားရှိုး)
                  </option>
  
                  <option value="Lat Yin Ma">
                    Lat Yin Ma (လက်ယက်မ)
                  </option>
  
                  <option value="Lawksawk">
                    Lawksawk (ရပ်စောက်)
                  </option>
  
                  <option value="Lay Taung">
                    Lay Taung (လေးတောင်)
                  </option>
  
                  <option value="Lay Tine Sin">
                    Lay Tine Sin (လေးတိုင်စင်)
                  </option>
  
                  <option value="Letpadan">
                    Letpadan (လက်ပံတန်း)
                  </option>
  
                  <option value="Letpanhla">
                    Letpanhla (လက်ပန်လှ)
                  </option>
  
                  <option value="Lewe">
                    Lewe (လယ်ဝေး)
                  </option>
  
                  <option value="Loikaw">
                    Loikaw (လွိုင်ကော်)
                  </option>
  
                  <option value="Loilem">
                    Loilem (လွိုင်လင်)
                  </option>
  
                  <option value="Lonkin">
                    Lonkin (လုံးခင်း)
                  </option>
  
                  <option value="Ma-ei">
                    Ma-ei (မအီ)
                  </option>
  
                  <option value="Madaya">
                    Madaya (မတ္တရာ)
                  </option>
  
                  <option value="Magway">
                    Magway (မကွေး)
                  </option>
  
                  <option value="Mahar Myaing">
                    Mahar Myaing (မဟာမြိုင်)
                  </option>
  
                  <option value="Mahlaing">
                    Mahlaing (မလှိုင်)
                  </option>
  
                  <option value="Malun">
                    Malun (မလွန်)
                  </option>
  
                  <option value="Mandalay">
                    Mandalay (မန္တလေး)
                  </option>
  
                  <option value="Maubin">
                    Maubin (မအူပင်)
                  </option>
  
                  <option value="Maw Hun">
                    Maw Hun (မော်ဟန်)
                  </option>
  
                  <option value="Maw Luu">
                    Maw Luu (မော်လူး)
                  </option>
  
                  <option value="Mawlamyine">
                    Mawlamyine (မော်လမြိုင်)
                  </option>
  
                  <option value="Me Za Li Kone">
                    Me Za Li Kone (မဲဇလီကုန်း)
                  </option>
  
                  <option value="Meiktila">
                    Meiktila (မိတ္ထီလာ)
                  </option>
  
                  <option value="MinBya">
                    MinBya (မင်းပြား)
                  </option>
  
                  <option value="Minbu">
                    Minbu (မင်းဘူး)
                  </option>
  
                  <option value="Moebyel">
                    Moebyel (မိုးဗြဲ)
                  </option>
  
                  <option value="Mogaung">
                    Mogaung (မိုးကောင်း)
                  </option>
  
                  <option value="Mogok">
                    Mogok (မိုးကုတ်)
                  </option>
  
                  <option value="Mohnyin">
                    Mohnyin (မိုးညှင်း)
                  </option>
  
                  <option value="Monywa">
                    Monywa (မုံရွာ)
                  </option>
  
                  <option value="Mrauk-U">
                    Mrauk-U (မြောက်ဦး)
                  </option>
  
                  <option value="Mudon">
                    Mudon (မုဒုံ)
                  </option>
  
                  <option value="Muse">
                    Muse (မူဆယon�)
                  </option>
  
                  <option value="Mya Taung">
                    Mya Taung (မြတောင်)
                  </option>
  
                  <option value="Myaing">
                    Myaing (မြိုင်)
                  </option>
  
                  <option value="Myanaung">
                    Myanaung (မြန်အောင်)
                  </option>
  
                  <option value="Myaungmya">
                    Myaungmya (မြောင်းမြ)
                  </option>
  
                  <option value="Myawaddy">
                    Myawaddy (မြဝတီ)
                  </option>
  
                  <option value="Myeik">
                    Myeik (မြိတ်)
                  </option>
  
                  <option value="Myingyan">
                    Myingyan (မြင်းခြံ)
                  </option>
  
                  <option value="Myitchay">
                    Myitchay (မြစ်ခြေ)
                  </option>
  
                  <option value="Myitkyina">
                    Myitkyina (မြစ်ကြီးနား)
                  </option>
  
                  <option value="Myitnge">
                    Myitnge (မြစ်ငယ်)
                  </option>
  
                  <option value="Myittha">
                    Myittha (မြစ်သား)
                  </option>
  
                  <option value="Myo Hla">
                    Myo Hla (မြို့လှ)
                  </option>
  
                  <option value="Myothit">
                    Myothit (မြို့သစ်)
                  </option>
  
                  <option value="Namsang">
                    Namsang (နမ့်စန်)
                  </option>
  
                  <option value="Namsi Awng">
                    Namsi Awng (နန့်စီးအောင်)
                  </option>
  
                  <option value="Nan Mar">
                    Nan Mar (နမ်မား)
                  </option>
  
                  <option value="Nanmati">
                    Nanmati (နမ္မတီး)
                  </option>
  
                  <option value="Natmauk">
                    Natmauk (နတ်မောက်)
                  </option>
  
                  <option value="Natogyi">
                    Natogyi (နွားထိုးကြီး)
                  </option>
  
                  <option value="Nattalin">
                    Nattalin (နတ္တလင်း)
                  </option>
  
                  <option value="Nawnghkio">
                    Nawnghkio (နောင်ချို)
                  </option>
  
                  <option value="Naypyitaw(Bawga)">
                    Naypyitaw (Bawga) (နေပြည်တော် (ဘောဂ))
                  </option>
  
                  <option value="Naypyitaw(Myoma)">
                    Naypyitaw (Myoma) (နေပြည်တော် (မြို့မ))
                  </option>
  
                  <option value="Naypyitaw(Thapyaygone)">
                    Naypyitaw (Thapyaygone) (နေပြည်တော် (သပြေကုန်း))
                  </option>
  
                  <option value="Ngapali">
                    Ngapali (ငပလီ)
                  </option>
  
                  <option value="Ngar O">
                    Ngar O (ငါးအိုး)
                  </option>
  
                  <option value="Ngwe Saung">
                    Ngwe Saung (ငွေဆောင်)
                  </option>
  
                  <option value="Nyaung Kone">
                    Nyaung Kone (ညောင်ကုန်း)
                  </option>
  
                  <option value="Nyaung Lay Pin">
                    Nyaung Lay Pin (ညောင်လေးပင်)
                  </option>
  
                  <option value="Nyaung Pin Thar">
                    Nyaung Pin Thar (ညောင်ပင်သာ)
                  </option>
  
                  <option value="Nyaung Shwe(Inle)">
                    Nyaung Shwe(Inle) (ညောင်ရွှေ(အင်းလေး))
                  </option>
  
                  <option value="NyaungPin">
                    NyaungPin (ညောင်ပင်)
                  </option>
  
                  <option value="Nyaungdon">
                    Nyaungdon (ညောင်တုန်း)
                  </option>
  
                  <option value="Oak Pho">
                    Oak Pho (အုတ်ဖို)
                  </option>
  
                  <option value="Oke Shit Pin">
                    Oke Shit Pin (ဥသျှစ်ပင်)
                  </option>
  
                  <option value="Oktwin">
                    Oktwin (အုတ်တွင်း)
                  </option>
  
                  <option value="Padaung">
                    Padaung (ပန်းတောင်း)
                  </option>
  
                  <option value="Padein">
                    Padein (ပဒါန်း)
                  </option>
  
                  <option value="Padigon">
                    Padigon (ပုတီးကုန်း)
                  </option>
  
                  <option value="Pakokku">
                    Pakokku (ပခုက္ကူ)
                  </option>
  
                  <option value="Pala">
                    Pala (ပလ)
                  </option>
  
                  <option value="Palauk">
                    Palauk (ပလောက်)
                  </option>
  
                  <option value="Palaw">
                    Palaw (ပုလော)
                  </option>
  
                  <option value="Pale">
                    Pale (ပုလဲ)
                  </option>
  
                  <option value="Pathein">
                    Pathein (ပုသိမ်)
                  </option>
  
                  <option value="Pauk">
                    Pauk (ပေါက်)
                  </option>
  
                  <option value="Paukkhaung">
                    Paukkhaung (ပေါက်ခေါင်း)
                  </option>
  
                  <option value="Pauktaw">
                    Pauktaw (ပေါက်တော)
                  </option>
  
                  <option value="Paung">
                    Paung (ပေါင်)
                  </option>
  
                  <option value="Paungdale">
                    Paungdale (ပေါင်းတလည်)
                  </option>
  
                  <option value="Paungde">
                    Paungde (ပေါင်းတည်)
                  </option>
  
                  <option value="Payangazu">
                    Payangazu (ဘုရားငါးဆ  �)
                  </option>
  
                  <option value="Pekon">
                    Pekon (ဖယ်ခုံ)
                  </option>
  
                  <option value="Penwegon">
                    Penwegon (ပဲနွယ်ကုန်း)
                  </option>
  
                  <option value="Petye">
                    Petye (ဘက်ရဲ)
                  </option>
  
                  <option value="Phar Auk">
                    Phar Auk (ဖားအောက်)
                  </option>
  
                  <option value="Phyu">
                    Phyu (ဖြူး)
                  </option>
  
                  <option value="Pindaya">
                    Pindaya (ပင်းတယ)
                  </option>
  
                  <option value="Pinlaung">
                    Pinlaung (ပင်လောင်း)
                  </option>
  
                  <option value="Pinlon">
                    Pinlon (ပင်လုံ)
                  </option>
  
                  <option value="Ponnagyun">
                    Ponnagyun (ပုဏ္ဏားကျွန်း)
                  </option>
  
                  <option value="Pwintbyu">
                    Pwintbyu (ပွင့်ဖြူ)
                  </option>
  
                  <option value="Pyapon">
                    Pyapon (���ျာပုံ)
                  </option>
  
                  <option value="Pyawbwe">
                    Pyawbwe (ပျော်ဘွယ်)
                  </option>
  
                  <option value="Pyay">
                    Pyay (ပြည်)
                  </option>
  
                  <option value="Pyin Oo Lwin">
                    Pyin Oo Lwin (ပြင်ဦးလွင်)
                  </option>
  
                  <option value="Pyinbongyi">
                    Pyinbongyi (ပျဉ်ပုံကြီး)
                  </option>
  
                  <option value="Pyuntasa">
                    Pyuntasa (ပြွန်တန်ဆာ)
                  </option>
  
                  <option value="Sadaung">
                    Sadaung (ဆားတောင်)
                  </option>
  
                  <option value="Sagaing">
                    Sagaing (စစ်ကိုင်း)
                  </option>
  
                  <option value="Sahmaw">
                    Sahmaw (ဆားမှော်)
                  </option>
  
                  <option value="Saing Pyin">
                    Saing Pyin (စိုင်ပြင်)
                  </option>
  
                  <option value="Salin">
                    Salin (စလင်း)
                  </option>
  
                  <option value="Sane">
                    Sane (စနဲ)
                  </option>
  
                  <option value="Satthwa">
                    Satthwa (ဆပ်သွား)
                  </option>
  
                  <option value="Seikphyu">
                    Seikphyu (ဆိပ်ဖြူ)
                  </option>
  
                  <option value="Shwe Ku">
                    Shwe Ku (ရွှေကူ)
                  </option>
  
                  <option value="Shwe Nyaung">
                    Shwe Nyaung (ရွှေညောင်)
                  </option>
  
                  <option value="Shwe Set Taw">
                    Shwe Set Taw (ရွှေစက်တော်)
                  </option>
  
                  <option value="Shwebo">
                    Shwebo (ရွှေဘို)
                  </option>
  
                  <option value="Shwedaung">
                    Shwedaung (ရွှေတောင်)
                  </option>
  
                  <option value="Shwehlae">
                    Shwehlae (ရွှေလှေ)
                  </option>
  
                  <option value="Si Sone Gone">
                    Si Sone Gone (ဆီဆုံကုန်း)
                  </option>
  
                  <option value="Sin Hpyu Kyun">
                    Sin Hpyu Kyun (ဆင်ဖြူကျွန်း)
                  </option>
  
                  <option value="Sinde">
                    Sinde (ဆင်တဲ)
                  </option>
  
                  <option value="Sintgaing">
                    Sintgaing (စဉ့်ကိုင်)
                  </option>
  
                  <option value="Sittwe">
                    Sittwe (စစ်တွေ)
                  </option>
  
                  <option value="Swar">
                    Swar (ဆွာ)
                  </option>
  
                  <option value="Tabayin">
                    Tabayin (ဒီပဲယင်း)
                  </option>
  
                  <option value="Tachileik">
                    Tachileik (တာချီလိတ်)
                  </option>
  
                  <option value="Tamu">
                    Tamu (တမူး)
                  </option>
  
                  <option value="Tanintharyi">
                    Tanintharyi (တနင်္သာရီ)
                  </option>
  
                  <option value="Tatkon">
                    Tatkon (တပ်ကုန်း)
                  </option>
  
                  <option value="Taungdwingyi">
                    Taungdwingyi (တောင်တွင်းကြီး)
                  </option>
  
                  <option value="Taunggyi">
                    Taunggyi (တောင်ကြီး)
                  </option>
  
                  <option value="Taungoo">
                    Taungoo (တောင်ငူ)
                  </option>
  
                  <option value="Taungtha">
                    Taungtha (တောင်သာ)
                  </option>
  
                  <option value="Taw Kyel Inn">
                    Taw Kyel Inn (တောကျွဲအင်း)
                  </option>
  
                  <option value="Taze">
                    Taze (တန့်ဆည်)
                  </option>
  
                  <option value="Tha Bye Kon">
                    Tha Bye Kon (သပြေကုန်း)
                  </option>
  
                  <option value="Thabeikkyin">
                    Thabeikkyin (သပိတ်ကျဉ်း)
                  </option>
  
                  <option value="Thanbyuzayat">
                    Thanbyuzayat (သံဖြူဇရပ်)
                  </option>
  
                  <option value="Thandwe">
                    Thandwe (သံတွဲ)
                  </option>
  
                  <option value="Thaton">
                    Thaton (သထုံ)
                  </option>
  
                  <option value="Thazi">
                    Thazi (သာစည်)
                  </option>
  
                  <option value="Thegon">
                    Thegon (သဲကုန်း)
                  </option>
  
                  <option value="Thit Yar Kaut">
                    Thit Yar Kaut (သစ်ရာကောက်)
                  </option>
  
                  <option value="Tigyaing">
                    Tigyaing (ထီးချိုင့်)
                  </option>
  
                  <option value="Tilin">
                    Tilin (ထီးလင်း)
                  </option>
  
                  <option value="Toungup">
                    Toungup (တောင်ကုတ်)
                  </option>
  
                  <option value="Wathtikan">
                    Wathtikan (ဝက်ထီးကန်)
                  </option>
  
                  <option value="Waw">
                    Waw (ဝေါ)
                  </option>
  
                  <option value="Wetpoat">
                    Wetpoat (ဝက်ပုတ်)
                  </option>
  
                  <option value="Wundwin">
                    Wundwin (ဝမ်းတွင်း)
                  </option>
  
                  <option value="Yae Myet Ni">
                    Yae Myet Ni (ရေမျက်နီ)
                  </option>
  
                  <option value="Yae Nan Ma">
                    Yae Nan Ma (ရေနံမ)
                  </option>
  
                  <option value="Yae Ni">
                    Yae Ni (ရေနီ)
                  </option>
  
                  <option value="Yamethin">
                    Yamethin (ရမည်းသင်း)
                  </option>
  
                  <option value="Yanbye">
                    Yanbye (ရမ်းဗြဲ)
                  </option>
  
                  <option value="Yangon(Aung Mingalar)">
                    Yangon(Aung Mingalar) (ရန်ကုန်)
                  </option>
  
                  <option value="Ye">
                    Ye (ရေး)
                  </option>
  
                  <option value="YeU">
                    YeU (ရေဦး)
                  </option>
  
                  <option value="Yedashe">
                    Yedashe (ရေတာရှည်)
                  </option>
  
                  <option value="Yenangyaung">
                    Yenangyaung (ရေနံချောင်း)
                  </option>
  
                  <option value="Yesagyo">
                    Yesagyo (ရေစကြို)
                  </option>
  
                  <option value="Yin Mar Bin">
                    Yin Mar Bin (ယင်းမာပင)
                  </option>
  
                  <option value="Ywar Mon">
                    Ywar Mon (ရွာမွန်)
                  </option>
  
                  <option value="Ywarthit">
                    Ywarthit (ရွာသစ်)
                  </option>
  
                  <option value="Zalun">
                    Zalun (ဇလွန်)
                  </option>
  
                  <option value="Zayat Kwin(Mandalay)">
                    Zayat Kwin(Mandalay) (ဇရပ်ကွင်း(မန္တလေး))
                  </option>
  
                  <option value="Zeyawaddy">
                    Zeyawaddy (ဇေယျဝတီ)
                  </option>
  
                  <option value="Zigon">
                    Zigon (ဇီးကုန်း)
                  </option>
  
                  <option value="Zin Chaung">
                    Zin Chaung (ဇင်ချောင်း)
                  </option>
  
                  <option value="Zin Kyaik">
                    Zin Kyaik (ဇင်းကျိုက်)
                  </option>
  
                </datalist>
          </div>

          <div class="portion">
              <div style="display:inline-flex;">
                <i class="fa-solid fa-location-dot"></i>
                <p>Destination</p>
                </div>
                <input list="to" name="to" id="tplace" required="required" class="int" placeholder="To" value="<?php echo setValue("to"); ?>"
                style="font-family:Poppins, FontAwesome" onkeyup="noNum(this) , test(this)" required>
                <datalist id="to">
                  <option value="Ahtet Min Hla">
                    Ahtet Min Hla (အထက်မင်းလှ)
                  </option>
  
                  <option value="Ann">
                    Ann (အမ်း)
                  </option>
  
                  <option value="AungLan">
                    AungLan (အောင်လံ)
                  </option>
  
                  <option value="Aungpan">
                    Aungpan (အောင်ပန်း)
                  </option>
  
                  <option value="Ayadaw">
                    Ayadaw (အရာတော်)
                  </option>
  
                  <option value="Ayetharyar">
                    Ayetharyar (အေးသာယာ)
                  </option>
  
                  <option value="Bagan">
                    Bagan/Nyaung-U (ပုဂံ/ညောင်ဦး)
                  </option>
  
                  <option value="Bago">
                    Bago (ပဲခူး)
                  </option>
  
                  <option value="Bahin">
                    Bahin (ဗဟင်း)
                  </option>
  
                  <option value="Banmauk">
                    Banmauk (ဗန်းမောက်)
                  </option>
  
                  <option value="Bhamo">
                    Bhamo (ဗန်းမော်)
                  </option>
  
                  <option value="Bilin">
                    Bilin (ဘီးလင်း)
                  </option>
  
                  <option value="Bokpyin">
                    Bokpyin (ဘုတ်ပြင်း)
                  </option>
  
                  <option value="Budalin">
                    Budalin (ဘုတလင်)
                  </option>
  
                  <option value="Chauk">
                    Chauk (ချောက်)
                  </option>
  
                  <option value="Chaung Thar">
                    Chaung Thar (ချောင်းသာ)
                  </option>
  
                  <option value="ChaungU">
                    ChaungU (ချောင်းဦး)
                  </option>
  
                  <option value="Chaungzon">
                    Chaungzon (ချောင်းဆုံ)
                  </option>
  
                  <option value="Dagonayar(Yangon)">
                    Dagonayar(Yangon) (ဒဂုံဧရာ(ရန်ကုန်))
                  </option>
  
                  <option value="Daik-U">
                    Daik-U (ဒိုက်ဦး)
                  </option>
  
                  <option value="Danai">
                    Danai (တနိုင်း)
                  </option>
  
                  <option value="Danubyu">
                    Danubyu (ဓနုဖြူ)
                  </option>
  
                  <option value="Dawei">
                    Dawei (ထားဝယ်)
                  </option>
  
                  <option value="Demoso">
                    Demoso (ဒီမောဆို)
                  </option>
  
                  <option value="Gangaw">
                    Gangaw (ဂန့်ဂေါ)
                  </option>
  
                  <option value="Gwa">
                    Gwa (ဂွ)
                  </option>
  
                  <option value="Gway Gone">
                    Gway Gone (ဂွေးကုန်း)
                  </option>
  
                  <option value="Gyobingauk">
                    Gyobingauk (ကြို့ပင်ကောက်)
                  </option>
  
                  <option value="Hakha">
                    Hakha (ဟားခါး)
                  </option>
  
                  <option value="HeHoe">
                    HeHoe (ဟဲဟိုး)
                  </option>
  
                  <option value="Hinthada">
                    Hinthada (ဟင်္သာတ)
                  </option>
  
                  <option value="Hlegu">
                    Hlegu (လှည်းကူး)
                  </option>
  
                  <option value="Hopin">
                    Hopin (ဟိုပင်)
                  </option>
  
                  <option value="Hopong">
                    Hopong (ဟိုပုံး)
                  </option>
  
                  <option value="Hpa-An">
                    Hpa-An (ဘားအံ)
                  </option>
  
                  <option value="Hpakan">
                    Hpakan (ဖားကန့်)
                  </option>
  
                  <option value="Hpayargyi">
                    Hpayargyi (ဘုရားကြီး)
                  </option>
  
                  <option value="Hsipaw">
                    Hsipaw (သီပေါ)
                  </option>
  
                  <option value="Htonebo">
                    Htonebo (ထုံးဘို)
                  </option>
  
                  <option value="Indaw">
                    Indaw (အင်းတော်)
                  </option>
  
                  <option value="Ingapu">
                    Ingapu (အင်္ဂပူ)
                  </option>
  
                  <option value="Inn Ta Kaw">
                    Inn Ta Kaw (အင်းတကော်)
                  </option>
  
                  <option value="InnMa">
                    InnMa (အင်းမ)
                  </option>
  
                  <option value="Kalaw">
                    Kalaw (ကလော)
                  </option>
  
                  <option value="Kale">
                    Kale (ကလေး)
                  </option>
  
                  <option value="Kalewa">
                    Kalewa (ကလေး၀)
                  </option>
  
                  <option value="Kamma">
                    Kamma (ကမ္မ)
                  </option>
  
                  <option value="Kanbalu">
                    Kanbalu (ကန့်ဘလူ)
                  </option>
  
                  <option value="Kanbya">
                    Kanbya (ကန်ပြား)
                  </option>
  
                  <option value="Kanpetlet">
                    Kanpetlet (ကန်ပက်လက်)
                  </option>
  
                  <option value="Katha">
                    Katha (ကသာ)
                  </option>
  
                  <option value="Kawkareik">
                    Kawkareik (ကော့ကရိတ်)
                  </option>
  
                  <option value="Kawthaung">
                    Kawthaung (ကော့သောင်း)
                  </option>
  
                  <option value="Keng Tung">
                    Keng Tung (ကျိုင်းတုံ)
                  </option>
  
                  <option value="Khin-U">
                    Khin-U (ခင်ဦး)
                  </option>
  
                  <option value="Kho Lam">
                    Kho Lam (ခိုလမ်)
                  </option>
  
                  <option value="Koebin">
                    Koebin (ကိုးပင်)
                  </option>
  
                  <option value="Kon Zaung">
                    Kon Zaung (ကုန်းဇောင်း)
                  </option>
  
                  <option value="Kume">
                    Kume (ကူမဲ)
                  </option>
  
                  <option value="Kwin Hla">
                    Kwin Hla (ကွင်းလှ)
                  </option>
  
                  <option value="Kyaikkami">
                    Kyaikkami (ကျိုက်ခမီ)
                  </option>
  
                  <option value="Kyaiklat">
                    Kyaiklat (ကျိုက်လတ်)
                  </option>
  
                  <option value="Kyaiktiyo">
                    Kyaiktiyo (ကျိုက်ထီးရိုး)
                  </option>
  
                  <option value="Kyaikto">
                    Kyaikto (ကျိုက်ထို)
                  </option>
  
                  <option value="Kyainseikgyi">
                    Kyainseikgyi (ကြာအင်းဆိပ်ကြီး)
                  </option>
  
                  <option value="Kyangin">
                    Kyangin (ကြံခင်း)
                  </option>
  
                  <option value="Kyauk Gyi">
                    Kyauk Gyi (ကျောက်ကြီး)
                  </option>
  
                  <option value="Kyaukme">
                    Kyaukme (ကျောက်မဲ)
                  </option>
  
                  <option value="Kyaukpadaung">
                    Kyaukpadaung (ကျောက်ပန်းတောင်း)
                  </option>
  
                  <option value="Kyaukphyu">
                    Kyaukphyu (ကျောက်ဖြူ)
                  </option>
  
                  <option value="Kyaukse">
                    Kyaukse (ကျောက်ဆည်)
                  </option>
  
                  <option value="Kyauktaga">
                    Kyauktaga (ကျောက်တံခါး)
                  </option>
  
                  <option value="Kyauktaw">
                    Kyauktaw (ကျောက်တော်)
                  </option>
  
                  <option value="Kyaw">
                    Kyaw (ကျော)
                  </option>
  
                  <option value="Kyeintali">
                    Kyeintali (ကျိန္တလီ)
                  </option>
  
                  <option value="Kyun Hla">
                    Kyun Hla (ကျွန်းလှ)
                  </option>
  
                  <option value="Kyunchaung">
                    Kyunchaung (ကျွန်းချောင်း)
                  </option>
  
                  <option value="Lashio">
                    Lashio (လားရှိုး)
                  </option>
  
                  <option value="Lat Yin Ma">
                    Lat Yin Ma (လက်ယက်မ)
                  </option>
  
                  <option value="Lawksawk">
                    Lawksawk (ရပ်စောက်)
                  </option>
  
                  <option value="Lay Taung">
                    Lay Taung (လေးတောင်)
                  </option>
  
                  <option value="Lay Tine Sin">
                    Lay Tine Sin (လေးတိုင်စင်)
                  </option>
  
                  <option value="Letpadan">
                    Letpadan (လက်ပံတန်း)
                  </option>
  
                  <option value="Letpanhla">
                    Letpanhla (လက်ပန်လှ)
                  </option>
  
                  <option value="Lewe">
                    Lewe (လယ်ဝေး)
                  </option>
  
                  <option value="Loikaw">
                    Loikaw (လွိုင်ကော်)
                  </option>
  
                  <option value="Loilem">
                    Loilem (လွိုင်လင်)
                  </option>
  
                  <option value="Lonkin">
                    Lonkin (လုံးခင်း)
                  </option>
  
                  <option value="Ma-ei">
                    Ma-ei (မအီ)
                  </option>
  
                  <option value="Madaya">
                    Madaya (မတ္တရာ)
                  </option>
  
                  <option value="Magway">
                    Magway (မကွေး)
                  </option>
  
                  <option value="Mahar Myaing">
                    Mahar Myaing (မဟာမြိုင်)
                  </option>
  
                  <option value="Mahlaing">
                    Mahlaing (မလှိုင်)
                  </option>
  
                  <option value="Malun">
                    Malun (မလွန်)
                  </option>
  
                  <option value="Mandalay">
                    Mandalay (မန္တလေး)
                  </option>
  
                  <option value="Maubin">
                    Maubin (မအူပင်)
                  </option>
  
                  <option value="Maw Hun">
                    Maw Hun (မော်ဟန်)
                  </option>
  
                  <option value="Maw Luu">
                    Maw Luu (မော်လူး)
                  </option>
  
                  <option value="Mawlamyine">
                    Mawlamyine (မော်လမြိုင်)
                  </option>
  
                  <option value="Me Za Li Kone">
                    Me Za Li Kone (မဲဇလီကုန်း)
                  </option>
  
                  <option value="Meiktila">
                    Meiktila (မိတ္ထီလာ)
                  </option>
  
                  <option value="MinBya">
                    MinBya (မင်းပြား)
                  </option>
  
                  <option value="Minbu">
                    Minbu (မင်းဘူး)
                  </option>
  
                  <option value="Moebyel">
                    Moebyel (မိုးဗြဲ)
                  </option>
  
                  <option value="Mogaung">
                    Mogaung (မိုးကောင်း)
                  </option>
  
                  <option value="Mogok">
                    Mogok (မိုးကုတ်)
                  </option>
  
                  <option value="Mohnyin">
                    Mohnyin (မိုးညှင်း)
                  </option>
  
                  <option value="Monywa">
                    Monywa (မုံရွာ)
                  </option>
  
                  <option value="Mrauk-U">
                    Mrauk-U (မြောက်ဦး)
                  </option>
  
                  <option value="Mudon">
                    Mudon (မုဒုံ)
                  </option>
  
                  <option value="Muse">
                    Muse (မူဆယon�)
                  </option>
  
                  <option value="Mya Taung">
                    Mya Taung (မြတောင်)
                  </option>
  
                  <option value="Myaing">
                    Myaing (မြိုင်)
                  </option>
  
                  <option value="Myanaung">
                    Myanaung (မြန်အောင်)
                  </option>
  
                  <option value="Myaungmya">
                    Myaungmya (မြောင်းမြ)
                  </option>
  
                  <option value="Myawaddy">
                    Myawaddy (မြဝတီ)
                  </option>
  
                  <option value="Myeik">
                    Myeik (မြိတ်)
                  </option>
  
                  <option value="Myingyan">
                    Myingyan (မြင်းခြံ)
                  </option>
  
                  <option value="Myitchay">
                    Myitchay (မြစ်ခြေ)
                  </option>
  
                  <option value="Myitkyina">
                    Myitkyina (မြစ်ကြီးနား)
                  </option>
  
                  <option value="Myitnge">
                    Myitnge (မြစ်ငယ်)
                  </option>
  
                  <option value="Myittha">
                    Myittha (မြစ်သား)
                  </option>
  
                  <option value="Myo Hla">
                    Myo Hla (မြို့လှ)
                  </option>
  
                  <option value="Myothit">
                    Myothit (မြို့သစ်)
                  </option>
  
                  <option value="Namsang">
                    Namsang (နမ့်စန်)
                  </option>
  
                  <option value="Namsi Awng">
                    Namsi Awng (နန့်စီးအောင်)
                  </option>
  
                  <option value="Nan Mar">
                    Nan Mar (နမ်မား)
                  </option>
  
                  <option value="Nanmati">
                    Nanmati (နမ္မတီး)
                  </option>
  
                  <option value="Natmauk">
                    Natmauk (နတ်မောက်)
                  </option>
  
                  <option value="Natogyi">
                    Natogyi (နွားထိုးကြီး)
                  </option>
  
                  <option value="Nattalin">
                    Nattalin (နတ္တလင်း)
                  </option>
  
                  <option value="Nawnghkio">
                    Nawnghkio (နောင်ချို)
                  </option>
  
                  <option value="Naypyitaw(Bawga)">
                    Naypyitaw (Bawga) (နေပြည်တော် (ဘောဂ))
                  </option>
  
                  <option value="Naypyitaw(Myoma)">
                    Naypyitaw (Myoma) (နေပြည်တော် (မြို့မ))
                  </option>
  
                  <option value="Naypyitaw(Thapyaygone)">
                    Naypyitaw (Thapyaygone) (နေပြည်တော် (သပြေကုန်း))
                  </option>
  
                  <option value="Ngapali">
                    Ngapali (ငပလီ)
                  </option>
  
                  <option value="Ngar O">
                    Ngar O (ငါးအိုး)
                  </option>
  
                  <option value="Ngwe Saung">
                    Ngwe Saung (ငွေဆောင်)
                  </option>
  
                  <option value="Nyaung Kone">
                    Nyaung Kone (ညောင်ကုန်း)
                  </option>
  
                  <option value="Nyaung Lay Pin">
                    Nyaung Lay Pin (ညောင်လေးပင်)
                  </option>
  
                  <option value="Nyaung Pin Thar">
                    Nyaung Pin Thar (ညောင်ပင်သာ)
                  </option>
  
                  <option value="Nyaung Shwe(Inle)">
                    Nyaung Shwe(Inle) (ညောင်ရွှေ(အင်းလေး))
                  </option>
  
                  <option value="NyaungPin">
                    NyaungPin (ညောင်ပင်)
                  </option>
  
                  <option value="Nyaungdon">
                    Nyaungdon (ညောင်တုန်း)
                  </option>
  
                  <option value="Oak Pho">
                    Oak Pho (အုတ်ဖို)
                  </option>
  
                  <option value="Oke Shit Pin">
                    Oke Shit Pin (ဥသျှစ်ပင်)
                  </option>
  
                  <option value="Oktwin">
                    Oktwin (အုတ်တွင်း)
                  </option>
  
                  <option value="Padaung">
                    Padaung (ပန်းတောင်း)
                  </option>
  
                  <option value="Padein">
                    Padein (ပဒါန်း)
                  </option>
  
                  <option value="Padigon">
                    Padigon (ပုတီးကုန်း)
                  </option>
  
                  <option value="Pakokku">
                    Pakokku (ပခုက္ကူ)
                  </option>
  
                  <option value="Pala">
                    Pala (ပလ)
                  </option>
  
                  <option value="Palauk">
                    Palauk (ပလောက်)
                  </option>
  
                  <option value="Palaw">
                    Palaw (ပုလော)
                  </option>
  
                  <option value="Pale">
                    Pale (ပုလဲ)
                  </option>
  
                  <option value="Pathein">
                    Pathein (ပုသိမ်)
                  </option>
  
                  <option value="Pauk">
                    Pauk (ပေါက်)
                  </option>
  
                  <option value="Paukkhaung">
                    Paukkhaung (ပေါက်ခေါင်း)
                  </option>
  
                  <option value="Pauktaw">
                    Pauktaw (ပေါက်တော)
                  </option>
  
                  <option value="Paung">
                    Paung (ပေါင်)
                  </option>
  
                  <option value="Paungdale">
                    Paungdale (ပေါင်းတလည်)
                  </option>
  
                  <option value="Paungde">
                    Paungde (ပေါင်းတည်)
                  </option>
  
                  <option value="Payangazu">
                    Payangazu (ဘုရားငါးဆ  �)
                  </option>
  
                  <option value="Pekon">
                    Pekon (ဖယ်ခုံ)
                  </option>
  
                  <option value="Penwegon">
                    Penwegon (ပဲနွယ်ကုန်း)
                  </option>
  
                  <option value="Petye">
                    Petye (ဘက်ရဲ)
                  </option>
  
                  <option value="Phar Auk">
                    Phar Auk (ဖားအောက်)
                  </option>
  
                  <option value="Phyu">
                    Phyu (ဖြူး)
                  </option>
  
                  <option value="Pindaya">
                    Pindaya (ပင်းတယ)
                  </option>
  
                  <option value="Pinlaung">
                    Pinlaung (ပင်လောင်း)
                  </option>
  
                  <option value="Pinlon">
                    Pinlon (ပင်လုံ)
                  </option>
  
                  <option value="Ponnagyun">
                    Ponnagyun (ပုဏ္ဏားကျွန်း)
                  </option>
  
                  <option value="Pwintbyu">
                    Pwintbyu (ပွင့်ဖြူ)
                  </option>
  
                  <option value="Pyapon">
                    Pyapon (���ျာပုံ)
                  </option>
  
                  <option value="Pyawbwe">
                    Pyawbwe (ပျော်ဘွယ်)
                  </option>
  
                  <option value="Pyay">
                    Pyay (ပြည်)
                  </option>
  
                  <option value="Pyin Oo Lwin">
                    Pyin Oo Lwin (ပြင်ဦးလွင်)
                  </option>
  
                  <option value="Pyinbongyi">
                    Pyinbongyi (ပျဉ်ပုံကြီး)
                  </option>
  
                  <option value="Pyuntasa">
                    Pyuntasa (ပြွန်တန်ဆာ)
                  </option>
  
                  <option value="Sadaung">
                    Sadaung (ဆားတောင်)
                  </option>
  
                  <option value="Sagaing">
                    Sagaing (စစ်ကိုင်း)
                  </option>
  
                  <option value="Sahmaw">
                    Sahmaw (ဆားမှော်)
                  </option>
  
                  <option value="Saing Pyin">
                    Saing Pyin (စိုင်ပြင်)
                  </option>
  
                  <option value="Salin">
                    Salin (စလင်း)
                  </option>
  
                  <option value="Sane">
                    Sane (စနဲ)
                  </option>
  
                  <option value="Satthwa">
                    Satthwa (ဆပ်သွား)
                  </option>
  
                  <option value="Seikphyu">
                    Seikphyu (ဆိပ်ဖြူ)
                  </option>
  
                  <option value="Shwe Ku">
                    Shwe Ku (ရွှေကူ)
                  </option>
  
                  <option value="Shwe Nyaung">
                    Shwe Nyaung (ရွှေညောင်)
                  </option>
  
                  <option value="Shwe Set Taw">
                    Shwe Set Taw (ရွှေစက်တော်)
                  </option>
  
                  <option value="Shwebo">
                    Shwebo (ရွှေဘို)
                  </option>
  
                  <option value="Shwedaung">
                    Shwedaung (ရွှေတောင်)
                  </option>
  
                  <option value="Shwehlae">
                    Shwehlae (ရွှေလှေ)
                  </option>
  
                  <option value="Si Sone Gone">
                    Si Sone Gone (ဆီဆုံကုန်း)
                  </option>
  
                  <option value="Sin Hpyu Kyun">
                    Sin Hpyu Kyun (ဆင်ဖြူကျွန်း)
                  </option>
  
                  <option value="Sinde">
                    Sinde (ဆင်တဲ)
                  </option>
  
                  <option value="Sintgaing">
                    Sintgaing (စဉ့်ကိုင်)
                  </option>
  
                  <option value="Sittwe">
                    Sittwe (စစ်တွေ)
                  </option>
  
                  <option value="Swar">
                    Swar (ဆွာ)
                  </option>
  
                  <option value="Tabayin">
                    Tabayin (ဒီပဲယင်း)
                  </option>
  
                  <option value="Tachileik">
                    Tachileik (တာချီလိတ်)
                  </option>
  
                  <option value="Tamu">
                    Tamu (တမူး)
                  </option>
  
                  <option value="Tanintharyi">
                    Tanintharyi (တနင်္သာရီ)
                  </option>
  
                  <option value="Tatkon">
                    Tatkon (တပ်ကုန်း)
                  </option>
  
                  <option value="Taungdwingyi">
                    Taungdwingyi (တောင်တွင်းကြီး)
                  </option>
  
                  <option value="Taunggyi">
                    Taunggyi (တောင်ကြီး)
                  </option>
  
                  <option value="Taungoo">
                    Taungoo (တောင်ငူ)
                  </option>
  
                  <option value="Taungtha">
                    Taungtha (တောင်သာ)
                  </option>
  
                  <option value="Taw Kyel Inn">
                    Taw Kyel Inn (တောကျွဲအင်း)
                  </option>
  
                  <option value="Taze">
                    Taze (တန့်ဆည်)
                  </option>
  
                  <option value="Tha Bye Kon">
                    Tha Bye Kon (သပြေကုန်း)
                  </option>
  
                  <option value="Thabeikkyin">
                    Thabeikkyin (သပိတ်ကျဉ်း)
                  </option>
  
                  <option value="Thanbyuzayat">
                    Thanbyuzayat (သံဖြူဇရပ်)
                  </option>
  
                  <option value="Thandwe">
                    Thandwe (သံတွဲ)
                  </option>
  
                  <option value="Thaton">
                    Thaton (သထုံ)
                  </option>
  
                  <option value="Thazi">
                    Thazi (သာစည်)
                  </option>
  
                  <option value="Thegon">
                    Thegon (သဲကုန်း)
                  </option>
  
                  <option value="Thit Yar Kaut">
                    Thit Yar Kaut (သစ်ရာကောက်)
                  </option>
  
                  <option value="Tigyaing">
                    Tigyaing (ထီးချိုင့်)
                  </option>
  
                  <option value="Tilin">
                    Tilin (ထီးလင်း)
                  </option>
  
                  <option value="Toungup">
                    Toungup (တောင်ကုတ်)
                  </option>
  
                  <option value="Wathtikan">
                    Wathtikan (ဝက်ထီးကန်)
                  </option>
  
                  <option value="Waw">
                    Waw (ဝေါ)
                  </option>
  
                  <option value="Wetpoat">
                    Wetpoat (ဝက်ပုတ်)
                  </option>
  
                  <option value="Wundwin">
                    Wundwin (ဝမ်းတွင်း)
                  </option>
  
                  <option value="Yae Myet Ni">
                    Yae Myet Ni (ရေမျက်နီ)
                  </option>
  
                  <option value="Yae Nan Ma">
                    Yae Nan Ma (ရေနံမ)
                  </option>
  
                  <option value="Yae Ni">
                    Yae Ni (ရေနီ)
                  </option>
  
                  <option value="Yamethin">
                    Yamethin (ရမည်းသင်း)
                  </option>
  
                  <option value="Yanbye">
                    Yanbye (ရမ်းဗြဲ)
                  </option>
  
                  <option value="Yangon(Aung Mingalar)">
                    Yangon(Aung Mingalar) (ရန်ကုန်)
                  </option>
  
                  <option value="Ye">
                    Ye (ရေး)
                  </option>
  
                  <option value="YeU">
                    YeU (ရေဦး)
                  </option>
  
                  <option value="Yedashe">
                    Yedashe (ရေတာရှည်)
                  </option>
  
                  <option value="Yenangyaung">
                    Yenangyaung (ရေနံချောင်း)
                  </option>
  
                  <option value="Yesagyo">
                    Yesagyo (ရေစကြို)
                  </option>
  
                  <option value="Yin Mar Bin">
                    Yin Mar Bin (ယင်းမာပင်)
                  </option>
  
                  <option value="Ywar Mon">
                    Ywar Mon (ရွာမွန်)
                  </option>
  
                  <option value="Ywarthit">
                    Ywarthit (ရွာသစ်)
                  </option>
  
                  <option value="Zalun">
                    Zalun (ဇလွန်)
                  </option>
  
                  <option value="Zayat Kwin(Mandalay)">
                    Zayat Kwin(Mandalay) (ဇရပ်ကွင်း(မန္တလေး))
                  </option>
  
                  <option value="Zeyawaddy">
                    Zeyawaddy (ဇေယျဝတီ)
                  </option>
  
                  <option value="Zigon">
                    Zigon (ဇီးကုန်း)
                  </option>
  
                  <option value="Zin Chaung">
                    Zin Chaung (ဇင်ချောင်း)
                  </option>
  
                  <option value="Zin Kyaik">
                    Zin Kyaik (ဇင်းကျိုက်)
                  </option>
  
                </datalist>
          </div>

          <div class="portion">
              <div style="display:inline-flex;">
              <i class="fa-regular fa-calendar"></i>
                <p>Departing On</p>
                </div>
                <input type="text" list="from" name="date" id="ddate" required="required" class="int" placeholder="Dep: Date" value="<?php echo setValue("date"); ?>"
                style="font-family:Poppins, FontAwesome" onkeyup="noNum(this) , test(this)" onfocus="(this.type='date')"
                onblur="(this.type='text')">
          </div>
          <div class="portion">
              <div style="display:inline-flex;">
              <i class="fa-regular fa-clock"></i>
                <p>Departing Time</p>
                </div>
                <select id="time" name="time" required>
                
                <option value="Morning" <?= setSelected('time', "Morning") ?>>Morning</option> <!--5:00am - < 12:00 pm-->
                <option value="Afternoon" <?= setSelected('time', "Afternoon") ?>>Afternoon</option> <!--12:00 pm - < 6:00pm-->
                <option value="Night" <?= setSelected('time', "Night") ?>>Night</option>    <!--6:00pm - < 5:00am-->



</select>
          </div>

          <div class="portion">
            <div style="display:inline-flex;">
              <!--<i class="fa-solid fa-person-walking-luggage"></i> -->
              <i class="fa-solid fa-chair"></i>
              <p>Seats</p>
              </div>
            <input type="number" name = "passno" value="<?php echo setValue("passno"); ?>" placeholder="No of seats" class="int" style="font-family:Poppins, FontAwesome"  id="passenger" min="1" max="10" required="required"> 
          </div>

        </div>
        
      </div>

      <div class="src_btn" >
        <input type="submit" name="page1_next" id="sub_btn" class="search" value="&#xf054"  style="font-family:Poppins, FontAwesome">
      </div>

    </form>

   <!--for passenger-->
   
</div>



    
 


<div class="whole_lower">
    <div class="gray-container">
        <div class="part part1">
          
          <img src="images/bus/3.png">
          <div class="text">
          <h5>Search</h5>
          <p>Find & Select your trip</p>
          </div>
        </div>
        <div class="part part2">
        
          <img src="images/bus/2.png">
          <div class="text">
          <h5>Book</h5>
          <p>Enter your detail & pay</p>
          </div>
        </div>
        <div class="part part3">
          
          <img src="images/bus/1.png">
          <div class="text">
          <h5>Go</h5>
          <p>Show order summary & check in on the departure day</p>
          </div>
        </div>
    </div>
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
                    <a href="# " class="link_info"><p class="mb-0 fw-bold">Head Office</p></a>
                </div>
                <div class=" d-flex">
                    <div class="icon_2 "><i class="fa-solid fa-phone icon2" ></i></div>
                    <a href="tel+9599766270791" class="link_info"><p class="mb-0 fw-bold"> 09766270791</p></a>
                </div>
              </div>
          </div>
  
          <div class="col">
              <div class="d-flex flex-column mt-5">
                  <p class=" mb-1 fw-bold">Our Services</p>
                  <div class="service mt-2">
                    <a href="bus_page_1.php" class="link_info"><p class="mb-0">Bus Ticket</p></a>
                </div>
               
                <div class="service mt-2">
                     <a href="cargo_page_1.php" class="link_info">Cargo</p></a>
                </div>
              </div>
          </div>
  
          <div class="col">
              <div class="d-flex flex-column align-items-end mt-5" >
                <div class="s1 mt-0 mb-0">
                  <a href="About_us.php" class="link_info"><p class="mb-1 fw-bold text-start">About us</p></a>
              </div>
              <div class="s1 mt-0">
                  <a href="legal.php" class="link_info"><p class="mb-1 fw-bold text-start">Legal</p></a>
              </div>
              <div class="s1 mt-0">
                  <a href="tandc.php" class="link_info"><p class="mb-1 fw-bold text-end">Terms and Conditions</p></a>
              </div>
              <div class="s1 mt-0">
                  <a href="privacy.php" class="link_info"><p class="mb-1 fw-bold text-start">Privacy Policy</p></a>
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


<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    AOS.init();
</script>
<script>
var today = new Date(); // Get today's date
var tomorrow = new Date(today); // Create a new date object for tomorrow
tomorrow.setDate(today.getDate() + 1); // Set the date to tomorrow

var s = new Date(); // Get today's date again
var ed = new Date(s.setDate(s.getDate() + 5)); // Get the date 12 days from now

var myDate = document.getElementById('ddate'); // Get the departure date input field

// Set the minimum and maximum values for the departure date input field
myDate.min = tomorrow.toLocaleDateString('en-ca'); // Set the minimum date to tomorrow
myDate.max = ed.toLocaleDateString('en-ca'); // Set the maximum date to 12 days from now
   
  function noNum(input)
{   
   // var allow=/[^a-z]/gi;
      var allow = /[^a-z\s()]/gi;
    input.value=input.value.replace(allow,"");
}

function noLetter(input)
{
    var accept=/[^0-9]/gi;
    input.value=input.value.replace(accept, "");
}

function test(input)
{ 
   input.value=input.value.charAt(0).toUpperCase()+input.value.slice(1);
}
</script>
<script src="https://code.jquery.com/jquery-3.5.0.min.js"></script>

</body>
<?php 
if(isset($_POST["submit1"])){
  echo "<script>window.location = 'bus_page_2.php';</script>";
}
?>
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