<?php
/*
Plugin Name: Polixea Profile Searchbox
Plugin URI: http://www.polixea-profile.de
Description: Insert Polixea Profile Searchbox
Author: Trupoli AG
Version: 1.2
Author URI: http://www.trupoli.com
License: GPL 2.0, @see http://www.gnu.org/licenses/gpl-2.0.html
*/

function pp_searchbox_init() {

	// check for the required WP functions, die silently for pre-2.2 WP.
	if ( !function_exists('wp_register_sidebar_widget') )
		return;

	// front end view
	function pp_searchbox($args) {
		extract($args);

       $options = get_option('pp_searchbox');


	$title = htmlspecialchars($options['title'], ENT_QUOTES);
	$buttontext = htmlspecialchars($options['buttontext'], ENT_QUOTES);
	$banner = htmlspecialchars($options['banner'], ENT_QUOTES);
	$region = htmlspecialchars($options['region'], ENT_QUOTES);
	$party = htmlspecialchars($options['party'], ENT_QUOTES);
	$tags = htmlspecialchars($options['tags'], ENT_QUOTES);

		// the widget's form, themeable through $args
		echo $before_widget . $before_title . $title . $after_title;
		echo '<div id="pp-searchbox">';
		echo '
   <style type="text/css">
     #pp-searchbox {margin-top:5px;border:1px solid #194E86;padding:5px;}
     .pp-form select , .pp-form .field {width:157px}
     .pp-grey {color:#999999}
     #sidebar .pp-form .checkbox_after_radio {margin-left:22px;display:block;}
   </style>
   
   ';
   if( $banner == 1) { echo '<a href="http://www.polixea-profile.de/" title="Polixea Profile"><img src="http://www.polixea-profile.de/images/de_DE/banner/blue_polixea_234x60.gif" width="100%" alt="Polixea Profile" /></a><br /><br />'; }
   echo "<form action=\"http://www.polixea-profile.de/politiker/suche\" class=\"edit_politician_search_params\" id=\"edit_politician_search_params_1\" method=\"get\" onsubmit=\"if(getElementById('politician_search_params_position').value=='z.B. Stadt, Ort, Plz') {getElementById('politician_search_params_position').value='';} if(getElementById('politician_search_params_query').value=='z.B. Politikername') {getElementById('politician_search_params_query').value='';}\">      
   ";

  if( $region == 1) { echo' 
    <div class="pp-form">
       <strong>Regionale Begrenzung</strong>
     </div>
     <div class="pp-form">
     <input checked="checked" name="politician_search_params[location_type]" type="radio" value="placemark" />
     <select id="politician_search_params_placemark" name="politician_search_params[placemark]" onclick="setLocationFilterPlacemark(); ">
       <option value="">Alle Bundesl&auml;nder &amp; St&auml;dte</option>
       <option value="-">--- Bundesl&auml;nder ---</option>
       <option value="Baden-W&uuml;rttemberg">Baden-W&uuml;rttemberg</option>
       <option value="Bayern">Bayern</option>
       <option value="Berlin">Berlin</option>
       <option value="Brandenburg">Brandenburg</option>
       <option value="Bremen">Bremen</option>
       <option value="Hamburg">Hamburg</option>
       <option value="Hessen">Hessen</option>
       <option value="Mecklenburg-Vorpommern">Mecklenburg-Vorpommern</option>
       <option value="Niedersachsen">Niedersachsen</option>
       <option value="Nordrhein-Westfalen">Nordrhein-Westfalen</option>
       <option value="Rheinland-Pfalz">Rheinland-Pfalz</option>
       <option value="Saarland">Saarland</option>
       <option value="Sachsen">Sachsen</option>
       <option value="Sachsen-Anhalt">Sachsen-Anhalt</option>
       <option value="Schleswig-Holstein">Schleswig-Holstein</option>
       <option value="Thüringen">Th&uuml;ringen</option>
       <option value="-">--- Wichtige St&auml;dte ---</option>
       <option value="Berlin">Berlin</option>
       <option value="Bremen">Bremen</option>
       <option value="Dresden">Dresden</option>
       <option value="D&uuml;sseldorf">D&uuml;sseldorf</option>
       <option value="Erfurt">Erfurt</option>
       <option value="Hamburg">Hamburg</option>
       <option value="Hannover">Hannover</option>
       <option value="Kiel">Kiel</option>
       <option value="Magdeburg">Magdeburg</option>
       <option value="Mainz">Mainz</option>
       <option value="M&uuml;nchen">M&uuml;nchen</option>
       <option value="Potsdam">Potsdam</option>
       <option value="Saarbr&uuml;cken">Saarbr&uuml;cken</option>
       <option value="Schwerin">Schwerin</option>
       <option value="Stuttgart">Stuttgart</option>
       <option value="Wiesbaden">Wiesbaden</option>



     </select>
   </div>
     <div class="pp-form">
     <input class="float_left" id="politician_search_params_location_type_around" name="politician_search_params[location_type]" type="radio" value="around" />
     <input class="field city pp-grey" id="politician_search_params_position" name="politician_search_params[position]" value="z.B. Stadt, Ort, Plz" size="30" type="text" ';
     echo "onfocus=\"if(this.value=='z.B. Stadt, Ort, Plz') {this.value=''; $(this).addClassName('pp-grey');}\" ";
     echo "onblur=\"if(this.value.strip()=='') {this.value='z.B. Stadt, Ort, Plz';$(this).removeClassName('pp-grey');}\" ";
     echo ' />
     <input type="hidden" name="politician_search_params[radius]" value="50" />
   </div>
   <br />';
   }

  if( $party == 1) { echo' 
   <div class="pp-form">
     <strong>Parteien</strong>
   </div>
     <div class="pp-form">
     <label> 
       <input checked="checked" id="politician_search_params_party_filter_off" name="politician_search_params[party_filter]" type="radio" value="off" />
       Alle Parteien
     </label>
   </div>

   <div class="pp-form">
     <label>
       <input id="politician_search_params_party_filter_on" name="politician_search_params[party_filter]" type="radio" value="on" />
       Bestimmte Parteien
     </label>

     <span class="checkbox_after_radio">
       <label>
         <input id="parties_CDU" name="politician_search_params[parties][]" onclick="setPartyFilterOn()" type="checkbox" value="CDU" />
         CDU
       </label>
     </span>
         <span class="checkbox_after_radio">
       <label>
         <input id="parties_CSU" name="politician_search_params[parties][]" onclick="setPartyFilterOn()" type="checkbox" value="CSU" />
         CSU
       </label>
     </span>
         <span class="checkbox_after_radio">
       <label>
         <input id="parties_SPD" name="politician_search_params[parties][]" onclick="setPartyFilterOn()" type="checkbox" value="SPD" />
         SPD
       </label>
     </span>
         <span class="checkbox_after_radio">
       <label>
         <input id="parties_GRUENE" name="politician_search_params[parties][]" onclick="setPartyFilterOn()" type="checkbox" value="GR&Uuml;NE" />
         GR&Uuml;NE
       </label>
     </span>
         <span class="checkbox_after_radio">
       <label>
         <input id="parties_FDP" name="politician_search_params[parties][]" onclick="setPartyFilterOn()" type="checkbox" value="FDP" />
         FDP
       </label>
     </span>

     <span class="checkbox_after_radio">
       <label>
         <input id="parties_LINKE" name="politician_search_params[parties][]" onclick="setPartyFilterOn()" type="checkbox" value="LINKE" />
         LINKE
       </label>
     </span>
   </div>

  <br /> ';    }

  if( $tags == 1) { echo' 
   <div class="pp-form">
     <label><strong>Weitere Stichw&ouml;rter</strong>
       <input class="field pp-grey" id="politician_search_params_query" name="politician_search_params[query]" size="30" value="z.B. Politikername" type="text"  ';
     echo "onfocus=\"if(this.value=='z.B. Politikername') {this.value=''; $(this).addClassName('pp-grey');}\" ";
     echo "onblur=\"if(this.value.strip()=='') {this.value='z.B. Politikername';$(this).removeClassName('pp-grey');}\" ";
     echo ' />
     </label>
   </div>

  <br />'; }
  if( $party == 1 || $tags == 1 || $region == 1) {echo '  
<div class="pp-form">
 <input type="submit" class="btn btn_show_results" alt="Suche" value="';
echo $buttontext;
echo '" />
</div>'; }

echo '</form> ';
		echo '</div>';
		echo $after_widget;
	}

	// back end controller
	function pp_searchbox_control() {
       
            $options = get_option('pp_searchbox');
	     if ( !is_array($options) )
	         $options = array('title'=>'Politiker-Suche',
				      'buttontext'=>'Politiker suchen',
				      'banner'=>'1',
				      'region'=>'1',
				      'party'=>'1',
				      'tags'=>'1');

	     if ( $_POST['pp_searchbox-submit'] ) {
	         $options['title'] = strip_tags(stripslashes($_POST['pp_searchbox-title']));
	         $options['buttontext'] = strip_tags(stripslashes($_POST['pp_searchbox-buttontext']));
	         $options['banner'] = strip_tags(stripslashes($_POST['pp_searchbox-banner']));
	         $options['region'] = strip_tags(stripslashes($_POST['pp_searchbox-region']));
	         $options['party'] = strip_tags(stripslashes($_POST['pp_searchbox-party']));
	         $options['tags'] = strip_tags(stripslashes($_POST['pp_searchbox-tags']));
                update_option('pp_searchbox', $options);
            }

	$title = htmlspecialchars($options['title'], ENT_QUOTES);
	$buttontext = htmlspecialchars($options['buttontext'], ENT_QUOTES);
	$banner = htmlspecialchars($options['banner'], ENT_QUOTES);
	$region = htmlspecialchars($options['region'], ENT_QUOTES);
	$party = htmlspecialchars($options['party'], ENT_QUOTES);
	$tags = htmlspecialchars($options['tags'], ENT_QUOTES);

		echo '<p style="text-align:right;">'.
		'<label for="pp_searchbox-bottontext">Button:'.
		' <input style="width: 200px;" id="pp_searchbox-buttontext"
		name="pp_searchbox-buttontext" type="text" value="'.
		$buttontext.'" /></label></p>';
		echo '<p style="text-align:right;">'.
		'<label for="pp_searchbox-title">Title:'.
		' <input style="width: 200px;" id="pp_searchbox-title"
		name="pp_searchbox-title" type="text" value="'.
		$title.'" /></label></p>';

		echo '<p>'.
		'<label for="pp_searchbox-banner">'.
		' <input id="pp_searchbox-banner"
		name="pp_searchbox-banner" type="checkbox" value="1" ';
             if($banner == 1) { echo "checked='checked'"; }
             echo ' /> Polixea Profile Banner anzeigen</label></p>';

		echo '<p>'.
		'<label for="pp_searchbox-region">'.
		' <input id="pp_searchbox-region"
		name="pp_searchbox-region" type="checkbox" value="1" ';
             if($region == 1) { echo "checked='checked'"; }
             echo ' /> Region-Filter anzeigen</label></p>';

		echo '<p>'.
		'<label for="pp_searchbox-party">'.
		' <input id="pp_searchbox-party"
		name="pp_searchbox-party" type="checkbox" value="1" ';
             if($party == 1) { echo "checked='checked'"; }
             echo ' /> Partei-Filter anzeigen</label></p>';

		echo '<p>'.
		'<label for="pp_searchbox-tags">'.
		' <input id="pp_searchbox-tags"
		name="pp_searchbox-tags" type="checkbox" value="1" ';
             if($tags == 1) { echo "checked='checked'"; }
             echo ' /> Stichwort-Feld anzeigen</label></p>';

		echo '<input type="hidden" id="pp_searchbox-submit"
		name="pp_searchbox-submit" value="1" />';

		echo "<br /><strong>Werfen Sie einen Blick auf die <a href='http://www.polixea-profile.de/info/polixea_profile_einbinden'>Polixea Profile Banner-Seite</a></strong><br /><br />";
}


	// let WP know of this plugin's widget view entry
	wp_register_sidebar_widget('pp_searchbox', 'Polixea Profile Searchbox', 
        'pp_searchbox', 
	     array(
        	'classname' => 'pp_searchbox', 
        	'description' =>'Integriert einen Filter um nach deutschen Politikern zu suchen'.
        	        	' (c) by Polixea Profile'
	    )
        );

	// let WP know of this widget's controller entry
	wp_register_widget_control('pp_searchbox', 'Polixea Profile Searchbox', 
        'pp_searchbox_control', 
	    array(
        	'width' => 300
	    )
        );
}


add_action('widgets_init', 'pp_searchbox_init');

?>
