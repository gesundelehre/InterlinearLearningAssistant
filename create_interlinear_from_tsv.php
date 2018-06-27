<?php
error_reporting(0);

//choose from which project TODO
if (!$_GET['projectname']){
    $projects = scandir("projects");
    //print_r($projects);
    echo'<form action="'.$_SERVER['PHP_SELF'].'" method="get">Choose Project to update HTML-file by re-processing corresponding tsv-file:<br /><select name="projectname">';
    foreach ($projects as $project) {
        if ($project != "." && $project != ".."){
            echo'<option value="'.$project.'">'.$project.'</option>';    
        }
    }
    echo'</select><input type="submit" value="Re-Process tsv-File"/></form>';  
}else{
    $project_chosen = $_GET['projectname'];
    
    
    //$project_chosen = "testproject_2";
    $project_foldername = "projects/" . $project_chosen . "/";
    $tsv_filename = $project_foldername . $project_chosen . ".tsv";

    $fp = fopen($project_foldername.'project_original_name.txt','r');
    $project_original_name = fread($fp, filesize ($project_foldername.'project_original_name.txt'));
    fclose($fp);
    
    $html_file_content = '<html>
    <head>
    <title>'.$project_original_name.'</title>
    <meta http-equiv="Content-type" content=\'text/html; charset="utf-8"\' />
    <style>
    div.unit {
     float: left;
     margin-bottom: 1em;
     color: black;
    }
    p.original {
     font-size: 16pt;
     margin: 0em;
     padding: 0em 0.5em;
    }
    p.translation {
     font-size: 10pt;
     font-family: sans-serif;
     color: gray;
     margin: 0em;
     padding: 0em 1em;
    }
    </style>
    </head>
    <body>
    <h1>'.$project_original_name.'</h1>';

    
    $handle = fopen ($tsv_filename, "r");
    if ($handle) {
        while (($whole_line = fgets($handle)) !== false) {
            $place_of_tab = strpos($whole_line,"\t");
            $word_original = substr($whole_line,0,$place_of_tab);
            $word_translated = substr($whole_line,$place_of_tab);
            $html_file_content .= '<div class="unit"><p class="original">'.$word_original.'</p><p class="translation">'.$word_translated.'</p></div>';
        }
        fclose($handle);
    } else {
        // error opening the file.
    }
    $html_file_content .= '
    </body>
    </html>';

    $html_filename=$project_foldername . $project_chosen . ".html";
    $fp = fopen ($html_filename, 'w' );
    fwrite ( $fp, $html_file_content);
    fclose ( $fp );
    
    echo '<a href="'.$project_foldername . $project_chosen . '.html">Open newly created interlinear HTML-Site</a>';
        
}
?>