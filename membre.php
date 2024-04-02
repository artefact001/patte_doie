<?php
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
     // methodes pour avoirs acces aux proprietes privees
    // les getter pour recuper
    //  les setter pour avoir acces
    public function getprenom(){
        return $this->prenom;

   }
   public function setprenom($new_prenom){
       $this->prenom=$new_prenom;
   }

   public function getnom(){
    return $this->nom;

}
public function setnom($new_nom){
   $this->nom=$new_nom;
}

public function getage(){
    return $this->age;

}
public function setage($new_age){
   $this->age=$new_age;
}
public function getsexe(){
    return $this->sexe;

}
public function setsexe($new_sexe){
   $this->sexe=$new_sexe;
}
public function getsituation(){
    return $this->situation;

}
public function setsituation($new_situation){
   $this->situation=$new_situation;
}

public function getstatut(){
    return $this->statut;

}
public function setstatut($new_statut){
   $this->statut=$new_statut;
}


// methode pour ajouter des membres


public function add($prenom,$nom,$age,$sexe,$situation,$statut){
    try {
        $sql = "INSERT INTO membre (prenom, nom, age, sexe, situation, statut) VALUES (:prenom, :nom, :age, :sexe, :situation, :statut)";
        $stmt = $this->connexion->prepare($sql);
        $stmt->bindParam(':prenom', $prenom, PDO::PARAM_STR);
        $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
        $stmt->bindParam(':age', $age, PDO::PARAM_STR);
        $stmt->bindParam(':sexe', $sexe, PDO::PARAM_STR);
        $stmt->bindParam(':situation', $situation, PDO::PARAM_STR);
        $stmt->bindParam(':statut', $statut, PDO::PARAM_STR);
        $resultats = $stmt->execute();
        if ($resultats) {
            header("location: idex.php");
            exit();
        } else {
            die("Erreur : Impossible d'insérer des données.");
        }
    } catch (PDOException $e) {
        die("Erreur : Impossible d'insérer des données " . $e->getMessage());
    }
}
}


?>