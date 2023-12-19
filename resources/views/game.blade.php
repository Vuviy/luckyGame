@extends('layouts.layout')

@section('content')


    <div class="w-50 p-2" style="margin-left: auto; margin-right: auto; margin-top: 100px">

{{--        <form>--}}
{{--            <div class="mb-3">--}}
{{--                <label for="exampleInputEmail1" class="form-label">Generate new link</label>--}}
{{--                <input hidden type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">--}}
{{--                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>--}}
{{--            </div>--}}
{{--            <button type="submit" class="btn btn-primary">Submit</button>--}}
{{--        </form>--}}

        <form class="border border-primary p-1" class="row g-3">
            <div class="col-auto">

                <h5>Your link: <h4>{{'site.com/game/'. $user->link->link}}</h4> </h5>
            </div>
            <div class="col-auto">
                <label for="inputPassword2" class="visually-hidden"></label>
                <input hidden type="text" class="form-control" id="inputPassword2" placeholder="Password">
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary mb-3">Generate new link</button>
            </div>
        </form>

        <form action="{{route('deactivate', ['link' => $user->link->link])}}" method="post" class="row g-3 border border-primary p-1 mt-3">
            <div class="col-auto">

                <h5>Your link: <h4>{{'site.com/game/'. $user->link->link}}</h4> </h5>
            </div>
            <div class="col-auto">
                <label for="inputPassword2" class="visually-hidden"></label>
                <input hidden type="text" name="user_id" value="{{$user->id}}" class="form-control" id="inputPassword2" placeholder="Password">
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-danger mb-3">Deactivate link</button>
            </div>
            @csrf
        </form>

        <div class="border border-primary p-1 mt-3">
            <button type="button" class="btn btn-secondary btn-lg">HISTORY</button>
        </div>

        <div class="border border-primary p-1 mt-3">
            <button type="button" class="btn btn-success btn-lg">Imfeelinglucky</button>
        </div>





{{--      <h1>{{$user->link->link}}</h1>--}}
    </div>

@endsection
