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
                    window.location = "<?php echo URL::to('search_stories');?>?q=" + $('#site_search').val();
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
                    <li><a href="http://health.ziwaphi.com">Home</a></li>
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

<div class="row" style="margin-bottom: 20px">
    <div class="large-9 columns sidebar">
        <div style="padding:5px;background:#fff;"><a href="<?php print URL::to("/single_story?q=".$featured->id);?>"><h4 class="featured_title"> >> <?php print $featured->title;?></h4></a></div>
        <div class="large-7 columns"  style="background-color: #fff; height:510px;padding-top: 0.9375rem; border: 0px solid #cacaca; border-right: none;">
            <?php
            if($featured != null){
                ?>
                <?php
                    $description = explode("&hellip;", $featured->excerpt);

                    print $description[0];

                    print '<a href="'.URL::to("/single_story?q=".$featured->id).'"> &hellip; more</a>';

                ?>
                <h5>The story so far</h5>

                <ul class="side-nav" style="padding:0 !important;">

                    <?php
                    if(count($related)<1){
                        print "<h5 style='text-align:center'>No related stories at this time</h5>";
                    }
                    foreach($related as $r){
                        print '<li><a href="'.URL::to("/single_story?q=".$r->id).'" data-search="">'.$r->title.'</a></li>';
                    }
                    ?>
                </ul>
            <div class="evidence"><i class="fa fa-envelope" style="margin-right:5px;"></i>Evidence Dossier</div>
        </div>
        <div class="large-5 columns" style="background-color: #fff; height:510px;padding-top: 0.9375rem;  border: 0px solid #cacaca; border-left: none;">
            <?php

                if(!property_exists($featured, 'thumbnail')){
                    print '<img src="http://placehold.it/500x500&amp;text=[%20img%201%20]" width="100%">';
                }else{
                    print '<img src="'.$featured->thumbnail.'" width="100%">';
                }
            ?>

            <div class="feedback">
                <a href="#" data-reveal-id="feedbackModal">Tell us More</a>
                <p>Do you have more information? Help us improve this story by sharing your experiences/evidence.</p>
            </div>
            <div id="feedbackModal" class="reveal-modal" data-reveal>
                <div><h4>Share your experience with us</h4></div>
                <input type="text" placeholder="Your full names" name="name">
                <input type="text" placeholder="Email Address" name="email">
                <input type="text" placeholder="RE: <?php print $featured->title;?>" disabled>
                <input type="hidden" placeholder="RE: <?php print $featured->title;?>" name="post">
                <textarea rows="4" placeholder="Your message goes here"></textarea>
                <input type="submit" class="button" value="Send Feedback">
                <a class="close-reveal-modal">&#215;</a>
            </div>
            <?php
            }else{
                   print "<h5>No featured story created</h5>";
            }

            ?>
        </div>
    </div>
    <div class="large-3 columns sidebar">
        <div class="big-title" style="display:none;">Help Desk</div>
        <div class="content_body" style="height: 555px; font-size:0.8em;">
            <h5><i class="icon-phone"></i> Helplines</h5>

            <ul class="side-nav">
                <?php
                    $i = 0;
                    foreach($helpdesk['helpline'] as $h){

                        if($i<3){
                            print "<li>".create_link($h->title)."</li>";
                        }
                        $i++;
                    }
                ?>
            </ul>
            <h5><i class="fi-anchor"></i> Support groups</h5>
            <ul class="side-nav">
                <?php
                $i = 0;
                foreach($helpdesk['supportgroup'] as $h){

                    if($i<3){
                        print "<li>".create_link($h->title)."</li>";
                    }
                }
                ?>
            </ul>
            <h5><i class="fi-torsos-all"></i> Social media</h5>
            <ul class="side-nav">
                <?php
                $i = 0;
                foreach($helpdesk['socialmedia'] as $h){

                    if($i<3){
                        print "<li>".create_link($h->title)."</li>";
                    }
                }

                function create_link($htitle){

                    $parts = explode('|', $htitle);
                    if(count($parts)>1){
                        return "<a href='".$parts[1]."' target='_blank' style='background:none; padding:2px'>".$parts[0]."</a>";
                    }else{
                        return $htitle;
                    }

                }
                ?>
            </ul>
        </div>
    </div>
</div>


