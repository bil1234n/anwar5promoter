
<html data-wf-page="6348f7b6ae59d2c468652b7b"
    data-wf-site="633fc9cf3a4f100f9060830b" lang="en"
    class="w-mod-js wf-notosans-n4-active wf-notosans-n5-active wf-notosans-n6-active wf-notosans-n7-active wf-notosans-n8-active wf-nunito-n4-active wf-nunito-n5-active wf-nunito-n6-active wf-nunito-n7-active wf-nunito-n8-active wf-nunito-n9-active wf-active w-mod-ix"
    webcrx="">
<div id="in-page-channel-node-id" data-channel-name="in_page_channel_IaUqQk"></div>

<head>
    <style>
        .wf-force-outline-none[tabindex="-1"]:focus {
            outline: none;
        }
    </style>
    <meta charset="utf-8">
    <title>Services - Anwar5Promoter</title>
    <meta
        content="At Anwar5Promoter, we specialize in digital marketing, legalization services, and Islamic-compliant competitive solutions. Our marketing agency presents a clear and concise introduction, followed by a structured list of services organized under their main categories."
        name="description">
    <meta content="Services - 5" property="og:title">
    <meta
        content="At Anwar5Promoter, we specialize in digital marketing, legalization services, and Islamic-compliant competitive solutions. Our marketing agency presents a clear and concise introduction, followed by a structured list of services organized under their main categories."
        property="og:description">
    <meta content="Services - 5" property="twitter:title">
    <meta
        content="At Anwar5Promoter, we specialize in digital marketing, legalization services, and Islamic-compliant competitive solutions. Our marketing agency presents a clear and concise introduction, followed by a structured list of services organized under their main categories."
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
    <script src="blob:https://promote-template.webflow.io/b1005f55-8632-4b35-80b9-ae90e87239d0"></script>
    <style>
        /* --- 1. GENERAL STYLES --- */
        :root {
            --bg-color: #292930;
            --card-bg: #292930;
            --text-main: #ffffff;
            --text-secondary: #b0b0b0;
            --accent: #ff4757;
        }



        body {
            background-color: var(--bg-color);
            color: var(--text-main);
            padding-bottom: 50px;
        }

        .h1_gal {
            text-align: center;
            color: #fff;
            margin: -10px 0 20px;
            font-weight: 300;
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        /* --- 2. TOP FILTER SECTION --- */
        .filter-container {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 15px;
            margin-bottom: 40px;
            padding: 0 20px;
        }

        .filter-btn {
            background: transparent;
            border: 2px solid var(--text-secondary);
            color: var(--text-secondary);
            padding: 10px 25px;
            border-radius: 30px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .filter-btn:hover, .filter-btn.active {
            background-color: var(--accent);
            border-color: var(--accent);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(255, 71, 87, 0.4);
        }

        /* --- 3. GALLERY GRID --- */
        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
            padding: 20px 5%;
            max-width: 1600px;
            margin: 0 auto;
        }

        .gallery-item {
            position: relative;
            border-radius: 12px;
            overflow: hidden;
            height: 350px; /* Fixed height for uniform look */
            cursor: pointer;
            box-shadow: 0 4px 10px rgba(0,0,0,0.3);
            transition: transform 0.4s ease, opacity 0.4s ease;
        }

        /* Image Styling */
        .gallery-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        /* Hover Overlay */
        .overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(to top, rgba(0,0,0,0.8), transparent);
            padding: 20px;
            transform: translateY(100%);
            transition: transform 0.3s ease;
        }

        .gallery-item:hover img {
            transform: scale(1.1);
        }

        .gallery-item:hover .overlay {
            transform: translateY(0);
        }

        .overlay h3 {
            font-size: 1.2rem;
            margin-bottom: 5px;
        }

        .overlay p {
            font-size: 0.9rem;
            color: #ddd;
        }

        /* Animation classes for filtering */
        .gallery-item.hide {
            display: none;
        }
        
        .gallery-item.show {
            animation: fadeIn 0.5s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: scale(0.9); }
            to { opacity: 1; transform: scale(1); }
        }

        /* --- 4. BOTTOM CATEGORY SECTION --- */
        .category-footer {
            margin-top: 80px;
            border-top: 1px solid #333;
            padding: 40px 20px;
            background-color: #1a1a1a91;
        }

        .cat-footer-content {
            max-width: 1200px;
            margin: 0 auto;
            text-align: center;
        }

        .cat-footer-content h2 {
            margin-bottom: 30px;
            font-size: 1.5rem;
            color: #fff;
        }

        .cat-links {
            display: flex;
            justify-content: center;
            gap: 40px;
            flex-wrap: wrap;
        }

        .cat-link-item {
            text-decoration: none;
            color: var(--text-secondary);
            font-size: 1.1rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            transition: color 0.3s;
        }

        .cat-link-item span {
            font-size: 2rem;
            margin-bottom: 10px;
        }

        .cat-link-item:hover {
            color: var(--accent);
        }
        .gallery-item h3{
            color: #fff;
        }

    </style>
