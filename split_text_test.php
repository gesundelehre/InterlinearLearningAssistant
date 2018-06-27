<?php
error_reporting(0);
function rrmdir($dir) {    //remove directory recursively
   if (is_dir($dir)) { 
     $objects = scandir($dir); 
     foreach ($objects as $object) { 
       if ($object != "." && $object != "..") { 
         if (filetype($dir."/".$object) == "dir"){
            rrmdir($dir."/".$object);  
         } else {
            unlink($dir."/".$object);   
         }
       } 
     } 
     reset($objects); 
     rmdir($dir); 
   } 
}

//==============SETUP===========================
//$character_limit_filename = 'google_translate_character_limit.txt';       -----NOT NEEDED ANYMORE----
//$project_original_name = "Deutsch Beispiel";                              -----NOT NEEDED ANYMORE----
//$projectname = str_replace(" ","_",strtolower($project_original_name));   -----NOT NEEDED ANYMORE----
//==============================================


/*$text_input = "Mit unheimlicher Lautst�rke dr�hnen die Glocken der Friedenskirche durch meine Nachbarschaft. Insbesondere am Sonntagmorgen schallen sie derart durchdringend, dass jedes Schlafen verunm�glicht wird. Ein Christ antwortete auf mein Klagen diesbez�glich: \"Wir k�nnen doch froh sein um dieses Gel�ute. Das ruft uns Schweizern wenigstens wieder in Erinnerung, dass wir in einem christlichen Land leben.\" In einem christlichen Land? Wir? - Diese Idee macht mich stutzig. Was heisst es �berhaupt, ein christliches Land zu sein? Und falls wir wissen was es heisst, ein christliches Land zu sein ? ist die Schweiz ein solches Land?

Sollen geleitet. Wenn man die \"Christlichkeit\" eines Landes daran messen will, ob die Teile, die es ausmachen ? seine Menschen, seine F�hrer, sein �ffentliches Leben ? vom Glauben an den Gott Abrahams gepr�gt sind, so k�nnen wir die Schweiz nicht als christliches Land bezeichnen."; */

if (!$_POST['input_text_sent']){
    
?>

<html>
    <head>
    
    </head>
    <body>
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
            Project-Title: <br/>
            Only letters, numbers, dashes and spaces<br />
            <input type="text" name="title_of_project"/><br /><br />
            Text to create Interlinear Text from: <br />
            <textarea name="input_original_text" cols="50" rows="20"></textarea><br /><br />
            <input type="hidden" name="input_text_sent" value="1" />
            <input type="submit" value="Send Form"/>
        </form>
    </body>
</html>

<?php 
}else{
    $project_original_name = $_POST['title_of_project'];
    $projectname = str_replace(" ","_",strtolower($project_original_name));
    $text_input = $_POST['input_original_text'];
    $project_foldername = "projects/" . $projectname . "/";
    
    if (!file_exists($project_foldername)) { //if projectfolder does not yet exist
        mkdir($project_foldername);
    }else{    // if projectfolder does already exist: delete resp. overwrite existing project with same filename
        rrmdir($project_foldername);
        mkdir($project_foldername);
    }    
    
    $fp = fopen ($project_foldername.'project_original_name.txt', 'w' );
    fwrite ( $fp, utf8_encode($project_original_name));
    fclose ( $fp );

    //echo strlen($text_input);     //5410 = l�nge des beispieltexts (Google z�hlt allerdings nur 5389 - dh man kann ruhig die php-z�hlweise nehmen)   -----NOT NEEDED ANYMORE----
    
    //$fp = fopen($character_limit_filename,'r');                              -----NOT NEEDED ANYMORE----
    //$character_limit = fread($fp, filesize ($character_limit_filename));     -----NOT NEEDED ANYMORE----
    //fclose($fp);                                                             -----NOT NEEDED ANYMORE----
    
    //if (strlen($text_input)>$character_limit){  -----NOT NEEDED ANYMORE----
    
    //}else{                                     -----NOT NEEDED ANYMORE----
    $text_input = str_replace ("\r\n", "", $text_input);
    $text_input = str_replace (' ', "\r\n", $text_input);
    $fp = fopen ($project_foldername.'original.txt', 'w' );
    fwrite ( $fp, $text_input);
    fclose ( $fp );
    //echo "file 'original.txt' was successfully written";
    header('Location: translate.php?projectname='.$projectname);
    die;
//}
}
?>