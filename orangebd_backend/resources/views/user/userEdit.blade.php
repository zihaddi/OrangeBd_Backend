<!DOCTYPE html>
<html lang="en">

<head>
    @extends('dashboard')
    @section('content')
        <div class="flex justify-center bg-dark">
            <form action="usersEdit" method="post">
                @csrf
                
                <div >
                  <input name='id' type="hidden" class="form-control"   value='{{ $user->id }}' >
                    {{-- addding portion --}}
                    <div class="mr-3 mt-5">
                    <div class=" mb-2 ">
                      <div class="form-control  max-w-xs">
                          <label class="label">
                              <span class="label-text">Name :</span>
                          </label>
                          <input type="text" name="name" placeholder="name" class="input input-bordered "
                              value='{{ $user->name }}' style="width: 300px;height: 30px;" />
                      </div>
                  </div>
                  <div class=" mb-2 ">
                    <div class="form-control  max-w-xs">
                        <label class="label">
                            <span class="label-text">Email :</span>
                        </label>
                        <input type="text" name="email" placeholder="price" class="input input-bordered "
                            value='{{ $user->email }}' style="width: 300px;height: 30px;" />
                    </div>
                </div>
                {{-- <div class=" mb-2 ">
                  <div class="form-control  max-w-xs">
                      <label class="label">
                          <span class="label-text">Role :</span>
                      </label>
                      <input type="text" name="role" placeholder="role" class="input input-bordered "
                          value='{{ $user->role }}' style="width: 300px;height: 30px;" disabled/>
                  </div>
              </div> --}}
                   
                    </div>
                    <div style="margin-left:20px ">
                      <br><br>
                    <div class="flex justify-between">
                      <input type="submit" class="btn btn-outline btn-primary btn-sm" value="Edit User">
                      <button onclick="window.location.href='{{route('users')}}'" type="button" class='btn btn-error btn-outline btn-sm mx-4' >Back</button>
                    </div>
                    </div>
                    
                    
                </div>

        </div>
        </form>
        </div>
    @endsection
