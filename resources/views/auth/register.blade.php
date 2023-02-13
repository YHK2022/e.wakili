<!DOCTYPE html>
<html>



<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ config('app.name', 'JSDS') }}</title>

    <link href="{{ asset('css2/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('font-awesome/css/font-awesome.css') }}" rel="stylesheet">
    <link href="{{ asset('css2/plugins/iCheck/custom.css')  }}" rel="stylesheet">

    <link href="{{ asset('css2/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('css2/style.css') }}" rel="stylesheet">

    <style>
        body{
            margin: 0;
            padding: 0;
        }
        body:before{
            content: '';
            position: fixed;
            width: 100vw;
            height: 100vh;
            background-image: url("images/users/jotScales.png");
            background-position: center center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;
            -webkit-filter: blur(3px);
            -moz-filter: blur(3px);
            -o-filter: blur(3px);
            -ms-filter: blur(3px);
            filter: blur(3px);
        }
        .contact-form
        {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%,-50%);
            padding: 40px 30px;
            box-sizing: border-box;
            background: rgba(0,0,0,.2);
        }
        .avatar {
            position: absolute;
            width: 130px;
            height: 130px;
            border-radius: 50%;
            overflow: hidden;
            margin-left: auto;
            margin-right: auto;
            left: 0;
            right: 0;
            top: calc(-70px/2);
        }

        .contact-form a
        {
            color: #fff;
            font-size: 14px;
            font-weight: bold;
            text-decoration: none;
        }


    </style>
</head>

