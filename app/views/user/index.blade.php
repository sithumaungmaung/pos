@extends('layout')

@section('content')
   <div class="col-md-11">
      <div class="row">
         <div class="panel panel-default">

            <div class="panel-heading">
               @include('user.menu')

               <h3 class="panel-title"><i class="fi-page-users"></i> Users</h3>
            </div>

            <div class="panel-body">
               <table class="table table-condensed">
                  <thead>
                     <tr>
                        <th>#</th>
                        <th class="col-md-3">Email</th>
                        <th class="col-md-2">Role</th>                        
                        <th class="col-md-3">Username</th>                        
                        <th class="col-md-3"></th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach($users as $key => $user)
                     <tr>
                        <td>{{ $index+$key }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ implode('', $user->groups->lists('name')) }}</td>
                        <td>{{ $user->username }}</td>
                        <td class="actions">
                           <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-primary"><i class="fi-pencil"></i> Edit</a>
                           {{ Form::open(['url' => route('users.destroy', $user->id), 'method' => 'delete']) }}
                              {{ Form::button('<i class="fi-trash"></i> Delete', ['class' => 'btn btn-sm btn-danger', 'type' => 'submit', 'onclick' => 'return confirm("Are you sure you want to delete?")']) }}
                           {{ Form::close() }}
                        </td>
                     </tr>
                     @endforeach
                  </tbody>
               </table>

               {{ $users->links() }}
            </div>
         </div>
      </div>
   </div>
@stop
