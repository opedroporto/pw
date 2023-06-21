		
	</main> <!-- /container -->

	<hr>
		<footer class="container">
			<?php $d = new DateTime ('now'); ?>
			<p>&copy;<?php echo $d->format("Y"); ?> - Pedro Porto e Nicolas Celestino</p>
		</footer>

		<script src="<?php echo BASEURL; ?>js/jquery-3.6.0.min.js"></script>
		<script src="<?php echo BASEURL; ?>js/popper.min.js"></script>
		<script src="<?php echo BASEURL; ?>js/awesome/all.min.js"></script>
		<script src="<?php echo BASEURL; ?>js/bootstrap/bootstrap.min.js"></script>

		<script src="<?php echo BASEURL; ?>js/main.js"></script>
	</body>
	<div id="footer-section">
		<a target="_blank" href="https://github.com/opedroporto/pw">
			<button id="btn-github" type="button" class="btn" data-bs-toggle="tooltip" data-bs-placement="left" title="Ver código fonte">
				<img src="/assets/github.png"></img>
			</button>
	</a>
	</div>
</html>

<?php ob_end_flush(); ?>