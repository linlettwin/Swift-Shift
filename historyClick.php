

<?php
session_start();

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

$customer = $_SESSION["customer"];
?>
<!doctype html>
<head> 

<style>
.container{
    display:flex;
    flex-direction:column;
    justify-content:flex-start;
    margin-left:60px;
    margin-right:60px;
    width:auto;
    height:auto;
    
}
.header_section{
    background-color:#7895CB;
    width:100%;
    height:50px;
    text-align:center;
    padding:2px;
    align-items:center;

}

.whole{
    display:flex;
    flex-direction:row;
    justify-content:flex-start;
    padding:10px;
    width:auto;
    height:auto;
    
    
}
h4{
    font-size:18px;
    
   
    max-width:100%;
}
.upper{
    display :flex;
    flex-direction:column;
    justify-content:flex-start;
    padding:20px;
    max-width:50%;
}
.lower{
    display :flex;
    flex-direction:column;
    justify-content:flex-start;
    padding:20px;
    max-width:50%;
  
}
.card{
    width:fit-content;
    height:120px;
    background-color:#D8E5F2;
    margin-top:30px;
    padding:10px;
    border:black;
    border-radius:10px;
}
.btn_receipt{
    float:right;
    margin-right:10px;
    background-color: #F18D65;
    font-weight: bold;
    width:100px;
    height:28px;
    text-decoration:none;
    align-items:center;
    color:black;
    cursor:pointer;
    text-align:center;
    padding:2px;
    border-radius:5px;
    margin-bottom:10px;
    margin-top:10px;
}
.bth{
    background-color: #F18D65;
    font-weight: bold;
    width:100px;
    height:30px;
    text-decoration:none;
    align-items:center;
    color:black;
    cursor:pointer;
    text-align:center;
    padding:3px;
    border-radius:3px;
    margin-left:10px;
   
}
</style>
</head>

<body> 

<?php
try {
    $conn = connect();

    $sql3 = "SELECT numberofseats, pid, GROUP_CONCAT(seatno) AS seatnos, status, screenshot, seen, bpname, bpphone, bdate, btime, bcost, paymethod, special, message 
             FROM btickets 
             WHERE cid = :customer 
             GROUP BY bpname, bdate, btime  
             ORDER BY bdate DESC, btime DESC";

    $stmt = $conn->prepare($sql3);
    $stmt->bindParam(':customer', $customer, PDO::PARAM_INT);
    $stmt->execute();

    $historys = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Query failed: " . $e->getMessage());
}
?>

