<?php
error_reporting(E_ALL ^ E_NOTICE);

$path = './';

$url = $_SERVER['REQUEST_URI'];

if (isset($_GET['dir'])){
  $path = $_GET['dir'];
} else{
  $url = $url.'?dir=.';
}
/*
*@para ROOTFOLDER
*ROOTFOLDER should be updated to the actual root folder during deployment
*For safety concerns, do NOT allow clients to access upper levels of folder manually
*/
echo realpath($path);
if (strpos(realpath($path), 'ROOTFOLDER') == false){
  echo 'NO ACCESS!';
  exit();
}


echo '<hr />';
echo 'current path is: ', $path;

echo '<hr />';
echo 'current _GET[\'dir\'] is: ',$_GET['dir'];
$dh = opendir($path);
if ($dh === false) {
  echo 'Sorry! There\'s an error. Please try again later';
  exit;
}

$item = readdir($dh);
while (($item = readdir($dh))!==false) {
$list[] = $item;
}

echo '<hr />';
echo 'current $list is: <br />';
print_r($list);
echo '<hr />';

closedir($dh);
?>
<!DOCTYPE html>
<html>
<head>
  <title></title>
  <style type="text/css">
    td {
      border: 1px solid grey;
    }
  </style>
</head>
<body>
  <h1>File System</h1>
  <table>
    <tr>
      <td>No.</td>
      <td>File Name</td>
      <td>Action</td>
    </tr>
    <?php foreach ($list as $key => $value) {
      echo '<tr>';

      echo '<td>',$key,'</td>';
      echo '<td>',$value,'</td>';
      echo '<td>';
      if (is_dir($path . '/'.$value)){
        echo '<a href="',$url,'/',$value,'">Browser</a>';
      } else {
        echo '<a href="',$_GET['dir'],'/',$value,'">View</a>';
      }
      echo '</td>';
      echo '</tr>';
    } ?>
  </table>
  <?php echo '<hr />';
echo 'current $url is: ',$url; ?>
</body>
</html>