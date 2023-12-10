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
          const main = document.querySelector(
            `button[data-product-id="${idProduit}"]`
          );
          const successMessage = document.createElement("div");
          successMessage.className = "success-message";
          successMessage.innerHTML = "Merci pour acheter depuis notre store :)";
          successMessage.style.color = "#26A310";
          main.parentElement.appendChild(successMessage);
        }
        console.log("Response from server:", data);
      })
      .catch((error) => {
        console.error("Error adding item to cart:", error);
      });
  }
});
