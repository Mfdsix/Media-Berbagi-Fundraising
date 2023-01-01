<form method="post">
	<input type="hidden" name="type" value="Pertanian">
	@csrf
	<h6 class="mt-3">Hasil Panen</h6>
	<div class="row align-items-center">
		<div class="col-md-6 mb-2">
			<label>Hasil Panen</label>
		</div>
		<div class="col-md-6 mb-2">
			<div class="input-group">
				<input type="text" class="form-control rupiah" id="total_harvest4" name="total_harvest" onkeyup="calculateZakat4()">
				<div class="input-group-append">
					<span class="input-group-text">kg</span>
				</div>
			</div>
		</div>
		<div class="col-md-6 mb-2">
			<label>Jenis Pengairan</label>
		</div>
		<div class="col-md-6 mb-2">
			<div class="input-group">
				<select class="form-control" name="is_irrigated" id="is_irrigated" onchange="calculateZakat4()">
					<option value="0">tanpa biaya</option>
					<option value="1">dengan biaya</option>
				</select>
			</div>
		</div>
		<div class="col-md-6 mb-2">
			<label>Harga per kg</label>
		</div>
		<div class="col-md-6 mb-2">
			<div class="input-group">
				<div class="input-group-append">
					<span class="input-group-text">Rp</span>
				</div>
				<input type="text" class="form-control rupiah" id="quantity_price4" name="quantity_price" onkeyup="calculateZakat4()">
			</div>
		</div>
		<div class="col-md-6 mb-2">
			<label>Total Penjualan</label>
		</div>
		<div class="col-md-6 mb-2">
			<div class="input-group">
				<div class="input-group-append">
					<span class="input-group-text">Rp</span>
				</div>
				<input type="text" readonly="" class="form-control" id="total_price4" name="total_price">
			</div>
		</div>
	</div>

	<h6 class="mt-3">Zakat</h6>
	<div class="row align-items-center">
		<div class="col-md-6 mb-2">
			<label>Zakat</label>
		</div>
		<div class="col-md-6 mb-2">
			<div class="input-group">
				<div class="input-group-append">
					<span class="input-group-text">Rp</span>
				</div>
				<input type="text" class="form-control" readonly="" required="" id="zakat4" name="zakat">
			</div>
		</div>
	</div>

</form>

<hr>

@push('js')
<script type="text/javascript">
	let factor4 = 0.1;
	let nishab4 = 750;

	function calculateZakat4(){
		let price = $("#quantity_price4").val().replaceAll(".", "");
		let quantity = $("#total_harvest4").val().replaceAll(".", "");
		let is_irrigated = $("#is_irrigated").val();

		if(price == ""){
			price = 0;
		}
		if(quantity == ""){
			quantity = 0;
		}

		let total_price = parseInt(price) * parseInt(quantity);
		$("#total_price4").val(convertToRupiah(total_price));
		$("#r-total-harta").html(convertToRupiah(total_price));

		if(is_irrigated == 1){
			factor4 = 0.05;
		}else{
			factor4 = 0.1;
		}

		let zakat = 0;
		if(parseInt(price) >= nishab4){
			zakat = parseInt(total_price) * factor4;
		}
		if(zakat > 0){
			$("#btn-zakat").prop('disabled', false);
		}else{
			$("#btn-zakat").prop('disabled', true);
		}

		$("#zakat4").val(convertToRupiah(zakat));
		$("#r-total-harta").html(convertToRupiah(total_price));
		$("#r-total-Kewajiban").html("0");
		$("#r-selisih").html(convertToRupiah(total_price));
		$("#r-nominal-zakat").html(convertToRupiah(zakat));
	}
</script>
@endpush
