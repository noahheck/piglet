@extends('layouts.app')

@section('title')
    - {{ $family->name }} - {{ __('todos.todos') }}
@endsection

@push('stylesheets')
    {{--<link rel="stylesheet" type="text/css" href="{{ mix('css/family/member/home.css') }}" />--}}
@endpush

@push('scripts')
    {{--<script type="text/javascript" src="{{ mix('js/family.merchants.index.js') }}"></script>--}}
@endpush

@section('content')

    @include('family.shared.breadcrumb', [
        'location'   => __('todos.todos'),
        'menu' => [
            ['type' => 'link', 'href' => route('family.todos.create', [$family]), 'icon' => 'fa fa-plus-circle', 'text' => __('todos.add-new-todo')],
        ]
    ])

    <div class="row">

        <div class="col-12">

            <h2>{{ __('todos.todos') }}</h2>

            <hr>

            <div class="row justify-content-center mt-3">

                <div class="col-12 col-md-10 col-lg-8 col-xl-6">

                    @if (count($allTodos) === 0)

                        <p>{{ __('todos.no-todos-create') }}</p>
                        <p class="text-center">
                            <a class="btn btn-primary" href="{{ route('family.todos.create', $family) }}">
                                <span class="fa fa-plus-circle"></span> {{ __('todos.add-new-todo') }}
                            </a>
                        </p>

                    @else

                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><span class="fa fa-search"></span></div>
                            </div>
                            <input type="text" class="form-control dom-search" data-search-items=".todo" id="todoSearch" placeholder="Search To Dos">
                        </div>

                        <div class="list-group shadow mt-3 todo-list" id="todos">

                            @foreach ($allTodos as $todo)
                                <a class="todo list-group-item list-group-item-action" href="{{ route('family.todos.edit', [$family, $todo]) }}">
                                    {!! $todo->createdBy->icon(['mr-2']) !!}
                                    {{ $todo->title }} - {{ $todo->due_date }}
                                </a>
                            @endforeach

                        </div>

                    @endif

                </div>

            </div>

        </div>

    </div>

@endsection
