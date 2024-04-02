<?php
// Inclure le fichier de connexion à la base de données
include_once "connexion.php";

class MembreModifier {
    private $connexion;
    private $id;
    private $nom;
    private $prenom;
    private $age;
    private $sex;
    private $situation_matrimonial;
    private $statut;
    private $message;

    public function __construct($connexion) {
        $this->connexion = $connexion;
        $this->id = $_GET['id'] ?? null;
        $this->chargerDonnees();
        $this->modifierMembre();
    }

    private function chargerDonnees() {
        if ($this->id) {
            // Récupérer les informations de l'employé à modifier
            $req = $this->connexion->query("SELECT * FROM Membre WHERE id = $this->id");
            $row = $req->fetch_assoc();

            $this->nom = $row['nom'] ?? '';
            $this->prenom = $row['prenom'] ?? '';
            $this->age = $row['age'] ?? '';
            $this->sex = $row['sex'] ?? '';
            $this->situation_matrimonial = $row['situation_matrimonial'] ?? '';
            $this->statut = $row['statut'] ?? '';
        }
    }

    private function modifierMembre() {
        if (isset($_POST['button'])) {
            // Extraction des données envoyées par la méthode POST
            extract($_POST);
            
            // Vérification que tous les champs ont été remplis
            if (!empty($nom) && !empty($prenom) && !empty($age) && !empty($sex) && !empty($situaation_matrimonial) && !empty($statut)) {
                // Requête de mise à jour
                $req = $this->connexion->query("UPDATE employe SET nom = '$nom', prenom = '$prenom', age = $age , sex = '$sex' , situation_matrimonial = '$situation_matrimonial' , statut = '$statut' WHERE id = $this->id");

                if ($req) {
                    // Redirection vers la page d'accueil après la mise à jour réussie
                    header("location: index.php");
                    exit;
                } else {
                    $this->message = "Erreur lors de la mise à jour du membre.";
                }
            } else {
                $this->message = "Veuillez remplir tous les champs !";
            }
        }
    }

    public function afficherMessage() {
        if (isset($this->message)) {
            echo '<p class="erreur_message">' . $this->message . '</p>';
        }
    }
}

// Instanciation de la classe EmployeModifier
$HabitantModifier = new MembreModifier($connexion);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>modifier</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="form">
        <a href="index.php" class="back_btn"><img src="images/back.png"> Retour</a>
        <h2>Modifier le membre : <?= htmlspecialchars($membreModifier->nom) ?> </h2>
        <?php $membreModifier->afficherMessage(); ?>
        <form action="" method="POST">
            <label>Nom</label>
            <input type="text" name="nom" value="<?= htmlspecialchars($membreModifier->nom) ?>">
            <label>Prénom</label>
            <input type="text" name="prenom" value="<?= htmlspecialchars($membreModifier->prenom) ?>">
            <label>Âge</label>
            <input type="number" name="age" value="<?= htmlspecialchars($membreModifier->age) ?>">
            <label>sex</label>
            <input type="text" name="sex" value="<?= htmlspecialchars($membreModifier->sex) ?>">
            <label>situation matrimonial</label>
            <input type="text" name="situation matrimonial" value="<?= htmlspecialchars($membreModifier->situation_matrimonial) ?>">
            <label>statut</label>
            <input type="text" name="statut" value="<?= htmlspecialchars($membreModifier->statut) ?>">
            
            <input type="submit" value="Modifier" name="button">
        </form>
    </div>
</body>
</html>
