<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"  crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"  crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"  crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"  crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body>
    <div class="container">
        <h1>Login Form</h1>
        <form action="/login" method="post" id="loginfrm">
            @csrf
            <div class="form-group">
              <label for="email">Email address</label>
              <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Enter email">
              
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" class="form-control" id="password" name="password" placeholder="Password">
            </div>
            
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" crossorigin="anonymous"></script>
</body>
</html>

<script>
// $(document).ready(function()
// {
//     $("#loginfrm").on('submit',function(e)
//     {
//         e.preventDefault();

//         let formData = $("#loginfrm").serialize();
//         console.log(formData);

//         $.ajax({
//             url:'/login',
//             method:'post',
//             data:formData,
//             dataType:'json',
//             contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
//             success:function(data)
//             {
//                 console.log(data);

//                 if(data.status === 200)
//                 {
//                     window.location.href="/crud/index";
//                 }
//             },
//             error:function(e)
//             {
//                 console.log(e);
//             }
//         });
//     });
// });
// </script>