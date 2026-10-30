CREATE DATABASE  IF NOT EXISTS `creatifs` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `creatifs`;
-- MySQL dump 10.13  Distrib 5.7.23, for osx10.9 (x86_64)
--
-- Host: 127.0.0.1    Database: creatifs
-- ------------------------------------------------------
-- Server version	5.7.23

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `abonnes`
--

DROP TABLE IF EXISTS `abonnes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `abonnes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `mail` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `abonnes`
--

LOCK TABLES `abonnes` WRITE;
/*!40000 ALTER TABLE `abonnes` DISABLE KEYS */;
/*!40000 ALTER TABLE `abonnes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `creatifs`
--

DROP TABLE IF EXISTS `creatifs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `creatifs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(45) NOT NULL,
  `bio` text,
  `image` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `creatifs`
--

LOCK TABLES `creatifs` WRITE;
/*!40000 ALTER TABLE `creatifs` DISABLE KEYS */;
INSERT INTO `creatifs` VALUES (1,'Mister Univ\'Hair','Élu « Mister Univ\'Hair » trois années de suite par un jury composé de sa mère, de sa tante et de son chat, il coiffe tout ce qui possède un cuir chevelu. Formé à l\'école du bol, spécialiste des volumes rétro et des permanentes que l\'on croyait disparues, il ne connaît qu\'une règle : si ça tient avec de la laque, ça tient. Sa devise : « Le ridicule ne tue pas, il coiffe. »','creatif_1.jpg'),(2,'Leerdam\'Hair','Ancien fromager reconverti, Leerdam\'Hair a gardé de son premier métier le goût des trous, des formes rondes et des découpes nettes. Rasoir, tondeuse, feutre indélébile : tous les outils sont bons pour faire passer un message. Il ne coiffe pas, il affine. Ses clients repartent rarement comme ils sont venus, et c\'est bien là tout le concept.','creatif_2.jpg'),(3,'Séda\'Tifs','Voix douce, musique zen et lumière tamisée : chez Séda\'Tifs, tout est pensé pour que le client se détende... et ne regarde surtout pas le miroir avant la fin. Spécialiste des volumes monumentaux, des tracés au rasoir et des mulets de compétition, elle travaille lentement, avec la précision d\'une horlogère. Aucun client ne s\'est jamais plaint pendant la séance. Après, c\'est une autre histoire.','creatif_3.jpeg'),(4,'Jupil\'Hair','Jupil\'Hair a ouvert son salon au-dessus d\'un café liégeois, et ça se voit : on y coiffe en musique, en chantant et parfois en trinquant. Grand amateur de hauteur, de mousse et de volume, il pratique une coiffure généreuse qui déborde toujours un peu du cadre. Ses créations sont faites pour être admirées de loin, idéalement depuis l\'autre côté de la rue.','creatif_4.jpg');
/*!40000 ALTER TABLE `creatifs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `projets`
--

DROP TABLE IF EXISTS `projets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `projets` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `titre` varchar(45) NOT NULL,
  `resume` varchar(255) DEFAULT NULL,
  `texte` text,
  `dateCreation` datetime NOT NULL,
  `image` varchar(45) DEFAULT NULL,
  `creatif` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_projets_creatifs_idx` (`creatif`),
  CONSTRAINT `fk_projets_creatifs` FOREIGN KEY (`creatif`) REFERENCES `creatifs` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `projets`
--

LOCK TABLES `projets` WRITE;
/*!40000 ALTER TABLE `projets` DISABLE KEYS */;
INSERT INTO `projets` VALUES (1,'Frange Kamikaze','Une frange tracée au feutre noir, parce que la vraie audace ne pousse pas en un jour. Une création qui résiste au vent, à la pluie et, dans une certaine mesure, au savon.','Pourquoi attendre que la frange repousse quand on a un feutre indélébile sous la main ? La coupe a été complétée au marqueur noir, mèche par mèche, avec une précision d\'architecte. Résultat : une frange qui ne bouge jamais, même par grand vent. Tenue garantie jusqu\'à la prochaine douche, ou la suivante, selon la marque du feutre.','2017-08-17 00:00:00','1.jpg',2),(2,'La Demi-Lune','Un crâne rasé en demi-lune sur le dessus, pour ceux qui n\'arrivent pas à choisir entre la boule à zéro et la tignasse. Le débat reste ouvert, la coupe aussi.','Un côté pour la semaine, l\'autre pour le week-end. Le sommet du crâne a été rasé en arc de cercle pendant que le reste de la chevelure continue sa vie comme si de rien n\'était. Une coupe qui pose une vraie question existentielle : est-ce le début d\'une coupe ou la fin d\'une coupe ? Notre créa\'tif refuse de répondre.','2018-07-18 00:00:00','2.jpg',1),(3,'Brushing Tempête','Un brushing de photo de classe qui a survécu aux années 80, à deux déménagements et à toutes les tentatives de la famille pour faire disparaître le cliché.','Photo de classe, 1989. Deux bombes de laque, un fer à friser réglé au maximum et une confiance absolue dans l\'avenir. Le volume du sommet a été testé en soufflerie : il résiste à des vents de 90 km/h. Un classique de la période permanente-et-épaulettes, restauré ici avec tout le respect qu\'il mérite.','2017-01-17 00:00:00','3.jpg',4),(4,'Crête Flamant Rose','Une crête rose flamant déployée en éventail, pour les jours où l\'on veut être vu depuis l\'espace. Chaque mèche a été sculptée à la main et fixée au gel extra-fort.','Une crête en éventail, déployée comme la roue d\'un paon et teintée dans un rose flamant qu\'on ne trouve dans aucun nuancier officiel. Chaque mèche a été sculptée et fixée individuellement au gel extra-fort. Temps de pose : quatre heures. Temps nécessaire pour passer une porte : à calculer au cas par cas.','2017-03-17 00:00:00','4.jpg',4),(5,'Mulet Zébré','Le mulet des cours de récré, court devant, long derrière, rehaussé d\'une rayure tracée à la tondeuse pour aller plus vite. Un grand retour que personne n\'attendait.','Le mulet, version sport. Court devant pour la réunion, long derrière pour la fête, et une rayure tracée à la tondeuse sur le côté pour les jours où l\'on veut aller plus vite. Le mulet zébré a connu son heure de gloire dans les cours de récré des années 90. Nous l\'avons ressuscité. Personne ne nous l\'avait demandé.','2017-06-17 00:00:00','5.jpg',3),(6,'Le Front Dégagé','Dégagé devant, rockeur derrière : le compromis ultime entre la sagesse et la fête. La moustache assortie prouve qu\'aucun détail n\'a été laissé au hasard.','Devant : dégagé jusqu\'au sommet du crâne. Derrière : de longues mèches qui tombent sur les épaules. Certains appellent ça un compromis, nous appelons ça un manifeste. La moustache assortie complète l\'ensemble et prouve qu\'aucun détail n\'a été laissé au hasard. Enfin, presque aucun.','2018-04-18 00:00:00','6.jpg',2),(7,'Frange Guillotine','Une frange coupée à la règle et deux pointes affûtées : la géométrie sans pitié.','Une frange coupée à la règle, nette et sans pitié, puis deux pattes latérales effilées en pointe jusqu\'au menton. Sur le dessus, quelques piques gélifiées rappellent qu\'il reste un peu de rébellion là-haut. Une coupe géométrique qui a demandé un niveau à bulle, deux paires de ciseaux et énormément de sang-froid.','2017-11-17 00:00:00','7.jpg',1),(8,'Carré Boudeur','Un carré blond parfaitement gonflé sur un visage qui, visiblement, n\'a rien demandé. Premier rendez-vous chez le coiffeur, premier désaccord profond sur le résultat.','Premier passage chez le coiffeur, premier carré, premier avis tranché : c\'est non. Le brushing est pourtant irréprochable, gonflé, lisse et doré comme une brioche. Le modèle, en revanche, n\'a visiblement pas validé le devis. Un souvenir de famille qui ressort à chaque anniversaire, pour le plus grand plaisir de tout le monde, sauf d\'une personne.','2018-07-18 00:00:00','8.jpg',3),(9,'Rideau de Mèches','Quelques mèches torsadées qui tombent devant les yeux comme un rideau de perles des années 70. Idéal pour se cacher pendant les moments gênants, moins pour lire.','Un crâne rasé de près et, au sommet, une poignée de fines mèches torsadées qui retombent devant le visage comme un rideau de perles des années 70. Pratique pour se cacher lors des moments gênants, beaucoup moins pour lire. Une création qui divise l\'équipe depuis le premier jour, ce qui était exactement le but.','2017-04-17 00:00:00','9.jpg',3),(10,'Houppe Façon Canard','Une houppe fière et solitaire, dernière survivante d\'un sommet entièrement dégagé, qui retombe sur le front comme le plumage d\'un canard après l\'averse.','Les côtés ont été dégagés, le sommet aussi, sauf une grande houppe centrale qui retombe fièrement sur le front comme le plumage d\'un canard après l\'averse. Effet garanti de face comme de profil. Le client est reparti avec un grand sourire, ce qui reste à ce jour notre plus grande fierté.','2018-03-18 00:00:00','10.jpg',4),(11,'Tornade Asymétrique','La moitié gauche est sagement plaquée, la moitié droite a sa propre météo. Une asymétrie née d\'un sèche-cheveux oublié d\'un seul côté, devenue une signature.','Côté gauche : sagement plaqué. Côté droit : une tempête de frisottis qui semble avoir sa propre météo. La tornade asymétrique est née d\'un sèche-cheveux oublié d\'un seul côté pendant vingt minutes. Plutôt que de corriger, nous avons décidé d\'en faire une signature. On appelle ça la créativité.','2018-11-18 00:00:00','11.jpg',3),(12,'Champignon à la Crème','Un volume arrondi en forme de champignon de Paris, crêpé à la main puis lissé au peigne fin, servi avec sa sauce sixties et une bonne dose de laque.','Un volume arrondi, lisse et brillant, posé sur la tête comme le chapeau d\'un champignon de Paris. Le sommet a été crêpé à la main, puis lissé au peigne fin et bloqué à la laque. Une coupe très en vogue dans les années 60, que nous servons ici avec une petite sauce vintage. Bon appétit.','2017-05-17 00:00:00','12.jpg',1),(13,'Casque Intégral','Le dôme capillaire intégral, régulier comme un bol retourné, qui descend jusqu\'aux sourcils et protège des chocs, du soleil et surtout des remarques.','Le grand frère du champignon. Même principe, en version renforcée : un dôme parfaitement régulier qui descend jusqu\'aux sourcils et protège efficacement des chocs, du soleil et des remarques. Homologué pour la trottinette ? Pas encore. Mais le dossier a été envoyé.','2017-05-17 00:00:00','13.jpg',4),(14,'Mulet Frisé Junior','Des frisettes bien serrées devant, des longueurs raides derrière : deux coupes pour le prix d\'une, dès le plus jeune âge et pour la photo de classe.','Une permanente bien serrée sur le dessus, des longueurs raides et sages dans le dos. Le mulet frisé junior, c\'est la preuve qu\'on peut avoir deux coupes pour le prix d\'une dès le plus jeune âge. Salopette à carreaux en option, mais fortement recommandée pour l\'authenticité de la photo de classe.','2018-12-18 00:00:00','14.jpg',1),(15,'Rideaux de Velours','Une raie au milieu et deux rideaux de velours qui encadrent le visage, pour une soirée de bal de promo qui semble ne jamais vouloir se terminer.','Raie au milieu, longueurs lisses et deux pans qui encadrent le visage comme les rideaux d\'un vieux théâtre. Avec le nœud papillon, l\'ensemble dégage une élégance de bal de promo très précise, quelque part entre 1991 et 1994. Nous déconseillons fortement les courants d\'air : la raie ne s\'en remettrait pas.','2017-02-17 00:00:00','15.jpg',4),(16,'Boucles d\'Or Mulet','Le mulet version conte de fées : des bouclettes blondes serrées comme des ressorts, des longueurs dans le dos et un pull pastel assorti au fond nuageux.','Des bouclettes serrées comme des ressorts sur le dessus, des longueurs blondes qui glissent dans le dos. Le mulet version conte de fées, avec le pull pastel et le fond nuageux du photographe en prime. Une première coupe mémorable, réalisée avec un fer à boucler minuscule et une patience infinie.','2017-02-17 00:00:00','16.jpg',3),(17,'Casque Tracé au Rasoir','Un contour tracé au rasoir d\'une oreille à l\'autre, qui transforme la chevelure en casque de chantier. Le modèle n\'a pas bougé d\'un millimètre pendant une heure.','Un contour dessiné au rasoir d\'une oreille à l\'autre, qui laisse le haut du crâne parfaitement lisse et le reste de la chevelure en bordure, comme une jugulaire. De profil, on dirait un casque de chantier. De face aussi, d\'ailleurs. Le tracé a demandé une main très sûre et un modèle très, très immobile.','2017-02-17 00:00:00','17.jpg',1),(18,'Double Nuage','Deux énormes nuages de cheveux séparés par une allée de tresses bien nette : l\'ordre et le chaos réunis sur la même tête, sans que personne ne cède.','Deux énormes nuages de cheveux, un de chaque côté, et entre les deux une allée de tresses plaquées bien nette. Une coupe qui refuse de choisir entre l\'ordre et le chaos, et qui décide donc de faire les deux en même temps. Prévoir un peigne afro de compétition et un bon quart d\'heure chaque matin.','2018-05-18 00:00:00','18.jpg',1),(19,'Tour de Pise','Un afro monumental qui penche dangereusement, mais ne tombe jamais.','Un afro monumental, monté d\'un seul côté et légèrement penché, comme la célèbre tour italienne. Les ingénieurs du salon surveillent l\'inclinaison de près : pour l\'instant, tout tient. Le secret de la stabilité ? Une base bien serrée et une confiance absolue dans les lois de la physique.','2018-11-18 00:00:00','19.jpg',3),(20,'Soucoupe Volante','Un plateau parfaitement plat sur le dessus et deux ailes qui dépassent au-dessus des oreilles : la soucoupe est prête pour le décollage, contrôle au sol confirmé.','Un plateau parfaitement plat sur le dessus et, sur les côtés, deux ailes qui dépassent au-dessus des oreilles. De face, la silhouette évoque clairement un objet volant non identifié. Le client affirme capter certaines radios étrangères. Nous ne pouvons ni confirmer ni démentir.','2018-05-18 00:00:00','20.jpg',2),(21,'Queue de Castor','Un bol sage et bien net sur le dessus, une nuque rasée, puis une surprise plate qui pend dans le dos. Discrète de face, franchement spectaculaire de dos.','Un bol bien net sur le dessus, une nuque rasée... et puis, surprise : une large mèche plate qui pend dans le dos comme une queue de castor. Discrète de face, spectaculaire de dos. La coupe idéale pour laisser une impression durable en quittant une pièce.','2017-03-17 00:00:00','21.jpg',2),(22,'Le Château d\'Eau','Vingt centimètres de flat-top à la verticale, taillés au cordeau sur toutes les faces, avec de longues mèches dans le dos pour l\'équilibre et un permis de bâtir.','Un flat-top vertical qui monte, monte et monte encore, taillé au cordeau sur toutes les faces, avec de longues mèches dans le dos pour l\'équilibre. Hauteur mesurée au salon : vingt centimètres. Ce projet a nécessité un escabeau, une tondeuse de précision et l\'accord préalable du service urbanisme.','2017-06-17 00:00:00','22.jpg',3),(23,'Banane Stratosphérique','Une banane rockabilly tellement haute qu\'elle frôle la stratosphère, soutenue par une quantité de gomina tenue secrète et une veste en cuir de circonstance.','La banane rockabilly, poussée jusqu\'à ses limites. Un toupet géant projeté vers le ciel, soutenu par une quantité de gomina que nous préférons ne pas révéler. Le reste des longueurs retombe en cascade sur la veste en cuir. À ce niveau, ce n\'est plus une coiffure, c\'est un programme spatial.','2018-10-18 00:00:00','23.jpg',4),(24,'Store Vénitien','Des cheveux plaqués en arrière, sauf quelques mèches raides qui tombent en lamelles devant le visage, pour voir le monde comme à travers un store à moitié fermé.','Des cheveux plaqués vers l\'arrière, à l\'exception de quelques longues mèches raides qui tombent en lamelles devant le visage. On regarde le monde au travers, comme derrière un store à moitié fermé. Idéal pour les lendemains de fête, déconseillé pour la conduite de nuit.','2017-08-17 00:00:00','24.jpg',2),(25,'Ruche Impériale','Un chignon géant en forme de ruche, couleur miel, monté sur deux étages pour une montée des marches qui ne risquait pas de passer inaperçue.','Un chignon géant en forme de ruche, monté en deux étages sur un support caché et lissé jusqu\'au dernier cheveu. Couleur miel, évidemment. Réalisé pour une montée des marches, il a nécessité trois heures de travail, deux assistants et une voiture à toit ouvrant pour le trajet.','2018-01-18 00:00:00','25.jpg',4),(26,'Chapka Naturelle','Une toque de fourrure entièrement naturelle, dense et ronde sur le dessus, avec de longues mèches sur les côtés. Garantie sans bonnet et sans frissons.','Un volume dense et rond sur le dessus, taillé net comme une toque de fourrure, et de longues mèches lisses qui tombent de chaque côté. Plus besoin de bonnet en hiver : la chapka est intégrée. Une photo de classe très réussie, rehaussée par des bretelles parfaitement assorties.','2017-05-17 00:00:00','26.jpeg',1),(27,'Vagues Gravées','Des vagues sinueuses gravées à la tondeuse sur tout le crâne et une tresse fine interminable dans le dos : la plage à marée basse, directement sur la tête.','Des vagues sinueuses sculptées à la tondeuse sur tout le dessus du crâne, comme les ondulations d\'une plage à marée basse. Pour finir, une très longue tresse fine part de la nuque et descend jusqu\'au milieu du dos. Un travail d\'orfèvre, à mi-chemin entre la coiffure et le tatouage.','2017-02-17 00:00:00','27.jpg',1),(28,'Moustache Frontale','Deux mèches noires recourbées au milieu du front, pour une moustache qui a changé d\'étage. La vraie moustache, juste en dessous, complète la symétrie.','Le crâne a été rasé, sauf deux mèches noires recourbées au milieu du front, qui dessinent une élégante moustache à l\'envers. Et comme une moustache ne vient jamais seule, la vraie est assortie juste en dessous. Une symétrie parfaite qui oblige les gens à choisir où regarder.','2017-02-17 00:00:00','28.jpg',3),(29,'Ananas Tropical','Des écailles gravées à la tondeuse et un plumeau teint en vert vif au sommet : l\'ananas le plus stylé du marché, à déguster de préférence en été.','Un motif d\'écailles gravé à la tondeuse sur l\'arrière et les côtés, et au sommet une touffe teinte en vert vif. Le résultat : un ananas plus vrai que nature. Idéal pour l\'été, les cocktails et les soirées à thème. Attention aux guêpes.','2017-04-17 00:00:00','29.jpg',1),(30,'Cube Parfait','Une tête parfaitement carrée, taillée à l\'équerre.','Une coupe en bloc, taillée à angle droit sur toutes les faces, qui transforme la tête en boîte parfaitement carrée. Les arêtes ont été vérifiées à l\'équerre, la surface supérieure au niveau à bulle. Un hommage vivant à la géométrie euclidienne et, accessoirement, un excellent support pour poser un verre.','2017-07-17 00:00:00','30.jpg',3);
/*!40000 ALTER TABLE `projets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `projets_has_tags`
--

DROP TABLE IF EXISTS `projets_has_tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `projets_has_tags` (
  `projet` int(10) unsigned NOT NULL,
  `tag` int(10) unsigned NOT NULL,
  PRIMARY KEY (`projet`,`tag`),
  KEY `fk_projets_has_tags_tags1_idx` (`tag`),
  KEY `fk_projets_has_tags_projets1_idx` (`projet`),
  CONSTRAINT `fk_projets_has_tags_projets1` FOREIGN KEY (`projet`) REFERENCES `projets` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_projets_has_tags_tags1` FOREIGN KEY (`tag`) REFERENCES `tags` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `projets_has_tags`
--

LOCK TABLES `projets_has_tags` WRITE;
/*!40000 ALTER TABLE `projets_has_tags` DISABLE KEYS */;
INSERT INTO `projets_has_tags` VALUES (3,1),(5,1),(8,1),(11,1),(12,1),(13,1),(14,1),(15,1),(16,1),(22,1),(23,1),(26,1),(12,2),(23,2),(25,2),(29,2),(2,3),(5,3),(7,3),(13,3),(17,3),(20,3),(22,3),(24,3),(27,3),(30,3),(4,4),(29,4),(1,5),(4,5),(17,5),(19,5),(20,5),(21,5),(25,5),(26,5),(28,5),(29,5),(8,6),(14,6),(16,6),(2,7),(6,7),(9,7),(11,7),(18,7),(19,7),(24,7),(27,7),(1,8),(6,8),(9,8),(10,8),(18,8),(21,8),(28,8);
/*!40000 ALTER TABLE `projets_has_tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tags`
--

DROP TABLE IF EXISTS `tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tags` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tags`
--

LOCK TABLES `tags` WRITE;
/*!40000 ALTER TABLE `tags` DISABLE KEYS */;
INSERT INTO `tags` VALUES (1,'Vintage'),(2,'Alimentation'),(3,'Géométrie'),(4,'Couleur'),(5,'Figuratif'),(6,'Baptême'),(7,'Abstract'),(8,'Inclassable');
/*!40000 ALTER TABLE `tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `login` varchar(45) NOT NULL,
  `pwd` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (2,'pascal','pascal');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-09-30 21:14:17
