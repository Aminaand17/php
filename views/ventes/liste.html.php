<div class="flex justify-center mt-4 mb-8 space-x-4">
    <div class="w-48">
        <label for="filter-date" class="block text-sm font-medium text-gray-700">Filtrer par Date :</label>
        <input type="date" id="filter-date" name="filter-date" class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
    </div>
    <div class="w-48">
        <label for="filter-article" class="block text-sm font-medium text-gray-700">Filtrer par Article :</label>
        <select id="filter-article" name="articleId" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            <option value="">Sélectionnez un article</option>
            <?php if (!empty($ventes)) : ?>
                <?php foreach ($ventes as $vente) : ?>
                    <option value="<?= $vente['id'] ?>"><?= $vente['article_libelle'] ?></option>
                <?php endforeach; ?>
            <?php else : ?>
                <option value="" disabled>Aucun Article disponible</option>
            <?php endif; ?>
        </select>
    </div>
    <div class="w-48">
        <label for="filter-client" class="block text-sm font-medium text-gray-700">Filtrer par Client :</label>
        <select id="filter-client" name="clientId" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            <option value="">Sélectionnez un client</option>
            <?php if (!empty($ventes)) : ?>
                <?php foreach ($ventes as $vente) : ?>
                    <option value="<?= $vente['id'] ?>"><?= $vente['client_nom'] ?></option>
                <?php endforeach; ?>
            <?php else : ?>
                <option value="" disabled>Aucun Client disponible</option>
            <?php endif; ?>
        </select>
    </div>
    
    <div class="w-48 mt-6"> 
        <button id="apply-filters-btn" type="button" class="bg-red-300 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
            Appliquer
        </button>
    </div>
</div>

<div class="relative overflow-x-auto shadow-md sm:rounded-lg w-3/4 mx-auto">
    <div class="flex justify-end mb-2">
        <a href="<?= WEBROOT ?>/?controller=vente&action=form-vente" class="text-white bg-red-300 hover:bg-red-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800 mt-5">
            Nouveau
        </a>
    </div>
    <table id="ventes-table" class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3 bg-red-300 text-gray-900">
                    Date
                </th>
                <th scope="col" class="px-6 py-3 bg-red-300 text-gray-900">
                    Quantité
                </th>
                <th scope="col" class="px-6 py-3 bg-red-300 text-gray-900">
                    Prix
                </th>
                <th scope="col" class="px-6 py-3 bg-red-300 text-gray-900">
                    Montant
                </th>
                <th scope="col" class="px-6 py-3 bg-red-300 text-gray-900">
                    Observation
                </th>
                <th scope="col" class="px-6 py-3 bg-red-300 text-gray-900">
                    Article
                </th>
                <th scope="col" class="px-6 py-3 bg-red-300 text-gray-900">
                    Client
                </th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($ventes as $vente) : ?>
                <tr class="bg-white odd:bg-red-100 odd:dark:bg-red-100 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 vente-row">
                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white date">
                        <?= $vente["date"]; ?>
                    </td>
                    <td class="px-6 py-4 telephone">
                        <?= $vente["qte"]; ?>
                    </td>
                    <td class="px-6 py-4 adresse">
                        <?= $vente["prix"]; ?>
                    </td>
                    <td class="px-6 py-4 salaire">
                        <?= $vente["montant"]; ?>
                    </td>
                    <td class="px-6 py-4 salaire">
                        <?= $vente["observation"]; ?>
                    </td>
                    <td class="px-6 py-4 salaire article">
                        <?= $vente["article_libelle"]; ?>
                    </td>
                    <td class="px-6 py-4 salaire client">
                        <?= $vente["client_nom"]; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<script src="http://localhost/php/public/js/VenteController.js" type="module"></script>
