<?php
session_start();
if (!isset($_SESSION["customer"])) {
    $_SESSION["path"]="bus_page_2.php";
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
  header("Location: bus_page_2.php");

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
  <link rel="icon" type="image/png" href="images/bc_logo.png" />
  <link rel="stylesheet" href="bus_page2.css">

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
    /*background-color:aquamarine;*/
    display:flex;
    flex-direction:column;
    justify-content:flex-start;
    margin-left:60px;
    margin-right:60px;
}

/* upper to from choose part */
.upper{
    width:auto;
    height:180px;
    padding-top:30px;
   
}

.top-box {
    background-color: #688dc4;
    padding: 5px;
    text-align: center; 
    width: 100%;
    margin-left:0px;
    display:flex;
    flex-direction: column;
    align-items: center;
}

.glass-container {
    /*background-color: rgba(53, 52, 52, 0.9); */
    background-color: #E7EEF4;
    padding: 20px;
    border-radius: 0px;
    text-align: center;
    width:inherit;
    box-sizing: border-box;
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    height:auto;
    padding:20px;
}

.glass-container p {
    font-size: 12px;
}

.glass-container h4 {
    font-weight: bold;
    margin-top:8px;
    margin-bottom: 5px;
    text-align: left;
    margin-left: 0px;
}

.form-container {
    margin-top: 10px;
    width:100%;
    padding:10px;
    margin-bottom: 10px;
}

.button {
    display: inline-block;
    padding: 10px 20px;
    margin: 20px 30px;
    text-decoration: none;
    color: black;
    background-color: #fff;
    border-radius: 5px;
    font-size: 16px;
    text-align: center;
}
#adate{
  display:none;
}
.icon {
    display: inline;
    margin-right: 5px;
}

.form-container .choose input {
    margin-bottom: 10px;
    padding: 10px;
    width: calc(20% - 20px);
    box-sizing: border-box;
}

.choose{
  display:flex;
  flex-direction:row;
  justify-content:space-between;
  flex-grow:1;
  
}
.int {
    padding: 20px;
    width:100px;
    height:45px;
    text-align:left;
}
.seat1{
    padding: 20px;
    width:80px;
    height:45px;
    text-align:left;
    
}
#sub_btn{
  background-color:#7895CB;
  width:100px;
  height:45px;
  text-align:left;
  font-weight:bold;
  border:none;
}
#sub_btn:active{
  transform: translateY(1px);
}
.choose {
    text-align: left;
    margin-top:20px;

}

.glass-container h4 {
    text-align: left;
}

.way {
    margin-bottom: 5px;
    text-align: left;
    display:flex;
    flex-direction:row;
    justify-content:flex-start;
    flex-grow:1;
}
.align_label{
  margin-left:20px;
}


@media (max-width: 800px){
  .glass-container{
    margin-top:50px;
  }
  .form-container {
    margin-top: 10px;
    padding:10px;
  }
  .form-container .choose input {
    margin-bottom: 10px;
    padding: 10px;
    width: 550px;
    box-sizing: none;
}
    .choose{
      display:flex;
      flex-direction:column;
      justify-content:center;
      flex-grow:1;
      padding:20px;
    }
    .int, .seat1 {
      padding: 20px;
      width:550px;
      height:45px;
      text-align:left;
  }
  #sub_btn{
    width:550px;
    height:45px;
    text-align:center;
    margin-right:0px;
  }
  .sub_btn:active {
    transform: translateY(3px);
  }
  .choose {
      text-align: left;
      margin-top:20px;
  
  }
}
@media (max-width: 750px){
    .form-container .choose input {
       width:450px;
    }
   .int, .seat1{
          width:450px;

    }
    #sub_btn{
        width:450px;
    }

}  
@media (max-width: 650px){
    .form-container .choose input {
       width:350px;
    }
   .int, .seat1{
          width:350px;

    }
    #sub_btn{
        width:350px;
    }

}  

