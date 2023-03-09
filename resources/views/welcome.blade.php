@extends('layout.auth')
@section('form')
    <center>
        <div class=" row row-deck row-cards">
            <a href="{{ route('cli.auth.ViewLogin') }}" class="col-sm-6 col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <img src="{{ url('imgs/Users/user.svg') }}" alt="Users" width="100px">
                        <div class="text-center">
                            User
                        </div>
                    </div>
                </div>
            </a>
            <a href="{{ route('emp.auth.ViewLogin') }}" class="col-sm-6 col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <img src="{{ url('imgs/Users/maintain.svg') }}" alt="Technical" width="100px">
                        <div class="text-center">
                            Technical
                        </div>
                    </div>
                </div>
            </a>

        </div>
    </center>
@endsection
