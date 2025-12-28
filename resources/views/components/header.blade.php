@php
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Storage;

    $isLoggedIn = Auth::check();
    $user = $isLoggedIn ? Auth::user() : null;

    // 1. ALWAYS start with your local default image
    // This ensures if anything fails, or if the user has no photo, this one shows.
    $profile_p = asset('assets/img/users.png'); 
    $username = 'Guest';

    if ($isLoggedIn) {
        // 2. Only use Cloudinary if:
        //    a) The user has a profile_p value in the DB
        //    b) AND that value is NOT the text 'default.png'
        if (!empty($user->profile_p) && $user->profile_p !== 'users.png') {
            $profile_p = Storage::url($user->profile_p);
        }

        if (!empty($user->username)) {
            $username = $user->username;
        }
    }
@endphp


<!--=============== REMIXICONS ===============-->
<link rel="stylesheet" href="{{ 'https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.5.0/remixicon.css' }}">

<div class="navbar-wrapper">
    <a href="{{ url('/') }}" aria-current="page" class="navbar-brand w-nav-brand w--current" aria-label="home">
        <img src="{{ asset('assets/img/logo/logo_a_3.png') }}" loading="lazy" alt="" class="nav-logo"></a>
    <nav role="navigation" class="nav-menu w-nav-menu">
        <div class="nav-link-flex">

            @if ($isLoggedIn && $user->role === 'admin')
                <a href="{{ url('/admin/dashboard') }}" aria-current="page"
                    class="nav-link w-nav-link w--current">Dashboard</a>
                <a href="{{ url('/events') }}" class="nav-link w-nav-link">Events</a>
                <a href="{{ url('/blogs') }}" class="nav-link w-nav-link">Blog</a>
                <a href="{{ url('/admin/donations') }}" class="nav-link w-nav-link">Donations</a>
                <a href="{{ url('/admin/users') }}" class="nav-link w-nav-link">Users</a>
            @else
                <a href="{{ url('/about') }}" class="nav-link w-nav-link w--current">About</a>
                <!-- 1. The Dropdown (Visible on Desktop/Tablet, Hidden on Phone) -->
                <div data-hover="true" data-delay="0" class="nav-link dropdown-nav w-dropdown desktop-only-dropdown">
                    <div class="nav-dropdown-toggle w-dropdown-toggle" id="w-dropdown-toggle-0"
                        aria-controls="w-dropdown-list-0" aria-haspopup="menu" aria-expanded="false" role="button"
                        tabindex="0">
                        <div>Services</div>
                        <div class="nav-dropdown-icon w-icon-dropdown-toggle" aria-hidden="true"></div>
                    </div>
                    <nav class="nav-dropdown-list w-dropdown-list" id="w-dropdown-list-0"
                        aria-labelledby="w-dropdown-toggle-0">
                        <a href="{{ url('/services_1') }}" class="nav-dropdown-menu-link w-dropdown-link"
                            tabindex="0">Halal business & products promoting & selling</a>
                        <a href="{{ url('/services_2') }}" class="nav-dropdown-menu-link w-dropdown-link"
                            tabindex="0">Events organizing & Digital Marketing</a>
                        <a href="{{ url('/services_3') }}" class="nav-dropdown-menu-link w-dropdown-link"
                            tabindex="0">Website, App & System Development</a>
                        <a href="{{ url('/services_4') }}" class="nav-dropdown-menu-link w-dropdown-link"
                            tabindex="0">House of Allah projects</a>
                        <a href="{{ url('/services_5') }}" class="nav-dropdown-menu-link w-dropdown-link"
                            tabindex="0">Quran & Azan competition in Tigray Ethiopia</a>
                        <a href="{{ url('/services_6') }}" class="nav-dropdown-menu-link w-dropdown-link"
                            tabindex="0">Anwar5 Foundation (ወላጅ አልባ ህፃናት ና አረጋዊያን የመረጃ ማእከል)</a>
                        <a href="{{ url('/services_8') }}" class="nav-dropdown-menu-link w-dropdown-link"
                            tabindex="0">Anwar 5 Tour & Galleries</a>
                    </nav>
                </div>

                <!-- 2. The Single Link (Hidden on Desktop, Visible on Phone) -->
                <a href="{{ url('/services') }}" class="nav-link w-nav-link mobile-only-link">Services</a>
                <a href="{{ url('/blog') }}" class="nav-link w-nav-link">Blog</a>
                <a href="{{ url('/event') }}" class="nav-link w-nav-link">Event</a>
            @endif
        </div>
        <div class="nav-button-flex">
            {{-- socialMedia --}}
            <a href="{{ url('/socialMedia') }}" class="profile_icon nav-link">
                <i class="ri-youtube-line"></i>
            </a>

            {{-- donation --}}
            <a href="{{ route('donate.form') }}" class="profile_icon nav-link">
                <i class="ri-hand-coin-line"></i>
            </a>

            {{-- google language translator --}}
            <div>
                <!-- Hidden Google Element (Do not remove, just hidden) -->
                <div id="google_translate_element"></div>

                <!-- Your Custom Professional Button -->
                <div class="custom-lang-switcher" id="langSwitcher">
                    <!-- The Icon Button -->
                    <button class="lang-btn profile_icon nav-link" onclick="toggleLangMenu()">
                        <!-- SVG Icon for 'Language' (Globe) -->
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"></circle>
                            <line x1="2" y1="12" x2="22" y2="12"></line>
                            <path
                                d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z">
                            </path>
                        </svg>
                    </button>

                    <!-- The Dropdown Menu -->
                    <ul class="lang-dropdown">
                        <li>
                            <a onclick="triggerHtmlEvent('en')">🇺🇸 English</a>
                        </li>
                        <li>
                            <a onclick="triggerHtmlEvent('am')">🇪🇹 አማርኛ (Amharic)</a>
                        </li>
                    </ul>
                </div>
            </div>

            {{-- users icon --}}
            <div class="profile_dropdown">
                <div class="profile_icon nav-link">
                    <i class=""></i>
                    @if ($isLoggedIn)
                        <img src="{{ $profile_p }}" alt="Profile Picture" class="profile-button"
                            id="profile-button">
                    @else
                        <i class="ri-account-circle-line profile-button" id="profile-button"></i>
                    @endif
                </div>

                <div class="dropdown-menu" id="dropdown-menu">
                    @if ($isLoggedIn)
                        <img class="profile_img" src="{{ $profile_p }}" alt="Profile Picture" width="100">
                        <br>
                        <p>Welcome, <strong>{{ $username }}</strong></p>
                        <div class="d-f">
                            <a class="blue_btn" href="{{ url('/profile') }}">Profile</a>
                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                class="red_btn">Logout</a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                style="display: none;">
                                @csrf
                            </form>
                        </div>
                    @else
                        <p>Please Login or Register</p>
                        <div class="d-f">
                            <a class="blue_btn" href="{{ route('login') }}">Login</a>
                            <a class="btn-success" href="{{ route('register') }}">Register</a>
                        </div>
                    @endif
                </div>
            </div>

            {{-- noitifaction --}}
            <div style="position: relative;">
                <div class="nav-link w-nav-link" id="notifIcon" style="cursor:pointer;">
                    <i class="ri-notification-2-line"></i>
                    <span id="notifCount" class="notif-badge" style="display:none;"></span>
                </div>

                <div id="notifDropdown" class="notif-dropdown">
                    <span class="notif-close" id="closeNotif">✖</span>
                    <h4>Notifications</h4>
                    <div id="notifList"></div>
                </div>
            </div>

            @if ($isLoggedIn && $user->role === 'admin')
                <a href="{{ url('/messages') }}" class="primary-button nav-bar w-button">Messages</a>
            @else
                <a href="{{ url('/contact') }}" class="primary-button nav-bar w-button">ContactUs</a>
            @endif
        </div>
    </nav>
    <div class="menu-button w-nav-button" style="-webkit-user-select: text;" aria-label="menu" role="button"  tabindex="0" aria-controls="w-nav-overlay-0" aria-haspopup="menu" aria-expanded="false">
        <div class="w-icon-nav-menu"></div>
    </div>
