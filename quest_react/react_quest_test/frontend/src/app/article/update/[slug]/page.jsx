'use client';
import ArticleForm from '../../../components/Form';
import { useParams } from 'next/navigation';
import React, { useEffect, useState } from 'react';


const UpdateArticle = () => {
  const params = useParams();
  const slug = params.slug;
  const [article, setArticle] = useState(null);

  useEffect(() => {
    const fetchArticle = async () => {
      const response = await fetch(`http://localhost:6060/api/articles/${slug}`);
      const data = await response.json();
      setArticle(data);
    };

    fetchArticle();
  }, [slug]);

  if (!article) {
    return <div>Loading...</div>;
  }

  {console.log(article);}
  return (
    <ArticleForm
      initialArticle={article.article}
      method="PUT"
      url={`http://localhost:6060/api/articles/${slug}`}
    />
  );
};

export default UpdateArticle;