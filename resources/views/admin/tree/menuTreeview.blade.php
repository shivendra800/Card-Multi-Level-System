@extends('admin.index')

@section('content')



<div class="col-md-12">
    <h5 class="text-center mb-4 bg-info text-white">Tree List </h5>
    <div class="tree" id="chart-container">
     <ul id="tree" >
        @foreach($admins as $index=> $tree)
           <li>
   
            <h1>{{ $index+1 }}</h1>
            <img style="width:40px;" src="{{ asset('/admin_assets/uploads/adminlogin/'.$tree['image']) }}" alt="Image here"
            class="cate-image"><br>
         {{ $tree->name }}<br>(<small style="color: red;">{{ $tree->type }}</small>)<br>(<small style="color: black;">
            MemberId-{{ $tree->member_id }}</small>)<br>(<small style="color: red;">Referral By {{ $tree->sponsor_id }}</small>)
               @if(count($tree->childs))
                
                   @include('admin.tree.manageChild',['childs' => $tree->childs])
               @endif
           </li>
        @endforeach
       </ul>
 </div>
</div>

@endsection


