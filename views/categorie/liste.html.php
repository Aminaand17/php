<?php
    use App\Core\Session;
    $errors = [];
    if (Session::get("errors")) {
        $errors = Session::get("errors");
    }
?>
<div class="container mx-auto my-5 p-4 max-w-4xl">
    <div class="bg-white shadow-md rounded-lg">
        <div class="bg-red-300 text-white text-lg font-semibold p-4 rounded-t-lg">
            Liste des Catégories
        </div>
        <div class="p-4">
            <form class="flex flex-col md:flex-row md:items-end mb-4" method="POST" action="<?= WEBROOT ?>">
                <div class="mb-3 md:mr-4 w-full md:w-2/3">
                    <label for="nomCategorie" class="block text-gray-700 text-sm font-bold mb-2">Nom Catégorie</label>
                    <input type="text" name="nomCategorie" id="nomCategorie" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline <?= isset($errors["nomCategorie"]) ? 'border-red-500' : '' ?>" placeholder="" />
                    <?php if (isset($errors["nomCategorie"])) : ?>
                        <p class="text-red-500 text-xs italic mt-2"><?= $errors["nomCategorie"] ?></p>
                    <?php endif; ?>
                </div>
                <div class="mb-3 w-full md:w-1/3">
                    <button type="submit" class="bg-red-300 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Enregistrer
                    </button>
                </div>
                <input type="hidden" name="controller" value="categorie">
                <input type="hidden" name="action" value="add-categorie">
            </form>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-300">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 border-b border-gray-300 text-gray-800 text-left text-xs uppercase font-semibold">ID</th>
                            <th class="px-6 py-3 border-b border-gray-300 text-gray-800 text-left text-xs uppercase font-semibold">Nom Catégorie</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($categories as $categorie): ?>
                            <tr class="bg-white odd:bg-red-100">
                                <td class="px-6 py-4 border-b border-gray-300 text-sm"><?= $categorie["id"]; ?></td>
                                <td class="px-6 py-4 border-b border-gray-300 text-sm"><?= $categorie["nomCategorie"]; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php Session::remove("errors"); ?>

            