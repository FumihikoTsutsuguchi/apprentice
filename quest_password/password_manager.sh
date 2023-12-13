#!/bin/bash

#==================================================================
# パスワードマネージャーの処理
#==================================================================

# パスワード情報を保存するファイル
PASSWORD_FILE="passwords_db.txt" # 一時保管ファイル
PASSWORD_FILE_CODE="passwords_db.txt.gpg" # 暗号化後のファイル

echo "パスワードマネージャーへようこそ！"

while [ "$firstSelected" != "Exit" ]
do
    echo "次の選択肢から入力してください(Add Password/Get Password/Exit)："
    read firstSelected

    # Add Password が入力された場合
    if [ "$firstSelected" = "Add Password" ]; then
        echo "サービス名を入力してください："
        read serviceAdd
        echo "ユーザー名を入力してください："
        read userAdd
        echo "パスワードを入力してください："
        read passwordAdd
        echo "パスワードの追加は成功しました。"
        # 入力された情報をファイルに追記
        echo "$serviceAdd:$userAdd:$passwordAdd" >> "$PASSWORD_FILE"

        # ファイルの暗号化
        gpg -c --yes "$PASSWORD_FILE"

    # Get Password が入力された場合
    elif [ "$firstSelected" = "Get Password" ]; then
        echo "サービス名を入力してください："
        read serviceDb

        # ファイルの複合化
        gpg --yes "$PASSWORD_FILE_CODE"

        if grep -q "$serviceDb" "$PASSWORD_FILE"; then
            result=$(grep "$serviceDb" "$PASSWORD_FILE") # 該当のデータ

            # 実行前の IFS の値を一時避難
            OLD_IFS=$IFS

            IFS=":"
            read -ra parts <<< "$result" # 区切り文字「:」で分割し、配列に格納

            for index in "${!parts[@]}"; do
                case $index in
                    0) echo "サービス名：${parts[index]}" ;;
                    1) echo "ユーザー名：${parts[index]}" ;;
                    2) echo "パスワード：${parts[index]}" ;;
                    *) ;; # 未知のインデックスに対する処理
                esac
            done

            # 実行前の IFS の状態に戻す
            IFS=$OLD_IFS
        else
            echo "そのサービスは登録されていません。"
        fi
    # 最初の選択肢の入力が間違っていた場合
    elif [ "$firstSelected" != "Exit" ]; then
        echo "入力が間違えています。Add Password/Get Password/Exit から入力してください。"
    fi
done

# Exit が入力された場合
echo -e "Thank you\e[31m!\e[m"
# 一時保管ファイルを削除(情報の流出を防ぐ)
rm "$PASSWORD_FILE"
