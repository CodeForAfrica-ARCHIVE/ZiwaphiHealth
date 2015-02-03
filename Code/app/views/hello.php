<!doctype html>
<!--[if IE 9]><html class="lt-ie10" lang="en" > <![endif]-->
<html class="no-js" lang="en" data-useragent="Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.2; Trident/6.0)">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>HealthWatch | Home</title>
    <meta name="description" content="Nigeria Health Portal"/>
    <meta name="author" content="Nick Hargreaves"/>
    <meta name="copyright" content="CodeForAfrica Copyright (c) 2014"/>
    <link rel="stylesheet" href="css/foundation.css" />
    <link rel="stylesheet" href="main.css" />
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.1.1/css/font-awesome.css" rel="stylesheet">
    <link rel="stylesheet" href="icons/foundation-icons/foundation-icons.css" />

    <script src="js/vendor/modernizr.js"></script>
</head>
<body>
<div class="row">
    <div class="large-12 columns">
        <nav class="top-bar" data-topbar="" role="navigation">
            <!-- Title -->
            <ul class="title-area">
                <li class="name"><h1><a href="#"> <img src="http://placehold.it/150x30&text=Logo"/></a></h1></li>

                <!-- Mobile Menu Toggle -->
                <li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
            </ul>

            <!-- Top Bar Section -->

            <section class="top-bar-section">



                <!-- Top Bar Right Nav Elements -->
                <ul class="left">
                    <li><a href="#">Link 0</a></li>
                    <li class="divider"></li>
                    <li><a href="#">Link 1</a></li>
                    <li class="divider"></li>
                    <li><a href="#">Link 2</a></li>
                    <li class="divider"></li>
                    <li><a href="#">Link 3</a></li>
                    <li class="divider"></li>
                </ul>
                <ul class="right">

                    <!-- Search | has-form wrapper -->
                    <li class="has-form">
                        <div class="row collapse">
                            <div class="large-8 small-9 columns">
                                <input type="text" placeholder="Enter key words">
                            </div>
                            <div class="large-4 small-3 columns">
                                <a href="#" class="button expand">Search</a>
                            </div>
                        </div>
                    </li>
                </ul>
            </section>
        </nav>
    </div>
</div>

