<!-- header -->

<?php
$this->load->view('templates/header')

?>

<!-- end header -->
<?php
$this->load->view('templates/topbar')

?>

<?php
$this->load->view('templates/sidebar')

?>


<!-- menu -->

<?php
$this->load->view('templates/footer');
?>
<div class="container-fluid">
    <?php echo $contents; ?>

</div>

<!-- end menu -->