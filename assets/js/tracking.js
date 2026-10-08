(function () {
    "use strict";

    window.InrythTrack = function (eventName, params) {
        params = params || {};
        try {
            if (typeof window.gtag === "function") {
                window.gtag("event", eventName, params);
            }
            if (window.dataLayer) {
                window.dataLayer.push({ event: eventName, ...params });
            }
            if (typeof window.fbq === "function" && eventName === "form_submit") {
                window.fbq("track", "Lead", params);
            }
            if (typeof window.fbq === "function" && eventName === "whatsapp_click") {
                window.fbq("trackCustom", "WhatsAppClick", params);
            }
        } catch (err) {
            /* tracking must never break UX */
        }
    };
})();
