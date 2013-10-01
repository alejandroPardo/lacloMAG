/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 50528
 Source Host           : localhost
 Source Database       : laclomag

 Target Server Type    : MySQL
 Target Server Version : 50528
 File Encoding         : utf-8

 Date: 09/30/2013 21:36:39 PM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `authors`
-- ----------------------------
DROP TABLE IF EXISTS `authors`;
CREATE TABLE `authors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `user_id_idx` (`user_id`),
  CONSTRAINT `authors_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `authors`
-- ----------------------------
BEGIN;
INSERT INTO `authors` VALUES ('1', '2');
COMMIT;

-- ----------------------------
--  Table structure for `editors`
-- ----------------------------
DROP TABLE IF EXISTS `editors`;
CREATE TABLE `editors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `user_id_idx` (`user_id`),
  CONSTRAINT `editors_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `editors`
-- ----------------------------
BEGIN;
INSERT INTO `editors` VALUES ('1', '1');
COMMIT;

-- ----------------------------
--  Table structure for `evaluators`
-- ----------------------------
DROP TABLE IF EXISTS `evaluators`;
CREATE TABLE `evaluators` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `user_id_idx` (`user_id`),
  CONSTRAINT `evaluators_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `logbooks`
-- ----------------------------
DROP TABLE IF EXISTS `logbooks`;
CREATE TABLE `logbooks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(45) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `ip` varchar(45) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `logbooks`
-- ----------------------------
BEGIN;
INSERT INTO `logbooks` VALUES ('1', '2', 'Se ha guardado el paper <strong>Revistas Digitales y Características</strong> en borrador.', '2013-09-30 20:28:22', '::1', 'NOTIFICATION'), ('2', '2', 'Se ha enviado el paper <strong>Revistas Digitales y Características</strong> a edición.', '2013-09-30 20:28:33', '::1', 'NOTIFICATION'), ('3', '1', 'Se han guardado los cambios del paper <strong>Revistas Digitales y Características</strong>.', '2013-09-30 20:34:33', '::1', 'NOTIFICATION');
COMMIT;

-- ----------------------------
--  Table structure for `magazine_files`
-- ----------------------------
DROP TABLE IF EXISTS `magazine_files`;
CREATE TABLE `magazine_files` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `magazine_id` int(11) DEFAULT NULL,
  `file` mediumtext,
  `name` varchar(50) DEFAULT NULL,
  `type` enum('COVER','INDEX','EDITORIAL') DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `edition` varchar(255) DEFAULT NULL,
  `color` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `magazine_id_idx` (`magazine_id`),
  CONSTRAINT `magazine_files_magazine_id` FOREIGN KEY (`magazine_id`) REFERENCES `magazines` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `magazine_papers`
-- ----------------------------
DROP TABLE IF EXISTS `magazine_papers`;
CREATE TABLE `magazine_papers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `magazine_id` int(11) DEFAULT NULL,
  `paper_id` int(11) DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `magazine_id_idx` (`magazine_id`),
  KEY `paper_id_idx` (`paper_id`),
  CONSTRAINT `magazine_papers_magazine_id` FOREIGN KEY (`magazine_id`) REFERENCES `magazines` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `magazine_papers_paper_id` FOREIGN KEY (`paper_id`) REFERENCES `papers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `magazines`
-- ----------------------------
DROP TABLE IF EXISTS `magazines`;
CREATE TABLE `magazines` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `exemplary` int(11) DEFAULT NULL,
  `status` enum('ACTUAL','ARCHIVED','ONCONSTRUCTION') DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `news`
