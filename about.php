<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="keywords" content="coffee cupochino machine-coffee">
    <meta name="description"
        content="Découvrez un univers de délices caféinés sur DRCoffee. Notre site vous invite à explorer une gamme exquise de cafés, des grains soigneusement sélectionnés aux machines à capsules de pointe. Plongez dans une expérience de magasinage unique où la passion pour le café rencontre l'innovation. Parcourez notre catalogue pour découvrir des saveurs riches, des accessoires élégants et des machines qui transforment chaque tasse en une célébration de l'art du café.">
    <meta name="author" content="Noureddine DRIOUECH">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="home.css">
    <link rel="icon" href="Images/logoIcon.png" type="image/png">
    <link rel="stylesheet" href="about.css">
    <title>DRCoffee - À Propos</title>
</head>

<body>
    <?php
    require_once "nav.html";
    ?>
    <main>
        <section class="about">
            <div class="about-container">
                <h2>À Propos de Nous</h2>
                <p style="display: inline;">Bienvenue chez
                <p style="color: #D67F2E; display: inline; font-weight: bold;">DRCoffee</p>, votre destination ultime
                pour une expérience café exceptionnelle. Fondé avec une passion commune pour la qualité, nous nous
                engageons à vous offrir les meilleurs cafés, machines à capsules et accessoires.</p>

                <p>Notre mission est de rendre chaque tasse de café mémorable. Que vous soyez un amateur de café
                    chevronné ou que vous découvriez les délices du café, nous avons soigneusement sélectionné une gamme
                    qui satisfera vos papilles.</p>

                <div class="divh4">
                    <h4 class="msg">Rejoignez-nous dans notre aventure caféinée et explorez l'art du café avec </h4>
                    <h4 style=" color: #D67F2E; "> DRCoffee</h4>
                    <h4>.</h4>
                </div>

            </div>
        </section>
        <section class="Location">
            <div class="LocationP">
                <h2>Notre Location</h2>
                <img src="Images/locationIcon.png" alt="Location">
                <p>Nous sommes situés au cœur de la Ville Casablanca . Venez nous rendre visite !</p>
            </div>
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m10!1m8!1m3!1d6648.011497404557!2d-7.6133!3d33.5792!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sma!4v1701448799425!5m2!1sen!2sma"
                width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"></iframe>
        </section>
    </main>
    <?php
    require_once "footer.html";
    ?>
</body>

</html>