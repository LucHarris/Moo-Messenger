<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    $this->load->helper('url'); //For base URL
?>

		</main>

		<footer>
			< footer > <br><br>
			<?php
				foreach ($_SESSION as $key=>$val)
				echo $key." ".$val."<br/>";
			?>

		</footer>
	</body>
</html>
