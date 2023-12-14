<main>
    <?php
    if (isset($_GET["code"])) {
        require_once 'connectDB.php';
        $security_code = $_GET["code"];
        $checkCode = $database->prepare("select security_code from users where security_code = :security_code");
        $checkCode->bindParam(":security_code", $security_code);
        $checkCode->execute();
        if ($checkCode->rowCount() > 0) {
            $update = $database->prepare("UPDATE users SET security_code = :newsecurity_code , activated = true WHERE security_code = :security_code");
            $update->bindParam(":security_code", $security_code);
            $newsecurity_code = md5(date("h:m:s"));
            $update->bindParam(":newsecurity_code", $newsecurity_code);
            if ($update->execute()) {
                echo '
                <div style="background-color: #4CAF50; color: white; padding: 20px; text-align: center;font-family: sans-serif; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                    <h2>Votre compte est vérifié avec succès!</h2>
                    <pstyle = "
                    font-family: sans-serif; 
                    font-weight: bold;">Merci de vous connecter à votre compte.</p>
                </div>';
            }
        } else {
            echo '
            <div style="background-color: #FF0000; border-radius: 8px; 
            font-family: sans-serif; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); color: white; padding: 20px; text-align: center; margin-top : auto;">
                <h2>Erreur!</h2>
                <p style = "
                font-family: sans-serif; 
                font-weight: bold;">Le code n\'est pas valide.</p>
            </div>';
        }
    }
    ?>
</main>