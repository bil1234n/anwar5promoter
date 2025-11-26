<html data-wf-page="634ced2e990236397a942c15"
    data-wf-site="633fc9cf3a4f100f9060830b" lang="en"
    class="w-mod-js wf-notosans-n4-active wf-notosans-n5-active wf-notosans-n6-active wf-notosans-n7-active wf-notosans-n8-active wf-nunito-n4-active wf-nunito-n5-active wf-nunito-n6-active wf-nunito-n7-active wf-nunito-n8-active wf-nunito-n9-active wf-active w-mod-ix"
    webcrx="">
<div id="in-page-channel-node-id" data-channel-name="in_page_channel_yVXdFL"></div>

<head>
    <style>
        .wf-force-outline-none[tabindex="-1"]:focus {
            outline: none;
        }
    </style>
    <meta charset="utf-8">
    <title>Edit Profile</title>
    <meta
        content="Whether you have a question about digital services, cost value, or other information please contact us using the form and the other information on this page."
        name="description">
    <meta content="Edit Profile" property="og:title">
    <meta
        content="Whether you have a question about digital services, cost value, or other information please contact us using the form and the other information on this page."
        property="og:description">
    <meta content="Edit Profile" property="twitter:title">
    <meta
        content="Whether you have a question about digital services, cost value, or other information please contact us using the form and the other information on this page."
        property="twitter:description">
    <meta property="og:type" content="website">
    <meta content="summary_large_image" name="twitter:card">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <meta content="Webflow" name="generator">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js" type="text/javascript"></script>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Noto+Sans:regular,500,600,700,800%7CNunito:regular,500,600,700,800,900"
        media="all">
    <script
        type="text/javascript">WebFont.load({ google: { families: ["Noto Sans:regular,500,600,700,800", "Nunito:regular,500,600,700,800,900"] } });</script>
    <script
        type="text/javascript">!function (o, c) { var n = c.documentElement, t = " w-mod-"; n.className += t + "js", ("ontouchstart" in o || o.DocumentTouch && c instanceof DocumentTouch) && (n.className += t + "touch") }(window, document);</script>
    <link
        href="https://cdn.prod.website-files.com/633fc9cf3a4f100f9060830b/63635531ac4fa2658711ffbc_next-level-faicon.png"
        rel="shortcut icon" type="image/x-icon">
    <link
        href="https://cdn.prod.website-files.com/633fc9cf3a4f100f9060830b/63635535788bd0e2523debe5_next-level-webclip.webp"
        rel="apple-touch-icon">
    <script src="blob:https://promote-template.webflow.io/dcfac3c0-6c5c-41ec-bc05-5db5528229ed"></script>
</head>

<body>
    <div class="banner-title-area">
        <div data-animation="default" data-collapse="medium" data-duration="400" data-easing="ease" data-easing2="ease"
            role="banner" class="nav-bar w-nav">
            <div class="container">
                @include('components.header')
            </div>
            <div class="w-nav-overlay" data-wf-ignore="" id="w-nav-overlay-0"></div>
        </div>
        <div class="sub-banner-content-flex" style="opacity: 1;">
            <h1 class="banner-text">Update Profile Details</h1>
        </div>
        <div class="banner-overlay">
            <div class="banner-center-circle"
                style="opacity: 1; transform: translate3d(0px, 0px, 0px) scale3d(1, 1, 1) rotateX(0deg) rotateY(0deg) rotateZ(0deg) skew(0deg, 0deg); transform-style: preserve-3d;">
            </div>
            <div class="sub-banner-bg-main-circle"></div>
            <div class="sub-banner-bg-circle-left"></div>
            <div class="sub-banner-bg-circle-right"></div><img
                src="https://cdn.prod.website-files.com/633fc9cf3a4f100f9060830b/633fe09a4a630c6e9fa82f11_banner-03.svg"
                loading="lazy" alt="Banner Decorative Image" class="sub-banner-decorative"><img
                src="https://cdn.prod.website-files.com/633fc9cf3a4f100f9060830b/633fe09ad294ae620d862ef0_Banner-01.svg"
                loading="lazy" alt="Banner Decorative Image
" class="sub-banner-decorative-two">
        </div>
    </div>
    <div class="contact-section">
        <div class="container w-container">
            <div data-w-id="bb915454-e9f3-79b5-3dcb-b83cbaa7da28" style="opacity: 0;"
                class="section-title-wrap center-align">
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                <div class="title-image-wrap purple">
                    <img src="{{ \Illuminate\Support\Facades\Storage::url( $user->profile_p) }}"
                        loading="lazy" alt="Title Image" 
                        style="border: 2px solid #00000069; border-radius: 20px 0;">
                    </div>
                <div class="title-width full-width">
                    <div class="section-sub-title center-align">
                        <p class="sub-title-content"><span class="sub-title-slash purple">//</span> Edit Profile</p>
                    </div>
                    <h2 class="section-title">Update Your Profile Info</h2>
                </div>
            </div>
                
            <div data-w-id="712b99b1-9fe5-b545-7fe3-a60c9552eeaa" style="opacity: 0;" class="contact-form-wrap">
                <div class="contact-form-block w-form">
                    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="contact-form"
                        data-wf-page-id="634ced2e990236397a942c15"
                        data-wf-element-id="54eddc96-d999-49e4-b2c8-6d25e7145257" aria-label="Email Form">
                        @csrf
                        <div class="contact-form-flex">
                            <div class="contact-form-label-wrap">
                                <label for="name" class="contact-form-label">UserName
                                    *</label>
                                    <input class="contact-form-field w-input" maxlength="256" type="text" name="username" value="{{ old('username', $user->username) }}" placeholder="Your Name">
                            </div>
                            <div class="contact-form-label-wrap">
                                <label for="Email-2" class="contact-form-label">
                                    Email *</label>
                                    <input class="contact-form-field w-input" maxlength="256"
                                    name="email" value="{{ old('email', $user->email) }}" placeholder="example@yourmail.com" type="email">
                            </div>
                        </div>
                        <div class="contact-form-flex">
                            <div class="contact-form-label-wrap"><label class="contact-form-label">New Password (Leave blank to keep current)
                                    *</label>
                                    <input class="contact-form-field w-input" type="password" name="password">
                            </div>
                            <div class="contact-form-label-wrap"><label class="contact-form-label">Confirm New Password
                                    *</label>
                                    <input class="contact-form-field w-input" type="password"  name="password_confirmation">
                            </div>
                        </div>
                        <div class="contact-form-flex">
                            <div class="contact-form-label-wrap"><label
                                    class="contact-form-label">Phone Number *</label><input
                                    class="contact-form-field w-input" name="phoneNo" value="{{ old('phoneNo', $user->phoneNo) }}" placeholder="Your phoneNo here" type="text">
                            </div>
                            <div class="contact-form-label-wrap"><label
                                    class="contact-form-label">Update Profile Picture (Optional) *</label><input
                                    class="contact-form-field w-input" type="file" name="profile_p" accept="image/*">
                            </div>
                        </div>
                        <div class="button-flex contact-form">
                            <input type="submit" class="primary-button w-button" value="Update Profile">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @include('components.footer')
    <script src="https://d3e54v103j8qbb.cloudfront.net/js/jquery-3.5.1.min.dc5e7f18c8.js?site=633fc9cf3a4f100f9060830b"
        type="text/javascript" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
        crossorigin="anonymous"></script>
    <script src="https://assets-global.website-files.com/633fc9cf3a4f100f9060830b/js/webflow.0ae26b39a.js"
        type="text/javascript"></script>
</body>

</html>
