let customer_options = {
    series: [
        {
            name: "Sukses",
            data: sevenDays.donation,
        },
    ],
    colors: ["#3C21F7"],
    chart: {
        height: 300,
        type: "line",
    },
    dataLabels: {
        enabled: false,
    },
    stroke: {
        curve: "smooth",
    },
    xaxis: {
        categories: sevenDays.days,
    },
};

let customer_options2 = {
    series: [
        {
            name: "Sukses",
            data: oneMonth.donation,
        },
    ],
    colors: ["#f8d246"],
    chart: {
        height: 300,
        type: "line",
    },
    dataLabels: {
        enabled: false,
    },
    stroke: {
        curve: "smooth",
    },
    xaxis: {
        categories: oneMonth.days,
    },
};

if (sevenDays.days.length > 0) {
    let customer_chart = new ApexCharts(
        document.querySelector("#customer-chart"),
        customer_options
    );
    customer_chart.render();
} else {
    $("#customer-chart").append("<h3 class='text-dark'>Belum ada donasi</h3>");
}

if (oneMonth.days.length > 0) {
    let customer_chart2 = new ApexCharts(
        document.querySelector("#customer-chart2"),
        customer_options2
    );
    customer_chart2.render();
} else {
    $("#customer-chart2").append("<h3 class='text-dark'>Belum ada donasi</h3>");
}
