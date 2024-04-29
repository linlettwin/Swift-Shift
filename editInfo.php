<?php
require "dbConnection.php";

$sessionID = $_SESSION["customer"];
$user = mysqli_fetch_assoc(mysqli_query($dbConnection, "SELECT * FROM customer WHERE cid = $sessionID"));
$id = $user["cid"];
$name = $user["name"];
$passwordbf = $user["password"];
$email = $user["email"];
$image = $user["photo"];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["save_changes"])) {
        $id = $_POST["id"];
        $name = $_POST["name"];
        $email = $_POST["email"];
        $passwordaf = $_POST["currentPass"];

        $query = "UPDATE customer SET name = '$name', email = '$email' WHERE cid = $id";
        mysqli_query($dbConnection, $query);

        if($passwordaf == $passwordbf){
            if ($_POST["new_password"] === $_POST["retype_password"]) {
                $newpassword = $_POST["new_password"];
                $query = "UPDATE customer SET password = '$newpassword' WHERE cid = $id";
                mysqli_query($dbConnection, $query);
            } else {
                echo "New password and retyped password do not match";
                exit;
            }
        }
        header("Location: manageClick.php");
        exit();
    }

    if (isset($_POST["cancel"])) {
        header("Location: manageClick.php");
        exit();
    }
}




$sessionID = 1; // Assuming session id is set elsewhere
$user = mysqli_fetch_assoc(mysqli_query($dbConnection, "SELECT * FROM customer WHERE cid = $sessionID"));
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Info</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f5f5f5;
            margin-top: 20px;
        }

        .ui-w-80 {
            width: 80px !important;
            height: auto;
        }

        .btn-default {
            border-color: rgba(24, 28, 33, 0.1);
            background: rgba(0, 0, 0, 0);
            color: #4E5155;
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
                    <div class="list-group list-group-flush account-settings-links">
                        <a class="list-group-item list-group-item-action active" data-toggle="list"
                            href="#account-general">General</a>
                        <a class="list-group-item list-group-item-action" data-toggle="list"
                            href="#account-change-password">Change password</a>
                    </div>
                </div>
                <div class="col-md-9">
                    <form method="post" id="form" class="form" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                        <input type="hidden" name="id" value="<?php echo $user['cid']; ?>">
                        <div class="tab-content">
                            <div class="tab-pane fade active show" id="account-general">
                                <div class="card-body media align-items-center">
                                    <img src="img/<?php echo $image; ?>" alt class="d-block ui-w-80">
                                    <div class="media-body ml-4">
                                        <label class="btn btn-outline-primary">
                                            Upload new photo
                                            <input type="file" id="image" name="image" class="account-settings-fileinput">
                                        </label> &nbsp;
                                        <script type="text/javascript">
                                            document.getElementById("image").onchange = function () {
                                                document.getElementById("form").submit();
                                            };
                                        </script>

                                        <?php
                                            if (isset($_FILES["image"]["name"])) {
                                                $id = $_POST["id"];
                                                $name = $_POST["name"];
                                                $imageName = $_FILES["image"]["name"];
                                                $imageSize = $_FILES["image"]["size"];
                                                $tmpName = $_FILES["image"]["tmp_name"];

                                                // Image validation
                                                $validImageExtension = ['jpg', 'jpeg', 'png'];
                                                $imageExtension = explode('.', $imageName);
                                                $imageExtension = strtolower(end($imageExtension));
                                                if (!in_array($imageExtension, $validImageExtension)) {
                                                    echo 
                                                    "
                                                    <script>
                                                    alert('Invalid Image Extension');
                                                    document.location.href = '../editInfo.php';
                                                    </script>
                                                    ";
                                                } elseif ($imageSize > 1200000) {
                                                    echo 
                                                    "
                                                    <script>
                                                    alert('Image Size Is Too Large');
                                                    document.location.href = '../editInfo.php';
                                                    </script>";
                                                } else {
                                                    $newImageName = $name . " - " . date("Y.m.d") . " - " . date("h.i.sa"); // Generate new image name
                                                    $newImageName .= '.' . $imageExtension;
                                                    $query = "UPDATE customer SET photo = '$newImageName' WHERE cid = $id";
                                                    mysqli_query($dbConnection, $query);
                                                    move_uploaded_file($tmpName, 'images/user/' . $newImageName);
                                                    echo
                                                    "
                                                    <script>
                                                    document.location.href = '../editInfo.php';
                                                    </script>
                                                    ";
                                                }
                                            }
                                            ?>
                                        <div class="text-light small mt-1">Allowed JPG or PNG.</div>
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
                            <div class="text-right mt-3">
                                <button type="submit" name="save_changes" class="btn btn-primary">Save changes</button>&nbsp;
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
 