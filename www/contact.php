<?php
  require(dirname(__FILE__).'/../config.php');
  HTML_HEAD(['<link rel="stylesheet" type="text/css" href="https://unpkg.com/leaflet@1.0.2/dist/leaflet.css">']);
?>

<body>

<?php HTML_HEADER(); ?>

<main role="main">
<section class="section contact-info-section" id="contacts">
  <div class="contact-info">
    <h2>Контакты</h2>
    <p class="contact-info-email">
      <a href="mailto:info@vibrobox.com">info@vibrobox.com</a>
    </p>
    <div class="info-block">
      <h3>Главный офиc:</h3>
      <p>
        <span>VibroBox OÜ</span>
        <span>Бульвар Равала 8, офис 810, Таллин, 10143, Эстония</span>
      </p>
      <p class="phone-group">
        <span>
        Тел.:<a href="tel:+372 602 7122">+372 602 7122</a>
        </span>
      </p>
    </div>
    <div class="info-block">
      <h3>Центр разработки:</h3>
      <p>
        <span>ООО «Сител»</span>
        <span>Логойский тракт 22A/2, офис 402, г. Минск, 220090, Беларусь</span>
      </p>
      <p class="phone-group">
        <span>
        Тел.:<a href="tel:+375 29 176 83 35">+375 29 176 83 35</a>
        </span>
      </p>
    </div>
    <footer class="footer">
      <p class="copyright">VibroBox © 2015-2017</p>
    </footer>
  </div>
  <!-- Map is rendered here by leaflet and our map.js script. -->
  <div class="map-canvas" id="map-canvas"></div>
</section>
</main>

<?php HTML_FOOTER(); ?>

<!-- Code which renders leaflet map with #map-canvas id above. It's here for localization. -->
<script type="text/javascript" src=https://unpkg.com/leaflet@1.0.2/dist/leaflet.js></script>
<script type="text/javascript">
  var mymap = L.map('map-canvas', {scrollWheelZoom: false}).setView([56.717, 24.840], 5);
  L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1Ijoidmlicm9ib3giLCJhIjoiY2l3Njhib2tqMDAwbzJ5czAxYTN4ZWt6dyJ9.1CqJcnto4oJNbHLvwzxc5A', {
    attribution: 'Map data © <a href="http://openstreetmap.org/">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="http://mapbox.com/">Mapbox</a>',
    maxZoom: 19,
    id: 'vibrobox.28m6igh7',
    accessToken: 'pk.eyJ1Ijoidmlicm9ib3giLCJhIjoiY2l3Njhib2tqMDAwbzJ5czAxYTN4ZWt6dyJ9.1CqJcnto4oJNbHLvwzxc5A',
    detectRetina: true}).addTo(mymap);
  var strHeadquarters = '{{ T "headquarters" }}';
  var strDevelopmentOffice = '{{ T "developmentOffice" }}';
  var tallinn = L.marker([59.43411, 24.75434], {title: strHeadquarters, alt: strHeadquarters}).addTo(mymap);
  tallinn.bindPopup("<p>" + strHeadquarters + "</p>");
  var minsk = L.marker([53.94678, 27.61623], {title: strDevelopmentOffice, alt: strDevelopmentOffice}).addTo(mymap);
  minsk.bindPopup("<p>" + strDevelopmentOffice + "</p>");
</script>

</body>
</html>
