<!-- Liste des fournisseurs -->
<div class="relative overflow-x-auto shadow-md sm:rounded-lg w-3/4 mx-auto">
<div class="flex justify-end mb-2">
        <a href="<?= WEBROOT ?>/?controller=fournisseur&action=form-fournisseur" class="text-white bg-red-300 hover:bg-red-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800 mt-5">
            Nouveau
        </a>
    </div>
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3 bg-red-300 text-gray-900">
                    Nom
                </th>
                <th scope="col" class="px-6 py-3 bg-red-300 text-gray-900">
                    Téléphone
                </th>
                <th scope="col" class="px-6 py-3 bg-red-300 text-gray-900">
                    Adresse
                </th>
                <th scope="col" class="px-6 py-3 bg-red-300 text-gray-900">
                    Action
                </th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($fournisseurs as $fournisseur) : ?>
                <tr class="bg-white odd:bg-red-100 odd:dark:bg-red-100 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700" data-id="<?= $fournisseur['id']; ?>">
                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white nomFour">
                        <?= $fournisseur["nomFour"]; ?>
                    </td>
                    <td class="px-6 py-4 telFour">
                        <?= $fournisseur["telFour"]; ?>
                    </td>
                    <td class="px-6 py-4 adresseFour">
                        <?= $fournisseur["adresseFour"]; ?>
                    </td>
                    <td class="px-6 py-4">
                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded text-xs" onclick="modifierFournisseur(<?= $fournisseur['id']; ?>)">Modifier</button>
                        <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded text-xs" onclick="archiverFournisseur(<?= $fournisseur['id']; ?>)">Archiver</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script>
    function modifierFournisseur(id) {
        let row = document.querySelector(`tr[data-id='${id}']`);
        let nomFour = row.querySelector('.nomFour').textContent.trim();
        let adresseFour = row.querySelector('.adresseFour').textContent.trim();
        let telFour = row.querySelector('.telFour').textContent.trim();

        row.innerHTML = `
            <td><input type="text" value="${nomFour}" class="form-control nomFour"></td>
            <td><input type="text" value="${adresseFour}" class="form-control adresseFour"></td>
            <td><input type="text" value="${telFour}" class="form-control telFour"></td>
            <td>
                <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-2 rounded text-xs" onclick="enregistrerModification(${id})">Enregistrer</button>
            </td>
        `;
    }

    function enregistrerModification(id) {
        let row = document.querySelector(`tr[data-id='${id}']`);
        let nomFour = row.querySelector('.nomFour').value;
        let adresseFour = row.querySelector('.adresseFour').value;
        let telFour = row.querySelector('.telFour').value;

        fetch(`<?= WEBROOT ?>/?controller=fournisseur&action=edit-fournisseur`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: `id=${id}&nomFour=${encodeURIComponent(nomFour)}&adresseFour=${encodeURIComponent(adresseFour)}&telFour=${encodeURIComponent(telFour)}`
        }).then(response => {
            if (response.ok) {
                location.reload();
            } else {
                alert('Erreur lors de la modification du fournisseur');
            }
        }).catch(error => {
            console.error('Erreur:', error);
        });
    }

    function archiverFournisseur(id) {
        if (confirm("Êtes-vous sûr de vouloir archiver ce fournisseur ?")) {
            fetch(`<?= WEBROOT ?>/?controller=fournisseur&action=archiver-fournisseur&id=${id}`, {
                method: 'GET'
            }).then(response => {
                if (response.ok) {
                    location.reload();
                } else {
                    alert('Erreur lors de l\'archivage du fournisseur');
                }
            }).catch(error => {
                console.error('Erreur:', error);
            });
        }
    }
</script>
