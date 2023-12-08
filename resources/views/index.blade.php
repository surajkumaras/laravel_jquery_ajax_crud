<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"  crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"  crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"  crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"  crossorigin="anonymous"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        {{-- jquery datatable --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />
    
    <title>Document</title>
</head>
<body>
    <div class="container">
        <h1>Laravel-Ajax-Crud-Operation</h1>
        <button type="button" class="btn btn-info add-new" data-toggle="modal" data-target="#exampleModal" id="ModalButton">
            Add new
        </button>
        <button class="btn btn-warning log-out">Logout</button>
    <table class="table">
    <thead class="thead-dark">
        <tr>
        <th scope="col">EMP_ID</th>
        <th scope="col">Photo</th>
        <th scope="col">Name</th>
        <th scope="col">Email</th>
        <th scope="col">Address</th>
        <th scope="col">Phone</th>
        <th scope="col">City</th>
        <th scope="col">View ID</th>
        <th scope="col">Action</th>

        </tr>
    </thead>
    <tbody id="tbl">
        <!--  Display Dynamic Data here  -->
    </tbody>
    </table>

    <!-- Employee ID Card --Modal-->
            <!-- Modal -->
            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-footer d-flex justify-content-center">
                          <p class="text-center" style="color: green;font-weight: bold;">CODE BREW LABS,SECTOR-28B,CHANDIGARH</p>
                      </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table>
                        <tr>
                            <td rowspan="5">
                                <img src="" id="imgID" width="100px" height="120px" style="border-radius: 10px;">
                            </td>
                        </tr>
                        <tr >
                            <td id="spac">  EMP_No.</td>
                            <td><b><div id="empID"></div></b></td>
                        </tr>
                        <tr >
                            
                            <td><b><div id="imgID"></div></b></td>
                        </tr>
                        <tr>
                            <td id="spac">  Name</td>
                            <td><b><div id="nameID"></div></b></td>
                        </tr>
                        <tr>
                            <td id="spac">  Email</td>
                            <td><b><div id="emailID"></div></b></td>
                        </tr>
                        <tr>
                            <td id="spac">  Mobile</td>
                            <td><b><div id="mobileID"></div></b></td>
                        </tr>
                        <tr>
                            <td id="spac">  Address</td>
                            <td><b><div id="addressID"></div></b></td>
                        </tr>
                        <tr>
                            <td id="spac">  City</td>
                            <td><b><div id="cityID"></div></b></td>
                        </tr>
                    </table>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
                </div>
            </div>
            </div>

    <!-- End ID Modal -->
    <!--new modal  -->
    
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title tit" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <div class="modal-body">
            <!-- form  -->
            <form id="frm" enctype="multipart/form-data">
                @csrf
                <img id="previewImage" src="" alt="Preview Image" style="display: none;">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <input type="hidden" name="id" id="id">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" placeholder="Enter Name">
                    </div>
                    <div class="form-group col-md-6">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" placeholder="Enter Email">
                    </div>
                </div>
                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" class="form-control" id="address" placeholder="Enter Address">
                </div>
                <div class="form-group">
                    <label for="mobile">Phone No.</label>
                    <input type="text" class="form-control" id="mobile" placeholder="Enter Mobile no">
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="city">City</label>
                        <input type="text" class="form-control" id="city" placeholder="Enter City">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="img">Profile Image</label>
                        <input type="file" class="form-control" name="img" id="img" />
                    </div>
                </div>
            
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="AddData">Add</button>
            <button type="button" class="btn btn-primary" id="updateData">Update</button>
        </div>
        </div>
        </form>
    </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" crossorigin="anonymous"></script>

<script src="{{ asset('js/ajax.js') }}" ></script>
<script src="//cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
</body>
</html>
<style>
    #previewImage {
    height: 80px;
    width: 80px;
    border-radius: 5px;
    border: solid 1px;
    
}
</style>
    <script>
        $(document).ready(function() 
        {
            // $('#tbl').DataTable();
        });
    </script>
