<div class="col-12 col-lg-6">

    <div class="card shadow-sm mb-3 recurring-expense-category" style="border-top: 3px solid {{ $borderColor }};">

        <div class="card-body {{ $cashFlowPlan->recurringExpenseCategoryHasMissingProjectedValue($categoryId) ? 'bg-subtle-warning' : '' }}">

            <h3>{{ $categoryName }}</h3>

            <p class="card-text mb-1">
                {{ App\formatCurrency($cashFlowPlan->recurringExpenseCategoryActualTotal($categoryId), true) }} / {{ App\formatCurrency($cashFlowPlan->recurringExpenseCategoryProjectedTotal($categoryId), true) }}
            </p>

            <div class="progress">

                @php
                    $statusClass = '';
                    if ($cashFlowPlan->recurringExpenseCategoryIsOverspent($categoryId)) {
                        $statusClass = 'bg-danger';
                    }
                @endphp

                <div class="progress-bar {{ $statusClass }}" role="progressbar" style="width: {{ $cashFlowPlan->recurringExpenseCategoryPercentUtilized($categoryId) }}%" aria-valuenow="{{ $cashFlowPlan->recurringExpenseCategoryActualTotal($categoryId) }}" aria-valuemin="0" aria-valuemax="{{ App\formatCurrency($cashFlowPlan->recurringExpenseCategoryProjectedTotal($categoryId), false) }}"></div>
            </div>

            <p class="card-text mb-1 mt-3">
                <small class="text-muted float-right" title="{{ __('cash-flow-plans.actual-vs-projected') }}">
                    {{ App\formatCurrency($cashFlowPlan->recurringExpenseCategoryActualVsProjected($categoryId), true) }}
                </small>
                {{ $cashFlowPlan->recurringExpenseCategoryPaymentsMade($categoryId) }} / {{ $cashFlowPlan->recurringExpenseCategoryPaymentsExpected($categoryId) }} {{ __('recurring-expenses.payments-made') }}
            </p>

            <div class="progress">

                @php
                    $statusClass = 'bg-warning';
                    if ($cashFlowPlan->recurringExpenseCategoryAllPaymentsMade($categoryId)) {
                        $statusClass = 'bg-success';
                    }
                @endphp

                <div class="progress-bar {{ $statusClass }}" role="progressbar" style="width: {{ $cashFlowPlan->recurringExpenseCategoryPercentPaymentsMade($categoryId) }}%" aria-valuenow="{{ $cashFlowPlan->recurringExpenseCategoryPaymentsMade($categoryId) }}" aria-valuemin="0" aria-valuemax="{{ $cashFlowPlan->recurringExpenseCategoryPaymentsExpected($categoryId) }}" ></div>

            </div>

        </div>

        <ul class="list-group list-group-flush recurring-expenses-list" id="recurring-expenses-list_{{ $categoryId }}">

            @foreach ($cashFlowPlan->recurringExpenses->where('category_id', $categoryId) as $recurringExpense)
                <li class="list-group-item {{ ($recurringExpense->hasMissingProjectedValue()) ? 'bg-subtle-warning' : '' }}">
                    <a href="{{ route('family.cash-flow-plans.recurring-expenses.edit', [$family, $cashFlowPlan, $recurringExpense]) }}">
                        {{ $recurringExpense->name }} -
                        {{ App\formatCurrency($recurringExpense->actual, true) }} /
                        {{ App\formatCurrency($recurringExpense->projected, true) }}
                    </a>
                </li>
            @endforeach

        </ul>

        <button type="button" class="card-footer text-center toggle-recurring-expenses-list toggle-entries-list" id="recurring-expenses-list_{{ $categoryId }}_toggle-button" data-toggle-target="recurring-expenses-list_{{ $categoryId }}">

            <span class="show-list-items list-item-display-action">
                <span class="fa fa-expand rotate-minus-45"></span> <span class="action">View Expenses</span>
            </span>

            <span class="hide-list-items list-item-display-action" style="display: none;">
                <span class="fa fa-compress rotate-minus-45"></span> <span class="action">Hide Expenses</span>
            </span>

        </button>

    </div>

</div>
