@extends('layout.index')
@section('title')
    {{ __('app.pur.AddNew') }}
@endsection
@section('pagetitle')
    {{ __('app.pur.AddNew') }}
@endsection
@section('page')
    <div class="row row-cards">
        <div class="col-12">
            <form action="{{ route('emp.pur.Add') }}" method="post" class="card">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="row mb-3">
                            {{-- task --}}
                            <div class="col-6 mb-3">
                                <label class="form-label required">{{ __('app.pur.Task') }}</label>
                                <select type="text" name="task"
                                    class="form-control @error('task') is-invalid @enderror" id="select-emp">
                                    <option value="">...</option>
                                    @foreach ($task as $e)
                                        <option value="{{ $e->id }}">
                                            {{ $e->tittle }} |
                                            {{ $e->id }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('task')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- note --}}
                            <div class="col-6 mb-3">
                                <label class="form-label required">{{ __('app.pur.Note') }}</label>
                                <input type="text" name="note"
                                    class="form-control @error('note') is-invalid @enderror" value="{{ old('name') }}">
                                @error('note')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            @livewire('pur.emp.add-item')
                            <div class="col-2 mx-auto">
                                <button onclick="_submit()" id="btn" type="submit"
                                    class="btn btn-primary btn-pill w-100">
                                    {{ __('app.pur.Add') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{ url('assets/js/select.js') }}"></script>
    <script>
        // @formatter:off
        document.addEventListener("DOMContentLoaded", function() {
            var el;
            window.TomSelect && (new TomSelect(el = document.getElementById('select-emp'), {
                copyClassesToDropdown: false,
                dropdownClass: 'dropdown-menu ts-dropdown',
                optionClass: 'dropdown-item',
                controlInput: '<input>',
                render: {
                    item: function(data, escape) {
                        if (data.customProperties) {
                            return '<div><span class="dropdown-item-indicator">' + data
                                .customProperties + '</span>' + escape(data.text) + '</div>';
                        }
                        return '<div>' + escape(data.text) + '</div>';
                    },
                    option: function(data, escape) {
                        if (data.customProperties) {
                            return '<div><span class="dropdown-item-indicator">' + data
                                .customProperties + '</span>' + escape(data.text) + '</div>';
                        }
                        return '<div>' + escape(data.text) + '</div>';
                    },
                },
            }));
        });
        // @formatter:on
    </script>
@endsection
