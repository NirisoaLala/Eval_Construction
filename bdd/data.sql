insert into admin(nom, email, mdp) values
    ('Rakoto', 'rakoto@example.com', 'rakoto'),
    ('Rabe', 'rabe@example.com', 'rabe');

insert into travaux(code, nom) values
    ('000', 'Travaux preparatoire'),
    ('100', 'Travaux de terrassement'),
    ('200', 'Travaux en infrastructure');

insert into maison(nom, description, duree) values
    ('Maison en bois', '', 32),
    ('Maison moderne', '', 36),
    ('Maison traditionnelle', '', 58),
    ('Maison a etage', '', 45);

INSERT INTO maison(nom, description, duree) VALUES
    ('Maison en bois', 'Une charmante maison en bois offrant une ambiance chaleureuse et rustique. Les poutres apparentes et le revêtement en bois ajoutent une touche naturelle à cette résidence. Parfait pour ceux qui recherchent un refuge confortable au milieu de la nature.', 32),
    ('Maison moderne', 'Une maison au design contemporain qui allie fonctionnalité et élégance. Les lignes épurées, les grandes fenêtres et les matériaux minimalistes créent un espace lumineux et ouvert. Dotée des dernières technologies et déquipements de pointe, cette maison incarne le style de vie moderne.', 36),
    ('Maison traditionnelle', 'Une maison imprégnée de charme et d histoire, inspirée par les architectures régionales traditionnelles. Avec ses toits en pente, ses fenêtres à petits carreaux et ses détails architecturaux classiques, cette maison évoque un sentiment de confort et de familiarité. Parfaite pour ceux qui apprécient le caractère intemporel et l authenticité.', 58),
    ('Maison à étage', 'Une maison spacieuse qui offre un agencement sur plusieurs niveaux pour répondre aux besoins de toute la famille. Avec ses différents espaces de vie répartis sur plusieurs étages, cette maison offre une séparation claire entre les espaces de détente et de vie quotidienne. Idéale pour ceux qui recherchent une organisation pratique de l espace.', 45);


insert into finition(nom, pourcentage) values 
    ('Standard', 0),
    ('Gold', 20),
    ('Premium', 30),
    ('VIP', 40);

insert into sous_travaux(code, designation, unite, pu, idtravaux) values
    ('001', 'mur de soutenement et demi Cloture ht 1m', 'm3', 190000, 1),
    ('101', 'Decapage des terrains meuble', 'm2', 3072.87, 2),
    ('102', 'Dressage du plateforme', 'm2', 3736.26, 2),
    ('103', 'Fouille d ouvrage terrain ferme', 'm3', 9390.93, 2),
    ('104', 'Remblai d ouvrage', 'm3', 37563.26, 2),
    ('105', 'Travaux d implantation', 'ftt', 152656, 2);

insert into devis(idmaison, idst, qte) values
    ( 1, 1, 26.98),
    ( 1, 2, 101.36),
    ( 1, 3, 101.36),
    ( 1, 4, 24.44),
    ( 1, 5, 15.59),
    ( 1, 6, 1),
    ( 2, 1, 27.65),
    ( 2, 2, 99.98),
    ( 2, 3, 99.98),
    ( 2, 4, 25.48),
    ( 2, 5, 16),
    ( 2, 6, 1);

