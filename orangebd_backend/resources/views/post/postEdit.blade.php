<!DOCTYPE html>
<html lang="en">

<head>
    @extends('dashboard')
    @section('content')
        <div class="flex justify-center bg-dark">
            <form action="postsEdit" method="post">
                @csrf
                <input name='id' type="hidden" class="form-control" value='{{ $post->id }}'>
                {{-- addding portion --}}
                {{-- parent --}}
                <div class="flex justify-between">
                    {{-- child1 --}}
                    {{-- child2 --}}
                    <div>
                      <div class="form-control  max-w-xs">
                        <label class="label">
                            <span class="label-text">Author :</span>
                        </label>
                        <input type="text" name="author_name" placeholder="author" class="input input-bordered "
                            value='{{ $post->author_name }}' style="width: 300px;" disabled />
                    </div>
                    <div>
                      <div class="form-control  max-w-xs">
                        <label class="label">
                            <span class="label-text">Category :</span>
                        </label>
                        <input type="text" name="category_name" placeholder="category_name" class="input input-bordered "
                            value='{{ $post->category_name }}' style="width: 300px;" disabled/>
                    </div>
                        <div class="form-control  max-w-xs">
                            <label class="label">
                                <span class="label-text">Title :</span>
                            </label>
                            <input type="text" name="title" placeholder="title" class="input input-bordered "
                                value='{{ $post->title }}' style="width: 300px;" />
                        </div>
                        <div class="form-control  max-w-xs">
                            <label class="label">
                                <span class="label-text">Description :</span>
                            </label>
                            <input type="text" name="description" placeholder="description" class="input input-bordered "
                                value='{{ $post->description }}' style="width: 300px;" />
                        </div>
                        <br><br>
                        <div class="flex justify-between">
                          <input type="submit" class="btn btn-outline btn-primary btn-sm" value="Edit Post">
                        <button onclick="window.location.href='{{route('posts')}}'" type="button" class='btn btn-error btn-outline btn-sm' >Back</button>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    @endsection
