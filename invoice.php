<?php
include('database.php');

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $customer_name = $_POST['customer_name'];
    $total_amount = $_POST['total_amount'];
    $product_names = $_POST['product_name'];
    $quantities = $_POST['quantity'];
    $prices = $_POST['price'];
    $total_prices = $_POST['total_price'];

    date_default_timezone_set('Asia/Kolkata'); 
    $created_at = date('Y-m-d H:i:s');

    // Insert the bill data into the 'bills' table
    $sql = "INSERT INTO bills (customer_name, total_amount, created_at) 
            VALUES ('$customer_name', '$total_amount', '$created_at')";
    $conn->query($sql);

    // Get the last inserted bill ID
    $bill_id = $conn->insert_id;

    // Insert the product details into the 'bills_products' table
    foreach ($product_names as $index => $product_name) {
        $product_name = $conn->real_escape_string($product_name);
        $quantity = $quantities[$index];
        $price = $prices[$index];
        $total_price = $total_prices[$index];

        $sql = "INSERT INTO bills_products (bill_id, product_name, quantity, price, total_price) 
                VALUES ('$bill_id', '$product_name', '$quantity', '$price', '$total_price')";
        $conn->query($sql);
    }

    // Redirect to the full invoice page
    header("Location: view_invoice.php?id=$bill_id");
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Billing System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .form-container {
            max-width: 100vw;
            margin: auto;
            padding: 20px;
            border: 1px solid black;
            box-shadow: 5px 10px 20px black;
            border-radius: 8px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th, td {
            border: 1px solid black;
            padding: 10px;
            text-align: center;
        }
        .btn {
            background-color: blue;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .additems{
            margin-top: 10px;
        }
        .btn:hover {
            background-color: darkblue;
        }
        .history-btn {
            background-color: green;
            color: white;
            padding: 6px;
            border-radius: 5px;
            border: none;
            margin-top: 20px;
            cursor: pointer;
        }
        .history-btn:hover {
            background-color: darkgreen;
        }
        input{
            font-size: 18px;
        }
        footer{
            text-align: center;
        }
        </style>
</head>
<body>

    <h2>Cash</h2>
    <div class="form-container">
        <form method="POST" action="">
            <!-- Customer Details -->
            <label for="customer_name">Party :</label><br>
            <input type="text" id="customer_name" name="customer_name" required><br><br>

            <!-- Product Table -->
            <table id="productTable">
                <thead>
                    <tr>
                        <th>Serial No.</th>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="serial-number">1</td>
                        <td><input type="text" name="product_name[]" required></td>
                        <td><input type="number" name="quantity[]" class="quantity" required onchange="updateTotal()"></td>
                        <td><input type="number" step="0.01" name="price[]" class="price" required onchange="updateTotal()"></td>
                        <td><input type="number" step="0.01" name="total_price[]" class="total_price" readonly></td>
                        <td><button type="button" class="btn" onclick="removeProduct(this)">Remove</button></td>
                    </tr>
                </tbody>
            </table>

            <button type="button" class="btn additems" onclick="addProduct()">+ Add Product</button><br><br>

            <label for="total_amount">Total Amount:</label><br>
            <input type="number" id="total_amount" name="total_amount" readonly><br><br>

            <button type="submit" class="btn">Generate Bill</button>
        </form>
        
        <!-- History Button -->
        <button class="history-btn" onclick="window.location.href='history.html'">View Bill History</button>
    </div>
    <footer>
    <p class="credits">Made By <b>Rishikesh J Natu</b></p></footer>

    <script>

        document.addEventListener('keydown',()=>{
            if (event.key ='Shift' &&  event.key=== 'Enter') {
                event.preventDefault();
                addProduct();
            }
        })

        document.querySelectorAll('input').forEach(input=>{
            input.addEventListener('keydown' ,(e)=>{
                if (e.key == 'Enter') {
                    e.preventDefault();
                    console.log("enter was clicked");
                }
            })
        })
        document.querySelector('form').addEventListener('keydown',(e)=>{
            if (e.key =='Emter') {
                e.preventDefault();
            }
        })
        window.addEventListener('unload' , (e)=>{
            const warning = 'Refresh kelat tr hote te items sgle jatil'
            e.returnValue = warning;
        })
        // Add new product row
        const table = document.getElementById("productTable").getElementsByTagName('tbody')[0];
        function addProduct() {
            const row = table.insertRow();
            const rowCount = table.rows.length; // get the number of rows

            row.innerHTML = `
                <td class="serial-number">${rowCount}</td>
                <td><input type="text" name="product_name[]" required></td>
                <td><input type="number" name="quantity[]" class="quantity" required onchange="updateTotal()"></td>
                <td><input type="number" step="0.01" name="price[]" class="price" required onchange="updateTotal()"></td>
                <td><input type="number" step="0.01" name="total_price[]" class="total_price" readonly></td>
                <td><button type="button" class="btn" onclick="removeProduct(this)">Remove</button></td>
            `;
            updateTotal();
        }

        // Remove product row
        function removeProduct(button) {
            const row = button.parentElement.parentElement;
            if (table.rows.length<=1) {
                alert('Cannot Remove this item');   
                return 0;                
            }
            else{
                row.remove();
                updateSerialNumbers();  // Update serial numbers after removal
                updateTotal();
            }
        }

        // Update total price for each product and calculate overall total
        function updateTotal() {
            const rows = document.querySelectorAll("#productTable tbody tr");
            let grandTotal = 0;

            rows.forEach(row => {
                const quantity = row.querySelector(".quantity");
                const price = row.querySelector(".price");
                const totalPrice = row.querySelector(".total_price");

                if (quantity && price && totalPrice) {
                    const total = parseFloat(quantity.value || 0) * parseFloat(price.value || 0);
                    totalPrice.value = total.toFixed(2);
                    grandTotal += total;
                }
            });

            document.getElementById("total_amount").value = grandTotal.toFixed(2);
        }

        // Update serial numbers for each row
        function updateSerialNumbers() {
            const rows = document.querySelectorAll("#productTable tbody tr");
            rows.forEach((row, index) => {
                row.querySelector(".serial-number").textContent = index + 1;
            });
        }
    </script>

</body>
</html>
