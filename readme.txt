# eCommerce-Website
1.Introduction

CodeIgniter is used to build this website. And Jquery has been used to neccessary places replacing javascript. There are 3 main parts.They are views part, models part and controllers part.The views part is used for showing the website to customers. The models part is used for connecting with database. The controllers part is used for controlling the whole website.

2.Page Description

1)controllers

coolbook.php:
the php script for determining which model file or view file should be loaded, and it loads library scripts to validate forms. It used for controlling the whole website.


2)models

homepage_model.php:
the php script used to connect with database tables that are related to products.

login_model.php:
the php script used to connect with database tables that are related to customers.

3)views

cartfunctions.php:the php script for some functions used by other php files.

change_pw.php:the php script for users to change password.

change_pw_success.php:the php script for noticing customer that changes have been made successfully.

check.php:the php script for customers to check out.

customerlogin.php:the php script for login, varify the username and password and set up a session.

customerlogout.php:the php script for logout.

edit_profile.php:the php script for modifying account profile.

edit_profile_success.php:the php script for noticing customer that changes have been made successfully.

fader.css:the css file for slideshow in homepage.php.

fader.js, fader.packed.js: JQuery for slideshow in homepage.php.

homepage.php:the php script for scanning product and shopping.

homepage.css:the css file for homepage.php.

orderSuccess.php:the php script for noticing customer placed order successfully.

shopcart.php:the php script for show and edit shopping cart.

shopcart.css:the css file for shopcart.php.

showContent.php:the php script for displaying different category pages.

signup.php:the php script for customer registering.

signup.css:the css file for signup.php.

signup_success.php:the php script for noticing customer sign up successfully.

view_order.php:the php script for viewing orders.

view_order_detail.php:the php script for viewing order details.

viewinfo.php:the php script for viewing account profile information.


3.Database Description

1)customers table: 

UId: the id for the customers, it is unique and int(20).

UName: the name for the customers to login, it is unique and varchar(20).

UPass: the password for a customer to login and varchar(20).

FName: customer's firstname and varchar(20).

LName: customer's lastname and varchar(20).

UEmail: customer's email and varchar(100). 

UAddress: customer's address and varchar(200).

UPhone: customer's phone number and varchar(11).

UZip: customer's zip code and varchar(6).

2)orders table

order_id: id for an order, it is unique, auto_increment and int(11).

cus_id: id for a customer, it is the same with UId in customer table.

bill_adr: the billing address, varchar(200).

ship_adr: the shipping address, varchar(200)

date: the order date.

price: the total price for an order.

card: the paying card number,varchar(50).

3)order_item table:

order_id: id for an order, it is unique, auto_increment and int(11).

pro_id: id of the product, int(10).

pro_qty: quantity of product, int(11).

pro_price: price of the product, float.

4)shopcart table:

PId: product id, it's the same with PId in product table, int(10).

Qty: quantity of the product, int(11).

PPrice: price of the product, it's the same with PPrice in product table, float.

UId: customer id, it's the same with UId in customer table, int(20).

SId: session id.


4.Featrue Description:

1)If check out, users have to login using an existed username and matched password.

2)Users will automatically logout after 30 minutes.

3)If login, the shopping cart will automatically add the products not brought last time.

4)When a customer puts an item in their shopping cart, in the cart page, it will display item(s) that other customers also bought in a single order.

5)In the homepage, AJAX has been used to change category content. When clicking different category name on the left nabigator menu, content in the middle will show the product with the same category. In the order detail page, AJAX was used to show different orders' detail.

6)Jquery has been used to neccessary places replacing javascrpit in old version.

7)XSS and SQL Injection are solved.

5.Extra Credit

1)create_xml.php:the php script that extracts all the products from product table and generates a string variable that is an XML document. 

2)product.xml:the XML file been created by create_xml.php .

3)booklist.xsl:the XSLT script for outputing the product data in a nice table format as HTML.
