# e-commerce
Aplikasi e-commerce menggunakan laravel

#Cara install aplikasi ini

1. Download dengan cara buka url https://github.com/taryono/e-commerce
2. Sebelah kanan atas ada tombo Clone or download kemudian pilih download zip
3. Jika sudah berhasil download extract zip taro folder e-commerce ini ke server local anda
4. Jika anda menggunakan xampp dan diinstall di C://xampp
5. Buka C://xampp/htcods dan taro project disitu dan buka phpmyadmin import olx.sql yang ada di folder database
6. Jika sudah berhasil import selanjutnya setting config dengan membuka file env.local dan edit

  APP_NAME='Handi Craft'
  APP_ENV=local
  APP_KEY=base64:dyaja3NhfcdFfaYqK5cy4hG2ts/Lh87sjN0v5Mm4H9Y=
  APP_DEBUG=true
  APP_LOG_LEVEL=debug
  APP_URL=http://localhost

  DB_CONNECTION=mysql
  DB_HOST=127.0.0.1
  DB_PORT=3306
  DB_DATABASE=olx
  DB_USERNAME=root  #<---------- user mysql sesuaikan dengan user mysql dikomputer kamu
  DB_PASSWORD=      #<---------- password mysql sesuaikan dengan password mysql dikomputer kamu

  BROADCAST_DRIVER=log
  CACHE_DRIVER=file
  SESSION_DRIVER=file
  QUEUE_DRIVER=sync
 7. install composer dengan cara download disini https://getcomposer.org/download/ klik tulisan yang warna biru Composer-Setup.exe jika sudah di install
 8. buka cmd dan ketik ini untuk masuk ke project kamu
  cd \xampp\htdocs\e-commerce
  setelah itu ketik 
  php artisan config:clear
  
 9. Jika belum berhasil maka hubungi saya,Terimakasih...



