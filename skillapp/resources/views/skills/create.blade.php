@extends("layouts.app")

@section("content")
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">

                    <div class="row">
                        <div class="col-md-10">
                            <h4 class="card-title">Define new skill</h4>
                        </div>

                    </div>
                </div>
                <div class="card-body">
                        <form action="{{route("skills.store")}}" method="post">
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
                                    <label>Skill Category</label>
                                    <select class="form-control" name="category">
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}">{{$category->name}}</option>

                                        @endforeach

                                    </select>

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
