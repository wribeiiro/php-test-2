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