@extends('admin.index')

@section('content')

<div class="row">
    <div class="col-sm-12">
        <table id="example1" class="table table-bordered table-hover dataTable dtr-inline"
            aria-describedby="example1_info">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User Name</th>
                    {{-- <th>User Type</th> --}}
                    <th>Request User MemberID</th>
                    <th>W-Req-Amount</th>
                    <th>W-Amount-Wallet</th>
                    <th>Orangial Amount</th>
                    <th>Remaing Amount</th>
                    <th>W-Req-Date</th>
                    <th>W-Appr-Date</th>
                    <th>Transfer- Wallet Date</th>
                    <th>Type</th>



                </tr>
            </thead>
            <tbody>


                @foreach ($withdrawhistroy as $value)
                <tr>
                      <td>{{ $value->id }}</td>
                      <td>{{ $value->admin_name }}</td>
                      {{-- <td>{{ $value->admin_type }}</td> --}}
                      <td>{{ $value->admin_member_id }}</td>

                    <td><strong style="color:black;">Rs.{{ $value->withdraw_request_amount }}</strong></td>
                    <td><strong style="color:black;">Rs.{{ $value->witdrarw_amount_dummywallet }}</strong></td>
                    <td><strong style="color:red;">Rs.{{ $value->orangial_amount }}</strong></td>
                    <td><strong style="color:orange;">Rs.{{ $value->remaing_amount }}</strong></td>
                    <td><strong style="color:black;">{{ $value->withdraw_request_date }}</strong></td>
                    <td><strong style="color:black;">{{ $value->withdraw_approvel_date }}</strong></td>
                    <td><strong style="color:black;">{{ $value->witdrarw_amount_dummywallet_date}}</strong></td>
                    <td><strong style="color:red;">{{ $value->type }}</strong></td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
