{{--
$tableData should be an instance of \App\TableData
--}}
@php
$__tableClasses = 'table '. e(implode(' ', $tableData->getTableClasses()));
$__tableClasses .= ($tableData->striped())   ? ' table-striped'  : '';
$__tableClasses .= ($tableData->bordered())  ? ' table-bordered' : '';
$__tableClasses .= ($tableData->hoverable()) ? ' table-hover'    : '';

$__colHeaderTag = ($tableData->highlightColumnHeaders()) ? 'th' : 'td';
$__rowHeaderTag = ($tableData->highlightRowHeaders())    ? 'th' : 'td';
@endphp
@if ($tableData->responsive())
    <div class="table-responsive">
@endif

<table class="{{ $__tableClasses }}">
    @if ($__caption = $tableData->caption())
        <caption>{{ $__caption }}</caption>
    @endif

    @foreach ($tableData->getHeaders() as $header)
        @if ($loop->first)
            <tr>
        @endif
                <{{ $__colHeaderTag }}>{{ $header }}</{{ $__colHeaderTag }}>
        @if ($loop->last)
            </tr>
        @endif
    @endforeach

    @foreach ($tableData->getRows() as $row)

        @foreach ($row as $cellData)
            @if ($loop->first)
                <tr>
                    <{{ $__rowHeaderTag }}>{{ $cellData }}</{{ $__rowHeaderTag }}>
            @else
                <td>{{ $cellData }}</td>
            @endif

            @if ($loop->last)
                </tr>
            @endif
        @endforeach
    @endforeach

</table>

@if ($tableData->responsive())
    </div>
@endif
