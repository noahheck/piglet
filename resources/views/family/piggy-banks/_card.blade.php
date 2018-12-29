<a href="{{ route('family.piggy-banks.show', [$family, $piggyBank]) }}">

    <div class="card shadow">

        <div class="card-body">

            <h5 class="card-title">{{ $piggyBank->name }}</h5>

            <p class="card-text text-dark">
                {{ App\formatDate($piggyBank->dueDate) }}
                @if ($piggyBank->monthly_contribution)
                    ({{ App\formatCurrency($piggyBank->monthly_contribution, true) }} / {{ __('months.month') }})
                @endif
            </p>

            <div class="progress">
                <div class="progress-bar" role="progressbar" style="width: {{ $piggyBank->percentCompleted }}%" aria-valuenow="{{ $piggyBank->balance }}" aria-valuemin="0" aria-valuemax="{{ App\formatCurrency($piggyBank->target_amount, false) }}"></div>
            </div>

            <hr>

            <p class="card-text {{ ($piggyBank->active) ? "text-dark" : "text-muted" }}">
                {{ App\formatCurrency($piggyBank->balance, true) }} / {{ App\formatCurrency($piggyBank->target_amount, true) }}
            </p>

        </div>

    </div>

</a>
