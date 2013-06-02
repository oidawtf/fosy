-- Reporting testdaten
--=====================

-- tax
INSERT INTO tax (fk_tax_type_id, date, value, businessRecordNumber) VALUES ( (select id from tax_type where type='vst'), '2013-01-02', 20, 'ER1');
INSERT INTO tax (fk_tax_type_id, date, value, businessRecordNumber) VALUES ( (select id from tax_type where type='vst'), '2013-01-04', 34, 'ER2');
INSERT INTO tax (fk_tax_type_id, date, value, businessRecordNumber) VALUES ( (select id from tax_type where type='vst'), '2013-01-10', 213, 'ER3');
INSERT INTO tax (fk_tax_type_id, date, value, businessRecordNumber) VALUES ( (select id from tax_type where type='vst'), '2013-01-31', 88, 'ER4');
INSERT INTO tax (fk_tax_type_id, date, value, businessRecordNumber) VALUES ( (select id from tax_type where type='vst'), '2013-02-04', 60, 'ER5');
INSERT INTO tax (fk_tax_type_id, date, value, businessRecordNumber) VALUES ( (select id from tax_type where type='vst'), '2013-02-11', 32, 'ER6');
INSERT INTO tax (fk_tax_type_id, date, value, businessRecordNumber) VALUES ( (select id from tax_type where type='vst'), '2013-02-15', 93, 'ER7');
INSERT INTO tax (fk_tax_type_id, date, value, businessRecordNumber) VALUES ( (select id from tax_type where type='vst'), '2013-02-20', 100, 'ER8');
INSERT INTO tax (fk_tax_type_id, date, value, businessRecordNumber) VALUES ( (select id from tax_type where type='vst'), '2013-03-04', 50, 'ER9');
INSERT INTO tax (fk_tax_type_id, date, value, businessRecordNumber) VALUES ( (select id from tax_type where type='vst'), '2013-03-08', 53, 'ER10');
INSERT INTO tax (fk_tax_type_id, date, value, businessRecordNumber) VALUES ( (select id from tax_type where type='vst'), '2013-03-11', 35, 'ER11');
INSERT INTO tax (fk_tax_type_id, date, value, businessRecordNumber) VALUES ( (select id from tax_type where type='vst'), '2013-04-05', 48, 'ER12');
INSERT INTO tax (fk_tax_type_id, date, value, businessRecordNumber) VALUES ( (select id from tax_type where type='vst'), '2013-04-08', 34, 'ER13');
INSERT INTO tax (fk_tax_type_id, date, value, businessRecordNumber) VALUES ( (select id from tax_type where type='vst'), '2013-04-19', 102, 'ER14');
INSERT INTO tax (fk_tax_type_id, date, value, businessRecordNumber) VALUES ( (select id from tax_type where type='vst'), '2013-04-23', 54, 'ER15');
INSERT INTO tax (fk_tax_type_id, date, value, businessRecordNumber) VALUES ( (select id from tax_type where type='vst'), '2013-05-02', 34, 'ER16');
INSERT INTO tax (fk_tax_type_id, date, value, businessRecordNumber) VALUES ( (select id from tax_type where type='vst'), '2013-05-06', 87, 'ER17');
INSERT INTO tax (fk_tax_type_id, date, value, businessRecordNumber) VALUES ( (select id from tax_type where type='vst'), '2013-05-10', 88, 'ER18');
INSERT INTO tax (fk_tax_type_id, date, value, businessRecordNumber) VALUES ( (select id from tax_type where type='vst'), '2013-05-20', 56, 'ER19');
INSERT INTO tax (fk_tax_type_id, date, value, businessRecordNumber) VALUES ( (select id from tax_type where type='ust'), '2013-01-02', 56, 'AR1');
INSERT INTO tax (fk_tax_type_id, date, value, businessRecordNumber) VALUES ( (select id from tax_type where type='ust'), '2013-01-10', 180, 'AR2');
INSERT INTO tax (fk_tax_type_id, date, value, businessRecordNumber) VALUES ( (select id from tax_type where type='ust'), '2013-01-31', 45, 'AR3');
INSERT INTO tax (fk_tax_type_id, date, value, businessRecordNumber) VALUES ( (select id from tax_type where type='ust'), '2013-02-05', 56, 'AR4');
INSERT INTO tax (fk_tax_type_id, date, value, businessRecordNumber) VALUES ( (select id from tax_type where type='ust'), '2013-02-11', 77, 'AR5');
INSERT INTO tax (fk_tax_type_id, date, value, businessRecordNumber) VALUES ( (select id from tax_type where type='ust'), '2013-02-12', 94, 'AR6');
INSERT INTO tax (fk_tax_type_id, date, value, businessRecordNumber) VALUES ( (select id from tax_type where type='ust'), '2013-02-20', 102, 'AR7');
INSERT INTO tax (fk_tax_type_id, date, value, businessRecordNumber) VALUES ( (select id from tax_type where type='ust'), '2013-03-04', 53, 'AR8');
INSERT INTO tax (fk_tax_type_id, date, value, businessRecordNumber) VALUES ( (select id from tax_type where type='ust'), '2013-03-15', 12, 'AR9');
INSERT INTO tax (fk_tax_type_id, date, value, businessRecordNumber) VALUES ( (select id from tax_type where type='ust'), '2013-03-19', 98, 'AR10');
INSERT INTO tax (fk_tax_type_id, date, value, businessRecordNumber) VALUES ( (select id from tax_type where type='ust'), '2013-03-25', 56, 'AR11');
INSERT INTO tax (fk_tax_type_id, date, value, businessRecordNumber) VALUES ( (select id from tax_type where type='ust'), '2013-04-01', 37, 'AR12');
INSERT INTO tax (fk_tax_type_id, date, value, businessRecordNumber) VALUES ( (select id from tax_type where type='ust'), '2013-04-18', 24, 'AR13');
INSERT INTO tax (fk_tax_type_id, date, value, businessRecordNumber) VALUES ( (select id from tax_type where type='ust'), '2013-04-19', 100, 'AR14');
INSERT INTO tax (fk_tax_type_id, date, value, businessRecordNumber) VALUES ( (select id from tax_type where type='ust'), '2013-05-04', 87, 'AR15');
INSERT INTO tax (fk_tax_type_id, date, value, businessRecordNumber) VALUES ( (select id from tax_type where type='ust'), '2013-05-08', 34, 'AR16');
INSERT INTO tax (fk_tax_type_id, date, value, businessRecordNumber) VALUES ( (select id from tax_type where type='ust'), '2013-05-20', 25, 'AR17');
INSERT INTO tax (fk_tax_type_id, date, value, businessRecordNumber) VALUES ( (select id from tax_type where type='ust'), '2013-05-22', 67, 'AR18');
INSERT INTO tax (fk_tax_type_id, date, value, businessRecordNumber) VALUES ( (select id from tax_type where type='ust'), '2013-05-23', 38, 'AR19');
