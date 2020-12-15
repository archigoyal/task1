<!DOCTYPE html>
<html>
<head>
<title>Form site</title>
</head>
<body>
<form method="post" action="connect.php">
    Source:
Source Database : <input type="text" name="SourceDB"><br><br>
Source Table : <input type="text" name="SourceTB"><br><br>
Destination:
Destination Database : <input type="text" name="DestinationDB"><br><br>
Destination Table : <input type="text" name="DestinationTB"><br><br>
<input type="submit" value="Submit">
<p>
    <?php
$SourceDB = filter_input(INPUT_POST, 'SourceDB');
$SourceTB = filter_input(INPUT_POST, 'SourceTB');

$DestinationDB = filter_input(INPUT_POST, 'DestinationDB');
$DestinationTB = filter_input(INPUT_POST, 'DestinationTB');


if (!empty($SourceDB)&& !empty($SourceTB)){
if (!empty($DestinationDB)&& !empty($DestinationTB)){
    $host = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbname = $SourceDB;
    $count1=0; $count2=0;
    // Create connection
    $conn = new mysqli ($host, $dbusername, $dbpassword, $dbname);



    if (mysqli_connect_error()){
        die('Connect Error ('. mysqli_connect_errno() .') '
        . mysqli_connect_error());
    }
    else{
        $sql = "SELECT COUNT(*) as total FROM ". $SourceTB;


        if ($conn->query($sql)){
        //echo "New record is inserted sucessfully";
        $result=$conn->query($sql);
        $count1= mysqli_fetch_assoc($result);
        }
        else{
        echo "Error: ". $sql ."
        ". $conn->error;
        }
      //  $conn->close();
    }

  //////////////////////////////////////////////////////////////////////////


    $dbname = $DestinationDB;
    $conn = mysqli_connect($host, $dbusername, $dbpassword, $dbname);



    if (mysqli_connect_error()){
        die('Connect Error ('. mysqli_connect_errno() .') '
        . mysqli_connect_error());
    }
    else{
        $sql = "SELECT COUNT(*) as total FROM ". $DestinationTB;

        //echo $DestinationDB . $DestinationTB ;
        if ($conn->query($sql)){
            $result=($conn->query($sql));
           // $count2=$conn->query($sql);
          $count2= mysqli_fetch_assoc($result);
        //echo "New record is inserted sucessfully".  $count2['total'];
        echo "COUNT:". $count1['total'] - $count2['total'];
        

        }
        else{
        echo "Error: ". $sql ."
        ". $conn->error;
        }
        $conn->close();
    }

    
   
}

}

?>
</p>
</form>
</body>
</html>