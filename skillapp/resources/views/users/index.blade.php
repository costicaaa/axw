@extends("layouts.app")

@section("content")
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">

                    <div class="row">
                        <div class="col-md-10">
                            <h4 class="card-title">Users</h4>
                        </div>
                        <div class="col-md-2">
                            <a href="{{route("users.create")}}" class="btn btn-primary">+ Add new </a>

                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table" id="users_table">
                        <thead class=" text-primary">
                        <tr>
                            <td>Id</td>
                            <td>Name</td>
                            <td>Email</td>
                            <td>Matricola</td>
                            <td>Actions</td>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>
                                    {{$user->id}}
                                </td>
                                <td>
                                    {{$user->name}}
                                </td>
                                <td>
                                    {{$user->email}}
                                </td>
                                <td>
                                    {{$user->matricola}}
                                </td>
                                <td>
                                    <a class="btn btn-info" href="{{route("users.edit", $user->id)}}">View</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection


@section("js")
    <script>
        $(document).ready(function () {
            $('#users_table').DataTable();
        });
    </script>
@endsection
