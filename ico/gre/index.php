<?php include 'header.php';

$date = $db->query("SELECT SUM(mallu) as xo FROM users")->fetchAll();
//print_r($date);
?>
<style>
    .tp-leftarrow{
        display:none;
    }
    .tp-rightarrow{
        display:none;
    }
</style>


    <!--
    <section id="slider">
        <div id="rev_slider_484_1_wrapper" class="rev_slider_wrapper fullscreen-container" data-alias="typewriter-effect" data-source="gallery" style="background-color:transparent;padding:0px;">
            
            <div id="rev_slider_484_1" class="rev_slider fullscreenbanner" style="display:none;" data-version="5.4.1">
                <ul>
            
                    <li data-index="rs-2800" data-transition="slidingoverlayhorizontal" data-slotamount="default" data-hideafterloop="0" data-hideslideonmobile="off" data-easein="default" data-easeout="default" data-masterspeed="default" data-thumb="assets/img/5.2.jpg" data-rotate="0" data-saveperformance="off" data-title="Slide" data-param1="" data-param2="" data-param3="" data-param4="" data-param5="" data-param6="" data-param7="" data-param8="" data-param9="" data-param10="" data-description="">
            
                        <img src="assets/img/5.jpg" alt="" data-bgposition="center center" data-bgfit="cover" class="rev-slidebg">
            

            
                        <div class="tp-caption tp-shape tp-shapewrapper " id="slide-2800-layer-7" data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" data-y="['middle','middle','middle','middle']" data-voffset="['0','0','0','0']" data-width="full" data-height="full" data-whitespace="nowrap" data-type="shape" data-basealign="slide" data-responsive_offset="off" data-responsive="off" data-frames='[{"from":"opacity:0;","speed":500,"to":"o:1;","delay":0,"ease":"Power4.easeOut"},{"speed":5000,"to":"opacity:0;","ease":"Power4.easeInOut"}]' data-textAlign="['left','left','left','left']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 5;background-color:rgba(0, 0, 0, 0.50);border-color:rgba(0, 0, 0, 0);border-width:0px;"></div>

            
                        <div class="tp-caption   tp-resizeme" id="slide-2800-layer-1" data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" data-y="['middle','middle','middle','middle']" data-voffset="['-80','-80','-130','-157']" data-fontsize="['80','50','40','30']" data-lineheight="['80','50','40','30']" data-width="none" data-height="none" data-whitespace="nowrap" data-type="text" data-responsive_offset="on" data-frames='[{"from":"y:50px;sX:1;sY:1;opacity:0;","speed":2500,"to":"o:1;","delay":500,"ease":"Power4.easeOut"},{"delay":"wait","speed":300,"to":"opacity:0;","ease":"nothing"}]' data-textAlign="['center','center','center','center']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 6; white-space: nowrap; font-size: 80px; line-height: auto; font-weight: 700; color: rgba(255, 255, 255, 1.00);font-family:Arial, Helvetica, sans-serif;border-width:0px;letter-spacing:0px; text-transform:capitalize;">Συμμετοχή Στην Ψηφιακή Καινοτομία
                        </div>

            
                        <div class="tp-caption tp-shape tp-shapewrapper  tp-resizeme" id="slide-2800-layer-3" data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" data-y="['middle','middle','middle','middle']" data-voffset="['16','16','-54','-89']" data-width="60" data-height="3" data-whitespace="nowrap" data-type="shape" data-responsive_offset="on" data-frames='[{"from":"y:50px;opacity:0;","speed":2500,"to":"o:1;","delay":500,"ease":"Power4.easeOut"},{"delay":"wait","speed":300,"to":"opacity:0;","ease":"nothing"}]' data-textAlign="['left','left','left','left']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 7;background-color:rgba(38, 211, 105, 1.00);border-color:rgba(0, 0, 0, 0);border-width:0px;"></div>

            
                        <div class="tp-caption   tp-resizeme" id="slide-2800-layer-2" data-x="['center','center','center','center']" data-hoffset="['-10','-10','-10','-10']" data-y="['middle','middle','middle','middle']" data-voffset="['65','65','-8','-32']" data-fontsize="['40','40','30','30']" data-width="['640','640','480','360']" data-height="none" data-whitespace="['nowrap','nowrap','normal','normal']" data-type="text" data-typewriter='{"lines":" Γεμίστε την τσέπη σας με Fillit,Ελεγχόμενο Blockchain,Αγοράστε Tokens","enabled":"on","speed":"60","delays":"1%7C100","looped":"on","cursorType":"one","blinking":"on","word_delay":"off","sequenced":"on","hide_cursor":"off","start_delay":"1500","newline_delay":"1000","deletion_speed":"20","deletion_delay":"1000","blinking_speed":"500","linebreak_delay":"60","cursor_type":"two","background":"off"}' data-responsive_offset="on" data-frames='[{"from":"y:50px;sX:1;sY:1;opacity:0;","speed":2500,"to":"o:1;","delay":500,"ease":"Power4.easeOut"},{"delay":"wait","speed":300,"to":"opacity:0;","ease":"nothing"}]' data-textAlign="['center','center','center','center']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 8; min-width: 640px; max-width: 640px; white-space: nowrap; font-size: 40px; line-height: 40px; font-weight: 400; color: rgba(255, 255, 255, 1.00);font-family:Georgia, serif;font-style:italic;border-width:0px;">Αφοσιωμένο, εμπνευσμένο, παθιασμένο
                        </div>

                        <div class="tp-caption rev-btn  tp-resizeme" id="slide-2800-layer-5" data-x="['left','left','center','center']" data-hoffset="['400','480','0','0']" data-y="['middle','middle','middle','middle']" data-voffset="['340','340','224','207']" data-width="none" data-height="none" data-whitespace="nowrap" data-type="button" data-actions='[{"event":"click","action":"scrollbelow","offset":"px","delay":""}]' data-responsive_offset="on" data-frames='[{"from":"x:50px;opacity:0;","speed":2500,"to":"o:1;","delay":500,"ease":"Power4.easeOut"},{"delay":"wait","speed":300,"to":"opacity:0;","ease":"nothing"},{"frame":"hover","speed":"150","ease":"Power2.easeInOut","to":"o:1;rX:0;rY:0;rZ:0;z:0;","style":"c:rgba(0, 0, 0, 1.00);bg:rgba(255, 255, 255, 1.00);bc:rgba(255, 255, 255, 0);bw:2px 2px 2px 2px;"}]' data-textAlign="['left','left','left','left']" data-paddingtop="[0,0,0,0]" data-paddingright="[50,50,50,50]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[50,50,50,50]" style="z-index: 11; white-space: nowrap; font-size: 18px; line-height: 46px; font-weight: 700; color: rgba(255, 255, 255, 1.00);font-family:Arial, Helvetica, sans-serif;background-color:rgba(0, 0, 0, 0);border-color:rgba(255, 255, 255, 0.25);border-style:solid;border-width:2px;border-radius:4px 4px 4px 4px;outline:none;box-shadow:none;box-sizing:border-box;-moz-box-sizing:border-box;-webkit-box-sizing:border-box;letter-spacing:5px;cursor:pointer;">ΕΓΓΡΑΦΕΙΤΕ ΣΤΗΝ ΠΡΟΠΩΛΗΣΗ
                        </div>
                    </li>
                
                    <li data-index="rs-2801" data-transition="slidingoverlayhorizontal" data-slotamount="default" data-hideafterloop="0" data-hideslideonmobile="off" data-easein="default" data-easeout="default" data-masterspeed="default" data-thumb="assets/img/6.2.jpg" data-rotate="0" data-saveperformance="off" data-title="Slide" data-param1="" data-param2="" data-param3="" data-param4="" data-param5="" data-param6="" data-param7="" data-param8="" data-param9="" data-param10="" data-description="">
                
                        <img src="assets/img/6.jpg" alt="" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" class="rev-slidebg">
                

                
                        <div class="tp-caption tp-shape tp-shapewrapper " id="slide-2801-layer-7" data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" data-y="['middle','middle','middle','middle']" data-voffset="['0','0','0','0']" data-width="full" data-height="full" data-whitespace="nowrap" data-type="shape" data-basealign="slide" data-responsive_offset="off" data-responsive="off" data-frames='[{"from":"opacity:0;","speed":1000,"to":"o:1;","delay":0,"ease":"Power4.easeOut"},{"delay":"wait","speed":1000,"to":"opacity:0;","ease":"Power4.easeOut"}]' data-textAlign="['left','left','left','left']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 12;background-color:rgba(0, 0, 0, 0.50);border-color:rgba(0, 0, 0, 0);border-width:0px;"></div>

                
                        <div class="tp-caption   tp-resizeme" id="slide-2801-layer-1" data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" data-y="['middle','middle','middle','middle']" data-voffset="['-80','-80','-130','-157']" data-fontsize="['80','50','40','30']" data-lineheight="['80','50','40','30']" data-width="none" data-height="none" data-whitespace="nowrap" data-type="text" data-responsive_offset="on" data-frames='[{"from":"y:50px;sX:1;sY:1;opacity:0;","speed":2500,"to":"o:1;","delay":500,"ease":"Power4.easeOut"},{"delay":"wait","speed":300,"to":"opacity:0;","ease":"nothing"}]' data-textAlign="['center','center','center','center']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 13; white-space: nowrap; font-size: 130px; line-height: auto; font-weight: 700; color: rgba(255, 255, 255, 1.00);font-family:Arial, Helvetica, sans-serif;background-color:rgba(0, 0, 0, 0);border-width:0px;letter-spacing:0;text-transform:capitalize;">Η θρυλική καινοτομία στο ICO
                        </div>

                
                        <div class="tp-caption tp-shape tp-shapewrapper  tp-resizeme" id="slide-2801-layer-3" data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" data-y="['middle','middle','middle','middle']" data-voffset="['16','16','-54','-89']" data-width="60" data-height="3" data-whitespace="nowrap" data-type="shape" data-responsive_offset="on" data-frames='[{"from":"y:50px;opacity:0;","speed":2500,"to":"o:1;","delay":500,"ease":"Power4.easeOut"},{"delay":"wait","speed":300,"to":"opacity:0;","ease":"nothing"}]' data-textAlign="['left','left','left','left']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 14;background-color:#F25F61;border-color:rgba(0, 0, 0, 0);border-width:0px;"></div>

                
                        <div class="tp-caption   tp-resizeme" id="slide-2801-layer-2" data-x="['center','center','center','center']" data-hoffset="['-10','-10','-10','-10']" data-y="['middle','middle','middle','middle']" data-voffset="['65','65','-8','-32']" data-fontsize="['40','40','30','30']" data-width="['640','640','480','360']" data-height="none" data-whitespace="normal" data-type="text" data-typewriter='{"lines":" Γεμίστε την τσέπη σας με FILLIT,Ελεγχόμενο Blockchain,Αγοράστε Tokens","enabled":"on","speed":"60","delays":"1%7C100","looped":"on","cursorType":"one","blinking":"on","word_delay":"off","sequenced":"on","hide_cursor":"off","start_delay":"1500","newline_delay":"1000","deletion_speed":"20","deletion_delay":"1000","blinking_speed":"500","linebreak_delay":"60","cursor_type":"two","background":"off"}' data-responsive_offset="on" data-frames='[{"from":"y:50px;sX:1;sY:1;opacity:0;","speed":2500,"to":"o:1;","delay":500,"ease":"Power4.easeOut"},{"delay":"wait","speed":300,"to":"opacity:0;","ease":"nothing"}]' data-textAlign="['center','center','center','center']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 15; min-width: 640px; max-width: 640px; white-space: normal; font-size: 40px; line-height: 40px; font-weight: 400; color: rgba(255, 255, 255, 1.00);font-family:Georgia, serif;font-style:italic;border-width:0px;">Αφοσιωμένο, εμπνευσμένο, παθιασμένο
                        </div>

                

                
                        <div class="tp-caption rev-btn  tp-resizeme" id="slide-2801-layer-5" data-x="['left','left','center','center']" data-hoffset="['400','550','0','0']" data-y="['middle','middle','middle','middle']" data-voffset="['340','340','224','207']" data-width="none" data-height="none" data-whitespace="nowrap" data-type="button" data-actions='[{"event":"click","action":"scrollbelow","offset":"px","delay":""}]' data-responsive_offset="on" data-frames='[{"from":"x:50px;opacity:0;","speed":2500,"to":"o:1;","delay":500,"ease":"Power4.easeOut"},{"delay":"wait","speed":300,"to":"opacity:0;","ease":"nothing"},{"frame":"hover","speed":"150","ease":"Power2.easeInOut","to":"o:1;rX:0;rY:0;rZ:0;z:0;","style":"c:rgba(0, 0, 0, 1.00);bg:rgba(255, 255, 255, 1.00);bc:rgba(255, 255, 255, 0);bw:2px 2px 2px 2px;"}]' data-textAlign="['left','left','left','left']" data-paddingtop="[0,0,0,0]" data-paddingright="[50,50,50,50]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[50,50,50,50]" style="z-index: 18; white-space: nowrap; font-size: 18px; line-height: 46px; font-weight: 700; color: rgba(255, 255, 255, 1.00);font-family:Arial, Helvetica, sans-serif;background-color:rgba(0, 0, 0, 0);border-color:rgba(255, 255, 255, 0.25);border-style:solid;border-width:2px;border-radius:4px 4px 4px 4px;outline:none;box-shadow:none;box-sizing:border-box;-moz-box-sizing:border-box;-webkit-box-sizing:border-box;letter-spacing:5px;cursor:pointer;">ΕΓΓΡΑΦΕΙΤΕ ΣΤΗΝ ΠΡΟΠΩΛΗΣΗ
                        </div>
                    </li>
                
                    <li data-index="rs-2802" data-transition="slidingoverlayhorizontal" data-slotamount="default" data-hideafterloop="0" data-hideslideonmobile="off" data-easein="default" data-easeout="default" data-masterspeed="default" data-thumb="assets/img/4.2.jpg" data-rotate="0" data-saveperformance="off" data-title="Slide" data-param1="" data-param2="" data-param3="" data-param4="" data-param5="" data-param6="" data-param7="" data-param8="" data-param9="" data-param10="" data-description="">
                
                        <img src="assets/img/4.jpg" alt="" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" class="rev-slidebg">
                

                
                        <div class="tp-caption tp-shape tp-shapewrapper " id="slide-2802-layer-7" data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" data-y="['middle','middle','middle','middle']" data-voffset="['0','0','0','0']" data-width="full" data-height="full" data-whitespace="nowrap" data-type="shape" data-basealign="slide" data-responsive_offset="off" data-responsive="off" data-frames='[{"from":"opacity:0;","speed":1000,"to":"o:1;","delay":0,"ease":"Power4.easeOut"},{"delay":"wait","speed":1000,"to":"opacity:0;","ease":"Power4.easeOut"}]' data-textAlign="['left','left','left','left']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 19;background-color:rgba(0, 0, 0, 0.50);border-color:rgba(0, 0, 0, 0);border-width:0px;"></div>

                
                        <div class="tp-caption   tp-resizeme" id="slide-2802-layer-1" data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" data-y="['middle','middle','middle','middle']" data-voffset="['-80','-81','-171','-146']" data-fontsize="['100','100','70','60']" data-lineheight="['100','100','70','50']" data-width="['760','760','none','360']" data-height="none" data-whitespace="['normal','normal','nowrap','normal']" data-type="text" data-typewriter='{"lines":"","enabled":"on","speed":"60","delays":"1%7C100","looped":"on","cursorType":"one","blinking":"on","word_delay":"off","sequenced":"on","hide_cursor":"off","start_delay":"1500","newline_delay":"1000","deletion_speed":"20","deletion_delay":"1000","blinking_speed":"500","linebreak_delay":"60","cursor_type":"two","background":"off"}' data-responsive_offset="on" data-frames='[{"from":"y:50px;sX:1;sY:1;opacity:0;","speed":2500,"to":"o:1;","delay":500,"ease":"Power4.easeOut"},{"delay":"wait","speed":300,"to":"opacity:0;","ease":"nothing"}]' data-textAlign="['center','center','center','center']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 20; min-width: 760px; max-width: 760px; white-space: normal; font-size: 100px; line-height: 100px; font-weight: 700; color: rgba(255, 255, 255, 1.00);font-family:Arial, Helvetica, sans-serif;border-width:0px;letter-spacing:-5px;">Πάντα φαίνεται
                            <br /> αδύνατο
                            <br /> μέχρι να γίνει.
                        </div>

                
                        <div class="tp-caption tp-shape tp-shapewrapper  tp-resizeme" id="slide-2802-layer-3" data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" data-y="['middle','middle','middle','middle']" data-voffset="['96','96','-35','-19']" data-width="60" data-height="3" data-whitespace="nowrap" data-type="shape" data-responsive_offset="on" data-frames='[{"from":"y:50px;opacity:0;","speed":2500,"to":"o:1;","delay":5000,"ease":"Power4.easeOut"},{"delay":"wait","speed":300,"to":"opacity:0;","ease":"nothing"}]' data-textAlign="['left','left','left','left']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 21;background-color:rgba(0, 220, 186, 1.00);border-color:rgba(0, 0, 0, 0);border-width:0px;"></div>

                
                        <div class="tp-caption   tp-resizeme" id="slide-2802-layer-2" data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" data-y="['middle','middle','middle','middle']" data-voffset="['144','144','12','18']" data-fontsize="['40','40','30','30']" data-width="['640','640','480','360']" data-height="none" data-whitespace="normal" data-type="text" data-responsive_offset="on" data-frames='[{"from":"y:50px;sX:1;sY:1;opacity:0;","speed":2500,"to":"o:1;","delay":5000,"ease":"Power4.easeOut"},{"delay":"wait","speed":300,"to":"opacity:0;","ease":"nothing"}]' data-textAlign="['center','center','center','center']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 22; min-width: 640px; max-width: 640px; white-space: normal; font-size: 40px; line-height: 40px; font-weight: 400; color: rgba(255, 255, 255, 1.00);font-family:Georgia, serif;font-style:italic;border-width:0px;">Nelson Mandela
                        </div>

                
                        <div class="tp-caption rev-btn  tp-resizeme" id="slide-2802-layer-4" data-x="['right','right','center','center']" data-hoffset="['400','550','0','0']" data-y="['middle','middle','middle','middle']" data-voffset="['340','340','100','93']" data-width="none" data-height="none" data-whitespace="nowrap" data-type="button" data-actions='[{"event":"click","action":"scrollbelow","offset":"px","delay":""}]' data-responsive_offset="on" data-frames='[{"from":"x:-50px;opacity:0;","speed":2500,"to":"o:1;","delay":5000,"ease":"Power4.easeOut"},{"delay":"wait","speed":300,"to":"opacity:0;","ease":"nothing"},{"frame":"hover","speed":"150","ease":"Power2.easeInOut","to":"o:1;rX:0;rY:0;rZ:0;z:0;","style":"c:rgba(0, 0, 0, 1.00);bg:rgba(255, 255, 255, 1.00);bc:rgba(255, 255, 255, 0);bw:2px 2px 2px 2px;"}]' data-textAlign="['left','left','left','left']" data-paddingtop="[0,0,0,0]" data-paddingright="[50,50,50,50]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[50,50,50,50]" style="z-index: 23; white-space: nowrap; font-size: 18px; line-height: 46px; font-weight: 700; color: rgba(255, 255, 255, 1.00);font-family:Arial, Helvetica, sans-serif;background-color:rgba(0, 0, 0, 0);border-color:rgba(255, 255, 255, 0.25);border-style:solid;border-width:2px;border-radius:4px 4px 4px 4px;outline:none;box-shadow:none;box-sizing:border-box;-moz-box-sizing:border-box;-webkit-box-sizing:border-box;letter-spacing:5px;cursor:pointer;">ΕΓΓΡΑΦΕΙΤΕ ΣΤΗΝ ΠΡΟΠΩΛΗΣΗ
                        </div>

                
                    </li>
                </ul>


                <div class="tp-bannertimer tp-bottom" style="visibility: hidden !important;"></div>
            </div>
        </div>
    </section> -->
    <section id="slider">
        <div id="rev_slider_484_1_wrapper" class="rev_slider_wrapper fullscreen-container" data-alias="typewriter-effect" data-source="gallery" style="background-color:transparent;padding:0px;">
            <!-- START REVOLUTION SLIDER 5.4.1 fullscreen mode -->
            <div id="rev_slider_484_1" class="rev_slider fullscreenbanner" style="display:none;" data-version="5.4.1">
                <ul>
                    <!-- SLIDE  -->
                    <li data-index="rs-2800" data-transition="slidingoverlayhorizontal" data-slotamount="default" data-hideafterloop="0" data-hideslideonmobile="off" data-easein="default" data-easeout="default" data-masterspeed="default" data-thumb="assets/img/5.2.jpg" data-rotate="0" data-saveperformance="off" data-title="Slide" data-param1="" data-param2="" data-param3="" data-param4="" data-param5="" data-param6="" data-param7="" data-param8="" data-param9="" data-param10="" data-description="">
                        <!-- MAIN IMAGE -->
                        <img src="assets/img/5'.jpg" alt="" data-bgposition="center center" data-bgfit="cover" class="rev-slidebg">
                        <!-- LAYERS -->

                        <!-- LAYER NR. 1 -->
                        <div class="tp-caption tp-shape tp-shapewrapper "  data-width="full" data-height="full" data-whitespace="nowrap" data-type="shape" data-basealign="slide" data-responsive_offset="off" data-responsive="off" data-frames='[{"from":"opacity:0;","speed":500,"to":"o:1;","delay":0,"ease":"Power4.easeOut"},{"speed":5000,"to":"opacity:0;","ease":"Power4.easeInOut"}]'  style="z-index: 5;background-color:rgba(0, 0, 0, 0.30);border-color:rgba(0, 0, 0, 0);border-width:0px;"></div>

                        <!-- LAYER NR. 2 -->
                        <!--<div class="tp-caption   tp-resizeme" id="slide-2800-layer-1" data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" data-y="['middle','middle','middle','middle']" data-voffset="['-80','-80','-130','-157']" data-fontsize="['80','50','40','30']" data-lineheight="['80','50','40','30']" data-width="none" data-height="none" data-whitespace="nowrap" data-type="text" data-responsive_offset="on" data-frames='[{"from":"y:50px;sX:1;sY:1;opacity:0;","speed":2500,"to":"o:1;","delay":500,"ease":"Power4.easeOut"},{"delay":"wait","speed":300,"to":"opacity:0;","ease":"nothing"}]' data-textAlign="['center','center','center','center']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 6; white-space: nowrap; font-size: 80px; line-height: auto; font-weight: 700; color: rgba(255, 255, 255, 1.00);font-family:Arial, Helvetica, sans-serif;border-width:0px;letter-spacing:0px; text-transform:capitalize;">Join Into Digital Innovation-->
                        <!--</div>-->

                        <!-- LAYER NR. 3 -->
                        <!--<div class="tp-caption tp-shape tp-shapewrapper  tp-resizeme" id="slide-2800-layer-3" data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" data-y="['middle','middle','middle','middle']" data-voffset="['16','16','-54','-89']" data-width="60" data-height="3" data-whitespace="nowrap" data-type="shape" data-responsive_offset="on" data-frames='[{"from":"y:50px;opacity:0;","speed":2500,"to":"o:1;","delay":500,"ease":"Power4.easeOut"},{"delay":"wait","speed":300,"to":"opacity:0;","ease":"nothing"}]' data-textAlign="['left','left','left','left']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 7;background-color:rgba(38, 211, 105, 1.00);border-color:rgba(0, 0, 0, 0);border-width:0px;"></div>-->

                        <!-- LAYER NR. 4 -->
                        <!--<div class="tp-caption   tp-resizeme" id="slide-2800-layer-2" data-x="['center','center','center','center']" data-hoffset="['-10','-10','-10','-10']" data-y="['middle','middle','middle','middle']" data-voffset="['65','65','-8','-32']" data-fontsize="['40','40','30','30']" data-width="['640','640','480','360']" data-height="none" data-whitespace="['nowrap','nowrap','normal','normal']" data-type="text" data-typewriter='{"lines":" Fill your pocket with FILLIT,Blockchain Controlled,Buy tokens","enabled":"on","speed":"60","delays":"1%7C100","looped":"on","cursorType":"one","blinking":"on","word_delay":"off","sequenced":"on","hide_cursor":"off","start_delay":"1500","newline_delay":"1000","deletion_speed":"20","deletion_delay":"1000","blinking_speed":"500","linebreak_delay":"60","cursor_type":"two","background":"off"}' data-responsive_offset="on" data-frames='[{"from":"y:50px;sX:1;sY:1;opacity:0;","speed":2500,"to":"o:1;","delay":500,"ease":"Power4.easeOut"},{"delay":"wait","speed":300,"to":"opacity:0;","ease":"nothing"}]' data-textAlign="['center','center','center','center']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 8; min-width: 640px; max-width: 640px; white-space: nowrap; font-size: 40px; line-height: 40px; font-weight: 400; color: rgba(255, 255, 255, 1.00);font-family:Georgia, serif;font-style:italic;border-width:0px;">Dedicated. Inspired. Passionate.-->
                        <!--</div>-->

                        <!-- LAYER NR. 5 -->

                        <!-- LAYER NR. 6 -->

                        <!-- LAYER NR. 7 -->
                        <div class="tp-caption rev-btn  tp-resizeme" id="slide-2800-layer-5" data-x="['left','left','center','center']" data-hoffset="['500','480','0','0']" data-y="['middle','middle','middle','middle']" data-voffset="['340','340','224','207']" data-width="none" data-height="none" data-whitespace="nowrap" data-type="button" data-actions='[{"event":"click","action":"scrollbelow","offset":"px","delay":""}]' data-responsive_offset="on" data-frames='[{"from":"x:50px;opacity:0;","speed":2500,"to":"o:1;","delay":500,"ease":"Power4.easeOut"},{"delay":"wait","speed":300,"to":"opacity:0;","ease":"nothing"},{"frame":"hover","speed":"150","ease":"Power2.easeInOut","to":"o:1;rX:0;rY:0;rZ:0;z:0;","style":"c:rgba(0, 0, 0, 1.00);bg:rgba(255, 255, 255, 1.00);bc:rgba(255, 255, 255, 0);bw:2px 2px 2px 2px;"}]' data-textAlign="['left','left','left','left']" data-paddingtop="[0,0,0,0]" data-paddingright="[50,50,50,50]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[50,50,50,50]" style="z-index: 11; white-space: nowrap; font-size: 18px; line-height: 46px; font-weight: 700; color: rgba(255, 255, 255, 1.00);font-family:Arial, Helvetica, sans-serif;background-color:rgba(0, 0, 0, 0);border-color:rgba(255, 255, 255, 0.25);border-style:solid;border-width:2px;border-radius:4px 4px 4px 4px;outline:none;box-shadow:none;box-sizing:border-box;-moz-box-sizing:border-box;-webkit-box-sizing:border-box;letter-spacing:5px;cursor:pointer;">Πάρτε μέρος στην προπώληση
                        </div>
                    </li>
                    <!-- SLIDE  -->
                    <!--<li data-index="rs-2801" data-transition="slidingoverlayhorizontal" data-slotamount="default" data-hideafterloop="0" data-hideslideonmobile="off" data-easein="default" data-easeout="default" data-masterspeed="default" data-thumb="assets/img/6.2.jpg" data-rotate="0" data-saveperformance="off" data-title="Slide" data-param1="" data-param2="" data-param3="" data-param4="" data-param5="" data-param6="" data-param7="" data-param8="" data-param9="" data-param10="" data-description="">-->
                        <!-- MAIN IMAGE -->
                    <!--    <img src="assets/img/6.jpg" alt="" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" class="rev-slidebg">-->
                        <!-- LAYERS -->

                        <!-- LAYER NR. 8 -->
                    <!--    <div class="tp-caption tp-shape tp-shapewrapper " id="slide-2801-layer-7" data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" data-y="['middle','middle','middle','middle']" data-voffset="['0','0','0','0']" data-width="full" data-height="full" data-whitespace="nowrap" data-type="shape" data-basealign="slide" data-responsive_offset="off" data-responsive="off" data-frames='[{"from":"opacity:0;","speed":1000,"to":"o:1;","delay":0,"ease":"Power4.easeOut"},{"delay":"wait","speed":1000,"to":"opacity:0;","ease":"Power4.easeOut"}]' data-textAlign="['left','left','left','left']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 12;background-color:rgba(0, 0, 0, 0.50);border-color:rgba(0, 0, 0, 0);border-width:0px;"></div>-->

                        <!-- LAYER NR. 9 -->
                    <!--    <div class="tp-caption   tp-resizeme" id="slide-2801-layer-1" data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" data-y="['middle','middle','middle','middle']" data-voffset="['-80','-80','-130','-157']" data-fontsize="['80','50','40','30']" data-lineheight="['80','50','40','30']" data-width="none" data-height="none" data-whitespace="nowrap" data-type="text" data-responsive_offset="on" data-frames='[{"from":"y:50px;sX:1;sY:1;opacity:0;","speed":2500,"to":"o:1;","delay":500,"ease":"Power4.easeOut"},{"delay":"wait","speed":300,"to":"opacity:0;","ease":"nothing"}]' data-textAlign="['center','center','center','center']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 13; white-space: nowrap; font-size: 130px; line-height: auto; font-weight: 700; color: rgba(255, 255, 255, 1.00);font-family:Arial, Helvetica, sans-serif;background-color:rgba(0, 0, 0, 0);border-width:0px;letter-spacing:0;text-transform:capitalize;">Legendary Innovation in ICO-->
                    <!--    </div>-->

                        <!-- LAYER NR. 10 -->
                    <!--    <div class="tp-caption tp-shape tp-shapewrapper  tp-resizeme" id="slide-2801-layer-3" data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" data-y="['middle','middle','middle','middle']" data-voffset="['16','16','-54','-89']" data-width="60" data-height="3" data-whitespace="nowrap" data-type="shape" data-responsive_offset="on" data-frames='[{"from":"y:50px;opacity:0;","speed":2500,"to":"o:1;","delay":500,"ease":"Power4.easeOut"},{"delay":"wait","speed":300,"to":"opacity:0;","ease":"nothing"}]' data-textAlign="['left','left','left','left']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 14;background-color:#F25F61;border-color:rgba(0, 0, 0, 0);border-width:0px;"></div>-->

                        <!-- LAYER NR. 11 -->
                    <!--    <div class="tp-caption   tp-resizeme" id="slide-2801-layer-2" data-x="['center','center','center','center']" data-hoffset="['-10','-10','-10','-10']" data-y="['middle','middle','middle','middle']" data-voffset="['65','65','-8','-32']" data-fontsize="['40','40','30','30']" data-width="['640','640','480','360']" data-height="none" data-whitespace="normal" data-type="text" data-typewriter='{"lines":" Fill your pocket with FILLIT,Blockchain Controlled,Buy tokens","enabled":"on","speed":"60","delays":"1%7C100","looped":"on","cursorType":"one","blinking":"on","word_delay":"off","sequenced":"on","hide_cursor":"off","start_delay":"1500","newline_delay":"1000","deletion_speed":"20","deletion_delay":"1000","blinking_speed":"500","linebreak_delay":"60","cursor_type":"two","background":"off"}' data-responsive_offset="on" data-frames='[{"from":"y:50px;sX:1;sY:1;opacity:0;","speed":2500,"to":"o:1;","delay":500,"ease":"Power4.easeOut"},{"delay":"wait","speed":300,"to":"opacity:0;","ease":"nothing"}]' data-textAlign="['center','center','center','center']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 15; min-width: 640px; max-width: 640px; white-space: normal; font-size: 40px; line-height: 40px; font-weight: 400; color: rgba(255, 255, 255, 1.00);font-family:Georgia, serif;font-style:italic;border-width:0px;">Dedicated. Inspired. Passionate.-->
                    <!--    </div>-->

                        <!-- LAYER NR. 12 -->


                        <!-- LAYER NR. 13 -->


                        <!-- LAYER NR. 14 -->
                    <!--    <div class="tp-caption rev-btn  tp-resizeme" id="slide-2801-layer-5" data-x="['left','left','center','center']" data-hoffset="['500','550','0','0']" data-y="['middle','middle','middle','middle']" data-voffset="['340','340','224','207']" data-width="none" data-height="none" data-whitespace="nowrap" data-type="button" data-actions='[{"event":"click","action":"scrollbelow","offset":"px","delay":""}]' data-responsive_offset="on" data-frames='[{"from":"x:50px;opacity:0;","speed":2500,"to":"o:1;","delay":500,"ease":"Power4.easeOut"},{"delay":"wait","speed":300,"to":"opacity:0;","ease":"nothing"},{"frame":"hover","speed":"150","ease":"Power2.easeInOut","to":"o:1;rX:0;rY:0;rZ:0;z:0;","style":"c:rgba(0, 0, 0, 1.00);bg:rgba(255, 255, 255, 1.00);bc:rgba(255, 255, 255, 0);bw:2px 2px 2px 2px;"}]' data-textAlign="['left','left','left','left']" data-paddingtop="[0,0,0,0]" data-paddingright="[50,50,50,50]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[50,50,50,50]" style="z-index: 18; white-space: nowrap; font-size: 18px; line-height: 46px; font-weight: 700; color: rgba(255, 255, 255, 1.00);font-family:Arial, Helvetica, sans-serif;background-color:rgba(0, 0, 0, 0);border-color:rgba(255, 255, 255, 0.25);border-style:solid;border-width:2px;border-radius:4px 4px 4px 4px;outline:none;box-shadow:none;box-sizing:border-box;-moz-box-sizing:border-box;-webkit-box-sizing:border-box;letter-spacing:5px;cursor:pointer;">Join Presales-->
                    <!--    </div>-->
                    <!--</li>-->
                    <!-- SLIDE  -->
                    <!--<li data-index="rs-2802" data-transition="slidingoverlayhorizontal" data-slotamount="default" data-hideafterloop="0" data-hideslideonmobile="off" data-easein="default" data-easeout="default" data-masterspeed="default" data-thumb="assets/img/4.2.jpg" data-rotate="0" data-saveperformance="off" data-title="Slide" data-param1="" data-param2="" data-param3="" data-param4="" data-param5="" data-param6="" data-param7="" data-param8="" data-param9="" data-param10="" data-description="">-->
                        <!-- MAIN IMAGE -->
                    <!--    <img src="assets/img/4.jpg" alt="" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" class="rev-slidebg">-->
                        <!-- LAYERS -->

                        <!-- LAYER NR. 15 -->
                    <!--    <div class="tp-caption tp-shape tp-shapewrapper " id="slide-2802-layer-7" data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" data-y="['middle','middle','middle','middle']" data-voffset="['0','0','0','0']" data-width="full" data-height="full" data-whitespace="nowrap" data-type="shape" data-basealign="slide" data-responsive_offset="off" data-responsive="off" data-frames='[{"from":"opacity:0;","speed":1000,"to":"o:1;","delay":0,"ease":"Power4.easeOut"},{"delay":"wait","speed":1000,"to":"opacity:0;","ease":"Power4.easeOut"}]' data-textAlign="['left','left','left','left']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 19;background-color:rgba(0, 0, 0, 0.50);border-color:rgba(0, 0, 0, 0);border-width:0px;"></div>-->

                        <!-- LAYER NR. 16 -->
                    <!--    <div class="tp-caption   tp-resizeme" id="slide-2802-layer-1" data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" data-y="['middle','middle','middle','middle']" data-voffset="['-80','-81','-171','-146']" data-fontsize="['100','100','70','60']" data-lineheight="['100','100','70','50']" data-width="['760','760','none','360']" data-height="none" data-whitespace="['normal','normal','nowrap','normal']" data-type="text" data-typewriter='{"lines":"","enabled":"on","speed":"60","delays":"1%7C100","looped":"on","cursorType":"one","blinking":"on","word_delay":"off","sequenced":"on","hide_cursor":"off","start_delay":"1500","newline_delay":"1000","deletion_speed":"20","deletion_delay":"1000","blinking_speed":"500","linebreak_delay":"60","cursor_type":"two","background":"off"}' data-responsive_offset="on" data-frames='[{"from":"y:50px;sX:1;sY:1;opacity:0;","speed":2500,"to":"o:1;","delay":500,"ease":"Power4.easeOut"},{"delay":"wait","speed":300,"to":"opacity:0;","ease":"nothing"}]' data-textAlign="['center','center','center','center']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 20; min-width: 760px; max-width: 760px; white-space: normal; font-size: 100px; line-height: 100px; font-weight: 700; color: rgba(255, 255, 255, 1.00);font-family:Arial, Helvetica, sans-serif;border-width:0px;letter-spacing:-5px;">It Always Seems-->
                    <!--        <br />Impossible-->
                    <!--        <br /> Until It's Done.-->
                    <!--    </div>-->

                        <!-- LAYER NR. 17 -->
                    <!--    <div class="tp-caption tp-shape tp-shapewrapper  tp-resizeme" id="slide-2802-layer-3" data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" data-y="['middle','middle','middle','middle']" data-voffset="['96','96','-35','-19']" data-width="60" data-height="3" data-whitespace="nowrap" data-type="shape" data-responsive_offset="on" data-frames='[{"from":"y:50px;opacity:0;","speed":2500,"to":"o:1;","delay":5000,"ease":"Power4.easeOut"},{"delay":"wait","speed":300,"to":"opacity:0;","ease":"nothing"}]' data-textAlign="['left','left','left','left']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 21;background-color:rgba(0, 220, 186, 1.00);border-color:rgba(0, 0, 0, 0);border-width:0px;"></div>-->

                        <!-- LAYER NR. 18 -->
                    <!--    <div class="tp-caption   tp-resizeme" id="slide-2802-layer-2" data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" data-y="['middle','middle','middle','middle']" data-voffset="['144','144','12','18']" data-fontsize="['40','40','30','30']" data-width="['640','640','480','360']" data-height="none" data-whitespace="normal" data-type="text" data-responsive_offset="on" data-frames='[{"from":"y:50px;sX:1;sY:1;opacity:0;","speed":2500,"to":"o:1;","delay":5000,"ease":"Power4.easeOut"},{"delay":"wait","speed":300,"to":"opacity:0;","ease":"nothing"}]' data-textAlign="['center','center','center','center']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 22; min-width: 640px; max-width: 640px; white-space: normal; font-size: 40px; line-height: 40px; font-weight: 400; color: rgba(255, 255, 255, 1.00);font-family:Georgia, serif;font-style:italic;border-width:0px;">Nelson Mandela-->
                    <!--    </div>-->

                        <!-- LAYER NR. 19 -->
                    <!--    <div class="tp-caption rev-btn  tp-resizeme" id="slide-2802-layer-4" data-x="['right','right','center','center']" data-hoffset="['495','550','0','0']" data-y="['middle','middle','middle','middle']" data-voffset="['340','340','100','93']" data-width="none" data-height="none" data-whitespace="nowrap" data-type="button" data-actions='[{"event":"click","action":"scrollbelow","offset":"px","delay":""}]' data-responsive_offset="on" data-frames='[{"from":"x:-50px;opacity:0;","speed":2500,"to":"o:1;","delay":5000,"ease":"Power4.easeOut"},{"delay":"wait","speed":300,"to":"opacity:0;","ease":"nothing"},{"frame":"hover","speed":"150","ease":"Power2.easeInOut","to":"o:1;rX:0;rY:0;rZ:0;z:0;","style":"c:rgba(0, 0, 0, 1.00);bg:rgba(255, 255, 255, 1.00);bc:rgba(255, 255, 255, 0);bw:2px 2px 2px 2px;"}]' data-textAlign="['left','left','left','left']" data-paddingtop="[0,0,0,0]" data-paddingright="[50,50,50,50]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[50,50,50,50]" style="z-index: 23; white-space: nowrap; font-size: 18px; line-height: 46px; font-weight: 700; color: rgba(255, 255, 255, 1.00);font-family:Arial, Helvetica, sans-serif;background-color:rgba(0, 0, 0, 0);border-color:rgba(255, 255, 255, 0.25);border-style:solid;border-width:2px;border-radius:4px 4px 4px 4px;outline:none;box-shadow:none;box-sizing:border-box;-moz-box-sizing:border-box;-webkit-box-sizing:border-box;letter-spacing:5px;cursor:pointer;">Join Presales-->
                    <!--    </div>-->

                        <!-- LAYER NR. 20 -->


                        <!-- LAYER NR. 21 -->

                    <!--</li>-->
                </ul>


                <!-- LAYER NR. 39 -->

                <!-- LAYER NR. 40 -->


                <!-- LAYER NR. 41 -->
                <div class="tp-bannertimer tp-bottom" style="visibility: hidden !important;"></div>
            </div>
        </div>
        <!-- END REVOLUTION SLIDER -->
    </section>





    <!-- Section Content -->
    <section id="investor" class="g-py-30 g-py-30--md g-pt-60--md g-pt-60">
        <div class="container text-center u-bg-overlay__inner">
            <div class="text-uppercase text-center u-heading-v2-3--bottom g-brd-primary g-mb-20">
                <h2 class="u-heading-v2__title g-font-weight-200 mb-0">ΓΕΜΙΣΤΕ ΤΗΝ ΤΣΕΠΗ ΣΑΣ ΜΕ FILLIT</h2>
            </div>
            <div class="col-lg-8 offset-lg-2 timer-area">

                <h3 class="text-center top-heading">Η πρώτη περίοδος προπώλησης κλείνει σε</h3>

                <div class="clock"></div>
                <div class="message"></div>
            </div>
            <div class="row">
                <div class="col-sm-12 g-py-30 g-py-30--md" data-animation="fadeInRight" data-animation-duration="1750">
                    <ul class="token-info text-center ">
                        <li>
                            <h2 class="h1">Συνολικά Tokens που αγοράστηκαν,</h2>
                        </li>
                        <li>
                        <h2><?php echo number_format($date[0]['xo']+3000000, 0, '.', ','); ?></h2>
                    </li>
                    <li><small>1 FILL = 0.08 EUR</small>
                    </li>
                </ul>

                <a href="https://www.fillit.eu/ico/account/Register" class="btn btn-md u-btn-outline-red u-btn-hover-v2-2 g-font-weight-300 g-letter-spacing-0_5 text-uppercase g-brd-2 g-rounded-50 g-mb-15">
  Αγοράστε Tokens <i class="fa fa-hand-o-up g-ml-3"></i>
