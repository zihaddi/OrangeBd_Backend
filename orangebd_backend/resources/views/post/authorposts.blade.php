@extends('dashboard')
@section('content')

    <div class="overflow-x-auto ml-10 ">
        <div class="flex justify-between mb-4">
            @if (Auth::user()->role == '0' || Auth::user()->role == '2')
                <button onclick="window.location.href='{{ route('authorpostAdd') }}'"
                    class="btn btn-outline btn-success btn-sm ">Add
                    Post</button>
            @endif

            <div class="flex">
                <form action="authorpostsFilter" method="post" class="flex">
                    @csrf
                    <div class=" mb-3 form-control">
                        <label style="width: 300px;height:30px" class="input-group" for="inputGroupSelect01">
                            <span>Category</span>
                            <select style="width: 200px;height:30px" name='role' class="input input-bordered"
                                id="inputGroupSelect01">
                                <option class="text-black" style="width: 300px;" selected disabled>Category</option>
                                @if ($categories->count())
                                    @foreach ($categories as $country)
                                        <option class="text-black" value="{{ $country->id }}">{{ $country->name }}</option>
                                    @endForeach
                                @else
                                    No Record Found
                                @endif
                            </select>
                        </label>
                    </div>
                    <div>
                        <button class="btn btn-info btn-xs" type="submit">Filter</button>
                    </div>
                </form>

            </div>
        </div>
        <table class="table table-compact w-full mb-3">
            <!-- head -->
            <thead>
                <tr>

                    <th>Category</th>
                    <th>Title</th>
                    <th>Desciption</th>
                    @if (Auth::user()->role == '0' || Auth::user()->role == '2')
                        <th>Operation</th>
                    @endif

                </tr>
            </thead>
            <tbody>
                <!-- row 1 -->
                @foreach ($posts as $user)
                    <tr>

                        <td>
                            <div>
                                <div class="font-bold">{{ $user->category_name }}</div>
                            </div>
                        </td>
                        <td>
                            <div>
                                <div class="font-bold">{!! Str::words("$user->title", 3, ' ...') !!}</div>
                            </div>
                        </td>
                        {{-- <td>
        <div>
          <div class="font-bold">{{ $user->description }}</div>
        </div>
      </td> --}}
                        <td>
                            <div>
                                <div class="font-bold">{!! Str::words("$user->description", 3, ' ...') !!}</div>
                            </div>
                        </td>
                        <th>

    @if (Auth::user()->role == '0')
    <button onclick="window.location.href='{{ route('postDetails', $user->id) }}'"
                                    class="btn btn-info btn-xs">Details</button>
    </div>
    <button onclick="window.location.href='{{ route('authorpostEdit', $user->id) }}'"
        class="btn btn-secondary btn-xs">Edit</button></div>
    <button onclick="window.location.href='{{ route('postDelete', $user->id) }}'"
        class="btn btn-error btn-xs">Delete</button></div>
   @elseif (Auth::user()->role == '1' )
   @else
    <button onclick="window.location.href='{{ route('authorpostDetails', $user->id) }}'"
        class="btn btn-info btn-xs">Details</button></div>
    <button onclick="window.location.href='{{ route('authorpostEdit', $user->id) }}'"
        class="btn btn-secondary btn-xs">Edit</button></div>
    @endif
    {{-- <button onclick="window.location.href='{{route('postEdit',$user->id)}}'" class='btn btn-secondary btn-xs'>Edit</button></div>
              <button onclick="window.location.href='{{route('postDelete',$user->id)}}'" class='btn btn-error btn-xs'>Delete</button></div> --}}
    </th>

    </tr>
    {{-- onclick="window.location.href='{{route('postDetails',$user->id)}}'"
      onclick="window.location.href='{{route('postEdit',$user->id)}}'"
      onclick="window.location.href='{{route('postDelete',$user->id)}}'" --}}
    {{-- class='btn btn-info btn-xs'
      class='btn btn-secondary btn-xs'
      class='btn btn-error btn-xs' --}}
    @endforeach


    </tbody>

    </table>
   
    </div>
   
@endsection
