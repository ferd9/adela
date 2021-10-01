/*
SQLyog Ultimate v8.3 
MySQL - 5.5.16 : Database - bastas
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


/*Table structure for table `abaneado` */

DROP TABLE IF EXISTS `abaneado`;

CREATE TABLE `abaneado` (
  `idbanneado` int(11) NOT NULL,
  `ip` varchar(15) DEFAULT NULL,
  `tipo` char(15) DEFAULT NULL COMMENT 'imagen/post/null',
  `idpa` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`idbanneado`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `abaneado` */

/*Table structure for table `acategoria` */

DROP TABLE IF EXISTS `acategoria`;

CREATE TABLE `acategoria` (
  `idcategoria` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) NOT NULL,
  `fecha` int(11) DEFAULT NULL,
  PRIMARY KEY (`idcategoria`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

/*Data for the table `acategoria` */

insert  into `acategoria`(`idcategoria`,`nombre`,`fecha`) values (1,'Musica',NULL),(2,'Peliculas',NULL),(3,'Tecnologia',NULL),(4,'Hardward',NULL),(5,'Animes',NULL),(6,'Tutoriales',NULL),(7,'Hacks',NULL),(8,'Video Juegos',NULL),(9,'Animacion',NULL),(10,'Lugares',NULL),(11,'Raresas',NULL),(12,'Hentai',NULL),(13,'Chistes',NULL),(14,'Showliwood',NULL),(15,'General',NULL);

/*Table structure for table `acomentario` */

DROP TABLE IF EXISTS `acomentario`;

CREATE TABLE `acomentario` (
  `idcomentario` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_del_comentado` bigint(20) NOT NULL,
  `post_or_imagen` enum('POST','IMAGEN') NOT NULL,
  `nombre` varchar(50) NOT NULL DEFAULT 'anonimo',
  `comentario` tinytext NOT NULL,
  `fecha` int(11) NOT NULL,
  PRIMARY KEY (`idcomentario`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `acomentario` */

insert  into `acomentario`(`idcomentario`,`id_del_comentado`,`post_or_imagen`,`nombre`,`comentario`,`fecha`) values (1,9,'POST','anonimo','<p>asdfasdfasdf</p>',1341341961),(2,3,'POST','anonimo','<p>asdfasdfasdf</p>',1341342736),(3,1,'POST','anonimo','<p>aime desconocidoo</p>',1345093441);

/*Table structure for table `adl_album` */

DROP TABLE IF EXISTS `adl_album`;

CREATE TABLE `adl_album` (
  `idalbum` bigint(20) NOT NULL AUTO_INCREMENT,
  `idperfil` bigint(20) NOT NULL,
  `nombre` varchar(125) NOT NULL,
  `portada` bigint(20) DEFAULT NULL,
  `url_portada` varchar(250) DEFAULT NULL,
  `descripcion` varchar(500) NOT NULL,
  `idvisibilidad` int(11) NOT NULL,
  `fecha` int(11) NOT NULL,
  PRIMARY KEY (`idalbum`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `adl_album` */

insert  into `adl_album`(`idalbum`,`idperfil`,`nombre`,`portada`,`url_portada`,`descripcion`,`idvisibilidad`,`fecha`) values (1,19,'Imagenes de perfil',NULL,NULL,'album creando el 06-07-2012',1,1341554436),(2,20,'Imagenes de perfil',NULL,NULL,'album creando el 06-07-2012',1,1341596170),(3,21,'Imagenes de perfil',NULL,NULL,'album creando el 16-08-2012',1,1345149388),(4,22,'Imagenes de perfil',NULL,NULL,'album creando el 17-08-2012',1,1345169082);

/*Table structure for table `adl_amistad` */

DROP TABLE IF EXISTS `adl_amistad`;

CREATE TABLE `adl_amistad` (
  `idamistad` bigint(20) NOT NULL AUTO_INCREMENT,
  `idsolicitante` bigint(20) DEFAULT NULL,
  `idsolicitado` bigint(20) DEFAULT NULL,
  `essolicitante` enum('SI','NO') DEFAULT NULL,
  `pendiente` enum('SI','NO') DEFAULT 'SI',
  `aceptado` enum('SI','NO') DEFAULT 'NO',
  `rechazado` enum('SI','NO') DEFAULT 'NO',
  `eliminado` enum('SI','NO') DEFAULT 'NO',
  `fecha` int(11) DEFAULT NULL,
  PRIMARY KEY (`idamistad`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `adl_amistad` */

/*Table structure for table `adl_bebidas` */

DROP TABLE IF EXISTS `adl_bebidas`;

CREATE TABLE `adl_bebidas` (
  `idbebidas` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) DEFAULT NULL,
  `tipo` varchar(1) DEFAULT NULL,
  `fecha` int(11) DEFAULT NULL,
  PRIMARY KEY (`idbebidas`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `adl_bebidas` */

/*Table structure for table `adl_bitacora` */

DROP TABLE IF EXISTS `adl_bitacora`;

CREATE TABLE `adl_bitacora` (
  `idbitacora` bigint(20) NOT NULL AUTO_INCREMENT,
  `idusuario` bigint(20) DEFAULT NULL,
  `navegador` varchar(50) DEFAULT NULL,
  `version_navegador` varchar(50) DEFAULT NULL,
  `so` varchar(50) DEFAULT NULL,
  `ip` varchar(20) DEFAULT NULL,
  `fecha` int(11) DEFAULT NULL,
  `f_ultimo_ingreso` int(11) DEFAULT NULL,
  PRIMARY KEY (`idbitacora`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

/*Data for the table `adl_bitacora` */

insert  into `adl_bitacora`(`idbitacora`,`idusuario`,`navegador`,`version_navegador`,`so`,`ip`,`fecha`,`f_ultimo_ingreso`) values (1,20,'firefox','10.0','windows','::1',1341596170,1341596170),(2,20,'firefox','10.0','windows','::1',1341601317,1341596170),(3,20,'firefox','10.0','windows','::1',1341851246,1341601317),(4,20,'firefox','10.0','windows','::1',1341860195,1341851246),(5,21,'firefox','9.0','windows','::1',1345149388,1345149388),(6,21,'firefox','9.0','windows','::1',1345150071,1345149388),(7,22,'firefox','9.0','windows','::1',1345169082,1345169082);

/*Table structure for table `adl_cmt_album` */

DROP TABLE IF EXISTS `adl_cmt_album`;

CREATE TABLE `adl_cmt_album` (
  `id_cometario_album` bigint(20) NOT NULL AUTO_INCREMENT,
  `idusuario` bigint(20) NOT NULL,
  `idalbum` bigint(20) NOT NULL,
  `contenido` text NOT NULL,
  `idvisibilidad` int(11) DEFAULT NULL,
  `fecha` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_cometario_album`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `adl_cmt_album` */

/*Table structure for table `adl_cmt_estado` */

DROP TABLE IF EXISTS `adl_cmt_estado`;

CREATE TABLE `adl_cmt_estado` (
  `idcomentario_estado` bigint(20) NOT NULL AUTO_INCREMENT,
  `idestado` bigint(20) DEFAULT NULL,
  `idusuario` bigint(20) DEFAULT NULL,
  `contenido` text,
  `idvisibilidad` int(11) DEFAULT NULL,
  `fecha` int(11) DEFAULT NULL,
  PRIMARY KEY (`idcomentario_estado`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `adl_cmt_estado` */

/*Table structure for table `adl_cmt_foto` */

DROP TABLE IF EXISTS `adl_cmt_foto`;

CREATE TABLE `adl_cmt_foto` (
  `id_comentario_foto` bigint(20) NOT NULL AUTO_INCREMENT,
  `idusuario` bigint(20) NOT NULL,
  `idfoto` bigint(20) NOT NULL,
  `contenido` text NOT NULL,
  `idvisibilidad` int(11) DEFAULT NULL,
  `fecha` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_comentario_foto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `adl_cmt_foto` */

/*Table structure for table `adl_cmt_post` */

DROP TABLE IF EXISTS `adl_cmt_post`;

CREATE TABLE `adl_cmt_post` (
  `id_comentario_post` bigint(20) DEFAULT NULL,
  `idusuario` bigint(20) DEFAULT NULL,
  `idpost` bigint(20) DEFAULT NULL,
  `contendo` text,
  `idvisibilidad` int(11) DEFAULT NULL,
  `fecha` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `adl_cmt_post` */

/*Table structure for table `adl_discotecas` */

DROP TABLE IF EXISTS `adl_discotecas`;

CREATE TABLE `adl_discotecas` (
  `iddiscotecas` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) DEFAULT NULL,
  `fecha` int(11) DEFAULT NULL,
  PRIMARY KEY (`iddiscotecas`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `adl_discotecas` */

/*Table structure for table `adl_estado` */

DROP TABLE IF EXISTS `adl_estado`;

CREATE TABLE `adl_estado` (
  `idestado` bigint(20) NOT NULL AUTO_INCREMENT,
  `idperfil` bigint(20) NOT NULL,
  `idfriend` bigint(20) DEFAULT NULL,
  `idfoto` bigint(20) DEFAULT NULL,
  `contenido` text NOT NULL,
  `content_link` text,
  `tipo` enum('ESTADO','PUBLICACION') DEFAULT 'ESTADO',
  `eliminado` enum('SI','NO') DEFAULT 'NO',
  `idvisibilidad` int(11) DEFAULT NULL,
  `fecha` int(11) NOT NULL,
  PRIMARY KEY (`idestado`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `adl_estado` */

/*Table structure for table `adl_foto` */

DROP TABLE IF EXISTS `adl_foto`;

CREATE TABLE `adl_foto` (
  `idfoto` bigint(20) NOT NULL AUTO_INCREMENT,
  `idperfil` bigint(20) NOT NULL,
  `idalbum` bigint(20) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `esfotoperfil` enum('SI','NO') NOT NULL DEFAULT 'NO',
  `esfotoportada` enum('SI','NO') NOT NULL DEFAULT 'NO',
  `descripcion` varchar(500) NOT NULL,
  `extension` varchar(10) DEFAULT NULL,
  `alto` int(11) DEFAULT NULL,
  `ancho` int(11) DEFAULT NULL,
  `peso` int(11) DEFAULT NULL,
  `ruta` varchar(150) DEFAULT NULL,
  `directorio` varchar(150) DEFAULT NULL,
  `thumb_nom` varchar(100) DEFAULT NULL,
  `thumb_alto` int(11) DEFAULT NULL,
  `thumb_ancho` int(11) DEFAULT NULL,
  `thumb_ruta` varchar(150) DEFAULT NULL,
  `thumb_directorio` varchar(150) DEFAULT NULL,
  `enpapelera` enum('SI','NO') DEFAULT 'NO',
  `idvisibilidad` int(11) DEFAULT NULL,
  `fecha` int(11) DEFAULT NULL,
  PRIMARY KEY (`idfoto`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `adl_foto` */

insert  into `adl_foto`(`idfoto`,`idperfil`,`idalbum`,`nombre`,`esfotoperfil`,`esfotoportada`,`descripcion`,`extension`,`alto`,`ancho`,`peso`,`ruta`,`directorio`,`thumb_nom`,`thumb_alto`,`thumb_ancho`,`thumb_ruta`,`thumb_directorio`,`enpapelera`,`idvisibilidad`,`fecha`) values (1,20,2,'20_R_ep_299083_3.jpg','SI','NO','Imagen de perfil','image/jpeg',720,1280,498874,'C:/xampp/htdocs/adela/ruploads/2012/20','/ruploads/2012/20','thumb20_R_ep_299083_3.jpg',180,200,'C:/xampp/htdocs/adela/rthumb/2012/20','/rthumb/2012/20','NO',1,1341596209);

/*Table structure for table `adl_gustos` */

DROP TABLE IF EXISTS `adl_gustos`;

CREATE TABLE `adl_gustos` (
  `idgustos` int(11) NOT NULL AUTO_INCREMENT,
  `idperfil` bigint(20) DEFAULT NULL,
  `tipo` varchar(50) DEFAULT NULL,
  `idmigusto` int(11) DEFAULT NULL,
  PRIMARY KEY (`idgustos`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `adl_gustos` */

/*Table structure for table `adl_libros` */

DROP TABLE IF EXISTS `adl_libros`;

CREATE TABLE `adl_libros` (
  `idlibros` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(125) DEFAULT NULL,
  `genero` varchar(50) DEFAULT NULL,
  `fecha` int(11) DEFAULT NULL,
  PRIMARY KEY (`idlibros`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `adl_libros` */

/*Table structure for table `adl_musica` */

DROP TABLE IF EXISTS `adl_musica`;

CREATE TABLE `adl_musica` (
  `idmusica` int(11) NOT NULL AUTO_INCREMENT,
  `genero` varchar(120) DEFAULT NULL,
  `fecha` int(11) DEFAULT NULL,
  PRIMARY KEY (`idmusica`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `adl_musica` */

/*Table structure for table `adl_noticias_amistad` */

DROP TABLE IF EXISTS `adl_noticias_amistad`;

CREATE TABLE `adl_noticias_amistad` (
  `idnoticias` bigint(20) NOT NULL AUTO_INCREMENT,
  `tipo` char(15) DEFAULT NULL,
  `idestado` bigint(20) DEFAULT NULL,
  `idamistad` bigint(20) DEFAULT NULL,
  `idpost` bigint(20) DEFAULT NULL,
  `idcmtestado` bigint(20) DEFAULT NULL,
  `idcmtalbum` bigint(20) DEFAULT NULL,
  `idcmtpost` bigint(20) DEFAULT NULL,
  `idcmtfoto` bigint(20) DEFAULT NULL,
  `notificado` char(1) DEFAULT NULL,
  `fecha` int(11) DEFAULT NULL,
  PRIMARY KEY (`idnoticias`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `adl_noticias_amistad` */

/*Table structure for table `adl_peliculas` */

DROP TABLE IF EXISTS `adl_peliculas`;

CREATE TABLE `adl_peliculas` (
  `idpeliculas` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(125) DEFAULT NULL,
  `genero` varchar(50) DEFAULT NULL,
  `fecha` int(11) DEFAULT NULL,
  PRIMARY KEY (`idpeliculas`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `adl_peliculas` */

/*Table structure for table `adl_perfil` */

DROP TABLE IF EXISTS `adl_perfil`;

CREATE TABLE `adl_perfil` (
  `idperfil` bigint(20) NOT NULL AUTO_INCREMENT,
  `login` varchar(250) DEFAULT NULL,
  `foto` bigint(20) DEFAULT NULL,
  `s_sentimental` enum('S','C','A','CMP','ABIERTA','COMPLICADA','DIFICIL') DEFAULT NULL,
  `frase` varchar(250) DEFAULT NULL,
  `especialidad_social` varchar(300) DEFAULT NULL,
  `intereses` char(1) DEFAULT NULL,
  `descripcion` text,
  `fono` varchar(15) DEFAULT NULL,
  `movil` varchar(15) DEFAULT NULL,
  `nextel` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`idperfil`),
  CONSTRAINT `FK_adl_perfil` FOREIGN KEY (`idperfil`) REFERENCES `adl_usuario` (`idusuario`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

/*Data for the table `adl_perfil` */

insert  into `adl_perfil`(`idperfil`,`login`,`foto`,`s_sentimental`,`frase`,`especialidad_social`,`intereses`,`descripcion`,`fono`,`movil`,`nextel`) values (20,'jleod7',1,'S','mglasdjfas afsdfhlasdf','odaud dfashdf hasdfas sadhflkasd','M','lkdajdsoldyad adfnasld asdfashdflasdfasd asdfahsdjf','123-1234','123456789','488*7988'),(21,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(22,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);

/*Table structure for table `adl_perfil_visual` */

DROP TABLE IF EXISTS `adl_perfil_visual`;

CREATE TABLE `adl_perfil_visual` (
  `idcvp` int(11) NOT NULL AUTO_INCREMENT,
  `idperfil` bigint(20) DEFAULT NULL,
  `url_css` varchar(250) DEFAULT NULL,
  `css_content` text,
  `fondo_remote_img` varchar(250) DEFAULT NULL,
  `fondo_video` text,
  `idfoto` bigint(20) DEFAULT NULL,
  `fecha` int(11) DEFAULT NULL,
  PRIMARY KEY (`idcvp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `adl_perfil_visual` */

/*Table structure for table `adl_post` */

DROP TABLE IF EXISTS `adl_post`;

CREATE TABLE `adl_post` (
  `idpost` bigint(20) NOT NULL AUTO_INCREMENT,
  `idperfil` bigint(20) NOT NULL,
  `idfoto` bigint(20) DEFAULT NULL,
  `titulo` varchar(350) NOT NULL,
  `contenido` text NOT NULL,
  `etiquetas` varchar(400) NOT NULL,
  `idvisibilidad` int(11) DEFAULT NULL,
  `estado` char(1) DEFAULT NULL,
  `fecha_modificacion` int(11) DEFAULT NULL,
  `fecha` int(11) DEFAULT NULL,
  PRIMARY KEY (`idpost`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `adl_post` */

/*Table structure for table `adl_restringidos` */

DROP TABLE IF EXISTS `adl_restringidos`;

CREATE TABLE `adl_restringidos` (
  `idrestringidos` bigint(20) NOT NULL AUTO_INCREMENT,
  `idusuario` bigint(20) DEFAULT NULL,
  `idvisivilidad` bigint(20) DEFAULT NULL,
  `idusuario_restric` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`idrestringidos`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `adl_restringidos` */

/*Table structure for table `adl_usuario` */

DROP TABLE IF EXISTS `adl_usuario`;

CREATE TABLE `adl_usuario` (
  `idusuario` bigint(20) NOT NULL AUTO_INCREMENT,
  `email` varchar(250) NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `apellidos` varchar(250) NOT NULL,
  `sexo` char(1) NOT NULL,
  `clave` varchar(125) NOT NULL,
  `salt` varchar(125) NOT NULL,
  `f_nacimiento` int(11) DEFAULT NULL,
  `banneado` char(1) DEFAULT NULL,
  `confirmado` char(1) DEFAULT '0',
  `fecha_reg` int(11) NOT NULL,
  PRIMARY KEY (`idusuario`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

/*Data for the table `adl_usuario` */

insert  into `adl_usuario`(`idusuario`,`email`,`nombre`,`apellidos`,`sexo`,`clave`,`salt`,`f_nacimiento`,`banneado`,`confirmado`,`fecha_reg`) values (20,'leo_17_b@hotmail.com','test1','testing1','H','d598844f49243cc28c36f142f8f59e1d','moc.liamtoh@b_71_oel4ff72209ba6b0',441759600,'0','0',1341595472),(21,'jfer17@yahoo.es','leo','test','H','d61bfde2043fdb51078fb7bf8b5636ae','se.oohay@71refj502d59cbac5a8',795567600,'0','0',1345149331),(22,'leo2_17_b@hotmail.com','test','tes','H','6f712126d0a001ca2b87e4a2d498d793','moc.liamtoh@b_71_2oel502da6b9b824a',718498800,'0','0',1345169050);

/*Table structure for table `adl_vbd_personal` */

DROP TABLE IF EXISTS `adl_vbd_personal`;

CREATE TABLE `adl_vbd_personal` (
  `idrestricion` bigint(20) NOT NULL AUTO_INCREMENT,
  `idVisibilidad` bigint(20) NOT NULL,
  `idusuario` bigint(20) NOT NULL COMMENT 'usuario restringido',
  `tipo_restriccion` enum('PERMITIDO','BLOQUEADO') NOT NULL,
  PRIMARY KEY (`idrestricion`),
  UNIQUE KEY `idrestricion` (`idrestricion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='esta tabla almacenas a los amigos seleccionado de un usuario';

/*Data for the table `adl_vbd_personal` */

/*Table structure for table `adl_visibilidad` */

DROP TABLE IF EXISTS `adl_visibilidad`;

CREATE TABLE `adl_visibilidad` (
  `idvisibilidad` bigint(20) NOT NULL AUTO_INCREMENT,
  `tipo` enum('PRIVADO','AMIGO','PUBLICO','PERSONALIZADO') DEFAULT 'AMIGO',
  `ver` enum('NO','SI') DEFAULT 'SI',
  `comentar` enum('NO','SI') DEFAULT 'SI',
  `compartir` enum('NO','SI') DEFAULT 'SI',
  `fecha` int(11) DEFAULT NULL,
  PRIMARY KEY (`idvisibilidad`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `adl_visibilidad` */

insert  into `adl_visibilidad`(`idvisibilidad`,`tipo`,`ver`,`comentar`,`compartir`,`fecha`) values (1,'AMIGO','SI','SI','SI',NULL),(2,'PRIVADO','NO','NO','NO',NULL),(3,'PUBLICO','SI','SI','SI',NULL);

/*Table structure for table `aetiquetas` */

DROP TABLE IF EXISTS `aetiquetas`;

CREATE TABLE `aetiquetas` (
  `idetiquetas` bigint(20) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(125) NOT NULL,
  `frecuencia` int(11) DEFAULT NULL,
  `fecha` int(11) DEFAULT NULL,
  PRIMARY KEY (`idetiquetas`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

/*Data for the table `aetiquetas` */

insert  into `aetiquetas`(`idetiquetas`,`nombre`,`frecuencia`,`fecha`) values (1,'testing',7,1341099936),(2,'tags',2,1341099936),(3,'adela',6,1341099936),(4,'game',1,1341099936),(5,'testendo',1,1341359153),(6,'post',1,1341375404),(7,'pinguinos',1,1345136517),(8,'testin',1,1345136517),(9,'imagen',3,1345139124),(10,'url',1,1345139124),(11,'test',3,1345139124),(12,'subir',1,1345144112),(13,'chiste',1,1345147094),(14,'gracoso',1,1345161688),(15,'video',2,1345161688),(16,'esther',1,1345165049);

/*Table structure for table `aimagen` */

DROP TABLE IF EXISTS `aimagen`;

CREATE TABLE `aimagen` (
  `idimagen` bigint(20) NOT NULL AUTO_INCREMENT,
  `nombre_original` varchar(225) DEFAULT NULL,
  `nombre` varchar(225) DEFAULT NULL,
  `descripcion` varchar(600) DEFAULT NULL,
  `extension` varchar(10) DEFAULT NULL,
  `ruta` varchar(125) DEFAULT NULL,
  `directorio` varchar(50) DEFAULT NULL,
  `ancho` int(11) DEFAULT NULL,
  `alto` int(11) DEFAULT NULL,
  `nom_thumb` varchar(225) DEFAULT NULL,
  `thumb_ruta` varchar(125) DEFAULT NULL,
  `thumb_directorio` varchar(50) DEFAULT NULL,
  `thumb_ancho` int(11) DEFAULT NULL,
  `thumb_alto` int(11) DEFAULT NULL,
  `idCategoria` int(11) DEFAULT NULL,
  `tipo` enum('POST','COMENTARIO','ADJUNTA') DEFAULT NULL,
  `num_visitas` int(11) DEFAULT NULL,
  `enpost` char(1) DEFAULT '0',
  `fecha` int(11) DEFAULT NULL,
  PRIMARY KEY (`idimagen`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

/*Data for the table `aimagen` */

insert  into `aimagen`(`idimagen`,`nombre_original`,`nombre`,`descripcion`,`extension`,`ruta`,`directorio`,`ancho`,`alto`,`nom_thumb`,`thumb_ruta`,`thumb_directorio`,`thumb_ancho`,`thumb_alto`,`idCategoria`,`tipo`,`num_visitas`,`enpost`,`fecha`) values (1,'ao_no_exorcist.png','4fef65c48a523-ao_no_exorcist.png','un post con una imagen imaginaria... xD','image/png','C:/xampp/htdocs/adela/auploads','auploads',533,300,'thumb4fef65c48a523-ao_no_exorcist.png','C:/xampp/htdocs/adela/athumb','athumb',320,280,15,'ADJUNTA',NULL,'1',1341089220),(2,'Elfen-Lied2.jpg','4fef683c9909e-Elfen-Lied2.jpg','tiausasd','image/jpeg','C:/xampp/htdocs/adela/auploads','auploads',462,347,'thumb4fef683c9909e-Elfen-Lied2.jpg','C:/xampp/htdocs/adela/athumb','athumb',320,280,15,'ADJUNTA',NULL,'1',1341089852),(3,'Elfen-Lied.jpg','4fef6a38d8bb9-Elfen-Lied.jpg','sadfasdfa','image/jpeg','C:/xampp/htdocs/adela/auploads','auploads',400,300,'thumb4fef6a38d8bb9-Elfen-Lied.jpg','C:/xampp/htdocs/adela/athumb','athumb',320,280,15,'ADJUNTA',NULL,'1',1341090361),(4,'Penguins.jpg','502d2784b30b9-Penguins.jpg','pinguinosss','image/jpeg','C:/xampp/htdocs/adela/auploads','auploads',1024,768,'thumb502d2784b30b9-Penguins.jpg','C:/xampp/htdocs/adela/athumb','athumb',320,280,11,'ADJUNTA',NULL,'1',1345136517),(5,'Koala.jpg','502d452f85412-Koala.jpg','koalaa','image/jpeg','C:/xampp/htdocs/adela/auploads','auploads',1024,768,'thumb502d452f85412-Koala.jpg','C:/xampp/htdocs/adela/athumb','athumb',320,280,9,'ADJUNTA',NULL,'1',1345144112),(6,'P1000479-b.JPG','502d8f0bd4090-P1000479-b.JPG','tamaño regular','image/jpeg','C:/xampp/htdocs/adela/auploads','auploads',1080,810,'thumb502d8f0bd4090-P1000479-b.JPG','C:/xampp/htdocs/adela/athumb','athumb',320,280,13,'ADJUNTA',NULL,'1',1345163026),(7,'P1000479-b.JPG','502d90381b577-P1000479-b.JPG','sdfasdf','image/jpeg','C:/xampp/htdocs/adela/auploads','auploads',1080,810,'thumb502d90381b577-P1000479-b.JPG','C:/xampp/htdocs/adela/athumb','athumb',320,280,3,'ADJUNTA',NULL,'1',1345163326),(8,'P1000479-b.JPG','502d9073dbc1e-P1000479-b.JPG','sfasdf','image/jpeg','C:/xampp/htdocs/adela/auploads','auploads',1080,810,'thumb502d9073dbc1e-P1000479-b.JPG','C:/xampp/htdocs/adela/athumb','athumb',320,280,5,'ADJUNTA',NULL,'1',1345163385),(9,'P1000479-b.JPG','502d90b9c487c-P1000479-b.JPG','asfasd','image/jpeg','C:/xampp/htdocs/adela/auploads','auploads',1080,810,'thumb502d90b9c487c-P1000479-b.JPG','C:/xampp/htdocs/adela/athumb','athumb',320,280,3,'ADJUNTA',NULL,'1',1345163455),(10,'P1000479-b.JPG','502d91ba42d45-P1000479-b.JPG','fallas','image/jpeg','C:/xampp/htdocs/adela/auploads','auploads',1080,810,'thumb502d91ba42d45-P1000479-b.JPG','C:/xampp/htdocs/adela/athumb','athumb',320,280,14,'ADJUNTA',NULL,'1',1345163712),(11,'P1000479-b.JPG','502d924a8112b-P1000479-b.JPG','fallas','image/jpeg','C:/xampp/htdocs/adela/auploads','auploads',1080,810,'thumb502d924a8112b-P1000479-b.JPG','C:/xampp/htdocs/adela/athumb','athumb',320,280,14,'ADJUNTA',NULL,'1',1345163856),(12,'P1000479-b.JPG','502d92a8449a7-P1000479-b.JPG','fallas','image/jpeg','C:/xampp/htdocs/adela/auploads','auploads',1080,810,'thumb502d92a8449a7-P1000479-b.JPG','C:/xampp/htdocs/adela/athumb','athumb',320,280,14,'ADJUNTA',NULL,'1',1345163950),(13,'P1000479-b.JPG','502d92c8d79ff-P1000479-b.JPG','fallas','image/jpeg','C:/xampp/htdocs/adela/auploads','auploads',1080,810,'thumb502d92c8d79ff-P1000479-b.JPG','C:/xampp/htdocs/adela/athumb','athumb',320,280,14,'ADJUNTA',NULL,'1',1345163982),(14,'P1000479-b.JPG','502d92f8933af-P1000479-b.JPG','fallas','image/jpeg','C:/xampp/htdocs/adela/auploads','auploads',1080,810,'thumb502d92f8933af-P1000479-b.JPG','C:/xampp/htdocs/adela/athumb','athumb',320,280,14,'ADJUNTA',NULL,'1',1345164030),(15,'P1000479-b.JPG','502d9322dd0f4-P1000479-b.JPG','fallas','image/jpeg','C:/xampp/htdocs/adela/auploads','auploads',1080,810,'thumb502d9322dd0f4-P1000479-b.JPG','C:/xampp/htdocs/adela/athumb','athumb',320,280,14,'ADJUNTA',NULL,'1',1345164073),(16,'P1000479-b.JPG','502d93546f900-P1000479-b.JPG','ttee','image/jpeg','C:/xampp/htdocs/adela/auploads','auploads',1080,810,'thumb502d93546f900-P1000479-b.JPG','C:/xampp/htdocs/adela/athumb','athumb',320,280,NULL,'ADJUNTA',NULL,'1',1345164122),(17,'Tulips.jpg','502d95e5ea5b3-Tulips.jpg','sfasdf','image/jpeg','C:/xampp/htdocs/adela/auploads','auploads',1024,768,'thumb502d95e5ea5b3-Tulips.jpg','C:/xampp/htdocs/adela/athumb','athumb',320,280,12,'ADJUNTA',NULL,'1',1345164774),(18,'P1000479-b.JPG','502d96f3073af-P1000479-b.JPG','testin ikagen','image/jpeg','C:/xampp/htdocs/adela/auploads','auploads',1080,810,'thumb502d96f3073af-P1000479-b.JPG','C:/xampp/htdocs/adela/athumb','athumb',320,280,11,'ADJUNTA',NULL,'1',1345165049),(19,'P1000479-b.JPG','502d97799a481-P1000479-b.JPG','testing 2','image/jpeg','C:/xampp/htdocs/adela/auploads','auploads',1080,810,'thumb502d97799a481-P1000479-b.JPG','C:/xampp/htdocs/adela/athumb','athumb',320,280,10,'ADJUNTA',NULL,'1',1345165183);

/*Table structure for table `aimagen_compartir` */

DROP TABLE IF EXISTS `aimagen_compartir`;

CREATE TABLE `aimagen_compartir` (
  `aimagen_compartir` bigint(20) NOT NULL,
  `idimagen` bigint(20) DEFAULT NULL,
  `fecha` int(11) DEFAULT NULL,
  PRIMARY KEY (`aimagen_compartir`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `aimagen_compartir` */

/*Table structure for table `apost` */

DROP TABLE IF EXISTS `apost`;

CREATE TABLE `apost` (
  `idpost` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_nom` varchar(50) DEFAULT 'anonimo',
  `idimagen` bigint(20) DEFAULT NULL,
  `titulo` varchar(250) NOT NULL,
  `contenido` text NOT NULL,
  `contrasenia` varchar(180) DEFAULT NULL,
  `etiquetas` varchar(320) NOT NULL,
  `idcategoria` int(11) DEFAULT NULL,
  `tipo` enum('POST','COMENTARIO','IMAGEN','VIDEO') DEFAULT NULL,
  `nun_visitas` int(11) DEFAULT NULL,
  `fecha` int(11) DEFAULT NULL,
  PRIMARY KEY (`idpost`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

/*Data for the table `apost` */

insert  into `apost`(`idpost`,`user_nom`,`idimagen`,`titulo`,`contenido`,`contrasenia`,`etiquetas`,`idcategoria`,`tipo`,`nun_visitas`,`fecha`) values (1,'anonimo',1,'un post con una imagen imaginaria... xD','<p>post con imagen ...xD</p>','123456','admin,post,imagen,naruto',15,'POST',NULL,1341089158),(2,'anonimo',2,'tiausasd','<p>asdfasdfasdf</p>','123456','admin,asfa,asdf,asdfa',15,'POST',NULL,1341089818),(3,'anonimo',NULL,'un post sin imagen imagonosaaaa','<p>sin imagensss</p>','123456','admin,asda,adfas,asdas',15,'POST',NULL,1341089853),(4,'anonimo',3,'sadfasdfa','<p>asdfasdf</p>','123456','admin',15,'POST',NULL,1341090317),(5,'anonimo',NULL,'post postoso','<p>sdfasdfasdf</p>','123456','admin',15,'POST',NULL,1341095596),(6,'anonimo',NULL,'titulo titulo usuario invitado','<p>sadasdasdasdfadfas</p>','123456','asdfasf,sadf,asd,fasdf',15,'POST',NULL,1341095689),(7,'anonimo',NULL,'tesitassad','<p>sdfasdf</p>','123456','sad,fas,df,asdf,as',15,'POST',NULL,1341095973),(8,'anonimo',NULL,'testendo etiqeutas','<p>sdfasdfsfasdf</p>','123456','testing,tags,adela,game',15,'POST',NULL,1341099885),(9,'anonimo',NULL,'sdfasdfas','<p>sdfasdfasdfas</p>','123456','adela, testing, tags, ',15,'POST',NULL,1341100083),(10,'anonimo',NULL,'testendo contenido grande','<div id=\"general_panel\" class=\"panel current\">\r\n<h3>About TinyMCE</h3>\r\n<p>Version: <span id=\"version\">3.5.0.1</span> (<span id=\"date\">2012-05-10</span>)</p>\r\n<p>TinyMCE is a platform independent web based Javascript HTML WYSIWYG editor control released as Open Source under <a href=\"js/tiny_mce/license.txt\" target=\"_blank\">LGPL</a> by Moxiecode Systems AB. It has the ability to convert HTML TEXTAREA fields or other HTML elements to editor instances.</p>\r\n<p>Copyright &copy; 2003-2008, <a href=\"http://www.moxiecode.com/\" target=\"_blank\">Moxiecode Systems AB</a>, All rights reserved.</p>\r\n<p>For more information about this software visit the <a href=\"http://tinymce.moxiecode.com/\" target=\"_blank\">TinyMCE website</a>.</p>\r\n<div id=\"buttoncontainer\"><a href=\"http://www.moxiecode.com/\" target=\"_blank\"><img src=\"http://tinymce.moxiecode.com/images/gotmoxie.png\" alt=\"Got Moxie?\" border=\"0\" /></a></div>\r\n<div>\r\n<div id=\"general_panel\" class=\"panel current\">\r\n<h3>About TinyMCE</h3>\r\n<p>Version: <span id=\"version\">3.5.0.1</span> (<span id=\"date\">2012-05-10</span>)</p>\r\n<p>TinyMCE is a platform independent web based Javascript HTML WYSIWYG editor control released as Open Source under <a href=\"js/tiny_mce/license.txt\" target=\"_blank\">LGPL</a> by Moxiecode Systems AB. It has the ability to convert HTML TEXTAREA fields or other HTML elements to editor instances.</p>\r\n<p>Copyright &copy; 2003-2008, <a href=\"http://www.moxiecode.com/\" target=\"_blank\">Moxiecode Systems AB</a>, All rights reserved.</p>\r\n<p>For more information about this software visit the <a href=\"http://tinymce.moxiecode.com/\" target=\"_blank\">TinyMCE website</a>.</p>\r\n<div id=\"buttoncontainer\"><a href=\"http://www.moxiecode.com/\" target=\"_blank\"><img src=\"http://tinymce.moxiecode.com/images/gotmoxie.png\" alt=\"Got Moxie?\" border=\"0\" /></a></div>\r\n<div>\r\n<div id=\"general_panel\" class=\"panel current\">\r\n<h3>About TinyMCE</h3>\r\n<p>Version: <span id=\"version\">3.5.0.1</span> (<span id=\"date\">2012-05-10</span>)</p>\r\n<p>TinyMCE is a platform independent web based Javascript HTML WYSIWYG editor control released as Open Source under <a href=\"js/tiny_mce/license.txt\" target=\"_blank\">LGPL</a> by Moxiecode Systems AB. It has the ability to convert HTML TEXTAREA fields or other HTML elements to editor instances.</p>\r\n<p>Copyright &copy; 2003-2008, <a href=\"http://www.moxiecode.com/\" target=\"_blank\">Moxiecode Systems AB</a>, All rights reserved.</p>\r\n<p>For more information about this software visit the <a href=\"http://tinymce.moxiecode.com/\" target=\"_blank\">TinyMCE website</a>.</p>\r\n<div id=\"buttoncontainer\"><a href=\"http://www.moxiecode.com/\" target=\"_blank\"><img src=\"http://tinymce.moxiecode.com/images/gotmoxie.png\" alt=\"Got Moxie?\" border=\"0\" /></a></div>\r\n<div>\r\n<div id=\"general_panel\" class=\"panel current\">\r\n<h3>About TinyMCE</h3>\r\n<p>Version: <span id=\"version\">3.5.0.1</span> (<span id=\"date\">2012-05-10</span>)</p>\r\n<p>TinyMCE is a platform independent web based Javascript HTML WYSIWYG editor control released as Open Source under <a href=\"js/tiny_mce/license.txt\" target=\"_blank\">LGPL</a> by Moxiecode Systems AB. It has the ability to convert HTML TEXTAREA fields or other HTML elements to editor instances.</p>\r\n<p>Copyright &copy; 2003-2008, <a href=\"http://www.moxiecode.com/\" target=\"_blank\">Moxiecode Systems AB</a>, All rights reserved.</p>\r\n<p>For more information about this software visit the <a href=\"http://tinymce.moxiecode.com/\" target=\"_blank\">TinyMCE website</a>.</p>\r\n<div id=\"buttoncontainer\"><a href=\"http://www.moxiecode.com/\" target=\"_blank\"><img src=\"http://tinymce.moxiecode.com/images/gotmoxie.png\" alt=\"Got Moxie?\" border=\"0\" /></a></div>\r\n<div>\r\n<div id=\"general_panel\" class=\"panel current\">\r\n<h3>About TinyMCE</h3>\r\n<p>Version: <span id=\"version\">3.5.0.1</span> (<span id=\"date\">2012-05-10</span>)</p>\r\n<p>TinyMCE is a platform independent web based Javascript HTML WYSIWYG editor control released as Open Source under <a href=\"js/tiny_mce/license.txt\" target=\"_blank\">LGPL</a> by Moxiecode Systems AB. It has the ability to convert HTML TEXTAREA fields or other HTML elements to editor instances.</p>\r\n<p>Copyright &copy; 2003-2008, <a href=\"http://www.moxiecode.com/\" target=\"_blank\">Moxiecode Systems AB</a>, All rights reserved.</p>\r\n<p>For more information about this software visit the <a href=\"http://tinymce.moxiecode.com/\" target=\"_blank\">TinyMCE website</a>.</p>\r\n<div id=\"buttoncontainer\"><a href=\"http://www.moxiecode.com/\" target=\"_blank\"><img src=\"http://tinymce.moxiecode.com/images/gotmoxie.png\" alt=\"Got Moxie?\" border=\"0\" /></a>\r\n<div id=\"general_panel\" class=\"panel current\">\r\n<h3>About TinyMCE</h3>\r\n<p>Version: <span id=\"version\">3.5.0.1</span> (<span id=\"date\">2012-05-10</span>)</p>\r\n<p>TinyMCE is a platform independent web based Javascript HTML WYSIWYG editor control released as Open Source under <a href=\"js/tiny_mce/license.txt\" target=\"_blank\">LGPL</a> by Moxiecode Systems AB. It has the ability to convert HTML TEXTAREA fields or other HTML elements to editor instances.</p>\r\n<p>Copyright &copy; 2003-2008, <a href=\"http://www.moxiecode.com/\" target=\"_blank\">Moxiecode Systems AB</a>, All rights reserved.</p>\r\n<p>For more information about this software visit the <a href=\"http://tinymce.moxiecode.com/\" target=\"_blank\">TinyMCE website</a>.</p>\r\n<div id=\"buttoncontainer\"><a href=\"http://www.moxiecode.com/\" target=\"_blank\"><img src=\"http://tinymce.moxiecode.com/images/gotmoxie.png\" alt=\"Got Moxie?\" border=\"0\" /></a>\r\n<div id=\"general_panel\" class=\"panel current\">\r\n<h3>About TinyMCE</h3>\r\n<p>Version: <span id=\"version\">3.5.0.1</span> (<span id=\"date\">2012-05-10</span>)</p>\r\n<p>TinyMCE is a platform independent web based Javascript HTML WYSIWYG editor control released as Open Source under <a href=\"js/tiny_mce/license.txt\" target=\"_blank\">LGPL</a> by Moxiecode Systems AB. It has the ability to convert HTML TEXTAREA fields or other HTML elements to editor instances.</p>\r\n<p>Copyright &copy; 2003-2008, <a href=\"http://www.moxiecode.com/\" target=\"_blank\">Moxiecode Systems AB</a>, All rights reserved.</p>\r\n<p>For more information about this software visit the <a href=\"http://tinymce.moxiecode.com/\" target=\"_blank\">TinyMCE website</a>.</p>\r\n<div id=\"buttoncontainer\"><a href=\"http://www.moxiecode.com/\" target=\"_blank\"><img src=\"http://tinymce.moxiecode.com/images/gotmoxie.png\" alt=\"Got Moxie?\" border=\"0\" /></a>\r\n<div id=\"general_panel\" class=\"panel current\">\r\n<h3>About TinyMCE</h3>\r\n<p>Version: <span id=\"version\">3.5.0.1</span> (<span id=\"date\">2012-05-10</span>)</p>\r\n<p>TinyMCE is a platform independent web based Javascript HTML WYSIWYG editor control released as Open Source under <a href=\"js/tiny_mce/license.txt\" target=\"_blank\">LGPL</a> by Moxiecode Systems AB. It has the ability to convert HTML TEXTAREA fields or other HTML elements to editor instances.</p>\r\n<p>Copyright &copy; 2003-2008, <a href=\"http://www.moxiecode.com/\" target=\"_blank\">Moxiecode Systems AB</a>, All rights reserved.</p>\r\n<p>For more information about this software visit the <a href=\"http://tinymce.moxiecode.com/\" target=\"_blank\">TinyMCE website</a>.</p>\r\n<div id=\"buttoncontainer\"><a href=\"http://www.moxiecode.com/\" target=\"_blank\"><img src=\"http://tinymce.moxiecode.com/images/gotmoxie.png\" alt=\"Got Moxie?\" border=\"0\" /></a></div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>','123456','testendo',15,'POST',NULL,1341359078),(11,'anonimo',NULL,'poestao redirigidoo','<p>un os redirigo alkdasd</p>','123456','testing, post, adela, ',15,'POST',NULL,1341375348),(12,'anonimo',NULL,'postet personañ','<p>olaskdfjasdpiasdfjas asdfjajd asdfjasdfjasdf</p>','123456','testing, adela, ',15,'POST',NULL,1345136287),(13,'anonimo',4,'pinguinosss','<p>pinguinos desquiciados</p>','123456','pinguinos,testin,adela',11,'POST',NULL,1345136427),(14,'anonimo',NULL,'una url imagn','<img src=\"http://www.google.com/imagen.jpg\" alt=\"\" />','123456','imagen,url,test',1,'IMAGEN',NULL,1345139087),(15,'anonimo',5,'koalaa','.........','123456','testing, imagen, subir',9,'IMAGEN',NULL,1345144061),(16,'anonimo',NULL,'chiste chistoso','<p>sdfasdfasfasdfasdfasd</p>','123456','chiste,adela,test',13,'POST',NULL,1345147046),(17,'anonimo',NULL,'graciocsoo test','<iframe src=\"http://www.youtube.com/embed/1sa654da6\" frameborder=\"0\" width=\"425\" height=\"350\"></iframe>','123456','test,gracoso,video',2,'VIDEO',NULL,1345161641),(18,'anonimo',NULL,'testing 2','<iframe src=\"http://www.youtube.com/embed/1sa654da6\" frameborder=\"0\" width=\"425\" height=\"350\"></iframe>','123456','testing,video',13,'VIDEO',NULL,1345161772),(19,'anonimo',18,'testin ikagen','.........','123456','testing, esther',11,'IMAGEN',NULL,1345164778),(20,'anonimo',19,'testing 2','.........','123456','imagen',10,'IMAGEN',NULL,1345165127);

/*Table structure for table `apost_compartidos` */

DROP TABLE IF EXISTS `apost_compartidos`;

CREATE TABLE `apost_compartidos` (
  `idcompartir` bigint(20) NOT NULL,
  `idpost` bigint(20) NOT NULL,
  `fecha` int(11) DEFAULT NULL,
  PRIMARY KEY (`idcompartir`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `apost_compartidos` */

/*Table structure for table `areportados` */

DROP TABLE IF EXISTS `areportados`;

CREATE TABLE `areportados` (
  `idreporte` int(11) NOT NULL AUTO_INCREMENT,
  `motivo` text NOT NULL COMMENT 'post/imagen',
  `idreportado` bigint(20) NOT NULL,
  `fecha` int(11) DEFAULT NULL,
  PRIMARY KEY (`idreporte`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `areportados` */

insert  into `areportados`(`idreporte`,`motivo`,`idreportado`,`fecha`) values (1,'imagenes muy emfermas',4,1345168537),(2,'es muy suciaa',4,1345168607),(3,'contenido muyy sucioo',4,1345168653);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
