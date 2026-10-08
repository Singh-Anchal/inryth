(function () {
    "use strict";

    var reduce = window.matchMedia("(prefers-reduced-motion: reduce)").matches;

    function qs(sel, root) {
        return (root || document).querySelector(sel);
    }

    function qsa(sel, root) {
        return Array.prototype.slice.call((root || document).querySelectorAll(sel));
    }

    var toggle = qs("[data-nav-toggle]");
    var mobileNav = qs("[data-mobile-nav]");
    var closeBtns = qsa("[data-nav-close]");

    function setNav(open) {
        if (!mobileNav) return;
        mobileNav.classList.toggle("open", open);
        mobileNav.setAttribute("aria-hidden", open ? "false" : "true");
        document.body.style.overflow = open ? "hidden" : "";
        if (toggle) toggle.setAttribute("aria-expanded", open ? "true" : "false");
    }

    if (toggle) {
        toggle.addEventListener("click", function () {
            setNav(!mobileNav.classList.contains("open"));
        });
    }
    closeBtns.forEach(function (btn) {
        btn.addEventListener("click", function () {
            setNav(false);
        });
    });

    qsa("[data-filter]").forEach(function (btn) {
        btn.addEventListener("click", function () {
            var filter = btn.getAttribute("data-filter");
            qsa("[data-filter]").forEach(function (b) {
                b.classList.toggle("active", b === btn);
            });
            qsa("[data-item]").forEach(function (item) {
                var tags = (item.getAttribute("data-item") || "").split(/\s+/);
                var show = filter === "all" || tags.indexOf(filter) !== -1;
                item.classList.toggle("d-none", !show);
            });
            if (window.InrythTrack) window.InrythTrack("portfolio_filter", { filter: filter });
        });
    });

    if (!reduce) {
        qsa("[data-count]").forEach(function (el) {
            var end = parseInt(el.getAttribute("data-count"), 10);
            if (!end) return;
            var current = 0;
            var step = Math.max(1, Math.round(end / 40));
            var timer = setInterval(function () {
                current += step;
                if (current >= end) {
                    current = end;
                    clearInterval(timer);
                }
                el.textContent = current;
            }, 20);
        });
    }

    document.addEventListener("click", function (e) {
        var link = e.target.closest("[data-track]");
        if (!link || !window.InrythTrack) return;
        window.InrythTrack(link.getAttribute("data-track"), {
            label: link.getAttribute("data-track-label") || (link.textContent || "").trim(),
            href: link.getAttribute("href") || "",
        });
    });

    if (!reduce && "IntersectionObserver" in window) {
        var io = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (!entry.isIntersecting) return;
                entry.target.classList.add("is-in");
                io.unobserve(entry.target);
            });
        }, { threshold: 0.12, rootMargin: "0px 0px -40px 0px" });

        qsa(".section .card-premium, .process-item, .pillar").forEach(function (el, i) {
            el.classList.add("will-reveal");
            el.style.transitionDelay = Math.min(i % 6, 5) * 0.05 + "s";
            io.observe(el);
        });
    } else {
        qsa(".will-reveal").forEach(function (el) {
            el.classList.add("is-in");
        });
    }
})();
