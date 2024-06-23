@extends('admin.index')

@section('content')

<div class="row">
    <div class="col-sm-12">
        <table id="example1" class="table table-bordered table-hover dataTable dtr-inline"
            aria-describedby="example1_info">
            <thead>
                <tr>
                    <th> ID</th>
                    <th>Admin ID</th>
                    <th>Member ID</th>
                    <th>Total Amount</th>
                    <th>WithDraw Request Amount</th>
                    <th>Type</th>
                    <th>Action</th>


                </tr>
            </thead>
            <tbody>


                @foreach ($withdrawRequest as $value)
                <tr>
                      <td>{{ $value->id }}</td>
                      <td>{{ $value->admin_name }}</td>
                      <td>{{ $value->member_id }}</td>
                    <td><strong style="color:black;">Rs.{{ $value->total }}</strong></td>
                    <td><strong style="color:red;">Rs.{{ $value->witdrarw_amount }}</strong></td>
                    <td><strong style="color:red;">{{ $value->type }}</strong></td>
                    @if(Auth::guard('admin')->user()->type == 'admin')
                    <td>

                       <a href="{{ url('/') }}/admin/approve_withdraw_amount/{{$value->id}}"  title="Click to edit this row"><span class="badge badge-success"><i class="fa fa-request"></i>WithDrawRequest</span></a>
                      </td>
                      @else
                      <td>

                        <a href="#"  title="Click to edit this row"><span class="badge badge-success "><i class="fa fa-request"></i>WithDrawRequest</span></a>
                       </td>
                       @endif

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
