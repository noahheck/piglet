@extends('layouts.app')

@section('title')
    - {{ $family->name }} - {{ __('expense-groups.expense-groups') }} - {{ $expenseGroup->name }}
@endsection

@push('stylesheets')
    {{--<link rel="stylesheet" type="text/css" href="{{ asset('css/family/member/home.css') }}" />--}}
@endpush

@push('scripts')
{{--    <script type="text/javascript" src="{{ asset('js/family.merchants.index.js') }}"></script>--}}
@endpush

@section('content')

    @include('family.shared.breadcrumb', [
        'breadcrumb' => [
            route('family.money-matters', [$family])   => __('money-matters.money-matters'),
            route('family.expense-groups.index', [$family]) => __('expense-groups.expense-groups'),
        ],
        'location'   => $expenseGroup->name,
        'menu' => [
            ['type' => 'link', 'href' => route('family.expense-groups.create', [$family]), 'icon' => 'fa fa-plus-circle', 'text' => __('expense-groups.add-new-expense-group')],
            ['type' => 'link', 'href' => route('family.expense-groups.edit', [$family, $expenseGroup]), 'icon' => 'fa fa-pencil-square-o', 'text' => __('form.edit')],
        ]
    ])

    <div class="row">

        <div class="col-12 col-md-3">

            @include('family.shared.money-matters-nav', ['active' => 'expense-groups'])

        </div>

        <div class="col-12 col-md-9">

            <h2>{{ $expenseGroup->name }}</h2>

            @if ($expenseGroup->active)
                <p><span class="fa fa-check-square-o" title="Active"></span> {{ __('expense-groups.active') }}
            @else
                <p class="text-muted"><span class="fa fa-square-o" title="Inactive"></span> {{ __('expense-groups.inactive') }}
            @endif

                {{ ($expenseGroup->default_amount) ? '- ' . Auth::user()->formatCurrency($expenseGroup->default_amount, true) : '' }}
                {{ ($expenseGroup->category)       ? '- ' . $expenseGroup->category->name : '' }}
                {{ ($expenseGroup->sub_category)   ? '- ' . $expenseGroup->sub_category : '' }}
            </p>

            <p>{!! nl2br(e($expenseGroup->description)) !!}</p>

        </div>

        <hr>

    </div>

@endsection
