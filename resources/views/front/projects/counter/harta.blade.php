<form method="post">
	@csrf
	<input type="hidden" name="type" value="Harta">
	<h6 class="mt-3">Nishab</h6>
	<div class="row align-items-center">
		<div class="col-md-6 mb-2">
			<label>Nishab yang digunakan</label>
		</div>
		<div class="col-md-6 mb-2">
			<select class="form-control" name="nishab_type" id="nishab_type1">
				<option value="Emas">Emas</option>
				<option value="Perak">Perak</option>
			</select>
		</div>
		<div class="col-md-6 mb-2">
			<label>Harga 1 gram Emas</label>
		</div>
		<div class="col-md-6 mb-2">
			<div class="input-group">
				<div class="input-group-prepend">
					<div class="input-group-text">Rp</div>
				</div>
				<input type="text" class="form-control" name="gold_price" value="{{ number_format($prices['gold'], 0, ',', '.') }}" readonly="">
			</div>
		</div>
		<div class="col-md-6 mb-2">
			<label>Harga 1 gram Perak</label>
		</div>
		<div class="col-md-6 mb-2">
			<div class="input-group">
				<div class="input-group-prepend">
					<div class="input-group-text">Rp</div>
				</div>
				<input type="text" class="form-control" name="silver_price" value="{{ number_format($prices['silver'], 0,',', '.') }}" readonly="">
			</div>
		</div>
		<div class="col-md-6 mb-2">
			<label>Nishab</label>
		</div>
		<div class="col-md-6 mb-2">
			<div class="input-group">
				<div class="input-group-prepend">
					<div class="input-group-text">Rp</div>
				</div>
				<input type="text" class="form-control" name="nishab" placeholder="0" readonly="" id="nishab1">
			</div>
		</div>
	</div>

	<h6>Harta</h6>
	<div class="row align-items-center">
		<div class="col-md-6 mb-2">
			<label>Uang tunai dan tabungan</label>
		</div>
		<div class="col-md-6 mb-2">
			<div class="input-group">
				<div class="input-group-prepend">
					<div class="input-group-text">Rp</div>
				</div>
				<input type="text" class="form-control rupiah" placeholder="0" id="quantity_money1" onkeyup="calculateTreasure1()" name="quantity_money">
			</div>
		</div>
		<div class="col-md-6 mb-2">
			<label>Saham dan surat berharga lainnya <sup class="text-danger">[1]</sup></label>
		</div>
		<div class="col-md-6 mb-2">
			<div class="input-group">
				<div class="input-group-prepend">
					<div class="input-group-text">Rp</div>
				</div>
				<input type="text" class="form-control rupiah" placeholder="0" id="quantity_share1" onkeyup="calculateTreasure1()" name="quantity_share">
			</div>
		</div>
		<div class="col-md-6 mb-2">
			<label>Piutang <sup class="text-danger">[2]</sup></label>
		</div>
		<div class="col-md-6 mb-2">
			<div class="input-group">
				<div class="input-group-prepend">
					<div class="input-group-text">Rp</div>
				</div>
				<input type="text" class="form-control rupiah" placeholder="0" id="quantity_receivable1" onkeyup="calculateTreasure1()" name="quantity_receivable">
			</div>
		</div>
		<div class="col-md-6 mb-2">
			<label>Total Harta</label>
		</div>
		<div class="col-md-6 mb-2">
			<div class="input-group">
				<div class="input-group-prepend">
					<div class="input-group-text">Rp</div>
				</div>
				<input type="text" class="form-control" placeholder="0" readonly="" id="total_treasure1" name="total_treasure">
			</div>
		</div>
	</div>

	<h6>Kewajiban</h6>
	<div class="row align-items-center">
		<div class="col-md-6 mb-2">
			<label>Hutang <sup class="text-danger">[3]</sup></label>
		</div>
		<div class="col-md-6 mb-2">
			<div class="input-group">
				<div class="input-group-prepend">
					<div class="input-group-text">Rp</div>
				</div>
				<input type="text" class="form-control rupiah" placeholder="0" id="total_debt1" onkeyup="calculateObligation1()" name="total_debt">
			</div>
		</div>
		<div class="col-md-6 mb-2">
			<label>Total Kewajiban</label>
		</div>
		<div class="col-md-6 mb-2">
			<div class="input-group">
				<div class="input-group-prepend">
					<div class="input-group-text">Rp</div>
				</div>
				<input type="text" class="form-control" placeholder="0" readonly="" id="total_obligation1" name="total_obligation">
			</div>
		</div>
	</div>

	<h6>Zakat</h6>
	<div class="row align-items-center">
		<div class="col-md-6 mb-2">
			<label>Selisih harta dan kewajiban</label>
		</div>
		<div class="col-md-6 mb-2">
			<div class="input-group">
				<div class="input-group-prepend">
					<div class="input-group-text">Rp</div>
				</div>
				<input type="text" class="form-control" placeholder="0" readonly="" id="difference1" name="difference">
			</div>
		</div>
		<div class="col-md-6 mb-2">
			<label>Zakat</label>
		</div>
		<div class="col-md-6 mb-2">
			<div class="input-group">
				<div class="input-group-prepend">
					<div class="input-group-text">Rp</div>
				</div>
				<input type="text" class="form-control" placeholder="0" readonly="" id="grand_total1" required="" name="zakat">
			</div>
		</div>
	</div>

