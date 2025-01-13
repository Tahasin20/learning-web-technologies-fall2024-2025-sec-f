<?php
require('../Model/usermodel.php');

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
?>