<div class="container" style="background-color:#e7eef4;">
    <div class="header_section"><h3> View Your History Here  </h3></div>
    <div class="whole">
    <div class="upper" style="background-color:#e7eef4;">
        <div class="bt"><h4>Bus Tickets Section</h4></div>
        <?php 
            foreach($historys as $history)
            {
                $sql4 = "SELECT cg.town AS source, cg.cgaddress AS sourceaddress
                FROM cargate cg, route r, plan p
                WHERE p.rid = r.rid AND r.source = cg.cgid AND p.pid = :pid";

                    try {
                    $conn = connect();

                    // Assuming $history['pid'] contains the value for :pid
                    $stmt = $conn->prepare($sql4);
                    $stmt->bindParam(':pid', $history['pid'], PDO::PARAM_INT);
                    $stmt->execute();

                    // Fetch the result
                    $result = $stmt->fetch(PDO::FETCH_ASSOC);

                    // Assign values to variables
                    $source = $result['source'];
                    $sourceaddress = $result['sourceaddress'];
                    } catch (PDOException $e) {
                    die("Query failed: " . $e->getMessage());
                    }

                
                    $sql5 = "SELECT cg.town AS destination, cg.cgaddress AS destinationaddress
                    FROM cargate cg, route r, plan p
                    WHERE p.rid = r.rid AND r.destination = cg.cgid AND p.pid = :pid";

                    try {
                        $conn = connect();

                        // Assuming $history['pid'] contains the value for :pid
                        $stmt = $conn->prepare($sql5);
                        $stmt->bindParam(':pid', $history['pid'], PDO::PARAM_INT);
                        $stmt->execute();

                        // Fetch the result
                        $result = $stmt->fetch(PDO::FETCH_ASSOC);

                        // Assign values to variables
                        $destination = $result['destination'];
                        $destinationaddress = $result['destinationaddress'];
                    } catch (PDOException $e) {
                        die("Query failed: " . $e->getMessage());
                    }

                    $sql6 = "SELECT ddate, dtime FROM plan WHERE pid = :pid";

                    try {
                        $conn = connect();

                        // Assuming $history['pid'] contains the value for :pid
                        $stmt = $conn->prepare($sql6);
                        $stmt->bindParam(':pid', $history['pid'], PDO::PARAM_INT);
                        $stmt->execute();

                        // Fetch the result
                        $result = $stmt->fetch(PDO::FETCH_ASSOC);

                        // Assign values to variables
                        $ddate = $result['ddate'];
                        $dtime = $result['dtime'];
                        $dateTime = new DateTime("$ddate $dtime");
                        $formattedDateTime = $dateTime->format('j M Y h:ia');
                    } catch (PDOException $e) {
                        die("Query failed: " . $e->getMessage());
                    }

                    
                
                    if(strtolower($history["status"]) == "approved")
                    {
                        echo "<div class='card'>Your booking is successful!! You have booked for {$history['numberofseats']} seats ({$history['seatnos']}) in a travel plan from 
                        $source to $destination which will set out on $formattedDateTime.</br><a href='receipt.php?bpname={$history["bpname"]}&amp;bdate={$history["bdate"]}&amp;btime={$history["btime"]}' class='btn_receipt'>Get Receipt</a>
                        </div>";
                    }

                    if (strtolower($history["status"]) == "disapproved")
                    {
                        echo "<div class='card'>Sorry!! You have booked for {$history['numberofseats']} seats ({$history['seatnos']}) in a travel plan from 
                                $source to $destination which will set out on $formattedDateTime. Your booking is rejected because {$history['message']} 
                                You can contact at swiftshift123@gmail.com or on 09-557849838.
                            </div>";
                    }
                    
            }



            $sql7 = "SELECT * FROM get_cargo_service WHERE cid = :customer ORDER BY gdate DESC, gtime DESC";

            try {
                $conn = connect(); // Assuming connect() is a function that returns a PDO connection
                $stmt = $conn->prepare($sql7);
                
                // Bind the :customer parameter to the $customer variable
                $stmt->bindParam(':customer', $customer, PDO::PARAM_INT);
                
                // Execute the prepared statement
                $stmt->execute();
                
                // Fetch all results
                $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                
            } catch (PDOException $e) {
                die("Query failed: " . $e->getMessage());
            }
        ?>
    </div>

    <div class="line" style=""> </div>
    <div class='lower'>
        <div class='cargo'><h4>Cargo Service Section</h4></div>
        <?php 
                foreach($results as $result)
            {
                    $sql8 = "SELECT cr.cargo_src, cr.cargo_dest 
                    FROM cargo_route cr, get_cargo_service g 
                    WHERE g.crid = cr.crid AND g.gid = :gid";

                    try {
                    $conn = connect(); // Assuming connect() is a function that returns a PDO connection
                    $stmt = $conn->prepare($sql8);

                    // Assuming $result['gid'] contains the value you want to bind to :gid
                    $gid = $result['gid'];

                    // Bind the :gid parameter to the $gid variable
                    $stmt->bindParam(':gid', $gid, PDO::PARAM_STR);

                    // Execute the prepared statement
                    $stmt->execute();

                    // Fetch the first result row
                    $place = $stmt->fetch(PDO::FETCH_ASSOC);

                    if ($place) { // Check if any result was found
                        $cargo_source = $place['cargo_src'];
                        $cargo_destination = $place['cargo_dest'];

                        // Use $cargo_source and $cargo_destination as needed
                    } else {
                        // Handle the case where no matching row was found
                        echo "No results found.";
                    }
                    } catch (PDOException $e) {
                    die("Query failed: " . $e->getMessage());
                    }


                    if(strtolower($result["status"]) == "approved") {
                        // Prepare the date in a variable to avoid complexity within the echo statement
                        $cpdate = $result['cpdate'];
                        
                        echo "<div class='card'>Your booking is successful!! You have booked for a cargo service from " . htmlspecialchars($cargo_source) . " Branch to " . htmlspecialchars($cargo_destination) . " Branch which will set out on " . htmlspecialchars($cpdate) . ".<br>
                       <a href='cargo_receipt.php?gid=" . htmlspecialchars($result["gid"]) . " ' class='btn_receipt'>Get Receipt</a></div>";
                    }
                    

                    if(strtolower($result["status"]) == "disapproved")
                    {
                        // Extracting variables for easier use
                        $cpdate = $result['cpdate'];
                        $message = $result['message'];

                        echo "<div class='card'>Sorry!! You have booked for a cargo service from {$cargo_source} Branch to {$cargo_destination} Branch
                        which will set out on {$cpdate}. Your booking is rejected because {$message} 
                        You can contact us at swiftshift123@gmail.com or on 09-557849838.
                        </div>";
                    }


            }


            $sql1 = "UPDATE btickets SET seen='Yes' WHERE seen='No' AND cid=?";
            $sql2 = "UPDATE get_cargo_service SET seen='Yes' WHERE seen='No' AND cid=?";

            try {
                $conn = connect();
                
                // Prepare and execute the first query
                $stmt1 = $conn->prepare($sql1);
                $stmt1->execute([$customer]);

                // Prepare and execute the second query
                $stmt2 = $conn->prepare($sql2);
                $stmt2->execute([$customer]);

                // Close the connection
                $conn = null;
            } catch (PDOException $e) {
                die("Query failed: " . $e->getMessage());
            }

            ?>
    </div>
    
