<h2>{{ __('income-sources.income-sources') }}</h2>

<p>{!! nl2br(e(__('money-matters-welcome.income-sources-details'))) !!}</p>

<p class="note">{!! nl2br(e(__('money-matters-welcome.income-sources-details-other-income'))) !!}</p>

<hr>

<p>{!! nl2br(e(__('money-matters-welcome.income-sources-prompt'))) !!}</p>

<div id="income_sources_container" class="row justify-content-center">

    <div class="col-12 col-sm-6 col-md-4 money-matters-resource">
        <div class="card shadow mb-4">
            <div class="card-body">

                <div class="text-center">
                    <span class="fa-stack fa-3x">
                        <span class="fa fa-circle fa-stack-2x color-green" style="color: green;"></span>
                        <span class="fa fa-dollar fa-stack-1x color-white"></span>
                    </span>
                </div>

                <div class="form-group">
                    <label>{{ __('income-sources.name') }}</label>
                    <input type="text" name="income_sources_name[]" class="form-control" placeholder="{{ __('income-sources.income-source') }} {{ __('income-sources.name') }}">
                </div>

                <div class="form-group">
                    <label>{{ __('cash-flow-plans.amount') }}</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text"><span class="fa fa-dollar"></span></div>
                        </div>
                        <input type="text" name="income_sources_default_amount[]" class="form-control money-field" placeholder="{{ __('cash-flow-plans.amount') }}">
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>

<div class="add-new-resource-container text-center">
    <button type="button" id="add_new_income_source_button" class="btn btn-primary add-new-resource-button" data-template="income_sources_template" data-target="income_sources_container">
        <span class="fa fa-plus-circle"></span> {{ __('income-sources.add-new-income-source') }}
    </button>
</div>

<hr>

<p class="note">{!! nl2br(e(__('money-matters-welcome.income-sources-review-note'))) !!}</p>

<p>{!! nl2br(e(__('money-matters-welcome.income-sources-next'))) !!}</p>


{{-- Row template --}}

<div class="col-12 col-sm-6 col-md-4 template money-matters-resource" id="income_sources_template">
    <div class="card shadow mb-4">
        <div class="card-body">

            <div class="text-center">
                <span class="fa-stack fa-3x">
                    <span class="fa fa-circle fa-stack-2x color-green" style="color: green;"></span>
                    <span class="fa fa-dollar fa-stack-1x color-white"></span>
                </span>
            </div>

            <div class="form-group">
                <label>{{ __('income-sources.name') }}</label>
                <input type="text" name="income_sources_name[]" class="form-control" placeholder="{{ __('income-sources.income-source') }} {{ __('income-sources.name') }}">
            </div>

            <div class="form-group">
                <label>{{ __('cash-flow-plans.amount') }}</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><span class="fa fa-dollar"></span></div>
                    </div>
                    <input type="text" name="income_sources_default_amount[]" class="form-control money-field" placeholder="{{ __('cash-flow-plans.amount') }}">
                </div>
            </div>

            <div class="text-center">
                <button type="button" class="btn btn-danger btn-sm delete-resource-button">
                    <span class="fa fa-remove"></span>
                </button>
            </div>

        </div>
    </div>
</div>
