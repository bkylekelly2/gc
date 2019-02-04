<?php

$hostname = gethostname();
if ($hostname=='zeus'){
    $variable = 'default';
} else {
    $variable = 'globalchange';
}
$referrer = $_SERVER['HTTP_REFERER'];

$contributors = '';
$image_alt2 = '';
$thisurl = '';

// Retrieve an array which contains the path pieces.
$path_args = arg();

$nid = $path_args[2];
$getNodeID = $path_args[2];

$node = node_load($nid);

$thisurl = '/browse/indicator-details/'.$nid;
$node = gc_objectToArray($node);
$title = $node['title'];

for ($x = 0; $x <= (count($node['field_related_resources']['und'])-1); $x++) {
    $resources [] = $node['field_related_resources']['und'][$x]['value'];
}

$related_resources = '<ul>';
foreach ($resources as $resource) {

    $related_resources .= "<li class='related_resources_margin'>" . $resource . "</li>";
}
$related_resources .= '</ul>';

$teaser = $node['field_indicator_teaser']['und'][0]['value'];
$why_its_important = $node['field_why_it_s_important']['und'][0]['value'];

$date_range_start = $node['field_date_range_start']['und'][0]['value'];
$date_range_end = $node['field_date_range_end']['und'][0]['value'];

$headline = $node['field_headline']['und'][0]['value'];
$about_the_indicator = $node['field_about_the_indicator']['und'][0]['value'];

$indicator_hero_fid = $node['field_indicator_hero']['und'][0]['fid'];
$file = file_load($indicator_hero_fid);
$uri = $file->uri;
$indicator_hero_url = file_create_url($uri);

$indicator_card_fid = $node['field_indicator_card']['und'][0]['fid'];
$file = file_load($indicator_card_fid);
$uri = $file->uri;
$indicator_card_url = file_create_url($uri);

$metadataURL = $node['field_metadata']['und'][0]['value'];
$metadata = json_decode(file_get_contents($metadataURL), true);
$publication_year = $metadata['publication_year'];
$report_type_identifier = $metadata['report_type_identifier'];
$identifier = $metadata['identifier'];
$metadata_url = $metadata['url'];
$metadata_thumbnail=$metadata['files'][0]['thumbnail_href'];
$metadata_summary=$metadata['summary'];
$metadata_summary=str_replace("\r\n\r\n","<BR><BR>",$metadata_summary);
$metadata_summary=str_replace("2.", "<BR>2.",$metadata_summary);
$metadata_summary=str_replace("3.", "<BR>3.",$metadata_summary);
$metadata_title=$metadata['title'];
$metadata_reference_url = 'https://data.globalchange.gov/report/'.$identifier.'/reference';

$num_contacts=0;
$num_agencies = 0;
$num_producers = 0;

for ($x = 0; $x <= (count($metadata['contributors'])-1); $x++) {
    switch ($metadata['contributors'][$x]['role_type_identifier']) {
        case 'point_of_contact':
            $num_contacts = $num_contacts + 1;
            break;
        case 'contributing_agency':
            $num_agencies = $num_agencies + 1;
            break;
        case 'data_producer':
            $num_producers = $num_producers + 1;
            break;
    }
}

if (($num_contacts==1)){
    $point_of_contacts ='<div style="font-weight:600;">Point of Contact</div>';
}
if (($num_contacts>1)){
    $point_of_contacts ='<div style="font-weight:600;">Point of Contacts</div>';
}

if (($num_agencies==1)){
    $contributing_agencies ='<div style="font-weight:600;">Contributing Agency</div>';
    $contributing_agencies ='<ul>';
}
if (($num_agencies>1)){
    $contributing_agencies ='<div style="font-weight:600;">Contributing Agencies</div>';
    $contributing_agencies .='<ul>';
}

if (($num_producers==1)){
    $data_producers ='<div style="font-weight:600;">Data Producer</div>';
    $data_producers .='<ul>';
}
if (($num_producers>1)){
    $data_producers ='<div style="font-weight:600;">Data Producers</div>';
    $data_producers .='<ul>';
}

for ($x = 0; $x <= (count($metadata['contributors'])-1); $x++) {
    switch ($metadata['contributors'][$x]['role_type_identifier']){
        case 'point_of_contact':
            $point_of_contacts .='<ul>';
            $point_of_contacts .='<li><a href="'.$metadata['contributors'][$x]['person']['url'].'" target="_blank">'.$metadata['contributors'][$x]['person']['first_name'].' '.$metadata['contributors'][$x]['person']['last_name'].'</a></li>';
            $point_of_contacts .='<ul><li><a href="'.$metadata['contributors'][$x]['organization']['url'].'" target="_blank">'.$metadata['contributors'][$x]['organization']['name'].'</a></li></ul>';
            $point_of_contacts .='</ul>';
        break;
    }
}

