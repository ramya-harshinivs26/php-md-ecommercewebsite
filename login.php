<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $input_username = $_POST["username"];
    $input_password = $_POST["password"];

    // Connect to the database
    $host = "localhost";
    $dbname = "logindb";
    $username_db = "root";
    $password_db = "";

    try {
        $db = new PDO(
            "mysql:host=$host;dbname=$dbname",
            $username_db,
            $password_db
        );
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Check if the user exists in the database
        $stmt = $db->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->bindParam(":username", $input_username);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // Verify the password
            if (password_verify($input_password, $user["password"])) {
                session_start();
                $_SESSION["user"] = $user;

                echo '<script type="text/javascript">
                    window.onload = function () {
                        alert("Welcome to Moo Dairy Shop website");
                        window.location.href = "index.html";  
                    };
                </script>';
            } else {
                echo "<h2>Login Failed</h2>";
                echo "Invalid username or password.";
            }
        } else {
            echo "<h2>Login Failed</h2>";
            echo "User doesn't exist.";
        }
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
}
?>


