--
-- Table structure for table `products_type`
--

CREATE TABLE "products_type" (  "id" SERIAL NOT NULL ,
  "description" VARCHAR(255) NOT NULL ,
  "tax_percentage" NUMERIC(11,4) NULL DEFAULT 0,
  "created_at" TIMESTAMP NULL DEFAULT NOW(),
  "updated_at" TIMESTAMP NULL ,
  PRIMARY KEY ("id")
); 


--
-- Table structure for table `sales`
--

CREATE TABLE "sales" (  "id" SERIAL NOT NULL ,
  "client_name" VARCHAR(100) NOT NULL ,
  "total_price" NUMERIC(11,4) NULL DEFAULT 0,
  "total_tax" NUMERIC(11,4) NULL DEFAULT 0,
  "created_at" TIMESTAMP NULL DEFAULT now(),
  "updated_at" TIMESTAMP NULL ,
  PRIMARY KEY ("id")
); 


--
-- Table structure for table `products`
--

CREATE TABLE "products" (  "id" SERIAL NOT NULL ,
  "description" VARCHAR(255) NOT NULL ,
  "product_type_id" INTEGER NOT NULL ,
  "price" NUMERIC(11,4) NULL DEFAULT 0,
  "created_at" TIMESTAMP NULL DEFAULT now(),
  "updated_at" TIMESTAMP NULL ,
  PRIMARY KEY ("id"),FOREIGN KEY ("product_type_id") REFERENCES "products_type" ( "id" ) ON UPDATE CASCADE ON DELETE CASCADE
); 
CREATE INDEX "products_product_type_id" ON "products" ("product_type_id");


--
-- Table structure for table `sales_item`
--

CREATE TABLE "sales_item" (  "id" SERIAL NOT NULL ,
  "sale_id" INTEGER NOT NULL ,
  "product_id" INTEGER NOT NULL ,
  "quantity" NUMERIC(11,4) NULL DEFAULT 0,
  "price" NUMERIC(11,4) NULL DEFAULT 0,
  "tax" NUMERIC(11,4) NULL DEFAULT 0,
  "created_at" TIMESTAMP NULL DEFAULT now(),
  "updated_at" TIMESTAMP NULL ,
  PRIMARY KEY ("id"),FOREIGN KEY ("sale_id") REFERENCES "sales" ( "id" ) ON UPDATE CASCADE ON DELETE CASCADE,FOREIGN KEY ("product_id") REFERENCES "products" ( "id" ) ON UPDATE RESTRICT ON DELETE RESTRICT
); 
CREATE INDEX "sales_item_sale_id" ON "sales_item" ("sale_id");
CREATE INDEX "sales_item_product_id" ON "sales_item" ("product_id");


--
-- Dumping data for table `products_type`
--

INSERT INTO "products_type" ("id","description","tax_percentage","created_at","updated_at") VALUES (1,'Type Default',7.5000,'2020-12-14 09:31:37','2020-12-15 14:10:51'),(3,'Assessories',10.0000,'2020-12-14 17:27:46','2020-12-15 14:10:55'),(5,'Books',5.0000,'2020-12-14 20:36:52','2020-12-15 14:10:48'),(6,'Courses',12.0000,'2020-12-14 20:39:06','2020-12-15 14:11:24');
SELECT setval('public."products_type_id_seq"', max("id") ) FROM "products_type"; 


--
-- Dumping data for table `sales`
--

INSERT INTO "sales" ("id","client_name","total_price","total_tax","created_at","updated_at") VALUES (5,'CLIENT TEST',320.8600,20.9300,'2020-12-15 14:31:44',NULL);
SELECT setval('public."sales_id_seq"', max("id") ) FROM "sales"; 


--
-- Dumping data for table `products`
--

INSERT INTO "products" ("id","description","product_type_id","price","created_at","updated_at") VALUES (4,'Keyboard',1,234.0000,'2020-12-14 16:34:09','2020-12-15 14:02:24'),(5,'Headset',1,45.0000,'2020-12-14 16:38:11','2020-12-15 14:02:32'),(21,'PHP Book',5,34.0000,'2020-12-14 20:39:43','2020-12-15 14:02:43'),(22,'Course Book',5,50.0000,'2020-12-14 22:08:27','2020-12-15 14:11:34');
SELECT setval('public."products_id_seq"', max("id") ) FROM "products"; 


--
-- Dumping data for table `sales_item`
--

INSERT INTO "sales_item" ("id","sale_id","product_id","quantity","price","tax","created_at","updated_at") VALUES (4,5,4,1.0000,251.5500,17.5500,'2020-12-15 14:31:44',NULL),(5,5,5,1.0000,48.3800,3.3800,'2020-12-15 14:31:44',NULL);
SELECT setval('public."sales_item_id_seq"', max("id") ) FROM "sales_item"; 

