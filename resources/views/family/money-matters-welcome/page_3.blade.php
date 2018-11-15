<h2>{{ __('cash-flow-plans.lifestyle-expenses') }}</h2>

<p>{!! nl2br(e(__('money-matters-welcome.lifestyle-expenses-details'))) !!}</p>

<p class="note">{!! nl2br(e(__('money-matters-welcome.lifestyle-expenses-advisor-note'))) !!}</p>

<hr>

<p>{!! nl2br(e(__('money-matters-welcome.lifestyle-expenses-prompt'))) !!}</p>

<div class="row justify-content-center">

    <div class="col-12 col-sm-10 mbsss-4">

        @include('family.shared.money-matters-settings-form')

    </div>

</div>

<hr>

<p class="note">{!! nl2br(e(__('money-matters-welcome.lifestyle-expenses-review-note'))) !!}</p>

<p>{!! nl2br(e(__('money-matters-welcome.lifestyle-expenses-next'))) !!}</p>
