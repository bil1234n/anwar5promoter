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
                            tabindex="0">Quran & Azan competition in Tigray Ethiopia</a>
                        <a href="{{ url('/services_5') }}" class="nav-dropdown-menu-link w-dropdown-link"
                            tabindex="0">House of Allah projects</a>
                        <a href="{{ url('/services_6') }}" class="nav-dropdown-menu-link w-dropdown-link"
                            tabindex="0">Anwar5 Foundation (ወላጅ አልባ ህፃናት ና አረጋዊያን የመረጃ ማእከል)</a>
                        <a href="{{ url('/services_7') }}" class="nav-dropdown-menu-link w-dropdown-link"
                            tabindex="0">Legal Outreach works collaboration (ህጋዊ ጉዳዬች የማስፈፀም ሰራዎች)</a>
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
            <a href="{{ url('/payment') }}" class="profile_icon nav-link">
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


    // notifcation   
    document.addEventListener("DOMContentLoaded", function() {

        const notifIcon = document.getElementById("notifIcon");
        const notifDropdown = document.getElementById("notifDropdown");
        const notifList = document.getElementById("notifList");
        const notifCount = document.getElementById("notifCount");
        const closeNotif = document.getElementById("closeNotif");

        function loadNotifications() {
            fetch("/notifications/fetch")
                .then(res => res.json())
                .then(data => {

                    notifList.innerHTML = "";

                    if (data.length === 0) {
                        notifList.innerHTML = `
                            <div style="padding: 10px; text-align:center; color: gray;">
                                No new notifications
                            </div>
                        `;
                        notifCount.style.display = "none";
                        return;
                    }

                    notifCount.innerText = data.length;
                    notifCount.style.display = "inline-block";

                    data.forEach(notif => {
                        notifList.innerHTML += `
                            <div class="notif-item notif-item-unread">
                                <p><strong>${notif.type.toUpperCase()}</strong></p>
                                <p>${notif.message}</p>

                                <!-- ADD 'markReadBtn' CLASS HERE -->
                                <button class="blue_btn markReadBtn" data-id="${notif.id}">
                                    Mark as Read
                                </button>

                                <small>${new Date(notif.created_at).toLocaleString()}</small>
                            </div>
                        `;
                    });
                });
        }

        // Show dropdown
        notifIcon.addEventListener("click", (e) => {
            // Optional: Prevent this click from triggering the document close event immediately
            e.stopPropagation();
            notifDropdown.style.display = "block";
            loadNotifications();
        });

        // Close dropdown via 'Close' button
        // Ensure closeNotif exists to avoid errors if the button is missing
        if (closeNotif) {
            closeNotif.addEventListener("click", () => {
                notifDropdown.style.display = "none";
            });
        }

        // NEW: Close dropdown when clicking outside
        document.addEventListener("click", function(event) {
            // Check if the dropdown is currently visible
            if (notifDropdown.style.display === "block") {

                // If the click is NOT inside the dropdown AND NOT on the icon
                if (!notifDropdown.contains(event.target) && !notifIcon.contains(event.target)) {
                    notifDropdown.style.display = "none";
                }
            }
        });

        // Mark as read (AJAX)
        document.addEventListener("click", function(e) {
            if (e.target.classList.contains("markReadBtn")) {
                let id = e.target.getAttribute("data-id");

                // Optional: Prevent the dropdown from closing when clicking 'Mark as Read'
                // e.stopPropagation(); 

                fetch(`/notifications/read/${id}`, {
                        method: "POST",
                        headers: {
                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                        }
                    })
                    .then(res => res.json())
                    .then(() => {
                        loadNotifications();
                    });
            }
        });

        // Auto-load badge on every page
        loadNotifications();
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

