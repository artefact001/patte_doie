<?php
class Quartier {
    private $connexion;
    private $nom;
    private $nombre_membre;

    public function __construct($connexion, $nom, $nombre_membre) {
        $this->connexion = $connexion;
        $this->nom = $nom;
        $this->nombre_membre = $nombre_membre;
    }

    public function getNom() {
        return $this->nom;
    }

    public function setNom($nom) {
        $this->nom = $nom;
    }

    public function getNombreMembre() {
        return $this->nombre_membre;
    }

    public function setNombreMembre($nombre_membre) {
        $this->nombre_membre = $nombre_membre;
    }

    public function add($nom, $nombre_membre) {
        try {
            $sql = "INSERT INTO Quartier (Nom, Nombre_membre) VALUES (:nom, :nombre_membre)";
            $stmt = $this->connexion->prepare($sql);
            $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
            $stmt->bindParam(':nombre_membre', $nombre_membre, PDO::PARAM_INT);
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

    public function read() {
        try {
            $sql = "SELECT * FROM Quartier";
            $stmt = $this->connexion->prepare($sql);
            $stmt->execute();
            $resultats = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $resultats;
        } catch (PDOException $e) {
            die("Erreur : Impossible d'afficher les éléments " . $e->getMessage());
        }
    }

    public function update($id, $nom, $nombre_membre) {
        try {
            $sql = "UPDATE Quartier SET Nom = :nom, Nombre_membre = :nombre_membre WHERE ID = :id";
            $stmt = $this->connexion->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
            $stmt->bindParam(':nombre_membre', $nombre_membre, PDO::PARAM_INT);
            $stmt->execute();
            header("location: liste.php");
            exit();
        } catch (PDOException $e) {
            die("Erreur : Impossible de mettre à jour les données : " . $e->getMessage());
        }
    }

    public function delete($id) {
        try {
            $sql = "DELETE FROM Quartier WHERE ID = :id";
            $stmt = $this->connexion->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            header("location: liste.php");
            exit();
        } catch (PDOException $e) {
            die("Erreur : Impossible de supprimer le quartier : " . $e->getMessage());
        }
    }
}
?>
