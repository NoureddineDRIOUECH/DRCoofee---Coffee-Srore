<main>
    <?php
        if(isset($_POST["code"])){
            $username = 'root';
            $password = "";
            $database = new PDO("mysql:host=localhost;dbname=DRCoffee;",$username , $password);
            $chekckCode = $database->prepare("select security_code from users where security_code = :security_code");
            $chekckCode->bindParam("security_code",$_POST["code"]);
            $chekckCode->execute();
            if($chekckCode->rowCount()>0){
                $update = $database->prepare("update users set security_code = :newsecurity_code , activated = true where security_code = :security_code");
                $update->bindParam("security_code",$_POST['code']);
                $security_code = md5(date("h:m:s"));
                $update->bindParam("newsecurity_code",$security_code);
                if($update->execute()){
                    echo "<div> Votre compte est vérifié avec succées, Merci :)</div>";
                }else{
                    echo "<div> Le code n'est pas valide </div>";
                }
            }
        }
    ?>
</main>