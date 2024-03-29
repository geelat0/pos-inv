<div class="d-flex" id="wrapper">
    <!-- Sidebar-->
    <div class="border-end" id="sidebar-wrapper">
        <div class="sidebar-heading border-bottom" style="color: #fff; font-weight: bold; letter-spacing: 5px;">
            BITS&BYTES
        </div>
        <div class="list-group list-group-flush">
            <!-- {{-- Check if the user is an admin before displaying these items --}} -->
            @if(Auth::user()->isAdmin())
                <a class="list-group-item list-group-item-action list-group-item-light p-3" href="{{url('admin')}}"><i
                        class="bi bi-bar-chart-line-fill">&nbsp;</i>Dashboard</a>
                <a class="list-group-item list-group-item-action list-group-item-light p-3"
                   href="{{url('admin/monthly')}}"><i class="bi bi-calendar-event-fill">&nbsp;</i>Monthly Sales</a>
                <a class="list-group-item list-group-item-action list-group-item-light p-3"
                   href="{{url('admin/stocks')}}"><i class="bi bi-box">&nbsp;</i>Stocks</a>
                <a class="list-group-item list-group-item-action list-group-item-light p-3"
                   href="{{url('admin/supplier')}}"><i class="bi bi-truck">&nbsp;</i>Supplier</a>
                <a class="list-group-item list-group-item-action list-group-item-light p-3"
                   href="{{url('admin/item-category')}}"><i class="bi bi-list-ol">&nbsp;</i>Item Category</a>
                <a class="list-group-item list-group-item-action list-group-item-light p-3"
                   href="{{url('admin/return')}}"><i class="bi bi-cart-fill">&nbsp;</i>Returned Items</a>
                <a class="list-group-item list-group-item-action list-group-item-light p-3"
                   href="{{ url('admin/user-management') }}"><i class="bi bi-people-fill">&nbsp;</i>System Users</a>
            @endif
            @if(Auth::user()->isManager())
                <a class="list-group-item list-group-item-action list-group-item-light p-3" href="{{url('manager')}}"><i
                        class="bi bi-bar-chart-line-fill">&nbsp;</i>Dashboard</a>
                <a class="list-group-item list-group-item-action list-group-item-light p-3"
                   href="{{url('manager/monthly')}}"><i class="bi bi-calendar-event-fill">&nbsp;</i>Monthly Sales</a>
                <a class="list-group-item list-group-item-action list-group-item-light p-3"
                   href="{{url('manager/stocks')}}"><i class="bi bi-box">&nbsp;</i>Stocks</a>
                <a class="list-group-item list-group-item-action list-group-item-light p-3"
                   href="{{url('manager/supplier')}}"><i class="bi bi-truck">&nbsp;</i>Supplier</a>
                <a class="list-group-item list-group-item-action list-group-item-light p-3"
                   href="{{url('manager/item-category')}}"><i class="bi bi-list-ol">&nbsp;</i>Item Category</a>
                <a class="list-group-item list-group-item-action list-group-item-light p-3"
                   href="{{url('manager/return')}}"><i class="bi bi-cart-fill">&nbsp;</i>Returned Items</a>
                <a class="list-group-item list-group-item-action list-group-item-light p-3"
                   href="{{ url('manager/user-management') }}"><i class="bi bi-people-fill">&nbsp;</i>Employee</a>

            @endif
        </div>
    </div>
    <!-- Page content wrapper-->
    <div id="page-content-wrapper">
