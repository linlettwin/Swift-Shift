<?php
session_start();
if (!isset($_SESSION["customer"])) {
    $_SESSION["path"]="bus_page_4.php";
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
  header("Location: bus_page_4.php");

}


function setValue($fieldName)
{
    if (isset($_SESSION[$fieldName]))
    {
        return $_SESSION[$fieldName];
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
  <link rel="stylesheet" href="bus_page_4.css">

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

*{
    box-sizing: border-box;
    margin: 0;
    padding: 0;
 

}
body, html {
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
/*.progress-count:before{
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
}   */
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

.div_2_col{
   margin-top:50px;
   display :flex;
   justify-content:center;
   margin-left:60px;
   margin-right:60px;
   max-width:6500px;
   margin-bottom:50px;
}

.info_place{
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


.user_info{
    display:flex;
    flex-direction:column;
    justify-content:center;
    padding:30px;

}


@media (max-width: 850px){
    .div_2_col{
        flex-direction:column;
        justify-content:center;
        margin-left:10px;  /*need*/
        margin-right:0px; 
        margin-top:30px;
        
    }
    .info_place{
        max-width:500px;
        max-height:650px;
        background-color:#D8E5F2;
        margin-left:60px;
    }
    .pay_display{
        margin-top:30px;
        max-width:500px;
        height:auto;
        margin-left:60px;
    }
    
}

@media (max-width: 500px){
    .div_2_col{
        flex-direction:column;
        justify-content:center;  
        margin-left:0px;
        margin-right:0px; 
        margin-top:30px; 
    }
    .info_place{
        width:500px;
        height:650px;
        background-color:#D8E5F2;
    }
    .pay_display{
        margin-top:30px;
        width:500px;
        height:auto;
    }
    
}

/*user info*/
.user_info{
    display:flex;
    flex-direction:column;
    justify-content:center;
    margin:20px;
    padding:30px;
}

/*input form*/
.info form{
    border: 1px solid black;
    height: fit-content;
    /*border-radius: 20px;*/
    padding: 30px;
    width: 500px;
}
.info input{font-size:18px; padding-left:6px;}
textarea{font-size:18px; padding-left:6px; }
#check1, #check2 {
    width:17px; 
    height:17px;  
}
#check2{margin-left:20px;}
.rlabel{font-size:18px; }
.info .cap{
    padding-top:20px;
    font-size: 18px;
    font-weight:500px;
}
#name,
#phone,
#email,
#special {
    background-color:white;
    /*border-radius: 5px;*/
    height: 50px;
    margin-top: 5px;
    border:none;
    margin-right:40px;
    width:490px;
    padding-left:10px;

}

.btn_two{
    display:flex;
    flex-direction:row;
    justify-content:space-between;
    width:100%;
    padding-right:10px;
    
}
.button {
    cursor:pointer;
    text-align: center;
    border: 0; 
    background-color: #F18D65;
    /*border-radius: 5px; */
    height: 50px;
    width:200px;
  }


.button{
    text-decoration: none;
    color: black;
    font-weight:bold;
  }

.info span {font-size:20px;}
  /*require   */

#alert-name{font-size:15px; color:red;}

  #phone:invalid , #name:invalid, #email:invalid {   
    background-color:white;
    /*border-radius: 5px;*/
    height: 50px;
    margin-top: 5px;
    margin-right:40px;
    width:490px;
    outline: 2px solid pink;
    animation:shake 500ms;
  }
  #phone:valid , #name:valid, #email:valid {   
    background-color:white;
    /*border-radius: 5px;*/
    height: 50px;
    margin-top: 5px;
    margin-right:40px;
    width:490px;
    outline: 2px solid lightgreen;
  }
  @keyframes shake{
    25% {transform:translateX(4px);}
    50% {transform:translateX(-4px);}
    75% {transform:translateX(4px);}
  }


  @media (max-width: 850px){
    .info_form{
        max-width:500px;
        max-height:650px;
        
     }
    
     #name, 
     #phone, 
     #email, 
     #special {
    
     width:400px;
     height:50px;
    }
    .btn_two{
        padding-right:0px;
    }
    .button{
        width:100px;
        height:50px;
    }
    #phone:invalid , #name:invalid, #email:invalid {   
        background-color:white;
        border-radius: 5px;
        height: 50px;
        margin-top: 5px;
        margin-right:40px;
        width:400px;
        outline: 2px solid pink;
        animation:shake 500ms;
      }
      #phone:valid , #name:valid, #email:valid {   
        background-color:white;
        border-radius: 5px;
        height: 50px;
        margin-top: 5px;
        margin-right:40px;
        width:400px;
        outline: 2px solid lightgreen;
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


    <!--whole container for info and payment-->
    <div class="whole">
       
        <div class="progress-bar-place">
            <section class="step-wizard">
                    <ul class="step-wizard-list">
                        <li class="step-wizard-item current-item">
                            <span class="progress-count">1</span>
                            <span class="progress-label">Traveller Info</span>
                        </li>
                        <li class="step-wizard-item">
                            <span class="progress-count">2</span>
                            <span class="progress-label">Confirmation</span>
                        </li>
                        <li class="step-wizard-item">
                            <span class="progress-count">3</span>
                            <span class="progress-label">Payment</span>
                        </li>
                        <li class="step-wizard-item">
                            <span class="progress-count">4</span>
                            <span class="progress-label">Complete </span>
                        </li>
                    </ul>
            </section>
         </div> 
        <div class="div_2_col">
            
            <div class="info_place">

                <div class="title1">
                    <h5>Please Enter Information</h5>
                    <!--<?php $seat  ?>  -->
                </div>

                
             
                
                <div class="user_info">
                    <?php if( isset($_POST["page3_next"]) )
                    {
                        $_SESSION["Texts"] = $_POST["Texts"];
                        $_SESSION["Totals"] = $_POST["Totals"];
                        
                    ?>
                        
                        <form name="user-data">
                        <label for="name" class="cap">Traveller Name <span style="color:red;">*</span></label><br>
                        <input type="text" name="tname" id="name" value="<?php echo setValue("tname"); ?>"  maxlength="30" pattern="^(([A-Z][a-z]*)+\s*)*$" required="required">
                        <br><br>
        
                        <label for="phone" class="cap">Phone <span style="color:red;">*</span></label><br>
                        <input type="tel" name="tphone" id="phone" value="<?php echo setValue("tphone"); ?>" maxlength="12" placeholder="09456788942" onkeyup="noLetter(this)" maxlength="12" pattern="^09([0-9]{7}|[0-9]{8}|[0-9]{9})$" required><br><br>
                        
                        <label for="special" class="cap">Special Request</label><br>
                        <textarea name="special" id="special" maxlength="100"><?php echo setValue("special"); ?></textarea> <br><br>

                        </form>
                        
                   <?php } ?>

                   <?php if( isset($_POST["page5_back"]) )
                    {
                        
                    ?>
                        
                        <form name="user-data">
                        <label for="name" class="cap">Traveller Name <span style="color:red;">*</span></label><br>
                        <input type="text" name="tname" id="name" value="<?php echo setValue("tname"); ?>"  maxlength="30" pattern="^(([A-Z][a-z]*)+\s*)*$" required="required">
                        <br><br>
        
                        <label for="phone" class="cap">Phone <span style="color:red;">*</span></label><br>
                        <input type="tel" name="tphone" id="phone" value="<?php echo setValue("tphone"); ?>" maxlength="12" placeholder="09456788942" onkeyup="noLetter(this)" maxlength="12" pattern="^09([0-9]{7}|[0-9]{8}|[0-9]{9})$" required><br><br>
                        
                        <label for="special" class="cap">Special Request</label><br>
                        <textarea name="special" id="special" maxlength="100"><?php echo setValue("special"); ?></textarea> <br><br>

                        </form>
                        
                   <?php } ?>
                    
                   <div class="btn_two">
                   <form action="bus_page_3.php" method="post">
                            <input type="submit" name="page4_back" class="button" value="&lt;Back" onclick="carryback4()">
                            <input type="hidden" name="tbname" id="tbname">
                            <input type="hidden" name="tbphone" id="tbphone">
                            <input type="hidden" name="tbspecial" id="tbspecial">               
                    </form>

                    <form action="bus_page_5.php" method="post">
                            <input type="submit" name="page4_next" class="button" value="Next&gt;" onclick="return carrynext4()" style="margin-right:0px">
                            <input type="hidden" name="tnname" id="tnname">
                            <input type="hidden" name="tnphone" id="tnphone">
                            <input type="hidden" name="tnspecial" id="tnspecial">
                    </form>
                    </div>
                </div>

            </div>
            
          
            
        </div>
    </div>

