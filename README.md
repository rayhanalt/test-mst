<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Aplikasi test untuk PT Mitra Sinerji Teknoindo

## Cara Install
1. clone seperti biasa ke dalam folder
2. buka terminal didalam folder terkait jalankan perintah ( `composer install` dan `npm install` (opsional) )
3. ubah file .env.example menjadi .env
4. sesuaikan nama database antara .env dengan database local
5. jalankan perintah ```php artisan cache:clear``` dan ```php artisan config:clear```
6. jalankan perintah ```php artisan config:clear```
7. jalankan perintah ```php artisan key:generate```
8. jalankan perintah ```php artisan migrate --seed```
9. jalankan perintah ```php artisan serve```, lalu buka terminal lain untuk jalankan ```npm run dev``` (opsional)
10. username : admin , password : 12345
11. selamat mencoba.


## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
