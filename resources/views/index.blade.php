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
    <title>Document</title>
</head>
<body>
    <div class="container">
        <h1>Laravel-Ajax-Crud-Operation</h1>
        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#exampleModal" id="ModalButton">
            Add new
        </button>
        <button class="btn btn-warning log-out">Logout</button>
    <table class="table">
    <thead class="thead-dark">
        <tr>
        <th scope="col">EMP_ID</th>
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
    // $(document).ready(function()
    // {
    //     $("#updateData").hide();
        
    //     $("#img").on("change", function() {
    //         var file = $(this)[0].files[0];
    //         var reader = new FileReader();

    //         reader.onload = function(e) {
    //             $("#previewImage")
    //                 .attr("src", e.target.result)
    //                 .show();
    //         };

    //         reader.readAsDataURL(file);
    //     });

    //     $("#ModalButton").click(function()
    //     {
    //         $('.tit').text('Add New Record');
    //     })
    //     //***************************** FETCH ALL RECORD ****************** *//
    //     function showData()
    //     {
    //         $.ajax({                            
    //             url:'/showData',
    //             method:'get',
    //             dataType:'json',
    //             success:function(data)
    //             {
    //                 console.log(data);
                    
    //                 if(data.status === 200)
    //                 {
    //                     $.each(data.Data, function(index,item){
    //                         let row = '<tr><th scope="row">' +
    //                                 item.id +
    //                                 '</th><td>' +
    //                                 item.name +
    //                                 '</td><td>' +
    //                                 item.email +
    //                                 '</td><td>' +
    //                                 item.address +
    //                                 '</td><td>' +
    //                                 item.mobile +
    //                                 '</td><td>' +
    //                                 item.city +
    //                                 '</td><td>'+'<button type="button" class="btn btn-primary btn-showID" data-sid="'+item.id+'" data-toggle="modal" data-target="#exampleModalCenter">View</button></td><td>'+
    //                                 '<button class="btn btn-warning btn-edt" data-sid="'+item.id+'" data-toggle="modal" data-target="#exampleModal">Edit</button> <button class="btn btn-danger btn-del" data-sid="'+item.id+'">Delete</button>'+
    //                                 '</td></tr>';
    //                         $('#tbl').append(row);
                            
    //                     });
    //                 }
    //                 else 
    //                 {
    //                     console.log(data.msg);
    //                 }

    //                 if(data.status === 400)
    //                 {
    //                     console.log("error");
    //                 }
    //             },
    //             error:function(e)
    //             {
    //                 console.log(e)
    //             }
                
    //         })
    //     }
    //     showData();
        
        
    //     $.ajaxSetup({                               //<------- PASS CSRF TOKEN ----<<
    //         headers: {
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //         }
    //     });

    //     //*********************** ADD NEW RECORD ************************* *//
    //     $("#AddData").click(function()             
    //     {
    //         $("#updateData").hide();
            
    //         let formData = new FormData();
    //         formData.append('name', $("#name").val());
    //         formData.append('email', $("#email").val());
    //         formData.append('address', $("#address").val());
    //         formData.append('city', $("#city").val());
    //         formData.append('mobile', $("#mobile").val());
    //         formData.append('img', $('#img')[0].files[0]);


    //         $.ajax({
    //             url:'/add',
    //             type:'post',
    //             data: formData,
    //             dataType: 'json',
    //             processData: false, // Don't process the data (already in FormData)
    //             contentType: false,
    //             success:function(data)
    //             {
    //                 console.log(data);
    //                 if(data.status === 200)
    //                 {
    //                     $('[data-dismiss="modal"]').trigger('click');
    //                     swal({
    //                             title: "Good job!",
    //                             text: String(data.msg),
    //                             icon: "success",
    //                         });
    //                     console.log(data.msg)
    //                     $('#tbl').empty();
    //                     showData();
    //                 }

    //                 if(data.status === 400)
    //                 {
    //                     console.log(data.msg)
    //                     swal({
    //                             title: "Error!",
    //                             text: String(data.msg),
    //                             icon: "error",
    //                         });
    //                 }
                    
    //             },
    //             error:function(e)
    //             {
    //                 console.log(e);
    //             }

    //         })
    //     })

    //     //******************** DELETE STUDENT ************** *//
    //     $("tbody").on("click",".btn-del",function()
    //     {
    //         let id = $(this).attr("data-sid");
    //         console.log(id);
    //         mydata = {id:id};

    //         swal({
    //                 title: "Are you sure?",
    //                 text: "Once deleted, you will not be able to recover this imaginary file!",
    //                 icon: "warning",
    //                 buttons: true,
    //                 dangerMode: true,
    //                 })
    //                 .then((willDelete) => {
    //                 if (willDelete) 
    //                 {
    //                     $.ajax({
    //                         url:'/deleteData',
    //                         type:'post',
    //                         data:mydata,
    //                         dataType:'json',
    //                         success:function(data)
    //                         {
    //                             console.log(data);

    //                             if(data.status === 200)
    //                             {
    //                                 swal({
    //                                         title: "Good job!",
    //                                         text: "Data is deleted!",
    //                                         icon: "success",
    //                                     });
    //                                     $('#tbl').empty();
    //                                 showData();
    //                             }

    //                             if(data.status === 400)
    //                             {
    //                                 swal({
    //                                         title: "Error!",
    //                                         text: String(data.msg),
    //                                         icon: "error",
    //                                     });
    //                             }
    //                         },
    //                         error:function(e)
    //                         {
    //                             console.log(e);
    //                         }
    //                     });
    //                 } else {
    //                     swal("Your imaginary file is safe!");
    //                 }
    //             });
    //     });

    //     //******************** EDIT RECORD ****************** *//

    //     $("tbody").on("click",".btn-edt",function()
    //     {
    //         $("#AddData").hide();
    //         $("#updateData").show();
    //         $("#previewImage").hide();
    //         $('.tit').text('Update/Edit Record');
    //         let id = $(this).attr("data-sid");
    //         myData={id:id};

    //         $.ajax({
    //             url:'/editData',
    //             method:'post',
    //             data:myData,
    //             dataType:'json',
    //             success:function(data)
    //             {
    //                 console.log(data);
    //                 if(data.status === 200 && data.Data)
    //                 {
    //                     console.log(data)
    //                    $("#name").val(data.Data['name']);
    //                    $("#address").val(data.Data['address']);
    //                    $("#email").val(data.Data['email']);
    //                    $("#mobile").val(data.Data['mobile']);
    //                    $("#city").val(data.Data['city']);
    //                    $("#id").val(data.Data['id']);
    //                    var imageUrl = data.Data['avatar'];
    //                     if (imageUrl) 
    //                     {
    //                         $("#previewImage").attr("src", '{{ asset("images/") }}/' + imageUrl);
    //                         $("#previewImage").show(); // Show the image
    //                     } 
    //                     else 
    //                     {
    //                         $("#previewImage").attr("src", 'images/sk4.jpg');
    //                         // $("#previewImage").hide(); 
    //                     }

    //                 }
    //             },
    //             error:function(e)
    //             {
    //                 console.log(e);
    //             }
    //         })
    //         $("#frm")[0].reset();
            
    //     });

    //     //********************** UPDATE DATA ******************** *//

    //     $("#updateData").click(function()
    //     {
           
    //         let formData = new FormData();
    //         formData.append('id',$("#id").val());
    //         formData.append('name', $("#name").val());
    //         formData.append('email', $("#email").val());
    //         formData.append('address', $("#address").val());
    //         formData.append('city', $("#city").val());
    //         formData.append('mobile', $("#mobile").val());
    //         formData.append('img', $('#img')[0].files[0]);


    //         $.ajax({
    //             url:'/updateData',
    //             type:'post',
    //             data:formData,
    //             dataType:'json',
    //             processData:false,
    //             contentType:false,
    //             success:function(data)
    //             {
    //                 console.log(data);
    //                 if(data.status === 200)
    //                 {
    //                     $('[data-dismiss="modal"]').trigger('click');
    //                     swal({
    //                             title: "Good job!",
    //                             text: "Data is updated!",
    //                             icon: "success",
    //                         });

    //                     $("#frm")[0].reset();
    //                     console.log(data.msg)
    //                     $('#tbl').empty();
    //                     showData();
    //                 }
    //             },
    //             error:function(e)
    //             {
    //                 console.log(e);
    //             }

    //         })
            
    //     })

    //     //********************** SHOW EMI_ID ************* */

    //     $("tbody").on('click','.btn-showID',function()
    //     {
    //         let id = $(this).attr("data-sid");
    //         console.log(id);
    //         $.ajax({
    //             url:'getDetails',
    //             data:{id:id},
    //             type:'post',
    //             dataType:'json',
    //             success:function(data)
    //             {
    //                 if(data.status === 200)
    //                 {
    //                     console.log(data);
    //                     $("#empID").html(data.Data['id']);
    //                     $("#nameID").html(data.Data['name']);
    //                     $("#addressID").html('#'+data.Data['address']);
    //                     $("#emailID").html(data.Data['email']);
    //                     $("#mobileID").html(data.Data['mobile']);
    //                     $("#cityID").html(data.Data['city']);
                        
    //                     var imageUrl = data.Data['avatar'];
    //                     if (imageUrl) 
    //                     {
    //                         $("#imgID").attr("src", '{{ asset("images/") }}/' + imageUrl);
    //                        // $("#previewImage").show(); // Show the image
    //                     } 
    //                     else 
    //                     {
    //                         $("#imgID").attr("src", 'images/sk4.jpg');
    //                         // $("#previewImage").hide(); 
    //                     }

    //                 }
    //             },
    //             error:function(e)
    //             {
    //                 console.log(e);
    //             }
    //         })
    //     })

        
    // })
</script>