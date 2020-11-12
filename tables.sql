-- Herman Rai
-- Puneet Pal Kaur

-- CSE 111 - Database
-- Phase 2
-- Project: Lustrous Jewelry Customer Database

--Creating Tables For Lustures Jewelry Database

CREATE TABLE IF NOT EXISTS Customer(
	c_customerID int primary key,
	c_name nvarchar(25) not null,
	c_email nvarchar(25) not null,
	c_address nvarchar(25) not null,
	c_phoneNumber nvarchar(25) not null
);


CREATE TABLE IF NOT EXISTS Products
(
	p_name nvarchar(25) not null,
	p_quantity int not null,
	p_cost float not null,
	p_customerID int,
	p_productID int primary key	
);


CREATE TABLE IF NOT EXISTS Orders(
	o_orderID int primary key,
	o_productID int,
	o_totalcost float not null,
	o_customerID int
);


CREATE TABLE IF NOT EXISTS Payment(
	py_paymentID int,
	py_customerID int,
	py_orderID int,
	py_amount float not null,
	py_status nvarchar(15) not null,
	primary key(py_paymentID) 
);


CREATE TABLE IF NOT EXISTS Shipping(
	s_shippingID int primary key, 
	s_paymentID int,
	s_orderID int,
	s_customerID int,
	s_status nvarchar(10)
	
);


CREATE TABLE IF NOT EXISTS Login(
	l_username nvarchar(15) unique,
	l_password nvarchar(15),
	l_email nvarchar (20),
	primary key(l_email,l_password)
);


--Populating the Data
DELETE FROM Customer;
DELETE FROM Products;
DELETE FROM Orders;
DELETE FROM Payment;
DELETE FROM Shipping;
DELETE FROM Login;

INSERT INTO Login(l_username, l_password, l_email) values('jasleen','123456','kaur@abc.com');
INSERT INTO Login(l_username, l_password, l_email) values('raveen','123456','saini@abc.com');

INSERT INTO Customer(c_customerID, c_name,c_email,c_address,c_phoneNumber) values(1,'Jaspreet','jas@abc.com','street 1','209-123-4567');
INSERT INTO Customer(c_customerID, c_name,c_email,c_address,c_phoneNumber) values(2,'Manpreet','man@abc.com','street 2','209-321-4657');
INSERT INTO Customer(c_customerID, c_name,c_email,c_address,c_phoneNumber) values(3,'Meetu','meetu@abc.com','street 3','209-659-5667');
INSERT INTO Customer(c_customerID, c_name,c_email,c_address,c_phoneNumber) values(4,'Jaskiran','kiran@abc.com','street 4','209-563-6793');
INSERT INTO Customer(c_customerID, c_name,c_email,c_address,c_phoneNumber) values(5,'Kuldeep','kuldeep@abc.com','street 5','209-754-9755');
INSERT INTO Customer(c_customerID, c_name,c_email,c_address,c_phoneNumber) values(6,'Alisha','alish@abc.com','street 6','209-354-6579');
INSERT INTO Customer(c_customerID, c_name,c_email,c_address,c_phoneNumber) values(7,'Preeti','preeti@abc.com','street 7','209-028-0185');
INSERT INTO Customer(c_customerID, c_name,c_email,c_address,c_phoneNumber) values(8,'Tanveer','tanveer@abc.com','street 8','209-838-0001');
INSERT INTO Customer(c_customerID, c_name,c_email,c_address,c_phoneNumber) values(9,'Tamna','tamna@abc.com','street 9','209-760-2027');
INSERT INTO Customer(c_customerID, c_name,c_email,c_address,c_phoneNumber) values(10,'Anjali','anjali@abc.com','street 10','209-470-0298');

INSERT INTO Products(p_name,p_quantity,p_cost,p_customerID,p_productID) values('Earrings',3,50,4,1);
INSERT INTO Products(p_name,p_quantity,p_cost,p_customerID,p_productID) values('TikkaSet',5,50,6,2);
INSERT INTO Products(p_name,p_quantity,p_cost,p_customerID,p_productID) values('MeenakariEarringsGrey',6,60,2,3);
INSERT INTO Products(p_name,p_quantity,p_cost,p_customerID,p_productID) values('ChokerSet',7,90,8,4);
INSERT INTO Products(p_name,p_quantity,p_cost,p_customerID,p_productID) values('DreamchatherEarrings',10,40,6,5);
INSERT INTO Products(p_name,p_quantity,p_cost,p_customerID,p_productID) values('Jhanjran',4,45,7,6);
INSERT INTO Products(p_name,p_quantity,p_cost,p_customerID,p_productID) values('Bangles',8,30,1,7);
INSERT INTO Products(p_name,p_quantity,p_cost,p_customerID,p_productID) values('NosePin',5,10,3,8);
INSERT INTO Products(p_name,p_quantity,p_cost,p_customerID,p_productID) values('GoldNecklace',5,150,1,9);
INSERT INTO Products(p_name,p_quantity,p_cost,p_customerID,p_productID) values('SilverNacklace',5,50,2,10);

