<?php
    function show_overview($dir){
        echo 'Overview of Projects<br />';
        $projects = scandir($dir);
        //print_r($projects);
    
        foreach ($projects as $project) {
            if ($project != "." && $project != ".."){
                $current_project_foldername = "projects/" . $project . "/";
    
                $fp = fopen($current_project_foldername.'project_original_name.txt','r');
                $current_project_original_name = fread($fp, filesize ($current_project_foldername.'project_original_name.txt'));
                fclose($fp);
    
                echo'<a href="'.$current_project_foldername.$project.'.html" target="_blank">'.$current_project_original_name.'</a><br />';
            }
        }
    }
?>