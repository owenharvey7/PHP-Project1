#Create a database table with owner info named car_owners.
USE car_dealership;

DROP TABLE IF EXISTS car_owners;

CREATE TABLE car_owners (
                      userID INT NOT NULL AUTO_INCREMENT,
                      first_name VARCHAR(50) NOT NULL,
                      last_name VARCHAR(50) NOT NULL,
                      email VARCHAR(50) NOT NULL,
                      password VARCHAR(50) NOT NULL,
                      PRIMARY KEY (userID)
);




#Insert values into the car_owners table.
INSERT INTO car_owners (first_name, last_name, email, password) VALUES ('John', 'Smith', 'JohnSmith@gmail.com', 'password123');






#Create a database table with car values named cars.
USE car_dealership;

DROP TABLE IF EXISTS cars;

CREATE TABLE cars (
                      carID INT NOT NULL AUTO_INCREMENT,
                      make VARCHAR(50) NOT NULL,
                      model VARCHAR(50) NOT NULL,
                      year INT NOT NULL,
                      base_price INT NOT NULL,
                      PRIMARY KEY (carID)
);

#Insert values into the cars table.
INSERT INTO cars (make, model, year, base_price) VALUES ('Ford', 'Fusion', 2018, 25000);



#Link the two tables that you have created, car_owners and cars, together using a third table users_cars.
USE car_dealership;

DROP TABLE IF EXISTS users_cars;

CREATE TABLE users_cars (
                      userID INT NOT NULL,
                      carID INT NOT NULL,
                      private_price INT,
                      suggested_retail_price INT,
                      certified_pre_owned_price INT,
                      PRIMARY KEY (userID, carID),
                      FOREIGN KEY (userID) REFERENCES car_owners(userID),
                      FOREIGN KEY (carID) REFERENCES cars(carID)
);

#Insert values into the users_cars table.
INSERT INTO users_cars (userID, carID, private_price, suggested_retail_price, certified_pre_owned_price) VALUES (1, 1, 20000, 25000, 30000);