</div>
<div style="margin-bottom: 20px;">
    <a href="home.php" class="bth">Back to Home</a>
</div>
</div>


<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <style>
        .navbar {
            background-color: #333;
            color: black;
            padding: 10px;
        }
        .navbar img {
            width: 50px;
            height: auto;
            border-radius: 50%;
            margin-right: 10px;
        }
        
        /* Styles for the name card */
        .name-card {
            width: 80%;
            max-width: 500px;
            height: 80%;
            max-height: 400px;
            background-color: #f9f9f9;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            margin: auto; /* Center horizontally */
            position: absolute; /* Position absolute for vertical centering */
            top: 50px; /* Adjust top position based on navbar height */
            bottom: 0; /* Stretch to full height */
            left: 0; /* Stretch to full width */
        }

        .accountIcon {
            width: 100px;
            height:100px;
            border-radius: 50%;
        }

        .info {
            font-size: 16px;
            margin: 10px;
            line-height: 30px;
        }

        .btn {
            font-size: 16px;
            border: 1px solid rgba(37, 168, 244, 0.8);
            background: rgba(37, 168, 244, 0.8);
            border-radius: 8px;
            width: 60px;
            height: 30px;
            margin: 15px;
        }

        a {
            text-decoration: none;
            color: #000;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <img src="img/<?php echo $profile; ?>" alt="Profile Picture">
    </div>

    <div class="name-card">
        <div class="info">
            <div class="num"><strong>Amount of seat Purchased:</strong><?php echo $num; ?></div>
            <div class="seatno"><strong>The seat Purchased: Seat No.</strong><?php echo $seatno; ?></div>
            <div class="bpphone"><strong>Customer Phone Number:</strong><?php echo $bpphone; ?></div>
            <div class="bdate"><strong>Purchased Date:</strong><?php echo $bdate; ?></div>
            <div class="cost"><strong>Amount Purchased:</strong><?php echo $cost; ?></div>
            <div class="paymethod"><strong>Payment Method Used:</strong><?php echo $paymethod; ?></div>
        </div>
        <button class="btn"><a href="clickTest.php">Exit</a></button>
    </div>
</body>
</html> -->
<?php
//          } else {
//             echo "No booking history found for " . $name;
//         }
//     }
//          } catch (PDOException $e) {
//     echo "Error: " . $e->getMessage();
// }
?>
