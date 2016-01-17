INSERT INTO `course` (`course_id`, `name_en`, `name_de`) VALUES
(1, 'Japanese Foundation', 'Japanisch Grundkurs'),
(2, 'Japanese Advanced', 'Japanisch Fortgeschritten');

INSERT INTO `exercise` (`exercise_id`, `lesson_id`, `question`, `answer_en`, `answer_de`) VALUES
(28566, 1, 'Konnichiwa.', 'Hello', 'Hallo'),
(28567, 1, 'Konbanwa.', 'Good evening', 'Guten Abend'),
(28568, 1, 'Ohayo gozaimasu', 'Good morning', 'Guten Morgen'),
(28569, 2, 'Suisu', 'Switzerland', 'Schweiz'),
(28570, 2, 'Suisujin', 'Swiss person', 'Schweizer'),
(28571, 2, 'Doitsu', 'Germany', 'Deutschland'),
(28572, 2, 'Doitsugo', 'German', 'Deutsch'),
(28573, 1, 'Oyasuminasai.', 'Good night', 'Gute Nacht'),
(28574, 1, 'Sayōnara.', 'Goodbye', 'Tschüss'),
(28575, 1, 'Dewa mata.', 'See you', 'Auf Wiedersehen'),
(28576, 1, 'Arigatō gozaimasu.', 'Thank you', 'Dankeschön'),
(28577, 1, 'Sumimasen.', ' Excuse me', 'Entschuldigung'),
(28578, 1, 'Gomennasai.', 'I''m sorry', 'Tut mir leid'),
(28579, 2, 'Irigisu', 'England', 'England'),
(28580, 2, 'Eigo', 'English', 'Englisch'),
(28581, 2, 'Supein', 'Spain', 'Spanien'),
(28582, 2, 'Supeingo', 'Spanish', 'Spanisch'),
(28583, 2, 'Itaria', 'Italy', 'Italien'),
(28584, 2, 'Itariago', 'Italian', 'Italiener'),
(28585, 3, 'Chūgoku kara kimashita.', 'I''m from China', 'Ich komme aus China'),
(28586, 3, 'Watashi wa Nihon-jin desu.', 'I''m Japanese', 'Ich bin Japaner'),
(28587, 3, 'Itariajin', 'Italian', 'Italiener'),
(28588, 3, 'Ano hito wa dare desuka?', 'Who is that person?', 'Wer ist diese Person?'),
(28589, 9, 'Yo katta desu.', 'That was good', 'Das war gut'),
(28590, 9, 'Kantan deshita.', 'That was easy', 'Das war einfach'),
(28591, 9, 'oishi i', 'delicious', 'köstlich'),
(28592, 9, 'kirei na', 'beautiful', 'schön'),
(28593, 9, 'Sushi ga suki desu.', 'I like Sushi', 'Ich mag Sushi'),
(28594, 10, 'Mata kondo.', 'Some other time.', 'Ein ander mal.'),
(28595, 10, 'Chotto isogashii desu.', 'I''m a little busy.', 'Ich bin ziemlich beschäftigt.'),
(28596, 10, 'Yorokonde.', 'With pleasure.', 'Mit Vergnügen.'),
(28597, 10, 'Keitai o motte imasuka?', 'Do you have a cell phone?', 'Haben Sie ein Mobiltelefon?'),
(28598, 1, 'Arigatō.', 'Thanks', 'Danke');

INSERT INTO `lesson` (`lesson_id`, `course_id`, `lesson_nr`, `name_en`, `name_de`, `points`, `t_added`) VALUES
(1, 1, 1, 'Basic Expressions', 'Grundlegende Ausdrücke', 20, '2015-11-14 11:25:32'),
(2, 1, 2, 'Nationalities', 'Nationalitäten', 20, '2015-11-14 11:27:12'),
(3, 1, 3, 'Introducing yourself', 'Sich vorstellen', 30, '2015-11-14 11:28:46'),
(9, 4, 1, 'Expressing your feelings', 'Gefühle ausdrücken', 150, '2016-01-14 15:38:38'),
(10, 4, 2, 'Socializing', 'In Gesellschaft', 180, '2016-01-14 15:40:48');

INSERT INTO `user` (`email`, `nickname`, `pwd_hash`, `pwd_salt`, `t_registered`, `is_admin`) VALUES
('admin@hiragana.ch', 'admin', '7b55ac1aaf83e03ba51fd65eeaecb6ed', 'afab6a072868f422', '2016-01-17 11:27:44', 1),
('user@hiragana.ch', 'user', '8eea61ed67c341ccce5e7655b9257d94', 'b441993c4a85d837', '2016-01-17 11:27:22', 0);
