-- MySQL dump 10.13  Distrib 5.7.9, for Win64 (x86_64)
--
-- Host: localhost    Database: restaurant_recipies
-- ------------------------------------------------------
-- Server version	5.7.9

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
-- Table structure for table `ingr_categories`
--

DROP TABLE IF EXISTS `ingr_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ingr_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(45) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ingr_categories`
--

LOCK TABLES `ingr_categories` WRITE;
/*!40000 ALTER TABLE `ingr_categories` DISABLE KEYS */;
INSERT INTO `ingr_categories` VALUES (1,'Fresh Produce','2016-04-26 16:28:04','2016-04-26 16:28:04'),(2,'Frozen Produce','2016-04-26 16:28:05','2016-04-26 16:28:05'),(3,'Fresh Fish/Seafood','2016-04-26 16:28:06','2016-04-26 16:28:06'),(4,'Frozen Fish/Seafood','2016-04-26 16:28:06','2016-04-26 16:28:06'),(5,'Fresh Meat/Poultry','2016-04-26 16:28:07','2016-04-26 16:28:07'),(6,'Frozen Meat/Poultry','2016-04-26 16:28:07','2016-04-26 16:28:07'),(7,'Dairy','2016-04-26 16:28:08','2016-04-26 16:28:08'),(8,'Dry Grocery','2016-04-26 16:28:08','2016-04-26 16:28:08'),(9,'Frozen Grocery','2016-04-26 16:28:09','2016-04-26 16:28:09'),(10,'Chilled Grocery','2016-04-26 16:28:09','2016-04-26 16:28:09');
/*!40000 ALTER TABLE `ingr_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ingredients`
--

DROP TABLE IF EXISTS `ingredients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ingredients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(75) DEFAULT NULL,
  `usda_number` int(6) DEFAULT NULL,
  `ingr_category_id` int(11) NOT NULL,
  `uom_categories_id` int(11) NOT NULL,
  `created_on` datetime DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `usda_number_UNIQUE` (`usda_number`),
  KEY `fk_ingredients_ingr_category1_idx` (`ingr_category_id`),
  KEY `fk_ingredients_uom_categories1_idx` (`uom_categories_id`),
  CONSTRAINT `fk_ingredients_ingr_category1` FOREIGN KEY (`ingr_category_id`) REFERENCES `ingr_categories` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_ingredients_uom_categories1` FOREIGN KEY (`uom_categories_id`) REFERENCES `uom_categories` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ingredients`
--

LOCK TABLES `ingredients` WRITE;
/*!40000 ALTER TABLE `ingredients` DISABLE KEYS */;
INSERT INTO `ingredients` VALUES (1,'Roma Tomato',11529,1,1,'2016-04-26 17:32:55','2016-04-26 17:32:55');
/*!40000 ALTER TABLE `ingredients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ingredients_in_recipes`
--

DROP TABLE IF EXISTS `ingredients_in_recipes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ingredients_in_recipes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `recipes_id` int(11) NOT NULL,
  `ingredients_id` int(11) NOT NULL,
  `units_id` int(11) NOT NULL,
  `amount` decimal(4,2) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_ingredients_in_recipes_ingredients1_idx` (`ingredients_id`),
  KEY `fk_ingredients_in_recipes_recipes1_idx` (`recipes_id`),
  KEY `fk_ingredients_in_recipes_units1_idx` (`units_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ingredients_in_recipes`
--

LOCK TABLES `ingredients_in_recipes` WRITE;
/*!40000 ALTER TABLE `ingredients_in_recipes` DISABLE KEYS */;
/*!40000 ALTER TABLE `ingredients_in_recipes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `recipe_categories`
--

DROP TABLE IF EXISTS `recipe_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `recipe_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(100) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recipe_categories`
--

LOCK TABLES `recipe_categories` WRITE;
/*!40000 ALTER TABLE `recipe_categories` DISABLE KEYS */;
/*!40000 ALTER TABLE `recipe_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `recipes`
--

DROP TABLE IF EXISTS `recipes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `recipes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `servings` int(4) DEFAULT NULL,
  `instructions` longtext,
  `photos` longtext,
  `created_on` datetime DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL,
  `recipe_categories_id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `restaurants_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_recipes_recipe_categories1_idx` (`recipe_categories_id`),
  KEY `fk_recipes_users1_idx` (`users_id`),
  KEY `fk_recipes_restaurants1_idx` (`restaurants_id`),
  CONSTRAINT `fk_recipes_recipe_categories1` FOREIGN KEY (`recipe_categories_id`) REFERENCES `recipe_categories` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_recipes_restaurants1` FOREIGN KEY (`restaurants_id`) REFERENCES `restaurants` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_recipes_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recipes`
--

LOCK TABLES `recipes` WRITE;
/*!40000 ALTER TABLE `recipes` DISABLE KEYS */;
/*!40000 ALTER TABLE `recipes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `restaurants`
--

DROP TABLE IF EXISTS `restaurants`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `restaurants` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `alias` varchar(45) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `city` varchar(45) DEFAULT NULL,
  `state` varchar(2) DEFAULT NULL,
  `zip` varchar(11) DEFAULT NULL,
  `phone_number` int(11) DEFAULT NULL,
  `main_admin_id` int(11) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `restaurants`
--

LOCK TABLES `restaurants` WRITE;
/*!40000 ALTER TABLE `restaurants` DISABLE KEYS */;
/*!40000 ALTER TABLE `restaurants` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `units`
--

DROP TABLE IF EXISTS `units`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `units` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `unit` varchar(45) DEFAULT NULL,
  `abrev` varchar(4) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL,
  `uom_categories_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_units_uom_categories1_idx` (`uom_categories_id`),
  CONSTRAINT `fk_units_uom_categories1` FOREIGN KEY (`uom_categories_id`) REFERENCES `uom_categories` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `units`
--

LOCK TABLES `units` WRITE;
/*!40000 ALTER TABLE `units` DISABLE KEYS */;
INSERT INTO `units` VALUES (1,'Pound','lb','2016-04-26 16:12:45','2016-04-26 16:12:45',1),(2,'Ounce','oz','2016-04-26 16:12:46','2016-04-26 16:12:46',1),(3,'Kilogram','kg','2016-04-26 16:12:47','2016-04-26 16:12:47',1),(4,'Milligram','mg','2016-04-26 16:12:47','2016-04-26 16:12:47',1),(5,'Gallon','gal','2016-04-26 16:12:48','2016-04-26 16:12:48',2),(6,'Quart','qt','2016-04-26 16:12:49','2016-04-26 16:12:49',2),(7,'Pint','pt','2016-04-26 16:12:49','2016-04-26 16:12:49',2),(8,'Cup','c','2016-04-26 16:12:50','2016-04-26 16:12:50',2),(9,'Fluid Ounce','floz','2016-04-26 16:12:50','2016-04-26 16:12:50',2),(10,'Liter','lt','2016-04-26 16:12:51','2016-04-26 16:12:51',2),(11,'Milliliter','ml','2016-04-26 16:12:51','2016-04-26 16:12:51',2),(12,'Each','ea','2016-04-26 16:12:52','2016-04-26 16:12:52',3),(13,'Piece','pc','2016-04-26 16:12:53','2016-04-26 16:12:53',3),(14,'Pack','pk','2016-04-26 16:12:53','2016-04-26 16:12:53',3),(15,'Loaf','lf','2016-04-26 16:12:54','2016-04-26 16:12:54',3);
/*!40000 ALTER TABLE `units` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uom_categories`
--

DROP TABLE IF EXISTS `uom_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uom_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(45) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uom_categories`
--

LOCK TABLES `uom_categories` WRITE;
/*!40000 ALTER TABLE `uom_categories` DISABLE KEYS */;
INSERT INTO `uom_categories` VALUES (1,'Weight','2016-04-26 16:07:52','2016-04-26 16:07:52'),(2,'Volume','2016-04-26 16:07:54','2016-04-26 16:07:54'),(3,'Piece','2016-04-26 16:07:54','2016-04-26 16:07:54');
/*!40000 ALTER TABLE `uom_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(45) DEFAULT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL,
  `restaurants_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_users_restaurants_idx` (`restaurants_id`),
  CONSTRAINT `fk_users_restaurants` FOREIGN KEY (`restaurants_id`) REFERENCES `restaurants` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
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

-- Dump completed on 2016-04-27  9:39:32
