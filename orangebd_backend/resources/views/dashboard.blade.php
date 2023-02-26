<x-app-layout>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-whiteoverflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="container">
                        <div class="flex ">
                            {{-- right navigation --}}
                            <div class="border-r-2 rounded p-2 text-bg-light mt-4 mx-2"
                                style="width: 220px; height:450px">
                                @if (Auth::user()->role  == '0')
                                <a href=#
                                class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                                <span class="text-2xl text-red-600">Admin Panel</span>
                                </a>
                                @elseif(Auth::user()->role  == '1')
                                <a href=#
                                class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                                <span class="text-2xl text-red-600">Customer Portal</span>
                                </a>
                                @else
                                <a href=#
                                class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                                <span class="text-2xl text-red-600">Author Portal</span>
                                </a>
                                @endif
                                <hr>
                                <ul class="nav nav-pills flex-column mb-auto">
                                    <li class="nav-item">
                                       
                                        @if (Auth::user()->role  == '0')
                                        <a href="{{ route('users') }}" class="btn btn-ghost btn-sm ml-2 mt-3" aria-current="page"> 
                                            <p class=" mb-1" style="font-size: 12px">> Users</p> 
                                         </a>
                                        @endif<br>
                                        @if (Auth::user()->role  == '0')
                                        <a href="{{ route('categories') }}" class="btn btn-ghost btn-sm ml-2 mt-3" aria-current="page"> 
                                            <p class=" mb-1" style="font-size: 12px">> Categories</p> 
                                         </a>
                                         @endif<br>
                                         
                                         <a href="{{ route('posts') }}"class="btn btn-ghost btn-sm ml-2 mt-3" aria-current="page"> 
                                            <p class=" mb-1" style="font-size: 12px">> Posts</p> 
                                         </a><br>
                                         @if (Auth::user()->role  == '2')
                                        <a href="{{ route('authorposts') }}" class="btn btn-ghost btn-sm ml-2 mt-3" aria-current="page"> 
                                            <p class=" mb-1" style="font-size: 12px">> My Posts</p> 
                                         </a>
                                        @endif
                                        
                                    </li>
                                </ul>


                            </div>
                            <div class="w-4/5 mt-3">
                                @yield('content')
                            </div>
                        </div>
                    </div>
                </div>


            </div>

        </div>
    </div>
</x-app-layout>
