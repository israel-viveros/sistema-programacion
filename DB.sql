CREATE DATABASE IF NOT EXISTS parrilla_programacion;

USE parrilla_programacion;

CREATE TABLE IF NOT EXISTS `canal` (
  `id_canal` varchar(20) NOT NULL,
  `nombre` varchar(20) DEFAULT NULL,
  `logotipo` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id_canal`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `fecha`(
	`id_fecha` varchar(20) NOT NULL,	
	`fecha` date NOT NULL,
	PRIMARY KEY (`id_fecha`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `programacion`(
	`id_programacion` varchar(20) NOT NULL,
	`id_canal` varchar(20) NOT NULL,
	`id_fecha` varchar(20) 	 NOT NULL,
	PRIMARY KEY (`id_programacion`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `contenido`(
	`id_contenido` varchar(20) NOT NULL,
	`duracion` varchar(20) NOT NULL,
	`horario` varchar(20) NOT NULL,
	`timestap` varchar(20) NOT NULL,
	PRIMARY KEY (`id_contenido`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `programacion_contenido`(
	`id_programacion` varchar(20) NOT NULL,
	`id_contenido` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `programas`(
	`id_programa` varchar(20) NOT NULL,
	`nombre` varchar(20) NOT NULL,
	`descripcion` varchar(20) NOT NULL,
	PRIMARY KEY (`id_programa`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


CREATE TABLE IF NOT EXISTS `programas_contenido`(
	`id_programa` varchar(20) NOT NULL,
	`id_contenido` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;



