<form method="post">
	@csrf
	<h6 class="mt-3">Yang dimiliki</h6>
	<div class="row align-items-center">
		<div class="col-md-6 mb-2">
			<label>Emas</label>
		</div>
		<div class="col-md-6 mb-2">
			<div class="input-group">
				<input type="text" class="form-control rupiah" id="quantity_gold2" name="quantity_gold">
				<div class="input-group-append">
					<span class="input-group-text">gram</span>
				</div>
			</div>
		</div>
		<div class="col-md-6 mb-2">
			<label>Perak</label>
		</div>
		<div class="col-md-6 mb-2">
			<div class="input-group">
				<input type="text" class="form-control rupiah" id="quantity_silver2" name="quantity_silver">
				<div class="input-group-append">
					<span class="input-group-text">gram</span>
				</div>
			</div>
		</div>
	</div>

	<h6 class="mt-3">Zakat</h6>
	<div class="row align-items-center">
		<div class="col-md-6 mb-2">
			<label>Zakat Emas</label>
		</div>
		<div class="col-md-6 mb-2">
			<div class="input-group">
				<input type="text" class="form-control rupiah" readonly="" id="zakat_gold2" name="zakat_gold">
				<div class="input-group-append">
					<span class="input-group-text">gram</span>
				</div>
			</div>
		</div>
		<div class="col-md-6 mb-2">
			<label>Zakat Perak</label>
		</div>
		<div class="col-md-6 mb-2">
			<div class="input-group">
				<input type="text" class="form-control rupiah" readonly="" id="zakat_silver2" name="zakat_silver">
				<div class="input-group-append">
					<span class="input-group-text">gram</span>
				</div>
			</div>
		</div>
	</div>

	<h6 class="mt-3">Yang harus dibayarkan</h6>
	<div class="row align-items-center">
		<div class="col-md-6 mb-2">
			<label>Harga 1 gram emas</label>
		</div>
		<div class="col-md-6 mb-2">
			<div class="input-group">
				<div class="input-group-append">
					<span class="input-group-text">Rp</span>
				</div>
				<input type="text" class="form-control rupiah" readonly="" value="{{ number_format($prices['gold'], 0, ',', '.') }}" name="gold_price">
			</div>
		</div>
		<div class="col-md-6 mb-2">
			<label>Harga 1 gram perak</label>
		</div>
		<div class="col-md-6 mb-2">
			<div class="input-group">
				<div class="input-group-append">
					<span class="input-group-text">Rp</span>
				</div>
				<input type="text" class="form-control rupiah" readonly="" value="{{ number_format($prices['silver'], 0, ',', '.') }}" name="silver_price">
			</div>
		</div>
		<div class="col-md-6 mb-2">
			<label>Zakat Emas</label>
		</div>
		<div class="col-md-6 mb-2">
			<div class="input-group">
				<div class="input-group-append">
					<span class="input-group-text">Rp</span>
				</div>
				<input type="text" class="form-control rupiah" readonly="" id="zakat_nominal_gold2" name="zakat_nominal_gold">
			</div>
		</div>
		<div class="col-md-6 mb-2">
			<label>Zakat Perak</label>
		</div>
		<div class="col-md-6 mb-2">
			<div class="input-group">
				<div class="input-group-append">
					<span class="input-group-text">Rp</span>
				</div>
				<input type="text" class="form-control rupiah" readonly="" id="zakat_nominal_silver2" name="zakat_nominal_silver">
			</div>
		</div>
		<div class="col-md-6 mb-2">
			<label>Total</label>
		</div>
		<div class="col-md-6 mb-2">
			<div class="input-group">
				<div class="input-group-append">
					<span class="input-group-text">Rp</span>
				</div>
				<input type="text" class="form-control rupiah" readonly="" id="total_zakat2" required="" name="zakat">
			</div>
		</div>
	</div>

</form>
<hr>

@push('js')
<script type="text/javascript">
	let factor2 = 0.025;
	let nishab2 = {
		gold: 85,
		silver: 595
	};
	let price2 = {
		gold: {{ $prices['gold'] }},
		silver: {{ $prices['silver'] }},
	};

	$(document).ready(function(){
		$("#quantity_gold2").on("keyup", function(){
			let value = $(this).val().replaceAll(".", "");
			let zakat_gold = 0;

			if(parseInt(value) >= nishab2.gold){
				zakat_gold = parseInt(value) * factor2;
			}
			$("#zakat_gold2").val(zakat_gold);
			calculateZakat2();
		})
		$("#quantity_silver2").on("keyup", function(){
			let value = $(this).val().replaceAll(".", "");

			let zakat_silver = 0;
			if(parseInt(value) >= nishab2.silver){
				zakat_silver = parseInt(value) * factor2;
			}
			$("#zakat_silver2").val(zakat_silver);
			calculateZakat2();
		})
	});

	function calculateZakat2(){
		let gold = $("#zakat_gold2").val();
		let silver = $("#zakat_silver2").val();

		if(gold == ""){
			gold = 0;
		}
		if(silver == ""){
			silver = 0;
		}
		let gold_price = parseFloat(gold) * price2.gold;
		let silver_price = parseFloat(silver) * price2.silver;
		let total = (gold_price + silver_price) * factor2;

		if(total > 0){
			$("#btn-zakat").prop('disabled', false);
		}else{
			$("#btn-zakat").prop('disabled', true);
		}

		$("#zakat_nominal_gold2").val(convertToRupiah(gold_price));
		$("#zakat_nominal_silver2").val(convertToRupiah(silver_price));

		$("#r-total-harta").html(convertToRupiah(gold_price + silver_price));
        $("#r-total-Kewajiban").html("0");
		$("#r-selisih").html(convertToRupiah(gold_price + silver_price));

		$("#total_zakat2").val(convertToRupiah(total));
		$("#r-nominal-zakat").html(convertToRupiah(total));
	}
</script>
@endpush
