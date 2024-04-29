<?php
require "dbConnection.php";


session_start();

try {

    // $email=$_SESSION['email'];
    $stmt = $conn->prepare("SELECT * FROM customer WHERE email = ?");
    $stmt->execute([$_SESSION['email']]);

    if ($stmt->rowCount() > 0) {
        $user1 = $stmt->fetch();
        // echo gettype($user1);

        $id = $user1['cid'];
        // echo $id;
        $name = $user1['name'];
        $email=$user1['email'];
        $passwordbf=$user1['password'];
        $profile = $user1["photo"];

        if (isset($_POST["save_changes"])) {
        
            $_SESSION['email']=$_POST['email'];
            $passwordaf = $_POST["currentPass"];
            $file_name=$_FILES['image']['name'];
            $tempname=$_FILES['image']['tmp_name'];
            $folder='images/user/'.$file_name;
    
            if($file_name==NULL)
            {
                $stmt = $conn->prepare("UPDATE customer SET name=?, email=? WHERE cid=?");
                $stmt->execute([$_POST["name"],$_POST["email"],$_POST["id"]]);
                
            }
            else
            {
                $stmt = $conn->prepare("UPDATE customer SET name=?, email=?,photo=? WHERE cid=?");
                $stmt->execute([$_POST["name"],$_POST["email"], $file_name, $_POST["id"]]);
                move_uploaded_file($tempname,$folder);
            }
            echo $passwordaf;
    
            if($passwordaf == $passwordbf){
                if ($_POST["new_password"] !== NULL && $_POST["retype_password"] !==  NULL )
                {
                    if ($_POST["new_password"] == $_POST["retype_password"]) {
                        $newpassword = $_POST["new_password"];
                        $stmt = $conn->prepare("UPDATE customer SET password=? WHERE cid=?");
                        $stmt->execute([$newpassword,$_POST["id"]]);
                    } else {
                        echo "New password and retyped password do not match";
                        exit;
                    }
                }
                
            }
            
            header("Location: home.php");
            // exit();
        }
    } else {
        echo "No user found for email";
    }

    if (isset($_POST["submit"])) {
        $feedbackText = $_POST["feedback"];
        $currentTime = date('Y-m-d H:i:s');

        $stmt = $conn->prepare("INSERT INTO feedback (cid, feedback, ftime) VALUES (?, ?, ?)");
        $stmt->execute([$id, $feedbackText, $currentTime]);

        if ($stmt->rowCount() > 0) {
            echo "<script>alert('Successful!');</script>";
            echo "<script>window.location = 'home.php';</script>";
        } else {
            echo "Error: Unable to insert feedback.";
        }
    }

    if(isset($_POST["cancel"])){
        header("Location: home.php");
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}


        



       
        // $stmt = $conn->prepare("SELECT * FROM customer WHERE email=?");
        // $stmt->execute([$_SESSION['email']]);
        // $user1=$stmt->fetch();
        // echo gettype($user1);
        // $id=$user1['cid'];
        // $name=$user1['name'];
        // $passwordbf = $user1["password"];
        // $email = $user1["email"];
        // $image = $user1["photo"];

        
   
    
    


// if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // if (isset($_POST['$_FILES["image"]["name"]'])){
    //     //$_FILES["image"]["name"]
    //     $id = $_POST["id"];
    //     $name = $_POST["name"];
    //     $imageName = $_FILES["image"]["name"];
    //     $imageSize = $_FILES["image"]["size"];
    //     $tmpName = $_FILES["image"]["tmp_name"];
    //     // Image validation
    //     $validImageExtension = ['jpg', 'jpeg', 'png'];
    //     $imageExtension = explode('.', $imageName);
    //     $imageExtension = strtolower(end($imageExtension));
    //     if (!in_array($imageExtension, $validImageExtension)) {
    //         echo"
    //         <script>
    //         alert('Invalid Image Extension');
    //         document.location.href = 'clickTest.php';
    //         </script>";
    //     } elseif ($imageSize > 1200000) {
    //         echo "
    //         <script>
    //         alert('Image Size Is Too Large');
    //         document.location.href = 'clickTest.php';
    //         </script>";
    //     } else {
    //         $newImageName = $name . " - " . date("Y.m.d") . " - " . date("h.i.sa"); // Generate new image name
    //         $newImageName .= '.' . $imageExtension;
    //         $query = "UPDATE customer SET photo = '$newImageName' WHERE cid = $id";
    //         mysqli_query($dbConnection, $query);
    //         move_uploaded_file($tmpName, 'img/' . $newImageName);
    //         echo"
    //         <script>
    //         document.location.href = 'manageClick.php';
    //         </script>";
    //    }
    

    // if (isset($_POST["save_changes"])) {
        
       
    //     $passwordaf = $_POST["currentPass"];
    //     $file_name=$_FILES['image']['name'];
    //     $tempname=$_FILES['image']['tmp_name'];
    //     $folder='img/'.$file_name;

    //     if($file_name==NULL)
    //     {
    //         $stmt = $conn->prepare("UPDATE customer SET name=?, email=? WHERE cid=?");
    //         $stmt->execute([$_POST["name"],$_POST["email"],$_POST["id"]]);
    //     }
    //     else
    //     {
    //         $stmt = $conn->prepare("UPDATE customer SET name=?, email=?,photo=? WHERE cid=?");
    //         $stmt->execute([$_POST["name"],$_POST["email"], $file_name, $_POST["id"]]);
    //         move_uploaded_file($tempname,$folder);
    //     }
        

        
    //     if($passwordaf == $passwordbf){
    //         if ($_POST["new_password"] == $_POST["retype_password"]) {
    //             $newpassword = $_POST["new_password"];
                
    //             $stmt = $conn->prepare("UPDATE customer SET password=? WHERE cid=?");
    //             $stmt->execute([$newpassword,$_POST["id"]]);
    //         } else {
    //             echo "New password and retyped password do not match";
    //             exit;
    //         }
    //     }
    //     header("Location: manageClick.php");
    //     // exit();
    // }


    // if (isset($_POST["submit"])) {
    //     $feedbackText = mysqli_real_escape_string($dbConnection, $_POST["feedback"]);
    //     $currentTime = date('Y-m-d H:i:s');

    //     $query = "INSERT INTO feedback (cid, feedback, ftime) VALUES ($sessionID, '$feedbackText', '$currentTime')";
    //     $result = mysqli_query($dbConnection, $query);

    //     if ($result) {
    //         echo "<script>alert('Successful!');</script>";
    //         echo "<script>window.location = 'clickTest.php';</script>";
    //     } else {
    //         echo "Error: " . mysqli_error($dbConnection);
    //     }
    // }

    // if (isset($_POST["cancel"])) {
    //     header("Location: clickTest.php");
    //     exit();
    // }

    

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Edit Info</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://kit.fontawesome.com/094c1a5071.js" crossorigin="anonymous"></script>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Dancing+Script&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Dancing+Script&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

        <style>
            body {
              
                margin-top: 20px;
            }

            .ui-w-80 {
                width: 80px !important;
                height: auto;
            }

            .btn-default {
                border-color: rgba(24, 28, 33, 0.1);
                background: lightgrey;
                color: #4E5155;
                
                margin-right:20px;
            }

            label.btn {
                margin-bottom: 0;
            }

            .btn-outline-primary {
                border-color: #26B4FF;
                background: transparent;
                color: #26B4FF;
            }

            .btn {
                cursor: pointer;
            }

            .text-light {
                color: #babbbc !important;
            }


            .card {
                background-clip: padding-box;
                box-shadow: 0 1px 4px rgba(24, 28, 33, 0.012);
                background-color: #e7eef4;
            }

            .row-bordered {
                overflow: hidden;
            }

            .account-settings-fileinput {
                position: absolute;
                visibility: hidden;
                width: 1px;
                height: 1px;
                opacity: 0;
            }

            .box{
                background: linear-gradient(153.33deg, rgba(0, 0, 0, 0.35) 2.28%, rgba(0, 0, 0, 0.2) 97.62%);
                padding: 30px;
                border-radius: 15px;
            }

            textarea{
                background: rgba(176, 171, 171, 0.23);
                opacity: 0.5;
                width: 100%;
                border: 0;
                outline: none;
                padding: 10px;
                border-radius: 10px;
            }

            submit-align{
                display: flex;
                justify-content: center;
            }


            .submit{
                width: 100px;
                margin: 20px 210px;
                padding: 8px;
                border-radius: 8px;
                background-color: rgba(18, 117, 255, 1);
                border: 0;
                outline: none;
                color: white;
                font-size: 18px;
                cursor:pointer;

            }

            .w-count{display:flex; 
                flex-direction:row; 
                justify-content:flex-end;
            }

            .w-count h5{font-size:20px;}
            .w-count p{font-size:20px;}

            #confirm{
            display: none;
                background-color: #F3F5F6;
                color: #000000;
                border: 1px solid #aaa;
                position: fixed;
                width: 300px;
                height:fit-content;
                left: 45%;
                top:30%;
                margin-left: -100px;
                padding: 30px 10px;
                box-sizing: border-box;
                text-align: center;
                border-radius: 30px;
                z-index: 10;
            }

            #confirm button {
                    background-color: #262626;
                    display: inline-block;
                    border-radius: 12px;
                    border: 0;
                    outline: 0;
                    padding: 10px;
                    text-align: center;
                    width: 180px;
                    height: fit-content;
                    cursor: pointer;
                    color: white;
                    margin: 15px;
                    margin-bottom: 20px;
                    font-size: 20px;     
                }
    
                #confirm .message {
                    text-align: center;
                    font-size: 25px;
                    font-weight: 550;
                    margin: 10px;
                }
        </style>
    </head>

    <body>
        <div class="container light-style flex-grow-1 container-p-y">
            <h4 class="font-weight-bold py-3 mb-4">
                Account settings
            </h4>
            <div class="card overflow-hidden">
                <div class="row no-gutters row-bordered row-border-light">
                    <div class="col-md-3 pt-0">
                        <div class="list-group lidst-group-flush account-settings-links">
                            <a class="list-group-item list-group-item-action active" data-toggle="list"
                                href="#account-general">General</a>
                            <a class="list-group-item list-group-item-action" data-toggle="list"
                                href="#account-change-password">Change password</a>
                            <a class="list-group-item list-group-item-action" data-toggle="list"
                                href="#account-give-feedback">Give Feedback</a> 
                            <a class="list-group-item list-group-item-action"  style="height:300px;" data-toggle="list"
                                href="#"></a>  
                        </div>
                        
                    </div>
                    
                    <div class="col-md-9">
                        <form method="post" id="form" class="form" enctype="multipart/form-data" action="">
                            <input type="hidden" name="id" value="<?php echo $user1['cid']; ?>">
                            <div class="tab-content">
                                <div class="tab-pane fade active show" id="account-general">
                                    <div class="card-body media align-items-center">
                                        <img src="img/<?php echo $profile; ?>" alt class="d-block ui-w-80">
                                        <div class="media-body ml-4">
                                            <label class="btn btn-outline-primary">
                                                Upload new photo
                                                <input type="file" id="image" name="image" accept=".jpg, .jpeg, .png" class="account-settings-fileinput">
                                            </label> &nbsp;
                                            <div class="text-light small mt-1">Allowed JPG or PNG.</div>
                                            <script type="text/javascript">
                                                document.getElementById("image").onchange = function () {
                                                    document.getElementById("form").submit();
                                                };
                                            </script>
                                        </div>
                                    </div>
                                    <hr class="border-light m-0">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label class="form-label">Name</label>
                                            <input type="text" name="name" class="form-control" value="<?php echo $name; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Email</label>
                                            <input type="text" name="email" class="form-control mb-1" value="<?php echo $email; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="account-change-password">
                                    <div class="card-body pb-2">
                                        <div class="form-group">
                                            <label class="form-label">Current password</label>
                                            <input type="password" name="currentPass" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">New password</label>
                                            <input type="password" name="new_password" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Repeat new password</label>
                                            <input type="password" name="retype_password" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="account-give-feedback">
                                    <div class="card-body pb-3">
                                    <h3>Review your experiment</h3>
                                    <form><textarea rows="13" id="input-textarea" maxlength="250" name="feedback" style="background-color:grey;"></textarea>
                                        <!--word count-->
                                        <div class="w-count">
                                        <h5 id="charCount" style="margin-top:3px;">150</h5> 
                                        <p > &nbsp;/ 150</p>
                                        </div>

                                        <div class="submit-align" style="display:flex; justify-content:center;">
                                            <input type="submit"  name="submit" value="Submit"  class="submit" id="submit"/>
                                        </div>
                
                                    </form>

                                    <script>
                                        let max_length=150;
                                        let input_textarea=document.getElementById("input-textarea");
                                        let char_no=document.getElementById("charCount");
                                        input_textarea.addEventListener("input" , () => {
                                        let writing=input_textarea.value.length;
                                        char_no.textContent=max_length - writing;
                                        })
                                    </script>


                                </div>
                            </div>

                                
                                <div class="text-right mt-3 mb-3" >
                                    <button type="submit" name="save_changes" class="btn btn-primary">Save Changes</button>&nbsp;
                                    <button type="submit" name="cancel" class="btn btn-default">Cancel</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>

</html>
