const view_cursos = document.querySelectorAll(".view_cursos_content");
const pergs = document.querySelectorAll(".div_perg");

// View Cursos on Dashboard
if (typeof view_cursos != undefined) {
    const area_curso = document.querySelectorAll(".area-cursos");

    view_cursos[0].classList.add("borderLine");

    for (let i = 0; i < area_curso.length; i++) {
        if (i == 0) {
            area_curso[i].classList.remove("block");
        } else {
            area_curso[i].classList.add("block");
        }
    }

    function view_curso(w) {
        for (let i = 0; i < view_cursos.length; i++) {
            view_cursos[i].classList.remove("borderLine");
            area_curso[i].classList.add("block");
            view_cursos[w].classList.add("borderLine");
            area_curso[w].classList.remove("block");
        }
    }
}

if (typeof pergs != undefined) {
    console.log(pergs);

    for (let i = 0; i < pergs.length; i++) {
        if (i != 0) {
            pergs[i].classList.add("block");
        }
    }

}