<div class="row">
    <div class="large-5 columns app-container">
        <i class="icon-user-md icon-2x app-icon"></i>
        <h4>Dodgy Doctors</h4>
        <p class="app_description">Check to see if your doctor is registered, their certified area of practice and whether they are free from malpractice.</p>
        <p>
        <div class="row collapse">
            <div class="small-9 columns">
                <link rel="stylesheet" type="text/css" href="autocomplete/jquery.autocomplete.css">
                <script type="text/javascript" src="autocomplete/jquery.js"></script>
                <script type='text/javascript' src='autocomplete/jquery.autocomplete.js'></script>
                <script type="text/javascript">
                    $.noConflict();
                    jQuery(document).ready(function($) {
                        $("#dodgy_docs_input").autocomplete("doctor", {
                            width: 260,
                            matchContains: true,
                            //mustMatch: true,
                            //minChars: 0,
                            //multiple: true,
                            //highlight: false,
                            //multipleSeparator: ",",
                            selectFirst: true
                        });
                    });
                </script>
                <input type="text" placeholder="Start typing doctor's name" class="search form-control ac_input" name="dodgydoc" id="dodgy_docs_input" autocomplete="off">
            </div>
            <div class="small-3 columns">
                <a href="#" data-reveal-id="myModal"><span class="postfix" id="grabDetails"><i class="icon-search"></i></span></a>
            </div>

        </div>
        <div class="row" style="text-align: center"><span class="embed"><a href="#" data-reveal-id="embedModal"><img src="img/embed.png"> Embed this widget</a></span></div>

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

            <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
            <script>
                $(document).ready(function(){
                    $("#grabDetails").click(function(){
                        var name = $("#dodgy_docs_input").val();

                        $("#dname").html("<h4>" + name + "</h4>");

                        $("#doctorDetails").html("");

                        $("#loading").show();

                        $.ajax({url:"doctordetails?name=" + name,success:function(result){

                            $("#doctorDetails").html(result);

                            $("#loading").hide();
                        }});
                    });
                });
            </script>

            <a class="close-reveal-modal">&#215;</a>
        </div>

        </p>
    </div>
    <div class="large-4 columns app-container">
        <i class="icon-medkit icon-2x app-icon"></i>
        <h4>Medicine Prices</h4>
        <p class="app_description">Find out what you should pay for your medicine.</p>
        <p>
        <div class="row collapse">
            <div class="small-9 columns">
                <script type="text/javascript">
                    $(document).ready(function(){
                        $("#medicine_name").keyup(function(event){
                            if(event.keyCode == 13){
                                $("#search_medicine").click();
                            }
                        });



                        $("#search_medicine").click(function(){

                            var medicine_name = document.getElementById("medicine_name").value;

                            var url = 'http://mpr.code4sa.org/#search:' + medicine_name;

                            var win = window.open(url, '_blank');

                            if(win){
                                //Browser has allowed it to be opened
                                win.focus();
                            }else{
                                //Broswer has blocked it
                                alert('Please allow popups for this site');
                            }
                        });
                    });



                </script>
                <input type="text" id="medicine_name" placeholder="Type medicine name"/>
            </div>
            <div class="small-3 columns" id="search_medicine">
                <a href="#"><span class="postfix"><i class="icon-search"></i></span></a>
            </div>
        </div>
        <div class="row" style="text-align: center; display: none;"><span class="embed"><a href="#"><img src="img/embed.png"> Embed this widget</a></span></div>
        </p>
    </div>
    <div class="large-3 columns app-container">
        <i class="icon-hospital icon-2x app-icon"></i>
        <h4>Find a Hospital</h4>
        <p>Find right public hospital near you</p>
        <div style="text-align: center; margin-top:45px;"><a href="http://hospitals.code4sa.org/" target="_blank"><span class="postfix" style="border-left: 1px solid #cccccc;">Launch App <i class="icon-globe"></i></span></a></div>
    </div>
</div>

<div class="row" style="margin-bottom: 20px">
    <div class="large-9 columns sidebar">
        <div class="large-7 columns"  style="background-color: #f6f6f6; height:450px;padding-top: 0.9375rem; border: 0px solid #cacaca; border-right: none;">
            <a href="<?php print $featured->url;?>"><h4 class="featured_title"><?php print $featured->title;?></h4></a>
            <?php print $featured->excerpt;?>
            <h5>The story so far</h5>

            <ul class="side-nav" style="padding:0 !important;">

            <?php
            if(count($related)<1){
                print "<h5 style='text-align:center'>No related stories at this time</h5>";
            }
                    foreach($related as $r){
                        print '<li style="margin:3px !important;"><a href="'.$r->url.'" data-search="">'.$r->title.'</a></li>';
                    }
            ?>
            </ul>
            <h5>Evidence dossier</h5>
            Data Repository
        </div>
        <div class="large-5 columns" style="background-color: #f6f6f6; height:450px;padding-top: 0.9375rem;  border: 0px solid #cacaca; border-left: none;">
            <?php
                if(!property_exists($featured, 'thumbnail')){
                    print '<img src="http://placehold.it/500x500&amp;text=[%20img%201%20]" width="100%">';
                }else{

                    print '<img src="'.$featured->thumbnail.'" width="100%">';
                }
            ?>
            <div class="feedback">
                <a href="#">Tell us More</a>
                <p>Do you have more information? Help us improve this story by sharing your experiences/evidence.</p>
            </div>
        </div>
    </div>
    <div class="large-3 columns sidebar">
        <h3 class="big-title">Help Desk</h3>
        <h5><i class="icon-phone"></i> Helplines</h5>
        <ul>
            <li>Item 1</li>
            <li>Item 2</li>
            <li>Item 3</li>
        </ul>
        <h5><i class="fi-anchor"></i> Support groups</h5>
        <ul>
            <li>Item 1</li>
            <li>Item 2</li>
            <li>Item 3</li>
        </ul>
        <h5><i class="fi-torsos-all"></i> Social media</h5>
        <ul>
            <li>Item 1</li>
            <li>Item 2</li>
            <li>Item 3</li>
        </ul>
    </div>
