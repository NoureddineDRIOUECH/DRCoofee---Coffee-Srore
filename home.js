let dateNow = new Date();
let mycopyrightp = document.createElement("p");
mycopyrightp.innerHTML =
  "&copy; " + dateNow.getFullYear() + " DRCoffee. Tous droits réservés.";
document.querySelector("div.copyright").appendChild(mycopyrightp);

// document.addEventListener("DOMContentLoaded", function () {
//   let searchInput = document.querySelector(".search-btn");
//   let main = document.getElementsByTagName("main")[0];
//   searchInput.addEventListener("input", function () {
//     fetch("rechercheProduit.php")
//       .then((response) => response.json())
//       .then((data) => {
//         console.log(data);
//         main.innerHTML = "";
//         data.forEach((element) => {
//           if (element.nomProduit.includes(searchInput.value)) {
//             let productContainer = document.createElement("div");
//             productContainer.classList.add("container-product");
//             productContainer.innerHTML = `
//               <div class="images">
//                 <img src="${element.image}" alt="Image Produits" />
//                 <p class="stock">Quantité : ${element.stock}</p>
//                 <button type="submit" class="add-to-cart" name="add" data-product-id="${element.idProduit}">Ajouter au Panier</button>
//               </div>
//               <div class="product">
//                 <h2>${element.nomProduit}</h2>
//                 <h3>${element.prixProduit} MAD</h3>
//                 <p class="desc">${element.description}</p>
//               </div>`;
//             main.appendChild(productContainer);
//           }
//         });
//       })
//       .catch((error) => console.error("Error fetching data:", error));
//   });
// });

document.addEventListener("DOMContentLoaded", function () {
  let searchInput = document.querySelector(".search-btn");
  let main = document.getElementsByTagName("main")[0];

  searchInput.addEventListener("input", function () {
    fetch("rechercheProduit.php")
      .then((response) => response.json())
      .then((data) => {
        console.log(JSON.stringify(data)); // Log the JSON string representation
        console.log(data); // Log the data received from the fetch
        main.innerHTML = ""; // Clear the previous content

        data.forEach((element) => {
          if (
            element.nomProduit
              .toLowerCase()
              .includes(searchInput.value.toLowerCase())
          ) {
            let productContainer = document.createElement("div");
            productContainer.classList.add("container-product");
            productContainer.innerHTML = `
              <div class="images">
                <img src="${element.image}" alt="Image Produits" />
                <p class="stock">Quantité : ${element.stock}</p>
                <button type="submit" class="add-to-cart" name="add" data-product-id="${element.idProduit}">Ajouter au Panier</button>
              </div>
              <div class="product">
                <h2>${element.nomProduit}</h2>
                <h3>${element.prixProduit} MAD</h3>
                <p class="desc">${element.description}</p>
              </div>`;
            main.appendChild(productContainer);
          }
        });
      })
      .catch((error) => console.error("Error fetching data:", error));
  });
});
