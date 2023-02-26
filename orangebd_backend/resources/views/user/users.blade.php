@extends('dashboard')
@section('content')

<div class="overflow-x-auto ml-10 ">
  <div class="flex justify-between mb-4">
    <button onclick="window.location.href='{{route('userAdd')}}'" class="btn btn-outline btn-success btn-sm ">Add User</button>
  </div>
  <table class="table table-compact w-full">
    <!-- head -->
    <thead>
      <tr>    
        <th>Name</th>  
        <th>Email</th>
        <th>Role</th>
        <th>Operations</th>
      </tr>
    </thead>
    <tbody>
      <!-- row 1 -->
      @foreach ($users as $user)
     
      <tr>
        
        <td>
          <div>
            <div class="font-bold">{{ $user->name}}</div>
          </div>
        </td>  
     
      <td>
        <div>
          <div class="font-bold">{{ $user->email }}</div>
        </div>
      </td>
      {!! ($user->role == '0')? 
          '<td><p class=" w-50 badge badge-secondary">Admin</p></td>':
          (($user->role == '1')?
          '<td><p class=" w-50 badge badge-primary">User</p></td>':
          (($user->role == '2')?
          '<td><p class=" w-50 badge badge-success">Author</p></td>':
          ''))
          !!}
        <th>
            <button onclick="window.location.href='{{route('userEdit',$user->id)}}'" class='btn btn-secondary btn-xs'>Edit</button></div>

            {{-- <button onclick="window.location.href='{{route('categoryDelete',$product->id)}}'" class='btn btn-error btn-xs'>Delete</button></div> --}}
        </th>
      </tr>
      @endforeach
    </tbody>
    
  </table>
</div>

@endsection