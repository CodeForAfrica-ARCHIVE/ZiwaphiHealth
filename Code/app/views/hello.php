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
    <div class="large-4 columns app-container">
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
        <div class="row" style="text-align: center"><span class="embed"><a href="#"><img src="img/embed.png"> Embed this widget</a></span></div>
        </p>
    </div>
    <div class="large-4 columns app-container">
        <i class="icon-hospital icon-2x app-icon"></i>
        <h4>Nearest Specialist</h4>
        <p class="app_description">Find the nearest specialist doctor or facility.<select id="specialist" class="form-control">
                <option>Select specialty</option>
                <option>Antenatal Care (care of mother while pregnant)</option><option>Anteretroviral Therapy ( drugs for HIV)</option><option>Beoc</option><option>Blood</option><option>Caeserean section</option><option>Ceoc</option><option>C-IMCI</option><option>Epidemiology ( study of disease spread and distribution)</option><option>Family planning</option><option>GROWM</option><option>Heamogram ( blood test checking all blood parameters)</option><option>Heamatocrit ( simple blood test to analyse anaemia)</option><option>In- patient department</option><option>Out -patient  department</option><option>Outreach programs ie. go out and give treatment in the villages</option><option>Prevention of mother to child transmission ( of HIV/AIDS)</option><option>Radiology/ x-ray</option><option>Reproductive health treatment center/diagnostic center ( I think need to confirm)</option><option>Tuberculosis diagnosis</option><option>Tuberculosis treatment</option><option>Youth</option><option>Tuberculosis laboratory work up</option>								</select>
            <select id="county_s" class="form-control">
                <option>Select county</option>
                <option>Baringo</option><option>Bomet</option><option>Bungoma</option><option>Busia</option><option>Elgeyo/Marakwet</option><option>Embu</option><option>Garissa</option><option>Homa Bay</option><option>Isiolo</option><option>Kajiado</option><option>Kakamega</option><option>Kericho</option><option>Kiambu</option><option>Kilifi</option><option>Kirinyaga</option><option>Kisii</option><option>Kisumu</option><option>Kitui</option><option>Kwale</option><option>Laikipia</option><option>Lamu</option><option>Machakos</option><option>Makueni</option><option>Mandera</option><option>Marsabit</option><option>Meru</option><option>Migori</option><option>Mombasa</option><option>Muranga</option><option>Nairobi</option><option>Nakuru</option><option>Nandi</option><option>Narok</option><option>Nyamira</option><option>Nyandarua</option><option>Nyeri</option><option>Samburu</option><option>Siaya</option><option>Taita Taveta</option><option>Tana River</option><option>Tharaka Nithi</option><option>Trans Nzoia</option><option>Turkana</option><option>Uasin Gishu</option><option>Vihiga</option><option>Wajir</option><option>West Pokot</option>								</select>
        </p>
        <p>
        <div class="row" style="text-align: center">

            <span class="embed"><a href="#"><img src="img/embed.png"> Embed this widget</a></span>
            <span class="embed report_malpractice"><a href="#"><img src="img/alert.png"> <a href="#" data-reveal-id="reportModal">Report malpractice</a></span>
            <!-- Modal for doctor details -->
            <div id="reportModal" class="reveal-modal" data-reveal>
                <div id="reportForm">
                    <form class="form-horizontal" onsubmit="try { validateandsubmitform(); } catch (e) { }; return false;" id="negligence_form">
                        <fieldset>
                            <!-- Form Name -->
                            <legend>Submit your complaint</legend>

                            <!-- Text input-->
                            <div class="control-group">
                                <div class="controls">
                                    <input class="form-control" id="name" name="name" type="text" placeholder="Full Name" required="">

                                </div>
                            </div>

                            <!-- Text input-->
                            <div class="control-group">
                                <div class="controls">
                                    <input class="form-control" id="phone" name="phone" type="text" placeholder="Your phone number for us to be able to reach you." required="">
                                </div>
                            </div>

                            <!-- Multiple Radios (inline) -->
                            <div class="control-group">
                                Gender:

                                        <input type="radio" name="gender" id="gender-0" value="Male" checked="checked">
                                        Male

                                        <input type="radio" name="gender" id="gender-1" value="Female">
                                        Female

                                </div>

                            <!-- Text input-->
                            <div class="control-group">
                                <div class="controls">
                                    <input class="form-control" id="hospital_name" name="hospital_name" type="text" placeholder="Name of the Hospital" required="">

                                </div>
                            </div>

                            <!-- Select Basic -->
                            <div class="control-group">
                                <div class="controls">
                                    <select class="form-control" id="state" name="state">
                                        <option>Select State</option>
                                        <option>ABIA</option>
                                        <option>ADAMAWA</option>
                                        <option>AKWA IBOM</option>
                                        <option>ANAMBRA</option>
                                        <option>BAUCHI</option>
                                        <option>BENUE</option>
                                        <option>BORNO</option>
                                        <option>BAYELSA</option>
                                        <option>CROSS RIVER</option>
                                        <option>DELTA</option>
                                        <option>EBONYI</option>
                                        <option>EDO</option>
                                        <option>EKITI</option>
                                        <option>ENUGU</option>
                                        <option>FCT</option>
                                        <option>GOMBE</option>
                                        <option>IMO</option>
                                        <option>JIGAWA</option>
                                        <option>KEBBI</option>
                                        <option>KADUNA</option>
                                        <option>KOGI</option>
                                        <option>KANO</option>
                                        <option>KATSINA</option>
                                        <option>KWARA</option>
                                        <option>LAGOS</option>
                                        <option>NIGER</option>
                                        <option>NASARAWA</option>
                                        <option>ONDO</option>
                                        <option>OGUN</option>
                                        <option>OSUN</option>
                                        <option>OYO</option>
                                        <option>PLATEAU</option>
                                        <option>RIVERS</option>
                                        <option>SOKOTO</option>
                                        <option>TARABA</option>
                                        <option>YOBE</option>
                                        <option>ZAMFARA</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Text input-->
                            <div class="control-group">
                                <div class="controls">
                                    <input class="form-control" id="contact_person" name="contact_person" type="text" placeholder="Name of the doctor/nurse/receptionist or whoever you had primary contact with">
                                </div>
                            </div>

                            <!-- Select Basic -->
                            <div class="control-group">
                                <div class="controls">
                                    <select class="form-control" id="reason" name="reason">
                                        <option>Reason for visiting hospital</option>
                                        <option>Sickness</option>
                                        <option>Operation</option>
                                        <option>Diagnosis</option>
                                        <option>Others</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Select Basic -->
                            <div class="control-group">

                                <div class="controls">
                                    <select class="form-control" id="negligence" name="negligence">
                                        <option>Kind of Negligence experienced</option>
                                        <option>Wrongful death</option>
                                        <option>Surgical errors and complications</option>
                                        <option>Birth injuries</option>
                                        <option>Misdiagnosis</option>
                                        <option>Wrongful medication</option>
                                        <option>Others</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Textarea -->
                            <div class="control-group">
                                <div class="controls">
                                    <textarea class="form-control" id="comment" name="comment" placeholder="You can write a comment on your complaint with no restrictions."></textarea>
                                </div>
                            </div>

                            <!-- Multiple Radios (inline) -->
                            <div class="control-group">
                                Share Publicly:
                                        <input type="radio" name="share" id="share-0" value="Yes" checked="checked">
                                        Yes

                                        <input type="radio" name="share" id="share-1" value="No">
                                        No
                            </div>


                            <!-- Button -->
                            <div class="control-group">
                                <label class="control-label" for="submitbutton"></label>
                                <div class="controls">
                                    <button id="submitbutton" name="submitbutton" class="btn btn-primary">Submit</button>
                                </div>
                            </div>

                        </fieldset>
                    </form>
                </div>

                <a class="close-reveal-modal">&#215;</a>
            </div>
        </div>

        </p>
    </div>
