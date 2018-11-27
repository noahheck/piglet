<div class="row">

    <div class="col-12">
        <div class="card shadow piggy-bank border mb-4">

            <div class="row">

                <div class="col-12 col-sm-3 d-flex justify-content-center" style="background-color: {{ $color }}; align-items: center;">

                    <div class="text-center">
                        <span class="fa-stack fa-3x">
                            <span class="fa fa-circle fa-stack-2x color-white"></span>
                            <span class="fa fa-dollar fa-stack-1x color-{{ $color }}"></span>
                        </span>
                    </div>

                </div>

                <div class="col-12 col-sm-9">

                    <div class="form-group m-2">
                        <label for="piggy_bank_{{ $piggyBank }}_name">{{ __('piggy-banks.name') }}</label>
                        <input type="text" class="form-control" name="piggy_bank_{{ $piggyBank }}_name" id="piggy_bank_{{ $piggyBank }}_name" placeholder="{{ __('piggy-banks.name') }}">
                    </div>

                    <div class="form-group m-2">
                        <label for="piggy_bank_{{ $piggyBank }}_target">{{ __('piggy-banks.target-amount') }}</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><span class="fa fa-dollar"></span></div>
                            </div>
                            <input type="text" class="form-control money-field" name="piggy_bank_{{ $piggyBank }}_target" id="piggy_bank_{{ $piggyBank }}_target" placeholder="{{ __('piggy-banks.target-amount') }}">
                        </div>
                    </div>

                    <div class="form-group m-2">
                        <label for="piggy_bank_{{ $piggyBank }}_starting">{{ __('piggy-banks.starting-amount') }}</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><span class="fa fa-dollar"></span></div>
                            </div>
                            <input type="text" class="form-control money-field" name="piggy_bank_{{ $piggyBank }}_starting" id="piggy_bank_{{ $piggyBank }}_starting" placeholder="{{ __('piggy-banks.starting-amount') }}">
                        </div>
                    </div>

                    <div class="form-group m-2">
                        <label for="piggy_bank_{{ $piggyBank }}_monthly">{{ __('piggy-banks.monthly-contribution') }}</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><span class="fa fa-dollar"></span></div>
                            </div>
                            <input type="text" class="form-control money-field" name="piggy_bank_{{ $piggyBank }}_monthly" id="piggy_bank_{{ $piggyBank }}_monthly" placeholder="{{ __('piggy-banks.monthly-contribution') }}">
                        </div>
                    </div>

                    <div class="form-group m-2">
                        <label for="piggy_bank_{{ $piggyBank }}_dueDate">{{ __('piggy-banks.dueDate') }}</label>
                        <input type="text" name="piggy_bank_{{ $piggyBank }}_dueDate" id="piggy_bank_{{ $piggyBank }}_dueDate" class="form-control dateField datepicker" placeholder="{{ __('piggy-banks.dueDate') }}">
                    </div>

                </div>

            </div>
        </div>

    </div>

</div>
