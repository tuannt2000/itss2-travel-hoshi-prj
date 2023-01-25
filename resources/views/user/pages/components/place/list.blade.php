
{!! app('request')->input('query')? null : $places->links('user.pages.components.helper.paginate') !!}
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
                @if (Auth::user()->id == $place->user_id)
                <a href="{{route('user.place.edit', ['id' => $place->id])}}" class="icon-edit d-none" data-toggle="tooltip" data-placement="bottom" title="Update">
                    <i class="fa fa-edit"></i>
                </a>
                @endif
            </div>
            <div class="place-item-content__address mb-2">
                <i class="fas fa-map-marker-alt"></i>
                <span>{{ $place->address }}</span>
            </div>
            <div class="text-container rating d-flex align-items-center mb-2">
                <h5 class="mr-2 mb-0">Rating: </h5>
                <span class="mr-5">
                    {{ $place->getRating() ?? 0 }}/
                    @for ($i = 0; $i < 5; $i++)
                        <i class="fas fa-star mr-1 d-inline-block checked"></i>
                    @endfor
                </span>
            </div>   
            <p class="place-item-content__desc">{{ $place->content }}</p>
        </div>
    </div>
@endforeach
{!! app('request')->input('query')? null : $places->links('user.pages.components.helper.paginate') !!}