</div>

<!-- PROFESSIONAL WHATSAPP WIDGET START -->
<style>
    /* 1. The Floating Icon Button */
    .wa-widget-toggle {
        position: fixed;
        bottom: 20px;
        right: 20px;
        width: 60px;
        height: 60px;
        background-color: #25D366;
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        cursor: pointer;
        z-index: 9999;
        transition: transform 0.3s ease;
    }
    .wa-widget-toggle:hover {
        transform: scale(1.1);
    }
    
    /* 2. The Chat Box Container */
    .wa-chat-box {
        position: fixed;
        bottom: 90px;
        right: 20px;
        width: 350px; /* Width of the chat box */
        background: white;
        border-radius: 12px;
        box-shadow: 0 5px 25px rgba(0,0,0,0.2);
        overflow: hidden;
        z-index: 9998;
        display: none; /* Hidden by default */
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
        opacity: 0;
        transform: translateY(20px);
        transition: all 0.3s ease;
    }

    /* Animation class when opened */
    .wa-chat-box.active {
        display: block;
        opacity: 1;
        transform: translateY(0);
    }

    /* 3. Header Section ("Get in touch") */
    .wa-chat-header {
        background-color: #075E54;
        color: white;
        padding: 20px;
        text-align: center;
    }
    .wa-chat-header h3 {
        color: #fff;
        margin: 0;
        font-size: 18px;
        font-weight: 600;
    }
    .wa-chat-header .close-btn {
        position: absolute;
        top: 15px;
        right: 15px;
        cursor: pointer;
        font-size: 20px;
        opacity: 0.8;
    }

    /* 4. Body Section (Promoter Name & Message) */
    .wa-chat-body {
        padding: 20px;
        background-color: #e5ddd5; /* WhatsApp Chat Background Color */
        background-image: url('https://user-images.githubusercontent.com/15075759/28719144-86dc0f70-73b1-11e7-911d-60d70fcded21.png'); /* Optional WhatsApp Pattern */
        background-blend-mode: overlay;
    }

    /* The Message Bubble */
    .wa-msg-bubble {
        background: white;
        padding: 15px;
        border-radius: 0px 10px 10px 10px;
        box-shadow: 0 1px 2px rgba(0,0,0,0.1);
        position: relative;
        margin-bottom: 20px;
    }
    /* Small triangle on the left */
    .wa-msg-bubble::before {
        content: "";
        position: absolute;
        left: -10px;
        top: 0;
        width: 0;
        height: 0;
        border-top: 10px solid white;
        border-left: 10px solid transparent;
    }

    .wa-promoter-name {
        font-size: 14px;
        font-weight: bold;
        color: #e542a3; /* Or your brand color, or standard #075e54 */
        margin-bottom: 5px;
        display: block;
    }
    .wa-msg-text {
        font-size: 15px;
        color: #111;
        line-height: 1.4;
    }
    .wa-time {
        font-size: 11px;
        color: #999;
        text-align: right;
        display: block;
        margin-top: 5px;
    }

    /* 5. Footer Button ("Click to start chat") */
    .wa-chat-footer {
        padding: 15px;
        background: white;
        text-align: center;
    }
    .wa-btn-start {
        display: block;
        background-color: #25D366;
        color: white;
        text-decoration: none;
        padding: 12px;
        border-radius: 25px;
        font-weight: bold;
        font-size: 16px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        transition: background 0.3s;
    }
    .wa-btn-start:hover {
        background-color: #128C7E;
        color: white;
        text-decoration: none;
    }