for ($x = 0; $x <= (count($metadata['contributors'])-1); $x++) {
    switch ($metadata['contributors'][$x]['role_type_identifier']){
        case 'contributing_agency':
            $contributing_agencies .='<li><a href="'.$metadata['contributors'][$x]['organization']['url'].'" target="_blank">'.$metadata['contributors'][$x]['organization']['name'].'</a></li>';
        break;
    }
}

for ($x = 0; $x <= (count($metadata['contributors'])-1); $x++) {
    switch ($metadata['contributors'][$x]['role_type_identifier']){
        case 'data_producer':
            $data_producers .='<li><a href="'.$metadata['contributors'][$x]['organization']['url'].'" target="_blank">'.$metadata['contributors'][$x]['organization']['name'].'</a></li>';
        break;
    }
}


if (($num_agencies>0)){
    $contributing_agencies .='</ul>';
}


if (($num_producers>0)){
    $data_producers .='</ul>';
}

$metadata_contributors .= $point_of_contacts;
$metadata_contributors .= $contributing_agencies;
$metadata_contributors .= $data_producers;

$indicator_hero_alt = $node['field_indicator_hero']['und'][0]['alt'];
$static_image_filename = $node['field_static_image']['und'][0]['filename'];
$static_image_fid = $node['field_static_image']['und'][0]['fid'];
$static_image_caption = $node['field_image_caption']['und'][0]['value'];
$file = file_load($static_image_fid);
$uri = $file->uri;
$static_image_url = file_create_url($uri);
$static_image_title = str_replace(" ","_", $title);
$static_image_title .= substr($static_image_filename, -4);
$static_image_title = strtolower($static_image_title);
$date_range = $date_range_start ." - ".$date_range_end."<BR>";

$contributors .= '<ul>';

    for ($x = 0; $x <= (count($node['field_contributing_agencies_with']['und'])-1); $x++) {
        $contributors .= "<li class='contributors_link'>".$node['field_contributing_agencies_with']['und'][$x]['value']."</li>";
    }

$contributors .= '</ul>';

$tableau_button = '';
$tableau = '';
$tableau = $node['field_tableau_embed']['und'][0]['safe_value'];


if (isset($metadataURL)){
    $metadata_button = '<button class="button" id="metaBtn">View Metadata</button>';
}


if (isset($tableau)){
    $tableau_button = '<button class="button" onclick="openInteractiveGraph('.$getNodeID.')">Interact with Graph</button>';
}
$key_points = $node['field_key_points']['und'][0]['value'];


/* */
$node_type = "featured_indicators"; // can find this on the node type's "edit" screen in the Drupal admin section.
$nid = db_query("SELECT nid FROM {node} WHERE type = :type", array(':type' => $node_type))->fetchCol();
$nodeID = $nid[0];
$catalog = "/browse/indicators/catalog";
$node = node_load_multiple($nid);

$image_caption = 'Long-term observations provide evidence of warming in the climate system and the effects of increasing atmospheric greenhouse gas concentrations. This figure shows several climate-relevant indicators of change based on data collected across the United States. (NCA4 Ch. 01b)';

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

    $title2[]=$node['title'];
    $image_alt2[] = $node['field_indicator_card']['und'][0]['alt'];

    $fid = $node['field_indicator_card']['und'][0]['fid'];
    $file = file_load($fid);
    $uri = $file->uri;
    if (count($node['field_indicator_card']['und']>0)) {
        $image_url2[] = file_create_url($uri);
    }
    $alias2[] = "browse/indicator-details/".$nid;
}

$timestamp = time();

?>

<link rel="stylesheet" href="/sites/<?php echo $variable;?>/modules/custom/globalchange_indicators_custom/css/styles.css?v=<?php echo $timestamp; ?>" />

