<?php 
  session_start();

  if (isset($_SESSION["path"])) {
    $path=$_SESSION["path"];
    if($path == 'bus_page_2.php' || $path == 'cargo_page_2.php')
    {
        echo "<script>alert('You have to Login or Sing up first!!');</script>"; 
    }
}
else{
    $path='home.php';
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="login1.css">
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="icon" type="image/png" href="images/bc_logo.png" />
  <title> Swift Shift Login & SignUp Page</title>
  <style>
    *{
    margin: 0;
    padding: 0;
}
body{
    min-height: 100vh;
    background-color: #E7EEF4;
    font-family: "Poppins", sans-serif;
    --color1: white ;
    --color2:  #688dc4;
}
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
    margin-right:0px;
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
    width:80px;
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

/*login part */
.body{
    min-height: 100vh;
    background-color: #E7EEF4;
    display: flex;
    justify-content: center;
    align-items: center;
}

.container{
  margin-top:-55px;
    width: 50vh;
    height: 73vh;
    border-radius: 3vh;
    background-color: #D8E5F2;
    box-shadow: 10px 10px 20px rgba(0, 0, 0, 0.2), -10px -10px 20px rgba(255,255,250,0.8);
}
.top{
    text-align: center;
    margin-bottom: 10vh;
}
.image{
    width: 10vh;
    height: 10vh;
    position: relative;
    left: 20vh;
    top: 3vh;
}
.image img{
    width: 100%;
    height: 100%;
    border-radius: 50%;
}

.top span{
    position: relative;
    top: 2vh;
    font-weight: bold;
    font-size: 3vh;
    letter-spacing: 0.2vh;
}

.inputBox{
    border-radius: 2vh;
    display: flex;
    justify-content: space-around;
    align-items: center;
    margin-left: 4.5vh;
    width: 40vh;
    height: 6vh;
    /* margin-bottom: 4vh; */
    /*background-color:white;
    /*box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.1), -5px -5px 10px rgba(255,255,250,0.6); */
}

/*.inputBox:focus-within{
    
    box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.1),-5px -5px 10px rgba(255,255,250,0.5),
    5px 5px 10px rgba(0, 0, 0, 0.1),-5px -5px 10px rgba(255,255,250,0.5);
    outline: 0.42vh solid rgba(255,255,250,0.39); 
}  */
label{
    background-color:white;
}
.input{
    height: 4vh;
    width: 30vh;
    margin-left: -2vh;
    border: none;
    outline: none;
    background-color: white;
}
.forget{
    
    margin-top:-70px;
    background-color:#D8E5F2;
    font-size:12px;
    font-weight:bold;
    color:#F18D65;
    
}
.forget1{
  margin-top:-10px;
  background-color:#D8E5F2;
  font-size:12px;
  font-weight:bold;
  color:#F18D65;
  
}
#forget_bt{
    border:none;
    color:#F18D65;
    font-weight:bold;
    font-size:2vh;
    background-color:#D8E5F2;

}
.submit{
    margin-top: 2vh;
    height: 6vh;
    width: 20vh;
    border: none;
    background-color:#7895CB;
    border-radius: 2vh;
    cursor: pointer;
    /*box-shadow: 4px 4px 5px rgba(0, 0, 0, 0.3),-4px -4px 5px rgba(255,255,250,0.7);*/
    font-weight: bold;
}
.submit:hover{
    /*outline: 0.5vh groove rgba(255,255,250,0.5);*/
    border-color:#7895CB;
    border: 3px solid;
    background-color:white;
    color:#7895CB;
}
form{
    text-align: center;

}
.user{
    margin-top: 3vh;
}
.user span{
    margin-left: 1vh;
    font-size: 3vh;
    font-weight: bold;
    color: #1F2B81;
    cursor: pointer;
}

