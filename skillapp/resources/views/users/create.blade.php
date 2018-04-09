@extends("layouts.app")

@section("content")
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">

                    <div class="row">
                        <div class="col-md-10">
                            <h4 class="card-title">Create new user</h4>
                        </div>

                    </div>
                </div>
                <div class="card-body">
                        <form action="{{route("users.store")}}" method="post">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group @if ($errors->has('name')) has-danger @endif">
                                        <label>Name</label>
                                        <input value="{{old('name')}}" class="form-control " type="text" name="name">
                                        @if ($errors->has('name'))
                                            @foreach ($errors->get('name') as $message)
                                                <p>{{$message}}</p>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group @if ($errors->has('email')) has-danger @endif">
                                        <label>Email</label>
                                        <input  value="{{old('email')}}" class="form-control form-control-wide" type="email" name="email">
                                        @if ($errors->has('email'))
                                            @foreach ($errors->get('email') as $message)
                                                <p>{{$message}}</p>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group @if ($errors->has('email')) has-danger @endif">
                                        <label>Password</label>
                                        <input class="form-control " type="password" name="password">
                                        @if ($errors->has('password'))
                                            @foreach ($errors->get('password') as $message)
                                                <p>{{$message}}</p>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Confirm password</label>
                                        <input class="form-control " type="password" name="password_confirmation">
                                    </div>
                                </div>
                            </div>


                            <input type="submit" value="Save" class="btn btn-warning">
                        </form>
                    </div>
            </div>
        </div>
    </div>

@endsection


@section("js")
    <script>
        $(".form-group").on("keydown", function(){
           $(this).removeClass("has-danger");
        });
    </script>
@endsection
