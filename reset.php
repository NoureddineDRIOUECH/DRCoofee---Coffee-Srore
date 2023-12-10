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
    <link rel="stylesheet" href="reset.css">
    <link rel="icon" href="Images/logoIcon.png" type="image/png" />
    <title>DRCoffee</title>
</head>

<body>
    <?php
  require_once "nav.php";
  ?>
    <?php
  if (!isset($_GET['code'])) {
    echo '
      <main>
        <section id="reset-password">
            <div class="reset-password-container">
                <h2>Réinitialisation du Mot de Passe</h2>

                <p>Entrez votre adresse e-mail pour réinitialiser votre mot de passe. Un lien de réinitialisation vous
                    sera envoyé par e-mail.</p>

                <form method="post">
                    <label for="email">Adresse E-mail:</label>
                    <input type="email" id="email" name="email" required>

                    <button type="submit" name="reset">Envoyer le lien de Réinitialisation</button>
                </form>
                ';
  } elseif (isset($_GET['code']) && $_GET['email']) {
    echo '<section id="reset-password">
      <div class="reset-password-container">
          <h2>Réinitialisation du Mot de Passe</h2>

          <p>Entrez un nouveau votre mot de passe.</p>

          <form method="get">
              <label for="password">Mot de passe :</label>
              <input type="email" id="password" name="new-password" required>

              <button type="submit" name="reset-new">Réinitialisé le mot de passe</button>
          </form>
          </div>
                </section>';
  }
  ?>



    <?php
  if (isset($_POST["reset"])) {
    $username = "root";
    $password = "";
    $database = new PDO("mysql:host=localhost;dbname=DRCoffee;", $username, $password);
    $checkmail = $database->prepare("SELECT email, security_code FROM users WHERE email = :email");
    $checkmail->bindParam(":email", $_POST['email']);
    $checkmail->execute();
    if ($checkmail->rowCount() === 1) {
      require_once 'mail.php';
      $mail->addAddress($_POST['email']);
      $user = $checkmail->fetchObject();
      $mail->Subject = "Réinitialisation du Mot de Passe - DRCoffee";
      $mail->Body = '<body style="font-family: \'Roboto\', sans-serif; background-color: #f4f4f4; color: #333; margin: 0; padding: 20px;">
                                                        <div style="max-width: 600px; margin: 0 auto; background-color: #fff; border-radius: 5px; overflow: hidden; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
                                                            <div style="background-color: #D67F2E; padding: 20px; text-align: center; color: #fff;">
                                                                <h1 style="margin: 0;">DRCoffee</h1>
                                                            </div>
                                                            <div style="padding: 20px;">
                                                                <h2 style="color: #D67F2E;">Réinitialisation du Mot de Passe</h2>
                                                                <p>Nous avons reçu une demande de réinitialisation du mot de passe pour votre compte sur DRCoffee. Cliquez sur le lien ci-dessous pour choisir un nouveau mot de passe :</p>
                                                                <p style="text-align: center;">
                                                                    <a href="http://localhost/DRCoffee/reset.php?email=' . $_POST['email'] . '&code=' . $user->security_code . '". style="display: inline-block; background-color: #D67F2E; color: #fff; text-decoration: none; padding: 10px 20px; border-radius: 5px;">Confirmer l\'Inscription</a>
                                                                </p>
                                                                <p>Si vous n\'avez pas initié cette demande, veuillez ignorer cet e-mail.</p>
                                                                <p>Merci,</p>
                                                                <p>L\'équipe DRCoffee</p>
                                                            </div>
                                                            <div style="background-color: #f4f4f4; padding: 10px; text-align: center;">
                                                                <p style="margin: 0; color: #666;">DRCoffee - Casablanca, Maroc</p>
                                                            </div>
                                                        </div>
                                                    </body>';
      $mail->setFrom("oyuncoyt@gmail.com", "DRCoffee");
      $mail->send();
      echo '<p class="sucsses-message">La demande est envoyé, Veuillez vérifier votre boite mail.</p>';
    } else {
      echo '<p class="error-message">Cet mail ne trouve pas dans notre base de données . Veuillez réessayer.</p>';
    }
  }
  ?>
    </div>
    </section>
    </main>
    <?php
  if (isset($_GET['reset-new'])) {
    $username = "root";
    $password = "";
    $database = new PDO("mysql:host=localhost;dbname=DRCoffee;", $username, $password);
    $updatePass = $database->prepare("UPDATE users SET password = :password WHERE email = :email");
    $updatePass->bindParam(":password", $_GET['new-password']);
    $updatePass->bindParam(":email", $_GET['email']);
    if ($updatePass->execute()) {
      echo '<p class="sucsses-message">Le mot de passe rénitialisé par succée.</p>';
    } else {
      echo '<p class="error-message">Une erreur s\'est prosuite. Veuillez réessayer.</p>';
    }
  }
  ?>
    <?php
  require_once "footer.html";
  ?>
    <script src="home.js"></script>
</body>

</html>