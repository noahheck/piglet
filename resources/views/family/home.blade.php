@extends('layouts.app')

@section('title')
 - {{ $family->name }} Home
@endsection

@push('stylesheets')
    <link rel="stylesheet" type="text/css" href="{{ mix('css/family/home.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ mix('css/family.calendar.calendar.css') }}" />
@endpush

@push('scripts')
    {{--<script src="{{ mix("js/home.js") }}"></script>--}}
@endpush

@php

$menu = [];

if (Auth::user()->familyMember()->is_administrator) {
    $menu[] = [
        'type' => 'link',
        'href' => route('family.edit', [$family]),
        'icon' => 'fa fa-pencil-square-o',
        'text' => ucwords(__('form.edit_details')),
    ];
}

$menu[] = [
    'type' => 'help',
    'key'  => 'family',
];

@endphp

@section('content')

    @include('family.shared.breadcrumb', [
        'menu' => $menu,
    ])

    <div class="row">

        <div class="col-12 col-md-6 col-lg-5 col-xl-4">

            <div class="text-center">

                <h2>{{ $family->name }}</h2>

                {!! $family->photo(['rounded-circle', 'img-fluid', 'family-photo']) !!}

                @if (Auth::user()->familyMember()->is_administrator)
                    <p><a href="{{ route('family.edit', $family) }}" class="btn btn-outline-primary">{{ ucwords(__('form.edit_details')) }}</a></p>
                @endif

            </div>

            <hr>

            <a class="card shadow component-link" href="{{ route('family.members.index', $family) }}">
                <div class="card-body">
                    <h5 class="card-title">
                        <span class="fa fa-users"></span>
                        {{ __('family-members.family_members') }}
                    </h5>
                    @foreach ($members as $member)
                        {!! $member->icon(['rounded-circle'])  !!}
                    @endforeach
                </div>
            </a>

            <a class="card shadow component-link" href="{{ route('family.money-matters', $family) }}">
                <div class="card-body">
                    <h5 class="card-title">
                        <span class="fa fa-usd"></span>
                        {{ __('money-matters.money-matters') }}
                    </h5>
                    <p>
                        <span class="fa fa-pull-left fa-bar-chart fa-2x fa-border"></span>
                        {{ __('money-matters.money-matters-shortDesc') }}
                    </p>
                </div>
            </a>

            {{--@if (App::isLocal())
                <a class="card shadow component-link" href="{{ route('family.taskLists.index', $family) }}">
                    <div class="card-body">
                        <h5 class="card-title">
                            <span class="fa fa-sstasks fa-check-square-o"></span>
                            Things to do
                        </h5>
                        <p>
                            <span class="fa fa-pull-left fa-list fa-2x fa-border"></span>
                            To do lists and things
                        </p>
                    </div>
                </a>
            @endif--}}

