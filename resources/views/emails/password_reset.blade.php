
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Password Reset - ABS News</title>

<style>
body{
    margin:0;
    padding:0;
    background:#f4f6f9;
    font-family:'Segoe UI',Arial,sans-serif;
}

.wrapper{
    width:100%;
    padding:40px 15px;
    background:#f4f6f9;
}

.email-container{
    max-width:600px;
    margin:auto;
    background:#ffffff;
    border-radius:12px;
    overflow:hidden;
    box-shadow:0 8px 25px rgba(0,0,0,.05);
}

.header{
    background:linear-gradient(135deg,#0b7bcc,#0056b3);
    padding:30px;
    text-align:center;
    color:#ffffff;
}

.header img{
    max-height:60px;
    margin-bottom:15px;
}

.header h2{
    margin:0;
    font-size:24px;
    font-weight:600;
}

.body-content{
    padding:35px 30px;
    color:#444;
    font-size:16px;
    line-height:1.7;
}

.code-box{
    background:#f1f8ff;
    border:2px dashed #0b7bcc;
    padding:18px;
    text-align:center;
    font-size:30px;
    font-weight:bold;
    letter-spacing:6px;
    color:#0b7bcc;
    border-radius:8px;
    margin:25px 0;
}

.note{
    font-size:14px;
    color:#777;
    margin-top:15px;
}

.footer{
    background:#fafafa;
    padding:20px;
    text-align:center;
    font-size:13px;
    color:#888;
}

a{
    color:#0b7bcc;
    text-decoration:none;
}

@media(max-width:600px){
    .body-content{
        padding:25px 20px;
    }

    .code-box{
        font-size:24px;
        letter-spacing:4px;
    }
}
</style>

</head>

<body>

<div class="wrapper">

<div class="email-container">

    <!-- HEADER -->
    <div class="header">

        <a href="{{ url('/') }}" style="text-decoration:none;">

            <table role="presentation"
                   width="100%"
                   cellspacing="0"
                   cellpadding="0"
                   border="0">

                <tr>
                    <td align="center">

                        <img src="{{ asset('assets/images/ABS.png') }}"
                             alt="ABS News Logo"
                             width="160"
                             height="80"
                             style="display:block;
                                    border:0;
                                    outline:none;
                                    text-decoration:none;
                                    object-fit:contain;
                                    margin:0 auto 15px;">

                    </td>
                </tr>

            </table>

        </a>

        <h2>Password Reset</h2>

    </div>

    <!-- BODY -->
    <div class="body-content">

        <p>
            Hello{{ isset($name) ? ' '.e($name) : '' }} ,
        </p>

        <p>
            We received a request to reset the password for your
            <strong>ABS News</strong> account.
        </p>

        <p>
            Please use the secure verification code below to continue:
        </p>

        <div class="code-box">
            {{ $code ?? $body ?? '------' }}
        </div>

        <p>
            This code will expire in
            <strong>{{ $expiresIn ?? '5 minutes' }}</strong>.
        </p>

        <p class="note">
            Never share this code with anyone. ABS News staff will never ask for your verification code.
        </p>

        <p class="note">
            If you did not request a password reset, simply ignore this email. Your account will remain secure.
        </p>

        <p>
            Thank you for choosing <strong>ABS News</strong>.
        </p>

    </div>

    <!-- FOOTER -->
    <div class="footer">

        © {{ date('Y') }} <strong>ABS News</strong>. All rights reserved.<br>

        This email was sent because a password reset was requested for your account.

    </div>

</div>

</div>

</body>
</html>

