@push('scripts')
    <script type="text/javascript" src="{{ asset('js/family.categories._form.js') }}"></script>
@endpush

<form name="category" action="{{ $action }}" method="POST" class="has-bold-labels">

    @csrf

    @if ($method)
        @method($method)
    @endif

    @formError

    <fieldset>
        <legend>Details</legend>

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control" placeholder="Name" value="{{ old('name', $category->name) }}">
            @fieldError('name')
        </div>

        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="1" id="active" name="active" {{ ($category->active) ? "checked" : "" }}>
            <label class="form-check-label" for="active">
                Active
            </label>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control" placeholder="Description" rows="3">{{ old('description', $category->description) }}</textarea>
            @fieldError('description')
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
