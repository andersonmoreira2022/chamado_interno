-- MySQL dump 10.19  Distrib 10.3.35-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: chamados
-- ------------------------------------------------------
-- Server version	10.3.35-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2019_08_19_000000_create_failed_jobs_table',1),(4,'2020_12_14_130420_create_admins_table',1),(5,'2021_01_05_120011_create_fornecedors_table',1),(6,'2021_01_05_120030_create_clientes_table',1),(7,'2021_01_14_145448_create_table_operadora',1),(8,'2021_01_14_184839_create_table_chamados',1),(9,'2021_02_10_163843_create_motivos_table',1),(10,'2021_03_02_195646_create_trigger_sequencial',1),(11,'2021_03_08_183115_create_trigger_calcula_tempo_chamado',1),(12,'2021_03_15_170737_create_comentario_chamados_table',1),(13,'2021_04_16_161310_create_cliente_tecnicos_table',1),(14,'2021_04_27_185505_create_rede_interfaces_table',1),(15,'2021_04_27_200136_create_velocidades_table',1),(16,'2021_04_27_200256_create_links_table',1),(17,'2021_04_27_200407_create_meios_table',1),(18,'2021_05_06_235954_create_designacaos_table',1),(19,'2021_07_21_190342_campos_prazos_receitas',2),(20,'2021_07_22_201838_create_log_cliente_tecnicos_table',3),(21,'2021_07_27_213400_create_trigger_sequencial_designacao',3),(22,'2021_08_09_191924_create_cliente_tecnico_uploads_table',3),(23,'2021_08_13_143122_create_audits_table',4),(24,'2019_12_14_000001_create_personal_access_tokens_table',5),(25,'2021_10_15_122703_create_estados_table',6),(26,'2021_10_15_122726_create_cidades_table',6),(27,'2021_12_17_093325_create_permission_tables',7),(28,'2022_01_21_181454_create_cargos_roles_permissions',7),(29,'2022_02_01_153124_create_role_permission_default',7),(30,'2022_05_30_171944_create_fornecedor_cidades_table',8),(31,'2022_06_27_151622_create_cargos_table',9),(32,'2022_06_29_121905_create_situacao_circuitos_table',9),(33,'2022_06_30_155057_create_equipamentos_table',9),(34,'2022_07_01_165114_create_circuito_equipamentos_table',9),(35,'2022_08_09_141831_ajustes_fornecedor',10),(36,'2022_08_12_111050_add_protecao_to_cliente_tecnicos',10),(37,'2022_08_07_150003_create_contratos_table',11),(38,'2022_08_07_152541_create_contrato_designacaos_table',11);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-01-10 14:36:26
