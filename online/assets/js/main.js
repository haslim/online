document.addEventListener('DOMContentLoaded', function() {
    'use strict';

    const mainHeader = document.getElementById('mainHeader');
    const mobileToggle = document.getElementById('mobileToggle');
    const navMenu = document.getElementById('navMenu');
    const gdprNotice = document.getElementById('bga-gdpr-notice');
    const gdprAcceptButton = document.getElementById('bga-gdpr-accept-button');
    
    // --- PRELOADER --- //
    window.addEventListener('load', () => {
        setTimeout(() => {
            document.body.classList.add('loaded');
        }, 100); 
    });

    // --- STICKY HEADER --- //
    if (mainHeader) {
        const handleScroll = () => {
            if (window.scrollY > 50) {
                mainHeader.classList.add('scrolled');
            } else {
                mainHeader.classList.remove('scrolled');
            }
        };
        handleScroll(); 
        window.addEventListener('scroll', handleScroll, { passive: true });
    }

    // --- MOBILE MENU --- //
    if (mobileToggle && navMenu) {
        mobileToggle.addEventListener('click', () => {
            const isExpanded = mobileToggle.getAttribute('aria-expanded') === 'true';
            mobileToggle.classList.toggle('active');
            navMenu.classList.toggle('active');
            mobileToggle.setAttribute('aria-expanded', !isExpanded);
            document.body.style.overflow = navMenu.classList.contains('active') ? 'hidden' : '';
        });

        document.addEventListener('click', (e) => {
            if (navMenu.classList.contains('active') && !navMenu.contains(e.target) && !mobileToggle.contains(e.target)) {
                mobileToggle.classList.remove('active');
                navMenu.classList.remove('active');
                mobileToggle.setAttribute('aria-expanded', 'false');
                document.body.style.overflow = '';
            }
        });

        navMenu.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', () => {
                if (window.innerWidth <= 768 && navMenu.classList.contains('active')) {
                    // Smooth scroll already handles closing menu, but ensure
                    // if it's an external link or a full URL to another page/section,
                    // it doesn't try to scroll.
                    const href = link.getAttribute('href');
                    if (href && (href.startsWith('#') || href.startsWith(window.location.origin + window.location.pathname + '#'))) {
                         // This is a local scroll, let smooth scroll handle closing.
                    } else if (href && !href.startsWith('#')) { // It's a full URL to another page
                         // Just close the menu directly if it's an external navigation
                         mobileToggle.click(); // Simulate click to close
                    }
                }
            });
        });
    }

    // --- ACCORDION --- //
    const accordionItems = document.querySelectorAll('.accordion-item');
    accordionItems.forEach(item => {
        const header = item.querySelector('.accordion-header');
        const content = item.querySelector('.accordion-content');

        if (header && content) {
            header.addEventListener('click', () => {
                const isActive = item.classList.contains('active');
                
                accordionItems.forEach(otherItem => {
                    if (otherItem !== item) {
                       otherItem.classList.remove('active');
                       otherItem.querySelector('.accordion-content').style.maxHeight = null;
                    }
                });

                if (isActive) {
                    item.classList.remove('active');
                    content.style.maxHeight = null;
                } else {
                    item.classList.add('active');
                    content.style.maxHeight = content.scrollHeight + 'px';
                }
            });
        }
    });

    // --- SCROLL REVEAL ANIMATION --- //
    const revealElements = document.querySelectorAll('.reveal');
    if ('IntersectionObserver' in window) {
        const revealObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('revealed');
                    observer.unobserve(entry.target);
                }
            });
        }, { 
            threshold: 0.1, 
            rootMargin: '0px 0px -50px 0px' 
        });

        revealElements.forEach(el => revealObserver.observe(el));
    } else {
        revealElements.forEach(el => el.classList.add('revealed'));
    }

    // --- SCROLLSPY (Active menu link highlighting) --- //
    const sections = document.querySelectorAll('section[id]');
    const navLinks = document.querySelectorAll('.nav-menu a');

    const setActiveLink = () => {
        // Scrollspy sadece ön sayfada çalışmalı. Diğer sayfalarda çalışması gerekmez.
        if (!document.body.classList.contains('home')) { // 'home' class'ı sadece ön sayfada olur
            navLinks.forEach(link => {
                const listItem = link.closest('li');
                if (listItem) {
                    // Mevcut sayfa ile eşleşen bir menü öğesi varsa onu aktif yap.
                    // Örneğin, /makaleler/ sayfasındayken menüdeki "Makaleler" linkini aktif yap.
                    if (link.href === window.location.href || link.href === window.location.origin + window.location.pathname) {
                        listItem.classList.add('current-menu-item');
                    } else if (link.href.startsWith(window.location.origin + window.location.pathname + '#')) {
                         // Eğer link mevcut sayfanın bir anchor'ı ise, ancak bu senaryoda burası çalışmayacak,
                         // çünkü #anchor linkleri ana sayfaya yönlendirilecek.
                         listItem.classList.remove('current-menu-item'); // Remove if it was active by mistake
                    } else {
                         listItem.classList.remove('current-menu-item');
                    }
                }
            });
            return; // Ön sayfa değilse buradan çık
        }

        // Ön sayfadaysak normal scrollspy mantığı
        let currentSectionId = '';
        const headerHeight = mainHeader ? mainHeader.offsetHeight : 0;

        sections.forEach(section => {
            const sectionTop = section.offsetTop - headerHeight - 20;
            const sectionBottom = sectionTop + section.offsetHeight;

            if (pageYOffset >= sectionTop && pageYOffset < sectionBottom) {
                currentSectionId = section.getAttribute('id');
            }
        });

        navLinks.forEach(link => {
            const listItem = link.closest('li');
            if (listItem) {
                listItem.classList.remove('current-menu-item');
            }
            
            // Linkin hedeflediği anchor ID'yi al
            const linkHref = link.getAttribute('href');
            const hashIndex = linkHref ? linkHref.indexOf('#') : -1;
            let anchorIdFromLink = '';
            if (hashIndex !== -1) {
                anchorIdFromLink = linkHref.substring(hashIndex + 1);
            }

            // Sadece ana sayfadaki anchor linkleri için `current-menu-item` sınıfını ekle
            if (anchorIdFromLink && anchorIdFromLink === currentSectionId) {
                // Sadece tek sayfa bağlantılarını (yani # ile başlayanları) veya
                // ana sayfanın tam URL'siyle başlayan #anchor linklerini kontrol et.
                if (linkHref.startsWith('#') || linkHref.startsWith(window.location.origin + window.location.pathname + '#')) {
                    if (listItem) {
                        listItem.classList.add('current-menu-item');
                    }
                }
            }
        });
    };

    setActiveLink();
    window.addEventListener('scroll', setActiveLink, { passive: true });

    // --- Smooth scroll for internal links --- //
    // Bu kısım, menüdeki linklerin artık tam URL olabileceği duruma göre ayarlanmalı.
    // Eğer link ana sayfaya bir anchor ile dönüyorsa, smooth scroll yapmalı.
    document.querySelectorAll('.nav-menu a').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            const targetHref = this.getAttribute('href');
            let targetId = '';

            // Eğer link bir anchor ise (ör: #about)
            if (targetHref.startsWith('#')) {
                targetId = targetHref;
            } 
            // Eğer link ana sayfanın URL'si + anchor ise (ör: https://example.com/#about)
            else if (targetHref.startsWith(window.location.origin + window.location.pathname + '#')) {
                targetId = targetHref.substring(targetHref.indexOf('#'));
            }

            if (targetId && document.querySelector(targetId)) {
                e.preventDefault(); // Sayfanın normal gezinmesini engelle

                const targetElement = document.querySelector(targetId);
                const offsetTop = targetElement.offsetTop - (mainHeader ? mainHeader.offsetHeight : 0);

                window.scrollTo({
                    top: offsetTop,
                    behavior: 'smooth'
                });

                // Menüyü kapat
                if (window.innerWidth <= 768 && navMenu && navMenu.classList.contains('active')) {
                    mobileToggle.click();
                }
            }
        });
    });

    // --- GDPR Notice Handling --- //
    if (gdprNotice && gdprAcceptButton) {
        const hasAcceptedGDPR = document.cookie.split('; ').some((item) => item.startsWith('bga_gdpr_accepted=true'));

        if (!hasAcceptedGDPR) {
            setTimeout(() => {
                gdprNotice.classList.add('show');
            }, 500); 
        }

        gdprAcceptButton.addEventListener('click', function() {
            gdprNotice.classList.remove('show');
            gdprNotice.addEventListener('transitionend', function handler() {
                gdprNotice.style.display = 'none';
                gdprNotice.removeEventListener('transitionend', handler);
            });
            
            const d = new Date();
            d.setTime(d.getTime() + (30*24*60*60*1000));
            const expires = "expires="+ d.toUTCString();
            document.cookie = "bga_gdpr_accepted=true;" + expires + ";path=/;SameSite=Lax";
        });
    }

});