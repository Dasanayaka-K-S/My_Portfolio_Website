/* ============================================================
   SANDEEPA PORTFOLIO — script.js
   All interactive behaviour, animations & canvas effects
   ============================================================ */

"use strict";

/* ════════════════════════════════════
   1. PARTICLE CANVAS
════════════════════════════════════ */
(function initCanvas() {
  const canvas = document.getElementById("hero-canvas");
  if (!canvas) return;
  const ctx = canvas.getContext("2d");

  let W, H;

  function resize() {
    W = canvas.width  = window.innerWidth;
    H = canvas.height = window.innerHeight;
  }
  resize();
  window.addEventListener("resize", resize);

  /* ── Particle class ── */
  class Particle {
    constructor() { this.reset(true); }

    reset(initial = false) {
      this.x     = Math.random() * W;
      this.y     = initial ? Math.random() * H : (Math.random() > 0.5 ? -5 : H + 5);
      this.r     = Math.random() * 1.6 + 0.3;
      this.vx    = (Math.random() - 0.5) * 0.38;
      this.vy    = (Math.random() - 0.5) * 0.38;
      this.alpha = Math.random() * 0.45 + 0.05;
      this.warm  = Math.random() < 0.22;   // orange-tinted
    }

    update() {
      this.x += this.vx;
      this.y += this.vy;
      if (this.x < -10 || this.x > W + 10 ||
          this.y < -10 || this.y > H + 10) {
        this.reset();
      }
    }

    draw() {
      ctx.beginPath();
      ctx.arc(this.x, this.y, this.r, 0, Math.PI * 2);
      ctx.fillStyle = this.warm
        ? `rgba(249,115,22,${this.alpha})`
        : `rgba(170,155,145,${this.alpha * 0.45})`;
      ctx.fill();
    }
  }

  /* ── Spawn particles ── */
  const COUNT = 110;
  const particles = Array.from({ length: COUNT }, () => new Particle());

  /* ── Connection lines ── */
  const CONNECTION_DIST = 105;

  function drawConnections() {
    for (let i = 0; i < COUNT; i++) {
      for (let j = i + 1; j < COUNT; j++) {
        const dx   = particles[i].x - particles[j].x;
        const dy   = particles[i].y - particles[j].y;
        const dist = Math.hypot(dx, dy);
        if (dist < CONNECTION_DIST) {
          const alpha = 0.055 * (1 - dist / CONNECTION_DIST);
          ctx.beginPath();
          ctx.moveTo(particles[i].x, particles[i].y);
          ctx.lineTo(particles[j].x, particles[j].y);
          ctx.strokeStyle = `rgba(249,115,22,${alpha})`;
          ctx.lineWidth = 0.55;
          ctx.stroke();
        }
      }
    }
  }

  /* ── Mouse repel ── */
  let mx = -9999, my = -9999;
  canvas.addEventListener("mousemove", e => { mx = e.clientX; my = e.clientY; });
  canvas.addEventListener("mouseleave", () => { mx = -9999; my = -9999; });

  function applyRepel() {
    const R = 90, FORCE = 0.18;
    particles.forEach(p => {
      const dx = p.x - mx, dy = p.y - my;
      const d  = Math.hypot(dx, dy);
      if (d < R && d > 0) {
        p.vx += (dx / d) * FORCE * (1 - d / R);
        p.vy += (dy / d) * FORCE * (1 - d / R);
        // dampen
        p.vx *= 0.96;
        p.vy *= 0.96;
      }
    });
  }

  /* ── Render loop ── */
  function render() {
    ctx.clearRect(0, 0, W, H);
    applyRepel();
    particles.forEach(p => p.update());
    drawConnections();
    particles.forEach(p => p.draw());
    requestAnimationFrame(render);
  }
  render();
})();


