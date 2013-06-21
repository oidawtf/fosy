-- Rollen
INSERT INTO role (rolename, content) VALUES ('admin', 'showcustomers|editcustomer|customerdetails|requestdetails|createrequest|editrequest|createcustomer|showcampaigns|editcampaign|addcustomerstocampaign|customerdetailsfromcampaign|addarticlestocampaign|finalizecampaign|analyseCampaignPDF|createCampaignPDF'):
INSERT INTO role (rolename, content) VALUES ('management', 'showcustomers|editcustomer|customerdetails|requestdetails|createrequest|editrequest|createcustomer|showcampaigns|editcampaign|addcustomerstocampaign|customerdetailsfromcampaign|addarticlestocampaign|finalizecampaign|analyseCampaignPDF|createCampaignPDF');
INSERT INTO role (rolename, content) VALUES ('secretary', 'showcustomers|editcustomer|customerdetails|requestdetails|createrequest|editrequest|createcustomer|showcampaigns|analyseCampaignPDF');
INSERT INTO role (rolename, content) VALUES ('purchase', 'showcustomers|editcustomer|customerdetails|requestdetails|createrequest|editrequest|createcustomer|showcampaigns|analyseCampaignPDF');
INSERT INTO role (rolename, content) VALUES ('sales', 'showcustomers|editcustomer|customerdetails|requestdetails|createrequest|editrequest|createcustomer|showcampaigns|editcampaign|addcustomerstocampaign|customerdetailsfromcampaign|addarticlestocampaign|finalizecampaign|analyseCampaignPDF|createCampaignPDF');
INSERT INTO role (rolename, content) VALUES ('humanResources', 'showcustomers|editcustomer|customerdetails|requestdetails|createrequest|editrequest|createcustomer|showcampaigns|analyseCampaignPDF');
INSERT INTO role (rolename, content) VALUES ('accounting', 'showcustomers|editcustomer|customerdetails|requestdetails|createrequest|editrequest|createcustomer|showcampaigns|analyseCampaignPDF');
INSERT INTO role (rolename, content) VALUES ('montageManagement', 'showcustomers|editcustomer|customerdetails|requestdetails|createrequest|editrequest|createcustomer|showcampaigns|analyseCampaignPDF');
INSERT INTO role (rolename, content) VALUES ('montage', 'showcustomers|editcustomer|customerdetails|requestdetails|createrequest|editrequest|createcustomer|showcampaigns|analyseCampaignPDF');


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
INSERT INTO person (firstname, lastname, username, password, companyname, taxnumber, street, housenumber, city, zip, country, phone, phone_extension, personnel_number, hiredate, is_employee, fk_department_id) VALUES ('Felix', 'Martin', 'fma', '8c1b768340dffcaf747fd0acc98f0ce5', 'Felix Martin Hi-Fi-und Videostudios', '051234567', 'Neubaugasse', 15, 'Wien', 1060, 'Österreich', '+43/1/2135782', '112', 1, '1975-01-01', 1, (select id from department where name='Geschäftsführung'));
INSERT INTO person (firstname, lastname, username, password, street, housenumber, city, zip, country, phone, phone_extension, personnel_number, hiredate, is_employee, fk_department_id) VALUES ('Herta', 'Martin', 'hma', '011e592469e4c74ebb562f6ce07e14da', 'Neubaugasse', 15, 'Wien', 1060, 'Österreich', '+43/1/2135782', '113', 2, '1975-01-01', 1, (select id from department where name='Assistenz GF'));
INSERT INTO person (firstname, lastname, username, password, street, housenumber, city, zip, country, phone, phone_extension, personnel_number, hiredate, is_employee, fk_department_id) VALUES ('Hans', 'Römer', 'hro', '86f7f8715c21598ba382f76914d63fb6', 'Neubaugasse', 15, 'Wien', 1060, 'Österreich', '+43/1/2135782', '114', 3, '2000-06-01', 1, (select id from department where name='Sekretariat'));
INSERT INTO person (firstname, lastname, username, password, street, housenumber, city, zip, country, phone, phone_extension, personnel_number, hiredate, is_employee, fk_department_id) VALUES ('Franziska', 'Paul', 'fpa', 'b43aef660c537b30557b09f6b151a95a', 'Neubaugasse', 15, 'Wien', 1060, 'Österreich', '+43/1/2135782', '115', 4, '1987-01-05', 1, (select id from department where name='Sekretariat'));
INSERT INTO person (firstname, lastname, username, password, street, housenumber, city, zip, country, phone, phone_extension, personnel_number, hiredate, is_employee, fk_department_id) VALUES ('Martina', 'Haslinger', 'mha', 'dac8c9e6ec0efe64569e77030a62afdc', 'Neubaugasse', 15, 'Wien', 1060, 'Österreich', '+43/1/2135782', '116', 5, '1980-10-01', 1, (select id from department where name='Einkauf'));
INSERT INTO person (firstname, lastname, username, password, street, housenumber, city, zip, country, phone, phone_extension, personnel_number, hiredate, is_employee, fk_department_id) VALUES ('Lisa', 'Pammer', 'lpa', '58abb759e5602eec30e9e8ac773f9bc9', 'Neubaugasse', 15, 'Wien', 1060, 'Österreich', '+43/1/2135782', '117', 6, '1995-03-01', 1, (select id from department where name='Einkauf Assistenz'));
INSERT INTO person (firstname, lastname, username, password, street, housenumber, city, zip, country, phone, phone_extension, personnel_number, hiredate, is_employee, fk_department_id) VALUES ('Carmen', 'Martin', 'cma', 'a1f64bc3bec340545184ca0c623e87b8', 'Neubaugasse', 15, 'Wien', 1060, 'Österreich', '+43/1/2135782', '118', 7, '2000-05-02', 1, (select id from department where name='Verkauf'));
INSERT INTO person (firstname, lastname, username, password, street, housenumber, city, zip, country, phone, phone_extension, personnel_number, hiredate, is_employee, fk_department_id) VALUES ('Manuela', 'Basenovic', 'mba', '91e112b7220af68fcf5be09ee837f7a7', 'Neubaugasse', 15, 'Wien', 1060, 'Österreich', '+43/1/2135782', '119', 8, '1986-04-01', 1, (select id from department where name='Verkauf Assistenz'));
INSERT INTO person (firstname, lastname, username, password, street, housenumber, city, zip, country, phone, phone_extension, personnel_number, hiredate, is_employee, fk_department_id) VALUES ('Peter', 'Heilfried', 'phe', 'a2803f8aca5234170773a6f08e7a8d9a', 'Neubaugasse', 15, 'Wien', 1060, 'Österreich', '+43/1/2135782', '120', 9, '1990-02-03', 1, (select id from department where name='Personalverwaltung'));
INSERT INTO person (firstname, lastname, username, password, street, housenumber, city, zip, country, phone, phone_extension, personnel_number, hiredate, is_employee, fk_department_id) VALUES ('Karina', 'Sobotini', 'kso', '23812638f5f54a671eb207c2955c1fad', 'Neubaugasse', 15, 'Wien', 1060, 'Österreich', '+43/1/2135782', '121', 10, '1980-01-01', 1, (select id from department where name='Buchhaltung'));
INSERT INTO person (firstname, lastname, username, password, street, housenumber, city, zip, country, phone, phone_extension, personnel_number, hiredate, is_employee, fk_department_id) VALUES ('David', 'Martin', 'dma', '695578cfd3a6c798fefb9d3f475360ba', 'Neubaugasse', 15, 'Wien', 1060, 'Österreich', '+43/1/2135782', '122', 11, '2003-08-04', 1, (select id from department where name='Montage Leiter'));
INSERT INTO person (firstname, lastname, username, password, street, housenumber, city, zip, country, phone, phone_extension, personnel_number, hiredate, is_employee, fk_department_id) VALUES ('Sigrid', 'Geya', 'sge', '2a2ab400d355ac301859e4abb5432138', 'Neubaugasse', 15, 'Wien', 1060, 'Österreich', '+43/1/2135782', '123', 12, '1987-05-02', 1, (select id from department where name='Montage'));
INSERT INTO person (firstname, lastname, username, password, street, housenumber, city, zip, country, phone, phone_extension, personnel_number, hiredate, is_employee, fk_department_id) VALUES ('Hannes', 'Reczak', 'hre', '9f56a3366094da9772401b9d5612b6e7', 'Neubaugasse', 15, 'Wien', 1060, 'Österreich', '+43/1/2135782', '124', 13, '1981-01-05', 1, (select id from department where name='Montage'));
INSERT INTO person (firstname, lastname, username, password, street, housenumber, city, zip, country, phone, phone_extension, personnel_number, hiredate, is_employee, fk_department_id) VALUES ('Bernd', 'Riffl', 'bri', '11c5bbeea416ba0f55390e306769394d', 'Neubaugasse', 15, 'Wien', 1060, 'Österreich', '+43/1/2135782', '125', 14, '1983-11-01', 1, (select id from department where name='Montage'));
INSERT INTO person (firstname, lastname, username, password, street, housenumber, city, zip, country, phone, phone_extension, personnel_number, hiredate, is_employee, fk_department_id) VALUES ('Balo', 'Ursulic', 'bur', '5332c994a9ffe7d2d59e8e6e4a732216', 'Neubaugasse', 15, 'Wien', 1060, 'Österreich', '+43/1/2135782', '126', 15, '1992-08-03', 1, (select id from department where name='Montage'));
INSERT INTO person (firstname, lastname, username, password, street, housenumber, city, zip, country, phone, phone_extension, personnel_number, hiredate, is_employee, fk_department_id) VALUES ('Gerd', 'Funkenhofer', 'gfu', '7e55e9f1a5607944f97ec52b152c34c4', 'Neubaugasse', 15, 'Wien', 1060, 'Österreich', '+43/1/2135782', '127', 16, '1995-09-01', 1, (select id from department where name='Montage'));
INSERT INTO person (firstname, lastname, username, password, street, housenumber, city, zip, country, phone, phone_extension, personnel_number, hiredate, is_employee, fk_department_id) VALUES ('Sepp', 'Gaulhofer', 'sga', '5fcb6c59d83260960b81881843798a15', 'Neubaugasse', 15, 'Wien', 1060, 'Österreich', '+43/1/2135782', '128', 17, '1999-07-05', 1, (select id from department where name='Montage'));
INSERT INTO person (firstname, lastname, username, password, street, housenumber, city, zip, country, phone, phone_extension, personnel_number, hiredate, is_employee, fk_department_id) VALUES ('Hilda', 'Riedmüller', 'hri', '074f6c0c30332b90692d65099cb8469e', 'Neubaugasse', 15, 'Wien', 1060, 'Österreich', '+43/1/2135782', '129', 18, '2002-06-03', 1, (select id from department where name='Montage'));
INSERT INTO person (firstname, lastname, username, password, street, housenumber, city, zip, country, phone, phone_extension, personnel_number, hiredate, is_employee, fk_department_id) VALUES ('Christian', 'Spindel', 'csp', '3c2f5decde47940c8baf3b80dea449bd', 'Neubaugasse', 15, 'Wien', 1060, 'Österreich', '+43/1/2135782', '130', 19, '2002-06-03', 1, (select id from department where name='Montage'));
INSERT INTO person (firstname, lastname, username, password, street, housenumber, city, zip, country, phone, phone_extension, personnel_number, hiredate, is_employee, fk_department_id) VALUES ('Daniel', 'Vouk', 'dvo', 'e65d5d416912ddc6f4a951da7c13374a', 'Neubaugasse', 15, 'Wien', 1060, 'Österreich', '+43/1/2135782', '131', 20, '2008-03-03', 1, (select id from department where name='Montage'));
INSERT INTO person (firstname, lastname, username, password, street, housenumber, city, zip, country, phone, phone_extension, personnel_number, hiredate, is_employee, fk_department_id) VALUES ('Sandra', 'Hasanic', 'sha', 'ca794fb2d950acf25c964ecc35f2d7e2', 'Neubaugasse', 15, 'Wien', 1060, 'Österreich', '+43/1/2135782', '132', 21, '2011-01-03', 1, (select id from department where name='Montage'));
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

