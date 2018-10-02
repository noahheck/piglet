<div class="col-12 col-lg-6">

    <div class="card shadow-sm mb-5 recurring-expense-category" style="border-top: 3px solid {{ $borderColor }};">

        <div class="card-body">

            <h3>{{ $categoryName }}</h3>

            <p class="card-text mb-1">
                {{ App\formatCurrency($cashFlowPlan->recurringExpenseCategoryActualTotal($categoryId), true) }} / {{ App\formatCurrency($cashFlowPlan->recurringExpenseCategoryProjectedTotal($categoryId), true) }}
            </p>

            <div class="progress">

                @php
                    $statusClass = '';
                    if ($cashFlowPlan->recurringExpenseCategoryIsOverspent($categoryId)) {
                        $statusClass = 'bg-danger';
                    } elseif ($cashFlowPlan->recurringExpenseCategoryIsCloseToOverspent($categoryId)) {
                        //$statusClass = 'bg-warning';
                    }
                @endphp

                <div class="progress-bar {{ $statusClass }}" role="progressbar" style="width: {{ $cashFlowPlan->recurringExpenseCategoryPercentUtilized($categoryId) }}%" aria-valuenow="{{ $cashFlowPlan->recurringExpenseCategoryActualTotal($categoryId) }}" aria-valuemin="0" aria-valuemax="{{ App\formatCurrency($cashFlowPlan->recurringExpenseCategoryProjectedTotal($categoryId), false) }}"></div>
            </div>

            <p class="card-text mb-1 mt-3">
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
                <li class="list-group-item">
                    <a href="{{ route('family.cash-flow-plans.recurring-expenses.edit', [$family, $cashFlowPlan, $recurringExpense]) }}">
                        {{ $recurringExpense->name }} -
                        {{ App\formatCurrency($recurringExpense->actual, true) }} /
                        {{ App\formatCurrency($recurringExpense->projected, true) }}
                    </a>
                </li>
            @endforeach

        </ul>

        <div class="card-footer">

            <div class="row">

                <a href="#" class="col text-center toggle-recurring-expenses-list" data-toggle-target="recurring-expenses-list_{{ $categoryId }}">

                    <span class="fa fa-eye"></span> <span class="action">View Expenses</span>

                </a>

            </div>

        </div>

    </div>

</div>
