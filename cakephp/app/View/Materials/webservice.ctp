
<?php

// print_r( $materials);

foreach ($materials as $material) {
   // unset($material['Material']['id']);
   echo $material['Material']['id'];
}
// echo json_encode(compact('materials', 'id'));

?>
