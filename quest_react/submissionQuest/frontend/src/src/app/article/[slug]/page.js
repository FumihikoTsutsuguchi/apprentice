
"use client";

import { useEffect, useState } from 'react';
// import { fetchArticle } from 'path/to/your/api'; // APIから記事を取得する関数

import axios from 'axios';
export async function generateStaticParams() {
  const posts = await fetch('http://localhost:8080/api/articles/').then(res => res.json());
  return posts.map(post => ({ params: { slug: post.slug } }));
}

// 指定されたslugの記事データを取得する関数
export async function fetchArticle(slug) {
  try {
    const response = await axios.get(`http://localhost:8080/api/articles/${slug}`);
    return response.data; // 取得した記事データ
  } catch (error) {
    console.error('記事の取得中にエラーが発生しました:', error);
    throw error;
  }
}

const ArticlePage = ({ params }) => {
  const [article, setArticle] = useState(null);

  useEffect(() => {
    // 記事データをフェッチする
    if (params && params.slug) {
      fetchArticle(params.slug).then(setArticle);
    }
  }, [params.slug]);

    return (
        <>
            <div className="article-page">
                <LoginLinks />
                <div className="banner">
                    <div className="container">
                        <h1>{article.title}</h1>
                        <div className="article-meta">
                            <a href="/profile/eric-simons">
                                <img src="http://i.imgur.com/Qr71crq.jpg" />
                            </a>
                            <div className="info">
                                <a
                                    href="/profile/eric-simons"
                                    className="author">
                                    Eric Simons
                                </a>
                                <span className="date">January 20th</span>
                            </div>
                            <button className="btn btn-sm btn-outline-secondary">
                                <i className="ion-plus-round" />
                                &nbsp; Follow Eric Simons{' '}
                                <span className="counter">(10)</span>
                            </button>
                            &nbsp;&nbsp;
                            <button className="btn btn-sm btn-outline-primary">
                                <i className="ion-heart" />
                                &nbsp; Favorite Post{' '}
                                <span className="counter">(29)</span>
                            </button>
                            <button className="btn btn-sm btn-outline-secondary">
                                <i className="ion-edit" /> Edit Article
                            </button>
                            <button className="btn btn-sm btn-outline-danger">
                                <i className="ion-trash-a" /> Delete Article
                            </button>
                        </div>
                    </div>
                </div>
                <div className="container page">
                    <div className="row article-content">
                        <div className="col-md-12">
                            <p>
                                {article.description}
                            </p>
                            <p>
                                {article.body}
                            </p>
                            <ul className="tag-list">
                                {article.tagList.map(tag => (
                                    <li key={tag} className="tag-default tag-pill tag-outline">
                                        {tag}
                                    </li>
                                ))}
                            </ul>
                        </div>
                    </div>
                    <hr />
                    <div className="article-actions">
                        <div className="article-meta">
                            <a href="profile.html">
                                <img src="http://i.imgur.com/Qr71crq.jpg" />
                            </a>
                            <div className="info">
                                <a href="" className="author">
                                    Eric Simons
                                </a>
                                <span className="date">January 20th</span>
                            </div>
                            <button className="btn btn-sm btn-outline-secondary">
                                <i className="ion-plus-round" />
                                &nbsp; Follow Eric Simons
                            </button>
                            &nbsp;
                            <button className="btn btn-sm btn-outline-primary">
                                <i className="ion-heart" />
                                &nbsp; Favorite Article{' '}
                                <span className="counter">(29)</span>
                            </button>
                            <button className="btn btn-sm btn-outline-secondary">
                                <i className="ion-edit" /> Edit Article
                            </button>
                            <button className="btn btn-sm btn-outline-danger">
                                <i className="ion-trash-a" /> Delete Article
                            </button>
                        </div>
                    </div>
                    <div className="row">
                        <div className="col-xs-12 col-md-8 offset-md-2">
                            <form className="card comment-form">
                                <div className="card-block">
                                    <textarea
                                        className="form-control"
                                        placeholder="Write a comment..."
                                        rows={3}
                                        defaultValue={''}
                                    />
                                </div>
                                <div className="card-footer">
                                    <img
                                        src="http://i.imgur.com/Qr71crq.jpg"
                                        className="comment-author-img"
                                    />
                                    <button className="btn btn-sm btn-primary">
                                        Post Comment
                                    </button>
                                </div>
                            </form>
                            <div className="card">
                                <div className="card-block">
                                    <p className="card-text">
                                        With supporting text below as a natural
                                        lead-in to additional content.
                                    </p>
                                </div>
                                <div className="card-footer">
                                    <a
                                        href="/profile/author"
                                        className="comment-author">
                                        <img
                                            src="http://i.imgur.com/Qr71crq.jpg"
                                            className="comment-author-img"
                                        />
                                    </a>
                                    &nbsp;
                                    <a
                                        href="/profile/jacob-schmidt"
                                        className="comment-author">
                                        Jacob Schmidt
                                    </a>
                                    <span className="date-posted">
                                        Dec 29th
                                    </span>
                                </div>
                            </div>
                            <div className="card">
                                <div className="card-block">
                                    <p className="card-text">
                                        With supporting text below as a natural
                                        lead-in to additional content.
                                    </p>
                                </div>
                                <div className="card-footer">
                                    <a
                                        href="/profile/author"
                                        className="comment-author">
                                        <img
                                            src="http://i.imgur.com/Qr71crq.jpg"
                                            className="comment-author-img"
                                        />
                                    </a>
                                    &nbsp;
                                    <a
                                        href="/profile/jacob-schmidt"
                                        className="comment-author">
                                        Jacob Schmidt
                                    </a>
                                    <span className="date-posted">
                                        Dec 29th
                                    </span>
                                    <span className="mod-options">
                                        <i className="ion-trash-a" />
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </>
    )
}

export default ArticlePage
