<?php

include "DataObject.class.php";

class showPlan extends DataObject
{
    protected $data = array(
        "pid" => "",
        "oname" => "",
        "duration" => "",
        "cost" => "",
        "busno" => "",
        "ddate" => "",
        "dtime" => "",
        "ophoto" => ""
    );

    public function getSourceid($source)
    {
        $conn = parent::connect();
        $sql = "select cgid, cgaddress from cargate where town='$source'";

        try
        {
            $rows = $conn->query($sql);
            $sourceid = '';
            $sourceaddress = '';
            foreach( $rows as $row )
            {
                $sourceid = $row["cgid"];
                $sourceaddress = $row["cgaddress"];
            }
            parent::disconnect($conn);
            return array($sourceid, $sourceaddress);
        }
        catch(PDOException $e)
        {
            die( "query failed: " . $e->getMessage() );
        }
    }


    public function getDestinationid($destination)
    {
        $conn = parent::connect();
        $sql = "select cgid, cgaddress from cargate where town='$destination'";

        try
        {
            $rows = $conn->query($sql);
            $destinationid = '';
            $destinationaddress = '';
            foreach( $rows as $row )
            {
                $destinationid = $row["cgid"];
                $destinationaddress = $row["cgaddress"];
            }
            parent::disconnect($conn);
            return array($destinationid, $destinationaddress);
        }
        catch(PDOException $e)
        {
            die( "query failed: " . $e->getMessage() );
        }
    }


    public function getPlans($source, $destination, $date, $time)
    {
        if($time == "Morning")
        {
            $start = "5:0:0";
            $end = "12:0:0";
        }
        else if($time == "Afternoon")
        {
            $start = "12:0:0";
            $end = "18:0:0";
        }
       

        $conn = parent::connect();


        
        if ($time == "Night")
        {
            $sql = "SELECT p.pid, o.oname, r.duration, co.cost, p.busno, p.ddate, p.dtime, o.ophoto 
                    FROM operator o, bus b, route r, cost co, plan p 
                    WHERE p.ddate = '$date' 
                    AND ((p.dtime >= '18:0:0' AND p.dtime <= '23:59:59') OR (p.dtime >= '0:0:0' AND p.dtime <= '4:59:59'))
                    AND r.source = '$source' 
                    AND r.destination = '$destination' 
                    AND r.rid = p.rid 
                    AND p.busno = b.busno 
                    AND b.oid = o.oid 
                    AND p.rid = co.rid 
                    AND o.oid = co.oid
                    ORDER BY p.dtime";
        }
        else
        {
            $sql = "SELECT p.pid, o.oname, r.duration, co.cost, p.busno, p.ddate, p.dtime, o.ophoto 
            FROM operator o, bus b, route r, cost co, plan p 
            WHERE p.ddate = '$date' 
            AND (p.dtime >= '$start' AND p.dtime <= '$end')
            AND r.source = '$source' 
            AND r.destination = '$destination' 
            AND r.rid = p.rid 
            AND p.busno = b.busno 
            AND b.oid = o.oid 
            AND p.rid = co.rid 
            AND o.oid = co.oid
            ORDER BY p.dtime";
        }
        
        try
        {
            $rows = $conn->query($sql);

            $plans = array();
            foreach($rows as $row)
            {
                $plans[] = new showPlan($row);
            }

            parent::disconnect($conn);
            return $plans;
            
        }catch(PDOException $e)
        {
            die( "query failed: " . $e->getMessage() );
        }

    }
    
}

?>