# This project for the Google API(sheet api and gmail api)
### Created By Hemin S Patel
### contact info patelhemin1607@gmail.com   (+91)9979290148

### About project
This project for simple demo for google api you can send mail form this project and also you can create google sheet from this project, other operation with this google sheet

### How generate key  and how to run project
* create google account 
* create console google account 
* If you are opening the page for the first time then Updates to Terms of Service window prompt  appears, click on accept button.
* First you need to create a project by going to credentials tab and click on create button.
* Now enter name of the project and click on create button.
* Wait for few seconds to create project then select OAuth client ID by clicking on create credentials button.
* Click on configure consent screen, enter all the basic details and click on save button.
* After successfully done application type options will be enabled. Select web application option
* Enter name, your website URL and re-direct URL( you can change the URL later also).
 For now enter the re-direct URL as https://www.yourdomain.com/folder/file-name.php
 * Click on create button after filling all the details.
 * It will take few seconds to display your client ID and client secret (Note down the details).
 * Click on library tab in the left panel and search for Google plus.
 * Choose Google+ API option and click on enable button
* now you have CLIENTID and SECRETKEY add in config.php file
* Google Sign-In Button(now you need to run googlesign.php)
   * Google login open
   * need to select account id/password
   * accept app permission
   * after that you are back to your page(codetoaccessker.php) with code
* codetoaccessker.php in page you got REFRESH key and access key 
* copy REFRESH key and put in config.php file
* run createsheet.php file and create google sheet
  * copy sheet id and put in config.php file
* now run appendinsheet.php file for sheet api
  * now you can add data in sheet
  * you can see all data of sheet
  * you can clear data from shhet

* now for gmail api
  * run sendEmail.php pahe
  * you can sand mail 
  * you can see unread mail 


   
