@extends('layouts.app')

@section('title')
    - {{ $family->name }} - {{ __('contacts.contacts') }}
@endsection

@push('stylesheets')
    {{--<link rel="stylesheet" type="text/css" href="{{ mix('css/family/member/home.css') }}" />--}}
@endpush

@push('scripts')
    {{--<script type="text/javascript" src="{{ mix('js/family.merchants.index.js') }}"></script>--}}
@endpush

@section('content')

    @include('family.shared.breadcrumb', [
        'location'   => __('contacts.contacts'),
        'menu' => [
            ['type' => 'link', 'href' => route('family.contacts.create', [$family]), 'icon' => 'fa fa-plus-circle', 'text' => __('contacts.add-new-contact')],
        ]
    ])

    <div class="row">

        <div class="col-12">

            <h2>{{ __('contacts.contacts') }}</h2>

            <hr>

            <div class="row justify-content-center mt-3">

                <div class="col-12 d-flex mb-3">

                    <div class="flex-grow-1">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><span class="fa fa-search"></span></div>
                            </div>
                            <input type="text" class="form-control dom-search" data-search-items="#contactsTable tr.contact" id="contactSearch" placeholder="{{ __('contacts.search-contacts') }}" autofocus>
                        </div>
                    </div>

                    <div class="flex-grow-0">
                        <a class="btn btn-primary btn-sm ml-3" href="{{ route('family.contacts.create', [$family]) }}">
                            <span class="fa fa-plus-circle"></span>
                            {{ __('contacts.add-new-contact') }}
                        </a>
                    </div>

                </div>

                <div class="col-12">

                    <div class="table-responsive">

                        <table class="table table-striped" id="contactsTable">
                            <thead class="table-dark">
                                <tr>
                                    <th style="width: 50%;">
                                        {{ __('contacts.name') }}
                                    </th>
                                    <th>
                                        {{ __('contacts.phone') }}
                                    </th>
                                    <th>
                                        {{ __('contacts.birthdate') }}
                                    </th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($contacts as $contact)
                                    <tr class="contact">
                                        <td>
                                            <a href="{{ route('family.contacts.show', [$family, $contact]) }}">
                                                @if ($contact->name)
                                                    {{ $contact->name }}
                                                @else
                                                    <em>&lt;No Name&gt;</em>
                                                @endif
                                            </a>
                                        </td>
                                        <td>{{ $contact->phone }}</td>
                                        <td>{{ $contact->birthdate }}</td>
                                    </tr>
                                @endforeach
                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection
