<?php
    session_start();
    require_once('../Model/usermodel.php');
    $conn = getconnection();


    if(isset($_POST['register'])) {
        $name = $_POST['name'];
        $contact = $_POST['contact'];
        $username = $_POST['username'];
        $password = $_POST['password'];
    
        if(empty($name) || empty($contact) || empty($username) || empty($password)) {
            echo "All fields are required.";
        } else {
            addUser($name, $contact, $password, $username);
            header('location: ../View/login.html');
        }
    }

    if(isset($_POST['Login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
    
        if(empty($username) || empty($password)) {
            echo "All fields are required.";
        } else {
            $status = login($username, $password);
            if ($status){
                $_SESSION['username'] = $username;
                header('location: ../View/dashboard.html');
            }else {
                echo "Error: " . $conn->error;
            }
        }
    
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = $_POST['username'];
        $user = getUserByUsername($username);
        if ($user) {
            echo "username:{$user['username']},name:{$user['name']},contact_no:{$user['contact_no']},password:{$user['password']}";
        } else {
            echo "User not found";
        }
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $searchTerm = $_POST['search'];
        $users = searchUsers($searchTerm);
    
        if (!empty($users)) {
            foreach ($users as $user) {
                echo "<div>
                        <p><strong>Name:</strong> {$user['employee_name']}</p>
                        <p><strong>Username:</strong> {$user['username']}</p>
                        <p><strong>Contact No:</strong> {$user['contact_no']}</p>
                        <p><strong>Password:</strong> {$user['password']}</p>
                        <button onclick='updateUser(\"{$user['username']}\")'>Update</button>
                        <button onclick='deleteUser(\"{$user['username']}\")'>Delete</button>
                      </div><hr>";
            }
        } else {
            echo "No results found!";
        }
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = $_POST['username'];
        $name = $_POST['name'];
        $contact_no = $_POST['contact_no'];
        $password = $_POST['password'];
    
        $result = updateUser($name, $contact_no, $password, $username);
        if ($result) {
            echo "User updated successfully!";
        } else {
            echo "Error updating user.";
        }
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = $_POST['username'];
        $result = deleteUser($username);
        if ($result) {
            echo "User deleted successfully!";
        } else {
            echo "Error deleting user.";
        }
    }

    if(isset($_POST['logout'])) {
        unset($_SESSION['flag']);
        session_destroy();
        header('location: ../View/login.html');
}

    
?>