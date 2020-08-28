<?php
function get_full_map() {
  global $wpdb;

  $result = "<div id='map' style='width: 1000px; height: 500px; border: 1px solid #AAA;'></div>
	<script>
		var map = L.map( 'map', {
		  center: [50.9, 4.5],
		  minZoom: 2,
		  zoom: 8
		});

		L.tileLayer( 'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
		 attribution: '&copy; <a href=\"https://www.openstreetmap.org/copyright\">OpenStreetMap</a>',
		 subdomains: ['a','b','c']
		}).addTo( map );

		var myIcon = L.icon({
		  iconUrl: '/wp-content/plugins/octoform/assets/leaflet/images/pin24.png',
		  iconRetinaUrl: '/wp-content/plugins/octoform/assets/leaflet/images/pin48.png',
		  iconSize: [29, 24],
		  iconAnchor: [9, 21],
		  popupAnchor: [0, -14]
		});

		var markerClusters = L.markerClusterGroup();";

		if (current_user_can('administrator')) {
			$conn = $wpdb->get_results("SELECT * FROM wp_markers");
		} else {
			$conn = $wpdb->get_results("SELECT * FROM wp_markers WHERE group_id=" . get_groupid());
      $l = '';
		}

		foreach ($conn as $c) {
      if (current_user_can('administrator')) {
        $l = '<br><br><form action="" method="post"><input type="hidden" name="method" value="mdelete"><input type="hidden" name="marker_id" value="'.$c->ID.'"><input type="submit" value="Verwijder" class="del"></form>';
      }
			$result .= "
			var popup = '<b>' + '". $c->name ."' + '</b>'+
		              '<br>' + '". $c->location ."' +
		              '<br><br><b>Beschrijving:</b> ' + '". $c->description ."' + '". $l ."';

		  var m = L.marker( [". $c->lat .", ". $c->lng ."], {icon: myIcon} )
		                  .bindPopup( popup );

		  markerClusters.addLayer( m );";
		}

		$result .= "map.addLayer( markerClusters );
	</script>";

  return $result;
}
