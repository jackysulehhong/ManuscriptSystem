<?php
include("shared/layout/header.php");
?>



<div class="container-fluid">
 <div class="container pt-5">
  <div class="table-responsive">
   <table class="table" id="example">
    <thead>
     <tr>
      <th>Year</th>
      <th>Negeri</th>
      <th>BIRADS 0</th>
      <th>35-39 Tahun</th>
      <th>40-44 Tahun</th>
      <th>45-49 Tahun</th>
      <th>50-54 Tahun</th>
      <th>55-59 Tahun</th>
      <th>60-64 Tahun</th>
      <th>65-69 Tahun</th>
      <th>70-74 Tahun</th>
      <th>75 + Tahun</th>
     </tr>
    </thead>
    <tbody></tbody>
   </table>


  </div>
 </div>
 <div class="py-5">
  <div id="map" style="height: 500px;"></div>
 </div>
</div>
<script src="./shared/script/jquery-3.5.1.js"></script>
<script src="./shared/script/bootstrap.bundle.min.js"></script>
<script src="./shared/script/jquery.dataTables.min.js"></script>
<script src="./shared/script/dataTables.buttons.min.js"></script>
<script src="./shared/script/dataTables.bootstrap5.min.js"></script>

<script async
 src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA1G5jv_wQAv9dgavsoI5S_tlSemSw3o4M&libraries=visualization&callback=initMap">
</script>
<script>
$(document).ready(function() {

 $('#example').DataTable({
  dom: 'Bfrtip',
  ajax: "import.php",

  drawCallback: function(settings) {
   // Here the response
   var response = settings.json;
   console.log(response);
  },
  columns: [{
   "data": '2019'
  }, {
   "data": 'Negeri'
  }, {
   "data": 'BIRADS 0'
  }, {
   "data": '35-39 Tahun'
  }, {
   "data": '40-44 Tahun'
  }, {
   "data": '45-49 Tahun'
  }, {
   "data": '50-54 Tahun'
  }, {
   "data": '55-59 Tahun'
  }, {
   "data": '60-64 Tahun'
  }, {
   "data": '65-69 Tahun'
  }, {
   "data": '70-74 Tahun'
  }, {
   "data": '75 + Tahun'
  }],
  "columnDefs": [{
    "searchable": false,
    "targets": [0, 2]
   },
   {
    orderable: false,
    targets: 0
   }
  ],
  //https://datatables.net/forums/discussion/53287/how-to-reset-values-in-individual-column-searching-text-inputs-at-a-button-click
  initComplete: function() {
   this.api().columns([1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11]).every(function() {
    var column = this;
    var select = $('<select class="select-filter"><option value=""></option></select>')
     .appendTo($(column.header()))
     .on('change', function() {
      var val = $.fn.dataTable.util.escapeRegex(
       $(this).val()
      );

      column
       .search(val ? '^' + val + '$' : '', true, false)
       .draw();
     });

    column.data().unique().sort().each(function(d, j) {
     select.append('<option value="' + d + '">' + d + '</option>')
    });
   });
  },
  buttons: [{


   text: 'My button',
   action: function(e, dt, node, config) {
    alert('Button activated');
   }
  }, {
   text: 'Reset',
   className: 'btn btn-warning',
   header: true,
   action: function(e, dt, node, config) {


    $(".select-filter").each(function() {
     $(this).val('');
    })

    dt.columns().every(function() {
     var column = this;
     column
      .search('')
    });

    dt.search('').draw();

   }
  }]
 });
});
</script>
<!--<script>
let map, heatmap;
// Initialize and add the map
function initMap() {


 var heatMapData = [{
   location: new google.maps.LatLng(37.782, -122.447),
   weight: 0.5
  },
  new google.maps.LatLng(37.782, -122.445),
  {
   location: new google.maps.LatLng(37.782, -122.443),
   weight: 2
  },
  {
   location: new google.maps.LatLng(37.782, -122.441),
   weight: 3
  },
  {
   location: new google.maps.LatLng(37.782, -122.439),
   weight: 2
  },
  new google.maps.LatLng(37.782, -122.437),
  {
   location: new google.maps.LatLng(37.782, -122.435),
   weight: 0.5
  },

  {
   location: new google.maps.LatLng(37.785, -122.447),
   weight: 3
  },
  {
   location: new google.maps.LatLng(37.785, -122.445),
   weight: 2
  },
  new google.maps.LatLng(37.785, -122.443),
  {
   location: new google.maps.LatLng(37.785, -122.441),
   weight: 0.5
  },
  new google.maps.LatLng(37.785, -122.439),
  {
   location: new google.maps.LatLng(37.785, -122.437),
   weight: 2
  },
  {
   location: new google.maps.LatLng(37.785, -122.435),
   weight: 3
  }
 ];

 map = new google.maps.Map(document.getElementById("map"), {
  zoom: 13,
  center: {
   lat: 37.775,
   lng: -122.434
  },
  mapTypeId: "satellite",
 });
 heatmap = new google.maps.visualization.HeatmapLayer({
  data: heatMapData,
  map: map,
 });
}
</script>-->
<!-- Make sure you put this AFTER Leaflet's CSS -->

</body>