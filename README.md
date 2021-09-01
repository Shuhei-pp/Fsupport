# README
# 環境構築手順

( *dockerは入っている前提です。* 入ってない場合はダウンロード →https://www.docker.com/)

$ git clone  
↓  
$ docker-compose build 　                  # コンテナをビルド  
↓  
$ docker-compose -d up   　　　　　　　　　　 # コンテナの一斉起動  
↓  
$ docker-compose run app composer install  
↓  
$ docker-compose run app php artisan migrate　# マイグレーション

# 参考にしたサイト

https://qiita.com/ucan-lab/items/56c9dc3cf2e6762672f4  
  
https://hsmt-web.com/blog/openweathermap-api/