-- ----------------------------
DROP TABLE IF EXISTS `news`;
CREATE TABLE `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `headline` varchar(255) DEFAULT NULL,
  `summary` varchar(512) DEFAULT NULL,
  `content` text,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `photo_url` varchar(255) DEFAULT NULL,
  `more_info_url` varchar(255) DEFAULT NULL,
  `video_url` varchar(255) DEFAULT NULL,
  `author` varchar(50) DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `paper_authors`
-- ----------------------------
DROP TABLE IF EXISTS `paper_authors`;
CREATE TABLE `paper_authors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `paper_id` int(11) DEFAULT NULL,
  `author_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `paper_id_idx` (`paper_id`),
  KEY `author_id_idx` (`author_id`),
  CONSTRAINT `paper_authors_paper_id` FOREIGN KEY (`paper_id`) REFERENCES `papers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `paper_authors_author_id` FOREIGN KEY (`author_id`) REFERENCES `authors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `paper_authors`
-- ----------------------------
BEGIN;
INSERT INTO `paper_authors` VALUES ('1', '1', '1');
COMMIT;

-- ----------------------------
--  Table structure for `paper_evaluators`
-- ----------------------------
DROP TABLE IF EXISTS `paper_evaluators`;
CREATE TABLE `paper_evaluators` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `paper_id` int(11) DEFAULT NULL,
  `evaluator_id` int(11) DEFAULT NULL,
  `status` enum('ASIGNED','ACCEPT','REJECT','APPROVED','MINORCHANGE','AUTHORCHANGE','DENIED','CORRECTED','EDITOR') NOT NULL DEFAULT 'ASIGNED',
  `comment` mediumtext,
  `type` enum('PRINCIPAL','SURROGATE') DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `paper_id_idx` (`paper_id`),
  KEY `evaluator_id_idx` (`evaluator_id`),
  CONSTRAINT `paper_evaluators_paper_id` FOREIGN KEY (`paper_id`) REFERENCES `papers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `paper_evaluators_evaluator_id` FOREIGN KEY (`evaluator_id`) REFERENCES `evaluators` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `paper_files`
