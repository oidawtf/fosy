CREATE TABLE tax_rate (
  id   int(10) NOT NULL AUTO_INCREMENT, 
  rate smallint(6) NOT NULL, 
  PRIMARY KEY (id), 
  UNIQUE INDEX (id));
CREATE TABLE plannedvalue_type (
  id   int(10) NOT NULL AUTO_INCREMENT, 
  type varchar(10) NOT NULL, 
  PRIMARY KEY (id), 
  UNIQUE INDEX (id));
CREATE TABLE article_manufacturer (
  id   int(10) NOT NULL AUTO_INCREMENT, 
  name varchar(255) NOT NULL, 
  PRIMARY KEY (id), 
  UNIQUE INDEX (id));
CREATE TABLE tax_report (
  id       int(10) NOT NULL AUTO_INCREMENT, 
  month    smallint(6) NOT NULL, 
  year     smallint(6) NOT NULL, 
  document varchar(255) NOT NULL, 
  PRIMARY KEY (id), 
  CONSTRAINT monthYear 
    UNIQUE (month, year), 
  UNIQUE INDEX (id));
CREATE TABLE role (
  id       int(10) NOT NULL AUTO_INCREMENT, 
  rolename varchar(128) NOT NULL, 
  content  varchar(5000), 
  PRIMARY KEY (id), 
  UNIQUE INDEX (id));
CREATE TABLE person_role (
  fk_person_id int(10) NOT NULL, 
  fk_role_id   int(10) NOT NULL, 
  PRIMARY KEY (fk_person_id, 
  fk_role_id));
CREATE TABLE period (
  id    int(10) NOT NULL AUTO_INCREMENT, 
  value varchar(255) NOT NULL, 
  PRIMARY KEY (id), 
  UNIQUE INDEX (id));
CREATE TABLE plannedvalue (
  id                      int(10) NOT NULL AUTO_INCREMENT, 
  fk_period_id            int(10) NOT NULL, 
  fk_indicator_id         int(10) NOT NULL, 
  fk_plannedvalue_type_id int(10) NOT NULL, 
  value                   varchar(10) NOT NULL, 
  PRIMARY KEY (id), 
  UNIQUE INDEX (id));
CREATE TABLE indicator (
  id                   int(10) NOT NULL AUTO_INCREMENT, 
  fk_indicator_type_id int(10) NOT NULL, 
  name                 varchar(255) NOT NULL, 
  PRIMARY KEY (id), 
  UNIQUE INDEX (id));
CREATE TABLE indicator_type (
  id   int(10) NOT NULL AUTO_INCREMENT, 
  type varchar(16) NOT NULL, 
  PRIMARY KEY (id), 
  UNIQUE INDEX (id));
CREATE TABLE tax_type (
  id   int(10) NOT NULL AUTO_INCREMENT, 
  type varchar(10) NOT NULL, 
  PRIMARY KEY (id), 
  UNIQUE INDEX (id));
CREATE TABLE invoice (
  id                   int(10) NOT NULL AUTO_INCREMENT, 
  fk_tax_type_id       int(10) NOT NULL, 
  fk_tax_rate_id       int(10) NOT NULL, 
  `date`               date NOT NULL, 
  gross_price          decimal(19, 2) NOT NULL, 
  net                  decimal(19, 2) NOT NULL, 
  tax                  decimal(19, 2) NOT NULL, 
  businessRecordNumber varchar(255) NOT NULL, 
  PRIMARY KEY (id), 
  UNIQUE INDEX (id));
CREATE TABLE offer_article (
  fk_article_id int(10) NOT NULL, 
  fk_offer_id   int(10) NOT NULL, 
  count         int(10) NOT NULL, 
  PRIMARY KEY (fk_article_id, 
  fk_offer_id));
CREATE TABLE delivery (
  id          int(10) NOT NULL AUTO_INCREMENT, 
  price       decimal(19, 2) NOT NULL, 
  street      varchar(255) NOT NULL, 
  housenumber smallint(6) NOT NULL, 
  stiege      smallint(6), 
  doornumber  smallint(6), 
  city        varchar(128) NOT NULL, 
  zip         smallint(6) NOT NULL, 
  country     varchar(255) NOT NULL, 
  assambly    tinyint(1) NOT NULL, 
  PRIMARY KEY (id), 
  UNIQUE INDEX (id));
CREATE TABLE orders (
  id     int(10) NOT NULL AUTO_INCREMENT, 
  number varchar(128) NOT NULL, 
  `date` date NOT NULL, 
  PRIMARY KEY (id), 
  UNIQUE INDEX (id));
CREATE TABLE offer (
  id             int(10) NOT NULL AUTO_INCREMENT, 
  fk_customer_id int(10) NOT NULL, 
  fk_delivery_id int(10), 
  fk_order_id    int(10), 
  number         varchar(128) NOT NULL, 
  `date`         date NOT NULL, 
  valid_from     date NOT NULL, 
  valid_until    date NOT NULL, 
  code           varchar(64), 
  PRIMARY KEY (id), 
  UNIQUE INDEX (id));