</a>


                    <p class="g-mb-30">Τα μπόνους θα εξαρτηθούν από τον όγκο των ICO που αγοράζετε. Η κλίμακα είναι προοδευτική. Όσα περισσότερα ICO αγοράζετε σε μία συναλλαγή το υψηλότερο ποσοστό μπόνους θα λάβετε.
                    </p>

                </div>
            </div>
        </div>

    </section>
    <!-- End Section Content -->



    <section class="bg-image-area g-py-40 g-py-80--md" style="background-image: url('assets/img/card.jpg');">

        <div class="container text-center g-py-50--md g-py-20">
            <h2 class="h2 text-uppercase g-font-weight-300">Επισκεφτείτε την κύρια ιστοσελίδα μας
            </h2>
            <p class="lead g-px-100--md g-mb-20">
                www.fillit.eu</p>

            <a href="https://www.fillit.eu/index.php" class="btn btn-md u-btn-red u-btn-hover-v1-4 g-font-weight-300 g-letter-spacing-0_5 text-uppercase g-brd-2 g-rounded-50 g-mr-10 g-mb-15">
                <i class="fa fa-check-circle g-mr-3"></i> Visit
            </a>

        </div>
    </section>


    <!-- Section Content -->
    <section id="whyWe">
        <div class="container-fluid px-0">
            <div class="row no-gutters">
                <div class="col-md-6 d-flex g-theme-bg-gray-light-v4 g-py-30 g-py-0--md g-px-30">
                    <div class="align-self-center" data-animation="fadeInLeft" data-animation-duration="1750">
                        <div class="text-uppercase u-heading-v2-3--bottom g-brd-primary g-mb-20">
                            <h3 class="g-font-weight-300 g-font-size-30 g-color-primary g-mb-0"><span class="sp-font">FILLIT</span></h3>
                            <h2 class="u-heading-v2__title g-font-weight-200 mb-0">ΣΗΜΕΡΑ ΚΑΙ ΑΥΡΙΟ</h2>
                        </div>

                        <p class="g-mb-10">Συνδέει το παρόν και το μέλλον
                            Η Fillit είναι μια σύγχρονη τέχνη, μια εύκολη και βολική υπηρεσία, διαθέσιμη από οποιαδήποτε συσκευή με πλήρως λειτουργική διαδικτυακή έκδοση Android ή/και iOS. Οι χρήστες διαθέτουν ένα Fillit πορτοφόλι πολλών νομισμάτων FIAT και ένα ιδιωτικό κλειδί το οποίο φυλάσσεται για να προστατεύει τα κεφάλαιά τους. Το  Fillit wallet μπορεί να φορτωθεί άμεσα με κρυπτονομίσματα.
                        </p>

                        <p class="g-mb-10">Με τηv καινοτομία της Fillit Crypto/Debit Visa Card τα κρυπτονομίσματα γίνονται διαθέσιμα για οποιονδήποτε, με χαρακτηριστικά όπως η ενισχυμένη ασφάλεια και η απλότητα χρήσης, που την καθιστούν άψογη. Οι χρήστες μπορούν να φορτώσουν την κάρτα τους από το πορτοφόλι τους και να επιλέξουν μεταξύ διαφόρων κρυπτονομισμάτων (BTC, ETH, ERC20, κ.λπ.) για την πραγματοποίηση των πληρωμών τους.</p>
                        <p class="g-mb-10">Η Fillit επιδιώκει την αξιοπιστία και την διάρκεια. Για αυτόν το λόγο ανταμείβει τους κατόχους του FILLIT ICO μετά από κάθε πληρωμή που πραγματοποιούν οι χρήστες της Fillit Crypto/Debit Visa Card στο σύνολό τους.
                        </p>
                        <p class="g-mb-10">Η Fillit διαθέτει πλέον το δικό της ICO (FILLIT ICO) το οποίο πρόκειται να ξεκινήσει τον Νοέμβριο του 2017 με αρχική αξία πώλησης 0,04 Ευρώ ανά FILLIT ICO.
                            Μπορείτε να μας στείλετε τις παραγγελίες σας στο
                            <em style="color: #e74c3c;">co@fillitcrowd.eu</em>
                        </p>

                    </div>
                </div>

                <div class="col-md-6">
                    <div class="g-parent g-theme-bg-gray-dark-v1 g-theme-bg-gray-dark-v2--hover g-overflow-x-hidden g-brd-bottom g-theme-brd-gray-dark-v4 g-transition-0_2 g-transition--ease-in">
                        <!-- Icon Blocks -->
                        <article class="media d-block d-md-flex text-center text-md-left g-py-30 g-py-70--md g-pl-30 g-pl-60--md g-pr-30" data-animation="fadeInRight" data-animation-duration="1750">
                            <div class="d-md-flex align-self-center g-mb-30 g-mb-0--md g-mr-30--md">
                            <span class="u-icon-v2 u-icon-size--2xl g-color-primary-dark-v1 g-brd-4 g-theme-brd-gray-dark-v3 g-brd-primary-dark--parent-hover g-rounded-50x">
                      <i class="icon-line icon-magic-wand g-font-size-35"></i>
                    </span>
                            </div>

                            <div class="media-body align-self-center">
                                <h3 class="h6 text-uppercase g-font-weight-300 g-font-secondary g-color-white">Branding and identity</h3>
                                <p class="g-color-white-opacity-0_5 mb-0">Εδώ είναι η θρυλική καινοτομία στο ICO
                                    Επενδύσεις μέσω της απλής χρήσης των κρυπτονομισμάτων


                                </p>
                            </div>
                        </article>
                        <!-- End Icon Blocks -->
                    </div>

                    <div class="g-parent g-theme-bg-gray-dark-v1 g-theme-bg-gray-dark-v2--hover g-overflow-x-hidden g-brd-bottom g-theme-brd-gray-dark-v4 g-transition-0_2 g-transition--ease-in">
                        <!-- Icon Blocks -->
                        <article class="media d-block d-md-flex text-center text-md-left g-py-30 g-py-70--md g-pl-30 g-pl-60--md g-pr-30" data-animation="fadeInRight" data-animation-duration="1750">
                            <div class="d-md-flex align-self-center g-mb-30 g-mb-0--md g-mr-30--md">
                            <span class="u-icon-v2 u-icon-size--2xl g-color-primary-dark-v1 g-brd-4 g-theme-brd-gray-dark-v3 g-brd-primary-dark--parent-hover g-rounded-50x">
                      <i class="icon-line icon-globe-alt g-font-size-35"></i>
                    </span>
                            </div>

                            <div class="media-body align-self-center">
                                <h3 class="h6 text-uppercase g-font-weight-300 g-font-secondary g-color-white">FILLIT Worldwide</h3>
                                <p class="g-color-white-opacity-0_5 mb-0">Η Fillit είναι το συνώνυμο των συναλλαγών παγκοσμίως και προσφέρει ευελιξία, ελευθέρια, ταχύτητα και οικονομία.</p>
                            </div>
                        </article>
                        <!-- End Icon Blocks -->
                    </div>

                    <div class="g-parent g-theme-bg-gray-dark-v1 g-theme-bg-gray-dark-v2--hover g-overflow-x-hidden g-transition-0_2 g-transition--ease-in">
                        <!-- Icon Blocks -->
                        <article class="media d-block d-md-flex text-center text-md-left g-py-30 g-py-70--md g-pl-30 g-pl-60--md g-pr-30" data-animation="fadeInRight" data-animation-duration="1750">
                            <div class="d-md-flex align-self-center g-mb-30 g-mb-0--md g-mr-30--md">
                            <span class="u-icon-v2 u-icon-size--2xl g-color-primary-dark-v1 g-brd-4 g-theme-brd-gray-dark-v3 g-brd-primary-dark--parent-hover g-rounded-50x">
                      <i class="icon-line icon-target g-font-size-35"></i>
                    </span>
                            </div>

                            <div class="media-body align-self-center">
                                <h3 class="h6 text-uppercase g-font-weight-300 g-font-secondary g-color-white">FILLIT Goal</h3>
                                <p class="g-color-white-opacity-0_5 mb-0">Η Fillit πραγματοποιεί με ακρίβεια κάθε της στόχο και αναπτύσσεται σταθερά και δυναμικά.</p>
                            </div>
                        </article>
                        <!-- End Icon Blocks -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Section Content -->

    <section class="js-bg-video g-flex-centered g-height-500 g-color-white u-bg-overlay g-bg-black-opacity-0_6--after g-py-20" style="background-image: url(&quot;assets/img-temp/1920x1080/img1.jpg&quot;); position: relative;" data-hs-bgv-path="assets/media-temp/video-bg/video-bg" data-hs-bgv-loop="1">
        <video class="hs-html5 hs-bg-video" poster="" autoplay="" muted="" loop="">
            <source src="assets/media-temp/video-bg/video-bg.mp4" type="video/mp4"></source>
            <source src="assets/media-temp/video-bg/video-bg.webm" type="video/webm"></source>
            <source src="assets/media-temp/video-bg/video-bg.ogv" type="video/ogg"></source>Your browser doesn't support HTML5 video.
        </video>
        <div class="container u-bg-overlay__inner">
            <div class="row">
                <div class="col-md-6 offset-md-6 align-self-center g-py-20">
                    <div class="text-uppercase g-color-white u-heading-v2-3--bottom g-brd-primary g-mb-20">
                        <h2 class="h4 u-heading-v2__title g-color-white g-font-weight-200 mb-0">ΓΙΑ ΑΥΤΟΥΣ ΠΟΥ ΔΕΝ ΓΝΩΡΙΖΟΥΝ ΤΑ ICO</h2>
                    </div>
                    <p class="lead mb-0 g-line-height-2">Τώρα που, έννοιες όπως Ewallet, cryptocurrency, ICO, blockchain, DLN (Μηχανισμός Αποκέντρωσης) έχουν ενσφηνωθεί στο μυαλό σας, αρχίζει να γίνεται αντιληπτό ότι ξετυλίγεται μπροστά σας ένας νέος Online κόσμος επενδύσεων! Να είστε σίγουροι ότι ο πιο δίκαιος και διαφανής τρόπος επένδυσης είναι τa ICO και ιδιαιτέρως τα FILL ICO! Η Fillit, με απόλυτη συνείδηση, προσφέρει πρόσβαση σε όλες τις πληροφορίες που αφορούν στη δομή, στους συντελεστές, στις προμήθειες, κτλ, αρκεί να ανατρέξετε στο Whitepaper (link).  Θα χαρούμε να σας δώσουμε ακόμα περισσότερες πληροφορίες δια ζώσης (email).
                    </p>
                    <p class="lead mb-0 g-line-height-2">Εκμεταλλευτείτε την πληροφορία της αναδυόμενης βιομηχανίας των FILL ICO και κατακτήστε όσα μέχρι σήμερα αποφεύγατε!</p>
                </div>

            </div>
        </div>
    </section>




    <section class="promo-area g-flex-centered g-bg-primary g-color-white-opacity-0_9 g-py-30 ">
        <div class="container">
            <div class="row">
                <div class="col-md-6 align-self-center g-py-20">
                    <div class="text-uppercase g-color-white u-heading-v2-3--bottom g-brd-white g-mb-20" data-animation="fadeInUp" data-animation-delay="100" data-animation-duration="1000">
                        <h2 class="h4 u-heading-v2__title g-color-white g-font-weight-200 mb-0 ">ΓΙΑ ΤΗΝ ΨΗΦΙΑΚΗ ΠΑΡΑΓΩΓΗ ΤΗΣ ΑΝΑΠΤΥΞΗΣ ΤΟΥ BLOCKCHAIN</h2>
                    </div>
                    <div data-animation="fadeInUp" data-animation-delay="100" data-animation-duration="1000">
                        <p class="lead mb-0 g-line-height-2">Βελτιωμένες συνθήκες δαπανών, ταχύτατη αποστολή χρημάτων στο εξωτερικό και άλλες καινοτόμες υπηρεσίες! </p>
                        <p class="lead mb-0 g-line-height-2">Αν είστε επιχειρηματίας και συχνά κάνετε μαζικές πληρωμές, τότε η Fillit κι εσείς βαδίζετε στον ίδιο δρόμο!</p>
                        <p class="lead mb-0 g-line-height-2">Χάρη στην ισχυρή βάση για την ανάπτυξη προϊόντων πολλαπλών νομισμάτων, γεφυρώνουμε το κενό μεταξύ Crypto και Fiat νομισμάτων στην καθημερινή ζωή ακολουθώντας την αρχή της αποκέντρωσης.</p>
                        <p class="lead mb-0 g-line-height-2">Οι ρυθμίσεις πολλαπλών πληρωμών είναι ιδιαιτέρως χρήσιμες για εσάς δεδομένου ότι σας βοηθούν να κάνετε τις πληρωμές σε πολλούς δικαιούχους ταυτόχρονα εξοικονομώντας χρόνο, χρήμα και άλλες περιττές δαπάνες. </p>
                    </div>
                </div>

                <div class="col-md-6 align-self-center">
                    <img class="w-100 img-fluid img-thumbnail" src="assets/img/blackchain.jpg" alt="Iamge Description" data-animation="fadeInUp" data-animation-delay="150" data-animation-duration="1000">
                </div>
            </div>
        </div>
    </section>

    <section class="promo-area g-flex-centered g-bg-primary g-color-white-opacity-0_9 g-py-30">
        <div class="container">
            <div class="row direction-mb">
                <div class="col-md-6 align-self-center g-py-20  float-sm">

                    <div class="text-uppercase g-color-white u-heading-v2-3--bottom g-brd-white g-mb-20" data-animation="fadeInUp" data-animation-delay="100" data-animation-duration="2000">
                        <h2 class="h4 u-heading-v2__title g-color-white g-font-weight-200 mb-0">ΑΠΟΚΕΝΤΡΩΣΗ ΚΑΙ BLOCKCHAIN</h2>
                    </div>
                    <div data-animation="fadeInUp" data-animation-delay="150" data-animation-duration="1000">
                        <p class="lead mb-0 g-line-height-2">Ο αποκεντρωμένος μηχανισμός, που έχει αναπτύξει η Fillit για την πραγματοποίηση ευέλικτων και ταχύτερων πληρωμών, προσφέρει στους πελάτες επαρκή ρευστότητα και ελαχιστοποίηση οποιουδήποτε  κινδύνου αφορά αυτήν, χρησιμοποιώντας δίκτυο αποκεντρωμένης ρευστότητας (DLN). Εξαιτίας του DLN οι συμμετέχοντες στο δίκτυο αλληλοεπιδρούν με ασφάλεια μεταξύ τους και την ίδια στιγμή πραγματοποιούν πληρωμές με οποιοδήποτε στοιχείο blockchain και οποιοδήποτε νόμισμα, με τον ταχύτερο, φθηνότερο και πιο διαφανή τρόπο. </p>
                        <p class="lead mb-0 g-line-height-2">Το FILLIT ICO ήρθε για να επαναπροσδιορίσει τις έννοιες διαφάνεια, ταχύτητα συναλλαγών, νομισματική μετατροπή, μεταφορά κεφαλαίων!</p>
                    </div>
                </div>

                <div class="col-md-6 align-self-center g-py-20">
                    <img class="w-100 img-fluid img-thumbnail" src="assets/img/decent.jpg" alt="Iamge Description" data-animation="fadeInUp" data-animation-delay="250" data-animation-duration="1000">
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Info #01 -->
    <section class="text-center g-py-60--md g-py-70 what-ico-area">
        <div class="container">
            <div class="u-heading-v2-5--bottom g-brd-primary g-mb-30">
                <h2 class="u-heading-v2__title text-uppercase g-font-weight-300 mb-0">FILLIT ICO – ΤΙ ΕΙΝΑΙ</h2>
            </div>

            <p class="lead g-px-60--md g-mb-40">
                Το <span class="g-color-primary">FILLIT ICO</span> είναι μια δελεαστική πρόταση της Fillit προκειμένου να εξασφαλισθούν τα απαιτούμενα κεφάλαια για την περαιτέρω ανάπτυξη και διεύρυνση του έργου της. Η αγορά των FILLIT ICO είναι ένας ασφαλής τρόπος προσαύξησης των κεφαλαίων των, εν δυνάμει, επενδυτών και ταυτόχρονα ένας προσεκτικά καταγεγραμμένος τρόπος χρηματοδότησης και επέκτασης ενός υπάρχοντος προϊόντος και υπηρεσίας. Κάθε πώληση FILLIT ICO διέπεται από Όρους και Προϋποθέσεις και αποτελεί ξεχωριστό έγγραφο που περιγράφει τους όρους της συμφωνίας μεταξύ επενδυτών και των κατόχων FILLIT ICO.

                <img class="img-fluid" src="assets/img/maps/map1.png" alt="Image description">
        </div>
    </section>
    <!-- End Hero Info #01 -->



    <!-- Subscribe   -->
    <form autocomplete="off" action="https://fillitcrowd.us17.list-manage.com/subscribe/post?u=2d46739889581169f0d197a8c&amp;id=f7e1276bb0" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form"  target="_blank" novalidate>

        <section class="g-bg-primary-dark-v1 g-color-white g-pa-40 subscribe-area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7 align-self-center">

                        <h2 class="h4 text-uppercase g-font-weight-300 g-mb-20 g-mb-0--lg">Εγγραφείτε στο εβδομαδιαίο μας
                            <strong class="g-color-white">Newsletter</strong></h2>
                    </div>

                    <div class="col-lg-5 align-self-center">
                        <div class="input-group">
                            <div class="input-group-addon g-color-white g-bg-transparent g-brd-white rounded-0">
                                <i class="fa fa-envelope"></i>
                            </div>

                            <input name="EMAIL" class="form-control pl-0 u-form-control g-brd-left-none g-placeholder-white g-color-white g-bg-transparent g-bg-transparent--focus g-brd-white rounded-0 g-mr-15" placeholder="Γράψτε το email σας" type="text">
                            <div class="input-group-btn">
                                <input type="submit" class="btn btn-md u-btn-white u-btn-hover-v1-4 g-font-weight-300 g-letter-spacing-0_5 text-uppercase g-brd-2 g-rounded-50" value="Εγγραφείτε" >
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </form>
    <!-- Subscribe End  -->


    <!-- Hero Info #11 -->
    <section class="dzsparallaxer auto-init height-is-based-on-content use-loading mode-scroll" data-options="{direction: 'reverse', settings_mode_oneelement_max_offset: '150'}">
        <!-- Parallax Image -->
        <div class="divimage dzsparallaxer--target w-100 g-bg-repeat" style="height: 160%; background-image: url('assets/img/bg/pattern4.png'); transform: translate3d(0px, -306px, 0px);"></div>
        <!-- End Parallax Image -->

        <div class="container g-py-150--md g-py-80">
            <div class="row">
                <div class="col-md-6 align-self-center g-mb-60 g-mb-0--md">

                    <div class="text-uppercase g-color-balck u-heading-v2-3--bottom g-brd-primary g-mb-20">
                        <h2 class="h1 text-uppercase g-color-black g-font-weight-300 g-mb-0">ΜΕΡΙΔΙΟ ΚΕΡΔΟΥΣ</h2>
                    </div>
                    <p class="lead g-mb-30 g-color-black">Το 30% του εταιρικού κέρδους διανέμεται στους κατόχους Tokens. Κάθε κάτοχος λαμβάνει μερίδιο κέρδους ανάλογα με τον αριθμό των Tokens που αγοράστηκαν. Οι πληρωμές γίνονται στο Fillit wallet.</p>
                </div>
                <div class="col-md-6 align-self-center g-mb-60 g-mb-0--md">
                    <div class="text-uppercase g-color-balck u-heading-v2-3--bottom g-brd-primary g-mb-20">
                        <h2 class="h1 text-uppercase g-color-black g-font-weight-300 g-mb-0">ΟΙΚΟΝΟΜΙΚΗ ΑΝΑΦΟΡΑ</h2>
                    </div>
                    <p class="lead g-mb-30 g-color-black">Η πρόσβαση στις αναφορές καθορίζεται από τον αριθμό των αρχικά αγορασμένων Tokens. Οι συμμετέχοντες, οι οποίοι κατέχουν Tokens αξίας άνω των €30.000, έχουν πρόσβαση σε στατιστικά στοιχεία σε πραγματικό χρόνου της FILLIT ενώ οι ετήσιες αναφορές είναι διαθέσιμες στους υπόλοιπους κατόχους Tokens.</p>
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Info #11 -->

    <div class="tecno-area g-bg-lighgray-radialgradient-ellipse g-py-30--md g-py-30">
        <!-- Nav tabs -->


        <div class="container u-heading-v2-5--bottom g-brd-primary g-mb-30  text-center g-py-50--md g-py-20">
            <h2 class="u-heading-v2__title text-uppercase g-font-weight-300 mb-0">Η ΤΕΧΝΟΛΟΓΙΑ ΤΗΣ FILLIT</h2>
        </div>
        <div class="container">
            <ul class="nav u-nav-v8-2" role="tablist" data-target="nav-8-2-default-hor-left" data-tabs-mobile-type="slide-up-down" data-btn-classes="btn btn-md btn-block rounded-0 u-btn-darkgray">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#nav-8-2-default-hor-left--1" role="tab">
                    <span class="u-nav-v8__icon u-icon-v3 u-icon-size--lg g-rounded-50x g-brd-around g-brd-4 g-brd-white">
      <i class="fa fa-users"></i>
    </span>
                        <strong class="text-uppercase u-nav-v8__title">ΠΟΛΛΑΠΛΟΣ ΛΟΓΑΡΙΑΣΜΟΣ ΝΟΜΙΣΜΑΤΙΚΩΝ</strong>
                        <em class="u-nav-v8__description">ΛΟΓΑΡΙΑΣΜΩΝ ΓΙΑ ΤΡΑΠΕΖΙΚΕΣ ΜΕΤΑΦΟΡΕΣ</em>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#nav-8-2-default-hor-left--2" role="tab">
                    <span class="u-nav-v8__icon u-icon-v3 u-icon-size--lg g-rounded-50x g-brd-around g-brd-4 g-brd-white">
      <i class="fa fa-credit-card-alt"></i>
    </span>
                        <strong class="text-uppercase u-nav-v8__title">ΠΡΟΠΛΗΡΩΜΕΝΗ ΠΛΑΣΤΙΚΗ </strong>
                        <em class="u-nav-v8__description">ΧΡΕΩΣΤΙΚΗ ΚΑΡΤΑ VISA - FILLIT</em>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#nav-8-2-default-hor-left--3" role="tab">
                    <span class="u-nav-v8__icon u-icon-v3 u-icon-size--lg g-rounded-50x g-brd-around g-brd-4 g-brd-white">
      <i class="fa fa-cc-visa"></i>
    </span>
                        <strong class="text-uppercase u-nav-v8__title">ΕΙΚΟΝΙΚΗ ΧΡΕΩΣΙΚΗ</strong>
                        <em class="u-nav-v8__description">ΚΑΡΤΑ VISA – FILLIT</em>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#nav-8-2-default-hor-left--4" role="tab">
                    <span class="u-nav-v8__icon u-icon-v3 u-icon-size--lg g-rounded-50x g-brd-around g-brd-4 g-brd-white">
      <i class="fa fa-file-text"></i>
    </span>
                        <strong class="text-uppercase u-nav-v8__title">ΟΓΚΟΣ</strong>
                        <em class="u-nav-v8__description">ΠΛΗΡΩΜΩΝ</em>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#nav-8-2-default-hor-left--5" role="tab">
                    <span class="u-nav-v8__icon u-icon-v3 u-icon-size--lg g-rounded-50x g-brd-around g-brd-4 g-brd-white">
      <i class="fa fa-credit-card"></i>
    </span>
                        <strong class="text-uppercase u-nav-v8__title">ΠΛΗΡΩΜΕΣ ΣΕ </strong>
                        <em class="u-nav-v8__description">ΟΠΟΙΑΔΗΠΟΤΕ ΚΑΡΤΑ</em>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#nav-8-2-default-hor-left--6" role="tab">
                    <span class="u-nav-v8__icon u-icon-v3 u-icon-size--lg g-rounded-50x g-brd-around g-brd-4 g-brd-white">
      <i class="fa fa-superpowers"></i>
    </span>
                        <strong class="text-uppercase u-nav-v8__title">ΠΡΟΓΡΑΜΜΑ</strong>
                        <em class="u-nav-v8__description">ΣΥΝΕΡΓΑΤΩΝ (AFFILIATES)</em>
                    </a>
                </li>
            </ul>
            <!-- End Nav tabs -->

            <!-- Tab panes -->
            <div id="nav-8-2-default-hor-left" class="tab-content g-pt-20">
                <div class="tab-pane fade show active" id="nav-8-2-default-hor-left--1" role="tabpanel">

                    <p>Σας επιτρέπει να δέχεστε τραπεζικές μεταφορές χωρίς την αναγκαιότητα ανοίγματος τραπεζικού λογαριασμού</p>
                    <div class="row">
                        <div class="col-sm-12">
                            <ul class="list-unstyled g-color-gray-dark-v4 g-mb-30 g-mb-0--sm">
                                <li class="d-flex g-mb-10">
                                    <i class="icon-check g-color-primary g-mt-5 g-mr-10"></i> Πλήρως έμμεσο άνοιγμα λογαριασμών πολλών νομισμάτων
                                </li>
                                <li class="d-flex g-mb-10">
                                    <i class="icon-check g-color-primary g-mt-5 g-mr-10"></i> 0% προμήθεια για τραπεζικές μεταφορές
                                </li>
                                <li class="d-flex g-mb-10">
                                    <i class="icon-check g-color-primary g-mt-5 g-mr-10"></i> Μία πλήρη εναλλακτική λύση από τον παραδοσιακό τρέχοντα τραπεζικό λογαριασμό
                                </li>
                                <li class="d-flex g-mb-10">
                                    <i class="icon-check g-color-primary g-mt-5 g-mr-10"></i> Υψηλά όρια συναλλαγών
                                </li>
                                <li class="d-flex g-mb-10">
                                    <i class="icon-check g-color-primary g-mt-5 g-mr-10"></i> Δεν υπάρχουν τέλη εγκατάστασης και τα μηνιαία τέλη συντήρησης έχουν κόστος μόνο €1.00
                                </li>
                                <li class="d-flex g-mb-10">
                                    <i class="icon-check g-color-primary g-mt-5 g-mr-10"></i> Διαδικασία πλήρους ηλεκτρονικής αίτησης και έγκριση αυτής γίνεται εντός 48 ωρών
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="nav-8-2-default-hor-left--2" role="tabpanel">
                    <p>Πρόκειται για μια προπληρωμένη χρεωστική κάρτα Visa της Fillit, προσφέροντας απεριόριστη εμπειρία πληρωμών</p>

                    <div class="row">
                        <div class="col-sm-12">
                            <ul class="list-unstyled g-color-gray-dark-v4 g-mb-30 g-mb-0--sm">
                                <li class="d-flex g-mb-10">
                                    <i class="icon-check g-color-primary g-mt-5 g-mr-10"></i>	Νομίσματα USD, EUR, GBR
                                </li>
                                <li class="d-flex g-mb-10">
                                    <i class="icon-check g-color-primary g-mt-5 g-mr-10"></i> Ημερήσιο όριο ανάληψης σε ATM 2000 ευρώ ή ισοδύναμο 7 ημέρες την εβδομάδα
                                </li>
                                <li class="d-flex g-mb-10">
                                    <i class="icon-check g-color-primary g-mt-5 g-mr-10"></i> Άμεση πίστωση πληρωμών από το λογαριασμό Fillit
                                </li>
                                <li class="d-flex g-mb-10">
                                    <i class="icon-check g-color-primary g-mt-5 g-mr-10"></i> Φορτώστε την μέσω τραπεζικής μεταφοράς
                                </li>
                                <li class="d-flex g-mb-10">
                                    <i class="icon-check g-color-primary g-mt-5 g-mr-10"></i> Μόλις 2,25 ευρώ ανά ανάληψη σε ΑΤΜ
                                </li>
                                <li class="d-flex g-mb-10">
                                    <i class="icon-check g-color-primary g-mt-5 g-mr-10"></i> Η πιο οικονομική και αποδοτική λύση άμεσων πολλαπλών πληρωμών
                                </li>
                                <li class="d-flex g-mb-10">
                                    <i class="icon-check g-color-primary g-mt-5 g-mr-10"></i> Παράδοση σε 10 εργάσιμες ημέρες
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="nav-8-2-default-hor-left--3" role="tabpanel">
                    <p>Μια μοναδική επιλογή πληρωμών πολλαπλών νομισμάτων που επιτρέπει στους χρήστες να κάνουν online αγορές χωρίς κινδύνους</p>

                    <div class="row">
                        <div class="col-sm-12">
                            <ul class="list-unstyled g-color-gray-dark-v4 g-mb-30 g-mb-0--sm">
                                <li class="d-flex g-mb-10">
                                    <i class="icon-check g-color-primary g-mt-5 g-mr-10"></i> Άμεση έκδοση
                                </li>
                                <li class="d-flex g-mb-10">
                                    <i class="icon-check g-color-primary g-mt-5 g-mr-10"></i> Επαναφορτιζόμενη και ισχύει για 3 χρόνια
                                </li>
                                <li class="d-flex g-mb-10">
                                    <i class="icon-check g-color-primary g-mt-5 g-mr-10"></i> Μέγιστο υπόλοιπο 150.000 ευρώ
                                </li>
                                <li class="d-flex g-mb-10">
                                    <i class="icon-check g-color-primary g-mt-5 g-mr-10"></i> Συναλλαγές πολλαπλών νομισμάτων
                                </li>
                                <li class="d-flex g-mb-10">
                                    <i class="icon-check g-color-primary g-mt-5 g-mr-10"></i> Ασφαλείς online πληρωμές με 3D ασφάλεια
                                </li>
                                <li class="d-flex g-mb-10">
                                    <i class="icon-check g-color-primary g-mt-5 g-mr-10"></i> Οικονομικά αποδοτική λύση άμεσων πληρωμών
                                </li>
                                <li class="d-flex g-mb-10">
                                    <i class="icon-check g-color-primary g-mt-5 g-mr-10"></i> Άμεση χρηματοδότηση από το λογαριασμό πληρωμών Fillit
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="nav-8-2-default-hor-left--4" role="tabpanel">
                    <p>Μια βολική λύση που βοηθάει να εξοικονομήσετε χρόνο</p>


                    <div class="row">
                        <div class="col-sm-12">
                            <ul class="list-unstyled g-color-gray-dark-v4 g-mb-30 g-mb-0--sm">
                                <li class="d-flex g-mb-10">
                                    <i class="icon-check g-color-primary g-mt-5 g-mr-10"></i> 0.25€ τέλος μεταφοράς σε άλλους λογαριασμούς Fillit σε όλο τον κόσμο
                                </li>
                                <li class="d-flex g-mb-10">
                                    <i class="icon-check g-color-primary g-mt-5 g-mr-10"></i> Υψηλά όρια συναλλαγών
                                </li>
                                <li class="d-flex g-mb-10">
                                    <i class="icon-check g-color-primary g-mt-5 g-mr-10"></i> Μεταφορές πολλαπλών νομισμάτων
                                </li>
                                <li class="d-flex g-mb-10">
                                    <i class="icon-check g-color-primary g-mt-5 g-mr-10"></i> Πληρωμές σε τραπεζικούς λογαριασμούς
                                </li>
                                <li class="d-flex g-mb-10">
                                    <i class="icon-check g-color-primary g-mt-5 g-mr-10"></i> Πληρωμές σε Fillit προπληρωμένες κάρτες
                                </li>
                                <li class="d-flex g-mb-10">
                                    <i class="icon-check g-color-primary g-mt-5 g-mr-10"></i> Καθημερινή υποστήριξη
                                </li>
                                <li class="d-flex g-mb-10">
                                    <i class="icon-check g-color-primary g-mt-5 g-mr-10"></i> Φιλική προς τον χρήστη με απλό περιβάλλον
                                </li>
                                <li class="d-flex g-mb-10">
                                    <i class="icon-check g-color-primary g-mt-5 g-mr-10"></i> Ένας εύκολος τρόπος για όλους για πληρωμές μισθών και πληρωμές των εταιρειών που συνδέονται
                                </li>
                                <li class="d-flex g-mb-10">
                                    <i class="icon-check g-color-primary g-mt-5 g-mr-10"></i> Μεταφόρτωση λίστας επαφών σε μορφή xls ή csv
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="nav-8-2-default-hor-left--5" role="tabpanel">
                    <p>Μία χρήσιμη επιλογή για την κρυπτο-κοινότητα που σας επιτρέπει πληρωμές σε κρυπτονομίσματα σχεδόν σε οποιαδήποτε κάρτα VISA/MASTERCARD παγκοσμίως.</p>


                    <div class="row">
                        <div class="col-sm-12">
                            <ul class="list-unstyled g-color-gray-dark-v4 g-mb-30 g-mb-0--sm">
                                <li class="d-flex g-mb-10">
                                    <i class="icon-check g-color-primary g-mt-5 g-mr-10"></i> Δεν απαιτείται εγγραφή
                                </li>
                                <li class="d-flex g-mb-10">
                                    <i class="icon-check g-color-primary g-mt-5 g-mr-10"></i> Όριο συναλλαγών έως 2000 ευρώ έως 5 συναλλαγές την ημέρα
                                </li>
                                <li class="d-flex g-mb-10">
                                    <i class="icon-check g-color-primary g-mt-5 g-mr-10"></i> Δεν χρειάζεται να εγκαταστήσετε κάποιο άλλο λογισμικό
                                </li>
                                <li class="d-flex g-mb-10">
                                    <i class="icon-check g-color-primary g-mt-5 g-mr-10"></i> Άμεση επεξεργασία και διακανονισμός εντός 1-3 ημερών
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="nav-8-2-default-hor-left--6" role="tabpanel">
                    <p>Είναι ένα εργαλείο που επιτρέπει στους συνεργάτες να αποκομίσουν κέρδη προωθώντας το Fillit. Αυτό το πρόγραμμα μπορεί να είναι ενδιαφέρον για τους κατόχους ιστοσελίδων ή blogs, και συνεργατών, καθώς και για όσους περνούν πολύ χρόνο σε κοινωνικά δίκτυα, φόρουμ, συζητήσεις κτλ.</p>


                    <div class="row">
                        <div class="col-sm-12">
                            <ul class="list-unstyled g-color-gray-dark-v4 g-mb-30 g-mb-0--sm">
                                <li class="d-flex g-mb-10">
                                    <i class="icon-check g-color-primary g-mt-5 g-mr-10"></i> Διαθέσιμο τόσο για μεμονωμένους όσο και για εταιρικούς συνεργάτες
                                </li>
                                <li class="d-flex g-mb-10">
                                    <i class="icon-check g-color-primary g-mt-5 g-mr-10"></i> Μπορείτε να κερδίσετε το 15% των εσόδων από υπηρεσίες για κάθε πελάτη που προσελκύετε
                                </li>
                                <li class="d-flex g-mb-10">
                                    <i class="icon-check g-color-primary g-mt-5 g-mr-10"></i> Μπορείτε να κερδίσετε το 20% των εσόδων από υπηρεσίες για εταιρικούς λογαριασμούς
                                </li>
                                <li class="d-flex g-mb-10">
                                    <i class="icon-check g-color-primary g-mt-5 g-mr-10"></i> Πληρωθείτε για κάθε δραστηριότητα κέρδους χρημάτων μέσω της ανταλλαγής πληροφοριών σχετικά με το Fillit
                                </li>
                                <li class="d-flex g-mb-10">
                                    <i class="icon-check g-color-primary g-mt-5 g-mr-10"></i> Έτοιμο περιεχόμενο για κοινή χρήση με ενσωματωμένο δικό σας σύνδεσμο παραπομπής (affiliate link)
                                </li>
                                <li class="d-flex g-mb-10">
                                    <i class="icon-check g-color-primary g-mt-5 g-mr-10"></i> Τα χρήματα που κερδίζονται κατατίθενται αυτόματα στο υπόλοιπό σας στις 5 κάθε μήνα
                                </li>
                                <li class="d-flex g-mb-10">
                                    <i class="icon-check g-color-primary g-mt-5 g-mr-10"></i> Τα κέρδη μπορούν να μεταφερθούν σε τραπεζικό λογαριασμό ή στο πορτοφόλι Fillit
                                </li>
                                <li class="d-flex g-mb-10">
                                    <i class="icon-check g-color-primary g-mt-5 g-mr-10"></i> Προσαρμοσμένες συνθήκες για συνεργάτες και παρουσιαστές μεγάλου όγκου συναλλαγών
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Tab panes -->

    </div>

    <!-- Partner -->
    <section class="clients-area g-pt-30 g-pt-80--md">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="text-uppercase text-center u-heading-v2-3--bottom g-brd-primary g-mb-20">
                        <h2 class="u-heading-v2__title g-font-weight-200 mb-0">Οι συνεργάτες μας</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div id="carousel3" class="js-carousel" data-autoplay="1" data-slides-show="1">
        <div class="js-slide g-brd-around g-brd-gray-light-v3--hover g-transition-0_2 rounded g-pa-20 g-mx-10">

            <!-- Testimonials Advanced -->
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="text-center">
                        <a href = "https://www.wavecrest.gi/">
                        <img class="mx-auto g-width-200" src="assets/img/wavecrest.jpg" alt="Image Description">
                        </a>

                        <blockquote class="lead g-line-height-1_8 g-mb-25">" Ευχαριστούμε πάρα πολύ για την μέχρι τώρα άψογη συνεργασία μας. Είστε οι άνθρωποι που μπορεί κάποιος να βασίζεται σε αυτούς και πραγματικά πιστεύουμε πως αυτή η σχέση μεταξύ μας δεν θα σταματήσει να υφίσταται. Σας ευχαριστούμε και πάλι πολύ για τις υπηρεσίες σας και το ενδιαφέρον σας για εμάς. "</blockquote>

                        <div class="js-rating align-self-center g-color-yellow" data-rating="5" data-spacing="5" data-backward-icons-classes="fa fa-star"></div>
                    </div>
                </div>
            </div>
            <!-- End Partner Advanced -->
        </div>

        <div class="js-slide g-brd-around g-brd-gray-light-v3--hover g-transition-0_2 rounded g-pa-20 g-mx-10">

            <!-- Partner Advanced -->
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="text-center">
                        <br>
                        <a href = "https://www.infobip.com/">
                        <img class="mx-auto g-width-200" src="https://www.infobip.com/assets/img/infobip-logo-white.svg" alt="Image Description">
                        </a>
                        <br>    
                        <blockquote class="lead g-line-height-1_8 g-mb-25">" Εκτιμούμε τις συνδυασμένες προσπάθειες όλων σας και σας ευχαριστούμε για την επιτυχία σας στο να βοηθήσετε να φέρουμε την εταιρεία μας στην κορυφή. Με τη σκληρή δουλειά σας το έχουμε επιτύχει αυτό. "</blockquote>
                        <br>    
                        <div class="js-rating align-self-center g-color-yellow" data-rating="5" data-spacing="5" data-backward-icons-classes="fa fa-star"></div>
                        <br>
                    </div>
                </div>
            </div>
            <!-- End Partner Advanced -->
        </div>

        <div class="js-slide g-brd-around g-brd-gray-light-v3--hover g-transition-0_2 rounded g-pa-20 g-mx-10">
            
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="text-center">
                        <img class="mx-auto g-width-200" src="assets/img/caf solutions.png" alt="Image Description">


                        <blockquote class="lead g-line-height-1_8 g-mb-25">" Με μεγάλη ευτυχία, εκτιμούμε τον ενθουσιασμό που δείξατε για την εταιρεία μας. Σας ευχαριστούμε όλους για την ενεργό συμμετοχή και την επιτυχημένη προσπάθεια. "</blockquote>

                        <div class="js-rating align-self-center g-color-yellow" data-rating="5" data-spacing="5" data-backward-icons-classes="fa fa-star"></div>
                    </div>
                </div>
            </div>
            
        </div>

        <div class="js-slide g-brd-around g-brd-gray-light-v3--hover g-transition-0_2 rounded g-pa-20 g-mx-10">

            
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="text-center">\
                        <a href = "http://www.glbdigital.eu/">
                        <img class="mx-auto g-width-200" src="assets/img/global.png" alt="Image Description">
                        </a>
                        <br>
                        <blockquote class="lead g-line-height-1_8 g-mb-25">" Παρακαλούμε να δεχθείτε την ειλικρινή ευγνωμοσύνη μας για την εργασία σας. Η καθημερινή σας προώθηση μας δείχνει πόσο σας ενδιαφέρει. Αυτό το γεγονός μας έχει φέρει όλους πιο κοντά και είμαστε ευγνώμονες που έχουμε έναν εταίρο σαν εσάς. "</blockquote>

                        <div class="js-rating align-self-center g-color-yellow" data-rating="5" data-spacing="5" data-backward-icons-classes="fa fa-star"></div>
                    </div>
                </div>
            </div>
        </div> 
    </div>



    <!-- Partner END -->


<?php include 'footer.php';?>