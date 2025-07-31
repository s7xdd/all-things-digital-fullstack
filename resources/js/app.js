/* =========================================================================
   1. Imports: UI libraries & CSS
   ========================================================================== */
import Alpine from 'alpinejs';
import '../css/app.css';

import Swiper from 'swiper/bundle';
import 'swiper/css/bundle';

import gsap from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';

let ScrollSmoother;
try {
  ScrollSmoother = require('gsap/ScrollSmoother').default || require('gsap/ScrollSmoother');
  gsap.registerPlugin(ScrollSmoother);
  window.ScrollSmoother = ScrollSmoother;
} catch (e) {
  // ScrollSmoother plugin not found - ignore
}

import Splitting from 'splitting';
import 'splitting/dist/splitting.css';

// Register GSAP plugins
gsap.registerPlugin(ScrollTrigger);

// Expose globals if needed
window.gsap = gsap;
window.ScrollTrigger = ScrollTrigger;
window.Swiper = Swiper;
window.Alpine = Alpine;

// Initialize Alpine.js
Alpine.start();


/* =========================================================================
   2. Main Initialization: DOMContentLoaded
   ========================================================================== */
document.addEventListener('DOMContentLoaded', () => {

  /* ---------------------------------------------------------------------------
     2.1 Smooth scrolling for anchor links (# anchors)
     --------------------------------------------------------------------------- */
  document.querySelectorAll('a[href^="#"]').forEach(link => {
    const hash = link.getAttribute('href');
    if (hash && hash.length > 1) {
      link.addEventListener('click', e => {
        const target = document.getElementById(hash.slice(1));
        if (target) {
          e.preventDefault();
          window.scrollTo({ top: target.offsetTop - 80, behavior: 'smooth' });
        }
      });
    }
  });


  /* ---------------------------------------------------------------------------
     2.2 Initialize GSAP ScrollSmoother if available
     --------------------------------------------------------------------------- */
  if (window.ScrollSmoother) {
    window.scrollSmoother = ScrollSmoother.create({
      smooth: 1.2,
      effects: true,
      normalizeScroll: true,
    });
  }


  /* ---------------------------------------------------------------------------
     2.3 Sticky header animation & padding adjustment on scroll/resize
     --------------------------------------------------------------------------- */
  const header = document.getElementById('main-header');
  const logo = header?.querySelector('img');
  const inner = header?.querySelector('.header-inner');

  if (header && logo && inner) {
    gsap.fromTo(header,
      { y: -60, opacity: 0 },
      { y: 0, opacity: 1, duration: 0.72, ease: 'power3.out', delay: 0.1 }
    );

    const getHeaderPaddings = (isSticky) => {
      if (window.innerWidth >= 768) {
        return isSticky
          ? { paddingTop: 12, paddingBottom: 12 }
          : { paddingTop: 24, paddingBottom: 24 };
      }
      return isSticky
        ? { paddingTop: 8, paddingBottom: 8 }
        : { paddingTop: 16, paddingBottom: 16 };
    };

    const updateHeaderGlass = () => {
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
    };

    updateHeaderGlass();
    window.addEventListener('scroll', updateHeaderGlass, { passive: true });
    window.addEventListener('resize', updateHeaderGlass);
  }


  /* ---------------------------------------------------------------------------
     2.4 Initialize Swiper slider & handle hero slide videos and progress bar
     --------------------------------------------------------------------------- */
  const swiperEl = document.getElementById('hero-swiper');
  const progressEl = document.getElementById('hero-slider-progress');

  if (swiperEl && Swiper) {
    const swiper = new Swiper('#hero-swiper', {
      speed: 700,
      loop: true,
      effect: 'fade',
      fadeEffect: { crossFade: true },
      navigation: {
        nextEl: '#hero-swiper-next',
        prevEl: '#hero-swiper-prev',
      },
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
      },
    });

    function handleActiveSlideVideo(swiperInstance) {
      swiperInstance.slides.forEach((slide, idx) => {
        const video = slide.querySelector('video');
        if (video) {
          if (idx === swiperInstance.activeIndex) {
            setTimeout(() => video.play().catch(() => {}), 100);
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
      gsap.fromTo(elements, { y: 60, opacity: 0 }, { y: 0, opacity: 1, stagger: 0.1, duration: 1, ease: 'power2.out' });
    }

    function updateSwiperProgress(swiperInstance) {
      if (!progressEl) return;
      const total = swiperInstance.slides.length - (swiperInstance.params.loop ? 2 : 0);
      const progress = (swiperInstance.realIndex % total) / (total - 1);
      progressEl.style.width = `${Math.max(0, progress) * 100}%`;
      progressEl.style.transition = 'width 0.45s cubic-bezier(.4,0,.2,1)';
    }
  }


  /* ---------------------------------------------------------------------------
     2.5 Animate page sections with GSAP and ScrollTrigger
     --------------------------------------------------------------------------- */
  try {
    const scrollAnimOptions = { duration: 1, ease: 'power3.out' };

    if (document.querySelector('#about-title')) {
      gsap.from('#about-title', {
        y: 50, opacity: 0, ...scrollAnimOptions,
        scrollTrigger: { trigger: '#about-title', start: 'top 80%' }
      });
    }

    if (document.querySelector('#about-text')) {
      gsap.from('#about-text', {
        y: 50, opacity: 0, delay: 0.2, ...scrollAnimOptions,
        scrollTrigger: { trigger: '#about-text', start: 'top 80%' }
      });
    }

    if (document.querySelector('#about-button')) {
      gsap.from('#about-button', {
        scale: 0.95, opacity: 0, delay: 0.4, duration: 0.8, ease: 'back.out(1.7)',
        scrollTrigger: { trigger: '#about-button', start: 'top 90%' }
      });
    }

    if (document.querySelector('#about-stats')) {
      gsap.from('#about-stats > div', {
        opacity: 0, y: 30, duration: 1, ease: 'power2.out', stagger: 0.2,
        scrollTrigger: { trigger: '#about-stats', start: 'top 85%' }
      });

      ScrollTrigger.create({
        trigger: '#about-stats',
        start: 'top 85%',
        once: true,
        onEnter: () => {
          document.querySelectorAll('.counter').forEach(el => {
            const target = parseInt(el.dataset.count);
            const suffix = el.dataset.suffix || '';
            gsap.fromTo(el, { innerText: 0 }, {
              innerText: target,
              duration: 2,
              ease: 'power3.out',
              snap: 'innerText',
              onUpdate() {
                el.innerText = `${Math.round(this.targets()[0].innerText)}${suffix}`;
              }
            });
          });
        }
      });
    }
  } catch (e) {
    // Prevent script failure if elements or plugins missing
  }


  /* ---------------------------------------------------------------------------
     2.6 Initialize Trusted Logos Swiper and animations
     --------------------------------------------------------------------------- */
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
      allowTouchMove: false,
    });
  }

  if (document.querySelector('#trusted-heading')) {
    gsap.from('#trusted-heading', {
      opacity: 0, y: 40, duration: 1, ease: 'power3.out',
      scrollTrigger: { trigger: '#trusted-heading', start: 'top 85%' }
    });
  }

  if (document.querySelectorAll('#trusted-logos .swiper-slide').length) {
    gsap.from('#trusted-logos .swiper-slide', {
      opacity: 0, scale: 0.8, duration: 0.6, stagger: 0.15, ease: 'power3.out',
      scrollTrigger: { trigger: '#trusted-logos', start: 'top 90%' }
    });
  }


  /* ---------------------------------------------------------------------------
     2.7 Animate Services section - sticky left and cards
     --------------------------------------------------------------------------- */
  if (document.querySelector('#services-left')) {
    gsap.from('#services-left', {
      x: -48, duration: 1.2, ease: 'power3.out',
      scrollTrigger: { trigger: '#services-left', start: 'top 75%', once: true }
    });
  }


  /* ---------------------------------------------------------------------------
     2.8 Animate cards in services section with stagger
     --------------------------------------------------------------------------- */
  if (window.gsap && window.ScrollTrigger) {
    const cards = gsap.utils.toArray('#services-cards .fade-up');
    if (cards.length) {
      gsap.timeline({
        scrollTrigger: {
          trigger: '#services-cards',
          start: 'top 85%',
          end: 'bottom',
          scrub: 1
        }
      }).from(cards, { y: 60, opacity: 0, stagger: 0.15, duration: 0.7, ease: 'power2.out' });
    }
  }


  /* ---------------------------------------------------------------------------
     2.9 Animate CTA section
     --------------------------------------------------------------------------- */
  if (document.querySelector('#cta-section')) {
    gsap.from('#cta-section', {
      y: 80, opacity: 0, duration: 1, ease: 'power3.out',
      scrollTrigger: { trigger: '#cta-section', start: 'top 84%', once: true }
    });
  }


  /* ---------------------------------------------------------------------------
     2.10 IntersectionObserver for '.fade-up' elements
     --------------------------------------------------------------------------- */
  if ('IntersectionObserver' in window) {
    const observer = new IntersectionObserver((entries, observerInstance) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('show');
          observerInstance.unobserve(entry.target);
        }
      });
    }, { threshold: 0.1 });

    document.querySelectorAll('.fade-up').forEach(el => observer.observe(el));
  }


  /* ---------------------------------------------------------------------------
     2.11 Initialize Splitting.js and other optional text effects
     --------------------------------------------------------------------------- */
  Splitting();
});
