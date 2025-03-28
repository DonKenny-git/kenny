<style>
/* display styles */
.display {
    max-width: 1200px;
    margin: 50px auto;
    padding: 30px;
    background-color: #ffffff;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    font-family: Arial, sans-serif;
    font-size: 18px;
    text-align: center;
    border-radius: 10px;
}

.display table {
    width: 100%;
    margin-top: 30px;
    border-collapse: collapse;
}

.display th,
.display td {
    border: 1px solid #ddd;
    padding: 15px;
}

.display th {
    font-weight: bold;
    background-color: #3498db;
    color: #ffffff;
}

/* Styles for the search form */
.search-form {
    margin-top: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.search-form input {
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 5px;
    width: 300px;
}

.search-form button {
    padding: 10px 20px;
    background-color: #3498db;
    color: #ffffff;
    border: none;
    border-radius: 5px;
    margin-left: 10px;
    cursor: pointer;
}

.search-form button:hover {
    background-color: #2980b9;
}

.edit-button {
    padding: 8px;
    background-color: #4CAF50;
    color: #fff;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

.edit-button:hover {
    background-color: #45a049;
}

.modal {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    justify-content: center;
    align-items: center;
}

.modal-content {
    background-color: #ffffff;
    padding: 20px;
    border-radius: 8px;
    max-width: 500px;
    width: 100%;
    box-sizing: border-box;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    position: relative;
}

.close-button {
    background-color: #e74c3c;
    color: #ffffff;
    border: none;
    padding: 5px 10px;
    border-radius: 4px;
    cursor: pointer;
    position: absolute;
    top: 10px;
    right: 10px;
}

.close-button:hover {
    background-color: #c0392b;
}

/* Style for form inputs */
#editForm label {
    display: block;
    margin-top: 10px;
}

#editForm input {
    width: 100%;
    padding: 8px;
    margin-top: 5px;
    box-sizing: border-box;
}

#saveChangesBtn {
    background-color: #4CAF50;
    color: #fff;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    margin-top: 15px;
    cursor: pointer;
    transition: background-color 0.3s;
}

#saveChangesBtn:hover {
    background-color: #45a049;
}

/* Styles for the delete button */
.delete-button {
    padding: 8px;
    background-color: #e74c3c;
    color: #fff;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    margin: 10px;
}

.delete-button:hover {
    background-color: #c0392b;
}
</style>

<body style="background-image:linear-gradient(rgba(0,0,0,0.5),rgba(0,0,0,0.5)), url(gsweet-high-resolution-logo.png);
    background-size: cover;
    background-attachment: fixed;
    background-repeat: no-repeat;">

<div class="display">
    <form action="?page=find" method="post" class="search-form">
        <input type="text" name="search_query" placeholder="User ID">
        <button type="submit">Search</button>
    </form>
    <div id="editModal" class="modal">
        <div class="modal-content">
            <span class="close-button" onclick="closeModal()">X</span>
            <h2>Edit User</h2>
            <form id="editForm">
                <label for="editFirstName">First Name:</label>
                <input type="text" id="editFirstName" name="editFirstName">

                <label for="editLastName">Last Name:</label>
                <input type="text" id="editLastName" name="editLastName">

                <label for="editUsername">Username:</label>
                <input type="text" id="editUsername" name="editUsername">

                <label for="editPassword">Password:</label>
                <input type="text" id="editPassword" name="editPassword">

                <!-- Add id="saveChangesBtn" to the button -->
                <button type="button" id="saveChangesBtn" onclick="saveChanges()">Save Changes</button>
                <!-- Add hidden input for user_id -->
                <input type="hidden" id="editUserId" name="editUserId">
            </form>
        </div>
    </div>

    <?php
    $db = new mysqli("localhost", "root", "", "bsit");

    if ($db->connect_error) {
        die("Connection failed: " . $db->connect_error);
    }

    $result = $db->query("SELECT stid, fname, lname, username, password FROM students");

    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr>";
        echo "<th>First Name</th>";
        echo "<th>Last Name</th>";
        echo "<th>Username</th>";
        echo "<th>Password</th>";
        echo "<th>Action</th>"; // Add a new column header for actions
        echo "</tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["fname"] . "</td>";
            echo "<td>" . $row["lname"] . "</td>";
            echo "<td>" . $row["username"] . "</td>";
            echo "<td>" . $row["password"] . "</td>";

            echo "<td><button class='edit-button' onclick='editRow(" . json_encode($row) . ")'>Edit</button></td>";
            echo "<td><button class='delete-button' onclick='deleteRow(" . $row["stid"] . ")'>Delete</button></td>";

            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "No records found.";
    }

    $db->close();
    ?>
</div>

<script>
    function editRow(rowData) {
        // Populate the modal form with the data from rowData
        document.getElementById('editFirstName').value = rowData.fname;
        document.getElementById('editLastName').value = rowData.lname;
        document.getElementById('editUsername').value = rowData.username;
        document.getElementById('editPassword').value = rowData.password;

        // Set the user_id to the hidden field
        document.getElementById('editUserId').value = rowData.stid;

        // Show the modal
        document.getElementById('editModal').style.display = 'flex';
    }

    function closeModal() {
        // Close the modal
        document.getElementById('editModal').style.display = 'none';
    }

    function saveChanges() {
        // Get the user ID from the hidden field
        const userId = document.getElementById('editUserId').value;

        // Get the updated data from the form
        const updatedFirstName = document.getElementById('editFirstName').value;
        const updatedLastName = document.getElementById('editLastName').value;
        const updatedUsername = document.getElementById('editUsername').value;
        const updatedPassword = document.getElementById('editPassword').value;

        // Make an AJAX request to update the data
        fetch('update_display.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `stid=${userId}&fname=${updatedFirstName}&lname=${updatedLastName}&username=${updatedUsername}&password=${updatedPassword}`,
        })
        .then(response => response.text())
        .then(data => {
            // Handle the response, e.g., close the modal or show a success message
            console.log(data);
            closeModal();

            // Reload the page after changes are saved
            location.reload();
        })
        .catch(error => {
            console.error('Error updating data:', error);
        });
    }

    function deleteRow(userId) {
        if (confirm("Are you sure you want to delete this user?")) {
            // Make an AJAX request to delete the data
            fetch('delete_user.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `stid=${userId}`,
            })
            .then(response => response.text())
            .then(data => {
                // Handle the response, e.g., show a success message
                console.log(data);

                // Reload the page after deletion
                location.reload();
            })
            .catch(error => {
                console.error('Error deleting user:', error);

                // Add an alert or other notification for the user
                alert('Error deleting user. Please try again.');
            });
        }
    }
</script>