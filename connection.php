<?php
$servername="localhost";
$username="root";
$password="";
$dbname="findmydoctor";


$conn=new mysqli($servername, $username, $password, $dbname);

if($conn){
  //echo "successfully connected";
}else{
    echo"failed to connect".mysqli_error($conn);
}
