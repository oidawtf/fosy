ALTER TABLE plannedvalue DROP FOREIGN KEY FKplannedval839;
ALTER TABLE customer_request DROP FOREIGN KEY FKcustomer_r922497;
ALTER TABLE article DROP FOREIGN KEY FKarticle457910;
ALTER TABLE person_role DROP FOREIGN KEY FKperson_rol382207;
ALTER TABLE offer DROP FOREIGN KEY FKoffer923303;
ALTER TABLE person_role DROP FOREIGN KEY FKperson_rol801128;
ALTER TABLE person DROP FOREIGN KEY FKperson804629;
ALTER TABLE campaign_person DROP FOREIGN KEY FKcampaign_p674063;
ALTER TABLE campaign_person DROP FOREIGN KEY FKcampaign_p19488;
ALTER TABLE customer_request DROP FOREIGN KEY FKcustomer_r322622;
ALTER TABLE customer_request DROP FOREIGN KEY FKcustomer_r569446;
ALTER TABLE customer_request DROP FOREIGN KEY FKcustomer_r107897;
ALTER TABLE customer_request DROP FOREIGN KEY FKcustomer_r247992;
ALTER TABLE article DROP FOREIGN KEY FKarticle656773;
ALTER TABLE campaign_article DROP FOREIGN KEY FKcampaign_a874402;
ALTER TABLE campaign_article DROP FOREIGN KEY FKcampaign_a697883;
ALTER TABLE offer DROP FOREIGN KEY FKoffer38377;
ALTER TABLE offer DROP FOREIGN KEY FKoffer469590;
ALTER TABLE offer_article DROP FOREIGN KEY FKoffer_arti895052;
ALTER TABLE offer_article DROP FOREIGN KEY FKoffer_arti327112;
ALTER TABLE tax DROP FOREIGN KEY FKtax270969;
ALTER TABLE indicator DROP FOREIGN KEY FKindicator424408;
ALTER TABLE plannedvalue DROP FOREIGN KEY FKplannedval437012;
ALTER TABLE plannedvalue DROP FOREIGN KEY FKplannedval9649;
ALTER TABLE tax DROP FOREIGN KEY FKtax226913;
DROP TABLE IF EXISTS plannedvalue_type;
DROP TABLE IF EXISTS article_manufacturer;
DROP TABLE IF EXISTS tax_report;
DROP TABLE IF EXISTS role;
DROP TABLE IF EXISTS person_role;
DROP TABLE IF EXISTS period;
DROP TABLE IF EXISTS plannedvalue;
DROP TABLE IF EXISTS indicator;
DROP TABLE IF EXISTS indicator_type;
DROP TABLE IF EXISTS tax_type;
DROP TABLE IF EXISTS tax;
DROP TABLE IF EXISTS offer_article;
DROP TABLE IF EXISTS delivery;
DROP TABLE IF EXISTS `order`;
DROP TABLE IF EXISTS offer;
DROP TABLE IF EXISTS campaign_article;
DROP TABLE IF EXISTS article_category;
DROP TABLE IF EXISTS status;
DROP TABLE IF EXISTS article;
DROP TABLE IF EXISTS customer_request_type;
DROP TABLE IF EXISTS customer_request;
DROP TABLE IF EXISTS campaign_person;
DROP TABLE IF EXISTS campaign;
DROP TABLE IF EXISTS department;
DROP TABLE IF EXISTS person;
DROP TABLE IF EXISTS tax_rate;
