<div class="container">
<aside class="sidebar">
    <div id="main">
        <!-- Button to toggle the sidebar -->
        <button class="openbtn" onclick="toggleSidebar()"><i class="fa fa-home"></i></button>
    </div>
   
    <nav>
        <ul>
        <hr style="border:1px solid; background-color:#8a7b6d; border-color:#3B3131;">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()"></a>
    <a href="?page=home" ><i class="fa fa-home"></i> Dashboard</a>
    
    <a style="color: white;" ><i class="fa fa-th"></i> Genre</a>
    <ul class="dropdown-content">
            <li><a href="?page=movie1">Anime</a></li>
            <li><a href="?page=movie2">Kdrama</a></li>
            <li><a href="?page=movie3">Horror</a></li>
         </ul>

<div style="margin-top: 150px;" class="ls">
            <?php  
                if(isset($_SESSION['logged_in'])) {
                    if($_SESSION['logged_in'] == 'yes') {
                        echo '<li><a style="color: red;" href="?page=logout">Logout</a></li>';
                        if ($_SESSION['user_type'] == 'admin') {
                            echo '<li><a style="color: orange;" href="?page=admin">Admin</a></li>';
                        }
                    } else {
                        echo '<li><a href="?page=login">Login</a></li>';
                        echo '<li><a href="?page=signup">Sign Up</a></li>';
                    }
                } else {
                    echo '<li style="bottom:30px;"><a href="?page=login">Login</a></li>';
                    echo '<li><a href="?page=signup">Sign Up</a></li>';
                }
            ?>
</div>
        </ul>
    </nav>
</aside>

<script>
 function toggleSidebar() {
    var sidebar = document.querySelector('.sidebar');
    var mainContent = document.getElementById('main');

    // Get the computed width of the sidebar
    var computedWidth = window.getComputedStyle(sidebar).width;

    if (computedWidth === '250px') {
        sidebar.style.width = '0';
        mainContent.style.marginLeft = '0';
        mainContent.style.position = 'fixed'; // Set position to 'relative' when closing the sidebar
        // Store the state in localStorage when the sidebar is closed
        localStorage.setItem('sidebarState', 'closed');
    } else {
        sidebar.style.width = '250px';
        mainContent.style.marginLeft = '250px';
        mainContent.style.position = 'fixed'; // Set position to 'fixed' when opening the sidebar
        // Store the state in localStorage when the sidebar is open
        localStorage.setItem('sidebarState', 'open');
    }
}

window.onload = function () {
    var storedState = localStorage.getItem('sidebarState');
    var sidebar = document.querySelector('.sidebar');
    var mainContent = document.getElementById('main');

    if (storedState === 'open') {
        sidebar.style.width = '250px';
        mainContent.style.marginLeft = '250px';
        mainContent.style.position = 'fixed'; // Set position to 'fixed' when loading with open sidebar
    } else {
        sidebar.style.width = '0';
        mainContent.style.marginLeft = '0';
        mainContent.style.position = 'fixed'; // Set position to 'relative' when loading with closed sidebar
    }
};
</script>
</div>