</style>

<!-- HTML STRUCTURE -->
<div id="wa-widget-container">
    
    <!-- 1. The Chat Popup Window -->
    <div class="wa-chat-box" id="wa-box">
        <!-- Header -->
        <div class="wa-chat-header">
            <h3><i class="ri-whatsapp-line"></i>&nbsp; Get in touch</h3>
            <span class="close-btn" onclick="toggleWaChat()">×</span>
        </div>

        <!-- Body (The Message) -->
        <div class="wa-chat-body">
            <div class="wa-msg-bubble">
                <span class="wa-promoter-name">Anwar5Promoter</span>
                <div class="wa-msg-text">
                    Hey, how can i help you today?
                </div>
                <span class="wa-time">Just now</span>
            </div>
        </div>

        <!-- Footer (The Button) -->
        <div class="wa-chat-footer">
            <!-- REPLACE PHONE NUMBER BELOW (Format: No + or spaces, e.g., 251911000000) -->
            <a href="https://wa.me/251912164433?text=Anwar5Promoter" target="_blank" class="wa-btn-start">
                <i class="ri-whatsapp-line"></i> Click to start chat
            </a>
        </div>
    </div>

    <!-- 2. The Floating Button (Bottom Right) -->
    <div class="wa-widget-toggle" onclick="toggleWaChat()">
        <!-- WhatsApp SVG Icon -->
        <i style="font-size: 34px" class="ri-whatsapp-line"></i>
    </div>
