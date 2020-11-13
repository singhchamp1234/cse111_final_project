-- Herman Rai
-- Puneet Pal Kaur

-- CSE 111 - Database
-- Phase 2
-- Project: Lustrous Jewelry Customer Database

-- For Testing Purposes
-- select * from Login;
-- select * from Customer;
-- select * from Orders;
-- SELECT * FROM Payment;
-- SELECT * FROM Products;
-- SELECT * FROM Shipping;

-- This part contain the use of UPDATE clause

---------------------------------------QUERY 1--------------------------------
-- Query to update the login information of a user
update Login set l_email = 'saini1@abc.com' where l_email = 'kaur@abc.com';
select * from Login;


---------------------------------------QUERY 2--------------------------------
-- Query to change the status of the payment
update Payment set py_status = 'Approved' where py_paymentID = 7;
select * from Payment;


---------------------------------------QUERY 3--------------------------------
-- Query to update the Product name from Products table 
update Products set p_name = 'Diamond Ring' where p_name = 'SilverNacklace';
select * from Products;


---------------------------------------QUERY 4--------------------------------
-- Login with Email
--	The query will return a record if the information is correct 
--  otherwise no information will return
SELECT l_username as User_Name, l_email as Email
FROM Login
WHERE l_email = 'saini@abc.com' and l_password = '123456';


---------------------------------------QUERY 5--------------------------------
-- Login with Username
--	The query will return a record if the information is correct 
--  otherwise no information will return
SELECT l_username as User_Name, l_password as Password
FROM Login 
WHERE l_username = 'jasleen';


---------------------------------------QUERY 6--------------------------------
-- Find a Customer by its ID
-- if there is a match will return Name, Email. Address, [Phone Number]

SELECT c_name as Name, c_email as Email, c_address as Address, c_phoneNumber as [Phone Number]
FROM Customer
WHERE c_customerID = 2;

---------------------------------------QUERY 7--------------------------------
-- Select [Customer Name], [Total Cost], and [Product Name]
-- FROM Customer, Orders, and Products tables
-- Conditions: Where c_customerID = o_orderID, and o_productID = p_productID, and o_orderID = 5;

SELECT c_name as [Customer Name], o_totalcost as [Total Cost], p_name as [Product Name]
FROM Customer, Orders, Products
WHERE c_customerID = o_orderID
    AND o_productID = p_productID
    AND o_orderID = 5;

---------------------------------------QUERY 8--------------------------------
-- Set the shipping status to Not Received, if match with shipping ID
-- return the updated shipping table

UPDATE Shipping SET s_status = "Not Received"
WHERE  s_shippingID = 4;
SELECT * FROM Shipping;


---------------------------------------QUERY 9--------------------------------
-- Find all the orders by a specific Customer
SELECT cs.c_name as [Customer Name], o_orderID as [Order ID], o_productID as [Product ID], o_totalCost as [Total Cost]
FROM Orders as od INNER JOIN Customer as cs ON od.o_customerID = cs.c_customerID
WHERE od.o_customerID = 1;


---------------------------------------QUERY 10--------------------------------
-- Find total cost of the orders by a specific Customer till now
SELECT SUM(o_totalCost) as [Total Cost]
FROM Orders as od INNER JOIN Customer as cs ON od.o_customerID = cs.c_customerID
WHERE od.o_customerID = 1;


---------------------------------------QUERY 11--------------------------------
-- Find all the payments with 'Approved' status
SELECT c.c_name as [Customer Name], py_paymentID as [Payment ID], py_orderID as [Order ID], py_amount as Amount, py_status as [Status]
FROM Payment as p INNER JOIN Customer as c ON p.py_customerID = c.c_customerID
WHERE p.py_status = 'Approved';


---------------------------------------QUERY 12--------------------------------
-- Find all the shippments with 'In process' status
SELECT c_name as [Customer Name], s_paymentID as [Payment ID], s_orderID as [Orders ID], s_status as [Status], o_totalcost as[Total Cost]
FROM Shipping, Customer, Orders
WHERE s_customerID = c_customerID AND o_orderID = s_customerID AND s_status = 'In process' AND o_totalcost > 10;


---------------------------------------QUERY 13--------------------------------
-- this Query will delete a record from order table
DELETE FROM Orders
WHERE o_orderID = 1;
SELECT * FROM Orders;


---------------------------------------QUERY 14--------------------------------
-- this Query will delete payments of a specific order id
DELETE FROM Payment 
WHERE py_orderID = 1;
SELECT * FROM Payment;


---------------------------------------QUERY 15--------------------------------
-- Select only DISTINCT customer names no duplicates

SELECT DISTINCT c_name FROM Customer;


---------------------------------------QUERY 16--------------------------------
-- Select the py_amount in ASC order from Payment table

SELECT * FROM Payment ORDER BY py_amount ASC;


---------------------------------------QUERY 17--------------------------------
-- Select the o_orderID from orders table with limit 5 and offset as 2.

SELECT o_orderID
FROM Orders
LIMIT 5
OFFSET 2;


---------------------------------------QUERY 18--------------------------------
-- Update the Customer Info by finding the customer with Customer Phone Number
-- this will be a stored prosedure that will update the customer information
--	in the customer table

UPDATE Customer SET c_customerID = 10, c_name = 'Puneet', c_email = 'puneet123@abc.com', c_address = 'Street 12'
WHERE  c_phoneNumber = '209-470-0298';
SELECT * FROM Customer;


---------------------------------------QUERY 19--------------------------------
-- Update the Payment Status by finding the Payment using Payment ID
-- this will be a stored prosedure that will update the customer information
--	in the customer table

UPDATE Payment SET py_status = 'Declined'
WHERE  py_paymentID = 2;
SELECT py_paymentID, py_amount, py_status FROM Payment WHERE py_paymentID = 2;


---------------------------------------QUERY 20--------------------------------
-- Update the Shipping Status by finding the Shipping data using Shipping ID
-- this will be a stored prosedure that will update the customer information
--	in the customer table

UPDATE Shipping SET s_status = 'Declined'
WHERE  s_shippingID = 1;
SELECT s_shippingID, s_customerID, s_status, c_name FROM Shipping, Customer WHERE s_customerID = c_customerID AND s_shippingID = 1;