-- tax_type
INSERT INTO tax_type (type) VALUES ('vst');
INSERT INTO tax_type (type) VALUES ('ust');

-- tax_rate
INSERT INTO tax_rate (rate) VALUES (10);
INSERT INTO tax_rate (rate) VALUES (20);

-- indicator_type
INSERT INTO indicator_type (type) VALUES ('KZ');
INSERT INTO indicator_type (type) VALUES ('TAB');

-- period
INSERT INTO period (value) VALUES ('1 Monat');
INSERT INTO period (value) VALUES ('1 Quartal');
INSERT INTO period (value) VALUES ('1 Jahr');

-- plannedValue_type
INSERT INTO plannedvalue_type (type) VALUES ('Stk.');
INSERT INTO plannedvalue_type (type) VALUES ('%');
INSERT INTO plannedvalue_type (type) VALUES ('€');

-- Status
INSERT INTO status (value) VALUES ('Offen');
INSERT INTO status (value) VALUES ('In Bearbeitung');
INSERT INTO status (value) VALUES ('Geschlossen');

-- Klassifizierung
INSERT INTO customer_request_type (type) VALUES ('Feedback');
INSERT INTO customer_request_type (type) VALUES ('Beschwerde');
INSERT INTO customer_request_type (type) VALUES ('Angebotsanfrage');
INSERT INTO customer_request_type (type) VALUES ('Auftragsanfrage');

