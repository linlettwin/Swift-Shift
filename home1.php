<?php
session_start();
$_SESSION['path']="home.php";

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

if (isset($_SESSION["customer"])) {
   
//Access the admin object stored in the session variable
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

$sql = "SELECT count(*) as count FROM get_cargo_service WHERE ((status = 'approved' AND seen='No') OR (status='disapproved' AND seen='No')) AND cid = :customer;";

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
}

if (isset($_FILES["image"]["name"])) {
  $file_name = $_FILES['image']['name'];
  $tempname = $_FILES['image']['tmp_name'];
  $folder = 'images/user/' . $file_name;

  
  $stmt = $conn->prepare("UPDATE customer SET photo=? Where cid=$cid");
  $stmt->execute([$file_name]);
  move_uploaded_file($tempname,$folder);
  header("Location: home.php");

}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="home.css">
  <link rel="icon" type="image/png" href="images/bc_logo.png" />
  <title>Swift Shift</title>
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

  <!--for video-->
 
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Travel And Cargo</title>

    <!--google fonts -->
  
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
     

      body,html {
    background-color:#E7EEF4;
    font-family: "Poppins", sans-serif;
    --color1: #FFF ;
    --color2:  #688dc4;
   

}
.text-with-lines:before,
.text-with-lines:after {
    content: "";
    position: absolute;
    width: 200%;
    height: 2px;
    background-color: black;
    top: 50%;
    transform: translateY(-50%);
}
@media (max-width: 900px) {
    
    .text-with-lines:before,
    .text-with-lines:after {
    content: "";
    position: absolute;
    width: 60%;
    height: 2px;
    background-color: black;
    top: 50%;
    transform: translateY(-50%);
}
    .text-with-lines:before {
        right: 100%; 
        margin-right: 10px; 
    }
    
    .text-with-lines:after {
        left: 100%; 
        margin-left: 10px; /* Adjust for spacing */
    }
}
@media (max-width: 580px) {
    
    .text-with-lines:before,
    .text-with-lines:after {
    content: "";
    position: absolute;
    width: 50%;
    height: 2px;
    background-color: black;
    top: 50%;
    transform: translateY(-50%);
}
    .text-with-lines:before {
        right: 80%; 
        margin-right: 10px; 
    }
    
    .text-with-lines:after {
        left: 80%; 
        margin-left: 10px; /* Adjust for spacing */
    }
    .flex-container {
      
      margin-left:-30px;
    }
}


            .ftime{
              font-size:10px;
              color:grey;
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
              
                <li><a href="homepage.php">Home</a></li>
                <li><a href="bus_page_1.php">Bus Ticket</a>
                  
                </li>
                <li><a href="cargo_page_1.php">Cargo</a>
                  
                </li>
                <li><a href="#cont_us">Contact Us</a></li>
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

  <!--Intro video-->
  <div id="video_box">
    <div class="content">
      <h1 style="font-size:3vw;" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="100">Explore & Ship with Ease</h1>
      <p style="font-size:2vw;" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">Embark on seamless journeys and hassle-free cargo shipments with Swift Shift. </p>
      <div class="buttons">
      <a href="About_us.php"><button class="aboutUs" style="font-size:1.5vw;" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="300">
        <!-- <img src="icons/group.png" class="group" width="15" height="15"> -->
        About Us
      </button></a>
      </div>
   </div>
    <div class="video-container">
    <video id="video1" autoplay muted loop>
      
      <source src="videos/intro.mp4" type="video/mp4">
      <source src="movie.ogg" type="video/ogg">
    </video>
    </div>
  </div>



  <div class="blue-section" id="blue_section">
        <h4 style="font-weight: bold;">Our Services</h4>
        <div class="text-with-lines">
            <p>Travel and Cargo with please</p>
        </div>

        <div class="photo" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="100">
            <form class="flex-container">
                <button class="img-button" formaction="#blue_section">
                  <div class="photo1">
                    <div class="image_overlay">
                        <i class="fa-solid fa-bus"></i>
                      <h3>Bus Transportation</h3>
                    <p>Worldwide dense network and routings to all international core markets. Profit from sustained quality and efficient connections across the globe.</p>
                    </div>
                    <h3 class="no"><i class="fa-solid fa-bus"></i><br>
                        Bus Transportation
                    </h3>
                  </div>
                </button>          
    
              <button class="img-button" formaction="#blue_section">
                <div class="photo2">
                  <div class="image_overlay">
                    <i class="fa-solid fa-truck-moving"></i>
                    <h3>Road Freight</h3>
                    <p>For every shipment we have the right vehicle – based on your needs according to time, size, weight and insurance.</p>
                  </div>
                  <h3 class="no"><i class="fa-solid fa-truck-moving"></i><br>
                    Road Freight
                 </h3>
                </div>  
              </button>
      
            </form>
        </div>
    </div>
  <!--Travel-->
   <!--Travel-->
   <div class="travel">
    <div class="glass-container" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="100">
        <h4>"Discover the World,Your Journey Awaits" </h4>
        <p>Initiate your bus and cargo reservation now</p>

        <div class="button-container">
            <a href="bus_page_1.php" class="button">
              <div class="icon"><i class="fa-solid fa-bus"></i>
                </div> Bus Ticket</a>
            <a href="cargo_page_1.php" class="button"><div class="icon"><i class="fa-solid fa-truck"></i></div> Cargo Reservation</a>
            <!-- <a href="#" class="button"><div class="icon"><i class="fa-solid fa-ship"></i></div> Cruise Ticket</a> -->
        </div>
    </div>
  </div>
  <!--Review-->
  <?php

include 'connect.php';


$query = "SELECT c.name, f.feedback, c.photo, f.ftime FROM customer c INNER JOIN feedback f ON c.cid = f.cid ORDER BY f.ftime DESC";
$result = mysqli_query($dbconnection, $query);


if(mysqli_num_rows($result) > 0) {
   
    echo '<div class="review">';
    echo '  <section class="testimonials">';
    echo '    <div class="container1">';
    echo '      <div class="section-header">';
    echo '        <h4 class="title" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="100">What Our Customers Say</h4>';
    echo '      </div>';
    echo '      <div class="testimonials-content">';
    echo '        <div class="swiper testimonials-slider js-testimonials-slider">';
    echo '          <div class="swiper-wrapper">';
    
    
    while($row = mysqli_fetch_assoc($result)) {
        
        echo '            <div class="swiper-slide testimonials-item">';
        echo '              <div class="info">';
        
        echo '                <img src="./images/user/'.$row['photo'].'" alt="img">';
        echo '                <div class="text-box">';
        echo '                  <h5 class="name">'.$row['name'].'</h5>';
        echo '                  <span class="ftime">'.$row['ftime'].'</span>';
        echo '                </div>';
        echo '              </div>';
        echo '              <p>"'.$row['feedback'].'"</p>';
        echo '            </div>';
    }
    

    echo '          </div>';
    echo '        </div>';
    echo '        <div class="swiper-pagination js-testimonials-pagination"></div>';
    echo '      </div>';
    echo '    </div>';
    echo '  </section>';
    echo '</div>';
} else {
 
    echo 'No testimonials found.';
}


mysqli_close($dbconnection);
?>


    <!--Partners-->
    <div class="part6">

      <div class="banks">
        <h3 id="bank-caption">Payment Partners</h3>
        <div class="bank-pic" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="100">
          <img src="images/payment/kbzpay.jpg" class="bord">
          <img src="images/payment/wave-money.jpg" class="bord">
          <img src="images/payment/cbpay.png" class="bord">
          <img src="images/payment/ayapay.png" class="bord">
        </div>

        <!--<div class="bank-pic1" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
          <img src="images/payment/yoma.jpg" class="bord">
          <img src="images/payment/agd.jpg" class="bord">
          <img src="images/payment/mpt_pay.png" class="bord">
          <img src="images/payment/uab_pay.jpg" class="bord">
        </div>  -->
      </div>

      <div class="car_partners">
      <div class="carlogo">
        <h3>Our Operators</h3>
      </div>
      <div class="second_line" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="100">
        <img src="images/bus/elite.png">
        <img src="images/bus/SSS.png">
        <img src="images/bus/jj.png">
        <img src="images/busLogo/STY.png" />
      </div>
      <div class="second_line" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
        <img src="images/busLogo/kmdy.png">
        <img src="images/busLogo/SMDL.png">
        <img src="images/busLogo/MMDT.png">
        <img src="images/busLogo/mandalarmin.png">
      </div> 
      </div>
    </div>


    <!--Contact Us-->
    
    <div class="contUs" id="cont_us" data-aos="fade-right" data-aos-duration="1000" data-aos-delay="100">
      <div class="pt1">
       <div class="getInTouch">
         <h3>Get In Touch!</h3>
         <hr id="line1">
         <div class="form1">
          <p style="font-weight:bold; color:white;">Send Email....</p>
         <form class="contact_info" action="mailto:swiftshift@gmail.com" method="post" enctype="text/plain" role="form" id="form">           
           <input  type="Submit" name="Email" value="&#xf0e0       Email" id="subt" style="font-family:Poppins, FontAwesome" onkeyup="noNum(this) , test(this)" required><br><br><br>
         </form>
         <p style="font-weight:bold; color:white;">Call Our Office....</p>
         <a href="tel:+959766270791">           
           <input type="Submit" name="Email" value="&#xf095        Call" id="subt" style="font-family:Poppins, FontAwesome" onkeyup="noNum(this) , test(this)" required><br><br><br>
          </a>
         </div>
       </div>
      </div>
      <div class="pt2">
          <div class="map_info">

            
              <div class="map_flex_info">
                  <h5>Head Office</h5>
                  <p style="font-weight:bold">Address</p>
                  <p>121 Thazain Street, 21 Avenue, Yangon.</p>
                  <p style="font-weight:bold">Call us</p>
                  <p>09-557849838<br>
                     09-798884886</p>
                 <p style="font-weight:bold">Opening Hours</p>
                 <p>Monday-Friday - 9am - 7pm
                    Saturday,Sunday - Closed</p>  
                    
             </div>
             <div id="pic">
              <div class="mapouter"><div class="gmap_canvas"><iframe src="https://maps.google.com/maps?q=university%20of%20information%20technology&amp;t=&amp;z=13&amp;ie=UTF8&amp;iwloc=&amp;output=embed" frameborder="0" scrolling="no" style="width: 280px; height: 350px;"></iframe><style>.mapouter{position:relative; height:350px; width:280px;background:#fff;} .maprouter a{color:#fff !important;position:absolute !important;top:0 !important;z-index:0 !important;}</style><a href="https://blooketjoin.org/blooket-host/">blooket host</a><style>.gmap_canvas{overflow:hidden;height:350px;width:280px}.gmap_canvas iframe{position:relative;z-index:2}</style></div></div>
             </div>
             
            
          </div>
      </div>
  </div>
    <div class="office_bt">
      <a href="office.php"><button class="otherOffice" formaction="office.php" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="100">Branch Offices</button> </a>
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
                    <a href="#" class="link_info"><p class="mb-0 fw-bold">Head Office</p></a>
                </div>
                <div class=" d-flex">
                    <div class="icon_2 "><i class="fa-solid fa-phone icon2" ></i></div>
                    <a href="tel:+959766270791" class="link_info"><p class="mb-0 fw-bold"> 09766270791 </p></a>
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
                  <a href="about_us.php" class="link_info"><p class="mb-1 fw-bold text-start">About us</p></a>
              </div>
              <div class="s1 mt-0">
                  <a href="legal.php" class="link_info"><p class="mb-1 fw-bold text-start">Legal</p></a>
              </div>
              <div class="s1 mt-0">
                  <a href="tandc.php" class="link_info"><p class="mb-1 fw-bold text-end">Terms and Conditions</p></a>
              </div>
              <div class="s1 mt-0">
                  <a href="policy.php" class="link_info"><p class="mb-1 fw-bold text-start">Privacy Policy</p></a>
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


    



  
  
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
  <script>
    const swiper = new Swiper('.js-testimonials-slider', {
      grabCursor:true,
      spaceBetween:30,
      pagination:{
        el:  '.js-testimonials-pagination',
        clickable:true
      },
      breakpoints:{
        767:{
          slidesPerView:2
        }
      }
    });
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
  <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
  <script>
    AOS.init();
  </script>

</body>

</html>