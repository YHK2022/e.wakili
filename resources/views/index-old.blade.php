<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
  <meta name="description" content=""/>
  <meta name="author" content=""/>
  <title>{{ config('app.name', 'eCMS') }}</title>
  <!--favicon-->
  <link rel="icon" href="homepage/images/Judiciary-Logo.png" type="image/x-icon">
  <!-- simplebar CSS-->
  <link href="{{ asset('homepage/plugins/simplebar/css/simplebar.css') }}" rel="stylesheet">
  <!-- Bootstrap core CSS-->
  <link href="{{ asset('homepage/css/bootstrap.min.css') }}" rel="stylesheet">
  <!-- animate CSS-->
  <link href="{{ asset('homepage/css/animate.css') }}" rel="stylesheet">
  <!-- Icons CSS-->
  <link href="{{ asset('homepage/css/icons.css') }}" rel="stylesheet">
  <!-- Horizontal menu CSS-->
  <link href="{{ asset('homepage/css/horizontal-menu.css') }}" rel="stylesheet">
  <!-- Custom Style-->
  <link href="{{ asset('homepage/css/app-style.css') }}" rel="stylesheet">
 
  
</head>

<body>

<!-- start loader -->
   <div id="pageloader-overlay" class="visible incoming"><div class="loader-wrapper-outer"><div class="loader-wrapper-inner" ><div class="loader"></div></div></div></div>
   <!-- end loader -->

<!-- Start wrapper-->
 <div id="wrapper">

  <!--Start topbar header-->
<header class="topbar-nav-head">
 <nav class="navbar navbar-expand">
  <ul class="navbar-nav mr-auto align-items-center">
    <li class="nav-item">
      <a class="nav-link" href="javascript:void();">
        <div class="media align-items-center">
          <div class="media-body">
            <h5 class="logo-text-head"><strong>eCMS</strong></h5>
          </div>
        </div>
     </a>
    </li>
  </ul>
     
  <ul class="navbar-nav align-items-center right-nav-link">

    <li class="nav-item">
      <a class="nav-link dropdown-toggle dropdown-toggle-nocaret login" href="{{ url('login') }}">
        <i class="fa fa-unlock-alt"></i> Sign in
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link dropdown-toggle dropdown-toggle-nocaret login" data-toggle="dropdown" href="#">
        <i class="fa fa-group"></i> Register
      </a>
      <ul class="dropdown-menu dropdown-menu-right">
       <li class="dropdown-item user-details">
        <a href="javaScript:void();">
           <div class="media">
            <div class="media-body">
            <h6 class="mt-2 user-title">Select your Profile</h6>
            </div>
           </div>
          </a>
        </li>
        <li class="dropdown-divider"></li>
        <li class="dropdown-item"><i class="fa fa-gavel mr-2"></i><a href="{{ url('advocate-registration') }}"> Advocate</a></li>
        <li class="dropdown-divider"></li>
        <li class="dropdown-item"><i class="fa fa-balance-scale mr-2"></i><a href="{{ url('attorney-registration') }}"> State Attorney</a></li>
        <li class="dropdown-divider"></li>
        <li class="dropdown-item"><i class="fa fa-user-circle-o mr-2"></i><a href="{{ url('litigant-registration') }}"> Individual Litigant</a></li>
        <li class="dropdown-divider"></li>
        <li class="dropdown-item"><i class="fa fa-bank mr-2"></i><a href="{{ url('bureau-registration') }}"> Service Bureau</a></li>
        <li class="dropdown-divider"></li>
        <li class="dropdown-item"><i class="fa fa-user-secret mr-2"></i><a href="#"> Argent</a></li>
      </ul>
    </li>
  </ul>
</nav>
</header>
<!--End topbar header-->


