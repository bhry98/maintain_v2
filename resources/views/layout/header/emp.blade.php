<header class="navbar navbar-expand-md navbar-light d-print-none">
    <div class="container-xl">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
            <a>
                <img src="{{ url('imgs/org/icon.jpg') }}" width="110" height="32" alt="{{ $Sys['App_Name'] }}"
                    class="navbar-brand-image">
            </a>
        </h1>
        <div class="navbar-nav flex-row order-md-last">
            <div class="nav-item d-none d-md-flex me-3">
                <div class="btn-list">

                </div>
            </div>
            <div class="d-none d-md-flex">
                {{-- @can('noti-sys')
                    @livewire('noti.emp.task')
                @endcan --}}
                @can('noti-task')
                    @livewire('noti.emp.task')
                @endcan
                @can('noti-sys')
                    @livewire('noti.emp.sys')
                @endcan
                {{-- <emp-noti-task not="{{ $User->work_shop_id }}" local="{{ $Local }}"></emp-noti-task>
                <emp-noti local="{{ $Local }}" not="{{ $User->id }}"></cli-noti> --}}
            </div>
            <div class="nav-item dropdown">
                <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown"
                    aria-label="Open user menu">
                    <span class="avatar avatar-sm" style="background-image: url({{ url('/imgs/Users/user.svg') }})">
                    </span>
                    <div class="d-none d-xl-block ps-2">
                        <div>
                            {{ $User->name }}
                        </div>
                        <div class="mt-1 small text-muted">
                            {{ $User->code == null ? __('app.errors.NF') : $User->code }}
                        </div>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('emp.auth.Logout') }}" class="text-danger dropdown-item">
                        {{ __('app.auth.Logout') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</header>
