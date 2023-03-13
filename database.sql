-- MySQL dump 10.13  Distrib 8.0.31, for Win64 (x86_64)
--
-- Host: localhost    Database: blog_codeigniter
-- ------------------------------------------------------
-- Server version	8.0.31

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `posts` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `slug` varchar(255) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `active` tinyint NOT NULL,
  `userId` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts`
--

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` VALUES (3,'Mi tercer post con cambios','<p>Wo con cambios</p>','mi-tercer-post-con-cambios','2023-02-10 16:04:27',0,1),(4,'hola ke ase este es un titulo muy grande para ver como acaba flotando el titulo dentro del card','hola ke ase','hola-ke-ase','2023-02-11 12:05:01',0,0),(5,'este es un nuevo articulo desde bootstrap','y este es su contenido','este-es-un-nuevo-articulo-desde-bootstrap','2023-02-11 12:45:41',0,0),(9,'sdsffsfsdfsdff','sdfsfsdsdfsdf','sdsffsfsdfsdff','2023-02-11 12:49:59',0,0),(10,'este es otro articulo sobre como ganar una partida al LOL ','Lo primero que debes de hacer es seguirme en redes sociales y meterte un pepino en el culo','este-es-otro-articulo-sobre-como-ganar-una-partida-al-lol','2023-02-11 20:53:12',0,0),(11,'voy a crear un nuevo post','Cambiando la configuracion de carga del modelo','voy-a-crear-un-nuevo-post','2023-02-11 21:33:38',0,0),(13,'mi primer post','contenido del primer post','mi-primer-post','2023-02-11 22:35:46',0,0),(15,'holake ase','asdssdc fdffsd','holake-ase','2023-02-11 23:02:42',0,0),(16,'Creo un nuevo artculo wepute','Con el contenido que yo quiera','creo-un-nuevo-artculo-wepute','2023-02-11 23:18:09',0,0),(17,'dd vale pongo mas','esta reutilizando el componente del formulario','dd-vale-pongo-mas','2023-02-11 23:23:52',0,0),(18,'nuevo articulo texto enriqueto','<b>negrita</b>','nuevo-articulo-texto-enriqueto','2023-02-11 23:33:49',0,0),(19,'si pongo un tiulo el tiny no pilla guay el invalid','<p>Y esto me pillaria ya el <strong>contenido</strong>??? le meto una comillas \"\"</p>','si-pongo-un-tiulo-el-tiny-no-pilla-guay-el-invalid','2023-02-12 00:06:18',0,0),(20,'titulo para ver los enlaces','<p><a title=\"pues a ver que es\" href=\"https://www.google.es\" target=\"_blank\" rel=\"noopener\">Google</a></p>','titulo-para-ver-los-enlaces','2023-02-12 00:24:38',0,0),(21,'esta vez si que me va a dejar','<p><img src=\"https://images.pexels.com/photos/14800043/pexels-photo-14800043.jpeg?auto=compress&amp;cs=tinysrgb&amp;w=1260&amp;h=750&amp;dpr=1\" alt=\"va a ser lo mismo\" width=\"150\" height=\"225\"></p>\r\n<p>&clubs;</p>','esta-vez-si-que-me-va-a-dejar','2023-02-12 00:27:08',0,0),(23,'pues le pongo un titulo no problem','<p>Voy a probar la alineacion</p>\r\n<p style=\"text-align: center;\">con varios parrafos</p>\r\n<p>a ver que pasa</p>','pues-le-pongo-un-titulo-no-problem','2023-02-12 00:46:12',0,0),(24,'titulode tabla','<p>aasddasdas</p>\r\n<p>&nbsp;</p>','titulode-tabla','2023-02-12 01:07:23',0,0),(25,'agrego un emoji a ver','<p>????prueba de iconos</p>','agrego-un-emoji-a-ver','2023-02-12 01:09:42',0,0),(26,'Titulo probando metiendo codigo','<p>Esto es un ejemplo de c&oacute;digo</p>\r\n<pre class=\"language-php\"><code>mysql -u root -p</code></pre>','titulo-probando-metiendo-codigo','2023-02-12 01:13:18',0,0),(29,'Hola voy a crear un articulo','<p>Y este es su contenido, para m&aacute;s, <strong>suscribete</strong>.</p>','hola-voy-a-crear-un-articulo','2023-02-15 23:35:30',0,0);
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(70) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','publisher','user') NOT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Ruben','Glez','ruben@mail.com','rugo','123','publisher',NULL),(2,'ramon','garcia valle','ramon@mail.com','ramoncin','123','admin',NULL),(5,'abellanop','duplo calido','duplo@mail.com','duplo','123','admin',NULL),(6,'lalal','lalal','lalala@lalal.com','lala','123','user',NULL),(7,'lolo','lolo lolo','lolo@mail.com','lolo','123','admin',NULL);
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

-- Dump completed on 2023-03-13  8:27:07
