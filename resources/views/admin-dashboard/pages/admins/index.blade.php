@extends('layouts.adminMaster')

@section('title')
  Administrators
@endsection

@section('content')
  @section('header')
  <div class="row">
      <div class="col-md-12">
        <div class="col-md-8">
          <b>Administrators</b>
        </div>
        <div class="col-md-4">
          @if ($counter != 3)
            <a href="{{route('registeradmin')}}" class="btn green pull-right btn-md"><i class="fa fa-floppy-o"></i> Register Administrator</a>
          @endif
        </div>
      </div>
  </div>
  @endsection
  <div class="row">
    <br>
      <table class="table">
        <thead class="thead-inverse">
          <tr>
            <th>#</th>
            <th>Name</th>
            <th>Designation</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($admins as $admin)
            <tr>
              <th>{{$cc++}}</th>
              <td><a href="">{{$admin -> surname }}, {{$admin -> firstname }} {{substr($admin -> middlename, 0,1)}}.</a></td>
              <td>
                @if ($admin -> designation == 'president')
                    <em>{{"University President"}}</em>
                  @elseif ($admin -> designation == 'vpaa')
                    <em>{{"Vice-President of Academic Affairs"}}</em>
                  @elseif ($admin -> designation == 'hrd')
                    <em>{{"Human Resource Development Director"}}</em>
                @endif
              </td>
              <td>
                {!! Form::open(['route' => ['administrators.destroy', $admin->id], 'method' => 'DELETE']) !!}
                    {!! Form::button('<i class="fa fa-edit"></i>Remove', ['class' => 'btn red btn-md delete ', 'type' => 'submit']) !!}
                    <a href="{{route("administrators.edit", $admin->id)}}">
                      {!! Form::button('<i class="fa fa-edit"></i> Edit', ['class' => 'btn btn-info btn-md', 'type' => 'BUTTON']) !!}
                    </a>
                {!! Form::close() !!}

              </td>

            </tr>
          @endforeach
        </tbody>
      </table>
  </div>
@endsection
@section('javascript')
  <script type="text/javascript">
      $(document).on("click", ".delete", function(e) {
          if (confirm("Are you sure you want to delete this Administrator account?")) {
          }else {
            e.preventDefault();
          }
      });
  </script>
@endsection
