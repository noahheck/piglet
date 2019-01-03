<h1>Users - {{ $users->count() }}</h1>

<table class="table table-sm table-striped table-hover">
    <thead class="thead-dark">
        <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Email Verified</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($users as $user)
            <tr>
                <td>{{ $user->firstName }}</td>
                <td>{{ $user->lastName }}</td>
                <td>{{ $user->email }}</td>
                <td><input type="checkbox" disabled {{ ($user->email_verified) ? "checked" : "" }}></td>
            </tr>
        @endforeach
    </tbody>
</table>
