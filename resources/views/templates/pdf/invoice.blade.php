<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Invoice</title>
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
    }

    .invoice {
        width: 600px;
        margin: 20px auto;
        border: 1px solid #ccc;
        padding: 20px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .invoice-header h1 {
        margin: 0;
        color: #333;
    }

    .invoice-details {
        margin-bottom: 20px;
    }

    .invoice-details p {
        margin: 0;
        margin-bottom: 10px;
    }

    .invoice-footer {
        border-top: 1px solid #ccc;
        padding-top: 20px;
        margin-top: 20px;
    }

    .invoice-footer p {
        margin: 0;
    }
</style>
</head>
<body>

<div class="invoice">
    <div class="invoice-header">
        <h1>Invoice</h1>
    </div>
    
    <div class="invoice-details">
        <p><strong>Invoice Number:</strong> INV-123</p>
        <p><strong>Date:</strong> January 1, 2023</p>
        <p><strong>Billed To:</strong> John Doe</p>
        <p>123 Main Street<br>City, State, ZIP</p>
    </div>

    <div class="product-details">
        <h2>Product Details</h2>
        <p><strong>Product:</strong> Product A</p>
        <p><strong>Quantity:</strong> 1</p>
        <p><strong>Unit Price:</strong> $50.00</p>
        <p><strong>Total:</strong> $50.00</p>
    </div>

    <div class="invoice-footer">
        <p>Thank you for your business!</p>
    </div>
</div>

</body>
</html>
