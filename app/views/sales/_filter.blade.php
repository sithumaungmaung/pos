<div class="filter">
   {{ Form::open(['url' => route('sales.index'), 'method' => 'get', 'class' => 'form-inline', 'autocomplete' => 'off']) }}

      
      <div class="form-group">
         {{ Form::select('status', ['' => 'All', 'completed' => 'Completed', 'credit' => 'Credit'], Input::get('status', null), ['class' => 'form-control input-sm']) }}
      </div> 

      <div class="form-group">
         {{ Form::text('from', Input::get('from', null), array('class' => 'datepicker-from form-control','placeholder' => 'Select Date From')) }}
      </div>

      <div class="form-group">
         {{ Form::text('to', Input::get('to', null), array('class' => 'datepicker-to form-control','placeholder' => 'Select Date To')) }}
      </div>

      <div class="form-group">
         {{ Form::button('Search', ['class' => 'btn btn-sm btn-info', 'type' => 'submit']) }}
      </div>

   {{ Form::close() }}
   <hr>
</div>
