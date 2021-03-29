<?php
  class Image {
     // parcourt un dossier et récupère un array des images/fichiers
    public function getImages($files) {
         //Nous ouvrons le dossier $dir_vrac avec opendir 
         // Et affectons le résultat à la variable $handle 
         if($handle = opendir($files)) {
            while (false !== ($entry = readdir($handle))) {
                 /*la variable $entry ne pourra pas se voir affecté les . et les ..
                 */
                 if ($entry != "." && $entry != "..") {
                   /*nous affectons le résultat dans un array */
                   $images[] = $entry ; 
                }
            }
        }
        closedir($handle); //Nous fermons le repertoire avec closedir
        return $images;//Nous retournons le tableau de données 
     }
    public function actionSlug($files) {
        
            $extension = array('.jpeg','.jpg','.png','.gif',);
            $tab="";
            $without_extension=trim(str_replace($extension,$tab,$files));//nous supprimons l'extension du fichier
            $slug=substr($without_extension,0,-4);//nous supprimons le numero du fichier
            return $slug;
     }

    public function creatDir($files) {
        
        foreach ($files as $file){
            $slug=$this->actionSlug($file);
            $dir_source=WEB_DIR_PATH.'/'.$file;
            $new_dir_path=WEB_DIR_PATH.'/'.$slug;
            if(!is_dir($dir_source)){//si le fichier n'est pas un dossier et que son dossier correspondant n'existe pas
                if (file_exists($new_dir_path)==false)
                {
                    mkdir($new_dir_path, 0777);   
                }
            }    
        }
    }
    public function moveFile($files) {
        
        foreach ($files as $file){
            $slug=$this->actionSlug($file);
            $dir_source=WEB_DIR_PATH.'/'.$file;
            $dir_destination=WEB_DIR_PATH.'/'.$slug.'/'.$file;
            if ((is_dir($dir_source))==false)
            {
                rename($dir_source,$dir_destination);   
            }
        }
        $message="tri des fichiers effectué";
        return $message;
    }
}



 





 