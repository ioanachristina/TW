-- MySQL dump 10.13  Distrib 8.0.15, for Win64 (x86_64)
--
-- Host: localhost    Database: twproiect
-- ------------------------------------------------------
-- Server version	8.0.15

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
 SET NAMES utf8 ;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `addtable`
--

DROP TABLE IF EXISTS `addtable`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `addtable` (
  `id` int(10) unsigned NOT NULL,
  `tip` varchar(45) NOT NULL,
  `titlu` mediumtext NOT NULL,
  `localitate` varchar(45) NOT NULL,
  `data_form` date NOT NULL,
  `detalii` longtext NOT NULL,
  `data_adaugare` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(10) unsigned NOT NULL,
  KEY `user_id_idx` (`user_id`),
  CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `addtable`
--

LOCK TABLES `addtable` WRITE;
/*!40000 ALTER TABLE `addtable` DISABLE KEYS */;
INSERT INTO `addtable` VALUES (43,'accidente','Accident la Hârlău','Harlau','2019-03-22','Unui bărbat de 27 din judeţul Botoşani i s-a întocmit dosar penal după ce a provocat, ieri, un accident rutier pe raza localităţii Hârlău. Bărbatul se deplasa cu un Volkswagen dinspre Botoşani, iar la un moment dat a intrat într-o depăşire fără a se asigura. A lovit atunci un alt autoturism de aceeaşi marcă, la volanul căruia se afla un alt bărbat, de 53 de ani, din localitatea Popricani. Impactul a fost unul violent. Niciunul dintre şoferi nu a suferit răni grave.','2019-04-17 13:23:58',1),(44,'accidente','Accidente la Lețcani','Letcani','2019-02-06','Trei accidente s-au petrecut în decurs de o oră la Lețcani joi dimineață. Circulația a fost complet blocată. Primul accident s-a petrecut în jurul orei 7:45 pe raza localității Lețcani. Trei mașini au fost implicate, iar două persoane au fost rănite. Al doilea accident s-a produs în jurul orei 8:45 pe drumul care leagă Lețcani de Podu Iloaiei. O autobasculantă a intrat în coliziune cu un autoturism condus de o femeie. Șoferița a ajuns la spital. Despre cel de-al treilea accident nu avem detalii. Știm că au fost implicate două mașini.','2019-04-17 13:24:01',1),(45,'dezastre_naturale','Drumurile au fost inundate de la ploaie','Marasesti','2019-03-10','De la ploaia de seara trecută, drumurile din Mărășești au fost inundate, și apa a ajuns până și în casele oamenilor.','2019-04-17 13:24:05',1),(46,'blocaje','Test de rezistență pentru Pasajul Băncilă','Iasi','2019-04-10','12 camioane care cântăreau peste 400 de tone au traversat pasarela, dar au și staționat pe fiecare porțiune. \"Vor fi încărcate pe pod, în anumite poziții determinate strict de către proiectant, iar în acele poziții se vor măsura deformațiile pe care le suportă podul\", a explicat directorul tehnic al firmei de construcții. Pentru că testele nu au indicat probleme, pasarela va fi deschisă peste o săptămână, la doi ani distanță însă de termenul anunțat inițial pentru punerea în funcțiune. Dar greșelile de proiectare au dus la o amânare.</p>\r\n','2019-04-17 13:24:07',1),(47,'acte_de_vandalism','Bisericile, noua țintă a hoților','Madarjesti','2019-03-28','Biserica de patrimoniu din localitatea Mădârjești a fost construită în 1816 și este vizitată mai mult de hoți decât de enoriași. În ultimii doi ani, au fost reclamate cinci furturi, iar ultimul a avut loc chiar acum 2 săptămâni, când hoții au distrus ușa de la intrare în încercarea de a ajunge la cutia milei. Lăcașul de cult nu are pază sau sistem de alarmare. \"O să punem și noi, dar trebuie să vorbesc cu enoriașii să strângem o colectă și după aceea să punem, altă soluție nu este\", a spus preotul.','2019-04-17 13:24:08',1),(48,'blocaje','Semafoarele \"inteligente\" din Iași provoacă haos','Iasi','2019-04-01',' S-a circulat cu greu dimineață în municipiul Iași. Șoferii au mers bară la bară și au stat și câte o oră ca să traverseze o distanță pe care, de regulă, o parcurgeau în câteva minute. Traficul a fost dat peste cap de noul sistem de management al traficului pe care autoritățile îl testează zilele acestea. \"50 de minute pe o distanță de jumătate de kilometru, maxim.\" \"- Vi se pare că s-a mai fluidizat traficul de când cu semafoarele noi? - Nu, nu, deloc, mai tare încurcă.\"','2019-04-17 13:24:09',1),(49,'blocaje','Restricții de circulație ca urmare a desființării unui imobil','Iasi','2019-01-08','In cursul zilei de astazi se vor lua masuri de restrictionare a circulatiei auto pe strada Scoalei si pe strada Pacurari, pe sensul de coborare, pentru executarea lucrarilor de desfiintare a imobilului situat pe strada Pacurari nr. 86. Traficul auto se va desfasura pe strazile adiacente, sub indrumarea agentilor de poltie. Politia Municipiului Iasi, Biroul Rutier si Politia Locala vor lua deciziile privind inchiderea / restrictionarea circulatiei rutiere, in functie de necesitati, in zona lucrarilor de desfiintare.','2019-04-17 13:24:12',1),(59,'aparitia_cersetoriei','Doi cersetori prinsi cu 3.700 de lei in buzunare, alti 122 identificati de la inceputul anului','Bacau','2019-04-03','Doi frati, unul de 38 si altul de 40 de ani, care cerseau din scaune cu rotile in zona centrala a municipiului Bacau, au fost depistati, in urma controlului corporal efectuat de un echipaj de politie, avand asupra lor suma de 3.730 de lei.\r\n\r\n\"Pentru ca nu au putut justifica provenienta importantei sume, politistii au confiscat banii, iar pe numele celor doi barbati, avand domiciliul in comuna bacauana Orbeni, au deschis dosare penale pentru cersetorie\", a declarat, miercuri, pentru Agerpres, inspector Narcisa Butnaru, purtator de cuvant al Inspectoratului de Politie Judetean Bacau.','2019-04-18 08:36:42',1);
/*!40000 ALTER TABLE `addtable` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `perms`
--

DROP TABLE IF EXISTS `perms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `perms` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tip` varchar(45) NOT NULL,
  `titlu` mediumtext NOT NULL,
  `localitate` varchar(45) NOT NULL,
  `data_form` date NOT NULL,
  `detalii` longtext NOT NULL,
  `data_adaugare` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id_idx` (`user_id`),
  CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `perms`
--

LOCK TABLES `perms` WRITE;
/*!40000 ALTER TABLE `perms` DISABLE KEYS */;
/*!40000 ALTER TABLE `perms` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `roles` (
  `role_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `role_name` varchar(50) NOT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'Admin'),(2,'User'),(3,'SuperUser');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_role`
--

DROP TABLE IF EXISTS `user_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `user_role` (
  `user_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  KEY `user_id` (`user_id`),
  KEY `role_id` (`role_id`),
  CONSTRAINT `user_role_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  CONSTRAINT `user_role_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `roles` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_role`
--

LOCK TABLES `user_role` WRITE;
/*!40000 ALTER TABLE `user_role` DISABLE KEYS */;
INSERT INTO `user_role` VALUES (1,1),(2,3),(21,2),(26,2),(28,3);
/*!40000 ALTER TABLE `user_role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `users` (
  `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nume` varchar(100) NOT NULL,
  `prenume` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `localitate` varchar(100) NOT NULL,
  `parola` varchar(100) NOT NULL,
  `data_adaugare` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `log_in` int(11) DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username_UNIQUE` (`username`),
  UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Pascal','Ioana Cristina','ioanacristina','ioana.pascal@info.uaic.ro','Iasi','30a30767cbff6395a3540cd810dc3b05','2019-03-31 12:28:38',1),(2,'Bucur','Teodor','teobucur','teodor.bucur@info.uaic.ro','Bacau','e10adc3949ba59abbe56e057f20f883e','2019-04-01 07:27:40',2),(21,'Popescu','Maria','mariapopescu','maria.popescu@yahoo.com','Suceava','30a30767cbff6395a3540cd810dc3b05','2019-04-04 19:46:10',NULL),(26,'Paparus','Madalin','madalin.paparus','madalin_paparus@gmail.com','Botosani','fcea920f7412b5da7be0cf42b8c93759','2019-04-04 19:58:17',NULL),(28,'Cotfas','Oana','oana.cotfas','chryssu.tau15@gmail.com','Piatra Neamt','MjIwNTE5OTg=','2019-04-06 07:24:31',NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'twproiect'
--

--
-- Dumping routines for database 'twproiect'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-04-18 22:02:42
