window.onload = () => {
    const skills = document.querySelectorAll('.form-check-input');
    for (let skill of skills) {
        skill.addEventListener('change', (event) => {
            const divParent = event.currentTarget.parentNode;
            if (divParent.classList.contains("btn-secondary")) {
                divParent.className = "btn btn-dark";
            } else {
                divParent.className = "btn btn-secondary";
            }
            const filterForm = document.querySelector('#filterForm');
            const form = new FormData(filterForm);
            const params = new URLSearchParams();

            for (const val of form.entries()) {
                params.append(val[0], val[1]);
            }

            const url = new URL(window.location.href);

            // On lance la requête ajax
            fetch(url.pathname + "?" + params.toString() + "&ajax=1", {
                headers: {
                    "X-Requested-With": "XMLHttpRequest"
                }
            }).then(response =>
                response.json()
            ).then(data => {
                // On va chercher la zone de contenu
                const content = document.querySelector("#realisations-content");

                // On remplace le contenu
                content.innerHTML = data.content;
            }).catch(e => alert(e));

        });
    }
}
