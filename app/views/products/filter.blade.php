<div class="filter">
   {{ Form::open(['url' => route('products.index'), 'method' => 'get', 'class' => 'form-inline', 'autocomplete' => 'off']) }}
      <div class="form-group">
         {{ Form::select('category', $categories, array_key_exists('category', $input)?$input['category']:'', ['class' => 'form-control input-sm']) }}
      </div>
      <div class="form-group">
         {{ Form::select('unit', $units, array_key_exists('unit', $input)?$input['unit']:'', ['class' => 'form-control input-sm']) }}
      </div>
      <div class="form-group">
         {{ Form::text('name', array_key_exists('name', $input)?$input['name']:'', ['class' => 'form-control input-sm', 'placeholder' => 'Search product name']) }}
      </div>
      <div class="form-group">
         {{ Form::text('barcode', array_key_exists('barcode', $input)?$input['barcode']:'', ['class' => 'form-control input-sm', 'placeholder' => 'Search product barcode']) }}
      </div>
      <div class="form-group">
         {{ Form::text('entry_from', array_key_exists('entry_from', $input)?$input['entry_from']:'', ['class' => 'datepicker-from form-control input-sm', 'placeholder' => 'Entry date From']) }}
      </div>
      <div class="form-group">
         {{ Form::text('entry_to', array_key_exists('entry_to', $input)?$input['entry_to']:'', ['class' => 'datepicker-to form-control input-sm', 'placeholder' => 'Entry date To']) }}
      </div>
      <div class="form-group">
         {{ Form::button('Search', ['class' => 'btn btn-sm btn-info', 'type' => 'submit']) }}
      </div>

   {{ Form::close() }}
   <hr>
</div> 