document.addEventListener("DOMContentLoaded", function () {
  const addToCartButtons = document.querySelectorAll(".add-to-cart");

  addToCartButtons.forEach((button) => {
    button.addEventListener("click", function () {
      fetch("checkLogin.php")
        .then((response) => response.json())
        .then((data) => {
          if (data.isLoggedIn) {
            const idProduit = this.getAttribute("data-product-id");
            addToCart(idProduit);
          } else {
            window.location.href = "connexion.php";
          }
        })
        .catch((error) => {
          console.error("Error checking login status:", error);
        });
    });
  });

  function addToCart(idProduit) {
    fetch("addToCart.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({
        idProduit: idProduit,
      }),
    })
      .then((response) => response.json())
      .then((data) => {
        console.log("Response from server:", data);
        window.location.reload();
      })
      .catch((error) => {
        console.error("Error adding item to cart:", error);
      });
  }
});
