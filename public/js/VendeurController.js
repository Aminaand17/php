function modifierVendeur(id) {
    let row = document.querySelector(`tr[data-id='${id}']`);
    let nomComplet = row.querySelector('.nomComplet').textContent;
    let telephone = row.querySelector('.telephone').textContent;
    let adresse = row.querySelector('.adresse').textContent;
    let salaire = row.querySelector('.salaire').textContent;

    row.innerHTML = `
    <td><input type="text" value="${nomComplet}" class="form-control nomComplet"></td>
    <td><input type="text" value="${telephone}" class="form-control telephone"></td>
    <td><input type="text" value="${adresse}" class="form-control adresse"></td>
    <td><input type="text" value="${salaire}" class="form-control salaire"></td>
    <td><button class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-2 rounded text-xs" onclick="enregistrerModification(${id})">Enregistrer</button></td>
`;
}

function enregistrerModification(id) {
    let row = document.querySelector(`tr[data-id='${id}']`);
    let nomComplet = row.querySelector('.nomComplet').value;
    let telephone = row.querySelector('.telephone').value;
    let adresse = row.querySelector('.adresse').value;
    let salaire = row.querySelector('.salaire').value;

    fetch(`<?= WEBROOT ?>/?controller=vendeur&action=edit-vendeur`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: `id=${id}&nomComplet=${encodeURIComponent(nomComplet)}&telephone=${encodeURIComponent(telephone)}&adresse=${encodeURIComponent(adresse)}&salaire=${encodeURIComponent(salaire)}`
    }).then(response => {
        if (response.ok) {
            location.reload();
        }
    });
}

function archiverVendeur(id) {
    if (confirm("Voulez-vous vraiment archiver ce vendeur ?")) {
        window.location.href = `<?= WEBROOT ?>/?controller=vendeur&action=archiver-vendeur&id=${id}`;
    }
}