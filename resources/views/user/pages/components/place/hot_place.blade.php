<h3 class="mb-4 border-bottom border-header pb-2">Top địa điểm được yêu thích</h3>

@foreach ($places_hot as $place)
    <div class="place-item border-bottom pb-3">
        <a href="{{route('user.place.index', ['place' => urlencode($place->name)])}}" class="image-container place-item__img hot-place-link">
            @if (count($place->placeImages) && explode('/', $place->placeImages[0]->file_path)[0] == 'videos')
            <video autoplay loop class="img-fluid" src="{{ asset('storage/' . $place->placeImages[0]->file_path) }} "></video>
            @elseif (count($place->placeImages))
            <img class="img-fluid hot-place-img" src="{{ asset('storage/' . $place->placeImages[0]->file_path) }} " alt="no file" />
            @endif
        </a>
        <div class="place-item-content">
            <div class="d-flex">
                <a href="{{route('user.place.index', ['place' => urlencode($place->name)])}}"><h5 class="place-item-content__title mr-3 hot-place-title">{{ $place->name }}</h5></a>
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
            <p class="place-item-content__desc hot-place-content">{{ $place->content }}</p>
            <div class="rating d-flex align-items-center mb-2">
                <strong class="mr-2 mb-0 rating-title">Rating: </strong>
                <span class="rating-span">
                    {{ number_format($place->user_place_votes_avg_vote, 1) ?? 0 }}/
                    @for ($i = 0; $i < 5; $i++)
                        <i class="fas fa-star mr-1 d-inline-block checked"></i>
                    @endfor
                </span>
            </div>   
        </div>
    </div>
@endforeach
