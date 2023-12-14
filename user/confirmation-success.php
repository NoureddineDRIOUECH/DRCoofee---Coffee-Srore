<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="styles.css" /> <!-- Include your styles if needed -->
    <title>Confirmation Success</title>
</head>

<body>
    <?php require_once 'nav.html';?>

    <main>
        <div class="success-container">
            <h2>Order Confirmed Successfully!</h2>
            <p>Thank you for confirming your order. Your purchase is now complete.</p>

            <!-- Additional content or actions can be added here -->
            <p>Your order will be processed, and you will receive updates on the delivery status.</p>
            <p>If you have any questions, feel free to <a href="contact.php">contact our support team</a>.</p>

            <a href="index.php">Continue Shopping</a>
            <!-- Provide a link to your main page or any other relevant page -->
        </div>
    </main>

    <?php require_once 'nav.html';?>
</body>

</html>