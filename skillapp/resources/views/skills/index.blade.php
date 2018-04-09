@extends("layouts.app")

@section("content")
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">

                    <div class="row">
                        <div class="col-md-10">
                            <h4 class="card-title">Search user by skill-set</h4>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div id="searchskillset">
                        <treeselectmultiple v-if="loaded" :optionss="optionss" multiple="multiple"  valueConsistsOf="ALL"></treeselectmultiple>
                        <template v-for="user of users">
                            <br>
                            <div class="row">
                                <div class="col-md-3">
                                    @{{ user.name }}
                                </div>
                                <div class="col-md-3">
                                    @{{ user.email }}
                                </div>
                                <div class="col-md-3">
                                    <a :href="'http://ax.way/skillapp/users/'+user.id+'/edit'">View Profile</a>
                                </div>
                            </div>
                        </template>
                        <button class="btn btn-outline-warning" @click="search">Search</button>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">

                    <div class="row">
                        <div class="col-md-10">
                            <h4 class="card-title">Skills</h4>
                        </div>
                        <div class="col-md-2">
                            <a href="{{route("skills.create")}}" class="btn btn-primary">+ Add new </a>

                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table" id="skills_table">
                        <thead class=" text-primary">
                        <tr>
                            <td>Id</td>
                            <td>Name</td>
                            <td>Category</td>
                            <td>Actions</td>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($skills as $skill)
                            <tr>
                                <td>
                                    {{$skill->id}}
                                </td>
                                <td>
                                    {{$skill->name}}
                                </td>
                                <td>
                                    {{$skill->category->name}}
                                </td>
                                <td>
                                    <a class="btn btn-info" href="{{route("skills.edit", $skill->id)}}">View</a>
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
            $('#skills_table').DataTable();
        });
    </script>
@endsection
