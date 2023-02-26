<!DOCTYPE html>
<html lang="en">

    @extends('dashboard')
    @section('content')
     <div class="flex ">
      <div class="card w-92 mt-2 glass">
        <div class="card-body">
          <h2 style="font-weight: 900" class="card-title">{{ $post['title'] }}</h2>
          <h4 class='text-red-600'>Author : {{ $post['author_name'] }}</h4>
          <h4 class="text-blue-500">Category : {{ $post['category_name'] }}</h4> 
          <p>Description : {{ $post['description']  }}</p>  
        </div>
      </div>

     </div>
     <div class="flex justify-center mt-3">
      <button onclick="window.location.href='{{ route('posts') }}'" type="button"
                            class='btn btn-error btn-outline btn-sm '>Back</button>
     </div>

    @endsection