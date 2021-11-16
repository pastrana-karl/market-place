<link rel="stylesheet" href="../styles/header_Manage.css">
<body>
    <div class="menu textcenter"> 
        <div class="wrapper">
            <ul>
                <li><a href="../admin/home.php">Dashboard</a></li>
                <li><a href="../admin/manage_category.php">Category</a></li>
                <li><a href="../admin/manage_product.php">Product</a></li>
                <li><a href="../admin/manage_order.php">Order</a></li>
                <li><a href="../admin/about.php">About</a></li>
                <?php
                    if (isset($_SESSION["usersName"])){
                        echo "<li><a href = '../includes/logOut.inc.php'>Log Out</a></li>";
                    }
                ?>
            </ul> 
        </div>
    </div>
</body>