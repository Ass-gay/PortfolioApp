// Recuperation des elements
const tableListe = document.getElementById("table-liste");
const tableCorbeille = document.getElementById("table-corbeille");
const btnShowListe = document.getElementById("btn-show-liste");
const BtnShowCorbeille = document.getElementById("btn-show-corbeille");

    // Permet de masquer corbeille et button List
    tableCorbeille.setAttribute("hidden", "hidden");
    btnShowListe.setAttribute("hidden", "hidden");

    // Permet de ouvire table-corbeille quand se click sur list
    BtnShowCorbeille.addEventListener("click", function (event) {
        this.setAttribute("hidden", "hidden");
        btnShowListe.removeAttribute("hidden");

        tableListe.setAttribute("hidden", "hidden"); //Pour masquer
        tableCorbeille.removeAttribute("hidden"); //Pour Afficher
        
    })

    // Permet de ouvire table-List quand se click sur corbeille
    btnShowListe.addEventListener("click", function (event) {
        this.setAttribute("hidden", "hidden");
        BtnShowCorbeille.removeAttribute("hidden");

        tableCorbeille.setAttribute("hidden", "hidden");
        tableListe.removeAttribute("hidden");
        
    })
