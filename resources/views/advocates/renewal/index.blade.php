@extends('adv-static')

@section('title')
    @parent
    | Renewal
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
                                <h5>Practising & Notary Public Certificate Renewal</h5>
                                <span>{{ Auth::user()->full_name }} - {{ Auth::user()->email }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <nav class="breadcrumb-container" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ url('auth/advocate-profile') }}"><i class="ik ik-home"></i></a>
                                    <li class="breadcrumb-item active" aria-current="page">Renewal</li>
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
                                <p class="lead"><i class="ik ik-edit"></i> Application for Practising Certificate 2023 </p><hr/>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="exampleSelectGender">Choose Payment Mode</label>
                                        <select name="olevel" class="form-control is-valid required" id="exampleSelectLevel" required>
                                            <option value="">--Choose one--</option>
                                            <option value="Individual">Individual</option>
                                            <option value="Group">Group</option>
                                        </select>
                                    </div>
                                </div>

                                <form class="forms-sample" method="POST" action="{{ url('renewal/tls-check')}}">
                                    {{ csrf_field() }}
                                    <div class="table-responsive">
                                        <table class="table table-borderless" style="font: size 20px;">
                                            <tr>
                                                <th style="width:20%;text-align:right;">Practising Certificate Fee:</th>
                                                <td>Tsh 100000/=</td>
                                            </tr>
                                            <tr>
                                                <th style="width:20%;text-align:right;">Notary Public Certificate Fee:</th>
                                                <td>Tsh 40000/=</td>
                                            </tr>
                                            <tr>
                                                <th style="width:20%;text-align:right;">Total Amount:</th>
                                                <td>Tsh 140000/=</td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-danger pull-left">Submit for TLS Compliance Check</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>

@endsection