</div>

<!-- JAVASCRIPT LOGIC -->
<script>
    function toggleWaChat() {
        var chatBox = document.getElementById('wa-box');
        if (chatBox.style.display === 'none' || chatBox.style.display === '') {
            chatBox.style.display = 'block';
            setTimeout(() => { chatBox.classList.add('active'); }, 10); // Trigger transition
        } else {
            chatBox.classList.remove('active');
            setTimeout(() => { chatBox.style.display = 'none'; }, 300); // Wait for transition
        }
    }
</script>
<!-- PROFESSIONAL WHATSAPP WIDGET END -->

<!--==================== SCRIPT ====================-->
<script>
    // users dropdown
    document.addEventListener("DOMContentLoaded", function() {
        const profileButton = document.getElementById("profile-button");
        const dropdownMenu = document.getElementById("dropdown-menu");

        profileButton.addEventListener("click", function(event) {
            event.stopPropagation();
            dropdownMenu.style.display = dropdownMenu.style.display === "block" ? "none" : "block";
        });

        document.addEventListener("click", function(event) {
            if (!profileButton.contains(event.target) && !dropdownMenu.contains(event.target)) {
                dropdownMenu.style.display = "none";
            }
        });
    });

    
    // NOTIFICATION SCRIPT
    document.addEventListener("DOMContentLoaded", function() {

        // 1. Select DOM Elements
        const notifIcon = document.getElementById("notifIcon");
        const notifDropdown = document.getElementById("notifDropdown");
        const notifList = document.getElementById("notifList");
        const notifCount = document.getElementById("notifCount");
        const closeNotif = document.getElementById("closeNotif");

        // 2. Define the Function to Fetch Data
        function loadNotifications() {
            fetch("{{ url('/notifications/fetch') }}")
                .then(res => {
                    // Check if response is JSON, otherwise authentication might have failed
                    if (!res.ok) throw new Error("Failed to fetch");
                    return res.json();
                })
                .then(data => {
                    notifList.innerHTML = "";

                    // Case: No Notifications
                    if (data.length === 0) {
                        notifList.innerHTML = `
                            <div style="padding: 10px; text-align:center; color: gray;">
                                No new notifications
                            </div>
                        `;
                        notifCount.style.display = "none";
                        return;
                    }

                    // Case: Have Notifications -> Update Badge
                    notifCount.innerText = data.length;
                    notifCount.style.display = "inline-block";

                    // Build the List HTML
                    data.forEach(notif => {
                        // Format Date nicely
                        const dateStr = new Date(notif.created_at).toLocaleString();
                        
                        notifList.innerHTML += `
                            <div class="notif-item">
                                <p><strong>${notif.type.toUpperCase()}</strong></p>
                                <p>${notif.message}</p>

                                <button class="blue_btn markReadBtn" data-id="${notif.id}">
                                    Mark as Read
                                </button>

                                <br>
                                <small style="font-size:0.8rem; color:#888;">${dateStr}</small>
                            </div>
                            <hr style="margin: 5px 0; opacity:0.3;">
                        `;
                    });
                })
                .catch(error => console.error("Notification Error:", error));
        }

        // 3. Toggle Dropdown when Icon is clicked
        if (notifIcon) {
            notifIcon.addEventListener("click", (e) => {
                e.stopPropagation(); // Stop click from reaching document
                if (notifDropdown.style.display === "block") {
                    notifDropdown.style.display = "none";
                } else {
                    notifDropdown.style.display = "block";
                    // Optional: Refresh list when opening
                    // loadNotifications(); 
                }
            });
        }

        // 4. Close Dropdown via 'X' button
        if (closeNotif) {
            closeNotif.addEventListener("click", () => {
                notifDropdown.style.display = "none";
            });
        }

        // 5. Close dropdown when clicking OUTSIDE
        document.addEventListener("click", function(event) {
            if (notifDropdown.style.display === "block") {
                if (!notifDropdown.contains(event.target) && !notifIcon.contains(event.target)) {
                    notifDropdown.style.display = "none";
                }
            }
        });

        // 6. Handle "Mark as Read" clicks
        document.addEventListener("click", function(e) {
            if (e.target.classList.contains("markReadBtn")) {
                e.preventDefault(); // Prevent default button behavior
                
                let id = e.target.getAttribute("data-id");
                
                // Call backend to mark as read
                fetch("{{ url('/notifications/read') }}/" + id, {
                        method: "POST",
                        headers: {
                            "X-CSRF-TOKEN": "{{ csrf_token() }}",
                            "Content-Type": "application/json"
                        }
                    })
                    .then(res => res.json())
                    .then(() => {
                        // Reload the list to remove the item or update UI
                        loadNotifications();
                    })
                    .catch(err => console.error("Error marking read:", err));
            }
        });

        // ============================================================
        // CRITICAL FIX: Only run fetch if user is logged in
        // This prevents the "redirect to json" issue upon login
        // ============================================================
        @if(Auth::check())
            loadNotifications();
            
            // Optional: Auto-refresh every 60 seconds
            // setInterval(loadNotifications, 60000); 
        @endif
    });
