<!-- form.html.php -->

<div class="container mx-auto mt-5 p-4 max-w-md">
    <div class="bg-white shadow-md rounded-lg p-6">
        <div class="mb-4 text-xl font-semibold">
            Enregistrer un nouveau Fournisseur
        </div>
        <form action="<?= WEBROOT ?>?controller=fournisseur&action=add-fournisseur" method="post">
            <div class="mb-4">
                <label for="nomComplet" class="block text-gray-700 text-sm font-bold mb-2">Nom Complet :</label>
                <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="nomComplet" name="nomFour" required>
            </div>
            <div class="mb-4">
                <label for="telephone" class="block text-gray-700 text-sm font-bold mb-2">Téléphone portable :</label>
                <input type="number" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="telephone" name="telFour" required>
            </div>
            <div class="mb-4">
                <label for="adresse" class="block text-gray-700 text-sm font-bold mb-2">Adresse :</label>
                <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="adresse" name="adresseFour" rows="3"></textarea>
            </div>
            <div class="flex justify-end">
                <button type="submit" class="bg-red-300 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Enregistrer
                </button>
            </div>
        </form>
    </div>
</div>
