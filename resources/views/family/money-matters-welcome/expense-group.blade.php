<div class="row">

    <div class="col-12 col-sm-4 mb-4">

        <div class="card shadow">
            <div class="card-body">
                <div class="text-center">
                    <span class="circle-icon" style="color: #fff; background-color: {{ $iconColor }};">
                        {!! $icon !!}
                    </span>
                </div>
                <h4 class="text-center">
                    {{ __('money-matters-welcome.expense-groups-' . $expense) }}
                </h4>
                <label for="expense_groups_{{ $expense }}_amount">{{ __('cash-flow-plans.amount') }}</label>

                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text"><span class="fa fa-dollar"></span></div>
                        </div>
                        <input type="text" name="expense_groups_{{ $expense }}_amount" id="expense_groups_{{ $expense }}_amount" class="form-control money-field" placeholder="{{ __('cash-flow-plans.amount') }}"">
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="col-12 col-sm-8">

        <div class="card shadow">
            <div class="card-body">

                @foreach ($merchantTypes as $type => $details)
                    <h4>{!! $details['icon'] !!} {{ __('money-matters-welcome.expense-groups-' . $type . 's') }}</h4>

                    <div id="{{ $type }}s_container" class="mb-4">

                        <div class="money-matters-resource row">

                            <div class="col-10">

                                <input type="text" class="form-control" name="expense_groups_{{ $type }}s[]" placeholder="{{ __('merchants.name') }}">

                            </div>

                            <div class="col-2 text-center">
                                <button type="button" class="btn btn-sm btn-danger delete-resource-button">
                                    <span class="fa fa-remove"></span>
                                </button>
                            </div>

                        </div>

                    </div>

                    <div class="add-new-resource-container text-center">
                        <button type="button" class="btn btn-sm btn-primary add-new-resource-button" data-template="{{ $type }}_template" data-target="{{ $type }}s_container">
                            <span class="fa fa-plus-circle"></span> {{ __('money-matters-welcome.expense-groups-add-' . $type) }}
                        </button>
                    </div>

                @endforeach

            </div>
        </div>

    </div>

</div>


@foreach ($merchantTypes as $type => $details)

    <div class="row template money-matters-resource mt-2" id="{{ $type }}_template">

        <div class="col-10">

            <input type="text" class="form-control" name="expense_groups_{{ $type }}[]" placeholder="{{ __('merchants.name') }}">

        </div>

        <div class="col-2 text-center">
            <button type="button" class="btn btn-danger btn-sm delete-resource-button">
                <span class="fa fa-remove"></span>
            </button>
        </div>

    </div>

@endforeach
