<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facture - Commande #<?= $order['idCommande'] ?></title>
    <style>
    /* Add your custom styles for the invoice */
    /* For example: */
    body {
        font-family: Arial, sans-serif;
        margin: 20px;
    }
    </style>
</head>

<body>
    <h1>Facture - Commande #<?= $order['idCommande'] ?></h1>

    <p>Date de la commande: <?= $order['date'] ?></p>
    <p>État de la commande: <?= $order['etat'] ?></p>

    <h2>Détails de la commande</h2>
    <table>
        <thead>
            <tr>
                <th>Produit</th>
                <th>Prix unitaire</th>
                <th>Quantité</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $product) : ?>
            <tr>
                <td><?= $product['nomProduit'] ?></td>
                <td><?= $product['prixProduit'] ?> MAD</td>
                <td><?= $product['Quantite'] ?></td>
                <td><?= $product['prixProduit'] * $product['Quantite'] ?> MAD</td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <p>Total de la commande: <?= $order['total'] ?> MAD</p>

    <!-- Add more details as needed -->

    <!-- You can include a button or link to allow the user to save or print the invoice -->
    <button onclick="window.print()">Imprimer la Facture</button>
</body>

</html>