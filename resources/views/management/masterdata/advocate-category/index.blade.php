@extends('mgt-static')

@section('title')
    @parent
    | Advocate Category
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
                                <h5>Master Data</h5>
                                <span>Advocate Category</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <nav class="breadcrumb-container" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ url('auth/dashboard') }}"><i class="ik ik-home"></i></a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Advocate Category</li>
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
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        {{ $error }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <i class="ik ik-x"></i>
                        </button>
                    </div>
                @endforeach
            @endif

            <!-- End Alert-->
            <div>
                <a data-toggle="modal" data-target="#addSession" title="Add Session" class="btn btn-info btn-xm pull-right">
                    <i class="fa fa-plus"></i>
                    Add Advicate Category
                </a>
                <!-- Add Session Model-->
                <div class="modal fade" id="addSession" tabindex="-1" role="dialog" aria-labelledby="demoModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <form class="forms-sample" method="POST" action="{{ url('settings/advocate-category/add') }}">
                                {{ csrf_field() }}
                                <div class="modal-header">
                                    <h5 class="modal-title" id="demoModalLabel">Add Advicate Category</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                            aria-hidden="true">&times;</span></button>
                                </div>
                                <div class="modal-body">

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Name</label>
                                                <input type="text" name="name" class="form-control  is-valid"
                                                    placeholder="Name" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="exampleInputConfirmPassword1">Description</label>
                                                <input type="text" name="description" class="form-control  is-valid"
                                                    placeholder="Description" required>
                                            </div>
                                        </div>
                                    </div>



                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-danger">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <br />
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-hover" id="table_id">
                                <thead>
                                    <tr>
                                        <th id="table_id" data-priority="1">#</th>
                                        <th id="table_id">Name</th>
                                        <th id="table_id">Description</th>
                                        <th id="table_id" data-priority="2">Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($actions as $key => $action)
                                        <tr>
                                            <td id="table_id">{{ ++$key }}</td>
                                            <td id="table_id">{{ $action->name }}</td>
                                            <td id="table_id">{{ $action->description }}</td>


                                            <td id="table_id">

                                                <a href="#edit{{ $action->id }}" title="Edit" data-toggle="modal"
                                                    data-id="{{ $action->id }}"
                                                    data-target="#edit{{ $action->id }}"><i
                                                        class="ik ik-edit-2"></i></a>
                                                <a href="#delete{{ $action->id }}" title="Delete" data-toggle="modal"
                                                    data-id="{{ $action->id }}"
                                                    data-target="#delete{{ $action->id }}"><i
                                                        class="ik ik-trash-2"></i></a>

                                            </td>
                                        </tr>

                                        <!-- Edit Session Model-->
                                        <div class="modal fade" id="edit{{ $action->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="demoModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <form class="forms-sample" method="POST"
                                                        action="{{ url('settings/advocate-category/edit', $action->id) }}">
                                                        {{ csrf_field() }}
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="demoModalLabel">Edit Advocate
                                                                Category
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close"><span
                                                                    aria-hidden="true">&times;</span></button>
                                                        </div>
                                                        <div class="modal-body">

                                                            <div class="row">
                                                                <div class="col-sm-6">
                                                                    <div class="form-group">
                                                                        <label for="exampleInputPassword1">Name
                                                                        </label>
                                                                        <input type="text" name="name"
                                                                            value="{{ $action->name }}"
                                                                            class="form-control  is-valid"
                                                                            placeholder="name" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div class="form-group">
                                                                        <label
                                                                            for="exampleInputConfirmPassword1">Description
                                                                        </label>
                                                                        <input type="text" name="description"
                                                                            value="{{ $action->description }}"
                                                                            class="form-control  is-valid"
                                                                            placeholder="description" required>
                                                                    </div>
                                                                </div>
                                                            </div>



                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-danger">Edit</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>


                                        <!-- Delete session Model-->
                                        <div class="modal fade" id="delete{{ $action->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="demoModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-sm" role="document">
                                                <div class="modal-content">
                                                    <form class="forms-sample" method="POST"
                                                        action="{{ url('settings/advocate-category/delete', $action->id) }}">
                                                        {{ csrf_field() }}
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="demoModalLabel">Delete Petition
                                                                Session</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close"><span
                                                                    aria-hidden="true">&times;</span></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Are you sure you want to delete Active Directory:
                                                            <strong> {{ $action->open_date }} </strong>?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-danger">Yes
                                                                Delete</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
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
