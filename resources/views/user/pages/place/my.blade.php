@extends('user.layout.page')

@section('title')
<link rel="stylesheet" href="{{ asset('assets/css/user/place_custom.css') }}" />
<script type="module" src="https://cdn.jsdelivr.net/npm/emoji-picker-element@^1/index.js"></script>
<title>My place</title>
@endsection

@section('section')
<!-- Header -->
<header id="header" class="ex-header">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1> My place </h1>
            </div> <!-- end of col -->
        </div> <!-- end of row -->
    </div> <!-- end of container -->
</header> <!-- end of ex-header -->
<!-- end of header -->
@include('user.pages.components.helper.alert_4')
<div id="place" class="basic-1 pt-5">
    <div class="container place-list">
        @if ($places->count() != 0)
        @foreach ($places as $place)
            <div class="place-item">
                <a href="{{route('user.place.index', ['place' => urlencode($place->name)])}}" class="image-container place-item__img">
                    @if (count($place->placeImages) && explode('/', $place->placeImages[0]->file_path)[0] == 'videos')
                    <video autoplay loop class="img-fluid" src="{{ asset('storage/' . $place->placeImages[0]->file_path) }} "></video>
                    @elseif (count($place->placeImages))
                    <img class="img-fluid" src="{{ asset('storage/' . $place->placeImages[0]->file_path) }} " alt="no file" />
                    @endif
                </a>
            <div class="place-item-content">
            <div class="d-flex">
                <a href="{{route('user.place.index', ['place' => urlencode($place->name)])}}"><h5 class="place-item-content__title mr-3">{{ $place->name }}</h5></a>
                <div class="place-item-content__like">
                    <i class="fas fa-heart"></i>
                    <span>{{ $place->countLikes() }}</span>
                </div>
                {{-- @if (Auth::user()->id == $place->user_id)
                <a href="{{route('user.place.edit', ['id' => $place->id])}}" class="icon-edit d-none" data-toggle="tooltip" data-placement="bottom" title="Update">
                    <i class="fa fa-edit"></i>
                </a>
                @endif --}}
                @if (Auth::user()->id == $place->user_id)
                <a href="{{route('user.place.remove', $place)}}" class="icon-edit d-none" data-toggle="tooltip" data-placement="bottom" title="delete">
                    <i class="fa fa-minus-circle"></i>
                </a>
                @endif
            </div>
            <div class="place-item-content__address mb-2">
                <i class="fas fa-map-marker-alt"></i>
                <span>{{ $place->address }}</span>
            </div>
            <p class="place-item-content__desc">{{ $place->content }}</p>
            </div>
        </div>
        @endforeach
        @else
        <strong>Chưa có place nào</strong>
        @endif
    </div>
</div>

@endsection
