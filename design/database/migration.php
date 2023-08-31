<?php


$conn = mysqli_connect("localhost","root","","todoapp");
if(!$conn){
    echo "not connected"."<br>" ;
}
// $sql="DROP DATABASE  todoapp";
$sql="CREATE TABLE if not exists tasks(
`id` INT PRIMARY KEY AUTO_INCREMENT,
`title` VARCHAR(200) NOT NULL 


)";

$result= mysqli_query($conn,$sql);
echo mysqli_error($conn);
mysqli_close($conn);



echo "<pre>";
var_dump($conn); 
