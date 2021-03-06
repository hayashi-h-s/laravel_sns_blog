@php
    $title = __('User') . ': ' . $user->name;
@endphp
@extends('layouts.app')
@section('content')
    <div class="text-center mb-5">
        <h1>{{ $user->name }}</h1>
        <h1 class="display-5 mt-4">投稿記事一覧</h1>
    </div>

            @if(!isset($user->articles [0]))
                <div class="card mx-auto text-center container">
                    <div class="card-body">
                            まだ投稿していません。
                    </div>
                </div>
            @else
                @foreach ($user->articles as $article )
                    <div class="card mx-auto text-center container">
                        <div class="card-body">
                            <p>{{$article->created_at }}</p>
                            <h3><a href="{{ url('users/'.$article->user->id) }}">ユーザー名：{{ $article->user->name }}</a></h4>
                            <h4><a href="/articles/{{$article->id}}">タイトル：{{$article->title}}</a></h3>
                            <h5 class="mt-3"><a href="/articles/{{$article->id}}">[記事の詳細を表示]</a></h3>
                            @guest
                            @else
                                @if( ( $article->user_id ) === ( Auth::user()->id ))
									<a href="/articles/{{$article->id}}/edit" class="btn btn-info mb-2 mt-4 w-25">編集</a>
									<form action="/articles/{{$article->id}}" method="post">
									{{ csrf_field() }}
										<input type="hidden" name="_method" value="delete">
										<input type="submit" name="" value="削除" class="btn btn-primary w-25">
									</form>
                         	    @endif
                    		@endguest
						</div>
					</div>
                @endforeach
            @endif
@endsection
