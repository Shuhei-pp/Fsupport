# README　　
  
# アプリケーション概要　　
エリア別に3時間ごとに釣果指数を表示するアプリケーション。  
釣果投稿機能もあります。  
  
#　使用技術  
> PHP version:8.0.10  
> Laravel version:8.51.0  

# 環境構築手順

( *dockerは入っている前提です。* 入ってない場合はダウンロード →https://www.docker.com/)

$ git clone  
↓  
$ docker-compose build 　                  # コンテナをビルド  
↓  
$ docker-compose -d up   　　　　　　　　　　 # コンテナの一斉起動  
↓  
$ docker-compose run app composer install # composer install  
↓  
$ docker-compose run app php artisan migrate　# マイグレーション  
  
# dbにデータをダンプ  
$ docker exec -it database_container bash  
↓  
$ mysql -u phper -ppassword laravel_local < /tmp/dmp.sql  
↓  
$ exit  

# 命名規則　　  
命名規則にはコーディング規約PSRを使用します。  

>クラス名:パスカルケース  
>クラス定数:コンタクトケース  
>関数:キャメルケース  
>それ以外の変数:スネークケース
  
```
class ClassName
{
  const TEST_STRING = 1;
  public function testMethod{
    $test_id = 10;
    echo $test_id;
  }
}
```

# 参考にしたサイト

https://qiita.com/ucan-lab/items/56c9dc3cf2e6762672f4  

# リンク　　
>Home  
>http://localhost:8080/  
  
>メールボックス  
http://localhost:8025/  


# コマンド集

>ログ表示  
>$ docker compose logs -f 　

>コンテナ初期化  
>$ docker-compose down --rmi all --volumes --remove-orphans  
  
> PHPStanによる静的解析  
> (appコンテナ内)  
> $ vendor/bin/phpstan analyse 'file/dir' 

