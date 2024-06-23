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
                    <th>Total Amount</th>
                    <th>WithDraw Request Amount</th>
                    <th>Type</th>


                </tr>
            </thead>
            <tbody>


                @foreach ($withdrawRequestApprovel as $value)
                <tr>
                      <td>{{ $value->id }}</td>
                      <td>{{ $value->admin_id }}</td>
                    <td><strong style="color:black;">Rs.{{ $value->total }}</strong></td>
                    <td><strong style="color:red;">Rs.{{ $value->witdrarw_amount }}</strong></td>
                    <td><strong style="color:red;">{{ $value->type }}</strong></td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
