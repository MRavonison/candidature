<?php

/**
 * Created by PhpStorm.
 * User: miharizoravonison
 * Date: 23/01/2017
 * Time: 16:10
 */
 /* Ce fichier vérifie les données upload, principalement les photos*/

namespace App;

class Upload
{

    public function controlSizeFile ($name)
    {
        $maxSize = UPLOAD_ERR_INI_SIZE;

        if($_FILES[$name]['size'] > $maxSize)
        {
            return false;
        }
        return true;
    }

    public function controlTypeFile($name)
    {
        $extensions_valides = array( 'jpg' , 'jpeg' , 'gif' , 'png' );
        //1. strrchr renvoie l'extension avec le point (« . »).
        //2. substr(chaine,1) ignore le premier caractère de chaine.
        //3. strtolower met l'extension en minuscules.
        $extension_upload = strtolower(  substr(  strrchr($_FILES[$name]['name'], '.')  ,1)  );
        if ( in_array($extension_upload,$extensions_valides) )
        {
            return true;
        }
        return false;
    }

    public function getUploadFile($name)
    {
        if(array_key_exists($name,$_FILES)== true)
        {
            if ($_FILES[$name]['error'] = UPLOAD_ERR_OK)
            {
                return true;
            }
        }
        return false;
    }

    public function moveUploadFile($name)
    {
        $location = "../img/upload/".$_FILES[$name]['name'];
        if($this->getUploadFile($name)== false)
        {
            echo "Erreur de chargement";
        }
        if ($this->controlSizeFile($name)==false)
        {
            echo 'Erreur le fichier est trop gros';
        }
        if ($this->controlTypeFile($name)==false)
        {
            echo "Erreur le fichier doit être de type JPG/JPEG/GIF/PNG";
        }
        return move_uploaded_file($_FILES[$name]['tmp_name'],$location);
    }

    // Penser à une redirection de fichier header()
}