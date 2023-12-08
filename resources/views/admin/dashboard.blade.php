@extends('layouts/admin-layout')

@section('content')
    <div class=content-header>
        <div class=header-icon>
            <i class=pe-7s-tools></i>
        </div>
        <div class=header-title>
            <ol class=breadcrumb>
                <li><a href={{ url('dashboard') }}><i class=pe-7s-home></i> Home</a></li>
                <li class=active>Dashboard</li>
            </ol>
        </div>
    </div>

        <div class=row>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                <div class="statistic-box statistic-filled-3">
                    <h2><span class=count-number>789</span> <span class=slight><i class="fa fa-play fa-rotate-270 text-warning"> </i> +29%</span></h2>
                    <div class=small>Total Applicants </div>

                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                <div class="statistic-box statistic-filled-1">
                    <h2><span class=count-number>696</span> <span class=slight><i class="fa fa-play fa-rotate-270 text-warning"> </i> +28%</span></h2>
                    <div class=small>Leave Requests</div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                <div class="statistic-box statistic-filled-2">
                    <h2><span class=count-number>321</span> <span class=slight><i class="fa fa-play fa-rotate-90 c-white"> </i> +10%</span> </h2>
                    <div class=small>Trainings</div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                <div class="statistic-box statistic-filled-4">
                    <h2><span class=count-number>5489</span> <span class=slight><i class="fa fa-play fa-rotate-90 c-white"> </i> +24%</span></h2>
                    <div class=small>Employees</div>
                </div>
            </div>
        </div>
        <div class=row>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 ">
                <div class="panel panel-bd ">
                    <div class=panel-body>
                        <div id=chartdiv></div>
                    </div>
                </div>
            </div>
        </div>
        <div class=row>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 ">
                <div class="panel panel-bd lobidrag">
                    <div class=panel-heading>
                        <div class=panel-title>
                            <i class=ti-panel></i>
                            <h4>CSS animations Chart</h4>
                        </div>
                    </div>
                    <div class=panel-body>
                        <div id=chartdiv2></div>
                    </div>
                </div>
            </div>
            <di class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
                <div class="panel panel-bd lobidisable">
                    <div class=panel-heading>
                        <div class=panel-title>
                            <i class=ti-archive></i>
                            <h4>Calender</h4>
                        </div>
                    </div>
                    <div class=panel-body>
                        <div class=monthly_calender>
                            <div class=monthly id=m_calendar></div>
                        </div>
                    </div>
                    <div class=panel-footer>
                        This is panel footer
                    </div>
                </div>
            </di>

        </div>
    </div>
</div>
</div>
@endsection
