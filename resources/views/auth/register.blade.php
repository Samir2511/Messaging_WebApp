@extends('layouts.layout')

@section('content')
    <div class="wrapper">
        <section class="form signup">
            <header>Chat App</header>
            <form action="{{route("register.store")}}" method="POST" enctype="multipart/form-data" autocomplete="off">
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
                    <div class="field input">
                        <label>Name</label>
                        <input type="text" name="name" placeholder="Name" value="{{ old('name') }}">
                    </div>
                <div class="field input">
                    <label>Email Address</label>
                    <input type="text" name="email" placeholder="Enter your email" value="{{ old('email') }}">
                </div>
                <div class="field input">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="Enter new password" value="{{ old('password') }}">
                    <i class="fas fa-eye"></i>
                </div>
                <div class="field image">
                    <label>Select Image</label>
                    <input type="file" name="image" value="{{ old('image') }}">
                </div>
                <div class="field button">
                    <input type="submit" name="submit" value="Continue to Chat">
                </div>
            </form>
            <div class="link">Already signed up? <a href="{{route("login")}}">Login now</a></div>
        </section>
    </div>
@endsection
{{--{{route("login.create")}}--}}
@section('scripts')
    <script src="{{asset("assets/javascript/pass-show-hide.js")}}"></script>
@endsection

