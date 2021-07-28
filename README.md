<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>
API REST  napisane w Laravel
Baza: SQLite
Program napisany w Visual Studio Code. Do testowania API użyłem programu POSTMAN
Dodałem do projektu rozszerzenie SQLite w VSC
Adres serwera np: 127.0.0.1:8000

1. Administracja terminami

-Wyświetlanie wszystkich terminów
GET http://{adres_serwera}/api/appointments

-Dodawanie nowego terminu
Headers: KEY:Accept VALUE:application/json
Body: raw JSON 
{
    "booking_date": "2022-07-27 08:00",
    "description": "DESC"
}
POST http://{adres_serwera}/api/appointments

-Edycja terminu
Headers: KEY:Accept VALUE:application/json
Body: raw JSON 
{
    "booking_date": "2022-07-27 08:00",
    "description": "DESC"
}
PUT http://{adres_serwera}/api/appointments/{id_appointment}
{id_appointment} - id utworzonego terminu spotkania

-Usunięcie terminu
DELETE http://{adres_serwera}/api/appointments/{id_appointment}
{id_appointment} - id istniejącego terminu spotkania

-Wyświetlenie zarezerwowanych terminów
GET http://{adres_serwera}/api/status/unavailable

2. Rezerwacja terminu

-Wyświetlenie wszystkich dostępnych terminów
GET http://{adres_serwera}/api/status/available

-Rezerwacja wybranego terminu
GET http://{adres_serwera}/api/add/appointment/{id_appointment}/email/{adres_email}
{id_appointment} - id istniejącego terminu spotkania
{adres_email} - adres email osoby rezerwującej

-Odwołanie rezerwacji
GET http://{adres_serwera}/api/remove/appointment/{id_appointment}/email/{adres_email}
{id_appointment} - id istniejącego terminu spotkania
{adres_email} - adres email osoby rezerwującej konkretne id spotkania
