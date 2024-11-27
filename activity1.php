<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vending Machine</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            background-color: #eef1f7;
        }
        h1 {
            text-align: left;
            color: #444;
        }
        fieldset {
            margin-bottom: 20px;
            padding: 15px;
            border: 2px solid #666;
            background-color: #fff;
        }
        legend {
            font-size: 1.2em;
            font-weight: bold;
            color: #333;
        }
        label {
            margin-bottom: 10px;
            display: block;
        }
        input[type="checkbox"], input[type="number"] {
            margin-right: 8px;
        }
        select {
            margin-left: 5px;
            padding: 5px;
        }
        input[type="submit"] {
            margin-top: 10px;
            padding: 10px 20px;
            background-color: #0069d9;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
        ul {
            margin: 15px 0;
        }
        li {
            margin-bottom: 10px;
        }
        .summary {
            font-size: 1.1em;
        }
        hr {
            margin: 20px 0;
            border: 1px solid #ddd;
        }
    </style>
</head>
<body>
    <h1>Vending Machine</h1>
    <form method="post">
        <fieldset>
            <legend>Choose Your Drinks</legend>
            <label><input type="checkbox" name="drinks[]" value="Coke"> Coke - ₱15</label>
            <label><input type="checkbox" name="drinks[]" value="Sprite"> Sprite - ₱20</label>
            <label><input type="checkbox" name="drinks[]" value="Royal"> Royal - ₱20</label>
            <label><input type="checkbox" name="drinks[]" value="Pepsi"> Pepsi - ₱15</label>
            <label><input type="checkbox" name="drinks[]" value="Mountain Dew"> Mountain Dew - ₱20</label>
        </fieldset>

        <fieldset>
            <legend>Order Information</legend>
            <label>Size:
                <select name="size_option">
                    <option value="Regular" selected>Regular</option>
                    <option value="Up">Up-Size (₱5 extra)</option>
                    <option value="Jumbo">Jumbo-Size (₱10 extra)</option>
                </select>
            </label>
            <label>Quantity: <input type="number" name="quantity" min="1" max="10"></label>
        </fieldset>

        <input type="submit" value="Checkout" name="process_order">
    </form>

    <?php
    // Drink prices
    $drink_prices = [
        "Coke" => 15,
        "Sprite" => 20,
        "Royal" => 20,
        "Pepsi" => 15,
        "Mountain Dew" => 20
    ];

    // Additional size costs
    $size_extra_charges = [
        "Regular" => 0,
        "Up" => 5,
        "Jumbo" => 10
    ];

    // Initialize total
    $total_amount = 0;

    if (isset($_POST['process_order'])) {
        $selected_drinks = $_POST['drinks'] ?? [];
        $selected_size = $_POST['size_option'] ?? "Regular";
        $drink_quantity = $_POST['quantity'] ?? 0;

        if (empty($selected_drinks)) {
            echo "<hr><p>Please choose at least one drink.</p>";
        } elseif ($drink_quantity < 1) {
            echo "<hr><p>Specify a valid quantity.</p>";
        } else {
            echo "<hr><h2>Order Summary</h2>";
            echo "<ul>";

            foreach ($selected_drinks as $drink) {
                $base_price = $drink_prices[$drink];
                $size_cost = $size_extra_charges[$selected_size];
                $item_total = ($base_price + $size_cost) * $drink_quantity;
                $total_amount += $item_total;

                echo "<li><strong>$drink_quantity x $selected_size $drink:</strong> ₱$item_total</li>";
            }

            echo "</ul>";
            echo "<p class='summary'><strong>Total Amount:</strong> ₱$total_amount</p>";
            echo "<p class='summary'><strong>Drinks Selected:</strong> " . count($selected_drinks) . "</p>";
        }
    }
    ?>
</body>
</html>
