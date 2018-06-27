<?php
error_reporting(0);
//==============SETUP===========================
$projectname = $_GET['projectname'];
$project_foldername = "projects/" . $projectname . "/";

$fp = fopen($project_foldername.'project_original_name.txt','r');
$project_original_name = fread($fp, filesize ($project_foldername.'project_original_name.txt'));
fclose($fp);
//==============================================
if ($_POST['translation_sent']!=1){
    $original_filename="projects/".$projectname."/original.txt";
    $fp = fopen($original_filename,"r");
    $text=fread($fp,filesize($original_filename));
    fclose($fp); 
?>
    <html>
    <head><title><?php echo $project_original_name ?></title>
    <style>
        div#original{
            float: left;
            width: 30%;
        }
        div#translation{
            float: left;
            width: 30%;
        }
        div#container{
            margin-left: auto;
            margin-right: auto;
            width: 80%;
        }
        div#send_button{
            clear: both;
        }
    </style></head>
    <body>
    <div id="container"><form action="translate.php?projectname=<?php echo $projectname ?>" method="post">
    <div id="original">Original Text:<br />
    <textarea cols="50" rows="20"><?php echo $text ?></textarea></div>
    
    <div id="translation">Translation:<br />
    <textarea name="translation" cols="50" rows="20"></textarea><br /><br />
    You need to copy-paste text from the the original textfield into google translate and then return back and paste the translation into the translation-textfield.</div>
    <input type="hidden" name="translation_sent" value="1" />
    <div id="send_button"><input type="submit" value="Save Translation + create Interlinear Text"/></div>
    </form>
    </div>
    </body>
    </html>
<?php     
          
}else{
    $new_entered_translation = $_POST['translation'];
    $translation_filename = "projects/".$projectname."/translation.txt";
    /*if (!file_exists($translation_filename)){
        $fp = fopen($translation_filename,'r');
        $existing_translation = fread($fp, filesize ($translation_filename));
        fclose($fp);
    }else{
        $existing_translation = "";
    }      */
    //$new_translation_text = $existing_translation . $new_entered_translation;

    $fp = fopen ($translation_filename, 'w' );
    //fwrite ( $fp, utf8_encode($new_translation_text));
    fwrite ( $fp, utf8_encode($new_entered_translation));
    fclose ( $fp );

    header('Location: create_interlinear.php?projectname='.$projectname);
    die;       
}

      


?>

