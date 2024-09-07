<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="{{ asset('assets/toastr/css/toastr.min.css') }}">
    <style>
        :root {
            --primary-color: #4CAF50;
            --secondary-color: #ff9800;
            --accent-color: #3f51b5;
            --light-bg: #f4f4f4;
            --dark-bg: #282828;
            --font-color: #333;
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--light-bg);
            color: var(--font-color);
        }
        .header, .footer {
            background-color: var(--dark-bg);
            color: white;
        }
        .card-custom {
            border-left: 5px solid var(--primary-color);
        }
        .btn-custom {
            background-color: var(--secondary-color);
            color: white;
        }
        .btn-accent {
            background-color: var(--accent-color);
            color: white;
        }
        .icon-big {
            font-size: 24px;
        }
        .nav-tabs .nav-link.active {
            background-color: var(--primary-color);
            color: white;
        }
        .tab-content {
            padding: 20px;
            border: 1px solid #ccc;
            border-top: none;
        }
    </style>
</head>

<body>

<div id="dashboardContent">
    @if(auth()->user()->role == "admin")
    <div class="container-fluid">
        <header class="header p-3 mb-2">
            <h1 class="text-center">User Management Dashboard</h1>
        </header>
    
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" data-bs-toggle="tab" href="#overview">Details</a>
            </li>
        </ul>
    
        <div class="tab-content">
           <div id="overview" class="tab-pane fade show active">
        </div>
    
    
    
    
    
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Sr.no</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Created Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- @foreach ($alluser as $data)
                    <tr>
                        <td>{{$loop->index+ 1}}</td>
                        <td>{{$data->name}}</td>
                        <td>{{$data->email}}</td>
                        <td>{{\Carbon\Carbon::parse($data->created_at)->format('d-m-y')}}</td>
                        <td>@if($data->status =="1") <span class="btn btn-success">Enable</span>  @elseif($data->status == "0") <span class="btn btn-danger">Disable</span>  @else <span class="btn btn-info">NA</span>  @endif</td>
                        {{-- <td><a href="{{route('edit.user',$data->id)}}">Edit</a></td> 
                        <td><button type="button" class="btn btn-primary" id="edit" data-toggle="modal" data-target="#exampleModal">
                         Edit
                          </button></td>

        
                    </tr>
                    @endforeach --}}

                    @foreach ($alluser as $data)
    <tr>
        <td>{{$loop->index + 1}}</td>
        <td>{{$data->name}}</td>
        <td>{{$data->email}}</td>
        <td>{{ \Carbon\Carbon::parse($data->created_at)->format('d-m-y') }}</td>
        <td>
            @if ($data->status == "1") 
                <span class="btn btn-success">Enable</span>
            @elseif ($data->status == "0") 
                <span class="btn btn-danger">Disable</span>
            @else 
                <span class="btn btn-info">NA</span>
            @endif
        </td>
        <td>
            <button type="button" class="btn btn-primary edit-btn" 
                    data-toggle="modal" 
                    data-target="#exampleModal"
                    data-user-id="{{ $data->id }}">
                Edit
            </button>
        </td>
    </tr>
@endforeach

                </tbody>
            </table>
        </div>
    
    
    </div>
    

    
    
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Status</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <form class="form-valide" action="{{ route('user.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf 
                            <input type="hidden" id="userId" name="user_id">
                            <input type="hidden" id="token" name="token">

                            <div class="row">
                                <div class="col-md-12 col-xl-12 col-xxl-12 mb-3 form-group">
                                    <label>Status <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <select class="form-control" name="status">
                                            <option value="" selected disabled>--Select status--</option>
                                            <option value="1">Enable</option>
                                            <option value="0">Disable</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" id="save" class="btn btn-primary">Save changes</button>
                                <button type="submit" id="submit" class="btn  d-none">Save changes</button>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    {{-- <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                    <form class="form-valide" action="{{route('user.update')}}" method="Post" enctype="multipart/form-data">
                      @csrf
                          <div class="row">
                              <div class="col-md-12 col-xl-12 col-xxl-12 mb-3 form-group">
                                  <label id="name"> Status<span class="text-danger">*</span></label>
                                  <div class="input-group">
                             
                                      <select class="form-control" name="status">
                                          <option value="" selected disabled>--Select status--</option>
                                          <option value="1" >Enable</option>
                                          <option value="0"  >Disable</option>
                                      </select>
                                  </div>
                              </div>
                          </div>
                     
                   
                  </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save changes</button>
        
            </div>
        </form>
          </div>
        </div>
      </div> --}}
    
    @elseif(auth()->user()->role == "user")
    <header class="header p-3 mb-2">
        <h1 class="text-center">User Dashboard</h1>
    </header>
    
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link active" data-bs-toggle="tab" href="#overview">Details</a>
        </li>
    </ul>
    
    <div class="content container-fluid">
        <div class="card">
            <h6>{{$labels['name']}}:{{ $user->name }}</h6>
            <p>{{$labels['username']}}: {{ $user->email  }}</p>
            <p>{{$labels['language']}}: {{ $user->language  }}</p>
            <p>{{$labels['mobile']}}: {{ $user->mobile }}</p>
            <a href="{{ route('logout') }}">Logout</a>
        </div>
       
    </div>
    
    @else
     NA
    @endif
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('assets/toastr/js/toastr.min.js') }}" type="text/javascript"></script>

<script>

@if(session()->has('error'))
                     toastr.error("", "{{ session()->get('error')}}", {
                                    positionClass: "toast-top-right",timeOut: 5000,
                                    closeButton: !0,debug: !1,newestOnTop: !0,
                                    progressBar: !0,preventDuplicates: !0,onclick: null,
                                    showDuration: "300",hideDuration: "1000",
                                    extendedTimeOut: "1000",showEasing: "swing",
                                    hideEasing: "linear",showMethod: "fadeIn",
                                    hideMethod: "fadeOut",tapToDismiss: !1
                                })
                    @endif
                    @if(session()->has('success'))
                       toastr.success("", "{{ session()->get('success')}}", {
                                    timeOut: 5000,closeButton: !0,
                                    debug: !1,newestOnTop: !0,
                                    progressBar: !0,positionClass: "toast-top-right",
                                    preventDuplicates: !0,onclick: null,
                                    showDuration: "300",hideDuration: "1000",
                                    extendedTimeOut: "1000",showEasing: "swing",
                                    hideEasing: "linear",showMethod: "fadeIn",
                                    hideMethod: "fadeOut",tapToDismiss: !1
                                })
                    @endif


$(document).ready(function() {
    function getQueryParam(param) {
        let urlParams = new URLSearchParams(window.location.search);
        return urlParams.get(param);
    }
    let token = getQueryParam('token');

    // Set the token in the hidden input field
    if (token) {
        $('#token').val(token);
    }
});

$(document).ready(function() {
    $('.edit-btn').on('click', function() {
        var userId = $(this).data('user-id'); // Get user_id from data attribute
        $('#userId').val(userId); // Populate the hidden input in the modal
    });

   $('#save').on('click', function() {
    $('#submit').click();
   });
});


    </script>
    
</body>
</html>
