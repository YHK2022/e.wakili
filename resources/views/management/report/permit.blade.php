@extends('mgt-static')

@section('title')
    @parent
    | Permit
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
                                <h5>Permit Report</h5>
                            <span>Permit Report</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ url('auth/dashboard') }}"><i class="ik ik-home"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Permit Report</li>
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
                            {{-- <ul class="nav nav-pills custom-pills" id="pills-tab" role="tablist">
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
                            </ul> --}}
                            <div class="tab-content" id="pills-tabContent">

                                <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="pills-timeline-tab">
                                    <div class="card-body">
                                        <table class="table table-hover" id="table_id">                                                {{-- anza changes --}}

                                            <thead>
                                            <tr>

                                                <th id="table_id" data-priority="1">#</th>
                                                <th id="table_id">Full Name</th>
                                                <th id="table_id">Application Type</th>
                                                <th id="table_id">Description</th>
                                                <th id="table_id">Status</th>
                                                <th id="table_id">Submission Date</th>
                                                <th id="table_id">Current Stage</th>
                                            
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($permits as $key => $permit)
                                                <tr>
                                                    <td id="table_id">{{++$key}}</td>
                                                    <td id="table_id">{{$permit->fullname}}</td>
                                                    <td id="table_id">{{$permit->type}}</td>
                                                    <td id="table_id">{{$permit->display_name}}</td>
                                                    <td id="table_id">{{$permit->status}}</td>
                                                    <td id="table_id">{{$permit->submission_at}}</td>
                                                    <td id="table_id">{{$permit->current_stage}}</td>
                                                    
                                                 
                                                </tr>

                                              
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


