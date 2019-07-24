# TestKLY
##### Muhammad Iqbal Rofikurrahman @ iqbalcakep.com :)
## Installation

Clone atau download file terlebih dahulu.
Buka terminal dan arahkan ke folder yang telah di download

ex :
```bash
cd /Downloads/testKLY
```
Perisapkan Database Kosong lalu rubah file .env sesuai koneksi database kosong yang telah di buat sebelumnya
![konfigurasi DB](http://thegadeareamalang.com/testgambar/db.png)

Jalankan perintah untuk migrasi dan mengisi data database

pastikan lokasi di dalam folder/project yang telah di clone
ex :
```bash
php artisan migrate
```
Lalu
```bash
php artisan db:seed
```

setelah semua selesai jalankan servis 

```bash
php artisan serve --port=8080
```
Servis akan berjalan di localhost dengan port 8080

berikut adalah hasil nya
![hasil test](http://thegadeareamalang.com/testgambar/hasil.png)

Note : apabaila perintah db:seed sukses maka login dapat dilakukan dengan username dan password "admin"

## Testing PHP Unit

Lakukan dengan perintah berikut 

```bash
vendor/bin/phpunit
```

![hasil test](http://thegadeareamalang.com/testgambar/testing.png)

SEMOGA BISA SESUAI HARAPAN.

Selesai.

ThankYou..

[https://scrutinizer-ci.com/g/iqbalcakep/testKLY/](https://scrutinizer-ci.com/g/iqbalcakep/testKLY/)


[http://testkly.herokuapp.com/](http://testkly.herokuapp.com/)