.inputBoxBack{
    height: 5vh;
    margin-bottom: 2vh;
    margin-top: 1vh;

}
.imageBack{
    width: 8vh;
    height: 8vh;
    left: 21.3vh;
}
.topBack{
    margin-bottom: 4vh;
}
.submitBack{
    margin-top: 2vh;
    height: 6vh;
    width: 20vh;
    font-size: 1.8vh;
}
.containerFront{
    position: absolute;
    z-index: 2;
    transition: 2s ease-in-out;
}
.containerBack{
    position: absolute;
    z-index: 1;
    transform: rotateY(180deg);
    transition: 2s ease-in-out;
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

  <div class="body">
    
    <div class="container containerFront" id="traditionalFront">
        <div class="top">
          <div class="image">
          <img src="images/logo1.png" alt="logo.png">
          </div>
          <span>Log In</span>
        </div>
      
    
      <div class="form">
        <form action="SignUp.php" method="post" id="form" >
        
          <div class="inputBox inputBoxFront">
            <label><i class="fa-solid fa-envelope"></i></label>
            <input type="text" placeholder="Email" class="input" name="email" id="email" value="<?php setValue("email") ?>" required="required" onkeydown="validate()" onblur="not_show_e()" >
          </div>
          <div> <span class="forget" id="emailValidity"></span></div>
    
            <div class="inputBox inputBoxFront">
              <label><i class="fa-solid fa-lock"></i></label>
              <input type="password" placeholder="Password" class="input" name="Password" id="password" value="<?php setValue("Password") ?>" required="required" onkeydown="validate1()" onblur="not_show_pass()" title="Password must contain at least 1 lowercase and 1 uppercase letter, 1 numeric digit, and be above 6 characters long." pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,20}$">
               <!--<span class="password-toggle-icon"><i class="fas fa-eye"></i></span>-->
            </div>
            <div><span class="forget" id="passwordValidity"></span></div>
          <input type="submit" name="login" value="Login" class="submit">
          <div class="user">New User?
            <span class="newUser" onclick="rotate1()">Sign Up</span>
          </div>
        </form>
      </div>
    </div>

    <div class="container containerBack" id="traditionalBack">
      <div class="top topBack">
          <div class="image">
          <img src="images/logo1.png" alt="logo.png">
          </div>
          <span>Sign Up</span>
        </div>
      
    
      <div class="form formBack" id="show_sign_up" >
        <form action="SignUp.php" method="post" id="form1" >
          <div class="inputBox inputBoxBack">
            <label><i class="fa-solid fa-user"></i></label>
            <input type="text" placeholder="Username" class="input" name="name" id="name" value="<?php setValue1("name") ?>" required="required" onkeydown="validate3()" onblur="not_show_name()">
          </div>
          <div><span class="forget" id="nameValidity"></span></div>
          <div class="inputBox inputBoxBack">
            <label><i class="fa-solid fa-envelope"></i></i></label>
            <input type="text" placeholder="Email" class="input" name="Email" id="email1" value="<?php setValue1("Email") ?>" required="required" onkeydown="validate4()" onblur="not_show_email_1()">
          </div>
          <div><span class="forget" id="emailValidity1"></span></div>
          <div class="inputBox inputBoxBack">
            <label><i class="fa-solid fa-lock"></i></label>
            <input type="password" placeholder="Password" class="input" name="PPassword" id="password1" value="<?php setValue1("PPassword") ?>" required="required" onkeydown="validate5()" onblur="not_show_pass_2()" title="Password must contain at least 1 lowercase and 1 uppercase letter, 1 numeric digit, and be above 6 characters long." pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,20}$">
             <!--<span class="password-toggle-icon"><i class="fas fa-eye"></i></span>-->
          </div>
          <div><span class="forget" id="passwordValidity1"></span></div>
          <div class="inputBox inputBoxBack">
            <label><i class="fa-solid fa-lock"></i></label>
            <input type="password" placeholder="Confirm Password" class="input" name="ConfirmPassword" id="ConfirmPassword" value="<?php setValue1("ConfirmPassword") ?>" required="required" onkeydown="validate2()" onblur="not_show_pass_1()" pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,20}$">
            <!--<span class="password-toggle-icon"><i class="fas fa-eye"></i></span>-->
          </div>
          <div><span class="forget" id="passwordValidity2"></span></div>
          <button class="submit submitBack" value="Sign Up" name="SignUp">Sign Up</button>
          <div class="user userBack">Existing User?
            <span class="existingUser" onclick="rotate2()">Log In</span>
          </div>
        </form>
      </div>
    </div>
  </div>
  
<script>

</script>
<script>
function rotate1()
{
    document.getElementById("traditionalFront").style.zIndex = "1";
    document.getElementById("traditionalBack").style.zIndex = "2";
    document.getElementById("traditionalFront").style.transform = "rotateY(180deg)";
    document.getElementById("traditionalBack").style.transform = "rotateY(0deg)";

}

function rotate2()
{
    document.getElementById("traditionalBack").style.zIndex = "1";
    document.getElementById("traditionalFront").style.zIndex = "2";
    document.getElementById("traditionalBack").style.transform = "rotateY(180deg)";
    document.getElementById("traditionalFront").style.transform = "rotateY(0deg)";
}


