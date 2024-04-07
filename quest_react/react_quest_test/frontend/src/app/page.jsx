'use client'

import React from 'react';
import useSWR from 'swr';

// データ取得用のフェッチャー関数
const fetcher = (url) => fetch(url).then((res) => res.json());

export default function Home() {
    // useSWRフックを使用してデータを取得
    const { data, error } = useSWR('http://localhost:6060/api/articles', fetcher);

    if (error) return <div>Failed to load</div>;
    if (!data) return <div>Loading...</div>;

    return (
        <>
            <div className="home-page">
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
                            {data.articles.map((article) => (
                                <div className="article-preview" key={article.slug}>
                                    <div className="article-meta">
                                        <a href={`/profile/${article.author}`}>
                                            <img src="http://i.imgur.com/Qr71crq.jpg" />
                                        </a>
                                        <div className="info">
                                            <a href={`/profile/${article.author}`} className="author">
                                                {article.author}
                                            </a>
                                            <span className="date">{article.createdAt}</span>
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
                                            {article.tagList.map((tag, index) => (
                                                <li className="tag-default tag-pill tag-outline" key={index}>{tag}</li>
                                            ))}
                                        </ul>
                                    </a>
                                </div>
                            ))}
                            <ul className="pagination">
                                <li className="page-item active"><a className="page-link" href="">1</a></li>
                                <li className="page-item"><a className="page-link" href="">2</a></li>
                            </ul>
                        </div>
                        <div className="col-md-3">
                            <div className="sidebar">
                                <p>Popular Tags</p>
                                <div className="tag-list">
                                    {/* タグリスト */}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </>
    );
}
