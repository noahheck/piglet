<h1>Families - {{ $families->count() }}</h1>

<table class="table table-sm table-striped table-hover">
    <thead class="thead-dark">
        <tr>
            <th>Name</th>
            <th>Created By</th>
            <th>Last Accessed</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($families as $family)
            <tr>
                <td>{{ $family->name }}</td>
                <td>{{ $family->createdBy->firstName }} {{ $family->createdBy->lastName }}</td>
                <td>&nbsp;</td>
            </tr>
        @endforeach
    </tbody>
</table>
