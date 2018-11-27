<div class="card shadow mb-4">
    <div class="card-body">
        <h4 class="text-center">{{ __('money-matters.pocket-money-label') }}</h4>
        <div class="text-center">
            <span class="fa-stack fa-3x">
                <span class="fa fa-circle fa-stack-2x color-green"></span>
                <span class="fa fa-dollar fa-stack-1x color-white"></span>
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
            <span class="fa-stack fa-3x">
                <span class="fa fa-circle fa-stack-2x color-red"></span>
                <span class="fa fa-globe fa-stack-1x color-white"></span>
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
            <span class="fa-stack fa-3x">
                <span class="fa fa-circle fa-stack-2x color-purple"></span>
                <span class="fa fa-graduation-cap fa-stack-1x color-white"></span>
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


