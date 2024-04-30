
<!DOCTYPE html>

<html>
<head>

<title> View </title>

    <style>
        body{
            display: flex;
            justify-content: center;
            align-items: center;
           flex-wrap: wrap;
            min-height: 100vh;
            background: #CA95;
        }

        .alb{
            width: 200px;
            height:200px;
            padding: 5px;
        }

        .alb img{
            width: 100%;
            height:100%;
        }

        a{
            text-decoration: none;
            color: black;
        }
    </style>


</head>

<body>
    <!-- <a href="file.php"> &#8592; </a> -->




<?php
$servername = "localhost";
$username = "zscplszw_TOL";
$password = "!@Maya2996";
$dbname = "zscplszw_TOL";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM images ORDER BY id DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
     //   echo "<br> id: ". $row["id"]. " - Name: ". $row["image_url"];?>


    <div class= "alb">
        <img src="gallery/<?=$row['image_url']?>">
        </div>
        <?php
    }
} else {
    echo "0 results";
}

$conn->close();
?>

</body>
</html>