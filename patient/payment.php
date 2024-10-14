<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .payment-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
        }
        .payment-container h2 {
            margin-bottom: 20px;
            text-align: center;
        }
        .payment-container input[type="text"],
        .payment-container input[type="number"],
        .payment-container input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .payment-container input[type="submit"] {
            background-color: #28a745;
            color: #fff;
            border: none;
            cursor: pointer;
        }
        .payment-container input[type="submit"]:hover {
            background-color: #218838;
        }
        .error {
            color: red;
            margin: 10px 0;
        }
        .success {
            color: green;
            margin: 10px 0;
        }
    </style>
</head>
<body>
    <div class="payment-container">
        <h2>Payment Details</h2>
        <form action="payment.php" method="post">
            <label for="name">Name on Card</label>
            <input type="text" id="name" name="name" required>
            
            <label for="card_number">Card Number</label>
            <input type="number" id="card_number" name="card_number" required>
            
            <label for="exp_date">Expiration Date (MM/YY)</label>
            <input type="text" id="exp_date" name="exp_date" required>
            
            <label for="cvv">CVV</label>
            <input type="number" id="cvv" name="cvv" required>
            
            <input type="submit" value="Pay Now">
        </form>
    </div>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = htmlspecialchars($_POST['name']);
        $card_number = htmlspecialchars($_POST['card_number']);
        $exp_date = htmlspecialchars($_POST['exp_date']);
        $cvv = htmlspecialchars($_POST['cvv']);

        $errors = [];

        // Validate name
        if (empty($name)) {
            $errors[] = "Name on card is required.";
        }

        // Validate card number (example: 16 digits)
        if (!is_numeric($card_number) || strlen($card_number) != 16) {
            $errors[] = "Invalid card number. It should be 16 digits.";
        }

        // Validate expiration date (MM/YY format and future date)
        if (!preg_match("/^(0[1-9]|1[0-2])\/?([0-9]{2})$/", $exp_date)) {
            $errors[] = "Invalid expiration date format. Use MM/YY.";
        } else {
            $currentYear = date('y');
            $currentMonth = date('m');
            list($month, $year) = explode('/', $exp_date);
            if ($year < $currentYear || ($year == $currentYear && $month < $currentMonth)) {
                $errors[] = "Expiration date must be a future date.";
            }
        }

        // Validate CVV (example: 3 digits)
        if (!is_numeric($cvv) || strlen($cvv) != 3) {
            $errors[] = "Invalid CVV. It should be 3 digits.";
        }

        if (empty($errors)) {
            echo "<div class='payment-container'>";
            echo "<h2 class='success'>Payment Details Submitted</h2>";
            echo "<p>Name on Card: $name</p>";
            echo "<p>Card Number: $card_number</p>";
            echo "<p>Expiration Date: $exp_date</p>";
            echo "<p>CVV: $cvv</p>";
            echo "</div>";
        } else {
            echo "<div class='payment-container'>";
            echo "<h2>Errors</h2>";
            foreach ($errors as $error) {
                echo "<p class='error'>$error</p>";
            }
            echo "</div>";
        }
    }
    ?>
</body>
</html>