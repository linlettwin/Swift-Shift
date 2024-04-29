<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="home.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2"
    crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>

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
      @import url('https://fonts.googleapis.com/css2?family=Itim&display=swap');

       body,html {
    background-color:#E7EEF4;
    font-family: "Poppins", sans-serif;
    --color1: #FFF ;
    --color2:  #688dc4;
   

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
                <li><a href="cargoform.php">Cargo</a>
                  
                </li>
                <li><a href="#cont_us">Contact Us</a></li>
                <li><a href="SignUp.php">Login <i class="fa-solid fa-user"></i></a></li>
                <label for="check" class="close-menu"><i class="fas fa-times"></i></label>
              
            </span>
            <label for="check" class="open-menu"><i class="fas fa-bars"></i></label>
        </ul>
    </nav>
</header>
             

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
  <div class="blue-section">
        <h4 style="font-weight: bold;">Our Services</h4>
        <div class="text-with-lines">
            <p>Travel and Cargo with please</p>
        </div>

        <div class="photo" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="100">
            <form class="flex-container">
                <button class="img-button" formaction="About_us.php">
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
    
              <button class="img-button" formaction="About_us.php">
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
            <a href="cargoform.php" class="button"><div class="icon"><i class="fa-solid fa-bus"></i></div> Cargo Reservation</a>
            <!-- <a href="#" class="button"><div class="icon"><i class="fa-solid fa-ship"></i></div> Cruise Ticket</a> -->
        </div>
    </div>
  </div>
  <!--Review-->
  <div class="review">
      <section class="testimonials">
        <div class="container1">
          <div class="section-header">
            <h4 class="title" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="100">What Our Customers Say</h4>
          </div>
          <div class="testimonials-content">
            <div class="swiper testimonials-slider js-testimonials-slider">
              <div class="swiper-wrapper">
                <div class="swiper-slide testimonials-item">
                  <div class="info">
                    <img src="images/user/boy.jpg" alt="img">
                    <div class="text-box">
                      <h5 class="name">Jack</h5>
                    </div>
                  </div>
                  <p>"Exceptional service! I've been using this transportation agency for my daily 
                    commute, and they never disappoint. Punctual drivers, clean vehicles, and a 
                    smooth ride every time. Highly recommended!"</p>
                  <!--<div class="rating">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star" class="sbl"></i>
                  </div> -->
                </div>
  
                <div class="swiper-slide testimonials-item">
                  <div class="info">
                    <img src="images/user/girl.jpg" alt="img">
                    <div class="text-box">
                      <h5 class="name">Anna</h5>
                    </div>
                  </div>
                  <p>"Reliable and efficient transportation service! The drivers are courteous, and 
                    the vehicles are well-maintained. I've used this agency for both personal and business
                     travel, and they consistently exceed expectations."</p>
                  <!--<div class="rating">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star" class="sbl"></i>
                  </div> -->
                </div>
  
                <div class="swiper-slide testimonials-item">
                  <div class="info">
                    <img src="images/user/girl3.jpg" alt="img">
                    <div class="text-box">
                      <h5 class="name">May</h5>
                    </div>
                  </div>
                  <p>"Good experience overall. The drivers are friendly, and the booking process is 
                    straightforward. The vehicles are comfortable, and I appreciate the attention to 
                    safety. Will use again."</p>
                  <!--<div class="rating">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star" class="sbl"></i>
                  </div> -->
                </div>
  
                <div class="swiper-slide testimonials-item">
                  <div class="info">
                    <img src="images/user/girl2.jpg" alt="img">
                    <div class="text-box">
                      <h5 class="name">Jasmine</h5>
                    </div>
                  </div>
                  <p>"Outstanding customer service! I had a last-minute change in my travel plans, and th
                    e agency went above and beyond to accommodate me. Clean cars, on-time service, and fr
                    iendly staff. I'm a satisfied customer."</p>
                  <!--<div class="rating">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star" class="sbl"></i>
                  </div> -->
                </div>
                <div class="swiper-slide testimonials-item">
                  <div class="info">
                    <img src="images/user/man.jpg" alt="img">
                    <div class="text-box">
                      <h5 class="name">Mr. Johny</h5>
                    </div>
                  </div>
                  <p>"Solid transportation choice for business trips. The chauffeurs are professional, and 
                    the agency is responsive to scheduling needs. I've used them for airport transfers, and
                     it's always a hassle-free experience."</p>
                  <!--<div class="rating">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star" class="sbl"></i>
                  </div> -->
                </div>
                <div class="swiper-slide testimonials-item">
                  <div class="info">
                    <img src="images/user/boy3.jpg" alt="img">
                    <div class="text-box">
                      <h3 class="name">Kelvin</h3>
                    </div>
                  </div>
                  <p>"Great for group travel! I recently booked a large vehicle for a family reunion, 
                    and everything went smoothly. The driver was accommodating, and the vehicle was
                     spacious and clean. Will definitely use their services again!"</p>
                  <!--<div class="rating">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star" class="sbl"></i>
                  </div> -->
                </div>
              </div>
            </div>
            <div class="swiper-pagination js-testimonials-pagination"></div>
          </div>
        </div>
      </section>
    </div>

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
         <form class="contact_info">
           <input type="text" name="username1" class="inp" placeholder="Full Name"> <br><br>
           <input type="email" name="userEmail" class="inp" placeholder="Email"><br><br>
           <!--<input type="text" name="comment" id="comt" class="inp" placeholder="Comment">-->
           <textarea id="comment" name="comment" placeholder="Comment" rows="3" cols="30"></textarea>
          <br><br>
           <input type="Submit" name="submit" id="subt"><br><br><br>
         </form>
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
                     09-789998665</p>
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
      <a href="office.html"><button class="otherOffice" formaction="office.html" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="100">Branch Offices</button> </a>
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
                    <a href="#" class="link_info"><p class="mb-0">Buses</p></a>
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


    



  
  <script src="home.js"></script>
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
  <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
  <script>
    AOS.init();
  </script>
</body>

</html>