@extends('layout')

@section('content')
   <div class="col-md-6 col-md-offset-3">
      <div class="row">
         <div class="panel panel-default">
            <div class="panel-heading">
               
               <h3 class="panel-title"><i class="fi-page-add"></i> Create Product</h3>
            </div>
            <div class="panel-body">
               {{ Form::open(['url' => route('products.store'), 'method' => 'post', 'class' => 'form-vertical', 'autocomplete' => 'off']) }}
                  <div class="row">
                     <div class="col-md-6">
                        <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                           {{ Form::label('description', 'Product Name') }}
                           {{ Form::text('description', '', ['class' => 'form-control']) }}
                           <p class="help-block">Enter Product name here</p>

                           @if($errors->has('description'))
                           <p class="help-block">{{ $errors->first('description') }}</p>
                           @endif
                        </div>
                     </div>
                     
                  </div>

                   <div class="row">
                     <div class="col-md-4">
                        <div class="form-group {{ $errors->has('buyingprice') ? 'has-error' : '' }}">
                           {{ Form::label('buyingprice', 'Cost Price') }}
                           <div class="input-group">
                              <span class="input-group-addon"><i class="fa fa-rupee"></i></span>
                              {{ Form::text('buyingprice', '', ['class' => 'form-control']) }}
                           </div>
                           @if($errors->has('buyingprice'))
                           <p class="help-block">{{ $errors->first('buyingprice') }}</p>
                           @endif
                        </div>
                     </div>

                     <div class="col-md-4">
                        <div class="form-group {{ $errors->has('sellingprice') ? 'has-error' : '' }}">
                           {{ Form::label('sellingprice', 'Selling Price') }}
                           <div class="input-group">
                              <span class="input-group-addon"><i class="fa fa-rupee"></i></span>
                              {{ Form::text('sellingprice', '', ['class' => 'form-control']) }}
                           </div>
                           @if($errors->has('sellingprice'))
                           <p class="help-block">{{ $errors->first('sellingprice') }}</p>
                           @endif
                        </div>
                     </div>

                     
                  </div>

                  <div class="row">
                    
                     <div class="col-md-4">
                        <div class="form-group {{ $errors->has('category_id') ? 'has-error' : '' }}">
                           {{ Form::label('category_id', '') }}
                           {{ Form::select('category_id', $categories, '', ['class' => 'form-control']) }}
                           @if($errors->has('category_id'))
                           <p class="help-block">{{ $errors->first('category_id') }}</p>
                           @endif
                        </div>
                     </div>

                     <div class="col-md-4">
                        <div class="form-group {{ $errors->has('um_id') ? 'has-error' : '' }}">
                           {{ Form::label('um_id', 'Unit') }}
                           {{ Form::select('um_id', $units, '', ['class' => 'form-control']) }}
                           @if($errors->has('um_id'))
                           <p class="help-block">{{ $errors->first('um_id') }}</p>
                           @endif
                        </div>
                     </div>
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