<div class="outer" >

    <div id='panels-ipe-regionid-preface' class='panels-ipe-region'>

        <div class="pane__content">
            <nav class="breadcrumb" role="navigation">
                <h2 class="breadcrumb__title">You are here</h2>
                <ul class="breadcrumb__list">
                    <li class="breadcrumb__item">
                        <a href="/browse">Browse &amp; Find</a>
                    </li>
                    <li class="breadcrumb__item">
                        <a href="/browse/indicators">USGCRP Indicators</a>
                    </li>
                    <li class="breadcrumb__item">
                        <a href="/browse/indicators/catalog">Catalog</a>
                    </li>
                    <li class="breadcrumb__item">
                        <a href=""><?php echo $title; ?></a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>

    <div style="padding-top:20px;">
        <div class="image-container">
            <img class="indicator_details_image" alt="<?php echo $indicator_hero_alt;?>">
            <div class="overlay"></div>
            <div class="top_left"><h1><?php echo $title; ?></h1></div>
            <div class="bottom_left show_when_not_small"><?php echo $teaser; ?></div>
            <div class="bottom_right show_when_not_small">
            <div><span class="gc_indicators_date_range_heading">Date Range:</span> <span class="gc_indicators_date_range"><?php echo $date_range; ?></span></div>
            <div><span class="gc_indicators_contributors_heading">Contributors:</span> <span class="gc_indicators_contributors"><?php echo $contributors; ?></span></div>
            </div>
        </div>
    </div>

    <div class="center">

        <div class="show_when_small">
            <div style="width:100%;"><?php echo $teaser; ?></div>
            <div style="width:100%;">
            <div><span style="font-weight:600">Date Range:</span> <span class="date_range"><?php echo $date_range; ?></span></div>
            <div><span style="font-weight:600">Contributors:</span> <span><?php echo $contributors; ?></span></div>
            </div>
        </div>

        <div class="indicator_details_heading"><h2><?php echo $headline;?></h2>
        <div class="indicator_details_text"><?php echo $key_points;?></div>
        </div>
        <div class="static_image"><img src="<?php echo $static_image_url; ?>" ></div>

        <div class="button_wrapper">

            <?php echo $metadata_button; ?>
            <button class="button" id="enlargeImageBtn">Enlarge Image</button>
            <button class="button" data-href='<?php echo $static_image_url; ?>' download="<?php echo $static_image_title; ?>" onclick='forceDownload(this)'>Download Image</button>

            <?php echo $tableau_button; ?>

        </div>

        <div class="gc_static_image_caption_text"><?php echo $static_image_caption; ?></div>

    </div>





<hr class="hr">



    <div class="column_row_about"  >
        <div class="column_about left_about" >
            <h2 class="about_heading">About <?php echo $title; ?></h2>
            <?php echo $about_the_indicator; ?>

            <div class="related_resources show_when_not_stacked2">
                <div id="related_resources_heading"><h3>Related Resources</h3></div>
                <div id="related_resources_body"><p><?php echo $related_resources; ?></p></div>
            </div>

        </div>
        <div class="column_about right_about" >
            <div class='why_its_important'>
                <div class="why_its_important_heading"><div id="why_its_important_heading">Why It's Important</div></div>
                <div class="why_its_important_body"><?php echo $why_its_important; ?></div>
            </div>
        </div>

    </div>

    <div class="related_resources show_when_stacked2">
        <div id="related_resources_heading"><h3>Related Resources</h3></div>
        <div id="related_resources_body"><p><?php echo $related_resources; ?></p></div>
    </div>


</div>





<div class="gc_explore_indicators " id="explore_usgcrp_indicators" >
    <div class="explore_indicators_heading">Explore USGCRP Indicators</div>


    <div id="featured_indicators" class="padding-top">
        <div class="outer" style="">

        <div class="three_column_row">
            <div class="three_column" >
                <a href="/<?php echo $alias2[0]; ?>" class="darken">
                    <div class="container gc_image_small">
                        <img src="<?php echo $image_url2[0]; ?>" alt="<?php echo $image_alt2[0]; ?>"  >
                        <div class="centered"><div class="gc_image_title_small"><?php echo $title2[0]; ?></div>
                    </div>
                    </div>
                </a>
            </div>
            <div class="three_column" >
                <a href="/<?php echo $alias2[1]; ?>" class="darken">
                    <div class="container gc_image_small">
                        <img src="<?php echo $image_url2[1]; ?>" alt="<?php echo $image_alt2[1]; ?>"  >
                        <div class="centered"><div class="gc_image_title_small"><?php echo $title2[1]; ?></div>
                    </div>
                    </div>
                </a>
            </div>
            <div class="three_column" >
                <a href="/<?php echo $alias2[2]; ?>" class="darken">
                    <div class="container gc_image_small">
                        <img src="<?php echo $image_url2[2]; ?>" alt="<?php echo $image_alt2[2]; ?>"  >
                        <div class="centered"><div class="gc_image_title_small"><?php echo $title2[2]; ?></div>
                    </div>
                    </div>
                </a>
            </div>

        </div>

        <div class="view_all" ><a href="<?php echo $catalog; ?>"><button class="button">View All</button></a></div>


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
<div id="metaModal" class="modal">
    <!-- Modal content -->
    <div class="modal-content">
        <span class="close" id="close0">&times;</span>
        <div id="metadata-outerdiv">
        <div id="metadata-heading">Indicator : <?php echo $identifier; ?></div>
        <div id="metadata-innerdiv">
            <div class="metadata_row">
                <div class="two_column_meta column_left_meta">
                    <div id="metadata-title">
                    <h2><?php echo $metadata_title; ?></h2>
                    <div id="metadata-publication_year"><?php echo $publication_year;?> <?php echo $report_type_identifier;?></div>
                    </div>
                    <div id="metadata-contributors"><?php echo $metadata_contributors;?></div>
                </div>

                <div class="two_column_meta column_right_meta">
                <div id="metadata-image" ><img src="<?php echo $metadata_thumbnail; ?>" style="height:100%; width:100%;"></div>
                </div>
            </div>
            <div class="metadata_row metadata_row_bottom">
                <div id="metadata-text"><?php echo $metadata_summary; ?></div>
                <div id="metadata-url"><a href="<?php echo $metadata_reference_url; ?>" target="_blank">References</a></div>
            </div>

    </div>
    </div>
    </div>
