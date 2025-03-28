# GSweetFlix

A streaming platform for anime and movies, built with PHP and MySQL.

## Features

- User authentication (login/signup)
- Movie browsing and searching
- User profiles
- Admin panel for content management
- Responsive design

## Requirements

- PHP 7.4 or higher
- MySQL 5.7 or higher
- Apache/Nginx web server
- XAMPP (recommended for local development)

## Installation

1. Clone the repository:
```bash
git clone https://github.com/DonKenny-git/kenny.git
```

2. Set up your web server (XAMPP recommended)
3. Import the database schema from the `database` folder
4. Configure your database connection in `connection.php`
5. Access the website through your web server

## Deployment on InfinityFree (Free PHP Hosting)

1. Create an account on [InfinityFree](https://infinityfree.com/)
2. Choose a free subdomain or connect your own domain
3. From the control panel, go to the File Manager
4. Upload and extract the project files to the public_html directory
5. Go to MySQL/Database section and create a new database
6. Import the bsit.sql file using phpMyAdmin
7. Update connection.php with your InfinityFree database credentials:
   ```php
   $host = "sql.infinityfree.com";
   $user = "epiz_username"; // Your InfinityFree database username
   $password = "your_password"; // Your database password
   $db = "epiz_database_name"; // Your database name
   ```
8. Your site should now be accessible at your chosen subdomain (e.g., yoursite.infinityfree.net)

## Hosting Notes

This is a PHP application and cannot be directly hosted on GitHub Pages, which only supports static websites (HTML, CSS, JavaScript). To properly host this application, consider these options:

1. **Local Development**: Use XAMPP, WAMP, or MAMP to run the site locally
2. **Web Hosting Services**: Use a PHP-compatible web hosting service like:
   - Hostinger
   - InfinityFree
   - 000webhost
   - HelioHost
   - Heroku (with PHP buildpack)

3. **Traditional Web Hosting**: Any hosting provider that supports PHP and MySQL

## License

This project is licensed under the MIT License - see the LICENSE file for details. 