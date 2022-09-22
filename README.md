# docker-laravel

## クローン
```
$ git clone -b develop git@github.com:Rihitonnnu/docker-laravel.git
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

### マイグレーション
```
$ php artisan migrate
```

### シード
```
$ php artisan migrate:fresh --seed
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

