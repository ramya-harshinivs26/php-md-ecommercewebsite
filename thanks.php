<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You - Moo Dairy Shop</title>
    <style>
        body {
            background-color: #f2f2f2;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            text-align: center;
        }

        header {
            background-color: #0073e6;
            color: #ffffff;
            width: 100%;
            padding: 10px 0;
            position: fixed;
            top: 0;
            left: 0;
        }

        header nav ul {
            margin: 0;
            padding: 0;
            list-style: none;
            text-align: center;
        }

        header nav li {
            display: inline-block;
            margin-right: 20px;
        }

        header nav a {
            color: #ffffff;
            text-decoration: none;
            font-weight: bold;
        }

        header nav a:hover {
            text-decoration: underline;
        }

        main {
            margin-top: 80px;
        }

        h1 {
            color: #0073e6;
            font-size: 2.5em;
            margin-top: 20px;
        }

        p {
            color: #0073e6;
            font-size: 1.2em;
            margin-top: 20px;
        }

        footer {
            background-color: #0073e6;
            color: #ffffff;
            width: 100%;
            padding: 10px 0;
            text-align: center;
            position: fixed;
            bottom: 0;
            left: 0;
        }
        .footer-para{
            color:#f2f2f2;
        }
    </style>
</head>

<body>
    <header>
        <nav>
            <ul>
                <li><a href="index.html">Home</a></li>
                <li><a href="index.html">About</a></li>
                <li><a href="products.php">Products</a></li>
                <li><a href="cart.php">Cart</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <?php
        // Start the session
        session_start();

        // Retrieve the customer name from the session variable
        if (isset($_SESSION['user'])) {
            $user = $_SESSION['user'];
            $customerName = $user['name'];
        } else {
            $customerName = "Valued Customer";
        }

        // Display the thank you message
        echo "<h1>Thank You, $customerName!</h1>";
        echo "<p>Your order has been received and will be delivered soon.</p>";
        ?>
    </main>

    <footer>
        <p class="footer-para">&copy; 2024 Moo Dairy Shop. All rights reserved.</p>
    </footer>
</body>

</html>
