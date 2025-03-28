<?php
	class Database {
    private $connection;

    public function __construct($host, $username, $password, $database) {
        // Create a new MySQLi object and store the connection in a class variable
        $this->connection = new mysqli($host, $username, $password, $database);

        // Check for connection errors
        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }
    }

    public function query($sql) {
        // Perform the query using the established connection
        return $this->connection->query($sql);
    }

    public function close() {
        // Close the database connection
        $this->connection->close();
    }

    public function prepare($sql) {
        // Prepare a statement using the established connection
        return $this->connection->prepare($sql);
    }
}

