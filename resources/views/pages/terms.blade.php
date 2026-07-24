@extends('layouts.app')

@section('title', 'Terms & Conditions - ABS News')

@section('content')
<!-- Terms & Conditions page -->

<div class="container py-5" style="margin-top: 100px;">

    <h1 class="mb-4">Terms & Conditions</h1>

    <p>
        Welcome to <strong>ABS News (Anambra Broadcasting Service)</strong>.
        By accessing and using this website, you agree to comply with and be bound by the following Terms & Conditions.
        Please read them carefully before using our services.
    </p>

    <h3>1. Acceptance of Terms</h3>
    <p>
        By accessing ABS News, you acknowledge that you have read, understood,
        and agreed to these Terms & Conditions. If you do not agree, please discontinue use of the website.
    </p>

    <h3>2. Use of the Website</h3>
    <p>
        Users are expected to use this website responsibly and lawfully. You agree not to:
    </p>
    <ul>
        <li>Publish or transmit false, misleading, defamatory, or unlawful content.</li>
        <li>Attempt to gain unauthorized access to any part of the website or its systems.</li>
        <li>Disrupt the operation, security, or functionality of the website.</li>
        <li>Use the website for fraudulent, harmful, or illegal activities.</li>
    </ul>

    <h3>3. News and Information Disclaimer</h3>
    <p>
        ABS News strives to provide accurate, timely, and reliable news and information.
        However, we do not guarantee the completeness, accuracy, or reliability of all published content.
        Information provided on this website is for informational purposes only.
    </p>

    <h3>4. User Accounts</h3>
    <p>
        Where account registration is available, users are responsible for maintaining the confidentiality
        of their account credentials and for all activities conducted under their accounts.
    </p>

    <h3>5. Intellectual Property Rights</h3>
    <p>
        All content published on ABS News, including articles, videos, images, logos,
        graphics, audio recordings, and other materials, is the property of
        Anambra Broadcasting Service or its content providers and is protected by applicable copyright laws.
    </p>

    <h3>6. User-Generated Content</h3>
    <p>
        Users may submit comments, opinions, or other content where permitted.
        ABS News reserves the right to review, edit, or remove any content that is unlawful,
        offensive, defamatory, misleading, or otherwise violates these Terms.
    </p>

    <h3>7. Third-Party Links</h3>
    <p>
        This website may contain links to external websites for additional information.
        ABS News is not responsible for the content, policies, or practices of third-party websites.
    </p>

    <h3>8. Limitation of Liability</h3>
    <p>
        ABS News shall not be liable for any direct, indirect, incidental, consequential,
        or special damages arising from the use of, or inability to use, this website or its content.
    </p>

    <h3>9. Privacy Policy</h3>
    <p>
        Your use of this website is also governed by our
        <a href="{{ route('privacy') }}">Privacy Policy</a>,
        which explains how we collect, store, and protect your personal information.
    </p>

    <h3>10. Modifications to Terms</h3>
    <p>
        ABS News reserves the right to amend these Terms & Conditions at any time.
        Any changes will be posted on this page, and continued use of the website constitutes acceptance of the revised terms.
    </p>

    <h3>11. Governing Law</h3>
    <p>
        These Terms & Conditions shall be governed and interpreted in accordance with the laws
        of the Federal Republic of Nigeria.
    </p>

    <h3>12. Contact Us</h3>
    <p>
        If you have any questions regarding these Terms & Conditions,
        please <a href="{{ route('contactus') }}">contact us</a>.
    </p>

</div>
@endsection