-- indicator
INSERT INTO indicator (fk_indicator_type_id, name) VALUES ( (select id from indicator_type where type='KZ'), 'Anzahl Angebote');
INSERT INTO indicator (fk_indicator_type_id, name) VALUES ( (select id from indicator_type where type='KZ'), 'Anzahl Aufträge');
INSERT INTO indicator (fk_indicator_type_id, name) VALUES ( (select id from indicator_type where type='KZ'), 'Verhältnis Angebote/Aufträge');
INSERT INTO indicator (fk_indicator_type_id, name) VALUES ( (select id from indicator_type where type='KZ'), 'Gesamtumsatz');
INSERT INTO indicator (fk_indicator_type_id, name) VALUES ( (select id from indicator_type where type='TAB'), 'Mitarbeiterstatistik');
INSERT INTO indicator (fk_indicator_type_id, name) VALUES ( (select id from indicator_type where type='TAB'), 'Umsatz und Anzahl Bestellungen pro Kunde');

-- plannedValue
INSERT INTO plannedvalue (fk_period_id, fk_indicator_id, fk_plannedvalue_type_id, value) VALUES ( (select id from period where value='1 Monat'), (select id from indicator where name='Anzahl Angebote'), (select id from plannedvalue_type where type='Stk.'), '10');
INSERT INTO plannedvalue (fk_period_id, fk_indicator_id, fk_plannedvalue_type_id, value) VALUES ( (select id from period where value='1 Quartal'), (select id from indicator where name='Anzahl Angebote'), (select id from plannedvalue_type where type='Stk.'), '30');
INSERT INTO plannedvalue (fk_period_id, fk_indicator_id, fk_plannedvalue_type_id, value) VALUES ( (select id from period where value='1 Jahr'), (select id from indicator where name='Anzahl Angebote'), (select id from plannedvalue_type where type='Stk.'), '120');
INSERT INTO plannedvalue (fk_period_id, fk_indicator_id, fk_plannedvalue_type_id, value) VALUES ( (select id from period where value='1 Monat'), (select id from indicator where name='Anzahl Aufträge'), (select id from plannedvalue_type where type='Stk.'), '5');
INSERT INTO plannedvalue (fk_period_id, fk_indicator_id, fk_plannedvalue_type_id, value) VALUES ( (select id from period where value='1 Quartal'), (select id from indicator where name='Anzahl Aufträge'), (select id from plannedvalue_type where type='Stk.'), '15');
INSERT INTO plannedvalue (fk_period_id, fk_indicator_id, fk_plannedvalue_type_id, value) VALUES ( (select id from period where value='1 Monat'), (select id from indicator where name='Verhältnis Angebote/Aufträge'), (select id from plannedvalue_type where type='%'), '33,33');

