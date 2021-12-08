create table Stores(
	Id int NOT NULL AUTO_INCREMENT,
    Name VARCHAR(50),
    Address VARCHAR(50),
    PRIMARY KEY(Id)
);

CREATE TABLE Employees(
	Id int NOT NULL AUTO_INCREMENT,
    FirstName VARCHAR(50),
	LastName VARCHAR(50),
    JobTitle VARCHAR(50),
    PRIMARY KEY(Id)
);

CREATE TABLE Products(
	Id int NOT NULL AUTO_INCREMENT,
    Name VARCHAR(50),
    Price DECIMAL(8,2),
    Quantity int,
    PRIMARY KEY(Id)
);

CREATE TABLE Orders(
	Id int NOT NULL AUTO_INCREMENT,
    OrderDate DATE,
    Amount DECIMAL(10,2),
    PRIMARY KEY(Id)
);

CREATE TABLE Customers(
	Id int NOT NULL AUTO_INCREMENT,
    FirstName VARCHAR(50),
    LastName VARCHAR(50),
    Address VARCHAR(50),
    PRIMARY KEY(Id)
);

-- has relation
CREATE TABLE Store_Employee(
	StoreId int NOT NULL,
    EmployeeId int NOT NULL,
    FOREIGN KEY(StoreId) REFERENCES stores(Id) ON DELETE CASCADE,
    FOREIGN KEY(EmployeeId) REFERENCES employees(Id) ON DELETE CASCADE
);

-- contains relation
CREATE TABLE Store_Product(
	StoreId int NOT NULL,
    ProductId int NOT NULL,
    FOREIGN KEY(StoreId) REFERENCES stores(Id) ON DELETE CASCADE,
    FOREIGN KEY(ProductId) REFERENCES products(Id) ON DELETE CASCADE
);

-- Gets Relation
CREATE TABLE Store_Order(
	StoreId int NOT NULL,
    OrderId int NOT NULL,
    FOREIGN KEY(StoreId) REFERENCES stores(Id) ON DELETE CASCADE,
    FOREIGN KEY(OrderId) REFERENCES orders(Id) ON DELETE CASCADE
);

-- Places Relation
CREATE TABLE Customer_Order(
	CustomerId int NOT NULL,
    OrderId int NOT NULL,
    FOREIGN KEY(CustomerId) REFERENCES customers(Id) ON DELETE CASCADE,
    FOREIGN KEY(OrderId) REFERENCES orders(Id) ON DELETE CASCADE
);

-- Made Of relation
CREATE TABLE Order_Product(
    OrderId int NOT NULL,
    ProductId int NOT NULL,
    FOREIGN KEY(OrderId) REFERENCES orders(Id) ON DELETE CASCADE,
    FOREIGN KEY(ProductId) REFERENCES products(Id) ON DELETE CASCADE
);

-- Authorizes Relation
CREATE TABLE Employee_Order(
    EmployeeId int NOT NULL,
    OrderId int NOT NULL,
    FOREIGN KEY(EmployeeId) REFERENCES employees(Id) ON DELETE CASCADE,
    FOREIGN KEY(OrderId) REFERENCES orders(Id) ON DELETE CASCADE
);

-- addOrder Procedure
DELIMITER $$
CREATE  PROCEDURE `addOrder`(IN `orderDate` DATE, IN `amount` DECIMAL(10,2), IN `customerId` INT, IN `employeeId` INT, IN `productId` INT)
BEGIN
	DECLARE orderId INT DEFAULT 0;
    
    select Max(Id)
    into orderId
    from orders;
    
    insert into customer_order
    VALUES(customerId, orderId);
    
    insert into employee_order
    VALUES(employeeId, orderId);
    
    insert into order_product
    VALUES(orderId, productId);
    
    
END$$
DELIMITER ;

-- select order details
select DISTINCT orders.OrderDate, orders.Amount, customers.FirstName, customers.LastName, employees.FirstName AS EmpFirstName, employees.LastName As EmpLastName, products.Name
from orders inner join customer_order ON orders.Id = customer_order.OrderId
inner join customers on customers.Id = customer_order.CustomerId
inner join employee_order ON orders.Id = employee_order.OrderId
INNER JOIN employees ON employee_order.EmployeeId = employees.Id
INNER join order_product on order_product.OrderId = orders.Id
inner JOIN products on order_product.ProductId = products.Id
where orders.Id = 18;