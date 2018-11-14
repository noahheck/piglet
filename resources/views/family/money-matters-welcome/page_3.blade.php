<h2>{{ __('cash-flow-plans.lifestyle-expenses') }}</h2>

<p>{!! nl2br(e(__('money-matters-welcome.lifestyle-expenses-details'))) !!}</p>

<p class="note">{!! nl2br(e(__('money-matters-welcome.lifestyle-expenses-advisor-note'))) !!}</p>

<hr>

<p>{!! nl2br(e(__('money-matters-welcome.lifestyle-expenses-prompt'))) !!}</p>

<div class="row justify-content-center">

    <div class="col-12 col-sm-10 mb-4">
        <div class="card shadow">
            <div class="card-body">
                <h4 class="text-center">{{ __('money-matters.pocket-money-label') }}</h4>
                <div class="text-center">
                        <span class="circle-icon" style="color: #fff; background-color: green;">
                            <span class="fa fa-money"></span>
                        </span>
                </div>
                <p>{{ __('money-matters.pocket-money-description') }}</p>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text"><span class="fa fa-dollar"></span></div>
                        </div>
                        <input type="text" name="{{ App\Family::MONEY_MATTERS_POCKET_MONEY_AMOUNT }}" id="{{ App\Family::MONEY_MATTERS_POCKET_MONEY_AMOUNT }}" class="form-control money-field" placeholder="{{ __('money-matters.pocket-money-label') }}">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 col-sm-10 mb-4">
        <div class="card shadow">
            <div class="card-body">
                <h4 class="text-center">{{ __('money-matters.retirement-label') }}</h4>
                <div class="text-center">
                        <span class="circle-icon" style="color: #fff; background-color: red;">
                            <span class="fa fa-globe"></span>
                        </span>
                </div>
                <p>{{ __('money-matters.retirement-description') }}</p>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text"><span class="fa fa-dollar"></span></div>
                        </div>
                        <input type="text" name="{{ App\Family::MONEY_MATTERS_RETIREMENT_AMOUNT }}" id="{{ App\Family::MONEY_MATTERS_RETIREMENT_AMOUNT }}" class="form-control money-field" placeholder="{{ __('money-matters.retirement-label') }}">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 col-sm-10 mb-4">
        <div class="card shadow">
            <div class="card-body">
                <h4 class="text-center">{{ __('money-matters.education-label') }}</h4>
                <div class="text-center">
                        <span class="circle-icon" style="color: #fff; background-color: purple;">
                            <span class="fa fa-graduation-cap"></span>
                        </span>
                </div>
                <p>{{ __('money-matters.education-description') }}</p>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text"><span class="fa fa-dollar"></span></div>
                        </div>
                        <input type="text" name="{{ App\Family::MONEY_MATTERS_EDUCATION_AMOUNT }}" id="{{ App\Family::MONEY_MATTERS_EDUCATION_AMOUNT }}" class="form-control money-field" placeholder="{{ __('money-matters.education-label') }}">
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>

<hr>

<p class="note">{!! nl2br(e(__('money-matters-welcome.lifestyle-expenses-review-note'))) !!}</p>

<p>{!! nl2br(e(__('money-matters-welcome.lifestyle-expenses-next'))) !!}</p>
