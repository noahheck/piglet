@push('scripts')
    <script type="text/javascript" src="{{ asset('js/family.income-sources._form.js') }}"></script>
@endpush

<form name="incomeSource" action="{{ $action }}" method="POST" class="has-bold-labels">

    @csrf

    @if ($method)
        @method($method)
    @endif

    @formError

    <fieldset>
        <legend>Details</legend>

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control" placeholder="Name" value="{{ old('name', $incomeSource->name) }}">
            @fieldError('name')
        </div>

        <div class="form-group">
            <label for="default_amount">Default Amount</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text"><span class="fa fa-dollar"></span></div>
                </div>
                <input type="text" name="default_amount" id="default_amount" class="form-control money-field" placeholder="Default Amount" value="{{ old('default_amount', number_format($incomeSource->default_amount, 2, '.', '')) }}">
            </div>
            @fieldError('default_amount')
        </div>

        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="1" id="active" name="active" {{ ($incomeSource->active) ? "checked" : "" }}>
            <label class="form-check-label" for="active">
                Active
            </label>
        </div>

        <div class="form-group">
            <label for="details">Details</label>
            <textarea name="details" id="details" class="form-control" placeholder="Details" rows="3">{{ old('details', $incomeSource->details) }}</textarea>
            @fieldError('details')
        </div>

    </fieldset>

    <hr>

    <button type="submit" class="btn btn-primary">
        {{ __('form.save') }}
    </button>

    <a class="btn btn-secondary" href="{{ $cancelRoute }}">
        {{ __('form.cancel') }}
    </a>

</form>
