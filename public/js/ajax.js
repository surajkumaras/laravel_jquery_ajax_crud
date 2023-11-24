$(document).ready(function()
    {
        $("#updateData").hide();
        
        $("#img").on("change", function() {
            var file = $(this)[0].files[0];
            var reader = new FileReader();

            reader.onload = function(e) {
                $("#previewImage")
                    .attr("src", e.target.result)
                    .show();
            };

            reader.readAsDataURL(file);
        });

        $("#ModalButton").click(function()
        {
            $('.tit').text('Add New Record');
        })
        //***************************** FETCH ALL RECORD ****************** *//
        function showData()
        {
            $.ajax({                            
                url:'/showData',
                method:'get',
                dataType:'json',
                success:function(data)
                {
                    console.log(data);
                    
                    if(data.status === 200)
                    {
                        $.each(data.Data, function(index,item){
                            let row = '<tr><th scope="row">' +
                                    item.id +
                                    '</th><td>' +
                                    item.name +
                                    '</td><td>' +
                                    item.email +
                                    '</td><td>' +
                                    item.address +
                                    '</td><td>' +
                                    item.mobile +
                                    '</td><td>' +
                                    item.city +
                                    '</td><td>'+'<button type="button" class="btn btn-primary btn-showID" data-sid="'+item.id+'" data-toggle="modal" data-target="#exampleModalCenter">View</button></td><td>'+
                                    '<button class="btn btn-warning btn-edt" data-sid="'+item.id+'" data-toggle="modal" data-target="#exampleModal">Edit</button> <button class="btn btn-danger btn-del" data-sid="'+item.id+'">Delete</button>'+
                                    '</td></tr>';
                            $('#tbl').append(row);
                            
                        });
                    }
                    else 
                    {
                        console.log(data.msg);
                    }

                    if(data.status === 400)
                    {
                        console.log("error");
                    }
                },
                error:function(e)
                {
                    console.log(e)
                }
                
            })
        }
        showData();
        
        
        $.ajaxSetup({                               //<------- PASS CSRF TOKEN ----<<
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        //*********************** ADD NEW RECORD ************************* *//
        $("#AddData").click(function()             
        {
            $("#updateData").hide();
            
            let formData = new FormData();
            formData.append('name', $("#name").val());
            formData.append('email', $("#email").val());
            formData.append('address', $("#address").val());
            formData.append('city', $("#city").val());
            formData.append('mobile', $("#mobile").val());
            formData.append('img', $('#img')[0].files[0]);


            $.ajax({
                url:'/add',
                type:'post',
                data: formData,
                dataType: 'json',
                processData: false, // Don't process the data (already in FormData)
                contentType: false,
                success:function(data)
                {
                    console.log(data);
                    if(data.status === 200)
                    {
                        $('[data-dismiss="modal"]').trigger('click');
                        swal({
                                title: "Good job!",
                                text: String(data.msg),
                                icon: "success",
                            });
                        console.log(data.msg)
                        $('#tbl').empty();
                        showData();
                    }

                    if(data.status === 400)
                    {
                        console.log(data.msg)
                        swal({
                                title: "Error!",
                                text: String(data.msg),
                                icon: "error",
                            });
                    }
                    
                },
                error:function(e)
                {
                    console.log(e);
                }

            })
        })

        //******************** DELETE STUDENT ************** *//
        $("tbody").on("click",".btn-del",function()
        {
            let id = $(this).attr("data-sid");
            console.log(id);
            mydata = {id:id};

            swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this imaginary file!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                    })
                    .then((willDelete) => {
                    if (willDelete) 
                    {
                        $.ajax({
                            url:'/deleteData',
                            type:'post',
                            data:mydata,
                            dataType:'json',
                            success:function(data)
                            {
                                console.log(data);

                                if(data.status === 200)
                                {
                                    swal({
                                            title: "Good job!",
                                            text: "Data is deleted!",
                                            icon: "success",
                                        });
                                        $('#tbl').empty();
                                    showData();
                                }

                                if(data.status === 400)
                                {
                                    swal({
                                            title: "Error!",
                                            text: String(data.msg),
                                            icon: "error",
                                        });
                                }
                            },
                            error:function(e)
                            {
                                console.log(e);
                            }
                        });
                    } else {
                        swal("Your imaginary file is safe!");
                    }
                });
        });

        //******************** EDIT RECORD ****************** *//

        $("tbody").on("click",".btn-edt",function()
        {
            $("#AddData").hide();
            $("#updateData").show();
            $("#previewImage").hide();
            $('.tit').text('Update/Edit Record');
            let id = $(this).attr("data-sid");
            myData={id:id};

            $.ajax({
                url:'/editData',
                method:'post',
                data:myData,
                dataType:'json',
                success:function(data)
                {
                    console.log(data);
                    if(data.status === 200 && data.Data)
                    {
                        console.log(data)
                       $("#name").val(data.Data['name']);
                       $("#address").val(data.Data['address']);
                       $("#email").val(data.Data['email']);
                       $("#mobile").val(data.Data['mobile']);
                       $("#city").val(data.Data['city']);
                       $("#id").val(data.Data['id']);
                       var imageUrl = data.Data['avatar'];
                        if (imageUrl) 
                        {
                             $("#previewImage").attr("src", 'images/' + imageUrl);
                            //$("#previewImage").attr("src", '/images/' + imageUrl);
                            $("#previewImage").show(); // Show the image
                        } 
                        else 
                        {
                            $("#previewImage").attr("src", 'images/user1.jpeg');
                            // $("#previewImage").hide(); 
                        }

                    }
                },
                error:function(e)
                {
                    console.log(e);
                }
            })
            $("#frm")[0].reset();
            
        });

        //********************** UPDATE DATA ******************** *//

        $("#updateData").click(function()
        {
           
            let formData = new FormData();
            formData.append('id',$("#id").val());
            formData.append('name', $("#name").val());
            formData.append('email', $("#email").val());
            formData.append('address', $("#address").val());
            formData.append('city', $("#city").val());
            formData.append('mobile', $("#mobile").val());
            formData.append('img', $('#img')[0].files[0]);


            $.ajax({
                url:'/updateData',
                type:'post',
                data:formData,
                dataType:'json',
                processData:false,
                contentType:false,
                success:function(data)
                {
                    console.log(data);
                    if(data.status === 200)
                    {
                        $('[data-dismiss="modal"]').trigger('click');
                        swal({
                                title: "Good job!",
                                text: "Data is updated!",
                                icon: "success",
                            });

                        $("#frm")[0].reset();
                        console.log(data.msg)
                        $('#tbl').empty();
                        showData();
                    }
                },
                error:function(e)
                {
                    console.log(e);
                }

            })
            
        })

        //********************** SHOW EMI_ID ************* */

        $("tbody").on('click','.btn-showID',function()
        {
            let id = $(this).attr("data-sid");
            console.log(id);
            $.ajax({
                url:'getDetails',
                data:{id:id},
                type:'post',
                dataType:'json',
                success:function(data)
                {
                    if(data.status === 200)
                    {
                        console.log(data);
                        $("#empID").html(data.Data['id']);
                        $("#nameID").html(data.Data['name']);
                        $("#addressID").html('#'+data.Data['address']);
                        $("#emailID").html(data.Data['email']);
                        $("#mobileID").html(data.Data['mobile']);
                        $("#cityID").html(data.Data['city']);
                        
                        var imageUrl = data.Data['avatar'];
                        if (imageUrl) 
                        {
                            
                            $("#imgID").attr("src", 'images/' + imageUrl);
                             $("#previewImage").show(); // Show the image
                        } 
                        else 
                        {
                            $("#imgID").attr("src", 'images/sk4.jpg');
                            // $("#previewImage").hide(); 
                        }

                    }
                },
                error:function(e)
                {
                    console.log(e);
                }
            })
        })
});