INSERT INTO `usuario` (`id`, `nombre`, `apellido`, `nickname`, `email`, `password`) VALUES
                        (1, 'Angel', 'Cruz', 'Angel', 'aacruz@unillanos.edu.co', 'eikon666'),
                        (2, 'Francisco', 'Sanchez', 'Pacho', 'fsanchezbarrera@unillanos.edu.co', 'pacho321'),
                        (3, 'Yerson', 'Porras', 'Yerfer', 'yerson.porras@unillanos.edu.co', 'yerfer'),
                        (4, 'Angelica Viviana', 'Yanten Arevalo', 'angelica', 'angelica.yanten@unillanos.edu.co', 'ayanten'),
                        (5, 'Juan David', 'Rodriguez Hurtado', 'juan', 'juan.rodriguez.hurtado@unillanos.edu.co', 'jrodriguez');


INSERT INTO `audio` (`id`, `nombre_original`, `nombre_audio`,`ruta`) VALUES 
						(1, 'yerfer_audio_1', 'caso1','chimbila/Audios/Yerfer/yerfer_audio_1.wav'),
						(2, 'yerfer_audio_2', 'caso2','chimbila/Audios/Yerfer/yerfer_audio_2.wav'),
						(3, 'yerfer_audio_3', 'caso3','chimbila/Audios/Yerfer/yerfer_audio_1.wav'),
						(4, 'yerfer_audio_4', 'caso4','chimbila/Audios/Yerfer/yerfer_audio_2.wav'),
						(5, 'yerfer_audio_5', 'caso5','chimbila/Audios/Yerfer/yerfer_audio_1.wav'),
						(6, 'yerfer_audio_6', 'caso6','chimbila/Audios/Yerfer/yerfer_audio_2.wav'),
						(7, 'yerfer_audio_7', 'caso7','chimbila/Audios/Yerfer/yerfer_audio_1.wav'),
						(8, 'yerfer_audio_8', 'caso8','chimbila/Audios/Yerfer/yerfer_audio_2.wav'),
						(9, 'yerfer_audio_9', 'caso9','chimbila/Audios/Yerfer/yerfer_audio_1.wav'),
						(10, 'yerfer_audio_10', 'caso10','chimbila/Audios/Yerfer/yerfer_audio_2.wav'),
						(11, 'yerfer_audio_11', 'caso11','chimbila/Audios/Yerfer/yerfer_audio_1.wav'),
						(12, 'yerfer_audio_12', 'caso12','chimbila/Audios/Yerfer/yerfer_audio_2.wav'),
						(13, 'yerfer_audio_13', 'caso13','chimbila/Audios/Yerfer/yerfer_audio_1.wav');

INSERT INTO `tipo_etiqueta` (`id`, `nombre`) VALUES 
						(1, 'Frecuencia'),
						(2, 'Fase'),
						(3, 'Comportamiento');

INSERT INTO `etiqueta` (`id`, `nombre`, `tipo_etiqueta_id`) VALUES 
						(1, "Frecuencia Modulada (FM)", 1),
						(2, "Frecuencia Constante (CF)", 1),
						(3, "Frecuencia cuasi-constantes (QCF)", 1),
						(4, "Fase de búsqueda (pases)", 2),
						(5, "Fase de aproximación", 2),
						(6, "Fase terminal (feeding buzz)", 2),
						(7, "Caza aérea", 3),
						(8, "Caza rastreo Agua", 3),
						(9, "Caza Picada Agua", 3);
