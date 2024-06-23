@extends('admin.index')

@section('content')


  <h5 style="color:brown;"> Total Commission Amount of Hello India Life Care- <strong style="color:red;">Rs.{{$hospitlaTotalComm->total_commission_hicl}}</strong> </h5>
<div class="row" >
    <div class="col-md-12">
    <div class="col-sm-12">
        <table id="example2" class="table table-bordered table-hover dataTable dtr-inline"
            aria-describedby="example2_info">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Money Recive By</th>
                    <th>Received Commissions Amount</th>
                    <th>Total Commission Amount</th>
                    <th>Remaning Commission Amount</th>
                    <th>Money Received Date</th>
                    <th>Transection Receipt</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($paymentRecpitOfComm as $HosptHistroy)
                <tr>
                      <td>{{ $HosptHistroy->id }}</td>
                      <td>{{ $HosptHistroy->reciver_name }}</td>
                      <td>{{ $HosptHistroy->amount_recive }}</td>
                      <td>{{ $HosptHistroy->total_amount }}</td>
                      <td>{{ $HosptHistroy->remaing_amount }}</td>

                      <td>{{ date('d-m-Y ',strtotime($HosptHistroy->created_at)); }}</td>
                      <td>
                        <a class="label label-info" href="{{ url('/') }}/admin_assets/uploads/receive_slip/{{ $HosptHistroy->receive_slip}}" target="_blank" download="">Transection Receipt
                        </a>
                      </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
