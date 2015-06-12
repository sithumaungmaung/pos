@extends('layout')

@section('content')
   <div class="col-md-12">
      <div class="row">
         <div class="panel panel-default">

            <div class="panel-heading">
               @include('stocks.menu')

               <h3 class="panel-title"><i class="fi-page-multiple"></i> Stocks</h3>
            </div>

            <div class="panel-body">
               @include('stocks.filter')

               <table class="table table-condensed">
                  <thead>
                     <tr>
                        <th>#</th>
                        <th class="col-md-4">Product</th>
                        <th class="col-md-3">Cost/Sale</th>
                        <th class="col-md-1">Quantity</th>
                        <th class="col-md-2">Date</th>
                        <th class="col-md-3"></th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach($stocks as $key => $stock)
                     <tr>
                        <td>{{ $index+$key }}</td>
                        <td>
                           @if($stock->product)
                           <a href="{{ route('products.show', $stock->product->id) }}">{{ stripslashes($stock->product->name) }}</a><br />
                           <small>{{ $stock->product->product_code}}</small>
                           @else
                           <small>Product deleted</small>
                           @endif
                        </td>
                       
                        <td>
                           @if($stock->product)
                           <i class="fa fa-rupee"></i> {{ $stock->product->buyingprice }} / <i class="fa fa-rupee"></i> {{ $stock->product->sellingprice}}
                           @endif
                        </td>

                        <td>{{ $stock->quantity }}</td>
                        
                        <td>
                           {{ date('d/m/Y h:iA', strtotime($stock->created_at)) }}
                        </td>
                        <td>
                           
                            <a href="{{ route('stocks.edit', $stock->id) }}" class="btn btn-sm btn-primary"><i class="fi-pencil"></i> Edit</a>
                            
                        </td>

                     
                     </tr>
                     @endforeach
                  </tbody>
               </table>
               <?php
               $input = Input::all();
               if(isset($input['page']))
                  unset($input['page']);
               ?>
               {{ $stocks->appends($input)->links() }}
            </div>
         </div>
      </div>
   </div>
@stop
