@extends('mgt-static')

@section('title')
    @parent
    | Petition Applications
@stop

@section('content')
    <div class="main-content">
        <div class="container-fluid">
            <div class="page-header">
                <div class="row align-items-end">
                    <div class="col-lg-8">
                        <div class="page-header-title">
                            <i class="ik ik-lock bg-red"></i>
                            <div class="d-inline">
                                <h5>Petition Applications</h5>
                                <span>Under Review</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <nav class="breadcrumb-container" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ url('auth/dashboard') }}"><i class="ik ik-home"></i></a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Under Review</li>
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
                        <div class="card-body">
                            <table class="table table-hover" id="table_id">
                                <thead>
                                <tr>
                                    <th id="table_id" data-priority="1">#</th>
                                    <th id="table_id">Applicant Name</th>
                                    <th id="table_id">Application Type</th>
                                    <th id="table_id">Current Stage</th>
                                    <th id="table_id">Status</th>
                                    <th id="table_id">Submitted Date</th>
                                    <th id="table_id">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($applications as $key => $application)
                                    <tr>
                                        <td id="table_id">{{++$key}}</td>
                                        <td id="table_id">{{$application->profile_detail->fullname}}</td>
                                        <td id="table_id">{{$application->type}}</td>
                                        <td id="table_id"> Front Desk </td>
                                        <td id="table_id">{{$application->status}}</td>
                                        <td id="table_id">{{$application->submission_at}}</td>
                                        <td id="table_id">
                                            <div class="table-actions">

                                            </div>
                                        </td>
                                    </tr>


                                @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection


