  @php
    use Illuminate\Support\Facades\Auth;

    $isLoggedIn = Auth::check();
    $user = $isLoggedIn ? Auth::user() : null;

@endphp

<div class="footer">
    <div class="container w-container">
        <div class="footer-wrap">
            <div class="w-layout-grid footer-grid">
                <div id="w-node-a4d201cf-cd7b-7cf6-df07-f5f6966cebbc-966cebb8"
                    data-w-id="a4d201cf-cd7b-7cf6-df07-f5f6966cebbc" class="footer-cta-wrap" style="opacity: 0;"><a
                        href="index.html" aria-current="page" class="footer-logo w-inline-block w--current"><img
                            src="{{ asset('assets/img/logo/logo_a_3.png') }}"
                            loading="lazy" alt=""></a>
                    <div>
                        <h3 class="footer-title">Subscribe Now</h3>
                        <p class="footer-cta-content">We assists with all aspects to let your page be in first.</p>
                    </div>
                    <div class="subscribe-form w-form">
                        <form id="wf-form-Footer-Subscribe-Form" name="wf-form-Footer-Subscribe-Form"
                            data-name="Footer Subscribe Form" method="get" class="footer-cta-subcribe-wrap"
                            data-wf-page-id="633fc9cf3a4f10cced60830c"
                            data-wf-element-id="a4d201cf-cd7b-7cf6-df07-f5f6966cebc7"
                            aria-label="Footer Subscribe Form"><input class="hero-form-input w-input"
                                maxlength="256" name="Footer-Cta-2" data-name="Footer Cta 2"
                                aria-label="Enter your email" placeholder="Enter Your Email..." type="email"
                                id="Footer-Cta-2" required=""><input type="submit" data-wait="Please wait..."
                                class="yellow-button w-button" value="Subscribe"></form>
                        <div class="success-message w-form-done" tabindex="-1" role="region"
                            aria-label="Footer Subscribe Form success">
                            <div>Thank you! Your submission has been received!</div>
                        </div>
                        <div class="error-message w-form-fail" tabindex="-1" role="region"
                            aria-label="Footer Subscribe Form failure">
                            <div>Oops! Something went wrong while submitting the form.</div>
                        </div>
                    </div>
                </div>
                <div id="w-node-a4d201cf-cd7b-7cf6-df07-f5f6966cebd0-966cebb8" class="footer-content-wrap">
                    <div class="footer-contact-wrap">
                        <div data-w-id="a4d201cf-cd7b-7cf6-df07-f5f6966cebd2" class="footer-contact"
                            style="opacity: 0;">
                            <div class="footer-contact-flex"><img
                                    src="https://cdn.prod.website-files.com/633fc9cf3a4f100f9060830b/6340062b46bbfb2ee3cfbee3_phone.svg"
                                    loading="lazy" alt="Footer Link Title Image">
                                <h3 class="footer-title">Get in touch with</h3>
                            </div><a href="tel:+251912164433" class="footer-phone-link w-inline-block">
                                <div>+251912164433</div>
                            </a><a href="mailto:anwar5promoter@gmail.com"
                                class="footer-email-link">anwar5promoter@gmail.com</a>
                        </div>
                        <div data-w-id="a4d201cf-cd7b-7cf6-df07-f5f6966cebdc" class="footer-contact"
                            style="opacity: 0;">
                            <div class="footer-contact-flex"><img
                                    src="https://cdn.prod.website-files.com/633fc9cf3a4f100f9060830b/6340062bbef7e52bc9fa996f_location.svg"
                                    loading="lazy" alt="Footer Link Title Image">
                                <h3 class="footer-title">Location</h3>
                            </div>
                            <p class="footer-contact-content">Head office: Addis Ababa Betel around Teqewa Mesjed</p>
                        </div>
                    </div>
                    <div class="footer-page-wrap">
                        <div data-w-id="a4d201cf-cd7b-7cf6-df07-f5f6966cebe6" class="footer-page-flex"
                            style="opacity: 0;">
                            <div class="footer-page-title-wrap"><img
                                    src="https://cdn.prod.website-files.com/633fc9cf3a4f100f9060830b/6340062b9d98672c1ab94823_Pages.svg"
                                    loading="lazy" alt="Footer Link Title Image">
                                <h3 class="footer-title">Pages</h3>
                            </div>
                            <div class="footer-page-link-wrap">
                                <a href="{{ url('/') }}" aria-current="page"
                                class="footer-page-link w--current">Home</a>
                                <a href="{{ url('/about') }}" class="footer-page-link">About</a>
                                <a href="{{ url('/blog') }}" class="footer-page-link">Blog</a>
                                <a href="{{ url('/socialMedia') }}" class="footer-page-link">SocialMedia</a>
                                <a href="{{ url('/contact') }}" class="footer-page-link">Contact</a>
                                </div>
                        </div>
                        <div data-w-id="a4d201cf-cd7b-7cf6-df07-f5f6966cebf8" class="footer-page-flex"
                            style="opacity: 0;">
                            <div class="footer-page-title-wrap"><img
                                    src="https://cdn.prod.website-files.com/633fc9cf3a4f100f9060830b/6340062cc9f3fa33166103aa_Utility.svg"
                                    loading="lazy" alt="Footer Link Title Image">
                                <h3 class="footer-title">Services Pages</h3>
                            </div>
                            <div class="footer-page-link-wrap">
                                <a href="#" class="footer-page-link">Digital Marketing</a>
                                <a href="#" class="footer-page-link">Project Management</a>
                                <a href="#" class="footer-page-link">Business Analytics</a>
                                <a href="#" class="footer-page-link">Advertising</a>
                                <a href="#" class="footer-page-link">Event Photography & Planning</a>
                            </div>
                        </div>
                        <div data-w-id="a4d201cf-cd7b-7cf6-df07-f5f6966cec08" class="footer-page-flex" style="opacity: 0;">
                            <div class="footer-page-title-wrap">
                                <img src="https://cdn.prod.website-files.com/633fc9cf3a4f100f9060830b/6340062b14d6453a5889b8b2_follow.svg"
                                    loading="lazy" alt="Footer Link Title Image">
                                <h3 class="footer-title">Follows</h3>
                            </div>
                            <div class="footer-page-link-wrap">
                                <a href="https://web.facebook.com/Anwar5promoter/" target="_blank" class="footer-page-link">Facebook</a>
                                <a href="https://www.youtube.com/@Anwar5promoter" target="_blank" class="footer-page-link">Youtube</a>
                                <a href="https://www.instagram.com/anwar5promoter" target="_blank" class="footer-page-link">Instagram</a>
                                <a href="https://www.whatsapp.com/catalog/251912164433/?app_absent=0" target="_blank" class="footer-page-link">WhatsUp</a>
                                <a href="https://www.linkedin.com/in/anwar-abadi-20b096291/"
                                target="_blank" class="footer-page-link">LinkedIn</a>
                            </div>
                        </div>
                    </div>
                    <div data-w-id="a4d201cf-cd7b-7cf6-df07-f5f6966cec16" class="copyright-wrap"
                        style="opacity: 0;">
                        <p class="white-content">2025 Copyright © Anwar5Promoter| Designed by <a
                                href="https://bil-portfolio.netlify.app/" target="_blank"
                                class="copyright-link">Bilal Nesru</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>