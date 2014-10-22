<!doctype html>
<!--[if IE 9]><html class="lt-ie10" lang="en" > <![endif]-->
<html class="no-js" lang="en" data-useragent="Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.2; Trident/6.0)">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>HealthWatch | Dodgy Doctors Widget</title>
    <meta name="description" content="Nigeria Health Portal"/>
    <meta name="author" content="Nick Hargreaves"/>
    <meta name="copyright" content="CodeForAfrica Copyright (c) 2014"/>
    <link rel="stylesheet" href="css/foundation.css" />
    <link rel="stylesheet" href="main.css" />
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.1.1/css/font-awesome.css" rel="stylesheet">
    <link rel="stylesheet" href="icons/foundation-icons/foundation-icons.css" />
</head>
<body>

    <div class="large-4 columns app-container">
        <i class="icon-user-md icon-2x app-icon"></i>
        <h4>Dodgy Doctors</h4>
        <p>Check to see if your doctor is registered, their certified area of practice and whether they are free from malpractice.</p>
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
                            selectFirst: false
                        });
                    });
                </script>
                <input type="text" placeholder="Start typing doctor's name" class="search form-control ac_input" name="dodgydoc" id="dodgy_docs_input" autocomplete="off">
            </div>
            <div class="small-3 columns">
                <a href="#" data-reveal-id="myModal"><span class="postfix" id="grabDetails"><i class="icon-search"></i></span></a>
            </div>
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