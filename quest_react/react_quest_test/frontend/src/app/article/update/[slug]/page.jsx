"use client";
// import ArticleForm from "../../../components/Form";
import { useParams } from "next/navigation";
import React, { useEffect, useState } from "react";
import { useRouter } from "next/navigation";

const UpdateArticle = () => {
    const params = useParams();
    const { slug } = params;
    const [article, setArticle] = useState(null);
    const [title, setTitle] = useState("");
    const [description, setDescription] = useState("");
    const [body, setBody] = useState("");
    const [tags, setTagList] = useState([]);
    const router = useRouter();

    useEffect(() => {
        const fetchArticle = async () => {
            const response = await fetch(`http://localhost:6060/api/articles/${slug}`);
            const data = await response.json();
            setArticle(data.article);
            // フェッチした記事データを用いてステートを更新
            setTitle(data.article.title);
            setDescription(data.article.description);
            setBody(data.article.body);
            setTagList(data.article.tagList.join(","));
        };

        fetchArticle();
    }, [slug]);

    const publishArticle = async (e) => {
        e.preventDefault();

        const articleData = {
            title,
            description,
            body,
            tags,
        };

        try {
            const token = localStorage.getItem("token");
            const res = await fetch(`http://localhost:6060/api/articles/${slug}`, {
                method: "PUT",
                headers: {
                    "Content-Type": "application/json",
                    "X-Requested-With": "XMLHttpRequest",
                    Authorization: `Bearer ${token}`,
                },
                body: JSON.stringify(articleData),
            });

            router.replace("/");
        } catch (error) {
            console.log("Error", error.message);
        }
    };

    if (!article) {
        return <div>Loading...</div>;
    }
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
                                    {console.log(tags)}
                                    <input type="text" className="form-control" placeholder="Enter tags" value={tags} onChange={(event) => setTagList(event.target.value)} />
                                    <div className="tag-list">
                                        {tags.split(",").map((tag, index) => (
                                            <span key={index} className="tag-default tag-pill">
                                                {tag.trim()}
                                            </span>
                                        ))}
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

export default UpdateArticle;
