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
        console.log("Response from server:", data);
        window.location.href = "panier.php";
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
      console.log("Response from server:", data);
      window.location.href = "panier.php";
      showToast("Item added successfully!");
    })
    .catch((error) => {
      console.error("Error removing item from cart:", error);
      successmsg = document.querySelector(".item-details");
      successmsg.innerHTML +=
        '<p style="color: #FB3636; " >Vous avez depasser la quantite q\'on a en stock </p>';
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
      console.log("Response from server:", data);
      window.location.href = "utilisateur.php";
    })
    .then(() => {
      setTimeout(() => {
        successmsg = document.querySelector(".cart-container");
        successmsg.firstElementChild.innerHTML +=
          '<p style="color: green">Votre Commande est envoyée avec succès </p>';
      }, 1000);
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
