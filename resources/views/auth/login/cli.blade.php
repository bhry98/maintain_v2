@extends('layout.auth')
@section('title')
    {{__("app.auth.Login")}}
@endsection
@section('form')

    <form class="card card-md" action="{{ route('cli.auth.Login') }}" method="POST" id="form">
        @csrf
        <div class="card-body">
            <h2 class="card-title text-center mb-4">{{ __('app.auth.Login') }}</h2>
            <div class="mb-3">
                <label class="form-label">{{ __('app.auth.Username') }}</label>
                <input type="text" name="username" class="form-control" placeholder="{{ __('app.auth.Username') }}">
                @error('username')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-2">
                <label class="form-label">{{ __('app.auth.Password') }} </label>
                <div class="input-group input-group-flat">
                    <input type="password" name="password" class="form-control" placeholder="*****">
                </div>
                @if (session()->has('password'))
                    <span class="text-danger">{{ __('app.auth.PassError') }}</span>
                @endif
                @error('password')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-footer">
                <button onclick="_submit(),form()" type="submit" id="btn" class="btn btn-primary w-100">
                    {{ __('app.auth.Login') }}
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-login" width="24"
                        height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2"></path>
                        <path d="M20 12h-13l3 -3m0 6l-3 -3"></path>
                    </svg>
                </button>
            </div>
            <br>
        </div>
    </form>
@endsection
@section('js')
    <script>
        form() {
            document.getElementById("form").submit();
        }
    </script>
@endsection
