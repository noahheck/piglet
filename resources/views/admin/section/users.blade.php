<h1>Users - {{ $users->count() }}</h1>

<div class="input-group mb-3">
    <div class="input-group-prepend">
        <div class="input-group-text"><span class="fa fa-search"></span></div>
    </div>
    <input autofocus type="text" class="form-control dom-search" data-search-items="#usersTable tbody tr" id="usersSearch" placeholder="Search">
</div>

<div class="table-responsive">
    <table class="table table-sm table-striped table-hover" id="usersTable">
        <thead class="thead-dark">
            <tr>
                <th>Id</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th class="text-center">Email Verified</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->firstName }}</td>
                    <td>{{ $user->lastName }}</td>
                    <td>{{ $user->email }}</td>
                    <td class="text-center"><span class="fa {{ ($user->email_verified) ? "fa-check-square-o" : "fa-square-o" }}"></span></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
