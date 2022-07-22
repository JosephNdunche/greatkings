<?php
session_start();
if(!isset($_SESSION['admin'])){
    header("location: admin-signin.php");
}

?>
<?php
require "admin-header.php"; 
?>

<section class="py-4">
    <h2 class="text-center pt-5">Manage Payment</h2>
<div class="container pt-2">

<?php
require "database/conn.php";
        $sql = "SELECT * FROM payment WHERE verified='0'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows > 0){
            echo '
            <table class="table table-responsive">
                <tr>
                  <th>Parent Id</th>
                  <th>Action</th>
                </tr>
            ';
            while($rows = $result->fetch_assoc()){
                echo
                '
                <tr>
                        <td>'. $rows['parent_id'] .'</td>
                        <td><a href="manage-payment.php?unique_id='.$rows['parent_id'].'"><i style="font-size: 1.3rem;" class="bi bi-pencil-square"></i></a></td>
                    </tr>
                ';
            }
            echo '
            </table>
            ';
            
        }else{
            $error['user'] = "No student in the database for " . $class;
        }
?>

        </div>
</section>

<?php 
require "user-footer.php";  ?>