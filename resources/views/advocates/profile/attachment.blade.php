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
                        <i class="ik ik-paperclip bg-red"></i>
                        <div class="d-inline">
                            <h5>Required Attachements</h5>
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
                            <li class="breadcrumb-item active" aria-current="page">Required Attachements</li>
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
            <div class="card">
                <div class="card-header" id="headingOne">
                <h2 class="mb-0">
                    <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    <h3>Required Attachements 
                            @if($qualification)
                            @if($qualification->lst == 'Yes')<i>[ Law School ]</i>
                            @else <i>[ Bar ]</i>
                            @endif
                            @endif 
                            @if($petition_form) 
                            @if($petition_form->attachment == 1) - <span style="color:green;">&#10003;</span> @endif
                            @endif
                    </h3>
                    </button>
                </h2>
                </div>

                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                <div class="card-body">
                <div class="col-md-12">
                  <div class="card">
                    <div class="card-body">
                        <!-- Profile Picture-->
                        @if(!empty($attach_move->profile_picture))
                        <div class="row">
                                <div class="col-sm-9">
                                <form class="picture" method="POST" action="{{ url('petition/delete-picture')}}" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                    <div class="form-group div1">
                                        <div class="col-sm-12 col-md-12 col-xl-12 mb-30">
                                            <div class="form-group row">
                                                <div class="col-sm-9">
                                                <img src="{{ asset('storage/files/'.$attach_move->profile_picture) }}" width="100px" height="90px" /> - <span>Profile Picture @if($petition_form->attachment == 1) - <span style="color:DeepSkyBlue;">&#10003;</span> @endif</span>
                                                </div>
                                                <div class="col-sm-3">
                                                    @if($petition_form->attachment == 0)
                                                    <button type="submit" class="btn btn-danger button1"><i class="ik ik-trash-2"></i>Remove</button>
                                                    @endif
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group">
                                       
                                    </div>
                                </div>
                        </div>
                        
                        @else
                        <div class="row">
                                <div class="col-sm-9">
                                <form class="picture" method="POST" action="{{ url('petition/post-picture')}}" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                    <div class="form-group">
                                        <div class="col-sm-12 col-md-12 col-xl-12 mb-30">
                                            <h4 class="sub-title">Passport Size <small><i style="color:red;">Recent & Colored</i></small></h4>
                                            <div class="form-group row">
                                                <div class="col-sm-9">
                                                    <input type="file" name="profile_picture" accept="image/*" placeholder="col-sm-11" onChange="readURL(this);">
                                                </div>
                                                <div class="col-sm-3">
                                                    <button type="submit" class="btn btn-info"><i class="ik ik-share"></i>Upload</button>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <img src="{{ URL::to('images/user.png') }}" id="img" width="100px" alt="You are uploading something else, Only image is required here!" />
                                    </div>
                                </div>
                        </div>
                        @endif

                        @if(!empty($attach_move->profile_picture))
                        <!-- Petition for Admission and Enrollment-->
                        @if(!empty($attach_move->petition))
                        <div class="row">
                                <div class="col-sm-9">
                                <form class="petition" method="POST" action="{{ url('petition/delete-petition')}}" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                    <div class="form-group div2">
                                        <div class="col-sm-12 col-md-12 col-xl-12 mb-30">
                                            <div class="form-group row">
                                                <div class="col-sm-9">
                                                    <a href="#petition{{$attach_move->id}}"  title="{{ $attach_move->petition }}" data-toggle="modal" data-id="{{ $attach_move->id }}" data-name="{{ $attach_move->petition }}" data-file="{{ $attach_move->petition }}" data-target="#petition{{$attach_move->id}}">
                                                    <span>
                                                        
                                                        <p><i style="color:red" class="fas fa-file-pdf fa-lg"></i> - Petition for Admission and Enrollment  @if($petition_form->attachment == 1) - <span style="color:DeepSkyBlue;">&#10003;</span> @endif</p>
                                                    </span>
                                                    </a>
                                                </div>
                                                <div class="col-sm-3">
                                                    @if($petition_form->attachment == 0)
                                                    <button type="submit" class="btn btn-danger button2"><i class="ik ik-trash-2"></i>Remove</button>
                                                    @endif
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <!-- View pdf modal-->
                                        <div class="modal fade" id="petition{{$attach_move->id}}" tabindex="-1" role="dialog" aria-labelledby="demoModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="demoModalLabel">Petition for Admission and Enrollment</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <embed src="{{ asset('storage/files/'.$attach_move->petition) }}#toolbar=0" type="application/pdf" width="100%" height="500px" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                        </div>
                        
                        @else
                        <div class="row">
                                <div class="col-sm-9">
                                <form class="petition" method="POST" action="{{ url('petition/post-petition')}}" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                    <div class="form-group">
                                        <div class="col-sm-12 col-md-12 col-xl-12 mb-30">
                                            
                                            <div class="form-group row">
                                               <div class="col-sm-12 col-md-12 col-xl-12" style="margin-top:0px;">
                                                <h4 class="sub-title">Petition for Admission and Enrollment</h4>
                                                <div class="form-group row">
                                                    <div class="col-sm-9">
                                                        <input type="file" name="petition" accept=".pdf"/>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <button type="submit" class="btn btn-info"><i class="ik ik-share"></i>Upload</button>
                                                    </div>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group">
                                       
                                    </div>
                                </div>
                        </div>
                        @endif

                        <!-- Birth Certificate-->
                        @if(!empty($attach_move->birth_cert))
                        <div class="row" id="birthcert">
                                <div class="col-sm-9">
                                <form class="birthcert" method="POST" action="{{ url('petition/delete-birthcert')}}" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                    <div class="form-group div3">
                                        <div class="col-sm-12 col-md-12 col-xl-12 mb-30">
                                            <div class="form-group row">
                                                <div class="col-sm-9">
                                                <a href="#birthcert{{$attach_move->id}}"  title="{{ $attach_move->birth_cert }}" data-toggle="modal" data-id="{{ $attach_move->id }}" data-name="{{ $attach_move->birth_cert }}" data-file="{{ $attach_move->petition }}" data-target="#birthcert{{$attach_move->id}}">
                                                    <span>
                                                        <p><i style="color:red" class="fas fa-file-pdf fa-lg"></i> - Birth Certificate @if($petition_form->attachment == 1) - <span style="color:DeepSkyBlue;">&#10003;</span> @endif</p>
                                                    </span>
                                                    </a>
                                                </div>
                                                <div class="col-sm-3">
                                                    @if($petition_form->attachment == 0)
                                                    <button type="submit" class="btn btn-danger button3"><i class="ik ik-trash-2"></i>Remove</button>
                                                    @endif
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group">
                                       <!-- View pdf modal-->
                                        <div class="modal fade" id="birthcert{{$attach_move->id}}" tabindex="-1" role="dialog" aria-labelledby="demoModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="demoModalLabel">Birth Certificate</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <embed src="{{ asset('storage/files/'.$attach_move->birth_cert) }}#toolbar=0" type="application/pdf" width="100%" height="500px" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                        </div>
                        
                        @else
                        <div class="row" id="birthcert">
                                <div class="col-sm-9">
                                <form class="birthcert" method="POST" action="{{ url('petition/post-birthcert')}}" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                    <div class="form-group">
                                        <div class="col-sm-12 col-md-12 col-xl-12 mb-30">
                                            
                                            <div class="form-group row">
                                               <div class="col-sm-12 col-md-12 col-xl-12" style="margin-top:0px;">
                                                <h4 class="sub-title">Birth Certificate</h4>
                                                <div class="form-group row">
                                                    <div class="col-sm-9">
                                                        <input type="file" name="birthcert" accept=".pdf"/>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <button type="submit" class="btn btn-info"><i class="ik ik-share"></i>Upload</button>
                                                    </div>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group">
                                       
                                    </div>
                                </div>
                        </div>
                        @endif


                        <!-- Good Character Certificate-->
                        @if(!empty($attach_move->char_cert))
                        <div class="row" id="charcert">
                                <div class="col-sm-9">
                                <form class="charcert" method="POST" action="{{ url('petition/delete-charcert')}}" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                    <div class="form-group div4">
                                        <div class="col-sm-12 col-md-12 col-xl-12 mb-30">
                                            <div class="form-group row">
                                                <div class="col-sm-9">
                                                <a href="#charcert{{$attach_move->id}}"  title="{{ $attach_move->char_cert }}" data-toggle="modal" data-id="{{ $attach_move->id }}" data-name="{{ $attach_move->char_cert }}" data-file="{{ $attach_move->char_cert }}" data-target="#charcert{{$attach_move->id}}">
                                                    <span>
                                                        <p><i style="color:red" class="fas fa-file-pdf fa-lg"></i> - Certificate of Good Character @if($petition_form->attachment == 1) - <span style="color:DeepSkyBlue;">&#10003;</span> @endif</p>
                                                    </span>
                                                    </a>
                                                </div>
                                                <div class="col-sm-3">
                                                    @if($petition_form->attachment == 0)
                                                    <button type="submit" class="btn btn-danger button4"><i class="ik ik-trash-2"></i>Remove</button>
                                                    @endif
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group">
                                       <!-- View pdf modal-->
                                       <div class="modal fade" id="charcert{{$attach_move->id}}" tabindex="-1" role="dialog" aria-labelledby="demoModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="demoModalLabel">Certificate of Good Character</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <embed src="{{ asset('storage/files/'.$attach_move->char_cert) }}#toolbar=0" type="application/pdf" width="100%" height="500px" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                        </div>
                        
                        @else
                        <div class="row" id="charcert">
                                <div class="col-sm-9">
                                <form class="charcert" method="POST" action="{{ url('petition/post-charcert')}}" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                    <div class="form-group">
                                        <div class="col-sm-12 col-md-12 col-xl-12 mb-30">
                                            
                                            <div class="form-group row">
                                               <div class="col-sm-12 col-md-12 col-xl-12" style="margin-top:0px;">
                                                <h4 class="sub-title">Certificate of Good Character From Experienced Lawyer </h4>
                                                <div class="form-group row">
                                                    <div class="col-sm-9">
                                                        <input type="file" name="charcert" accept=".pdf"/>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <button type="submit" class="btn btn-info"><i class="ik ik-share"></i>Upload</button>
                                                    </div>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group">
                                       
                                    </div>
                                </div>
                        </div>
                        @endif

                        <!-- Employer letter-->
                        @if(!empty($attach_move->emp_later))
                        <div class="row" id="empletter">
                                <div class="col-sm-9">
                                <form class="empletter" method="POST" action="{{ url('petition/delete-empletter')}}" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                    <div class="form-group div5">
                                        <div class="col-sm-12 col-md-12 col-xl-12 mb-30">
                                            <div class="form-group row">
                                                <div class="col-sm-9">
                                                    <a target="_blank" href="{{ asset('storage/files/'.$attach_move->emp_later) }}">
                                                    <span>
                                                        <p"><i style="color:red" class="fas fa-file-pdf fa-lg"></i> - Employer Letter @if($petition_form->attachment == 1) - <span style="color:DeepSkyBlue;">&#10003;</span> @endif</p>
                                                    </span>
                                                    </a>
                                                </div>
                                                <div class="col-sm-3">
                                                    @if($petition_form->attachment == 0)
                                                    <button type="submit" class="btn btn-danger button5"><i class="ik ik-trash-2"></i>Remove</button>
                                                    @endif
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group">
                                       
                                    </div>
                                </div>
                        </div>
                        @else
                        <div class="row" id="empletter">
                                <div class="col-sm-9">
                                <form class="empletter" method="POST" action="{{ url('petition/post-empletter')}}" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                    <div class="form-group">
                                        <div class="col-sm-12 col-md-12 col-xl-12 mb-30">
                                            
                                            <div class="form-group row">
                                               <div class="col-sm-12 col-md-12 col-xl-12" style="margin-top:0px;">
                                               <h4 class="sub-title">Employer Letter<small><i style="color:red;">Certified copy .pdf format</i></small></h4>
                                                <div class="form-group row">
                                                    <div class="col-sm-9">
                                                    <input type="file" name="empletter" accept=".pdf"/>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <button type="submit" class="btn btn-info"><i class="ik ik-share"></i>Upload</button>
                                                    </div>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>  
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group">
                                       
                                    </div>
                                </div>
                        </div>
                        @endif
                        
                        
                        @if($qualification)
                        @if($qualification->o_level == 'Tanzania')
                        <!-- O-Level Certificate TZ-->
                        @if(!empty($attach_move->csee))
                        <div class="row">
                                <div class="col-sm-9">
                                <form class="petition" method="POST" action="{{ url('petition/delete-csee')}}" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                    <div class="form-group div6">
                                        <div class="col-sm-12 col-md-12 col-xl-12 mb-30">
                                            <div class="form-group row">
                                                <div class="col-sm-9">
                                                    <a target="_blank" href="{{ asset('storage/files/'.$attach_move->csee) }}">
                                                    <span>
                                                        <p><i style="color:red" class="fas fa-file-pdf fa-lg"></i> - Certificate of Ordinary Secondary Education @if($petition_form->attachment == 1) - <span style="color:DeepSkyBlue;">&#10003;</span> @endif</p>
                                                    </span>
                                                    </a>
                                                </div>
                                                <div class="col-sm-3">
                                                    @if($petition_form->attachment == 0)
                                                    <button type="submit" class="btn btn-danger button6"><i class="ik ik-trash-2"></i>Remove</button>
                                                    @endif
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group">
                                       
                                    </div>
                                </div>
                        </div>
                        @else
                        <div class="row" id="o-level-tz">
                                <div class="col-sm-9">
                                <form class="olevel" method="POST" action="{{ url('petition/post-csee')}}" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                    <div class="form-group">
                                        <div class="col-sm-12 col-md-12 col-xl-12 mb-30">
                                            
                                            <div class="form-group row">
                                               <div class="col-sm-12 col-md-12 col-xl-12" style="margin-top:0px;">
                                               <h4 class="sub-title">Certificate of Secondary Education (CSEE) <small><i style="color:red;">Certified copy .pdf format</i></small></h4>
                                                <div class="form-group row">
                                                    <div class="col-sm-9">
                                                    <input type="file" name="csee" accept=".pdf"/>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <button type="submit" class="btn btn-info"><i class="ik ik-share"></i>Upload</button>
                                                    </div>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>    
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group">
                                       
                                    </div>
                                </div>
                        </div>
                        @endif

                        @else
                        <!-- O-Level Certificate Abroad-->
                        @if(!empty($attach_move->csee))
                        <div class="row">
                                <div class="col-sm-9">
                                <form class="petition" method="POST" action="{{ url('petition/delete-csee')}}" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                    <div class="form-group div7">
                                        <div class="col-sm-12 col-md-12 col-xl-12 mb-30">
                                            <div class="form-group row">
                                                <div class="col-sm-9">
                                                    <a target="_blank" href="{{ asset('storage/files/'.$attach_move->csee) }}">
                                                    <span>
                                                        <p><i style="color:red" class="fas fa-file-pdf fa-lg"></i> - Certificate of Ordinary Secondary Education @if($petition_form->attachment == 1) - <span style="color:DeepSkyBlue;">&#10003;</span> @endif</p>
                                                    </span>
                                                    </a>
                                                </div>
                                                <div class="col-sm-3">
                                                    @if($petition_form->attachment == 0)
                                                    <button type="submit" class="btn btn-danger button7"><i class="ik ik-trash-2"></i>Remove</button>
                                                    @endif
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group">
                                       
                                    </div>
                                </div>
                        </div>
                        @else
                        <div class="row" id="o-level-ab">
                                <div class="col-sm-9">
                                <form class="olevel" method="POST" action="{{ url('petition/post-csee')}}" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                    <div class="form-group">
                                        <div class="col-sm-12 col-md-12 col-xl-12 mb-30">
                                            
                                            <div class="form-group row">
                                               <div class="col-sm-12 col-md-12 col-xl-12" style="margin-top:0px;">
                                               <h4 class="sub-title">Certificate of Ordinary Secondary Education <small><i style="color:red;">Certified copy .pdf format</i></small></h4>
                                                <div class="form-group row">
                                                    <div class="col-sm-9">
                                                    <input type="file" name="csee" accept=".pdf"/>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <button type="submit" class="btn btn-info"><i class="ik ik-share"></i>Upload</button>
                                                    </div>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>    
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group">
                                       
                                    </div>
                                </div>
                        </div>
                        @endif
                        @if(!empty($attach_move->necta))
                        <div class="row">
                                <div class="col-sm-9">
                                <form class="petition" method="POST" action="{{ url('petition/delete-necta')}}" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                    <div class="form-group div8">
                                        <div class="col-sm-12 col-md-12 col-xl-12 mb-30">
                                            <div class="form-group row">
                                                <div class="col-sm-9">
                                                    <a target="_blank" href="{{ asset('storage/files/'.$attach_move->necta) }}">
                                                    <span>
                                                        <p><i style="color:red" class="fas fa-file-pdf fa-lg"></i> - NECTA Certificate of Recognition</p>
                                                    </span>
                                                    </a>
                                                </div>
                                                <div class="col-sm-3">
                                                    @if($petition_form->attachment == 0)
                                                    <button type="submit" class="btn btn-danger button8"><i class="ik ik-trash-2"></i>Remove</button>
                                                    @endif
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group">
                                       
                                    </div>
                                </div>
                        </div>
                        @else
                        <div class="row" id="necta">
                                <div class="col-sm-9">
                                <form class="petition" method="POST" action="{{ url('petition/post-necta')}}" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                    <div class="form-group">
                                        <div class="col-sm-12 col-md-12 col-xl-12 mb-30">
                                            
                                            <div class="form-group row">
                                               <div class="col-sm-12 col-md-12 col-xl-12" style="margin-top:0px;">
                                               <h4 class="sub-title">NECTA Certificate of Recognition <small><i style="color:red;">Certified copy .pdf format</i></small></h4>
                                                <div class="form-group row">
                                                    <div class="col-sm-9">
                                                        <input type="file" name="necta" accept=".pdf"/>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <button type="submit" class="btn btn-info"><i class="ik ik-share"></i>Upload</button>
                                                    </div>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group">
                                       
                                    </div>
                                </div>
                        </div>
                        @endif
                        @endif
                        @endif

                        @if($qualification)
                        @if($qualification->a_level == 'Tanzania')
                        <!-- A-Level Certificate TZ-->
                        @if(!empty($attach_move->acsee))
                        <div class="row">
                                <div class="col-sm-9">
                                <form class="petition" method="POST" action="{{ url('petition/delete-acsee')}}" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                    <div class="form-group div9">
                                        <div class="col-sm-12 col-md-12 col-xl-12 mb-30">
                                            <div class="form-group row">
                                                <div class="col-sm-9">
                                                    <a target="_blank" href="{{ asset('storage/files/'.$attach_move->acsee) }}">
                                                    <span>
                                                        <p><i style="color:red" class="fas fa-file-pdf fa-lg"></i> - Advanced Certificate of Secondary Education @if($petition_form->attachment == 1) - <span style="color:DeepSkyBlue;">&#10003;</span> @endif</p>
                                                    </span>
                                                    </a>
                                                </div>
                                                <div class="col-sm-3">
                                                    @if($petition_form->attachment == 0)
                                                    <button type="submit" class="btn btn-danger button9"><i class="ik ik-trash-2"></i>Remove</button>
                                                    @endif
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group">
                                       
                                    </div>
                                </div>
                        </div>
                        @else
                        <div class="row" id="a-level-tz">
                                <div class="col-sm-9">
                                <form class="olevel" method="POST" action="{{ url('petition/post-acsee')}}" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                    <div class="form-group">
                                        <div class="col-sm-12 col-md-12 col-xl-12 mb-30">
                                            
                                            <div class="form-group row">
                                               <div class="col-sm-12 col-md-12 col-xl-12" style="margin-top:0px;">
                                               <h4 class="sub-title">Advanced Certificate of Secondary Education (ACSEE)<small><i style="color:red;">Certified copy .pdf format</i></small></h4>
                                                <div class="form-group row">
                                                    <div class="col-sm-9">
                                                    <input type="file" name="acsee" accept=".pdf"/>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <button type="submit" class="btn btn-info"><i class="ik ik-share"></i>Upload</button>
                                                    </div>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>    
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group">
                                       
                                    </div>
                                </div>
                        </div>
                        @endif
                        @else
                        <!-- A-Level Certificate Abroad-->
                        @if(!empty($attach_move->acsee))
                        <div class="row" id="a-level-ab">
                                <div class="col-sm-9">
                                <form class="petition" method="POST" action="{{ url('petition/delete-acsee')}}" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                    <div class="form-group div10">
                                        <div class="col-sm-12 col-md-12 col-xl-12 mb-30">
                                            <div class="form-group row">
                                                <div class="col-sm-9">
                                                    <a target="_blank" href="{{ asset('storage/files/'.$attach_move->acsee) }}">
                                                    <span>
                                                        <p><i style="color:red" class="fas fa-file-pdf fa-lg"></i> - Advanced Certificate of Secondary Education @if($petition_form->attachment == 1) - <span style="color:DeepSkyBlue;">&#10003;</span> @endif</p>
                                                    </span>
                                                    </a>
                                                </div>
                                                <div class="col-sm-3">
                                                    @if($petition_form->attachment == 0)
                                                    <button type="submit" class="btn btn-danger button10"><i class="ik ik-trash-2"></i>Remove</button>
                                                    @endif
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group">
                                       
                                    </div>
                                </div>
                        </div>
                        @else
                        <div class="row" id="a-level-ab">
                                <div class="col-sm-9">
                                <form class="olevel" method="POST" action="{{ url('petition/post-acsee')}}" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                    <div class="form-group">
                                        <div class="col-sm-12 col-md-12 col-xl-12 mb-30">
                                            
                                            <div class="form-group row">
                                               <div class="col-sm-12 col-md-12 col-xl-12" style="margin-top:0px;">
                                               <h4 class="sub-title">Advanced Certificate of Secondary Education<small><i style="color:red;">Certified copy .pdf format</i></small></h4>
                                                <div class="form-group row">
                                                    <div class="col-sm-9">
                                                    <input type="file" name="acsee" accept=".pdf"/>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <button type="submit" class="btn btn-info"><i class="ik ik-share"></i>Upload</button>
                                                    </div>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>    
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group">
                                       
                                    </div>
                                </div>
                        </div>
                        @endif

                        @if(!empty($attach_move->nacte))
                        <div class="row" id="nacte">
                                <div class="col-sm-9">
                                <form class="petition" method="POST" action="{{ url('petition/delete-nacte')}}" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                    <div class="form-group div11">
                                        <div class="col-sm-12 col-md-12 col-xl-12 mb-30">
                                            <div class="form-group row">
                                                <div class="col-sm-9">
                                                    <a target="_blank" href="{{ asset('storage/files/'.$attach_move->nacte) }}">
                                                    <span>
                                                        <p><i style="color:red" class="fas fa-file-pdf fa-lg"></i> - NACTE Certificate of Recognition @if($petition_form->attachment == 1) - <span style="color:DeepSkyBlue;">&#10003;</span> @endif</p>
                                                    </span>
                                                    </a>
                                                </div>
                                                <div class="col-sm-3">
                                                    @if($petition_form->attachment == 0)
                                                    <button type="submit" class="btn btn-danger button11"><i class="ik ik-trash-2"></i>Remove</button>
                                                    @endif
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group">
                                       
                                    </div>
                                </div>
                        </div>
                        @else
                        <div class="row" id="nacte">
                                <div class="col-sm-9">
                                <form class="olevel" method="POST" action="{{ url('petition/post-nacte')}}" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                    <div class="form-group">
                                        <div class="col-sm-12 col-md-12 col-xl-12 mb-30">
                                            
                                            <div class="form-group row">
                                               <div class="col-sm-12 col-md-12 col-xl-12" style="margin-top:0px;">
                                               <h4 class="sub-title">NECTA/NACTE Certificate of Recognition<small><i style="color:red;">Certified copy .pdf format</i></small></h4>
                                                <div class="form-group row">
                                                    <div class="col-sm-9">
                                                    <input type="file" name="nacte" accept=".pdf"/>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <button type="submit" class="btn btn-info"><i class="ik ik-share"></i>Upload</button>
                                                    </div>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>    
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group">
                                       
                                    </div>
                                </div>
                        </div>
                        @endif
                        @endif
                        @endif

                        @if($qualification)
                        @if($qualification->llb == 'Tanzania')
                        <!-- LLB Certificate TZ-->
                        @if(!empty($attach_move->llb_cert))
                        <div class="row" id="llb-tz">
                                <div class="col-sm-9">
                                <form class="petition" method="POST" action="{{ url('petition/delete-llbcert')}}" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                    <div class="form-group div12">
                                        <div class="col-sm-12 col-md-12 col-xl-12 mb-30">
                                            <div class="form-group row">
                                                <div class="col-sm-9">
                                                    <a target="_blank" href="{{ asset('storage/files/'.$attach_move->llb_cert) }}">
                                                    <span>
                                                        <p><i style="color:red" class="fas fa-file-pdf fa-lg"></i> - LLB Certificate @if($petition_form->attachment == 1) - <span style="color:DeepSkyBlue;">&#10003;</span> @endif</p>
                                                    </span>
                                                    </a>
                                                </div>
                                                <div class="col-sm-3">
                                                    @if($petition_form->attachment == 0)
                                                    <button type="submit" class="btn btn-danger button12"><i class="ik ik-trash-2"></i>Remove</button>
                                                    @endif
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group">
                                       
                                    </div>
                                </div>
                        </div>
                        @else
                        <div class="row" id="llb-tz">
                                <div class="col-sm-9">
                                <form class="olevel" method="POST" action="{{ url('petition/post-llbcert')}}" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                    <div class="form-group">
                                        <div class="col-sm-12 col-md-12 col-xl-12 mb-30">
                                            
                                            <div class="form-group row">
                                               <div class="col-sm-12 col-md-12 col-xl-12" style="margin-top:0px;">
                                               <h4 class="sub-title">LLB Certificate<small><i style="color:red;">Certified copy .pdf format</i></small></h4>
                                                <div class="form-group row">
                                                    <div class="col-sm-9">
                                                    <input type="file" name="llbcert" accept=".pdf"/>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <button type="submit" class="btn btn-info"><i class="ik ik-share"></i>Upload</button>
                                                    </div>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>   
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group">
                                       
                                    </div>
                                </div>
                        </div>
                        @endif

                        @if(!empty($attach_move->llb_trans))
                        <div class="row" id="llb-tans-tz">
                                <div class="col-sm-9">
                                <form class="petition" method="POST" action="{{ url('petition/delete-llbtrans')}}" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                    <div class="form-group div13">
                                        <div class="col-sm-12 col-md-12 col-xl-12 mb-30">
                                            <div class="form-group row">
                                                <div class="col-sm-9">
                                                    <a target="_blank" href="{{ asset('storage/files/'.$attach_move->llb_trans) }}">
                                                    <span>
                                                        <p><i style="color:red" class="fas fa-file-pdf fa-lg"></i> - LLB Transcript @if($petition_form->attachment == 1) - <span style="color:DeepSkyBlue;">&#10003;</span> @endif</p>
                                                    </span>
                                                    </a>
                                                </div>
                                                <div class="col-sm-3">
                                                    @if($petition_form->attachment == 0)
                                                    <button type="submit" class="btn btn-danger button13"><i class="ik ik-trash-2"></i>Remove</button>
                                                    @endif
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group">
                                       
                                    </div>
                                </div>
                        </div>
                        @else
                        <div class="row" id="llb-tans-tz">
                                <div class="col-sm-9">
                                <form class="olevel" method="POST" action="{{ url('petition/post-llbtrans')}}" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                    <div class="form-group">
                                        <div class="col-sm-12 col-md-12 col-xl-12 mb-30">
                                            
                                            <div class="form-group row">
                                               <div class="col-sm-12 col-md-12 col-xl-12" style="margin-top:0px;">
                                               <h4 class="sub-title">LLB Transcript<small><i style="color:red;">Certified copy .pdf format</i></small></h4>
                                                <div class="form-group row">
                                                    <div class="col-sm-9">
                                                    <input type="file" name="llbtrans" accept=".pdf"/>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <button type="submit" class="btn btn-info"><i class="ik ik-share"></i>Upload</button>
                                                    </div>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>    
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group">
                                       
                                    </div>
                                </div>
                        </div>
                        @endif

                        @else
                        <!-- LLB Certificate Abroad-->
                        @if(!empty($attach_move->llb_cert))
                        <div class="row" id="llb-ab">
                                <div class="col-sm-9">
                                <form class="llbcert" method="POST" action="{{ url('petition/delete-llbcert')}}" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                    <div class="form-group div14">
                                        <div class="col-sm-12 col-md-12 col-xl-12 mb-30">
                                            <div class="form-group row">
                                                <div class="col-sm-9">
                                                    <a target="_blank" href="{{ asset('storage/files/'.$attach_move->llb_cert) }}">
                                                    <span>
                                                        <p><i style="color:red" class="fas fa-file-pdf fa-lg"></i> - Advanced Certificate of Secondary Education @if($petition_form->attachment == 1) - <span style="color:DeepSkyBlue;">&#10003;</span> @endif</p>
                                                    </span>
                                                    </a>
                                                </div>
                                                <div class="col-sm-3">
                                                    @if($petition_form->attachment == 0)
                                                    <button type="submit" class="btn btn-danger button14"><i class="ik ik-trash-2"></i>Remove</button>
                                                    @endif
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group">
                                       
                                    </div>
                                </div>
                        </div>
                        @else
                        <div class="row" id="llb-ab">
                                <div class="col-sm-9">
                                <form class="llbcert" method="POST" action="{{ url('petition/post-llbcert')}}" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                    <div class="form-group">
                                        <div class="col-sm-12 col-md-12 col-xl-12 mb-30">
                                            
                                            <div class="form-group row">
                                               <div class="col-sm-12 col-md-12 col-xl-12" style="margin-top:0px;">
                                               <h4 class="sub-title">LLB Certificate<small><i style="color:red;">Certified copy .pdf format</i></small></h4>
                                                <div class="form-group row">
                                                    <div class="col-sm-9">
                                                    <input type="file" name="llbcert" accept=".pdf"/>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <button type="submit" class="btn btn-info"><i class="ik ik-share"></i>Upload</button>
                                                    </div>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>   
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group">
                                       
                                    </div>
                                </div>
                        </div>
                        @endif

                        @if(!empty($attach_move->llb_trans))
                        <div class="row" id="llb-tans-ab">
                                <div class="col-sm-9">
                                <form class="llbtrans" method="POST" action="{{ url('petition/delete-llbtrans')}}" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                    <div class="form-group div15">
                                        <div class="col-sm-12 col-md-12 col-xl-12 mb-30">
                                            <div class="form-group row">
                                                <div class="col-sm-9">
                                                    <a target="_blank" href="{{ asset('storage/files/'.$attach_move->llb_trans) }}">
                                                    <span>
                                                        <p><i style="color:red" class="fas fa-file-pdf fa-lg"></i> - LLB Transcript @if($petition_form->attachment == 1) - <span style="color:DeepSkyBlue;">&#10003;</span> @endif</p>
                                                    </span>
                                                    </a>
                                                </div>
                                                <div class="col-sm-3">
                                                    @if($petition_form->attachment == 0)
                                                    <button type="submit" class="btn btn-danger button15"><i class="ik ik-trash-2"></i>Remove</button>
                                                    @endif
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group">
                                       
                                    </div>
                                </div>
                        </div>
                        @else
                        <div class="row" id="llb-tans-ab">
                                <div class="col-sm-9">
                                <form class="olevel" method="POST" action="{{ url('petition/post-llbtrans')}}" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                    <div class="form-group">
                                        <div class="col-sm-12 col-md-12 col-xl-12 mb-30">
                                            
                                            <div class="form-group row">
                                               <div class="col-sm-12 col-md-12 col-xl-12" style="margin-top:0px;">
                                               <h4 class="sub-title">LLB Transcript<small><i style="color:red;">Certified copy .pdf format</i></small></h4>
                                                <div class="form-group row">
                                                    <div class="col-sm-9">
                                                    <input type="file" name="llbtrans" accept=".pdf"/>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <button type="submit" class="btn btn-info"><i class="ik ik-share"></i>Upload</button>
                                                    </div>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>   
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group">
                                       
                                    </div>
                                </div>
                        </div>
                        @endif

                        @if(!empty($attach_move->tcu))
                        <div class="row" id="tcu">
                                <div class="col-sm-9">
                                <form class="petition" method="POST" action="{{ url('petition/delete-tcu')}}" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                    <div class="form-group div16">
                                        <div class="col-sm-12 col-md-12 col-xl-12 mb-30">
                                            <div class="form-group row">
                                                <div class="col-sm-9">
                                                    <a target="_blank" href="{{ asset('storage/files/'.$attach_move->tcu) }}">
                                                    <span>
                                                        <p><i style="color:red" class="fas fa-file-pdf fa-lg"></i> - TCU Certificate of Recognition @if($petition_form->attachment == 1) - <span style="color:DeepSkyBlue;">&#10003;</span> @endif</p>
                                                    </span>
                                                    </a>
                                                </div>
                                                <div class="col-sm-3">
                                                    @if($petition_form->attachment == 0)
                                                    <button type="submit" class="btn btn-danger button16"><i class="ik ik-trash-2"></i>Remove</button>
                                                    @endif
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group">
                                       
                                    </div>
                                </div>
                        </div>
                        @else
                        <div class="row" id="tcu">
                                <div class="col-sm-9">
                                <form class="olevel" method="POST" action="{{ url('petition/post-tcu')}}" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                    <div class="form-group">
                                        <div class="col-sm-12 col-md-12 col-xl-12 mb-30">
                                            
                                            <div class="form-group row">
                                               <div class="col-sm-12 col-md-12 col-xl-12" style="margin-top:0px;">
                                               <h4 class="sub-title">TCU Certificate of Recognition<small><i style="color:red;">Certified copy .pdf format</i></small></h4>
                                                <div class="form-group row">
                                                    <div class="col-sm-9">
                                                    <input type="file" name="tcu" accept=".pdf"/>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <button type="submit" class="btn btn-info"><i class="ik ik-share"></i>Upload</button>
                                                    </div>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>  
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group">
                                       
                                    </div>
                                </div>
                        </div>
                        @endif
                        @endif
                        @endif

                        @if($qualification)
                        @if($qualification->lst == 'Yes')
                        <!-- Attended Law School Tanzania-->
                        @if(!empty($attach_move->lst_cert))
                        <div class="row" id="lstcert">
                                <div class="col-sm-9">
                                <form class="petition" method="POST" action="{{ url('petition/delete-lstcert')}}" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                    <div class="form-group div17">
                                        <div class="col-sm-12 col-md-12 col-xl-12 mb-30">
                                            <div class="form-group row">
                                                <div class="col-sm-9">
                                                    <a target="_blank" href="{{ asset('storage/files/'.$attach_move->lst_cert) }}">
                                                    <span>
                                                        <p><i style="color:red" class="fas fa-file-pdf fa-lg"></i> - Post Graduate Diploma in Legal Practice from LST @if($petition_form->attachment == 1) - <span style="color:DeepSkyBlue;">&#10003;</span> @endif</p>
                                                    </span>
                                                    </a>
                                                </div>
                                                <div class="col-sm-3">
                                                    @if($petition_form->attachment == 0)
                                                    <button type="submit" class="btn btn-danger button17"><i class="ik ik-trash-2"></i>Remove</button>
                                                    @endif
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group">
                                       
                                    </div>
                                </div>
                        </div>
                        @else
                        <div class="row" id="lstcert">
                                <div class="col-sm-9">
                                <form class="lstcert" method="POST" action="{{ url('petition/post-lstcert')}}" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                    <div class="form-group">
                                        <div class="col-sm-12 col-md-12 col-xl-12 mb-30">
                                            
                                            <div class="form-group row">
                                               <div class="col-sm-12 col-md-12 col-xl-12" style="margin-top:0px;">
                                               <h4 class="sub-title">Post Graduate Diploma in Legal Practice from LST<small><i style="color:red;">Certified copy .pdf format</i></small></h4>
                                                <div class="form-group row">
                                                    <div class="col-sm-9">
                                                    <input type="file" name="lstcert" accept=".pdf"/>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <button type="submit" class="btn btn-info"><i class="ik ik-share"></i>Upload</button>
                                                    </div>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                </form> 
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group">
                                       
                                    </div>
                                </div>
                        </div>
                        @endif

                        @if(!empty($attach_move->lst_results))
                        <div class="row" id="lsttrans">
                                <div class="col-sm-9">
                                <form class="lsttrans" method="POST" action="{{ url('petition/delete-lsttrans')}}" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                    <div class="form-group div18">
                                        <div class="col-sm-12 col-md-12 col-xl-12 mb-30">
                                            <div class="form-group row">
                                                <div class="col-sm-9">
                                                    <a target="_blank" href="{{ asset('storage/files/'.$attach_move->llb_results) }}">
                                                    <span>
                                                        <p><i style="color:red" class="fas fa-file-pdf fa-lg"></i> - Final Result Post Graduate Diploma in Legal Practice from LST @if($petition_form->attachment == 1) - <span style="color:DeepSkyBlue;">&#10003;</span> @endif</p>
                                                    </span>
                                                    </a>
                                                </div>
                                                <div class="col-sm-3">
                                                    @if($petition_form->attachment == 0)
                                                    <button type="submit" class="btn btn-danger button18"><i class="ik ik-trash-2"></i>Remove</button>
                                                    @endif
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group">
                                       
                                    </div>
                                </div>
                        </div>
                        @else
                        <div class="row" id="lsttrans">
                                <div class="col-sm-9">
                                <form class="lsttrans" method="POST" action="{{ url('petition/post-lsttrans')}}" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                    <div class="form-group">
                                        <div class="col-sm-12 col-md-12 col-xl-12 mb-30">
                                            
                                            <div class="form-group row">
                                               <div class="col-sm-12 col-md-12 col-xl-12" style="margin-top:0px;">
                                               <h4 class="sub-title">Final Result Post Graduate Diploma in Legal Practice from LST<small><i style="color:red;">Certified copy .pdf format</i></small></h4>
                                                <div class="form-group row">
                                                    <div class="col-sm-9">
                                                    <input type="file" name="lsttrans" accept=".pdf"/>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <button type="submit" class="btn btn-info"><i class="ik ik-share"></i>Upload</button>
                                                    </div>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                </form> 
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group">
                                       
                                    </div>
                                </div>
                        </div>
                        @endif

                        @else
                        <!-- Not Attended Law School Tanzania-->
                        @if(!empty($attach_move->pupilage))
                        <div class="row" id="pupilage">
                                <div class="col-sm-9">
                                <form class="pupilage" method="POST" action="{{ url('petition/delete-pupilage')}}" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                    <div class="form-group div19">
                                        <div class="col-sm-12 col-md-12 col-xl-12 mb-30">
                                            <div class="form-group row">
                                                <div class="col-sm-9">
                                                    <a target="_blank" href="{{ asset('storage/files/'.$attach_move->pupilage) }}">
                                                    <span>
                                                        <p><i style="color:red" class="fas fa-file-pdf fa-lg"></i> - Certificate of Pupilage @if($petition_form->attachment == 1) - <span style="color:DeepSkyBlue;">&#10003;</span> @endif</p>
                                                    </span>
                                                    </a>
                                                </div>
                                                <div class="col-sm-3">
                                                    @if($petition_form->attachment == 0)
                                                    <button type="submit" class="btn btn-danger button19"><i class="ik ik-trash-2"></i>Remove</button>
                                                    @endif
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group">
                                       
                                    </div>
                                </div>
                        </div>
                        @else
                        <div class="row" id="pupilage">
                                <div class="col-sm-9">
                                <form class="pupilage" method="POST" action="{{ url('petition/post-pupilage')}}" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                    <div class="form-group">
                                        <div class="col-sm-12 col-md-12 col-xl-12 mb-30">
                                            
                                            <div class="form-group row">
                                               <div class="col-sm-12 col-md-12 col-xl-12" style="margin-top:0px;">
                                               <h4 class="sub-title">Letter for Pupilage<small><i style="color:red;">Certified copy .pdf format</i></small></h4>
                                                <div class="form-group row">
                                                    <div class="col-sm-9">
                                                    <input type="file" name="pupilage" accept=".pdf"/>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <button type="submit" class="btn btn-info"><i class="ik ik-share"></i>Upload</button>
                                                    </div>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>    
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group">
                                       
                                    </div>
                                </div>
                        </div>
                        @endif

                        @if(!empty($attach_move->intenship))
                        <div class="row" id="intenship">
                                <div class="col-sm-9">
                                <form class="intenship" method="POST" action="{{ url('petition/delete-intenship')}}" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                    <div class="form-group div20">
                                        <div class="col-sm-12 col-md-12 col-xl-12 mb-30">
                                            <div class="form-group row">
                                                <div class="col-sm-9">
                                                    <a target="_blank" href="{{ asset('storage/files/'.$attach_move->intenship) }}">
                                                    <span>
                                                        <p"><i style="color:red" class="fas fa-file-pdf fa-lg"></i> - Intenship / Extenship Certificate @if($petition_form->attachment == 1) - <span style="color:DeepSkyBlue;">&#10003;</span> @endif</p>
                                                    </span>
                                                    </a>
                                                </div>
                                                <div class="col-sm-3">
                                                    @if($petition_form->attachment == 0)
                                                    <button type="submit" class="btn btn-danger button20"><i class="ik ik-trash-2"></i>Remove</button>
                                                    @endif
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group">
                                       
                                    </div>
                                </div>
                        </div>
                        @else
                        <div class="row" id="intenship">
                                <div class="col-sm-9">
                                <form class="olevel" method="POST" action="{{ url('petition/post-intenship')}}" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                    <div class="form-group">
                                        <div class="col-sm-12 col-md-12 col-xl-12 mb-30">
                                            
                                            <div class="form-group row">
                                               <div class="col-sm-12 col-md-12 col-xl-12" style="margin-top:0px;">
                                               <h4 class="sub-title">Intenship / Extenship<small><i style="color:red;">Certified copy .pdf format</i></small></h4>
                                                <div class="form-group row">
                                                    <div class="col-sm-9">
                                                    <input type="file" name="intenship" accept=".pdf"/>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <button type="submit" class="btn btn-info"><i class="ik ik-share"></i>Upload</button>
                                                    </div>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>    
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group">
                                       
                                    </div>
                                </div>
                        </div>
                        @endif
                        @endif
                        @endif

                        @if($qualification)
                        @if($qualification->lst == 'Changed')
                        <!-- Name Changed -->
                        @if(!empty($attach_move->deedpoll))
                        <div class="row" id="deedpoll">
                                <div class="col-sm-9">
                                <form class="deedpoll" method="POST" action="{{ url('petition/delete-deedpoll')}}" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                    <div class="form-group div21">
                                        <div class="col-sm-12 col-md-12 col-xl-12 mb-30">
                                            <div class="form-group row">
                                                <div class="col-sm-9">
                                                    <a target="_blank" href="{{ asset('storage/files/'.$attach_move->deedpoll) }}">
                                                    <span>
                                                        <p><i style="color:red" class="fas fa-file-pdf fa-lg"></i> - Deed Poll @if($petition_form->attachment == 1) - <span style="color:DeepSkyBlue;">&#10003;</span> @endif</p>
                                                    </span>
                                                    </a>
                                                </div>
                                                <div class="col-sm-3">
                                                    @if($petition_form->attachment == 0)
                                                    <button type="submit" class="btn btn-danger button21"><i class="ik ik-trash-2"></i>Remove</button>
                                                    @endif
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group">
                                       
                                    </div>
                                </div>
                        </div>
                        @else
                        <div class="row" id="deedpoll">
                                <div class="col-sm-9">
                                <form class="deedpoll" method="POST" action="{{ url('petition/post-deedpoll')}}" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                    <div class="form-group">
                                        <div class="col-sm-12 col-md-12 col-xl-12 mb-30">
                                            
                                            <div class="form-group row">
                                               <div class="col-sm-12 col-md-12 col-xl-12" style="margin-top:0px;">
                                               <h4 class="sub-title">Deed Poll<small><i style="color:red;">Certified copy .pdf format</i></small></h4>
                                                <div class="form-group row">
                                                    <div class="col-sm-9">
                                                    <input type="file" name="deedpoll" accept=".pdf"/>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <button type="submit" class="btn btn-info"><i class="ik ik-share"></i>Upload</button>
                                                    </div>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>   
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group">
                                       
                                    </div>
                                </div>
                        </div>
                        @endif
                        @endif
                        @endif

                        <!-- Submit Attachements -->
                        @if($petition_form->attachment == 0)
                        <form class="submit" method="POST" action="{{ url('petition/post-attachments')}}">
                        {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger mr-2">Save All</button>
                        </form>
                        @endif
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

    </div>
</div>

@endsection