-- ----------------------------
DROP TABLE IF EXISTS `paper_files`;
CREATE TABLE `paper_files` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `paper_id` int(11) DEFAULT NULL,
  `raw` mediumtext,
  `name` varchar(255) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `paper_id_idx` (`paper_id`),
  CONSTRAINT `paper_files_paper_id` FOREIGN KEY (`paper_id`) REFERENCES `papers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `paper_files`
-- ----------------------------
BEGIN;
INSERT INTO `paper_files` VALUES ('1', '1', '														<p>\r\n</p><h1><span style=\"color: #000000;\">Revistas digitales</span></h1>\r\n\r\n<p></p>\r\n\r\n<p>  En un principio muchos autores asumieron su propia\r\ndefinición en cuanto al término de revista digital. Para Lancaster (1995), en\r\nel estudio de las publicaciones electrónicas de la investigación, una revista\r\nelectrónica es aquella creada para el medio electrónico y, además solo es\r\ndisponible en ese medio. Por otra parte, para Carbó y Hatada (1996) además de\r\nser una revista en formato electrónico, también consideran que pueden admitir\r\nelementos multimedia, y son distribuidas por \r\ninternet, con un costo menor y publicadas más rápidamente que su versión\r\nimpresa (en caso de poseerla).</p>\r\n<p>Partiendo de las ideas\r\nexpuestas anteriormente podemos decir que una \r\nrevista digital académica es aquella publicación periódica creada\r\nmediante medios electrónicos, que \r\ncomparten un conjunto de características con las revistas impresas y\r\ndisponen de una arquitectura, interacciones, funcionalidades y distribución relacionadas\r\ncon la especificidad del entorno digital. </p>\r\n<p>Gracias a las facilidades que\r\npresentan tecnologías existentes, las revistas digitales cuentan con un\r\nenriquecimiento en cuanto a la presentación de su contenido y pueden tener un\r\nmayor alcance gracias a Internet. Asimismo, Abadal y Rius (2006) ofrecen una\r\nmuestra significativa del incremento de revistas digitales año tras año, se\r\npuede recurrir a uno de los repositorios de revistas científicas más\r\nconsolidado y prestigioso a nivel mundial Ulrich’sPeriodicalDirectory, al\r\nrealizar una consulta de este repositorio en febrero de 2013 se arroja un\r\nresultado de 216.000 revistas académicas activas, las cuales en su mayoría\r\nestán disponibles en formato digital.</p><p>                                                                      <img src=\"../../files/466ca248648b20e37b91c6bd7d2d81d8.jpg\" style=\"width: 452.45345016429354px; height: 409px; \"></p><br>\r\n<h2><span style=\"color: #000000;\">Características</span></h2>\r\n\r\n<p></p>\r\n\r\n<p>Actualmente existen infinidad\r\nde revistas digitales, estén disponibles en Internet o en papel. Pero\r\ngeneralmente presentan unas características básicas que las diferencian, según\r\nCINDOC-CSIC (2004) éstas son:</p>\r\n<p>·<span>  </span><b>Reducción considerable del plazo de espera para la edición</b>. En algunos casos, se\r\npresentan los trabajos antes de estar completamente terminados, lo que se\r\nconoce como preprints.</p>\r\n<p>·<span>  </span><b>Facilidad de acceso</b>. Las revistas electrónicas pueden ser consultadas independientemente\r\ndel lugar en el que se esté y de la hora a la que se quiera acceder a\r\nellas.  Como cualquier producto presente\r\nen Internet las limitaciones espacio-temporales son inexistentes. De igual\r\nforma, la consulta a una revista no está limitada a un solo usuario, ya que\r\nvarias personas pueden leer el mismo artículo de forma simultánea.</p>\r\n<p>·<span>  </span><b>Reducción de los costos de producción, adquisición, almacenamiento y\r\nconservación</b>.\r\nResulta difícil estimar una diferencia entre la producción de una revista\r\ndigital frente a producir una impresa.</p>\r\n<p>·<span>  </span><b>Actualización inmediata</b>. La característica principal de las publicaciones en serie es que\r\nperiódicamente aportan nuevos contenidos. Esta circunstancia se cumple en\r\nlas  revistas electrónica y se mejora, ya\r\nque el usuario podrá disponer de la información nada más que esta se publique,\r\nincluso antes, ya que en ocasiones se ofrecen servicios de pre-publicación, en\r\nlos que se informa de los artículos que serán incluidos en los próximos\r\nnúmeros. La rapidez con la que las revistas electrónicas se actualizan dinamiza\r\nla investigación, ya que los resultados de la misma se difunden en el momento.</p>\r\n<p>·<span>  </span><b>Capacidad de interacción con el lector</b>. Las revistas electrónicas suelen acompañar\r\ncada artículo con la dirección electrónica del autor, con lo cual el\r\nintercambio de impresiones entre los responsables de un texto y sus lectores\r\npueden hacerse de forma muy sencilla e incluso discusión entre lectores.</p>\r\n<p>·<span>  </span><b>Posibilidades de la consulta</b>. La recuperación en las revistas\r\nelectrónica es muy sencilla, ya que todas poseen un motor de búsqueda, al\r\ntiempo que permiten la consulta por números publicados. Sus buscadores suelen\r\nofrecer la posibilidad de emplear búsquedas avanzadas e incluso asistidas, con\r\nlo que las consultas en las mismas es muy sencilla y completa.</p>\r\n\r\n<p></p>\r\n\r\n<p>·<span>  </span><b>Sistema de recuperación de artículo a texto completo rápido y fácil</b>. Habitualmente los artículos\r\nse encuentran almacenados en una base de datos y su acceso se realiza por medio\r\nde procedimientos de los sistemas de recuperación documentales. </p>\r\n<p>·<span>  </span><b>Independencia de los documentos</b>. No siempre es necesario estar suscrito a\r\nuna publicación electrónica para poder consultar su contenido. </p>\r\n<p>·<span>  </span><b>Integración de redes sociales</b>. Las revistas digitales pueden llegar a los\r\nlectores por medio de las redes sociales. Contando con información de interés\r\nen ellas. Hoy en día, las redes sociales están dominando el mundo virtual y\r\nesta integración sin duda alguna traerá consigo mayor interés a la hora de\r\nrealizar una publicación.</p>\r\n\r\n<br><p></p>												', 'Revistas Digitales y Características', 'text/html', 'DB');
COMMIT;

-- ----------------------------
--  Table structure for `papers`
-- ----------------------------
DROP TABLE IF EXISTS `papers`;
CREATE TABLE `papers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `status` enum('UNSENT','SENT','ASIGNED','ONREVISION','REJECTED','APPROVED','PUBLISHED','UNPUBLISHED','REVIEW') NOT NULL DEFAULT 'UNSENT',
  `evaluation_type` enum('BLIND','OPEN','DOUBLEBLIND') NOT NULL DEFAULT 'BLIND',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `papers`
-- ----------------------------
BEGIN;
INSERT INTO `papers` VALUES ('1', 'Revistas Digitales y Características', '2013-09-30 20:28:22', '2013-09-30 20:28:33', 'SENT', 'BLIND');
COMMIT;

-- ----------------------------
--  Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role` varchar(20) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `tokenhash` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username_UNIQUE` (`username`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `users`
-- ----------------------------
BEGIN;
INSERT INTO `users` VALUES ('1', 'editor', 'editor@laclomag.com', 'f6caa9aaf55160618260aac07fab499a70e8e941', 'editor', '2013-09-30 19:47:00', '2013-09-30 20:28:59', '2013-09-30 20:28:59', 'Editor', 'Editor', null), ('2', 'apardo', 'alejandro.pardo.r@gmail.com', 'f6caa9aaf55160618260aac07fab499a70e8e941', 'author', '2013-09-30 20:08:29', '2013-09-30 20:11:22', '2013-09-30 20:11:22', 'Alejandro', 'Pardo', 'd6ec545069593d885524bf19c1b9336f0ae341f2');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