CREATE TABLE campaign_article (
  fk_campaign_id int(10) NOT NULL, 
  fk_article_id  int(10) NOT NULL, 
  real_price     decimal(19, 2), 
  PRIMARY KEY (fk_campaign_id, 
  fk_article_id));
CREATE TABLE article_category (
  id   int(10) NOT NULL AUTO_INCREMENT, 
  name varchar(255) NOT NULL, 
  PRIMARY KEY (id), 
  UNIQUE INDEX (id));
CREATE TABLE status (
  id    int(10) NOT NULL AUTO_INCREMENT, 
  value varchar(255) NOT NULL, 
  PRIMARY KEY (id), 
  UNIQUE INDEX (id));
CREATE TABLE article (
  id                         int(10) NOT NULL AUTO_INCREMENT, 
  fk_article_category_id     int(10) NOT NULL, 
  fk_article_manufacturer_id int(10) NOT NULL, 
  model                      varchar(128) NOT NULL, 
  description                varchar(1000) NOT NULL, 
  picture                    varchar(255), 
  stock                      int(5) NOT NULL, 
  purchase_price             decimal(19, 2) NOT NULL, 
  selling_price              decimal(19, 2), 
  tax_rate                   smallint(6) NOT NULL, 
  PRIMARY KEY (id), 
  UNIQUE INDEX (id));
CREATE TABLE customer_request_type (
  id   int(10) NOT NULL AUTO_INCREMENT, 
  type varchar(32) NOT NULL, 
  PRIMARY KEY (id), 
  UNIQUE INDEX (id));
CREATE TABLE customer_request (
  id                          int(10) NOT NULL AUTO_INCREMENT, 
  fk_customer_request_type_id int(10) NOT NULL, 
  fk_person_id                int(10) NOT NULL, 
  fk_responsible_user_id      int(10) NOT NULL, 
  fk_article_id               int(10) NOT NULL, 
  fk_status_id                int(10) NOT NULL, 
  `date`                      date NOT NULL, 
  text                        varchar(2048) NOT NULL, 
  PRIMARY KEY (id), 
  UNIQUE INDEX (id));
CREATE TABLE campaign_person (
  fk_person_id   int(10) NOT NULL, 
  fk_campaign_id int(10) NOT NULL, 
  PRIMARY KEY (fk_person_id, 
  fk_campaign_id));
CREATE TABLE campaign (
  id          int(10) NOT NULL AUTO_INCREMENT, 
  name        varchar(255), 
  description varchar(1000), 
  goal        varchar(255), 
  date_from   date, 
  date_to     date, 
  budget      decimal(19, 2), 
  medium      varchar(64), 
  code        varchar(64), 
  CONSTRAINT id 
    PRIMARY KEY (id), 
  UNIQUE INDEX (id));
CREATE TABLE department (
  id   int(10) NOT NULL AUTO_INCREMENT, 
  name varchar(255) NOT NULL, 
  PRIMARY KEY (id), 
  UNIQUE INDEX (id));
CREATE TABLE person (
  id               int(10) NOT NULL AUTO_INCREMENT, 
  fk_department_id int(10), 
  firstname        varchar(32) NOT NULL, 
  lastname         varchar(32) NOT NULL, 
  username         varchar(32) UNIQUE, 
  password         varchar(255), 
  title            varchar(10), 
  companyname      varchar(255), 
  taxnumber        varchar(129), 
  street           varchar(255) NOT NULL, 
  housenumber      int(10) NOT NULL, 
  stiege           smallint(6), 
  doornumber       int(10), 
  city             varchar(128) NOT NULL, 
  zip              smallint(6) NOT NULL, 
  country          varchar(255) NOT NULL, 
  phone            varchar(128), 
  phone_extension  varchar(10), 
  fax              varchar(128), 
  email            varchar(255), 
  birthdate        date, 
  personnel_number int(10), 
  hiredate         date, 
  position         varchar(255), 
  is_distributor   tinyint(1), 
  is_customer      tinyint(1), 
  is_employee      tinyint(1), 
  PRIMARY KEY (id), 
  UNIQUE INDEX (id));