<body class="gray-bg">

    <div class="contact-form fadeInDown">

            <div>
                <center>
                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissable">
                            @foreach($errors->all() as $error)
                                <a href="#" class="alert-link">INFO! :</a> {{ $error }}
                            @endforeach
                        </div>
                    @endif
                </center>
            </div>
            <form method="POST" action="{{ route('register')}}" class="m-t" role="form" autocomplete="off">
                    {{ csrf_field() }}
                <div class="row">
                    <div class="col-md-12">
                        <center>
                            <p style="font-size:20px;color:black;">Registration Form <small>(All fields are mandatory)</small></p>
                        </center><hr/>
                    </div>
                </div>
            <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <input id="fname" type="text" class="form-control" name="fname"
                           value="{{ old('fname') }}" placeholder="Enter First Name" required />
                </div>
                <div class="form-group">
                    <input id="lname" type="text" class="form-control" name="lname"
                           value="{{ old('lname') }}" placeholder="Enter Last Name" required />
                </div>
                <div class="form-group">
                    {!! Form::select('countries', $countries, null, ['class'=>'countryId form-control',
                    'id'=>'countries', 'placeholder'=>'Select Country', 'required']) !!}
                </div>
                <div class="form-group">
                    {!! Form::select('idType', $idType, null, ['class'=>'form-control',
                                'id'=>'idType', 'placeholder'=>'ID Type', 'required']) !!}
                </div>
                <div class="form-group">
                    <input id="tin" type="text" class="form-control" name="tin"
                           value="{{ old('tin') }}" placeholder="Enter TIN" required />
                </div>
                <div class="form-group">
                    {!! Form::select('firmName', $firmName, null, ['class'=>'firmId2 form-control',
                    'id'=>'firmName', 'placeholder'=>'Select Law Firm', 'required']) !!}
                </div>
                <div class="form-group">
                    <input id="mobile" type="text" class="form-control" name="mobile"
                    data-mask="999 999 9999"  placeholder="Mobile Number" required />
                </div>

                <div class="form-group">
                    {!! Form::select('qualification', $advQualification, null, ['class'=>'firm-select form-control',
                    'id'=>'qualification', 'placeholder'=>'Select Qualification', 'required']) !!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <input id="oname" type="text" class="form-control" name="mname"
                           value="{{ old('mname') }}" placeholder="Enter Middle Name"/>
                </div>
                <div class="form-group">
                    <input id="roll" type="number" class="form-control" name="rollNumber"
                           value="{{ old('rollNumber') }}" placeholder="Enter Roll Number" required />
                </div>
                <div class="form-group">
                    <input id="address" type="text" class="form-control" name="address"
                           value="{{ old('address') }}" placeholder="Enter Physical Address" />
                </div>
                <div class="form-group">
                    <input id="idNumber" type="text" class="form-control" name="idNumber"
                                value="{{ old('idNumber') }}" placeholder="Enter ID Number" required />
                </div>
                <div class="form-group">
                    <input id="dateBirth" type="text" class="form-control" name="dateBirth" value="{{ old('dateBirth') }}" placeholder="Date of Birth" required readonly/>
                </div>
                <div class="form-group">
                    <input id="email" type="email" class="form-control" name="email"
                           value="{{ old('email') }}" placeholder="Enter Email" />
                </div>
                <div class="form-group">
                    <input id="password" type="password" class="form-control" name="password"
                           placeholder="Password" required />
                </div>
                <div class="form-group">
                    <input id="password-confirm" type="password" class="form-control"
                           name="password_confirmation" placeholder="Confirm Password" required />
                </div>

            </div>
            </div>
            <div class="row">
                    <div class="col-md-12" style="font-size:14px;color:black;">
                       <label  class="font-bold"><i class="fa fa-user"></i> - Select user group. <a href="{{ url('login') }}"> Already have an account? <i class="fa fa-sign-in"></i> Login</a></label><br/>
                       <input type="radio" name="enforcementName" id="advocate" value="Advocate" required>
                        &nbsp; Advocate &nbsp;
                        <input type="radio" name="enforcementName" id="attorney" value="fine" required>
                        &nbsp; State Attorney/Solisitor &nbsp;&nbsp;
                        <input type="radio" name="enforcementName" id="imprisonment" value="imprisonment" required>
                        &nbsp; Individual Litigant &nbsp;&nbsp;
                    </div>
            </div>
            <div class="row" id="userAdvocate" style="display: none">
                <div class="col-md-12">
                <button type="submit" class="btn btn-sm btn-block btn-primary"><i class="fa fa-sign-in"></i> Request Registration</button>
                </div>
            </div>
            <div class="row" id="userAttorney" style="display: none">
                <div class="col-md-12">
                <button type="submit" class="btn btn-sm btn-block btn-primary"><i class="fa fa-sign-in"></i> Request Registration</button>
                </div>
            </div>

            </form>
        <center><p class="m-t" style="color:black;"> <small><span>Copyright &copy; <?php echo date('Y'); ?>. Judiciary of Tanzania.</span><br><span> JSDS version 2.1</span></small></p></center>
    </div>




<script src="{{ asset('assets/js/plugins/iCheck/icheck.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery-3.1.1.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>

<script>
        $(document).ready(function() {

            setTimeout(function() {
                toastr.options = {
                    closeButton: true,
                    progressBar: true,
                    showMethod: 'slideDown',
                    timeOut: 4000
                };
                toastr.success('A Case Management System', 'Welcome to JSDS 2');

            }, 1300);


           $('#compensation').on('ifChecked', function () {
                $('#caseFine').slideUp();
                $('#caseImprisonment').slideUp();
                $('#caseFine :input').attr('disabled', true);
                $('#caseImprisonment :input').attr('disabled', true);

                $('#caseCompensation :input').attr('disabled', false);
                $("#caseCompensation").slideDown();
            });

            $('#fine').on('ifChecked', function () {
                $('#caseImprisonment').slideUp();
                $('#caseCompensation').slideUp();
                $('#caseImprisonment :input').attr('disabled', true);
                $('#caseCompensation :input').attr('disabled', true);

                $('#caseFine :input').attr('disabled', false);
                $("#caseFine").slideDown();
            });

            $('#imprisonment').on('ifChecked', function () {
                $('#caseFine').slideUp();
                $('#caseCompensation').slideUp();
                $('#caseFine :input').attr('disabled', true);
                $('#caseCompensation :input').attr('disabled', true);

                $('#caseImprisonment :input').attr('disabled', false);
                $("#caseImprisonment").slideDown();
            });

            $('#birthDate').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                format: 'yyyy-mm-dd'
            }).on('change', function () {
                $('.datepicker').hide();
            });

            $('#dateBirth').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                format: 'yyyy-mm-dd'
            }).on('change', function () {
                $('.datepicker').hide();
            });


            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });



            $('.firmId').select2({
                placeholder: 'Select Office',
                width: '100%'

            });

            $('.firmId2').select2({
                placeholder: 'Select AdvocateCategory Firm',
                width: '100%'

            });

            $('.countryId').select2({
                placeholder: 'Select Country',
                width: '100%'
            });



            $("#selectbox").on("change", function() {
              var sOptionVal = $(this).val();
              if (/modal/i.test(sOptionVal)) {
                var $selectedOption = $(sOptionVal);
                $selectedOption.modal('show');
              }
            });

        var uploadField = document.getElementById("file");

          uploadField.onchange = function() {
            if(this.files[0].size > 26214288.15237){
           alert("File is too big to be uploaded!");
           this.value = "";
            };
        };

        });
    </script>
</body>


</html>
