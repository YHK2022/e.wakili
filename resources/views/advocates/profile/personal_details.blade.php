@extends('adv-static')

@section('title')
    @parent
    | Application for Petition
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
                            <h5>Personal & Contact Info</h5>
                            <span>{{ Auth::user()->username }} - {{ Auth::user()->email }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ url('auth/advocate-profile') }}"><i class="ik ik-home"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Personal & Contact Info</li>
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
            <div class="accordion" id="accordionExample">
            @if($profile)
            <div class="card">
                <div class="card-header" id="headingOne">
                <h2 class="mb-0">
                    <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    <h3>Personal & Contact Info - <span style="color:green;">&#10003;</span></h3>
                    </button>
                </h2>
                </div>

                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                <div class="card-body">
                <div class="col-md-12">
                  <div class="card">
                    <div class="card-body">
                        <form class="forms-sample" method="POST" action="{{ url('petition/update-profile')}}">
                        {{ csrf_field() }}
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="exampleInputUsername1">Title</label>
                                        <select name="title" class="form-control is-valid" id="exampleSelectTile" required>
                                            <option value="{{$profile->title}}">{{$profile->title}}</option>
                                            <option value="Male">Mr</option>
                                            <option value="Female">Mrs</option>
                                            <option value="Male">Miss</option>
                                            <option value="Female">Dr</option>
                                            <option value="Male">Prof</option>
                                            <option value="Female">Fr</option>
                                            <option value="Male">Imaam</option>
                                            <option value="Female">Muft</option>
                                            <option value="Male">Pr</option>
                                            <option value="Female">Rev</option>
                                            <option value="Male">Sr</option>
                                            <option value="Female">Sheikh</option>
                                            <option value="Male">Gen</option>
                                            <option value="Female">Lt Gen</option>
                                            <option value="Male">Maj Gen</option>
                                            <option value="Female">Brig Gen</option>
                                            <option value="Male">Col</option>
                                            <option value="Female">Lt Col</option>
                                            <option value="Male">Maj</option>
                                            <option value="Female">Capt</option>
                                            <option value="Female">Lt</option>
                                            <option value="Male">IGP</option>
                                            <option value="Female">CP</option>
                                            <option value="Male">DCP</option>
                                            <option value="Female">SACP</option>
                                            <option value="Male">ACP</option>
                                            <option value="Female">SSP</option>
                                            <option value="Male">SP</option>
                                            <option value="Female">ASP</option>
                                            <option value="Male">Insp</option>
                                            <option value="Female">A/Insp</option>
                                            <option value="Male">Sgt</option>
                                            <option value="Female">Cpl</option>
                                            <option value="Female">Pc</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                    <label for="exampleInputUsername1">Full Name</label>
                                    <input type="text" name="name" class="form-control is-valid" value="{{ Auth::user()->username }}" id="exampleInputUsername1" placeholder="Username">
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="exampleSelectGender">Gender</label>
                                        <select name="gender" class="form-control is-valid" id="exampleSelectGender" required>
                                            <option value="{{$profile->gender}}">{{$profile->gender}}</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                    <label for="exampleInputPassword1">Date of Birth</label>
                                    <input type="date" value="{{$profile->dob}}" name="dob" class="form-control datetimepicker-input is-valid" id="datepicker" data-toggle="datetimepicker" data-target="#datepicker">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                    <label for="exampleInputConfirmPassword1">Nationality</label>
                                    <select name="nationality" class="selectpicker countrypicker form-control is-valid" data-default="TZ" data-live-search="true" data-flag="true"></select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                    <label for="exampleSelectGender">ID Type</label>
                                    <select name="id_type" class="form-control is-valid" id="exampleSelectGender" required>
                                        <option value="{{$profile->id_type}}">{{$profile->id_type}}</option>
                                        <option value="National Identity Card">National Identity Card</option>
                                        <option value="Voters Identity Card">Voters Identity Card</option>
                                        <option value="Passport">Passport</option>
                                        <option value="Driving Licence">Driving Licence</option>
                                    </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                    <label for="exampleInputUsername1">ID Number</label>
                                    <input type="text" value="{{$profile->id_number}}" name="id_number" class="form-control is-valid" id="exampleInputUsername1" placeholder="ID Number">
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-danger mr-2">Update Changes</button>
                            <button class="btn btn-default">Cancel</button>
                            <a href="{{ url('petition/qualifications') }}" class="btn btn-primary">Next</a>
                        </form>
                    </div>

                  </div>
                </div>
                </div>
                </div>
            </div>
            @else
            <div class="card">
                <div class="card-header" id="headingOne">
                <h2 class="mb-0">
                    <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    <h3>Personal & Contact Info</h3>
                    </button>
                </h2>
                </div>

                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                <div class="card-body">
                <div class="col-md-12">
                  <div class="card">
                    <div class="card-body">
                        <form class="forms-sample" method="POST" action="{{ url('petition/post-profile')}}">
                        {{ csrf_field() }}
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                    <label for="exampleInputUsername1">Title</label>
                                        <select name="title" class="form-control is-valid" id="exampleSelectTile" required>
                                            <option value="">--Choose one--</option>
                                            <option value="Male">Mr</option>
                                            <option value="Female">Mrs</option>
                                            <option value="Male">Miss</option>
                                            <option value="Female">Dr</option>
                                            <option value="Male">Prof</option>
                                            <option value="Female">Fr</option>
                                            <option value="Male">Imaam</option>
                                            <option value="Female">Muft</option>
                                            <option value="Male">Pr</option>
                                            <option value="Female">Rev</option>
                                            <option value="Male">Sr</option>
                                            <option value="Female">Sheikh</option>
                                            <option value="Male">Gen</option>
                                            <option value="Female">Lt Gen</option>
                                            <option value="Male">Maj Gen</option>
                                            <option value="Female">Brig Gen</option>
                                            <option value="Male">Col</option>
                                            <option value="Female">Lt Col</option>
                                            <option value="Male">Maj</option>
                                            <option value="Female">Capt</option>
                                            <option value="Female">Lt</option>
                                            <option value="Male">IGP</option>
                                            <option value="Female">CP</option>
                                            <option value="Male">DCP</option>
                                            <option value="Female">SACP</option>
                                            <option value="Male">ACP</option>
                                            <option value="Female">SSP</option>
                                            <option value="Male">SP</option>
                                            <option value="Female">ASP</option>
                                            <option value="Male">Insp</option>
                                            <option value="Female">A/Insp</option>
                                            <option value="Male">Sgt</option>
                                            <option value="Female">Cpl</option>
                                            <option value="Female">Pc</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="exampleInputUsername1">Full Name</label>
                                        <input type="text" name="name" class="form-control is-valid" value="{{ Auth::user()->username }}" id="exampleInputUsername1" placeholder="Username">
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="exampleSelectGender">Gender</label>
                                        <select name="gender" class="form-control is-valid" id="exampleSelectGender" required>
                                            <option value="">--Choose one--</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                    <label for="exampleInputPassword1">Date of Birth</label>
                                    <input type="date" name="dob" class="form-control datetimepicker-input is-valid" id="datepicker" data-toggle="datetimepicker" data-target="#datepicker">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                    <label for="exampleInputConfirmPassword1">Nationality</label>
                                    <select name="nationality" class="selectpicker countrypicker form-control is-valid" data-default="TZ" data-live-search="true" data-flag="true"></select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                    <label for="exampleSelectGender">ID Type</label>
                                    <select name="id_type" class="form-control is-valid" id="exampleSelectGender" required>
                                        <option value="">--Choose one--</option>
                                        <option value="National Identity Card">National Identity Card</option>
                                        <option value="Voters Identity Card">Voters Identity Card</option>
                                        <option value="Passport">Passport</option>
                                        <option value="Driving Licence">Driving Licence</option>
                                    </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                    <label for="exampleInputUsername1">ID Number</label>
                                    <input type="text" name="id_number" class="form-control is-valid" id="exampleInputUsername1" placeholder="ID Number">
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-danger mr-2">Save</button>
                            <button class="btn btn-default">Cancel</button>
                        </form>
                    </div>

                  </div>
                </div>
                </div>
                </div>
            </div>
            @endif

            </div>
          </div>
        </div>

    </div>
</div>

@endsection


