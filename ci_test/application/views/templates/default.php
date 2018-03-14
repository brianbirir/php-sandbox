<!DOCTYPE html>

<html>
    <!-- Head -->
    <?php
        $this->load->view('partials/head');
    ?>

    <body>
    	<!-- Header -->
	    <?php
	        $this->load->view('partials/header');
	    ?>

        <div class="container">
        	<section class="main-content">
        		<?php echo $body; ?>
        	</section>
        </div>

        <?php
            $this->load->view('partials/footer');
        ?>
    </body>
</html>
