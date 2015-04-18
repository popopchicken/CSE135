# CSE135
This is a Shopping Cart Application

Removed the java project and have added a laravel project called Aristocart.  Steps to set this up:

Install the latest version of xampp on either your computer or VM.  I just did it on my computer.

When it has finished installing, you will need to clone this repo into the root of the installation directory of xampp.  (There should be a folder called htdocs in this directory as well.)  

Copy everything from the htdocs folder into the new repo folder, and rename this folder htdocs, replacing the old htdocs folder.  You will want to git ignore all of these files except for the Aristocart directory.

From the xampp control panel, start apache and go to localhost/Aristocart/public, and you should get the laravel welcome page.  (You can edit the xampp apache httpd config file to point straight to the Aristocart/public directory so that you can just type localhost instead of adding the "Aristocart/public").