<?php
session_start();
include 'db_connect.php'; // Include database connection file

if (isset($_POST["add_to_cart"])) {
    $product_id = $_POST["product_id"];
    $product_quantity = $_POST["product_quantity"];
    $product_unit = $_POST["product_unit"];

    if (!isset($_SESSION["cart"])) {
        $_SESSION["cart"] = [];
    }

    $_SESSION["cart"][$product_id] = [
        'quantity' => $product_quantity,
        'unit' => $product_unit
    ];
    header("location:cart.php");
}

$products = [];
$query = "SELECT * FROM products";
$result = mysqli_query($conn, $query);
while ($row = mysqli_fetch_assoc($result)) {
    $products[] = $row;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moo Dairy Shop</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</head>
<body>
    <!-- Header Section -->
    <header class="header">
        <div class="container">
            <h1>Welcome To Moo Dairy Shop</h1>
        </div>
    </header>

    <!-- Navigation Section -->
    <nav class="nav">
        <ul>
            <li><a href="index.html">Home</a></li>
            <li><a href="index.html">About</a></li>
            <li><a href="products.php" class="active">Products</a></li>
            <li><a href="cart.php">Cart</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>

    <!-- Main Content Section -->
    <main>
        <section id="home" class="home">
            <h2>Our Products</h2>
            <ul>
                <?php foreach ($products as $product): ?>
                    <li>
                        <h3><?php echo $product['name']; ?></h3>
                        <img src="<?php echo $product['image_url']; ?>" alt="<?php echo $product['name']; ?>">
                        <p><?php echo $product['description']; ?></p>
                        <p><span>$<?php echo $product['price']; ?></span></p>
                        <form method="post" action="products.php">
                            <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                            <label for="product<?php echo $product['id']; ?>_quantity">Quantity:</label>
                            <input type="number" id="product<?php echo $product['id']; ?>_quantity" name="product_quantity" min="0" max="10">
                            <label for="product<?php echo $product['id']; ?>_unit">Unit:</label>
                            <select id="product<?php echo $product['id']; ?>_unit" name="product_unit">
                                <?php if (strpos($product['name'], 'Milk') !== false): ?>
                                    <option value="250ml">250ml</option>
                                    <option value="500ml">500ml</option>
                                    <option value="1 liter">1 liter</option>
                                <?php else: ?>
                                    <option value="50g">50g</option>
                                    <option value="100g">100g</option>
                                    <option value="150g">150g</option>
                                <?php endif; ?>
                            </select>
                            <button type="submit" name="add_to_cart">Add to Cart</button>
                        </form>
                    </li>
                <?php endforeach; ?>
            </ul>
        </section>
    </main>

    <!-- Footer Section -->
    <footer class="footer">
        <p>&copy; 2024 Moo Dairy Shop Corporation</p>
    </footer>

    <!-- JavaScript for Smooth Scrolling -->
    <script>
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();

                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
    </script>
</body>
</html>
