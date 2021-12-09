create database Store;

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
CREATE  PROCEDURE `addOrder`(IN `orderDate` DATE, IN `amount` DECIMAL(10,2), IN `customerId` INT, IN `employeeId` INT, IN `productId` INT, IN `storeId` INT)
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
    
    insert into store_order
    VALUES(storeId, orderId);
    
    UPDATE products  
    set products.Quantity = products.Quantity-1
    where products.Id = productId;
    
END$$
DELIMITER ;

-- add employee and store_employee
DELIMITER $$
create PROCEDURE add_store_employee(
	IN firstName VARCHAR(50),
    IN lastName VARCHAR(50),
    IN jobTitle VARCHAR(50),
    IN storeId int
)
BEGIN
	DECLARE empId INT DEFAULT 0;
    
    INSERT INTO employees(FirstName, LastName, JobTitle)
        VALUES (firstName, lastName, jobTitle);
    
    select Max(Id)
    into empId
    from employees;
    
    insert into store_employee
    VALUES(storeId, empId);
    
    
END$$
DELIMITER ;

-- add product and store_product
DELIMITER $$
create PROCEDURE add_store_product(
	IN name VARCHAR(50),
    IN price DECIMAL(10,2),
    IN quantity INT,
    IN storeId int
)
BEGIN
	DECLARE pId INT DEFAULT 0;
    
    INSERT INTO products(Name, Price, Quantity)
        VALUES (name, price, quantity);
    
    select Max(Id)
    into pId
    from products;
    
    insert into store_product
    VALUES(storeId, pId);
    
    
END$$
DELIMITER ;

-- select order details
select DISTINCT orders.OrderDate, orders.Amount, customers.FirstName, customers.LastName, employees.FirstName AS EmpFirstName, employees.LastName As EmpLastName, products.Name
from orders inner join customer_order ON orders.Id = customer_order.OrderId
inner join customers on customers.Id = customer_order.CustomerId
inner join employee_order ON orders.Id = employee_order.OrderId
INNER JOIN employees ON employee_order.EmployeeId = employees.Id
INNER join order_product on order_product.OrderId = orders.Id
inner JOIN products on order_product.ProductId = products.Id;

-- select employees
select employees.Id, employees.FirstName, employees.LastName, employees.JobTitle, stores.Name from employees
inner JOIN store_employee on employees.Id  = store_employee.EmployeeId
inner JOIN stores on store_employee.StoreId = stores.Id;

-- select products
select products.Id, products.Name, products.Price, products.Quantity, stores.Name As StoreName from products
inner JOIN store_product on products.Id = store_product.ProductId
inner JOIN stores on store_product.StoreId = stores.Id;