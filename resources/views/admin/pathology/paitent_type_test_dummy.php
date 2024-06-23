@extends('admin.index')
@section('content')

    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header bg-success text-white">Purchase-Order</div>
                            <div class="card-body">
                                <div class="card-title">
                                    <h3 class="text-center title-2">Add Purchase-Order</h3>
                                </div>
                                <hr>
                                <form action="{{ url('Add-Purchase-Order') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="input-fields product_data">
                                        <div class="row">
                                            <div class="form-group col-md-4">
                                                <label class="control-label mb-1" for="name">Select Product</label>
                                                <select class="form-select form-control @error('name') is-invalid @enderror  " name="name[]" id="testtypeid" >
                                                   <option value="">Select</option>
                                                    @foreach($pathtestype as $item)
                                                        @if (old('name') == $item->id)
                                                            <option value="{{ $item->id }}" selected>{{$item->name}}</option>
                                                        @else
                                                            <option value="{{ $item->id }}">{{$item->name}}</option>
                                                        @endif
                                                    @endforeach
                                                  
                                                </select>
                                                @error('name')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                               @enderror
                                            </div>    
                                        </div>
                                        <div class="row">
                                         
                                            <div class="form-group col-md-4">
                                                <label class="control-label mb-1" for="test_charge">test_charge</label>
                                                <input type="number"  value="{{old('test_charge')}}" class="form-control  @error('test_charge') is-invalid @enderror test_charge" name="test_charge[]" onkeyup="CalculateTotal(this)" id="test_charge">
                                                @error('name')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                               @enderror
                                            </div>    
                                    </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group">
                                            <button id="add-more-field" class="btn btn-secondary btn-sm">add more</button>
                                        </div>
                                    </div>

                                    <div class="row">
                                         
                                        
                                        <div class="col-md-4">
                                               <div class="form-group">
                                            Total Billing Amount: <input type="text" value=""
                                             id="t_billing_amount" name="total_billing" class="form-control" placeholder="Total Billing Amount *"    readonly="">  
                                             <span id="amount_span" class="text-danger font-weight-bold"></span>
                                            </div>
                                            </div>
                                    </div>
                                     
                                   


                                      

                                    <div class="text-center">
                                        <button type="submit" class="btn  btn-info "> Submit </button>
                                        <button type="submit" class="btn  btn-secondary "> Back </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')

<script>

    
$( document ).ready(function() {
    // Add More buuton work ----jquery here
    $(function(){
    var max_fields = 10;
    var x = 1;
    var more_fields = `
                                       
                                          <hr>
                                         <div class="row One-div product_data">
                                            
                                           <div class="form-group col-md-3">
                                                <label class="control-label mb-1" for="name">Select Product</label>
                                                <select class="form-select form-control @error('name') is-invalid @enderror  " name="name[]" id="testtypeid">
                                                   <option value="">Select</option>
                                                    @foreach($pathtestype as $item)
                                                        @if (old('name') == $item->id)
                                                            <option value="{{ $item->id }}" selected>{{$item->name}}</option>
                                                        @else
                                                            <option value="{{ $item->id }}">{{$item->name}}</option>
                                                        @endif
                                                    @endforeach
                                                  
                                                </select>
                                                @error('name')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                               @enderror
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label class="control-label mb-1" for="test_charge">test_charge</label>
                                                <input type="number" id="test_charge" value="{{old('test_charge')}}" class="form-control test_charge @error('test_charge') is-invalid @enderror" name="test_charge[]" onkeyup="CalculateTotal(this)" >
                                                @error('qty')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                               @enderror
                                            </div>
                                        
                                            <a href="#" class="delete">Delete</a>
                                        </div>
                                       
                                           
                     
                `;
    //  add more button --
    $('#add-more-field').on('click', (function (e) {
         
        e.preventDefault();
        if (x < max_fields) {
            x++;
        $(".input-fields").append(more_fields);
        }
        else {
            alert('You Reached the limits')
        }
    }));
    // delete button--
    $(".input-fields").on("click", ".delete", function(e) {
        e.preventDefault();
        $(this).parent('.One-div').remove();
        x--;
        CalculateTotal();
        paymentUpdate();
    })

  });//add more button function end -----------------------

  //venor wise previou balance get -----
  $("#testtypeid").on("change",function(){
     var testtypeid =   this.options[this.selectedIndex].value;
     alert('kj');
      
      $.ajax({
       
       url: "{{ url('/') }}/admin/testtype_wise_amount/" + testtypeid,
       dataType: "json",
        cache:false,
        success: function(data){  
            console.log(data);
        console.log(data.data.test_charge);
        var test_charge = document.getElementById("test_charge").value = data.data.test_charge;
         }
      });
    });

   
     

  
});//document. ready function end 
// calculate one div class->product_data toatal amount 
function CalculateTotal(ele) {
        var rate = $(ele).closest('.product_data').find('.rate').val();
        var quantity = $(ele).closest('.product_data').find('.quantity').val();
        var expense = $(ele).closest('.product_data').find('.expense').val();
        rate = rate == '' ? 0 : rate;
        quantity = quantity == '' ? 0 : quantity;
        expense = expense == '' ? 0 : expense;
        if (!isNaN(rate) && !isNaN(quantity)) {
            // calculate all three data 
            var total = parseFloat(rate) * parseFloat(quantity) +parseFloat(expense) ;
            // set data in toatal price
            $(ele).closest('.product_data').find('.total_price').val(total.toFixed(2));
        }
        Calculate()// here for auto set total billing amount 
}//end here calculate one div class->product _data total amount 

function Calculate() {
    var totalbilling = 0;
     $(".total_price").each(function () {
      //add only if the value is number
        if (!isNaN(this.value) && this.value.length != 0) {
            totalbilling += parseFloat(this.value);
          
        }       
        var sub_total_billing = document.getElementById("t_billing_amount").value=totalbilling;
        // find total balance
        var previous_balance = document.getElementById('previous_balance').value;
        var grand_total_balance = parseInt(sub_total_billing) + parseInt(previous_balance);
    
       document.getElementById('grand_total').value=grand_total_balance;
        
    });
}// end total balance

// remaining balance on click pay now input
function paymentUpdate()
{
    var u = document.getElementById('grand_total').value; 
    var v = document.getElementById('paid_amount').value;
    var w = parseInt(u) - parseInt(v);
    document.getElementById('remaining_amount').value  = w; 
    
}
   
</script>
    
@endsection
