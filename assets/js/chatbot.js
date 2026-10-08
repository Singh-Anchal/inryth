(function () {
    "use strict";

    var root = document.querySelector("[data-chatbot]");
    if (!root) return;

    var toggle = root.querySelector("[data-chatbot-toggle]");
    var panel = root.querySelector("[data-chatbot-panel]");
    var closeBtn = root.querySelector("[data-chatbot-close]");
    var messages = root.querySelector("[data-chatbot-messages]");
    var actions = root.querySelector("[data-chatbot-actions]");
    var config = null;
    var configUrl = root.getAttribute("data-config-url");

    function track(name, payload) {
        if (window.InrythTrack) window.InrythTrack(name, payload || {});
    }

    function addMessage(text, who) {
        var div = document.createElement("div");
        div.className = who === "user" ? "user-msg" : "bot-msg";
        div.textContent = text;
        messages.appendChild(div);
        messages.scrollTop = messages.scrollHeight;
    }

    function renderActions(node) {
        actions.innerHTML = "";
        if (!node) return;

        (node.buttons || []).forEach(function (btn) {
            var b = document.createElement("button");
            b.type = "button";
            b.textContent = btn.label;
            b.addEventListener("click", function () {
                addMessage(btn.label, "user");
                track("chatbot_service_click", { id: btn.id, label: btn.label });
                go(btn.id);
            });
            actions.appendChild(b);
        });

        if (node.link) {
            var a = document.createElement("a");
            a.href = node.link;
            a.textContent = node.link_label || "Learn more";
            actions.appendChild(a);
        }

        if (node.whatsapp && window.INRYTH_WHATSAPP) {
            var wa = document.createElement("a");
            wa.href = window.INRYTH_WHATSAPP;
            wa.target = "_blank";
            wa.rel = "noopener";
            wa.textContent = node.whatsapp_label || "WhatsApp";
            wa.setAttribute("data-track", "whatsapp_click");
            wa.setAttribute("data-track-label", "chatbot");
            actions.appendChild(wa);
        }

        if (node.cta && !node.buttons) {
            var consult = document.createElement("button");
            consult.type = "button";
            consult.textContent = "Talk to Expert";
            consult.addEventListener("click", function () {
                addMessage("Talk to Expert", "user");
                go("expert");
            });
            actions.appendChild(consult);
        }
    }

    function go(id) {
        if (!config || !config.nodes[id]) {
            addMessage("I can connect you with the team for that.", "bot");
            renderActions(config.nodes.expert);
            return;
        }
        var node = config.nodes[id];
        addMessage(node.message, "bot");
        renderActions(node);
    }

    function openPanel() {
        panel.classList.add("open");
        panel.setAttribute("aria-hidden", "false");
        toggle.setAttribute("aria-expanded", "true");
        track("chatbot_open");
        if (!messages.dataset.ready) {
            addMessage(config.welcome, "bot");
            renderActions({ buttons: config.quick_replies });
            messages.dataset.ready = "1";
        }
    }

    function closePanel() {
        panel.classList.remove("open");
        panel.setAttribute("aria-hidden", "true");
        toggle.setAttribute("aria-expanded", "false");
    }

    fetch(configUrl, { headers: { Accept: "application/json" } })
        .then(function (r) {
            return r.json();
        })
        .then(function (data) {
            config = data;
            toggle.addEventListener("click", function () {
                if (panel.classList.contains("open")) closePanel();
                else openPanel();
            });
            if (closeBtn) closeBtn.addEventListener("click", closePanel);
        })
        .catch(function () {
            toggle.hidden = true;
        });
})();
