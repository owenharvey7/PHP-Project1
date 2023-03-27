Cars and Car Values Mini System
The Cars and Car Values Mini System is a web-based application that allows users to value their cars based on a set of parameters. This application is created using the PHP programming language and requires a PHP 7 installation.

Features
User registration and login
Car valuation based on make, model, year, and condition
Base price adjustment based on mileage
Addition of desirable options to increase the car value
Display of car value if sold to a private owner, suggested retail price, and certified pre-owned value
Clean and responsive user interface
Installation
Download or clone the project files to your local machine.
Create a new database on your MySQL server.
Import the SQL file provided in the database directory into your new database.
Open the config.php file and update the database connection details.
Navigate to the project directory in your terminal/command prompt and run php -S localhost:8000.
Open your web browser and navigate to localhost:8000 to start using the application.
Usage
Registration and Login
To use the car valuation feature, users must first register an account and login to the system. The registration form requires a valid email address and a password of at least 6 characters. Passwords are encrypted using a one-way hash function and stored securely in the database. Once registered, users can log in to the system using their email and password.

Car Valuation
To value a car, users must select the make, model, year, and condition of the car from the dropdown menus on the valuation form. The condition of the car can be set to Excellent, Very Good, Good, or Fair, and affects the final value of the car. The base price of the car is adjusted based on the mileage, with higher mileage resulting in a lower final value. Users can also select up to five desirable options, each of which adds a fixed value of $50 to the car price.

Displaying Car Values
Once the car valuation is complete, the application displays the final value of the car if sold to a private owner, the suggested retail price (15% more than the private owner value), and the certified pre-owned value (10% more than the private owner value). Users can view the car values for all the cars they have valued by clicking on the "View My Valuations" button in the navigation bar.

Future Improvements
Allow users to edit their account details
Improve the validation and error handling of the registration and login forms
Allow users to delete their account and all associated data
Allow users to save and retrieve incomplete car valuations
Add more cars and options to the database
Allow users to search for cars based on make, model, or year
Add support for multiple currencies
