@extends("layouts.app")

@section("content")
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">

                    @if (Session::has('message'))
                        <div class="alert alert-info">{{ Session::get('message') }}</div>
                    @endif

                    <div class="row">
                        <div class="col-md-10">
                            <h4 class="card-title">Edit skill</h4>
                        </div>

                    </div>
                </div>
                <div class="card-body">
                    <form action="{{route("skills.update", $skill->id)}}" method="post">
                        <input type="hidden" name="_method" value="PUT">

                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group @if ($errors->has('name')) has-danger @endif">
                                    <label>Name</label>
                                    <input value="{{$skill->name}}" class="form-control " type="text" name="name">
                                    @if ($errors->has('name'))
                                        @foreach ($errors->get('name') as $message)
                                            <p>{{$message}}</p>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">

                                <label>Skill Category</label>
                                <select style="height: 36px" class="form-control" name="category">
                                    @foreach($categories as $category)
                                        <option @if($skill->category_id === $category->id) selected @endif value="{{$category->id}}">{{$category->name}}</option>

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