function validate() {
    var form = document.getElementById("form");
    var email = document.getElementById('email').value;
    var emailValidity = document.getElementById('emailValidity');
   
    var pattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;


    if (email.match(pattern)) {
        form.classList.add("valid")
    form.classList.remove("invalid");
    emailValidity.innerHTML= "Your Email Address is Valid.";
    emailValidity.style.color = "#1C1AE7";
    } else {
    form.classList.remove("valid")
    form.classList.add("invalid");
    emailValidity.innerHTML = "Invalid Email.";
    emailValidity.style.color="#ff0000";
    }
    if (email== " ")
  {
    form.classList.remove("valid")
    form.classList.remove("invalid");
    emailValidity.innerHTML= "       ";
    emailValidity.style.color = "#00ff00";
  }
  }
  function not_show_e(){
    form.classList.remove("valid")
    form.classList.remove("invalid");
    emailValidity.innerHTML= "       ";
    emailValidity.style.color = "#00ff00";
  }
  
  function validate1() {
    var form = document.getElementById("form");
    var password = document.getElementById('password').value;
    var passwordValidity = document.getElementById('passwordValidity');
    var passwordPattern = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,20}$/;
    if (password.match(passwordPattern)) {
        form.classList.add("valid");
        form.classList.remove("invalid");
        passwordValidity.innerHTML = "Valid Password.";
        passwordValidity.style.color = "#1C1AE7";
    } else {
        form.classList.remove("valid");
        form.classList.add("invalid");
        passwordValidity.innerHTML = "Invalid Password.";
        passwordValidity.style.color = "#ff0000";
    }
    if (password== " ")
  {
    form.classList.remove("valid")
    form.classList.remove("invalid");
    passwordValidity.innerHTML= "  ";
    passwordValidity.style.color = "#00ff00";
  }
  }
  function not_show_pass(){
    form.classList.remove("valid")
    form.classList.remove("invalid");
    passwordValidity.innerHTML= "  ";
    passwordValidity.style.color = "#00ff00";
  }


  function validate2() {
    var form1 = document.getElementById("form1");
    var password = document.getElementById('ConfirmPassword').value;
    var passwordValidity2 = document.getElementById('passwordValidity2');
    var passwordPattern = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,20}$/;
    if (password.match(passwordPattern)) {
       form1.classList.add("valid");
       form1.classList.remove("invalid");
        passwordValidity2.innerHTML = "Password is matched.       ";
        passwordValidity2.style.color = "#1C1AE7";
    } else {
        form1.classList.remove("valid");
       form1.classList.add("invalid");
        passwordValidity2.innerHTML = "Password is not matched.";
        passwordValidity2.style.color = "#ff0000";
    }
    if (password== " ")
  {
    form1.classList.remove("valid")
    form1.classList.remove("invalid");
    passwordValidity2.innerHTML= "  ";
    passwordValidity2.style.color = "#00ff00";
  }
  }
  function not_show_pass_1(){
    form1.classList.remove("valid")
    form1.classList.remove("invalid");
    passwordValidity2.innerHTML= "  ";
    passwordValidity2.style.color = "#00ff00";
  }



  function validate3() {
    var form1 = document.getElementById("form1");
    var name = document.getElementById('name').value;
    var nameValidity = document.getElementById('nameValidity');
    var namePattern = /^[A-Za-z\s]+$/;
    if (name.match(namePattern)) {
        form1.classList.add("valid");
        form1.classList.remove("invalid");
        nameValidity.innerHTML = "Your Name is Valid.";
        nameValidity.style.color = "#1C1AE7";
    } else {
        form1.classList.remove("valid");
        form1.classList.add("invalid");
        nameValidity.innerHTML = "Please enter a valid name (letters only).";
        nameValidity.style.color = "#ff0000";
    }
    if (name== " ")
  {
    form1.classList.remove("valid")
    form1.classList.remove("invalid");
    nameValidity.innerHTML= "  ";
    nameValidity.style.color = "#00ff00";
  }
  }
  function not_show_name(){
    form1.classList.remove("valid")
    form1.classList.remove("invalid");
    nameValidity.innerHTML= "  ";
    nameValidity.style.color = "#00ff00";
  }


  function validate4() {
    var form1 = document.getElementById("form1");
    var email1 = document.getElementById('email1').value;
    var emailValidity1 = document.getElementById('emailValidity1');
   
    var pattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;


    if (email1.match(pattern)) {
    form1.classList.add("valid")
    form1.classList.remove("invalid");
    emailValidity1.innerHTML= "Your Email Address is Valid.";
    emailValidity1.style.color = "#1C1AE7";
    } else {
    form1.classList.remove("valid")
    form1.classList.add("invalid");
    emailValidity1.innerHTML = "Please enter valid email address";
    emailValidity1.style.color="#ff0000";
    }
    if (email1== " ")
  {
    form1.classList.remove("valid")
    form1.classList.remove("invalid");
    emailValidity1.innerHTML= "       ";
    emailValidity1.style.color = "#00ff00";
  }
  }
  function not_show_email_1(){
    form1.classList.remove("valid")
    form1.classList.remove("invalid");
    emailValidity1.innerHTML= "       ";
    emailValidity1.style.color = "#00ff00";
  }


  function validate5() {
    var form1 = document.getElementById("form1");
    var password1 = document.getElementById('password1').value;
    var passwordValidity1 = document.getElementById('passwordValidity1');
    var passwordPattern = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,20}$/;
    if (password1.match(passwordPattern)) {
        form1.classList.add("valid");
        form1.classList.remove("invalid");
        passwordValidity1.innerHTML = "Your Password is Strong.";
        passwordValidity1.style.color = "#1C1AE7";
    } else {
        form1.classList.remove("valid");
        form1.classList.add("invalid");
        passwordValidity1.innerHTML = "Invalid password.";
        passwordValidity1.style.color = "#ff0000";
    }
    if (password1== " ")
  {
    form1.classList.remove("valid")
    form1.classList.remove("invalid");
    passwordValidity1.innerHTML= "  ";
    passwordValidity1.style.color = "#00ff00";
  }
  }
  function not_show_pass_2(){
    form1.classList.remove("valid")
    form1.classList.remove("invalid");
    passwordValidity1.innerHTML= "  ";
    passwordValidity1.style.color = "#00ff00";
  }


  