</script>

<script type="text/javascript">
    // 1. Initialize Google Translate (Hidden)
    function googleTranslateElementInit() {
        new google.translate.TranslateElement({
            pageLanguage: 'en',
            includedLanguages: 'en,am',
            autoDisplay: false
        }, 'google_translate_element');
    }
</script>

<!-- Load Google Script -->
<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit">
</script>

<script type="text/javascript">
    // 2. Function to toggle the Dropdown
    function toggleLangMenu() {
        var switcher = document.getElementById('langSwitcher');
        switcher.classList.toggle('active');
    }

    // 3. Close dropdown if user clicks outside
    window.onclick = function(event) {
        if (!event.target.closest('.custom-lang-switcher')) {
            var switcher = document.getElementById('langSwitcher');
            if (switcher.classList.contains('active')) {
                switcher.classList.remove('active');
            }
        }
    }

    // 4. The Magic: Trigger Google Translate when user clicks your custom links
    function triggerHtmlEvent(langCode) {
        // Find the hidden Google select box
        var select = document.querySelector('.goog-te-combo');

        if (select) {
            select.value = langCode; // Set the value (en or am)

            // Dispatch the change event so Google detects it
            select.dispatchEvent(new Event('change'));
        }

        // Close the menu
        toggleLangMenu();
    }
</script>

