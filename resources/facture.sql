DROP DATABASE IF EXISTS facture;
CREATE DATABASE facture;
USE facture;

CREATE TABLE factures (
    id INTEGER NOT NULL AUTO_INCREMENT,
    client VARCHAR(100) NOT NULL,
    caissier VARCHAR(100) NOT NULL,
    montant INTEGER NOT NULL,
    percu INTEGER NOT NULL,
    retourne INTEGER NOT NULL,
    etat VARCHAR(16) NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    name VARCHAR(100),
    email VARCHAR(100),
    password VARCHAR(255)
);


INSERT INTO factures (client, caissier, montant, percu, retourne, etat)
VALUES
    ('Rakoto Jean', 'Rasoa', 15000, 20000, 5000, 'payée'),
    ('Raharinaivo Andry', 'Rasoa', 10000, 10000, 0, 'facturée'),
    ('Rakotonirina Hery', 'Andrianina', 20000, 25000, 5000, 'annulée'),
    ('Randria Olivia', 'Rabe', 5000, 10000, 5000, 'payée'),
    ('Andriamatoa Pierre', 'Razafindrahery', 30000, 30000, 0, 'payée'),
    ('Rakotomalala Faly', 'Rajaonarison', 12000, 20000, 8000, 'facturée'),
    ('Rasoanaivo Tiana', 'Rakoto', 18000, 20000, 2000, 'payée'),
    ('Andriamanarivo Koto', 'Randrianarivo', 25000, 30000, 5000, 'annulée'),
    ('Rambeloson Mamy', 'Razafy', 8000, 10000, 2000, 'facturée'),
    ('Ranaivo Faly', 'Rahariharivelo', 22000, 25000, 3000, 'payée'),
    ('Andrianina Volana', 'Rasoa', 15000, 20000, 5000, 'payée'),
    ('Randriamanga Hery', 'Rakoto', 9000, 10000, 1000, 'annulée'),
    ('Rafalimanana Haja', 'Rabe', 14000, 20000, 6000, 'payée'),
    ('Andriamalala Joël', 'Randrianarivo', 18000, 18000, 0, 'facturée'),
    ('Ranaivo Faniry', 'Rajaonarison', 21000, 22000, 1000, 'payée'),
    ('Andriantsitoha Roben', 'Rasoa', 11000, 15000, 4000, 'facturée'),
    ('Raharimanana Lova', 'Rakoto', 27000, 30000, 3000, 'payée'),
    ('Randrianina Eva', 'Rabe', 19000, 25000, 6000, 'annulée'),
    ('Ralaivao Voahirana', 'Randrianarivo', 30000, 35000, 5000, 'payée'),
    ('Rakotoniaina Haja', 'Razafindrahery', 25000, 25000, 0, 'payée');
