<?php
session_start();


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/png" href="images/bc_logo.png" />
  <link rel="stylesheet" href="paymentkbz.css">

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
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--google fonts -->
	
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    <style>
        body,html{
            font-family: "Poppins", sans-serif;
        }
        #login_user{
            width: 40px;
            height:40px;
            align-items:center;
            border-radius:50%;
            /*margin-left:20px;
            margin-right:20px; */
            
        }
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
    z-index:5;
    position:fixed;
    width:100%;
    
}

/* Styles for the logo */
.logo img {
    width: 40px;
}
#login_user{
    width: 40px;
    height:40px;
    align-items:center;
    border-radius:50%;
    /*margin-left:20px;
    margin-right:20px; */
    
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
    padding-top:120px;
    display:flex;
    flex-direction:column;
    justify-content:center;
    margin-bottom:30px;
    text-align: center;
}
.progress-bar-place{
    margin-left:60px;
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
.progress-count:before{
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
}   
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

.section-container {
     /* Set position to relative */
    width: 30%; /* Adjust the width as needed */
    margin: 0 auto; /* Center the section */
    margin-bottom:40px;
    text-align: center;
    display:flex;
    justify-content:center;
    margin-top:-35px;
  }

  .section-with-background {
    background-color: #D8E5F2; /* Choose your background color */
    border-radius:10px;
    height: 40%; /* Set position to relative */
  }
  
.logo_head img{
    width:100px;
    height:100px;
}

.cancel-button {
    margin-top: 10px;
    padding: 5px 10px;
    background-color: #F18D65;
    font-weight: bold;/* Adjust the margin as needed */
    border-radius: 10px;
    margin-bottom:10px;
}  
@media (max-width: 745px) {

    .section-with-background {
       height:auto;
    }
  }
  
@media (max-width: 500px) {

.section-with-background {
   height:auto;
}
}
 </style>

</head>
<?php 
if(isset($_POST["done"])){
  echo "<script> window.location.href = 'home.php';</script>";

}
?>
<body>
    <header>
        <nav>
            <ul class='nav-bar'>
                    <img src='./images/logo1.png'>
                <input type='checkbox' id='check' />
                <span class="menu">
                  
                <li><a href="">Home</a></li>
                    <li><a href="bus_page_1.php">Bus Ticket</a>
                      
                    </li>
                    <li><a href="cargoform.php">Cargo</a>
                      
                    </li>
                    
                    <li><a href="#cont_us">Contact Us</a></li>
                    <li><a href="#"><img src="./images/user/boy.jpg" id="login_user"></a></li>
                    <label for="check" class="close-menu"><i class="fas fa-times"></i></label>
                  
                </span>
                <label for="check" class="open-menu"><i class="fas fa-bars"></i></label>
            </ul>
        </nav>
    </header>
    <div class="whole">
    <div class="progress-bar-place">
        <section class="step-wizard">
                <ul class="step-wizard-list">
                    <li class="one step-wizard-item">
                        <span class="progress-count">1</span>
                        <span class="progress-label">Traveller Info</span>
                    </li>
                    <li class="two step-wizard-item ">
                        <span class="progress-count">2</span>
                        <span class="progress-label">Confirmation</span>
                    </li>
                    <li class="three step-wizard-item">
                        <span class="progress-count">3</span>
                        <span class="progress-label">Payment</span>
                    </li>
                    <li class="step-wizard-item current-item">
                        <span class="progress-count">4</span>
                        <span class="progress-label">Complete</span>
                    </li>
                </ul>
        </section>
     </div>
     </div>
     <div class="section-container">
      <div class="section-with-background">
          <div>
            <div class="logo_head">
                 <img src='./images/logo1.png'>
            </div>
            <div>
                <h5 style="color=#7895CB;">Your Booking has been Reserved!</h5>
                <p  style="font-size:13px;">We'll review your payment and inform you within 2 hours. 
                You can see if your booking is approved in your account profile!</p>
                <span></span>
                <form action="book_confirm.php" method="post">
                <button type="submit" class="cancel-button" name="done">Done</button>
                </form>
            </div>
          </div>
      </div>
    </div>


<script type="text/javascript">
</script>



  
</body>


</html>