@if(isset($position) && $position == 'top')
<div class="hidden-xs" id="topbar_menu">
   <ul class="nav navbar-nav navbar-right">      
      
      <li class="{{ Mypos\Menu::isCurrent('sales.create') }}"><a href="{{ route('sales.create') }}">New Sale</a></li>

      <li class="{{ Mypos\Menu::isCurrent('users.index') }}"><a href="{{ route('users.index') }}">Users</a></li>
     
      <li class="{{ Mypos\Menu::isCurrent('sales.index') }}"><a href="{{ route('sales.index') }}">Sales Report</a></li>

      <li class="{{ Mypos\Menu::isCurrent('stocks.index') }}"><a href="{{ route('stocks.index') }}">Stocks</a></li>


      <li class="{{ Mypos\Menu::isCurrent('products.index') }}"><a href="{{ route('products.index') }}">Products</a></li>

      <li class="{{ Mypos\Menu::isCurrent('categories.index') }}"><a href="{{ route('categories.index') }}">Categories</a></li>

      <li class="{{ Mypos\Menu::isCurrent('units.index') }}"><a href="{{ route('units.index') }}">Units</a></li>  

      <li><a href="{{ route('users.logout') }}">logout</a></li>    

     {{--  @if($logged_user->hasAccess('products.index'))
      <li class="{{ Mypos\Menu::isCurrent('products.index') }}"><a href="{{ route('products.index') }}">Products</a></li>
      @endif

      @if($logged_user->hasAccess('discounts.index'))
      <li class="{{ Mypos\Menu::isCurrent('discounts.index') }}"><a href="{{ route('discounts.index') }}">Discounts</a></li>
      @endif

      @if($logged_user->hasAccess('suppliers.index'))
      <li class="{{ Mypos\Menu::isCurrent('suppliers.index') }}"><a href="{{ route('suppliers.index') }}">Suppliers</a></li>
      @endif

      @if($logged_user->hasAccess('salesoutlets.index'))
      <li class="{{ Mypos\Menu::isCurrent('salesoutlets.index') }}"><a href="{{ route('salesoutlets.index') }}">Outlets</a></li>
      @endif

      @if($logged_user->hasAccess('outletdeposits.index'))
      <li class="{{ Mypos\Menu::isCurrent('outletdeposits.index') }}"><a href="{{ route('outletdeposits.index') }}">Outlet Deposit</a></li>
      @endif

      @if($logged_user->hasAccess('distributions.index'))
      <li class="{{ Mypos\Menu::isCurrent('distributions.index') }}"><a href="{{ route('distributions.index') }}">Distribution</a></li>
      @endif


      <li class="dropdown {{ Mypos\Menu::isCurrent(['customers.index', 'units.index', 'types.index', 'users.index']) }}">
         <a class="dropdown-toggle" data-toggle="dropdown" href="#">System <span class="caret"></span></a>
         <ul class="dropdown-menu">

            @if($logged_user->hasAccess('customers.index'))
            <li class="{{ Mypos\Menu::isCurrent('customers.index') }}"><a href="{{ route('customers.index') }}"><i class="fa fa-arrow-right"></i> Customers</a></li>
            @endif

            @if($logged_user->hasAccess('units.index'))
            <li class="{{ Mypos\Menu::isCurrent('units.index') }}"><a href="{{ route('units.index') }}"><i class="fa fa-arrow-right"></i> Product Unit</a></li>
            @endif

            @if($logged_user->hasAccess('types.index'))
            <li class="{{ Mypos\Menu::isCurrent('types.index') }}"><a href="{{ route('types.index') }}"><i class="fa fa-arrow-right"></i> Product Types</a></li>
            @endif

            @if($logged_user->hasAccess('colors.index'))
            <li class="{{ Mypos\Menu::isCurrent('colors.index') }}"><a href="{{ route('colors.index') }}"><i class="fa fa-arrow-right"></i> Colors</a></li>
            @endif

            @if($logged_user->hasAccess('users.index'))
            <li class="{{ Mypos\Menu::isCurrent('users.index') }}"><a href="{{ route('users.index') }}"><i class="fa fa-arrow-right"></i> Users</a></li>
            @endif

            @if($logged_user->hasAccess('users.revokePermission'))
            <li class="{{ Mypos\Menu::isCurrent('users.revokePermission') }}"><a href="{{ route('users.revokePermission') }}"><i class="fa fa-arrow-right"></i> Revoke Permission</a></li>
            @endif

            <li class="divider"></li>

            <li><a href="{{ route('users.logout') }}"><i class="fi-power"></i> Logout</a></li>
         </ul>
      </li> --}}
   </ul>
