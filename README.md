# e-commerce
Aplikasi e-commerce menggunakan laravel

**Cara install aplikasi ini**

1. Download dengan cara buka url https://github.com/taryono/e-commerce
2. Sebelah kanan atas ada tombol Clone or download kemudian pilih download zip
3. Jika sudah berhasil download extract zip taro folder e-commerce ini ke server local anda
4. Jika anda menggunakan xampp dan diinstall di C://xampp
5. Buka C://xampp/htdocs dan taro project disitu dan buka phpmyadmin import olx.sql yang ada di folder database
6. Jika sudah berhasil import selanjutnya setting config dengan membuka file env.local dan edit

+ 
  - APP_NAME='Handi Craft'\s\s
  - APP_ENV=local\s\s
  - APP_KEY=base64:dyaja3NhfcdFfaYqK5cy4hG2ts/Lh87sjN0v5Mm4H9Y=\s\s
  - APP_DEBUG=true\s\s
  - APP_LOG_LEVEL=debug\s\s
  - APP_URL=http://localhost\s\s

  - DB_CONNECTION=mysql\s\s
  - DB_HOST=127.0.0.1\s\s
  - DB_PORT=3306\s\s
  - DB_DATABASE=olx\s\s
  - DB_USERNAME=root  #<---------- user mysql sesuaikan dengan user mysql dikomputer kamu\s\s
  - DB_PASSWORD=      #<---------- password mysql sesuaikan dengan password mysql dikomputer kamu\s\s

  - BROADCAST_DRIVER=log\s\s
  - CACHE_DRIVER=file\s\s
  - SESSION_DRIVER=file\s\s
  - QUEUE_DRIVER=sync\s\s
 
 7. install composer dengan cara download disini https://getcomposer.org/download/ klik tulisan yang warna biru Composer-Setup.exe jika sudah di install
 8. buka cmd dan ketik ini untuk masuk ke project kamu
  cd \xampp\htdocs\e-commerce
  setelah itu ketik 
  php artisan config:clear
  
 9. Jika belum berhasil maka hubungi saya,Terimakasih...



