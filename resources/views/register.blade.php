@extends('layouts.layout')

@section('content')


    <div class="w-50 p-5" style="margin-left: auto; margin-right: auto">
        <form action="{{route('register')}}" method="post">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Username</label>
                <input type="text" name="username" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Phonenumber</label>
                <input type="number" name="phone_number" class="form-control" id="exampleInputPassword1">
            </div>
            <button type="submit" class="btn btn-primary">Register</button>
            @csrf
        </form>
    </div>

@endsection