</form>

<hr>
<h6>Keterangan</h6>
<ol style="padding-left: 17px;" type="1">
	<li>Termasuk di dalamnya adalah investasi seperti reksadana dkk. Khusus untuk saham, kami sarankan untuk membaca tulisan di <a target="_blank" href="https://konsultasisyariah.com">KonsultasiSyariah.com.</a></li>
	<li>Piutang yang diharapkan dapat kembali / ditagih.</li>
	<li>Cicilan hutang yang harus dibayar (jatuh tempo) dalam waktu dekat.</li>
</ol>

<hr>

@push('js')
<script type="text/javascript">

	let factor1 = 0.025;
	let multiplier1 = 85;
	let nishab1 = multiplier1 * {{ $prices['gold'] }};

	$(document).ready(function(){
		$("#nishab1").val(convertToRupiah(nishab1));

		$("#nishab_type1").on("change", function(){
			let value = $(this).val();

			if(value == "Emas"){
				multiplier1 = 85;
				nishab1 = multiplier1 * {{ $prices['gold'] }};
			}else{
				multiplier1 = 595;
				nishab1 = multiplier1 * {{ $prices['silver'] }};
			}

			$("#nishab1").val(convertToRupiah(nishab1));
		})
	})

	function calculateTreasure1(){
		let treasure = $("#quantity_money1").val().replaceAll(".", "");
		let share = $("#quantity_share1").val().replaceAll(".", "");
		let receivable = $("#quantity_receivable1").val().replaceAll(".", "");

		if(treasure == ""){
			treasure = 0;
		}
		if(share == ""){
			share = 0;
		}
		if(receivable == ""){
			receivable = 0;
		}

		let total_treasure = parseInt(treasure) + parseInt(share) + parseInt(receivable);

		$("#total_treasure1").val(convertToRupiah(total_treasure));
		$("#r-total-harta").html(convertToRupiah(total_treasure));
		calculateTotal1();
	}

	function calculateObligation1(){
		let debt = $("#total_debt1").val().replaceAll(".", "");
		if(debt == ""){
			debt = 0;
		}

		$("#total_obligation1").val(convertToRupiah(parseInt(debt)));
		$("#r-total-Kewajiban").html(convertToRupiah(parseInt(debt)));
		calculateTotal1();
	}

	function calculateTotal1(){
		let total = $("#total_treasure1").val().replaceAll(".", "");
		let obligation = $("#total_obligation1").val().replaceAll(".", "");

		if(Number.isNaN(parseInt(obligation))){
			obligation = 0;
		}

		let difference = parseInt(total) - parseInt(obligation);
		let grand_total = 0;
		if(total >= nishab1){
			grand_total = difference * factor1;
		}

		if(grand_total > 0){
			$("#btn-zakat").prop('disabled', false);
		}else{
			$("#btn-zakat").prop('disabled', true);
		}

		$("#difference1").val(convertToRupiah(difference));
		$("#r-selisih").html(convertToRupiah(difference));

		$("#grand_total1").val(convertToRupiah(grand_total));
		$("#r-nominal-zakat").html(convertToRupiah(grand_total));
	}
</script>
@endpush
