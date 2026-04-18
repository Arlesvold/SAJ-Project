/**
 * Go Green School - Interactive Landing Page
 * All JavaScript functionality with try-catch error handling
 */
(function () {
    'use strict';

    // ============================================
    // UTILITIES
    // ============================================
    const $ = (sel, ctx = document) => ctx.querySelector(sel);
    const $$ = (sel, ctx = document) => [...ctx.querySelectorAll(sel)];
    const days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
    const months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

    /**
     * Safely execute a function with try-catch
     */
    function safeExecute(fn, context) {
        try {
            fn();
        } catch (error) {
            console.warn(`[GoGreen] Error in ${context}:`, error.message);
        }
    }

    // ============================================
    // 1. PAGE LOAD TOAST (Former Preloader Section)
    // ============================================
    safeExecute(function () {
        window.addEventListener('load', function () {
            try {
                showToast('Selamat Datang!', 'Selamat datang di Go Green School', 'success');
            } catch (e) {
                console.warn('[GoGreen] Toast error:', e.message);
            }
        });
    }, 'Page Load Toast');

    // ============================================
    // 2. DYNAMIC DATE & LIVE CLOCK
    // ============================================
    safeExecute(function () {
        const dateEl = $('#currentDate');
        const clockEl = $('#liveClock');

        function updateDateTime() {
            try {
                const now = new Date();
                if (dateEl) {
                    dateEl.textContent = days[now.getDay()] + ', ' + now.getDate() + ' ' + months[now.getMonth()] + ' ' + now.getFullYear();
                }
                if (clockEl) {
                    var h = String(now.getHours()).padStart(2, '0');
                    var m = String(now.getMinutes()).padStart(2, '0');
                    var s = String(now.getSeconds()).padStart(2, '0');
                    clockEl.innerHTML = '<i class="far fa-clock"></i> ' + h + ':' + m + ':' + s + ' WIB';
                }
            } catch (e) {
                console.warn('[GoGreen] Clock update error:', e.message);
            }
        }

        updateDateTime();
        setInterval(updateDateTime, 1000);
    }, 'DateTime');

    // ============================================
    // 3. SCROLL PROGRESS BAR
    // ============================================
    var scrollProgress = null;
    safeExecute(function () {
        scrollProgress = $('#scrollProgress');
    }, 'ScrollProgress init');

    function updateScrollProgress() {
        try {
            if (!scrollProgress) return;
            var scrollTop = window.scrollY;
            var docHeight = document.documentElement.scrollHeight - window.innerHeight;
            if (docHeight > 0) {
                var scrollPercent = (scrollTop / docHeight) * 100;
                scrollProgress.style.width = scrollPercent + '%';
            }
        } catch (e) {
            console.warn('[GoGreen] Scroll progress error:', e.message);
        }
    }

    // ============================================
    // 4. HEADER SHRINK ON SCROLL + BACK TO TOP
    // ============================================
    var header = null;
    var backToTop = null;
    var shapes = [];

    safeExecute(function () {
        header = $('.header');
        backToTop = $('#backToTop');
        shapes = $$('.hero-bg-shapes .shape');

        function handleScroll() {
            try {
                var scrollY = window.scrollY;

                if (header) {
                    if (scrollY > 80) {
                        header.classList.add('shrink');
                    } else {
                        header.classList.remove('shrink');
                    }
                }

                if (backToTop) {
                    if (scrollY > 400) {
                        backToTop.classList.add('visible');
                    } else {
                        backToTop.classList.remove('visible');
                    }
                }

                updateScrollProgress();
                updateParallax(scrollY);
            } catch (e) {
                console.warn('[GoGreen] Scroll handler error:', e.message);
            }
        }

        window.addEventListener('scroll', handleScroll, { passive: true });

        if (backToTop) {
            backToTop.addEventListener('click', function () {
                window.scrollTo({ top: 0, behavior: 'smooth' });
            });
        }
    }, 'Header/Scroll');

    // ============================================
    // 5. PARALLAX EFFECT ON HERO SHAPES
    // ============================================
    function updateParallax(scrollY) {
        try {
            var heroEl = $('.hero');
            if (!heroEl || shapes.length === 0) return;
            var heroHeight = heroEl.offsetHeight;
            if (scrollY < heroHeight) {
                var factor = scrollY / heroHeight;
                shapes.forEach(function (shape, i) {
                    var speed = (i + 1) * 30;
                    shape.style.transform = 'translateY(' + (factor * speed) + 'px) rotate(' + (factor * 20) + 'deg)';
                });

                // Subtle hero background parallax for the active slide on desktop devices.
                if (window.innerWidth > 768) {
                    var activeSlide = $('.hero-slide.active');
                    if (activeSlide) {
                        var offset = (factor * 90).toFixed(2);
                        activeSlide.style.backgroundPosition = 'center calc(50% + ' + offset + 'px)';
                    }
                }
            }
        } catch (e) {
            // Silently ignore parallax errors
        }
    }

    // ============================================
    // 6. MOBILE MENU TOGGLE
    // ============================================
    safeExecute(function () {
        var hamburger = $('#hamburger');
        var navMenu = $('#navMenu');

        if (hamburger && navMenu) {
            hamburger.addEventListener('click', function () {
                try {
                    navMenu.classList.toggle('open');
                    var icon = hamburger.querySelector('i');
                    if (icon) {
                        icon.classList.toggle('fa-bars');
                        icon.classList.toggle('fa-times');
                    }
                } catch (e) {
                    console.warn('[GoGreen] Menu toggle error:', e.message);
                }
            });
        }
    }, 'MobileMenu');

    // ============================================
    // 7. HERO SLIDER WITH TOUCH/SWIPE
    // ============================================
    var slides = [];
    var dots = [];
    var currentSlide = 0;
    var slideInterval = null;
    var touchStartX = 0;

    safeExecute(function () {
        slides = $$('.hero-slide');
        dots = $$('.hero-dot');

        if (slides.length === 0) return;

        function showSlide(index) {
            try {
                slides.forEach(function (s) {
                    s.classList.remove('active');
                    s.style.animation = 'none';
                });
                dots.forEach(function (d) { d.classList.remove('active'); });
                slides[index].classList.add('active');
                slides[index].style.animation = 'heroFadeIn .8s ease';
                if (dots[index]) dots[index].classList.add('active');
                currentSlide = index;
            } catch (e) {
                console.warn('[GoGreen] Slide show error:', e.message);
            }
        }

        function nextSlide() {
            showSlide((currentSlide + 1) % slides.length);
        }

        function prevSlide() {
            showSlide((currentSlide - 1 + slides.length) % slides.length);
        }

        dots.forEach(function (dot) {
            dot.addEventListener('click', function () {
                try {
                    showSlide(parseInt(dot.dataset.slide, 10));
                    resetAutoSlide();
                } catch (e) {
                    console.warn('[GoGreen] Dot click error:', e.message);
                }
            });
        });

        function startAutoSlide() {
            if (!slideInterval) {
                slideInterval = setInterval(nextSlide, 5000);
            }
        }

        function stopAutoSlide() {
            if (slideInterval) {
                clearInterval(slideInterval);
                slideInterval = null;
            }
        }

        function resetAutoSlide() {
            stopAutoSlide();
            startAutoSlide();
        }

        startAutoSlide();

        // Touch/Swipe support
        var heroEl = $('.hero');
        if (heroEl) {
            // Mencegah slider berpindah saat cursor ditahan
            heroEl.addEventListener('mousedown', function () {
                stopAutoSlide();
            });
            heroEl.addEventListener('mouseup', function () {
                startAutoSlide();
            });
            heroEl.addEventListener('mouseleave', function () {
                startAutoSlide();
            });

            heroEl.addEventListener('touchstart', function (e) {
                stopAutoSlide();
                touchStartX = e.changedTouches[0].screenX;
            }, { passive: true });

            heroEl.addEventListener('touchend', function (e) {
                startAutoSlide();
                try {
                    var touchEndX = e.changedTouches[0].screenX;
                    var diff = touchStartX - touchEndX;
                    if (Math.abs(diff) > 50) {
                        if (diff > 0) nextSlide(); else prevSlide();
                        resetAutoSlide();
                    }
                } catch (err) {
                    console.warn('[GoGreen] Swipe error:', err.message);
                }
            }, { passive: true });
        }

        // Keyboard navigation for hero
        document.addEventListener('keydown', function (e) {
            try {
                if ($('#lightbox') && $('#lightbox').classList.contains('active')) return;
                if (e.key === 'ArrowRight') { nextSlide(); resetAutoSlide(); }
                if (e.key === 'ArrowLeft') { prevSlide(); resetAutoSlide(); }
            } catch (err) {
                // Ignore
            }
        });

        // Expose for other modules
        window._goGreenSlider = { nextSlide: nextSlide, prevSlide: prevSlide, resetAutoSlide: resetAutoSlide };
    }, 'HeroSlider');

    // ============================================
    // 8. SCROLL ANIMATIONS (IntersectionObserver)
    // ============================================
    var scrollObserver = null;

    safeExecute(function () {
        var animElements = $$('.fade-in, .fade-in-left, .fade-in-right, .scale-in');

        if ('IntersectionObserver' in window) {
            scrollObserver = new IntersectionObserver(function (entries) {
                entries.forEach(function (entry) {
                    try {
                        if (entry.isIntersecting) {
                            var siblings = entry.target.parentElement.children;
                            var siblingIndex = Array.from(siblings).indexOf(entry.target);
                            var isHoverLiftElement = entry.target.classList.contains('hover-lift');

                            // Keep lift interactions responsive on cards while preserving stagger for non-card elements.
                            entry.target.style.transitionDelay = isHoverLiftElement ? '0s' : (siblingIndex * 0.1) + 's';
                            entry.target.classList.add('visible');

                            if (!isHoverLiftElement) {
                                setTimeout(function () {
                                    if (entry.target.classList.contains('visible')) {
                                        entry.target.style.transitionDelay = '0s';
                                    }
                                }, (siblingIndex * 100) + 750);
                            }
                        }
                    } catch (e) {
                        entry.target.classList.add('visible');
                    }
                });
            }, { threshold: 0.08, rootMargin: '0px 0px -40px 0px' });

            animElements.forEach(function (el) { scrollObserver.observe(el); });
        } else {
            // Fallback: show all elements
            animElements.forEach(function (el) { el.classList.add('visible'); });
        }
    }, 'ScrollAnimations');

    // ============================================
    // 9. COUNTER ANIMATION (Eco Stats)
    // ============================================
    safeExecute(function () {
        var counterData = [
            { target: 5200, suffix: '+', prefix: '' },
            { target: 35, suffix: '%', prefix: '' },
            { target: 1800, suffix: ' kWh', prefix: '' },
            { target: 2.4, suffix: ' Ton', prefix: '', decimal: true }
        ];
        var counterAnimated = false;

        function animateCounters() {
            try {
                if (counterAnimated) return;
                var items = $$('.eco-strip-info h4');
                if (items.length < 4) return;

                counterAnimated = true;
                items.forEach(function (el, i) {
                    var data = counterData[i];
                    if (!data) return;
                    var duration = 2000;
                    var start = performance.now();

                    function update(now) {
                        try {
                            var elapsed = now - start;
                            var progress = Math.min(elapsed / duration, 1);
                            var eased = 1 - Math.pow(1 - progress, 3);
                            var current = data.target * eased;
                            if (data.decimal) {
                                el.textContent = current.toFixed(1).replace('.', ',') + data.suffix;
                            } else {
                                el.textContent = data.prefix + Math.floor(current).toLocaleString('id-ID') + data.suffix;
                            }
                            if (progress < 1) requestAnimationFrame(update);
                        } catch (e) {
                            el.textContent = data.target + data.suffix;
                        }
                    }

                    requestAnimationFrame(update);
                });
            } catch (e) {
                console.warn('[GoGreen] Counter animation error:', e.message);
            }
        }

        var ecoStrip = $('.eco-strip');
        if (ecoStrip && 'IntersectionObserver' in window) {
            var counterObserver = new IntersectionObserver(function (entries) {
                if (entries[0].isIntersecting) animateCounters();
            }, { threshold: 0.3 });
            counterObserver.observe(ecoStrip);
        }
    }, 'CounterAnimation');

    // ============================================
    // 10. PROGRAM TAB FILTERING
    // ============================================
    safeExecute(function () {
        var programCards = $$('.program-card');
        var programTabs = $$('.programs-tabs .tab');

        programTabs.forEach(function (tab) {
            tab.addEventListener('click', function () {
                try {
                    programTabs.forEach(function (t) { t.classList.remove('active'); });
                    tab.classList.add('active');

                    var filter = tab.textContent.toLowerCase().trim();

                    programCards.forEach(function (card, index) {
                        var category = (card.dataset.category || '').toLowerCase();
                        if (filter === 'semua' || category === filter) {
                            card.classList.remove('hiding');
                            card.style.transitionDelay = card.classList.contains('hover-lift') ? '0s' : (index * 0.08) + 's';
                            card.style.display = '';
                        } else {
                            card.classList.add('hiding');
                            setTimeout(function () {
                                if (card.classList.contains('hiding')) card.style.display = 'none';
                            }, 400);
                        }
                    });

                    showToast('Filter Diterapkan', 'Menampilkan program: ' + tab.textContent, 'info');
                } catch (e) {
                    console.warn('[GoGreen] Program filter error:', e.message);
                }
            });
        });
    }, 'ProgramTabs');

    // ============================================
    // 11. NEWS TABS (Dynamic Content)
    // ============================================
    safeExecute(function () {
        var newsTabData = {
            'Berita Utama': {
                featured: { img: 'https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?w=800&q=80', date: '28 Februari 2026', title: 'Go Green School Raih Penghargaan Sekolah Adiwiyata Mandiri Tingkat Nasional', desc: 'Sekolah kami berhasil meraih penghargaan tertinggi dari Kementerian Lingkungan Hidup atas komitmen dalam pengelolaan lingkungan sekolah yang berkelanjutan.' },
                items: [
                    { img: 'https://images.unsplash.com/photo-1466692476868-aef1dfb1e735?w=300&q=80', date: '25 Februari 2026', title: '1.000 Pohon Baru Ditanam di Area Sekolah dan Desa Sekitar', desc: 'Kegiatan penanaman melibatkan siswa, guru, dan masyarakat sekitar.' },
                    { img: 'https://images.unsplash.com/photo-1532996122724-e3c354a0b15b?w=300&q=80', date: '20 Februari 2026', title: 'Bank Sampah Sekolah Hasilkan Pendapatan Rp 5 Juta Per Bulan', desc: 'Dana digunakan untuk biaya operasional program lingkungan sekolah.' },
                    { img: 'https://images.unsplash.com/photo-1509391366360-2e959784a276?w=300&q=80', date: '15 Februari 2026', title: 'Pemasangan Panel Surya Fase 2 Berhasil Menghemat 40% Listrik', desc: 'Sekolah mengurangi ketergantungan pada energi fosil secara signifikan.' },
                    { img: 'https://images.unsplash.com/photo-1518531933037-91b2f5f229cc?w=300&q=80', date: '10 Februari 2026', title: 'Workshop Edukasi Lingkungan Diikuti 500 Siswa dari 12 Sekolah', desc: 'Siswa belajar tentang pengelolaan sampah dan konservasi energi.' }
                ]
            },
            'Kegiatan': {
                featured: { img: 'https://images.unsplash.com/photo-1466692476868-aef1dfb1e735?w=800&q=80', date: '22 Februari 2026', title: 'Aksi Bersih Sungai Bersama Warga dan Siswa Go Green School', desc: 'Lebih dari 300 siswa dan warga sekitar turut dalam aksi membersihkan sungai dari sampah plastik dan limbah rumah tangga.' },
                items: [
                    { img: 'https://images.unsplash.com/photo-1497435334941-8c899ee9e8e9?w=300&q=80', date: '18 Februari 2026', title: 'Lomba Kreasi Daur Ulang Antar Kelas Berlangsung Meriah', desc: 'Siswa berlomba menciptakan karya seni dari bahan bekas.' },
                    { img: 'https://images.unsplash.com/photo-1567306226416-28f0efdc88ce?w=300&q=80', date: '12 Februari 2026', title: 'Panen Raya Kebun Organik Sekolah: Hasilnya Menakjubkan', desc: 'Hasil panen 50 kg sayuran organik untuk kantin sekolah.' },
                    { img: 'https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?w=300&q=80', date: '5 Februari 2026', title: 'Pelatihan Eco-Enzyme dari Limbah Buah untuk Guru & Siswa', desc: 'Peserta antusias belajar membuat pembersih alami.' },
                    { img: 'https://images.unsplash.com/photo-1518531933037-91b2f5f229cc?w=300&q=80', date: '1 Februari 2026', title: 'Field Trip ke Taman Nasional: Belajar dari Alam Langsung', desc: 'Siswa kelas 8 mempelajari ekosistem hutan tropis.' }
                ]
            },
            'Prestasi': {
                featured: { img: 'https://images.unsplash.com/photo-1509391366360-2e959784a276?w=800&q=80', date: '26 Februari 2026', title: 'Tim Eco-Robot Go Green School Juara 1 Kompetisi Nasional', desc: 'Robot pembersih sampah otomatis buatan siswa berhasil menyisihkan 120 tim dari seluruh Indonesia dalam kompetisi teknologi hijau.' },
                items: [
                    { img: 'https://images.unsplash.com/photo-1532996122724-e3c354a0b15b?w=300&q=80', date: '20 Februari 2026', title: 'Siswa Raih Medali Emas Olimpiade Lingkungan Hidup Asia', desc: 'Prestasi membanggakan di kancah internasional.' },
                    { img: 'https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?w=300&q=80', date: '14 Februari 2026', title: 'Penghargaan Best Innovation Award di Green School Summit', desc: 'Inovasi bank sampah digital siswa mendapat apresiasi.' },
                    { img: 'https://images.unsplash.com/photo-1466692476868-aef1dfb1e735?w=300&q=80', date: '8 Februari 2026', title: 'Go Green School Masuk 10 Besar Sekolah Hijau se-ASEAN', desc: 'Diapresiasi oleh UNESCO untuk program lingkungannya.' },
                    { img: 'https://images.unsplash.com/photo-1497435334941-8c899ee9e8e9?w=300&q=80', date: '3 Februari 2026', title: 'Guru Lingkungan Terbaik Nasional dari Go Green School', desc: 'Ibu Ratna meraih penghargaan atas dedikasi 10 tahun.' }
                ]
            }
        };

        var newsTabs = $$('.news-tabs .tab');
        newsTabs.forEach(function (tab) {
            tab.addEventListener('click', function () {
                try {
                    newsTabs.forEach(function (t) { t.classList.remove('active'); });
                    tab.classList.add('active');

                    var tabName = tab.textContent.trim();
                    var data = newsTabData[tabName];
                    if (!data) return;

                    var featured = $('.news-featured');
                    if (featured) {
                        featured.style.opacity = '0';
                        featured.style.transform = 'scale(.95)';
                        featured.style.transition = 'all .4s ease';
                        setTimeout(function () {
                            try {
                                var img = featured.querySelector('img');
                                if (img) img.src = data.featured.img;
                                var dateEl = featured.querySelector('.date');
                                if (dateEl) dateEl.innerHTML = '<i class="far fa-calendar"></i> ' + data.featured.date;
                                var h3 = featured.querySelector('h3');
                                if (h3) h3.textContent = data.featured.title;
                                var p = featured.querySelector('p');
                                if (p) p.textContent = data.featured.desc;
                                featured.style.opacity = '1';
                                featured.style.transform = 'scale(1)';
                            } catch (e) {
                                featured.style.opacity = '1';
                                featured.style.transform = 'scale(1)';
                            }
                        }, 300);
                    }

                    var newsItems = $$('.news-list .news-item');
                    newsItems.forEach(function (item, i) {
                        item.style.opacity = '0';
                        item.style.transform = 'translateX(20px)';
                        item.style.transition = 'all .4s ease';
                        setTimeout(function () {
                            try {
                                var d = data.items[i];
                                if (!d) return;
                                var img = item.querySelector('.news-item-img img');
                                if (img) img.src = d.img;
                                var dateEl = item.querySelector('.date');
                                if (dateEl) dateEl.textContent = d.date;
                                var h4 = item.querySelector('h4');
                                if (h4) h4.textContent = d.title;
                                var p = item.querySelector('p');
                                if (p) p.textContent = d.desc;
                                item.style.opacity = '1';
                                item.style.transform = 'translateX(0)';
                            } catch (e) {
                                item.style.opacity = '1';
                                item.style.transform = 'translateX(0)';
                            }
                        }, 300 + (i * 100));
                    });
                } catch (e) {
                    console.warn('[GoGreen] News tabs error:', e.message);
                }
            });
        });
    }, 'NewsTabs');

    // ============================================
    // 12. GALLERY LIGHTBOX
    // ============================================
    safeExecute(function () {
        var lightbox = $('#lightbox');
        var lightboxImg = $('#lightboxImg');
        var lightboxCaption = $('#lightboxCaption');
        var lightboxCounter = $('#lightboxCounter');
        var galleryItems = $$('.gallery-item');
        var currentGalleryIndex = 0;

        if (!lightbox || galleryItems.length === 0) return;

        function openLightbox(index) {
            try {
                currentGalleryIndex = index;
                var item = galleryItems[index];
                var img = item.querySelector('img');
                var title = item.querySelector('.overlay h4');
                var subtitle = item.querySelector('.overlay span');

                if (lightboxImg && img) lightboxImg.src = img.src.replace('w=600', 'w=1200');
                if (lightboxCaption) {
                    var h4 = lightboxCaption.querySelector('h4');
                    var span = lightboxCaption.querySelector('span');
                    if (h4 && title) h4.textContent = title.textContent;
                    if (span && subtitle) span.textContent = subtitle.textContent;
                }
                if (lightboxCounter) lightboxCounter.textContent = (index + 1) + ' / ' + galleryItems.length;
                lightbox.classList.add('active');
                document.body.style.overflow = 'hidden';
            } catch (e) {
                console.warn('[GoGreen] Open lightbox error:', e.message);
            }
        }

        function closeLightbox() {
            try {
                lightbox.classList.remove('active');
                document.body.style.overflow = '';
            } catch (e) {
                document.body.style.overflow = '';
            }
        }

        function navigateLightbox(dir) {
            try {
                currentGalleryIndex = (currentGalleryIndex + dir + galleryItems.length) % galleryItems.length;
                var item = galleryItems[currentGalleryIndex];
                if (lightboxImg) {
                    lightboxImg.style.opacity = '0';
                    lightboxImg.style.transform = 'scale(.9)';
                    lightboxImg.style.transition = 'all .3s ease';
                }
                setTimeout(function () {
                    try {
                        var img = item.querySelector('img');
                        if (lightboxImg && img) lightboxImg.src = img.src.replace('w=600', 'w=1200');
                        if (lightboxCaption) {
                            var h4 = lightboxCaption.querySelector('h4');
                            var span = lightboxCaption.querySelector('span');
                            var title = item.querySelector('.overlay h4');
                            var subtitle = item.querySelector('.overlay span');
                            if (h4 && title) h4.textContent = title.textContent;
                            if (span && subtitle) span.textContent = subtitle.textContent;
                        }
                        if (lightboxCounter) lightboxCounter.textContent = (currentGalleryIndex + 1) + ' / ' + galleryItems.length;
                        if (lightboxImg) {
                            lightboxImg.style.opacity = '1';
                            lightboxImg.style.transform = 'scale(1)';
                        }
                    } catch (e) {
                        if (lightboxImg) {
                            lightboxImg.style.opacity = '1';
                            lightboxImg.style.transform = 'scale(1)';
                        }
                    }
                }, 200);
            } catch (e) {
                console.warn('[GoGreen] Navigate lightbox error:', e.message);
            }
        }

        galleryItems.forEach(function (item, i) {
            item.addEventListener('click', function () { openLightbox(i); });
        });

        var closeBtn = $('#lightboxClose');
        if (closeBtn) closeBtn.addEventListener('click', closeLightbox);

        var prevBtn = $('#lightboxPrev');
        if (prevBtn) prevBtn.addEventListener('click', function () { navigateLightbox(-1); });

        var nextBtn = $('#lightboxNext');
        if (nextBtn) nextBtn.addEventListener('click', function () { navigateLightbox(1); });

        lightbox.addEventListener('click', function (e) {
            if (e.target === lightbox) closeLightbox();
        });

        // Keyboard navigation for lightbox
        document.addEventListener('keydown', function (e) {
            try {
                if (!lightbox.classList.contains('active')) return;
                if (e.key === 'Escape') closeLightbox();
                if (e.key === 'ArrowLeft') navigateLightbox(-1);
                if (e.key === 'ArrowRight') navigateLightbox(1);
            } catch (err) {
                // Ignore
            }
        });
    }, 'GalleryLightbox');

    // ============================================
    // 13. QUICK TOGGLE MENU
    // ============================================
    safeExecute(function () {
        var quickToggleWrapper = $('#quickToggleWrapper');
        var quickToggleMain = $('#quickToggleMain');
        var quickToggleDropdown = $('#quickToggleDropdown');

        if (!quickToggleWrapper || !quickToggleMain || !quickToggleDropdown) return;

        function setMenuState(open) {
            quickToggleWrapper.classList.toggle('open', open);
            quickToggleMain.setAttribute('aria-expanded', open ? 'true' : 'false');
            quickToggleDropdown.setAttribute('aria-hidden', open ? 'false' : 'true');
        }

        quickToggleMain.addEventListener('click', function (e) {
            e.preventDefault();
            e.stopPropagation();
            setMenuState(!quickToggleWrapper.classList.contains('open'));
        });

        quickToggleDropdown.addEventListener('click', function (e) {
            e.stopPropagation();
        });

        $$('.toggle-action-btn', quickToggleDropdown).forEach(function (button) {
            button.addEventListener('click', function () {
                setMenuState(false);
            });
        });

        document.addEventListener('click', function (e) {
            if (!quickToggleWrapper.contains(e.target)) {
                setMenuState(false);
            }
        });

        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') {
                setMenuState(false);
            }
        });
    }, 'QuickToggleMenu');

    // ============================================
    // 14. DARK THEME TOGGLE
    // ============================================
    safeExecute(function () {
        var darkToggle = $('#darkToggle');
        if (!darkToggle) return;

        var darkToggleIcon = darkToggle.querySelector('.dark-toggle-icon');
        var darkToggleText = darkToggle.querySelector('.dark-toggle-text');

        var storageKey = 'goGreenTheme';

        function updateDarkToggleUI(isDark) {
            if (darkToggleIcon) {
                darkToggleIcon.className = 'fas ' + (isDark ? 'fa-moon' : 'fa-sun') + ' dark-toggle-icon';
            }
            if (darkToggleText) {
                darkToggleText.textContent = isDark ? 'Gelap' : 'Terang';
            }
            darkToggle.classList.toggle('is-dark', isDark);
        }

        function applyTheme(theme, persist) {
            var isDark = theme === 'dark';
            document.body.classList.toggle('dark-theme', isDark);
            // Keep compatibility with existing page-specific dark-mode styles.
            document.body.classList.toggle('dark-mode', isDark);
            darkToggle.setAttribute('aria-pressed', isDark ? 'true' : 'false');
            darkToggle.title = isDark ? 'Beralih ke mode terang' : 'Aktifkan mode gelap';
            updateDarkToggleUI(isDark);

            if (persist) {
                try {
                    localStorage.setItem(storageKey, isDark ? 'dark' : 'light');
                } catch (e) {
                    // localStorage unavailable
                }
            }
        }

        function getSavedTheme() {
            try {
                var saved = localStorage.getItem(storageKey);
                if (saved === 'dark' || saved === 'light') return saved;
            } catch (e) {
                // localStorage unavailable
            }
            return null;
        }

        var savedTheme = getSavedTheme();
        if (savedTheme === 'dark') {
            applyTheme('dark', false);
        } else {
            applyTheme('light', false);
        }

        darkToggle.addEventListener('click', function () {
            var nextTheme = document.body.classList.contains('dark-theme') ? 'light' : 'dark';
            applyTheme(nextTheme, true);
        });
    }, 'DarkThemeToggle');

    // ============================================
    // 15. LANGUAGE TOGGLE (ID/EN)
    // ============================================
    safeExecute(function () {
        var langToggle = $('#langToggle');
        if (!langToggle) return;

        var langText = langToggle.querySelector('.lang-toggle-text');
        var preferredLang = 'id';

        try {
            preferredLang = localStorage.getItem('preferredLanguage') || 'id';
        } catch (e) {
            preferredLang = 'id';
        }

        function updateToggleUI(lang) {
            var isEnglish = lang === 'en';
            langToggle.classList.toggle('active-en', isEnglish);
            if (langText) langText.textContent = isEnglish ? 'EN' : 'ID';
            langToggle.title = isEnglish ? 'Switch to Indonesian' : 'Ganti ke Bahasa Inggris';
            document.documentElement.lang = isEnglish ? 'en' : 'id';
        }

        function setGoogleTranslateCookie(lang) {
            var value = '/id/' + lang;
            document.cookie = 'googtrans=' + value + ';path=/';
            document.cookie = 'googtrans=' + value + ';path=/;domain=' + window.location.hostname;
        }

        function applyGoogleLanguage(lang) {
            var combo = document.querySelector('.goog-te-combo');
            if (!combo) return false;
            combo.value = lang;
            combo.dispatchEvent(new Event('change'));
            return true;
        }

        function applyLanguage(lang, silentToast) {
            var targetLang = lang === 'en' ? 'en' : 'id';
            updateToggleUI(targetLang);
            setGoogleTranslateCookie(targetLang);

            try {
                localStorage.setItem('preferredLanguage', targetLang);
            } catch (e) {
                // localStorage unavailable
            }

            var applied = applyGoogleLanguage(targetLang);
            if (!silentToast) {
                if (applied) {
                    showToast(
                        targetLang === 'en' ? 'Language Switched' : 'Bahasa Diubah',
                        targetLang === 'en' ? 'Page is now in English' : 'Halaman sekarang menggunakan Bahasa Indonesia',
                        'info'
                    );
                } else {
                    showToast(
                        targetLang === 'en' ? 'Preparing English' : 'Menyiapkan Bahasa Indonesia',
                        targetLang === 'en' ? 'Translation engine is loading...' : 'Mesin penerjemah sedang dimuat...',
                        'info'
                    );
                }
            }
        }

        function initGoogleTranslate() {
            if (!window.google || !window.google.translate || !window.google.translate.TranslateElement) return;
            if (window._goGreenTranslateInitialized) return;

            new window.google.translate.TranslateElement({
                pageLanguage: 'id',
                includedLanguages: 'id,en',
                autoDisplay: false,
                layout: window.google.translate.TranslateElement.InlineLayout.SIMPLE
            }, 'google_translate_element');

            window._goGreenTranslateInitialized = true;
            setTimeout(function () {
                applyLanguage(preferredLang, true);
            }, 450);
        }

        function loadGoogleTranslateScript() {
            if (window._goGreenTranslateScriptLoading) return;
            if (window.google && window.google.translate) {
                initGoogleTranslate();
                return;
            }

            window._goGreenTranslateScriptLoading = true;
            window.googTranslateElementInit = function () {
                initGoogleTranslate();
            };

            var script = document.createElement('script');
            script.src = 'https://translate.google.com/translate_a/element.js?cb=googTranslateElementInit';
            script.async = true;
            script.onerror = function () {
                window._goGreenTranslateScriptLoading = false;
                showToast('Terjemahan Gagal', 'Koneksi ke layanan terjemahan tidak tersedia', 'warning');
            };
            document.body.appendChild(script);
        }

        updateToggleUI(preferredLang);
        setGoogleTranslateCookie(preferredLang);
        loadGoogleTranslateScript();

        langToggle.addEventListener('click', function (e) {
            if (e) e.preventDefault();

            var current = (langText && langText.textContent === 'EN') ? 'en' : 'id';
            var nextLang = current === 'id' ? 'en' : 'id';

            try {
                localStorage.setItem('preferredLanguage', nextLang);
            } catch (e) {
                // localStorage unavailable
            }

            setGoogleTranslateCookie(nextLang);
            window.location.reload();
        });
    }, 'LanguageToggle');

    // ============================================
    // 15. TOAST NOTIFICATION SYSTEM
    // ============================================
    var toastContainer = null;
    safeExecute(function () {
        toastContainer = $('#toastContainer');
    }, 'ToastInit');

    function showToast(title, message, type) {
        try {
            if (!toastContainer) return;
            type = type || 'success';
            var toast = document.createElement('div');
            toast.className = 'toast';
            var iconMap = { success: 'fa-check-circle', info: 'fa-info-circle', warning: 'fa-exclamation-triangle' };
            var safeTitle = document.createElement('span');
            safeTitle.textContent = title;
            var safeMessage = document.createElement('span');
            safeMessage.textContent = message;

            toast.innerHTML =
                '<div class="toast-icon ' + type + '"><i class="fas ' + (iconMap[type] || iconMap.success) + '"></i></div>' +
                '<div class="toast-body"><h5></h5><p></p></div>';
            toast.querySelector('h5').textContent = title;
            toast.querySelector('p').textContent = message;

            toastContainer.appendChild(toast);
            requestAnimationFrame(function () {
                requestAnimationFrame(function () { toast.classList.add('show'); });
            });

            setTimeout(function () {
                toast.classList.remove('show');
                setTimeout(function () {
                    try { toast.remove(); } catch (e) { /* ignore */ }
                }, 400);
            }, 4000);
        } catch (e) {
            console.warn('[GoGreen] Toast error:', e.message);
        }
    }

    // Make showToast globally reachable for inline usage
    window.showToast = showToast;

    // ============================================
    // 15. SMOOTH SCROLL FOR NAV LINKS + ACTIVE TRACKING
    // ============================================
    safeExecute(function () {
        var navLinks = $$('.nav-menu a[href^="#"]');
        var sections = $$('section[id]');
        var navMenu = $('#navMenu');
        var hamburgerEl = $('#hamburger');

        navLinks.forEach(function (link) {
            link.addEventListener('click', function (e) {
                try {
                    e.preventDefault();
                    var href = link.getAttribute('href');
                    var target = document.querySelector(href);
                    if (target && header) {
                        var offset = header.offsetHeight + 10;
                        var top = target.getBoundingClientRect().top + window.scrollY - offset;
                        window.scrollTo({ top: top, behavior: 'smooth' });
                    }
                    if (navMenu) navMenu.classList.remove('open');
                    if (hamburgerEl) {
                        var icon = hamburgerEl.querySelector('i');
                        if (icon) icon.className = 'fas fa-bars';
                    }
                } catch (e) {
                    console.warn('[GoGreen] Smooth scroll error:', e.message);
                }
            });
        });

        function updateActiveNav() {
            try {
                var current = '';
                sections.forEach(function (section) {
                    var top = section.offsetTop - 120;
                    if (window.scrollY >= top) current = section.getAttribute('id');
                });
                navLinks.forEach(function (link) {
                    link.classList.remove('active');
                    var href = link.getAttribute('href');
                    if (href === '#' + current || (current === '' && href === '#')) {
                        link.classList.add('active');
                    }
                });
            } catch (e) {
                // Ignore
            }
        }

        window.addEventListener('scroll', updateActiveNav, { passive: true });
    }, 'SmoothScroll');

    // ============================================
    // 16. SEARCH FUNCTIONALITY
    // ============================================
    safeExecute(function () {
        var searchInput = $('.search-box input');
        if (!searchInput) return;

        var programCards = $$('.program-card');
        var searchTimeout;

        searchInput.addEventListener('input', function () {
            clearTimeout(searchTimeout);
            var self = this;
            searchTimeout = setTimeout(function () {
                try {
                    var query = self.value.toLowerCase().trim();
                    if (query.length < 2) {
                        programCards.forEach(function (card) {
                            card.style.display = '';
                            card.classList.remove('hiding');
                            card.style.boxShadow = '';
                        });
                        return;
                    }

                    var found = 0;
                    programCards.forEach(function (card) {
                        var text = card.textContent.toLowerCase();
                        if (text.indexOf(query) !== -1) {
                            card.style.display = '';
                            card.classList.remove('hiding');
                            card.style.boxShadow = '0 0 0 3px #66bb6a';
                            found++;
                        } else {
                            card.style.display = 'none';
                            card.classList.add('hiding');
                            card.style.boxShadow = '';
                        }
                    });

                    var programsSection = document.querySelector('#programs');
                    if (found > 0 && programsSection) {
                        programsSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
                        showToast('Hasil Pencarian', 'Ditemukan ' + found + ' program terkait "' + self.value + '"', 'info');
                    } else if (found === 0) {
                        showToast('Tidak Ditemukan', 'Tidak ada hasil untuk "' + self.value + '"', 'warning');
                    }
                } catch (e) {
                    console.warn('[GoGreen] Search error:', e.message);
                }
            }, 500);
        });

        searchInput.addEventListener('keydown', function (e) {
            if (e.key === 'Enter') e.preventDefault();
            if (e.key === 'Escape') {
                searchInput.value = '';
                searchInput.dispatchEvent(new Event('input'));
            }
        });
    }, 'SearchFunctionality');

    // ============================================
    // 17. FLOATING LEAVES ANIMATION (Canvas)
    // ============================================
    safeExecute(function () {
        var leavesCanvas = $('#leavesCanvas');
        if (!leavesCanvas) return;

        var ctx = leavesCanvas.getContext('2d');
        if (!ctx) return;

        var leaves = [];
        var leafCount = 15;

        function resizeCanvas() {
            try {
                var hero = leavesCanvas.parentElement;
                leavesCanvas.width = hero.offsetWidth;
                leavesCanvas.height = hero.offsetHeight;
            } catch (e) {
                // Ignore resize errors
            }
        }

        resizeCanvas();
        window.addEventListener('resize', resizeCanvas);

        function Leaf() {
            this.reset();
        }

        Leaf.prototype.reset = function () {
            this.x = Math.random() * leavesCanvas.width;
            this.y = -20 - Math.random() * 100;
            this.size = 8 + Math.random() * 14;
            this.speedX = (Math.random() - 0.5) * 1.5;
            this.speedY = 0.5 + Math.random() * 1.5;
            this.rotation = Math.random() * Math.PI * 2;
            this.rotSpeed = (Math.random() - 0.5) * 0.04;
            this.opacity = 0.15 + Math.random() * 0.25;
            this.wobble = Math.random() * Math.PI * 2;
            this.wobbleSpeed = 0.02 + Math.random() * 0.03;
        };

        Leaf.prototype.update = function () {
            this.wobble += this.wobbleSpeed;
            this.x += this.speedX + Math.sin(this.wobble) * 0.5;
            this.y += this.speedY;
            this.rotation += this.rotSpeed;
            if (this.y > leavesCanvas.height + 20 || this.x < -30 || this.x > leavesCanvas.width + 30) {
                this.reset();
            }
        };

        Leaf.prototype.draw = function () {
            ctx.save();
            ctx.translate(this.x, this.y);
            ctx.rotate(this.rotation);
            ctx.globalAlpha = this.opacity;
            ctx.fillStyle = '#a5d6a7';
            ctx.beginPath();
            ctx.moveTo(0, -this.size / 2);
            ctx.bezierCurveTo(this.size / 2, -this.size / 3, this.size / 2, this.size / 3, 0, this.size / 2);
            ctx.bezierCurveTo(-this.size / 2, this.size / 3, -this.size / 2, -this.size / 3, 0, -this.size / 2);
            ctx.fill();
            ctx.strokeStyle = 'rgba(255,255,255,0.3)';
            ctx.lineWidth = 0.5;
            ctx.beginPath();
            ctx.moveTo(0, -this.size / 2);
            ctx.lineTo(0, this.size / 2);
            ctx.stroke();
            ctx.restore();
        };

        for (var i = 0; i < leafCount; i++) {
            var l = new Leaf();
            l.y = Math.random() * leavesCanvas.height;
            leaves.push(l);
        }

        function animateLeaves() {
            try {
                ctx.clearRect(0, 0, leavesCanvas.width, leavesCanvas.height);
                leaves.forEach(function (leaf) {
                    leaf.update();
                    leaf.draw();
                });
            } catch (e) {
                // Ignore frame errors
            }
            requestAnimationFrame(animateLeaves);
        }

        animateLeaves();
    }, 'FloatingLeaves');

    // ============================================
    // 18. TYPING EFFECT ON HERO
    // ============================================
    safeExecute(function () {
        if (slides.length === 0) return;
        var heroTitle = slides[0].querySelector('h2');
        if (!heroTitle) return;

        var spanText = heroTitle.querySelector('span');
        if (!spanText) return;

        var text = spanText.textContent;
        spanText.textContent = '';
        var cursor = document.createElement('span');
        cursor.className = 'typing-cursor';
        spanText.after(cursor);

        var charIndex = 0;
        function typeChar() {
            try {
                if (charIndex < text.length) {
                    spanText.textContent += text[charIndex];
                    charIndex++;
                    setTimeout(typeChar, 60 + Math.random() * 40);
                } else {
                    setTimeout(function () {
                        try { cursor.remove(); } catch (e) { /* ignore */ }
                    }, 2000);
                }
            } catch (e) {
                spanText.textContent = text;
            }
        }

        setTimeout(typeChar, 2800);
    }, 'TypingEffect');

    // ============================================
    // 19. CTA BUTTON CONFETTI EFFECT
    // ============================================
    safeExecute(function () {
        var ctaBtn = $('.cta-section .btn-primary');
        if (!ctaBtn) return;

        ctaBtn.addEventListener('click', function (e) {
            e.preventDefault();
            launchConfetti();
            showToast('Terima Kasih!', 'Kami sangat senang Anda tertarik bergabung!', 'success');
        });

        function launchConfetti() {
            try {
                var canvas = document.createElement('canvas');
                canvas.className = 'confetti-canvas';
                document.body.appendChild(canvas);
                var cCtx = canvas.getContext('2d');
                canvas.width = window.innerWidth;
                canvas.height = window.innerHeight;

                var confetti = [];
                var colors = ['#2e7d32', '#66bb6a', '#a5d6a7', '#fff9c4', '#81d4fa', '#ff8a65', '#ce93d8'];
                for (var i = 0; i < 100; i++) {
                    confetti.push({
                        x: canvas.width / 2 + (Math.random() - 0.5) * 200,
                        y: canvas.height / 2,
                        vx: (Math.random() - 0.5) * 15,
                        vy: -8 - Math.random() * 12,
                        w: 6 + Math.random() * 8,
                        h: 4 + Math.random() * 6,
                        color: colors[Math.floor(Math.random() * colors.length)],
                        rotation: Math.random() * 360,
                        rotSpeed: (Math.random() - 0.5) * 15,
                        gravity: 0.3 + Math.random() * 0.2,
                        opacity: 1
                    });
                }

                var frame = 0;
                function drawConfetti() {
                    try {
                        cCtx.clearRect(0, 0, canvas.width, canvas.height);
                        var alive = false;
                        confetti.forEach(function (c) {
                            c.vy += c.gravity;
                            c.x += c.vx;
                            c.y += c.vy;
                            c.vx *= 0.99;
                            c.rotation += c.rotSpeed;
                            if (frame > 60) c.opacity -= 0.02;
                            if (c.opacity > 0) alive = true;

                            cCtx.save();
                            cCtx.translate(c.x, c.y);
                            cCtx.rotate(c.rotation * Math.PI / 180);
                            cCtx.globalAlpha = Math.max(0, c.opacity);
                            cCtx.fillStyle = c.color;
                            cCtx.fillRect(-c.w / 2, -c.h / 2, c.w, c.h);
                            cCtx.restore();
                        });
                        frame++;
                        if (alive && frame < 200) {
                            requestAnimationFrame(drawConfetti);
                        } else {
                            canvas.remove();
                        }
                    } catch (e) {
                        try { canvas.remove(); } catch (err) { /* ignore */ }
                    }
                }

                requestAnimationFrame(drawConfetti);
            } catch (e) {
                console.warn('[GoGreen] Confetti error:', e.message);
            }
        }
    }, 'ConfettiEffect');

    // ============================================
    // 20. QUICK ACCESS CARD HOVER RIPPLE EFFECT
    // ============================================
    safeExecute(function () {
        $$('.quick-item').forEach(function (item) {
            item.addEventListener('pointerdown', function (e) {
                try {
                    var ripple = document.createElement('div');
                    ripple.style.cssText =
                        'position:absolute; border-radius:50%; background:rgba(46,125,50,.15);' +
                        'width:0; height:0; transform:translate(-50%,-50%);' +
                        'pointer-events:none; animation: rippleEffect .6s ease forwards;';
                    var rect = item.getBoundingClientRect();
                    ripple.style.left = (e.clientX - rect.left) + 'px';
                    ripple.style.top = (e.clientY - rect.top) + 'px';
                    item.style.position = 'relative';
                    item.style.overflow = 'hidden';
                    item.appendChild(ripple);
                    setTimeout(function () {
                        try { ripple.remove(); } catch (err) { /* ignore */ }
                    }, 600);
                } catch (e) {
                    console.warn('[GoGreen] Ripple error:', e.message);
                }
            });
        });
    }, 'RippleEffect');

    // ============================================
    // 21. ECO STRIP HOVER COUNTER BUMP
    // ============================================
    safeExecute(function () {
        $$('.eco-strip-item').forEach(function (item) {
            item.addEventListener('mouseenter', function () {
                try {
                    var h4 = item.querySelector('h4');
                    if (h4) {
                        h4.style.transform = 'scale(1.15)';
                        h4.style.color = '#2e7d32';
                    }
                } catch (e) { /* ignore */ }
            });
            item.addEventListener('mouseleave', function () {
                try {
                    var h4 = item.querySelector('h4');
                    if (h4) {
                        h4.style.transform = 'scale(1)';
                        h4.style.color = '';
                    }
                } catch (e) { /* ignore */ }
            });
        });
    }, 'EcoStripHover');

    // ============================================
    // 22. INFO SIDE CARD LIVE PULSE ANIMATION
    // ============================================
    safeExecute(function () {
        $$('.info-side-card .badge').forEach(function (badge) {
            setInterval(function () {
                try {
                    badge.style.transform = 'scale(1.1)';
                    setTimeout(function () { badge.style.transform = 'scale(1)'; }, 300);
                } catch (e) { /* ignore */ }
            }, 3000 + Math.random() * 2000);
        });
    }, 'BadgePulse');

    // ============================================
    // 23. PARTNER LOGOS ROTATION ANIMATION
    // ============================================
    safeExecute(function () {
        $$('.partner-logo').forEach(function (logo) {
            logo.addEventListener('mouseenter', function () {
                try {
                    var i = logo.querySelector('i');
                    if (i) {
                        i.style.transform = 'rotate(360deg) scale(1.2)';
                        i.style.transition = 'transform .5s ease';
                    }
                } catch (e) { /* ignore */ }
            });
            logo.addEventListener('mouseleave', function () {
                try {
                    var i = logo.querySelector('i');
                    if (i) i.style.transform = 'rotate(0deg) scale(1)';
                } catch (e) { /* ignore */ }
            });
        });
    }, 'PartnerLogos');

    // ============================================
    // 24. SECTION REVEAL ON SCROLL (EXTRA)
    // ============================================
    safeExecute(function () {
        if (scrollObserver) {
            $$('.section-title').forEach(function (title) {
                title.classList.add('fade-in');
                scrollObserver.observe(title);
            });
        }
    }, 'SectionReveal');

    // ============================================
    // 25. KEYBOARD SHORTCUTS
    // ============================================
    safeExecute(function () {
        var searchInput = $('.search-box input');

        document.addEventListener('keydown', function (e) {
            try {
                // Ctrl+K = Focus search
                if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
                    e.preventDefault();
                    if (searchInput) {
                        searchInput.focus();
                        showToast('Pencarian', 'Ketik untuk mencari program...', 'info');
                    }
                }
            } catch (err) {
                // Ignore keyboard shortcut errors
            }
        });
    }, 'KeyboardShortcuts');

    // Console branding
    try {
        console.log('%c🌿 Go Green School - Interactive Landing Page', 'color: #2e7d32; font-size: 16px; font-weight: bold;');
        console.log('%cKeyboard shortcuts: Ctrl+K=Search | ←→=Slider/Lightbox | Esc=Close', 'color: #66bb6a; font-size: 12px;');
    } catch (e) {
        // Ignore console styling errors
    }

})();
