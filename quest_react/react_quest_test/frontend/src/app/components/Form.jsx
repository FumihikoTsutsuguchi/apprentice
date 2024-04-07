"use client";
import React, { useState } from "react";
import { useRouter } from 'next/navigation';

const ArticleForm = ({ initialArticle, method, url }) => {
    const [title, setTitle] = useState(initialArticle.title);
    const [description, setDescription] = useState(initialArticle.description);
    const [body, setBody] = useState(initialArticle.body);
    const [tagList, setTagList] = useState(initialArticle.tagList);
    const router = useRouter();

    console.log(tagList)
    const publishArticle = async (e) => {
        e.preventDefault();

        const articleData = {
            title,
            description,
            body,
            tagList,
        }

        try {
            const token = localStorage.getItem('token');
            const res = await fetch(url, {
                method,
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

    };

    return (
        <div className="editor-page">
            <div className="container page">
                <div className="row">
                    <div className="col-md-10 offset-md-1 col-xs-12">
                        {/* <ul className="error-messages">
              <li></li>
            </ul> */}

                        <form onSubmit={publishArticle}>
                            <fieldset>
                                <fieldset className="form-group">
                                    <input type="text" className="form-control form-control-lg" placeholder="Article Title" value={title} onChange={(event) => setTitle(event.target.value)} />
                                </fieldset>
                                <fieldset className="form-group">
                                    <input type="text" className="form-control" placeholder="What's this article about?" value={description} onChange={(event) => setDescription(event.target.value)} />
                                </fieldset>
                                <fieldset className="form-group">
                                    <textarea className="form-control" rows="8" placeholder="Write your article (in markdown)" value={body} onChange={(event) => setBody(event.target.value)}></textarea>
                                </fieldset>
                                <fieldset className="form-group">
                                    <input type="text" className="form-control" placeholder="Enter tags" value={tagList} onChange={(event) => setTagList(event.target.value)} />
                                    <div className="tag-list">
                                        {/* {tagList.map((tag) => (
                                            <span key={tag} className="tag-default tag-pill">
                                                <i className="ion-close-round"></i> {tag}
                                            </span>
                                        ))} */}
                                    </div>
                                </fieldset>
                                <button className="btn btn-lg pull-xs-right btn-primary" type="submit">
                                    Publish Article
                                </button>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    );
};

export default ArticleForm;
