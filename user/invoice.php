<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="keywords" content="coffee cupochino machine-coffee" />
    <meta name="description"
        content="Découvrez un univers de délices caféinés sur DRCoffee. Notre site vous invite à explorer une gamme exquise de cafés, des grains soigneusement sélectionnés aux machines à capsules de pointe. Plongez dans une expérience de magasinage unique où la passion pour le café rencontre l'innovation. Parcourez notre catalogue pour découvrir des saveurs riches, des accessoires élégants et des machines qui transforment chaque tasse en une célébration de l'art du café." />
    <meta name="author" content="Noureddine DRIOUECH" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="home.css" />
    <link rel="stylesheet" href="invoice.css">
    <link rel="icon" href="Images/logoIcon.png" type="image/png" />
    <title>DRCoffee - Facture</title>
</head>

<body>
    <h1>DRCoffee Facture - Commande #<?= $order['idCommande'] ?></h1>
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

    <div style="display :flex; justify-content:space-around; width:100%">
        <div>
            <h4 style="display : inline">Date de la commande: </h4>
            <p style="display : inline"> <?= $order['date'] ?></p>
        </div>
        <div>
            <h4 style="display : inline">État de la commande: </h4>
            <p style="display : inline"> <?= $order['etat'] ?></p>
        </div>
    </div>


    <img src="Images/imprimer.svg" style="width: 300px; margin : 20px;" />

    <div>
        <h3 style="display : inline">Total de la commande: </h3>
        <p style="display : inline"><?= $order['total'] ?> MAD</p>
    </div>
    <button onclick="window.print()">Imprimer la Facture</button>
</body>

</html>