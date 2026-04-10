document.addEventListener("DOMContentLoaded", function (){
     const btnRestaurerElementsCompetence = document.querySelectorAll(".btn-restaurer-competence");
    
        btnRestaurerElementsCompetence.forEach((btnRestaurerCompetence) => {
            btnRestaurerCompetence.addEventListener("click", function (event) {
            event.preventDefault();

            const competenceId = this.getAttribute('data-id-restaurer');
            const competenceName = this.getAttribute('data-name-restaurer');

            Swal.fire({
                title: `Veuillez-vous bien Restaurer la competence  ${competenceName}`,
                text: "Cette action est irreversibile !",
                icon: "warning",
                showCancelButton: true,
                cancelButtonColor: '#3085d6',
                cancelButtonText: 'Annuler la restauration',
                confirmButtonColor: '#d33',
                confirmButtonText: 'Oui, restaurer',
            }).then((reponse) => {
                if (reponse.isConfirmed) {
                    window.location.href = `competenceMainController?id=${competenceId}&action=restaurer`;
                }
            })
        })
    })
});