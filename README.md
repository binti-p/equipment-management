# Equipment Management Application

## About

This is a repository for an equipment management system which can be used by various organizations/clubs to keep track of various tools and equipments in their inventory. The application has 2 sides: 

__1. Admin Side:__
  - The admin has the power to handle all the equipments in the inventory- inserting/deleting/modifying them. 
  - He/she can view all the registered users and can approve/reject borrow requests according to the availability of equipments. 
  - The admin can also look at the issue/request history of different users.

__2. User Side:__
  - Users can view all the available equipments in the inventory and can make a borrow request according to their needs. 
  - They can also view their previous requests and issues and their statuses. 

Summarizing everything, the application enables efficient inventory management of any club/organization.

## How to use

1. Make sure you have XAMPP/ LAMPP installed in your system.
2. Clone the repository into the htdocs folder so that you can use localhost to test this application using:
  ```
  $ git clone https://github.com/binti-p/equipment-management.git
  ```
3. Open localhost/phpmyadmin in your browser after starting the LAMPP/ XAMPP server.
4. Create a database named 'clubinventory' and import the file 'clubinventory.sql' into this database.
5. Visit localhost/equipment-management/clubinventory/

__ADMIN CREDENTIALS__

Username: bee

Password: 1234

_For accessing the user, you can sign up and then login as a user_
