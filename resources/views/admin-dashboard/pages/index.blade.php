@extends('layouts.adminMaster')

@section('title')
  Admin Dashboard
@endsection

@section('content')

  @section('header')
    <b>Dashboard</b>
  @endsection

  @include('admin-dashboard.pages.dashboard.layout-dashboard')

@endsection

@section('javascript')
  @include('footervarview')
@include('admin-dashboard.pages.includes.dashboard')
@endsection 

{{-- <div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-tasks fa-fw"></i> Content Manager
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
              <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Professional Development Activities
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Title</th>
                                            <th>Category</th>
                                            <th>Created On</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Professional Activity 1</td>
                                            <td>Instruction</td>
                                            <td>11/12/16</td>
                                            <td><i class="fa fa-edit fa-fw"></i><i class="fa fa-trash-o fa-fw"></i></td>
                                        </tr>
                                        <tr>
                                            <td>Professional Activity 2</td>
                                            <td>Research</td>
                                            <td>11/12/16</td>
                                            <td><i class="fa fa-edit fa-fw"></i><i class="fa fa-trash-o fa-fw"></td>
                                        </tr>
                                        <tr>
                                            <td>Professional Activity 3</td>
                                            <td>Extension</td>
                                            <td>11/12/16</td>
                                            <td><i class="fa fa-edit fa-fw"></i><i class="fa fa-trash-o fa-fw"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
              </div>
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->

</div>
<!-- /.row --> --}}