</head>

<body>
    <div class="banner-title-area service-page">
        <div data-animation="default" data-collapse="medium" data-duration="400" data-easing="ease" data-easing2="ease"
            role="banner" class="nav-bar w-nav">
            <div class="container">
                @include('components.header')
            </div>
            <div class="w-nav-overlay" data-wf-ignore="" id="w-nav-overlay-0"></div>
        </div>
        <div class="sub-banner-content-flex service-banner" style="display: block; opacity: 1;">
            <h1 class="banner-text">Services 4</h1>
            <h2>Quran & Azan competition in Tigray Ethiopia</h2>
        </div>
        <div class="banner-overlay">
            <div class="banner-center-circle"
                style="opacity: 1; transform: translate3d(0px, 0px, 0px) scale3d(1, 1, 1) rotateX(0deg) rotateY(0deg) rotateZ(0deg) skew(0deg, 0deg); transform-style: preserve-3d;">
            </div>
            <div class="sub-banner-bg-main-circle service-circle"></div>
            <div class="sub-banner-bg-circle-left service-bg"></div>
            <div class="sub-banner-bg-circle-right service-bg"></div><img
                src="https://cdn.prod.website-files.com/633fc9cf3a4f100f9060830b/633fe09a4a630c6e9fa82f11_banner-03.svg"
                loading="lazy" alt="Banner Decorative Image" class="sub-banner-decorative"><img
                src="https://cdn.prod.website-files.com/633fc9cf3a4f100f9060830b/633fe09ad294ae620d862ef0_Banner-01.svg"
                loading="lazy" alt="Banner Decorative Image" class="sub-banner-decorative-two">
        </div>
    </div>
    <div class="service-section service-page">
        <div class="container w-container">
    <!-- HEADER & TITLE -->
    <h1 class="h1_gal">Competition Gallery</h1>

    <!-- 1. TOP FILTER BUTTONS -->
    <div class="filter-container">
        <button class="filter-btn active" onclick="filterGallery('all')">Show All</button>
        <button class="filter-btn" onclick="filterGallery('1st_Quran_competition')">1st Round Quran Competition</button>
        <button class="filter-btn" onclick="filterGallery('2nd_Quran_competition')">2nd Round Quran Competition</button>
        <!-- <button class="filter-btn" onclick="filterGallery('urban')">Urban</button>
        <button class="filter-btn" onclick="filterGallery('portrait')">Portrait</button>
        <button class="filter-btn" onclick="filterGallery('travel')">Travel</button> -->
    </div>

    <!-- 2. GALLERY GRID -->
    <!-- 
       INSTRUCTIONS: 
       1. Replace 'src' with your actual image paths (e.g., images/photo1.jpg).
       2. Ensure the class name (e.g., '1st_Quran_competition', 'urban') matches your categories.
    -->
    <div class="gallery-grid">
        
        {{-- 1st round --}}
        <div class="gallery-item 2nd_Quran_competition">
            <img src="https://i.imgur.com/Wwv5uBa.jpeg" alt="2nd_Quran_competition">
            <div class="overlay">
                <h3>Islamic</h3>
                <p>2nd_Quran_competition Category</p>
            </div>
        </div>
        <div class="gallery-item 2nd_Quran_competition">
            <img src="https://i.imgur.com/McnL5RD.jpeg" alt="2nd_Quran_competition">
            <div class="overlay">
                <h3>Islamic</h3>
                <p>2nd_Quran_competition Category</p>
            </div>
        </div>
        <div class="gallery-item 2nd_Quran_competition">
            <img src="https://i.imgur.com/K1HJu0i.jpeg" alt="2nd_Quran_competition">
            <div class="overlay">
                <h3>Islamic</h3>
                <p>2nd_Quran_competition Category</p>
            </div>
        </div>
        <div class="gallery-item 2nd_Quran_competition">
            <img src="https://i.imgur.com/DfDc2fC.jpeg" alt="2nd_Quran_competition">
            <div class="overlay">
                <h3>Islamic</h3>
                <p>2nd_Quran_competition Category</p>
            </div>
        </div>
        <div class="gallery-item 2nd_Quran_competition">
            <img src="https://i.imgur.com/6CkFpId.jpeg" alt="2nd_Quran_competition">
            <div class="overlay">
                <h3>Islamic</h3>
                <p>2nd_Quran_competition Category</p>
            </div>
        </div>
        <div class="gallery-item 2nd_Quran_competition">
            <img src="https://i.imgur.com/zo3aB9M.jpeg" alt="2nd_Quran_competition">
            <div class="overlay">
                <h3>Islamic</h3>
                <p>2nd_Quran_competition Category</p>
            </div>
        </div>


        {{-- 1st round --}}
        <div class="gallery-item 1st_Quran_competition">
            <img src="https://i.imgur.com/iKhgGyx.jpeg" alt="1st_Quran_competition">
            <div class="overlay">
                <h3>Islamic</h3>
                <p>1st_Quran_competition Category</p>
            </div>
        </div>

        <div class="gallery-item 1st_Quran_competition">
            <img src="https://i.imgur.com/NLghWTI.jpeg" alt="1st_Quran_competition">
            <div class="overlay">
                <h3>Islamic</h3>
                <p>1st_Quran_competition Category</p>
            </div>
        </div>

        <div class="gallery-item 1st_Quran_competition">
            <img src="https://i.imgur.com/ef6Tav6.jpeg" alt="1st_Quran_competition">
            <div class="overlay">
                <h3>Islamic</h3>
                <p>1st_Quran_competition Category</p>
            </div>
        </div>

        <div class="gallery-item 1st_Quran_competition">
            <img src="https://i.imgur.com/qAw3ThI.jpeg" alt="1st_Quran_competition">
            <div class="overlay">
                <h3>Islamic</h3>
                <p>1st_Quran_competition Category</p>
            </div>
        </div>

        <div class="gallery-item 1st_Quran_competition">
            <img src="https://i.imgur.com/Jjymcru.jpeg" alt="1st_Quran_competition">
            <div class="overlay">
                <h3>Islamic</h3>
                <p>1st_Quran_competition Category</p>
            </div>
        </div>

        <div class="gallery-item 1st_Quran_competition">
            <img src="https://i.imgur.com/8FTy0je.jpeg" alt="1st_Quran_competition">
            <div class="overlay">
                <h3>Islamic</h3>
                <p>1st_Quran_competition Category</p>
            </div>
        </div>

        <div class="gallery-item 1st_Quran_competition">
            <img src="https://i.imgur.com/2fwuIcS.jpeg" alt="1st_Quran_competition">
            <div class="overlay">
                <h3>Islamic</h3>
                <p>1st_Quran_competition Category</p>
            </div>
        </div>

        <div class="gallery-item 1st_Quran_competition">
            <img src="https://i.imgur.com/yNc4syU.jpeg" alt="1st_Quran_competition">
            <div class="overlay">
                <h3>Islamic</h3>
                <p>1st_Quran_competition Category</p>
            </div>
        </div>

        <div class="gallery-item 1st_Quran_competition">
            <img src="https://i.imgur.com/KD15vUt.jpeg" alt="1st_Quran_competition">
            <div class="overlay">
                <h3>Islamic</h3>
                <p>1st_Quran_competition Category</p>
            </div>
        </div>

        <div class="gallery-item 1st_Quran_competition">
            <img src="https://i.imgur.com/4mT7S8F.jpeg" alt="1st_Quran_competition">
            <div class="overlay">
                <h3>Islamic</h3>
                <p>1st_Quran_competition Category</p>
            </div>
        </div>

        <div class="gallery-item 1st_Quran_competition">
            <img src="https://i.imgur.com/yjatgZy.jpeg" alt="1st_Quran_competition">
            <div class="overlay">
                <h3>Islamic</h3>
                <p>1st_Quran_competition Category</p>
            </div>
        </div>

        <div class="gallery-item 1st_Quran_competition">
            <img src="https://i.imgur.com/FECZd6N.jpeg" alt="1st_Quran_competition">
            <div class="overlay">
                <h3>Islamic</h3>
                <p>1st_Quran_competition Category</p>
            </div>
        </div>

        <div class="gallery-item 1st_Quran_competition">
            <img src="https://i.imgur.com/gWFqdNm.jpeg" alt="1st_Quran_competition">
            <div class="overlay">
                <h3>Islamic</h3>
                <p>1st_Quran_competition Category</p>
            </div>
        </div>

        <div class="gallery-item 1st_Quran_competition">
            <img src="https://i.imgur.com/lZEEI4m.jpeg" alt="1st_Quran_competition">
            <div class="overlay">
                <h3>Islamic</h3>
                <p>1st_Quran_competition Category</p>
            </div>
        </div>

        <div class="gallery-item 1st_Quran_competition">
            <img src="https://i.imgur.com/WfVOlwS.jpeg" alt="1st_Quran_competition">
            <div class="overlay">
                <h3>Islamic</h3>
                <p>1st_Quran_competition Category</p>
            </div>
        </div>

        <div class="gallery-item 1st_Quran_competition">
            <img src="https://i.imgur.com/19OQe6P.jpeg" alt="1st_Quran_competition">
            <div class="overlay">
                <h3>Islamic</h3>
                <p>1st_Quran_competition Category</p>
            </div>
        </div>

        <div class="gallery-item 1st_Quran_competition">
            <img src="https://i.imgur.com/m1voSgN.jpeg" alt="1st_Quran_competition">
            <div class="overlay">
                <h3>Islamic</h3>
                <p>1st_Quran_competition Category</p>
            </div>
        </div>

        <div class="gallery-item 1st_Quran_competition">
            <img src="https://i.imgur.com/3u13Be0.jpeg" alt="1st_Quran_competition">
            <div class="overlay">
                <h3>Islamic</h3>
                <p>1st_Quran_competition Category</p>
            </div>
        </div>

        <div class="gallery-item 1st_Quran_competition">
            <img src="https://i.imgur.com/HUrb8FX.jpeg" alt="1st_Quran_competition">
            <div class="overlay">
                <h3>Islamic</h3>
                <p>1st_Quran_competition Category</p>
            </div>
        </div>

        <div class="gallery-item 1st_Quran_competition">
            <img src="https://i.imgur.com/9Z4OPC2.jpeg" alt="1st_Quran_competition">
            <div class="overlay">
                <h3>Islamic</h3>
                <p>1st_Quran_competition Category</p>
            </div>
        </div>

        <div class="gallery-item 1st_Quran_competition">
            <img src="https://i.imgur.com/gGk523p.jpeg" alt="1st_Quran_competition">
            <div class="overlay">
                <h3>Islamic</h3>
                <p>1st_Quran_competition Category</p>
            </div>
        </div>

        <div class="gallery-item 1st_Quran_competition">
            <img src="https://i.imgur.com/fYHwv39.jpeg" alt="1st_Quran_competition">
            <div class="overlay">
                <h3>Islamic</h3>
                <p>1st_Quran_competition Category</p>
            </div>
        </div>

        <div class="gallery-item 1st_Quran_competition">
            <img src="https://i.imgur.com/37yk6w2.jpeg" alt="1st_Quran_competition">
            <div class="overlay">
                <h3>Islamic</h3>
                <p>1st_Quran_competition Category</p>
            </div>
        </div>

        <div class="gallery-item 1st_Quran_competition">
            <img src="https://i.imgur.com/QoPzskT.jpeg" alt="1st_Quran_competition">
            <div class="overlay">
                <h3>Islamic</h3>
                <p>1st_Quran_competition Category</p>
            </div>
        </div>

        <div class="gallery-item 1st_Quran_competition">
            <img src="https://i.imgur.com/e4QDADI.jpeg" alt="1st_Quran_competition">
            <div class="overlay">
                <h3>Islamic</h3>
                <p>1st_Quran_competition Category</p>
            </div>
        </div>

        <div class="gallery-item 1st_Quran_competition">
            <img src="https://i.imgur.com/kLYTS79.jpeg" alt="1st_Quran_competition">
            <div class="overlay">
                <h3>Islamic</h3>
                <p>1st_Quran_competition Category</p>
            </div>
        </div>

        <div class="gallery-item 1st_Quran_competition">
            <img src="https://i.imgur.com/V6wKr3z.jpeg" alt="1st_Quran_competition">
            <div class="overlay">
                <h3>Islamic</h3>
                <p>1st_Quran_competition Category</p>
            </div>
        </div>

        <div class="gallery-item 1st_Quran_competition">
            <img src="https://i.imgur.com/GK3MEDP.jpeg" alt="1st_Quran_competition">
            <div class="overlay">
                <h3>Islamic</h3>
                <p>1st_Quran_competition Category</p>
            </div>
        </div>

        <div class="gallery-item 1st_Quran_competition">
            <img src="https://i.imgur.com/DCdn6Yu.jpeg" alt="1st_Quran_competition">
            <div class="overlay">
                <h3>Islamic</h3>
                <p>1st_Quran_competition Category</p>
            </div>
        </div>

        <div class="gallery-item 1st_Quran_competition">
            <img src="https://i.imgur.com/DklHkd8.jpeg" alt="1st_Quran_competition">
            <div class="overlay">
                <h3>Islamic</h3>
                <p>1st_Quran_competition Category</p>
            </div>
        </div>

        <div class="gallery-item 1st_Quran_competition">
            <img src="https://i.imgur.com/YgaiJ8b.jpeg" alt="1st_Quran_competition">
            <div class="overlay">
                <h3>Islamic</h3>
                <p>1st_Quran_competition Category</p>
            </div>
        </div>

        <div class="gallery-item 1st_Quran_competition">
            <img src="https://i.imgur.com/8LqR9MQ.jpeg" alt="1st_Quran_competition">
            <div class="overlay">
                <h3>Islamic</h3>
                <p>1st_Quran_competition Category</p>
            </div>
        </div>

        <div class="gallery-item 1st_Quran_competition">
            <img src="https://i.imgur.com/V64eoMg.jpeg" alt="1st_Quran_competition">
            <div class="overlay">
                <h3>Islamic</h3>
                <p>1st_Quran_competition Category</p>
            </div>
        </div>

        <div class="gallery-item 1st_Quran_competition">
            <img src="https://i.imgur.com/FsKdwLx.jpeg" alt="1st_Quran_competition">
            <div class="overlay">
                <h3>Islamic</h3>
                <p>1st_Quran_competition Category</p>
            </div>
        </div>

        <div class="gallery-item 1st_Quran_competition">
            <img src="https://i.imgur.com/z1RK3XS.jpeg" alt="1st_Quran_competition">
            <div class="overlay">
                <h3>Islamic</h3>
                <p>1st_Quran_competition Category</p>
            </div>
        </div>

        <div class="gallery-item 1st_Quran_competition">
            <img src="https://i.imgur.com/SrR0tN4.jpeg" alt="1st_Quran_competition">
            <div class="overlay">
                <h3>Islamic</h3>
                <p>1st_Quran_competition Category</p>
            </div>
        </div>

        <div class="gallery-item 1st_Quran_competition">
            <img src="https://i.imgur.com/ZmYArWD.jpeg" alt="1st_Quran_competition">
            <div class="overlay">
                <h3>Islamic</h3>
                <p>1st_Quran_competition Category</p>
            </div>
        </div>

        <div class="gallery-item 1st_Quran_competition">
            <img src="https://i.imgur.com/RAHq7GF.jpeg" alt="1st_Quran_competition">
            <div class="overlay">
                <h3>Islamic</h3>
                <p>1st_Quran_competition Category</p>
            </div>
        </div>

    </div>

    <!-- 3. BOTTOM CATEGORY SECTION -->
    <footer class="category-footer">
        <div class="cat-footer-content">
            <h2>Explore by Category</h2>
            <div class="cat-links">
                <a href="#" class="cat-link-item" onclick="filterGallery('1st_Quran_competition'); scrollToTop()">
                    <span>🕌</span>
                    1st_Quran_competition
                </a>
                <a href="#" class="cat-link-item" onclick="filterGallery('2nd_Quran_competition'); scrollToTop()">
                    <span>🕌</span>
                    2nd_Quran_competition
                </a>
                <!-- <a href="#" class="cat-link-item" onclick="filterGallery('urban'); scrollToTop()">
                    <span>🏢</span>
                    Urban
                </a>
                <a href="#" class="cat-link-item" onclick="filterGallery('portrait'); scrollToTop()">
                    <span>👤</span>
                    Portrait
                </a>
                <a href="#" class="cat-link-item" onclick="filterGallery('travel'); scrollToTop()">
                    <span>✈️</span>
                    Travel
                </a> -->
            </div>
        </div>
    </footer>

    <!-- JAVASCRIPT LOGIC -->
    <script>
        function filterGallery(category) {
            let items = document.getElementsByClassName('gallery-item');
            
            // 1. Manage Buttons Active State
            // Only update buttons if called from the top filter bar logic (optional check)
            let buttons = document.getElementsByClassName('filter-btn');
            for (let btn of buttons) {
                // Remove active class from all
                btn.classList.remove('active');
                // Add active class if the button text matches category (simple check)
                if (btn.innerText.toLowerCase().includes(category) || (category === 'all' && btn.innerText === 'Show All')) {
                    btn.classList.add('active');
                }
            }

            // 2. Filter Images
            for (let i = 0; i < items.length; i++) {
                // Remove existing animation classes to reset
                items[i].classList.remove('show');
                
                if (category === 'all') {
                    items[i].classList.remove('hide');
                    items[i].classList.add('show');
                } else {
                    if (items[i].classList.contains(category)) {
                        items[i].classList.remove('hide');
                        items[i].classList.add('show');
                    } else {
                        items[i].classList.add('hide');
                    }
                }
            }
        }

        // Helper to scroll up when clicking bottom footer links
        function scrollToTop() {
            window.scrollTo({top: 0, behavior: 'smooth'});
        }
    </script>
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
