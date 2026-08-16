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
('Discovery', 60, 'Daft Punk Album', 'Daft Punk', 'Synthpop'),
('Unknown Album', 35, NULL, NULL, NULL),
('A Night at the Opera', 43, 'Queen Classic Album', 'Queen', 'Rock'),
('Chill Beats Vol. 1', 50, NULL, 'Various Artists', 'Lo-Fi'),
('Untitled Project', 28, 'Álbum experimental sem gênero definido', 'Artista Anônimo', NULL),
('In Rainbows', 42, 'Radiohead Album', 'Radiohead', NULL),
('Instrumental Suite', 65, NULL, NULL, 'Classical');

INSERT INTO experiences (album_id, title, mood, stars, desc) 
VALUES
(1, 'Reflexões sobre a Era Digital', 'Melancólico e reflexivo', 5.0, 'Uma verdadeira obra-prima sobre alienação moderna e tecnologia.'),
(2, 'A Perfeição do Lado B', 'Nostálgico e feliz', 4.8, 'A transição perfeita entre as faixas no Lado B torna este álbum inesquecível.'),
(3, 'Viagem Sonora Sem Fim', 'Psicodélico e imersivo', 5.0, 'Uma experiência sonora completa para ouvir do início ao fim de fones de ouvido.'),
(4, 'Trilha Sonora para a Estrada', 'Relaxado e emotivo', 4.5, 'Vocais e harmonias incríveis, ótimo para ouvir numa viagem de carro.'),
(5, 'A Alma da Mapeada Eletrônica', 'Eufórico e dançante', 4.9, 'Produção impecável que une a música eletrônica com instrumentos orgânicos de forma genial.'),
(6, 'Sintetizadores na Chuva', 'Introspectivo', 4.7, 'Sintetizadores impecáveis. A vibe perfeita para noites chuvosas.'),
(7, 'Manifesto Musical e Poético', 'Pensativo e enérgico', 5.0, 'Letras profundas sobre sociedade, raça e identidade. Um marco da década.'),
(8, 'Abraço Sonoro do Brasil', 'Aconchegante e poético', 5.0, 'Um dos maiores clássicos da música brasileira. Harmonias ricas e clima acolhedor.'),
(9, 'A Purificação do Rock Anos 90', 'Rebelde e agitado', 4.6, 'Pura energia dos anos 90 com riffs marcantes e vocais brutos.'),
(10, 'Nostalgia Synth dos Anos 2000', 'Nostálgico e animado', 4.8, 'Clássico absoluto da música eletrônica dos anos 2000.'),
(11, 'Imersão no Incerto', 'Misterioso', 3.5, NULL),
(12, 'A Grandiosidade do Queen', 'Empolgante', 5.0, 'Uma performance vocal incrível em Bohemian Rhapsody e ótimos arranjos.'),
(13, 'Sessão de Desconexão', 'Relaxado', 4.0, NULL),
(14, 'Experimento Caótico', 'Confuso', 2.8, 'Sons muito abstratos e sem estrutura definida.'),
(15, 'Mergulho Interno', 'Introspectivo', 4.9, NULL),
(16, 'Trilha para Concentração', 'Calmo', 4.2, 'Ótimo para focar no trabalho e estudos.');

