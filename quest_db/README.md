# インターネットTV

## 概要
* インターネットのテレビ番組のようなデータベースを作成しました。
## 初期データ構築の手順
1. quest_dbディレクトリでdockerを起動する
```
$ docker compose up -d
```
2. dbコンテナに入る
```
$ docker compose exec db bash
```
3. mysqlへの接続(tvsデータベースを指定)
```
$ mysql -u root -p tvs
```
pass: password

4. テーブル構築・サンプルデータ
* この時点でdocker/db/init/tv.sqlのクエリが実行され、テーブル構築・サンプルデータの流し込みが完了します。
