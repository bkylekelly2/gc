<?php

$hostname = gethostname();
if ($hostname=='zeus'){
    $variable = 'default';
} else {
    $variable = 'globalchange';
}

$node_type = "featured_indicators"; // can find this on the node type's "edit" screen in the Drupal admin section.

$nid = db_query("SELECT nid FROM {node} WHERE type = :type", array(':type' => $node_type))->fetchCol();
$nodeID = $nid[0];
$catalog = "/browse/indicators/catalog";
$node = node_load_multiple($nid);

$image_caption = 'Long-term observations provide evidence of warming in the climate system and the effects of increasing atmospheric greenhouse gas concentrations. This figure shows several climate-relevant indicators of change based on data collected across the United States. <a href="https://nca2018.globalchange.gov/chapter/1/" target="_blank">(NCA4, Overview Chapter)</a>';


if ( is_object( $node[$nodeID] ) ) {
    $node = get_object_vars($node[$nodeID]);
}

for ($x = 0; $x <= (count($node['field_featured_indicator']['und'])-1); $x++) {
    $featured_indicators [] = $node['field_featured_indicator']['und'][$x]['target_id'];
}

foreach ($featured_indicators as $nid) {
    $node = node_load($nid);

    if ( is_object( $node ) ) {
        $node = get_object_vars($node);
    }

    $title[]=$node['title'];
    $fid = $node['field_indicator_card']['und'][0]['fid'];
    $file = file_load($fid);
    $uri = $file->uri;
    if (count($node['field_indicator_card']['und']>0)) {
        $image_url[] = file_create_url($uri);
    }
    $alias[] = "browse/indicator-details/".$nid;
    $image_alt = $node['field_indicator_image']['und'][0]['alt'];
}

$timestamp = time();

?>

<link rel="stylesheet" href="/sites/<?php echo $variable;?>/modules/custom/globalchange_indicators_custom/css/styles.css?v=<?php echo $timestamp; ?>" />

<link rel="stylesheet" href="/sites/<?php echo $variable;?>/modules/custom/globalchange_indicators_custom/css/interactive_map.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
    $("a[href^="#").on("click", function( e ) {

    e.preventDefault();

    $("body, html").animate({
        scrollTop: $( $(this).attr('href') ).offset().top
    }, 600);

    });
</script>



