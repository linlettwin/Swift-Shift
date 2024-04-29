<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="receipt.css">
  <link rel="icon" type="image/png" href="images/bc_logo.png" />
  <title>Swift Shift</title>

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

</head>
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
    <!--whole container for info and payment-->
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
                        <li class="three step-wizard-item three">
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
         <div class="div_2_col"> 
            <div class="info_place">

                <div class="title1">
                    <h5>Thank You for trusting Us!</h5>
                    <div class="logo-and-receipt">
                        <div class="logo">
                            <img src="./images/logo1.png" style="width: 100px; height: 70px;">
                        </div>
                        <div class="receiptNo">
                            <p>Receipt Number : 001235</p>
                            <p1>Date: 2.1.2024</p1>
                        </div>
                    </div>
                </div>
                
                
             
                
                <div class="user_info">
                    <div class="show_info_booking">
                       <table>
                        <tr>
                            <th>Name: </th>
                            <td>Lin Lett</td>
                            
                        </tr>
                        <tr>
                            <th>Phone Number: </th>
                            <td>09-798884886</td>
                            
                        </tr>
                        <tr>
                            <th>Email: </th>
                            <td>linlett@gmail.com</td>
                            <td> </td>
                        </tr>
                        <tr class="line"></tr>
                        <tr>
                            <th>Operator: </th>
                            <td>Elite</td>
                            
                        </tr>
                        <tr>
                            <th>Route:</th>
                            <td>Yangon - Mandalay</td>
                            
                        </tr>
                        <tr>
                            <th>Departure Time:</th>
                            <td>Jan 1, 6:00 AM</td>
                            <td> </td>
                        </tr>
                        <tr class="line"></tr>
                        <tr>
                            <th>Seats:</th>
                            <td>2</td>
                           
                        </tr>
                        <tr>
                            <th>Seat Number(s):</th>
                            <td>2,12</td>
                            <td> </td>
                        </tr>
                        <tr class="line"></tr>
                        <tr>
                            <th>Total:</th>
                            <td>4,5000 MMK</td>
                            <td> </td>
                        </tr>
                        <tr>
                            <th>Payment Method:</th>
                            <td><img src="images/payment/kbzpay.jpg" style="width: 60px; height: 60px;"></td>
                        </tr>
                       </table>
                       <img src="images/payment/sign-removebg-preview.png" style="height: 40px; width: 100px; margin-left: 300px;">
                       <button class="ok_button" onclick="goToAnotherPage()" style="margin-left: 20px;padding: 8px 20px;background-color: #F18D65;">OK</button>
                    </div>
                    
                    
                </div>

            </div>
        </div>    
          
            
        

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
</body>
<script type="text/javascript" charset="utf-8">
const one = document.querySelectorAll(".one");
const two = document.querySelectorAll(".two");
const three = document.querySelectorAll(".three");

var div = document.getElementById("pay");
  
function show_payment()
{
    event.target.classList.remove("current-item");

    one.forEach(element => {
        element.classList.remove("current-item");
    });

    two.forEach(element => {
        element.classList.remove("current-item");
    });

    three.forEach(element => {
        element.classList.add("current-item");
    });

    div.style.display = "block";
}

    function goToAnotherPage() {
        window.location.href = "bus_page_1.php";
    }


</script>
</html>