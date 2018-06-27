<?php
error_reporting(0);
//==============SETUP===========================
$projectname = $_GET['projectname'];
$project_foldername = "projects/" . $projectname . "/";

$fp = fopen($project_foldername.'project_original_name.txt','r');
$project_original_name = fread($fp, filesize ($project_foldername.'project_original_name.txt'));
fclose($fp);
//==============================================
    $original_filename=$project_foldername."original.txt";
    $fp = fopen($original_filename,"r");
    $original=fread($fp,filesize($original_filename));
    fclose($fp);
    
    $translation_filename=$project_foldername."translation.txt";
    $fp = fopen($translation_filename,"r");
    $translation=fread($fp,filesize($translation_filename));
    fclose($fp);

$tsv_file_content = "";
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

$handle1 = fopen ($original_filename, "r");
$handle2 = fopen ($translation_filename, "r");
if ($handle1 and $handle2) {
    while (($line_original = fgets($handle1)) !== false) {
        $line_translated = fgets($handle2);
        $html_file_content .= '<div class="unit"><p class="original">'.$line_original.'</p><p class="translation">'.utf8_decode($line_translated).'</p></div>';
        $tsv_file_content .= substr($line_original,0,-2). "\t" . $line_translated; 
    }
    fclose($handle1);
    fclose($handle2);
} else {
    // error opening the file.
}

$html_file_content .= '
</body>
</html>';

$tsv_filename=$project_foldername . $projectname . ".tsv";
$fp = fopen ($tsv_filename, 'w' );
fwrite ( $fp, $tsv_file_content);
fclose ( $fp );

$html_filename=$project_foldername . $projectname . ".html";
$fp = fopen ($html_filename, 'w' );
fwrite ( $fp, $html_file_content);
fclose ( $fp );

echo '<a href="'.$project_foldername . $projectname . '.html" target="_blank">Open newly created interlinear HTML-Site</a><br /><br />';
echo '<a href="start.php">Home</a>';
//header('Location: '.$project_foldername . $projectname . '.html');
//die;