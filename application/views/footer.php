<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    $this->load->helper('url'); //For base URL
?>
			</section>
		</main>

		<footer>
			< footer > <br><br>
			<?php
			if(isset($this->session->id) )
			{
				foreach ($_SESSION as $key=>$val)
				if(is_array($val))
				{
					echo $key.": array count: ".count($val)."<br/>";
				}
				else{
					
					echo $key.": ".$val."<br/>";
				}
			}
			?>

		</footer>
	</body>
</html>
