<?php
// inclure le fichier de la configuration
require_once "config.php";

if(isset($_POST['soumetre'])){
    $prenom=$_POST['prenom'];
    $nom=$_POST['nom'];
    $tranche_age_id=$_POST['tranche_age'];
    $sexe=$_POST['sexe'];
    $situation_matrimoniale=$_POST['situation_matrimoniale'];
    $statut=$_POST['statut']; 
    $quartier_id=$_POST['quartier'];

    if($prenom!="" && $nom!="" && $tranche_age_id!="" && $sexe!="" && $situation_matrimoniale!="" && $statut!="" && $quartier_id!=""){
        $membre=new membre ($connexion, "John", "Doe", $tranche_age_id, "Masculin", "Célibataire", "Chef de quartier",$quartier_id);

        $membre->add($prenom,$nom,$tranche_age_id,$sexe, $situation_matrimoniale, $statut, $quartier_id);
    }
}

// Récupération de la liste des quartiers
$quartiers = $quartier->read();

// Récupération de la liste des tranches d'âge
$tranches_age = $tranche_age->read();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un membre</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
    <nav>
        <a href="index.php">Accueil</a>
        <a href="liste.php">Liste des membres</a> 
    </nav>
</header> 

<h1>Ajouter un membre</h1>

<form action="" method="post">
    <fieldset> 
        <div class="remplir_formulaire">
            <label for="prenom">Prénom du membre :</label>
            <input type="text" name="prenom">
        </div>
        <div class="remplir_formulaire">
            <label for="nom">Nom du membre :</label>
            <input type="text" name="nom">
        </div>
        <div class="remplir_formulaire">
            <label for="tranche_age">Tranche d'âge :</label>
            <select name="tranche_age" id="tranche_age">
                <?php foreach ($tranches_age as $tranche_age) : ?>
                    <option value="<?php echo $tranche_age['id']; ?>"><?php echo $tranche_age['contenu']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="remplir_formulaire">
            <label for="sexe">Sexe du membre :</label>
            <select name="sexe" id="sexe">
                <option value="Masculin">Masculin</option>
                <option value="Féminin">Féminin</option>
            </select>
        </div>
        <div class="remplir_formulaire">
            <label for="situation_matrimoniale">Situation matrimoniale :</label>
            <select name="situation_matrimoniale" id="situation_matrimoniale">
                <option value="Célibataire">Célibataire</option>
                <option value="Marié(e)">Marié(e)</option>
                <option value="Divorcé(e)">Divorcé(e)</option>
                <option value="Veuf(ve)">Veuf(ve)</option>
            </select>
        </div>
        <div class="remplir_formulaire">
            <label for="statut">Statut du membre :</label>
            <select name="statut" id="statut">
                <option value="Chef de quartier">Chef de quartier</option>
                <option value="Civile">Civile</option>
                <option value="Badian Gokh">Badian Gokh</option>
            </select>
        </div>
        <div class="remplir_formulaire">
            <label for="quartier">Quartier :</label>
            <select name="quartier" id="quartier">
                <?php foreach ($quartiers as $quartier) : ?>
                    <option value="<?php echo $quartier['id']; ?>"><?php echo $quartier['nom']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <input type="submit" value="Soumettre" name="soumetre" id="bouton">
    </fieldset> 
</form>
</body>
</html>
