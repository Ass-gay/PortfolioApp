// Recuperation des champs de formulaire
const idInputEdit = document.getElementById("edit-id-competence");
const nomInputEdit = document.getElementById("edit-nom-competence");
const descriptionInputEdit = document.getElementById("edit-description-competence");
const niveauInputEdit = document.getElementById("edit-niveau-competence");
const frmEditCompetenceEdit = document.getElementById("editcompetenceForm");
const btnSubmitEditCompetence = frmEditCompetenceEdit.querySelector("button[type='submit']");

// Desactive le boutton de soumission par defaut
// btnSubmitEditCompetence.disabled = true;

// Permet d'affiche ou masquer les message d'eureur
function showError(input, message)
{
    const baliseP = input.nextElementSibling;
    if (message) {
        baliseP.textContent = message;
        input.classList.add("is-invalid");
        baliseP.style.color = "brown";
        baliseP.style.fontWeight = "bold";
    }
    else
    {
        baliseP.textContent = "";
        input.classList.remove("is-invalid");
    }
}

// Validation du champ nom a la saisie
nomInputEdit.addEventListener("input", () => {
        const nom = nomInputEdit.value.trim();
        const nomValidator = Validator.nameValidator("Le nom", 2, 50, nom);

        if (nomValidator) {
            showError(nomInputEdit, nomValidator.message);
        }
        else
        {
            showError(nomInputEdit, "");
        }
        // checkFormValidity();
    }
);

// Validation du champ description a la saisie
descriptionInputEdit.addEventListener("input", () => {
        const description = descriptionInputEdit.value.trim();
        const descriptionValidator = Validator.nameValidator("La description", 5, 1000, description);

        if (descriptionValidator) {
            showError(descriptionInputEdit, descriptionValidator.message);
        }
        else
        {
            showError(descriptionInputEdit, "");
        }
        // checkFormValidity();
    }
);

// Validation du champ niveau à la saisie
niveauInputEdit.addEventListener("input", () => {
    const niveau = niveauInputEdit.value.trim();
    const niveauValidator = Validator.phoneValidator("Le niveau", 0, 100, niveau);

    if (niveauValidator) {
        showError(niveauInputEdit, niveauValidator.message);
        isNiveauValid = false;
    }
    else
    {
        showError(niveauInputEdit, "");
        isNiveauValid = true;
    }

    // checkFormValidity();
});



// Active le bouton de valdation si les deux champs est valide
    // function checkFormValidity()
    // {
    //     const nom = nomInputEdit.value.trim();
    //     const description = descriptionInputEdit.value.trim();
    //     const niveau = niveauInputEdit.value.trim();

    //     const isNameValid = Validator.nameValidator("Le nom", 2, 50, nom);
    //     const isDescriptionValid = Validator.nameValidator("La description", 5, 1000, description);
    //     const isNiveauValid = Validator.phoneValidator("Le niveau", 0, 100, niveau);

    //     btnSubmitEditCompetence.disabled = !(isNameValid && isDescriptionValid && isNiveauValid);
    // }


// Recuperation button edit
   
    const editbuttonsCompetence = document.querySelectorAll(".btn-edit-competence");

    editbuttonsCompetence.forEach(button => {
        button.addEventListener("click", () => {

            // Recuperation des attribute data-...* de la balise clique
            const id = button.getAttribute("data-id");
            const nom = button.getAttribute("data-nom");
            const description = button.getAttribute("data-description");
            const niveau = button.getAttribute("data-niveau");

            // Ramplir les champs du modal avec les donnees
            idInputEdit.value = id;
            nomInputEdit.value = nom;
            descriptionInputEdit.value = description;
            niveauInputEdit.value = niveau;

            const isNameValid = Validator.nameValidator("Le nom", 2, 50, nom) == null;
            const isDescriptionValid = Validator.nameValidator("La description", 5, 1000, description) == null;
            const isNiveauValid = Validator.phoneValidator("Le niveau", 0, 100, niveau) == null;

            btnSubmitEditCompetence.disabled = !(isNameValid && isDescriptionValid && isNiveauValid);
        });
    });