# JAC_ShowCase
# applicationCenter

This project provides a job applicaiton system, complete with user forms and adminstrator dashboard.

---------------------
ABOUT
---------------------
Spring 2019 - Polk State College CIS4910 Capstone - Business Information Technology

Project Members: Andrew Ettensohn - Web Developer/DBA
Stephen Justice - DBA/Tester/Technical Document Author
Professor: Dawn Giannoni, PhD 
Project Resources: Amazon Web Services, MySQL, JavaScript/jQuery, PHP, w3schools.com CSS

----------------------
INSTALLATION
----------------------

HOSTING THE FILES

-The PHP and HTML files included in this project can be hosted by any web server without issue. 
-The web server must have a connection to the internet due to dependencey on jQuery and CSS files not included with the files.
-If the project is able to be used over intranet or offline if the jQuery and CSS dependencies are downloaded and hosted by the web server.

CONNECTING THE PROJECT TO A DATABASE

-The project uses database connection info that is specified in the start of every PHP file.
-The credentials for the database must be hosted in the path specified on the web server, meaning that the files and directories must be created and edited with the connection info. 

For example, <?php include "../inc/dbinfo.inc"; ?>

The inc folder will exist in the parent directory of the web server, inside of the inc folder with me dbinfo.inc which will include the following:
 
<?php
define('DB_SERVER', '*');
define('DB_USERNAME', '*');
define('DB_PASSWORD', '*');
define('DB_DATABASE', '*');
?>

The * will need to be replaced by whatever connection info is necessary

-An uploads folder and images folder must be present in the main site directory

CONFIGURING THE DATABASE

-JAC_DATABASE_STRUCTURE.sql is required in order for the site to function! This file must be run on a mySQL database in order to create a new database instance. 

CONFIGURING THE SITE

-After the database is created, new postings can be created from the adminstrator dashboard. Once a posting is created the site is now usable.
-Postings can only use the 4 preset categories, custom categories are not supported.
-An adminstrator username and password must be inserted into the users table, otherwise the adminstrator pages can be accessed without a username and password.

----------------------
FEATURES
----------------------
Please see the technical design document for this site for a full list of features

-Web-form for data entry, database back end
-Searchable database of job openings
-Apply now features
-Email confirmation
-Adminstrator pages capable of making new postings, removing applicants, and adding applicants
