<?php 
$to = $_POST['mail'];
if (preg_match("#@(hotmail|live|msn).[a-z]{2,4}$#", $to)){
    $passage_ligne = "\n";
}else{
    $passage_ligne = "\r\n";
}

$boundary = "-----=".md5(rand());
$sujet = "Une crate de voeux";

$message_html ='
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
        padding-bottom: 40px;
    }
    .main{
        margin: 0 auto;
        width: 100%;
        max-width: 600px;
        border-spacing: 0;
        font-family: sans-serif;
        color: #dd3c3c;
        background-color: #e4e4e4;
        height: 100vh;
    }
    .button{
        width: 100%;
        padding: 10px;
        margin-top: 20px;
        border-radius: 20px;
        border: none;
        border-bottom: 4px solid #8f2020;
        background: #dd3c3c; 
        font-size: 16px;
        font-weight: 400;
        color: #fff;
        text-decoration: none;
    }
    .button:hover {
        background: #8f2020;
    }
</style>
</head>
<body>

    <center class="wrapper">

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
                    <img src="https://vincentv.promo-45.codeur.online/carte-voeux/choco.jpg" alt="bannière" width="600" style="max-width: 100%;">
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
                                    '.nl2br($_POST["message"]).'. <br><br>Clique sur ce beau bouton pour voir une belle carte de voeux !
                                    </p>
                                    <a href="https://vincentv.promo-45.codeur.online/carte-voeux/carte.php?d='.$_POST['nomdest'].'" class="button"><strong style="color: #e4e4e4;font-size: 18px">Ce beau bouton</strong></a>
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

$message_txt = strip_tags($message_html);

$headers = "From: \"Vincent Vaxelaire\"<votre-carte-de-voeux@acs.fr>" . $passage_ligne;
$headers.= "Reply-to: \"Vincent Vaxelaire\"<votre-carte-de-voeux@acs.fr>" . $passage_ligne;
$headers.= "MIME-Version: 1.0" . $passage_ligne;
$headers.= "Content-Type: multipart/alternative;" . $passage_ligne . " boundary=\"" . $boundary . "\"" . $passage_ligne;
$message = $passage_ligne . $boundary . $passage_ligne;

$message .= "Content-Type: text/plain; charset=\"ISO-8859-1\"" . $passage_ligne;
$message .= "Content-Transfer-Encoding: 8bit" . $passage_ligne;
$message .= $passage_ligne . $message_txt . $passage_ligne;
$message .= $passage_ligne . "--" . $boundary . $passage_ligne;

$message .= "Content-Type: text/html; charset=\"ISO-8859-1\"" . $passage_ligne;
$message .= "Content-Transfer-Encoding: 8bit" . $passage_ligne;
$message .= $passage_ligne . $message_html . $passage_ligne;
$message .= $passage_ligne . "--" . $boundary . "--" . $passage_ligne;
$message .= $passage_ligne . "--" . $boundary . "--" . $passage_ligne;

if (mail($to, $sujet, $message, $headers)){
    if(!empty($_POST['nom']) AND !empty($_POST['mail']) AND !empty($_POST['message']) AND !empty($_POST['nomdest'])){
        $msg="Votre carte de voeux a bien été envoyé!";
    }else{
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
    <title>Ma carte de voeux</title>
</head>
<body>
<h1>Ecrire une carte de voeux</h1>
<p>Grace à ce petit formulaire vous pourrez envoyer une carte de voeux à l'un de vos proche. Prennez le temps de lui écrire un petit mot, nous nous chargeront du reste !</p>
    <form action="" class="decor" method="POST">
        <div class="form-left-decoration"></div>
        <div class="form-right-decoration"></div>
        <div class="circle"></div>
            <div class="form-inner">
                <input type="text" name="nom" placeholder="Votre prénom + nom" value="<?php if(isset($_POST['nom'])) {echo $_POST['nom'];} ?>">
                <input type="text" name="nomdest" placeholder="Le prénom du destinataire" value="<?php if(isset($_POST['nomdest'])) {echo $_POST['nomdest'];} ?>"><br><br>
                <input type="email" name="mail" placeholder="L'adresse e-mail du destinataire" value="<?php if(isset($_POST['mail'])) {echo $_POST['mail'];} ?>"><br><br>
                <textarea name="message" placeholder="Votre message personnalisé"><?php if(isset($_POST['message'])) {echo $_POST['message'];} ?></textarea><br><br>
                <?php 
                    if(isset($msg)){
                        echo $msg;
                    }
                ?>
                <input class="button" type="submit" value="Envoyer !" name="mailform">
            </div>
    </form>
</body>
</html>