<?php
// inclure le fichier de la configuration
require_once "config.php";

if(isset($_POST['soumetre'])){
    $prenom=$_POST['prenom'];
    $nom=$_POST['nom'];
    $age=$_POST['age'];
    $sexe=$_POST['sexe'];
    $situation=$_POST['situation'];
    $statut=$_POST['statut']; 

    if($prenom!="" && $nom!="" && $age!="" && $sexe!="" && $situation!="" &&  $statut!=""){
        $membre=new membre ($connexion,"ndeye","cisse",12,"feminin", "mariee", "mariee");
        $membre->add($prenom,$nom,$age,$sexe, $situation, $statut);


    }
 }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>membre patte d'oie</title>
    <link rel="stylesheet" href="style.css">
    
</head>
<body>
<header>
    <nav>
        <a href="idex.php">ADD MEMBRE</a>
        <a href="list_membre.php">LIST_MEMBRE</a> 
    </nav>
  </header> 

  <h1>AJOUTER UN MEMBRE</h1>

<form action="" method="post">
   <fieldset> 
   <div class= "remplir_formulaire">
          <label for="prenom">quelle est le prenom du membre?</label>
          <input type="text" name="prenom">
          
      </div>
          
      <div class="remplir_formulaire">
          <label for="nom">quelle est le nom du membre?</label>
          <input type="text" name="nom">
      </div>
      
      <div class="remplir_formulaire">
          <label for="age">Quelle est l'age du memebre?</label>
          <input type="number" name="age">
      </div>
      <div class="remplir_formulaire">
          <label for="sexe">Quell est le sexe du membre</label>
          <input type="text" name="sexe">
      </div>

      <div class="remplir_formulaire">
          <label for="situation">quelle est la situation du membre?</label>
          <input type="text" name="situation">
      </div>

      <div class="remplir_formulaire">
          <label for="statut">quelle est le statut du membre?</label>
          <select name="statut" id="statut">
            <option value="Chef de quartier">Chef de quartier</option>
            <option value=" civile"> civile</option>
            <option value="badian gokh">badian gokh</option>
          </select>
      </div>
      <div>
      <input type="submit" value="Soumettre" name="soumetre" id="bouton">
       

       </fieldset> 
   
      
      
    
</body>
</html>