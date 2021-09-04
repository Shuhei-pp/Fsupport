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
  
# dbにデータをダンプ  
$ docker exec -it database_container bash  
↓  
$ mysql -u phper -ppassword laravel_local < /tmp/dmp.sql  
↓  
$ exit  


# 参考にしたサイト

https://qiita.com/ucan-lab/items/56c9dc3cf2e6762672f4  

# リンク　　
http://localhost:8080/  

# コマンド集

ログ表示  
$ docker-compose logs -f 　

コンテナ初期化  
$ docker-compose down --rmi all --volumes --remove-orphans

