
DROP TABLE IF EXISTS `membre`;

CREATE TABLE `membre` (
  `id` int NOT NULL AUTO_INCREMENT,
  `prenom` varchar(60) DEFAULT NULL,
  `nom` varchar(60) DEFAULT NULL,
  `age` int DEFAULT NULL,
  `sexe` varchar(40) DEFAULT NULL,
  `stituation` varchar(60) DEFAULT NULL,
  `statut` varchar(70) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


LOCK TABLES `membre` WRITE;

INSERT INTO `membre` VALUES (1,'ndeye','cisse',12,'feminin','celibataire','civile');
INSERT INTO `membre` VALUES (2,'cheikh tidiane','Sané',17,'masculin','celibataire','civile');


UNLOCK TABLES;
