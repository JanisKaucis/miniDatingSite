-- MySQL dump 10.13  Distrib 8.0.23, for Linux (x86_64)
--
-- Host: 127.0.0.1    Database: mini_dating_site
-- ------------------------------------------------------
-- Server version	8.0.23-0ubuntu0.20.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `registered_users`
--

DROP TABLE IF EXISTS `registered_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `registered_users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `surname` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `birth_year` int DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `picture_path` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `registered_users`
--

LOCK TABLES `registered_users` WRITE;
/*!40000 ALTER TABLE `registered_users` DISABLE KEYS */;
INSERT INTO `registered_users` VALUES (38,'Karlis','Kocins','male','karlis@kocins.lv',1992,'$2y$10$IAzWtSxCzjeiIvG/aDJFfuH3mh/YDAOWGkajMCjDn52sw3kTSXGcy','ee/db/eedb99f7c15810dd7136a8562c1b3316.jpg'),(42,'Anna','Buska','female','anna@buska.lv',1989,'$2y$10$ym62aiTZlWyFCkBWpaArLeYOkQEBDX9PgcDlwqwlkFi6EnZZHNaEK','5e/d7/5ed797479f35c93678b3bda1bb2c5edb.jpg'),(43,'Valdis','Bertrups','male','valdis@bertrups.lv',1985,'$2y$10$dCcVNn.7GzcbUPWsLpS/R.ssmegLbne4.eNxr0FoXj8OdUUZeM7Oi','83/f5/83f5a44a888695e034af2d5566dd94db.jpg'),(44,'Peteris','Zarna','male','peteris@zarna.lv',1991,'$2y$10$wa4zI70xjZ5pomlsF8gMJOcJHXnt0EjHK7TEY6ypIgb0uPbJlMIbe','3e/c2/3ec2349023b2dfb79fb6425b00385060.jpg'),(45,'Maris','Olte','male','maris@olte.lv',1973,'$2y$10$zPi2ufitwFkvWT9CdJ.TTOzYpmRJXYFfqEB7XKpwlUoZLQhdgNSAi','2e/48/2e48ae20ca08239fec06a598a8c37e6b.jpg'),(46,'Ojars','Vacietis','male','ojars@vacietis.lv',1985,'$2y$10$oMifpKD2ID3E5TuSLH42HewOEas8hYveZVS4deZmJLkn5wmWWhb3.','cb/7e/cb7ea5630a890e35fcb2225456d9d102.jpg'),(47,'Zigmunds','Truba','male','zigmunds@truba.lv',1980,'$2y$10$vPS5ufmjqqEAq1BSEu75kuXJSK/zwQ1yx37KvI83B4QNoxazWTdnG','84/12/8412b8a39de5615c996d08082b817aad.jpg'),(48,'Adolfs','Merce','male','adolfs@merce.lv',1997,'$2y$10$HGVQTbHEFYToMYuLYRriXOmi4C/FQOTr71MHdtMqwkReT0fE8Ez/C','3b/ee/3beeae9ec494012246b9059e14933167.jpg'),(49,'Zigis','Cerme','male','zigis@cerme.lv',1996,'$2y$10$V6g4O6HxilBwvkjGeQPX/.QildiMXs5NvIZwRnHvbiXCQurmHcJFq','e0/5e/e05e9b487afceec6af22c55726ee3ae4.jpg'),(50,'Ansis','Priede','male','ansis@priede.lv',1981,'$2y$10$Zn3zDydi5YgBSvjN9dm.KeiAzvBiHgzypawXZ.2MlbayxP9GvRB72','43/0b/430b29c1c738ebcadbb4324de13a3f25.jpg'),(51,'Ansis','Kocins','male','ansis@kocins.lv',1999,'$2y$10$66OG5BJmJDnFNmHeM48SKufj5kcXTkIOfW7Q9UDAYMAUaNUSZYYZe','43/2f/432fc0b91d8402aaf98edf61fcfdf661.jpg'),(52,'Rudolfs','Mucenieks','male','rudolfs@mucenieks.lv',1986,'$2y$10$oh2KC3RMqAOf.6Vn2U/f6uL2tAJhTXNuJxKSoMKasU1Eg6fqmdxJS','0c/48/0c4892f3fc4759146bced29bc7aba20c.jpg'),(53,'Janis','Felzens','male','janis@felzens.lv',1987,'$2y$10$hixYTxRllI1wBD04MLIUPOzDqaAwwRaWw4bRz8ONkAayfIITZwq.e','21/50/21508623f6936e95b041b8338d812e8a.jpg'),(54,'Janis','Berzs','male','janis@berzs.lv',1997,'$2y$10$Gw8Uhxl4oHpIPpTn56BGyOPJJIuFbCmFe2mxQq3x1tlF1Gzp5vi6q','6d/2a/6d2aded4adead3c5e8ef13ea6d5355d6.jpg'),(55,'Vilma','Vetra','female','vilma@vetra.lv',1985,'$2y$10$7iREN70yEokhvSHuiv4F/.SJxO4GJUzWWCRK.g4yYA.EtqXF0BB06','d8/4e/d84e68c0956172021e3c057ee14f9448.jpg'),(56,'Zane','Zupa','female','zane@zupa.lv',1993,'$2y$10$9mPnj1eC17h/oaZryqzy7u0BlApDFoGw8/T04aBDi0aj8CVOyTmSS','ff/4e/ff4ecdcc8084fb5eb7333f974dcc20fd.jpg'),(57,'Mara','Perse','female','mara@perse.lv',1987,'$2y$10$XTOPeVnhGdwN32ZatJl28.8OBr.388aCnXiGYgUC62V/5XlMNiOje','aa/bd/aabdbed41e5cf24710b5f26a450e3d11.jpg'),(58,'Elina','Kraukle','female','elina@kraukle.lv',1995,'$2y$10$5On0HRL3FadOsISJn9yTa.V1Z3A/.SHH56KlVOLUO9jeOMENKZIwa','dd/54/dd545581ebdfad82c3858d00d2ec31db.jpg'),(59,'Darta','Frice','female','darta@frice.lv',1988,'$2y$10$XWCgKYRvqTuz6zwUrNGC9uYzWaREg8HY5i8cd6Fc3iE.ocInJXh6m','08/ad/08ad201096087d4a085b51468ac60faf.jpg'),(60,'Katrina','Ulmane','female','katrina@ulmane.lv',1989,'$2y$10$p27HkQjzW0yIsCIKU19gNOgdF8.tHT/YoBstmzxfOgZC/Bx53oZ/6','ef/23/ef2397a57c2bacf33505602b36092058.jpg'),(61,'Marta','Berze','female','marta@berze.lv',1985,'$2y$10$LK4O5DNjwF2MFYOVybUxP.fYqVwJqPceTZd.Hv394DEKl3DNO81.y','f1/b5/f1b55fe1d73dbfa2d90ef706d5027c20.jpg'),(62,'Renate','Ripa','female','renate@ripa.lv',1985,'$2y$10$V1ayDoTiuU20it/Wag5qWe8GhzWY9gYfZCj51Y7iQQPf7xTP0Dcs2','6d/66/6d6637d78a6219cc302d4ded27dba059.jpg'),(63,'Anastasija','Pelde','female','anastasija@pelde.lv',1989,'$2y$10$2.cRav.HT/TqhMg9LYV6iuJVdBmEbPO1Xd/QTiPxMTkH4nHBI7.Oi','c8/83/c88346016a2a577b0bc276bfdf030fd1.jpg');
/*!40000 ALTER TABLE `registered_users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-04-20 11:28:54
