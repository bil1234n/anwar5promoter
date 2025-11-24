<html data-wf-page="63490244c19d640811050e1f"
    data-wf-site="633fc9cf3a4f100f9060830b" lang="en"
    class="w-mod-js wf-notosans-n4-active wf-notosans-n5-active wf-notosans-n6-active wf-notosans-n7-active wf-notosans-n8-active wf-nunito-n4-active wf-nunito-n5-active wf-nunito-n6-active wf-nunito-n7-active wf-nunito-n8-active wf-nunito-n9-active wf-active w-mod-ix"
    webcrx="">
<div id="in-page-channel-node-id" data-channel-name="in_page_channel_rui_-I"></div>

<head>
    <style>
        .wf-force-outline-none[tabindex="-1"]:focus {
            outline: none;
        }
    </style>
    <meta charset="utf-8">
    <title>Service Single - Promote - Webflow HTML website template</title>
    <meta
        content="A brief explanation about the particular digital marketing service with the images and the growth points are listed with readable quality."
        name="description">
    <meta content="Service Single - Promote - Webflow HTML website template" property="og:title">
    <meta
        content="A brief explanation about the particular digital marketing service with the images and the growth points are listed with readable quality."
        property="og:description">
    <meta content="Service Single - Promote - Webflow HTML website template" property="twitter:title">
    <meta
        content="A brief explanation about the particular digital marketing service with the images and the growth points are listed with readable quality."
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
    <script src="blob:https://promote-template.webflow.io/8726d368-4c25-4be9-a475-a8161bc0bb7e"></script>
    <style>
        /* 1. Variables & Reset (Consistent with previous design) */
        :root {
            --primary-color: #009b72;
            --primary-hover: #007a5a;
            --text-main: #333333;
            --text-muted: #666666;
            --text-light: #999999;
            --bg-color: #f4f7f6;
            --card-bg: #ffffff;
            --success-bg: #d4edda;
            --success-text: #155724;
            --radius: 12px;
            --shadow: 0 4px 6px rgba(0,0,0,0.05);
            --shadow-hover: 0 12px 24px rgba(0,0,0,0.1);
        }

        /* 2. Container & Layout */
        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .page-title {
            text-align: center;
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--text-main);
            margin: 60px auto 40px;
            position: relative;
        }

        /* Optional underline for title */
        .page-title::after {
            content: '';
            display: block;
            width: 60px;
            height: 4px;
            background: var(--primary-color);
            margin: 15px auto 0;
            border-radius: 2px;
        }

        /* 3. The Grid System */
        .events-grid {
            display: grid;
            /* Magic responsive grid: creates columns automatically */
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 30px;
        }

        /* 4. Card Component */
        .event-card {
            background: var(--card-bg);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            overflow: hidden;
            display: flex;
            flex-direction: column; /* Pushes footer to bottom */
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: 1px solid #00000040;
        }

        .event-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-hover);
        }

        /* Image Styles */
        .card-image-wrapper {
            width: 100%;
            height: 220px;
            position: relative;
        }

        .card-image-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .no-image {
            width: 100%;
            height: 100%;
            background-color: #e9ecef;
            color: var(--text-light);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 500;
            font-size: 0.9rem;
        }

        /* Content Styles */
        .card-body {
            padding: 25px;
            flex-grow: 1; /* Ensures all cards align even if text length differs */
            display: flex;
            flex-direction: column;
        }

        .event-date {
            font-size: 0.85rem;
            color: var(--primary-color);
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 10px;
        }

        .card-title {
            background: none;
            padding: 0;
            font-size: 1.25rem;
            font-weight: 700;
            margin-bottom: 12px;
            color: var(--text-main);
            line-height: 1.3;
        }

        .card-text {
            font-size: 0.95rem;
            color: var(--text-muted);
            margin-bottom: 20px;
        }

        /* Button Area */
        .card-footer {
            padding: 0 25px 25px 25px;
            margin-top: auto; /* Pushes button to very bottom */
        }

        .btn-register {
            display: block;
            width: 100%;
            padding: 12px;
            background-color: var(--primary-color);
            color: white;
            text-align: center;
            text-decoration: none;
            border-radius: 6px;
            font-weight: 600;
            transition: background-color 0.2s;
        }

        .btn-register:hover {
            background-color: var(--primary-hover);
        }

        /* 5. Alert Styles */
        .alert-success {
            background-color: var(--success-bg);
            color: var(--success-text);
            padding: 15px;
            border-radius: var(--radius);
            margin-bottom: 30px;
            border-left: 5px solid #28a745;
        }
    </style>
</head>

<body>
    <div class="hero-section service-single">
        <div data-animation="default" data-collapse="medium" data-duration="400" data-easing="ease" data-easing2="ease"
            role="banner" class="nav-bar w-nav">
            <div class="container">
                @include('components.header')
            </div>
            <div class="w-nav-overlay" data-wf-ignore="" id="w-nav-overlay-0"></div>
        </div>
        <div class="banner">
            <div class="w-container">

                <div class="container">
                    <h2 class="page-title">Our Events</h2>
                    
                    @if(session('success')) 
                        <div class="alert-success">{{ session('success') }}</div> 
                    @endif

                    <div class="events-grid">
                        @foreach($events as $event)
                        <div class="event-card">
                            
                            <!-- Image Section -->
                            <div class="card-image-wrapper">
                                @if($event->image)
                                    <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->title }}">
                                @else
                                    <div class="no-image">
                                        <span>No Image Available</span>
                                    </div>
                                @endif
                            </div>

                            <!-- Content Section -->
                            <div class="card-body">
                                <div class="event-date">
                                    {{ \Carbon\Carbon::parse($event->event_date)->format('M d, Y • h:i A') }}
                                </div>
                                
                                <h3 class="card-title">{{ $event->title }}</h3>
                                
                                <p class="card-text">
                                    {{ \Illuminate\Support\Str::limit($event->description, 100) }}
                                </p>
                            </div>

                            <!-- Button Section -->
                            <div class="card-footer">
                                <a href="{{ route('events.register', $event->id) }}" class="btn-register">Register Now</a>
                            </div>
                        </div>
                        @endforeach
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