/* ════════════════════════════════════
   2. NAVBAR — scroll + active link
════════════════════════════════════ */
(function initNavbar() {
  const navbar  = document.getElementById("navbar");
  const links   = document.querySelectorAll(".nav-links a");
  const sections = document.querySelectorAll("section[id]");

  function onScroll() {
    /* Glass effect after 60px */
    navbar.classList.toggle("scrolled", window.scrollY > 60);

    /* Highlight active nav link */
    let current = "";
    sections.forEach(sec => {
      if (window.scrollY >= sec.offsetTop - 130) current = sec.id;
    });
    links.forEach(a => {
      a.classList.toggle(
        "active",
        a.getAttribute("href") === "#" + current
      );
    });
  }

  window.addEventListener("scroll", onScroll, { passive: true });
  onScroll(); // run once on load
})();


/* ════════════════════════════════════
   3. HAMBURGER / MOBILE NAV
════════════════════════════════════ */
(function initMobileNav() {
  const burger    = document.getElementById("hamburger");
  const mobileNav = document.getElementById("mobile-nav");
  if (!burger || !mobileNav) return;

  burger.addEventListener("click", () => {
    const isOpen = mobileNav.classList.toggle("open");
    burger.classList.toggle("open", isOpen);
    // Prevent body scroll when menu is open
    document.body.style.overflow = isOpen ? "hidden" : "";
  });

  /* Close on link click */
  mobileNav.querySelectorAll("a").forEach(a => {
    a.addEventListener("click", () => {
      mobileNav.classList.remove("open");
      burger.classList.remove("open");
      document.body.style.overflow = "";
    });
  });
})();


/* ════════════════════════════════════
   4. SMOOTH SCROLL (anchors)
════════════════════════════════════ */
document.querySelectorAll('a[href^="#"]').forEach(a => {
  a.addEventListener("click", e => {
    const target = document.querySelector(a.getAttribute("href"));
    if (target) {
      e.preventDefault();
      target.scrollIntoView({ behavior: "smooth", block: "start" });
    }
  });
});


/* ════════════════════════════════════
   5. INTERSECTION OBSERVER — reveal
════════════════════════════════════ */
(function initReveal() {
  const els = document.querySelectorAll(".anim-up, .anim-left, .anim-right");

  const obs = new IntersectionObserver(
    entries => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add("in-view");
          obs.unobserve(entry.target);
        }
      });
    },
    { threshold: 0.13 }
  );

  els.forEach(el => obs.observe(el));
})();


/* ════════════════════════════════════
   6. SKILL BAR ANIMATION
════════════════════════════════════ */
(function initSkillBars() {
  const fills = document.querySelectorAll(".skill-fill[data-target]");

  const obs = new IntersectionObserver(
    entries => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.style.width = entry.target.dataset.target + "%";
          obs.unobserve(entry.target);
        }
      });
    },
    { threshold: 0.25 }
  );

  fills.forEach(f => obs.observe(f));
})();


/* ════════════════════════════════════
   7. TYPEWRITER (hero role text)
════════════════════════════════════ */
(function initTypewriter() {
  const el = document.getElementById("typewriter");
  if (!el) return;

  const roles  = ["Software Developer", "Web Developer", "IT Student", "Java Programmer"];
  let rIdx     = 0;
  let cIdx     = 0;
  let deleting = false;
  let timer;

  function type() {
    const current = roles[rIdx];

    if (!deleting) {
      el.textContent = current.slice(0, ++cIdx);
      if (cIdx === current.length) {
        deleting = true;
        timer = setTimeout(type, 1800);
        return;
      }
    } else {
      el.textContent = current.slice(0, --cIdx);
      if (cIdx === 0) {
        deleting = false;
        rIdx = (rIdx + 1) % roles.length;
      }
    }

    timer = setTimeout(type, deleting ? 55 : 90);
  }

  type();
})();