<div class="outer" style="margin-top:30px;">


             <div class='gc_landing_page_bread_crumb' >
                <nav class="breadcrumb" role="navigation"><h2 class="breadcrumb__title">You are here</h2>
                    <ul class="breadcrumb__list">
                        <li class="breadcrumb__item">
                            <a href="/browse">Browse &amp; Find</a>
                        </li>
                        <li class="breadcrumb__item">
                            <a href="/browse/indicators">USGCRP Indicator Platform</a>
                        </li>
                    </ul>
                </nav>
            </div>

        <div class="gc_top">

            <div class="gc_landing_page_heading gc_top_heading"><h2>USGCRP Indicator Platform</h2></div>

            <div class="contextual-links-region pane pane--service-links-service-links-not-node gc_top_share">
                <h2 class="pane__title">Share</h2>
                <div class="pane__content">
                    <div class="service-links"><a href="http://www.facebook.com/sharer.php?u=http%3A//bit.ly/2z2ML9u&amp;t=" title="Share on Facebook" class="service-links-facebook" rel="nofollow" target="_blank"><img src="/sites/all/modules/contrib/service_links/images/facebook.png" alt="Facebook logo" /></a> <a href="http://twitter.com/share?url=http%3A//bit.ly/2z2ML9u&amp;text=" title="Share this on Twitter" class="service-links-globalchange-twitter" rel="nofollow" target="_blank"><img src="/sites/all/modules/contrib/service_links/images/twitter.png" alt="Twitter logo" /></a> <a href="https://plus.google.com/share?url=http%3A//bit.ly/2z2ML9u" title="Share this on Google+" class="service-links-google-plus" rel="nofollow" target="_blank"><img src="/sites/all/modules/contrib/service_links/images/google_plus.png" alt="Google+ logo" /></a> <a href="http://www.linkedin.com/shareArticle?mini=true&amp;url=http%3A//bit.ly/2z2ML9u&amp;title=&amp;summary=&amp;source=GlobalChange.gov" title="Submit this post on LinkedIn" class="service-links-globalchange-linkedin" rel="nofollow" target="_blank"><img src="/sites/all/modules/contrib/service_links/images/linkedin.png" alt="LinkedIn logo" /></a> <a href="http://reddit.com/submit?url=http%3A//bit.ly/2z2ML9u&amp;title=" title="Submit this post on reddit.com" class="service-links-globalchange-reddit" rel="nofollow" target="_blank"><img src="/sites/all/modules/contrib/service_links/images/reddit.png" alt="Reddit logo" /></a>
                    </div>
                </div>
            </div>

        </div>

    <div class="gc_indicator_landing_page_hero show_when_stacked"><img src="/sites/<?php echo $variable; ?>/modules/custom/globalchange_indicators_custom/images/heavy_precipitation_card.jpg"></div>


    <div class="two_column_row two_column_row_top">
            <div class="two_column">
                <div class="">The indicator platform is an interagency collaboration that leverages efforts from across the USGCRP agencies and highlights key climate information in the form of indicators that:</div>

                <ul>
                    <li>Provide foundational science in support of USGCRP  sustained assessment products including the <a href="https://nca2018.globalchange.gov/" target="_blank">National Climate Assessment</a></li>
                    <li>Showcase examples from Federal agency-specific indicator efforts </li>
                    <li>Connect Federal agency research and science to USGCRP priorities </li>
                </ul>

            </div>
            <div class="two_column" >
                <div class="gc_indicator_landing_page_hero show_when_not_stacked"><img src="/sites/<?php echo $variable; ?>/modules/custom/globalchange_indicators_custom/images/heavy_precipitation_card.jpg"></div>
            </div>
        </div>

        <div class="pane pane--globalchange-general-custom-pane ">
            <div class="pane__content">
                <div id="features-jump-links" class="negative_top">

                    <div class="jump-link jump-link-label">JUMP TO →</div>
                    <div class="jump-link"><a href="#indicators_of_change">Indicators of Change</a></div>
                    <div class="jump-link"><a href="#explore_usgcrp_indicators">USGCRP Indicators</a></div>
                    <div class="jump-link"><a href="#federal_indicators">Federal Indicators of Change</a></div>
                </div>

            </div>

        </div>

        <div class="margin-top" id="indicators_of_change">
            <div ><h3>Indicators of Change</h3></div>
        </div>

        <div class="two_column_row " >
            <div class="two_column ">
                <div class="">Climate indicators show trends over time in key aspects of our environment including:</div>

                <ul>
                    <li><a href="/browse/indicators/indicator-annual-greenhouse-gas-index">Greenhouse gas levels in the atmosphere</a></li>
                    <li><a href="/browse/indicators/indicator-global-surface-temperatures">Temperatures across land and sea</a></li>
                    <li><a href="/browse/indicators/indicator-arctic-sea-ice-extent">Extent of Arctic sea ice</a></li>
                </ul>

            </div>
            <div class="two_column " >
                <div class="">Indicators based on long-term, consistently collected data can be used to:</div>

                <ul>
                    <li>Understand how our climate and environmental conditions are changing</li>
                    <li>Consider and assess risks and vulnerabilities</li>
                    <li>Help us prepare, take action, and improve resilience to the impacts of climate change</li>
                </ul>
            </div>
        </div>


        <div id="learn_about_climate_change_heading" class=""><h4>Learn About Trends in Climate Change</h4></div>


        <div class="centered_interactive_map" id="centered_interactive_map" >

            <style> #figure1_2 { height: 600px; width: 100%; display: table; }
                #figure1_2 p { display: table-cell; vertical-align: middle; }
                #figure1_2 img { max-height: 600px; }
                .leaflet-container a.leaflet-popup-close-button { color: #f00; }
                .map-container { position: relative; overflow: hidden; }
                .map-overlay { position: absolute; z-index: 1000; left: 0; right: 0; top: 0; bottom: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.3); cursor: pointer; }
                .map-overlay-message { position: absolute; top: 20%; text-align: center; width: 100%; padding: 30px 0; color: #fff; font-size: 20px; font-family: Roboto, Helvetica, Arial, sans-serif; background-color: rgba(0, 0, 0, 0.7); }
                .view-static { margin-top: 30px; font-family: Roboto, Helvetica, Arial, sans-serif; }

                .numberCircleDarkBlue { border-radius: 50%; width: 20px; height: 20px; padding: 4px; padding-left:8px; padding-right:8px; background: #117181; border: 1px solid #fff; color: #fff; text-align: center; text-transform: lowercase; font: 15px arial, sans-serif; text-shadow: 0px; }
                .numberCircleGreen { border-radius: 50%; width: 20px; height: 20px; padding: 4px; padding-left:8px; padding-right:8px; background: #a5be43; border: 1px solid #fff; color: #fff; text-align: center; text-transform: lowercase; font: 15px arial, sans-serif; text-shadow: 0px; }
                .numberCircleGreen-i { border-radius: 50%; width: 20px; height: 20px; padding: 2px; padding-left:8px; padding-right:8px; background: #a5be43; border: 1px solid #fff; color: #fff; text-align: center; text-transform: lowercase; font: 15px arial, sans-serif; text-shadow: 0px; }
                .numberCircleBrown { border-radius: 50%; width: 20px; height: 20px; padding: 2px; padding-left:8px; padding-right:8px; background: #9b5b2b; border: 1px solid #fff; color: #fff; text-align: center; text-transform: lowercase; font: 15px arial, sans-serif; text-shadow: 0px; }
                .numberCircleBrown-k { border-radius: 50%; width: 20px; height: 20px; padding: 4px; padding-left:8px; padding-right:8px; background: #9b5b2b; border: 1px solid #fff; color: #fff; text-align: center; text-transform: lowercase; font: 15px arial, sans-serif; text-shadow: 0px; }
                .numberCircleLightBlue { border-radius: 50%; width: 20px; height: 20px; padding: 2px; padding-left:8px; padding-right:8px; background: #53c2c8; border: 1px solid #fff; color: #fff; text-align: center; text-transform: lowercase; font: 15px arial, sans-serif; text-shadow: 0px; }
                .numberCircleLightBlue-d-e { border-radius: 50%; width: 20px; height: 20px; padding: 2px; padding-left:6px; padding-right:6px; background: #53c2c8; border: 1px solid #fff; color: #fff; text-align: center; text-transform: lowercase; font: 15px arial, sans-serif; text-shadow: 0px; }
            </style>
            <div class='map-container'>
                <div class='image-clickable' tabindex='0'>
                    <div class='figure1_2'>

                        <div class='image-clickable-main'>

                            <picture>
                                <source media='(min-width: 993px)' srcset='https://nca2018.globalchange.gov/interactives/1_2/figures/overview/Overview_indicators_2400.jpg'>
                                <source media='(max-width: 992px)' srcset='https://nca2018.globalchange.gov/interactives/1_2/figures/overview/Overview_indicators_1986.jpg'>
                                <source media='(max-width: 768px)' srcset='https://nca2018.globalchange.gov/interactives/1_2/figures/overview/Overview_indicators_1536.jpg'>
                                <source media='(max-width: 480px)' srcset='https://nca2018.globalchange.gov/interactives/1_2/figures/overview/Overview_indicators_960.jpg'>
                                <source media='(max-width: 320px)' srcset='https://nca2018.globalchange.gov/interactives/1_2/figures/overview/Overview_indicators_640.jpg'>
                                <img src='https://nca2018.globalchange.gov/interactives/1_2/figures/overview/Overview_indicators_1536.jpg' alt='Alternative text for the main image for figure 1_2'>
                            </picture>

                            <div class='image-clickable-links-overlay'>
                                <a class='image-clickable-link image-clickable-link-overlay image-clickable-link-overlay-figure_1_2_a' data-for='0' title='Expand graphic for figure a: Temperature'></a>
                                <a class='image-clickable-link image-clickable-link-overlay image-clickable-link-overlay-figure_1_2_b' data-for='1' title='Expand graphic for figure b'></a>
                                <a class='image-clickable-link image-clickable-link-overlay image-clickable-link-overlay-figure_1_2_c' data-for='2' title='Expand graphic for figure c'></a>
                                <a class='image-clickable-link image-clickable-link-overlay image-clickable-link-overlay-figure_1_2_d' data-for='3' title='Expand graphic for figure d'></a>
                                <a class='image-clickable-link image-clickable-link-overlay image-clickable-link-overlay-figure_1_2_e' data-for='4' title='Expand graphic for figure e'></a>
                                <a class='image-clickable-link image-clickable-link-overlay image-clickable-link-overlay-figure_1_2_f' data-for='5' title='Expand graphic for figure f'></a>
                                <a class='image-clickable-link image-clickable-link-overlay image-clickable-link-overlay-figure_1_2_g' data-for='6' title='Expand graphic for figure g'></a>
                                <a class='image-clickable-link image-clickable-link-overlay image-clickable-link-overlay-figure_1_2_h' data-for='7' title='Expand graphic for figure h'></a>
                                <a class='image-clickable-link image-clickable-link-overlay image-clickable-link-overlay-figure_1_2_l' data-for='8' title='Expand graphic for figure i'></a>
                                <a class='image-clickable-link image-clickable-link-overlay image-clickable-link-overlay-figure_1_2_j' data-for='9' title='Expand graphic for figure j'></a>
                                <a class='image-clickable-link image-clickable-link-overlay image-clickable-link-overlay-figure_1_2_k' data-for='10' title='Expand graphic for figure k'></a>
                                <a class='image-clickable-link image-clickable-link-overlay image-clickable-link-overlay-figure_1_2_i' data-for='11' title='Expand graphic for figure l'></a>
                            </div>

                            <div class='image-clickable-overlay'>

                                <div class='image-clickable-overlay-arrow-wrapper image-clickable-overlay-arrow-wrapper-left'>
                                    <a class='image-clickable-overlay-arrow image-clickable-overlay-arrow-left' title='Load previous image'></a>
                                </div>

                                <div class='image-clickable-overlay-images'>

                                    <picture class='image-clickable-overlay-image image-clickable-overlay-image-figure_1_2_a'>
                                        <source media='(min-width: 993px)' srcset='https://nca2018.globalchange.gov/interactives/1_2/figures/2320/a_us-temp_2320.jpg'>
                                        <source media='(max-width: 992px)' srcset='https://nca2018.globalchange.gov/interactives/1_2/figures/1906/a_us-temp_1906.jpg'>
                                        <source media='(max-width: 768px)' srcset='https://nca2018.globalchange.gov/interactives/1_2/figures/1456/a_us-temp_1456.jpg'>
                                        <source media='(max-width: 480px)' srcset='https://nca2018.globalchange.gov/interactives/1_2/figures/880/a_us-temp_880.jpg'>
                                        <source media='(max-width: 320px)' srcset='https://nca2018.globalchange.gov/interactives/1_2/figures/560/a_us-temp_560.jpg'>
                                        <img src='https://nca2018.globalchange.gov/interactives/1_2/figures/1456/a_us-temp_1456.jpg' alt='Caption for figure 1.2 a'>
                                    </picture>

                                    <picture class='image-clickable-overlay-image image-clickable-overlay-image-figure_1_2_b'>
                                        <source media='(min-width: 993px)' srcset='https://nca2018.globalchange.gov/interactives/1_2/figures/2320/b_heat-waves_2320.jpg'>
                                        <source media='(max-width: 992px)' srcset='https://nca2018.globalchange.gov/interactives/1_2/figures/1906/b_heat-waves_1906.jpg'>
                                        <source media='(max-width: 768px)' srcset='https://nca2018.globalchange.gov/interactives/1_2/figures/1456/b_heat-waves_1456.jpg'>
                                        <source media='(max-width: 480px)' srcset='https://nca2018.globalchange.gov/interactives/1_2/figures/880/b_heat-waves_880.jpg'>
                                        <source media='(max-width: 320px)' srcset='https://nca2018.globalchange.gov/interactives/1_2/figures/560/b_heat-waves_560.jpg'>
                                        <img src='https://nca2018.globalchange.gov/interactives/1_2/figures/1456/b_heat-waves_1456.jpg' alt='Caption for figure 1.2 b'>
                                    </picture>

                                    <picture class='image-clickable-overlay-image image-clickable-overlay-image-figure_1_2_c'>
                                        <source media='(min-width: 993px)' srcset='https://nca2018.globalchange.gov/interactives/1_2/figures/2320/c_us-heavy-precip_2320.jpg'>
                                        <source media='(max-width: 992px)' srcset='https://nca2018.globalchange.gov/interactives/1_2/figures/1906/c_us-heavy-precip_1906.jpg'>
                                        <source media='(max-width: 768px)' srcset='https://nca2018.globalchange.gov/interactives/1_2/figures/1456/c_us-heavy-precip_1456.jpg'>
                                        <source media='(max-width: 480px)' srcset='https://nca2018.globalchange.gov/interactives/1_2/figures/880/c_us-heavy-precip_880.jpg'>
                                        <source media='(max-width: 320px)' srcset='https://nca2018.globalchange.gov/interactives/1_2/figures/560/c_us-heavy-precip_560.jpg'>
                                        <img src='https://nca2018.globalchange.gov/interactives/1_2/figures/1456/c_us-heavy-precip_1456.jpg' alt='Caption for figure 1.2 c'>
                                    </picture>

                                    <picture class='image-clickable-overlay-image image-clickable-overlay-image-figure_1_2_d'>
                                        <source media='(min-width: 993px)' srcset='https://nca2018.globalchange.gov/interactives/1_2/figures/2320/d_snowpack_2320.jpg'>
                                        <source media='(max-width: 992px)' srcset='https://nca2018.globalchange.gov/interactives/1_2/figures/1906/d_snowpack_1906.jpg'>
                                        <source media='(max-width: 768px)' srcset='https://nca2018.globalchange.gov/interactives/1_2/figures/1456/d_snowpack_1456.jpg'>
                                        <source media='(max-width: 480px)' srcset='https://nca2018.globalchange.gov/interactives/1_2/figures/880/d_snowpack_880.jpg'>
                                        <source media='(max-width: 320px)' srcset='https://nca2018.globalchange.gov/interactives/1_2/figures/560/d_snowpack_560.jpg'>
                                        <img src='https://nca2018.globalchange.gov/interactives/1_2/figures/1456/d_snowpack_1456.jpg' alt='Caption for figure 1.2 d'>
                                    </picture>

                                    <picture class='image-clickable-overlay-image image-clickable-overlay-image-figure_1_2_e'>
                                        <source media='(min-width: 993px)' srcset='https://nca2018.globalchange.gov/interactives/1_2/figures/2320/e_drought-conditions_2320.jpg'>
                                        <source media='(max-width: 992px)' srcset='https://nca2018.globalchange.gov/interactives/1_2/figures/1906/e_drought-conditions_1906.jpg'>
                                        <source media='(max-width: 768px)' srcset='https://nca2018.globalchange.gov/interactives/1_2/figures/1456/e_drought-conditions_1456.jpg'>
                                        <source media='(max-width: 480px)' srcset='https://nca2018.globalchange.gov/interactives/1_2/figures/880/e_drought-conditions_880.jpg'>
                                        <source media='(max-width: 320px)' srcset='https://nca2018.globalchange.gov/interactives/1_2/figures/560/e_drought-conditions_560.jpg'>
                                        <img src='https://nca2018.globalchange.gov/interactives/1_2/figures/1456/e_drought-conditions_1456.jpg' alt='Caption for figure 1.2 e'>
                                    </picture>

                                    <picture class='image-clickable-overlay-image image-clickable-overlay-image-figure_1_2_f'>
                                        <source media='(min-width: 993px)' srcset='https://nca2018.globalchange.gov/interactives/1_2/figures/2320/f_arctic-sea-ice_2320.jpg'>
                                        <source media='(max-width: 992px)' srcset='https://nca2018.globalchange.gov/interactives/1_2/figures/1906/f_arctic-sea-ice_1906.jpg'>
                                        <source media='(max-width: 768px)' srcset='https://nca2018.globalchange.gov/interactives/1_2/figures/1456/f_arctic-sea-ice_1456.jpg'>
                                        <source media='(max-width: 480px)' srcset='https://nca2018.globalchange.gov/interactives/1_2/figures/880/f_arctic-sea-ice_880.jpg'>
                                        <source media='(max-width: 320px)' srcset='https://nca2018.globalchange.gov/interactives/1_2/figures/560/f_arctic-sea-ice_560.jpg'>
                                        <img src='https://nca2018.globalchange.gov/interactives/1_2/figures/1456/f_arctic-sea-ice_1456.jpg' alt='Caption for figure 1.2 f'>
                                    </picture>

                                    <picture class='image-clickable-overlay-image image-clickable-overlay-image-figure_1_2_g'>
                                        <source media='(min-width: 993px)' srcset='https://nca2018.globalchange.gov/interactives/1_2/figures/2320/g_slr_2320.jpg'>
                                        <source media='(max-width: 992px)' srcset='https://nca2018.globalchange.gov/interactives/1_2/figures/1906/g_slr_1906.jpg'>
                                        <source media='(max-width: 768px)' srcset='https://nca2018.globalchange.gov/interactives/1_2/figures/1456/g_slr_1456.jpg'>
                                        <source media='(max-width: 480px)' srcset='https://nca2018.globalchange.gov/interactives/1_2/figures/880/g_slr_880.jpg'>
                                        <source media='(max-width: 320px)' srcset='https://nca2018.globalchange.gov/interactives/1_2/figures/560/g_slr_560.jpg'>
                                        <img src='https://nca2018.globalchange.gov/interactives/1_2/figures/1456/g_slr_1456.jpg' alt='Caption for figure 1.2 g'>
                                    </picture>

                                    <picture class='image-clickable-overlay-image image-clickable-overlay-image-figure_1_2_h'>
                                        <source media='(min-width: 993px)' srcset='https://nca2018.globalchange.gov/interactives/1_2/figures/2320/h_marine-species_2320.jpg'>
                                        <source media='(max-width: 992px)' srcset='https://nca2018.globalchange.gov/interactives/1_2/figures/1906/h_marine-species_1906.jpg'>
                                        <source media='(max-width: 768px)' srcset='https://nca2018.globalchange.gov/interactives/1_2/figures/1456/h_marine-species_1456.jpg'>
                                        <source media='(max-width: 480px)' srcset='https://nca2018.globalchange.gov/interactives/1_2/figures/880/h_marine-species_880.jpg'>
                                        <source media='(max-width: 320px)' srcset='https://nca2018.globalchange.gov/interactives/1_2/figures/560/h_marine-species_560.jpg'>
                                        <img src='https://nca2018.globalchange.gov/interactives/1_2/figures/1456/h_marine-species_1456.jpg' alt='Caption for figure 1.2 h'>
                                    </picture>

                                    <picture class='image-clickable-overlay-image image-clickable-overlay-image-figure_1_2_i'>
                                        <source media='(min-width: 993px)' srcset='https://nca2018.globalchange.gov/interactives/1_2/figures/2320/i_ocean-acidity_2320.jpg'>
                                        <source media='(max-width: 992px)' srcset='https://nca2018.globalchange.gov/interactives/1_2/figures/1906/i_ocean-acidity_1906.jpg'>
                                        <source media='(max-width: 768px)' srcset='https://nca2018.globalchange.gov/interactives/1_2/figures/1456/i_ocean-acidity_1456.jpg'>
                                        <source media='(max-width: 480px)' srcset='https://nca2018.globalchange.gov/interactives/1_2/figures/880/i_ocean-acidity_880.jpg'>
                                        <source media='(max-width: 320px)' srcset='https://nca2018.globalchange.gov/interactives/1_2/figures/560/i_ocean-acidity_560.jpg'>
                                        <img src='https://nca2018.globalchange.gov/interactives/1_2/figures/1456/i_ocean-acidity_1456.jpg' alt='Caption for figure 1.2 i'>
                                    </picture>

                                    <picture class='image-clickable-overlay-image image-clickable-overlay-image-figure_1_2_j'>
                                        <source media='(min-width: 993px)' srcset='https://nca2018.globalchange.gov/interactives/1_2/figures/2320/j_growing-season_2320.jpg'>
                                        <source media='(max-width: 992px)' srcset='https://nca2018.globalchange.gov/interactives/1_2/figures/1906/j_growing-season_1906.jpg'>
                                        <source media='(max-width: 768px)' srcset='https://nca2018.globalchange.gov/interactives/1_2/figures/1456/j_growing-season_1456.jpg'>
                                        <source media='(max-width: 480px)' srcset='https://nca2018.globalchange.gov/interactives/1_2/figures/880/j_growing-season_880.jpg'>
                                        <source media='(max-width: 320px)' srcset='https://nca2018.globalchange.gov/interactives/1_2/figures/560/j_growing-season_560.jpg'>
                                        <img src='https://nca2018.globalchange.gov/interactives/1_2/figures/1456/j_growing-season_1456.jpg' alt='Caption for figure 1.2 j'>
                                    </picture>

                                    <picture class='image-clickable-overlay-image image-clickable-overlay-image-figure_1_2_k'>
                                        <source media='(min-width: 993px)' srcset='https://nca2018.globalchange.gov/interactives/1_2/figures/2320/k_wildfires_2320.jpg'>
                                        <source media='(max-width: 992px)' srcset='https://nca2018.globalchange.gov/interactives/1_2/figures/1906/k_wildfires_1906.jpg'>
                                        <source media='(max-width: 768px)' srcset='https://nca2018.globalchange.gov/interactives/1_2/figures/1456/k_wildfires_1456.jpg'>
                                        <source media='(max-width: 480px)' srcset='https://nca2018.globalchange.gov/interactives/1_2/figures/880/k_wildfires_880.jpg'>
                                        <source media='(max-width: 320px)' srcset='https://nca2018.globalchange.gov/interactives/1_2/figures/560/k_wildfires_560.jpg'>
                                        <img src='https://nca2018.globalchange.gov/interactives/1_2/figures/1456/k_wildfires_1456.jpg' alt='Caption for figure 1.2 k'>
                                    </picture>

                                    <picture class='image-clickable-overlay-image image-clickable-overlay-image-figure_1_2_l'>
                                        <source media='(min-width: 993px)' srcset='https://nca2018.globalchange.gov/interactives/1_2/figures/2320/l_degree-days_2320.jpg'>
                                        <source media='(max-width: 992px)' srcset='https://nca2018.globalchange.gov/interactives/1_2/figures/1906/l_degree-days_1906.jpg'>
                                        <source media='(max-width: 768px)' srcset='https://nca2018.globalchange.gov/interactives/1_2/figures/1456/l_degree-days_1456.jpg'>
                                        <source media='(max-width: 480px)' srcset='https://nca2018.globalchange.gov/interactives/1_2/figures/880/l_degree-days_880.jpg'>
                                        <source media='(max-width: 320px)' srcset='https://nca2018.globalchange.gov/interactives/1_2/figures/560/l_degree-days_560.jpg'>
                                        <img src='https://nca2018.globalchange.gov/interactives/1_2/figures/1456/l_degree-days_1456.jpg' alt='Caption for figure 1.2 l'>
                                    </picture>

                                </div>

                                <div class='image-clickable-overlay-arrow-wrapper image-clickable-overlay-arrow-wrapper-right'>
                                    <a class='image-clickable-overlay-arrow image-clickable-overlay-arrow-right' title='Load next image'></a>
                                </div>
                                <a class='image-clickable-overlay-dismiss'></a>

                            </div>

                        </div>

                        <div class='image-clickable-links-buttons'>
                            <a class='image-clickable-link image-clickable-link-button image-clickable-link-button-figure_1_2_a' data-for='0' title='Expand graphic for figure a: Temperature' tabindex='0'><span class='numberCircleDarkBlue'>a</span></a>
                            <a class='image-clickable-link image-clickable-link-button image-clickable-link-button-figure_1_2_b' data-for='1' title='Expand graphic for figure b' tabindex='0'><span class='numberCircleDarkBlue'>b</span></a>
                            <a class='image-clickable-link image-clickable-link-button image-clickable-link-button-figure_1_2_c' data-for='2' title='Expand graphic for figure c' tabindex='0'><span class='numberCircleDarkBlue'>c</span></a>
                            <a class='image-clickable-link image-clickable-link-button image-clickable-link-button-figure_1_2_d' data-for='3' title='Expand graphic for figure d' tabindex='0'><span class='numberCircleLightBlue-d-e'>d</span></a>
                            <a class='image-clickable-link image-clickable-link-button image-clickable-link-button-figure_1_2_e' data-for='4' title='Expand graphic for figure e' tabindex='0'><span class='numberCircleLightBlue-d-e'>e</span></a>
                            <a class='image-clickable-link image-clickable-link-button image-clickable-link-button-figure_1_2_f' data-for='5' title='Expand graphic for figure f' tabindex='0'><span class='numberCircleLightBlue'>f</span></a>
                            <a class='image-clickable-link image-clickable-link-button image-clickable-link-button-figure_1_2_g' data-for='6' title='Expand graphic for figure g' tabindex='0'><span class='numberCircleGreen'>g</span></a>
                            <a class='image-clickable-link image-clickable-link-button image-clickable-link-button-figure_1_2_h' data-for='7' title='Expand graphic for figure h' tabindex='0'><span class='numberCircleGreen'>h</span></a>
                            <a class='image-clickable-link image-clickable-link-button image-clickable-link-button-figure_1_2_i' data-for='8' title='Expand graphic for figure i' tabindex='0'><span class='numberCircleGreen-i'>i</span></a>
                            <a class='image-clickable-link image-clickable-link-button image-clickable-link-button-figure_1_2_j' data-for='9' title='Expand graphic for figure j' tabindex='0'><span class='numberCircleBrown'>j</span></a>
                            <a class='image-clickable-link image-clickable-link-button image-clickable-link-button-figure_1_2_k' data-for='10' title='Expand graphic for figure k' tabindex='0'><span class='numberCircleBrown-k'>k</span></a>
                            <a class='image-clickable-link image-clickable-link-button image-clickable-link-button-figure_1_2_l' data-for='11' title='Expand graphic for figure l' tabindex='0'><span class='numberCircleBrown'>l</span></a>
                        </div>

                    </div>
                </div>
                <div class='map-overlay' data-figure='1.2' onclick='hide_map_overlay_1_2(this)'>
                    <div class='map-overlay-message'> <i class='fas fa-chart-line'></i> CLICK HERE TO INTERACT </div>
                </div>
            </div>

            <div id="interactive_map_caption_div" class="text" >
                <p><span id="caption_text">Source: </span><span id="caption_text_link" ><a href="https://nca2018.globalchange.gov/" target="_blank">Fourth National Climate Assessment (NCA4)</a></span></p>
            </div>

            <p class='text-center button_wrapper'><button class="button" id="interactiveBtn">View static image</button></p>
            <script src='https://nca2018.globalchange.gov/interactives/1_2/figure1_2.js'></script> <link rel='stylesheet' href='https://nca2018.globalchange.gov/interactives/1_2/figure1_2.css'>
            <script> function hide_map_overlay_1_2(el) { el.style.display = 'none'; } </script>

                <div id="image_caption_div" style="">
                    <div id="" class="text ">
                        <p><span id="caption_text" ><?php echo $image_caption;?></span></p>
                    </div>
                </div>

        </div>

</div>



<div class="gc_explore_indicators" id="explore_usgcrp_indicators" >

        <div class="outer">
        <div class="explore_indicators_heading">Explore USGCRP Indicators</div>
        <div id="featured_indicators" class="padding-top">

            <div class="three_column_row">
                <div class="three_column" >
                    <a href="/<?php echo $alias[0]; ?>" class="darken">
                        <div class="container gc_image_small" >
                            <img src="<?php echo $image_url[0]; ?>" alt="<?php echo $image_alt[0]; ?>"  >
                            <div class="centered"><div class="gc_image_title_small"><?php echo $title[0]; ?></div>
                        </div>
                        </div>
                    </a>
                </div>
                <div class="three_column" >
                    <a href="/<?php echo $alias[1]; ?>" class="darken">
                        <div class="container gc_image_small">
                            <img  src="<?php echo $image_url[1]; ?>" alt="<?php echo $image_alt[1]; ?>"  >
                            <div class="centered"><div class="gc_image_title_small"><?php echo $title[1]; ?></div>
                        </div>
                        </div>
                    </a>
                </div>
                <div class="three_column" >
                    <a href="/<?php echo $alias[2]; ?>" class="darken">
                        <div class="container gc_image_small">
                            <img src="<?php echo $image_url[2]; ?>" alt="<?php echo $image_alt[2]; ?>"  >
                            <div class="centered"><div class="gc_image_title_small"><?php echo $title[2]; ?></div>
                        </div>
                        </div>
                    </a>
                </div>

            </div>

                <div class="view_all"><a href="<?php echo $catalog; ?>"><button class="button">View All</button></a></div>

        </div>
        </div>

</div>




<div class="gc_selected_indicators" id="federal_indicators" >
    <div class="selected_indicators_heading" style=""><h2 class="padding-top">Selected Federal Climate-Related Indicators</h2></div>
    <div class="selected_indicators_text">Learn more about climate change indicator research at USGCRP agencies.</div>
    <div class="gc_selected_indicators_wrapper outer">
        <div class="row1 margin-top-30">
            <div class="column1 left1 ">
                <div class="row padding-top-500">
                    <div class="column left ">
                        <a href="https://www.epa.gov/climate-indicators" target="_blank"><img class="gc_selected_indicators_image" src="/sites/<?php echo $variable;?>/modules/custom/globalchange_indicators_custom/images/epa.png" alt="Climate Change Indicators in the US" ></a>
                    </div>
                    <div class="column right ">
                        <div class="selected_indicators_heading2"><a href="https://www.epa.gov/climate-indicators" target="_blank">Climate Change Indicators in the US</a></div>
                        <div class="selected_indicators_text2">EPA partners with more than 40 data contributors from various sources to compile a key set of climate change indicators.</div>
                    </div>
                </div>
            </div>
            <div class="column1 right1 "  >
                <div class="row padding-top-500">
                    <div class="column left ">
                        <a href="https://www.arctic.noaa.gov/report-card" target="_blank"><img class="gc_selected_indicators_image"  src="/sites/<?php echo $variable;?>/modules/custom/globalchange_indicators_custom/images/noaa.png" alt="NOAA's Arctic Report Card" ></a>
                    </div>
                    <div class="column right">
                        <div class="selected_indicators_heading2"><a href="https://www.arctic.noaa.gov/report-card" target="_blank">NOAA's Arctic Report Card</a></div>
                        <div class="selected_indicators_text2">The Arctic Report Card is a timely and peer-reviewed source for environmental information on the current state of the Arctic environmental system.</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row1">
            <div class="column1 left1 "  >
                <div class="row padding-top-500">
                    <div class="column left ">
                        <a href="https://www.ncdc.noaa.gov/sotc/" target="_blank"><img class="gc_selected_indicators_image" src="/sites/<?php echo $variable;?>/modules/custom/globalchange_indicators_custom/images/noaa.png" alt="NOAA's State of the Climate" ></a>
                    </div>
                    <div class="column right">
                        <div class="selected_indicators_heading2"><a href="https://www.ncdc.noaa.gov/sotc/" target="_blank">NOAA's State of the Climate</a></div>
                        <div class="selected_indicators_text2">The State of the Climate is a collection of monthly summaries recapping climate-related occurrences on both a global and national scale.</div>
                    </div>
                </div>
            </div>
            <div class="column1 right1 " >
                <div class="row padding-top-500">
                    <div class="column left ">
                        <a href="https://www.cdc.gov/nceh/tracking/" target="_blank"><img class="gc_selected_indicators_image"  src="/sites/<?php echo $variable;?>/modules/custom/globalchange_indicators_custom/images/cdc.jpeg" alt="CDC's Environmental Public Health Tracking Program" ></a>
                    </div>
                    <div class="column right">
                        <div class="selected_indicators_heading2"><a href="https://www.cdc.gov/nceh/tracking/" target="_blank">CDC's Environmental Public Health Tracking Program</a></div>
                        <div class="selected_indicators_text2">The Arctic Report Card is a timely and peer-reviewed source for environmental information on the current state of the Arctic environmental system.</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row1">
            <div class="column1 left1 " >
                <div class="row padding-top-500">
                    <div class="column left ">
                        <a href="https://climate.nasa.gov/vital-signs/carbon-dioxide/" target="_blank"><img class="gc_selected_indicators_image"  src="/sites/<?php echo $variable;?>/modules/custom/globalchange_indicators_custom/images/nasa.png" alt="NASA's Vital Signs" ></a>
                    </div>
                    <div class="column right">
                        <div class="selected_indicators_heading2"><a href="https://climate.nasa.gov/vital-signs/carbon-dioxide/" target="_blank">NASA's Vital Signs</a></div>
                        <div class="selected_indicators_text2">Explore vital signs of global climate change and global warming, such as Carbon Dioxide, Global Temperature, and Arctic Sea Ice Minimum.</div>
                    </div>
                </div>
            </div>
            <div class="column1 right1 " >
                <div class="row padding-top-500">
                    <div class="column left ">
                        <a href="https://www.usanpn.org/usa-national-phenology-network" target="_blank"><img class="gc_selected_indicators_image"  src="/sites/<?php echo $variable;?>/modules/custom/globalchange_indicators_custom/images/phenology.png" alt="Natioanl Phenology Network" ></a>
                    </div>
                    <div class="column right">
                        <div class="selected_indicators_heading2"><a href="https://www.usanpn.org/usa-national-phenology-network" target="_blank">National Phenology Network</a></div>
                        <div class="selected_indicators_text2">This award-winning network collects, stores, and shares seasonal natural phenomena and cyclical data and information.</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="two_column_row" id="two_column_row_bottom">
    <div class="two_column col_left bottom_row_height">
        <div class="selected_usgrp_products">
            <div ><h4 style="color:#fff;">Select USGCRP Products</h4></div>
            <ul class="selected_usgrp_products_ul">
                <li><a href="https://www.globalchange.gov/sites/globalchange/files/USGCRP indicators_March2018-FINAL_Newsletter Version_23May18.pdf" target="_blank" style="color:#fff">USGCRP Indicators Fact Sheet</a> </li>
                <li><a href="https://nca2018.globalchange.gov/" target="_blank" style="color:#fff">Fourth National Climate Assessment </a> </li>
                <li><a href="https://science2017.globalchange.gov/" target="_blank" style="color:#fff">Climate Science Special Report</a> </li>
            </ul>
        </div>
    </div>
    <div class="two_column col_right bottom_row_height" >
        <div class="selected_usgrp_products">
            <div class="selected_usgrp_products_h4"><h4>Indicator Announcements and Opportunities</h4></div>
            <ul class="selected_usgrp_products_ul">
                <li class="selected_usgrp_products_text"><a href="https://www.sesync.org/project/propose-a-workshop/socio-environmental-systems-indicators-for-climate-change-adaptation" target="_blank" >Upcoming Workshop on Social Indicators</a></li>
                <li class="selected_usgrp_products_text"><a href="https://www.nsf.gov/funding/pgm_summ.jsp?pims_id=503222" target="_blank" >Arctic Observing Network</a></li>
                <li class="selected_usgrp_products_text"><a href="https://cpo.noaa.gov/Portals/0/Grants/2019/MAPP_FY19_ProgramInformationSheet_ProjectionsJune26.pdf" target="_blank" >NOAA Funding Opportunities for Developing Indicators (FY19 NOAA/CPO/MAPP)</a></li>
            </ul>
        </div>
    </div>
</div>


<!-- The Modal -->
<div id="interactiveModal" class="modal">

    <!-- Modal content -->
    <div class="modal-content">
        <span class="close" id="close">&times;</span>
        <div id="static_image_enlarged"><img src="https://nca2018.globalchange.gov/img/figure/figure1_2.png" style="height:100%;width:100%;"></div>
    </div>

</div>

<script src="/sites/<?php echo $variable;?>/modules/custom/globalchange_indicators_custom/js/interactive_map.js"></script>