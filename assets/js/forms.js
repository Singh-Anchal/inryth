(function () {
    "use strict";

    var form = document.querySelector("[data-lead-form]");
    if (!form) return;

    function showError(input, message) {
        var wrap = input.closest(".field") || input.parentElement;
        var existing = wrap.querySelector(".form-error");
        if (!existing) {
            existing = document.createElement("div");
            existing.className = "form-error";
            wrap.appendChild(existing);
        }
        existing.textContent = message || "";
        input.setAttribute("aria-invalid", message ? "true" : "false");
    }

    function validPhone(value) {
        var digits = (value || "").replace(/\D+/g, "");
        return digits.length >= 10 && digits.length <= 15;
    }

    form.addEventListener("submit", function (e) {
        e.preventDefault();
        var valid = true;
        var name = form.querySelector("[name=name]");
        var phone = form.querySelector("[name=phone]");
        var email = form.querySelector("[name=email]");

        if (name && name.value.trim().length < 2) {
            showError(name, "Please enter your name.");
            valid = false;
        } else if (name) showError(name, "");

        if (phone && !validPhone(phone.value)) {
            showError(phone, "Enter a valid phone number.");
            valid = false;
        } else if (phone) showError(phone, "");

        if (email && email.value && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email.value)) {
            showError(email, "Enter a valid email or leave it blank.");
            valid = false;
        } else if (email) showError(email, "");

        if (!valid) return;

        var submit = form.querySelector("[type=submit]");
        if (submit) {
            submit.disabled = true;
            submit.dataset.original = submit.textContent;
            submit.textContent = "Sending…";
        }

        fetch(form.action, {
            method: "POST",
            body: new FormData(form),
            headers: { Accept: "application/json", "X-Requested-With": "XMLHttpRequest" },
        })
            .then(function (res) {
                return res.json().then(function (data) {
                    return { ok: res.ok, data: data };
                });
            })
            .then(function (result) {
                if (result.ok && result.data && result.data.redirect) {
                    if (window.InrythTrack) {
                        window.InrythTrack("form_submit", {
                            form_type: form.getAttribute("data-form-type") || "enquiry",
                        });
                    }
                    window.location.href = result.data.redirect;
                    return;
                }
                throw new Error((result.data && result.data.message) || "Could not send. Please try WhatsApp.");
            })
            .catch(function (err) {
                var box = form.querySelector("[data-form-status]");
                if (box) {
                    box.hidden = false;
                    box.textContent = err.message;
                }
                if (submit) {
                    submit.disabled = false;
                    submit.textContent = submit.dataset.original || "Submit";
                }
            });
    });
})();
