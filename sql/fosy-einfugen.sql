-- Rollen
INSERT INTO role (rolename) VALUES ('admin');
INSERT INTO role (rolename) VALUES ('management');
INSERT INTO role (rolename) VALUES ('secretary');
INSERT INTO role (rolename) VALUES ('purchase');
INSERT INTO role (rolename) VALUES ('sales');
INSERT INTO role (rolename) VALUES ('humanResources');
INSERT INTO role (rolename) VALUES ('accounting');
INSERT INTO role (rolename) VALUES ('montageManagement');
INSERT INTO role (rolename) VALUES ('montage');

-- Abteilungen
INSERT INTO department (name) VALUES ('Geschäftsführung');
INSERT INTO department (name) VALUES ('Assistenz GF');
INSERT INTO department (name) VALUES ('Sekretariat');
INSERT INTO department (name) VALUES ('Einkauf');
INSERT INTO department (name) VALUES ('Einkauf Assistenz');
INSERT INTO department (name) VALUES ('Verkauf');
INSERT INTO department (name) VALUES ('Verkauf Assistenz');
INSERT INTO department (name) VALUES ('Personalverwaltung');
INSERT INTO department (name) VALUES ('Buchhaltung');
INSERT INTO department (name) VALUES ('Montage Leiter');
INSERT INTO department (name) VALUES ('Montage');

