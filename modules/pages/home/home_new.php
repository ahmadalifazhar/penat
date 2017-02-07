<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <title>Pin.It</title>

        <!-- stylesheet-->
        <link rel="stylesheet" type="text/css" href="css/styleeNew3.css?remcache=__CACHE__"   />
        <link rel="stylesheet" type="text/css" href="css/feeds_style.css"   />
        <link rel="stylesheet" type="text/css" href="css/tiny_style.css" />
        <link href="metro/css/modern.css" rel="stylesheet">
        <link href="metro/css/modern-responsive.css" rel="stylesheet">
        <link href="metro/css/site.css" rel="stylesheet" type="text/css">
        <link href="metro/js/google-code-prettify/prettify.css" rel="stylesheet" type="text/css">
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js"></script>
        <script type="text/javascript">var chat = $.noConflict(true);</script>
        <script type="text/javascript" src="metro/js/assets/jquery-1.9.0.min.js"></script>
        <script type="text/javascript" src="js/jquery-1.8.3.js"></script>
        <script type="text/javascript" src="metro/js/assets/jquery.mousewheel.min.js"></script>
        <script type="text/javascript" src="metro/js/assets/moment.js"></script>
        <script type="text/javascript" src="metro/js/assets/moment_langs.js"></script>
        <script type="text/javascript" src="metro/js/modern/dropdown.js"></script>
        <script type="text/javascript" src="metro/js/modern/accordion.js"></script>
        <script type="text/javascript" src="metro/js/modern/buttonset.js"></script>
        <script type="text/javascript" src="metro/js/modern/carousel.js"></script>
        <script type="text/javascript" src="metro/js/modern/input-control.js"></script>
        <script type="text/javascript" src="metro/js/modern/pagecontrol.js"></script>
        <script type="text/javascript" src="metro/js/modern/rating.js"></script>
        <script type="text/javascript" src="metro/js/modern/slider.js"></script>
        <script type="text/javascript" src="metro/js/modern/tile-slider.js"></script>
        <script type="text/javascript" src="metro/js/modern/tile-drag.js"></script>
        <script type="text/javascript" src="metro/js/modern/calendar.js"></script>
        <script type="text/javascript" src="js/dialogCreateRoute.js"></script>
        <script type="text/javascript" src="js/tinybox.js"></script>
        <script type="text/javascript" src="http://ecn.dev.virtualearth.net/mapcontrol/mapcontrol.ashx?v=7.0"></script>
        <!--<script type="text/javascript" src="js/mapfix.alif.20130426.js"></script>
        -->
        <script type="text/javascript" src="js/mapfix.js?remcache=__CACHE__"></script>
        <script type="text/javascript" src="js/searchLocByAddressNew.js"></script>
        <script type="text/javascript" src="js/takeScreenShot.js"></script>
        <script type="text/javascript" src="js/harlem.js"></script>
            <!--<script type="text/javascript" src="js/createDrivingRoute.js"></script>-->


        <script type="text/javascript">




                    var openTab = true;
            var chkComment = true;



            function hideshow(which, and) {
                if (!document.getElementById)
                    return

                __DIVPOSTS__

                if (which.style.display == "block")
                    which.style.display = "none";
                else
                {
                    which.style.display = "block";
                }
                if (and.style.display == "block")
                    and.style.display = "none";
                else
                {
                    chkComment = false;
                    and.style.display = "block";
                }
            }

            function hideshowpin(which) {
                if (!document.getElementById)
                    return

                if (which.style.display == "block")
                    which.style.display = "none";
                else
                {
                    document.getElementById("pinitFC11").style.display = "none";
                    document.getElementById("pinitFC12").style.display = "none";
                    document.getElementById("pinitFC13").style.display = "none";
                    document.getElementById("pinitFC14").style.display = "none";
                    document.getElementById("pinitFC15").style.display = "none";
                    document.getElementById("pinitFC16").style.display = "none";
                    document.getElementById("pinitFC17").style.display = "none";
                    which.style.display = "block";
                }
            }
        </script>
        <script type="text/javascript">
            function displayInfobox(e)
            {
            infoboxOption.setOptions({visible: tru e});    }
            < !-- set pin location -- >
                    function pushpin()
                            {
                            //alert("hello");

                            var i = null;
                                    var tid = new Array();
                                    var title = new Array();
                                    var descript = new Array();
                                    var latitude = new Array();
                                    var longitude = new Array();
                                    var pushpin = new Array();
                                    //Marhazli & Tan 
                                    // Traffics/Transportation (0-7)
                                    //Shopping Tracker (8-15)
                                    //Job (16) Alif 7/6/2013
                                    var ppFC = new Array();
                                    var maxFC = 18;
                                    for (var numFC = 0; numFC <= maxFC; numFC++)
                            {
                            ppFC[numFC] = new Array();
                                    ppFC[numFC][0] = null; //i
                                    ppFC[numFC][1] = new Array(); //tid
                                    ppFC[numFC][2] = new Array(); //title
                                    ppFC[numFC][3] = new Array(); //desc
                                    ppFC[numFC][4] = new Array(); //lat
                                    ppFC[numFC][5] = new Array(); //lon
                                    ppFC[numFC][6] = new Array(); //pushpin
                            }

                            __PUSHPIN__


                                    Microsoft.Maps.loadModule('Microsoft.Maps.Themes.BingTheme', { callback: function() {
                            for (var x = 0; x < i; x++)
                            {
                            pushpin[x] = new Microsoft.Maps.Pushpin(map.getCenter(), pushpinOptions);
                                    map.entities.push(pushpin[x]);
                                    var infoboxOption = {title: title[x], description: descript[x], pushpin: pushpin[x], visible:true };
                                    map.entities.push(new Microsoft.Maps.Infobox(new Microsoft.Maps.Location(latitude[x], longitude[x]), infoboxOption));
                                    pushpin[x].setLocation(new Microsoft.Maps.Location(latitude[x], longitude[x]));
                            }
                            //Marhazli
                            for (var numFC = 0; numFC <= maxFC; numFC++)
                            {
                            for (var x = 0; x < ppFC[numFC][0]; x++)
                            {
                            ppFC[numFC][6][x] = new Microsoft.Maps.Pushpin(map.getCenter(), pushpinOptionsFC[numFC]);
                                    map.entities.push(ppFC[numFC][6][x]);
                                    var infoboxOption = {title: ppFC[numFC][2][x], description: ppFC[numFC][3][x], pushpin: ppFC[numFC][6][x], };
                                    map.entities.push(new Microsoft.Maps.Infobox(new Microsoft.Maps.Location(ppFC[numFC][4][x], ppFC[numFC][5][x]), infoboxOption));
                                    ppFC[numFC][6][x].setLocation(new Microsoft.Maps.Location(ppFC[numFC][4][x],ppFC[numFC][5][x]));
                        }
                }
                }});
	
	
	
	
        }

        </script>
        <script type='text/javascript'>

                                    function logout()
                                            {
                                            window.location = "?op=logout";
                                                    }
                                    function homepage()
                                            {
                                    window.location = "?op=home";
                                                    }

        //<![CDATA[ 
                                    < !-- JS for left slider menu and auto resize map width (alif)-- >
                                            $(window).load(function(){
                                    $(".right-section").width($(window).width() - 500);
                                            $(".right-section").height($(window).height() - 30);
                                            $('.left-section .tab').toggle(function(){
                                    $('.left-section').animate({'left': - 500}, "slow");
                                            $('.left-section .tab').animate({'left':500}, "slow");
                                            $('.right-section').animate({'left':0}, "slow");
                                            var nextWidth = $(window).width() - 0;
                                            $(".right-section").animate({'width':nextWidth}, 600);
                                            $("#tggleBtnLeft").toggleClass("rotate");
                                            }, function(){
                                    $('.left-section').animate({'left':0}, "slow");
                                            $('.left-section .tab').animate({'left':500}, "slow");
                                            $('.right-section').animate({'left':500}, "slow");
                                            var nextWidth = $(window).width() - 500;
                                            $(".right-section").animate({'width':nextWidth}, 600);
                                            $("#tggleBtnLeft").toggleClass("rotate");
                                            });
                                            $('#userBar .toggle').toggle(function(){
                                    $('#topSlider').css('display', 'block');
                                            $('#topSlider').animate({'top':44});
                                            // $('#topSlider').css("display", "block");
                                            $("#tggleBtn").toggleClass("rotate");
                                            }, function(){
                                    $('#topSlider').animate({'top': - 139});
                                            $("#tggleBtn").toggleClass("rotate");
                                            timer = setTimeout(function(){
                                    $('#topSlider').css('display', 'none');
                                    }, 500);
                                            });
                                            }); //]]>  

        //function to reset map size(right-section) if user change windows size


                                            $(window).resize(function() {

                                    var left = parseInt($('.left-section').css('left'));
                                            if (left == 0){
                                    $(".right-section").width($(window).width()-500);
        $(".right-section").height($(window).height()-30);
        }
        else{
                 $(".right-section").width($(window).width()-0);
        $(".right-section").height($(window).height()-30);
        }

        });


        <!-- End JS for left slider menu and auto resize map width-->
        </script>

    </head>
    <body onLoad="getMap(); pushpin(); loadLog();">
        <!-- Home.html v1.13 Oryginally Designed by Alif 
        Please Write Design Update Here:-
        - update 8/6/2013 by Alif : Move Toggle Top Slider Button to the center
        - update 9/6/2013 by Alif : Problem with div, toggle button disappear when use other browsers....
        - update 10/9/2013 9:45A.M Alif: Redesign user bar content div, bug on firefox and IE repaired
        -->


        <!-- Start Drop Down Top Menu   -->
        <div id="userBar" class="metrouicss">
            <div class="userBar content" style="padding-top:8px; display:inline-block">

                <!--Start Column 1--><div style="float: left; color:#FFF; display:inline-block">

                    <div style="float: left; padding-left:10px; padding-right:10px">
                        <a href="?op=home"><img src="__MYPIC__" width="32" height="32"></a><span style="color:white;font-size:20px;margin-left:6px">Howdy,</span><a href="#" onClick="openTab = false; TINY.box.show({iframe:'?op=profile', boxid:'frameless', width:750, height:450, fixed:false, maskid:'bluemask', maskopacity:40, closejs:function(){openTab = true; loadLog(); closeJS()}})" title="Profile"><span style="font-size: 20px">__AFNAME__ __ALNAME__</span></a>
                    </div>



                    <div style=" float:left">
                        <div class="toolbar" style="padding-left:7px">
                            <button class=" bg-color-blue fg-color-white" onClick="homepage();" title="Homepage"><i class="icon-home" ></i></button>
                            <button class=" bg-color-blue fg-color-white" onClick="openTab = false; TINY.box.show({iframe:'?op=inbox', boxid:'frameless', width:750, height:450, fixed:false, maskid:'bluemask', maskopacity:40, closejs:function(){openTab = true; loadLog(); closeJS()}})" title="Chatting"><i class="icon-comments-5" ></i></button>
                            <button class=" bg-color-blue fg-color-white" onClick="openTab = false; TINY.box.show({iframe:'?op=friends', boxid:'frameless', width:750, height:450, fixed:false, maskid:'bluemask', maskopacity:40, closejs:function(){openTab = true; loadLog(); closeJS()}})" title="Search and Add Friends"><i class="icon-search" ></i></button>
                            <button class=" bg-color-blue fg-color-white" onClick="openTab = false; TINY.box.show({iframe:'?op=setting', boxid:'frameless', width:750, height:450, fixed:false, maskid:'bluemask', maskopacity:40, closejs:function(){openTab = true; loadLog(); closeJS()}})" title="User Setting"><i class="icon-wrench" ></i></button>
                            <button class=" bg-color-blue fg-color-white" onClick="openTab = false; TINY.box.show({iframe:'?op=account/notification', boxid:'frameless', width:750, height:450, fixed:false, maskid:'bluemask', maskopacity:40, closejs:function(){openTab = true; loadLog(); closeJS()}})" title="Notifications"><i class="icon-newspaper" ></i></button>
                            <button class=" bg-color-blue fg-color-white" id="Dialog" title="Create Driving Route"><i class="icon-steering-wheel" ></i></button>
                            <button class=" bg-color-blue fg-color-white" onClick="getCurrentLocation();" title="Go To My Location"><i class="icon-target-2" ></i></button> 
                            <script type="text/javascript" src="js/createDrivingRouteDialog2.js"></script>
                        </div><!-- end toolbar class div-->       
                    </div>



                    <div style="float: left;">
                        <div id="tggleBtn" class="toggle" title="More" style="margin-left: 10px; margin-top:-5px">
                            <i class="icon-arrow-down-3 fg-color-white" style="font-size:30px;"></i></div>
                    </div>

                </div><!-- End Column 1-->


                <div style="color:#FFF; float:left; padding-left:20px; display:inline-block">

                    <div class="input-control text">
                        <input type="text" id="locSearch" placeholder="Search Location">
                    </div>


                </div>
                <div style="float:left" class="toolbar"><button class="bg-color-blue fg-color-white" onClick="LoadSearchModule();"><i class="icon-search" style="width:10px;height:22px;"></i></button></div>

                <div style="float: right;color:#FFF">
                    <div class="toolbar" style="margin-right:10px;" >

