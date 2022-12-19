@extends('user.layout.page')

@section('title')
<link rel="stylesheet" href="{{ asset('assets/css/user/place_custom.css') }}" />
<script type="module" src="https://cdn.jsdelivr.net/npm/emoji-picker-element@^1/index.js"></script>
<title>My blog</title>
@endsection

@section('section')
<!-- Header -->
<header id="header" class="ex-header">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1> My blog </h1>
            </div> <!-- end of col -->
        </div> <!-- end of row -->
    </div> <!-- end of container -->
</header> <!-- end of ex-header -->
<!-- end of header -->

<div id="blog" class="basic-1 pt-5">
    <div class="container blog-list">
        @if (count($blogs))
        @foreach ($blogs as $blog)
        <div class="blog-item d-flex flex-column mb-5 mt-3">
            <div class="bookmark">
                <p>{{ date("d", strtotime($blog->created_at)) }}</p>
                <p>{{ date("M", strtotime($blog->created_at)) }}</p>
            </div>
            <div class="blog-item__header">
                <h3><a class="blog-item__title" href="{{route('user.blog.detail' , ['id' => $blog->id])}}">{{$blog->title}}</a></h3>
                <div class="blog-item__user mb-1">
                    <i class="fas fa-user-edit"></i>
                    <span>{{ $blog->user->name }}</span>
                    <i class="far fa-star ml-4"></i>
                    <span>4.6</span>
                    <i class="fas fa-heart ml-4"></i>
                    <span>30 likes</span>
                    <i class="fas fa-comment ml-4"></i>
                    <span>18 comments</span>
                </div>
            </div>
            @if (count($blog->blogImages))
            <div class="blog-item__img mt-3 mb-3">
                <img class="w-80" alt="no file" src="{{asset('storage/' . $blog->blogImages[0]->file_path)}}" />
            </div>
            @endif
            <p class="blog-item__content">{{$blog->content}}</p>
            <a href="{{route('user.blog.detail' , ['id' => $blog->id])}}" class="blog-item__readmore">
                <span>Read more</span>
                <i class="fas fa-angle-double-right"></i>
            </a>
        </div>
        @endforeach
        @else
        <strong>Chưa có blog nào</strong>
        @endif
    </div>
</div>

@endsection
