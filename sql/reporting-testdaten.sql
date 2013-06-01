-- Reporting testdaten
--=====================

-- tax
INSERT INTO tax (fk_tax_type_id, date, value, businessRecordNumber) VALUES ( (select id from tax_type where type='vst'), '02.01.2013', 20, 'ER1');
INSERT INTO tax (fk_tax_type_id, date, value, businessRecordNumber) VALUES ( (select id from tax_type where type='vst'), '04.01.2013', 34, 'ER2');
INSERT INTO tax (fk_tax_type_id, date, value, businessRecordNumber) VALUES ( (select id from tax_type where type='vst'), '10.01.2013', 213, 'ER3');
INSERT INTO tax (fk_tax_type_id, date, value, businessRecordNumber) VALUES ( (select id from tax_type where type='vst'), '31.01.2013', 88, 'ER4');
INSERT INTO tax (fk_tax_type_id, date, value, businessRecordNumber) VALUES ( (select id from tax_type where type='vst'), '04.02.2013', 60, 'ER5');
INSERT INTO tax (fk_tax_type_id, date, value, businessRecordNumber) VALUES ( (select id from tax_type where type='vst'), '11.02.2013', 32, 'ER6');
INSERT INTO tax (fk_tax_type_id, date, value, businessRecordNumber) VALUES ( (select id from tax_type where type='vst'), '15.02.2013', 93, 'ER7');
INSERT INTO tax (fk_tax_type_id, date, value, businessRecordNumber) VALUES ( (select id from tax_type where type='vst'), '20.02.2013', 100, 'ER8');
INSERT INTO tax (fk_tax_type_id, date, value, businessRecordNumber) VALUES ( (select id from tax_type where type='vst'), '04.03.2013', 50, 'ER9');
INSERT INTO tax (fk_tax_type_id, date, value, businessRecordNumber) VALUES ( (select id from tax_type where type='vst'), '08.03.2013', 53, 'ER10');
INSERT INTO tax (fk_tax_type_id, date, value, businessRecordNumber) VALUES ( (select id from tax_type where type='vst'), '11.03.2013', 35, 'ER11');
INSERT INTO tax (fk_tax_type_id, date, value, businessRecordNumber) VALUES ( (select id from tax_type where type='vst'), '05.04.2013', 48, 'ER12');
INSERT INTO tax (fk_tax_type_id, date, value, businessRecordNumber) VALUES ( (select id from tax_type where type='vst'), '08.04.2013', 34, 'ER13');
INSERT INTO tax (fk_tax_type_id, date, value, businessRecordNumber) VALUES ( (select id from tax_type where type='vst'), '19.04.2013', 102, 'ER14');
INSERT INTO tax (fk_tax_type_id, date, value, businessRecordNumber) VALUES ( (select id from tax_type where type='vst'), '23.04.2013', 54, 'ER15');
INSERT INTO tax (fk_tax_type_id, date, value, businessRecordNumber) VALUES ( (select id from tax_type where type='vst'), '02.05.2013', 34, 'ER16');
INSERT INTO tax (fk_tax_type_id, date, value, businessRecordNumber) VALUES ( (select id from tax_type where type='vst'), '06.05.2013', 87, 'ER17');
INSERT INTO tax (fk_tax_type_id, date, value, businessRecordNumber) VALUES ( (select id from tax_type where type='vst'), '10.05.2013', 88, 'ER18');
INSERT INTO tax (fk_tax_type_id, date, value, businessRecordNumber) VALUES ( (select id from tax_type where type='vst'), '20.05.2013', 56, 'ER19');
INSERT INTO tax (fk_tax_type_id, date, value, businessRecordNumber) VALUES ( (select id from tax_type where type='ust'), '02.01.2013', 56, 'AR1');
INSERT INTO tax (fk_tax_type_id, date, value, businessRecordNumber) VALUES ( (select id from tax_type where type='ust'), '10.01.2013', 180, 'AR2');
INSERT INTO tax (fk_tax_type_id, date, value, businessRecordNumber) VALUES ( (select id from tax_type where type='ust'), '31.01.2013', 45, 'AR3');
INSERT INTO tax (fk_tax_type_id, date, value, businessRecordNumber) VALUES ( (select id from tax_type where type='ust'), '05.02.2013', 56, 'AR4');
INSERT INTO tax (fk_tax_type_id, date, value, businessRecordNumber) VALUES ( (select id from tax_type where type='ust'), '11.02.2013', 77, 'AR5');
INSERT INTO tax (fk_tax_type_id, date, value, businessRecordNumber) VALUES ( (select id from tax_type where type='ust'), '12.02.2013', 94, 'AR6');
INSERT INTO tax (fk_tax_type_id, date, value, businessRecordNumber) VALUES ( (select id from tax_type where type='ust'), '20.02.2013', 102, 'AR7');
INSERT INTO tax (fk_tax_type_id, date, value, businessRecordNumber) VALUES ( (select id from tax_type where type='ust'), '04.03.2013', 53, 'AR8');
INSERT INTO tax (fk_tax_type_id, date, value, businessRecordNumber) VALUES ( (select id from tax_type where type='ust'), '15.03.2013', 12, 'AR9');
INSERT INTO tax (fk_tax_type_id, date, value, businessRecordNumber) VALUES ( (select id from tax_type where type='ust'), '19.03.2013', 98, 'AR10');
INSERT INTO tax (fk_tax_type_id, date, value, businessRecordNumber) VALUES ( (select id from tax_type where type='ust'), '25.03.2013', 56, 'AR11');
INSERT INTO tax (fk_tax_type_id, date, value, businessRecordNumber) VALUES ( (select id from tax_type where type='ust'), '01.04.2013', 37, 'AR12');
INSERT INTO tax (fk_tax_type_id, date, value, businessRecordNumber) VALUES ( (select id from tax_type where type='ust'), '18.04.2013', 24, 'AR13');
INSERT INTO tax (fk_tax_type_id, date, value, businessRecordNumber) VALUES ( (select id from tax_type where type='ust'), '19.04.2013', 100, 'AR14');
INSERT INTO tax (fk_tax_type_id, date, value, businessRecordNumber) VALUES ( (select id from tax_type where type='ust'), '04.05.2013', 87, 'AR15');
INSERT INTO tax (fk_tax_type_id, date, value, businessRecordNumber) VALUES ( (select id from tax_type where type='ust'), '08.05.2013', 34, 'AR16');
INSERT INTO tax (fk_tax_type_id, date, value, businessRecordNumber) VALUES ( (select id from tax_type where type='ust'), '20.05.2013', 25, 'AR17');
INSERT INTO tax (fk_tax_type_id, date, value, businessRecordNumber) VALUES ( (select id from tax_type where type='ust'), '22.05.2013', 67, 'AR18');
INSERT INTO tax (fk_tax_type_id, date, value, businessRecordNumber) VALUES ( (select id from tax_type where type='ust'), '23.05.2013', 38, 'AR19');
