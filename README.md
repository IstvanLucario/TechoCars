# TechoCars
Esté proyecto contiene los servicios REST para consumir en la APP cliente ,
para su correcta aplicación debe instalar XAMP server y cambiar los puertos de:80 a :8089

cambiar puerto 80 a 8089 en el documento httpd.conf 
---- linea 57
#Listen 12.34.56.78:8089
---- linea 58
Listen 8089
 --- linea 215
ServerName localhost:8089
descomentar la linea ----149
LoadModule rewrite_module modules/mod_rewrite.so 

alojar la carpeta TechoCars en C:\xampp\htdocs e iniciar el servidor apache y mysql

Instalar BD
Abrir http://localhost:8089/phpmyadmin/ 
ir a la pestaña importar y cargar el archivo techoCars.sql

