# パスワードマネージャー
シェルスクリプトで、パスワード管理ツールを作成しました。
## 機能
- サービス名/ユーザー名/パスワードの保存
- サービス名からパスワードを検索する機能
## 利用方法
1. GnuPGをインストール
    - 下記のコマンドでインストール
```
sudo apt install gnupg
```
2. password_manager.shをダウンロード
    - 本リポジトリからpassword_manager.shをダウンロードしてください
3. password_manager.shを実行
    - 下記コマンドを実行してください
```
./password_manager.sh
```
## 動作内容
- 次の選択肢から入力してください(Add Password/Get Password/Exit)
    - Add Password でサービス名/ユーザー名/パスワードの保存ができる
    - Get Passwordで保存ずみのサービス名を入力するとパスワードが表示される
    - 終了したい場合はExitで終了
- パスワードが保存されるファイル(passwords_db.txt.gpg)はGnuPGによって暗号化されます
