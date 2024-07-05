<?php
use App\Core\Session;
$errors = [];
if (Session::get("errors")) {
    $errors = Session::get("errors");
}
?>
<div class="container mx-auto mb-5">
    <div class="bg-white shadow-md rounded-lg mt-5 w-3/4 mx-auto">
        <div class=" bg-red-300 text-white p-4 rounded-t-lg">
            Formulaire de Connexion
        </div>
        <div class="p-6">
            <?php if(isset($errors["error_connection"])): ?>
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <?= $errors["error_connection"] ?>
                </div>
            <?php endif; ?>
            
            <form method="POST" action="<?= WEBROOT ?>?controller=article&action=liste-article&page=0">
                <div class="mb-4">
                    <label for="Login" class="block text-gray-700 font-bold mb-2">Login</label>
                    <input name="login" type="text" class="shadow appearance-none border <?= isset($errors["login"]) ? "border-red-500" : "border-gray-300" ?> rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="Login" />
                    <?php if(isset($errors["login"])): ?>
                        <p class="text-red-500 text-xs italic"><?= $errors["login"] ?></p>
                    <?php endif; ?>
                </div>
                <div class="mb-4">
                    <label for="Password" class="block text-gray-700 font-bold mb-2">Password</label>
                    <input name="password" type="password" class="shadow appearance-none border <?= isset($errors["password"]) ? "border-red-500" : "border-gray-300" ?> rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="Password" />
                    <?php if(isset($errors["password"])): ?>
                        <p class="text-red-500 text-xs italic"><?= $errors["password"] ?></p>
                    <?php endif; ?>
                </div> 
                
                <input type="hidden" name="controller" value="securite">
                <input type="hidden" name="action" value="connexion">
                <button type="submit" class=" bg-red-300 hover:bg-red-500 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Connexion</button>
            </form>
        </div>     
    </div>    
</div> 
<?php Session::remove("errors"); ?>
