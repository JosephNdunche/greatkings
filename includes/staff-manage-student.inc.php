<?php
require "database/conn.php";

$error = array();

$class = $_SESSION['class'];

        $sql = "SELECT * FROM users WHERE class = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s', $class);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows > 0){
            echo '
            <p class="text-danger">Note: you can only manage '.$_SESSION['class'].' class as their class teacher.</p>
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
                        <td><a href="action.php?unique_id='.$rows['unique_id'].'"><i style="font-size: 1.3rem;" class="bi bi-pencil-square"></i></a><a href="action.php?unique_id='.$rows['unique_id'].'"><i style="font-size: 1.3rem; color: red;" class="bi bi-archive px-3"></i></a></td>
                    </tr>
                ';
            }
            echo '
            </table>
            ';
            
        }else{
            $error['user'] = "No student in the database for " . $_SESSION['class'];
        }
