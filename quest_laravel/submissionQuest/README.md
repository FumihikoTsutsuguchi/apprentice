# RealWorld 「Condit」

## はじめに
RealWorldで作られている「Condit」というMedium.comのクローンサイトの一部機能を作成しました。
* RealWorldリンク: <https://realworld-docs.netlify.app/docs/intro>
## 機能
* ログイン認証 (各アカウントのプロフィール編集は未完)
* 記事の投稿・編集・削除
* 各記事に対するコメント

## 使用技術
* バックエンド
    * Laravel
* フロントエンド
    * Blade

## 使用方法
ご利用のPCにNodeやComposerをインストールしなくても大丈夫です。
1. 本リポジトリをクローン
2. `docker compose up -d --build` を実行
3. `docker compose exec app bash` でappコンテに入る
4. `npm run dev`でViteを起動
5. ブラウザで`http://localhost:2020`にアクセス