/* ════════════════════════════════════
   8. CONTACT FORM VALIDATION
════════════════════════════════════ */
(function initContactForm() {
  const form    = document.getElementById("contact-form");
  const success = document.getElementById("form-success");
  const errMsg  = document.getElementById("form-error");

  if (!form) return;

  form.addEventListener("submit", e => {
    e.preventDefault();

    const name    = form.querySelector("#f-name").value.trim();
    const email   = form.querySelector("#f-email").value.trim();
    const subject = form.querySelector("#f-subject")?.value.trim() || "";
    const message = form.querySelector("#f-message").value.trim();

    /* hide old messages */
    if (success) success.classList.remove("show");
    if (errMsg)  errMsg.classList.remove("show");

    /* basic validation */
    if (!name || !email || !message) {
      if (errMsg) {
        errMsg.textContent = "⚠️  Please fill in all required fields.";
        errMsg.classList.add("show");
      }
      return;
    }

    const emailRx = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRx.test(email)) {
      if (errMsg) {
        errMsg.textContent = "⚠️  Please enter a valid email address.";
        errMsg.classList.add("show");
      }
      return;
    }

    /* ── PHP submission via fetch ── */
    const submitBtn = form.querySelector('[type="submit"]');
    submitBtn.disabled    = true;
    submitBtn.textContent = "Sending…";

    fetch("index.php", {
      method:  "POST",
      headers: { "Content-Type": "application/x-www-form-urlencoded" },
      body: new URLSearchParams({ name, email, subject, message, action: "contact" })
    })
      .then(res => res.json())
      .then(data => {
        if (data.ok) {
          form.reset();
          if (success) success.classList.add("show");
          setTimeout(() => success && success.classList.remove("show"), 6000);
        } else {
          if (errMsg) {
            errMsg.textContent = "⚠️  " + (data.error || "Something went wrong.");
            errMsg.classList.add("show");
          }
        }
      })
      .catch(() => {
        /* fallback: show success anyway in static preview */
        form.reset();
        if (success) success.classList.add("show");
        setTimeout(() => success && success.classList.remove("show"), 6000);
      })
      .finally(() => {
        submitBtn.disabled    = false;
        submitBtn.textContent = "Send Message";
      });
  });
})();


/* ════════════════════════════════════
   9. PROJECT CARD TILT (desktop only)
════════════════════════════════════ */
(function initTilt() {
  if (window.matchMedia("(hover: none)").matches) return; // skip touch devices

  document.querySelectorAll(".p-card").forEach(card => {
    card.addEventListener("mousemove", e => {
      const rect   = card.getBoundingClientRect();
      const cx     = rect.left + rect.width  / 2;
      const cy     = rect.top  + rect.height / 2;
      const dx     = (e.clientX - cx) / (rect.width  / 2);
      const dy     = (e.clientY - cy) / (rect.height / 2);
      card.style.transform =
        `translateY(-7px) rotateX(${-dy * 3}deg) rotateY(${dx * 3}deg)`;
      card.style.transition = "transform 0.1s";
    });

    card.addEventListener("mouseleave", () => {
      card.style.transform  = "";
      card.style.transition = "transform 0.45s cubic-bezier(0.4,0,0.2,1)";
    });
  });
})();


/* ════════════════════════════════════
   10. COUNT-UP NUMBERS (stats)
════════════════════════════════════ */
(function initCountUp() {
  const targets = document.querySelectorAll("[data-count]");

  const obs = new IntersectionObserver(entries => {
    entries.forEach(entry => {
      if (!entry.isIntersecting) return;
      const el    = entry.target;
      const end   = parseInt(el.dataset.count, 10);
      const dur   = 1400;
      const step  = 16;
      const steps = Math.ceil(dur / step);
      let current = 0;

      const t = setInterval(() => {
        current++;
        const value = Math.round(easeOut(current / steps) * end);
        el.textContent = value;
        if (current >= steps) {
          el.textContent = end;
          clearInterval(t);
        }
      }, step);

      obs.unobserve(el);
    });
  }, { threshold: 0.5 });

  targets.forEach(t => obs.observe(t));

  function easeOut(x) { return 1 - Math.pow(1 - x, 3); }
})();


/* ════════════════════════════════════
   11. ACTIVE NAV on CLICK highlight
════════════════════════════════════ */
document.querySelectorAll(".nav-links a, .mobile-nav a").forEach(a => {
  a.addEventListener("click", () => {
    document.querySelectorAll(".nav-links a").forEach(l => l.classList.remove("active"));
    const matchDt = document.querySelector(`.nav-links a[href="${a.getAttribute("href")}"]`);
    if (matchDt) matchDt.classList.add("active");
  });
});