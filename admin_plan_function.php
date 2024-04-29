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
    $sql = "SELECT town FROM cargate";

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
    $sql = "select pid from plan";

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



function getOperator()
{
    $conn = connects();
    $sql_op="SELECT DISTINCT oname FROM  operator";

    try
    {
        $opName = $conn->query($sql_op)->fetchAll(PDO::FETCH_ASSOC);
        return $opName;
    }
    catch (PDOException $e)
    {
        echo "Query failed: " . $e->getMessage();
    }
}

function getBusNo()
{
    $conn = connects();
    $sql_bus="SELECT DISTINCT busno FROM  bus b";

    try
    {
        $busNo = $conn->query($sql_bus)->fetchAll(PDO::FETCH_ASSOC);
        return $busNo;
    }
    catch (PDOException $e)
    {
        echo "Query failed: " . $e->getMessage();
    }
}


//edit plan table



  

?>