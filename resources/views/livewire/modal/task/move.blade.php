<div wire:ignore.self class="modal modal-blur fade" id="move-task" tabindex="-1" role="dialog"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    {{ __('app.task.ws.Move') }}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form wire:submit.prevent="MoveTask({{$task_}})">
                <div class="modal-body">
                    <div class="col-12 mb-12">
                        <label class="form-label">{{ __('app.ws.Name') }}</label>
                        <select class="form-control" wire:model='GetSelectEmp'>
                            <option value="">.....</option>
                            @foreach ($ws as $w)
                                <option value="{{ $w->id }}">
                                    {{ $w->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <br>
                    @if (!is_null($GetSelectEmp))
                        <div class="col-12 mb-12">
                            <label class="form-label">{{ __('app.ws.Name') }}</label>
                            <select class="form-control" wire:model='select_emp'>
                                <option value="">.....</option>
                                @foreach ($emp as $e)
                                    <option value="{{ $e->id }}">
                                        {{ $e->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    @endif
                </div>

                <div class="modal-footer text-center">
                    <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">
                        {{ __('app.task.ws.Move') }}
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>
