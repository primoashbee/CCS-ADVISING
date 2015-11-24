<?

$array = array('ñ'=>'Paição','cidade'=>'São Paulo');

$array = array_map('htmlentities',$array);

//encode
$json = html_entity_decode(json_encode($array));

//Output: {"nome":"Paição","cidade":"São Paulo"}
echo json_encode($array);

?>