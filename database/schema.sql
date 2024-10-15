CREATE TABLE products (
    product_id             VARCHAR(   36) PRIMARY KEY,
    product_name           VARCHAR(  255) NOT NULL,
    product_category       VARCHAR(  255) NOT NULL,
    product_price_currency VARCHAR(    3) NOT NULL,
    product_price_amount   DECIMAL(10, 2) NOT NULL
);