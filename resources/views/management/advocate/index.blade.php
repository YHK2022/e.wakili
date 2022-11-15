@extends('mgt-static')

@section('title')
    @parent
    | Roll of Advocates
@stop

@section('content')
<div class="main-content">
    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-users bg-red"></i>
                        <div class="d-inline">
                                <h5>Roll of Advocates</h5>
                            <span>Roll of Advocates</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ url('auth/dashboard') }}"><i class="ik ik-home"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Roll of Advocates</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <!-- Start Alert-->
            @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <i class="ik ik-x"></i>
                </button>
            </div>
            @endif
            @if (session('warning'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                {{ session('warning') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <i class="ik ik-x"></i>
                </button>
            </div>
            @endif
            @if($errors->any())
                @foreach($errors->all() as $error)
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    {{ $error }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <i class="ik ik-x"></i>
                    </button>
                    </div>
                @endforeach
            @endif

        <!-- End Alert-->

        <div class="row">
            <div class="col-md-12">
                        <div class="card">
                            <ul class="nav nav-pills custom-pills" id="pills-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="pills-timeline-tab" data-toggle="pill" href="#all" role="tab" aria-controls="pills-timeline" aria-selected="true">ALL <span class="badge bg-warning" style="color: white">{{$all_count}}</span></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-timeline-tab" data-toggle="pill" href="#practising" role="tab" aria-controls="pills-timeline" aria-selected="true">PRACTISING <span class="badge bg-warning" style="color: white">{{$practising_count}}</span></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#non_practising" role="tab" aria-controls="pills-profile" aria-selected="false">NON PRACTISING <span class="badge bg-warning" style="color: white">{{$non_practising_count}}</span></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-setting-tab" data-toggle="pill" href="#suspended" role="tab" aria-controls="pills-setting" aria-selected="false">SUSPENDED <span class="badge bg-warning" style="color: white">{{$suspended_count}}</span></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-setting-tab" data-toggle="pill" href="#deferred" role="tab" aria-controls="pills-setting" aria-selected="false">DEFERRED <span class="badge bg-warning" style="color: white">{{$deferred_count}}</span></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-setting-tab" data-toggle="pill" href="#non_profit" role="tab" aria-controls="pills-setting" aria-selected="false">NON PROFIT <span class="badge bg-warning" style="color: white">{{$non_profit_count}}</span></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-setting-tab" data-toggle="pill" href="#retired" role="tab" aria-controls="pills-setting" aria-selected="false">RETIRED <span class="badge bg-warning" style="color: white">{{$retired_count}}</span></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-setting-tab" data-toggle="pill" href="#deceased" role="tab" aria-controls="pills-setting" aria-selected="false">DECEASED <span class="badge bg-warning" style="color: white">{{$deceased_count}}</span></a>
                                </li>
                            </ul>
                            <div class="tab-content" id="pills-tabContent">

                                <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="pills-timeline-tab">
                                    <div class="card-body">
                                        <table class="table table-hover" id="table_id">
                                            <thead>
                                            <tr>
                                                <th id="table_id" data-priority="1">#</th>
                                                <th id="table_id">Full Name</th>
                                                <th id="table_id">Roll Number</th>
                                                <th id="table_id">Admission Date</th>
                                                <th id="table_id">Status</th>
                                                <th id="table_id" data-priority="2">Action</th>

                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($all_advocates as $key => $advocate)
                                                <tr>
                                                    <td id="table_id">{{++$key}}</td>
                                                    <td id="table_id">{{$advocate->profile->fullname}}</td>
                                                    <td id="table_id">{{$advocate->roll_no}}</td>
                                                    <td id="table_id">{{$advocate->admission}}</td>
                                                    <td id="table_id">
                                                        @if ($advocate->paid_year != $cur_year)
                                                            <span class="badge bg-danger" style="color: white">Not Active</span>
                                                        @else
                                                            <span class="badge bg-success" style="color: white">Active</span>
                                                        @endif
                                                    </td>
                                                    <td id="table_id">
                                                        <div class="table-actions">
                                                            <a href="{{ url('advocate/view', $advocate->uid) }}" title="View Profile" ><i class="ik ik-eye pull-left"></i></a>
                                                        </div>
                                                    </td>
                                                </tr>

                                                <!-- View Advocate Model-->
                                                <div class="modal fade" id="view{{$advocate->uid}}" tabindex="-1" role="dialog" aria-labelledby="demoModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title"><center>Advocate Profile</center></h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="col-lg-4 col-md-5">
                                                                <div class="card">
                                                                    <div class="card-body text-center">
                                                                        <div class="profile-pic mb-20">

                                                                            @if(!empty($profile->picture))
                                                                                <img src="{{ asset('storage/files/'.$profile->picture) }}" width="150" class="rounded-circle" alt="user">
                                                                            @else
                                                                                <img src="{{ URL::to('images/user.png') }}" width="150" class="rounded-circle" alt="user">
                                                                            @endif

                                                                            @if ($advocate->paid_year != $cur_year)
                                                                                <span class="badge bg-danger" style="color: white">Not Active Since {{$advocate->paid_year}}</span>
                                                                            @else
                                                                                <span class="badge bg-success" style="color: white">Active - {{$advocate->paid_year}}</span>
                                                                            @endif

                                                                            <h5 class="mt-20 mb-0">{{ $advocate->profile->fullname}}</h5>
                                                                            <a style="font-size:17px;color:blue;" ><strong>{{$advocate->status}}</strong></a>
                                                                        </div>
                                                                        <div class="badge badge-pill badge-dark">Admission<br/>{{$advocate->admission}}</div>
                                                                        <div class="badge badge-pill badge-dark">Roll No.<br/>{{$advocate->roll_no}}</div>
                                                                    </div>

                                                                    <hr class="mb-0">

                                                                        <div class="card-body">
                                                                            <h6 class="mt-30">Firm/Work Place:</h6>
                                                                        </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="tab-pane fade show active" id="practising" role="tabpanel" aria-labelledby="pills-timeline-tab">
                                    <div class="card-body">

                                    </div>
                                </div>

                                <div class="tab-pane fade" id="non_practising" role="tabpanel" aria-labelledby="pills-profile-tab">
                                    <div class="card-body">

                                    </div>
                                </div>

                                <div class="tab-pane fade" id="suspended" role="tabpanel" aria-labelledby="pills-setting-tab">
                                    <div class="card-body">

                                    </div>
                                </div>

                                <div class="tab-pane fade" id="deferred" role="tabpanel" aria-labelledby="pills-setting-tab">
                                    <div class="card-body">

                                    </div>
                                </div>

                                <div class="tab-pane fade" id="non_profit" role="tabpanel" aria-labelledby="pills-setting-tab">
                                    <div class="card-body">

                                    </div>
                                </div>

                                <div class="tab-pane fade" id="retired" role="tabpanel" aria-labelledby="pills-setting-tab">
                                    <div class="card-body">

                                    </div>
                                </div>

                                <div class="tab-pane fade" id="deceased" role="tabpanel" aria-labelledby="pills-setting-tab">
                                    <div class="card-body">

                                    </div>
                                </div>

                            </div>
                        </div>

            </div>
        </div>

    </div>
</div>

@endsection