</div>

<div class="row">
    <div class="large-3 columns sidebar">
        <h3 class="big-title">Back Story</h3>
        <h5>Overview</h5>
        Bacon ipsum dolor sit amet nulla ham qui sint exercitation eiusmod commodo, chuck duis velit.
        <h5>The story so far</h5>
        <ul>
            <li>Item 1</li>
            <li>Item 2</li>
            <li>Item 3</li>
        </ul>
        <h5>Evidence dossier</h5>
        Data Repository
    </div>
    <div class="large-6 columns">
        <ul class="example-orbit" data-orbit>
            <li><img src="http://placehold.it/1000x500&amp;text=[%20img%201%20]"></li>
            <li><img src="http://placehold.it/1000x500&amp;text=[%20img%202%20]"></li>
            <li><img src="http://placehold.it/1000x500&amp;text=[%20img%203%20]"></li>
        </ul>
        <div class="panel feedback">
            <a href="#">Tell us More</a>
            <p>Do you have more information? Help us improve this story by sharing your experiences/evidence.</p>
        </div>
    </div>
    <div class="large-3 columns sidebar">
        <h3 class="big-title">Help Desk</h3>
        <h5>Helplines</h5>
        <ul>
            <li>Item 1</li>
            <li>Item 2</li>
            <li>Item 3</li>
        </ul>
        <h5>Support groups</h5>
        <ul>
            <li>Item 1</li>
            <li>Item 2</li>
            <li>Item 3</li>
        </ul>
        <h5>Social media</h5>
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

        <div class="panel">
            <a href="#"><img src="http://placehold.it/300x240&text=[img]"/></a>
            <div class="section-container vertical-nav" data-section data-options="deep_linking: false; one_up: true">
                <section class="section">
                    <h5 class="title"><a href="#">Story 1</a></h5>
                </section>
                <section class="section">
                    <h5 class="title"><a href="#">Story 2</a></h5>
                </section>
                <section class="section">
                    <h5 class="title"><a href="#">Story 3</a></h5>
                </section>
                <section class="section">
                    <h5 class="title"><a href="#">Story 4</a></h5>
                </section>
                <section class="section">
                    <h5 class="title"><a href="#">Story 5</a></h5>
                </section>
                <section class="section">
                    <h5 class="title"><a href="#">Story 6</a></h5>
                </section>
            </div>

        </div>
    </div>



    <div class="large-6 columns">
        <h4 class="big-title">Other Health News</h4>


            <div class="story">
                <p><h4>Story title goes here</h4><img src="http://placehold.it/80x80&text=[img]"/>Bacon ipsum dolor sit amet nulla ham qui sint exercitation eiusmod commodo, chuck duis velit. Aute in reprehenderit, dolore aliqua non est magna in labore pig pork biltong.</p>
                <p class="story-metadata">Written by John Smith | Posted on September 22, 2014</p>
            </div>
            <hr/>
            <div class="story">
                <p><h4>Story title goes here</h4><img src="http://placehold.it/80x80&text=[img]"/>Bacon ipsum dolor sit amet nulla ham qui sint exercitation eiusmod commodo, chuck duis velit. Aute in reprehenderit, dolore aliqua non est magna in labore pig pork biltong.</p>
                <p class="story-metadata">Written by John Smith | Posted on September 22, 2014</p>
            </div>
            <hr/>
            <div class="story">
                <p><h4>Story title goes here</h4><img src="http://placehold.it/80x80&text=[img]"/>Bacon ipsum dolor sit amet nulla ham qui sint exercitation eiusmod commodo, chuck duis velit. Aute in reprehenderit, dolore aliqua non est magna in labore pig pork biltong.</p>
                <p class="story-metadata">Written by John Smith | Posted on September 22, 2014</p>
            </div>
            <hr/>
            <div class="story">
                <p><h4>Story title goes here</h4><img src="http://placehold.it/80x80&text=[img]"/>Bacon ipsum dolor sit amet nulla ham qui sint exercitation eiusmod commodo, chuck duis velit. Aute in reprehenderit, dolore aliqua non est magna in labore pig pork biltong.</p>
                <p class="story-metadata">Written by John Smith | Posted on September 22, 2014</p>
            </div>
            <hr/>



    </div>



    <aside class="large-3 columns hide-for-small linksholder">
        <h4 class="big-title">Links</h4>
        <p><img style="height: 80px" src="img/c4nigeria.png" id="c4k_partner">
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
<script>
    $(document).foundation();

    var doc = document.documentElement;
    doc.setAttribute('data-useragent', navigator.userAgent);
</script>

</body>
</html>