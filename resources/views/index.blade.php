<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel CRUD With Multiple Image Upload</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <!-- Font-awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
</head>

<body>

    <div class="container" style="margin-top: 50px;">

        <h3 class="text-center text-danger"><b>Laravel CRUD</b> </h3>
        <a href="/create" class="btn btn-outline-success">Add New Product</a>

        <table class="table table-bordered data-table">
            <thead>
                <tr>
                    <th>SR.NO</th>
                    <th>Name</th>
                    <th>category</th>
                    <th>price</th>
                    <th>quantity</th>
                    <th>Description</th>
                    <th>View</th>
                    <th>Update</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $val)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $val->name }}</td>
                        @php
                            $catogory = ['Books', 'Electronics', 'Furniture', 'Beauty', 'Mobile', 'shoes ', 'Clothing'];
                        @endphp
                        @foreach ($catogory as $value => $label)
                            @if ($val->category == $value)
                                <td> {{ $label }}
                                </td>
                            @endif
                        @endforeach
                        <td>{{ $val->price }}</td>
                        <td>{{ $val->quantity }}</td>
                        <td>{{ $val->description }}</td>
                        <td><a href="/view/{{ $val->id }}" class="btn btn-outline-success">View</a></td>
                        <td><a href="/edit/{{ $val->id }}" class="btn btn-outline-primary">Update</a></td>
                        <td>
                            <form action="/delete/{{ $val->id }}" method="post">
                                <button class="btn btn-outline-danger" onclick="return confirm('Are you sure?');"
                                    type="submit">Delete</button>
                                @csrf
                                @method('delete')
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
