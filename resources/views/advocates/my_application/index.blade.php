@extends('adv-static')

@section('title')
    @parent
    | My Applications
@stop

@section('content')
    <div class="main-content">
        <div class="container-fluid">
            <div class="page-header">
                <div class="row align-items-end">
                    <div class="col-lg-8">
                        <div class="page-header-title">
                            <i class="ik ik-edit bg-red"></i>
                            <div class="d-inline">
                                <h5>My Applications</h5>
                                <span>{{ Auth::user()->full_name }} - {{ Auth::user()->email }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <nav class="breadcrumb-container" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ url('auth/advocate-profile') }}"><i class="ik ik-home"></i></a>
                                <li class="breadcrumb-item active" aria-current="page">My Applications</li>
                                </li>
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
                            <div class="col-12">
                                <p class="lead"><i class="ik ik-edit"></i> My Applications / Activities </p><hr/>

                                <div class="container">
                                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                        @if($applications)
                                            @foreach($applications as $application)
                                                <div class="panel panel-default">
                                                    <div class="panel-heading" role="tab" id="headingOne">
                                                        <h4 class="panel-title">
                                                            <a style="font-size: medium; color: darkred" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne{{ $application->uid }}" aria-expanded="true" aria-controls="collapseOne">
                                                                 {{ $application->submission_at }}: {{ $application->type }} - {{ $application->status }}
                                                            </a>
                                                        </h4>
                                                    </div>
                                                    <div id="collapseOne{{ $application->uid }}" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                                        <div class="panel-body">
                                                            Application Attachments goes Here
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif


                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>

@endsection

