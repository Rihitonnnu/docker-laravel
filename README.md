# docker-laravel

## クローン
```
$ git clone git@github.com:Rihitonnnu/docker-laravel.git
```

## プロジェクトセットアップ
### ビルドとコンテナ起動
```
$ docker compose up -d
```

### envファイルコピー
```
$ cp .env.example .env
```

### コンテナに入る
```
$ docker compose exec php bash
```

### Composerインストール
```
$ composer install
```

### 認証キー作成
```
$ php artisan key:generate
```

### マイグレーション、シーディング
```
$ php artisan migrate:fresh --seed
```

## テスト環境セットアップ

### キャッシュクリア
```
$ php artisan config:clear
```
### 認証キー作成
```
$ php artisan key:generate --env=testing
```
### dbコンテナに入る
```
$ docker compose exec db bash
```
### MySQLにログイン(rootユーザー)
```
$ mysql -u root -p
```
### テスト用のデータベース作成
```
create database docker_laravel_test;
```
### DBの権限設定(pwはdocker)
```
grant all on docker_laravel_test.* to docker;
```
### マイグレート
```
php artisan migrate --env=testing
```

## Viteセットアップ
### npmインストール
```
$ npm install
```

### ビルド
```
#開発環境用
$ npm run dev

#本番環境用
$ npm run build
```