-- tax
INSERT INTO invoice (fk_tax_type_id, fk_tax_rate_id, date, gross_price, net, tax, businessRecordNumber) VALUES ( (select id from tax_type where type='vst'), (select id from tax_rate where rate=10), '2013-01-02', 220.00, 200.00, 20.00, 'ER1');
INSERT INTO invoice (fk_tax_type_id, fk_tax_rate_id, date, gross_price, net, tax, businessRecordNumber) VALUES ( (select id from tax_type where type='vst'), (select id from tax_rate where rate=10), '2013-01-04', 374.00, 340.00, 34.00, 'ER2');
INSERT INTO invoice (fk_tax_type_id, fk_tax_rate_id, date, gross_price, net, tax, businessRecordNumber) VALUES ( (select id from tax_type where type='vst'), (select id from tax_rate where rate=10), '2013-01-10', 2343.00, 2130.00, 213.00, 'ER3');
INSERT INTO invoice (fk_tax_type_id, fk_tax_rate_id, date, gross_price, net, tax, businessRecordNumber) VALUES ( (select id from tax_type where type='vst'), (select id from tax_rate where rate=20), '2013-01-31', 968.00, 880.00, 88.00, 'ER4');
INSERT INTO invoice (fk_tax_type_id, fk_tax_rate_id, date, gross_price, net, tax, businessRecordNumber) VALUES ( (select id from tax_type where type='vst'), (select id from tax_rate where rate=20), '2013-02-04', 660.00, 600.00, 60.00, 'ER5');
INSERT INTO invoice (fk_tax_type_id, fk_tax_rate_id, date, gross_price, net, tax, businessRecordNumber) VALUES ( (select id from tax_type where type='vst'), (select id from tax_rate where rate=20), '2013-02-11', 352.00, 320.00, 32.00, 'ER6');
INSERT INTO invoice (fk_tax_type_id, fk_tax_rate_id, date, gross_price, net, tax, businessRecordNumber) VALUES ( (select id from tax_type where type='vst'), (select id from tax_rate where rate=20), '2013-02-15', 1023.00, 930.00, 93.00, 'ER7');
INSERT INTO invoice (fk_tax_type_id, fk_tax_rate_id, date, gross_price, net, tax, businessRecordNumber) VALUES ( (select id from tax_type where type='vst'), (select id from tax_rate where rate=10), '2013-02-20', 1100.00, 1000.00, 100.00, 'ER8');
INSERT INTO invoice (fk_tax_type_id, fk_tax_rate_id, date, gross_price, net, tax, businessRecordNumber) VALUES ( (select id from tax_type where type='vst'), (select id from tax_rate where rate=20), '2013-03-04', 550.00, 500.00, 50.00, 'ER9');
INSERT INTO invoice (fk_tax_type_id, fk_tax_rate_id, date, gross_price, net, tax, businessRecordNumber) VALUES ( (select id from tax_type where type='vst'), (select id from tax_rate where rate=20), '2013-03-08', 583.00, 530.00, 53.00, 'ER10');
INSERT INTO invoice (fk_tax_type_id, fk_tax_rate_id, date, gross_price, net, tax, businessRecordNumber) VALUES ( (select id from tax_type where type='vst'), (select id from tax_rate where rate=20), '2013-03-11', 385.00, 350.00, 35.00, 'ER11');
INSERT INTO invoice (fk_tax_type_id, fk_tax_rate_id, date, gross_price, net, tax, businessRecordNumber) VALUES ( (select id from tax_type where type='vst'), (select id from tax_rate where rate=10), '2013-04-05', 528.00, 480.00, 48.00, 'ER12');
INSERT INTO invoice (fk_tax_type_id, fk_tax_rate_id, date, gross_price, net, tax, businessRecordNumber) VALUES ( (select id from tax_type where type='vst'), (select id from tax_rate where rate=20), '2013-04-08', 374.00, 340.00, 34.00, 'ER13');
INSERT INTO invoice (fk_tax_type_id, fk_tax_rate_id, date, gross_price, net, tax, businessRecordNumber) VALUES ( (select id from tax_type where type='vst'), (select id from tax_rate where rate=20), '2013-04-19', 1122.00, 1020.00, 102.00, 'ER14');
INSERT INTO invoice (fk_tax_type_id, fk_tax_rate_id, date, gross_price, net, tax, businessRecordNumber) VALUES ( (select id from tax_type where type='vst'), (select id from tax_rate where rate=20), '2013-04-23', 594.00, 540.00, 54.00, 'ER15');
INSERT INTO invoice (fk_tax_type_id, fk_tax_rate_id, date, gross_price, net, tax, businessRecordNumber) VALUES ( (select id from tax_type where type='vst'), (select id from tax_rate where rate=20), '2013-05-02', 374.00, 340.00, 34.00, 'ER16');
INSERT INTO invoice (fk_tax_type_id, fk_tax_rate_id, date, gross_price, net, tax, businessRecordNumber) VALUES ( (select id from tax_type where type='vst'), (select id from tax_rate where rate=20), '2013-05-06', 957.00, 870.00, 87.00, 'ER17');
INSERT INTO invoice (fk_tax_type_id, fk_tax_rate_id, date, gross_price, net, tax, businessRecordNumber) VALUES ( (select id from tax_type where type='vst'), (select id from tax_rate where rate=20), '2013-05-10', 968.00, 880.00, 88.00, 'ER18');
INSERT INTO invoice (fk_tax_type_id, fk_tax_rate_id, date, gross_price, net, tax, businessRecordNumber) VALUES ( (select id from tax_type where type='vst'), (select id from tax_rate where rate=20), '2013-05-20', 616.00, 560.00, 56.00, 'ER19');
INSERT INTO invoice (fk_tax_type_id, fk_tax_rate_id, date, gross_price, net, tax, businessRecordNumber) VALUES ( (select id from tax_type where type='ust'), (select id from tax_rate where rate=20), '2013-01-02', 336.00, 280.00, 56.00, 'AR1');
INSERT INTO invoice (fk_tax_type_id, fk_tax_rate_id, date, gross_price, net, tax, businessRecordNumber) VALUES ( (select id from tax_type where type='ust'), (select id from tax_rate where rate=10), '2013-01-10', 1080.00, 900.00, 180.00, 'AR2');
INSERT INTO invoice (fk_tax_type_id, fk_tax_rate_id, date, gross_price, net, tax, businessRecordNumber) VALUES ( (select id from tax_type where type='ust'), (select id from tax_rate where rate=20), '2013-01-31', 270.00, 225.00, 45.00, 'AR3');
INSERT INTO invoice (fk_tax_type_id, fk_tax_rate_id, date, gross_price, net, tax, businessRecordNumber) VALUES ( (select id from tax_type where type='ust'), (select id from tax_rate where rate=20), '2013-02-05', 336.00, 280.00, 56.00, 'AR4');
INSERT INTO invoice (fk_tax_type_id, fk_tax_rate_id, date, gross_price, net, tax, businessRecordNumber) VALUES ( (select id from tax_type where type='ust'), (select id from tax_rate where rate=10), '2013-02-11', 462.00, 385.00, 77.00, 'AR5');
INSERT INTO invoice (fk_tax_type_id, fk_tax_rate_id, date, gross_price, net, tax, businessRecordNumber) VALUES ( (select id from tax_type where type='ust'), (select id from tax_rate where rate=20), '2013-02-12', 564.00, 470.00, 94.00, 'AR6');
INSERT INTO invoice (fk_tax_type_id, fk_tax_rate_id, date, gross_price, net, tax, businessRecordNumber) VALUES ( (select id from tax_type where type='ust'), (select id from tax_rate where rate=20), '2013-02-20', 612.00, 510.00, 102.00, 'AR7');
INSERT INTO invoice (fk_tax_type_id, fk_tax_rate_id, date, gross_price, net, tax, businessRecordNumber) VALUES ( (select id from tax_type where type='ust'), (select id from tax_rate where rate=20), '2013-03-04', 318.00, 265.00, 53.00, 'AR8');
INSERT INTO invoice (fk_tax_type_id, fk_tax_rate_id, date, gross_price, net, tax, businessRecordNumber) VALUES ( (select id from tax_type where type='ust'), (select id from tax_rate where rate=20), '2013-03-15', 72.00, 60.00, 12.00, 'AR9');
INSERT INTO invoice (fk_tax_type_id, fk_tax_rate_id, date, gross_price, net, tax, businessRecordNumber) VALUES ( (select id from tax_type where type='ust'), (select id from tax_rate where rate=20), '2013-03-19', 588.00, 490.00, 98.00, 'AR10');
INSERT INTO invoice (fk_tax_type_id, fk_tax_rate_id, date, gross_price, net, tax, businessRecordNumber) VALUES ( (select id from tax_type where type='ust'), (select id from tax_rate where rate=20), '2013-03-25', 336.00, 280.00, 56.00, 'AR11');
INSERT INTO invoice (fk_tax_type_id, fk_tax_rate_id, date, gross_price, net, tax, businessRecordNumber) VALUES ( (select id from tax_type where type='ust'), (select id from tax_rate where rate=20), '2013-04-01', 222.00, 185.00, 37.00, 'AR12');
INSERT INTO invoice (fk_tax_type_id, fk_tax_rate_id, date, gross_price, net, tax, businessRecordNumber) VALUES ( (select id from tax_type where type='ust'), (select id from tax_rate where rate=20), '2013-04-18', 144.00, 120.00, 24.00, 'AR13');
INSERT INTO invoice (fk_tax_type_id, fk_tax_rate_id, date, gross_price, net, tax, businessRecordNumber) VALUES ( (select id from tax_type where type='ust'), (select id from tax_rate where rate=10), '2013-04-19', 600.00, 500.00, 100.00, 'AR14');
INSERT INTO invoice (fk_tax_type_id, fk_tax_rate_id, date, gross_price, net, tax, businessRecordNumber) VALUES ( (select id from tax_type where type='ust'), (select id from tax_rate where rate=20), '2013-05-04', 522.00, 435.00, 87.00, 'AR15');
INSERT INTO invoice (fk_tax_type_id, fk_tax_rate_id, date, gross_price, net, tax, businessRecordNumber) VALUES ( (select id from tax_type where type='ust'), (select id from tax_rate where rate=20), '2013-05-08', 204.00, 170.00, 34.00, 'AR16');
INSERT INTO invoice (fk_tax_type_id, fk_tax_rate_id, date, gross_price, net, tax, businessRecordNumber) VALUES ( (select id from tax_type where type='ust'), (select id from tax_rate where rate=20), '2013-05-20', 150.00, 125.00, 25.00, 'AR17');
INSERT INTO invoice (fk_tax_type_id, fk_tax_rate_id, date, gross_price, net, tax, businessRecordNumber) VALUES ( (select id from tax_type where type='ust'), (select id from tax_rate where rate=10), '2013-05-22', 402.00, 335.00, 67.00, 'AR18');
INSERT INTO invoice (fk_tax_type_id, fk_tax_rate_id, date, gross_price, net, tax, businessRecordNumber) VALUES ( (select id from tax_type where type='ust'), (select id from tax_rate where rate=20), '2013-05-23', 228.00, 190.00, 38.00, 'AR19');

