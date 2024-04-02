<?php
// Inclure le fichier de connexion à la base de données
include_once "connexion.php";

class MembreSupprimer {
    private $connexion;

    public function __construct($connexion) {
        $this->connexion = $connexion;
        $this->supprimerMembre();
    }

    private function supprimerMembre() {
        if (isset($_GET['id'])) {
            // Récupérer l'ID du membre à supprimer
            $id = $_GET['id'];

            // Requête de suppression
            $req = $this->connexion->query("DELETE FROM membre WHERE id = $id");

            // Redirection vers la page index.php
            header("Location: index.php");
            exit; // Arrêter l'exécution du script après la redirection
        }
    }
}

// Instanciation de la classe EmployeSupprimer
$membreSupprimer = new MembreSupprimer($connexion);

