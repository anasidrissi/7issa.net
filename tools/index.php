<html lang="fr">
    <head>
        <title>Player YouTube JS</title>
 
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
 
        <!-- Optional theme -->
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">
        <link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/themes/smoothness/jquery-ui.css" />
 
        <!-- Latest compiled and minified JavaScript -->
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/jquery-ui.min.js"></script>
 
        <style type="text/css">
           #slider .ui-slider-range { background: #29b3bf; }
           #slider .ui-slider-handle { border-color: #29b3bf; }
            
        </style>
        
    </head>
    <body>
 
        <div class="container">
            <div class="row">
                <h3>Title YouTube Player</h3>
                <div class="col-md-8">
                    <div id="player"></div>
                </div>
                <div class="col-md-7">
                    <div class="col-md-1">
                        <!-- button play/pause -->
                        <span class="button-play glyphicon glyphicon-play"></span>
                        <span class="button-play glyphicon glyphicon-pause" style="display:none"></span>
 
                    </div>
                    <div class="col-md-1">
                        <!-- button volume -->
                        <span class="button-volume glyphicon glyphicon-volume-up"></span>
                        <span class="button-volume glyphicon glyphicon-volume-down" style="display:none"></span>                        
                    </div>
                    <div class="col-md-9">
                        <!-- input range with JqueryUI -->
                        <div id="slider"></div>
 
                    </div>
                    <div class="col-md-1">
                        <!-- button fullscreen -->
                        <span class="button-resize glyphicon glyphicon-resize-full" id="fullsize"></span>
 
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript">

            $("#slider").slider({
                range: "min"
            });

        </script>
 
        <script src="player.js"></script>
        <?php
        echo "<h1>". $_GET['g'] . "</h1>";
        ?>
  
    </body>
</html>