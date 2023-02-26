<!DOCTYPE html>
<html lang="en">

@extends('dashboard')
@section('content')
    <div class="flex justify-center bg-dark">
        <form action="authorpostsAdd" method="post">
            @csrf

            {{-- addding portion --}}
            <div class="mr-3">
               
                
                 <div class="mt-4 mb-3 form-control">
                    <label style="width: 300px;height:30px" class="input-group" for="inputGroupSelect01">
                        <span>Category</span>
                        <select style="width: 200px;height:30px" name='cid' class="input input-bordered"
                            id="inputGroupSelect01">
                            <option class="text-black" style="width: 300px;" selected disabled>--Category--</option>
                            @if ($category->count())
                                @foreach ($category as $country)
                                    <option class="text-black" value="{{ $country->id }}">{{ $country->name }}</option>
                                @endForeach
                            @else
                                No Record Found
                            @endif
                        </select>
                    </label>
                 </div>
                
                <div class="form-control  max-w-xs">
                    <label class="label">
                        <span class="label-text">Title :</span>
                    </label>
                    
                    <input type="text" name="title" placeholder="post title" class="input input-bordered w-full max-w-xs rounded-lg" />
                </div>
                <div class="form-control  max-w-xs">
                    <label class="label">
                        <span class="label-text">Description :</span>
                    </label>
                    <textarea name='description' type="textarea" class="textarea textarea-bordered" id="4"
                    placeholder="description"></textarea>
                </div>
                <div class="flex justify-between">
                    <input type="submit" class="btn btn-outline btn-primary btn-sm mt-4" value="Add Post">
                    <button onclick="window.location.href='{{route('authorposts')}}'" type="button" class='btn btn-error btn-outline btn-sm mt-4' >Back</button>
                </div>
            </div>
        </form>
    </div>
@endsection
