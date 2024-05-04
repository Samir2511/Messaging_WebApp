@extends("layouts.layout")

@section("content")

<div class="wrapper">
    <section class="form login">
        <header>Chat App</header>
        <form action="{{route("login")}}" method="POST" enctype="multipart/form-data" autocomplete="off">
            @csrf
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
{{--            <div class="class="alert alert-danger""></div>--}}
            <div class="field input">
                <label>Email Address</label>
                <input type="text" name="email" placeholder="Enter your email" >
            </div>
            <div class="field input">
                <label>Password</label>
                <input type="password" name="password" placeholder="Enter your password" >
                <i class="fas fa-eye"></i>
            </div>
            <div class="field button">
                <input type="submit" name="submit" value="Continue to Chat">
            </div>
        </form>
        <div class="link">Not yet signed up? <a href="{{route("register.create")}}">Signup now</a></div>
    </section>
</div>
@endsection

@section("scripts")
    <script src="{{asset("assets/javascript/pass-show-hide.js")}}"></script>
@endsection