@media (max-width: 550px){
    .form-container .choose input {
        
        width: 250px;
       
    }
.int, .seat1 {
    
    width:250px;
    
    
}
#sub_btn{
  width:200px;
 
  
}

}  

@media (max-width: 350px){
    .form-container .choose input {
       
       
        width: 100px;
    }
    .int, .seat1 {
       
        width:70px;
        height:45px;
        margin-bottom:10px;
        
    }
    #sub_btn{
     width:70px;
      height:45px;
     
    }
    
    }  


  .whole_lower{
    background-color: #E7EEF4;
    height:auto;
  }
     .gray-container {
        background-color: #E7EEF4;
        display: flex;
        margin-left:60px; 
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
.back_btn{
    margin-top:20px;
    width:200px;
    height:45px;
    background-color:#7895CB;
    border:none;
}

/*ticket show part*/
.lower
{
    display:flex;
    flex-direction:row;
    justify-content:flex-start;
    margin-top:30px;
}
.filter
{
    background-color:#E7EEF4;
    opacity:0.95;
    max-height:580px;
    max-width:850px;
    margin-bottom:20px;
   
}
.ticket_space{
    margin:30px;
}
.tic{
    background-color:#FFF;
}

.filt1{
    margin:30px;
    
}
.filt1 h4{
    margin-bottom:10px;
    padding:2px;
}

.time_part{
    color:black;
    font-size:15px;
    padding-top:30px;
    padding-bottom:50px;
    border-bottom:2px dashed black;
}

.checkbox-round {
    width: 1em;
    height: 1em;
    background-color: white;
    border-radius: 50%;
    vertical-align: middle;
    border: 1px solid #ddd;
    appearance: none;
    -webkit-appearance: none;
    outline: none;
    cursor: pointer;
}
.checkbox-round:checked {
    background-color: #7895CB;
}
.btn_res{
    display: flex;
    justify-content: center;
    align-items: center;
}
.reset_btn{
    align-items:center;
    background-color:#7895CB;
    width:100px;
    height:50px;
    margin-top:20px;
    border:none;
    margin-bottom:20px;
    
}
@media (max-width: 1000px) {
       .time_part label{
        font-size:13px;
        font-size:bold;
       
       }
       .filter{
        height:950px;
       }
}
@media (max-width: 800px) {
    .lower{
          flex-direction:column;
    }
    .filter{
        flex-direction:row;
        height:auto;
        font-size:15px;
    }
    .ticket_space{
        margin-top:750px;
        margin-left:0px;
        padding-left:0px;
        
    }
    
}
@media (max-width: 600px) {
    .lower{
          flex-direction:column;
    }
    .filter{
       max-width:400px;
    }
    
}
@media (max-width: 450px) {
    .lower{
          flex-direction:column;
    }
    .filter{
        max-width:300px;
    }
    
}




/*ticket*  #D9D9D9*/



.ticket_space{
    width:100%;
    display:flex;
    flex-direction:column;
    /*justify-content:space-between;*/
    
}

.show_ticket{
    background-color:#D8E5F2;
    max-width:100%;
    height:250px;
    padding:30px;
    border-radius:10px;
    
    margin:30px;

}
.ticket{
    display:flex;
    flex-direction:row;
    justify-content:space-between;
    flex-grow:1;
    max-width:inherit;
}
.pt1{
    /*background-color:blue;*/
    display:flex;
    flex-direction:column;
    justify-content:inherit;
    justify-content:flex-start;
    width:400px;

}
.pt1 p{
    font-size:12px;
    
}
.in1 p{
    flex-direction:row;
}
.p_new{
    margin-top:5px;
}
.pt2{
   margin-left:100px;

}
.pt2 img{
    width:120px;
    height:100px;
}
.pt3{
    margin-left:130px;
    display:flex;
    flex-direction:column;
    justify-content:inherit;
    justify-content:flex-start;
}
.icon{
    
    margin-right:20px;
    width:50px;
    height:50px;
}
.pt3 h4{
    color:red;
}
.butn{
   border:none;
   font-size:20px;
   font-weight:bold;
   background-color:#F18D65;
   padding:10px;
   width:140px;
   height:50px;
   color:black;
   align-items:center;
}
@media (max-width: 1000px) {

    .pt1{
        max-width:300px;
    
    }
    .pt1 h5{
        font-size:20px;
    }
    .icon{
        margin:10px;
        display:none;
    }
    .in1 h6{
        font-size:20px;
    }
    .pt1 p{
        font-size:15px;
        
    }
    .p_new{
        margin-top:3px;
    }
    .in1 p{
        flex-direction:row;
    }
    .pt2{
       margin-left:60px;
    
    }
    .pt2 img{
        max-width:80px;
        height:50px;
    }
    .pt3{
        margin-left:70px;
        
    }
    .icon{
        margin-left:20px;
        margin-right:20px;
        max-width:30px;
        height:30px;
    }
    .pt3 h4{
        color:red;
        font-size:18px;
    }
    .butn{
       
       font-size:15px;
       font-weight:bold;
       padding:10px;
       max-width:90px;
       height:40px;
       
    }
}

@media (max-width: 800px) {

    .pt1{
        max-width:200px;
    
    }
    .pt1 h5{
        font-size:10px;
    }
    .icon{
        margin:10px;
        display:none;
    }
    .in1 h6{
        font-size:10px;
    }
    .pt1 p{
        font-size:10px;
        
    }

    .p_new{
        margin-top:3px;
    }
    .in1 p{
        flex-direction:row;
    }
    .pt2{
       margin-left:60px;
    
    }
    .pt2 img{
        max-width:80px;
        height:50px;
    }
    .pt3{
        margin-left:70px;
        
    }
    .icon{
        margin-left:20px;
        margin-right:20px;
        max-width:30px;
        height:30px;
    }
    .pt3 h4{
        color:red;
        font-size:18px;
    }
    .butn{
       
       font-size:15px;
       font-weight:bold;
       padding:10px;
       max-width:90px;
       height:40px;
       
    }
}
@media (max-width: 700px){

    .pt2{
       margin-left:20px;
    
    }
    
    .pt3{
        margin-left:30px;
        
    }
    .butn{
        max-width:60px;
        height:25px;
        font-size:10px;
        text-align:center;
        padding:0px;
    }
}

@media (max-width: 600px){

    .pt2{
       margin-left:0px;
    
    }
    
    .pt3{
        margin-left:0px;
        
    }
    .butn{
        max-width:40px;
        height:18px;
        font-size:10px;
        text-align:center;
        padding:0px;
    }
}
.standard{
    color:grey;
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


    <div class="whole">

        <div class="upper">
           

                
                    <div class="top-box">
                    <h5>Book Bus Ticket</h5>
                    </div> 
              
                    <div class="glass-container">
                        <form>
                            <div class="form-container">
                        
                                <!--div class="way">
                                    <div>
                                        <label for="oneWay">One Way</label>
                                        <input type="radio" id="oneWay" name="tripType" checked="checked">
                                    </div>
                                    <div>
                                        <label for="roundTrip" class="align_label">Round Trip</label>
                                        <input type="radio" id="roundTrip" name="tripType">
                                    </div>
                                </div -->
                                
                                <div class="choose">
                                    <?php if( isset($_GET["bus"]) )
                                    {?>
                                        <p style="font-weight:bold;">From:</p> 
                                        <input type="text" name="from" class="int" style="font-family:Poppins, FontAwesome" value="<?php echo setValue("from"); ?>" readonly>

                                        </br>
                                        <p style="font-weight:bold;">To:</p> 
                                        <input type="text" name="to" class="int" style="font-family:Poppins, FontAwesome" value="<?php echo setValue("to"); ?>" readonly>

                                        </br>
                                        <p style="font-weight:bold;">Date:</p> 
                                        <input type="text" name="date" class="int" style="font-family:Poppins, FontAwesome" value="<?php echo setValue("date"); ?>" readonly>

                                        <p style="font-weight:bold;">Departing Time:</p> </br>
                                        <input type="text" name="time" class="int" style="font-family:Poppins, FontAwesome" value="<?php echo setValue("time"); ?>" readonly>

                                        </br>
                                        <p style="font-weight:bold;">Seat(s):</p> 
                                        <input type="text" name="passno" class="seat1"  style="font-family:Poppins, FontAwesome" value="<?php echo setValue("passno"); ?>" readonly>

                                        </br>
                                        <p> </p> 
                                        <a href='bus_page_1.php'> <input type="button" value="Re-search" id="sub_btn" style="font-family:Poppins, FontAwesome;"> </a>
                                    <?php } ?>


                                    <?php if( isset($_POST["page3_back"]) )
                                    { ?>
                                        <p style="font-weight:bold;">From:</p> 
                                        <input type="text" name="from" class="int" style="font-family:Poppins, FontAwesome" value="<?php echo setValue("from"); ?>" readonly>

                                        <p style="font-weight:bold;">To:</p> </br>
                                        <input type="text" name="to" class="int" style="font-family:Poppins, FontAwesome" value="<?php echo setValue("to"); ?>" readonly>

                                        <p style="font-weight:bold;">Date:</p> </br>
                                        <input type="text" name="date" class="int" style="font-family:Poppins, FontAwesome" value="<?php echo setValue("date"); ?>" readonly>

                                        <p style="font-weight:bold;">Departing Time:</p> </br>
                                        <input type="text" name="time" class="int" style="font-family:Poppins, FontAwesome" value="<?php echo setValue("time"); ?>" readonly>

                                        <p style="font-weight:bold;">Seat(s):</p> </br>
                                        <input type="text" name="passno" class="seat1" style="font-family:Poppins, FontAwesome" value="<?php echo setValue("passno"); ?>" readonly>

                                        <p> </p> </br>
                                        <a href='bus_page_1.php'> <input type="button"  id="sub_btn" value="Re-search" style="font-family:Poppins, FontAwesome;"> </a>
                                    <?php } ?>

                                </div>
                            </div>
                        </form>
                    </div>
                  
        </div>

        <div class="lower">
            <!--<div class="filter">
                <div class="filt1">
                    <div class="und">
                        <h4>Operators</h4>
                       
                    </div>
                    
                   <form method="post" name="" class="time_part">
                        <input type="checkbox" id="all" name="all" value="1" selected  class="checkbox-round"/>
                        <label for="All">All</label><br>
                        <input type="checkbox" id="elite" name="elite" value="2"  class="checkbox-round"/>
                        <label for="morning">Elite </label><br>
                        <input type="checkbox" id="jj" name="jj" value="3"  class="checkbox-round"/>
                        <label for="night">JJ </label><br>
                        <input type="checkbox" id="mm" name="mm" value="4"  class="checkbox-round"/>
                        <label for="night">Mandalar Min </label><br>
                        <input type="checkbox" id="sssk" name="sssk" value="5"  class="checkbox-round"/>
                        <label for="night">Shwe Sin Satkyar</label> <br>
                        <input type="checkbox" id="elite" name="elite" value="2"  class="checkbox-round"/>
                        <label for="morning">Elite </label><br>
                        <input type="checkbox" id="jj" name="jj" value="3"  class="checkbox-round"/>
                        <label for="night">JJ</label><br>
                        <input type="checkbox" id="mm" name="mm" value="4"  class="checkbox-round"/>
                        <label for="night">Mandalar Min</label><br>
                        <input type="checkbox" id="sssk" name="sssk" value="5"  class="checkbox-round"/>
                        <label for="night">Shwe Sin Satkyar </label>
                    </form>
                   
                      <form class="btn_res">
                          <button class="reset_btn">Reset filter</button>
                      </form>
                 
                </div>
                
            </div>-->
            
            <div class="ticket_space">
                <?php
            

                    include "showPlan.class.php";
                    if( isset($_GET["bus"]) )
                    {

                        $showPlan1 = new showPlan(array());
                        list($sourceid, $sourceaddress) = $showPlan1->getSourceid(setValue("from"));
                        list($destinationid, $destinationaddress) = $showPlan1->getDestinationid(setValue("to"));
                        $plans = $showPlan1->getPlans($sourceid, $destinationid, setValue("date"), setValue("time") );
                        $passno = setValue("passno");

                        $_SESSION["sourceaddress"] = $sourceaddress;
                        $_SESSION["destinationaddress"] = $destinationaddress;


                        if ( $plans )
                        {

                        foreach($plans as $plan)
                        {

                            $oname = $plan->getValueEncoded("oname");
                            $scity = setValue("from");
                            $ecity= setValue("to");
                            $date = $plan->getValueEncoded("ddate");
                            $time = $plan->getValueEncoded("dtime");
                            $duration = $plan->getValueEncoded("duration");
                            $price = $plan->getValueEncoded("cost");
                            $id = $plan->getValueEncoded("pid");
                            $busno = $plan->getValueEncoded("busno");
                            $ophoto = $plan->getValueEncoded("ophoto");

                            $timestamp = strtotime($date);
                            $formattedDate = date("j M Y", $timestamp);

                            $dateTime = DateTime::createFromFormat('H:i:s', $time);
                            $formattedTime = $dateTime->format('h:i A');
                            
        
                        
                            echo "<div class='show_ticket'>";
                            echo "   <div class='ticket'> ";
                            echo "      <div class='pt1'> ";
                            echo"<div><h5>$oname  <span class='standard'>(Standard)</span></h5></div>";
                            echo"<div class'in1'>";
                            echo"<div><h6>$scity
                                    <img src='images/icons/bus.png' class='icon'>
                                    $ecity</h6></div>";
                                echo"</div>";
                                echo"<div>";
                                    echo" <p>Departs : $formattedDate, $formattedTime</p>";
                                        
                                        echo"<p>Duration : $duration Hours</p>";
                                        echo"<p>Bus No : $busno</p>";
                                echo"</div>";
                                echo"</div>";
                                echo"<div class='pt2'>";
                                echo"<img src='./images/busLogo/$ophoto' alt='Operator Logo'>";                                
                                echo"</div>";
                                echo"<div class='pt3'>";
                                echo"<div>";
                                    echo"<h4>MMK $price</h4>";
                                    echo"<p style='margin-top:-8px'>1 seat * $price</p>";
                                    echo"</div>";
                                    echo"<div>";
                                    echo" <form method='post' action='bus_page_3.php'>";
                                    echo"   <input type='submit' class='butn' id='$id' value='Select' name='page2_next'>";
                                    echo"   <input type='hidden' value='$id' name='pid'>";
                                    echo"   <input type='hidden' value='$price' name='price'>";
                                    echo"   <input type='hidden' value='$passno' name='passno'>";
                                    echo"   <input type='hidden' value='$oname' name='oname'>";
                                    echo"   <input type='hidden' value='$date' name='ddate'>";
                                    echo"   <input type='hidden' value='$time' name='dtime'>";
                                    echo" </form>";
                                echo"</div>";
                                echo"</div>";
                            echo"</div>";
    
                        echo"</div>";
                        }
                    } else
                    {
                                echo "No travel Plan";
                    }
                        echo "<a href='bus_page_1.php'> <input type='button' class='back_btn' value='&lt;Back'> </a>";
                        //echo "<script> alert('{$_SESSION["from"]}'); </script>";

                    }

                    if( isset($_POST["page3_back"]) )
                    {
                    
                        $showPlan1 = new showPlan(array());
                        list($sourceid, $sourceaddress) = $showPlan1->getSourceid(setValue("from"));
                        list($destinationid, $destinationaddress) = $showPlan1->getDestinationid(setValue("to"));
                        $plans = $showPlan1->getPlans($sourceid, $destinationid, setValue("date"), setValue("time") );
                        $passno = setValue("passno");

                        $_SESSION["sourceaddress"] = $sourceaddress;
                        $_SESSION["destinationaddress"] = $destinationaddress;

                        $_SESSION["Texts"] = $_POST["Textss"];
                        $_SESSION["Totals"] = $_POST["Totalss"];

                        if ( $plans ) 
                        {

                        foreach($plans as $plan)
                        {

                            $oname = $plan->getValueEncoded("oname");
                            $scity = $_SESSION["from"];
                            $ecity= $_SESSION["to"];
                            $date = $plan->getValueEncoded("ddate");
                            $time = $plan->getValueEncoded("dtime");
                            $duration = $plan->getValueEncoded("duration");
                            $price = $plan->getValueEncoded("cost");
                            $id = $plan->getValueEncoded("pid");
                            $busno = $plan->getValueEncoded("busno");
                            $ophoto = $plan->getValueEncoded("ophoto");

                            $timestamp = strtotime($date);
                            $formattedDate = date("j M Y", $timestamp);

                            $dateTime = DateTime::createFromFormat('H:i:s', $time);
                            $formattedTime = $dateTime->format('h:i A');
                           
        
                            // $busLogo=$row["img_dir"];
                        
                            echo "<div class='show_ticket'>";
                            echo "   <div class='ticket'> ";
                            echo "      <div class='pt1'> ";
                            echo"<div><h5>$oname <span class='standard'>(Standard)</span></h5></div>";
                            echo"<div class'in1'>";
                            echo"<div><h6>$scity
                                    <img src='images/icons/bus.png' class='icon'>
                                    $ecity</h6></div>";
                                echo"</div>";
                                echo"<div>";
                                    echo" <p>Departs : $formattedDate, $formattedTime</p>";
                                        
                                        echo"<p>Duration : $duration Hours</p>";
                                        echo"<p>Bus No : $busno</p>";
                                echo"</div>";
                                echo"</div>";
                                echo"<div class='pt2'>";
                                echo"<img src='./images/busLogo/$ophoto' alt='Operator Logo'>";
                                echo"</div>";
                                echo"<div class='pt3'>";
                                echo"<div>";
                                    echo"<h4>MMK $price</h4>";
                                    echo"<p style='margin-top:-8px'>1 seat * $price</p>";
                                    echo"</div>";
                                    echo"<div>";
                                    echo" <form method='post' action='bus_page_3.php'>";
                                    echo"   <input type='submit' class='butn' id='$id' value='Select' name='page2_next'>";
                                    echo"   <input type='hidden' value='$id' name='pid'>";
                                    echo"   <input type='hidden' value='$price' name='price'>";
                                    echo"   <input type='hidden' value='$passno' name='passno'>";
                                    echo"   <input type='hidden' value='$oname' name='oname'>";
                                    echo"   <input type='hidden' value='$date' name='ddate'>";
                                    echo"   <input type='hidden' value='$time' name='dtime'>";
                                    
                                    echo" </form>";
                                echo"</div>";
                                echo"</div>";
                            echo"</div>";
    
                        echo"</div>";
                        }
                    } else
                    {
                                echo "No travel Plan";
                    }
                        echo "<a href='bus_page_1.php'> <input type='button' class='back_btn' value='&lt;Back'> </a>";
                        //echo "<script> alert('{$_SESSION["from"]}'); </script>";

                    }
                
                ?>
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

<?php 

?>
</html>



























   