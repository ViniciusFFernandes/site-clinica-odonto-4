// app.js — interações do site (header no scroll, menu, reveal, scrollspy)
(function () {
  "use strict";

  var header = document.getElementById("siteHeader");
  var brand = document.querySelectorAll("[data-brand]");
  var brandSub = document.querySelectorAll("[data-brand-sub]");
  var navlinks = document.querySelectorAll("[data-navlink]");
  var menuBtn = document.querySelector("[data-menu-btn]");

  // Classes aplicadas ao header quando a página é rolada
  var scrolledCls = ["bg-background/90", "backdrop-blur-xl", "shadow-[var(--shadow-soft)]", "py-3"];

  function setScrolled(on) {
    if (!header) return;
    if (on) {
      header.classList.add.apply(header.classList, scrolledCls);
      header.classList.remove("py-5");
    } else {
      header.classList.remove.apply(header.classList, scrolledCls);
      header.classList.add("py-5");
    }
    // Marca (topo: branco sobre o hero escuro / rolado: cor escura)
    brand.forEach(function (el) {
      el.classList.toggle("text-white", !on);
      el.classList.toggle("text-primary", on);
    });
    brandSub.forEach(function (el) {
      el.classList.toggle("text-white/60", !on);
      el.classList.toggle("text-muted-foreground", on);
    });
    navlinks.forEach(function (el) {
      el.classList.toggle("text-white/80", !on);
      el.classList.toggle("text-muted-foreground", on);
    });
    if (menuBtn) {
      menuBtn.classList.toggle("border-white/25", !on);
      menuBtn.classList.toggle("text-white", !on);
      menuBtn.classList.toggle("border-border", on);
      menuBtn.classList.toggle("text-primary", on);
    }
  }

  function onScroll() { setScrolled(window.scrollY > 24); }
  window.addEventListener("scroll", onScroll, { passive: true });
  setScrolled(false);
  onScroll();

  // Menu mobile
  var toggle = document.getElementById("menuToggle");
  var menu = document.getElementById("mobileMenu");
  if (toggle && menu) {
    var openIcon = toggle.querySelector("[data-menu-open]");
    var closeIcon = toggle.querySelector("[data-menu-close]");
    var setOpen = function (open) {
      menu.classList.toggle("hidden", !open);
      if (openIcon) openIcon.classList.toggle("hidden", open);
      if (closeIcon) closeIcon.classList.toggle("hidden", !open);
    };
    toggle.addEventListener("click", function () {
      setOpen(menu.classList.contains("hidden"));
    });
    menu.querySelectorAll("[data-close-menu]").forEach(function (a) {
      a.addEventListener("click", function () { setOpen(false); });
    });
  }

  // Reveal on scroll
  var reveals = document.querySelectorAll(".reveal");
  if ("IntersectionObserver" in window) {
    var io = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          entry.target.classList.add("is-visible");
          io.unobserve(entry.target);
        }
      });
    }, { threshold: 0.12, rootMargin: "0px 0px -60px 0px" });
    reveals.forEach(function (el) { io.observe(el); });
  } else {
    reveals.forEach(function (el) { el.classList.add("is-visible"); });
  }

  // Scrollspy — destaca a seção atual no menu
  var sections = [];
  navlinks.forEach(function (link) {
    var id = link.getAttribute("href");
    if (id && id.charAt(0) === "#") {
      var sec = document.querySelector(id);
      if (sec) sections.push({ link: link, sec: sec });
    }
  });
  if (sections.length && "IntersectionObserver" in window) {
    var spy = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          sections.forEach(function (s) {
            s.link.classList.toggle("text-accent", s.sec === entry.target);
          });
        }
      });
    }, { rootMargin: "-45% 0px -50% 0px" });
    sections.forEach(function (s) { spy.observe(s.sec); });
  }
})();
