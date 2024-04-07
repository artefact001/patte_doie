<?php
// inclure le fichier de la configuration
require_once "config.php";

if(isset($_POST['soumettre'])){
    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    $age = $_POST['age'];
    $sexe = $_POST['sexe'];
    $situation_matrimoniale = $_POST['situation_matrimoniale'];
    $statut = $_POST['statut']; 
    $quartier_id = $_POST['quartier'];
    $tranche_age_id = $_POST['tranche_age'];

    // Récupérer l'ID à partir de la requête GET
    $id = $_GET['id'];

    // Appeler la méthode update avec les nouvelles valeurs
    $membre->update($id, $prenom, $nom, $age, $sexe, $situation_matrimoniale, $statut, $quartier_id, $tranche_age_id);
    
    // Rediriger vers la page index
    header("location: index.php");
    exit(); // Terminer le script après la redirection
}

// Récupérer les données du membre à mettre à jour
$id = $_GET['id'];

if(isset($id)) {
    try {
        // Requête SQL pour sélectionner les données du membre à mettre à jour
        $membreData = $membre->readOne($id);
        $prenom = $membreData['prenom'];
        $nom = $membreData['nom'];
        $age = $membreData['age'];
        $sexe = $membreData['sexe'];
        $situation_matrimoniale = $membreData['situation_matrimoniale'];
        $statut = $membreData['statut'];
        $quartier_id = $membreData['quartier_id'];
        $tranche_age_id = $membreData['tranche_age_id'];
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

<form action="update.php?id=<?php echo $id;?>" method="post">
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
            <label for="situation_matrimoniale">Situation Matrimoniale :</label>
            <select name="situation_matrimoniale" id="situation_matrimoniale">
                <option value="Marié" <?php if($situation_matrimoniale == "Marié") echo "selected"; ?>>Marié</option>
                <option value="Célibataire" <?php if($situation_matrimoniale == "Célibataire") echo "selected"; ?>>Célibataire</option>
                <option value="Divorcé" <?php if($situation_matrimoniale == "Divorcé") echo "selected"; ?>>Divorcé</option>
                <option value="Veuf" <?php if($situation_matrimoniale == "Veuf") echo "selected"; ?>>Veuf</option>
                <option value="Veuve" <?php if($situation_matrimoniale == "Veuve") echo "selected"; ?>>Veuve</option>
            </select>
        </div>
        <div class="remplir_formulaire">
            <label for="statut">Statut :</label>
            <select name="statut" id="statut">
                <option value="Chef de quartier" <?php if($statut == "Chef de quartier") echo "selected"; ?>>Chef de quartier</option>
                <option value="Civile" <?php if($statut == "Civile") echo "selected"; ?>>Civile</option>
                <option value="Badian Gokh" <?php if($statut == "Badian Gokh") echo "selected"; ?>>Badian Gokh</option>
            </select>
        </div>
        <div class="remplir_formulaire">
            <label for="quartier">Quartier :</label>
            <select name="quartier" id="quartier">
                <?php
                $quartiers = $quartier->read();
                foreach ($quartiers as $row) {
                    echo "<option value='" . $row['id'] . "'";
                    if ($row['id'] == $quartier_id) {
                        echo " selected";
                    }
                    echo ">" . $row['nom'] . "</option>";
                }
                ?>
            </select>
        </div>
        <div class="remplir_formulaire">
            <label for="tranche_age">Tranche d'âge :</label>
            <select name="tranche_age" id="tranche_age">
                <?php
                $tranches_age = $tranche_age->read();
                foreach ($tranches_age as $row) {
                    echo "<option value='" . $row['id'] . "'";
                    if ($row['id'] == $tranche_age_id) {
                        echo " selected";
                    }
                    echo ">" . $row['contenu'] . "</option>";
                }
                ?>
            </select>
        </div>
        <input type="submit" value="Soumettre" name="soumettre" id="bouton">
    </fieldset> 
</form>
</body>
</html>
