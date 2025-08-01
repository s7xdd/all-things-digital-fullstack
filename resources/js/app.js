/* =========================================================================
   1. Imports: UI libraries & CSS
   ========================================================================= */
import Alpine from 'alpinejs';
import '../css/app.css';

import Swiper from 'swiper/bundle';
import 'swiper/css/bundle';

import gsap from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';

import Splitting from 'splitting';
import 'splitting/dist/splitting.css';

// GSAP ScrollSmoother (if available)
let ScrollSmoother;
try {
  ScrollSmoother = require('gsap/ScrollSmoother').default || require('gsap/ScrollSmoother');
  gsap.registerPlugin(ScrollSmoother);
  window.ScrollSmoother = ScrollSmoother;
} catch (e) {}

gsap.registerPlugin(ScrollTrigger);
window.gsap = gsap;
window.ScrollTrigger = ScrollTrigger;
window.Swiper = Swiper;
window.Alpine = Alpine;
Alpine.start();

/* =========================================================================
   2. Main JS
   ========================================================================= */
document.addEventListener('DOMContentLoaded', () => {

  // ===================== Native Anchor Smooth Scroll =====================
  document.querySelectorAll('a[href^="#"]').forEach(link => {
    const hash = link.getAttribute('href');
    if (hash && hash.length > 1) {
      link.addEventListener('click', function (e) {
        const target = document.getElementById(hash.substring(1));
        if (target) {
          e.preventDefault();
          window.scrollTo({ top: target.offsetTop - 80, behavior: 'smooth' });
        }
      });
    }
  });

  // ========================= GSAP ScrollSmoother =========================
  if (window.ScrollSmoother) {
    window.scrollSmoother = window.ScrollSmoother.create({
      smooth: 1.2,
      effects: true,
      normalizeScroll: true,
    });
  }

  // ===================== Sticky Header GSAP Animation ====================
  const header = document.getElementById('main-header');
  const logo = header?.querySelector('img');
  const inner = header?.querySelector('.header-inner');

  if (header && logo && inner) {
    gsap.fromTo(header, { y: -60, opacity: 0 }, {
      y: 0,
      opacity: 1,
      duration: 0.72,
      ease: 'power3.out',
      delay: 0.1
    });

    function getHeaderPaddings(isSticky) {
      if (window.innerWidth >= 768) {
        return isSticky ? { paddingTop: 12, paddingBottom: 12 } : { paddingTop: 24, paddingBottom: 24 };
      } else {
        return isSticky ? { paddingTop: 8, paddingBottom: 8 } : { paddingTop: 16, paddingBottom: 16 };
      }
    }

    function updateHeaderGlass() {
      if (window.scrollY > 10) {
        header.classList.add('header-glass');
        gsap.to(logo, { height: '28px', duration: 0.44, ease: 'power2.out' });
        const { paddingTop, paddingBottom } = getHeaderPaddings(true);
        gsap.to(inner, { paddingTop, paddingBottom, duration: 0.44, ease: 'power2.out' });
      } else {
        header.classList.remove('header-glass');
        gsap.to(logo, { height: '40px', duration: 0.44, ease: 'power2.out' });
        const { paddingTop, paddingBottom } = getHeaderPaddings(false);
        gsap.to(inner, { paddingTop, paddingBottom, duration: 0.44, ease: 'power2.out' });
      }
    }

    updateHeaderGlass();
    window.addEventListener('scroll', updateHeaderGlass, { passive: true });
    window.addEventListener('resize', updateHeaderGlass);
  }

  // ======================== Hero Swiper Section ========================
  const swiperEl = document.getElementById('hero-swiper');
  const progressEl = document.getElementById('hero-swiper-progress');

  if (swiperEl && window.Swiper) {
    const swiper = new window.Swiper('#hero-swiper', {
      speed: 700,
      loop: true,
      effect: 'fade',
      fadeEffect: { crossFade: true },
      navigation: { nextEl: '#hero-swiper-next', prevEl: '#hero-swiper-prev' },
      on: {
        init() {
          handleActiveSlideVideo(this);
          animateHeroSlide(this.realIndex + 1);
          updateSwiperProgress(this);
        },
        slideChangeTransitionEnd() {
          handleActiveSlideVideo(this);
          animateHeroSlide(this.realIndex + 1);
          updateSwiperProgress(this);
        }
      }
    });

    function handleActiveSlideVideo(swiperInstance) {
      swiperInstance.slides.forEach((slide, idx) => {
        const video = slide.querySelector('video');
        if (video) {
          if (idx === swiperInstance.activeIndex) {
            setTimeout(() => { video.play().catch(() => {}) }, 100);
          } else {
            video.pause();
            video.currentTime = 0;
          }
        }
      });
    }

    function animateHeroSlide(index) {
      const elements = document.querySelectorAll(`#hero-slide-content-${index} .gsap-animate`);
      if (!elements.length) return;
      gsap.fromTo(elements, { y: 60, opacity: 0 }, { y: 0, opacity: 1, stagger: 0.1, duration: 1.0, ease: "power2.out" });
    }

    function updateSwiperProgress(swiperInstance) {
      if (!progressEl) return;
      const total = swiperInstance.slides.length - (swiperInstance.params.loop ? 2 : 0);
      const progress = (swiperInstance.realIndex % total) / (total - 1);
      progressEl.style.width = `${Math.max(0, progress) * 100}%`;
      progressEl.style.transition = 'width 0.45s cubic-bezier(.4,0,.2,1)';
    }
  }

  // ========================= About Section GSAP Reveal =========================
  gsap.from("#about-title", {
    y: 50, opacity: 0, duration: 1, ease: "power3.out",
    scrollTrigger: { trigger: "#about-title", start: "top 80%" }
  });

  gsap.from("#about-text", {
    y: 50, opacity: 0, duration: 1, delay: 0.2, ease: "power3.out",
    scrollTrigger: { trigger: "#about-text", start: "top 80%" }
  });

  gsap.from("#about-button", {
    scale: 0.95, opacity: 0, duration: 0.8, delay: 0.4, ease: "back.out(1.7)",
    scrollTrigger: { trigger: "#about-button", start: "top 90%" }
  });

  gsap.from("#about-stats > div", {
    opacity: 0, y: 30, duration: 1, ease: "power2.out", stagger: 0.2,
    scrollTrigger: { trigger: "#about-stats", start: "top 85%" }
  });

  ScrollTrigger.create({
    trigger: "#about-stats",
    start: "top 85%",
    once: true,
    onEnter: () => {
      document.querySelectorAll('.counter').forEach((el) => {
        const target = parseInt(el.dataset.count);
        const suffix = el.dataset.suffix || '';
        gsap.fromTo(el, { innerText: 0 }, {
          innerText: target,
          duration: 2,
          ease: "power3.out",
          snap: "innerText",
          onUpdate: function () {
            const value = Math.round(this.targets()[0].innerText);
            el.innerText = `${value}${suffix}`;
          }
        });
      });
    }
  });

  // ======================= Trusted by Industry Leaders =========================
  if (window.Swiper && document.getElementById('leaders-swiper')) {
    new Swiper('#leaders-swiper', {
      loop: true,
      autoplay: { delay: 2500, disableOnInteraction: false },
      slidesPerView: 3,
      spaceBetween: 24,
      breakpoints: {
        640: { slidesPerView: 4 },
        1024: { slidesPerView: 6 },
        1280: { slidesPerView: 6 },
      },
      allowTouchMove: false
    });
  }

  gsap.from("#trusted-heading", {
    opacity: 0, y: 40, duration: 1, ease: "power2.out",
    scrollTrigger: { trigger: "#trusted-heading", start: "top 85%" }
  });

  gsap.from("#trusted-logos .swiper-slide", {
    opacity: 0, scale: 0.8, duration: 0.6, stagger: 0.15, ease: "power2.out",
    scrollTrigger: { trigger: "#trusted-logos", start: "top 90%" }
  });

  // ============================= Services Section =========================
  gsap.from("#services-left", {
    x: -48, duration: 1.2, ease: "power2.out",
    scrollTrigger: { trigger: "#services-section", start: "top 75%", once: true }
  });

  // ========================= Fade-up GSAP for Cards in Services =================
  const cards = gsap.utils.toArray("#services-cards .fade-up");
  gsap.timeline({
    scrollTrigger: {
      trigger: "#services-cards",
      start: "top 85%",
      end: "bottom 10%",
      scrub: 1,
    }
  }).from(cards, {
    y: 60,
    opacity: 0,
    stagger: { each: 0.15 },
    duration: 0.7,
    ease: "power2.out"
  });

  // ============================== CTA Section ===========================
  gsap.from("#cta-section", {
    y: 80, opacity: 0, duration: 1, ease: "power2.out",
    scrollTrigger: { trigger: "#cta-section", start: "top 84%", once: true }
  });

  // =============================== IntersectionObserver ==============================
  if ('IntersectionObserver' in window) {
    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add("show");
          observer.unobserve(entry.target);
        }
      });
    }, { threshold: 0.1 });

    document.querySelectorAll(".fade-up").forEach(el => observer.observe(el));
  }

}); // End of DOMContentLoaded
