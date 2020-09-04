<div class="app-sidebar__user">
    <a href="{{ route('home') }}">
        {{--        @dd($company);--}}
        {{--        <img class="app-sidebar__user-avatar" src="{{ asset($company_common->logo) }}" alt="User Image" height="50" width="50">--}}
        <img class="app-sidebar__user-avatar" src="https://s3.amazonaws.com/uifaces/faces/twitter/jsa/48.jpg" alt="User Image">
    </a>

    <div>
        {{-- <a href="{{ route('home') }}"><p class="app-sidebar__user-name">{{ $company->name }}</p></a> --}}
        <p class="app-sidebar__user-designation">Admin</p>
    </div>
</div>






<ul class="app-menu">
    <li><a class="app-menu__item @yeild('dashboard')" href="{{ url('/home') }}"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Dashboard</span></a></li>

    
    <li class="treeview @yield('supplier')">
        <a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-edit"></i><span
                    class="app-menu__label">Manage Supplier</span><i class="treeview-indicator fa
                    fa-angle-right"></i></a>
        <ul class="treeview-menu">
            <li><a class="treeview-item @yield('manage_supplier')" href="{{ route('supplier.index') }}"><i class="icon fa fa-circle-o"></i>View Supplier</a></li>
        </ul>
    </li>

    <li class="treeview @yield('customer')">
        <a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-edit"></i><span
                    class="app-menu__label">Manage Customer</span><i class="treeview-indicator fa
                    fa-angle-right"></i></a>
        <ul class="treeview-menu">
            <li><a class="treeview-item @yield('manage_customer')" href="{{ route('customer.index') }}"><i class="icon fa fa-circle-o"></i>View Customer</a></li>
        </ul>
    </li>

    <li class="treeview @yield('units')">
        <a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-edit"></i><span
                    class="app-menu__label">Manage Units </span><i class="treeview-indicator fa
                    fa-angle-right"></i></a>
        <ul class="treeview-menu">
            <li><a class="treeview-item @yield('manage_units')" href="{{ route('unit.index') }}"><i class="icon fa fa-circle-o"></i>View Units</a></li>
        </ul>
    </li>

    <li class="treeview @yield('units')">
        <a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-edit"></i><span
                    class="app-menu__label">Manage Category</span><i class="treeview-indicator fa
                    fa-angle-right"></i></a>
        <ul class="treeview-menu">
            <li><a class="treeview-item @yield('manage_category')" href="{{ route('category.index') }}"><i class="icon fa fa-circle-o"></i>View Category</a></li>
        </ul>
    </li>

    <li class="treeview @yield('products')">
        <a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-edit"></i><span
                    class="app-menu__label">Manage Product</span><i class="treeview-indicator fa
                    fa-angle-right"></i></a>
        <ul class="treeview-menu">
            <li><a class="treeview-item @yield('manage_category')" href="{{ route('product.index') }}"><i class="icon fa fa-circle-o"></i>View Product</a></li>
        </ul>
    </li>


    <li class="treeview @yield('purchase')">
        <a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-edit"></i><span
                    class="app-menu__label">Manage Purchase</span><i class="treeview-indicator fa
                    fa-angle-right"></i></a>
        <ul class="treeview-menu">
            <li>
                <a class="treeview-item @yield('manage_purchase')" href="{{ route('purchase.index') }}">
                    <i class="icon fa fa-circle-o"></i>View Purchase
                </a>
            </li>
            <li>
                <a class="treeview-item @yield('manage_purchase')" href="{{ route('purchase.pending') }}">
                    <i class="icon fa fa-circle-o"></i>Approval Purchase
                </a>
            </li>
        </ul>
    </li>

    <li class="treeview @yield('invoice')">
        <a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-edit"></i><span
                    class="app-menu__label">Manage Invoice</span><i class="treeview-indicator fa
                    fa-angle-right"></i></a>
        <ul class="treeview-menu">
            <li>
                <a class="treeview-item @yield('manage_invoice')" href="{{ route('invoice.index') }}">
                    <i class="icon fa fa-circle-o"></i>View Invoice
                </a>
            </li>
            <li>
                <a class="treeview-item @yield('manage_invoice')" href="{{ route('invoice.pending.list') }}">
                    <i class="icon fa fa-circle-o"></i>Approval Invoice
                </a>
            </li>

            <li>
                <a class="treeview-item @yield('invoice.print.list')" href="{{ route('invoice.print.list') }}">
                    <i class="icon fa fa-circle-o"></i>Print Invoice
                </a>
            </li>
        </ul>
    </li>

    
</ul>