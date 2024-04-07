"use client";

import React, { useState } from "react";
import { useRouter } from 'next/navigation';

export default function Editor () {
    const [title, setTitle] = useState('');
    const [description, setDescription] = useState('');
    const [body, setBody] = useState('');
    const [tags, setTags] = useState('');
    const router = useRouter();

    const publishArticle = async (e) => {
        e.preventDefault();

        const articleData = {
            title,
            description,
            body,
            tags,
        }

        try {
            const token = localStorage.getItem('token');
            const res = await fetch("http://localhost:6060/api/articles", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-Requested-With": "XMLHttpRequest",
                    "Authorization": `Bearer ${token}`,
                },
                body: JSON.stringify(articleData),
            });

            router.replace('/')


        } catch (error) {
            console.log("Error", error.message);
        }

    }

    return (
        <>
            <div className="editor-page">
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
// import ArticleForm from '../components/Form';

// const Editor = () => {
//   const initialArticle = {
//     title: '',
//     description: '',
//     body: '',
//     tagList: '',
//   };

//   return (
//     <ArticleForm
//       initialArticle={initialArticle}
//       url="http://localhost:6060/api/articles"
//       method="POST"
//     />
//   );
// };

// export default Editor;