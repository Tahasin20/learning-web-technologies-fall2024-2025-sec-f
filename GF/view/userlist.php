<?php
    require_once('../model/userModel.php');
    $users = getAllUsers();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>User List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        a {
            text-decoration: none;
            color: #007BFF;
            margin-right: 10px;
        }

        a:hover {
            text-decoration: underline;
        }

        .container {
            max-width: 1000px;
            margin: 20px auto;
            background: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .action-links a {
            margin-right: 5px;
            color: #4CAF50;
        }

        .action-links a:hover {
            color: #f44336;
        }
    </style>
</head>
<body>
    <h2>Search Users</h2>
    <input type="text" id="search" placeholder="Type username to search..." style="padding: 20px 45%; margin-left: 10px;" />
    <div id="results"></div>

    <form id="updateForm" style="display:none;">
        <input type="hidden" id="updateUsername" />
        <input type="text" id="updateName" placeholder="Name" required />
        <input type="text" id="updateContactNo" placeholder="Contact No" required />
        <input type="password" id="updatePassword" placeholder="Password" required />
        <button type="submit">Update User</button>
    </form>
    <div class="container">
        <h2>User List</h2>

        <table>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>Gender</th>
                <th>Date of Birth</th>
                <th>Contact No</th>
                <th>Address</th>
                <th>Category</th>
                <th>Action</th>
            </tr>
            <?php 
            if (count($users) > 0) {
                foreach ($users as $user) {
            ?>
            <tr>
                <td><?php echo $user['id']; ?></td>
                <td><?php echo htmlspecialchars($user['username']); ?></td>
                <td><?php echo htmlspecialchars($user['email']); ?></td>
                <td><?php echo htmlspecialchars($user['gender']); ?></td>
                <td><?php echo htmlspecialchars($user['dob']); ?></td>
                <td><?php echo htmlspecialchars($user['contactno']); ?></td>
                <td><?php echo htmlspecialchars($user['address']); ?></td>
                <td><?php echo htmlspecialchars($user['catagory']); ?></td>
                <td class="action-links">
                    <a href="editUser.php?id=<?php echo $user['id']; ?>">EDIT</a> |
                    <a href="deleteUser.php?id=<?php echo $user['id']; ?>" onclick="return confirm('Are you sure you want to delete this user?');">DELETE</a>
                </td>
            </tr>
            <?php 
                }
            } else {
                echo "<tr><td colspan='9'>No users found.</td></tr>";
            }
            ?>
        </table>

        <script>
            document.getElementById('search').addEventListener('input', function () {
            const searchTerm = this.value.trim();
            if (!searchTerm) {
                document.getElementById('results').innerHTML = '';
                return;
            }
            const xhttp = new XMLHttpRequest();
            xhttp.open('POST', '../controller/search.php', true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.onreadystatechange = function () {
                if (this.readyState === 4 && this.status === 200) {
                    document.getElementById('results').innerHTML = this.responseText;
                }
            };
            xhttp.send("search=" + encodeURIComponent(searchTerm));
        });

        document.getElementById('updateForm').addEventListener('submit', function (e) {
            e.preventDefault();
            const username = document.getElementById('updateUsername').value;
            const contactNo = document.getElementById('updateContactNo').value;
            const password = document.getElementById('updatePassword').value;

            const xhttp = new XMLHttpRequest();
            xhttp.open('POST', '../controller/update.php', true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.onreadystatechange = function () {
                if (this.readyState === 4 && this.status === 200) {
                    alert(this.responseText);
                    document.getElementById('updateForm').reset();
                    document.getElementById('updateForm').style.display = 'none';
                    document.getElementById('results').innerHTML = '';
                }
            };
            xhttp.send(`username=${encodeURIComponent(username)}&contactno=${encodeURIComponent(contactNo)}&password=${encodeURIComponent(password)}`);
        });

        function updateUser(username) {
            const xhttp = new XMLHttpRequest();
            xhttp.open('POST', '../controller/get_user.php', true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.onreadystatechange = function () {
                if (this.readyState === 4 && this.status === 200) {
                    const user = this.responseText.split(',');
                    document.getElementById('updateUsername').value = user[0].split(':')[1].trim();
                    document.getElementById('updateContactNo').value = user[2].split(':')[1].trim();
                    document.getElementById('updatePassword').value = user[3].split(':')[1].trim();
                    document.getElementById('updateForm').style.display = 'block';
                }
            };
            xhttp.send(`username=${encodeURIComponent(username)}`);
        }

        function deleteUser(username) {
            const xhttp = new XMLHttpRequest();
            xhttp.open('POST', '../controller/delete.php', true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.onreadystatechange = function () {
                if (this.readyState === 4 && this.status === 200) {
                    alert(this.responseText);
                    document.getElementById('results').innerHTML = '';
                }
            };
            xhttp.send(`username=${encodeURIComponent(username)}`);
        }
            </script>
    </div>
</body>

</html>
<?php
} else {
    header('location: login.html');
}
?>