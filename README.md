# docker-laravel

## クローン
```
$ git clone -b develop git@github.com:Rihitonnnu/docker-laravel.git
```

## セットアップ
### ビルド
```
$ docker compose build
```

### envファイルコピー
```
$ cp .env.example .env
```
### コンテナ起動
```
$ docker compose up -d
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

### マイグレーション
```
$ php artisan migrate
```

### シード
```
$ php artisan migrate:fresh --seed
```
## tailwindCSSセットアップ
### npmインストール
```
$ npm install
```

### npmビルド
```
$ npm run build
```

