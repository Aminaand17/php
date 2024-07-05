<div class="container mb-5">
    <div class="card mt-5 w-75 m-auto">


        <div class="relative overflow-x-auto shadow-md sm:rounded-lg w-3/4 mx-auto">

            <div class="flex justify-end mb-2">
                <a href="<?= WEBROOT ?>/?controller=respo&action=form-respo" class="text-white bg-red-300 hover:bg-red-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800 mt-5">
                    Nouveau
                </a>
            </div>
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3 bg-red-300 text-gray-900">
                            Nom Complet
                        </th>
                        <th scope="col" class="px-6 py-3 bg-red-300 text-gray-900">
                            Téléphone portable
                        </th>
                        <th scope="col" class="px-6 py-3 bg-red-300 text-gray-900">
                            Adresse
                        </th>
                        <th scope="col" class="px-6 py-3 bg-red-300 text-gray-900">
                            Salaire
                        </th>
                        <th scope="col" class="px-6 py-3 bg-red-300 text-gray-900">
                            Type
                        </th>
                        <th scope="col" class="px-6 py-3 bg-red-300 text-gray-900">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($respos as $respo) : ?>
                        <tr class="bg-white odd:bg-red-100 odd:dark:bg-red-100 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700" data-id="<?= $respo['id']; ?>">
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white nomComplet">
                                <?= $respo["nomComplet"]; ?>
                            </td>
                            <td class="px-6 py-4 telephone">
                                <?= $respo["telephone"]; ?>
                            </td>
                            <td class="px-6 py-4 adresse">
                                <?= $respo["adresse"]; ?>
                            </td>
                            <td class="px-6 py-4 salaire">
                                <?= $respo["salaire"]; ?>
                            </td>
                            <td class="px-6 py-4 type">
                                <?= $respo["nomType"]; ?>
                            </td>
                            <td class="px-6 py-4">
                                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded text-xs" onclick="modifierResponsable(<?= $respo['id']; ?>)">Modifier</button>
                                <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded text-xs" onclick="archiverResponsable(<?= $respo['id']; ?>)">Archiver</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>

<script>
    function modifierResponsable(id) {
        let row = document.querySelector(`tr[data-id='${id}']`);
        let nomComplet = row.querySelector('.nomComplet').textContent;
        let telephone = row.querySelector('.telephone').textContent;
        let adresse = row.querySelector('.adresse').textContent;
        let salaire = row.querySelector('.salaire').textContent;
        let type = row.querySelector('.type').textContent;

        row.innerHTML = `
        <td><input type="text" value="${nomComplet}" class="form-control nomComplet"></td>
        <td><input type="text" value="${telephone}" class="form-control telephone"></td>
        <td><input type="text" value="${adresse}" class="form-control adresse"></td>
        <td><input type="text" value="${salaire}" class="form-control salaire"></td>
        <td><input type="text" value="${type}" class="form-control type"></td>
        <td><button class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-2 rounded text-xs" onclick="enregistrerModification(${id})">Enregistrer</button></td>
    `;
    }

    function enregistrerModification(id) {
        let row = document.querySelector(`tr[data-id='${id}']`);
        let nomComplet = row.querySelector('.nomComplet').value;
        let telephone = row.querySelector('.telephone').value;
        let adresse = row.querySelector('.adresse').value;
        let salaire = row.querySelector('.salaire').value;
        let type = row.querySelector('.type').value;

        fetch(`<?= WEBROOT ?>/?controller=respo&action=edit-respo`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: `id=${id}&nomComplet=${encodeURIComponent(nomComplet)}&telephone=${encodeURIComponent(telephone)}&adresse=${encodeURIComponent(adresse)}&salaire=${encodeURIComponent(salaire)}&type=${encodeURIComponent(type)}`
        }).then(response => {
            if (response.ok) {
                location.reload();
            }
        });
    }

    function archiverResponsable(id) {
    if (confirm("Voulez-vous vraiment archiver ce responsable ?")) {
        fetch(`<?= WEBROOT ?>/?controller=respo&action=archiver-respo`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: `id=${id}`
        }).then(response => {
            if (response.ok) {
                location.reload();
            } else {
                console.error('Erreur lors de l\'archivage:', response.statusText);
                alert('L\'archivage a échoué.');
            }
        }).catch(error => {
            console.error('Erreur:', error);
            alert('L\'archivage a échoué.');
        });
    }
}

</script>