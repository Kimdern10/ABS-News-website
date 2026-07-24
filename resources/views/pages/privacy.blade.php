@extends('layouts.app')

@section('title', 'Privacy Policy - ABS News')

@section('content')

<div class="container py-5" style="margin-top: 100px;">

    <h1 class="mb-4">Privacy Policy</h1>

    <p>
        ABS News (Anambra Broadcasting Service) is committed to protecting your privacy.
        This Privacy Policy explains how we collect, use, and safeguard your information
        when you visit our website.
    </p>

    <h3>1. Information We Collect</h3>
    <p>We may collect the following information:</p>
    <ul>
        <li>Name and email address when you register or contact us.</li>
        <li>Information submitted through forms, comments, or feedback.</li>
        <li>Technical information such as IP address, browser type, device information, and pages visited.</li>
        <li>Cookies and analytics data used to improve our services.</li>
    </ul>

    <h3>2. How We Use Your Information</h3>
    <p>Your information may be used to:</p>
    <ul>
        <li>Provide and improve our news services.</li>
        <li>Respond to inquiries and support requests.</li>
        <li>Send important account or website notifications.</li>
        <li>Analyze website traffic and user engagement.</li>
        <li>Protect the security and integrity of our platform.</li>
    </ul>

    <h3>3. Cookies</h3>
    <p>
        ABS News may use cookies and similar technologies to enhance user experience,
        remember preferences, and collect analytics data. You may disable cookies
        through your browser settings if you prefer.
    </p>

    <h3>4. Information Sharing</h3>
    <p>
        We do not sell, rent, or trade your personal information to third parties.
        Information may only be shared when required by law, to protect our rights,
        or with trusted service providers assisting in website operations.
    </p>

    <h3>5. Data Security</h3>
    <p>
        We implement reasonable security measures to protect personal information
        from unauthorized access, alteration, disclosure, or destruction.
    </p>

    <h3>6. Third-Party Services</h3>
    <p>
        Our website may use third-party services such as analytics tools, advertising
        networks, social media integrations, and external links. These services may
        collect information according to their own privacy policies.
    </p>

    <h3>7. User Rights</h3>
    <p>
        You may request access to, correction of, or deletion of your personal information,
        subject to applicable legal requirements.
    </p>

    <h3>8. Children's Privacy</h3>
    <p>
        ABS News does not knowingly collect personal information from children under
        the age required by applicable laws without parental consent.
    </p>

    <h3>9. Changes to This Policy</h3>
    <p>
        We may update this Privacy Policy from time to time. Any changes will be posted
        on this page with immediate effect.
    </p>

    <h3>10. Contact Us</h3>
    <p>
        If you have questions about this Privacy Policy, please
        <a href="{{ route('contactus') }}">contact us</a>.
    </p>

</div>

@endsection