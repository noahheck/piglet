<div class="col-12 col-lg-6">

    <div class="card shadow-sm mb-3 piggy-bank">

        <div class="card-body">

            <h3>
                <a href="{{ route('family.cash-flow-plans.piggy-banks.show', [$family, $cashFlowPlan, $piggyBank]) }}">
                    {{ $piggyBank->name }}
                </a>
            </h3>

                <a class="btn btn-sm btn-outline-primary float-right" href="{{ route("family.cash-flow-plans.piggy-bank-contributions.create", [$family, $cashFlowPlan, 'piggy_bank_id' => $piggyBank->id]) }}">
                    <span class="fa fa-dollar"></span> {{ __('piggy-banks.add-new-contribution') }}
                </a>
            <p class="mb-3">

                {{ App\formatCurrency($piggyBank->actualTotal(), true) }} / {{ App\formatCurrency($piggyBank->projected, true) }}
            </p>

            <div class="progress">

                @php
                    $statusClass = '';
                    if ($piggyBank->contributionsTargetAchieved()) {
                        $statusClass = 'bg-success';
                    }
                @endphp

                <div class="progress-bar {{ $statusClass }}" role="progressbar" style="width: {{ $piggyBank->percentAchieved() }}%" aria-valuenow="{{ $piggyBank->actualTotal() }}" aria-valuemin="0" aria-valuemax="{{ App\formatCurrency($piggyBank->projected, false) }}"></div>
            </div>

        </div>

    </div>

</div>
