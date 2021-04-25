@if (Auth::id() != $micropost->user_id)
    @if (Auth::user()->is_favoriting($micropost->id))
        {{-- アンフォローボタンのフォーム --}}
        {!! Form::open(['route' => ['favorites.unfavorite', $micropost->id], 'method' => 'delete']) !!}
            {!! Form::submit('Unfavorite', ['class' => "btn btn-danger  col-2"]) !!}
        {!! Form::close() !!}
    @else
        {{-- フォローボタンのフォーム --}}
        {!! Form::open(['route' => ['favorites.favorite', $micropost->id]]) !!}
            {!! Form::submit('Favorite', ['class' => "btn btn-primary  col-2"]) !!}
        {!! Form::close() !!}
    @endif
@else 

        {!! Form::open(['route' => ['microposts.destroy', $micropost->id], 'method' => 'delete']) !!}
            {!! Form::submit('delete', ['class' => "btn btn-danger  col-2"]) !!}
        {!! Form::close() !!}
@endif