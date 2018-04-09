@extends("layouts.app")

@section("content")


    @if($js_array !== null)
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">

                    </div>
                    <div class="card-body">
                        <div id="curve_chart" style="width: auto; height: 500px"></div>
                    </div>
                </div>

            </div>
        </div>
    @endif

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-10">
                            <h4 class="card-title">User {{$user->name}} info</h4>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="#" method="post">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group @if ($errors->has('name')) has-danger @endif">
                                    <label>Name</label>
                                    <input value="{{$user->name}}" class="form-control " type="text" name="name">
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
                                    <input value="{{$user->email}}" class="form-control" type="email" name="email">
                                    @if ($errors->has('email'))
                                        @foreach ($errors->get('email') as $message)
                                            <p>{{$message}}</p>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Matricola</label>
                                    <input disabled="disabled" value="{{$user->matricola}}" class="form-control"
                                           type="email" name="email">

                                </div>
                            </div>
                        </div>
                        <input type="submit" disabled="disabled" value="Save" class="btn btn-warning">
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row" id="assignskills">
        <input type="hidden" id="USER_ID" value="{{$user->id}}">
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-10">
                            <h4 class="card-title">Assign skills</h4>
                        </div>
                    </div>
                </div>
                <div class="card-body" >
                    <treeselect v-if="loaded" :optionss="optionss" v-model="cici" valueConsistsOf="ALL"></treeselect>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <skill v-for="skill of assignedSkills" :skill_info="skill"></skill>

        </div>

        <div class="col-md-3">
            @foreach($skills_history as $skill_history)
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="card-title">{{\App\Models\Skill::find($skill_history->first()->skill_id)->name}}</h4>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <td>
                                        Updated at
                                    </td>
                                    <td>
                                        Value
                                    </td>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach($skill_history as $item)

                                    <tr @if($loop->first)
                                            class="row-important"
                                        @endif>
                                        <td>

                                            {{$item->updated_at}}
                                        </td>
                                        <td>
                                            {{$item->value}} : {{$texts_array[$item->value]}}
                                        </td>
                                    </tr>

                                @endforeach
                            </tbody>
                        </table>


                    </div>
                </div>
            @endforeach
        </div>
    </div>



@endsection


@section("js")
    <script>
        $(".form-group").on("keydown", function () {
            $(this).removeClass("has-danger");
        });


    </script>


    @if($js_array !== null)
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript">
            google.charts.load('current', {'packages':['corechart']});
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {
//            var data = google.visualization.arrayToDataTable([
//                ['Year', 'Sales', 'Expenses', "another shit"],
//                ['2004',  1000,      400, 3],
//                ['2005',  1170,      460, 4],
//                ['2006',  660,       1120, 5],
//                ['2007',  1030,      540, 6]
//            ]);
                var data = google.visualization.arrayToDataTable({!! $js_array !!});

                var options = {
                    title: 'Skills progress',
                    curveType: 'function',
                    legend: { position: 'bottom' },
                    hAxis: { textPosition: 'none' },

                };

                var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

                chart.draw(data, options);
            }
        </script>
    @endif

@endsection
