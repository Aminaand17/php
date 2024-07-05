<!-- Liste des productions -->
<div class="relative overflow-x-auto shadow-md sm:rounded-lg w-3/4 mx-auto">
    <div class="flex justify-between mb-2">
        <div class="flex space-x-4">
            <!-- Formulaire de recherche -->
            <form method="get" action="<?= WEBROOT ?>/?controller=production&action=liste-production" class="flex items-center space-x-2">
                <label for="date" class="block text-gray-700 text-sm font-bold">Date :</label>
                <input type="date" id="date" name="date" class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <button type="submit" class="text-white bg-red-300 hover:bg-red-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Chercher</button>
           
                <label for="articleId" class="block text-gray-700 text-sm font-bold">Article :</label>
                <select id="articleId" name="articleId" class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    <option value="">Sélectionner un article</option>
                    <?php foreach ($productions as $article): ?>
                        <option value="<?= $article['id'] ?>"><?= $article['articleLibelle'] ?></option>
                    <?php endforeach; ?>
                </select>
                <button type="submit" class="text-white bg-red-300 hover:bg-red-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Chercher</button>
            </form>
        </div>
        <a href="<?= WEBROOT ?>/?controller=production&action=form-production" class="text-white bg-red-300 hover:bg-red-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800 mt-5">
            Nouveau
        </a>
    </div>
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3 bg-red-300 text-gray-900">
                    Date
                </th>
                <th scope="col" class="px-6 py-3 bg-red-300 text-gray-900">
                    Quantité
                </th>
                <th scope="col" class="px-6 py-3 bg-red-300 text-gray-900">
                    Observation
                </th>
                <th scope="col" class="px-6 py-3 bg-red-300 text-gray-900">
                    Article
                </th>
                <th scope="col" class="px-6 py-3 bg-red-300 text-gray-900">
                    Action
                </th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($productions as $production) : ?>
                <tr class="bg-white odd:bg-red-100 odd:dark:bg-red-100 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700" data-id="<?= $production['id']; ?>">
                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        <?= (new DateTime($production['date']))->format("d-m-Y"); ?>
                    </td>
                    <td class="px-6 py-4 qte">
                        <?= $production["qte"]; ?>
                    </td>
                    <td class="px-6 py-4 observation">
                        <?= $production["observation"]; ?>
                    </td>
                    <td class="px-6 py-4 articleLibelle">
                        <?= $production["articleLibelle"]; ?>
                    </td>
                    <td class="px-6 py-4">
                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded text-xs" onclick="modifierProduction(<?= $production['id']; ?>)">Modifier</button>
                        <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded text-xs" onclick="archiverProduction(<?= $production['id']; ?>)">Archiver</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script>
    function modifierProduction(id) {
        let row = document.querySelector(`tr[data-id='${id}']`);
        let qte = row.querySelector('.qte').textContent.trim();
        let observation = row.querySelector('.observation').textContent.trim();
        let articleLibelle = row.querySelector('.articleLibelle').textContent.trim();
        
        row.innerHTML = `
            <td><input type="date" value="${new Date().toISOString().slice(0, 10)}" class="form-control date"></td>
            <td><input type="number" value="${qte}" class="form-control qte"></td>
            <td><input type="text" value="${observation}" class="form-control observation"></td>
            <td>${articleLibelle}</td>
            <td>
                <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-2 rounded text-xs" onclick="enregistrerModification(${id})">Enregistrer</button>
            </td>
        `;
    }

    function enregistrerModification(id) {
        let row = document.querySelector(`tr[data-id='${id}']`);
        let date = row.querySelector('.date').value;
        let qte = row.querySelector('.qte').value;
        let observation = row.querySelector('.observation').value;

        fetch(`<?= WEBROOT ?>/?controller=production&action=edit-production`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: `id=${id}&date=${encodeURIComponent(date)}&qte=${encodeURIComponent(qte)}&observation=${encodeURIComponent(observation)}`
        }).then(response => {
            if (response.ok) {
                location.reload();
            } else {
                alert('Erreur lors de la modification de la production');
            }
        }).catch(error => {
            console.error('Erreur:', error);
        });
    }

    function archiverProduction(id) {
        if (confirm("Êtes-vous sûr de vouloir archiver cette production ?")) {
            fetch(`<?= WEBROOT ?>/?controller=production&action=archiver-production&id=${id}`, {
                method: 'GET'
            }).then(response => {
                if (response.ok) {
                    location.reload();
                } else {
                    alert('Erreur lors de l\'archivage de la production');
                }
            }).catch(error => {
                console.error('Erreur:', error);
            });
        }
    }
</script>
