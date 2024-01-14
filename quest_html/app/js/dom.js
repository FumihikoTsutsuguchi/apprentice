
document.addEventListener("submit", (event) => {
    event.preventDefault();

    const form = document.getElementById('post-form');
    const title = form.querySelector('input[type = "text"]');
    const textarea = form.querySelector('textarea');

    const targetElement = document.getElementById('posts');
    const h2 = document.createElement('h2');
    const p = document.createElement('p');

    targetElement.appendChild(h2);
    targetElement.appendChild(p);
    h2.textContent = title.value;
    p.textContent = textarea.value;

    const targetsH2 = targetElement.querySelectorAll("h2");
    const targetsP = targetElement.querySelectorAll("p");

    if (targetsH2.length >= 4) {
        targetElement.removeChild(targetsH2[0]);
        targetElement.removeChild(targetsP[0]);
    }

});
