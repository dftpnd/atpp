atpp
====
Установка на ПК:


1) git clone git@github.com:lkdnvc/atpp.git;

2) cd atpp;

4) mkdir uploads;sudo chmod ./uploads 777 -R

5) cd uploads;

5) mkdir avatar;sudo chmod ./avatar 777 -R

6) cd /atpp/protected/config/

7) cp exemple.main.php main.php

8) sudo nano main.php; 

   and edit line 73
   
   db' => array(
   
            'connectionString' => 'mysql:host=localhost;dbname=atpp',
            
            'emulatePrepare' => true,
            
            'username' => 'root',
            
            'password' => '',
            
            'charset' => 'utf8',
            
            'tablePrefix' => 'tbl_',
            
            'enableProfiling' => true,
            
            'enableParamLogging' => true,
            
  ),
  
9) create database atpp in /atpp/atpp.sql


Good luck!



http://atpp.in/

