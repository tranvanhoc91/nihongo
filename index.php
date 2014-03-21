<?php
define( '_JEXEC', 1 );
define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(dirname(__FILE__)));
define('MODULE', 'modules');
define('COMPONENT', 'components');
define('TMPL', 'templates');

require_once('admin/base/class.request.php');
require_once('admin/base/class.message.php');
require_once('admin/base/class.database.php');
require_once('admin/base/class.pagination.php');
require_once('admin/base/class.session.php');
require_once('admin/base/class.site.php');
require_once('admin/base/class.user.php');
require_once('admin/base/class.module.php');
require_once 'admin/require.php';
//require_once 'libraries/functions/readnumber.php';

$dbo = new Database();
//$uob = new User();



$format = Request::get('format');
if($format=='json') {
	header('Content-Type:application/json');
	$siteDocument = new SiteJsonDocument();
}
else $siteDocument = new SiteDocument();
echo $siteDocument->render();


if(!$QUERY_STRING) {
	// sử dụng điều kiện này để tiếp tục dùng
	//đường dẫn kiểu truy vấn.
	$url=strip_tags($REQUEST_URI);
	$url_array=explode("/",$url);
	// vì chúng ta sử dụng $REQUEST_URI nên $url_array luôn có giá trị đầu rỗng
	// sử dụng array_shift() để cắt giá trị đầu tiên
	array_shift($url_array);
	// gán các giá trị tương ứng lấy từ đường dẫn ảo
	$_REQUEST[view] = $url_array[0];
}


?>