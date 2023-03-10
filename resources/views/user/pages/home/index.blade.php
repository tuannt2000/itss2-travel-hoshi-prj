@php
    use App\Enums\Season;
@endphp

@extends('user.layout.page')

@section('title')
<title>Home</title>
@endsection

@section('header')
    @include('user.layout.header')
@endsection
<!-- end of header -->

@section('section')
@include('user.pages.components.helper.alert_4')
<!-- Intro -->
<div id="intro" class="basic-1">
    <form class="container user-place-search" action="">
        <div class="form-row mb-2 p-1">
            <div class="form-group col-md-4">
                <label for="address">Address</label>
                <input type="text" class="form-control" id="address" name="address" value="{{$address ?? ''}}" placeholder="Where do you want to go?">
            </div>
            <div class="form-group col-md-2">
                <label for="season">Month</label>
                <select id="month" name="month" class="form-control">
                    <option class="uppercase" value="0" >Month...</option>
                    @for ($i = 1; $i <= 12; $i++)
                        <option class="uppercase" value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>
            </div>
            <div class="form-group col-md-3">
                <label for="price">Price</label>
                <input type="text" class="form-control" id="price" name="price" value="{{$price ?? ''}}">
            </div>
            <div class="form-group col-md-2">
                <label for="season">Tags</label>
                <select id="tag" name="tag" class="form-control selectpicker" multiple data-live-search="true">
                    @foreach ($tags_select as $tag_select)
                        <option class="uppercase" value="{{ $tag_select->id }}">#{{ $tag_select->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-1 d-flex flex-column justify-content-end">
                <button type="submit" class="btn btn-primary">Search</button>
            </div>
        </div>
    </form>
    <div class="container place-list">
        <div class="row">
            <div class="col-md-8" id="tag_container">@include('user.pages.components.place.list')</div>
            <div class="col-md-4 shadow p-3 mb-5 bg-white rounded" style="height: fit-content">@include('user.pages.components.place.hot_place')</div>
        </div>
    </div> <!-- end of container -->

</div> <!-- end of basic-1 -->
<!-- end of intro -->

@include('user.pages.components.home.blog')
@endsection
