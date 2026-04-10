// Recuperation des elements
const UsertableListe = document.getElementById("table-liste-user");
const UsertableCorbeille = document.getElementById("table-corbeille-user");
const UserbtnShowListe = document.getElementById("btn-show-liste-users");
const UserBtnShowCorbeille = document.getElementById("btn-show-corbeille-users");

    // Permet de masquer corbeille et button List
    UsertableCorbeille.setAttribute("hidden", "hidden");
    UserbtnShowListe.setAttribute("hidden", "hidden");

    // Permet de ouvire table-corbeille quand se click sur list
    UserBtnShowCorbeille.addEventListener("click", function (event) {
        this.setAttribute("hidden", "hidden");
        UserbtnShowListe.removeAttribute("hidden");

        UsertableListe.setAttribute("hidden", "hidden"); //Pour masquer
        UsertableCorbeille.removeAttribute("hidden"); //Pour Afficher
        
    })

    // Permet de ouvire table-List quand se click sur corbeille
    UserbtnShowListe.addEventListener("click", function (event) {
        this.setAttribute("hidden", "hidden");
        UserBtnShowCorbeille.removeAttribute("hidden");

        UsertableCorbeille.setAttribute("hidden", "hidden");
        UsertableListe.removeAttribute("hidden");
        
    })
