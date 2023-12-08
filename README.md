# Classimax
Link to view app: http://marko-calssimax.online/

Admin:
  email:markodasic70@gmail.com
  passwrod: VisokaIct1.

Moderator:
  email:
  password:

User:
  email:
  password:



The project was done as a pre-examination requirement in the second year of study.
The project represents a Full Stack Web Application written in Native PHP, which serves as a portal for placing advertisements for the sale of products.

The application is intended for unauthorized users, authorized users and administrators

An unauthorized user is able to:
- Searches ads from other users. The purchase of the product is not realized in the application, but the phone number of the owner of the ad is visible on each ad.
- Change the currency in which his ads are displayed.

An authorized user has the same capabilities as an unauthorized user with the addition that he can:
-Rates other ads
- Comment on other ads
- Manage your ads (placement, deletion, modification)
- Add someone else's ad to your favorites list
- Pay for the promotion of your ad, so that the ad is more visible to other users
- Make changes to your own profile
- Sends a request to the administrator regarding credit replenishment, so that he can pay for promotions of his ads
- Add or delete additional phone numbers
- Delete own account

The administrator has the same capabilities as the authorized user with the addition that he can:
- Approve credits payment requests from the user
- View all users of the system, with the possibility to ban or reban them
- Download user data to your computer in excel table format
- Corrects the prices of promotions
- Has insight into the statistics of visits to individual parts of the application

The database used is MySql.
The application is written in Native PHP.
A session was used for authentication purposes.
Server side rendering.
The application architecture is based on the MVC architecture. The index.php page is always loaded and passed the query parameter "?page" which tells the user which page should be displayed. The index.php page then deduces which file needs to be loaded from the views folder. Pages that do not have a graphic display and serve only for data manipulation are located in the models folder. They can be called by Views pages or other Models files. The configuration files and the database connection file have been moved to a separate folder.
All data sent to the server by the user must be checked by the validator.
The HTML, CSS and part of the JavaScript code is taken from the Internet with my modification.

On this project I am:
- Perfected the logic and syntax of the PHP language.
- Improved knowledge of designing databases and writing SQL queries.
- Learned to create an architecture similar to MVC architecture.
- Learned to implement XSS protection
- Learned how to sending an email message to a user using PHP
- Learned how to upload image to server using AJAX in base64 format
- Learned to translate php objects into excel or word document
