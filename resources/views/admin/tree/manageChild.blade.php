<ul>

    @foreach($childs as $index => $child)
    <li>

        {{-- <h1>{{ count($child->childs)  }}</h1> --}}
        <h1>{{ $index+1 }}</h1>
        <h1>{{ $child->parent_id }}/{{ $child->id }}</h1>
        
        <img style="width:40px;" src="{{ asset('/admin_assets/uploads/adminlogin/'.$child['image']) }}" alt="Image here" class="cate-image"><br>
        {{ $child->name }}<br>(<small style="color: red;">{{ $child->type }})</small><br>(<small style="color: black;">
            MemberId-{{ $child->member_id }}</small>)<br>(<small style="color: red;">Referral By {{ $child->sponsor_id }}</small>)

        @if(count($child->childs))
        @include('admin.tree.manageChild',['childs' => $child->childs])
        @endif
    </li>
    @endforeach

</ul>