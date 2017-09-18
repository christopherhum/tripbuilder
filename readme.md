## Chris' Tripbuilder

Welcome to Chris' Tripbuilder.  This web application uses Laravel and Symphony that allows users to add Flights from one Airport to Another to their Trips.

It is based on the MVC (Model-View-Controller) design and is coded in PHP.

## Installing the Tripbuilder / Setting up the Environment
To install the tripbuilder follow the following steps (steps are currently only Windows, but application runs on Linux as well):

1. Install Composer to your computer from: https://getcomposer.org/ (composer is used to download and install Laravel to your system)
2. Install Laravel with: `composer global require "laravel/installer"`
3. Download project files of Tripbuilder to hard drive/web server in appropriate place (if using XAMPP put it into the \htdocs folder)
4. Set your **database name, username and password** in your web configuration (I use Apache on XAMPP locally and have to edit my Apache `httpd.conf` file and in my `my.ini` file for **MySql**)
5. Set your **Document Root Path** (for me `httpd.conf`) to your **public** folder in server. Ex: `DocumentRoot "G:/xampp/htdocs/TripBuilder/public"`
6. If database models `(Airport.php, Flight.php, Trip.php)` are not there/created (in the `TripBuilder\app)` folder (and you do not have the needed database). Run Laravel command `php artisan migrate` to run migrations to create the Models and the Database 
7. Import the database files included with the project in the `\database files\` folder of TripBuilder, to the respective tables. Using your database (I use MySql) 
8. **IF Using PHPStorm as IDE:** also set your **application URL**(if needed, default `http://localhost`) in (.env) file in root directory and `config\app.php`.  You will also need to set the database information for the respective database (MySql, Sqlite, sqlsrv etc) in `config\database.php`
9. Run your server and access it by the proper url (if local it will be `http://localhost` by default)
 
Note: If using PHPStorm as IDE, download `barryvdh/laravel-ide-helper` as dependency to **composer** as it will highlight code for you.
## Running the Tripbuilder

1. Once Tripbuilder environment is set up and installed, go to `http://localhost/tripbuilder` (or just `http://localhost/` as it will redirect you).
2. On the landing page of **Chris Tripbuilder** you will see all available Trips.  If you do not, you don't have any trips currently, add some in your database (there is only one field **id** which you can populate with numbers 1 to whatever number you'd like)
3. Select a Trip from the Drop down then click **Edit Trip** button
4. You will now be in the main TripBuilder area where you can see all the Flights for a current Trip.  
5. Here you have options to **View Flights** (table is already loaded with current Flights), **Delete Flights** and **Add Flights** for a current Trip
6. **Delete Flights:** You have the option to **delete flights** by clicking the appropriate **"Delete Flight"** button
7. **Add Flights:** 
* To add a flight, first click on the **"Search from airport..."** textbox.  Type in a string to search by airport name, ex: **Montreal** then click the **Search From** button.  This will populate the **FROM Airport location** table.  Click on the Airport you would like to add in the table.  Notice it highlights and the name will now show up in the middle of the encompassing table. **Do the same for the TO Airport area**
* When you have both a FROM airport and a TO airport clicked and highlighted, click on **Submit Choices** button in between the tables
* Note the new Flight appears on the top table, you have now added a Flight!
* When you are finished added a Flight you can click the link on top of the page labeled **Click Here to Return to Trip Selection** to go back to the Trip Selection area

##Known Bugs
1. The airport.csv file (and database) is in UTF-8 but certain characters show up as question marks
2. There is no error validation handling at the moment, so users can click Submit Choices when adding a Trip without a from and/or to destination (and it will populate the database with the dummy info)

