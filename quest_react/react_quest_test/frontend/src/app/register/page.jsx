"use client";

import React, { useState } from "react";

export default function Register() {
    const [username, setUsername] = useState("");
    const [email, setEmail] = useState("");
    const [password, setPassword] = useState("");
    const [errors, setErrors] = useState([]);

    const handleSubmit = async (e) => {
        e.preventDefault();

        const userData = {
            email,
            password,
            username,
        };

        // エラーをクリア
        setErrors([]);

        try {
            const res = await fetch("http://localhost:6060/api/users", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-Requested-With": "XMLHttpRequest",
                },
                body: JSON.stringify(userData),
            });


            // 登録後の処理（例：ユーザーをホームページにリダイレクトするなど）
        } catch (error) {
            if (error.res) {
                // サーバーからの応答本文をログに記録
                console.log(error.res.data);
                // ここでエラーメッセージを取り出してstateにセット
                if (error.res.data.errors) {
                    setErrors(Object.entries(error.res.data.errors).map(([key, value]) => `${key} ${value.join(", ")}`));
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
