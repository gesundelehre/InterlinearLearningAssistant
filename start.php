<?php
    error_reporting(0);
    include("includes/show_overview.php");



?>

<html>
    <head>
        <title>Create Interlinear Texts: Home</title>
        <style>
        .navigation{
            float: left;
            width: 400px;
            height: 100%;
            background-color: #FFD95A;
            margin-right: 20px;
        }
        .navigation a{
            display: block;
            text-decoration: none;
            color: white;
            background-color: #808080;
        }
        .navigation a:hover{
            color: yellow;
            background-color: #808080;
        }
        </style>
    </head>
    <body>
        <div class="header">
        </div>
        <div class="navigation">
            
            <a href="create_interlinear_from_tsv.php" target="_blank">Recreate HTML from updated tsv-file</a><br />
            <a href="split_text_test.php" target="_blank">Create new Project</a><br />
            <a href="overview.php" target="_blank">Overview of all Projects so far</a><br />
            <a href="import_tsv.php" target="_blank">Import new .tsv-File</a><br />
        </div>
        <div id="overview">
        <?php show_overview("projects");  ?>
        </div>
    </body>
</html>