<?php
require_once('data_entity.php');

$keys = array('foo'=>'adfasdf', 'id'=>'xyz', '10'=>'aaa', 'bar'=>'hahaah');
// khong nên đặt key là số
// $a = array_fill_keys($keys, 'banana');

// learn foreach
// $arr1 = array("a" => 0, "b" => 2, "c" => 3);
// $arr2 = array("x" => 4, "y" => 5, "z" => 6);

// foreach ($arr1 as $key => &$val) {
// 	print('key: '.$key); //$key là thứ tự trong mảng
// 	print('\n value: '.$val); //$value là giá trị của $arr1[key]

// }


$t=array();
$b=new data_entity($t);
print("b: ");
print_r($b);

print("<p>end b.</p>");

// learn data_entity
$a=$keys;

print('<pre>');
print_r($a);
print('</pre>');
print('a[foo]:  '.$a['foo']);
print("<p></p>");
$data= new data_entity($a);

print('<p> type of data: '.gettype($data)."</p>");
print('<pre>');
print_r($data);
print('</pre>');
print_r('<p>$data->foo: '.$data->foo.'</p>');
// nếu đặt key là số thì ở đây $data->số sẽ bị lỗi.




//test 2
require_once('connect.php');

$sql= 'select * from roomtype';
$result=mysqli_query($conn,$sql);
$roomtypes=array();
if($result){
	while($row = mysqli_fetch_array($result)){
		$type = new data_entity($row);
		$roomtypes[]=$type;
	}
}
else{
	print("room type model - slect:  loi");
}
print("<p>dữ liệu của roomtypess: </p>");
print('<pre>');
print_r($roomtypes);
print('</pre>');

print("<p>lấy dữ liệu của roomtypess bằng foreach: </p>");
foreach ($roomtypes as $key => $value) {
# code...
	print('<p>');
	print('\nkey: '.$key);
	print('   ---  ');
	print("\n | value->id: ".$value->id);
	print("\n | value->name: ".$value->typeName);

	print('</p>');
};
?>


