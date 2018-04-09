@extends("layouts.app")

@section("content")


    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="class-title">
                        Hello, {{ Auth::user()->name }} !

                    </h4>
                </div>
            </div>
        </div>
    </div>






@endsection


@section("js")

@endsection