<!--            <a class="card shadow component-link" href="{{ route('family.calendar', $family) }}">
                <div class="card-body">
                    <h5 class="card-title">
                        <span class="fa fa-calendar"></span>
                        {{ __('calendar.calendar') }}
                    </h5>
                    <p>
                        <span class="fa fa-pull-left fa-2x fa-border fa-list-alt"></span>
                    </p>
                    {{ __('calendar.calendar-short-desc') }}
                </div>
            </a>-->

        </div>



        <div class="col-12 col-md-6 col-lg-7 col-xl-8">


            <div class="card shadow">

                <a class="card-header" href="{{ route('family.calendar', $family) }}">
                    <h4 class="mb-0 ">
                        <span class="fa fa-calendar mr-2"></span>{{ __('calendar.calendar') }}
                        <span class="fa fa-external-link"></span>
                    </h4>
                </a>

                <div class="card-body">

                    <div id="calendar_dayDetails">

                        @include('family.calendar._day-detail', [
                            'returnRoute' => route('family.home', $family),
                        ])

                    </div>

                </div>

            </div>












            <div class="card shadow mb-5">
                <div class="card-body p-0">

                    <div>

                        <div class="d-flex">

                            <div class="margin flex-grow-0">

                            </div>

                            <h3 class="mt-4 ml-4 mb-2">
                                <span class="fa fa-check-square-o"></span>
                                {{ __('todos.todos') }}
                            </h3>

                        </div>

                    </div>

                    <div class="sheet">

                        <div class="d-flex">
                            <div class="margin flex-grow-0">

                            </div>
                            <div class="flex-grow-1">

                                <div class="todo-list">

                                    @php
                                        $currentDueDate = '';
                                    @endphp

                                    @foreach ($todos as $todo)

                                        @if ($todo->due_date != $currentDueDate)
                                            <span class="date-header {{ $todo->due_date === \Auth::user()->today()->format('m/d/Y') ? 'today' : '' }}">{{ $currentDueDate = $todo->due_date }}</span>
                                        @endif

                                        <div class="todo d-flex {{ $todo->isOverdue() ? 'overdue' : '' }} {{ $todo->isDueToday() ? 'due-today' : '' }}">
                                            <div class="flex-grow-0">
                                                <form action="{{ route('family.todos.complete', [$family, $todo]) }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="return" value="{{ url()->current() }}">

                                                    <button type="submit" class="btn btn-light mr-2 border-0" style="background: transparent;" title="{{ __('todos.complete-this-todo') }}">
                                                        <span class="fa fa-square-o"></span>
                                                    </button>
                                                </form>
                                            </div>
                                            <a class="flex-grow-1" href="{{ route('family.todos.edit', [$family, $todo]) }}">
                                                {{ $todo->title }}
                                                @if ($todo->details)
                                                    <small>
                                                        <span class='fa fa-align-left ml-2' title="{{ $todo->details }}"></span>
                                                    </small>
                                                @endif
                                            </a>
                                        </div>
                                    @endforeach

                                </div>

                                <div class="pl-3 pb-3">
                                    <a href="{{ route('family.todos.create', [$family]) }}" class="btn btn-primary">
                                        {{ __('todos.add-new-todo') }}
                                    </a>
                                </div>

                                <div class="completed-todo-list">
                                    @foreach ($completedTodos as $todo)

                                        <div class="todo d-flex">
                                            <div class="flex-grow-0">
                                                <form action="{{ route('family.todos.uncomplete', [$family, $todo]) }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="return" value="{{ url()->current() }}">
                                                    <button type="submit" class="btn btn-light mr-2 border-0" style="background: transparent;" title="{{ __('todos.uncomplete-this-todo') }}">
                                                        <span class="fa fa-check-square-o"></span>
                                                    </button>
                                                </form>
                                            </div>
                                            <a class="flex-grow-1" href="{{ route('family.todos.show', [$family, $todo]) }}">
                                                {{ $todo->title }}
                                            </a>
                                        </div>

                                    @endforeach
                                </div>

                            </div>
                        </div>

                    </div>

                </div>
            </div>









            @if ($currentCfp)

                @php
                    $cfpRoute = route("family.cash-flow-plans.show", [$family, $currentCfp]);
                @endphp

                <div class="row justify-content-center">

                    <div class="col-12 col-lg-10 col-xl-8">

                        <div class="card shadow">

                            <a class="card-header" href="{{ $cfpRoute }}">
                                <h3 class="mb-0">{{ __('months.' . $currentCfp->month) }} {{ $currentCfp->year }} <span class="fa fa-external-link"></span></h3>
                            </a>

                            <a href="{{ $cfpRoute }}">
                                <div class="card-body">

                                    <h4>{{ __('cash-flow-plans.actual') }} {{ __('cash-flow-plans.expenditures') }}</h4>

                                    <canvas id="cfpActualBalanceChart" class="piglet-chart" data-chart-data='@json($currentCfp->actualBalanceChartData())'></canvas>

                                </div>
                            </a>

                        <!--                        <div class="card-header border-top">
                                <h4>{{ __('expense-groups.expense-groups') }}</h4>
                            </div>

                            <ul class="list-group list-group-flush">

                                @foreach ($currentCfp->expenseGroups as $group)
                            <li class="list-group-item">

                                <h5>{{ $group->name }}</h5>

                                        <p>
                                            <a class="float-right btn btn-sm btn-outline-primary" href="{{ route("family.cash-flow-plans.expenses.create", [$family, $currentCfp, 'expense_group_id' => $group]) }}">
                                                <span class="fa fa-dollar"></span> {{ __('expenses.add-new-expense') }}
                                    </a>
                                    {{ App\formatCurrency($group->actualTotal(), true) }} / {{ App\formatCurrency($group->projected, true) }}
                                    <small class="text-muted" title="{{ __('cash-flow-plans.actual-vs-projected') }}">
                                                {{ App\formatCurrency($group->actualVsProjected(), true) }}
                                    </small>
                                </p>

                                <div class="progress">

                            @php
                                $statusClass = '';
                                if ($group->isOverspent()) {
                                    $statusClass = 'bg-danger';
                                } elseif ($group->isCloseToOverspent()) {
                                    $statusClass = 'bg-warning';
                                }
                            @endphp

                                    <div class="progress-bar {{ $statusClass }}" role="progressbar" style="width: {{ $group->percentUtilized() }}%" aria-valuenow="{{ $group->actualTotal() }}" aria-valuemin="0" aria-valuemax="{{ App\formatCurrency($group->projected, false) }}"></div>
                                        </div>
                                    </li>
                                @endforeach

                                </ul>-->

                        </div>

                    </div>

                </div>

            @endif





        </div>

    </div>



    <hr>

    <div class="row justify-content-around">

        <div class="col-12 col-sm-10 col-md-6">



        </div>



        </div>

@endsection
