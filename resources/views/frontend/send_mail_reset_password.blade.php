<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đặt lại mật khẩu</title>
</head>
<body>
<h1>Xin chào {{ $customer->name }},</h1>
<p>Bạn đã yêu cầu đặt lại mật khẩu. Vui lòng nhấn vào nút dưới đây để đặt lại mật khẩu của bạn:</p>
<a href="{{ $url }}" style="background-color: #007bff; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;">Đặt lại mật khẩu</a>
<p>Nếu bạn không yêu cầu đặt lại mật khẩu, hãy bỏ qua email này.</p>
<p>Trân trọng,<br>Đội ngũ hỗ trợ</p>
</body>
</html>
