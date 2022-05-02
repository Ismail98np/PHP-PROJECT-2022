# PHP-PROJECT-2022
A full stack website for my final assignment of the module Web Framework Development

<p align="center">
<img src="readMe_images/home.png" width="500">
<p>

# Details

The application is a full stack website constructed using PHP and Symfony that will connect to a MySQL database which will then be tested using PHPUnit.

This website will follow the use case of a driving instructor website. It will include some CRUD functionailty of multiple entites.

# Technologies Used

* **PHP** - PHP is a general-purpose scripting language geared toward web development. 

* **Symfony** - Symfony is a PHP web application framework and a set of reusable PHP components/libraries.

* **Composer** - Composer is an application-level package manager for the PHP programming language that provides a standard format for managing dependencies of PHP software and required libraries.

* **PHPUnit** - PHPUnit is a unit testing framework for the PHP programming language. 

* **MySQL** - MySQL is a database engine written in the C language.

* **Twig** - Twig is a template engine for the PHP programming language

* **BootSwatch** - Themes used for bootstrap.css

# Implementation

This project will have 3 entites:

* **Driving Instrucor** - This will model a driving instructor.
* **Student** - This will model a driving student.
* **Lesson** - This will model a lesson.

The Driving instructor and Student enties will have general C.R.U.D functionality revolving around lessons.

As of now I will attempt to add this funcitonailty and hopefully later down the line I can try to add more complex functionailty by manipulating the data that is stored in the database. But as of now this is the base functionailyty of the project.

# Entity Description

As mentioned above this project will have 3 entites here are the diagrams of these entites as to how i plan to model them in the project.

As PHP does not explicit types I created these diagrams to help clarify what types the fields in each entity

## Driving Instructor

<p align="center">
<img src="readMe_images/DI.png" width="500">
<p>

## Student

<p align="center">
<img src="readMe_images/Student.png" width="500">
<p>

## Lesson

<p align="center">
<img src="readMe_images/lesson.png" width="500">
<p>


# Approach


* **1. CRUD Functionailty**

The first thing that I wanted to implement for this project was the basic crud functionaility for one of the entities that i was going to be creating. to do this for one entity would me that i just have to repeat the steps for the remaining entites.

The first entity tat i wanted to create was the driving instructor as it was the most basic entity that did not need it's realtionships defined at the start.

This was all done within the **1_CRUD_LESSON** branch

* **2. Static Pages**

The next set of steps was to deliever the static pages of the application using a default controller class to add some context to the website.

I created the following static pages:

* Home Page
* Get started driving
* The EDT lessons
* Prices

* **3.Create remaning entities**

Since I had the completed the the dirivng instructor entity i decided to create the remaining entites, which was student and lesson. Here i established realationships between the entites.

One Driving instructor can have many lessons (OneToMany)
One Student can have many lessons (OneToMany)

establishing the relationships like this allowed me to ensure that the student and instructor entites were not depenedant on eachother and are only aware of eachother in the lesson entity.

* **4.Implement CRUD for remaning entities**

Repeating the steps in to add functionailty dor the driving instructor I repeated this for the student an dlesson objects 

* **5.Create start up fixture for entities**

I then created a fixture which would allow me to load the databasw with informtaion quickly

# Run website

* **1.Clone project**

Clone repository locally by using the git clone command:

`git clone https://github.com/Ismail98np/PHP-PROJECT-2022.git`

* **2. Install dependencies**

There are a number of dependencies for this project that are needed to ensure that it runs successfully.

You must install the following:

* Symfony
* Composer
* MySQL
* MySQL Workbench (useful for debugging)

You need to ensure that you have all the necessary packages for this project to work. To do this you need to run the following command

`composer install`

Composer will then install all the necessary packages for this project 

* **3. Configure Database**

To configure the database you will need to ensure that you have a database in MySQL and you will also need to confifure the .env file in the project to use the credentials for this local instance of the database by editing the `DATABASE_URL` field.

<p align="center">
<img src="readMe_images/db.png" width="500">
<p>


After you have done this you can proceed to run 3 command which will help set up the database.

MAKE SURE YOU ARE IN THE CRUD_APP FOLDER.

1. **php bin/console doctrine:database:create** - Create database.
2. **php bin/console doctrine:migrations:diff** - Generate a migration by comparing your current database to your mapping information.
3. **php bin/console doctrine:migrations:migrate** -Execute a migration to a specified version or the latest available version.
4. **php bin/console doctrine:fixtures:load** - Load data fixtures to your database

* **4. Run Server and navigate to localhost**

Run the following command

`symfony serve`

This should start the server and you can then open up localhost:8080 in your browser.

<p align="center">
<img src="readMe_images/wb.png" width="500">
<p>

This should bring you to the home page of the project.

<p align="center">
<img src="readMe_images/home.png" width="500">
<p>
