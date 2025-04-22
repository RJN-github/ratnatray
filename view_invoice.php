<?php
$host = 'localhost';
$dbname = 'ratnatray_traders';
$username = 'root';
$password = '';

// Establish database connection
$conn = mysqli_connect($host, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_GET['id'])) {
    $bill_id = $_GET['id'];

    // Fetch bill details
    $result = mysqli_query($conn, "SELECT * FROM bills WHERE id = '$bill_id'");
    $bill = mysqli_fetch_assoc($result);

    if ($bill) {
        // Fetch products for this bill
        $products_result = mysqli_query($conn, "SELECT * FROM bills_products WHERE bill_id = '$bill_id'");

        if (mysqli_num_rows($products_result) > 0) {
            $products = mysqli_fetch_all($products_result, MYSQLI_ASSOC);
        } else {
            // No products found for this bill
            $products = [];
        }

        $formattedDate = date("d/m/Y", strtotime($bill['created_at']));
    } else {
        // If no bill is found
        echo "Bill not found.";
        exit();
    }
} else {
    // If no ID is provided, redirect back to index
    header("Location: invoice.php");
    exit();
}

mysqli_close($conn);

$totalItems = count($products); // Total number of items
$itemsPerPage = 16; // Number of items per page

// Calculate total pages
$totalPages = ceil($totalItems / $itemsPerPage);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice #<?= $bill['id'] ?></title>
    <link rel="stylesheet" href="a5.css">
</head>

<body>

<?php for ($page = 1; $page <= $totalPages; $page++) : ?>
    <div class="page">
        <div class="top-part">
            <div class="heading">
                <h2>Ratnatray Traders</h2>
                    <div class="invoice-no">Delivery Challan No: <?= $bill['id'] ?></div>
            </div>
            <div class="party-name">
                <div class="partyname">
                    <strong>Party:</strong> <?= $bill['customer_name'] ?>
                </div>
                <div class="date-top">Date: <?= $formattedDate ?></div>

            </div>

            <h4 class="prodbreakdown">Product Breakdown</h4>
            <table>
                <thead>
                    <tr>
                        <th>Serial</th>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $startIndex = ($page - 1) * $itemsPerPage;
                    $endIndex = min($startIndex + $itemsPerPage, $totalItems);
                    for ($i = $startIndex; $i < $endIndex; $i++) :
                        $product = $products[$i];
                    ?>
                        <tr>
                            <td><?= $i + 1 ?></td>
                            <td><?= $product['product_name'] ?></td>
                            <td><?= $product['quantity'] ?></td>
                            <td><?= number_format($product['price'], 2) ?></td>
                            <td>₹<?= number_format($product['total_price'], 2) ?></td>
                        </tr>
                    <?php endfor; ?>
                </tbody>
            </table>
        </div>

                <!-- Footer on every page, pushed to bottom -->
                <div class="footer">
            <?php if ($page == $totalPages) : ?>
                <p><strong>Total Amount:</strong> ₹<?= number_format($bill['total_amount'], 2) ?></p>
            <?php endif; ?>

            <div class="contfooter">
                <div>Party Signature</div>
                <div class="footer-note">Software developed by Rishkesh J Natu</div>
                <div>For - Ratnatray Traders</div>
            </div>
        </div>
    </div> <!-- This closes the .page -->

<?php endfor; ?>


<div class="btns">
       <button class="btn" onclick="window.print()">Print Invoice</button>
     <button class="btn-back" onclick="window.location.href='invoice.php'"> <img style="filter:invert(1)" src="left.png" alt=""> Back to Invoice</button>
    <button class="btn-back" onclick="window.location.href='history.html'"> <img style="filter:invert(1)" src="left.png" alt=""> Back to History</button>
   </div>
</body> 

</html>