const btnPerfil = document.querySelector("#btnPerfil");

if (typeof btnPerfil != undefined) {
    const divPerfil = document.querySelector("#divPerfil");
    divPerfil.classList.add("block");

    btnPerfil.addEventListener("mouseover", () => {
        divPerfil.classList.remove("block");

        divPerfil.addEventListener("mouseover", () => {
            divPerfil.classList.remove("block");
        });

    });

    divPerfil.addEventListener("mouseout", () => {
        divPerfil.classList.add("block");

        btnPerfil.addEventListener("mouseout", () => {
            divPerfil.classList.add("block");
        });
    });
}



// const msg = document.querySelector("#mensagem_flex");

// if (typeof msg != undefined) {
//     msg.animate([{ opacity: "1" }, { opacity: "0" }], 2500);
//     msg.style.display = "none";
// }
