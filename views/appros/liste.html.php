<div class="container mb-5">
    <div class="card mt-5 w-3/4 m-auto">
        

        <div class="card-body">
            <div class="flex justify-end mb-2">
                <a href="<?= WEBROOT ?>/?controller=appro&action=form-appro" class="text-white bg-red-300 hover:bg-red-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800 mt-5">
                    Nouveau
                </a>
            </div>
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg w-full mx-auto">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3 bg-red-300 text-gray-900">
                                Date
                            </th>
                            <th scope="col" class="px-6 py-3 bg-red-300 text-gray-900">
                                Montant
                            </th>
                            <th scope="col" class="px-6 py-3 bg-red-300 text-gray-900">
                                Fournisseur
                            </th>
                            <th scope="col" class="px-6 py-3 bg-red-300 text-gray-900">
                                Téléphone
                            </th>
                            <th scope="col" class="px-6 py-3 bg-red-300 text-gray-900">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($appros as $appro) : ?>
                            <tr class="bg-white odd:bg-red-100 odd:dark:bg-red-100 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                <td class="px-6 py-4">
                                    <?= (new \DateTime($appro['date']))->format("d-m-Y"); ?>
                                </td>
                                <td class="px-6 py-4">
                                    <?= $appro["montant"]; ?>
                                </td>
                                <td class="px-6 py-4">
                                    <?= $appro["nomFour"]; ?>
                                </td>
                                <td class="px-6 py-4">
                                    <?= $appro["telFour"]; ?>
                                </td>
                                <td class="px-6 py-4">
                                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded text-xs">Voir Détail</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
