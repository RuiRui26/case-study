The EASYDRIVE SCHOOL OF MOTORING System Project
==============================================

The EasyDrive School of Motoring System is a project run and developed by three WMSU students under BSIT 3A (Andy Rilg Dela Merced Dinampo, Juliana Mikyla Escudero, and Alced Madiales).

This system aims to help run the day-to-day operations and routines in the EasyDrive School of Motoring. It displays necessary data on staff, clients, offices managed by different managers, and more. It also helps automate the school’s processes by providing an easier way in registering clients, staff, and managers into the system, as well as inputting information on necessary operations in the school like interviews, driving tests, and such.


Installation
=========

Prerequisites:

XAMPP

To install:

There are three ways to install;

    git clone https://github.com/RuiRui26/case-study.git

1. Open your terminal on your device or in Visual Studio and input the text above.

Note: You can also clone the repository from the Github Desktop. Proceed to the [main repository’s page](https://github.com/RuiRui26/case-study).

2. Make sure the repository’s folder is in xampp>htdocs.

3. Open your XAMPP and start both Apache and MySQL.

4. Proceed to place the database from our ‘database’ folder called easydrive_school and import it into your databases in phpmyadmin.

5. Go to your browser, and input ‘localhost/case-study/login-register-interview2/login.php’ to login to the system.

Note: if you want to create a new account, please proceed to ‘localhost/case-study/login-register-interview2/manager_signup.php’ to sign up as a Manager or ‘localhost/case-study/login-register-interview2/staff_signup.php’ to sign up as a Staff. Normal registration (for clients) can be seen in the login page of the system

6. Feel free to explore the system’s features!


User Guide
=========

Welcome to EasyDrive School of Motoring! This section covers the guide on navigating through each view of the site.

CLIENT

    Example Account: Client_E(Username), 12345(Password)

1. The user must create a Client account in order to proceed to the Client view.

2. After registration and interview, the user can now log into their account.

3. Once logged in, the user will be greeted by the booking page, where they’ll be able to book their lessons.

4. Input the necessary details before clicking on ‘Book Lesson’.


STAFF

Example Account: Staff_E(Username), 12345(Password)

1. The user must create a Staff account in order to proceed to the Staff view.

2. Once logged in, the user is greeted by their own dashboard, where they’ll be able to look through necessary information, such as interviews, lessons, cars, and driving tests. There are three categories: General Management, Car Management, and Driving Test Management. Clicking on one of the buttons will display the necessary information shown on the button.

3. In the navigation bar above, the user will also be able to input information, such as interviews and driving tests. Once done, click on their respective ‘add’ buttons to input the information into the database.


MANAGER

	Example Account: Manager_E(Username), 12345(Password)

1. The user must create a Manager account in order to proceed to the Manager view.

2. Once logged in, the user will see their manager profile, which will include their personal information as well as the names and contact numbers of the other managers registered in the system.

3. In the manager’s dashboard, the user will now be able to see the different information on the cities and the different offices that the EasyDrive School has in their database.

4. Clicking on one of the cities will display the different addresses that the offices are in, as well as their respective Managers. Clicking on one of the offices will transfer the Manager to the different information on said office.

5. The user will now be able to navigate, filter, and sort through each category of data in said office. 


Contribution
==========

(For developers) Contributions to the repository are welcome! Feel free to use different frameworks, add modifications, or fix any bugs to the system.

1. Fork the repository to your name.
2. Add your changes and modifications.
3. Proceed to pull your changes to the repository.


Copyright
========

Copyright © 2024 Dinampo, Escudero, & Madiales. All Rights Reserved.
