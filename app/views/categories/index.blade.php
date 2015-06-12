@extends('layout')

@section('content')
   <div class="col-md-12">
      <div class="row">
         <div class="panel panel-default">
            <div class="panel-heading">
               
               <h3 class="panel-title"><i class="fi-page-multiple"></i> Categories</h3>
            </div>
            <div class="panel-body">
               <table class="table condence">
                  <thead>
                     <tr>
                        <th>#</th>
                        <th class="col-md-9">Category Name</th>
                        <th class="col-md-3"></th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach($categories as $key => $category)
                     <tr>
                        <td>{{ $index+$key }}</td>
                        <td>{{ $category->description }}</td>
                        <td class="actions">
                           <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-sm btn-primary"><i class="fi-pencil"></i> Edit</a>
                           {{ Form::open(['url' => route('categories.destroy', $category->id), 'method' => 'delete']) }}
                              {{ Form::button('<i class="fi-trash"></i> Delete', ['class' => 'btn btn-sm btn-danger', 'type' => 'submit']) }}
                           {{ Form::close() }}
                        </td>
                     </tr>
                     @endforeach
                  </tbody>
               </table>

               {{ $categories->links() }}
            </div>
         </div>
      </div>
   </div>
@stop
