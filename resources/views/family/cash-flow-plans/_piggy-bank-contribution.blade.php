<div class="col-12 col-lg-6">

    <div class="card shadow-sm mb-5 recurring-expense-category">

        <div class="card-body">

            <h3>{{ $piggyBank->name }}</h3>

            <p class="card-text mb-1">
                {{ App\formatCurrency($cashFlowPlan->actualPiggyBankContributionsForPiggyBankTotal($piggyBank), true) }} / {{ App\formatCurrency($cashFlowPlan->projectedPiggyBankContributionsForPiggyBankTotal($piggyBank), true) }}
            </p>

            {{--<div class="progress">

                @php
                    $statusClass = '';
                    if ($cashFlowPlan->recurringExpenseCategoryIsOverspent($categoryId)) {
                        $statusClass = 'bg-danger';
                    }
                @endphp

                <div class="progress-bar {{ $statusClass }}" role="progressbar" style="width: {{ $cashFlowPlan->recurringExpenseCategoryPercentUtilized($categoryId) }}%" aria-valuenow="{{ $cashFlowPlan->recurringExpenseCategoryActualTotal($categoryId) }}" aria-valuemin="0" aria-valuemax="{{ App\formatCurrency($cashFlowPlan->recurringExpenseCategoryProjectedTotal($categoryId), false) }}"></div>
            </div>--}}

        </div>

        <ul class="list-group list-group-flush piggy-bank-contributions-list" id="piggy-bank-contributions-list_{{ $piggyBank->id }}">

            @foreach ($cashFlowPlan->piggyBankContributions->where('piggy_bank_id', $piggyBank->id) as $contribution)
                <li class="list-group-item">
                    <a href="{{ route('family.cash-flow-plans.piggy-bank-contributions.edit', [$family, $cashFlowPlan, $contribution]) }}">
                        {{ $contribution->title() }}
                        {{ App\formatCurrency($contribution->actual, true) }} /
                        {{ App\formatCurrency($contribution->projected, true) }}
                    </a>
                </li>
            @endforeach

        </ul>

        <a href="#" class="card-footer text-center toggle-piggy-bank-contributions-list toggle-entries-list" data-toggle-target="piggy-bank-contributions-list_{{ $piggyBank->id }}">

            <span class="show-list-items list-item-display-action">
                <span class="fa fa-eye"></span> <span class="action">View Contributions</span>
            </span>

            <span class="hide-list-items list-item-display-action" style="display: none;">
                <span class="fa fa-eye-slash"></span> <span class="action">Hide Contributions</span>
            </span>

        </a>

    </div>

</div>
