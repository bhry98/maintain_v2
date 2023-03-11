@extends('layout.index')
@section('title')
    {{ __('app.role.Edit') }}
@endsection
@section('pagetitle')
    {{ __('app.role.Edit') }}
@endsection
@section('page')
    <form method="POST" action="{{ route('emp.role.Edit', $role->code) }}" class="row row-cards col-12 card">
        @csrf
        <div class="row mb-3 card-body">
            {{--  name[ar] --}}
            <div class="col-6 mb-3">
                <label class="form-label required">{{ __('app.role.N.Ar') }}</label>
                <input autofocus type="text" name="name[ar]" class="form-control @error('name.ar') is-invalid @enderror"
                    value="{{ $role->name['ar'] }}">
                @error('name.ar')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            {{--  name[en] --}}
            <div class="col-6 mb-3">
                <label class="form-label ">{{ __('app.role.N.En') }}</label>
                <input type="text" name="name[en]" class="form-control @error('name.en') is-invalid @enderror"
                    value="{{ $role->name['en'] }}">
                @error('name.ar')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            {{--  code --}}
            <div class="col-6 mb-3">
                <label class="form-label required">{{ __('app.role.Code') }}</label>
                <input type="text" name="code" class="form-control @error('code') is-invalid @enderror"
                    value="{{ $role->code }}">
                @error('code')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            {{--  note --}}
            <div class="col-6 mb-3">
                <label class="form-label ">{{ __('app.role.Note') }}</label>
                <input type="text" name="note" class="form-control @error('note') is-invalid @enderror"
                    value="{{ $role->note }}">
                @error('note')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-12 mb-3">
                <div class="form-label required">
                    {{ __('app.role.All') }}
                </div>
                @error('role')
                    <div class="alert alert-danger" role="alert">
                        {{ $message }}
                    </div>
                @enderror
                <div class="accordion" id="accordion-example">
                    @foreach (config('roles.Roles') as $k => $P)
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading-{{ $k }}">
                                <button class="accordion-button " type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse-{{ $k }}" aria-expanded="false">
                                    {{ __("roles.Names.$k") }}
                                </button>
                            </h2>
                            <div id="collapse-{{ $k }}" class="accordion-collapse collapse "
                                data-bs-parent="#accordion-example">
                                <div class="accordion-body pt-0">
                                    @foreach ($P as $kk => $name)
                                        <div class="col-3">
                                            <label class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" name="role[]"
                                                    value="{{ $k }}-{{ $kk }}"
                                                    @foreach ($role->permission as $v)  @if ($v == "$k-$kk") checked @endif @endforeach>
                                                <span class="form-check-label">{{ $name[$Local] }}</span>
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="text-center">
                <button id="btn" onclick="_submit()" type="submit" class=" col-2 btn btn-azure">
                    {{ __('app.role.Edit') }}
                </button>
            </div>
        </div>
    </form>
@endsection
