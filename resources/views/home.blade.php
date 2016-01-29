@extends('layout')

@section('class', 'home')

@section('content')
    <div class="container">
        <h3>

        </h3>
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="panel ">
                    <a href="{{URL::to('personnel/')}}" class="btn btn-primary btn-lg btn-block">Liste des personnels</a>
                </div>
            </div>
        </div>

    </div>
@endsection
