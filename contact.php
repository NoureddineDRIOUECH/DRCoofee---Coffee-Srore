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
    <link rel="stylesheet" href="contact.css" />
    <link rel="icon" href="Images/logoIcon.png" type="image/png" />
    <title>DRCoffee - Contact</title>
</head>

<body>
    <?php
    require_once "nav.php";
    ?>
    <main>
        <section class="contact">
            <div class="contact-container">
                <h2>Contactez-nous</h2>
                <p>
                    Vous avez des questions ou des commentaires ? N'hésitez pas à nous
                    contacter en utilisant le formulaire ci-dessous :
                </p>
                <form class="contact-form" method="post">
                    <label for="name">Nom*</label>
                    <input type="text" id="name" name="name" required />

                    <label for="email">Email*</label>
                    <input type="email" id="email" name="email" required />

                    <label for="message">Message*</label>
                    <textarea id="message" name="message" required></textarea>

                    <button type="submit">Envoyer</button>
                </form>
            </div>
        </section>
    </main>
    <?php
    require_once "footer.html";
    ?>
    <script src="home.js"></script>
</body>

</html>