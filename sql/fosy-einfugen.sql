INSERT INTO role (rolename) VALUES ('admin');

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

INSERT INTO person (firstname, lastname, username, password, street, housenumber, city, zip, country, is_employee, fk_department_id) VALUES ('Administrator', 'Hero', 'admin', '598d4c200461b81522a3328565c25f7c', 'Straße', 1, 'Wien', '1010', 'Österreich', 1, (select id from department where name='Geschäftsführung'));

INSERT INTO person_role values ( (select id from role where rolename='admin'), (select id from person where username='admin') );