<div class="clearfix"></div>
	
  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumb-->
     
    <!-- End Breadcrumb-->

      <div class="row">
        <div class="col-lg-3">
           <div class="card profile-card-2">
            <div class="card-img-block">
                <img class="img-fluid" src="homepage/images/highcourtkigoma.jpg" alt="Card image cap">
            </div>
            <div class="card-body pt-5">
                <img src="homepage/images/Judiciary-Logo.png" alt="profile-image" class="profile">
                <h5 class="card-title">The Judiciary</h5>
                <p style="text-align: justify;" class="card-text">Judiciary of Tanzania is also available on various social media platforms.</p>
                <div class="icon-block">
                  <a href="javascript:void();"><i class="fa fa-globe bg-facebook text-white"></i></a>
                  <a href="javascript:void();"><i class="fa fa-facebook bg-facebook text-white"></i></a>
                  <a href="javascript:void();"><i class="fa fa-twitter bg-twitter text-white"></i></a>
                  <a href="javascript:void();"><i class="fa fa-youtube bg-youtube text-white"></i></a>
                </div>
            </div>

            <div class="card-body border-top border-light">
              <h5 class="card-title">e-Services</h5>
              <div class="media align-items-center">
                <a href="{{ url('login') }}"><i class="fa fa-gavel"></i>e-Filing</a>
               </div>
               <hr>
               <div class="media align-items-center">
                <a href="#"><i class="fa fa-globe"></i>e-Judiciary Portal</a>
               </div>
               <hr>
               <div class="media align-items-center">
                <a href="#"><i class="fa fa-file"></i>eCMS User Guide</a>
               </div>

            </div> 
        </div>

        </div>

        <div class="col-lg-9">
           <div class="card">
            <div class="card-body">
            <ul class="nav nav-tabs nav-tabs-primary top-icon nav-left">
                <li class="nav-item">
                    <a class="nav-link active heading"> <h5>electronic Case Management System</h5></a>
                </li>
            </ul>
            <div class="tab-content p-3">
                <div class="tab-pane active" id="profile">
                    <h5 class="mb-3">About</h5>
                    <div class="row">
                        <div class="col-md-12">
                            <p style="text-align: justify;">
                              Electronic Case Management System (eCMS) is currently being used by all judges and court officials of all courts nationwide to computerize case documents. CMS supports judges and court officials in computerizing all kinds of cases such as merits of civil cases, family, criminal and administrative case. After the integrated menu called 'Case Management System’ was newly developed in 1998, a common system was developed for receiving cases, allocating cases, managing official documents, serving documents, preserving documents, etc. Later on, CMS began to be implemented by each type of cases starting from civil cases and then family, administrative, insolvency cases, etc., consecutively. From 2000, the function of CMS was dramatically improved through segmentation of jobs and improvement of the system. As for criminal cases, electronic information is being exchanged between the police, prosecution and Ministry of Justice through Korea Information System of Criminal Justice Services. In particular, the E-Summary System through which all cases are handled electronically is being operated for some summary cases such as drunk driving or unlicensed driving. The Judiciary implemented the Electronic Case Filing System (ECFS) as the next generation model of CMS. ECFS is providing efficient service to the public by the support of litigation process without paper
                            </p>
                        </div>
                        <div class="col-md-12">
                            <h5 class="mt-2 mb-3"><span class="fa fa-clock-o ion-clock float-right"></span> System Scope</h5>
                             <div class="table-responsive">
                            <table class="table table-hover table-striped">
                                <tbody>                                    
                                    <tr>
                                        <td>
                                            <strong>Court of Appeal</strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong>High Courts</strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong>Resident Magistrate Courts</strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong>District Courts</strong>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                          </div>
                        </div>
                    </div>
                    <!--/row-->
                </div>
            </div>
        </div>
      </div>
      </div>
        
    </div>
<!--start overlay-->
		  <div class="overlay toggle-menu"></div>
		<!--end overlay-->
    </div>
    <!-- End container-fluid-->
   </div><!--End content-wrapper-->
   <!--Start Back To Top Button-->
    <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
    <!--End Back To Top Button-->
	
	<!--Start footer-->
	<footer class="footer">
      <div class="container">
        <div class="text-center">
          Copyright &copy; <?php echo date('Y'); ?>. Judiciary of Tanzania
        </div>
      </div>
    </footer>
	<!--End footer-->
	
   
  </div><!--End wrapper-->


  <!-- Bootstrap core JavaScript-->
  <script src="{{ asset('homepage/js/jquery.min.js') }}"></script>
  <script src="{{ asset('homepage/js/popper.min.js') }}"></script>
  <script src="{{ asset('homepage/js/bootstrap.min.js') }}"></script>
	
  <!-- simplebar js -->
  <script src="{{ asset('homepage/plugins/simplebar/js/simplebar.js') }}"></script>
  <!-- horizontal-menu js -->
  <script src="{{ asset('homepage/js/horizontal-menu.js') }}"></script>
  
  <!-- Custom scripts -->
  <script src="{{ asset('homepage/js/app-script.js') }}"></script>
	
</body>
</html>
