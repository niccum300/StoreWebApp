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
