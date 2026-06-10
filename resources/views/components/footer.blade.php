<div class="relative pt-16 overflow-hidden" style="background: linear-gradient(180deg, #c8dff0 0%, #7aafd6 40%, #4a82ad 100%);">

    <!-- Footer -->
    <footer     
        data-aos="fade-up"
        data-aos-offset="120"
        data-aos-duration="1200"
        data-aos-easing="ease-out-cubic"
        class="relative z-20">

        <div class="bg-white rounded-t-[80px] pt-16 pb-20 px-8 md:px-24 min-h-[300px] shadow-[0_-10px_40px_rgba(255,255,255,0.25)]">

            <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-12 md:gap-20 justify-items-center">

                <!-- Kolom 1 -->
                <div class="space-y-6 md:max-w-sm">

                    <!-- Logo -->
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 bg-blue-900 rounded-sm flex items-center justify-center">
                            <span class="text-white font-bold text-xs">{{ $pageContents['footer']['footer_logo_mark'] ?? ($siteSettings['logo_mark'] ?? 'P') }}</span>
                        </div>

                        <h3 class="text-2xl font-bold text-[#1A2E5A]">
                            {{ $pageContents['footer']['footer_brand_label'] ?? ($siteSettings['footer_logo_text'] ?? 'Logo') }}
                        </h3>
                    </div>

                    <!-- Description -->
                    <p class="text-gray-500 text-sm leading-relaxed max-w-sm">
                        {{ $pageContents['footer']['footer_description'] ?? ($siteSettings['footer_description'] ?? 'Cari peluang baru, upgrade skill, dan raih pengalaman terbaik bersama JTIFY.') }}
                    </p>

                    <!-- Social -->
                    <div>
                        <p class="font-bold text-[#1A2E5A] mb-4 text-sm">
                            {{ $pageContents['footer']['footer_social_label'] ?? 'Follow Us:' }}
                        </p>
                        <div class="flex gap-4">

                            <!-- Instagram -->
                            <a href="{{ $pageContents['footer']['footer_instagram_url'] ?? ($siteSettings['social_instagram_url'] ?? 'https://www.instagram.com/jtipolinema') }}"
                                target="_blank"
                                class="w-10 h-10 border border-gray-200 rounded-lg flex items-center justify-center hover:bg-gray-50 hover:-translate-y-1 transition-all duration-300 shadow-sm">

                                <img src="https://img.icons8.com/ios-glyphs/24/1A2E5A/instagram-new.png"
                                    alt="Instagram"/>
                            </a>

                            <!-- X -->
                            <a href="{{ $pageContents['footer']['footer_x_url'] ?? ($siteSettings['social_x_url'] ?? 'https://x.com/polinema_campus') }}"
                                target="_blank"
                                class="w-10 h-10 border border-gray-200 rounded-lg flex items-center justify-center hover:bg-gray-50 hover:-translate-y-1 transition-all duration-300 shadow-sm">

                                <img src="https://img.icons8.com/ios-glyphs/24/1A2E5A/twitter.png"
                                    alt="X"/>
                            </a>

                            <!-- YouTube -->
                            <a href="{{ $pageContents['footer']['footer_youtube_url'] ?? ($siteSettings['social_youtube_url'] ?? 'https://www.youtube.com/@jtipolinema367') }}"
                                target="_blank"
                                class="w-10 h-10 border border-gray-200 rounded-lg flex items-center justify-center hover:bg-gray-50 hover:-translate-y-1 transition-all duration-300 shadow-sm">

                                <img src="https://img.icons8.com/ios-glyphs/24/1A2E5A/youtube-play.png"
                                    alt="YouTube"/>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Kolom 2 -->
                <div class="w-full md:w-auto">

                    <h4 class="font-bold text-[#1A2E5A] mb-8 text-lg">
                        {{ $pageContents['footer']['footer_home_title'] ?? 'Beranda' }}
                    </h4>

                    <ul class="space-y-5">

                        <!-- Lomba -->
                        <li>
                            <a href="/lomba"
                                class="flex items-center gap-3 text-[#3B4C7E] hover:text-blue-900 hover:translate-x-1 transition-all duration-300 text-sm font-medium">

                                <img src="https://img.icons8.com/ios-glyphs/20/1A2E5A/trophy.png"
                                    alt="Lomba"
                                    class="w-5 h-5"/>

                                {{ $pageContents['footer']['footer_lomba_label'] ?? 'Informasi Lomba' }}
                            </a>
                        </li>

                        <!-- Seminar -->
                        <li>
                            <a href="/seminar"
                                class="flex items-center gap-3 text-[#3B4C7E] hover:text-blue-900 hover:translate-x-1 transition-all duration-300 text-sm font-medium">

                                <img src="https://img.icons8.com/ios-glyphs/20/1A2E5A/megaphone.png"
                                    alt="Seminar"
                                    class="w-5 h-5"/>

                                {{ $pageContents['footer']['footer_seminar_label'] ?? 'Informasi Seminar' }}
                            </a>
                        </li>

                        <!-- Beasiswa -->
                        <li>
                            <a href="/beasiswa"
                                class="flex items-center gap-3 text-[#3B4C7E] hover:text-blue-900 hover:translate-x-1 transition-all duration-300 text-sm font-medium">

                                <img src="https://img.icons8.com/ios-glyphs/20/1A2E5A/graduation-cap.png"
                                    alt="Beasiswa"
                                    class="w-5 h-5"/>

                                {{ $pageContents['footer']['footer_beasiswa_label'] ?? 'Informasi Beasiswa' }}
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Kolom 3 -->
                <div class="w-full md:w-auto">
                    <h4 class="font-bold text-[#1A2E5A] mb-8 text-lg">
                        {{ $pageContents['footer']['footer_feature_title'] ?? 'Feature' }}
                    </h4>
                    <ul class="space-y-5">

                        <!-- Bookmark -->
                        <li>
                            <a href="/bookmark"
                                class="flex items-center gap-3 text-[#3B4C7E] hover:text-blue-900 hover:translate-x-1 transition-all duration-300 text-sm font-medium">

                                <img src="https://img.icons8.com/ios-glyphs/20/1A2E5A/bookmark.png"
                                    alt="Bookmark"
                                    class="w-5 h-5"/>

                                {{ $pageContents['footer']['footer_bookmark_label'] ?? 'Bookmark' }}
                            </a>
                        </li>

                        <!-- Diminati -->
                        <li>
                            <a href="/peminatan"
                                class="flex items-center gap-3 text-[#3B4C7E] hover:text-blue-900 hover:translate-x-1 transition-all duration-300 text-sm font-medium">

                                <img src="https://img.icons8.com/ios-glyphs/30/1A2E5A/like--v1.png"
                                    alt="Diminati"
                                    class="w-5 h-5"/>

                                {{ $pageContents['footer']['footer_diminati_label'] ?? 'Diminati' }}
                            </a>
                        </li>

                        <!-- Feedback -->
                        <li>
                            <a href="/feedback"
                                class="flex items-center gap-3 text-[#3B4C7E] hover:text-blue-900 hover:translate-x-1 transition-all duration-300 text-sm font-medium">

                                <img src="https://img.icons8.com/ios-glyphs/20/1A2E5A/filled-topic.png"
                                    alt="Feedback"
                                    class="w-5 h-5"/>

                                {{ $pageContents['footer']['footer_feedback_label'] ?? 'Feedback' }}
                            </a>
                        </li>

                    </ul>

                </div>

            </div>

        </div>
    </footer>

</div>