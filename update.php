

<?php
// inclure le fichier de la configuration
require_once "config.php";

if(isset($_POST['soumetre'])){
    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    $age = $_POST['age'];
    $sexe = $_POST['sexe'];
    $situation = $_POST['situation'];
    $statut = $_POST['statut']; 

    // Récupérer l'ID à partir de la requête GET
    $id = $_GET['id'];

    // Appeler la méthode update avec les nouvelles valeurs
    $membre->update($id, $prenom, $nom, $age, $sexe, $situation, $statut);
    
    // Rediriger vers la page index
    header("location: idex.php");
    exit(); // Terminer le script après la redirection
}

// Récupérer les données de l'étudiant à mettre à jour
$id = $_GET['id'];

if(isset($id)) {
    try {
        // Requête SQL pour sélectionner les données de l'étudiant à mettre à jour
        $sql = "SELECT * FROM membre WHERE id = :id";
        $stmt = $connexion->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        
        if ($stmt->execute()) {
            // Récupération des données de l'étudiant
            $membre = $stmt->fetch(PDO::FETCH_ASSOC);
            $prenom = $membre['prenom'];
            $nom = $membre['nom'];
            $age = $membre['age'];
            $sexe = $membre['sexe'];
            $situation = $membre['situation'];
            $statut = $membre['statut'];
        } else {
            echo "Erreur lors de la récupération des données.";
        }
    } catch(PDOException $e) {
        die("Erreur : " . $e->getMessage());
    }
} else {
    echo "ID non spécifié.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mise à jour du membre</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
    <nav>
        <a href="index.php">Accueil</a>
        <a href="liste.php">Liste des membres</a> 
    </nav>
</header> 

<h1>Mise à jour du membre</h1>

<form action=" update.php?id=<?php echo $id;?>" method="post">
    <fieldset> 
        <div class="remplir_formulaire">
            <label for="prenom">Prénom :</label>
            <input type="text" name="prenom" value="<?php echo $prenom ?>">
        </div>
        <div class="remplir_formulaire">
            <label for="nom">Nom :</label>
            <input type="text" name="nom" value="<?php echo $nom ?>">
        </div>
        <div class="remplir_formulaire">
            <label for="age">Âge :</label>
            <input type="number" name="age" value="<?php echo $age ?>">
        </div>
        <div class="remplir_formulaire">
            <label for="sexe">Sexe :</label>
            <input type="text" name="sexe" value="<?php echo $sexe ?>">
        </div>
        <div class="remplir_formulaire">
            <label for="situation">Situation :</label>
            <input type="text" name="situation" value="<?php echo $situation ?>">
        </div>
        <div class="remplir_formulaire">
            <label for="statut">Statut :</label>
            <select name="statut" id="statut">
                <option value="Chef de quartier" <?php if($statut == "Chef de quartier") echo "selected"; ?>>Chef de quartier</option>
                <option value="Civile" <?php if($statut == "Civile") echo "selected"; ?>>Civile</option>
                <option value="Badian Gokh" <?php if($statut == "Badian Gokh") echo "selected"; ?>>Badian Gokh</option>
            </select>
        </div>
        <input type="submit" value="Soumettre" name="soumetre" id="bouton">
    </fieldset> 
</form>
</body>
</html>
