<?php
session_start();
include 'db_connect.php'; // Include database connection file

if (!isset($_SESSION["cart"]) || empty($_SESSION["cart"])) {
    header("Location: cart.php");
    exit();
}

$product_ids = array_keys($_SESSION["cart"]);
if (count($product_ids) > 0) {
    $ids = implode(",", $product_ids);
    $query = "SELECT * FROM products WHERE id IN ($ids)";
    $result = mysqli_query($conn, $query);
    $products = mysqli_fetch_all($result, MYSQLI_ASSOC);
} else {
    $products = [];
}

function getTotalAmount($products) {
    $total = 0;
    foreach ($products as $product) {
        $total += $product["price"] * $_SESSION["cart"][$product["id"]]["quantity"];
    }
    return $total;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $address = $_POST["address"];
    $total_amount = getTotalAmount($products);

    // Insert order into database
    $order_query = "INSERT INTO orders (name, email, address, total_amount) VALUES ('$name', '$email', '$address', '$total_amount')";
    if (mysqli_query($conn, $order_query)) {
        $order_id = mysqli_insert_id($conn);
        foreach ($products as $product) {
            $product_id = $product["id"];
            $quantity = $_SESSION["cart"][$product_id]["quantity"];
            $price = $product["price"];
            $order_item_query = "INSERT INTO order_items (order_id, product_id, quantity, price) VALUES ('$order_id', '$product_id', '$quantity', '$price')";
            mysqli_query($conn, $order_item_query);
        }
        unset($_SESSION["cart"]); // Clear the cart
        header("Location: thank_you.php?order_id=$order_id");
        exit();
    } else {
        echo "Error: " . $order_query . "<br>" . mysqli_error($conn);
    }

    if (count($product_ids) > 0) {
        $ids = implode(",", $product_ids);
        $query = "SELECT * FROM products WHERE id IN ($ids)";
        $result = mysqli_query($conn, $query);
        $products = mysqli_fetch_all($result, MYSQLI_ASSOC);
    } else {
        $products = [];
        // Handle the case where the cart is empty
        echo "Your cart is empty!";
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - Moo Dairy Shop</title>
    <link rel="stylesheet" href="styles.css">

    <style>
        /* General styles checkout page*/
body {
    font-family: Arial, sans-serif;
    background-color: #f8f9fa;
    margin: 0;
    padding: 0;
    display: flex;
    flex-direction: column;
    min-height: 100vh;
  
}

.container {
    width: 80%;
    margin: 10px auto;
    padding: 20px;
}
.nav {
    background-color: #343a40;
    overflow: hidden;
}
.nav a {
    float: left;
    display: block;
    color: #f2f2f2;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
}
.nav a:hover {
    background-color: #ddd;
    color: black;
}
.header {
    text-align: center;
    margin-bottom: 20px;
}
.checkout-form {
    background-color: #ffffff;
    padding: 20px;
    border: 1px solid #ddd;
    border-radius: 5px;
    margin-bottom: 20px;
}
.checkout-form h2 {
    margin-top: 0;
}
.checkout-form table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
}
.checkout-form th, .checkout-form td {
    padding: 12px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}
.checkout-form th {
    background-color: #f2f2f2;
}
.total-row td {
    font-weight: bold;
}
.checkout-form label {
    display: block;
    margin-bottom: 8px;
    font-weight: bold;
}
.checkout-form input, .checkout-form textarea {
    width: 100%;
    padding: 10px;
    margin-bottom: 20px;
    border: 1px solid #ddd;
    border-radius: 4px;
}
.checkout-form button {
    background-color: #007bff;
    color: #fff;
    border: none;
    padding: 10px 20px;
    cursor: pointer;
    border-radius: 4px;
}
.checkout-form button:hover {
    background-color: #0056b3;
}
footer {
    text-align: center;
    margin-top: 20px;
    padding: 20px;
    background-color: #0073e6;
    color:white;
    width:100%;
    
}
</style>

</head>
<body>
    <div class="nav">
        <a href="index.html">Home</a>
        <a href="index.html">About</a>
        <a href="products.php">Products</a>
        <a href="cart.php">Cart</a>
        <a href="logout.php">Logout</a>
    </div>
    <div class="container">
        <div class="header">
            <h1>Checkout</h1>
        </div>
        <div class="checkout-form">
            <h2>Your Order</h2>
            <table class="cart-table">
                <tr>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total</th>
                </tr>
                <?php foreach ($products as $product): ?>
                    <tr>
                        <td><?php echo $product["name"]; ?></td>
                        <td><?php echo $_SESSION["cart"][$product["id"]]["quantity"]; ?></td>
                        <td>$<?php echo $product["price"]; ?></td>
                        <td>$<?php echo $product["price"] * $_SESSION["cart"][$product["id"]]["quantity"]; ?></td>
                    </tr>
                <?php endforeach; ?>
                <tr class="total-row">
                    <td colspan="3">Total</td>
                    <td>$<?php echo getTotalAmount($products); ?></td>
                </tr>
                <section> 
        <form action="placeorder.html" method="post"> 

            <button type="submit">Place Order</button>
        </form> 
    </section> 

    <footer> 
        <p>&copy; 2024 Moo Dairy Shop. All rights reserved.</p> 
    </footer> 

    <script src="script.js"></script>




           
                
            </form>
        </div>
    </div>
</body>
</html>