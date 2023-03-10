@extends('user.layout.page')

@section('title')
<title>Place</title>
@endsection

@section('section')
<!-- Header -->
<header id="header" class="ex-header">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1> Create place </h1>
            </div> <!-- end of col -->
        </div> <!-- end of row -->
    </div> <!-- end of container -->
</header> <!-- end of ex-header -->
<!-- end of header -->

<div class="content place-form">
    <div class="container-fluid">
        @include('user.pages.components.helper.alert')
        <div class="row">
        <div class="card col-md-12">
            <div class="card-header">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h3 class="mb-0">{{__('Add Place')}}</h3>
                    </div>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('user.place.store') }}" autocomplete="off"
                        enctype="multipart/form-data">
                        @csrf

                        <div class="row pl-lg-4">
                            <div class="col-sm">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-name">
                                        <i class="w3-xxlarge fa fa-photo mr-1"></i>{{ __('Place Image or Video') }}
                                    </label>
                                    <div class="block-img">
                                        <img id="show-img" src="" />
                                        <video src="" class="d-none" id="show-video" controls></video>
                                    </div>
                                    <div class="text-center justify-content-center d-flex hide" id="load-images">
                                        <button type="button" style="cursor: pointer" class="btn-custom prev-btn mr-3">
                                            Prev
                                        </button>
                                        <button type="button" style="cursor: pointer" class="btn-custom next-btn">
                                            Next
                                        </button>
                                    </div>
                                    <input type="button" value="{{__('Choose image or Video')}}" id="choose-image" />
                                    <input type="button" value="{{__('Remove')}}" id="remove-image" class="hide"/>
                                    <input type="file" multiple accept="image/png, image/jpeg, video/mp4,video/x-m4v,video/*" class="form-control hide" id="image" name="file_path[]"/>
                                </div>
                            </div>

                            <div class="col-sm">
                                <div class="form-group">
                                    <label class="form-control-label" for="name"><i class="w3-xxlarge fa fa-map mr-1"></i>{{ __('Place Name') }}</label>
                                    <input type="text" name="name" id="name" class="form-control" placeholder="{{ __('Name...') }}" value="" required>
                                </div>

                                <div class="form-group">
                                    <label class="form-control-label" for="address"><i class="w3-xxlarge fa fa-map mr-1"></i>{{ __('Place Address') }}</label>
                                    <select type="text" name="address" id="address" class="form-control" value="" required> 
                                        @foreach ($addresses as $address)
                                            <option value="{{$address}}">{{$address}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label class="form-control-label" for="content"><i class="w3-xxlarge fa fa-map mr-1"></i>{{ __('Place Description') }}</label>
                                    <textarea name="content" style="border: 1px solid #ced4da; height: 200px" id="content" class="form-control" placeholder="{{ __('Description...') }}" value="" required></textarea>
                                </div>

                                <div class="form-group">
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalTag">
                                        Choose Tags
                                    </button>
                                </div>

                                <input type="hidden" id="tag" name="tag">
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary mt-4">{{ __('Save') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalTag" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tag</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="tag-main">
                    @foreach ($tags as $tag)
                    <div class="tag-label" data-value="{{$tag->id}}">#{{$tag->name}}</div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('css')
    <link rel="stylesheet" href="{{asset('assets/css/user/place/create_place.css')}}" />
@endsection

@section('js')
    <script src="{{asset('assets/js/user/place/create_place.js')}}"></script>
@endsection

