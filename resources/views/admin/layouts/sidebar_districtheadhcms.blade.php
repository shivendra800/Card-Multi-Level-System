<li class="nav-item">
    <a href="{{ url('/') }}/admin/hcms-dashboard" class="nav-link ">
        <i class="nav-icon fas fa-tachometer-alt"></i>
        <p>
            Dashboard
        </p>
    </a>
    <a href="{{ url('/') }}/admin/account-districthead" class="nav-link ">
        <i class="nav-icon far fa-plus-square"></i>
        <p>
            Account District
        </p>
    </a>
    <a href="{{ url('/') }}/admin/hcms-profile" class="nav-link ">
        <i class="nav-icon far fa-plus-square"></i>
        <p>
            Profile
        </p>
    </a>
    <a href="{{ url('/') }}/admin/city-head-hcms" class="nav-link ">
        <i class="nav-icon far fa-plus-square"></i>
        <p>
            City Head
        </p>
    </a>
    <a href="{{url('admin/district-invoice')}}" class="nav-link ">
        <i class="nav-icon far fa-plus-square"></i>
        <p>
           District Invoice
        </p>
    </a>
    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="nav-icon far fa-plus-square"></i>
            <p>
                Gift Section
                <i class="fas fa-angle-left right"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="{{url('admin/HealthCard-gift-Offered')}}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Your Gift </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{url('admin/gift-Offered-List')}}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Company Gift List</p>
                </a>
            </li>
 
        </ul>
    </li>
    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="nav-icon far fa-plus-square"></i>
            <p>
                Health Card Section
                <i class="fas fa-angle-left right"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="{{url('admin/create-health-card')}}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Create Heallth Card</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{url('admin/inactive-healthcard')}}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>InActive HeallthCard User </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{url('admin/health-wallet-Transection-History')}}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Health-Wallet-Trans-Hist</p>
                </a>
            </li>
            <li class="nav-item">
            <a href="{{ url('/') }}/admin/assign-card-customer-list" class="nav-link ">
                <i class="far fa-circle nav-icon"></i>
                <p>
                    Assigned card list
                </p>
            </a>
            </li>
            <li class="nav-item">
            <a href="{{ url('/') }}/admin/health-card-customer-list" class="nav-link ">
                <i class="far fa-circle nav-icon"></i>
                <p>
                    Health-Card-Cust list
                </p>
            </a>
            </li>
            <li class="nav-item">
            <a href="{{url('admin/tree-structure')}}" class="nav-link ">
                <i class="far fa-circle nav-icon"></i>
                <p>
                     Tree Structure
                </p>
            </a>
            </li>
 
        </ul>
    </li>   
    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="nav-icon far fa-plus-square"></i>
            <p>
               WithDraw Section
                <i class="fas fa-angle-left right"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="{{url('admin/withdraw-request')}}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Withdraw Request</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{url('admin/approve_withdraw_amount')}}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Withdraw Approvel</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{url('admin/withdraw-Histroy')}}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Withdraw History</p>
                </a>
            </li>
        </ul>
    </li>

</li>
