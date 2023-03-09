    <div wire:poll.1000ms dir="rtl" class="nav-item dropdown d-none d-md-flex me-3">
        <a href="#" class="nav-link px-0" data-bs-toggle="dropdown" tabindex="-1" aria-label="Show notifications">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-bell" width="24" height="24"
                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <path d="M10 5a2 2 0 0 1 4 0a7 7 0 0 1 4 6v3a4 4 0 0 0 2 3h-16a4 4 0 0 0 2 -3v-3a7 7 0 0 1 4 -6"></path>
                <path d="M9 17v1a3 3 0 0 0 6 0v-1"></path>
            </svg>
            <span class="badge bg-red">{{ count($noti) }}</span>
        </a>
        <div wire:ignore.self class="dropdown-menu dropdown-menu-arrow dropdown-menu-end dropdown-menu-card">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        الأشعارات
                    </h3>
                </div>
                <div class="list-group list-group-flush list-group-hoverable">
                    @if (count($noti) > 0)
                        @foreach ($noti as $n)
                            <div style="width: 350px" class="list-group-item">
                                <a href="{{ url($n->url) }}" wire:click='Show({{$n->id}})' style="text-decoration:none;">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <span class="status-dot status-dot-animated bg-red d-block"></span>
                                        </div>
                                        <div class="col text-truncate">
                                            <p class="text-body d-block">
                                                {{ $n->tittle }}
                                            </p>
                                            <div class="d-block text-muted text-truncate mt-n1">
                                                {{ $n->details }}
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <p href="#" class="">
                                                {{ $n->id }}
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    @else
                        <div class="list-group-item">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <p>
                                        {{ __('app.nav.noti.NF') }}
                                    </p>
                                </div>

                                {{-- <div class="col-auto"><span
                                        class="status-dot status-dot-animated bg-red d-block"></span>
                                </div>
                                <div class="col text-truncate">
                                    <a href="#" class="text-body d-block">Example 1</a>
                                    <div class="d-block text-muted text-truncate mt-n1">
                                        {{__("app.nav.noti.NF")}}
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
