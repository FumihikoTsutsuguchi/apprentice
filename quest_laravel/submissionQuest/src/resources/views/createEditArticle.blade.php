@extends('template')

@section('title','記事編集ページ')
@section('description','記事を編集することができるページです')
@include('head')

@section('content')

    <div class="editor-page">
        <div class="container page">
            <div class="row">
                <div class="col-md-10 offset-md-1 col-xs-12">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
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
                                <input type="text" name="tags" class="form-control" placeholder="Enter tags" />
                                <div class="tag-list"></div>
                                <input type="hidden" name="tag_list" id="tag_list" />
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

<script>
    // タグを追加する処理
    const tagInput = document.querySelector('input[name="tags"]');
    const tagList = document.querySelector('.tag-list');
    const tagListInput = document.querySelector('#tag_list');

    tagInput.addEventListener('keypress', function (e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            const tag = tagInput.value.trim();
            if (tag !== '') {
                const tagElement = document.createElement('span');
                tagElement.className = 'tag-default tag-pill';
                tagElement.innerHTML = `<i class="ion-close-round"></i> ${tag}`;
                tagList.appendChild(tagElement);
                // タグ情報を隠しフィールドに追加
                const tagListValue = tagListInput.value === '' ? tag : tagListInput.value + ',' + tag;
                tagListInput.value = tagListValue;
                tagInput.value = '';
            }
        }
    });
</script>

@endsection
