<!doctype html>
<!--[if IE 9]><html class="lt-ie10" lang="en" > <![endif]-->
<html class="no-js" lang="en" data-useragent="Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.2; Trident/6.0)">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <?php
        $story = $post->post;
    ?>
    <title><?php echo $story->title; ?> | ZiwaphiHealth</title>
    <meta name="description" content="South Africa Health Portal"/>
    <meta name="author" content="Nick Hargreaves"/>
    <meta name="copyright" content="CodeForAfrica Copyright (c) 2014"/>
    <link rel="stylesheet" href="css/foundation.css" />
    <link rel="stylesheet" href="main.css" />
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.1.1/css/font-awesome.css" rel="stylesheet">
    <link rel="stylesheet" href="icons/foundation-icons/foundation-icons.css" />
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <script src="js/vendor/modernizr.js"></script>
    <link href='http://fonts.googleapis.com/css?family=Vollkorn' rel='stylesheet' type='text/css'>
    <link href="prism/prism.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="autocomplete/jquery.autocomplete.css">
    <script type="text/javascript" src="autocomplete/jquery.js"></script>
    <script type='text/javascript' src='autocomplete/jquery.autocomplete.js'></script>
    <script src="prism/prism.js"></script>
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

        });
    </script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script>
        $(document).ready(function(){

            $('#medicine_name').keypress(function (e) {
                if (e.which == 13) {
                    $('#searchMedicine').click();
                    return false;    //<---- Add this line
                }
            });

            $("#searchMedicine").click(function(){
                var name = $("#medicine_name").val();

                $("#dname").html("<h4>Results for: " + name + "</h4>");

                $("#doctorDetails").html("");

                $("#loading").show();

                $.ajax({url:"medicine_price?q=" + name,success:function(result){
                    $("#medicine_name").val("");

                    $("#doctorDetails").html(result);

                    $("#loading").hide();
                }});
            });

            $('#dodgy_docs_input').keypress(function (e) {
                if (e.which == 13) {
                    $('#grabDetails').click();
                    return false;    //<---- Add this line
                }
            });

            $("#grabDetails").click(function(){
                var name = $("#dodgy_docs_input").val();

                $("#dname").html("<h4>Results for: " + name + "</h4>");

                $("#doctorDetails").html("");

                $("#loading").show();

                $.ajax({url:"doctordetails?name=" + name,success:function(result){
                    $("#dodgy_docs_input").val("");

                    $("#doctorDetails").html(result);

                    $("#loading").hide();
                }});
            });





            $('#medicine_name2').keypress(function (e) {
                if (e.which == 13) {
                    $('#searchGeneric').click();
                    return false;    //<---- Add this line
                }
            });

            $("#searchGeneric").click(function(){
                var name = $("#medicine_name2").val();

                $("#dname").html("<h4>Results for: " + name + "</h4>");

                $("#doctorDetails").html("");

                $("#loading").show();

                $.ajax({url:"medicine_generics?q=" + name,success:function(result){
                    $("#medicine_name2").val("");

                    $("#doctorDetails").html(result);

                    $("#loading").hide();
                }});
            });


            $('#hospital_location').keypress(function (e) {
                if (e.which == 13) {
                    $('#searchHospitals').click();
                    return false;    //<---- Add this line
                }
            });

            $("#searchHospitals").click(function(){
                var name = $("#hospital_location").val();

                $("#dname").html("<h4>Results for: " + name + "</h4>");

                $("#doctorDetails").html("");

                $("#loading").show();

                $.ajax({url:"find_hospitals?q=" + name,success:function(result){
                    $("#hospital_location").val("");

                    $("#doctorDetails").html(result);

                    $("#loading").hide();
                }});
            });

            $('#site_search').keypress(function (e) {
                if (e.which == 13) {
                    $('#site_search_submit').click();
                    return false;    //<---- Add this line
                }
            });

            $('#site_search_submit').click(function(){

                if($('#site_search').val().length == 0){
                    alert('Please enter a search query!');
                }else{
                    window.location = "<?php echo Config::get('custom_config.WPFeedRoot');?>?s=" + $('#site_search').val();
                }

            });

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
<div class="row">
    <div class="large-12 columns">
        <div class="name">
              <img src="img/logo.png" style="height:80px;">
              <div class="h1">Health</div>
        </div>
        <nav class="top-bar" data-topbar="" role="navigation">
            <!-- Title -->
            <ul class="title-area"">
                <!-- Mobile Menu Toggle -->
                <li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
            </ul>

            <!-- Top Bar Section -->
            <section class="top-bar-section">
                <!-- Top Bar Right Nav Elements -->
                <ul class="left" style="font-size: 0.8em;">
                    <li><a href="http://health.ziwaphi.com" target="_blank">Home</a></li>
                    <li><a href="http://ziwaphi.com" target="_blank">Ziwaphi</a></li>
                    <li><a href="http://dlb.ziwaphi.com" target="_blank">Dead Letter Box</a></li>
                </ul>
                <ul class="right">
                    <!-- Search | has-form wrapper -->
                    <li class="has-form">
                        <div class="row collapse">
                                <div class="large-8 small-9 columns">
                                    <input type="text" placeholder="Enter key words" name="s" id="site_search">
                                </div>
                            <div class="large-4 small-3 columns" id="site_search_submit">
                                <a href="#" class="button expand">Search</a>
                            </div>
                        </div>
                    </li>
                </ul>
            </section>
        </nav>
    </div>
</div>

<div class="row app_section">
    <div class="large-3 columns app-container">
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
                    <pre><code class="language-markup">&lt;iframe height="100px" width="300px" src="<?php print URL::to('/embed_widget?q=1');?>" scrolling="no" frameborder="0">&lt;/iframe></code></pre>
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
    <div class="large-3 columns app-container">
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
            <span class="embed"><a href="#" data-reveal-id="embedModal2"><i class="icon-code"></i> Embed this widget</a></span>
        </div>
    </div>
    <div class="large-3 columns app-container">
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
            <span class="embed"><a href="#" data-reveal-id="embedModal3"><i class="icon-code"></i> Embed this widget</a></span>
        </div>
    </div>
    <div class="large-3 columns app-container">
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
            <span class="embed"><span class="near_me" style="cursor: pointer;"><i class="icon-location-arrow"></i> <span id="get_location_text" style="">My Location</span></span> &nbsp; <a href="#" data-reveal-id="embedModal4"><i class="icon-code"></i> Embed this widget</a></span>
        </div>

    </div>


    <!-- Modal for embed doctor details -->
    <div id="embedModal" class="reveal-modal" data-reveal>
        <div><h4>Copy code below to embed this widget on your website</h4></div>
        <pre><code class="language-markup">&lt;iframe height="100px" width="300px" src="<?php print URL::to('/embed_widget?q=1');?>" scrolling="no" frameborder="0">&lt;/iframe></code></pre>
        <a class="close-reveal-modal">&#215;</a>
    </div>

    <div id="embedModal2" class="reveal-modal" data-reveal>
        <div><h4>Copy code below to embed this widget on your website</h4></div>
        <pre><code class="language-markup">&lt;iframe height="100px" width="300px" src="<?php print URL::to('/embed_widget?q=2');?>" scrolling="no" frameborder="0">&lt;/iframe></code></pre>
        <a class="close-reveal-modal">&#215;</a>
    </div>

    <div id="embedModal3" class="reveal-modal" data-reveal>
        <div><h4>Copy code below to embed this widget on your website</h4></div>
        <pre><code class="language-markup">&lt;iframe height="100px" width="300px" src="<?php print URL::to('/embed_widget?q=3');?>" scrolling="no" frameborder="0">&lt;/iframe></code></pre>
        <a class="close-reveal-modal">&#215;</a>
    </div>

    <div id="embedModal4" class="reveal-modal" data-reveal>
        <div><h4>Copy code below to embed this widget on your website</h4></div>
        <pre><code class="language-markup">&lt;iframe height="100px" width="300px" src="<?php print URL::to('/embed_widget?q=4');?>" scrolling="no" frameborder="0">&lt;/iframe></code></pre>
        <a class="close-reveal-modal">&#215;</a>
    </div>
</div>

<div class="row">

    <div class="large-12 columns">
        <?php
            print '<div class="story">';
                print '<a href="'.$story->url.'"><h4>'.$story->title.'</h4></a>';
                print $story->content.'
                <p class="story-metadata"><i>Written by '.$story->author->nickname.' | Posted on '.date("l jS \of F Y h:i:s A", strtotime($story->date)).'</i></p>
            </div>';
        ?>
    </div>

</div>

<div class="row footer">

    <div class="large-12 columns footer_section">

        <div class="row">
            <div class="large-6 columns">
            </div>
            <div class="large-6 columns">
                <ul class="inline-list right">
                    <li><a href="http://health.ziwaphi.com" target="_blank">Home</a></li>
                    <li><a href="http://ziwaphi.com" target="_blank">Ziwaphi</a></li>
                    <li><a href="http://dlb.ziwaphi.com" target="_blank">Dead Letter Box</a></li>
                </ul>
            </div>
        </div>

        <div class="footer_brand large-12 columns">
            <a href="http://codeforafrica.org" target="_blank">Built by Code for Africa</a>
        </div>
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