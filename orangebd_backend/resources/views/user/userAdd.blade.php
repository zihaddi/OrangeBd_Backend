<!DOCTYPE html>
<html lang="en">

@extends('dashboard')
@section('content')
    <div class="flex justify-center bg-dark">
        <form action="usersAdd" method="post" enctype="multipart/form-data">
            @csrf
            {{-- addding portion --}}

            <div class=" mb-2 ">
              {{-- parent --}}
             <div >
                 {{-- child1 --}}
                 <div class="mt-4 mr-20">
                  <div style="width: 300px" class="form-control mb-3">
                    <label class="input-group">
                      <span style="width: 90px">Name</span>
                      <input  name="name" type="text" placeholder="name" class="input input-bordered" />
                    </label>
                  </div>
                  <div style="width: 300px" class="form-control mb-3">
                    <label class="input-group">
                      <span style="width: 90px">Email</span>
                      <input  name="email" type="text" placeholder="email" class="input input-bordered" />
                    </label>
                  </div>
                  <div style="width: 300px" class="form-control mb-3">
                    <label class="input-group">
                      <span style="width: 90px">Password</span>
                      <input  name="password" type="password" placeholder="password" class="input input-bordered" />
                    </label>
                  </div>
                  
                 
                    
                  
                
                  {{-- child2 --}}
                 <div class="mt-4">
                  <div   class=" mb-3 form-control">
                    <label style="width: 300px" class="input-group" for="inputGroupSelect01">
                      <span>Role</span>
                    <select style="width: 200px;" name='role' class="input input-bordered" id="inputGroupSelect01">
                      <option selected disabled>----- Role -----</option>
                      <option value="0">Admin</option>
                      <option value="1">User</option>
                      <option value="2">Author</option>
                    </select>
                  </label>
                  </div>
                  
                

            
                <div class="flex justify-between">
                    <input type="submit" class="btn btn-outline btn-primary btn-sm mt-4" value="Add User">

                    <button onclick="window.location.href='{{ route('users') }}'" type="button"
                        class='btn btn-error btn-outline btn-sm mt-4'>Back</button>
                </div>
                 </div>
             </div>
                
            
        </form>
    </div>


    {{-- javascript --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#country-dd').on('change', function() {
                var idCountry = this.value;
                $("#city-dd").html('');
                $.ajax({
                    url: "{{ url('api/fetch-cities') }}",
                    type: "POST",
                    data: {
                        coid: idCountry,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(result) {
                        console.log(result)
                        $('#city-dd').html('<option value="">----- City -----</option>');
                        $.each(result, function(key, value) {
                            $("#city-dd").append('<option value="' + value
                                .id + '">' + value.name + '</option>');
                        });

                    }
                });
            });
            $('#city-dd').on('change', function () {
                var idCity = this.value;
                $("#place-dd").html('');
                $.ajax({
                    url: "{{url('api/fetch-places')}}",
                    type: "POST",
                    data: {
                        ctid: idCity,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (res) {
                        $('#place-dd').html('<option value="">----- Thana ------</option>');
                        $.each(res, function (key, value) {
                            $("#place-dd").append('<option value="' + value
                                .id + '">' + value.name + '</option>');
                        });
                    }
                });
            });
        });
    </script>
@endsection
