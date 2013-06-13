-- Reporting testdaten

-- indicator
INSERT INTO indicator (fk_indicator_type_id, name) VALUES ( (select id from indicator_type where type='KZ'), 'Anzahl Angebote');
INSERT INTO indicator (fk_indicator_type_id, name) VALUES ( (select id from indicator_type where type='KZ'), 'Anzahl Aufträge');
INSERT INTO indicator (fk_indicator_type_id, name) VALUES ( (select id from indicator_type where type='KZ'), 'Verhältnis Angebote/Aufträge');
INSERT INTO indicator (fk_indicator_type_id, name) VALUES ( (select id from indicator_type where type='KZ'), 'Umsatz pro Kunde');
INSERT INTO indicator (fk_indicator_type_id, name) VALUES ( (select id from indicator_type where type='TAB'), 'Mitarbeiterstatistik');
INSERT INTO indicator (fk_indicator_type_id, name) VALUES ( (select id from indicator_type where type='TAB'), 'Umsatz pro Kunde');
INSERT INTO indicator (fk_indicator_type_id, name) VALUES ( (select id from indicator_type where type='TAB'), 'Anzahl Bestellungen pro Kunde');

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
