# README　　
  
# アプリケーション概要　　
釣果を釣り人同士で共有することができ、もう一つ上の釣りを楽しむためのアプリケーションです。  
エリア詳細ページでは3時間ごとに釣果指数を見ることができ、この先24時間の海の様子を把握することが可能。  
  
# 使用技術  
> PHP  
> version:8.0.10  
  
> Laravel  
> version:8.51.0  

> Vue  
> version:2.6.12  

> Vue-router   
> version:3.5.2  

> docker  
> version:20.10.7

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
↓  
$ docker-compose run app npm run dev　# jsをコンパイル  

# テストアカウント

mail: testadmin@gmail.com  
Pass: zzzzzzzz

  
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

