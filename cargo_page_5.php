<?php
session_start();
if (!isset($_SESSION["customer"])) {
    $_SESSION["path"]="cargo_page_5.php";
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
  header("Location: cargo_page_5.php");

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

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="">
  <script src="sweetalert.min.js"></script>
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
.cargo{
    margin-top:40px;
    margin-bottom:30px;
    display: flex;
  text-align: center;
  align-items:center;
  justify-content: center;
}

.payment{
    width:400px;
    height:auto;
   
    
    align-items:center;
    justify-content:center;
    display:flex;
}
.pays{
    display:flex;
    flex-direction:column;
    
    justify-content:center;
    margin-top:30px;
    margin-bottom:10px;
    
}

.btn_two{
      margin-top:35px;
       display:flex;
      flex-direction:row;
      justify-content:space-between;
      margin-right:25px;
     
   
  }
/* .pay_row{
    display:flex;
    flex-direction:row;
    flex-grow:1;
    justify-content:space-between;
    margin-bottom:40px;
    
} */
.pay_row a, h6{
    text-decoration:none;
    
}
.pay1 {
    padding:10px;
    background-color:#E7EEF4;
    height: 60px;
    width: 150px;
    display:flex;
    flex-direction:row;
    flex-grow:1;
    justify-content:center;
    margin-bottom:20px;
    border-radius:8px;
    
}

.pay1 h6 {
        color: black; 
        margin-left:20px;
        text-decoration:none;     
}

.pay1 img {
        border-radius:5px;
        width: 35px;
        height: 35px;
        background-repeat: no-repeat;
        background-size: contain;
}



.glass-container {
  background-color: rgba(90, 89, 90, 0.8);
  padding: 20px;
  border-radius: 6px;
  text-align: center;
  width: 40%;
  height: 70%;
  max-width: 100%;
  box-sizing: border-box;
  display: flex;
  text-align: center;
  align-items:center;
  justify-content: center;
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

          .button{
            
            padding: 10px 20px;    
            background-color: #F18D65;
            font-weight: bold;
            margin:0;
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
      
    <div class="cargo">
    <div class="glass-container">
    <form action="cargo_page_5.php" method="post" class="booking-form">
        <div style="margin-bottom: 10px;">
        <h5>Choose Payment</h5>
        <div class="payment" >
                  
                  <div class="pays">
                      
                            <a href="paymentkbz_cargo.php" style="text-decoration:none;">
                                <div class="pay1">
                                 <img src="images/payment/kpay.jpg" />
                                 <h6>KBZ Pay</h6>
                                </div>
                            </a>
                            <a href="paymentwave_cargo.php" style="text-decoration:none;">
                                <div class="pay1">
                                  <img src="images/payment/wave-money.jpg" />
                                  <h6>Wave Pay</h6>
                                  </div>
                            </a>
                                
                        
                        
                     
                            <a href="cbpay.php" style="text-decoration:none;" onclick=" return cancelpay()">
                                <div class="pay1">
                                <img src="images/payment/cbpay.png" />
                                <h6>CB Pay</h6>
                                </div>
                            </a>
                            <a href="ayapay.php" style="text-decoration:none;" onclick="return cancelpay()">
                                <div class="pay1">
                                
                                <img src="images/payment/ayapay.png" />
                                <h6>AYA Pay</h6>
                            
                                </div> 
                            </a>
                      </div>

                      
                      
        
                  </div>
                  <div class="btn_two" style="display:flex; justify-content:center; margin:-10px; ">
                       
                       <input type="button" name="cargo5_back" id="cargo5_back "class="button" value="&lt;Back" onclick="goToAnotherPage()">
                     
                   </div>
                  
                  </div>

    
    
</div>
</div>
<script type="text/javascript" charset="utf-8">

    function cancelpay()
    {
        alert("Currently unavailable. Use K-pay or Wave-pay.");
        return false;
    }

    function goToAnotherPage()
    {
        window.location.href = "cargo_page_4.php";
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