"use client"

import LoginLinks from '@/app/LoginLinks'
import { useState } from 'react'
import axios from '@/lib/axios';

const Editor = () => {
    const [title, setTitle] = useState('')
    const [description, setDescription] = useState('')
    const [body, setBody] = useState('')
    const [tags, setTags] = useState('')


    const publishArticle = async () => {
        try {
            // 記事データの構造を修正
            const articleData = {
                article: {
                    title,
                    description,
                    body,
                    tagList: tags.split(',').map(tag => tag.trim()), // タグを配列に変換
                },
            };
            console.log(articleData); // 送信データを確認

            // axiosインスタンスを使用してPOSTリクエストを送信
            const response = await axios.post('/api/articles', articleData);

            console.log(response.data);
            // 成功時の処理（例：投稿後のリダイレクトなど）
        } catch (error) {
            console.error('Error publishing article:', error);
            if (error.response && error.response.data.errors) {
                // エラーメッセージをstateにセット
                setErrors(Object.entries(error.response.data.errors).map(([key, value]) => `${key} ${value.join(", ")}`));
            }
        }
    };


    return (
        <>
            <div className="editor-page">
                <LoginLinks />
                <div className="container page">
                    <div className="row">
                        <div className="col-md-10 offset-md-1 col-xs-12">
                            <ul className="error-messages">
                                {/* エラーメッセージが表示される場合はここに追加 */}
                            </ul>
                            <form>
                                <fieldset>
                                    <fieldset className="form-group">
                                        <input
                                            type="text"
                                            className="form-control form-control-lg"
                                            placeholder="Article Title"
                                            value={title}
                                            onChange={(e) => setTitle(e.target.value)}
                                        />
                                    </fieldset>
                                    <fieldset className="form-group">
                                        <input
                                            type="text"
                                            className="form-control"
                                            placeholder="What's this article about?"
                                            value={description}
                                            onChange={(e) => setDescription(e.target.value)}
                                        />
                                    </fieldset>
                                    <fieldset className="form-group">
                                        <textarea
                                            className="form-control"
                                            rows={8}
                                            placeholder="Write your article (in markdown)"
                                            value={body}
                                            onChange={(e) => setBody(e.target.value)}
                                        />
                                    </fieldset>
                                    <fieldset className="form-group">
                                        <input
                                            type="text"
                                            className="form-control"
                                            placeholder="Enter tags"
                                            value={tags}
                                            onChange={(e) => setTags(e.target.value)}
                                        />
                                        {/* タグリスト表示は必要に応じて追加 */}
                                    </fieldset>
                                    <button
                                        className="btn btn-lg pull-xs-right btn-primary"
                                        type="button"
                                        onClick={publishArticle}
                                    >
                                        Publish Article
                                    </button>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </>
    )
}

export default Editor
