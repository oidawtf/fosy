-- delivery 
INSERT INTO delivery (price, street, housenumber, city, zip, country, assambly) VALUES ('22.50', 'Straße', 1, 'Wien', 1060, 'Österreich', 0);
INSERT INTO delivery (price, street, housenumber, city, zip, country, assambly) VALUES ('1234.99', 'Hauptplatz', 5, 'Wien', 1190, 'Österreich', 1);
INSERT INTO delivery (price, street, housenumber, stiege, doornumber, city, zip, country, assambly) VALUES ('13.99', 'Engerthstraße', 138, 5, 21, 'Wien', 1200, 'Österreich', 0);

-- offer
INSERT INTO offer (fk_customer_id, fk_delivery_id, number, date, valid_from, valid_until) VALUES (23, 1, 'offer-1-2013', '2013-06-02', '2013-06-02', '2013-06-30');
INSERT INTO offer (fk_customer_id, fk_delivery_id, number, date, valid_from, valid_until) VALUES (24, 2, 'offer-2-2013', '2013-04-15', '2013-04-15', '2013-05-15');
INSERT INTO offer (fk_customer_id, fk_delivery_id, number, date, valid_from, valid_until) VALUES (29, 3, 'offer-3-2013', '2013-05-03', '2013-05-03', '2013-06-03');

-- orders
INSERT INTO orders(number, date) VALUES ('order-1-2013', '2013-04-15');
UPDATE offer SET fk_order_id=(select id from orders where number='order-1-2013');
INSERT INTO orders(number, date) VALUES ('order-2-2013', '2013-06-15');
UPDATE offer SET fk_order_id=(select id from orders where number='order-2-2013');


