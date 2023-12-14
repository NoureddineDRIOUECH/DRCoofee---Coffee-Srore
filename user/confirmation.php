<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('location:../connexion.php');
} else {
    require_once '../connectDB.php';

    if (isset($_GET['id'])) {
        $commandeId = $_GET['id'];

        $commande = $database->prepare("SELECT produits.idProduit, produits.nomProduit, produits.imageType, produits.image, commandeDetails.Quantite, produits.prixProduit FROM commandeDetails INNER JOIN produits ON commandeDetails.IDProduit = produits.idProduit WHERE IDCommande = :orderID");
        $commande->bindParam(":orderID", $commandeId);
        $commande->execute();

        if ($commande->rowCount() > 0) {
            $emailUser = $_SESSION['user']->email;
            require_once '../mail.php';
            // $verificationCode = 'ddec5800';
            $verificationCode = substr(md5(uniqid(mt_rand(), true)), 0, 8);
            $cmd = $database->prepare("UPDATE commandes SET verificationCode = :verificationCode WHERE idCommande = :commandeId");
            $cmd->bindParam(":verificationCode", $verificationCode);
            $cmd->bindParam(":commandeId", $commandeId);
            // $_SESSION['verification_code'] = $verificationCode;
            $cmd->execute();
            $verifCodeQuery = $database->prepare("SELECT verificationCode FROM commandes WHERE idCommande = :commandeId");
            $verifCodeQuery->bindParam(":commandeId", $commandeId);
            $verifCodeQuery->execute();
            $verificationCode = $verifCodeQuery->fetch(PDO::FETCH_COLUMN);

            $mail->addAddress($emailUser);
            $mail->Subject = "Confirmation de Commande - DRCoffee";
            $mail->Body = '
      <body style="font-family: \'Roboto\', sans-serif; background-color: #f4f4f4; color: #333; margin: 0; padding: 20px;">
          <div style="max-width: 600px; margin: 0 auto; background-color: #fff; border-radius: 5px; overflow: hidden; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
              <div style="background-color: #D67F2E; padding: 20px; text-align: center; color: #fff;">
                  <h1 style="margin: 0;">DRCoffee</h1>
              </div>
              <div style="padding: 20px;">
                  <h2 style="color: #D67F2E;">Confirmation de Commande</h2>
                  <p>Merci de votre commande sur DRCoffee. Utilisez le code de vérification ci-dessous pour confirmer votre commande :</p>
                  <h3 style="color: #D67F2E;">Code de Vérification: ' . $verificationCode . '</h3>
                  <p>Entrez ce code lors du processus de confirmation de commande.</p>
                  <p>Merci de choisir DRCoffee!</p>
                  <p>L\'équipe DRCoffee</p>
              </div>
              <div style="background-color: #f4f4f4; padding: 10px; text-align: center;">
                  <p style="margin: 0; color: #666;">DRCoffee - Casablanca, Maroc</p>
              </div>
          </div>
      </body>';
            $mail->setFrom("oyuncoyt@gmail.com", "DRCoffee");
            $mail->send();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['verification'])) {
            $verife = $database->prepare('SELECT verificationCode FROM commandes WHERE idCommande = :commandeId');
            $verife->bindParam(":commandeId", $commandeId);
            $verife->execute();
            $code = $verife->fetch(PDO::FETCH_COLUMN);
            if ($_POST['verification_code'] == $code) {
                $updateStock = $database->prepare("UPDATE produits SET stock = stock - :quantitySold WHERE idProduit = :productId");

                while ($commandeDetails = $commande->fetch(PDO::FETCH_ASSOC)) {
                    $productId = $commandeDetails['idProduit'];
                    $quantitySold = $commandeDetails['Quantite'];

                    $updateStock->bindParam(":quantitySold", $quantitySold);
                    $updateStock->bindParam(":productId", $productId);
                    $updateStock->execute();
                }

                $commande->execute();

                $updateStatus = $database->prepare("UPDATE commandes SET etat = 'Confirmée' WHERE idCommande = :orderId");
                $updateStatus->bindParam(":orderId", $commandeId);
                $updateStatus->execute();

                header('Location: confirmation-success.php');
                exit();
            } else {
                header('Location: about.php');
                exit();
            }
        }
    }
?>



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
    <link rel="stylesheet" href="confirmation.css">
    <link rel="icon" href="Images/logoIcon.png" type="image/png" />
    <link rel="stylesheet" href="about.css" />
    <title>Confirmation de Commande</title>
</head>

<body>
    <?php
        require_once "nav.html";
        ?>
    <main>
        <?php
            echo '<div>';
            echo '<form method="post" >
        <label for="verification_code">Code de vérification :</label>
        <input type="text" id="verification_code" name="verification_code" required>
        <button type="submit" name="verification">Confirmer l\'Achat</button>
    </form>';
            // echo $_SESSION['verification_code'];
            echo '</div>';


            echo '<div class ="p-a">';
            echo '<div class="divproducts">';
            while ($commandeDetails = $commande->fetch(PDO::FETCH_ASSOC)) {

                $getFile = "data:" . $commandeDetails['imageType'] . ";base64," . base64_encode($commandeDetails["image"]);
                echo '<div class="divproduct">';
                echo '<div class="divpanier">';
                echo '<h4 style= "margin-bottom:5px">' . $commandeDetails['nomProduit'] . '</h4>';
                echo '<div class="image">';
                echo '<img class="imgpanier" src="' . $getFile . '" alt="Image Produits" />';
                echo '</div>';
                echo '<div class="product-details">';
                echo '<p class="price">Prix: ' . $commandeDetails['prixProduit'] . ' MAD</p>';
                echo '<p><i>Quantité: </i>' . $commandeDetails['Quantite'] . '</p>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
            echo '</div>';

            ?>


        <div class="containerInfo">
            <?php
                $queryUser = $database->prepare("SELECT * FROM users WHERE id = :currentUserId");
                $currentUserId = $_SESSION['user']->id;
                $queryUser->bindParam(":currentUserId", $currentUserId);
                $queryUser->execute();

                $rowUser = $queryUser->fetch(PDO::FETCH_ASSOC);

                if ($rowUser) {
                    echo '<div class="total-panier">';
                    echo '<h2>Adresse de livraison</h2>';

                    echo '<p>Bonjour Monsieur <b>' . $rowUser['name'] . '</b></p>';
                    echo '<p>Voici votre adresse : ' . $rowUser['address'] . '</p>';
                    echo '<p>Votre email : ' . $rowUser['email'] . '</p>';
                    echo '<p>Votre numéro de téléphone : ' . $rowUser['tel'] . '</p>';
                    $total = $database->prepare("SELECT total from commandes WHERE idCommande = :idcommande");
                    $total->bindParam(":idcommande", $commandeId);
                    $total->execute();
                    $totalAmount = $total->fetch(PDO::FETCH_COLUMN);
                    echo '<br>';
                    echo '<table class="total-panier-table">';
                    echo '<tr>';
                    echo '<th>EXPÉDITION</th>';
                    echo '<td><h5 class="expedition" > Livraison gratuite partout au Maroc !</h5></td>';
                    echo '</tr>';
                    echo '<tr>';
                    echo '<th>TOTAL PANIER</th>';
                    echo '<td><h5 class="total-amount" >' . $totalAmount . ' MAD</h5></td>';
                    echo '</tr>';
                    echo '</table>';
                    echo '</div>';
                }
                ?>
        </div>


        </div>

    </main>
    <?php require_once 'footer.html'; ?>
</body>
<script src="home.js"></script>

</html>

<?php
}
?>