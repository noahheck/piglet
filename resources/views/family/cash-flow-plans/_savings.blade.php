<div class="col-12 col-lg-6">

    <div class="card shadow-sm mb-5 investment">

        <div class="card-body text-center">

            <h4>{{ __('cash-flow-plans.' . $investment)  }}</h4>

            <h5 class="text-center">
                {{ App\formatCurrency($cashFlowPlan->$investment, true) }}
            </h5>

        </div>

    </div>

</div>
