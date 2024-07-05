<div class="container mx-auto my-5 p-4 max-w-4xl">
    <div class="bg-white shadow-md rounded-lg">
        <div class="bg-red-300 text-white text-lg font-semibold p-4 rounded-t-lg">
            Liste des Articles
        </div>
        <div class="p-4">
            <div class="flex justify-end mb-2">
                <a href="<?= WEBROOT ?>/?controller=article&action=form-article" class="text-white bg-red-300 hover:bg-red-700 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-red-600 dark:hover:bg-red-700 focus:outline-none dark:focus:ring-red-800">
                    Nouveau
                </a>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-300">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 border-b border-gray-300 text-gray-800 text-left text-xs uppercase font-semibold">Libellé</th>
                            <th class="px-6 py-3 border-b border-gray-300 text-gray-800 text-left text-xs uppercase font-semibold">Qté Stock</th>
                            <th class="px-6 py-3 border-b border-gray-300 text-gray-800 text-left text-xs uppercase font-semibold">Prix</th>
                            <th class="px-6 py-3 border-b border-gray-300 text-gray-800 text-left text-xs uppercase font-semibold">Catégorie</th>
                            <th class="px-6 py-3 border-b border-gray-300 text-gray-800 text-left text-xs uppercase font-semibold">Type</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($response["data"] as $article) : ?>
                            <tr class="bg-white odd:bg-red-100">
                                <td class="px-6 py-4 border-b border-gray-300 text-sm"><?= $article["libelle"]; ?></td>
                                <td class="px-6 py-4 border-b border-gray-300 text-sm"><?= $article["qteStock"]; ?></td>
                                <td class="px-6 py-4 border-b border-gray-300 text-sm"><?= $article["prixAppro"]; ?></td>
                                <td class="px-6 py-4 border-b border-gray-300 text-sm"><?= $article["nomCategorie"]; ?></td>
                                <td class="px-6 py-4 border-b border-gray-300 text-sm"><?= $article["nomType"]; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <nav aria-label="Page navigation example">
                <ul class="flex items-center -space-x-px h-8 text-sm">
                    <li>
                        <a href="<?= WEBROOT ?>/?controller=article&action=liste-article&page=<?= $currentPage - 1 ?>" class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                            <span class="sr-only">Previous</span>
                            <svg class="w-2.5 h-2.5 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4" />
                            </svg>
                        </a>
                    </li>
                    <?php for ($i = 0; $i < $response["pages"]; $i++) : ?>
                        <li <?= $i == $currentPage ? 'active' : '' ?>>
                            <a class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white" href="<?= WEBROOT ?>/?controller=article&action=liste-article&page=<?= $i ?>"><?= $i + 1 ?></a>
                        </li>
                    <?php endfor; ?>
                    <li <?= $currentPage == $response["pages"] - 1 ? 'disabled' : '' ?>>
                        <a href="<?= WEBROOT ?>/?controller=article&action=liste-article&page=<?= $currentPage + 1 ?>" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                            <span class="sr-only">Next</span>
            </nav>




        </div>
    </div>
</div>