<div class="col-12 col-lg-6">

    <div class="card shadow-sm mb-5 investment">

        <div class="card-body">

            <h3>{{ __('cash-flow-plans.' . $investment)  }}</h3>

            <h4 class="text-center">
                {{ App\formatCurrency($cashFlowPlan->$investment, true) }}
            </h4>

        </div>

    </div>

</div>
