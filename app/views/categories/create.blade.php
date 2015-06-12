@extends('layout')

@section('content')
   <div class="col-md-6 col-md-offset-3">
      <div class="row">
         <div class="panel panel-default">
            <div class="panel-heading">
               
               <h3 class="panel-title"><i class="fi-page-add"></i> Create Category</h3>
            </div>
            <div class="panel-body">
               {{ Form::open(['url' => route('categories.store'), 'method' => 'post', 'class' => 'form-vertical', 'autocomplete' => 'off']) }}
                  <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                     {{ Form::label('description', 'Category Description') }}
                     {{ Form::text('description', '', ['class' => 'form-control']) }}
                     <p class="help-block">Enter Category name here</p>

                     @if($errors->has('description'))
                     <p class="help-block">{{ $errors->first('description') }}</p>
                     @endif
                  </div>

                  <div class="for-group text-right">
                     {{ Form::submit('Submit', ['class' => 'btn btn-primary']) }}
                  </div>
               {{ Form::close() }}
            </div>
         </div>
      </div>
   </div>
@stop