</div>

<!-- The Modal -->
<div id="enlargeImageModal" class="modal">

    <!-- Modal content -->
    <div class="modal-content">
        <span class="close" id="close1">&times;</span>
        <div id="static_image_enlarged"><img src="<?php echo $static_image_url; ?>" ></div>
    </div>

</div>

<?php if (isset($metadataURL)){ ?>

    <script>
    // Get the metadata modal
    var metaModal = document.getElementById('metaModal');

    // Get the button that opens the modal
    var metaBtn = document.getElementById("metaBtn");

    // Get the <span> element that closes the modal
    var metaSpan = document.getElementById("close0");

    // When the user clicks the button, open the modal
    metaBtn.onclick = function() {
        metaModal.style.display = "block";
    };

    // When the user clicks on <span> (x), close the modal
    metaSpan.onclick = function() {
        metaModal.style.display = "none";
    };

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target === metaModal) {
            metaModal.style.display = "none";
        }
    };

    /////////////////////////////////////////////////////////////////////////////////
</script>

<?php } ?>


<script>
    do_resize();
    window.addEventListener('resize', do_resize);
    document.getElementsByClassName("indicator_details_image")[0].src="<?php echo $indicator_hero_url; ?>";
    function do_resize(){
        var width = document.documentElement.clientWidth;

        if (width<501){
            document.getElementsByClassName("indicator_details_image")[0].src="<?php echo $indicator_card_url; ?>";
        }
    }


    // Get the enlargeImage modal
    var enlargeImageModal = document.getElementById('enlargeImageModal');

    // Get the button that opens the modal
    var enlargeImageBtn = document.getElementById("enlargeImageBtn");

    // Get the <span> element that closes the modal
    var enlargeImageSpan = document.getElementById("close1");


    // When the user clicks the button, open the modal
    enlargeImageBtn.onclick = function() {
        enlargeImageModal.style.display = "block";
    };

    // When the user clicks on <span> (x), close the modal
    enlargeImageSpan.onclick = function() {
        enlargeImageModal.style.display = "none";
    };

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target === enlargeImageModal) {
            enlargeImageModal.style.display = "none";
        }
    };

    /////////////////////////////////////////////////////////////////////////////
    function openInteractiveGraph(nodeID){
        var url = '/browse/indicator-interactive_graph/'+nodeID;
        var myHeight = 800;
        var myWidth = 800;
        var left = (screen.width - myWidth) / 2;
        var top = (screen.height - myHeight) / 4;
        var title = '';
        window.open(url, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=no, copyhistory=no, width=' + myWidth + ', height=' + myHeight + ', top=' + top + ', left=' + left);
    }
    //////////////////////////////////////////////////////////////////////////////
    function forceDownload(link){
        var url = link.getAttribute("data-href");
        var fileName = link.getAttribute("download");
        var xhr = new XMLHttpRequest();
        xhr.open("GET", url, true);
        xhr.responseType = "blob";
        xhr.onload = function(){
            var urlCreator = window.URL || window.webkitURL;
            var imageUrl = urlCreator.createObjectURL(this.response);
            var tag = document.createElement('a');
            tag.href = imageUrl;
            tag.download = fileName;
            document.body.appendChild(tag);
            tag.click();
            document.body.removeChild(tag);
            link.innerText="Download Image";
        }
        xhr.send();
    }

</script>

<!--<script src="/sites/<?php echo $variable;?>/modules/custom/globalchange_indicators_custom/js/scripts.js"></script>-->