-- Daten für Tabelle `person` Customer
INSERT INTO `person` (`id`, `fk_department_id`, `firstname`, `lastname`, `username`, `password`, `title`, `street`, `housenumber`, `stiege`, `doornumber`, `city`, `zip`, `country`, `phone`, `fax`, `email`, `birthdate`, `personnel_number`, `hiredate`, `position`, `is_distributor`, `is_customer`, `is_employee`) VALUES
(23, NULL, 'Bernd', 'Maur', NULL, NULL, NULL, 'Libellengasse', 12, 2, 4, 'Saraberg', 9863, 'Austria', '0650 659 61 34', NULL, NULL, '1954-12-05', NULL, NULL, NULL, NULL, 1, NULL),
(24, NULL, 'Mike', 'Dreher', NULL, NULL, NULL, 'Schlösslstrasse ', 13, 2, 1, 'NETZBERG', 4420, 'Austria', '0664 654 54 70', NULL, 'mike.dreher@gmail.de', '1984-12-08', NULL, NULL, NULL, NULL, 1, NULL),
(25, NULL, 'Sven', 'Papst', NULL, NULL, NULL, 'Kimpling ', 22, 2, 1, 'ZWETTL AN DER RODL', 1120, 'Austria', '0680 659 34 34', NULL, NULL, '1970-12-05', NULL, NULL, NULL, NULL, 1, NULL),
(26, NULL, 'Paul', 'Nussbaum', NULL, NULL, NULL, 'Salzburger Strasse', 43, 2, 1, 'LITZLDORF', 5512, 'Austria', '0650 659 61 34', NULL, 'paul.nussbaum@gmail.de', '1954-10-15', NULL, NULL, NULL, NULL, 1, NULL),
(27, NULL, 'Jens', 'Schmidt', NULL, NULL, NULL, 'Bonygasse', 11, 2, 1, ' EBEN IM PONGAU', 1780, 'Austria', '0650 342 34 34', NULL, 'BerndMaur@gmail.de', '1954-12-05', NULL, NULL, NULL, NULL, 1, NULL),
(28, NULL, 'Matthias', 'Hofmann', NULL, NULL, NULL, 'Herrenstrasse ', 43, 2, 1, 'HAIMACH', 8800, 'Austria', '0650 342 61 49', NULL, 'jensschmidt@gmail.de', '1970-12-05', NULL, NULL, NULL, NULL, 1, NULL),
(29, NULL, 'Jan', 'Sanger', NULL, NULL, NULL, 'Ditscheinergasse', 6, 2, 1, 'SCHENKENBRUNN', 2654, 'Austria', '0650 34 34 3', NULL, 'matthiashofman@gmail.de', '1959-12-05', NULL, NULL, NULL, NULL, 1, NULL),
(30, NULL, 'Klaus', 'Trommler', NULL, NULL, NULL, 'Schlösslstrasse ', 36, 2, 1, 'PICHLING', 1256, 'Austria', '0650 659 34 49', NULL, 'jan@gmail.de', '1997-12-05', NULL, NULL, NULL, NULL, 1, NULL),
(31, NULL, 'Lucas', 'Aachen', NULL, NULL, NULL, 'Bahnhofstrasse', 23, 2, 1, 'SIMETSHAM', 2240, 'Austria', '0650 659 34 49', NULL, 'klaust@gmail.de', '1952-12-05', NULL, NULL, NULL, NULL, 1, NULL),
(32, NULL, 'Marko', 'Metzger', NULL, NULL, NULL, 'Zeppelinstrasse', 25, 2, 1, 'OBERRIETHAL', 3665, 'Austria', '0650 34 61 49', NULL, 'markometzger@gmail.de', '1954-12-05', NULL, NULL, NULL, NULL, 1, NULL),
(33, NULL, 'Ralph', 'Seiler', NULL, NULL, NULL, 'Horner Strasse', 11, 2, 5, 'BIRKFELD', 6582, 'Austria', '0650 34 34 34', NULL, 'ralphseiler@gmail.de', '1954-12-09', NULL, NULL, NULL, NULL, 1, NULL),
(34, NULL, 'Leon', 'Mayer', NULL, NULL, NULL, 'Traungasse ', 75, 2, 8, 'LUEGGRABEN', 2568, 'Austria', '0650 34 61 34', NULL, 'leonmayer@gmail.de', '1067-12-05', NULL, NULL, NULL, NULL, 1, NULL);

