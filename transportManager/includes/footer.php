</div>
	<footer class="navbar navbar-default text-center" id="footer">
		Copyright &copy;TransportManager
	</footer>
	<script type="text/javascript">
		function detailsmodal(id) {
			var data={"id" : id};
			jQuery.ajax({
				url :'/transportManager/includes/detailsmodal.php',
				method : "post",
				data :data,
				success : function(data)
				{
					jQuery('body').append(data);
					jQuery('#details-modal').modal('toggle');
				},
				error: function(){
					alert("something went wrong");
				}
			});
		}
	</script>
</body>
