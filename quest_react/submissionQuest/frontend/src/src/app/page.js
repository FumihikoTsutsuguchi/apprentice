"use client";

import { useEffect, useState } from 'react';
import LoginLinks from '@/app/LoginLinks';
import axios from '@/lib/axios'; // axiosのインスタンスが設定されたものを仮定

const Home = () => {
    // 記事データを保持するための状態
    const [articles, setArticles] = useState([]);

    useEffect(() => {
        // 記事データを取得する非同期関数
        const fetchArticles = async () => {
            try {
                const response = await axios.get('/api/articles');
                setArticles(response.data.articles); // 取得した記事データを状態にセット
            } catch (error) {
                console.error('Error fetching articles:', error);
            }
        };

        fetchArticles();
    }, []); // 依存配列を空にすることで、コンポーネントのマウント時にのみ実行

    return (
        <>
            <div className="home-page">
                <LoginLinks />
                <div className="banner">
                    <div className="container">
                        <h1 className="logo-font">conduit</h1>
                        <p>A place to share your knowledge.</p>
                    </div>
                </div>
                <div className="container page">
                    <div className="row">
                        <div className="col-md-9">
                            <div className="feed-toggle">
                                <ul className="nav nav-pills outline-active">
                                    <li className="nav-item">
                                        <a className="nav-link" href="">Your Feed</a>
                                    </li>
                                    <li className="nav-item">
                                        <a className="nav-link active" href="">Global Feed</a>
                                    </li>
                                </ul>
                            </div>
                            {/* 記事データをマップして表示 */}
                            {articles.map((article, index) => (
                                <div key={index} className="article-preview">
                                    <div className="article-meta">
                                        <a href="">
                                            <img src="http://i.imgur.com/Qr71crq.jpg" />
                                        </a>
                                        <div className="info">
                                            <a href="" className="author">
                                                Eric Simons
                                            </a>
                                            <span className="date">
                                                {new Date(article.createdAt).toLocaleDateString()}
                                            </span>
                                        </div>
                                        <button className="btn btn-outline-primary btn-sm pull-xs-right">
                                            <i className="ion-heart" /> {article.favoritesCount}
                                        </button>
                                    </div>
                                    <a href={`/article/${article.slug}`} className="preview-link">
                                        <h1>{article.title}</h1>
                                        <p>{article.description}</p>
                                        <span>Read more...</span>
                                        <ul className="tag-list">
                                            {article.tagList.map((tag, tagIndex) => (
                                                <li key={tagIndex} className="tag-default tag-pill tag-outline">
                                                    {tag}
                                                </li>
                                            ))}
                                        </ul>
                                    </a>
                                </div>
                            ))}
                        </div>
                        <div className="col-md-3">
                            {/* サイドバーのコンテンツ */}
                        </div>
                    </div>
                </div>
            </div>
        </>
    );
};

export default Home;
