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
INSERT INTO tax (fk_tax_type_id, fk_tax_rate_id, date, value, businessRecordNumber) VALUES ( (select id from tax_type where type='vst'), (select id from tax_rate where rate=10), '2013-01-02', 20.00, 'ER1');
INSERT INTO tax (fk_tax_type_id, fk_tax_rate_id, date, value, businessRecordNumber) VALUES ( (select id from tax_type where type='vst'), (select id from tax_rate where rate=10), '2013-01-04', 34.00, 'ER2');
INSERT INTO tax (fk_tax_type_id, fk_tax_rate_id, date, value, businessRecordNumber) VALUES ( (select id from tax_type where type='vst'), (select id from tax_rate where rate=10), '2013-01-10', 213.00, 'ER3');
INSERT INTO tax (fk_tax_type_id, fk_tax_rate_id, date, value, businessRecordNumber) VALUES ( (select id from tax_type where type='vst'), (select id from tax_rate where rate=20), '2013-01-31', 88.00, 'ER4');
INSERT INTO tax (fk_tax_type_id, fk_tax_rate_id, date, value, businessRecordNumber) VALUES ( (select id from tax_type where type='vst'), (select id from tax_rate where rate=20), '2013-02-04', 60.00, 'ER5');
INSERT INTO tax (fk_tax_type_id, fk_tax_rate_id, date, value, businessRecordNumber) VALUES ( (select id from tax_type where type='vst'), (select id from tax_rate where rate=20), '2013-02-11', 32.00, 'ER6');
INSERT INTO tax (fk_tax_type_id, fk_tax_rate_id, date, value, businessRecordNumber) VALUES ( (select id from tax_type where type='vst'), (select id from tax_rate where rate=20), '2013-02-15', 93.00, 'ER7');
INSERT INTO tax (fk_tax_type_id, fk_tax_rate_id, date, value, businessRecordNumber) VALUES ( (select id from tax_type where type='vst'), (select id from tax_rate where rate=10), '2013-02-20', 100.00, 'ER8');
INSERT INTO tax (fk_tax_type_id, fk_tax_rate_id, date, value, businessRecordNumber) VALUES ( (select id from tax_type where type='vst'), (select id from tax_rate where rate=20), '2013-03-04', 50.00, 'ER9');
INSERT INTO tax (fk_tax_type_id, fk_tax_rate_id, date, value, businessRecordNumber) VALUES ( (select id from tax_type where type='vst'), (select id from tax_rate where rate=20), '2013-03-08', 53.00, 'ER10');
INSERT INTO tax (fk_tax_type_id, fk_tax_rate_id, date, value, businessRecordNumber) VALUES ( (select id from tax_type where type='vst'), (select id from tax_rate where rate=20), '2013-03-11', 35.00, 'ER11');
INSERT INTO tax (fk_tax_type_id, fk_tax_rate_id, date, value, businessRecordNumber) VALUES ( (select id from tax_type where type='vst'), (select id from tax_rate where rate=10), '2013-04-05', 48.00, 'ER12');
INSERT INTO tax (fk_tax_type_id, fk_tax_rate_id, date, value, businessRecordNumber) VALUES ( (select id from tax_type where type='vst'), (select id from tax_rate where rate=20), '2013-04-08', 34.00, 'ER13');
INSERT INTO tax (fk_tax_type_id, fk_tax_rate_id, date, value, businessRecordNumber) VALUES ( (select id from tax_type where type='vst'), (select id from tax_rate where rate=20), '2013-04-19', 102.00, 'ER14');
INSERT INTO tax (fk_tax_type_id, fk_tax_rate_id, date, value, businessRecordNumber) VALUES ( (select id from tax_type where type='vst'), (select id from tax_rate where rate=20), '2013-04-23', 54.00, 'ER15');
INSERT INTO tax (fk_tax_type_id, fk_tax_rate_id, date, value, businessRecordNumber) VALUES ( (select id from tax_type where type='vst'), (select id from tax_rate where rate=20), '2013-05-02', 34.00, 'ER16');
INSERT INTO tax (fk_tax_type_id, fk_tax_rate_id, date, value, businessRecordNumber) VALUES ( (select id from tax_type where type='vst'), (select id from tax_rate where rate=20), '2013-05-06', 87.00, 'ER17');
INSERT INTO tax (fk_tax_type_id, fk_tax_rate_id, date, value, businessRecordNumber) VALUES ( (select id from tax_type where type='vst'), (select id from tax_rate where rate=20), '2013-05-10', 88.00, 'ER18');
INSERT INTO tax (fk_tax_type_id, fk_tax_rate_id, date, value, businessRecordNumber) VALUES ( (select id from tax_type where type='vst'), (select id from tax_rate where rate=20), '2013-05-20', 56.00, 'ER19');
INSERT INTO tax (fk_tax_type_id, fk_tax_rate_id, date, value, businessRecordNumber) VALUES ( (select id from tax_type where type='ust'), (select id from tax_rate where rate=20), '2013-01-02', 56.00, 'AR1');
INSERT INTO tax (fk_tax_type_id, fk_tax_rate_id, date, value, businessRecordNumber) VALUES ( (select id from tax_type where type='ust'), (select id from tax_rate where rate=10), '2013-01-10', 180.00, 'AR2');
INSERT INTO tax (fk_tax_type_id, fk_tax_rate_id, date, value, businessRecordNumber) VALUES ( (select id from tax_type where type='ust'), (select id from tax_rate where rate=20), '2013-01-31', 45.00, 'AR3');
INSERT INTO tax (fk_tax_type_id, fk_tax_rate_id, date, value, businessRecordNumber) VALUES ( (select id from tax_type where type='ust'), (select id from tax_rate where rate=20), '2013-02-05', 56.00, 'AR4');
INSERT INTO tax (fk_tax_type_id, fk_tax_rate_id, date, value, businessRecordNumber) VALUES ( (select id from tax_type where type='ust'), (select id from tax_rate where rate=10), '2013-02-11', 77.00, 'AR5');
INSERT INTO tax (fk_tax_type_id, fk_tax_rate_id, date, value, businessRecordNumber) VALUES ( (select id from tax_type where type='ust'), (select id from tax_rate where rate=20), '2013-02-12', 94.00, 'AR6');
INSERT INTO tax (fk_tax_type_id, fk_tax_rate_id, date, value, businessRecordNumber) VALUES ( (select id from tax_type where type='ust'), (select id from tax_rate where rate=20), '2013-02-20', 102.00, 'AR7');
INSERT INTO tax (fk_tax_type_id, fk_tax_rate_id, date, value, businessRecordNumber) VALUES ( (select id from tax_type where type='ust'), (select id from tax_rate where rate=20), '2013-03-04', 53.00, 'AR8');
INSERT INTO tax (fk_tax_type_id, fk_tax_rate_id, date, value, businessRecordNumber) VALUES ( (select id from tax_type where type='ust'), (select id from tax_rate where rate=20), '2013-03-15', 12.00, 'AR9');
INSERT INTO tax (fk_tax_type_id, fk_tax_rate_id, date, value, businessRecordNumber) VALUES ( (select id from tax_type where type='ust'), (select id from tax_rate where rate=20), '2013-03-19', 98.00, 'AR10');
INSERT INTO tax (fk_tax_type_id, fk_tax_rate_id, date, value, businessRecordNumber) VALUES ( (select id from tax_type where type='ust'), (select id from tax_rate where rate=20), '2013-03-25', 56.00, 'AR11');
INSERT INTO tax (fk_tax_type_id, fk_tax_rate_id, date, value, businessRecordNumber) VALUES ( (select id from tax_type where type='ust'), (select id from tax_rate where rate=20), '2013-04-01', 37.00, 'AR12');
INSERT INTO tax (fk_tax_type_id, fk_tax_rate_id, date, value, businessRecordNumber) VALUES ( (select id from tax_type where type='ust'), (select id from tax_rate where rate=20), '2013-04-18', 24.00, 'AR13');
INSERT INTO tax (fk_tax_type_id, fk_tax_rate_id, date, value, businessRecordNumber) VALUES ( (select id from tax_type where type='ust'), (select id from tax_rate where rate=10), '2013-04-19', 100.00, 'AR14');
INSERT INTO tax (fk_tax_type_id, fk_tax_rate_id, date, value, businessRecordNumber) VALUES ( (select id from tax_type where type='ust'), (select id from tax_rate where rate=20), '2013-05-04', 87.00, 'AR15');
INSERT INTO tax (fk_tax_type_id, fk_tax_rate_id, date, value, businessRecordNumber) VALUES ( (select id from tax_type where type='ust'), (select id from tax_rate where rate=20), '2013-05-08', 34.00, 'AR16');
INSERT INTO tax (fk_tax_type_id, fk_tax_rate_id, date, value, businessRecordNumber) VALUES ( (select id from tax_type where type='ust'), (select id from tax_rate where rate=20), '2013-05-20', 25.00, 'AR17');
INSERT INTO tax (fk_tax_type_id, fk_tax_rate_id, date, value, businessRecordNumber) VALUES ( (select id from tax_type where type='ust'), (select id from tax_rate where rate=10), '2013-05-22', 67.00, 'AR18');
INSERT INTO tax (fk_tax_type_id, fk_tax_rate_id, date, value, businessRecordNumber) VALUES ( (select id from tax_type where type='ust'), (select id from tax_rate where rate=20), '2013-05-23', 38.00, 'AR19');
