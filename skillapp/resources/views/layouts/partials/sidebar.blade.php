    <div class="sidebar" data-color="blue">
        <!--
    Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
-->
        <div class="logo">
            <a href="http://www.creative-tim.com" class="simple-text logo-mini">
                AXW
            </a>
            <a href="http://www.creative-tim.com" class="simple-text logo-normal">
                SkillsApp
            </a>
        </div>

        <div class="sidebar-wrapper">
            <ul class="nav">
                <li class="{{\Illuminate\Support\Facades\Request::path() == "dashboard" ? "active" : ''}}">
                    <a href="{{route("dashboard")}}">
                        <i class="now-ui-icons design_app"></i>
                        <p style="color: {{\Illuminate\Support\Facades\Request::path() == "dashboard" ? "#0070ff" : 'white'}}">Dashboard </p>
                    </a>
                </li>
                <li class="{{\Illuminate\Support\Facades\Request::path() == "users" ? "active" : ''}}">
                    <a href="{{route("users.index")}}">
                        <i class="now-ui-icons users_single-02"></i>
                        <p style="color: {{\Illuminate\Support\Facades\Request::path() == "users" ? "#0070ff" : 'white'}}" >Users</p>
                    </a>
                </li>
                <li class="{{\Illuminate\Support\Facades\Request::path() == "skils" ? "active" : ''}}" >
                    <a href="{{route("skills.index")}}">
                        <i class="now-ui-icons education_atom"></i>
                        <p style="color: white">Skills</p>
                    </a>
                </li>

            </ul>
        </div>
    </div>