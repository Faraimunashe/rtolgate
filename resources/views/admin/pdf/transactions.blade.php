<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>report</title>
</head>
<body>
    <h1>Transactions Report</h1>
    <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>User</th>
                <th>Activity</th>
                <th>Amount</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @php
                $count = 0;
            @endphp
            @foreach ($transactions as $item)
                <tr>
                    <td>
                        @php
                            $count++;
                            echo $count;
                        @endphp
                    </td>
                    <td>
                        @php
                            $user = \App\Models\User::find($item->user_id);
                            echo $user->name;
                        @endphp
                    </td>
                    <td>{{ $item->action }}</td>
                    <td>{{ $item->amount }}</td>
                    <td>{{ $item->status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>

