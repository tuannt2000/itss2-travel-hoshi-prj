
{!! app('request')->input('query')? null : $places->links('user.pages.components.helper.paginate') !!}
@foreach ($places as $place)
    <div class="place-item">
        <a href="{{route('user.place.index', ['place' => urlencode($place->name)])}}" class="image-container place-item__img">
            <img class="img-fluid" src="{{ count($place->placeImages) ? asset('storage/' . $place->placeImages[0]->file_path) : '' }} " alt="no file">
        </a>
        <div class="place-item-content">
            <div class="d-flex">
                <a href="{{route('user.place.index', ['place' => urlencode($place->name)])}}"><h5 class="place-item-content__title mr-3">{{ $place->name }}</h5></a>
                <div class="place-item-content__like">
                    <i class="fas fa-heart"></i>
                    <span>{{ $place->countLikes() }}</span>
                </div>
                <a href="{{route('user.place.edit', ['id' => $place->id])}}" class="icon-edit d-none" data-toggle="tooltip" data-placement="bottom" title="Update">
                    <i class="fa fa-edit"></i>
                </a>
            </div>
            <div class="place-item-content__address mb-2">
                <i class="fas fa-map-marker-alt"></i>
                <span>{{ $place->address }}</span>
            </div>
            <p class="place-item-content__desc">{{ $place->content }}</p>
        </div>
    </div>
@endforeach
{!! app('request')->input('query')? null : $places->links('user.pages.components.helper.paginate') !!}
