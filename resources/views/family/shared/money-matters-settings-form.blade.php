<div class="card shadow mb-4">
    <div class="card-body">
        <h4 class="text-center">{{ __('money-matters.pocket-money-label') }}</h4>
        <div class="text-center">
                <span class="circle-icon" style="color: #fff; background-color: green;">
                    <span class="fa fa-money"></span>
                </span>
        </div>
        <p>{{ __('money-matters.pocket-money-description') }}</p>
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text"><span class="fa fa-dollar"></span></div>
                </div>
                <input type="text" name="{{ App\Family::MONEY_MATTERS_POCKET_MONEY_AMOUNT }}" id="{{ App\Family::MONEY_MATTERS_POCKET_MONEY_AMOUNT }}" class="form-control money-field" placeholder="{{ __('money-matters.pocket-money-label') }}" value="{{ old($family::MONEY_MATTERS_POCKET_MONEY_AMOUNT, App\formatCurrency($family->getSetting($family::MONEY_MATTERS_POCKET_MONEY_AMOUNT), false)) }}">
            </div>
        </div>
    </div>
</div>



<div class="card shadow mb-4">
    <div class="card-body">
        <h4 class="text-center">{{ __('money-matters.retirement-label') }}</h4>
        <div class="text-center">
                <span class="circle-icon" style="color: #fff; background-color: red;">
                    <span class="fa fa-globe"></span>
                </span>
        </div>
        <p>{{ __('money-matters.retirement-description') }}</p>
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text"><span class="fa fa-dollar"></span></div>
                </div>
                <input type="text" name="{{ App\Family::MONEY_MATTERS_RETIREMENT_AMOUNT }}" id="{{ App\Family::MONEY_MATTERS_RETIREMENT_AMOUNT }}" class="form-control money-field" placeholder="{{ __('money-matters.retirement-label') }}" value="{{ old($family::MONEY_MATTERS_RETIREMENT_AMOUNT, App\formatCurrency($family->getSetting($family::MONEY_MATTERS_RETIREMENT_AMOUNT), false)) }}">
            </div>
        </div>
    </div>
</div>



<div class="card shadow mb-4">
    <div class="card-body">
        <h4 class="text-center">{{ __('money-matters.education-label') }}</h4>
        <div class="text-center">
                <span class="circle-icon" style="color: #fff; background-color: purple;">
                    <span class="fa fa-graduation-cap"></span>
                </span>
        </div>
        <p>{{ __('money-matters.education-description') }}</p>
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text"><span class="fa fa-dollar"></span></div>
                </div>
                <input type="text" name="{{ App\Family::MONEY_MATTERS_EDUCATION_AMOUNT }}" id="{{ App\Family::MONEY_MATTERS_EDUCATION_AMOUNT }}" class="form-control money-field" placeholder="{{ __('money-matters.education-label') }}" value="{{ old($family::MONEY_MATTERS_EDUCATION_AMOUNT, App\formatCurrency($family->getSetting($family::MONEY_MATTERS_EDUCATION_AMOUNT), false)) }}">
            </div>
        </div>
    </div>
</div>


