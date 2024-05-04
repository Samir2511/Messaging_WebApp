@extends("layouts.layout")


@section("content")
<div class="wrapper">
    <section class="users">
        <header>
            <div class="content">
                <img src="{{asset("storage/images/". $user['image'])}}" alt="image">
                <div class="details">
                    <span>{{$user['name']}}</span>
                    <p>{{$user['status']}}</p>
                </div>
            </div>
            <a
               href="{{ route('logout') }}"
               class="logout"
               onclick="event.preventDefault(); document.getElementById('logout-link').submit();"
            >
                Logout
            </a>

            <form id="logout-link" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>

        </header>
{{--        <form method="post" action="">--}}
        <div class="search">
            <span class="text">Select a user to start chat</span>
            <input type="text" placeholder="Enter name to search...">
            <button><i class="fas fa-search"></i></button>
        </div>
{{--        </form>--}}
        <div class="users-list">

        </div>
    </section>
</div>
@endsection

@section("scripts")
<script>const userSearchURI = "{{ route('user.search') }}";</script>
<script src="{{asset("assets/javascript/users.js")}}"></script>
@endsection
