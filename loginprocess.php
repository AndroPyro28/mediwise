<?php
include 'connectMySQL.php';

if (isset($_POST['LOGIN'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    if (empty($username) || empty($password)) {
        // Display error message if username or password is empty
        echo "<script src='dist/js/sweetalert2.all.min.js'></script>
           <body onload='error()'></body>
           <script> 
           function error(){
           Swal.fire({
                icon: 'error',
                title: 'Login failed!'
           })
           }</script>";
        include 'login.php';
    } else {

        if($role === 'Admin') {
        $query = "SELECT * FROM admin WHERE username = '$username' AND  password = '$password' AND status = 'ACTIVE'";
        $result = $conn->query($query);

        if ($result->num_rows > 0) 
        {
            while ($row = $result->fetch_assoc()) 
            {
                $user_id = $row['admin_id'];
                $username = $row['username'];
                $password = $row['password'];
                $first_name = $row['first_name'];
                $middle_name = $row['middle_name'];
                $last_name = $row['last_name'];
                $email_address = $row['email_address'];
                $contact_number = $row['contact_number'];

                session_start();
                $_SESSION['user_id'] = $user_id;
                $_SESSION['username'] = $username;
                $_SESSION['password'] = $password;
                $_SESSION['first_name'] = $first_name;
                $_SESSION['middle_name'] = $middle_name;
                $_SESSION['last_name'] = $last_name;
                $_SESSION['email_address'] = $email_address;
                $_SESSION['contact_number'] = $contact_number;
                $_SESSION['role'] = $role;

                header('location:admin/');
            }
        }
    }

    if($role === 'Doctor') {
        $query = "SELECT * FROM doctor WHERE username = '$username' AND  password = '$password' AND status = 'ACTIVE'";
        $result = $conn->query($query);

        if ($result->num_rows > 0) 
        {
            while ($row = $result->fetch_assoc()) 
            {
                $user_id = $row['doctor_id'];
                $username = $row['username'];
                $password = $row['password'];
                $first_name = $row['first_name'];
                $middle_name = $row['middle_name'];
                $last_name = $row['last_name'];

                session_start();
                $_SESSION['user_id'] = $user_id;
                $_SESSION['username'] = $username;
                $_SESSION['password'] = $password;
                $_SESSION['first_name'] = $first_name;
                $_SESSION['middle_name'] = $middle_name;
                $_SESSION['last_name'] = $last_name;
                $_SESSION['role'] = $role;
                header('location:doctor/');
            }
        }
    }

     // if($role === 'Doctor') {

    //     $query = "SELECT * FROM patient WHERE username = '$username' AND  password = '$password' AND status = 'ACTIVE'";
    //     $result = $conn->query($query);

    //     if ($result->num_rows > 0) 
    //     {
    //         while ($row = $result->fetch_assoc()) 
    //         {
    //             $user_id = $row['patient_id'];
    //             $username = $row['username'];
    //             $password = $row['password'];
    //             $first_name = $row['first_name'];
    //             $middle_name = $row['middle_name'];
    //             $last_name = $row['last_name'];
    //             $email_address = $row['email_address'];
    //             $contact_number = $row['contact_number'];

    //             session_start();
    //             $_SESSION['user_id'] = $user_id;
    //             $_SESSION['username'] = $username;
    //             $_SESSION['password'] = $password;
    //             $_SESSION['first_name'] = $first_name;
    //             $_SESSION['middle_name'] = $middle_name;
    //             $_SESSION['last_name'] = $last_name;
    //             $_SESSION['email_address'] = $email_address;
    //             $_SESSION['contact_number'] = $contact_number;
    //             $_SESSION['role'] = $role;
    //             header('location:user/');
    //         }
    //     }
    // }


        echo "<script src='dist/js/sweetalert2.all.min.js'></script>
           <body onload='error()'></body>
           <script> 
           function error(){
           Swal.fire({
                icon: 'error',
                title: 'Login failed!'
           })
           }</script>";
        include 'login.php';
    }
}
?>
