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
    <title>Events</title>
    <meta content="Events page with Ramadan Countdown" name="description">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <meta content="Webflow" name="generator">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js" type="text/javascript"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Noto+Sans:regular,500,600,700,800%7CNunito:regular,500,600,700,800,900" media="all">
    <!-- Added Amiri Font for Ramadan Widget -->
    <link href="https://fonts.googleapis.com/css2?family=Amiri:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
    
    <script type="text/javascript">WebFont.load({ google: { families: ["Noto Sans:regular,500,600,700,800", "Nunito:regular,500,600,700,800,900"] } });</script>
    <script type="text/javascript">!function (o, c) { var n = c.documentElement, t = " w-mod-"; n.className += t + "js", ("ontouchstart" in o || o.DocumentTouch && c instanceof DocumentTouch) && (n.className += t + "touch") }(window, document);</script>
    
    <style>
        /* --- ORIGINAL PAGE STYLES --- */
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

        .container { max-width: 1200px; margin: 0 auto; }
        .page-title { text-align: center; font-size: 2.5rem; font-weight: 700; color: var(--text-main); margin: 60px auto 40px; position: relative; }
        .page-title::after { content: ''; display: block; width: 60px; height: 4px; background: var(--primary-color); margin: 15px auto 0; border-radius: 2px; }
        
        .events-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 30px; }
        
        /* Renamed generic .card to .event-card in CSS for clarity, though you had .event-card already */
        .event-card { background: var(--card-bg); border-radius: var(--radius); box-shadow: var(--shadow); overflow: hidden; display: flex; flex-direction: column; transition: transform 0.3s ease, box-shadow 0.3s ease; border: 1px solid #00000040; }
        .event-card:hover { transform: translateY(-5px); box-shadow: var(--shadow-hover); }
        .card-image-wrapper { width: 100%; height: 220px; position: relative; }
        .card-image-wrapper img { width: 100%; height: 100%; object-fit: cover; }
        .no-image { width: 100%; height: 100%; background-color: #e9ecef; color: var(--text-light); display: flex; align-items: center; justify-content: center; font-weight: 500; font-size: 0.9rem; }
        .card-body { padding: 25px; flex-grow: 1; display: flex; flex-direction: column; }
        .event-date { font-size: 0.85rem; color: var(--primary-color); font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 10px; }
        .card-title { background: none; padding: 0; font-size: 1.25rem; font-weight: 700; margin-bottom: 12px; color: var(--text-main); line-height: 1.3; }
        .card-text { font-size: 0.95rem; color: var(--text-muted); margin-bottom: 20px; }
        .card-footer { padding: 0 25px 25px 25px; margin-top: auto; }
        .btn-register { display: block; width: 100%; padding: 12px; background-color: var(--primary-color); color: white; text-align: center; text-decoration: none; border-radius: 6px; font-weight: 600; transition: background-color 0.2s; }
        .btn-register:hover { background-color: var(--primary-hover); }
        .alert-success { background-color: var(--success-bg); color: var(--success-text); padding: 15px; border-radius: var(--radius); margin-bottom: 30px; border-left: 5px solid #28a745; }

        /* =========================================
           RAMADAN WIDGET STYLES (SCOPED)
           ========================================= */
        
        .ramadan-wrapper {
            /* Scoped Variables */
            --gold: #D4AF37;
            --gold-shine: #F9E58A;
            --midnight: #0B1026;
            --deep-purple: #1a1b3a;
            --overlay-color: rgba(11, 16, 38, 0.85);
            
            /* Container styling to keep it contained */
            position: relative;
            background-color: var(--midnight);
            color: white;
            border-radius: 20px;
            overflow: hidden; /* IMPORTANT: Keeps stars inside */
            margin: 40px 0;
            padding: 20px 0 60px 0;
            box-shadow: 0 10px 30px rgba(0,0,0,0.4);
            font-family: 'Amiri', 'Nunito', sans-serif;
            min-height: 400px; /* Ensure height for absolute elements */
        }

        /* Background Layers */
        .ramadan-wrapper .bg-pattern {
            position: absolute; top: 0; left: 0; width: 100%; height: 100%;
            background-image: 
                radial-gradient(var(--gold) 2px, transparent 2.5px),
                radial-gradient(var(--gold) 2px, transparent 2.5px);
            background-size: 50px 50px;
            background-position: 0 0, 25px 25px;
            opacity: 0.1; z-index: 1;
        }
        
        .ramadan-wrapper .vignette {
            position: absolute; top: 0; left: 0; width: 100%; height: 100%;
            background: radial-gradient(circle at center, transparent 0%, var(--midnight) 90%);
            z-index: 2;
        }

        /* Moon */
        .ramadan-wrapper .moon {
            position: absolute; top: 8%; right: 10%; width: 120px; height: 120px;
            border-radius: 50%;
            box-shadow: -20px 8px 0 5px var(--gold);
            filter: drop-shadow(0 0 25px rgba(212, 175, 55, 0.6));
            transform: rotate(-15deg); z-index: 3;
            animation: moonFloat 6s ease-in-out infinite alternate;
        }

        /* Stars */
        .ramadan-wrapper .stars { position: absolute; width: 100%; height: 100%; z-index: 1; top: 0; left: 0;}
        .ramadan-wrapper .star {
            position: absolute; background: white; border-radius: 50%;
            animation: twinkle var(--duration) infinite ease-in-out; opacity: 0;
        }

        /* Mosque */
        .ramadan-wrapper .mosque-bg {
            position: absolute; bottom: 0; left: 0; width: 100%; height: 25vh;
            background-repeat: repeat-x; background-position: bottom center;
            background-size: contain; z-index: 3; opacity: 0.8;
            pointer-events: none;
        }

        /* Lanterns */
        .ramadan-wrapper .lantern-group { position: absolute; top: -75px; left: 5%; z-index: 5; display: flex; gap: 40px; }
        .ramadan-wrapper .lantern-box { position: relative; transform-origin: top center; }
        .ramadan-wrapper .l-1 { animation: swing 4s infinite ease-in-out alternate; }
        .ramadan-wrapper .l-2 { animation: swing 5s infinite ease-in-out alternate-reverse; margin-top: 50px; }
        .ramadan-wrapper .chain { width: 2px; background: linear-gradient(to bottom, transparent, var(--gold)); margin: 0 auto; }
        .ramadan-wrapper .lantern-body {
            width: 50px; height: 70px; background: rgba(11, 16, 38, 0.8);
            border: 2px solid var(--gold); border-radius: 10px 10px 20px 20px;
            position: relative; box-shadow: 0 0 30px rgba(212, 175, 55, 0.3), inset 0 0 20px rgba(212, 175, 55, 0.2);
        }
        .ramadan-wrapper .lantern-body::after {
            content: ''; position: absolute; width: 12px; height: 12px; background: #fff;
            border-radius: 50%; top: 50%; left: 50%; transform: translate(-50%, -50%);
            box-shadow: 0 0 20px 5px #ffdb4d; animation: flicker 3s infinite;
        }

        /* Content inside Ramadan Widget */
        .container_r {
            position: relative; margin: 3rem auto 1rem; z-index: 10; text-align: center;
            width: 90%; max-width: 900px; padding: 20px;
            animation: fadeInUp 1.5s ease-out;
        }
        .bismillah { font-family: 'Amiri', serif; color: var(--gold); font-size: 1.5rem; margin-bottom: 10px; opacity: 0.9; }
        
        .r-headline {
            font-family: 'Amiri', serif; font-size: 3.5rem; margin: 10px 0 30px 0;
            background: linear-gradient(135deg, var(--gold), #FFF, var(--gold));
            -webkit-background-clip: text; -webkit-text-fill-color: transparent;
            text-shadow: 0 4px 15px rgba(0,0,0,0.5); line-height: 1.2;
        }

        /* Countdown Cards (Renamed .card to .r-card to avoid conflict) */
        .ramadan-countdown { display: flex; justify-content: center; gap: 25px; flex-wrap: wrap; }
        
        .r-card {
            background: rgba(11, 16, 38, 0.6); border: 1px solid var(--gold);
            border-radius: 15px; padding: 20px; min-width: 120px;
            position: relative; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.3);
            transition: all 0.3s ease;
        }
        .r-card::before {
            content: ''; position: absolute; top: -50%; left: -50%; width: 200%; height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            transform: rotate(45deg); pointer-events: none;
        }
        .r-card:hover { transform: translateY(-10px); box-shadow: 0 15px 40px rgba(212, 175, 55, 0.2); border-color: var(--gold-shine); }
        
        .r-card .time { display: block; font-size: 2.5rem; font-weight: 600; color: #fff; text-shadow: 0 0 10px rgba(255,255,255,0.5); }
        .r-card .label { font-family: 'Amiri', serif; font-size: 1.1rem; color: var(--gold); text-transform: uppercase; letter-spacing: 2px; margin-top: 5px; }

        .footer-text { margin-top: 40px; font-size: 1.1rem; color: #ccc; font-family: 'Amiri', serif; font-style: italic; }

        /* Animations */
        @keyframes twinkle { 0%, 100% { opacity: 0.2; transform: scale(0.8); } 50% { opacity: 1; transform: scale(1.2); } }
        @keyframes swing { 0% { transform: rotate(-8deg); } 100% { transform: rotate(8deg); } }
        @keyframes flicker { 0%, 100% { opacity: 1; transform: translate(-50%, -50%) scale(1); } 50% { opacity: 0.6; transform: translate(-50%, -50%) scale(0.9); } }
        @keyframes moonFloat { 0% { transform: rotate(-15deg) translateY(0); } 100% { transform: rotate(-15deg) translateY(-20px); } }
        @keyframes fadeInUp { from { opacity: 0; transform: translateY(30px); } to { opacity: 1; transform: translateY(0); } }

        /* Responsive for Widget */
        @media (max-width: 768px) {
            .r-headline { font-size: 2.5rem; }
            .ramadan-countdown { gap: 10px; }
            .r-card { min-width: 80px; padding: 10px; flex: 1 1 40%; }
            .r-card .time { font-size: 1.8rem; }
            .ramadan-wrapper .moon { 
                width: 55px;
                height: 56px;
                top: 2%;
             }
            .ramadan-wrapper .lantern-group { left: 10px; transform: scale(0.7); }
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

                    
                    <!-- =========================================
                         START RAMADAN WIDGET
                         ========================================= -->
                    <div class="ramadan-wrapper">
                        <!-- Background Layers -->
                        <div class="bg-pattern"></div>
                        <div class="vignette"></div>
                        <div class="stars" id="star-container"></div>
                        <div class="mosque-bg"></div>
            
                        <!-- Decorative Moon -->
                        <div class="moon"></div>
            
                        <!-- Hanging Lanterns -->
                        <div class="lantern-group">
                            <div class="lantern-box l-1">
                                <div class="chain" style="height: 120px;"></div>
                                <div class="lantern-body"></div>
                            </div>
                            <div class="lantern-box l-2">
                                <div class="chain" style="height: 180px;"></div>
                                <div class="lantern-body" style="width: 60px; height: 85px;"></div>
                            </div>
                        </div>
            
                        <!-- Main Content -->
                        <div class="container_r">
                            <div class="bismillah">﷽</div>
                            <h1 class="r-headline">Ramadan Kareem</h1>
                            
                            <div class="ramadan-countdown">
                                <div class="r-card">
                                    <span class="time" id="days">00</span>
                                    <span class="label">Days</span>
                                </div>
                                <div class="r-card">
                                    <span class="time" id="hours">00</span>
                                    <span class="label">Hours</span>
                                </div>
                                <div class="r-card">
                                    <span class="time" id="minutes">00</span>
                                    <span class="label">Mins</span>
                                </div>
                                <div class="r-card">
                                    <span class="time" id="seconds">00</span>
                                    <span class="label">Secs</span>
                                </div>
                            </div>
            
                            <p class="footer-text">Counting down to the month of Mercy, Forgiveness, and Freedom from Fire.</p>
                        </div>
                    </div>
                    <!-- =========================================
                         END RAMADAN WIDGET
                         ========================================= -->
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

    <!-- RAMADAN WIDGET SCRIPT -->
    <script>
        // --- STAR GENERATOR ---
        const starContainer = document.getElementById('star-container');
        if(starContainer) {
            const starCount = 60; // Reduced star count slightly for performance

            for (let i = 0; i < starCount; i++) {
                const star = document.createElement('div');
                star.classList.add('star');
                
                // Random positioning
                const x = Math.random() * 100;
                const y = Math.random() * 100;
                const size = Math.random() * 3;
                const duration = 2 + Math.random() * 3;
                const delay = Math.random() * 5;

                star.style.left = `${x}%`;
                star.style.top = `${y}%`;
                star.style.width = `${size}px`;
                star.style.height = `${size}px`;
                star.style.setProperty('--duration', `${duration}s`);
                star.style.animationDelay = `${delay}s`;

                starContainer.appendChild(star);
            }
        }

        // --- COUNTDOWN LOGIC ---
        // Estimated Date for Ramadan 2026: Feb 17, 2026 (Adjust as needed)
        const targetDate = new Date("February 17, 2026 00:00:00").getTime();

        const timer = setInterval(() => {
            const now = new Date().getTime();
            const distance = targetDate - now;

            if (distance < 0) {
                clearInterval(timer);
                const rHead = document.querySelector('.r-headline');
                if(rHead) rHead.innerText = "Ramadan Mubarak!";
                return;
            }

            const days = Math.floor(distance / (1000 * 60 * 60 * 24));
            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);

            const elDay = document.getElementById("days");
            if(elDay) {
                elDay.innerText = days < 10 ? "0" + days : days;
                document.getElementById("hours").innerText = hours < 10 ? "0" + hours : hours;
                document.getElementById("minutes").innerText = minutes < 10 ? "0" + minutes : minutes;
                document.getElementById("seconds").innerText = seconds < 10 ? "0" + seconds : seconds;
            }

        }, 1000);
    </script>
</body>

</html>
