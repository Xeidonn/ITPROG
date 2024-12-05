
---

# E-Commerce Website

## Overview
The E-Commerce Website project is a PHP and MySQL-based application that includes various functionalities such as item management, shopping carts, and social media features. This guide will walk you through how to set up and run the project using **XAMPP**.

## Requirements
- **XAMPP**: Install XAMPP, which includes Apache (for PHP) and MySQL (for the database).
- **PHP**: PHP 7 or later version.

## Installation Steps

### Step 1: Clone the Repository
Clone the repository to the XAMPP `htdocs` directory. You can clone the project by using the following command:
```
git clone https://github.com/Xeidonn/ITPROG.git
```

Alternatively, you can manually download the project and move it into your XAMPP `htdocs/demo/Machine Problem` folder.

### Step 2: Import the Database
1. Open **phpMyAdmin** by going to `http://localhost/phpmyadmin/` in your browser.
2. Create a new database (e.g., `scentbonanza`).
3. Import the database SQL file:
    - Go to the **Import** tab in phpMyAdmin.
    - Select the file `scentbonanza.sql` and execute the import.

### Step 3: Configure the Project
1. Make sure your project is located in the `Machine Project` folder under XAMPP. For example:
   ```
   C:\xampp\htdocs\demo\ITPROG\Machine Project
   ```

2. Open `dbconnect.php` (or the appropriate configuration file) and set your MySQL credentials and database name:
   ```php
   $servername = "localhost";
   $username = "root";
   $password = "";
   $dbname = "scentbonanza";  // The database you created in phpMyAdmin
   ```

### Step 4: Run the Project
1. Start the Apache and MySQL services in XAMPP Control Panel.
2. Open your browser and navigate to:
   ```
   (http://localhost/demo/ITPROG/Machine%20Project/php)
   ```
   This should load the main page of your project.

### Folder Structure
- **php**: This contains the PHP files for the web application.
- **images**: This contains the images for the web application.
- **css**: This folder contains Cascading Style Sheets for the web application.
- **javascript**: This folder contains the script files for the web application.

## Sample Screenshots

Here are a few screenshots of the Scent Bonanza Perfume Catalog project:
**Main Page**
![image](https://github.com/user-attachments/assets/3e8f536d-c77f-489d-8382-6661db3a6c6a)

**Products Page**
![image](https://github.com/user-attachments/assets/ede54748-6c2c-4f17-98c6-119e9d7e28b6)

**Brand Page**
![image](https://github.com/user-attachments/assets/e0135aff-ee40-4550-a604-a38daad06bad)

**About Us Page**
![image](https://github.com/user-attachments/assets/acd14009-a5f5-4fc7-9966-3f433f3ac17e)

**Login Page**
![image](https://github.com/user-attachments/assets/07d3cf71-af85-4230-9543-423ae1a83630)

**Sign Up Page**
![image](https://github.com/user-attachments/assets/504f20ed-6464-41e2-9b43-0bd648dde002)

**Forgot Password Page**
![image](https://github.com/user-attachments/assets/c23ad9e4-7b87-43af-b172-0d19f69a6cd3)


## Contributors

BUTIONG, Juan Francisco P.
KALINISAN, Carl Adrian F.
PEREZ, Carll Josef R.
PEREZ, James Matthew F.
RAMIREZ, Myles Clement D.

## Contact

myles_ramirez@dlsu.edu.ph
carl_kalinisan@dlsu.edu.ph
carll_perez@dlsu.edu.ph
james_matthew_perez@dlsu.edu.ph
juan_butiong@dlsu.edu.ph

---
