@php
$distributedProperty = $investment . '_distributed';
@endphp

<div class="col-12 col-lg-6">

    <div class="card shadow-sm mb-5 investment">

        <div class="card-body text-center">

            <h4>{{ __('cash-flow-plans.' . $investment)  }}</h4>

            <h5>
                {{ App\formatCurrency($cashFlowPlan->$investment, true) }}
                @if ($cashFlowPlan->$distributedProperty)
                    <span class="text-success fa fa-check-circle-o"></span>
                @endif
            </h5>


        </div>

    </div>

</div>
