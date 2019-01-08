@extends('layouts.print')

@section('title')
    - {{ $family->name }} - {{ __('cash-flow-plans.cash-flow-plans') }} - {{ __('months.' . $cashFlowPlan->month) }} {{ $cashFlowPlan->year }}
@endsection

@push('stylesheets')
    <link rel="stylesheet" type="text/css" href="{{ mix('css/family.cash-flow-plans.show.css') }}" />
@endpush

@push('scripts')
    <script type="text/javascript" src="{{ mix('js/family.cash-flow-plans.show.js') }}"></script>
@endpush

@push('meta')
    @meta('cash-flow-plan-id', $cashFlowPlan->id)
@endpush

@section('print-options')

@endsection

@section('content')

Here's some print content

@endsection
