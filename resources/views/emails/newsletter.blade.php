<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>ABS News Newsletter</title>
</head>

<body style="margin:0;padding:0;background:#f4f6f8;font-family:Arial,Helvetica,sans-serif;">

<table width="100%" cellpadding="0" cellspacing="0" border="0" bgcolor="#f4f6f8">
<tr>
<td align="center" style="padding:30px 15px;">

<table width="600" cellpadding="0" cellspacing="0" border="0" style="max-width:600px;background:#ffffff;border-radius:8px;overflow:hidden;">

    <!-- Header -->
    <tr>
        <td align="center" style="background:#0b7bcc;padding:25px;">
            <img src="/assets/image/ABS.png"
                 width="170"
                 alt="ABS">

            <h1 style="margin:20px 0 10px;color:#ffffff;font-size:30px;">
                ABS Newsletter
            </h1>

            <p style="margin:0;color:#eaf6ff;font-size:16px;">
                Stay informed with today's top stories.
            </p>
        </td>
    </tr>

    <!-- Hero -->
    <tr>
        <td style="padding:30px;">

            <h2 style="margin-top:0;color:#222;">
                Hello 
            </h2>

            <p style="color:#666;font-size:16px;line-height:28px;">
                Thank you for subscribing to ABS News.
                Here are the latest headlines and trending stories selected for you.
            </p>

        </td>
    </tr>

    <!-- Latest News -->
    <tr>
        <td style="padding:0 30px;">

            <h2 style="color:#0b7bcc;border-left:5px solid #0b7bcc;padding-left:10px;">
                Latest News
            </h2>

        </td>
    </tr>

    @foreach($latestPosts as $post)

    <tr>
        <td style="padding:20px 30px;border-bottom:1px solid #ececec;">

            @if($post->image1)
            <img src="{{ asset('storage/'.$post->image1) }}"
                 width="100%"
                 style="border-radius:6px;margin-bottom:15px;">
            @endif

            <h3 style="margin:0 0 10px;font-size:22px;color:#222;">
                {{ $post->title }}
            </h3>

            <p style="color:#666;line-height:26px;font-size:15px;">
                {{ \Illuminate\Support\Str::limit(strip_tags($post->content),150) }}
            </p>

            <a href="{{ route('posts.show',$post->slug) }}"
               style="display:inline-block;background:#0b7bcc;color:#ffffff;text-decoration:none;padding:10px 22px;border-radius:4px;margin-top:10px;">
                Read More
            </a>

        </td>
    </tr>

    @endforeach

    <!-- Trending -->
    <tr>
        <td style="padding:30px 30px 0;">

            <h2 style="color:#ff3d3d;border-left:5px solid #ff3d3d;padding-left:10px;">
                Trending News
            </h2>

        </td>
    </tr>

    @foreach($trendingPosts as $post)

    <tr>
        <td style="padding:20px 30px;border-bottom:1px solid #ececec;">

            @if($post->image1)
            <img src="{{ asset('storage/'.$post->image1) }}"
                 width="100%"
                 style="border-radius:6px;margin-bottom:15px;">
            @endif

            <h3 style="margin:0 0 10px;font-size:22px;color:#222;">
                {{ $post->title }}
            </h3>

            <p style="color:#666;line-height:26px;font-size:15px;">
                {{ \Illuminate\Support\Str::limit(strip_tags($post->content),150) }}
            </p>

            <a href="{{ route('posts.show',$post->slug) }}"
               style="display:inline-block;background:#ff3d3d;color:#ffffff;text-decoration:none;padding:10px 22px;border-radius:4px;margin-top:10px;">
                Read More
            </a>

        </td>
    </tr>

    @endforeach

    <!-- Footer -->
    <tr>
        <td align="center" style="padding:35px;background:#f8f8f8;">

            <p style="margin:0 0 10px;color:#555;">
                You're receiving this email because you subscribed to
                <strong>ABS News</strong>.
            </p>

            <p style="margin:10px 0;">
                <a href="{{ route('newsletter.unsubscribe',$subscriber->unsubscribe_token) }}"
                   style="color:#e53935;text-decoration:none;">
                    Unsubscribe
                </a>
            </p>

            <p style="margin-top:20px;color:#999;font-size:13px;">
                © {{ date('Y') }} ABS News. All Rights Reserved.
            </p>

        </td>
    </tr>

</table>

</td>
</tr>
</table>

</body>
</html>