</script>

<?php
function setValue($fieldName)
{
    if( isset($_POST[$fieldName]) )
    {
        echo $_POST[$fieldName];
    }
}


if (isset($_POST["login"])) {
   
    $email = $_POST["email"];
    $password1 = $_POST["Password"];
    //echo "<script>alert('login click');</script>";
    function checkUser($email, $password1, $table)
{
    $dsn = "mysql:dbname=transport";
    $username = "root";
    $password = "";

    try {
        $conn = new PDO( $dsn, $username, $password );
        $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    } catch ( PDOException $e ) {
        echo "Connection failed: " . $e->getMessage();
    }

    $sql = "SELECT * FROM $table";
    $dbpassword = "";
    try {
        $rows = $conn->query( $sql );
        foreach ( $rows as $row )
        {
                if($row["email"] == $email)
                {
                   
                    $dbpassword = $row["password"];
                    if($table == "admin")
                    {
                        //echo "<script>alert('admin.');</script>";
                        $aname=$row["name"];
                        $aid=$row["aid"];                    
                        //echo "<script>alert('$aname');</script>";
                        //echo "<script>alert('$aid');</script>";
                        
                    }    
                    if($table == "customer")
                    {
                        //echo "<script>alert('customer.');</script>";
                        $name=$row["name"];
                        $cid=$row["cid"];
                        $cemail=$row["email"];
                        //echo "<script>alert('$name');</script>";
                        //echo "<script>alert('$cid');</script>";
                    }  
               
                
                    break;
                }
                
                    
        }
                if($dbpassword == $password1) {
                    //echo "<script>alert('pass check.');</script>"; 
                    if($table == "admin")
                    {
                        $_SESSION["admin"] = $aid;                        
                        $_SESSION["aname"] = $aname;
                    }  
                    if($table == "customer")
                    {
                        $_SESSION["customer"] = $cid;
                        $_SESSION["cname"] = $name;
                        $_SESSION["cemail"]=$cemail;
                    }          
                    return true;
                }
                else if (($dbpassword == "") && ($table == "customer"))
                {
                    echo "<script>alert('You have not signed in. Please go to Sign in page.' + rotate1());</script>";  //sign in page flip
                }
                

        return false;

    } catch (PDOException $e) {
        echo "Query failed: " . $e->getMessage();
    }

}

    if (checkUser($email, $password1, "admin")) {

        $admin_name=$_SESSION["aname"];
        echo "<script>alert('Welcome $admin_name');</script>";
        $aid=$_SESSION["admin"];
        
        echo "<script>window.location = 'admin_dashboard.php';</script>"; 
        echo "<script>alert('Welcome here $aid');</script>";


    } elseif (checkUser($email, $password1, "customer")) {
        
       // echo "<script>alert('Login Successful!');</script>";
        echo "<script>window.location ='$path';</script>";
        
    } 

}
?>