<!--
    <div class="footerb">
        <div class="container text-center custom-bg-gray text-white ">
          <div class="row align-items-center">
              <div class="col ">
                  <div class="d-flex flex-column align-items-start mt-4">
                      <img src='images/logo1.png' height="70px" width="100px" alt="Logo">
                      <div class="d-flex align-items-center">
                        <div class="icon me-2"><i class="fa-solid fa-location-dot"></i></div>
                        <a href=" " class="link_info"><p class="mb-0 fw-bold">Head Office</p></a>
                    </div>
                    <div class="d-flex align-items-center">
                        <div class="icon me-2"><i class="fa-solid fa-phone"></i></div>
                        <a href=" " class="link_info"><p class="mb-0 fw-bold"> 09766270791</p></a>
                    </div>
                  </div>
              </div>
      
              <div class="col">
                  <div class="d-flex flex-column align-items-center mt-4">
                      <p class=" mb-1 fw-bold">Our Services</p>
                      <div class="service mt-0">
                        <a href="#" class="link_info"><p class="mb-0">Buses</p></a>
                    </div>
                    <div class="service mt-0">
                        <a href="#" class="link_info"><p class="mb-0 text-left">Airlines</p></a>
                    </div>
                    <div class="service mt-0">
                        <a href="#" class="link_info"><p class="mb-0 text-left">Cruise</p></a>
                    </div>
                    <div class="service mt-0">
                         <a href="#" class="link_info">Cargo</p></a>
                    </div>
                  </div>
              </div>
      
              <div class="col">
                  <div class="d-flex flex-column align-items-end mt-4" >
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
      
          
          <div class="row mt-3">
              <div class="col border-bottom">
                  
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
    </div>  -->
