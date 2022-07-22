<?php
require "database/conn.php";

$error = array();

    if (isset($_POST['manage-student-btn'])) {

        $class = trim($_POST['class']);
        $class = stripslashes($class);
        $class = htmlspecialchars($class);

        $sql = "SELECT * FROM users WHERE class = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s', $class);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows > 0){
            echo '
            <table class="table table-responsive">
                <tr>
                  <th>Student Names</th>
                  <th>Action</th>
                </tr>
            ';
            while($rows = $result->fetch_assoc()){
                echo
                '
                <tr>
                        <td>'. $rows['student_names'] .'</td>
                        <td><a href="admin-result-checker.php?unique_id='.$rows['unique_id'].'"><i style="font-size: 1.3rem;" class="bi bi-pencil-square"></i></a><a href="action.php?unique_id='.$rows['unique_id'].'"><i style="font-size: 1.3rem; color: red;" class="bi bi-archive px-3"></i></a></td>
                    </tr>
                ';
            }
            echo '
            </table>
            ';
            
        } elseif(empty($class)){
            $error['user'] = "this field cannot be empty";
        } else{
            $error['user'] = "No student in the database for " . $class;
        }
    }
