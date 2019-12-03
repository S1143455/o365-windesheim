# o365-windesheim


HOW TO INSTALL THE PROJECT

No composer? Install it.

go to https://getcomposer.org/download/

####Windows installer

Download and run Composer-Setup.exe - it will install the latest composer version whenever it is executed. (https://getcomposer.org/Composer-Setup.exe)

###### ~~No mac users in our project team, otherwise go f*** yourself. you can read the mac tutorial yourself.~~

Follow the composer install guide. When it asks for a PHP path. Navigate to your xammp folder/php/php.exe (example : C:/program-files/xammp/php/php.exe)
   

No nodejs? Install it.


Go to https://nodejs.org/en/

####Windows installer

At the time of writing: version 12.13.1 LTS (https://nodejs.org/dist/v12.13.1/node-v12.13.1-x64.msi)

Follow the install guide. No special actions required.



####PHPSTORM

After installing composer/nodejs, restart phpstorm.

Make sure you are up-to-date with the latest changes.

Run:
Composer install
npm install




####COPY THE .example FILES!!
And remove the .example from the end of the files. (USE PHPSTORM [ALT+F6])

In the .env file change the placeholder data for your information.

In the gulpfile change the constant hostname to the url of your site. (example : wwi.local)

To automatically refresh (S)CSS changes. run : gulp serve

This will open a browser at localhost:3000, all SCSS changes you make will be automatically refreshed on THIS url.
(When you add a new stylesheet, you need to rerun: gulp serve)

##Styling

All stylesheets will be stored as .scss files in the theme/scss folder. When gulp is ran, it will create CSS files for you.


###No further questions?? Have fun.




