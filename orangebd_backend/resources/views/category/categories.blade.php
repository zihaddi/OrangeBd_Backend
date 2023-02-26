@extends('dashboard')
@section('content')

<div class="overflow-x-auto ml-20 w-full">
  <div class="flex justify-between mb-4">
    <button onclick="window.location.href='{{route('categoryAdd')}}'" class="btn btn-outline btn-success btn-sm ">Add Category</button>
  </div>
  <table class="table table-compact  w-1/2">
    <!-- head -->
    <thead>
      <tr>  
       
        <th>Category Name</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <!-- row 1 -->
      @foreach ($products as $product)
     
      <tr>

       
       
      <td>
        <div>
          <div class="font-bold">{{ $product->name }}</div>
        </div>
      </td>
 
     
        <th>
       
          {{-- <button class="btn btn-ghost btn-xs"></button> --}}
          
           {{-- <label onclick="func1()"    class="btn">
            {{ $product->id }}</label>              --}}
            <button onclick="window.location.href='{{route('categoryEdit',$product->id)}}'" class='btn btn-secondary btn-xs'>Edit</button></div>

            <button onclick="window.location.href='{{route('categoryDelete',$product->id)}}'" class='btn btn-error btn-xs'>Delete</button></div>
        </th>
      </tr>
  
      @endforeach
 
    
    </tbody>
    
  </table>
</div>

@endsection