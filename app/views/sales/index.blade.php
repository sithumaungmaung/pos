@extends('layout')

@section('content')
   <div class="col-md-12">
      <div class="row">
         <div class="panel panel-default">
            <div class="panel-heading">
               @include('sales._menu')
               <h3 class="panel-title"><i class="fi-page-multiple"></i> Sales </h3>
            </div>
            <div class="panel-body sales-list">
               @include('sales._filter')

               <table class="table table-condensed">
                  <thead>
                     <tr>
                        <th>#</th>
                        <th class="col-md-3">Reference No</th>
                        <th class="col-md-2">Total ( Ks )</th>
                        <th class="col-md-2">Discount ( Ks )</th>                       
                        <th class="col-md-1">Items</th>
                        <th class="col-md-2">Date</th>
                        
                        <th class="col-md-3"></th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php
                     $totamount=0;
                     $totdistcount=0;
                     $totpaid=0;
                     $totbalance=0;
                     ?>
                     @foreach($sales as $key => $sale)
                     
                     <tr>
                        <td>{{ $sales->getFrom() + $key }}</td>
                        <td>{{ $sale->reference_no }}</td>
                        <td>{{ (int)$sale->total }}</td>
                        <td>{{ (int)$sale->discount }}</td>
                        
                        <td>{{ $sale->items->count() }}</td>
                        <td>{{$sale->created_at}}</td>
                        
                        <td class="actions">
                           <a target="_blank" href="{{ route('sales.show', $sale->id) }}" class="btn btn-sm btn-success"><i class="fi-print"></i> Print</a>
                           
                           
                           <a href="{{ route('sales.edit', $sale->id) }}" class="btn btn-sm btn-primary"><i class="fi-pencil"></i> Edit</a>
                           
                           @if($logged_user->hasAccess('sales.returnitem'))
                           <a href="{{ route('sales.returnitem', $sale->id) }}" class="btn btn-sm btn-warning"><i class="fi-minus"></i> Return Item</a>
                           @endif

                           @if($logged_user->hasAccess('sales.destroy'))
                           {{ Form::open(['url' => route('sales.destroy', $sale->id), 'method' => 'delete']) }}
                              {{ Form::button('<i class="fi-trash"></i> Delete', ['class' => 'btn btn-sm btn-danger', 'type' => 'submit']) }}
                           {{ Form::close() }}
                           @endif
                        </td>
                     </tr>
                     <?php

                     $totamount = (int)($totamount + $sale->total);
                     $totdistcount = (int)($totdistcount + $sale->discount);
                     $totpaid = (int)($totpaid + $sale->paid);
                     $totbalance = (int)($totbalance + ($sale->total - $sale->paid));
                     ?>
                     @endforeach
                     <tr>
                        <td></td>
                        <td><strong>TOTAL</strong></td>
                        <td><strong>{{$totamount}}</strong></td>
                        <td><strong>{{$totdistcount}}</strong></td>
                        <td><strong>{{$totpaid}}</strong></td>
                        <td><strong>{{$totbalance}}</strong></td>
                        <td></td>
                        <td></td>
                        <td></td>
                     </tr>
                  </tbody>
               </table>

               {{ $sales->links() }}

            </div>
         </div>
      </div>
   </div>
@stop


