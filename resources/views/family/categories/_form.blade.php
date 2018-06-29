@push('scripts')
    <script type="text/javascript" src="{{ asset('js/family.categories._form.js') }}"></script>
@endpush

<form name="category" action="{{ $action }}" method="POST" class="has-bold-labels">

    @csrf

    @if ($method)
        @method($method)
    @endif

    @formError

    <ul class="nav nav-tabs" id="merchantTabs" role="tablist">

        <li class="nav-item">
            <a class="nav-link active" id="detailsTab" data-toggle="tab" href="#details" role="tab" aria-controls="details" aria-selected="true">{{ __('categories.details') }}</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="subCategoryTab" data-toggle="tab" href="#subCategory" role="tab" aria-controls="subCategory" aria-selected="false">{{ __('categories.sub-categories') }}</a>
        </li>

    </ul>

    <div class="tab-content" id="merchantTabsContent">

        <div class="tab-pane show active fade" id="details" role="tabpanel" aria-labelledby="detailsTab">

            <fieldset>
                <legend>{{ __('categories.details') }}</legend>

                <div class="form-group">
                    <label for="name">{{ __('categories.name') }}</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="{{ __('categories.name') }}" value="{{ old('name', $category->name) }}">
                    @fieldError('name')
                </div>

                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="1" id="active" name="active" {{ ($category->active) ? "checked" : "" }}>
                    <label class="form-check-label" for="active">
                        {{ __('categories.active') }}
                    </label>
                </div>

                <div class="form-group">
                    <label for="color">{{ __('categories.color') }}</label>
                    <a href="#" class="dismissable-popover" data-toggle="popover" data-content="{{ __('categories.color_desc') }}"><span class="fa fa-question-circle"></span></a>
                    <input type="color" name="color" id="color" class="form-control" placeholder="{{ __('categories.color') }}" value="{{ old('color', $category->color) }}">
                    @fieldError('color')
                </div>

                <div class="form-group">
                    <label for="description">{{ __('categories.description') }}</label>
                    <textarea name="description" id="description" class="form-control" placeholder="{{ __('categories.description') }}" rows="3">{{ old('description', $category->description) }}</textarea>
                    @fieldError('description')
                </div>

            </fieldset>

        </div>

        <div class="tab-pane fade" id="subCategory" role="tabpanel" aria-labelledby="subCategoryTab">

            <fieldset>
                <legend>{{ __('categories.sub-categories') }}</legend>

                <p>{{ __('categories.sub-categories-desc') }}</p>

                <div class="input-group">
                    <input type="text" id="newSubCategory" class="form-control" placeholder="{{ __('categories.add-sub-category') }}" aria-label="{{ __('categories.add-sub-category') }}">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="button" id="addNewSubCategory">{{ __('categories.add-sub-category') }}</button>
                    </div>
                </div>

                <ul class="list-group mt-3 shadow" id="subCategories">

                    @if ($category->sub_categories)

                        @foreach($category->sub_categories as $sub_category)

                            <li class="list-group-item sub-category-item">
                                <span class="fa fa-sort sort-handle"></span>
                                <span class="fa fa-trash-o float-right delete-icon mr-3 pt-1"></span>
                                <span class="category-title">{{ $sub_category }}</span>
                                <input type="hidden" name="sub_categories[]" value="{{ $sub_category }}">
                            </li>

                        @endforeach

                    @endif

                </ul>

            </fieldset>

        </div>

    </div>

    <hr>

    <button type="submit" class="btn btn-primary">
        {{ __('form.save') }}
    </button>

    <a class="btn btn-secondary" href="{{ $cancelRoute }}">
        {{ __('form.cancel') }}
    </a>

</form>

<ul class="template">
    <li class="list-group-item sub-category-item" id="newSubCategoryTemplate">
        <span class="fa fa-sort sort-handle"></span>
        <span class="fa fa-trash-o float-right delete-icon mr-3 pt-1"></span>
        <span class="category-title"></span>
        <input type="hidden" name="sub_categories[]" value="">
    </li>
</ul>
