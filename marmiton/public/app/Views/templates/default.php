<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Marmiton vers CS & MR </title>

    <!-- Bootstrap core CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/main.css" />
</head>

<body>


    <div class="col-md-3 mon-navbar" style="display: none">
        <nav>
            <ul class="menu-vertical">
                <img src="../../../img/logo.png" alt="Logo" />
                <li class="mv-item"><a href="index.php?pages=home">Accueil</a></li>
                <li class="mv-item"><a href="index.php?pages=create_recipeView" onclick="affiche_create_rec();">Créer une recette</a></li>
                <li class="mv-item"><a href="index.php?pages=search_recipeView">Rechercher une recette</a></li>
            </ul>
        </nav>
    </div>
    <div class="container col-md-offset-3 mon-container" style="display: none;">

            <?php echo $content; ?>
    </div>
<!-- /.container -->
<footer>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script type="text/javascript" src="js/main.js"></script>
</footer>
</body>
</html>

