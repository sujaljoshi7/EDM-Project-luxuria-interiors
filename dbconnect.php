<?php 
$server = "localhost";
$user = "root";
$password = "";
$db = "luxuria interiors";
$conn = mysqli_connect($server,$user,$password,$db);
if($conn){
    
}
else{
    ?>
    <script> 
    alert("Not Connected With DataBase");
    </script>
<?php
  
}