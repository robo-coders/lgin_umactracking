<!--begin::Modal-->
<div class="modal fade" id="requestDeleteByRequestor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Warning &nbsp;<i class="flaticon-warning"></i></h5> 
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				</button>
			</div>
			<form action="{{ route('deleteByRequestor') }}" method="post">
				@csrf
				<div class="modal-body">
					<p>Are you sure you want to delete?</p>
	             	<input type="hidden" name="dell_id" id="dell_id" value="">
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-danger btn-sm">Delete</button>
				</div>
			</form>
		</div>
	</div>
</div>

<!--end::Modal-->
