"use client";

import React, { useState } from "react";
import axios from "axios";

export default function Register() {
    // ステートを使用してユーザー入力を管理
    const [username, setUsername] = useState("");
    const [email, setEmail] = useState("");
    const [password, setPassword] = useState("");
    const [errors, setErrors] = useState([]);


    // ユーザー登録を処理する関数
    const handleSubmit = async (e) => {
        e.preventDefault(); // フォームのデフォルトの送信を防ぐ
        // 送信データの構造を確認
        const userData = {
            user: { email, password, username }
        };

        // コンソールで送信データの構造を出力
        console.log(userData);
        // エラーをクリア
        setErrors([]);

        try {
            // APIにPOSTリクエストを送信
            const response = await axios.post("http://localhost:6060/api/users", {
                user: { email, password, username }
            });

            // 応答からユーザー情報を取得（ここで何かしらの認証処理を実行するかもしれません）
            console.log(response.data);

            // 登録後の処理（例：ユーザーをホームページにリダイレクトするなど）
        } catch (error) {
            if (error.response) {
                // サーバーからの応答本文をログに記録
                console.log(error.response.data);
                // ここでエラーメッセージを取り出してstateにセット
                if (error.response.data.errors) {
                    setErrors(Object.entries(error.response.data.errors).map(([key, value]) => `${key} ${value.join(", ")}`));
                }
            } else {
                // サーバーからの応答がない場合のエラー処理
                console.log("Error", error.message);
            }
        }
    };

    return (
        <div className="auth-page">
            <div className="container page">
                <div className="row">
                    <div className="col-md-6 offset-md-3 col-xs-12">
                        <h1 className="text-xs-center">Sign up</h1>
                        <p className="text-xs-center">
                            <a href="/login">Have an account?</a>
                        </p>
                        {errors.length > 0 && (
                            <ul className="error-messages">
                                {errors.map((error, index) => (
                                    <li key={index}>{error}</li>
                                ))}
                            </ul>
                        )}
                        <form onSubmit={handleSubmit}>
                            <fieldset className="form-group">
                                <input className="form-control form-control-lg" type="text" placeholder="Username" value={username} onChange={(e) => setUsername(e.target.value)} />
                            </fieldset>
                            <fieldset className="form-group">
                                <input className="form-control form-control-lg" type="text" placeholder="Email" value={email} onChange={(e) => setEmail(e.target.value)} />
                            </fieldset>
                            <fieldset className="form-group">
                                <input className="form-control form-control-lg" type="password" placeholder="Password" value={password} onChange={(e) => setPassword(e.target.value)} />
                            </fieldset>
                            <button type="submit" className="btn btn-lg btn-primary pull-xs-right">
                                Sign up
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    );
}
