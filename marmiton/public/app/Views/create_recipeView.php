<div class="form">
    <h1>Créer une recette</h1>
    <form class="form-horizontal" name="formulaire" action='index.php?pages=RecipeController' method="post"  enctype="multipart/form-data">
        <div class="form-group">
            <label class="control-label col-sm-2" for="email">E-mail</label>
            <div class="col-sm-6 ">
                <input type="text" class="form-control" id="email" name="e_mail" placeholder="@" maxlength="100">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="pseudo_f">Pseudo</label>
            <div class="col-sm-6 ">
                <input type="text" class="form-control" id="pseudo_f" name="pseudo" placeholder="Pseudo" maxlength="50">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="name_rec">Nom recette:</label>
            <div class="col-sm-6 ">
                <input type="text" class="form-control"  id="name_rec" name="nom_rec" placeholder="Entrer nom recette" maxlength="50">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="categorie">Catégorie:</label>
                <div class="row">
                    <div class="col-md-2">
                            <select class="form-control">
                                <option value="plats">Plats Principales</option>
                                <option value="dessert">Desserts</option>
                                <option value="entrees">Entrées</option>
                            </select>
                    </div>
                    <div class="col-md-6">
                        <label class="control-label col-sm-2"for="origine">Origines:</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="origine" name="origines" placeholder="Thaî/Africain..." maxlength="20">
                        </div>
                    </div>
                </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="img">Image (max. 1 Mo) :</label>
            <div class="col-sm-10">
                <input type="file"  id="img" name="mon_img" value="1048576" />
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="descript">Descriptif de la recette:</label>
            <div class="col-sm-6 ">
                <textarea class="form-control" name="descript" id="descript" rows="3"></textarea>
            </div>
        </div><br /> <br />
        <div class="form-group">
            <label class="control-label col-sm-4" for="nom_ingre">Nom ingrédient:</label>
            <div class="col-sm-8 col-">
                <input type="text" class="form-control" name="nom_ingre" placeholder="Entrer nom ingrédient" maxlength="50">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-4" for="unite">Unité:</label>
            <div class="col-sm-2 col-">
                <input type="text" class="form-control" name="unite" placeholder="Entrer une unité" maxlength="50">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-4" for="poid">Poids/volume:</label>
            <div class="col-sm-3">
                <input type="number" class="form-control" name="poid" placeholder="Entrer le poids/volume" maxlength="5">
            </div>
        </div>
        <div id="repaire" class="form-group">
            <div class="col-sm-offset-4 col-sm-8">
                <button class="btn btn-default" onclick="ajoutingre(event);">Ajouter</button>
            </div>
        </div>
        <div id="repaire1" class="form-group">
            <div class="col-sm-offset-4 col-sm-8">
                <button type="submit" class="btn btn-default">Créer</button>
            </div>
        </div>
    </form>
</div>