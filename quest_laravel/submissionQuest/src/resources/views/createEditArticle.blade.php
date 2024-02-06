@extends('template')

@section('title','記事編集ページ')
@section('description','記事を編集することができるページです')
@include('head')

@section('content')

    <div class="editor-page">
        <div class="container page">
            <div class="row">
                <div class="col-md-10 offset-md-1 col-xs-12">
                    <ul class="error-messages">
                        <li>That title is required</li>
                    </ul>

                    <form method="POST" action="/create-article">
                        @csrf
                        <fieldset>
                            <fieldset class="form-group">
                                <input type="text" name="title" class="form-control form-control-lg" placeholder="Article Title" />
                            </fieldset>
                            <fieldset class="form-group">
                                <input type="text" name="description" class="form-control" placeholder="What's this article about?" />
                            </fieldset>
                            <fieldset class="form-group">
                                <textarea
                                    name="body"
                                    class="form-control"
                                    rows="8"
                                    placeholder="Write your article (in markdown)"
                                ></textarea>
                            </fieldset>
                            <fieldset class="form-group">
                                <input type="text" class="form-control" placeholder="Enter tags" />
                                <div class="tag-list">
                                    <span class="tag-default tag-pill"> <i class="ion-close-round"></i> tag </span>
                                </div>
                            </fieldset>
                            <button name="create-article" class="btn btn-lg pull-xs-right btn-primary">
                            Publish Article
                            </button>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
