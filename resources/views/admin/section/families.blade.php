<h1>Families - {{ $families->count() }}</h1>

<div class="input-group mb-3">
    <div class="input-group-prepend">
        <div class="input-group-text"><span class="fa fa-search"></span></div>
    </div>
    <input autofocus type="text" class="form-control dom-search" data-search-items="#familiesTable tbody tr" id="familiesSearch" placeholder="Search">
</div>

<div class="table-responsive">
    <table class="table table-sm table-striped table-hover" id="familiesTable">
        <thead class="thead-dark">
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Created By</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($families as $family)
                <tr>
                    <td>{{ $family->id }}</td>
                    <td>{{ $family->name }}</td>
                    <td>{{ $family->createdBy->firstName }} {{ $family->createdBy->lastName }} ({{ $family->createdBy->id }})</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
