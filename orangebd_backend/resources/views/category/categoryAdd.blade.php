<!DOCTYPE html>
<html lang="en">

    @extends('dashboard')
    @section('content')
        <div class="flex justify-center bg-dark">
            <form action="categoriesAdd" method="post">
              @csrf
              
                      {{-- addding portion --}}
                      <div class="mr-3">
                        <div class="form-control  max-w-xs">
                          <label class="label">
                              <span class="label-text">Category name :</span>
                          </label>
                          <input type="text" name="name" placeholder="category name" class="input input-bordered "
                              style="width: 300px;" />
                      </div>
                      
                     <div class="flex justify-between">
                        <input type="submit" class="btn btn-outline btn-primary btn-sm mt-4" value="Add Category">
  
                        <button onclick="window.location.href='{{route('categories')}}'" type="button" class='btn btn-error btn-outline btn-sm mt-4' >Back</button>
                     </div>
                     
                    
                </div>
            </form>
        </div>
    @endsection