INSERT INTO Orders(o_orderID, o_productID, o_totalcost, o_customerID) values(1,5,500,1);
INSERT INTO Orders(o_orderID, o_productID, o_totalcost, o_customerID) values(2,2,50,2);
INSERT INTO Orders(o_orderID, o_productID, o_totalcost, o_customerID) values(3,7,260,1);
INSERT INTO Orders(o_orderID, o_productID, o_totalcost, o_customerID) values(4,5,85,2);
INSERT INTO Orders(o_orderID, o_productID, o_totalcost, o_customerID) values(5,8,20,1);
INSERT INTO Orders(o_orderID, o_productID, o_totalcost, o_customerID) values(6,10,64,2);
INSERT INTO Orders(o_orderID, o_productID, o_totalcost, o_customerID) values(7,5,88,1);
INSERT INTO Orders(o_orderID, o_productID, o_totalcost, o_customerID) values(8,2,20,2);
INSERT INTO Orders(o_orderID, o_productID, o_totalcost, o_customerID) values(9,9,300,1);
INSERT INTO Orders(o_orderID, o_productID, o_totalcost, o_customerID) values(10,1,190,2);

INSERT INTO Payment(py_paymentID,py_customerID,	py_orderID,	py_amount,	py_status) values(1,4,1,50,'Pending');
INSERT INTO Payment(py_paymentID,py_customerID,	py_orderID,	py_amount,	py_status)  values(2,2,2,200,'Approved');
INSERT INTO Payment(py_paymentID,py_customerID,	py_orderID,	py_amount,	py_status) values(3,7,5,40,'Not Received');
INSERT INTO Payment(py_paymentID,py_customerID,	py_orderID,	py_amount,	py_status)  values(4,10,3,250,'Approved');
INSERT INTO Payment(py_paymentID,py_customerID,	py_orderID,	py_amount,	py_status) values(5,1,4,25,'Pending');
INSERT INTO Payment(py_paymentID,py_customerID,	py_orderID,	py_amount,	py_status)  values(6,10,7,90,'Not Received');
INSERT INTO Payment(py_paymentID,py_customerID,	py_orderID,	py_amount,	py_status) values(7,9,6,180,'Pending');
INSERT INTO Payment(py_paymentID,py_customerID,	py_orderID,	py_amount,	py_status)  values(8,5,10,200,'Approved');
INSERT INTO Payment(py_paymentID,py_customerID,	py_orderID,	py_amount,	py_status) values(9,9,1,100,'Not Received');
INSERT INTO Payment(py_paymentID,py_customerID,	py_orderID,	py_amount,	py_status)  values(10,2,2,300,'Approved');

INSERT INTO Shipping(s_shippingID,s_paymentID,s_orderID,s_customerID,s_status) values(1,5,4,4,'In process');
INSERT INTO Shipping(s_shippingID,s_paymentID,s_orderID,s_customerID,s_status) values(2,9,7,6,'Delivered');
INSERT INTO Shipping(s_shippingID,s_paymentID,s_orderID,s_customerID,s_status) values(3,9,7,7,'In process');
INSERT INTO Shipping(s_shippingID,s_paymentID,s_orderID,s_customerID,s_status) values(4,2,8,1,'Delivered');
INSERT INTO Shipping(s_shippingID,s_paymentID,s_orderID,s_customerID,s_status) values(5,4,8,1,'In process');
INSERT INTO Shipping(s_shippingID,s_paymentID,s_orderID,s_customerID,s_status) values(6,7,10,2,'Delivered');
INSERT INTO Shipping(s_shippingID,s_paymentID,s_orderID,s_customerID,s_status) values(7,8,3,7,'In process');
INSERT INTO Shipping(s_shippingID,s_paymentID,s_orderID,s_customerID,s_status) values(8,5,2,9,'Delivered');
INSERT INTO Shipping(s_shippingID,s_paymentID,s_orderID,s_customerID,s_status) values(9,8,1,5,'In process');
INSERT INTO Shipping(s_shippingID,s_paymentID,s_orderID,s_customerID,s_status) values(10,2,6,5,'Delivered');