<!--<button class=" bg-color-blue fg-color-white"  onclick="generate();" title="Take Map ScreenShot"><i class="icon-camera"></i></button>-->
                        <button class=" bg-color-blue fg-color-white" onClick="harlemShake();" title="Please Slow Down Speaker Volume :D"><i class="icon-bug"></i></button>
                        <button class=" bg-color-blue fg-color-white" onClick="logout();" title="See Yaa Again Buddy!!"><i class="icon-exit" ></i></button>
                    </div> 
                </div>

            </div>
        </div><!-- end userBar division-->

        <!-- Start Drop Down Top Menu   (Top Slider)-->
        <div id="topSlider" style="top:-139px">
            <div class="topSlider content"  style="padding-top:10px; padding-left:10px" >
                <div class="metrouicss">
                    <div class="tile image outline-color-green">
                        <div class="tile-content"> <img src="__MYPIC__" alt="" />
                            <div class="brand">
                                <div class="name"><a href="#" onClick="openTab = false; TINY.box.show({iframe:'?op=profile', boxid:'frameless', width:750, height:450, fixed:false, maskid:'bluemask', maskopacity:40, closejs:function(){openTab = true; loadLog(); closeJS()}})">Profile</a></div>
                            </div>
                        </div>
                    </div>
                    <div class="tile image outline-color-green">
                        <div class="tile-content" title="Jobs Advertisement"> <a href="?op=job"><img src="images/job1.png" alt="Jobs Advertisement" width="100%" height="100%"/>
                            </a>
                            <div class="brand">
                                <div class="name">Jobs</div>
                            </div>
                        </div>
                    </div>
                    <div class="tile image outline-color-green">
                        <div class="tile-content" title="Entertainment"> <a href="?op=entertainment"><img src="images/entertainment.png" alt="" /></a>
                            <div class="brand">
                                <div class="name">Entertainment</div>
                            </div>
                        </div>
                    </div>
                    <div class="tile image outline-color-green">
                        <div class="tile-content" title="Traffics"> <a href="?op=traffics"><img src="images/traffic.png" alt="" /></a>
                            <div class="brand">
                                <div class="name">Traffics</div>
                            </div>
                        </div>
                    </div>
                    <div class="tile image outline-color-green">
                        <div class="tile-content" title="Cloud"> <a href="?op=cloud"><img src="images/cloud.png" alt="" /></a>
                            <div class="brand">
                                <div class="name">Pin-cloud Storage</div>
                            </div>
                        </div>
                    </div>
                    <div class="tile image outline-color-green">
                        <div class="tile-content" title="Shopping"> <a href="?op=shopping"><img src="images/shopping.png" alt="" /></a>
                            <div class="brand">
                                <div class="name">Shopping Tracker</div>
                            </div>
                        </div>
                    </div>    <div class="tile image outline-color-green">
                        <div class="tile-content" title="Trades"> <a href="?op=trades"><img src="images/trade.png" alt="" /></a>
                            <div class="brand">
                                <div class="name">Trades</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- End Drop Down Top Menu   (Top Slider)-->

        <!-- Start Main Container , contain = Left Section(Left Slider), Right Section(PinItMap)-->
        <div class="main-container">

            <!-- Start Right Section -->
            <div class="left-section">
                <div class="tab"> <div id='tggleBtnLeft' class='toggle' style="padding-left:1px;" title="Close Activity Bar"><div class="metrouicss"><i class="icon-arrow-left-3 fg-color-darken" style="font-size:18px"></i></div></div></div>
                <div class="contentx" style="overflow:scroll;scrollbar-base-color:white;scrollbar-highlight-color: #639ACE; scrollbar-track-color: #FFF;background-color:#fff">
                    <!--   <button onClick="gotoLocation(2.26760535,102.28052459)" >locate</button> --> 
                    <!--<a href="javascript:void(0);" onclick="generate();"><button >Take Map Screenshot</button></a>-->
                    _LEFTSIDE_
                </div>
            </div><!-- End Left Section -->

            <!-- Start Right Section -->
            <div class="right-section">
                <ul id="popupmenu" class="pmenu">

                    <li><a href="#" onclick='' class="parent">Write Pin at This Location</a>
                        <ul class="pmenu" style="width:270px">
                            <div align="center">
                                <form name="pinitpost2" method="post" action="?op=home">
                                    <input type="hidden" name="latUserDefine" id="latidUserDefine">
                                    <input type="hidden" name="lonUserDefine" id="lonidUserDefine">
                                    <input type="hidden" name="locnameUserDefine" id="locnameidUserDefine">
                                    <p>
                                        <textarea name="msg" id="msg" cols="30" rows="5" style="resize:vertical"></textarea>
                                    </p>
                                    <p> 
                                      <!-- <input type="radio" name="ptype" value="1">Jobs<br /> 
                                      <input type="radio" name="ptype" value="2">Trades<br /> 
                              <input type="radio" name="ptype" value="3">Promotions<br /> 
                              <input type="radio" name="ptype" value="4">Entertainments<br />   -->
                                    <table width=100% border=0>
                                        <tr>
                                            <td width=33% valign="top" style="font:Tahoma 12px bold">
                                                <input type="radio" name="pcat" value="0" onClick="hideshowpin(document.getElementById('pinitFC10'));" checked=checked >Pinit</td>
                                            <td width=34% valign="top" style="font:Tahoma 12px bold">
                                            <!--<input type="radio" name="pcat" value="1100" onClick="hideshowpin(document.getElementById('pinitFC11'));">Jobs-->
                                            </td>
                                            <td width=33% valign="top" style="font:Tahoma 12px bold">
                                                <input type="radio" name="pcat" value="1200" onClick="hideshowpin(document.getElementById('pinitFC12'));">Fun
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width=33% valign="top" style="font:Tahoma 12px bold"> 
                                                <input type="radio" name="pcat" value="1300" onClick="hideshowpin(document.getElementById('pinitFC13'));">Traffics 
                                            </td>
                                            <td width=34% valign="top" style="font:Tahoma 12px bold">
                                                <input type="radio" name="pcat" value="1400" onClick="hideshowpin(document.getElementById('pinitFC14'));">Cloud
                                            </td>
                                            <td width=33% valign="top" style="font:Tahoma 12px bold">
                                                <input type="radio" name="pcat" value="1500" onClick="hideshowpin(document.getElementById('pinitFC15'));">Education
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width=33% valign="top" style="font:Tahoma 12px bold">
                                                <input type="radio" name="pcat" value="1600" onClick="hideshowpin(document.getElementById('pinitFC16'));">Trades
                                            </td>
                                            <td width=34% valign="top" style="font:Tahoma 12px bold">
                                                <input type="radio" name="pcat" value="1700" onClick="hideshowpin(document.getElementById('pinitFC17'));">Shopping
                                            </td>
                                            <td width=33% valign="top" style="font:Tahoma 12px bold">
                                            </td>
                                        </tr>
                                    </table>
                                    <hr>
                                    <div id="pinitFC10" style="font:10px; display: none; margin-top:20px;">
                                    </div>
                                    <div id="pinitFC11" style="font:10px; display: none; margin-top:20px;">
                                    </div>
                                    <div id="pinitFC12" style="font:10px; display: none; margin-top:20px;">
                                    </div>
                                    <div id="pinitFC13" style="font:10px; display: none; margin-top:20px;">
                                        <input type="radio" name="pcat" value="1301">Light Traffics<br /> 
                                        <input type="radio" name="pcat" value="1302">Medium Traffics<br /> 
                                        <input type="radio" name="pcat" value="1303">Heavy Traffics<br /> 
                                        <input type="radio" name="pcat" value="1304">Speed Traps/Road Blocks<br /> 
                                        <input type="radio" name="pcat" value="1305">Accidents<br /> 
                                        <input type="radio" name="pcat" value="1306">Vehicles Stopped By<br />
                                        <input type="radio" name="pcat" value="1307">Activities<br />
                                    </div>
                                    <div id="pinitFC14" style="font:10px; display: none; margin-top:20px;">
                                    </div>
                                    <div id="pinitFC15" style="font:10px; display: none; margin-top:20px;">
                                    </div>
                                    <div id="pinitFC16" style="font:10px; display: none; margin-top:20px;">
                                    </div>
                                    <div id="pinitFC17" style="font:10px; display: none; margin-top:20px;">
                                    </div>
                                    <input type="submit" name="opchk" id="opchk" value="PinIt Here!">
                                    </p>
                                </form>
                            </div>
                        </ul>
                    </li>
                    <li><a href="#" onClick="window.open('?op=job&load=postJob', 'Post New Job', 'toolbar=no,resizable=yes,scrollbars=yes,width=800,height=500,left=20,top=20');">Post New Job</a></li>
                    <li><a href="#" onClick="pinPost(); hidePopupMenu()">Pin It!</a></li>
                    <li><a href="#" onClick="ZoomIn(); hidePopupMenu()">Zoom In</a></li>
                    <li><a href="#" onClick="ZoomOut(); hidePopupMenu()">Zoom Out</a></li>

                    <li><a href="#" onclick='' class="parent">Switch View</a>
                        <ul class="pmenu">
                            <li><a href="#" 
                                   onclick="setMapType('aerial'); hidePopupMenu()">Aerial</a></li>
                            <li><a href="#" 
                                   onclick="setMapType('road'); hidePopupMenu()">Road</a></li>
                            <li><a href="#" 
                                   onclick="setMapType('birdseye'); hidePopupMenu()">Birdseye</a></li>
                        </ul>
                    </li>
                    <li><a href="#" onClick="javascript:alert('Map is centered on:  ' + map.getCenter()); hidePopupMenu();">Point coordinates</a></li>
                </ul>

                <div id='PinItMap' style="width:100%; height:400px" oncontextmenu = "return false"></div>
            </div><!-- End Right Section  -->
        </div><!-- End Main Container , contain = Left Section(Left Slider), Right Section(PinItMap) -->

        <script type='text/javascript'>
        // jQuery Document
        // Marhazk -custom NEWSFEEDS
                                            __OTHERSCRIPTS__
                                            //Load the file containing the chat log
                                            var ajaxID = 0;
                                            function loadLog2(){
                                            $('#ajaxBusy').show();
                                                    loadLog();
                                                    setTimeout(
                                                    function()
                                                    {
                                                    loadLog();
                                                            $('#ajaxBusy').hide();
                                                    }, 2500);
                                                    $(this).ajaxStop(function(){
                                            $('#ajaxBusy').hide();
                                            });
                                            }
                                    function loadLogNews(){
                                    $('#ajaxBusyNews').show();
                                            loadLog();
                                            setTimeout(
                                            function()
                                            {
                                            loadLog();
                                                    $('#ajaxBusyNews').hide();
                                            }, 2500);
                                            $(this).ajaxStop(function(){
                                    $('#ajaxBusyNews').hide();
                                    });
                                    }
                                    function loadLogWeather(){
                                    $('#ajaxBusyWeather').show();
                                            loadLog();
                                            setTimeout(
                                            function()
                                            {
                                            loadLog();
                                                    $('#ajaxBusyWeather').hide();
                                            }, 2500);
                                            $(this).ajaxStop(function(){
                                    $('#ajaxBusyWeather').hide();
                                    });
                                    }
                                    function loadLog(){

                                    $.ajax({
                                    url: "?op=home/chkonline",
                                            cache: false,
                                            success: function(html){
                                    },
                                    });
                                            if (chkComment)
                                    {
                                    //var oldscrollHeight = $("#newsfeeds").attr("scrollHeight") - 20;
                                    $.ajax({
                                    url: "?op=home&ajax=1__HASHTAG__",
                                            cache: false,
                                            dataType:'html',
                                            success: function(html){
                                    $("#newsfeeds").html(html); //Insert chat log into the #chatbox div				
                                            //var newscrollHeight = $("#newsfeeds").attr("scrollHeight") - 20;
                                            //if(newscrollHeight > oldscrollHeight){
                                            //	$("#newsfeeds").animate({ scrollTop: newscrollHeight }, 'normal'); //Autoscroll to bottom of div
                                            //}				
                                    },
                                            error: function(){
                                    //alert("Error:");
                                    }
                                    });
                                            $.ajax({
                                    url: "?op=home&ajax=1&cat=1__HASHTAG__",
                                            cache: false,
                                            dataType:'html',
                                            success: function(html){
                                    $("#jobs").html(html); //Insert chat log into the #chatbox div				
                                            //var newscrollHeight = $("#newsfeeds").attr("scrollHeight") - 20;
                                            //if(newscrollHeight > oldscrollHeight){
                                            //	$("#newsfeeds").animate({ scrollTop: newscrollHeight }, 'normal'); //Autoscroll to bottom of div
                                            //}				
                                    },
                                            error: function(){
                                    //alert("Error:");
                                    }
                                    });
                                            $.ajax({
                                    url: "?op=home&ajax=1&cat=2__HASHTAG__",
                                            cache: false,
                                            dataType:'html',
                                            success: function(html){
                                    $("#entertainment").html(html); //Insert chat log into the #chatbox div				
                                            //var newscrollHeight = $("#newsfeeds").attr("scrollHeight") - 20;
                                            //if(newscrollHeight > oldscrollHeight){
                                            //	$("#newsfeeds").animate({ scrollTop: newscrollHeight }, 'normal'); //Autoscroll to bottom of div
                                            //}				
                                    },
                                            error: function(){
                                    //alert("Error:");
                                    }
                                    });
                                            $.ajax({
                                    url: "?op=home&ajax=1&cat=3__HASHTAG__",
                                            cache: false,
                                            dataType:'html',
                                            success: function(html){
                                    $("#traffic").html(html); //Insert chat log into the #chatbox div				
                                            //var newscrollHeight = $("#newsfeeds").attr("scrollHeight") - 20;
                                            //if(newscrollHeight > oldscrollHeight){
                                            //	$("#newsfeeds").animate({ scrollTop: newscrollHeight }, 'normal'); //Autoscroll to bottom of div
                                            //}				
                                    },
                                            error: function(){
                                    //alert("Error:");
                                    }
                                    });
                                            $.ajax({
                                    url: "?op=home&ajax=1&cat=4__HASHTAG__",
                                            cache: false,
                                            dataType:'html',
                                            success: function(html){
                                    $("#cloud").html(html); //Insert chat log into the #chatbox div				
                                            //var newscrollHeight = $("#newsfeeds").attr("scrollHeight") - 20;
                                            //if(newscrollHeight > oldscrollHeight){
                                            //	$("#newsfeeds").animate({ scrollTop: newscrollHeight }, 'normal'); //Autoscroll to bottom of div
                                            //}				
                                    },
                                            error: function(){
                                    //alert("Error:");
                                    }
                                    });
                                            $.ajax({
                                    url: "?op=home&ajax=1&cat=5__HASHTAG__",
                                            cache: false,
                                            dataType:'html',
                                            success: function(html){
                                    $("#trades").html(html); //Insert chat log into the #chatbox div				
                                            //var newscrollHeight = $("#newsfeeds").attr("scrollHeight") - 20;
                                            //if(newscrollHeight > oldscrollHeight){
                                            //	$("#newsfeeds").animate({ scrollTop: newscrollHeight }, 'normal'); //Autoscroll to bottom of div
                                            //}				
                                    },
                                            error: function(){
                                    //alert("Error:");
                                    }
                                    });
                                            $.ajax({
                                    url: "?op=home&ajax=1&cat=6__HASHTAG__",
                                            cache: false,
                                            dataType:'html',
                                            success: function(html){
                                    $("#promotions").html(html); //Insert chat log into the #chatbox div				
                                            //var newscrollHeight = $("#newsfeeds").attr("scrollHeight") - 20;
                                            //if(newscrollHeight > oldscrollHeight){
                                            //	$("#newsfeeds").animate({ scrollTop: newscrollHeight }, 'normal'); //Autoscroll to bottom of div
                                            //}				
                                    },
                                            error: function(){
                                    //alert("Error:");
                                    }
                                    });
                                            $.ajax({
                                    url: "?op=home/weather&wid=" + ajaxID,
                                            cache: false,
                                            dataType:'html',
                                            success: function(weather){
                                    if (ajaxID == 22)
                                            $("#weatherajax").html(weather);
                                            else
                                            $("#weatherajax").after(weather);
                                            //$("#weatherajax").add(html); 
                                    },
                                            error: function(){
                                    //alert("Error:");
                                    }

                                    });
                                            $.ajax({
                                    url: "?op=home/news&nid=" + ajaxID,
                                            cache: false,
                                            dataType:'html',
                                            success: function(news){
                                    $("#newsajax").html(news);
                                            //$("#weatherajax").add(html); 
                                    },
                                            error: function(){
                                    //alert("Error:");
                                    }
                                    });
                                            if (openTab)
                                    {
                                    $.ajax({
                                    url: "?op=account/notification&ajax=1",
                                            cache: false,
                                            success: function(html){
                                    $("#notifications").html(html); //Insert chat log into the #chatbox div				
                                            //var newscrollHeight = $("#newsfeeds").attr("scrollHeight") - 20;
                                            //if(newscrollHeight > oldscrollHeight){
                                            //	$("#newsfeeds").animate({ scrollTop: newscrollHeight }, 'normal'); //Autoscroll to bottom of div
                                            //}				
                                    },
                                    });
                                    }
                                    $.ajax({
                                    url: "?op=home&ajax=2&updatelatlon=1&lat=" + document.getElementById('latid').value + "&lon=" + document.getElementById('lonid').value + "&locname=" + document.getElementById('locnameid').value,
                                            cache: false,
                                            dataType:'html',
                                            success: function(html){
                                    },
                                            error: function(){
                                    }
                                    });
                                            ajaxID++;
                                            if (ajaxID == 22)
                                            ajaxID = 0;
                                    }
                                    }
                                    var curLen = 0;
                                            $('#msgpinit').keypress(function() {
                                    //alert("marhazk currently editing it");
                                    var str = new String(document.getElementById("msgpinit").value);
                                            var strArray = new Array;
                                            var strBool = new Array;
                                            for (strb = 0; strb < strArray.length; strb++)
                                    {
                                    strBool[strb] = false;
                                    }
                                    var foundStr = false;
                                            strArray = str.split(" ");
                                            if (true)
                                    {
                                    curLen = str.length;
                                            for (chks = 0; chks < strArray.length; chks++)
                                    {
                                    var varStr = new String(strArray[chks].toLowerCase());
                                            var tagOrNotText = new String("@").toLowerCase();
                                            var tagOrNot = varStr.match(tagOrNotText);
                                            if (varStr.length > 2)
                                    {
                                    if (tagOrNot)
                                    {
                                    for (chkn = 0; chkn < accDBfl.length; chkn++)
                                    {
                                    var adb1 = new String("@" + accDBfl[chkn]).toLowerCase();
                                            var adb2 = new String("@" + accDBun[chkn]).toLowerCase();
                                            var chknm1 = adb1.match(varStr);
                                            var chknm2 = adb2.match(varStr);
                                            if (chknm2)
                                    {
                                    if ((chknm2 != adb2) && ((varStr.length < adb2.length - 1) || (varStr.length > adb2.length)))
                                    {

                                    //alert(varStr);
                                    //alert(adb2.length);
                                    //str=str.replace(chknm2, ":XtagX:" + accDBun[chkn]) + " ";
                                    document.getElementById("listag").style.display = "block";
                                            str = str.replace(varStr, "");
                                            str = str.replace(chknm2, "");
                                            document.getElementById("msgpinit").value = str;
                                            $.ajax({
                                    url: "?op=home/tags&ajax=1&val=" + chknm2,
                                            cache: false,
                                            success: function(html){
                                    $("#listag").html(html);
                                    },
                                    });
                                            return false;
                                    }
                                    }
                                    else if (chknm1)
                                    {
                                    if ((chknm1 != adb1) && ((varStr.length < adb1.length - 1) || (varStr.length > adb1.length)))
                                    {
                                    //alert(varStr.length);
                                    //alert(adb2.length);
                                    //str=str.replace(chknm1, ":XtagX:" + accDBun[chkn]) + " ";
                                    document.getElementById("listag").style.display = "block";
                                            str = str.replace(varStr, "");
                                            str = str.replace(chknm1, "");
                                            document.getElementById("msgpinit").value = str;
                                            //$("#listag").html("TEST2");
                                            $.ajax({
                                    url: "?op=home/tags&ajax=1&val=" + chknm1,
                                            cache: false,
                                            success: function(html){
                                    $("#listag").html(html);
                                    },
                                    });
                                            return false;
                                    }
                                    }
                                    }
                                    }
                                    }
                                    }
                                    //document.getElementById("msgpinit").value = str.replace(":XtagX:", "@");
                                    document.getElementById("msgpinit").value = str;
                                            curLen = str.length;
                                    }
                                    });
                                            chat(document).ready(function(){
                                    //If user submits the form

                                    chat("#opchkpinit").click(function(){
                                    $('#ajaxBusy').show();
                                            var val1 = $("#latid").val();
                                            var val2 = $("#lonid").val();
                                            var val3 = $("#locnameid").val();
                                            var val4 = $("#msgpinit").val();
                                            var val5 = $("#opchkpinit").val();
                                            //$("#msgpinit").attr("value", "");
                                            document.getElementById("msgpinit").value = "";
                                            $.post("?op=home&ajax=2", {opchk: val5, lat: val1, lon: val2, locname: val3, msg: val4});
                                            loadLog();
                                            setTimeout(
                                            function()
                                            {
                                            loadLog();
                                                    $('#ajaxBusy').hide();
                                            }, 2500);
                                            $(this).ajaxStop(function(){
                                    $('#ajaxBusy').hide();
                                    });
                                            return false;
                                    });
                                            setInterval (loadLog, 30000); //Reload file every 30 seconds

                                            //If user wants to end session
                                    });
                                            // Ajax activity indicator bound to ajax start/stop document events
        </script>
    </body>
</html>
