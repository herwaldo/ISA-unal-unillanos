INSERT INTO `jerarquia` (`nombre_coleccion`,`antecesor_id`, `usuario_id`) VALUES 
						('Prueba',0, 3);


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
						(13, 1, 3, 1);
