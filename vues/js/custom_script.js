/*Gestion de la fenetre modale de suppression*/
$(document).ready(function () {
    var theHREF;

    $(".confirmModalLien").click(function(e) {
        e.preventDefault();
        theHREF = $(this).attr("href");
        $("#modal_suppression").modal("show");
    });

    $("#confirmModalNon").click(function(e) {
        $("#modal_suppression").modal("hide");
    });

    $("#confirmModalOui").click(function(e) {
        window.location.href = theHREF;
    });
});