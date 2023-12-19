@extends('layouts.layout')

@section('content')


    <div class="w-50 p-2" style="margin-left: auto; margin-right: auto; margin-top: 100px">


        <div class="d-flex justify-content-between">
            <h2>User: {{$user->username}}</h2>
            <h2>Score: {{$user->score()}}</h2>
        </div>

        <form action="{{route('generateNewLink', ['link' => $user->link->link])}}" method="post" class="border border-primary p-1" class="row g-3">
            <div class="col-auto">

                @if($user->link->status == 0)
                    <div>
                        <h4 class="border border-danger">Link not active</h4>
                    </div>
                @endif
                <p>Your link: <p>{{str_replace(['/history', '/imfeelinglucky'], '', url()->current())}}</p> </p>
            </div>
            <div class="col-auto">
                <label for="inputPassword2" class="visually-hidden"></label>
                <input hidden type="text" name="user_id" value="{{$user->id}}" class="form-control" id="inputPassword2" placeholder="Password">
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary mb-3">Generate new link</button>
            </div>
            @csrf
        </form>

        <form action="{{route('deactivate', ['link' => $user->link->link])}}" method="post" class="row g-3 border border-primary p-1 mt-3">
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
            <form action="{{route('history', ['link' => $user->link->link])}}" method="post">
                <button type="submit" class="btn btn-secondary btn-lg">HISTORY</button>
                @csrf
            </form>

            @if(isset($games))
                <div class="m-3">
                    @foreach($games as $game)
                        <div class="card text-center">
                            <div class="card-header {{$game->sum ? 'bg-success' : 'bg-danger'}}">
                            </div>
                            <div class="card-body">
                                <h4 class="card-title">{{$game->result}}</h4>
                                <h4 class="card-title">{{$game->sum ? 'Win' : 'Lose'}}</h4>
                                <h4 class="card-title">{{$game->sum}}</h4>
                            </div>
                            <div class="card-footer text-muted {{$game->sum ? 'bg-success' : 'bg-danger'}}">
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <div class="border border-primary p-1 mt-3">
            <form action="{{route('imfeelinglucky', ['link' => $user->link->link])}}" method="post">
                <button type="submit" {{$user->link->status == 0 ? 'disabled' : ''}} class="btn btn-success btn-lg imfeelinglucky">Imfeelinglucky</button>
                @csrf
            </form>

            @if(isset($data))
                <div class="m-3">
                    <div class="card text-center">
                        <div class="card-header {{$data['win_lose'] ? 'bg-danger' : 'bg-success'}}">

                        </div>
                        <div class="card-body">
                            <h4 class="card-title">{{$data['result']}}</h4>
                            <h4 class="card-title">{{$data['win_lose'] ? 'Lose' : 'Win'}}</h4>
                            <h4 class="card-title">{{$data['win_lose'] ? '' : 'Yout price: '. $data['prise']}}</h4>
                        </div>
                        <div class="card-footer text-muted {{$data['win_lose'] ? 'bg-danger' : 'bg-success'}}">

                        </div>
                    </div>
                </div>
            @endif
        </div>





{{--      <h1>{{$user->link->link}}</h1>--}}
    </div>

@endsection