-- Daten für Tabelle `article_category`
INSERT INTO `article_category` (`id`, `name`) VALUES
(1, 'TV'),
(2, 'Hifi'),
(3, 'Video'),
(4, 'Radio'),
(5, 'Sonstiges');

-- Daten für Tabelle `article_manufacturer`
INSERT INTO `article_manufacturer` (`id`, `name`) VALUES
(1, 'Samsung'),
(2, 'Sony'),
(3, 'Panasonc'),
(4, 'Toshiba'),
(5, 'Apple');

-- Daten für Tabelle `article`
INSERT INTO `article` (`id`, `fk_article_category_id`, `fk_article_manufacturer_id`, `model`, `description`, `picture`, `stock`, `purchase_price`, `selling_price`, `tax_rate`) VALUES
(1, 1, 1, 'UE46F6500 ', 'Diagonale: 117cm, Auflösung: 1920x1080, Format: 16:9', NULL, 5, 605.00, 805.00, 20),
(2, 1, 2, '46PFL3807K', 'Diagonale: 117cm, Auflösung: 1920x1080, Format: 16:9', NULL, 0, 380.00, 470.00, 20),
(3, 1, 1, 'UE55F6500', 'Diagonale: 139cm, Auflösung: 1920x1080, Format: 16:9', NULL, 12, 1050.00, 1200.00, 8),
(4, 3, 2, 'BDP-S560E', ' Blu-ray(BD-ROM/BD-R(E)), DVD+R(W)/DVD-R(W)/DVD-Video', NULL, 50, 95.00, 149.00, 20),
(5, 4, 2, 'SCD-XE800', 'Wiedergabe: CD-R(W)/SACD. Abmessungen: 430x95x295mm', NULL, 14, 143.00, 182.00, 20),
(6, 2, 5, 'iPod nano', 'Display: 1.54" Color-LCD Touchscreen (240x240)', NULL, 10, 149.00, 179.00, 20);

