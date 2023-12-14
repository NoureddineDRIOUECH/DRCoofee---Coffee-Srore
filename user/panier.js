function removeItem(idPanier) {
  fetch("panierAction.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify({
      idPanier: idPanier,
    }),
  })
    .then((response) => response.json())
    .then((data) => {
      console.log("Response from server:", data);
      window.location.href = "panier.php";
    })
    .catch((error) => {
      console.error("Error removing item from cart:", error);
    });
}

function moins(idPanier, quantite) {
  if (quantite > 1) {
    fetch("panierAction.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({
        idPanier: idPanier,
        moins: true,
      }),
    })
      .then((response) => response.json())
      .then((data) => {
        if (data.success) {
          function showToast(message) {
            var toast = document.getElementById("toastS");
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
        console.error("Error removing item from cart:", error);
      });
  } else {
    removeItem(idPanier);
  }
}

function plus(idPanier, idProduit, quantite) {
  fetch("panierAction.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify({
      idPanier: idPanier,
      idProduit: idProduit,
      quantite: quantite,
    }),
  })
    .then((response) => response.json())
    .then((data) => {
      if (data.success) {
        function showToast(message) {
          var toast = document.getElementById("toastS");
          toast.innerHTML = message;
          toast.style.display = "block";
          setTimeout(function () {
            toast.style.display = "none";
          }, 3000);
        }
        showToast("L'element ajouté avec succes!");
      }
      console.log("Response from server:", data);
    })
    .then(() => {
      window.location.reload();
    })
    .catch((error) => {
      console.error("Error plus quntite item from cart:", error);
      function showToast(message) {
        var toast = document.getElementById("toastF");
        toast.innerHTML = message;
        toast.style.display = "block";
        setTimeout(function () {
          toast.style.display = "none";
        }, 3000);
      }
      showToast("Vous avez depasser la quantite q'on a en stock");
    });
}

function commander(total, userId, idPanier) {
  fetch("commander.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify({
      userId: userId,
      total: total,
      idPanier: idPanier,
    }),
  })
    .then((response) => response.json())
    .then((data) => {
      if (data.success) {
        function showToast(message) {
          var toast = document.getElementById("toastS");
          toast.innerHTML = message;
          toast.style.display = "block";
          setTimeout(function () {
            toast.style.display = "none";
          }, 3000);
        }
        showToast("La commande est envoyé veuillez la confirmer avec succes!");
      }
      console.log("Response from server:", data);
    })
    .then(() => {
      window.location.href = "utilisateur.php";
    })

    .catch((error) => {
      console.error("Error commanding item from cart:", error);
    });
}
function showToast(message) {
  // Get the toast element
  var toast = document.getElementById("toast");

  // Set the message
  toast.innerHTML = message;

  // Show the toast
  toast.style.display = "block";

  // Hide the toast after 3 seconds (adjust as needed)
  setTimeout(function () {
    toast.style.display = "none";
  }, 3000);
}
