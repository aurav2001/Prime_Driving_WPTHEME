/**
 * Driveria Theme JavaScript Interactivity & Hero Background Slider
 *
 * @package Driveria
 */

document.addEventListener('DOMContentLoaded', function () {
  'use strict';

  // 0. Hero Background Slideshow & Text Animation Trigger
  const slides = document.querySelectorAll('.hero-slide');
  let currentSlide = 0;

  function nextSlide() {
    if (!slides.length) return;
    slides[currentSlide].classList.remove('active');
    currentSlide = (currentSlide + 1) % slides.length;
    slides[currentSlide].classList.add('active');

    // Re-trigger text animations smoothly on slide change
    const animatedTexts = document.querySelectorAll('.animated-text-up');
    animatedTexts.forEach(el => {
      el.style.animation = 'none';
      void el.offsetWidth; // Trigger reflow
      el.style.animation = null;
    });
  }

  if (slides.length > 1) {
    setInterval(nextSlide, 4800);
  }

  // 0.1 Initialize Courses Slider Carousel with Swiper.js
  if (typeof Swiper !== 'undefined' && document.querySelector('.courses-swiper')) {
    new Swiper('.courses-swiper', {
      slidesPerView: 1,
      spaceBetween: 24,
      loop: true,
      autoplay: {
        delay: 4500,
        disableOnInteraction: false,
        pauseOnMouseEnter: true,
      },
      pagination: {
        el: '.courses-swiper-pagination',
        clickable: true,
      },
      navigation: {
        nextEl: '.courses-swiper-btn-next',
        prevEl: '.courses-swiper-btn-prev',
      },
      breakpoints: {
        640: {
          slidesPerView: 2,
          spaceBetween: 20,
        },
        1024: {
          slidesPerView: 3,
          spaceBetween: 30,
        }
      }
    });
  }

  // 1. Mobile Drawer Navigation
  const mobileMenuBtn = document.getElementById('mobileMenuBtn');
  const drawerCloseBtn = document.getElementById('drawerCloseBtn');
  const mobileDrawer = document.getElementById('mobileDrawer');

  if (mobileMenuBtn && mobileDrawer) {
    mobileMenuBtn.addEventListener('click', function () {
      mobileDrawer.classList.add('active');
    });
  }

  if (drawerCloseBtn && mobileDrawer) {
    drawerCloseBtn.addEventListener('click', function () {
      mobileDrawer.classList.remove('active');
    });
  }

  document.addEventListener('click', function (e) {
    if (mobileDrawer && mobileDrawer.classList.contains('active')) {
      if (!mobileDrawer.contains(e.target) && !mobileMenuBtn.contains(e.target)) {
        mobileDrawer.classList.remove('active');
      }
    }
  });

  // 2. Header Overlay to Sticky Shrink on Scroll
  const siteHeader = document.getElementById('site-header');
  window.addEventListener('scroll', function () {
    if (siteHeader) {
      if (window.scrollY > 60) {
        siteHeader.classList.add('scrolled');
      } else {
        siteHeader.classList.remove('scrolled');
      }
    }
  });

  // 3. Back to Top Button
  const backToTopBtn = document.getElementById('backToTop');
  if (backToTopBtn) {
    window.addEventListener('scroll', function () {
      if (window.scrollY > 400) {
        backToTopBtn.classList.add('visible');
      } else {
        backToTopBtn.classList.remove('visible');
      }
    });

    backToTopBtn.addEventListener('click', function () {
      window.scrollTo({
        top: 0,
        behavior: 'smooth'
      });
    });
  }

  // 4. Auto Select Course on "Enroll Now" or "Choose Plan" click
  const enrollBtns = document.querySelectorAll('.course-btn, .open-enroll-modal, [data-course]');
  const mainCourseSelect = document.getElementById('enroll_course_select');
  const modalCourseSelect = document.getElementById('modal_course_select');
  const enrollModalOverlay = document.getElementById('driveriaEnrollModal');
  const closeEnrollModalBtn = document.getElementById('closeEnrollModalBtn');

  function selectCourseInDropdown(selectEl, courseName) {
    if (!selectEl || !courseName) return;
    for (let i = 0; i < selectEl.options.length; i++) {
      if (selectEl.options[i].text.toLowerCase().includes(courseName.toLowerCase()) || 
          selectEl.options[i].value.toLowerCase().includes(courseName.toLowerCase())) {
        selectEl.selectedIndex = i;
        break;
      }
    }
  }

  enrollBtns.forEach(function (btn) {
    btn.addEventListener('click', function (e) {
      const courseName = this.getAttribute('data-course') || this.getAttribute('data-plan') || '';
      const enrollSection = document.getElementById('enroll-registration');

      if (enrollSection) {
        // If on homepage where enroll form section exists, smooth scroll down to it
        e.preventDefault();
        enrollSection.scrollIntoView({ behavior: 'smooth' });

        if (mainCourseSelect && courseName) {
          selectCourseInDropdown(mainCourseSelect, courseName);
        }

        const formCard = document.querySelector('.enroll-form-card-v2');
        if (formCard) {
          formCard.classList.remove('form-card-highlight');
          void formCard.offsetWidth; // Trigger reflow
          formCard.classList.add('form-card-highlight');
        }
      } else if (enrollModalOverlay) {
        // If on another page, open the Popup Modal!
        e.preventDefault();
        enrollModalOverlay.classList.add('active');

        if (modalCourseSelect && courseName) {
          selectCourseInDropdown(modalCourseSelect, courseName);
        }
      }
    });
  });

  if (closeEnrollModalBtn && enrollModalOverlay) {
    closeEnrollModalBtn.addEventListener('click', function () {
      enrollModalOverlay.classList.remove('active');
    });

    enrollModalOverlay.addEventListener('click', function (e) {
      if (e.target === enrollModalOverlay) {
        enrollModalOverlay.classList.remove('active');
      }
    });
  }

  // 4.1 Header Appointment Modal Popup Handler
  const appointmentModal = document.getElementById('driveriaAppointmentModal');
  const closeAppointmentModalBtn = document.getElementById('closeAppointmentModalBtn');
  const openAppointmentBtns = document.querySelectorAll('.open-appointment-modal, #headerAppointmentBtn');

  openAppointmentBtns.forEach(function (btn) {
    btn.addEventListener('click', function (e) {
      e.preventDefault();
      if (appointmentModal) {
        appointmentModal.classList.add('active');
      }
    });
  });

  if (closeAppointmentModalBtn && appointmentModal) {
    closeAppointmentModalBtn.addEventListener('click', function () {
      appointmentModal.classList.remove('active');
    });

    appointmentModal.addEventListener('click', function (e) {
      if (e.target === appointmentModal) {
        appointmentModal.classList.remove('active');
      }
    });
  }

  document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape' && appointmentModal && appointmentModal.classList.contains('active')) {
      appointmentModal.classList.remove('active');
    }
  });

  // 5. Universal AJAX Form Submission Handler (Handles all forms: Booking, Quick Enroll, Contact Page, Modal, Appointment, Sidebar)
  const ajaxForms = document.querySelectorAll('.driveria-ajax-form, #driveriaBookingForm, #driveriaQuickEnrollForm, #driveriaModalEnrollForm, #driveriaAppointmentForm, #driveria-contact-page-form, #driveriaSidebarEnrollForm');

  ajaxForms.forEach(function (form) {
    if (form.getAttribute('data-ajax-initialized') === 'true') return;
    form.setAttribute('data-ajax-initialized', 'true');

    form.addEventListener('submit', function (e) {
      e.preventDefault();

      const submitBtn = form.querySelector('button[type="submit"], input[type="submit"], .submit-btn, .btn-enroll-submit, .btn-shimmer-submit');
      const originalBtnHtml = submitBtn ? submitBtn.innerHTML : '';

      let responseMsgContainer = form.querySelector('.form-response-msg');
      if (!responseMsgContainer) {
        if (form.id === 'driveriaBookingForm') responseMsgContainer = document.getElementById('bookingFormResponse');
        else if (form.id === 'driveriaQuickEnrollForm') responseMsgContainer = document.getElementById('quickEnrollResponseMsg');
        else if (form.id === 'driveriaModalEnrollForm') responseMsgContainer = document.getElementById('modalEnrollResponseMsg');
        else if (form.id === 'driveriaAppointmentForm') responseMsgContainer = document.getElementById('appointmentFormResponseMsg');
      }

      if (!responseMsgContainer) {
        responseMsgContainer = document.createElement('div');
        responseMsgContainer.className = 'form-response-msg';
        form.appendChild(responseMsgContainer);
      }

      if (submitBtn) {
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<span>SUBMITTING...</span> <i class="fa-solid fa-spinner fa-spin"></i>';
      }

      responseMsgContainer.className = 'form-response-msg';
      responseMsgContainer.style.display = 'none';

      const formData = new FormData(form);
      formData.append('action', 'driveria_submit_booking');
      if (typeof driveria_ajax !== 'undefined' && driveria_ajax.nonce) {
        formData.append('nonce', driveria_ajax.nonce);
      }

      const ajaxUrl = (typeof driveria_ajax !== 'undefined' && driveria_ajax.ajax_url) ? driveria_ajax.ajax_url : '/wp-admin/admin-ajax.php';

      fetch(ajaxUrl, {
        method: 'POST',
        body: formData
      })
        .then(response => response.json())
        .then(data => {
          if (submitBtn) {
            submitBtn.disabled = false;
            submitBtn.innerHTML = originalBtnHtml;
          }

          responseMsgContainer.style.display = 'block';
          if (data && data.success) {
            responseMsgContainer.className = 'form-response-msg success';
            responseMsgContainer.textContent = (data.data && data.data.message) ? data.data.message : 'Thank you! Your submission has been received successfully.';
            form.reset();

            const bookingId = (data.data && data.data.booking_id) ? data.data.booking_id : 0;
            const redirectUrl = (data.data && data.data.redirect_url) ? data.data.redirect_url : '';
            const redirectEl = document.getElementById('driveriaActiveRedirectUrl');
            if (redirectEl) {
              redirectEl.value = redirectUrl;
            }

            // Pop up 3-Option Payment Choice Modal (Credit Card, Venmo, Zelle)
            setTimeout(function () {
              if (typeof openPaymentModal === 'function') {
                openPaymentModal(bookingId);
              }
            }, 600);
          } else {
            responseMsgContainer.className = 'form-response-msg error';
            responseMsgContainer.textContent = (data && data.data && data.data.message) ? data.data.message : 'An error occurred. Please try again.';
          }
        })
        .catch(err => {
          if (submitBtn) {
            submitBtn.disabled = false;
            submitBtn.innerHTML = originalBtnHtml;
          }
          responseMsgContainer.style.display = 'block';
          responseMsgContainer.className = 'form-response-msg success';
          responseMsgContainer.textContent = 'Thank you! Your request has been submitted successfully.';
          form.reset();
        });
    });
  });

  /**
   * Helper to launch Venmo Mobile App via Deep Link (venmo://) with Web Link fallback (https://venmo.com/)
   */
  window.driveriaOpenVenmo = function (appUrl, webUrl) {
    if (!appUrl) return;

    if (!appUrl.startsWith('venmo://')) {
      var raw = appUrl.trim();
      var clean = raw;
      if (raw.includes('venmo.com')) {
        var parts = raw.split('venmo.com/').pop().split('?')[0].replace(/^u\//, '');
        clean = parts.replace(/^@/, '');
      } else {
        clean = raw.replace(/^@/, '');
      }
      appUrl = 'venmo://paycharge?txn=pay&recipients=' + encodeURIComponent(clean);
      webUrl = /^\d+$/.test(clean) ? 'https://venmo.com/' + encodeURIComponent(clean) : 'https://venmo.com/u/' + encodeURIComponent(clean);
    }

    if (!webUrl) {
      webUrl = 'https://venmo.com/';
    }

    var isMobile = /Android|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);

    if (isMobile) {
      // 1. Try launching native Venmo app on smartphone
      window.location.href = appUrl;

      // 2. Set fallback: if app fails to open after 1.5 seconds, redirect to web URL
      setTimeout(function () {
        if (!document.hidden && !document.webkitHidden) {
          window.location.href = webUrl;
        }
      }, 1500);
    } else {
      // Desktop browser -> open web URL in a new tab
      window.open(webUrl, '_blank');
    }
  };

  // Intercept all Venmo links on page to automatically handle deep links for mobile app vs web
  document.addEventListener('click', function (e) {
    var target = e.target.closest('a[href*="venmo"]');
    if (target) {
      var href = target.getAttribute('href');
      if (href && (href.includes('venmo.com') || href.startsWith('venmo://'))) {
        e.preventDefault();
        window.driveriaOpenVenmo(href);
      }
    }
  });

  // =========================================================================
  // 11. 3-Option Payment Modal Logic (Credit Card, Venmo, Zelle) & Deep Linking
  // =========================================================================
  const paymentModal = document.getElementById('driveriaPaymentModal');
  const paymentModalCloseBtn = document.getElementById('paymentModalCloseBtn');
  const btnCloseNoticeBtn = document.getElementById('btnCloseNoticeBtn');
  const paymentModalGrid = document.getElementById('paymentModalGrid');
  const paymentSuccessNoticeBox = document.getElementById('paymentSuccessNoticeBox');
  const noticeDetails = document.getElementById('noticeDetails');

  window.openPaymentModal = function(bookingId) {
    if (paymentModal) {
      if (bookingId && document.getElementById('driveriaActiveBookingId')) {
        document.getElementById('driveriaActiveBookingId').value = bookingId;
      }
      if (paymentModalGrid) paymentModalGrid.style.display = 'grid';
      if (paymentSuccessNoticeBox) paymentSuccessNoticeBox.style.display = 'none';
      paymentModal.style.display = 'flex';
    }
  };

  function closePaymentModal() {
    if (paymentModal) {
      paymentModal.style.display = 'none';
    }
  }

  if (paymentModalCloseBtn) paymentModalCloseBtn.addEventListener('click', closePaymentModal);
  if (btnCloseNoticeBtn) btnCloseNoticeBtn.addEventListener('click', closePaymentModal);

  // Helper to send AJAX payment selection
  function processPaymentSelection(methodName, callback) {
    const bookingIdEl = document.getElementById('driveriaActiveBookingId');
    const bookingId = bookingIdEl ? bookingIdEl.value : 0;
    const ajaxUrl = (typeof driveria_ajax !== 'undefined' && driveria_ajax.ajax_url) ? driveria_ajax.ajax_url : '/wp-admin/admin-ajax.php';

    const formData = new FormData();
    formData.append('action', 'driveria_select_payment_method');
    formData.append('booking_id', bookingId);
    formData.append('payment_method', methodName);

    fetch(ajaxUrl, {
      method: 'POST',
      body: formData
    })
      .then(res => res.json())
      .then(data => {
        if (callback) callback(data);
      })
      .catch(err => {
        if (callback) callback({ success: true });
      });
  }

  // 1. Credit Card Click
  const btnPayCreditCard = document.getElementById('btnPayCreditCard');
  if (btnPayCreditCard) {
    btnPayCreditCard.addEventListener('click', function () {
      const activeRedirectEl = document.getElementById('driveriaActiveRedirectUrl');
      const fallbackRedirectEl = document.getElementById('driveriaCheckoutFallbackUrl');
      const specificUrl = activeRedirectEl ? activeRedirectEl.value : '';
      const fallbackUrl = fallbackRedirectEl ? fallbackRedirectEl.value : '/checkout/';
      const finalRedirectUrl = specificUrl ? specificUrl : fallbackUrl;
      
      processPaymentSelection('Credit Card', function () {
        window.location.href = finalRedirectUrl;
      });
    });
  }

  // 2. Venmo Click (Attempts native App launch on mobile + fallback to web)
  const btnPayVenmo = document.getElementById('btnPayVenmo');
  if (btnPayVenmo) {
    btnPayVenmo.addEventListener('click', function () {
      btnPayVenmo.disabled = true;
      btnPayVenmo.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Processing...';
      processPaymentSelection('Venmo', function (res) {
        btnPayVenmo.disabled = false;
        btnPayVenmo.innerHTML = 'Pay Now';
        if (paymentModalGrid) paymentModalGrid.style.display = 'none';
        if (paymentSuccessNoticeBox) paymentSuccessNoticeBox.style.display = 'block';

        const handle = (res && res.data && res.data.venmo_handle) ? res.data.venmo_handle : 'Prime Driving SCHOOL';
        const num = (res && res.data && res.data.venmo_num) ? res.data.venmo_num : '5715013404';
        const appUrl = (res && res.data && res.data.venmo_app_url) ? res.data.venmo_app_url : 'venmo://paycharge?txn=pay&recipients=' + encodeURIComponent(handle);
        const webUrl = (res && res.data && res.data.venmo_web_url) ? res.data.venmo_web_url : 'https://venmo.com/u/' + encodeURIComponent(handle);

        if (noticeDetails) {
          noticeDetails.innerHTML = `
            <div class="notice-detail-row"><strong>Venmo Account:</strong> <span>${handle}</span></div>
            <div class="notice-detail-row"><strong>Phone / ID:</strong> <span>${num}</span></div>
            <div class="notice-detail-row"><strong>Status:</strong> <span class="badge-green">Details Sent To Your Gmail</span></div>
            <a href="${appUrl}" onclick="event.preventDefault(); window.driveriaOpenVenmo('${appUrl}', '${webUrl}');" class="btn-venmo-direct"><i class="fa-brands fa-vimeo-v"></i> 📱 Open in Venmo App</a>
          `;
        }

        // Auto trigger app open on mobile
        setTimeout(function () {
          window.driveriaOpenVenmo(appUrl, webUrl);
        }, 300);
      });
    });
  }

  // 3. Zelle Click
  const btnPayZelle = document.getElementById('btnPayZelle');
  if (btnPayZelle) {
    btnPayZelle.addEventListener('click', function () {
      btnPayZelle.disabled = true;
      btnPayZelle.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Processing...';
      processPaymentSelection('Zelle', function (res) {
        btnPayZelle.disabled = false;
        btnPayZelle.innerHTML = 'Pay By Zelle';
        if (paymentModalGrid) paymentModalGrid.style.display = 'none';
        if (paymentSuccessNoticeBox) paymentSuccessNoticeBox.style.display = 'block';

        const handle = (res && res.data && res.data.zelle_handle) ? res.data.zelle_handle : 'Prime Driving SCHOOL';
        const num = (res && res.data && res.data.zelle_num) ? res.data.zelle_num : '5715013404';

        if (noticeDetails) {
          noticeDetails.innerHTML = `
            <div class="notice-detail-row"><strong>Zelle Recipient:</strong> <span>${handle}</span></div>
            <div class="notice-detail-row"><strong>Zelle Phone / ID:</strong> <span>${num}</span></div>
            <div class="notice-detail-row"><strong>Status:</strong> <span class="badge-green">Receipt Sent To Your Gmail</span></div>
          `;
        }
      });
    });
  }

  // 6. Course Archive Category Filter
  const filterBtns = document.querySelectorAll('.filter-btn');
  const courseItems = document.querySelectorAll('.course-card.filter-item');

  filterBtns.forEach(btn => {
    btn.addEventListener('click', function () {
      filterBtns.forEach(b => b.classList.remove('active'));
      this.classList.add('active');

      const filterValue = this.getAttribute('data-filter');

      courseItems.forEach(item => {
        const itemCategory = item.getAttribute('data-category');
        if (filterValue === 'all' || !itemCategory || itemCategory === filterValue) {
          item.style.display = 'flex';
          item.style.opacity = '0';
          setTimeout(() => { item.style.opacity = '1'; }, 50);
        } else {
          item.style.display = 'none';
        }
      });
    });
  });

  // 7. FAQ Accordion Toggle Handler
  const faqQuestions = document.querySelectorAll('.faq-question');
  faqQuestions.forEach(function (btn) {
    btn.addEventListener('click', function () {
      const item = this.closest('.faq-accordion-item');
      if (!item) return;
      const isActive = item.classList.contains('active');

      document.querySelectorAll('.faq-accordion-item').forEach(el => {
        el.classList.remove('active');
      });

      if (!isActive) {
        item.classList.add('active');
      }
    });
  });

  // =========================================================================
  // 8. Intersection Observer for Scroll-Triggered Reveal Animations
  // =========================================================================
  const revealElements = document.querySelectorAll(
    '.reveal-item, .section-title-wrap, .why-us-image-wrap, .why-us-content, .course-card-v2, .pricing-card-v2, .instructor-card-v2, .testimonial-card-v2, .stat-card-v2, .value-card-v2, .trust-item, .driveria-contact-cards .contact-card, .faq-accordion-item'
  );

  if ('IntersectionObserver' in window && revealElements.length > 0) {
    const revealObserver = new IntersectionObserver(
      function (entries, observer) {
        entries.forEach(function (entry) {
          if (entry.isIntersecting) {
            entry.target.classList.add('is-revealed');
            observer.unobserve(entry.target);
          }
        });
      },
      {
        root: null,
        threshold: 0.08,
        rootMargin: '0px 0px -30px 0px'
      }
    );

    revealElements.forEach(function (el) {
      const rect = el.getBoundingClientRect();
      if (rect.top < window.innerHeight && rect.bottom > 0) {
        el.classList.add('is-revealed');
      } else {
        revealObserver.observe(el);
      }
    });
  } else {
    revealElements.forEach(function (el) {
      el.classList.add('is-revealed');
    });
  }
});


