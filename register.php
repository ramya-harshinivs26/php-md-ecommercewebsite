
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    
    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    $host = "localhost";
    $dbname = "logindb";
    $username_db = "root";
    $password_db = "";

    try {
        $db = new PDO("mysql:host=$host;dbname=$dbname", $username_db, $password_db);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Insert the user into the database
        $stmt = $db->prepare("INSERT INTO users (name, username, email, password) VALUES (:name, :username, :email, :password)");
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":password", $hashed_password);
        $stmt->execute();
        
        echo "<h2>Registration Successful</h2>";
        echo "Thank you for registering, " . $name . "!<br>";
        echo "You'll be redirected to the login page in 3 seconds";
        header("Location: login.html");
        exit();
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
    
}
?>



<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_BCRYPT);

    // Database connection details
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

        // Insert user into the database
        $stmt = $db->prepare("INSERT INTO users (username, password, email) VALUES (:username, :password, :email)");
        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":password", $password);
        $stmt->bindParam(":email", $email);
        $stmt->execute();

        echo "User registered successfully.";
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
}
?>
