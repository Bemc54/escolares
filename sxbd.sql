-- Volcando estructura para tabla project_sx.alumnos
CREATE TABLE IF NOT EXISTS `alumnos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  `telefono` varchar(255) DEFAULT NULL,
  `correo` varchar(255) DEFAULT NULL,
  `grado_estudio` varchar(255) DEFAULT NULL,
  `carrera` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21;

-- Volcando datos para la tabla project_sx.alumnos: ~6 rows (aproximadamente)
INSERT INTO `alumnos` (`id`, `nombre`, `telefono`, `correo`, `grado_estudio`, `carrera`) VALUES
	(7, 'Sx', '4568795178', 'sxmelapela@gmail.com', 'Carrera Escolarizada', 'Carrera Escolarizadda'),
	(8, 'putagoras', '7898732149', 'renependejo@wey.com', 'Carrera Sabado y Domingo', 'Carrera Sabado y Domingo'),
	(10, 'Ulises Mireles', '8713638644', 'bemc54@gmail.com', 'Bachillerato', NULL),
	(17, 'Drako', '654654687', 'soydrako@gmail.com', 'Carrera Semi-Escolarizada', 'Proteccion Civil'),
	(18, 'Ouran', '64654987', 'soyouran@gmail.com', 'Carrera Semi-Escolarizada', 'Derecho'),
	(20, 'goku', '654679879', 'soygoku@gmail.com', 'Examen Unico', 'Trabajo Social');

-- Volcando estructura para tabla project_sx.ingresos
CREATE TABLE IF NOT EXISTS `ingresos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_al` int DEFAULT NULL,
  `id_pa` int DEFAULT NULL,
  `concep` varchar(255) DEFAULT NULL,
  `monto_pagado` varchar(255) DEFAULT NULL,
  `fecha_pago` varchar(255) DEFAULT NULL,
  `cobrador` varchar(255) DEFAULT NULL,
  `metodo` varchar(255) DEFAULT NULL,
  `comentario` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12;

-- Volcando datos para la tabla project_sx.ingresos: ~6 rows (aproximadamente)
INSERT INTO `ingresos` (`id`, `id_al`, `id_pa`, `concep`, `monto_pagado`, `fecha_pago`, `cobrador`, `metodo`, `comentario`) VALUES
	(4, 8, 9, 'Inscripcion', '1750', '04/06/2024', 'bemc', 'Efectivo', 'Sin comentario'),
	(5, 7, 10, 'Inscripcion', '1000', '06/06/2024', 'sx', 'Seleccione el Metodo de Pago', 'Medio pago'),
	(6, 11, 8, 'Inscripcion', '500', '06/06/2024', 'sx', 'Transferencia', 'Mitad Inscripcion'),
	(7, 18, 17, 'Mensualidad', '2400', '08/06/2024', 'sx', 'Deposito', ''),
	(8, 17, 17, 'Mensualidad', '2500', '08/06/2024', 'sx', 'Seleccione el Metodo de Pago', ''),
	(9, 10, 8, 'Inscripcion', '1000', '08/06/2024', 'sx', 'Transferencia', ''),
	(10, 17, 9, 'Inscripcion', '2100', '10/06/2024', 'john', 'Deposito', 'Pago completo'),
	(11, 10, 16, 'Mensualidad', '1500', '10/06/2024', 'sx', 'Cheque', 'todo chido');

-- Volcando estructura para tabla project_sx.pagos
CREATE TABLE IF NOT EXISTS `pagos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `concepto` varchar(255) DEFAULT NULL,
  `monto` varchar(255) DEFAULT NULL,
  `tipo_alumno` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23;

-- Volcando datos para la tabla project_sx.pagos: ~11 rows (aproximadamente)
INSERT INTO `pagos` (`id`, `concepto`, `monto`, `tipo_alumno`) VALUES
	(8, 'Inscripcion', '1000', 'Bachillerato'),
	(9, 'Inscripcion', '1750', 'Carrera Semi-Escolarizada'),
	(10, 'Inscripcion', '1950', 'Carrera Escolarizada'),
	(12, 'Reinscripcion', '1000', 'Bachillerato'),
	(13, 'Reinscripcion', '1600', 'Carrera Semi-Escolarizada'),
	(14, 'Reinscripcion', '2000', 'Carrera Escolarizada'),
	(16, 'Mensualidad', '1500', 'Bachillerato'),
	(17, 'Mensualidad', '2400', 'Carrera Semi-Escolarizada'),
	(18, 'Mensualidad', '2000', 'Carrera Escolarizada'),
	(20, 'Inscripcion', '1000', 'Examen Unico'),
	(21, 'Mensualidad', '2600', 'Examen Unico');

-- Volcando estructura para tabla project_sx.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom_usu` varchar(255) DEFAULT NULL,
  `tel` varchar(255) DEFAULT NULL,
  `mail` varchar(255) DEFAULT NULL,
  `pass` varchar(255) DEFAULT NULL,
  `rol` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5;

-- Volcando datos para la tabla project_sx.usuarios: ~3 rows (aproximadamente)
INSERT INTO `usuarios` (`id`, `nom_usu`, `tel`, `mail`, `pass`, `rol`) VALUES
	(2, 'sx', NULL, NULL, 'soysx', 'sx'),
	(4, 'john', '65465498', 'johndoe@john.com', 'johndoe', 'Conta');