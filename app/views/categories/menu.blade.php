<div class="sub-menu pull-right">
   @if( in_array($current_route, ['categories.create', 'categories.edit']) )
   <a href="{{ route('categories.index') }}" class="btn btn-xs btn-success"><i class="fa fa-arrow-left"></i> Back To List</a>
   @endif

   @if( in_array($current_route, ['categories.index', 'categories.edit']) )
   <a href="{{ route('categories.create') }}" class="btn btn-xs btn-success"><i class="fi-page-add"></i> New</a>
   @endif
</div>
