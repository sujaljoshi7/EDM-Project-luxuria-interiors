<?php
include '../dbconnect.php';
$id=$_POST['c_id'];

// Debugging: Log received data

$sql="select * from sub_categories where c_id='$id'";
$result = $conn->query($sql);
$subcategories = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $subcategories[] = $row;
    }
}
echo json_encode($subcategories);

?>