</body>
<script type="text/javascript">
      
    function noNum(input)
    {   
        var allow=/[^a-z]/gi;
        input.value=input.value.replace(allow,"");
    }
    
    function noLetter(input)
    {
        var accept=/[^0-9]/gi;
        input.value=input.value.replace(accept, "");
    }


    
</script>
<script>
const one = document.querySelector(".one");
const two = document.querySelector(".two");
const three = document.querySelector(".three");
const four = document.querySelector(".four");
const five = document.querySelector(".five");

one.onclick = function() {
    one.classList.add("active");
    two.classList.remove("active");
    three.classList.remove("active");
    four.classList.remove("active");
    five.classList.remove("active");
}

two.onclick = function() {
    one.classList.add("active");
    two.classList.add("active");
    three.classList.remove("active");
    four.classList.remove("active");
    five.classList.remove("active");
}
three.onclick = function() {
    one.classList.add("active");
    two.classList.add("active");
    three.classList.add("active");
    four.classList.remove("active");
    five.classList.remove("active");
}
four.onclick = function() {
    one.classList.add("active");
    two.classList.add("active");
    three.classList.add("active");
    four.classList.add("active");
    five.classList.remove("active");
}
five.onclick = function() {
    one.classList.add("active");
    two.classList.add("active");
    three.classList.add("active");
    four.classList.add("active");
    five.classList.add("active");
}

function carryback4()
{
     document.getElementById("tbname").value = document.getElementById("name").value;
     document.getElementById("tbphone").value = document.getElementById("phone").value;
     document.getElementById("tbspecial").value = document.getElementById("special").value;
}
function carrynext4()
{
    
    if( document.getElementById("name").value == "" )
    {
        alert("Name is required. Please enter your name.");
        return false;
    }
    if( document.getElementById("phone").value == "" )
    {
        alert("Phone number is required. Please enter your phone number.");
        return false;
    }

    var namepattern = /^(([A-Z][a-z]*)+\s*)*$/;
    if( !namepattern.test(document.getElementById("name").value) )
    {
        alert("Enter valid name. Your name must start with capital letter.");
        return false;
    }

    var phonepattern = /^09([0-9]{7}|[0-9]{8}|[0-9]{9})$/;
    if( !phonepattern.test(document.getElementById("phone").value) )
    {
        alert("Enter valid phone number.");
        return false;
    }

    document.getElementById("tnname").value = document.getElementById("name").value;
    document.getElementById("tnphone").value = document.getElementById("phone").value;
    document.getElementById("tnspecial").value = document.getElementById("special").value;


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