-- Personen (Mitarbeiter)
INSERT INTO person (firstname, lastname, username, password, street, housenumber, city, zip, country, phone, personnel_number, hiredate, is_employee, fk_department_id) VALUES ('Felix', 'Martin', 'fma', '8c1b768340dffcaf747fd0acc98f0ce5', 'Neubaugasse', 15, 'Wien', 1060, 'Österreich', '+43/1/2135782-112', 1, '1975-01-01', 1, (select id from department where name='Geschäftsführung'));
INSERT INTO person (firstname, lastname, username, password, street, housenumber, city, zip, country, phone, personnel_number, hiredate, is_employee, fk_department_id) VALUES ('Herta', 'Martin', 'hma', '011e592469e4c74ebb562f6ce07e14da', 'Neubaugasse', 15, 'Wien', 1060, 'Österreich', '+43/1/2135782-113', 2, '1975-01-01', 1, (select id from department where name='Assistenz GF'));
INSERT INTO person (firstname, lastname, username, password, street, housenumber, city, zip, country, phone, personnel_number, hiredate, is_employee, fk_department_id) VALUES ('Hans', 'Römer', 'hro', '86f7f8715c21598ba382f76914d63fb6', 'Neubaugasse', 15, 'Wien', 1060, 'Österreich', '+43/1/2135782-114', 3, '2000-06-01', 1, (select id from department where name='Sekretariat'));
INSERT INTO person (firstname, lastname, username, password, street, housenumber, city, zip, country, phone, personnel_number, hiredate, is_employee, fk_department_id) VALUES ('Franziska', 'Paul', 'fpa', 'b43aef660c537b30557b09f6b151a95a', 'Neubaugasse', 15, 'Wien', 1060, 'Österreich', '+43/1/2135782-115', 4, '1987-01-05', 1, (select id from department where name='Sekretariat'));
INSERT INTO person (firstname, lastname, username, password, street, housenumber, city, zip, country, phone, personnel_number, hiredate, is_employee, fk_department_id) VALUES ('Martina', 'Haslinger', 'mha', 'dac8c9e6ec0efe64569e77030a62afdc', 'Neubaugasse', 15, 'Wien', 1060, 'Österreich', '+43/1/2135782-116', 5, '1980-10-01', 1, (select id from department where name='Einkauf'));
INSERT INTO person (firstname, lastname, username, password, street, housenumber, city, zip, country, phone, personnel_number, hiredate, is_employee, fk_department_id) VALUES ('Lisa', 'Pammer', 'lpa', '58abb759e5602eec30e9e8ac773f9bc9', 'Neubaugasse', 15, 'Wien', 1060, 'Österreich', '+43/1/2135782-117', 6, '1995-03-01', 1, (select id from department where name='Einkauf Assistenz'));
INSERT INTO person (firstname, lastname, username, password, street, housenumber, city, zip, country, phone, personnel_number, hiredate, is_employee, fk_department_id) VALUES ('Carmen', 'Martin', 'cma', 'a1f64bc3bec340545184ca0c623e87b8', 'Neubaugasse', 15, 'Wien', 1060, 'Österreich', '+43/1/2135782-118', 7, '2000-05-02', 1, (select id from department where name='Verkauf'));
INSERT INTO person (firstname, lastname, username, password, street, housenumber, city, zip, country, phone, personnel_number, hiredate, is_employee, fk_department_id) VALUES ('Manuela', 'Basenovic', 'mba', '91e112b7220af68fcf5be09ee837f7a7', 'Neubaugasse', 15, 'Wien', 1060, 'Österreich', '+43/1/2135782-119', 8, '1986-04-01', 1, (select id from department where name='Verkauf Assistenz'));
INSERT INTO person (firstname, lastname, username, password, street, housenumber, city, zip, country, phone, personnel_number, hiredate, is_employee, fk_department_id) VALUES ('Peter', 'Heilfried', 'phe', 'a2803f8aca5234170773a6f08e7a8d9a', 'Neubaugasse', 15, 'Wien', 1060, 'Österreich', '+43/1/2135782-120', 9, '1990-02-03', 1, (select id from department where name='Personalverwaltung'));
INSERT INTO person (firstname, lastname, username, password, street, housenumber, city, zip, country, phone, personnel_number, hiredate, is_employee, fk_department_id) VALUES ('Karina', 'Sobotini', 'kso', '23812638f5f54a671eb207c2955c1fad', 'Neubaugasse', 15, 'Wien', 1060, 'Österreich', '+43/1/2135782-121', 10, '1980-01-01', 1, (select id from department where name='Buchhaltung'));
INSERT INTO person (firstname, lastname, username, password, street, housenumber, city, zip, country, phone, personnel_number, hiredate, is_employee, fk_department_id) VALUES ('David', 'Martin', 'dma', '695578cfd3a6c798fefb9d3f475360ba', 'Neubaugasse', 15, 'Wien', 1060, 'Österreich', '+43/1/2135782-122', 11, '2003-08-04', 1, (select id from department where name='Montage Leiter'));
INSERT INTO person (firstname, lastname, username, password, street, housenumber, city, zip, country, phone, personnel_number, hiredate, is_employee, fk_department_id) VALUES ('Sigrid', 'Geya', 'sge', '2a2ab400d355ac301859e4abb5432138', 'Neubaugasse', 15, 'Wien', 1060, 'Österreich', '+43/1/2135782-123', 12, '1987-05-02', 1, (select id from department where name='Montage'));
INSERT INTO person (firstname, lastname, username, password, street, housenumber, city, zip, country, phone, personnel_number, hiredate, is_employee, fk_department_id) VALUES ('Hannes', 'Reczak', 'hre', '9f56a3366094da9772401b9d5612b6e7', 'Neubaugasse', 15, 'Wien', 1060, 'Österreich', '+43/1/2135782-124', 13, '1981-01-05', 1, (select id from department where name='Montage'));
INSERT INTO person (firstname, lastname, username, password, street, housenumber, city, zip, country, phone, personnel_number, hiredate, is_employee, fk_department_id) VALUES ('Bernd', 'Riffl', 'bri', '11c5bbeea416ba0f55390e306769394d', 'Neubaugasse', 15, 'Wien', 1060, 'Österreich', '+43/1/2135782-125', 14, '1983-11-01', 1, (select id from department where name='Montage'));
INSERT INTO person (firstname, lastname, username, password, street, housenumber, city, zip, country, phone, personnel_number, hiredate, is_employee, fk_department_id) VALUES ('Balo', 'Ursulic', 'bur', '5332c994a9ffe7d2d59e8e6e4a732216', 'Neubaugasse', 15, 'Wien', 1060, 'Österreich', '+43/1/2135782-126', 15, '1992-08-03', 1, (select id from department where name='Montage'));
INSERT INTO person (firstname, lastname, username, password, street, housenumber, city, zip, country, phone, personnel_number, hiredate, is_employee, fk_department_id) VALUES ('Gerd', 'Funkenhofer', 'gfu', '7e55e9f1a5607944f97ec52b152c34c4', 'Neubaugasse', 15, 'Wien', 1060, 'Österreich', '+43/1/2135782-127', 16, '1995-09-01', 1, (select id from department where name='Montage'));
INSERT INTO person (firstname, lastname, username, password, street, housenumber, city, zip, country, phone, personnel_number, hiredate, is_employee, fk_department_id) VALUES ('Sepp', 'Gaulhofer', 'sga', '5fcb6c59d83260960b81881843798a15', 'Neubaugasse', 15, 'Wien', 1060, 'Österreich', '+43/1/2135782-128', 17, '1999-07-05', 1, (select id from department where name='Montage'));
INSERT INTO person (firstname, lastname, username, password, street, housenumber, city, zip, country, phone, personnel_number, hiredate, is_employee, fk_department_id) VALUES ('Hilda', 'Riedmüller', 'hri', '074f6c0c30332b90692d65099cb8469e', 'Neubaugasse', 15, 'Wien', 1060, 'Österreich', '+43/1/2135782-129', 18, '2002-06-03', 1, (select id from department where name='Montage'));
INSERT INTO person (firstname, lastname, username, password, street, housenumber, city, zip, country, phone, personnel_number, hiredate, is_employee, fk_department_id) VALUES ('Christian', 'Spindel', 'csp', '3c2f5decde47940c8baf3b80dea449bd', 'Neubaugasse', 15, 'Wien', 1060, 'Österreich', '+43/1/2135782-130', 19, '2002-06-03', 1, (select id from department where name='Montage'));
INSERT INTO person (firstname, lastname, username, password, street, housenumber, city, zip, country, phone, personnel_number, hiredate, is_employee, fk_department_id) VALUES ('Daniel', 'Vouk', 'dvo', 'e65d5d416912ddc6f4a951da7c13374a', 'Neubaugasse', 15, 'Wien', 1060, 'Österreich', '+43/1/2135782-131', 20, '2008-03-03', 1, (select id from department where name='Montage'));
INSERT INTO person (firstname, lastname, username, password, street, housenumber, city, zip, country, phone, personnel_number, hiredate, is_employee, fk_department_id) VALUES ('Sandra', 'Hasanic', 'sha', 'ca794fb2d950acf25c964ecc35f2d7e2', 'Neubaugasse', 15, 'Wien', 1060, 'Österreich', '+43/1/2135782-132', 21, '2011-01-03', 1, (select id from department where name='Montage'));
INSERT INTO person (firstname, lastname, username, password, street, housenumber, city, zip, country, is_employee, fk_department_id) VALUES ('Administrator', 'Hero', 'admin', '598d4c200461b81522a3328565c25f7c', 'Straße', 1, 'Wien', 1010, 'Österreich', 1, (select id from department where name='Geschäftsführung'));

