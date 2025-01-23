<?php
    session_start();
    if(isset($_COOKIE['flag'])){
    require_once('../model/userModel.php');
    $username  =  $_SESSION['username'];
    $row = getUserInfo($username);
?>

<html>
<head>
    <title>Profile Management</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f9f0;
            color: #2f4f2f;
            margin: 0;
            padding: 0;
        }
        h1 {
            text-align: center;
            color: #2e8b57;
        }
        form {
            max-width: 600px;
            margin: 20px auto;
            background: #ffffff;
            border: 1px solid #ccc;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        td {
            padding: 10px;
            vertical-align: middle;
        }
        label {
            font-weight: bold;
        }
        input[type="text"], input[type="file"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #2e8b57;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #3cb371;
        }
        .profile-image {
            text-align: center;
            margin-bottom: 20px;
        }
        .profile-image img {
            border-radius: 50%;
            border: 3px solid #2e8b57;
            height: 100px;
        }
    </style>
</head>
<body>
    <h1>Profile Management</h1>
    <form method="post" action="../controller/updateUserInfo.php" enctype="multipart/form-data">
        <div class="profile-image">
            <img src="<?php echo '../Images/Users/'.$row['image'] ?>" alt="Profile Picture">
        </div>
        <table>
            <tr>
                <td><label for="name">Username:</label></td>
                <td><input type="text" id="name" name="username" value="<?php echo $row['username'] ?>" required /></td>
            </tr>
            <tr>
                <td><label for="password">Password:</label></td>
                <td><input type="text" id="password" name="password" value="<?php echo $row['password'] ?>" required /></td>
            </tr>
            <tr>
                <td><label for="email">Email:</label></td>
                <td><input type="text" id="email" name="email" value="<?php echo $row['email'] ?>" required /></td>
            </tr>
            <tr>
                <td><label for="gender">Gender:</label></td>
                <td><input type="text" id="gender" name="gender" value="<?php echo $row['gender'] ?>" required /></td>
            </tr>
            <tr>
                <td><label for="dob">Date of Birth:</label></td>
                <td><input type="date" name="dob" value="<?php echo $row["dob"] ?>" required /></td>
            </tr>
            <tr>
                <td><label for="contactno">Phone Number:</label></td>
                <td><input type="text" name="contactno" value="<?php echo $row["contactno"] ?>" required pattern="\d{11}" title="Please enter a valid 11-digit phone number" /></td>
            </tr>
            <tr>
                <td><label for="address">Address:</label></td>
                <td><input id="address" name="address" value="<?php echo $row["address"] ?>" ></td>
            </tr>
            <tr>
                <td><label for="profilePic">Profile Picture:</label></td>
                <td><input type="file" id="profilePic" name="profilePic" /></td>
            </tr>
        </table>
        <div style="text-align: center;">
            <input type="submit" name="submit" value="Update Profile">
        </div>
    </form>
</body>
</html>

<?php
    } else {
        header('location: ../view/signIn.html');
    }
?>