<div class="row further-reading">
    <div class="large-3 columns ">
        <div class="big-title">Major Stories</div>
        <div class="content_body">
        <dl class="accordion" data-accordion>
            <?php
            if(count($major_stories)<1){
                print "<h3 style='text-align:center'>No major stories found</h3>";
            }
            $i = 0;
            foreach($major_stories as $story){
                $i++;
                print'<dd class="accordion-navigation">
                <a href="#major-story-panel'.$i.'">'.$story->title.'<i class="icon-chevron-sign-down" style="float:right; margin-top:0px; margin-right:5px;"></i></a>';

                //if($i==1){
                //    print '<div id="major-story-panel'.$i.'" class="content active">';
                //}else{
                    print '<div id="major-story-panel'.$i.'" class="content">';
                //}
                if(property_exists($story, 'thumbnail')){
                    print '<img src="'.$story->thumbnail.'" style="width:100%">';
                }

                $description = explode("&hellip;", $story->excerpt);

                print $description[0];

                print '<a href="'.URL::to("/single_story?q=".$story->id).'"> &hellip; more</a>';

                print '</div>
            </dd>';
            }
            ?>
        </dl>
            </div>

        <div class="big-title">Feed Filters</div>
        <div class="content_body">
        <?php

            print '<ul class="side-nav" style="padding:0 !important;">';

                print '<li style="margin:3px !important;"><a class="filterFeed" data-tag="all" data-tagtitle="All">All</a></li>';

            foreach($tags as $slug=>$title){

                print '<li style="margin:3px !important;"><a class="filterFeed" data-tag="'.$slug.'" data-tagtitle="'.$title.'">'.$title.'</a></li>';

            }

            print '</ul>';

        ?>
            </div>

    </div>

    <script>
        $(document).ready(function(){
            $(".filterFeed").click(function(){
                var tag = $(this).data('tag');
                var tagTitle = $(this).data('tagtitle');

                $("#tagName").html("<h4>" + tagTitle + "</h4>");

                $("#newsFeed").html("");

                $("#loadingFeed").show();

                $.ajax({url:"filterFeed?tag=" + tag,success:function(result){

                    $("#newsFeed").html(result);

                    $("#loadingFeed").hide();
                }});
            });
        });
    </script>

    <div class="large-6 columns">
        <div class="big-title">Feed</div>
        <div class="content_body" style="background-color: inherit !important; padding:0px;">
        <div class="tagName" style="text-align:center;" id="tagName">
        </div>
        <div class="loadingFeed" style="text-align:center;display:none" id="loadingFeed">
            <img src="img/preloader.gif" style="height:80px;">
        </div>

        <div id="newsFeed">

            <?php

                    if(count($other_stories)<1){
                        print "<h3 style='text-align:center'>No stories found</h3>";
                    }

                    foreach($other_stories as $story){
                        print '<div class="story">';

                        print '<a href="'.URL::to("/single_story?q=".$story->id).'"><h4>'.$story->title.'</h4></a>';

                        if(property_exists($story, 'thumbnail')){
                            print '<img src="'.$story->thumbnail.'" style="float:left;width:100px">';
                        }

                        $description = explode("&hellip;", $story->excerpt);

                        print $description[0];

                        print '<a href="'.URL::to("/single_story?q=".$story->id).'"> &hellip; more</a>';

                        print '<p class="story-metadata"><i>Written by '.$story->author->nickname.' | Posted on '.date("l jS \of F Y h:i:s A", strtotime($story->date)).'</i></p>
                            </div>';
                    }

            ?>

        </div>
            </div>

    </div>

    <aside class="large-3 columns hide-for-small linksholder">
        <div class="big-title">Links</div>
        <div class="content_body">
        <p><a href="http://code4sa.org" target="_blank"><img src="img/c4sa.png" id="partner_logo"></a>
            <br/>
            The data driven journalism + tools in ZiwaphiHealth section were kickstarted by <a href="http://code4kenya.org" target="_blank">Code4Kenya</a>
        </p>
            <hr />
        <div style="display:none;">
            <a href="http://github.com/CodeForAfrica/ZiwaphiHealth"><img src="img/github.png" id="cfa_icon"></a>
            <a href="http://data.the-star.co.ke"><img style="height:32px;margin-left:25px" src="img/data.png" id="ckan_icon"></a>
                </div>
        <p>
            The <a href="http://github.com/CodeForAfrica/ZiwaphiHealth">code</a> & <a href="https://github.com/CodeForAfrica/ZiwaphiHealth/tree/master/Data/clean">data</a> for this project are open source and available for re-use.
        </p>
            <hr />
        <div class="social_media_icons" style="text-align: center">
            <i class="icon-facebook icon-2x app-icon"></i>
            <i class="icon-twitter icon-2x app-icon"></i>
            <i class="icon-rss icon-2x app-icon"></i>
        </div>
            </div>
    </aside>

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