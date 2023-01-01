<form method="post">
	@csrf
	<input type="hidden" name="type" value="Harta Karun">
	<h6 class="mt-3">Harta Karun</h6>
	<div class="row align-items-center">
		<div class="col-md-6 mb-2">
			<label>Nilai Harta</label>
		</div>
		<div class="col-md-6 mb-2">
			<div class="input-group">
				<div class="input-group-append">
					<span class="input-group-text">Rp</span>
				</div>
				<input type="text" class="form-control rupiah" name="total_treasure" id="total_treasure5" required="">
			</div>
		</div>
		<div class="col-md-6 mb-2">
			<label>Zakat</label>
		</div>
		<div class="col-md-6 mb-2">
			<div class="input-group">
				<div class="input-group-append">
					<span class="input-group-text">Rp</span>
				</div>
				<input type="text" class="form-control rupiah" readonly="" name="zakat" id="zakat5">
			</div>
		</div>
	</div>
</form>

<hr>

@push('js')
<script type="text/javascript">
	let zakat5 = 0;
	let factor5 = 0.2;

	$(document).ready(function(){

		drawToView5();

		$("#total_treasure5").on("keyup", function(){
			try{
				let total_treasure = $(this).val().replaceAll(".", "");
				zakat5 = convertToRupiah(total_treasure * factor5);

				$("#r-total-harta").html(convertToRupiah(total_treasure));
				$("#r-total-Kewajiban").html("0");
				$("#r-selisih").html(convertToRupiah(total_treasure));
				drawToView5();
			}catch(e){
				console.log(e);
				drawToView5();
			}
		})
	})

	function drawToView5(){
		if(zakat5 > 0){
			$("#btn-zakat").prop('disabled', false);
		}else{
			$("#btn-zakat").prop('disabled', true);
		}
		$("#zakat5").val(zakat5);
		$("#r-nominal-zakat").html(zakat5);
	}
</script>
@endpush