-- Daten für Tabelle `customer_request`
INSERT INTO `customer_request` (`id`, `fk_customer_request_type_id`, `fk_person_id`, `fk_responsible_user_id`, `fk_article_id`, `fk_status_id`, `date`, `text`) VALUES
(1, 1, 23, 22, 3, 1, '2013-06-20', 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.'),
(2, 2, 23, 22, 4, 2, '2013-06-11', 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.'),
(3, 3, 30, 22, 6, 3, '2013-06-02', 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.'),
(4, 4, 23, 22, 1, 3, '2013-06-29', 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.');

-- Dumping data for table `campaign`
INSERT INTO `campaign` (`id`, `name`, `description`, `goal`, `date_from`, `date_to`, `budget`, `medium`, `code`) VALUES
(1, 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata', 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata', 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata', '2013-04-15', '2013-05-15', 100000.00, 'address', NULL),
(2, 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata', 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata', 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata', '2013-05-15', '2013-06-15', 20000.00, 'email', NULL),
(3, 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. 

Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu f', '2013-01-01', '2013-12-31', 1750000.00, 'address', NULL);

-- Dumping data for table `campaign_article`
INSERT INTO `campaign_article` (`fk_campaign_id`, `fk_article_id`, `real_price`) VALUES
(1, 1, NULL),
(1, 2, NULL),
(1, 6, 100.00),
(2, 1, NULL),
(2, 2, NULL),
(2, 3, NULL),
(2, 4, NULL),
(3, 1, NULL),
(3, 2, NULL),
(3, 3, NULL),
(3, 4, NULL);

-- Dumping data for table `campaign_person`
INSERT INTO `campaign_person` (`fk_person_id`, `fk_campaign_id`) VALUES
(23, 1),
(23, 2),
(23, 3),
(24, 1),
(24, 2),
(24, 3),
(25, 1),
(26, 2),
(26, 3),
(27, 2),
(27, 3),
(28, 1);

-- delivery 
INSERT INTO delivery (price, street, housenumber, city, zip, country, assambly) VALUES ('22.50', 'Straße', 1, 'Wien', 1060, 'Österreich', 0);
INSERT INTO delivery (price, street, housenumber, city, zip, country, assambly) VALUES ('1234.99', 'Hauptplatz', 5, 'Wien', 1190, 'Österreich', 1);
INSERT INTO delivery (price, street, housenumber, stiege, doornumber, city, zip, country, assambly) VALUES ('13.99', 'Engerthstraße', 138, 5, 21, 'Wien', 1200, 'Österreich', 0);

-- offer
INSERT INTO offer (fk_customer_id, fk_delivery_id, number, date, valid_from, valid_until) VALUES (23, 1, 'offer-1-2013', '2013-06-02', '2013-06-02', '2013-06-30');
INSERT INTO offer (fk_customer_id, fk_delivery_id, number, date, valid_from, valid_until) VALUES (24, 2, 'offer-2-2013', '2013-04-15', '2013-04-15', '2013-05-15');
INSERT INTO offer (fk_customer_id, fk_delivery_id, number, date, valid_from, valid_until) VALUES (29, 3, 'offer-3-2013', '2013-05-03', '2013-05-03', '2013-06-03');
INSERT INTO offer (fk_customer_id, fk_delivery_id, number, date, valid_from, valid_until) VALUES (23, 1, 'offer-4-2013', '2013-06-11', '2013-06-11', '2013-07-11');
INSERT INTO offer (fk_customer_id, fk_delivery_id, number, date, valid_from, valid_until) VALUES (30, 3, 'offer-5-2013', '2013-04-25', '2013-04-25', '2013-05-15');

-- orders
INSERT INTO orders(number, date) VALUES ('order-1-2013', '2013-04-15');
UPDATE offer SET fk_order_id=(select id from orders where number='order-1-2013') where number = 'offer-1-2013';
INSERT INTO invoice(fk_tax_type_id, fk_tax_rate_id, date, gross_price, net, tax, businessRecordNumber) VALUES ( (select id from tax_type where type='ust'), (select id from tax_rate where rate=20), '2013-04-15', 1200, 1000, 200, 'order-1-2013');
INSERT INTO orders(number, date) VALUES ('order-2-2013', '2013-06-15');
UPDATE offer SET fk_order_id=(select id from orders where number='order-2-2013') where number = 'offer-2-2013';
INSERT INTO invoice(fk_tax_type_id, fk_tax_rate_id, date, gross_price, net, tax, businessRecordNumber) VALUES ( (select id from tax_type where type='ust'), (select id from tax_rate where rate=20), '2013-06-15', 60, 50, 10, 'order-2-2013');
INSERT INTO orders(number, date) VALUES ('order-4-2013', '2013-06-15');
UPDATE offer SET fk_order_id=(select id from orders where number='order-4-2013') where number = 'offer-4-2013';
INSERT INTO invoice(fk_tax_type_id, fk_tax_rate_id, date, gross_price, net, tax, businessRecordNumber) VALUES ( (select id from tax_type where type='ust'), (select id from tax_rate where rate=20), '2013-06-15', 120, 100, 20, 'order-4-2013');
INSERT INTO orders(number, date) VALUES ('order-5-2013', '2013-05-10');
UPDATE offer SET fk_order_id=(select id from orders where number='order-5-2013') where number = 'offer-5-2013';

INSERT INTO `offer_article` (`fk_article_id`, `fk_offer_id`, `count`) VALUES
(1, 1, 3),
(1, 2, 5),
(2, 1, 2),
(3, 2, 6),
(5, 4, 2),
(5, 5, 8),
(6, 4, 7),
(6, 5, 9);