</div>


<div class="row further-reading">
    <div class="large-3 columns ">
        <h4 class="big-title">Major Stories</h4>



        <dl class="accordion" data-accordion>
            <?php
            if(count($major_stories)<1){
                print "<h3 style='text-align:center'>No major stories found</h3>";
            }
            $i = 0;
            foreach($major_stories as $story){
                $i++;
            print'<dd class="accordion-navigation">
                <a href="#major-story-panel'.$i.'">'.$story->title.'</a>';
                //if($i==1){
                //    print '<div id="major-story-panel'.$i.'" class="content active">';
                //}else{
                    print '<div id="major-story-panel'.$i.'" class="content">';
                //}
                if(property_exists($story, 'thumbnail')){
                    print '<img src="'.$story->thumbnail.'" style="width:100%">';
                }
                print $story->excerpt;

                print '<a href="'.$story->url.'">...more</a>';

                print '</div>
            </dd>';
            }
            ?>
        </dl>

        <h4 class="big-title">Feed Filters</h4>
        <?php

            print '<ul class="side-nav" style="padding:0 !important;">';

                print '<li style="margin:3px !important;"><a class="filterFeed" data-tag="all" data-tagtitle="All">All</a></li>';

            foreach($tags as $slug=>$title){

                print '<li style="margin:3px !important;"><a class="filterFeed" data-tag="'.$slug.'" data-tagtitle="'.$title.'">'.$title.'</a></li>';

            }

            print '</ul>';

        ?>

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
        <h4 class="big-title">Other News</h4>
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
                        print '<a href="'.$story->url.'"><h4>'.$story->title.'</h4></a>';
                        if(property_exists($story, 'thumbnail')){
                            print '<img src="'.$story->thumbnail.'" style="float:left;width:100px">';
                        }
                        print $story->excerpt.'</p>
                                <p class="story-metadata">Written by '.$story->author->nickname.' | Posted on '.date("l jS \of F Y h:i:s A", strtotime($story->date)).'</p>
                            </div>
                            <hr/>';
                    }

            ?>

        </div>

    </div>

    <aside class="large-3 columns hide-for-small linksholder">
        <h4 class="big-title">Links</h4>
        <p><a href="http://code4sa.org" target="_blank"><img style="height: 80px" src="img/c4sa.png" id="c4sa_partner"></a>
            <br/>
            The data driven journalism + tools in HealthWatch section were kickstarted by <a href="http://code4kenya.org" target="_blank">Code4Kenya</a>
        </p>
        <p>
            <a href="http://github.com/CodeForAfrica/HealthWatch"><img src="img/github.png" id="cfa_icon"></a>
            <a href="http://data.the-star.co.ke"><img style="height:32px;margin-left:25px" src="img/data.png" id="ckan_icon"></a>
            <br/>
            The code & data for this page are open source. You can re-use it by visiting the above repositories.
        </p>

        <h4>Stay in Touch</h4>
        <div class="social_media_icons">
            <i class="icon-facebook icon-2x app-icon"></i>
            <i class="icon-twitter icon-2x app-icon"></i>
            <i class="icon-rss icon-2x app-icon"></i>
        </div>
    </aside>

</div>


<footer class="row">
    <div class="large-12 columns">
        <hr/>
        <div class="row">
            <div class="large-6 columns">
            </div>
            <div class="large-6 columns">
                <ul class="inline-list right">
                    <li><a href="#">Link 1</a></li>
                    <li><a href="#">Link 2</a></li>
                    <li><a href="#">Link 3</a></li>
                    <li><a href="#">Link 4</a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>

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