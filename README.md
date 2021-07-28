<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>
API REST  napisane w Laravel.</br>
Baza: SQLite.</br>
Program napisany w Visual Studio Code. Do testowania API użyłem programu POSTMAN.</br>
Dodałem do projektu rozszerzenie SQLite w VSC.</br>
API służy do rezerwowania wizyt.</br></br>
<b>1. Administracja terminami </br></b> 
-Wyświetlanie wszystkich terminów  </br>
-Dodawanie nowego terminu  </br>
-Edycja terminu  </br>
-Usunięcie terminu  </br>
-Wyświetlenie zarezerwowanych terminów  </br></br>
<b>2. Rezerwacja terminu </b> </br>
-Wyświetlenie wszystkich dostępnych terminów  </br>
-Rezerwacja wybranego terminu (przy rezerwacji powinno się podawać jakiś identyfikator typu email, PESEL, nr rejestracyjny)  </br>
-Odwołanie rezerwacji </br></br>
-------------------</br>
{adres_serwera} - np: 127.0.0.1:8000</br>
{id_appointment} - id istniejącego terminu spotkania</br>
{adres_email} - adres email osoby rezerwującej</br></br>

<b>1. Administracja terminami</b>

<b>-Wyświetlanie wszystkich terminów:</br></b>
GET http://{adres_serwera}/api/appointments

<b>-Dodawanie nowego terminu:</br></b>
Headers:</br> -KEY:Accept</br> -VALUE:application/json</br>
Body: raw JSON </br>
{</br>
    "booking_date": "2022-07-27 08:00",</br>
    "description": "DESC"</br>
}</br>
POST http://{adres_serwera}/api/appointments

<b>-Edycja terminu:</br></b>
Headers:</br> -KEY:Accept</br> -VALUE:application/json</br>
Body: raw JSON </br>
{</br>
    "booking_date": "2022-07-27 08:00",</br>
    "description": "DESC"</br>
}</br>
PUT http://{adres_serwera}/api/appointments/{id_appointment}</br>

<b>-Usunięcie terminu:</br></b>
DELETE http://{adres_serwera}/api/appointments/{id_appointment}</br>

<b>-Wyświetlenie zarezerwowanych terminów:</br></b>
GET http://{adres_serwera}/api/status/unavailable

<b>2. Rezerwacja terminu</b>

<b>-Wyświetlenie wszystkich dostępnych terminów:</br></b>
GET http://{adres_serwera}/api/status/available

<b>-Rezerwacja wybranego terminu</br></b>
GET http://{adres_serwera}/api/add/appointment/{id_appointment}/email/{adres_email}

<b>-Odwołanie rezerwacji:</br></b>
GET http://{adres_serwera}/api/remove/appointment/{id_appointment}/email/{adres_email}</br>

