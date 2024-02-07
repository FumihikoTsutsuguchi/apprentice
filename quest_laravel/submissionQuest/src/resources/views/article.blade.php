@extends('template')

@section('title','記事一覧ページ')
@section('description','conduitの記事一覧ページです')
@include('head')

@section('content')

    <div class="article-page">
        <div class="banner">
            <div class="container">
                <h1>{{$article->title}}</h1>
                <div class="article-meta">
                    <a href="/profile/eric-simons"><img src="http://i.imgur.com/Qr71crq.jpg" /></a>
                    <div class="info">
                        <a href="/profile/eric-simons" class="author">Eric Simons</a>
                        <span class="date">January 20th</span>
                    </div>
                    <button class="btn btn-sm btn-outline-secondary">
                        <i class="ion-plus-round"></i>
                        &nbsp; Follow Eric Simons <span class="counter">(10)</span>
                    </button>
                        &nbsp;&nbsp;
                    <button class="btn btn-sm btn-outline-primary">
                        <i class="ion-heart"></i>
                        &nbsp; Favorite Post <span class="counter">(29)</span>
                    </button>
                    <button class="btn btn-sm btn-outline-secondary">
                        <a href="/edit-article/{{$article->id}}">
                            <i class="ion-edit"></i> Edit Article
                        </a>
                    </button>
                    <form action="/delete/{{$article->id}}" method="post" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-outline-danger" onclick="return confirm('本当に削除していいですか?')">
                            <i class="ion-trash-a"></i> Delete Article
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="container page">
            <div class="row article-content">
                <div class="col-md-12">
                    <p>
                    {{$article->description}}
                    </p>
                    <!-- <h2 id="introducing-ionic">Introducing RealWorld.</h2> -->
                    <p>{{$article->body}}</p>
                    <ul class="tag-list">
                        @foreach($article->tags as $tag)
                            <li class="tag-default tag-pill tag-outline">{{$tag->name}}</li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <hr />

            <div class="article-actions">
                <div class="article-meta">
                    <a href="profile.html"><img src="http://i.imgur.com/Qr71crq.jpg" /></a>
                    <div class="info">
                        <a href="" class="author">Eric Simons</a>
                        <span class="date">January 20th</span>
                    </div>

                    <button class="btn btn-sm btn-outline-secondary">
                        <i class="ion-plus-round"></i>
                        &nbsp; Follow Eric Simons
                    </button>
                        &nbsp;
                    <button class="btn btn-sm btn-outline-primary">
                        <i class="ion-heart"></i>
                        &nbsp; Favorite Article <span class="counter">(29)</span>
                    </button>
                    <button class="btn btn-sm btn-outline-secondary">
                        <i class="ion-edit"></i> Edit Article
                    </button>
                    <button class="btn btn-sm btn-outline-danger">
                        <i class="ion-trash-a"></i> Delete Article
                    </button>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12 col-md-8 offset-md-2">
                    <form action="/articles/{{$article->id}}/comments" method="post" class="card comment-form">
                        @csrf
                        <div class="card-block">
                            <textarea name="body" id="comment-input" class="form-control" placeholder="Write a comment..." rows="3"></textarea>
                        </div>
                        <div class="card-footer">
                            <img src="http://i.imgur.com/Qr71crq.jpg" class="comment-author-img" />
                            <button type="submit" id="post-comment-btn" class="btn btn-sm btn-primary">Post Comment</button>
                        </div>
                    </form>
                    @if($comments)
                        @foreach($comments as $comment)
                            <div class="card">
                                <div class="card-block">
                                    <p class="card-text">{{ $comment->body }}</p>
                                </div>
                                <div class="card-footer">
                                    <? /*
                                    <a href="{{ $comment->author->profile_url }}" class="comment-author">
                                        <img src="{{ $comment->author->avatar }}" class="comment-author-img" />
                                    </a>
                                    */ ?>
                                    <a href="/profile/author" class="comment-author">
                                        <img src="http://i.imgur.com/Qr71crq.jpg" class="comment-author-img" />
                                    </a>
                                    &nbsp;
                                    <a href="/profile/jacob-schmidt" class="comment-author">Jacob Schmidt</a>
                                    <? /*
                                    <a href="{{ $comment->author->profile_url }}" class="comment-author">{{ $comment->author->name }}</a>
                                    */ ?>
                                    <span class="date-posted">{{ $comment->created_at->format('M dS') }}</span>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p>No comments yet.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection
