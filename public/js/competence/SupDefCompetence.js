document.addEventListener("DOMContentLoaded", function (){
    const btnSupDefElementsCompetence = document.querySelectorAll(".btn-sup-def-competence");
    
        btnSupDefElementsCompetence.forEach((btnSupDefComptence) => {
            btnSupDefComptence.addEventListener("click", function (event) {
            event.preventDefault();

            const competenceId = this.getAttribute('data-id-sup-competence');
            const competenceName = this.getAttribute('data-name-sup-competence');

            Swal.fire({
                title: `Veuillez-vous bien Supprimer definitivement la competence  ${competenceName}`,
                text: "Cette action est irreversibile !",
                icon: "warning",
                showCancelButton: true,
                cancelButtonColor: '#3085d6',
                cancelButtontext: 'Annuler la suppression definitive',
                confirmButtonColor: '#d33',
                confirmButtonText: 'Oui, supprime',
            }).then((reponse) => {
                if (reponse.isConfirmed) {
                    window.location.href = `competenceMainController?id=${competenceId}&action=supDef`;
                }
            })
        })
        })
});