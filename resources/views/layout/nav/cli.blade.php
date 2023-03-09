<div class="navbar-expand-md">
    <div class="collapse navbar-collapse" id="navbar-menu">
        <div class="navbar navbar-light">
            <div class="container-xl">
                <ul class="navbar-nav">
                    {{-- home --}}
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('cli.dash') }}">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <polyline points="5 12 3 12 12 3 21 12 19 12" />
                                    <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                                    <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" />
                                </svg>
                            </span>
                            <span class="nav-link-title">
                                {{ __('app.dash.P') }}
                            </span>
                        </a>
                    </li>
                    @can('mang-order')
                        <li class="nav-item  dropdown">
                            <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown"
                                data-bs-auto-close="outside" role="button" aria-expanded="false">
                                <span class="nav-link-icon d-md-none d-lg-inline-block">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-subtask"
                                        width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                        stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M6 9l6 0"></path>
                                        <path d="M4 5l4 0"></path>
                                        <path d="M6 5v11a1 1 0 0 0 1 1h5"></path>
                                        <path
                                            d="M12 7m0 1a1 1 0 0 1 1 -1h6a1 1 0 0 1 1 1v2a1 1 0 0 1 -1 1h-6a1 1 0 0 1 -1 -1z">
                                        </path>
                                        <path
                                            d="M12 15m0 1a1 1 0 0 1 1 -1h6a1 1 0 0 1 1 1v2a1 1 0 0 1 -1 1h-6a1 1 0 0 1 -1 -1z">
                                        </path>
                                    </svg>
                                </span>
                                <span class="nav-link-title">
                                    {{ __('app.nav.TaskP') }}
                                </span>
                            </a>
                            <div class="dropdown-menu">
                                <div dir="{{ __('app.HTML') }}" class="dropdown-menu-columns">
                                    <div class="dropdown-menu-column">
                                        @can('task-portal')
                                            <div class="dropend">
                                                <a class="dropdown-item " href="#Mang" data-bs-toggle="dropdown"
                                                    data-bs-auto-close="outside" role="button" aria-expanded="false">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="icon icon-tabler icon-tabler-circle-dot" width="24"
                                                        height="24" viewBox="0 0 24 24" stroke-width="2"
                                                        stroke="currentColor" fill="none" stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                        <circle cx="12" cy="12" r="1"></circle>
                                                        <circle cx="12" cy="12" r="9"></circle>
                                                    </svg>
                                                    &nbsp;
                                                    {{ __('app.task.Mang') }}
                                                </a>
                                                <div class="dropdown-menu">
                                                    @can('task-add')
                                                        <a class="dropdown-item " href="{{ route('cli.task.ViewAdd') }}">
                                                            {{ __('app.task.AddNew') }}
                                                        </a>
                                                    @endcan
                                                    @can('task-all')
                                                        <a class="dropdown-item " href="{{ route('cli.task.All') }}">
                                                            {{ __('app.task.All') }}
                                                        </a>
                                                    @endcan
                                                </div>
                                            </div>
                                        @endcan
                                    </div>
                                </div>
                            </div>
                        </li>
                    @endcan
                </ul>
            </div>
        </div>
    </div>
</div>
