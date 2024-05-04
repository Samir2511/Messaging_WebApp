@foreach($searchResults as $res)
    <a href="{{route("chat.show", $res['id'])}}">
        <div class="content">
            <img src="{{asset("storage/images/" . $res['image'])}}" alt="image">
            <div class="details">
                <span>{{$res['name']}}</span>
                <p>{{$res ? $res['last_message'] : 'No messages available'}}</p>
            </div>
        </div>
        <div class="status-dot {{$res['status']}}"><i class="fas fa-circle"></i></div>
    </a>
@endforeach
{{--<pre>--}}
{{--{{print_r($searchResults)}}--}}
{{--</pre>--}}
