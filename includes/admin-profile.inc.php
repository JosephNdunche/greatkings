<?php
 require_once "database/conn.php";
 $admin_id = $_SESSION['admin'];
 $sql = "SELECT * FROM admin WHERE unique_id = ?";
 $stmt = $conn->prepare($sql);
 $stmt->bind_param('s', $admin_id);
 $stmt->execute();
 $result = $stmt->get_result();
 if($result->num_rows > 0){
 $row = $result->fetch_assoc();
 $state_of_origin = $row['state_of_origin'];
 $date_of_birth = $row['date_of_birth'];
 $address = $row['home_address'];
 
 } else{
   echo "No data";
 }

 ?>