ALTER TABLE invoice ADD INDEX FKinvoice859400 (fk_tax_rate_id), ADD CONSTRAINT FKinvoice859400 FOREIGN KEY (fk_tax_rate_id) REFERENCES tax_rate (id);
ALTER TABLE person ADD INDEX FKperson804629 (fk_department_id), ADD CONSTRAINT FKperson804629 FOREIGN KEY (fk_department_id) REFERENCES department (id);
ALTER TABLE plannedvalue ADD INDEX FKplannedval839 (fk_plannedvalue_type_id), ADD CONSTRAINT FKplannedval839 FOREIGN KEY (fk_plannedvalue_type_id) REFERENCES plannedvalue_type (id);
ALTER TABLE customer_request ADD INDEX FKcustomer_r922497 (fk_responsible_user_id), ADD CONSTRAINT FKcustomer_r922497 FOREIGN KEY (fk_responsible_user_id) REFERENCES person (id);
ALTER TABLE article ADD INDEX FKarticle457910 (fk_article_manufacturer_id), ADD CONSTRAINT FKarticle457910 FOREIGN KEY (fk_article_manufacturer_id) REFERENCES article_manufacturer (id);
ALTER TABLE person_role ADD INDEX FKperson_rol382207 (fk_role_id), ADD CONSTRAINT FKperson_rol382207 FOREIGN KEY (fk_role_id) REFERENCES role (id);
ALTER TABLE offer ADD INDEX FKoffer923303 (fk_customer_id), ADD CONSTRAINT FKoffer923303 FOREIGN KEY (fk_customer_id) REFERENCES person (id);
ALTER TABLE person_role ADD INDEX FKperson_rol801128 (fk_person_id), ADD CONSTRAINT FKperson_rol801128 FOREIGN KEY (fk_person_id) REFERENCES person (id);
ALTER TABLE campaign_person ADD INDEX FKcampaign_p674063 (fk_person_id), ADD CONSTRAINT FKcampaign_p674063 FOREIGN KEY (fk_person_id) REFERENCES person (id);
ALTER TABLE campaign_person ADD INDEX FKcampaign_p19488 (fk_campaign_id), ADD CONSTRAINT FKcampaign_p19488 FOREIGN KEY (fk_campaign_id) REFERENCES campaign (id);
ALTER TABLE customer_request ADD INDEX FKcustomer_r322622 (fk_customer_request_type_id), ADD CONSTRAINT FKcustomer_r322622 FOREIGN KEY (fk_customer_request_type_id) REFERENCES customer_request_type (id);
ALTER TABLE customer_request ADD INDEX FKcustomer_r569446 (fk_person_id), ADD CONSTRAINT FKcustomer_r569446 FOREIGN KEY (fk_person_id) REFERENCES person (id);
ALTER TABLE customer_request ADD INDEX FKcustomer_r107897 (fk_article_id), ADD CONSTRAINT FKcustomer_r107897 FOREIGN KEY (fk_article_id) REFERENCES article (id);
ALTER TABLE customer_request ADD INDEX FKcustomer_r247992 (fk_status_id), ADD CONSTRAINT FKcustomer_r247992 FOREIGN KEY (fk_status_id) REFERENCES status (id);
ALTER TABLE article ADD INDEX FKarticle656773 (fk_article_category_id), ADD CONSTRAINT FKarticle656773 FOREIGN KEY (fk_article_category_id) REFERENCES article_category (id);
ALTER TABLE campaign_article ADD INDEX FKcampaign_a874402 (fk_campaign_id), ADD CONSTRAINT FKcampaign_a874402 FOREIGN KEY (fk_campaign_id) REFERENCES campaign (id);
ALTER TABLE campaign_article ADD INDEX FKcampaign_a697883 (fk_article_id), ADD CONSTRAINT FKcampaign_a697883 FOREIGN KEY (fk_article_id) REFERENCES article (id);
ALTER TABLE offer ADD INDEX FKoffer816172 (fk_order_id), ADD CONSTRAINT FKoffer816172 FOREIGN KEY (fk_order_id) REFERENCES orders (id);
ALTER TABLE offer ADD INDEX FKoffer469590 (fk_delivery_id), ADD CONSTRAINT FKoffer469590 FOREIGN KEY (fk_delivery_id) REFERENCES delivery (id);
ALTER TABLE offer_article ADD INDEX FKoffer_arti895052 (fk_article_id), ADD CONSTRAINT FKoffer_arti895052 FOREIGN KEY (fk_article_id) REFERENCES article (id);
ALTER TABLE offer_article ADD INDEX FKoffer_arti327112 (fk_offer_id), ADD CONSTRAINT FKoffer_arti327112 FOREIGN KEY (fk_offer_id) REFERENCES offer (id);
ALTER TABLE invoice ADD INDEX FKinvoice614307 (fk_tax_type_id), ADD CONSTRAINT FKinvoice614307 FOREIGN KEY (fk_tax_type_id) REFERENCES tax_type (id);
ALTER TABLE indicator ADD INDEX FKindicator424408 (fk_indicator_type_id), ADD CONSTRAINT FKindicator424408 FOREIGN KEY (fk_indicator_type_id) REFERENCES indicator_type (id);
ALTER TABLE plannedvalue ADD INDEX FKplannedval437012 (fk_indicator_id), ADD CONSTRAINT FKplannedval437012 FOREIGN KEY (fk_indicator_id) REFERENCES indicator (id);
ALTER TABLE plannedvalue ADD INDEX FKplannedval9649 (fk_period_id), ADD CONSTRAINT FKplannedval9649 FOREIGN KEY (fk_period_id) REFERENCES period (id);
