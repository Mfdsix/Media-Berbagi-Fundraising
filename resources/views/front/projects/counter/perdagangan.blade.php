<form method="post">
	@csrf
	<input type="hidden" name="type" value="Perdagangan">
	<h6 class="mt-3">Nishab</h6>
	<div class="row align-items-center">
		<div class="col-md-6 mb-2">
			<label>Harga 1 gram emas</label>
		</div>
		<div class="col-md-6 mb-2">
			<div class="input-group">
				<div class="input-group-append">
					<span class="input-group-text">Rp</span>
				</div>
				<input type="text" class="form-control" readonly="" value="{{ number_format($prices['gold'], 0, ',', '.') }}" name="gold_price">
			</div>
		</div>
		<div class="col-md-6 mb-2">
			<label>Nishab</label>
		</div>
		<div class="col-md-6 mb-2">
			<div class="input-group">
				<div class="input-group-append">
					<span class="input-group-text">Rp</span>
				</div>
				<input type="text" class="form-control" readonly="" id="nishab3" name="nishab">
			</div>
		</div>
	</div>

	<h6 class="mt-3">Harta</h6>
	<div class="row align-items-center">
		<div class="col-md-6 mb-2">
			<label>Uang (cash, tabungan, dkk)</label>
		</div>
		<div class="col-md-6 mb-2">
			<div class="input-group">
				<div class="input-group-append">
					<span class="input-group-text">Rp</span>
				</div>
				<input type="text" class="form-control rupiah" id="quantity_money3" onkeyup="calculateTreasure3()" name="quantity_money">
			</div>
		</div>
		<div class="col-md-6 mb-2">
			<label>Stok Barang Dagangan</label>
		</div>
		<div class="col-md-6 mb-2">
			<div class="input-group">
				<div class="input-group-append">
					<span class="input-group-text">Rp</span>
				</div>
				<input type="text" class="form-control rupiah" id="quantity_stock3" onkeyup="calculateTreasure3()" name="quantity_stock">
			</div>
		</div>
		<div class="col-md-6 mb-2">
			<label>Piutang <sup class="text-danger">[1]</sup></label>
		</div>
		<div class="col-md-6 mb-2">
			<div class="input-group">
				<div class="input-group-append">
					<span class="input-group-text">Rp</span>
				</div>
				<input type="text" class="form-control rupiah" id="quantity_receivable3" onkeyup="calculateTreasure3()" name="quantity_receivable">
			</div>
		</div>
		<div class="col-md-6 mb-2">
			<label>Total Harta Kena Zakat</label>
		</div>
		<div class="col-md-6 mb-2">
			<div class="input-group">
				<div class="input-group-append">
					<span class="input-group-text">Rp</span>
				</div>
				<input type="text" class="form-control rupiah" readonly="" id="total_treasure3" name="total_treasure">
			</div>
		</div>
	</div>

	<h6 class="mt-3">Kewajiban</h6>
	<div class="row align-items-center">
		<div class="col-md-6 mb-2">
			<label>Hutang <sup class="text-danger">[2]</sup></label>
		</div>
		<div class="col-md-6 mb-2">
			<div class="input-group">
				<div class="input-group-append">
					<span class="input-group-text">Rp</span>
				</div>
				<input type="text" class="form-control rupiah" id="quantity_debt3" onkeyup="calculateObligation3()" name="quantity_debt">
			</div>
		</div>
		<div class="col-md-6 mb-2">
			<label>Biaya lain <sup class="text-danger">[3]</sup></label>
		</div>
		<div class="col-md-6 mb-2">
			<div class="input-group">
				<div class="input-group-append">
					<span class="input-group-text">Rp</span>
				</div>
				<input type="text" class="form-control rupiah" id="quantity_other_debt3" onkeyup="calculateObligation3()" name="quantity_other_debt">
			</div>
		</div>
		<div class="col-md-6 mb-2">
			<label>Total Kewajiban</label>
		</div>
		<div class="col-md-6 mb-2">
			<div class="input-group">
				<div class="input-group-append">
					<span class="input-group-text">Rp</span>
				</div>
				<input type="text" class="form-control rupiah" readonly="" id="total_obligation3" name="total_obligation">
			</div>
		</div>
	</div>

	<h6 class="mt-3">Zakat</h6>
	<div class="row align-items-center">
		<div class="col-md-6 mb-2">
			<label>Selisih harta dan kewajiban</label>
		</div>
		<div class="col-md-6 mb-2">
			<div class="input-group">
				<div class="input-group-append">
					<span class="input-group-text">Rp</span>
				</div>
				<input type="text" class="form-control rupiah" readonly="" id="difference3" name="difference">
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
				<input type="text" class="form-control rupiah" readonly="" id="total_zakat3" required="" name="zakat">
			</div>
		</div>
	</div>

	<hr>

	<h6>Keterangan</h6>
	<ol style="padding-left: 17px" type="1">
		<li>Piutang yang diharapkan dapat kembali atau ditagih.</li>
		<li>Hutang dagang (jangka pendek).</li>
		<li>Biaya lain yang masih harus dibayar sebelum sampai waktu pembayaran zakat.</li>
	</ol>

</form>

<hr>

@push('js')
<script type="text/javascript">
	let factor3 = 0.025;
	let nishab3 = {{ $prices['gold'] }} * 85;
	$(document).ready(function(){
		$("#nishab3").val(convertToRupiah(nishab3));
	})

	function calculateTreasure3(){
		let money = $("#quantity_money3").val().replaceAll(".", "");
		let stock = $("#quantity_stock3").val().replaceAll(".", "");
		let receivable = $("#quantity_receivable3").val().replaceAll(".", "");

		if(money == ""){
			money = 0;
		}
		if(stock == ""){
			stock = 0;
		}
		if(receivable == ""){
			receivable = 0;
		}

		let total_treasure = parseInt(money) + parseInt(stock) + parseInt(receivable);
		$("#total_treasure3").val(convertToRupiah(total_treasure));
		$("#r-total-harta").html(convertToRupiah(total_treasure));
		calculateZakat3();
	}

	function calculateObligation3(){
		let debt = $("#quantity_debt3").val().replaceAll(".", "");
		let other = $("#quantity_other_debt3").val().replaceAll(".", "");

		if(debt == ""){
			debt = 0;
		}
		if(other == ""){
			other = 0;
		}

		let total_obligation = parseInt(debt) + parseInt(other);
		$("#total_obligation3").val(convertToRupiah(total_obligation));
		$("#r-total-Kewajiban").html(convertToRupiah(total_obligation));
		calculateZakat3();
	}

	function calculateZakat3(){
		let total_treasure = $("#total_treasure3").val().replaceAll(".", "");
		let total_obligation = $("#total_obligation3").val().replaceAll(".", "");

		if(total_treasure == ""){
			total_treasure = 0;
		}
		if(total_obligation == ""){
			total_obligation = 0;
		}
		let difference = parseInt(total_treasure) - parseInt(total_obligation);

		let total_zakat = 0;
		if(difference >= nishab3){
			total_zakat = factor3 * difference;
		}

		if(total_zakat > 0){
			$("#btn-zakat").prop('disabled', false);
		}else{
			$("#btn-zakat").prop('disabled', true);
		}

		$("#difference3").val(convertToRupiah(difference));
		$("#total_zakat3").val(convertToRupiah(total_zakat));

		$("#r-selisih").html(convertToRupiah(difference));
		$("#r-nominal-zakat").html(convertToRupiah(total_zakat));
	}
</script>
@endpush
