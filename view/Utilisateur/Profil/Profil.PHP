<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="../../Origine/CSS/1_Header.css">
    <link rel="stylesheet" type="text/css" href="../../Origine/CSS/2_Main.css">
    <link rel="stylesheet" type="text/css" href="../../Origine/CSS/3_Footer.css">
    <link rel="stylesheet" type="text/css" href="../../Utilisateur/Profil/Profil.css">
    <title>Metric Care</title>
    <link rel="icon" href="../../Origine/Images/Logo.png">
</head>
<body>
<?php
session_start(); // Démarrer la session

if (isset($_SESSION['email'])) {
    $email = $_SESSION['email']; // Récupérer la valeur de la variable
    // Utilisez la variable comme nécessaire dans la page Profil.PHP
} else {
    // La variable n'est pas définie
}

$host = 'localhost';
$username = 'martin';
$dbpassword = 'test';
$dbName = 'metric_care';

$mysqli = mysqli_connect($host, $username, $dbpassword, $dbName);

if (!$mysqli) {
    die('Erreur de connexion à la base de données: ' . mysqli_connect_error());
}

$i = $mysqli->query("SELECT PersonneId FROM personnes  WHERE AdressMail ='$email'");
$id = $i->fetch_assoc();

if (!empty($id)) {
    try {
        $n = $mysqli->query("SELECT Nom FROM personnes  WHERE PersonneId =" . $id['PersonneId']);
        $nom = $n->fetch_assoc();
        $p = $mysqli->query("SELECT Prenom FROM personnes  WHERE PersonneId=" . $id['PersonneId']);
        $prenom = $p->fetch_assoc();
        $a = $mysqli->query("SELECT DateDeNaissance FROM personnes  WHERE PersonneId=" . $id['PersonneId']);
        $age = $a->fetch_assoc();
        $auth = $mysqli->query("SELECT AuthentificationId from authentificationprimaire WHERE PersonneId=" . $id['PersonneId']);
        $numero = $auth->fetch_assoc();
        $e = $mysqli->query("SELECT AdressMail FROM personnes  WHERE PersonneId=" . $id['PersonneId']);
        $email = $e->fetch_assoc();
        $pwd = $mysqli->query("SELECT MotDePas FROM logins  WHERE PersonneId=" . $id['PersonneId']);
        $password = $pwd->fetch_assoc();


    } catch (PDOException $e) {
        $erreur = $e->getMessage();
    }
} else {
    echo 'Veuillez vous connecter.';
}

?>
<header>
      <div id="Rectangle_Debut">
        <nav>
          <div>
            <img id="Logo" src="../../Origine/Images/Logo.png" alt="Logo Metric Metro", width="75", height="40">
            <img id="Logo_Texte" src="../../Origine/Images/Logo_texte.png" alt="Logo Metric Metro", width="200", height="50">
            <a href="https://infinitemeasures.fr/vues/fr/index.php" target="_blank">
            <img id="Logo_Infinite_Measures" src="../../Origine/Images/Infinite_logo.png" alt="Logo Infinite Measures", width="60", height="60"> </a>
          </div>      
          <div class="contenuNav">
            <a>🌐Français</a>
            <a href="../Tableau de bord/Tableau_de_bord.PHP">Tableau de bord</a>
            <a href ="../FAQ/FAQ.PHP">FAQ</a>
            <a href ="../Forum/Forum.PHP">Forum</a>
            <a href ="../Ticket/Ticket.PHP">Ticket</a>
            <a href ="../Profil/Profil.PHP">Profil</a>
          </div>
        </nav>
      </div>
    </header>
<main>
    <div class="title">
        <p>Gestion de profil<p>
    </div>
    <div class="Nom">
        <div class="Intitule">
            <p>Nom<p>
        </div>
        <div class="Entrée">
            <p><?php echo $nom['Nom']; ?><p>
        </div>
    </div>
    <div class="Prénom">
        <div class="Intitule">
            <p>Prénom<p>
        </div>
        <div class="Entrée">
            <p><?php echo $prenom['Prenom']; ?><p>
        </div>
    </div>
    <div class="Prénom">
        <div class="Intitule">
            <p>Prénom<p>
        </div>
        <div class="Entrée">
            <p><?php echo $prenom['Prenom']; ?><p>
        </div>
    </div>
    <div class="Age">
        <div class="Intitule">
            <p>Naissance<p>
        </div>
        <div class="Entrée">
            <p><?php echo $age['DateDeNaissance']; ?><p>
        </div>
    </div>
    <div class="Numéro">
        <div class="Intitule">
            <p>Numéro d'identification<p>
        </div>
        <div class="Entrée">
            <p><?php echo $numero['AuthentificationId']; ?><p>
        </div>
    </div>
    <div class="Email">
        <div class="Intitule">
            <p>E-mail<p>
        </div>
        <div class="Entrée">
            <p><?php echo $email['AdressMail']; ?><p>
        </div>
    </div>
    <div class="MDP">
        <div class="Intitule">
            <p>Mot de passe<p>
        </div>
        <div class="Entrée">
            <p>******<p>
        </div>
        <div class="Reinitialiser">
            <p><a href="../../Utilisateur/Réinitialiser%20mdp/Réinitialiser_mot_de_passe.PHP">Réinitialiser<p>
        </div>
    </div>
    <div class="Tableau">
        <p><a href="../Tableau de bord/Tableau_de_Bord.PHP">◂ Tableau de bord</a><p>
    </div>
    <div class="Deconnexion">
        <p><a href="../../Metric_Care.PHP">Déconnexion</a><p>
    </div>
    <div class='Photo'>
        <?php
        // Affichage de l'image si elle est disponible
        if (!empty($imageData)) {
            echo '<img src="data:image/jpeg;base64,' . base64_encode($imageData) . '" alt="Photo de profil">';
        }
        ?>
      </div>
    
</div>
<div class="Enregistrer">
    <button onclick="window.location.href = '../../Utilisateur/Editer_Profil/Editer_Profil.PHP';">Editer</button>
</div>
<div class="Supprimer">
    <button onclick="window.location.href = '../../Utilisateur/Suppression%20du%20compte/Suppression_du_compte.PHP';">Supprimer le compte</button>
</div>
</main>
<footer class = "Footer">
      <div class = "contenu_Footer">
        <div class="Footer_contenu_Logo">
          <img id="LogoFooter" src="../../Origine/Images/image.png" alt="Logo Metric Metro", width="80", height="80">
          <p>Metric Care © 2023 - Tous droits réservés</p>
          <a href="https://infinitemeasures.fr/vues/fr/index.php" target="_blank">
          <img id="Logo_Infinite_Measures_Footer" src="../../Origine/Images/Infinite_logo.png" alt="Logo Infinite Measures", width="60", height="60"> </a>
        </div>
        <div class="Footer_contenu_texte">
        <div class="Footer_contenu_texte">
          <a href="../../Utilisateur/CGU/CGU.PHP">CGU</a> <a>|</a>
          <a href="../../Utilisateur/AboutUs/AboutUs.PHP">À propos</a> <a>|</a>
          <a >Préférences des cookies</a>
        </div>
        </div>
      </div>
    </footer>
</body>
</html>
