
function barChart(model) {
    Highcharts.chart('category-bar-chart', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Top Ten ' + model.catname
        },
        subtitle: {
            text: null
        },
        xAxis: {
            categories: model.category,
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Scores'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y} scores</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [{
            name: 'Twitter',
            data: model.twitterData
        }, {
            name: 'Reddit',
            data: model.redditData
        }]
    });
}