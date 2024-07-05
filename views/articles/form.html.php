<div class="container mx-auto mb-5">
    <div class="card mt-5 w-75 m-auto">
        <div class="card-header">
            Nouvel article
        </div>
        <div class="card-body">
            <form method="POST" action="<?= WEBROOT ?>">
                <div class="mb-4">
                    <label for="libelle" class="block text-gray-700 text-sm font-bold mb-2">Libellé</label>
                    <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="libelle" name="libelle" aria-describedby="libelleHelp" />
                </div>
                <div class="mb-4">
                    <label for="qteStock" class="block text-gray-700 text-sm font-bold mb-2">Quantité en stock</label>
                    <input type="number" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="qteStock" name="qteStock" aria-describedby="qteStockHelp" />
                </div>
                <div class="mb-4">
                    <label for="prix" class="block text-gray-700 text-sm font-bold mb-2">Prix</label>
                    <input type="number" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="prix" name="prix" aria-describedby="prixHelp" />
                </div>
                <div class="mb-4">
                    <label for="categorieId" class="block text-gray-700 text-sm font-bold mb-2">Catégorie</label>
                    <select name="categorieId" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="categorieId" aria-label="Catégorie">
                        <option selected disabled>Choisir une catégorie...</option>
                        <?php foreach ($categories as $categorie) : ?>
                            <option value="<?= $categorie['id'] ?>"><?= $categorie['nomCategorie'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="typeId" class="block text-gray-700 text-sm font-bold mb-2">Type</label>
                    <select name="typeId" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="typeId" aria-label="Type">
                        <option selected disabled>Choisir un type...</option>
                        <?php foreach ($types as $type) : ?>
                            <option value="<?= $type['id'] ?>"><?= $type['nomType'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <input type="hidden" name="controller" value="article">
                <input type="hidden" name="action" value="add-article">
                <button type="submit" class="bg-red-300 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Enregistrer
                </button>
            </form>
        </div>
    </div>
</div>
