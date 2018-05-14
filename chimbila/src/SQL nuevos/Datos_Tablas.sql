INSERT INTO `usuario` (`id`,`nombre`, `apellido`, `nickname`, `email`, `password`) VALUES
                        (1,'Angel', 'Cruz', 'Angel', 'aacruz@unillanos.edu.co', 'eikon666'),
                        (2,'Francisco', 'Sanchez', 'Pacho', 'fsanchezbarrera@unillanos.edu.co', 'pacho321'),
                        (3,'Yerson', 'Porras', 'Yerfer', 'yerson.porras@unillanos.edu.co', 'yerfer'),
                        (4,'Angelica Viviana', 'Yanten Arevalo', 'Angelica', 'angelica.yanten@unillanos.edu.co', 'ayanten'),
                        (5,'Juan David', 'Rodriguez Hurtado', 'Juan', 'juan.rodriguez.hurtado@unillanos.edu.co', 'jrodriguez'),
                        (6,'Karen Andrea', 'Bernal Contreras', 'Karen', 'karen.bernal@unillanos.edu.co', 'pollito'),
						(7,'Orlando Fabian', 'Hernandez Leal', 'Fabian', 'orlando.hernandez@unillanos.edu.co', 'ohernandez');


INSERT INTO `audio` (`nombre_original`, `nombre_audio`,`ruta`) VALUES 
						('yerfer_audio_1', 'caso1','chimbila/Audios/Yerfer/yerfer_audio_1.wav'),
						('yerfer_audio_2', 'caso2','chimbila/Audios/Yerfer/yerfer_audio_2.wav'),
						('yerfer_audio_3', 'caso3','chimbila/Audios/Yerfer/yerfer_audio_1.wav'),
						('yerfer_audio_4', 'caso4','chimbila/Audios/Yerfer/yerfer_audio_2.wav'),
						('yerfer_audio_5', 'caso5','chimbila/Audios/Yerfer/yerfer_audio_1.wav'),
						('yerfer_audio_6', 'caso6','chimbila/Audios/Yerfer/yerfer_audio_2.wav'),
						('yerfer_audio_7', 'caso7','chimbila/Audios/Yerfer/yerfer_audio_1.wav'),
						('yerfer_audio_8', 'caso8','chimbila/Audios/Yerfer/yerfer_audio_2.wav'),
						('yerfer_audio_9', 'caso9','chimbila/Audios/Yerfer/yerfer_audio_1.wav'),
						('yerfer_audio_10', 'caso10','chimbila/Audios/Yerfer/yerfer_audio_2.wav'),
						('yerfer_audio_11', 'caso11','chimbila/Audios/Yerfer/yerfer_audio_1.wav'),
						('yerfer_audio_12', 'caso12','chimbila/Audios/Yerfer/yerfer_audio_2.wav'),
						('yerfer_audio_13', 'caso13','chimbila/Audios/Yerfer/yerfer_audio_1.wav'),
						('3.2', 'Audio de Karen 1','chimbila/Audios/Karen/Karen_1.wav'),
						('3.3', 'Balmoral 20-01-2016_Audio 3.3','chimbila/Audios/Karen/Karen_2.wav');

INSERT INTO `tipo_etiqueta` (`id`,`nombre`) VALUES 
						(1, 'Frecuencia'),
						(2, 'Fase'),
						(3, 'Comportamiento'),
						(4, 'Cantidad de Murcielagos');

INSERT INTO `etiqueta` (`nombre`, `tipo_etiqueta_id`) VALUES 
						("Frecuencia Modulada (FM)", 1),
						("Frecuencia Constante (CF)", 1),
						("Frecuencia cuasi-constantes (QCF)", 1),
						("Fase de búsqueda (pases)", 2),
						("Fase de aproximación", 2),
						("Fase terminal (feeding buzz)", 2),
						("Caza aérea", 3),
						("Caza arrastre Agua", 3),
						("Caza Picada Agua", 3),
						("1",4),
						("2",4),
						("3",4),
						("4",4),
						("5",4),
						("6",4),
						("7",4),
						("8",4),
						("9",4),
						("10",4),
						("+10",4);

INSERT INTO `tipo_estado` (`nombre_estado`, `descripcion`) VALUES 
						("Sin etiquetar", "Es el estado inicial del audio cuando es ingresado a la plataforma y no se han agregado anotaciones."),
						("Etiquetando", "Es el estado en el cual el audio estan agregando anotaciones."),
						("Finalizado", "Es el estado en que el audio ya se han realizado todas las anotaciones.");
