@extends('layout')

@section('content')
   <div class="col-md-8 col-md-offset-2">
      <div class="row">
         <div class="panel panel-default">
            <div class="panel-heading">
               @include('stocks.menu')
               <h3 class="panel-title"><i class="fi-page-add"></i> Update Stock Quantity</h3>
            </div>
            <div class="panel-body">
               {{ Form::open(['url' => route('stocks.update',$stock->id), 'method' => 'put', 'class' => 'form-vertical', 'autocomplete' => 'off']) }}
                  <div class="row">
                     <div class="col-md-4">
                        <div class="form-group {{ $errors->has('category_id') ? 'has-error' : '' }}">
                           {{ Form::label('category_id', 'Product Category') }}
                           <p class="form-control-static">
                              {{$stock->product->category->description}}
                           </p>
                        </div>
                     </div>

                     <div class="col-md-8">
                        <div class="form-group {{ $errors->has('product_id') ? 'has-error' : '' }}">
                           {{ Form::label('product_id', 'Product') }}
                           <p class="form-control-static">
                              {{$stock->product->name}}
                           </p>
                        </div>
                     </div>
                  </div>

                  <div class="row">

                     <div class="col-md-4">
                        <div class="form-group {{ $errors->has('quantity') ? 'has-error' : '' }}">
                           {{ Form::label('quantity', 'Quantity') }}
                           {{ Form::text('quantity', $stock->quantity, ['class' => 'form-control']) }}
                           @if($errors->has('quantity'))
                           <p class="help-block">{{ $errors->first('quantity') }}</p>
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
