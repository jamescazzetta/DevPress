<div id="log-wrapper">
	<div id="log"><?php echo file_get_contents('infos.log');	 ?></div>
</div>
<script>
	document.getElementById('log').scrollTop = 9999999;	
</script>