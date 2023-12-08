<?php
/**
 * Created by Paul Iyaji.
 * Date: 24/11/2023
 * Time: 09:25
 * Project Name: monis-api-homebase
 */
?>

<!-- /.Navigation -->
<div class="sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            <li class="active"><a href="{{ url('dashboard') }}" class="material-ripple"><i class="material-icons">home</i> Dashboard</a></li>
            <li>
                <a href="#" class="material-ripple"><strong style="color: white;"><i class="material-icons">checklist</i>Recruitment System</strong><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a href="{{ url('admin/applicants') }}">List of Applicants</a></li>
                    <li><a href="#">CBT Scores</a></li>
                    <li><a href="#">Interviews</a></li>
                    <li><a href="#">ShortListed Candidates</a></li>
                </ul>
            </li>

            <li>
                <a href="#" class="material-ripple"><strong style="color: white;"><i class="material-icons">people</i> HRMS</strong><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a href="{{ route('employees.index') }}">Employees</a></li>
                    <li><a href="{{ route('leaves.index') }}">Leave</a></li>
                    <li><a href="{{ route('transfers.index') }}">Transfer</a></li>
                    <li><a href="{{ route('promotions.index') }}">Promotion</a></li>
                    <li><a href="{{ route('deployments.index') }}">Deployment</a></li>
                    <li><a href="{{ route('trainings.index') }}">Training</a></li>
                    <li><a href="{{ route('disciplines.index') }}">Discipline</a></li>
                    <li><a href="{{ route('certifications.index') }}">Certifications</a></li>
                    <li><a href="{{ route('qualifications.index') }}">Qualifications</a></li>

                </ul>
            </li>
            <li>
                <a href="#" class="material-ripple"><strong style="color: white;"><i class="material-icons">insert_emoticon</i> Self Service</strong><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a href="#">Leave Request</a></li>
                    <li><a href="#">Training Request</a></li>

                </ul>
            </li>
            <li>
                <a href="#" class="material-ripple"><strong style="color: white;"><i class="material-icons">settings</i> Settings</strong><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a href="{{ route('commands.index') }}">Commands</a></li>
                    <li><a href="{{ route('offices.index') }}">Offices</a></li>
                    <li><a href="{{ route('departments.index') }}">Department</a></li>
                    <li><a href="{{ route('divisions.index') }}">Divisions</a></li>
                    <li><a href="{{ route('units.index') }}">Units</a></li>
                    <li><a href="{{ route('ranks.index') }}">Ranks</a></li>
                    <li><a href="{{ route('designations.index') }}">Designations</a></li>
                    <li><a href="{{ route('leavetypes.index') }}">Leave Types</a></li>
                    <li><a href="{{ route('traininglists.index') }}">Training Lists</a></li>

                    <li><a href="#" class="material-ripple"><i class="material-icons">bookmark</i> Documentation</a></li>

                </ul>
            </li>
            <li>
                <form method="POST" action="{{ route('logout') }}" style="padding-left: 18px;">
                    @csrf
                <a href="{{ url('logout') }}" class="material-ripple" data-toggle="modal" data-target="#logoutModal"><i class="material-icons">logout</i> Logout</a>
                </form>
            </li>


        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>
