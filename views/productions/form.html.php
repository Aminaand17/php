<!-- form -->
<div class="container mx-auto mt-5 p-4 max-w-md">
    <div class="bg-white shadow-md rounded-lg p-6">
        <div class="mb-4 text-xl font-semibold">
            Enregistrer une nouvelle production
        </div>
        <form action="<?= WEBROOT ?>?controller=production&action=add-production" method="post">
            <div class="mb-4">
                <label for="date" class="block text-gray-700 text-sm font-bold mb-2">Date :</label>
                <input type="date" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="date" name="date" required>
            </div>
            <div class="mb-4">
                <label for="qte" class="block text-gray-700 text-sm font-bold mb-2">Quantité :</label>
                <input type="number" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="qte" name="qte" required>
            </div>
            <div class="mb-4">
                <label for="observation" class="block text-gray-700 text-sm font-bold mb-2">Observation :</label>
                <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="observation" name="observation" rows="3"></textarea>
            </div>
            <div class="mb-4">
                <label for="articleId" class="block text-gray-700 text-sm font-bold mb-2">Article :</label>
                <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="articleId" name="articleId" required>
                    <option value="">Sélectionner un article</option>
                    <?php foreach ($articles as $article): ?>
                        <option value="<?= $article['id'] ?>"><?= $article['libelle'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="flex justify-end">
                <button type="submit" class="bg-red-300 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Enregistrer
                </button>
            </div>
            <input type="hidden" name="controller" value="production">
            <input type="hidden" name="action" value="add-production">
        </form>
    </div>
</div>
