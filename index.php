<?php
include 'config.php';

// INSERT Operation (DML)
if(isset($_POST['add_product'])){
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $desc = mysqli_real_escape_string($conn, $_POST['desc']);
    
    $sql = "INSERT INTO products (name, price, description) VALUES ('$name', '$price', '$desc')";
    mysqli_query($conn, $sql);
}

// DELETE Operation (DML)
if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM products WHERE product_id=$id");
}

// SELECT Operation to display products
$products = mysqli_query($conn, "SELECT * FROM products");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Mayuranga's E-Commerce System</title>
    <style>
        body { font-family: 'Segoe UI', Arial, sans-serif; margin: 0; padding: 0; background: #f7fafc; color: #2d3748; }
        .navbar { background: #2b6cb0; padding: 15px; text-align: center; }
        .navbar a { color: white; margin: 0 15px; text-decoration: none; font-weight: bold; }
        .container { max-width: 1000px; margin: 30px auto; background: white; padding: 30px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        h1, h2 { color: #1a365d; }
        .tab-content { display: none; }
        .active { display: block; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #e2e8f0; padding: 12px; text-align: left; }
        th { background: #2b6cb0; color: white; }
        .btn { background: #2b6cb0; color: white; padding: 8px 16px; border: none; border-radius: 4px; cursor: pointer; text-decoration: none; }
        .btn-danger { background: #e53e3e; }
        .form-group { margin-bottom: 15px; }
        .form-group input, .form-group textarea { width: 100%; padding: 10px; border: 1px solid #cbd5e0; border-radius: 4px; box-sizing: border-box; }
    </style>
    <script>
        function showTab(tabName) {
            var i;
            var x = document.getElementsByClassName("tab-content");
            for (i = 0; i < x.length; i++) { x[i].style.display = "none"; }
            document.getElementById(tabName).style.display = "block";
        }
    </script>
</head>
<body onload="showTab('home')">

    <div class="navbar">
        <a href="#" onclick="showTab('home')">Home</a>
        <a href="#" onclick="showTab('products')">Products</a>
        <a href="#" onclick="showTab('contact')">Contact Us</a>
        <a href="#" onclick="showTab('admin')">Admin Dashboard</a>
    </div>

    <div class="container">
        <p style="text-align: right; font-weight: bold;">U.V.N.S.Mayuranga | ID: 28340</p>
        
        <div id="home" class="tab-content">
            <h1>Welcome to Premium Retailers</h1>
            <p>Discover the finest collection of authentic products curated just for you. Seamlessly view, manage, and engage with our modern storefront solutions.</p>
        </div>

        <div id="products" class="tab-content">
            <h2>Our Current Catalog</h2>
            <table>
                <tr>
                    <th>Product Name</th>
                    <th>Price (LKR)</th>
                    <th>Description</th>
                </tr>
                <?php while($row = mysqli_fetch_assoc($products)) { ?>
                <tr>
                    <td><strong><?php echo $row['name']; ?></strong></td>
                    <td><?php echo number_format($row['price'], 2); ?></td>
                    <td><?php echo $row['description']; ?></td>
                </tr>
                <?php } ?>
            </table>
        </div>

        <div id="contact" class="tab-content">
            <h2>Contact Our Team</h2>
            <form onsubmit="alert('Message Sent Successfully!'); return false;">
                <div class="form-group"><input type="text" placeholder="Your Name" required></div>
                <div class="form-group"><input type="email" placeholder="Your Email" required></div>
                <div class="form-group"><textarea placeholder="Your Message" rows="4" required></textarea></div>
                <button type="submit" class="btn">Send Inquiry</button>
            </form>
        </div>

        <div id="admin" class="tab-content">
            <h2>Admin Control Panel (DML Operations)</h2>
            
            <h3>Add New Product (INSERT)</h3>
            <form method="POST" action="index.php">
                <div class="form-group"><input type="text" name="name" placeholder="Product Name" required></div>
                <div class="form-group"><input type="number" step="0.01" name="price" placeholder="Price" required></div>
                <div class="form-group"><textarea name="desc" placeholder="Product Description" rows="2" required></textarea></div>
                <button type="submit" name="add_product" class="btn">Execute INSERT</button>
            </form>

            <h3>Manage Records (DELETE / UPDATE)</h3>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Action</th>
                </tr>
                <tr>
                    <td>1</td>
                    <td>Sample Core i5 Laptop</td>
                    <td>150,000.00</td>
                    <td><a href="index.php?delete=1" class="btn btn-danger" onclick="alert('DML DELETE Requested')">Delete</a></td>
                </tr>
            </table>
        </div>
    </div>
</body>
</html>
