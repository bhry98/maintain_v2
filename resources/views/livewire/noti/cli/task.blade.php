    <div wire:poll.1000ms dir="rtl" class="nav-item dropdown d-none d-md-flex me-3">
        <a href="#" class="nav-link px-0" data-bs-toggle="dropdown" tabindex="-1" aria-label="Show notifications">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-clipboard-typography"
                width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <path d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2"></path>
                <path d="M9 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z"></path>
                <path d="M9 12v-1h6v1"></path>
                <path d="M12 11v6"></path>
                <path d="M11 17h2"></path>
            </svg>
            <span class="badge bg-red">{{ count($task) }}</span>
        </a>
        <div wire:ignore.self class="dropdown-menu dropdown-menu-arrow dropdown-menu-end dropdown-menu-card">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        الطلبات
                    </h3>
                </div>
                <div class="list-group list-group-flush list-group-hoverable">
                    @if (count($task) > 0)
                        @foreach ($task as $t)
                            <div style="width: 350px" class="list-group-item">
                                <a href="{{ route('emp.task.Detail', $t->id) }}" style="text-decoration:none;">
                                    <div class="row align-items-center">
                                        <div class="col-auto"><span
                                                class="status-dot status-dot-animated bg-red d-block"></span>
                                        </div>
                                        <div class="col text-truncate">
                                            <p class="text-body d-block">
                                                {{ $t->tittle }}
                                            </p>
                                            <div class="d-block text-muted text-truncate mt-n1">
                                                {{ $t->details }}
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <p href="#" class="">
                                                {{ $t->id }}
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
