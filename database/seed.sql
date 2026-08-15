INSERT INTO albums (name, duration, desc, artist, genre) 
VALUES
('OK Computer', 53, 'Radiohead Album', 'Radiohead', 'Alternative Rock'),
('Abbey Road', 47, 'The Beatles Album', 'The Beatles', 'Rock'),
('The Dark Side of the Moon', 43, 'Pink Floyd Album', 'Pink Floyd', 'Progressive Rock'),
('Rumours', 39, 'Fleetwood Mac Album', 'Fleetwood Mac', 'Soft Rock'),
('Random Access Memories', 74, 'Daft Punk Album', 'Daft Punk', 'Electronic'),
('Currents', 51, 'Tame Impala Album', 'Tame Impala', 'Psychedelic Pop'),
('To Pimp a Butterfly', 79, 'Kendrick Lamar Album', 'Kendrick Lamar', 'Hip Hop'),
('Clube da Esquina', 64, 'Milton Nascimento e Lô Borges Album', 'Milton Nascimento', 'MPB'),
('Nevermind', 42, 'Nirvana Album', 'Nirvana', 'Grunge'),
('Discovery', 60, 'Daft Punk Album', 'Daft Punk', 'Synthpop');

INSERT INTO experiences (album_fk, mood, stars, desc) 
VALUES
(1, 'Melancólico e reflexivo', 5.0, 'Uma verdadeira obra-prima sobre alienação moderna e tecnologia.'),
(2, 'Nostálgico e feliz', 4.8, 'A transição perfeita entre as faixas no Lado B torna este álbum inesquecível.'),
(3, 'Psicodélico e imersivo', 5.0, 'Uma experiência sonora completa para ouvir do início ao fim de fones de ouvido.'),
(4, 'Relaxado e emotivo', 4.5, 'Vocais e harmonias incríveis, ótimo para ouvir numa viagem de carro.'),
(5, 'Eufórico e dançante', 4.9, 'Produção impecável que une a música eletrônica com instrumentos orgânicos de forma genial.'),
(6, 'Introspectivo', 4.7, 'Sintetizadores impecáveis. A vibe perfeita para noites chuvosas.'),
(7, 'Pensativo e enérgico', 5.0, 'Letras profundas sobre sociedade, raça e identidade. Um marco da década.'),
(8, 'Aconchegante e poético', 5.0, 'Um dos maiores clássicos da música brasileira. Harmonias ricas e clima acolhedor.'),
(9, 'Rebelde e agitado', 4.6, 'Pura energia dos anos 90 com riffs marcantes e vocais brutos.'),
(10, 'Nostálgico e animado', 4.8, 'Clássico absoluto da música eletrônica dos anos 2000.');

INSERT INTO albums (name, duration, desc, artist, genre) 
VALUES
('Unknown Album', 35, NULL, NULL, NULL),
('A Night at the Opera', 43, 'Queen Classic Album', 'Queen', 'Rock'),
('Chill Beats Vol. 1', 50, NULL, 'Various Artists', 'Lo-Fi'),
('Untitled Project', 28, 'Álbum experimental sem gênero definido', 'Artista Anônimo', NULL),
('In Rainbows', 42, 'Radiohead Album', 'Radiohead', NULL),
('Instrumental Suite', 65, NULL, NULL, 'Classical');

INSERT INTO experiences (album_fk, mood, stars, desc) 
VALUES
(11, 'Misterioso', 3.5, NULL),
(12, 'Empolgante', 5.0, 'Uma performance vocal incrível em Bohemian Rhapsody e ótimos arranjos.'),
(13, 'Relaxado', 4.0, NULL),
(14, 'Confuso', 2.8, 'Sons muito abstratos e sem estrutura definida.'),
(15, 'Introspectivo', 4.9, NULL),
(16, 'Calmo', 4.2, 'Ótimo para focar no trabalho e estudos.');