<!-- /.Left Sidebar-->
<div class="side-bar right-bar">
    <div class="">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs right-sidebar-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab"><i class="material-icons">home</i></a></li>
            <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab"><i class="material-icons">person_add</i></a></li>
            <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab"><i class="material-icons">chat</i></a></li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane fade  in active" id="home">
                <ul id="styleOptions" title="switch styling">
                    <li><b>Dark Skin</b></li>
                    <li><a href="javascript: void(0)" data-theme="skin-blue.min"><img src="{{ asset('assets/dist/img/theme-color/1.jpg') }}" alt=""/></a></li>
                    <li><a href="javascript: void(0)" data-theme="skin-dark.min"><img src="{{ asset('assets/dist/img/theme-color/2.jpg') }}" alt=""/></a></li>
                    <li><a href="javascript: void(0)" data-theme="skin-red-light.min" class="skin-logo"><img src="{{ asset('assets/dist/img/theme-color/5.jpg') }}" alt=""/></a></li>
                    <li><b>Dark Skin sidebar</b></li>
                    <li><a href="javascript: void(0)" data-theme="skin-default.min"><img src="{{ asset('assets/dist/img/theme-color/7.jpg') }}" alt=""/> </a></li>
                    <li><a href="javascript: void(0)" data-theme="skin-red-dark.min"><img src="{{ asset('assets/dist/img/theme-color/6.jpg') }}" alt=""/></a></li>
                    <li><a href="javascript: void(0)" data-theme="skin-dark-1.min"><img src="{{ asset('assets/dist/img/theme-color/8.jpg') }}" alt=""/></a></li>
                    <li><b>Light Skin sidebar</b></li>
                    <li><a href="javascript: void(0)" data-theme="skin-default-light.min" class="skin-logo"><img src="{{ asset('assets/dist/img/theme-color/3.jpg') }}" alt=""/></a></li>
                    <li><a href="javascript: void(0)" data-theme="skin-white.min"><img src="{{ asset('assets/dist/img/theme-color/4.jpg') }}" alt=""/></a> </li>
                </ul>
            </div>
            <div role="tabpanel" class="tab-pane fade " id="profile">
                <h3 class="sidebar-heading">Activity</h3>
                <div class="rad-activity-body">
                    <div class="rad-list-group group">
                        <a href="#" class="rad-list-group-item">
                            <div class="rad-list-icon bg-red pull-left"><i class="fa fa-phone"></i></div>
                            <div class="rad-list-content"><strong>Client meeting</strong>
                                <div class="md-text">Meeting at 10:00 AM</div>
                            </div>
                        </a>
                        <a href="#" class="rad-list-group-item">
                            <div class="rad-list-icon bg-yellow pull-left"><i class="fa fa-refresh"></i></div>
                            <div class="rad-list-content"><strong>Created ticket</strong>
                                <div class="md-text">Ticket assigned to Dev team</div>
                            </div>
                        </a>
                        <a href="#" class="rad-list-group-item">
                            <div class="rad-list-icon bg-primary pull-left"><i class="fa fa-check"></i></div>
                            <div class="rad-list-content"><strong>Activity completed</strong>
                                <div class="md-text">Completed the dashboard html</div>
                            </div>
                        </a>
                        <a href="#" class="rad-list-group-item">
                            <div class="rad-list-icon bg-green pull-left"><i class="fa fa-envelope"></i></div>
                            <div class="rad-list-content"><strong>New Invitation</strong>
                                <div class="md-text">Max has invited you to join Inbox</div>
                            </div>
                        </a>
                    </div>
                </div>
                <!-- /.sidebar-menu -->
                <h3 class="sidebar-heading">Tasks Progress</h3>
                <ul class="sidebar-menu">
                    <li>
                        <a href="#">
                            <h4 class="subheading">
                                Task one
                                <span class="label label-danger pull-right">40%</span>
                            </h4>
                            <div class="progress">
                                <div class="progress-bar progress-bar-danger progress-bar-striped active" style="width: 40%"></div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <h4 class="subheading">
                                Task two
                                <span class="label label-success pull-right">20%</span>
                            </h4>
                            <div class="progress">
                                <div class="progress-bar progress-bar-success progress-bar-striped active" style="width: 20%"></div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <h4 class="subheading">
                                Task Three
                                <span class="label label-warning pull-right">60%</span>
                            </h4>
                            <div class="progress">
                                <div class="progress-bar progress-bar-warning progress-bar-striped active" style="width: 60%"></div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <h4 class="subheading">
                                Task four
                                <span class="label label-primary pull-right">80%</span>
                            </h4>
                            <div class="progress">
                                <div class="progress-bar progress-bar-primary progress-bar-striped active" style="width: 80%"></div>
                            </div>
                        </a>
                    </li>
                </ul>
                <!-- /.sidebar-menu -->
            </div>
            <div role="tabpanel" class="tab-pane fade " id="messages">
                <div class="message_widgets">
                    <a href="#">
                        <div class="inbox-item">
                            <div class="inbox-item-img"><img src="{{ asset('assets/dist/img/avatar.png') }}" class="img-circle" alt=""></div>
                            <strong class="inbox-item-author">Naeem Khan</strong>
                            <span class="inbox-item-date">-13:40 PM</span>
                            <p class="inbox-item-text">Hey! there I'm available...</p>
                            <span class="profile-status available pull-right"></span>
                        </div>
                    </a>
                    <a href="#">
                        <div class="inbox-item">
                            <div class="inbox-item-img"><img src="{{ asset('assets/dist/img/avatar2.png') }}" class="img-circle" alt=""></div>
                            <strong class="inbox-item-author">Sala Uddin</strong>
                            <span class="inbox-item-date">-13:40 PM</span>
                            <p class="inbox-item-text">Hey! there I'm available...</p>
                            <span class="profile-status away pull-right"></span>
                        </div>
                    </a>
                    <a href="#">
                        <div class="inbox-item">
                            <div class="inbox-item-img"><img src="{{ asset('assets/dist/img/avatar3.png') }}" class="img-circle" alt=""></div>
                            <strong class="inbox-item-author">Mozammel</strong>
                            <span class="inbox-item-date">-13:40 PM</span>
                            <p class="inbox-item-text">Hey! there I'm available...</p>
                            <span class="profile-status busy pull-right"></span>
                        </div>
                    </a>
                    <a href="#">
                        <div class="inbox-item">
                            <div class="inbox-item-img"><img src="{{ asset('assets/dist/img/avatar4.png') }}" class="img-circle" alt=""></div>
                            <strong class="inbox-item-author">Tanzil</strong>
                            <span class="inbox-item-date">-13:40 PM</span>
                            <p class="inbox-item-text">Hey! there I'm available...</p>
                            <span class="profile-status offline pull-right"></span>
                        </div>
                    </a>
                    <a href="#">
                        <div class="inbox-item">
                            <div class="inbox-item-img"><img src="{{ asset('assets/dist/img/avatar5.png') }}" class="img-circle" alt=""></div>
                            <strong class="inbox-item-author">Amir Khan</strong>
                            <span class="inbox-item-date">-13:40 PM</span>
                            <p class="inbox-item-text">Hey! there I'm available...</p>
                            <span class="profile-status available pull-right"></span>
                        </div>
                    </a>
                    <a href="#">
                        <div class="inbox-item">
                            <div class="inbox-item-img"><img src="{{ asset('assets/dist/img/avatar.png') }}" class="img-circle" alt=""></div>
                            <strong class="inbox-item-author">Salman Khan</strong>
                            <span class="inbox-item-date">-13:40 PM</span>
                            <p class="inbox-item-text">Hey! there I'm available...</p>
                            <span class="profile-status available pull-right"></span>
                        </div>
                    </a>
                    <a href="#">
                        <div class="inbox-item">
                            <div class="inbox-item-img"><img src="{{ asset('assets/dist/img/avatar.png') }}" class="img-circle" alt=""></div>
                            <strong class="inbox-item-author">Tahamina</strong>
                            <span class="inbox-item-date">-13:40 PM</span>
                            <p class="inbox-item-text">Hey! there I'm available...</p>
                            <span class="profile-status available pull-right"></span>
                        </div>
                    </a>
                    <a href="#">
                        <div class="inbox-item">
                            <div class="inbox-item-img"><img src="{{ asset('assets/dist/img/avatar4.png') }}" class="img-circle" alt=""></div>
                            <strong class="inbox-item-author">Jhon</strong>
                            <span class="inbox-item-date">-13:40 PM</span>
                            <p class="inbox-item-text">Hey! there I'm available...</p>
                            <span class="profile-status offline pull-right"></span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.Right Sidebar -->
<div class=control-sidebar-bg></div>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: rgba(110,52,23,0.9); color: white; align-items: center;">
                <h4 class="modal-title" id="exampleModalLabel"></h4>
            </div>

            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer" style="display: flex;">
                <button type="button" class="btn" style="background-color: rgba(222,72,89,0.96); color: white; margin-right: 10px;" data-dismiss="modal">Close</button>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a class="btn btn-primary" :href="route('logout')"
                       onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </a>
                </form>
            </div>
        </div>

    </div>
</div>
