# COVID 19 Website

Website to track and add new COVID 19 infections onto a map of Exeter.

Coursework was written for temporary deployment on a virtual machine, so is only an example of my PHP coding experience, that cannot be run.

Coursework Requirements:

- HTML pages for static content

- CSS is used to style the pages
  - Each page matches the CSS guide closely as possible

- PHP is correct
  - To register the PHP will start a session, check password criteria, generate a salt value, hash the password, connect to the logins table of the database and insert all the user data. It will set session variables then redirect user to the homepage.
  - To login it will connect to the database, compare values with that in the login table, then start a session and redirect to the homepage if they match.
  - To check infections on the home page it will gather cookie data, then use curl to retrieve all infections within those cookie parameters from the API. It will also collect all the user’s visits from the database. A comparison is made and infections that meet the threshold are theoretically added onto the map, but this functionality is yet to work.
  - To create the overview, it will connect to the database and select all the visits data. Also, it will perform the deletion of a record at the request of an AJAX call.
  - Adding a new visit, it will take all the form data and connect to the database then insert that into the visits table.
  - To report an infection, it will connect to the database and insert the infection data from the form. It will connect to the API using curl and individually report each of these visits to it.
  - To change the settings, it will gather the form data, then assign cookies with these cookie values.

- Secure sessions and cookies
  - Sessions are created at login/registration. Then destroyed as soon as you close the tab or press logout
  - Cookies are used to store the settings and are established in the settings.php

- JavaScript
  - To remove a location from the overview, JavaScript is used to make an AJAX call and set up a new XMLHttpRequest.
  - JavaScript is also used to check for any blank entries.
  - Using JavaScript posed issues when trying to click to get X and Y coordinates in the add visit page, so instead there are two extra form boxes.

- AJAX
  - AJAX is used in the overview page, an XMLHttpRequest is made and a POST request is sent to another PHP file, where the POSTed parameters are used in a SQL deletion query.

- Web Service
  - In report.php, the web service is accessed using curl and the POST option, data parameters from the database of visits are used as post fields.
  - In the homepage, a GET request is made for all the infections in a chosen timespan.

- Security
  - In the registration page,a random salt is generated to be hashed with the password
  - In every instance of accessing the database, htmlspecialchars is applied to the data before insertion to protect from cross side scripting attacks, and prepared statements are used to protect against SQL injection.
