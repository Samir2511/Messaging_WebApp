@extends("layouts.layout")
@section('content')

@if($messages && count($messages) > 0)
    @foreach($messages as $msg)
        @if ($msg["sender"] == "You")
            <div class="chat outgoing">
                <div class="details">
                    <p>{{$msg['message']}}</p>
                </div>
            </div>
        @else
            <div class="chat incoming">
                <img src="{{asset('storage/images/' . $otherUser->image)}}" alt="">
                <div class="details">
                    <p> {{$msg['message']}} </p>
                </div>
            </div>

        @endif
    @endforeach
    @else
    <div class="text">No messages are available. Once you send a message, it will appear here.</div>
@endif

@endsection
