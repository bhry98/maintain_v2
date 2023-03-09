<div class="row mb-3 ">
    @foreach ($items as $n => $i)
        <div class="col-3 mb-3">
            <label class="form-label required">
                {{ __('app.pur.item.Name') }}
            </label>
            <input required type="text" name="data[{{ $n }}][item]" class="form-control ">

        </div>
        <div class="col-3 mb-3">
            <label class="form-label required">
                {{ __('app.pur.item.Q') }}
            </label>
            <input type="number" name="data[{{ $n }}][q]" class="form-control ">

        </div>
        <div class="col-4 mb-3">
            <label class="form-label ">
                {{ __('app.pur.item.Details') }}
            </label>
            <input type="text" name="data[{{ $n }}][detail]" class="form-control">

        </div>
    @endforeach
    <div class="col-1 mb-3">
        <label class="form-label ">&nbsp;</label>
        @if (count($items) > 1)
            <input wire:click='Remove({{ $n }})' type="button" class="btn btn-red form-control "
                value="-">
        @endif
    </div>
    <div class="col-1 mb-3">
        <label class="form-label ">&nbsp;</label>
        <input wire:click='Add' type="button" class="btn btn-azure form-control " value="+">
    </div>
</div>
