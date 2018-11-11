<h2>{{ __('cash-flow-plans.lifestyle-expenses') }}</h2>

<p>{!! nl2br(e(__('money-matters-welcome.lifestyle-expenses-details'))) !!}</p>

<p class="note">{!! nl2br(e(__('money-matters-welcome.lifestyle-expenses-advisor-note'))) !!}</p>

<hr>

<p>{!! nl2br(e(__('money-matters-welcome.lifestyle-expenses-prompt'))) !!}</p>

<div class="form-group">
    <label for="{{ App\Family::MONEY_MATTERS_POCKET_MONEY_AMOUNT }}">{{ __('money-matters.pocket-money-label') }}</label>
    <p>{{ __('money-matters.pocket-money-description') }}</p>
    <div class="input-group">
        <div class="input-group-prepend">
            <div class="input-group-text"><span class="fa fa-dollar"></span></div>
        </div>
        <input type="text" name="{{ App\Family::MONEY_MATTERS_POCKET_MONEY_AMOUNT }}" id="{{ App\Family::MONEY_MATTERS_POCKET_MONEY_AMOUNT }}" class="form-control money-field" placeholder="{{ __('money-matters.pocket-money-label') }}">
    </div>
</div>

<div class="form-group">
    <label for="{{ App\Family::MONEY_MATTERS_RETIREMENT_AMOUNT }}">{{ __('money-matters.retirement-label') }}</label>
    <p>{{ __('money-matters.retirement-description') }}</p>
    <div class="input-group">
        <div class="input-group-prepend">
            <div class="input-group-text"><span class="fa fa-dollar"></span></div>
        </div>
        <input type="text" name="{{ App\Family::MONEY_MATTERS_RETIREMENT_AMOUNT }}" id="{{ App\Family::MONEY_MATTERS_RETIREMENT_AMOUNT }}" class="form-control money-field" placeholder="{{ __('money-matters.retirement-label') }}">
    </div>
</div>

<div class="form-group">
    <label for="{{ App\Family::MONEY_MATTERS_EDUCATION_AMOUNT }}">{{ __('money-matters.education-label') }}</label>
    <p>{{ __('money-matters.education-description') }}</p>
    <div class="input-group">
        <div class="input-group-prepend">
            <div class="input-group-text"><span class="fa fa-dollar"></span></div>
        </div>
        <input type="text" name="{{ App\Family::MONEY_MATTERS_EDUCATION_AMOUNT }}" id="{{ App\Family::MONEY_MATTERS_EDUCATION_AMOUNT }}" class="form-control money-field" placeholder="{{ __('money-matters.education-label') }}">
    </div>
</div>

<hr>

<p class="note">{!! nl2br(e(__('money-matters-welcome.lifestyle-expenses-review-note'))) !!}</p>

<p>{!! nl2br(e(__('money-matters-welcome.lifestyle-expenses-next'))) !!}</p>
