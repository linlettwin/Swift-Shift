<?php
if (!function_exists('connects'))
{
    function connects()
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
}


function getTownNames()
{
    $conn = connects();
    $sql = "SELECT cgid, town FROM cargate";

    try
    {
        $townNames = $conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        return $townNames;
    }
    catch (PDOException $e)
    {
        echo "Query failed: " . $e->getMessage();
    }
}

function checkUnique()
{
    $conn = connects();
    $sql = "select rid, source, destination from route";

    try
    {
        $sdus = $conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        return $sdus;
    }
    catch (PDOException $e)
    {
        echo "Query failed: " . $e->getMessage();
    }

}

function townsearch($search)
{
    $conn = connects();
    $sql = "select cgid from cargate where town like '%$search%'";

    try
    {
        $townsearchs = $conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        return $townsearchs;
    }
    catch (PDOException $e)
    {
        echo "Query failed: " . $e->getMessage();
    }
}

?>