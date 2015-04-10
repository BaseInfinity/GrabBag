

<style type="text/css">
body {
    height: 100%;
    width: auto;
    overflow: hidden;
}
#item_container			{
    display: inline-block;
    width:800px;
    height:500px;
    overflow:auto;
    border:1px solid #ccc;
    -webkit-border-radius:10px;
    -moz-border-radius:10px; }
.item{
    display: inline-block;
    text-align: center;
    word-wrap: normal;
    position: static}
#items	{
    height:300px;
    overflow-style:scrollbar; }
</style>

<!DOCTYPE html>
<html>
    <head>
    <title>My Inventory</title>

    <script type="text/javascript" src="../../js/MooTools-Core-1.5.1.js"></script>
    <script type="text/javascript" src="../../js/darkwing-ScrollSpy-f202941/Source/ScrollSpy.js"></script>
    <script type="text/javascript" src="../../js/jquery-1.11.2.js"></script>

    <script type="text/javascript" src="../../js/ducksboard-gridster.js-3140374/src/jquery.collision.js"></script>
    <script type="text/javascript" src="../../js/ducksboard-gridster.js-3140374/src/jquery.coords.js"></script>
    <script type="text/javascript" src="../../js/ducksboard-gridster.js-3140374/src/jquery.draggable.js"></script>

    <script type="text/javascript" src="../../js/ducksboard-gridster.js-3140374/src/jquery.gridster.js"></script>
    <link type="text/css" src="../../js/ducksboard-gridster.js-310374/src/jquery.gridster.css">

    <script type="text/javascript" src="../../js/ducksboard-gridster.js-3140374/src/jquery.gridster.extras.js"></script>

    <script type="text/javascript" src="../../js/ducksboard-gridster.js-3140374/src/utils.js"></script>
    <!-- <script type="text/javascript" src="scroller.javascript"></script>-->>





</head>

<body>
<input type="text" id="textfield" />
            <input type="button" id="load-more" value="Click me!"/>

    <div class="gridster" id="item_container">
        <ul id="items">


        </ul>
    </div>

</body>


</html>
<script>
var grid;
$(function() {

    grid = $(".gridster > ul").gridster({
        widget_margins: [10, 20],
            widget_base_dimensions: [140, 140],
            widget_selector: "div",
            min_cols: 5,
            max_cols: 'null',
            max_size_x: 5,
            min_rows: 5,
            autogrow_cols: false,
            autogrow_rows: true,
            avoid_overlapped_widgets: true,
            resize: {
                enabled: false
                }


    }).data('gridster');

});


/*Native.implement([Element, Window, Document, Events], {
    oneEvent: function(type, fn) {
        return this.addEvent(type,function() {
            this.removeEvent(type,arguments.callee);
            return fn.apply(this.arguments);
        });
        }
});*/


(function($){
    //var start;
    //var desiredItems;
    window.addEvent('domready',function(){
     domain = 'http://ifixit.com/api/2.0/';
     //initialItems = <!--?php echo get_items(0,$_SESSION['items_start']); ?-->;
     //var start;
     //var desiredItems;
     //start = <!--?php echo $_SESSION['items_start']; ?-->;
     start = 0;
     desiredItems = 20;
     row = 1;
     column = 1;
     //desiredItems = <!--?php echo $number_items; ?-->;
     //start = 20;
     //desiredItems = 20;
     loadMore = $('load-more');

     var spy;
     var spyContainer = $('item_container');
     var spyAct = function() {
         var min = spyContainer.getScrollSize().y - spyContainer.getSize().y - 150;
         spy = new ScrollSpy({
             container: spyContainer,
             min: min,
             onEnter: function(){
             loadMore.fireEvent('click');
             }
         });
    };

    /*window.oneEvent('load',function(){
        spyAct();
    });*/






    //Grabs the items from the JSON file that it's given
    var itemHandler = function(itemsJSON){
        var myObject = JSON.decode(itemsJSON);
        console.log("OBJECT: " + myObject);
        myObject.each(function(item,i) {
            //check to make sure the item has an image, should put
            //a better check here. Also maybe to allow items on the list
            //that don't have an image.
            if(item.image == null){
                return true;
                }
            //console.log("******************************" + itemsJSON);

            var imageURL = item.image.thumbnail;

            var itemName = item.display_title;

            var itemDiv = new Element('div', {
                'class': 'item',
                'data-row': row,
                'data-col': column,
                id: 'item-' + item.wikiid,
                html: '<a><img src="' + imageURL + '"</img>'
                        + '<p>' + itemName + '</p></a>'
            });
            //itemDiv.inject($('items'));i
            grid.add_widget(itemDiv, 1, 1, column, row);
            if(i%5 == 0){

                row += 1;
            }

            column = 1 + i%5;
            console.log("ROW: " + row + "COLUMN: " + column);
            jQuery($('item-' + item.wikiid)).css({
                'top': 'auto'
            });
        });
    };

    //itemHandler(initialItems);
    var getDomain = function(){
        return domain + 'wikis/CATEGORY?offset=' + start + '&limit=' + desiredItems;
        }

    //*******OBSOLETE REQUEST IMPLEMENTATION, KEPT FOR REFERENCE*********
    //The request used for grabbing the items.
    var request = new Request({
        url: 'load-more.php',
        method: 'get',
        link: 'cancel',
        noCache: true,
        onSuccess: function(responseJSON){
            console.log("first" +start);
            start += desiredItems;
            itemHandler(responseJSON);
            console.log("third " + start);
            spyAct();
            console.log("second " + start);
        }/*,
        onFailure: function() {

        },
        onComplete: function() {

        }*/

    });

    //generates and sends the next request
    var generateRequest = function(){
        var request = new Request({
            url: getDomain(),
            method: 'get',
            link: 'cancel',
            onSuccess: function(responseJSON){
                start += desiredItems;
                itemHandler(responseJSON);
                spyAct();
                }
        }

        );

        request.send();
        }

    loadMore.addEvent('click',function() {
        /*request.send({
            data:{
                'start': start,
                'desiredItems': desiredItems
            }
        });*/
        generateRequest();
    });

    $('load-more').trigger('click');

});
})(document.id);


</script>