-- Person-Rollen-Verknuepfung
INSERT INTO person_role (fk_person_id, fk_role_id) values ( (select id from person where username='admin'), (select id from role where rolename='admin') );
INSERT INTO person_role (fk_person_id, fk_role_id) values ( (select id from person where username='fma'), (select id from role where rolename='management') );
INSERT INTO person_role (fk_person_id, fk_role_id) values ( (select id from person where username='hma'), (select id from role where rolename='management') );
INSERT INTO person_role (fk_person_id, fk_role_id) values ( (select id from person where username='hro'), (select id from role where rolename='secretary') );
INSERT INTO person_role (fk_person_id, fk_role_id) values ( (select id from person where username='fpa'), (select id from role where rolename='secretary') );
INSERT INTO person_role (fk_person_id, fk_role_id) values ( (select id from person where username='mha'), (select id from role where rolename='purchase') );
INSERT INTO person_role (fk_person_id, fk_role_id) values ( (select id from person where username='lpa'), (select id from role where rolename='purchase') );
INSERT INTO person_role (fk_person_id, fk_role_id) values ( (select id from person where username='cma'), (select id from role where rolename='sales') );
INSERT INTO person_role (fk_person_id, fk_role_id) values ( (select id from person where username='mba'), (select id from role where rolename='sales') );
INSERT INTO person_role (fk_person_id, fk_role_id) values ( (select id from person where username='phe'), (select id from role where rolename='humanResources') );
INSERT INTO person_role (fk_person_id, fk_role_id) values ( (select id from person where username='kso'), (select id from role where rolename='accounting') );
INSERT INTO person_role (fk_person_id, fk_role_id) values ( (select id from person where username='dma'), (select id from role where rolename='montageManagement') );
INSERT INTO person_role (fk_person_id, fk_role_id) values ( (select id from person where username='sge'), (select id from role where rolename='montage') );
INSERT INTO person_role (fk_person_id, fk_role_id) values ( (select id from person where username='hre'), (select id from role where rolename='montage') );
INSERT INTO person_role (fk_person_id, fk_role_id) values ( (select id from person where username='bri'), (select id from role where rolename='montage') );
INSERT INTO person_role (fk_person_id, fk_role_id) values ( (select id from person where username='bur'), (select id from role where rolename='montage') );
INSERT INTO person_role (fk_person_id, fk_role_id) values ( (select id from person where username='gfu'), (select id from role where rolename='montage') );
INSERT INTO person_role (fk_person_id, fk_role_id) values ( (select id from person where username='sga'), (select id from role where rolename='montage') );
INSERT INTO person_role (fk_person_id, fk_role_id) values ( (select id from person where username='hri'), (select id from role where rolename='montage') );
INSERT INTO person_role (fk_person_id, fk_role_id) values ( (select id from person where username='csp'), (select id from role where rolename='montage') );
INSERT INTO person_role (fk_person_id, fk_role_id) values ( (select id from person where username='dvo'), (select id from role where rolename='montage') );
INSERT INTO person_role (fk_person_id, fk_role_id) values ( (select id from person where username='sha'), (select id from role where rolename='montage') );

-- Artikel Kategorien
INSERT INTO article_category (name) VALUES ('TV');
INSERT INTO article_category (name) VALUES ('Hifi');
INSERT INTO article_category (name) VALUES ('Video');
INSERT INTO article_category (name) VALUES ('Radio');
INSERT INTO article_category (name) VALUES ('Sonstiges');

-- tax_type
INSERT INTO tax_type (type) VALUES ('vst');
INSERT INTO tax_type (type) VALUES ('ust');

-- indicator
INSERT INTO indicator_type (type) VALUES ('KZ');
INSERT INTO indicator_type (type) VALUES ('TAB');

-- period
INSERT INTO period (value) VALUES ('1 Monat');
INSERT INTO period (value) VALUES ('1 Quartal');
INSERT INTO period (value) VALUES ('1 Jahr');

