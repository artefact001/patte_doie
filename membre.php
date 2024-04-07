<?php
class Membre {
    private $connexion;
    private $prenom;
    private $nom;
    private $tranche_age_id;
    private $sexe;
    private $situation_matrimoniale; // Nouvelle propriété pour la situation matrimoniale
    private $statut;
    private $situation_id;
    private $quartier_id;

    public function __construct($connexion, $prenom, $nom, $sexe,$situation_matrimoniale,$statut,$situation_id,$tranche_age_id,$quartier_id, ){
        $this->connexion = $connexion;
        $this->prenom = $prenom;
        $this->nom = $nom;
        $this->tranche_age_id = $tranche_age_id;
        $this->sexe = $sexe;
        $this->situation_matrimoniale = $situation_matrimoniale; // Initialisation de la situation matrimoniale
        $this->statut = $statut;
        $this->situation_id = $situation_id;
        $this->quartier_id = $quartier_id;
    }

    // Getters et setters pour la nouvelle propriété

    public function getSituationMatrimoniale() {
        return $this->situation_matrimoniale;
    }

    public function setSituationMatrimoniale($situation_matrimoniale) {
        $this->situation_matrimoniale = $situation_matrimoniale;
    }

    // Méthodes CRUD mises à jour

    public function add($prenom, $nom, $sexe, $situation_id, $statut, $tranche_age_id, $quartier_id, $situation_matrimoniale){
        try {
            $sql = "INSERT INTO membre (prenom, nom, sexe, situation_id, statut, tranche_age_id, quartier_id, situation_matrimoniale) VALUES (:prenom, :nom, :age, :sexe, :situation_id, :statut, :tranche_age_id, :quartier_id, :situation_matrimoniale)";
            $stmt = $this->connexion->prepare($sql);
            $stmt->bindParam(':prenom', $prenom, PDO::PARAM_STR);
            $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
            $stmt->bindParam(':tranche_age_id', $tranche_age_id, PDO::PARAM_INT);
            $stmt->bindParam(':sexe', $sexe, PDO::PARAM_STR);
            $stmt->bindParam(':situation_matrimoniale', $situation_matrimoniale, PDO::PARAM_STR); // Liaison pour la situation matrimoniale
            $stmt->bindParam(':statut', $statut, PDO::PARAM_STR);
            $stmt->bindParam(':situation_id', $situation_id, PDO::PARAM_INT);
            $stmt->bindParam(':quartier_id', $quartier_id, PDO::PARAM_INT);
            $resultats = $stmt->execute();
            if ($resultats) {
                header("location: liste.php");
                exit();
            } else {
                die("Erreur : Impossible d'insérer des données.");
            }
        } catch (PDOException $e) {
            die("Erreur : Impossible d'insérer des données " . $e->getMessage());
        }
    }

    public function read(){

        try{
            $sql="SELECT * FROM membre";
            $stmt=$this->connexion->prepare($sql);
            $stmt->execute();
            $resultats=$stmt->fetchAll(PDO::FETCH_ASSOC);
            return $resultats;

        }

        catch(PDOException $e){
            die("erreur:impossible d'afficher les elements" .$e->getMessage());
        }
    }

    public function update($id, $prenom, $nom, $sexe, $situation_id, $statut, $tranche_age_id, $quartier_id, $situation_matrimoniale){
        try{
            $sql = "UPDATE membre SET prenom = :prenom, nom = :nom, age = :age, sexe = :sexe, situation_id = :situation_id, statut = :statut, tranche_age_id = :tranche_age_id, quartier_id = :quartier_id, situation_matrimoniale = :situation_matrimoniale WHERE id = :id";
            $stmt = $this->connexion->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':prenom', $prenom, PDO::PARAM_STR);
            $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
            $stmt->bindParam(':tranche_age_id', $tranche_age_id, PDO::PARAM_INT);
            $stmt->bindParam(':sexe', $sexe, PDO::PARAM_STR);
            $stmt->bindParam(':situation_id', $situation_id, PDO::PARAM_INT);
            $stmt->bindParam(':statut', $statut, PDO::PARAM_STR);
            $stmt->bindParam(':quartier_id', $quartier_id, PDO::PARAM_INT);
            $stmt->bindParam(':situation_matrimoniale', $situation_matrimoniale, PDO::PARAM_STR); // Liaison pour la situation matrimoniale
            $stmt->execute();
            header("location: liste.php");
            exit();
        } catch(PDOException $e){
            die("Erreur : Impossible de mettre à jour les données : " . $e->getMessage());
        }
    }

    public function delete($id) {
        try {
            $sql = "DELETE FROM membre WHERE id = :id";
            $stmt = $this->connexion->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            header("location: liste.php");
            exit();
        } catch(PDOException $e) {
            die("Erreur : Impossible de supprimer le membre : " . $e->getMessage());
        }
    }
}
?>
