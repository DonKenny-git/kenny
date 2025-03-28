

<body style=" background-image:linear-gradient(rgba(0,0,0,0.5),rgba(0,0,0,0.5)), url(abstract-futuristic-background-with-3d-design.jpg);
    background-size: cover;
  background-attachment: fixed;
  background-repeat: no-repeat;">


<div style="margin-bottom: 200px; margin-top: 100px;" class="find">
    <?php
    $db = new mysqli("localhost", "root", "", "bsit");

    if ($db->connect_error) {
        die("Connection failed: " . $db->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Check if the form is submitted and contains data
        if (isset($_POST["search_query"])) {
            $search_query = $_POST["search_query"];

            // You can modify the SQL query to search for both first name and last name
            $result = $db->query("SELECT stid, fname, lname, age FROM students WHERE fname LIKE '%$search_query%' OR lname LIKE '%$search_query%' OR username LIKE '%$search_query%'");

            if ($result && $result->num_rows > 0) {
                // If there are multiple results, you may want to loop through them
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<table>";
                    echo "<tr>";
                    echo "<th>ID</th>";
                    echo "<td>" . $row["stid"] . "</td>";
                    echo "</tr>";
                    echo "<tr>";
                    echo "<th>First Name</th>";
                    echo "<td>" . $row["fname"] . "</td>";
                    echo "</tr>";
                    echo "<tr>";
                    echo "<th>Last Name</th>";
                    echo "<td>" . $row["lname"] . "</td>";
                    echo "</tr>";
                    echo "<tr>";
                    echo "<th>Age</th>";
                    echo "<td>" . $row["age"] . "</td>";
                    echo "</tr>";
                    echo "</table>";
                }
            } else {
                echo "No records found for query: $search_query";
            }
        }
    }
    ?>
</div>
<style>
 /* search database*/
 .find {
              max-width: 800px;
              margin: 50px auto;
              padding: 30px;
              background-color: #E6F7FF; /* Light blue background */
              box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
              font-family: Arial, sans-serif;
              font-size: 18px;
              text-align: center;
              border-radius: 10px;
          }
      
          .find table {
              width: 100%;
              margin-top: 30px;
              border-collapse: collapse;
          }
      
          .find th, .find td {
              border: 1px solid black; /* Lighter blue border */
              padding: 15px;
          }
      
          .find th {
              font-weight: bold;
              background-color: maroon; /* Medium blue background */
              color: #ffffff; /* White text */
          }
          
  
          

</style>