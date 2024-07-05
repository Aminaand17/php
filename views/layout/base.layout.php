
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <nav class="bg-white border-gray-200 dark:bg-gray-900">
        <div class="max-w-screen-xl flex items-center justify-between mx-auto p-4">
            <div class="flex-shrink-0">
                <img src="https://img.freepik.com/photos-gratuite/fils-colores-table_144627-10220.jpg" class="h-16" alt="Flowbite Logo" />
            </div>
            <div class="md:flex-grow md:w-auto">
                <ul class="flex flex-wrap justify-end md:space-x-4">
                    <?php
                    use App\Core\Autorisation;
                     if (Autorisation::hasRole('Admin')) : ?>
                        <li>
                            <a href="<?= WEBROOT ?>/?controller=article&action=liste-article&page=0" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white">Article</a>
                        </li>
                        <li>
                            <a href="<?= WEBROOT ?>/?controller=categorie&action=liste-categorie" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white">Catégorie</a>
                        </li>
                        <li>
                            <a href="<?= WEBROOT ?>/?controller=appro&action=liste-appro" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white">Approvisionnement</a>
                        </li>
                        <li>
                            <a href="<?= WEBROOT ?>/?controller=respo&action=liste-respo" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white">Responsable</a>
                        </li>
                        <li>
                            <a href="<?= WEBROOT ?>/?controller=fournisseur&action=liste-fournisseur" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white">Fournisseur</a>
                        </li>
                        <li>
                            <a href="<?= WEBROOT ?>/?controller=vendeur&action=liste-vendeur" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white">Vendeur</a>
                        </li>
                        <li>
                            <a href="<?= WEBROOT ?>/?controller=client&action=liste-client" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white">Client</a>
                        </li>
                        <li>
                            <a href="<?= WEBROOT ?>/?controller=type&action=liste-type" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white">Type</a>
                        </li>
                    <?php endif; ?>

                    <?php if (Autorisation::hasRole('RP')) : ?>
                        <li>
                            <a href="<?= WEBROOT ?>/?controller=production&action=liste-production" class="block py-2 px-3 text-white bg-blue-700 rounded  md:bg-transparent md:text-blue-700 dark:text-white md:dark:text-blue-500">Production</a>
                        </li>
                    <?php endif; ?>

                    <?php if (Autorisation::hasRole('RS')) : ?>
                        <li>
                            <a href="<?= WEBROOT ?>/?controller=article&action=liste-article&page=0" class="block py-2 px-3 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 dark:text-white md:dark:text-blue-500">Article</a>
                        </li>
                        <li>
                            <a href="<?= WEBROOT ?>/?controller=appro&action=liste-appro" class="block py-2 px-3 text-white bg-blue-700 rounded  md:bg-transparent md:text-blue-700 dark:text-white md:dark:text-blue-500">Approvisionnement</a>
                        </li>
                    <?php endif; ?>

                    <?php if (Autorisation::hasRole('Vendeur')) : ?>
                        <li>
                            <a href="<?= WEBROOT ?>/?controller=vente&action=liste-vente" class="block py-2 px-3 text-white bg-blue-700 rounded  md:bg-transparent md:text-blue-700 dark:text-white md:dark:text-blue-500">Vente</a>
                        </li>
                    <?php endif; ?>

                    <li>
                        <a href="<?= WEBROOT ?>/?controller=securite&action=logout" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 dark:text-white md:dark:hover:text-blue-500">Déconnexion</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <hr>
    <br>
    <main>
        <?php echo $contentView; ?>
    </main>
</body>
</html>
