CREATE DATABASE if NOT EXISTS places;
USE places;
CREATE TABLE if NOT EXISTS coordenadas (
		id INT AUTO_INCREMENT,
		coordenada VARCHAR(50) NOT NULL,
		lugar VARCHAR(100) NOT NULL,
		hashtag VARCHAR(100) NOT NULL,
		PRIMARY KEY (id)
	)
ENGINE=INNODB
DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO coordenadas (coordenada, lugar, hashtag) VALUES 
		('16.7091385,-93.0165571','Chiapa de Corzo', 'ChiapadeCorzo'),
		('17.5109792,-91.9930466','Palenque', 'PalenqueChiapas'),
		('16.7342989,-92.0362219','Altamirano', 'Chiapas'),
		('16.7432897,-92.6359999','San Cristobal de las Casas', 'SanCristóbalDeLasCasas'),
		('16.7516009,-93.1029939','Tuxtla Gutiérrez','TuxtlaGutiérrez'),
		('16.2304979,-92.1162415','Comitán de Domínguez','ComitándeDominguez'),
		('16.315474,-91.987953','Las Margaritas','Chiapas'),
		('17.1734888,-92.329558','Yajalón','Chiapas'),
		('17.1046837,-92.2736561','Chilón','Chiapas'), 
		('16.9082311,-92.0950037','Ocosingo', 'Ocosingo');