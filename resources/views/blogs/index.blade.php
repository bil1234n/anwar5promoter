<html data-wf-page="63492007bfd081cbe161b1ed"
    data-wf-site="633fc9cf3a4f100f9060830b" lang="en"
    class="w-mod-js wf-notosans-n4-active wf-notosans-n5-active wf-notosans-n6-active wf-notosans-n7-active wf-notosans-n8-active wf-nunito-n4-active wf-nunito-n5-active wf-nunito-n6-active wf-nunito-n7-active wf-nunito-n8-active wf-nunito-n9-active wf-active w-mod-ix"
    webcrx="">
<div id="in-page-channel-node-id" data-channel-name="in_page_channel_xXwIed"></div>

<head>
    <style>
        .wf-force-outline-none[tabindex="-1"]:focus {
            outline: none;
        }
    </style>
    <meta charset="utf-8">
    <title>Blog - Promote</title>
    <meta content="All the recent and upcoming news about digital marketing agencies is explained with a clean layout."
        name="description">
    <meta content="Blog - Promote" property="og:title">
    <meta content="All the recent and upcoming news about digital marketing agencies is explained with a clean layout."
        property="og:description">
    <meta content="Blog - Promote" property="twitter:title">
    <meta content="All the recent and upcoming news about digital marketing agencies is explained with a clean layout."
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
    <script src="blob:https://promote-template.webflow.io/c723d712-4a5e-480d-8fdf-a3d98bc097bd"></script>
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
            <h1 class="banner-text">Our <span class="section-sub-text purple">Blog</span></h1>
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
                loading="lazy" alt="Banner Decorative Image" class="sub-banner-decorative-two">
        </div>
    </div>
    <div class="latest-blog-section">
        <div class="container w-container">
            <div class="section-title-wrap">
                <h2 class="section-title">Latest posts</h2>
            </div>
            <div class="blog-tab-wrap">
                <div data-current="Tab 1" data-easing="ease" data-duration-in="300" data-duration-out="100"
                    class="w-tabs"> 
                    <div class="tabs-menu w-tab-menu" role="tablist">
                        
                    <form action="{{ route('blogs.index') }}" method="GET" class="d-f">
                        <select class="contact-form-field w-input" name="category" id="categorySelect">
                            <option value="">All Categories</option>
                            {{-- We assume $categories is passed from the controller --}}
                            @foreach($categories as $cat)
                                <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>
                                    {{ $cat }}
                                </option>
                            @endforeach
                        </select>
                        <button type="submit" class="primary-button w-button">Filter</button>
                        
                        {{-- Optional: Reset button if a filter is active --}}
                        @if(request('category'))
                            <a href="{{ route('blogs.index') }}" class="yellow-button  blue_btn_2 w-button">Reset</a>
                        @endif
                    </form>
                    </div>
                    <div data-w-id="a4717db7-069f-9e21-ba21-8d559b486b98" style="opacity: 0;" class="w-tab-content">
                        
                        <div class="w-tab-pane w--tab-active">
                            <div>
                                <div class="blog-collection w-dyn-list">
                                    <div role="list" class="blog-collection-list w-dyn-items w-row">
                                        @forelse($blogs as $blog) 
                                            <div role="listitem" class="blog-collection-item w-dyn-item w-col w-col-6">
                                                <div class="blog-wrap">
                                                    <a href="#" class="blog-link w-inline-block">
                                                        @if($blog->image)
                                                        
                                                            <img alt="Blog Image" loading="lazy" src="{{ \Illuminate\Support\Facades\Storage::url($blog->image) }}" sizes="(max-width: 479px) 83vw, (max-width: 767px) 87vw, (max-width: 991px) 41vw, (max-width: 1279px) 38vw, 478px" class="blog-image">
                                                        @endif
                                                    </a>
                                                    <div class="category-and-date">
                                                        <a href="#" class="categories-wrap w-inline-block">
                                                            <div>{{ $blog->category }}</div>
                                                        </a>
                                                        <p class="blog-publish-date">December 4, 2023</p>
                                                    </div><a
                                                        href="#"
                                                        class="section-content-title blog-page-title">{{ $blog->title }}</a>
                                                        <p>{{ Str::limit($blog->content, 100) }}</p>
                                                </div>
                                            </div>
                                        @empty
                                            <p class="text-center">No blogs found for this category.</p>
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
