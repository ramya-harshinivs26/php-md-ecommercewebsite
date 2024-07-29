CREATE DATABASE moo_dairy_shop;

USE moo_dairy_shop;

CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    image_url VARCHAR(255) NOT NULL
);

INSERT INTO products (name, description, price, image_url) VALUES
('Mother Dairy Toned Milk', 'High Quality toned milk', 23.00, 'https://cdn.grofers.com/cdn-cgi/image/f=auto,fit=scale-down,q=70,metadata=none,w=900/app/assets/products/sliding_images/jpeg/e3f63e12-631f-4193-9160-ea4ddcbd6c5c.jpg?ts=1711189562'),
('Mother Dairy Butter Pouch', 'Unsalted Butter', 20.00, 'https://m.media-amazon.com/images/I/61at+1JKLhL.jpg'),
('Mother Dairy Cheese Slices', 'Processed Cheese Spread', 15.00, 'https://m.media-amazon.com/images/I/61+AzywctoL.jpg'),
('Mother Dairy Ghee', 'Pure Cow Ghee', 15.00, 'https://m.media-amazon.com/images/I/91idhnLyJqL.jpg'),
('Mother Dairy Standardised Milk', 'High Quality Standardised Milk', 15.00, 'https://www.bigbasket.com/media/uploads/p/xxl/40219320_1-mother-dairy-standardised-milk.jpg'),
('Mother Dairy Curd', 'High Quality Standardised Milk', 15.00, 'https://5.imimg.com/data5/SELLER/Default/2021/5/EC/GO/TB/29317581/mother-dairy-dahi-400g.jpg');
