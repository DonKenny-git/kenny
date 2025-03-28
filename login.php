
<body style=" background-image:linear-gradient(rgba(0,0,0,0.5),rgba(0,0,0,0.5)), url(gsweet-high-resolution-logo.png);
    background-size: cover;
  background-attachment: fixed;
  background-repeat: no-repeat;">

<div class="bg">
<form style=" margin: auto; margin-bottom: 0px; margin-top: 0px; background-color: " action="check_login.php" method="post" class="login-form">
    <h3 style=" color: darkturquoise;" >LogIn Here</h3>
    <input type="text" name="username" class="box" placeholder="Username" /><br /><br />
    <div class="password-container">
        <!-- Password input -->
        <input type="password" name="password" id="password" class="box" placeholder="Password" />

        <!-- Toggle button inside the password input -->
        <button type="button" class="toggle-password-button" onclick="togglePassword()">𓂀</button>
    </div>

  
    <input class="button" type="submit" value=" LogIn "/><br/>
   
</form>
</div>
<?php
$_SESSION['error_msg'] = '';
?>
<script>
 

function test() {
	alert('test');
}


    // Add the function for toggling password visibility
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
        


          max-width: 400px;
                margin: 150px auto;
                padding: 30px;
               
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
                font-family: Arial, sans-serif;
                font-size: 18px;
                text-align: center;
                border-radius: 10px;
            }
</style>