let dateNow = new Date();
let mycopyrightp = document.createElement("p");
mycopyrightp.innerHTML =
  "&copy; " + dateNow.getFullYear() + " DRCoffee. Tous droits réservés.";
document.querySelector("div.copyright").appendChild(mycopyrightp);
