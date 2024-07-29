<?php
session_start();
include 'db_connect.php'; // Include database connection file

$cart = isset($_SESSION["cart"]) ? $_SESSION["cart"] : [];

$products = [];
if (!empty($cart)) {
    $ids = implode(',', array_keys($cart));
    $query = "SELECT * FROM products WHERE id IN ($ids)";
    $result = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        $products[] = $row;
    }
}

// Function to get total price
function getTotalAmount($products, $cart) {
    $total = 0;
    foreach ($products as $product) {
        $total += $product["price"] * $cart[$product["id"]]["quantity"];
    }
    return $total;
}

// Handle removing items from the cart
if (isset($_GET['remove'])) {
    $product_id = $_GET['remove'];
    unset($_SESSION["cart"][$product_id]);
    header("Location: cart.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart - Moo Dairy Shop</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        /* Add custom CSS to match the design in the image */
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }
        .header {
            text-align: center;
            background-color: #007bff;
            color: #ffffff;
            padding: 20px 0;
        }
        .nav ul {
            list-style-type: none;
            padding: 0;
            display: flex;
            justify-content: center;
            background-color:#005f8b;
        }
        .nav ul li {
            margin: 0 10px;
        }
        .nav ul li a {
            color: #ffffff;
            text-decoration: none;
            padding: 10px;
            display: block;
        }
        .nav ul li a.active, .nav ul li a:hover {
            background-color: #00b4d8;
        }
        .container {
            width: 80%;
            margin: 20px auto;
        }
        .cart {
            background-color: #ffffff;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .cart h2 {
            margin-top: 0;
        }
        .cart ul {
            list-style-type: none;
            padding: 0;
        }
        .cart ul li {
            border-bottom: 1px solid #ddd;
            padding: 10px 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .cart ul li img {
            width: 100px;
            height: auto;
        }
        .cart ul li div {
            flex: 1;
            margin-left: 10px;
        }
        .cart ul li div p {
            margin: 5px 0;
        }
        .total {
            text-align: right;
            margin-top: 20px;
        }
        .checkout-btn {
            text-align: center;
            margin-top: 20px;
        }
        .checkout-btn button {
            background-color: #007bff;
            color: #ffffff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 4px;
        }
        .checkout-btn button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <!-- Header Section -->
    <header class="header">
        <div class="container">
            <h1>Your Cart</h1>
        </div>
    </header>

    <!-- Navigation Section -->
    <nav class="nav">
        <ul>
            <li><a href="index.html">Home</a></li>
            <li><a href="index.html">About</a></li>
            <li><a href="products.php">Products</a></li>
            <li><a href="cart.php" class="active">Cart</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>

    <!-- Main Content Section -->
    <div class="container">
        <section id="cart" class="cart">
            <h2>Items in Your Cart</h2>
            <?php if (empty($products)): ?>
                <p>Your cart is empty.</p>
            <?php else: ?>
                <ul>
                    <?php foreach ($products as $product): ?>
                        <li>
                            <img src="<?php echo $product['image_url']; ?>" alt="<?php echo $product['name']; ?>">
                            <div>
                                <h3><?php echo $product['name']; ?></h3>
                                <p><?php echo $product['description']; ?></p>
                                <p>Price: $<?php echo $product['price']; ?></p>
                                <p>Quantity: <?php echo $cart[$product['id']]['quantity']; ?></p>
                                <p>Unit: <?php echo $cart[$product['id']]['unit']; ?></p>
                                <p>Total: $<?php echo intval($product['price']) * intval($cart[$product['id']]['quantity']); ?></p>
                                                             <a href="cart.php?remove=<?php echo $product['id']; ?>">Remove</a>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
                
                <div class="checkout-btn">
                    <a href="checkout.php"><button>Proceed To Buy</button></a>
                </div>
            <?php endif; ?>
        </section>
    </div>

    <!-- Footer Section -->
    <footer class="footer">
        <p>&copy; 2024 Moo Dairy Shop Corporation</p>
    </footer>
</body>
</html>
