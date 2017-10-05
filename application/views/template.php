<!DOCTYPE html>
<html>
<?php
$this->load->view('Templates/header_script');
?>
 <body class="hold-transition skin-red sidebar-mini">
 <div class="wrapper">
 <?php

	 $this->load->view('Templates/header-menu');
	 $this->load->view('Templates/left-menu');
	 $this->load->view($page);
	 $this->load->view('Templates/footer');


?>

<?php
$this->load->view('Templates/footer_script');

?>
  </body>
</html>
