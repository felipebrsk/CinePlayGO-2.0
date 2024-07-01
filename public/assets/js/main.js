// Password visibility toggle
document.getElementById("toggle-password")?.addEventListener("click", () => {
    const passwordField = document.getElementById("password");
    const type =
        passwordField.getAttribute("type") === "password" ? "text" : "password";
    passwordField.setAttribute("type", type);
});

// Starfield
document.addEventListener("DOMContentLoaded", function () {
    const starContainer = document.querySelector(".star-container");
    const numStars = 50;

    for (let i = 0; i < numStars; i++) {
        const star = document.createElement("div");
        star.classList.add("star");

        const horizontalPos = Math.random() * 100;
        const verticalPos = Math.random() * 100;

        const animationDuration = Math.random() * 5 + 3;

        star.style.left = `${horizontalPos}%`;
        star.style.top = `${verticalPos}%`;
        star.style.animationDuration = `${animationDuration}s`;

        starContainer.appendChild(star);
    }
});
