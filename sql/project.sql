drop database if exists Project;
create database Project;
use Project;

create table categories (
	cat_id INT AUTO_INCREMENT PRIMARY KEY,	
	cat_name VARCHAR(50)	
) Engine=InnoDB;

insert into categories (cat_name) values ("Food");
insert into categories (cat_name) values ("Drink");
insert into categories (cat_name) values ("Household");

create table products (
	p_id INT AUTO_INCREMENT PRIMARY KEY,	
	p_name VARCHAR(50) NOT NULL,
    p_price VARCHAR(10) NOT NULL,
    p_description VARCHAR(500),
    cat_id INT NOT NULL,
    FOREIGN KEY (cat_id) REFERENCES categories(cat_id)	
) Engine=InnoDB;


insert into products (p_name, p_price, p_description, cat_id) values ("fuji apple", "1.32", "Fuji apples are typically red with greenish-yellow stripes and have a sweet flavour. Enjoy Fuji apples fresh as a snack, in your homemade applesauce, or baked with some cinnamon and brown sugar.", 1);
insert into products (p_name, p_price, p_description, cat_id) values ("bananas", "1.75", "Bananas are typically 6-10 inches long and have a green peel when unripe. They taste best when the peel turns yellow and is speckled with dark spots. ", 1);
insert into products (p_name, p_price, p_description, cat_id) values ("milktea", "5.99", "Enjoy both the rich taste of milk along with the flavourful aroma of authentic black tea leaves combined into one satisfying drink. Made in Japan.", 2);
insert into products (p_name, p_price, p_description, cat_id) values ("green tea", "4.49", "Unsweetened and zero calories. With more than 100% RDA of Vitamin C.", 2);
insert into products (p_name, p_price, p_description, cat_id) values ("shampoo", "9.49", "MONDAY Haircare's Gentle Shampoo is designed for hair and scalps that need a little extra TLC. Designed for easily irritated and/or dry scalps, this shampoo has a nourishing and supportive cleansing system to gently remove dirt and build-up.", 3);
insert into products (p_name, p_price, p_description, cat_id) values ("chocolate bar", "3.99", "Experience a textural sensation with the Lindt EXCELLENCE Caramel & Sea Salt Dark Chocolate Bar.", 1);
insert into products (p_name, p_price, p_description, cat_id) values ("facial tissues", "9.99", "Bathroom Tissue. Facial Tissue. Paper Towels. There is a Royale for every room.", 3);
insert into products (p_name, p_price, p_description, cat_id) values ("milk", "5.59", "A pasteurized, homogenized milk containing 3.25% M.F. fortified with vitamin D.This product is an excellent source of calcium.", 2);
insert into products (p_name, p_price, p_description, cat_id) values ("bread", "2.99", "Make Each Day A Little Softer By Biting Into Our Pillowy Soft Sliced White Bread. Each Loaf Is Baked In Canada And Contains 12 Essential Nutrients Per Serving. No Artificial Flavours, Colours Or Preservatives.", 1);
insert into products (p_name, p_price, p_description, cat_id) values ("coffee", "6.29", "Starbucks Iced Espresso is inspired by a familiar favorite served in our cafés every day. Inspired by a signature favorite served in our cafes every day.", 2);
insert into products (p_name, p_price, p_description, cat_id) values ("aluminum foil", "3.89", "Aluminum foil with a cutting edge, for wrapping food items to grill on the barbecue, cook in the oven, or store in the freezer.", 3);
insert into products (p_name, p_price, p_description, cat_id) values ("garbage bags", "7.99", "Ready and prepared to handle all your garbage, this bag suppresses the worst trash odours. And with the Easy-Tie closure you just tie, grab, toss, and you’re done. Ideal for kitchen, bathroom, bedroom or office. GLAD. Guaranteed Strong.", 3);
insert into products (p_name, p_price, p_description, cat_id) values ("shrimp ring", "6.99", "50 - 60 shrimp per ring.", 1);
insert into products (p_name, p_price, p_description, cat_id) values ("bacon", "7.49", "Schneiders Hickory Smoked Classic Cut Bacon proves that when it comes to great bacon, there are no shortcuts for time and care. Though bacon seems simple, Schneiders® has put decades of practice into perfecting the craft of this beloved breakfast food.", 1);
insert into products (p_name, p_price, p_description, cat_id) values ("cola", "11.99", "Enjoy the delicious & refreshing taste of Coca-Cola with meals, on the go, or to share. Serve ice cold for maximum refreshment.", 2);
insert into products (p_name, p_price, p_description, cat_id) values ("ice cream", "6.99", "Ben & Jerry's Half Baked Ice Cream pint. Featuring chocolate & vanilla ice creams with fudge brownies & gobs of chocolate chip cookie dough.", 1);

create table user (
	id INT AUTO_INCREMENT PRIMARY KEY,	
	username VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL,
    password VARCHAR(250) NOT NULL,
    admin_flag INT NOT NULL
) Engine=InnoDB;

insert into user (username, email, password, admin_flag) values ("Admin", "admin@gmail.com", "$2y$10$eZERmpyVNWfa3RgqcRUqvOoauoLSgmKyC5Gza1fhN6d..hxtUo00a", 1);
insert into user (username, email, password, admin_flag) values ("Amy", "amy@gmail.com", "$2y$10$wIBiPBs0hmTwYbDp24644O8AqLk1MuZ3e8PlXRyn8FlN465tcno3m", 0);
insert into user (username, email, password, admin_flag) values ("Bob", "bob@gmail.com", "$2y$10$wIBiPBs0hmTwYbDp24644O8AqLk1MuZ3e8PlXRyn8FlN465tcno3m", 0);
insert into user (username, email, password, admin_flag) values ("Cathy", "cathy@gmail.com", "$2y$10$wIBiPBs0hmTwYbDp24644O8AqLk1MuZ3e8PlXRyn8FlN465tcno3m", 0);
insert into user (username, email, password, admin_flag) values ("Danny", "danny@gmail.com", "$2y$10$wIBiPBs0hmTwYbDp24644O8AqLk1MuZ3e8PlXRyn8FlN465tcno3m", 0);
insert into user (username, email, password, admin_flag) values ("Eliot", "eliot@gmail.com", "$2y$10$wIBiPBs0hmTwYbDp24644O8AqLk1MuZ3e8PlXRyn8FlN465tcno3m", 0);
