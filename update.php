<?php

// update membre 

class membre {
    private $connexion;
    private $prenom;
    private $nom;
    private $age;
    private $sexe;
    private $situation;
    private $statut;
    public function __construct($connexion,$prenom,$nom,$age,$sexe,$situation,$statut){
        $this->connexion=$connexion;
        $this->prenom=$prenom;
        $this->nom=$nom;
        $this->age=$age;
        $this->sexe=$sexe;
        $this->situation=$situation;
        $this->statut=$statut;
    }

public function update($id, $prenom, $nom, $age, $sexe, $situation, $statut){
    try{
        // requete sql pour modifier
        $sql = "UPDATE membre SET prenom = :prenom, nom = :nom, age = :age, sexe = :sexe, situation = :situation, statut = :statut WHERE id = :id";
        // preparer la requete
        $stmt = $this->connexion->prepare($sql);
        // faire les liaisons des valeurs aux parametres
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':prenom', $prenom, PDO::PARAM_STR);
        $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
        $stmt->bindParam(':age', $age, PDO::PARAM_STR);
        $stmt->bindParam(':sexe', $sexe, PDO::PARAM_STR);
        $stmt->bindParam(':situation', $situation, PDO::PARAM_STR);
        $stmt->bindParam(':statut', $statut, PDO::PARAM_STR);
        $stmt->execute();
        //  rediriger la page
        header("location: liste.php");
        exit(); // Terminer le script après la redirection
    } catch(PDOException $e){
        die("Erreur : Impossible de mettre à jour les données : " . $e->getMessage());
    }
}
 }
 ?>

//update situation professionnel

 <?php
class SituationProfessionnelle {
    private $connexion;
    private $contenu;

    public function __construct($connexion, $contenu) {
        $this->connexion = $connexion;
        $this->contenu = $contenu;
    }
