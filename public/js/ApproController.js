import { FournisseurModel } from "./models/FournisseurModel.js";

document.addEventListener("DOMContentLoaded", async (event) => {
    const telFour = document.getElementById("telFour");
    const nomFour = document.getElementById("nomFour");
    const adresseFour = document.getElementById("adresseFour");
    const fournisseurId = document.getElementById("fournisseurId");
    const fournisseurModel = new FournisseurModel();
    
    // Le chargement de la page 
    telFour.addEventListener("input", async function () {
        if (telFour.value.length >= 9) {
            let response = await fournisseurModel.findFournisseurByTel(telFour.value);
            let { statut, data } = response;
            if (statut == 200) {
                telFour.classList.remove("is-invalid");
                nomFour.value = data["nomFour"];
                adresseFour.value = data["adresseFour"];
                fournisseurId.value = data["id"];
            } else {
                nomFour.value = "";
                adresseFour.value = "";
                fournisseurId.value = "";
                telFour.classList.add("is-invalid");
                telFour.nextElementSibling.textContent = `Le numero ${telFour.value} n'existe pas  `;
            }
        }
    });
});
