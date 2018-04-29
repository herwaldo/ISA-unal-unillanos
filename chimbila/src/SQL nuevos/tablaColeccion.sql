INSERT INTO `jerarquia` (`id`,`nombre_coleccion`,`antecesor_id`, `usuario_id`) VALUES 
						(1,'Raiz',null, 3),
						(2,"Karen's Audios",null, 6);

INSERT INTO `jerarquia` (`nombre_coleccion`,`antecesor_id`, `usuario_id`) VALUES 
						('Prueba',1, 3),
						('MiColeccion1',1, 3),
						('Otra Coleccion',2, 3),
						('Mi Subcoleccion',1, 3),
						('Mi Subcoleccion 2',1, 3),
						('Muestreo 1',2, 6),
						('Balmoral 20-01-2016',8, 6),
						('Ciudad Real 16-01-2016',8, 6);


INSERT INTO `coleccion` (`audio_id`, `jerarquia_id`,`jerarquia_usuario_id`,`tipo_estado_id`) VALUES 
						(1, 1, 3, 1),
						(2, 1, 3, 1),
						(3, 1, 3, 1),
						(4, 1, 3, 1),
						(5, 1, 3, 2),
						(6, 1, 3, 2),
						(7, 1, 3, 3),
						(8, 1, 3, 2),
						(9, 1, 3, 2),
						(10, 1, 3, 1),
						(11, 1, 3, 2),
						(12, 1, 3, 1),
						(13, 1, 3, 1),
						(14, 2, 6, 1),
						(15, 2, 6, 1);
