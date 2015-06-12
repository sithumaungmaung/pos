@extends('layout')

@section('content')
   <div class="col-md-8 col-md-offset-2">
      <div class="row">
         <div class="panel panel-default">
            <div class="panel-heading">
               @include('stocks.menu')
               <h3 class="panel-title"><i class="fi-page-add"></i> Create Stock</h3>
            </div>
            <div class="panel-body">
               {{ Form::open(['url' => route('stocks.store'), 'method' => 'post', 'class' => 'form-vertical', 'autocomplete' => 'off']) }}
                  <div class="row">
                     <div class="col-md-4">
                        <div class="form-group {{ $errors->has('category_id') ? 'has-error' : '' }}">

      </div>
                           {{ Form::label('category_id', 'Category') }}
                           {{ Form::select('category_id', $categories,'', ['class' => 'form-control']) }}
                           @if($errors->has('category_id'))
                           <p class="help-block">{{ $errors->first('category_id') }}</p>
                           @endif
                        </div>
                     </div>

                     <div class="col-md-8">
                        <div class="form-group {{ $errors->has('product_id') ? 'has-error' : '' }}">
                           {{ Form::label('product_id', 'Product') }}
                           {{ Form::select('product_id', [], '', ['class' => 'form-control']) }}
                           @if($errors->has('product_id'))
                           <p class="help-block">{{ $errors->first('product_id') }}</p>
                           @endif
                        </div>
                     </div>
                  </div>

                  <div class="row">
                    <div class="col-md-4">
                        <div id="quantity" class="form-group {{ $errors->has('quantity') ? 'has-error' : '' }}">
                           {{ Form::label('quantity', 'Quantity') }}
                           <div class="input-group">
                              {{ Form::text('quantity', '', ['class' => 'form-control']) }}
                              <span class="input-group-addon">-</span>
                           </div>
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

@section('script')
<script type="text/javascript">
$(function(){
   if($('#category_id').val() != "")
      fetchProducts($('#category_id').val());

   $('#category_id').on('change', function(){
      fetchProducts($(this).val());
   });

});


function fetchProducts (categoryId) {

   $.ajax({
      url: '{{ route('products.index', ['limit'=>0]) }}',
      type: 'get',
      dataType: 'jsonp',
      data: {categories: categoryId},
      beforeSend: function(){
         $("#product_id").append('<option value="">Fetching products...</option>');
      }
   })
   .done(function(data, xhr, textStatus){
      var html = '<option value="">No Products</option>';
      var options = "";

      var productId = 0;
      $.each(data, function(key, name){
         if(productId == 0)
            productId = key;

         nameArray = name.split(":");

         options += '<option value="' + nameArray[1] + '">' + nameArray[0] + '</option>';
      });
      if(options != "")
         html = options;

      $("#product_id").html(html);

   });
}
</script>
@stop
