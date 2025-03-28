<?php
// Check for and display error message
$error = '';
if (isset($_SESSION['error_msg'])) {
    $error = $_SESSION['error_msg'];
}
?>

<body style=" background-image:linear-gradient(rgba(0,0,0,0.5),rgba(0,0,0,0.5)), url(gsweet-high-resolution-logo.png);
    background-size: cover;
  background-attachment: fixed;
  background-repeat: no-repeat;">
<div class="bg">
<form style=" margin: auto; margin-bottom: 0px; margin-top: 0px; background-color: ;" action="process_signup.php" method="post" class="signup-form">
    <h3 style=" color: darkturquoise;" >Sign Up Here</h3>
    <input type="text" name="fname" class="box" placeholder="First Name" required /><br /><br />
    <input type="text" name="lname" class="box" placeholder="Last Name" required /><br /><br />
    <input type="text" name="username" class="box" placeholder="Username" required /><br /><br />

    <div class="password-container">
        <!-- Password input -->
        <input type="password" name="password" id="password" class="box" placeholder="Password" required />

        <!-- Toggle button inside the password input -->
        <button type="button" class="toggle-password-button" onclick="togglePassword()">𓂀</button>
    </div>

    <label>Age:</label>
    <input type="number" name="age" class="box" placeholder="Age" required /><br /><br />

    <input class="button" type="submit" value=" Sign Up "/><br/>
    <div style="font-size:11px; color: blue; margin-top:10px"><?php echo $error; ?></div>
</form>
</div>
<?php
$_SESSION['error_msg'] = '';
?>

<script>
    // Function to toggle password visibility
    function togglePassword() {
        var passwordField = document.getElementById("password");
        if (passwordField.type === "password") {
            passwordField.type = "text";
        } else {
            passwordField.type = "password";
        }
    }

</script>


<style>
    .bg {
          
         
          
          max-height: 5000px;
          background-color: rgba(0, 0, 0, 0.7);
        


          max-width: 350px;
                margin: 50px auto;
                padding: 30px;
               
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
                font-family: Arial, sans-serif;
                font-size: 18px;
                text-align: center;
                border-radius: 10px;
            }
</style>