<!doctype html>
<html>
    <head>
        <title>my inventory</title>

        <link rel="stylesheet" type="text/css" href="styles.css">i

        <script type="text/javascript" src="js/MooTools-Core-1.5.1.js"></script>
        <script type="text/javascript" src="js/darkwing-ScrollSpy-f202941/Source/ScrollSpy.js"></script>
        <script type="text/javascript" src="js/jquery-1.11.2.js"></script>

        <script type="text/javascript" src="js/ducksboard-gridster.js-3140374/src/jquery.collision.js"></script>
        <script type="text/javascript" src="js/ducksboard-gridster.js-3140374/src/jquery.coords.js"></script>
        <script type="text/javascript" src="js/ducksboard-gridster.js-3140374/src/jquery.draggable.js"></script>

        <script type="text/javascript" src="js/ducksboard-gridster.js-3140374/src/jquery.gridster.js"></script>
        <link type="text/css" src="js/ducksboard-gridster.js-310374/src/jquery.gridster.css"></link>

        <script type="text/javascript" src="js/ducksboard-gridster.js-3140374/src/jquery.gridster.extras.js"></script>

        <script type="text/javascript" src="js/ducksboard-gridster.js-3140374/src/utils.js"></script>

        <script type="text/javascript" src="inventory.js"></script>
    </head>

    <body >

        <div class="gridster" id="item_container">
            <ul id="items"></ul>
        </div>
        <div class="gridster" id="inventory">
            <ul id="myItems"></ul>
        </div>
        <div id="holder" style="vertical-align:bottom">
            <input type="button" id="load-more" value="Click me!"/>
            <input type="button" style="float:right" id="save" value="Save"/>
        </div>


    </body>


</html>

