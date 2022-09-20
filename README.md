# docker-laravel
## セットアップ
```
$ docker compose build
```

### コンテナ立ち上げ
```
$docker compose up -d
```

### Laravelアプリ作成
```
#docker compose up -dの後に実行
#コンテナに入る
$ docker compose exec php bash

#Laravelインストール
$ composer create-project laravel/laravel:^9 

#認証キー作成
$ php artisan key:migrate

#マイグレーション
$ php artisan migrate

