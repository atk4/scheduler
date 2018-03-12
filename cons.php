<?PHP

require 'vendor/autoload.php';

$app = new App('public');

$teacher=new Model\Teacher($app->db);
$teacher->load($app->stickyGet('id'));

//$t = new \atk4\core\DebugTrait;
$t = $app->add(['Console']);
$where = 'http://localhost/scheduler/print.php?id='.$_GET['id']; //local
//$where = 'https://vecaku-diena.herokuapp.com/print.php?id='.$_GET['id']; //not local
$file_name = '/tmp/'.$teacher['name'].'.pdf';
$de_way = '/usr/local/bin/wkhtmltopdf';
$request = $de_way.' "'.$where.'" "'.$file_name.'"';
echo $request;
$t->exec($request);
header('Location: open.php?id='.$_GET['id']);
$t->exec('open '.'"'.$file_name.'"');
//$t->exec('/usr/local/bin/wkhtmltopdf http://localhost/scheduler/print.php?id=243 /tmp/sqkirskir.pdf');
//$t->exec('open '.'/tmp/sqkirskir.pdf');
//$t->exec('open /Applications/XAMPP/xamppfiles/htdocs/scheduler/logo.png');
