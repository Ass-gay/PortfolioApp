document.addEventListener("DOMContentLoaded", function (){
    const btnRestaurerElements = document.querySelectorAll(".btn-restaurer");
    
        btnRestaurerElements.forEach((btnRestaurer) => {
            btnRestaurer.addEventListener("click", function (event) {
            event.preventDefault();

            const serviceProjetId = this.getAttribute('data-id');
            const serviceProjetName = this.getAttribute('data-name');

            Swal.fire({
                title: `Veuillez-vous bien Restaurer la realisation  ${serviceProjetName}`,
                text: "Cette action est irreversibile !",
                icon: "warning",
                showCancelButton: true,
                cancelButtonColor: '#3085d6',
                cancelButtontext: 'Annuler la restauration',
                confirmButtonColor: '#d33',
                confirmButtonText: 'Oui, restaurer',
            }).then((reponse) => {
                if (reponse.isConfirmed) {
                    window.location.href = `projetServiceMainController?id=${serviceProjetId}&action=restaurer`;
                }
            })
        })
        })
});