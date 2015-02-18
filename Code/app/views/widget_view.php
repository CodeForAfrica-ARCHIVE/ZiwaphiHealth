<!doctype html>
<!--[if IE 9]><html class="lt-ie10" lang="en" > <![endif]-->
<html class="no-js" lang="en" data-useragent="Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.2; Trident/6.0)">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>ZiwaphiHealth | Home</title>
    <meta name="description" content="South Africa Health Portal"/>
    <meta name="author" content="Nick Hargreaves"/>
    <meta name="copyright" content="CodeForAfrica Copyright (c) 2014"/>
    <link rel="stylesheet" href="css/foundation.css" />
    <link rel="stylesheet" href="main.css" />
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.1.1/css/font-awesome.css" rel="stylesheet">
    <link rel="stylesheet" href="icons/foundation-icons/foundation-icons.css" />
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <script src="js/vendor/modernizr.js"></script>

    <link rel="stylesheet" type="text/css" href="autocomplete/jquery.autocomplete.css">
    <script type="text/javascript" src="autocomplete/jquery.js"></script>
    <script type='text/javascript' src='autocomplete/jquery.autocomplete.js'></script>
    <script type="text/javascript">
        $.noConflict();
        jQuery(document).ready(function($) {
            //doctors autocomplete
            $("#dodgy_docs_input").autocomplete("doctor", {
                width: 260,
                matchContains: true,
                selectFirst: true
            });
            //TOTHINK: does search generic need autocomplete?
            /*
             //drug prices autocomplete
             $("#medicine_name").autocomplete("drugSuggestions", {
             width: 260,
             matchContains: true,
             selectFirst: true
             });
             //drug generics autocomplete
             $("#medicine_name2").autocomplete("drugSuggestions", {
             width: 260,
             matchContains: true,
             selectFirst: true
             });
             */
        });
    </script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            $("#grabDetails").click(function(){
                var name = $("#dodgy_docs_input").val();

                $("#dname").html("<h4>" + name + "</h4>");

                $("#doctorDetails").html("");

                $("#loading").show();

                $.ajax({url:"doctordetails?name=" + name,success:function(result){
                    $("#dodgy_docs_input").val("");

                    $("#doctorDetails").html(result);

                    $("#loading").hide();
                }});
            });
        });
        $(document).ready(function(){
            $("#searchMedicine").click(function(){
                var name = $("#medicine_name").val();

                $("#dname").html("<h4>" + name + "</h4>");

                $("#doctorDetails").html("");

                $("#loading").show();

                $.ajax({url:"medicine_price?q=" + name,success:function(result){
                    $("#medicine_name").val("");

                    $("#doctorDetails").html(result);

                    $("#loading").hide();
                }});
            });
        });

        $(document).ready(function(){
            $("#searchGeneric").click(function(){
                var name = $("#medicine_name2").val();

                $("#dname").html("<h4>" + name + "</h4>");

                $("#doctorDetails").html("");

                $("#loading").show();

                $.ajax({url:"medicine_generics?q=" + name,success:function(result){
                    $("#medicine_name2").val("");

                    $("#doctorDetails").html(result);

                    $("#loading").hide();
                }});
            });
        });

        $(document).ready(function(){
            $("#searchHospitals").click(function(){
                var name = $("#hospital_location").val();

                $("#dname").html("<h4>" + name + "</h4>");

                $("#doctorDetails").html("");

                $("#loading").show();

                $.ajax({url:"find_hospitals?q=" + name,success:function(result){
                    $("#hospital_location").val("");

                    $("#doctorDetails").html(result);

                    $("#loading").hide();
                }});
            });
        });

        $(document).ready(function(){
            jQuery(".near_me").click(initiate_geolocation);
            //$("#loading_hospitals").show();
        });

        function initiate_geolocation() {
            $("#hospital_location").css("background", "white url('autocomplete/indicator.gif') right center no-repeat");
            navigator.geolocation.getCurrentPosition(handle_geolocation_query);
        }

        function handle_geolocation_query(position){
            //Get cordinates on complete
            var autoCords = position.coords.latitude + ',' + position.coords.longitude;

            //make ajax request to reverse geocode coordinates
            $.ajax({url:"reverse_geocode?q=" + autoCords,success:function(result){

                $("#hospital_location").val(result);

                //$("#loading_hospitals").hide();
                $("#hospital_location").css("background", "none");

            }});
        }
    </script>
