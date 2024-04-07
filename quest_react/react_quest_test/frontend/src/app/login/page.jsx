"use client";

import React, { useState } from "react";
import { useRouter } from 'next/navigation';

export default function Login() {
    const [email, setEmail] = useState("");
    const [password, setPassword] = useState("");
    const [errors, setErrors] = useState([]);
    const router = useRouter();

    const handleLogin = async (e) => {
        e.preventDefault();

        const loginData = {
            email,
            password,
        }

        try {
            const res = await fetch("http://localhost:6060/api/users/login", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-Requested-With": "XMLHttpRequest",
                },
                body: JSON.stringify(loginData),
            });

            if (res.ok) {
                const data = await res.json(); // レスポンスデータを取得
                localStorage.setItem('token', data.user.token); // 取得したトークンをlocalStorageに保存

                router.replace('/');
            } else {
                // エラーレスポンスの処理
                const errorData = await res.json();
                setErrors([errorData.message]);
            }

        } catch (error) {
            console.log("Error", error.message);
        }
    }

    return (
        <div className="auth-page">
            <div className="container page">
                <div className="row">
                    <div className="col-md-6 offset-md-3 col-xs-12">
                        <h1 className="text-xs-center">Sign in</h1>
                        <p className="text-xs-center">
                            <a href="/register">Need an account?</a>
                        </p>
                        {errors.length > 0 && (
                            <ul className="error-messages">
                                {errors.map((error, index) => (
                                    <li key={index}>{error}</li>
                                ))}
                            </ul>
                        )}
                        {/* <ul className="error-messages">
                            <li>That email is already taken</li>
                        </ul> */}
                        <form onSubmit={handleLogin}>
                            <fieldset className="form-group">
                                <input className="form-control form-control-lg" type="text" placeholder="Email" value={email} onChange={(e) => setEmail(e.target.value)}/>
                            </fieldset>
                            <fieldset className="form-group">
                                <input className="form-control form-control-lg" type="password" placeholder="Password" value={password} onChange={(e) => setPassword(e.target.value)}/>
                            </fieldset>
                            <button type="submit" className="btn btn-lg btn-primary pull-xs-right">Sign in</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    );
}