<?php
  function setValue1($fieldName)
  {
      if( isset($_POST[$fieldName]) )
      {
          echo $_POST[$fieldName];
      }
  }
if (isset($_POST["SignUp"])) {
    $nname = $_POST["name"];
    $eemail = $_POST["Email"];
    $password1 = $_POST["PPassword"];
    $confirmPassword = $_POST["ConfirmPassword"];
    //$hashpw=password_hash( $confirmPassword, PASSWORD_DEFAULT);
    //echo "<script>alert('$nname');</script>";
    //echo "<script>alert('$eemail');</script>";
    //echo "<script>alert('$password1');</script>";

    $dsn = "mysql:dbname=transport";
    $username = "root";
    $password = "";

    try {
        $conn = new PDO( $dsn, $username, $password );
        $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
       } catch ( PDOException $e ) {
        echo "Connection failed: " . $e->getMessage();
    }

    $sql = "SELECT * FROM customer";

    $flag1 = false;

    try {
        $rows = $conn->query( $sql );
        foreach ( $rows as $row ) {
            if($row["email"] == $eemail)
            {
                $flag1 = true;
                break;
            }
        }
       } catch ( PDOException $e ) {
        echo "Query failed: " . $e->getMessage();
       }

       if($flag1 == true)
       {
        echo "<script>alert('Your email address is already Signed in. Please go to Login Page!' + rotate2());</script>";

       }
       else{
             if (!filter_var($eemail, FILTER_VALIDATE_EMAIL)) {
              echo "<script>alert('Invalid email address! Please enter again.' + rotate1());</script>";
            } elseif ($password1 != $confirmPassword) {
              echo "<script>alert('Passwords do not match.' + rotate1());</script>";  
              //echo "<script>window.location='SignUp.php#show_sign_up';</script>";
            } else {
                /*$sql = "INSERT INTO customer values (:name, :email, :password)";

                try{
                    $st = $conn->prepare($sql);
                    $st->bindValue(":name", $nname, PDO::PARAM_STR);
                    $st->bindValue(":email", $eemail, PDO::PARAM_STR);
                    $st->bindValue(":password", $password1, PDO::PARAM_STR);
                    $st-> execute();
                } catch ( PDOException $e ) {
                    echo "Query failed: " . $e-> getMessage();
                }
                $cid_s=getNextCustomerId();
                $_SESSION['customer']=$cid_s;
                echo "<script>alert('$cid_s');</script>";
                echo "<script>window.location = '$path' ;</script>";
                echo "<script>alert('Sign up Successful!!');</script>";*/


                $sql = "INSERT INTO customer (name, email, password, photo) VALUES (:name, :email, :password, :photo)";
                $cphoto='df_user.png';
                try {
                    $st = $conn->prepare($sql);

                    if (!$st) {
                        die("Failed to prepare statement: " . $conn->errorInfo());
                    }

                    $st->bindValue(":name", $nname, PDO::PARAM_STR);
                    $st->bindValue(":email", $eemail, PDO::PARAM_STR);
                    $st->bindValue(":photo", $cphoto, PDO::PARAM_STR);
                    $st->bindValue(":password", $password1, PDO::PARAM_STR);

                    if (!$st->execute()) {
                        die("Failed to execute statement: " . $st->errorInfo());
                    }

                    $cid_s = $conn->lastInsertId();
                    $_SESSION['customer'] = $cid_s;
                    //echo "<script>alert('$cid_s');</script>";
                    echo "<script>window.location = '$path' ;</script>";
                    echo "<script>alert('Sign up Successful!!');</script>";

                } catch (PDOException $e) {
                    die("Query failed: " . $e->getMessage());
                }
                
        }
       }
}
function getNextCustomerId() {
    global $conn; 

    try {
        
        $sql2 = "SELECT MAX(cid) AS max_cid FROM customer";
        $stmt2 = $conn->prepare($sql2);
        $stmt2->execute();
        
        
        $result2 = $stmt2->fetch(PDO::FETCH_ASSOC);

       
        if ($result2['max_cid'] === null) {
            return 1;
        } else {
            
            return $result2['max_cid'] + 1;
        }
    } catch (PDOException $e) {
        
        echo "Error: " . $e->getMessage();
        return null;
    }
}
?>
  </body>

  </html>
