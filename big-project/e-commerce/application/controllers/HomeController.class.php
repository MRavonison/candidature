<?php
// controle page d'accueil
class HomeController
{

    public function httpGetMethod()
    {
	// Méthode appelée lorsque l'on fait une requête HTTP GET sur l'URL /
        $mealModel  = new MealModel();
        $meals      = $mealModel->listAll();

    //integration des de variable dans phtml voir homeview
        return
        [
            'meals'=>$meals,
            'flashBag'=>new FlashBag(),
        ];
    }
}
