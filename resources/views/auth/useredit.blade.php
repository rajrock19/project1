<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>

    </style>
</head>

<body>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Edit User</h4>
        </div>
        <div class="card-body">
          <form class="form-valide" action="{{route('user.update',$user->id)}}" method="Post" enctype="multipart/form-data">
            @csrf
                <div class="row">
                    <div class="col-md-6 col-xl-6 col-xxl-6 mb-3 form-group">
                        <label id="name"> Status<span class="text-danger">*</span></label>
                        <div class="input-group">
                   
                            <select class="form-control" name="status">
                                <option value="" selected disabled>--Select Language--</option>
                                <option value="1"  >Enable</option>
                                <option value="0"  >Disable</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="text-end">
                    <a href="" class="btn btn-danger">Cancel</a>
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
            </form>
        </div>
    </div>
</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('assets/toastr/js/toastr.min.js') }}" type="text/javascript"></script>
</body>
</html>