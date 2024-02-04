<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function editArticle()
    {
        return view('editArticle');
    }

    public function article()
    {
        return view('article');
    }
}
