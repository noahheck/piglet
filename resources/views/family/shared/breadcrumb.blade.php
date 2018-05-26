<div class="row">

    <div class="col-12">

        <a href="{{ route('family.home', [$family]) }}">{{ __('family.family_home') }}</a> >

        @foreach ($breadcrumb as $href => $text)
            <a href="{{ $href }}">{{ $text }}</a> >
        @endforeach
        {{ $location }}

    </div>

</div>

<hr>
