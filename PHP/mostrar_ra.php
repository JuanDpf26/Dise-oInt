<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <title>Realidad Aumentada</title>
  <script src="https://aframe.io/releases/1.2.0/aframe.min.js"></script>
  <script src="https://cdn.rawgit.com/AR-js-org/AR.js/3.3.2/aframe/build/aframe-ar.min.js"></script>
</head>
<body style="margin: 0; overflow: hidden;">

  <a-scene embedded arjs="sourceType: webcam;">
    <a-camera gps-camera rotation-reader></a-camera>
    <a-entity 
      gps-entity-place="latitude: <?= $_GET['lat'] ?>; longitude: <?= $_GET['lng'] ?>;"
      text="value: Aquí está tu destino; color: red;"
      scale="20 20 20">
    </a-entity>
  </a-scene>

</body>
</html>