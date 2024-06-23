<li class="nav-item">

    <a href="{{ url('/') }}/admin/hcms-dashboard" class="nav-link">
        <i class="nav-icon fas fa-tachometer-alt"></i>
        <p>
            Dashboard
        </p>
    </a>
    <a href="{{ url('/') }}/admin/account-healthcard" class="nav-link ">
        <i class="nav-icon far fa-plus-square"></i>
        <p>
            Account Health Card
        </p>
    </a>

    <a href="{{ url('/') }}/admin/hcms-profile" class="nav-link ">
        <i class="nav-icon far fa-plus-square"></i>
        <p>
            Profile
        </p>
    </a>
    <a href="{{url('admin/Health-card-user-invoice')}}" class="nav-link ">
        <i class="nav-icon far fa-plus-square"></i>
        <p>
           HealthCard Invoice
        </p>
    </a>
</li>

    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="nav-icon fas fa-tree"></i>
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
            <li class="nav-item">
                <a href="{{url('admin/Withdraw-charges')}}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Withdraw Charges</p>
                </a>
            </li>
        </ul>
    </li>
    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="nav-icon fas fa-tree"></i>
            <p>
               Health Card Section
                <i class="fas fa-angle-left right"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="{{url('admin/create-health-card')}}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Create Health Card</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{url('admin/inactive-healthcard')}}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Inactive Health Card User</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{url('admin/health-wallet-Transection-History')}}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Health-Wallet-Trans-History</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{url('admin/assign-card-customer-list')}}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Assigned HealthCard list</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{url('admin/health-card-customer-list')}}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Health-Card-Cust list</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{url('admin/tree-structure')}}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Health Card Tree</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{url('admin/Health-card-view')}}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Health Card View</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{url('admin/HealthCard-gift-Offered')}}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p> Gift-Offered</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{url('admin/gift-Offered-List')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <i class="fa fa-gift"></i>
                  <p> Gift-Offered List</p>
                </a>
              </li>
        </ul>
    </li>
    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="nav-icon fas fa-tree"></i>
            <p>
               Hospital Section
                <i class="fas fa-angle-left right"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="{{url('admin/hospital-List')}}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Hospital Details</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{url('admin/hospital-Invoice-Customer-wise')}}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Hospital Invoice</p>
                </a>
            </li>  
            <li class="nav-item">
            <a href="{{url('admin/Online-Appointent-List')}}" class="nav-link ">
                <i class="nav-icon far fa-plus-square"></i>
                <p>
                    Online Hospital Appointent List
                </p>
            </a>
        </li>
            <li class="nav-item">
            <a href="{{url('admin/Appointent-Accepted-List')}}" class="nav-link ">
                <i class="nav-icon far fa-plus-square"></i>
                <p>
                     Appointent Hospital Accepted List
                </p>
            </a>
        </li>
            <li class="nav-item">
            <a href="{{url('admin/Appointent-Rejected-List')}}" class="nav-link ">
                <i class="nav-icon far fa-plus-square"></i>
                <p>
                     Appointent Hospital Rejected List
                </p>
            </a>   
        </li>        
        </ul>
    </li>
    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="nav-icon fas fa-tree"></i>
            <p>
               Clinic Doctor Section
                <i class="fas fa-angle-left right"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="{{url('admin/Doctor-List')}}" class="nav-link ">
                    <i class="nav-icon far fa-plus-square"></i>
                    <p>
                        Clinic Doctor List
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{url('admin/Doc-Online-Appointent-List')}}" class="nav-link ">
                    <i class="nav-icon far fa-plus-square"></i>
                    <p>
                        Online Clinic Doctor Appointent List
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{url('admin/Doc-Appointent-Accepted-List')}}" class="nav-link ">
                    <i class="nav-icon far fa-plus-square"></i>
                    <p>
                        Appointent  Clinic Doctor Accepted List
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{url('admin/Doc-Appointent-Rejected-List')}}" class="nav-link ">
                    <i class="nav-icon far fa-plus-square"></i>
                    <p>
                        Appointent  Clinic Doctor Rejected List
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{url('admin/ClinicDoctor-Invoice-Customer-wise')}}" class="nav-link ">
                    <i class="nav-icon far fa-plus-square"></i>
                    <p>
                        Clinic Doctor Inovice
                    </p>
                </a>
            </li>
        </ul>
    </li>
    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="nav-icon fas fa-tree"></i>
            <p>
               Pathology Section
                <i class="fas fa-angle-left right"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="{{url('admin/Pathology-List')}}" class="nav-link ">
                    <i class="nav-icon far fa-plus-square"></i>
                    <p>
                        Pathology Center List
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{url('admin/Pathology-wise-customer-Invoice')}}" class="nav-link ">
                    <i class="nav-icon far fa-plus-square"></i>
                    <p>
                        Pathology Test Inovice
                    </p>
                </a>
            </li>
        </ul>
    </li>
    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="nav-icon fas fa-tree"></i>
            <p>
               Video Call Section
                <i class="fas fa-angle-left right"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="{{url('admin/Request-VideoCall-Doctor')}}" class="nav-link ">
                    <i class="nav-icon far fa-plus-square"></i>
                    <p>
                        Request Video List
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{url('admin/Video-callApprovel-List')}}" class="nav-link ">
                    <i class="nav-icon far fa-plus-square"></i>
                    <p>
                       Approvel Video List 
                    </p>
                </a>
            </li>
        </ul>
    </li>


