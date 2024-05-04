@foreach($lastMsgUser as $usr)
<a href="{{route("chat.show", $usr['id'])}}">
    <div class="content">
        <img src="{{asset("storage/images/" . $usr['image'])}}" alt="image">
        <div class="details">
            <span>{{$usr['name']}}</span>
            <p>{{!empty($usr['last_message']) ? $usr['last_message'] : 'No messages available' }}</p>
        </div>
    </div>
    <div class="status-dot {{$usr['status']}}"><i class="fas fa-circle"></i></div>
</a>
@endforeach
