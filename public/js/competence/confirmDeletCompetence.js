    const btnDeleteElementsCompetence = document.querySelectorAll(".btn-delete-competence");
    
        btnDeleteElementsCompetence.forEach((btnDeleteCompetence) => {
            btnDeleteCompetence.addEventListener("click", function (event) {
            event.preventDefault();

            const competenceId = this.getAttribute('data-id-competence');
            const competenceName = this.getAttribute('data-name-competence');

            Swal.fire({
                title: `Veuillez-vous bien supprimer la competence  ${competenceName}`,
                text: "Cette action est irreversibile !",
                icon: "warning",
                showCancelButton: true,
                cancelButtonColor: '#3085d6',
                cancelButtontext: 'Annuler la suppression',
                confirmButtonColor: '#d33',
                confirmButtonText: 'Oui, supprimer',
            }).then((reponse) => {
                if (reponse.isConfirmed) {
                    window.location.href = `competenceMainController?id=${competenceId}&action=delete`;
                }
            })
        })
    });