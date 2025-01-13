<?php

    function getconnection(){

        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "EMPDB";
        $con = new mysqli($servername, $username, $password, $dbname);
    
        if ($con->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }else{
            return $con;
        }
    }

    function login($username, $password){
        $con = getConnection();
        $sql = "select * from emp where username='{$username}' and password='{$password}'";
        $result = mysqli_query($con, $sql);
        $count =  mysqli_num_rows($result);

        if($count ==1){
            return true;
        }else{
            return false;
        }
    }

    function addUser($name, $contact_no, $password, $username) {
        $con = getConnection();
        $sql = "INSERT INTO emp (employee_name, contact_no, password, username) VALUES ('{$name}', '{$contact_no}', '{$password}', '{$username}')";
        $result = mysqli_query($con, $sql);
        return $result;
    }
    
    function getUserByUsername($username) {
        $con = getConnection();
        $sql = "SELECT * FROM emp WHERE username = '{$username}'";
        $result = mysqli_query($con, $sql);
        return mysqli_fetch_assoc($result);
    }
    
    function checkIfUsernameExists($username) {
        $con = getConnection();
        $sql = "SELECT COUNT(*) AS count FROM emp WHERE username = '{$username}'";
        $result = mysqli_query($con, $sql);
        $data = mysqli_fetch_assoc($result);
        return $data['count'] > 0;
    }
    
    function getAllUsers() {
        $con = getConnection();
        $sql = "SELECT * FROM emp";
        $result = mysqli_query($con, $sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
    
    function searchUsers($searchTerm) {
        $con = getConnection();
        $sql = "SELECT * FROM emp WHERE username LIKE '%{$searchTerm}%'";
        $result = mysqli_query($con, $sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
    
    function updateUser($name, $contact_no, $password, $username) {
        $con = getConnection();
        $sql = "UPDATE emp SET employee_name='{$name}', contact_no='{$contact_no}', password='{$password}' WHERE username='{$username}'";
        return mysqli_query($con, $sql);
    }
    
    function deleteUser($username) {
        $con = getConnection();
        $sql = "DELETE FROM emp WHERE username='{$username}'";
        return mysqli_query($con, $sql);
    }




?>