</head>
<body>
<div class="large-3 app-container">
        <div class="app_header doctors">
            <i class="icon-user-md icon-2x app-icon"></i>
            <h4>Dodgy Doctors</h4>
        </div>
        <div class="app_body">
            Is your doctor registered in their area of practice?
            <p>
            <div class="row collapse">
                <div class="small-9 columns">

                    <input type="text" placeholder="Start typing doctor's name" class="search form-control ac_input" name="dodgydoc" id="dodgy_docs_input" autocomplete="off">
                </div>
                <div class="small-3 columns">
                    <a href="#" data-reveal-id="myModal"><span class="postfix" id="grabDetails"><i class="icon-search"></i></span></a>
                </div>

            </div>

            <!-- Modal for embed doctor details -->
            <div id="embedModal" class="reveal-modal" data-reveal>
                <div><h4>Copy code below to embed this widget on your website</h4></div>
                <textarea disabled><iframe height="100px" width="300px" src="<?php print URL::to('/');?>/dodgydocs_embed" scrolling="no" frameborder="0"></iframe></textarea>
                <a class="close-reveal-modal">&#215;</a>
            </div>

            <!-- Modal for doctor details -->
            <div id="myModal" class="reveal-modal" data-reveal>
                <div id="dname"><h2>[Name]</h2></div>
                <div class="loading" style="text-align:center;" id="loading">
                    <img src="img/preloader.gif" style="height:80px;">
                </div>
                <div id="doctorDetails">

                </div>
                <a class="close-reveal-modal">&#215;</a>
            </div>

            </p>
        </div>
        <div class="app_footer">
            <span class="embed"><a href="#" data-reveal-id="embedModal"><i class="icon-code"></i> Embed this widget</a></span>
        </div>
    </div>


    <div class="large-3 app-container">
        <div class="app_header medicine">
            <i class="icon-medkit icon-2x app-icon"></i>
            <h4>Medicine Prices</h4>
        </div>
        <div class="app_body">
            What should you pay for your medicine
            <p>
            <div class="row collapse">
                <div class="small-9 columns">
                    <input type="text" id="medicine_name" placeholder="e.g. salbutamol or asthavent"/>
                </div>
                <div class="small-3 columns" id="searchMedicine">
                    <a href="#" data-reveal-id="myModal"><span class="postfix" id="grabPrices"><i class="icon-search"></i></span></a>
                </div>
            </div>
            </p>
        </div>
        <div class="app_footer">
            <span class="embed"><a href="#"><i class="icon-code"></i> Embed this widget</a></span>
        </div>
    </div>


    <div class="large-3 app-container">
        <div class="app_header generics">
            <i class="icon-medkit icon-2x app-icon"></i>
            <h4>Find Generics</h4>
        </div>
        <div class="app_body">What generics are available for your drug
            <p>
            <div class="row collapse">
                <div class="small-9 columns">
                    <input type="text" id="medicine_name2" placeholder="e.g. salbutamol or asthavent"/>
                </div>
                <div class="small-3 columns" id="searchGeneric">
                    <a href="#" data-reveal-id="myModal"><span class="postfix" id="grabGenerics"><i class="icon-search"></i></span></a>
                </div>
            </div>
            </p>
        </div>
        <div class="app_footer">
            <span class="embed"><a href="#"><i class="icon-code"></i> Embed this widget</a></span>
        </div>
    </div>


    <div class="large-3 app-container">
        <div class="app_header hospitals">
            <i class="icon-hospital icon-2x app-icon"></i>
            <h4>Find a Hospital</h4>
        </div>
        <div class="app_body">Which are the best hospitals around you?
            <p>
            <div class="row collapse">
                <div class="small-9 columns">
                    <input type="text" id="hospital_location" placeholder="Eg. Hillbrow, Johannesburg" />
                </div>
                <div class="small-3 columns" id="searchHospitals">
                    <a href="#" data-reveal-id="myModal"><span class="postfix" id="grabHospitals"><i class="icon-search"></i></span></a>
                </div>
            </div>
            </p>
        </div>
        <div class="app_footer">
            <span class="embed"><span class="near_me" style="cursor: pointer;"><i class="icon-location-arrow"></i> <span id="get_location_text" style="">My Location</span></span> &nbsp; <a href="#"><i class="icon-code"></i> Embed this widget</a></span>
        </div>

    </div>

<script>
    document.write('<script src=js/vendor/' +
        ('__proto__' in {} ? 'zepto' : 'jquery') +
        '.js><\/script>')
</script>
<script src="js/vendor/jquery.js"></script>
<script src="js/foundation.min.js"></script>
<script>
    $(document).foundation();
</script>
<script src="js/foundation/foundation.reveal.js"></script>
<script src="js/foundation/foundation.js"></script>
<script src="js/foundation/foundation.accordion.js"></script>
<script>
    $(document).foundation();

    var doc = document.documentElement;
    doc.setAttribute('data-useragent', navigator.userAgent);
</script>
</body>
</html>