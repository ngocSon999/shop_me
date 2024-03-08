<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>SHOP TAI KHOAN GAME</title>
</head>
<body>
<div class="" style="height: 100vh">
    <div class="modal-dialog">
        <div class="modal-content" style="margin-top: 50%">
            <div class="modal-body">
                <div class="row">
                    <h4 class="d-block text-center w-100" style="color: #0c84ff">ĐĂNG NHẬP</h4>
                </div>
                <div class="row">
                    <form class="mt-4 col-12" action="{{ route('admin.user.post-login') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Email</label>
                            <input type="email" class="form-control" name="email">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Password</label>
                            <input type="password" class="form-control" name="password" >
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" name="remember" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">Lưu tài khoản</label>
                        </div>
                        <div class="d-flex justify-content-center"><button type="submit" class="btn btn-primary">Login</button></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
