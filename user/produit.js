document.addEventListener("DOMContentLoaded", function () {
  const addToCartButtons = document.querySelectorAll(".add-to-cart");

  addToCartButtons.forEach((button) => {
    button.addEventListener("click", function () {
      fetch("checkLogin.php")
        .then((response) => response.json())
        .then((data) => {
          if (data.isLoggedIn) {
            const userId = data.userID;
            const idProduit = this.getAttribute("data-product-id");
            addToCart(idProduit, userId);
          } else {
            window.location.href = "connexion.php";
          }
        })
        .catch((error) => {
          console.error("Error checking login status:", error);
        });
    });
  });

  function addToCart(idProduit, userID) {
    fetch("addToCart.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({
        idProduit: idProduit,
        userID: userID,
      }),
    })
      .then((response) => response.json())
      .then((data) => {
        if (data.success) {
          function showToast(message) {
            var toast = document.getElementById("toast");
            toast.innerHTML = message;
            toast.style.display = "block";
            setTimeout(function () {
              toast.style.display = "none";
            }, 3000);
          }
          showToast("L'element ajouté a votre panier!");
        }
        console.log("Response from server:", data);
      })
      .catch((error) => {
        console.error("Error adding item to cart:", error);
      });
  }
});
