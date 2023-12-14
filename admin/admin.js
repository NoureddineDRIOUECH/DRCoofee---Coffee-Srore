function logout() {
  fetch("logout.php")
    .then((response) => response.json())
    .then((data) => {
      console.log("Logout response:", data);
      window.location.href = "../connexion.php";
    })
    .catch((error) => {
      console.error("Logout error:", error);
    });
}
function toggleAddUserForm() {
  const addUserForm = document.querySelector(".add-user-form");
  const addUserDiv = document.querySelector(".add-one");
  addUserForm.style.display =
    addUserForm.style.display === "none" || addUserForm.style.display === ""
      ? "block"
      : "none";
  addUserDiv.style.display = "none";
}

function toggleAddProductSection() {
  var addProductForm = document.querySelector(".add-product-form");
  var addProduct = document.querySelector(".addP");
  addProductForm.style.display =
    addProductForm.style.display === "none" || addUserForm.style.display === ""
      ? "block"
      : "none";
  addProduct.style.display = "none";
}

function deleteProduct(idProduit) {
  fetch("actionAdmin.php", {
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
      console.error("Error removing Product:", error);
    });
}

function deleteUser(idUser) {
  fetch("actionAdmin.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify({
      idUser: idUser,
    }),
  })
    .then((response) => response.json())
    .then((data) => {
      console.log("Response from server:", data);
      window.location.reload();
    })
    .catch((error) => {
      console.error("Error removing Product:", error);
    });
}

document.addEventListener("DOMContentLoaded", function () {
  document.querySelectorAll(".process-btn").forEach(function (button) {
    button.addEventListener("click", function () {
      const orderId = this.getAttribute("data-order-id");

      const xhr = new XMLHttpRequest();
      xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
          console.log(xhr.responseText);
        }
      };
      xhr.open("GET", "traiterCommande.php?orderId=" + orderId, true);
      xhr.send();
    });
  });
});
