<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Email Verification - ABS News</title>

<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

body{
    background:#f4f5f7;
    font-family:Arial, Helvetica, sans-serif;
    color:#333333;
}

.wrapper{
    width:100%;
    padding:40px 15px;
}

.email-container{
    max-width:600px;
    margin:auto;
    background:#ffffff;
    border-radius:12px;
    overflow:hidden;
    border:1px solid #ececec;
}

.header{
    text-align:center;
    padding:35px 30px 25px;
    border-bottom:4px solid #e30613;
    background:#ffffff;
}

.header img{
    max-width:180px;
    height:auto;
}

.header h2{
    margin-top:20px;
    font-size:28px;
    color:#111111;
}

.content{
    padding:40px 35px;
    line-height:1.8;
    font-size:16px;
}

.content p{
    margin-bottom:18px;
}

.code-box{
    background:#fff7f7;
    border:2px dashed #e30613;
    border-radius:8px;
    padding:20px;
    margin:30px 0;
    text-align:center;
}

.code{
    font-size:34px;
    font-weight:700;
    letter-spacing:8px;
    color:#e30613;
}

.info-box{
    background:#f8f9fa;
    border-left:4px solid #e30613;
    padding:15px;
    border-radius:6px;
    margin-top:20px;
}

.footer{
    background:#fafafa;
    text-align:center;
    padding:25px;
    font-size:13px;
    color:#777777;
    border-top:1px solid #eeeeee;
}

.footer a{
    color:#e30613;
    text-decoration:none;
}

@media(max-width:600px){

.header{
    padding:30px 20px;
}

.content{
    padding:30px 20px;
}

.code{
    font-size:28px;
    letter-spacing:5px;
}

}
</style>

</head>

<body>

<div class="wrapper">

<div class="email-container">

    <div class="header">

        <a href="{{ url('/') }}">

            <img src="{{ asset('assets/images/ABS.png') }}"
                 alt="ABS News">

        </a>

        <h2>Email Verification</h2>

    </div>

    <div class="content">

        <p>Hello,</p>

        <p>
            Welcome to <strong>ABS News</strong>.
            Thank you for creating your account.
        </p>

        <p>
            Use the verification code below to activate your account.
        </p>

        <div class="code-box">

            <div class="code">
                {{ $otp_code }}
            </div>

        </div>

        <div class="info-box">

            This verification code will expire in
            <strong>{{ $expiresIn ?? '5 minutes' }}</strong>.

        </div>

        <p style="margin-top:30px;">
            If you didn't request this verification, you can safely ignore this email.
        </p>

        <p>
            Thank you for choosing
            <strong>ABS News</strong>.
        </p>

    </div>

    <div class="footer">

        <strong>ABS News</strong><br><br>

        © {{ date('Y') }} ABS News. All rights reserved.<br>

        Stay informed with trusted news, breaking stories and in-depth reporting.

    </div>

</div>

</div>

</body>
</html>

