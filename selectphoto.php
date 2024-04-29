<?php
function connect()
{
    try {
        $conn = new PDO("mysql:dbname=phototest", "root", "");
        $conn->setAttribute(PDO::ATTR_PERSISTENT, true);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn; // Return the connection object
    } catch (PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }
}

$conn = connect();
$sql = "SELECT photo FROM photos WHERE id = 4";

try {
    $stmt = $conn->query($sql);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        $photoFullPath = $result['photo'];
         ?>
      <img src="./images/user/<?php echo $photoFullPath; ?>" width="500" height="500" alt="Photo">
    <?php }
     else {
        echo "No photo found for id = 3";
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}

?>