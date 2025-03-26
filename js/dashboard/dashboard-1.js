

(function($) {
    /* "use strict" */
	
 var dlabChartlist = function(){


var chartBar = function(chartData){
		
	var options = {
		  series: [
			{
				name: 'Total Sertifikat',
				data: [chartData.rpl_a, chartData.tkj_a, chartData.an_a, chartData.dkv_a],
				//radius: 12,	
			} 
			
		],
			chart: {
			type: 'bar',
			height: 417,
			
			toolbar: {
				show: false,
			},
			
		},
		plotOptions: {
		  bar: {
			horizontal: false,
			columnWidth: '57%',
			endingShape: "rounded",
			borderRadius: 12,
		  },
		  
		},
		states: {
		  hover: {
			filter: 'none',
		  }
		},
		colors:['#FFA26D', '#FF5ED2'],
		dataLabels: {
		  enabled: false,
		},
		markers: {
	shape: "circle",
	},
	
	
		legend: {
			show: false,
			fontSize: '12px',
			labels: {
				colors: '#000000',
				
				},
			markers: {
			width: 18,
			height: 18,
			strokeWidth: 10,
			strokeColor: '#fff',
			fillColors: undefined,
			radius: 12,	
			}
		},
		stroke: {
		  show: true,
		  width: 4,
		  curve: 'smooth',
		  lineCap: 'round',
		  colors: ['transparent']
		},
		grid: {
			borderColor: '#eee',
		},
		xaxis: {
			 position: 'bottom',
		  categories: ['RPL', 'TKJ', 'AN', 'DKV'],
		  labels: {
		   style: {
			  colors: '#787878',
			  fontSize: '13px',
			  fontFamily: 'poppins',
			  fontWeight: 100,
			  cssClass: 'apexcharts-xaxis-label',
			},
		  },
		  crosshairs: {
		  show: false,
		  }
		},
		yaxis: {
			labels: {
				offsetX:-16,
			   style: {
				  colors: '#787878',
				  fontSize: '13px',
				   fontFamily: 'poppins',
				  fontWeight: 100,
				  cssClass: 'apexcharts-xaxis-label',
			  },
		  },
		},
		fill: {
			type: 'gradient',
			gradient: {
				shade: 'white',
				type: "vertical",
				shadeIntensity: 0.2,
				gradientToColors: undefined, // optional, if not defined - uses the shades of same color in series
				inverseColors: true,
				opacityFrom: 1,
				opacityTo: 1,
				stops: [0, 50, 50],
				colorStops: []
			}
		}, 
		tooltip: {
		  y: {
			formatter: function (val) {
			  return "" + val + " sertifikat"
			}
		  }
		},
		};

		var chartBar1 = new ApexCharts(document.querySelector("#chartBar"), options);
		chartBar1.render();
}
var chartBar1 = function(chartData){
		
	var options = {
		  series: [
			{
				name: 'Total Sertifikat',
				data: [chartData.rpl_p, chartData.tkj_p, chartData.an_p, chartData.dkv_p],
				//radius: 12,	
			} 
			
		],
			chart: {
			type: 'bar',
			height: 417,
			
			toolbar: {
				show: false,
			},
			
		},
		plotOptions: {
		  bar: {
			horizontal: false,
			columnWidth: '57%',
			endingShape: "rounded",
			borderRadius: 12,
		  },
		  
		},
		states: {
		  hover: {
			filter: 'none',
		  }
		},
		colors:['#FFA26D', '#FF5ED2'],
		dataLabels: {
		  enabled: false,
		},
		markers: {
	shape: "circle",
	},
	
	
		legend: {
			show: false,
			fontSize: '12px',
			labels: {
				colors: '#000000',
				
				},
			markers: {
			width: 18,
			height: 18,
			strokeWidth: 10,
			strokeColor: '#fff',
			fillColors: undefined,
			radius: 12,	
			}
		},
		stroke: {
		  show: true,
		  width: 4,
		  curve: 'smooth',
		  lineCap: 'round',
		  colors: ['transparent']
		},
		grid: {
			borderColor: '#eee',
		},
		xaxis: {
			 position: 'bottom',
		  categories: ['RPL', 'TKJ', 'AN', 'DKV'],
		  labels: {
		   style: {
			  colors: '#787878',
			  fontSize: '13px',
			  fontFamily: 'poppins',
			  fontWeight: 100,
			  cssClass: 'apexcharts-xaxis-label',
			},
		  },
		  crosshairs: {
		  show: false,
		  }
		},
		yaxis: {
			labels: {
				offsetX:-16,
			   style: {
				  colors: '#787878',
				  fontSize: '13px',
				   fontFamily: 'poppins',
				  fontWeight: 100,
				  cssClass: 'apexcharts-xaxis-label',
			  },
		  },
		},
		fill: {
			type: 'gradient',
			gradient: {
				shade: 'white',
				type: "vertical",
				shadeIntensity: 0.2,
				gradientToColors: undefined, // optional, if not defined - uses the shades of same color in series
				inverseColors: true,
				opacityFrom: 1,
				opacityTo: 1,
				stops: [0, 50, 50],
				colorStops: []
			}
		}, 
		tooltip: {
		  y: {
			formatter: function (val) {
			  return "" + val + " sertifikat"
			}
		  }
		},
		};

		var chartBar1 = new ApexCharts(document.querySelector("#chartBar1"), options);
		chartBar1.render();
}
var chartBar2 = function(chartData){
		
	var options = {
		  series: [
			{
				name: 'Total Sertifikat',
				data: [chartData.rpl_c, chartData.tkj_c, chartData.an_c, chartData.dkv_c],
				//radius: 12,	
			} 
			
		],
			chart: {
			type: 'bar',
			height: 417,
			
			toolbar: {
				show: false,
			},
			
		},
		plotOptions: {
		  bar: {
			horizontal: false,
			columnWidth: '57%',
			endingShape: "rounded",
			borderRadius: 12,
		  },
		  
		},
		states: {
		  hover: {
			filter: 'none',
		  }
		},
		colors:['#FFA26D', '#FF5ED2'],
		dataLabels: {
		  enabled: false,
		},
		markers: {
	shape: "circle",
	},
	
	
		legend: {
			show: false,
			fontSize: '12px',
			labels: {
				colors: '#000000',
				
				},
			markers: {
			width: 18,
			height: 18,
			strokeWidth: 10,
			strokeColor: '#fff',
			fillColors: undefined,
			radius: 12,	
			}
		},
		stroke: {
		  show: true,
		  width: 4,
		  curve: 'smooth',
		  lineCap: 'round',
		  colors: ['transparent']
		},
		grid: {
			borderColor: '#eee',
		},
		xaxis: {
			 position: 'bottom',
		  categories: ['RPL', 'TKJ', 'AN', 'DKV'],
		  labels: {
		   style: {
			  colors: '#787878',
			  fontSize: '13px',
			  fontFamily: 'poppins',
			  fontWeight: 100,
			  cssClass: 'apexcharts-xaxis-label',
			},
		  },
		  crosshairs: {
		  show: false,
		  }
		},
		yaxis: {
			labels: {
				offsetX:-16,
			   style: {
				  colors: '#787878',
				  fontSize: '13px',
				   fontFamily: 'poppins',
				  fontWeight: 100,
				  cssClass: 'apexcharts-xaxis-label',
			  },
		  },
		},
		fill: {
			type: 'gradient',
			gradient: {
				shade: 'white',
				type: "vertical",
				shadeIntensity: 0.2,
				gradientToColors: undefined, // optional, if not defined - uses the shades of same color in series
				inverseColors: true,
				opacityFrom: 1,
				opacityTo: 1,
				stops: [0, 50, 50],
				colorStops: []
			}
		}, 
		tooltip: {
		  y: {
			formatter: function (val) {
			  return "" + val + " sertifikat"
			}
		  }
		},
		};

		var chartBar1 = new ApexCharts(document.querySelector("#chartBar2"), options);
		chartBar1.render();
}

var donutchart = function(chartData) {
    var total = chartData.approved + chartData.pending + chartData.canceled;

    // Jika total 0, tambahkan dummy data agar chart tetap terlihat
    var seriesData = total === 0 ? [1, 1, 1] : [parseInt(chartData.approved), parseInt(chartData.pending), parseInt(chartData.canceled)];

    var options = {
        series: seriesData,
        labels: ['Approved', 'Pending', 'Canceled'], // Perbaiki legend
        chart: {
            type: 'donut',
            height: 237 // Pastikan cukup besar
        },
        dataLabels: {
            enabled: true
        },
        stroke: {
            width: 0
        },
        colors: ['#61CFF1', '#FFDA7C', '#FF86B1'],
        legend: {
            position: 'bottom',
            show: true,
			labels: {
				colors: 'var(--primary)',
				useSeriesColors: false,
				fontWeight: '600',
      			fontFamily: 'Poppins, sans-serif',
			}
        },
        tooltip: {
            enabled: true,
            y: {
                formatter: function(val) {
                    return val + " Sertifikat";
                }
            }
        },
        responsive: [{
            breakpoint: 1800,
            options: {
                chart: {
                    height: 237 // Sesuaikan agar tetap proporsional
                }
            }
        }]
    };

    var chart = new ApexCharts(document.querySelector("#donutchart"), options);
    chart.render();
};

var chartBarSiswa = function(chartData){
		
	var options = {
		  series: [
			{
				name: 'Total Siswa',
				data: [chartData.siswa_rpl, chartData.siswa_tkj, chartData.siswa_an, chartData.siswa_dkv],
				//radius: 12,	
			} 
			
		],
			chart: {
			type: 'bar',
			height: 260,
			
			toolbar: {
				show: false,
			},
			
		},
		plotOptions: {
		  bar: {
			horizontal: false,
			columnWidth: '57%',
			endingShape: "rounded",
			borderRadius: 12,
		  },
		  
		},
		states: {
		  hover: {
			filter: 'none',
		  }
		},
		colors:['#FF5ED2'],
		dataLabels: {
		  enabled: false,
		},
		markers: {
	shape: "circle",
	},
	
	
		legend: {
			show: false,
			fontSize: '12px',
			labels: {
				colors: '#000000',
				
				},
			markers: {
			width: 18,
			height: 18,
			strokeWidth: 10,
			strokeColor: '#fff',
			fillColors: undefined,
			radius: 12,	
			}
		},
		stroke: {
		  show: true,
		  width: 4,
		  curve: 'smooth',
		  lineCap: 'round',
		  colors: ['transparent']
		},
		grid: {
			borderColor: '#eee',
		},
		xaxis: {
			 position: 'bottom',
		  categories: ['RPL', 'TKJ', 'AN', 'DKV'],
		  labels: {
		   style: {
			  colors: '#787878',
			  fontSize: '13px',
			  fontFamily: 'poppins',
			  fontWeight: 100,
			  cssClass: 'apexcharts-xaxis-label',
			},
		  },
		  crosshairs: {
		  show: false,
		  }
		},
		yaxis: {
			labels: {
				offsetX:-16,
			   style: {
				  colors: '#787878',
				  fontSize: '13px',
				   fontFamily: 'poppins',
				  fontWeight: 100,
				  cssClass: 'apexcharts-xaxis-label',
			  },
		  },
		},
		fill: {
			type: 'gradient',
			gradient: {
				shade: 'white',
				type: "vertical",
				shadeIntensity: 0.2,
				gradientToColors: undefined, // optional, if not defined - uses the shades of same color in series
				inverseColors: true,
				opacityFrom: 1,
				opacityTo: 1,
				stops: [0, 50, 50],
				colorStops: []
			}
		}, 
		tooltip: {
		  y: {
			formatter: function (val) {
			  return "" + val + " siswa"
			}
		  }
		},
		};

		var chartBar1 = new ApexCharts(document.querySelector("#chartBarSiswa"), options);
		chartBar1.render();
}

	
	
	
	
	
	
 
	/* Function ============ */
		return {
			load:function(){
			fetch("../api/get_chart_data.php")
			.then(response => response.json())
			.then(chartData => {
				donutchart(chartData); // Kirim data ke fungsi donutchart
				chartBar(chartData);
				chartBar1(chartData);
				chartBar2(chartData);
				chartBarSiswa(chartData);
				document.querySelector("#donutchart").innerHTML = ""; 
				donutchart(chartData);
			})
			.catch(error => console.error("Error fetching data:", error));
			},
			
			resize:function(){
			}
		}
	
	}();

	
		
	jQuery(window).on('load',function(){
		setTimeout(function(){
			dlabChartlist.load();
		}, 1000); 
		
	});

     

})(jQuery);