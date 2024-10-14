<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Billing Dashboard</title>
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
        .dashboard-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 400px;
        }
        h2, h3 {
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        form label {
            margin-bottom: 5px;
        }
        form input[type="text"],
        form input[type="submit"] {
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        form input[type="submit"] {
            background-color: #28a745;
            color: #fff;
            border: none;
            cursor: pointer;
        }
        form input[type="submit"]:hover {
            background-color: #218838;
        }
        .logout {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #007bff;
            text-decoration: none;
        }
        .logout:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <h2>Welcome, User</h2>
        <h3>Billing History</h3>
        <table>
            <tr>
                <th>Date</th>
                <th>Amount</th>
                <th>Status</th>
            </tr>
            <tr>
                <td>2023-01-01</td>
                <td>5000 LKR</td>
                <td>Paid</td>
            </tr>
            <tr>
                <td>2023-02-01</td>
                <td>5000 LKR</td>
                <td>Paid</td>
            </tr>
            <tr>
                <td>2023-03-01</td>
                <td>5000 LKR</td>
                <td>Due</td>
            </tr>
        </table>
        <h3>Make a Payment</h3>
        <form action="payment.php" method="post">
            <label for="name">Name on Card:</label>
            <input type="text" id="name" name="name" required>
            
            <label for="card_number">Card Number:</label>
            <input type="text" id="card_number" name="card_number" required>
            
            <label for="exp_date">Expiration Date (MM/YY):</label>
            <input type="text" id="exp_date" name="exp_date" required>
            
            <label for="cvv">CVV:</label>
            <input type="text" id="cvv" name="cvv" required>
            
            <input type="submit" value="Pay Now">
        </form>
        <a class="logout" href="logout.php">Logout</a>
    </div>
</body>
</html>