</div>
@endif

{{-- @if(isset($position) && $position == 'sidebar')
<div class="visible-xs col-xs-6 sidebar-offcanvas" id="sidebar">
   <div class="list-group">
    @if($logged_user->hasAccess('sales.create'))
      <a href="{{ route('sales.create') }}" class="list-group-item"><i class="fa fa-arrow-right"></i> New Sale</a>
    @endif
    @if($logged_user->hasAccess('stocks.index'))  
      <a href="{{ route('sales.index') }}" class="list-group-item"><i class="fa fa-arrow-right"></i> Sales Report</a>
    @endif
    @if($logged_user->hasAccess('stocks.index'))  
      <a href="{{ route('stocks.index') }}" class="list-group-item"><i class="fa fa-arrow-right"></i> Stocks</a>
    @endif
    @if($logged_user->hasAccess('products.index'))  
      <a href="{{ route('products.index') }}" class="list-group-item"><i class="fa fa-arrow-right"></i> Products</a>
    @endif
    @if($logged_user->hasAccess('discounts.index'))  
      <a href="{{ route('discounts.index') }}" class="list-group-item"><i class="fa fa-arrow-right"></i> Discounts</a>
    @endif
    @if($logged_user->hasAccess('suppliers.index'))  
      <a href="{{ route('suppliers.index') }}" class="list-group-item"><i class="fa fa-arrow-right"></i> Suppliers</a>
    @endif
    @if($logged_user->hasAccess('salesoutlets.index'))  
      <a href="{{ route('salesoutlets.index') }}" class="list-group-item"><i class="fa fa-arrow-right"></i> Outlets</a>
    @endif
    @if($logged_user->hasAccess('outletdeposits.index'))  
      <a href="{{ route('outletdeposits.index') }}" class="list-group-item"><i class="fa fa-arrow-right"></i> Outlet Deposit</a>
    @endif
    @if($logged_user->hasAccess('distributions.index'))  
      <a href="{{ route('distributions.index') }}" class="list-group-item"><i class="fa fa-arrow-right"></i> Distribution</a>
    @endif
    @if($logged_user->hasAccess('customers.index'))  
      <a href="{{ route('customers.index') }}" class="list-group-item"><i class="fa fa-arrow-right"></i> Customers</a>
    @endif
    @if($logged_user->hasAccess('units.index'))  
      <a href="{{ route('units.index') }}" class="list-group-item"><i class="fa fa-arrow-right"></i> Product Units</a>
    @endif
    @if($logged_user->hasAccess('types.index'))  
      <a href="{{ route('types.index') }}" class="list-group-item"><i class="fa fa-arrow-right"></i> Product Types</a>
    @endif
    @if($logged_user->hasAccess('colors.index'))  
      <a href="{{ route('colors.index') }}" class="list-group-item"><i class="fa fa-arrow-right"></i> Colors</a>
    @endif
    @if($logged_user->hasAccess('users.index'))  
      <a href="{{ route('users.index') }}" class="list-group-item"><i class="fa fa-arrow-right"></i> Users</a>
    @endif
    @if($logged_user->hasAccess('vats.index'))  
      <a href="{{ route('vats.index') }}" class="list-group-item"><i class="fa fa-arrow-right"></i> Vat</a>
    @endif
    @if($logged_user->hasAccess('users.revokePermission'))  
      <a href="{{ route('users.revokePermission') }}" class="list-group-item"><i class="fa fa-arrow-right"></i> Revoke Permission</a>
    @endif
      <a href="{{ route('users.logout') }}" class="list-group-item"><i class="fa fa-arrow-right"></i> Logout</a>
  
   </div>
</div>
@endif
 --}}