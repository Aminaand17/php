<!-- approvisionnement_form.html.php -->

<div class="container mx-auto mt-5 p-4 max-w-4xl">
    <div class="bg-white shadow-md rounded-lg p-6">
        <div class="mb-4 text-xl font-semibold">
            Nouvel Approvisionnement
        </div>
        <form method="POST" action="<?= WEBROOT ?>">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                <div>
                    <label for="telFour" class="block text-gray-700 text-sm font-bold mb-2">Téléphone</label>
                    <input type="text" name="telFour" id="telFour" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" aria-label="Telephone">
                </div>
                <div>
                    <label for="nomFour" class="block text-gray-700 text-sm font-bold mb-2">Nom</label>
                    <input disabled type="text" id="nomFour" name="nomFour" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" aria-label="Nom">
                </div>
                <div>
                    <label for="adresseFour" class="block text-gray-700 text-sm font-bold mb-2">Adresse</label>
                    <input disabled type="text" id="adresseFour" name="adresseFour" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" aria-label="Adresse">
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                <div class="md:col-span-2">
                    <label for="articleId" class="block text-gray-700 text-sm font-bold mb-2">Article</label>
                    <select name="articleId" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        <option selected>Choisir un Article...</option>
                        <?php if (!empty($articles)) : ?>
                            <?php foreach ($articles as $article) : ?>
                                <option value="<?= $article['id'] ?>"><?= $article['libelle'] ?></option>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <option value="" disabled>Aucun Article disponible</option>
                        <?php endif; ?>
                    </select>
                </div>
                <div>
                    <label for="qteAppro" class="block text-gray-700 text-sm font-bold mb-2">Quantité Appro</label>
                    <input type="text" name="qteAppro" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" aria-label="Quantité Appro">
                </div>
                <div class="flex items-center justify-end">
                    <button type="submit" class="bg-red-300 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Ajouter
                    </button>
                </div>
            </div>
        </form>
        <div class="table-responsive mt-4">
            <table class="table-auto w-full">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2">Article</th>
                        <th class="px-4 py-2">Quantité</th>
                        <th class="px-4 py-2">Prix</th>
                        <th class="px-4 py-2">Montant</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Contenu du tableau ici -->
                </tbody>
            </table>
        </div>
        <div class="mt-4 text-right">
            <span class="text-lg font-semibold">Total : <span class="text-red-600">CFA</span></span>
        </div>
        <div class="mt-4 text-right">
            <a href="<?= WEBROOT ?>?controller=appro&action=add-appro" class="bg-red-300 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Enregistrer
            </a>
        </div>
    </div>
</div>

<script src="http://localhost/php/public/js/ApproController.js" type="module"></script>
