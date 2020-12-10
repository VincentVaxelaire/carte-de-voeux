<?php
if(isset($_POST['mailform'])){
    if(!empty($_POST['nom']) AND !empty($_POST['mail']) AND !empty($_POST['message']) AND !empty($_POST['nomdest'])){
        $header="MIME-Version: 1.0\r\n";
        $header.="From:'https://vincentv.promo-45.codeur.online/cartedevoeux/'\r\n";
        $header.="Content-Type: text/html; charset='utf-8'\r\n";
        $header.="Content-Transfer-Encoding: 8bit\r\n";

        $message='
        <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
        <html xmlns="http://www.w3.org/1999/xhtml">
        <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style type="text/css">
            body {
                margin: 0;
                background-color: #e4e4e4;
            }
            table {
                border-spacing: 0;
            }
            td {
                padding: 0;
            }
            img {
                border: 0;
                display: block;
            }
            a{
                color: #e4e4e4;
            }
            .wrapper{
                width: 100%;
                table-layout: fixed;
                background-color: #333333;
                padding-bottom: 40px;
            }
            .main{
                margin: 0 auto;
                width: 100%;
                max-width: 600px;
                border-spacing: 0;
                font-family: sans-serif;
                color: #e4e4e4;
                background-color: #333333;
                height: 100vh;
            }
            .button{
                background-color: rgb(209, 68, 68);
                color: #e4e4e4;
                text-decoration: none;
                padding: 12px 20px;
                border-radius: 5px;
                font-weight: bold;
            }
        </style>
        </head>
        <body>

            <center class="weapper">

                <table class="main" width="100%">

        <!--EMAIL TITLE-->
                    <tr>
                        <td>
                            <table width="100%">
                                <tr>
                                    <td style="text-align: center;padding: 15px;">
                                        <p style="font-size: 24px; font-weight: bold;">
                                            '.$_POST["nom"].' vous souhaite de bonne fêtes !
                                        </p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

        <!--BANNER IMAGE -->
                    <tr>
                        <td>
                            <img src="https://vincentv.promo-45.codeur.online/cartedevoeux/choco.jpg" alt="bannière" width="600" style="max-width: 100%;">
                        </td>
                    </tr>


        <!-- TITLE, TEXT & BUTTON -->
                    <tr>
                        <td>
                            <table width="100%">
                                <tr>
                                    <td>
                                        <td style="text-align: center;padding: 45px;">
                                            <p style="font-size: 18px; line-height: 24px; padding-bottom: 30px;">
                                            '.nl2br($_POST["message"]).' . Clique sur ce beau bouton pour voir une belle carte de voeux !
                                            </p>
                                            <a href="https://vincentv.promo-45.codeur.online/cartedevoeux/carte.php?d='.$_POST['nomdest'].'" class="button"><strong style="color: #e4e4e4;font-size: 24px">Ce beau bouton</strong></a>
                                        </td>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

        <!-- FOOTER SECTION -->
                    <tr>
                        <td>
                            <table width="100%">
                                <tr>
                                    <td>
                                        <td style="text-align: center;padding-left: 45px;padding-right: 45px;padding: 15px;">
                                            <p style="font-size: 14px; line-height: 18px;">Et bonnes fêtes également de la part de <a href="https://www.accesscodeschool.fr/">l\'Access Code School</a>.</p>
                                        </td>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </center>
        </body>
        </html>
        ';
        
        mail($_POST['mail'], "Vous avez reçu une carte de voeux", $message, $header);
        $msg="Votre carte de voeux a bien été envoyé!";
    }
    else{
        $msg="Tous les champs doivent être renseignés!";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="x-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    <h2>Envoyer une carte de voeux.</h2>
    <form action="" method="POST">
        <input type="text" name="nom" placeholder="Votre prénom + nom" value="<?php if(isset($_POST['nom'])) {echo $_POST['nom'];} ?>">
        <input type="text" name="nomdest" placeholder="Le prénom du destinataire" value="<?php if(isset($_POST['nomdest'])) {echo $_POST['nomdest'];} ?>"><br><br>
        <input type="email" name="mail" placeholder="L'adresse e-mail du destinataire" value="<?php if(isset($_POST['mail'])) {echo $_POST['mail'];} ?>"><br><br>
        <textarea name="message" placeholder="Votre message personnalisé"><?php if(isset($_POST['message'])) {echo $_POST['message'];} ?></textarea><br><br>
        <input type="submit" value="Envoyer !" name="mailform">
    </form>
    <?php 
    if(isset($msg)){
        echo $msg;
    }
    ?>
</body>
</html>