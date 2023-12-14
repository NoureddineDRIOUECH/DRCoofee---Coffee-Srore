function confirmOrder(idCommande) {
  window.location.href = "confirmation.php?id=" + idCommande;
}
function imprimerFacture(idCommande) {
  window.location.href = "facture.php?id=" + idCommande;
}

function supprimerOrder(idCommande) {
  fetch("suprimerOrder.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify({
      idCommande: idCommande,
    }),
  })
    .then((response) => response.json())
    .then((data) => {
      if (data.success) {
        function showToast(message) {
          var toast = document.getElementById("toastF");
          toast.innerHTML = message;
          toast.style.display = "block";
          setTimeout(function () {
            toast.style.display = "none";
          }, 3000);
        }
        showToast("L'element suprimmer avec succes!");
      }
      console.log("Response from server:", data);
    })
    .then(() => {
      window.location.reload();
    })
    .catch((error) => {
      console.error("Error deleting order:", error);
    });
}
