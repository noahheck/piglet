<div class="col-12 col-lg-6">

    <div class="card shadow-sm mb-5 piggy-bank">

        <a href="{{ route('family.cash-flow-plans.piggy-banks.show', [$family, $cashFlowPlan, $piggyBank]) }}" class="card-body">

            <h3>{{ $piggyBank->piggyBank->name }}</h3>

            <p class="card-text text-dark mb-1">
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

        </a>

        <a class="card-footer text-center" href="{{ route("family.cash-flow-plans.piggy-bank-contributions.create", [$family, $cashFlowPlan, 'piggy_bank_id' => $piggyBank->id]) }}">
            <span class="fa fa-dollar"></span> {{ __('piggy-banks.add-new-contribution') }}
        </a>

    </div>

</div>
