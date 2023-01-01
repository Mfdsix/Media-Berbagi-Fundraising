@extends('layouts.dashboard')
@section('title', 'Penggunaan Data')
@section('css')
@endsection @section('header', "Penggunaan Data")
@section('content')

<div class="row">
	<div class="col-md-12">
		<div class="box">
			<div class="box-body">
				<h3>Penggunaan Penyimpanan</h3>
				<p>anda berada di mode terbatas, dimana penggunaan maksimal adalah <b>1 GB</b>. Segera upgrade untuk penyimpanan yang tidak terbatas.</p>
				<br>
				<div class="row">
					<div class="col-md-8" style="margin-bottom: 0px">
						<div id="usage-chart"></div>
					</div>
					<div class="col-md-4 d-flex justify-content-center align-items-center" style="margin-bottom: 0px; flex-direction: column">
						<div id="usage-donute-chart"></div>
						<h4 class="text-center">{{ $totalUsage }} MB</h4>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection @section('js')
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    var usage = {
    	'categories': [],
    	'disk': [],
    	'database': []
    };

    var usageDonute = {
		used: {{ $totalUsagePrecentage > 100 ? 100 : $totalUsagePrecentage }},
		available: {{ $totalUsagePrecentage > 100 ? 0 : (100-$totalUsagePrecentage) }},
	};
    @foreach($usageHistories['date'] as $k => $v)
	usage.categories.push('{{ $v }}');
	usage.disk.push({{$usageHistories['disk'][$k]}});
	usage.database.push({{$usageHistories['database'][$k]}});
	@endforeach

    var options = {
    series: [
        {
            name: "disk",
            data: usage.disk,
        },
        {
            name: "database",
            data: usage.database,
        },
    ],
    chart: {
        height: 275,
        type: "area",
    },
    dataLabels: {
        enabled: false,
    },
    stroke: {
        curve: "smooth",
    },
    xaxis: {
        categories: usage.categories,
    },
    colors: ["#167f40", "#afcb22"],
};

var chart = new ApexCharts(document.querySelector("#usage-chart"), options);
chart.render();

var options2 = {
    series: [usageDonute.used, usageDonute.available],
    colors: ["#167f40", "#afcb22"],
    chart: {
        width: 300,
        type: "pie",
    },
    labels: ["Terpakai", "Tersedia"],
    legend: {
        position: "bottom",
        show: false,
    },
};

var chart2 = new ApexCharts(
    document.querySelector("#usage-donute-chart"),
    options2
);
chart2.render();

</script>
@endsection
