document.addEventListener("DOMContentLoaded", function () {
    const currentPath = window.location.pathname.replace(/\/+$/, "");

    const normalizeHref = (href) => {
        try {
            return new URL(href, window.location.origin).pathname.replace(/\/+$/, "");
        } catch (error) {
            return href.replace(/\/+$/, "");
        }
    };

    document.querySelectorAll(".navbar-nav .nav-link").forEach((link) => {
        const href = link.getAttribute("href");
        if (!href) return;
        if (normalizeHref(href) === currentPath || currentPath.endsWith("/index.php") && normalizeHref(href).endsWith("/index.php")) {
            link.classList.add("active");
        }
    });

    document.querySelectorAll(".sidebar a").forEach((link) => {
        const href = link.getAttribute("href");
        if (!href) return;
        if (normalizeHref(href) === currentPath) {
            link.classList.add("active");
        }
    });

    document.querySelectorAll("form.filter-form select").forEach((select) => {
        select.addEventListener("change", function () {
            const form = this.closest("form");
            if (form) {
                form.submit();
            }
        });
    });

    const backToTop = document.createElement("button");
    backToTop.id = "backToTop";
    backToTop.type = "button";
    backToTop.className = "btn btn-primary";
    backToTop.innerHTML = "<i class='bi bi-arrow-up'></i>";
    backToTop.style.display = "none";
    backToTop.style.alignItems = "center";
    backToTop.style.justifyContent = "center";
    document.body.appendChild(backToTop);

    window.addEventListener("scroll", function () {
        backToTop.style.display = window.scrollY > 280 ? "flex" : "none";
    });

    backToTop.addEventListener("click", function () {
        window.scrollTo({ top: 0, behavior: "smooth" });
    });

    const checkoutForm = document.querySelector("form[action*='checkout.php']");
    if (checkoutForm) {
        checkoutForm.addEventListener("submit", function (event) {
            const phoneInput = this.querySelector("input[name='phone']");
            if (phoneInput) {
                const phone = phoneInput.value.trim();
                const valid = /^\+?\d{9,12}$/.test(phone);
                if (!valid) {
                    event.preventDefault();
                    phoneInput.classList.add("is-invalid");
                    phoneInput.insertAdjacentHTML("afterend", "<div class='invalid-feedback'>Số điện thoại không hợp lệ.</div>");
                    phoneInput.focus();
                }
            }
        });
    }
});
