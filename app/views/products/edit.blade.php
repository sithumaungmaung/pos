@extends('layout')

@section('content')
   <div class="col-md-6 col-md-offset-3">
      <div class="row">
         <div class="panel panel-default">
            <div class="panel-heading">
               @include('products.menu')
               <h3 class="panel-title"><i class="fi-page-add"></i> Edit Product</h3>
            </div>
            <div class="panel-body">
               {{ Form::open(['url' => route('products.update',$product->id), 'method' => 'put', 'class' => 'form-vertical', 'autocomplete' => 'off']) }}
                  <div class="row">
                      <div class="col-md-6">
                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                           {{ Form::label('name', 'Product Name') }}
                           {{ Form::text('name', $product->name, ['class' => 'form-control']) }}
                           <p class="help-block">Enter Product name here</p>

                           @if($errors->has('name'))
                           <p class="help-block">{{ $errors->first('name') }}</p>
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
                              {{ Form::text('buyingprice', $product->buyingprice, ['class' => 'form-control']) }}
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
                              {{ Form::text('sellingprice', $product->sellingprice, ['class' => 'form-control']) }}
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
                           {{ Form::label('category_id', 'Category') }}
                           {{ Form::select('category_id', $categories, $product->category_id, ['class' => 'form-control']) }}
                           @if($errors->has('category_id'))
                           <p class="help-block">{{ $errors->first('category_id') }}</p>
                           @endif
                        </div>
                     </div>

                     <div class="col-md-4">
                        <div class="form-group {{ $errors->has('um_id') ? 'has-error' : '' }}">
                           {{ Form::label('um_id', 'Unit') }}
                           {{ Form::select('um_id', $units, $product->um_id, ['class' => 'form-control']) }}
                           @if($errors->has('um_id'))
                           <p class="help-block">{{ $errors->first('um_id') }}</p>
                           @endif
                        </div>
                     </div>
                  </div>     
                  

                  <div class="for-group text-right">
                     {{ Form::hidden('check_update', 1, ['class' => 'form-control']) }}
                     {{ Form::submit('Submit', ['class' => 'btn btn-primary']) }}
                  </div>
               {{ Form::close() }}
            </div>
         </div>
      </div>
   </div>
@stop
