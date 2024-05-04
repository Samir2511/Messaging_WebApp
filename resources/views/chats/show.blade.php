@extends('layouts.layout')

@section("content")

<div class="wrapper">
    <section class="chat-area">
        <header>

            <a href="{{route("user.showUserHeader")}}" class="back-icon"><i class="fas fa-arrow-left"></i></a>
            <img src="{{asset('storage/images/' . $otherUser->image)}}" alt="">
            <div class="details">
                <span>{{$otherUser->name}}</span>
                <p>{{$otherUser->status}}</p>
            </div>
        </header>
        <div class="chat-box">

        </div>

        <form action="{{route("chat.store", $otherUser->id)}}" method="post" class="typing-area" id="myForm">
            @csrf
            <input type="text" name="message" class="input-field" id="in" placeholder="Type a message here..." autocomplete="off">
            <button type="submit"><i class="fab fa-telegram-plane"></i></button>

        </form>

    </section>
</div>

@endsection

@section("scripts")
<script>const chatStoreURI = "{{ route('chat.store', $otherUser->id) }}";</script>
<script>const chatRetrieveURI = "{{ route('chat.retrieve', $otherUser->id) }}";</script>
<script src="{{asset("assets/javascript/insert_chat.js")}}"></script>
<script src="{{asset("assets/javascript/get_chat.js")}}"></script>
@endsection
