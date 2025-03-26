

(function($) {
    /* "use strict" */
	
 var dlabChartlist = function(){
	
	var screenWidth = $(window).width();
	let draw = Chart.controllers.line.__super__.draw; //draw shadow
		var donutChart1 = function(){
		$("span.donut1").peity("donut", {
			width: "70",
			height: "70"
		});
	}
	var chartBar = function(){
		
		var options = {
			  series: [
				{
					name: 'Running',
					data: [50, 18, 70, 40, 90, 70, 20],
					//radius: 12,	
				}, 
				{
				  name: 'Cycling',
				  data: [80, 40, 55, 20, 45, 30, 80]
				}, 
				
			],
				chart: {
				type: 'bar',
				height: 400,
				
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
			  categories: ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
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
				  return "$ " + val + " thousands"
				}
			  }
			},
			};

			var chartBar1 = new ApexCharts(document.querySelector("#chartBar"), options);
			chartBar1.render();
	}
	var chartBar1 = function(){
		
		var options = {
			  series: [
				{
					name: 'Running',
					data: [50, 18, 70, 40, 90, 70, 20],
					//radius: 12,	
				}, 
				{
				  name: 'Cycling',
				  data: [80, 40, 55, 20, 45, 30, 80]
				}, 
				
			],
				chart: {
				type: 'bar',
				height: 370,
				
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
			  categories: ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
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
				  return "$ " + val + " thousands"
				}
			  }
			},
			};

			var chartBar1 = new ApexCharts(document.querySelector("#chartBar1"), options);
			chartBar1.render();
	}
	var chartBar2 = function(){
		
		var options = {
			  series: [
				{
					name: 'Running',
					data: [50, 18, 70, 40, 90, 70, 20],
					//radius: 12,	
				}, 
				{
				  name: 'Cycling',
				  data: [80, 40, 55, 20, 45, 30, 80]
				}, 
				
			],
				chart: {
				type: 'bar',
				height: 370,
				
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
			  categories: ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
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
				  return "$ " + val + " thousands"
				}
			  }
			},
			};

			var chartBar1 = new ApexCharts(document.querySelector("#chartBar2"), options);
			chartBar1.render();
	}
	var revenueMap = function(){
		  var options = {
			  series: [
				{
					name: 'Net Profit',
					data: [20, 40, 20, 30, 50, 40, 60,],
					//radius: 12,	
				}, 				
			],
				chart: {
				type: 'line',
				height: 300,
				toolbar: {
					show: false,
				},
				
			},
			plotOptions: {
			  bar: {
				horizontal: false,
				columnWidth: '70%',
				endingShape: 'rounded'
			  },
			},
			colors:['#886CC0'],
			dataLabels: {
			  enabled: false,
			},
			markers: {
				shape: "circle",
			},
	
			legend: {
				show: false,
			},
			stroke: {
			  show: true,
			  width: 10,
			  curve:'smooth',
			  colors:['var(--primary)'],
			},
			
			grid: {
				borderColor: '#eee',
				show: true,
				 xaxis: {
					lines: {
						show: true,
					}
				},  
				 yaxis: {
					lines: {
						show: false,
					}
				},  
			},
			xaxis: {
				
			  categories: ['S', 'M', 'T', 'W', 'T', 'F', 'S'],
			  labels: {
				style: {
					colors: '#7E7F80',
					fontSize: '13px',
					fontFamily: 'Poppins',
					fontWeight: 100,
					cssClass: 'apexcharts-xaxis-label',
				},
			  },
			  crosshairs: {
			  show: false,
			  }
			},
			yaxis: {
			show:true,	
			labels: {
				offsetX: -15,
			   style: {
				  colors: '#7E7F80',
				  fontSize: '14px',
				   fontFamily: 'Poppins',
				  fontWeight: 100,
				  
				},
				 formatter: function (y) {
						  return y.toFixed(0) + "k";
						}
			  },
			},
			fill: {
			  opacity: 1,
			  colors:'#FAC7B6'
			},
			tooltip: {
			  y: {
				formatter: function (val) {
				  return "$ " + val + " hundred"
				}
			  }
			}
			};

			var chartBar1 = new ApexCharts(document.querySelector("#revenueMap"), options);
			chartBar1.render();
		 
		 
	 }
	 var columnChart = function(){
		var options = {
			series: [{
				name: 'Aplication Sent',
				data: [40, 55, 15,55]
			}, {
				name: 'Appllication Answered',
				data: [40, 55, 35,55]
			}, {
				name: 'Hired',
				data: [40, 17, 55, 55]
			}],
			chart: {
				type: 'bar',
				height: 150,
				stacked: true,
				toolbar: {
					show: false,
				}
			},
			responsive: [{
				breakpoint: 480,
				options: {
					legend: {
						position: 'bottom',
						offsetX: -10,
						offsetY: 0
					}
				}
			}],
			plotOptions: {
				bar: {
					horizontal: false,
					columnWidth: '20%',
					
					endingShape: "rounded",
					startingShape: "rounded",
					backgroundRadius: 20,
					colors: {
						backgroundBarColors: ['#ECECEC', '#ECECEC', '#ECECEC', '#ECECEC'],
						backgroundBarOpacity: 1,
						backgroundBarRadius: 10,
					},
				},
				
			},
			colors:['#ECECEC', '#886CC0', '#886CC0'],
			xaxis: {
				show: false,
				axisBorder: {
					show: false,
				},
				axisTicks:{
					show: false,
				},
				labels: {
					show: false,
					style: {
						colors: '#828282',
						fontSize: '14px',
						fontFamily: 'Poppins',
						fontWeight: 'light',
						cssClass: 'apexcharts-xaxis-label',
					},
				},
				
				crosshairs: {
					show: false,
				},
				
				categories: ['Sun', 'Mon', 'Tue'],
			},
			yaxis: {
				show: false
			},
			grid: {
				show: false,
			},
			toolbar: {
				enabled: false,
			},
			dataLabels: {
			  enabled: false
			},
			legend: {
				show:false
			},
			fill: {
				opacity: 1
			}
		};

		var chart = new ApexCharts(document.querySelector("#columnChart"), options);
		chart.render();
	}
	
	var kegiatan = function(){
		var options = {
		  series: [
			{
				name: 'Net Profit',
				data: [100,300, 100, 400, 200, 400],
				/* radius: 30,	 */
			}, 				
		],
			chart: {
			type: 'line',
			height: 50,
			width: 100,
			toolbar: {
				show: false,
			},
			zoom: {
				enabled: false
			},
			sparkline: {
				enabled: true
			}
			
		},
		
		colors:['var(--primary)'],
		dataLabels: {
		  enabled: false,
		},

		legend: {
			show: false,
		},
		stroke: {
		  show: true,
		  width: 6,
		  curve:'smooth',
		  colors:['var(--primary)'],
		},
		
		grid: {
			show:false,
			borderColor: '#eee',
			padding: {
				top: 0,
				right: 0,
				bottom: 0,
				left: 0

			}
		},
		states: {
                normal: {
                    filter: {
                        type: 'none',
                        value: 0
                    }
                },
                hover: {
                    filter: {
                        type: 'none',
                        value: 0
                    }
                },
                active: {
                    allowMultipleDataPointsSelection: false,
                    filter: {
                        type: 'none',
                        value: 0
                    }
                }
            },
		xaxis: {
			categories: ['Jan', 'feb', 'Mar', 'Apr', 'May'],
			axisBorder: {
				show: false,
			},
			axisTicks: {
				show: false
			},
			labels: {
				show: false,
				style: {
					fontSize: '12px',
				}
			},
			crosshairs: {
				show: false,
				position: 'front',
				stroke: {
					width: 1,
					dashArray: 3
				}
			},
			tooltip: {
				enabled: true,
				formatter: undefined,
				offsetY: 0,
				style: {
					fontSize: '12px',
				}
			}
		},
		yaxis: {
			show: false,
		},
		fill: {
		  opacity: 1,
		  colors:'#FB3E7A'
		},
		tooltip: {
			enabled:false,
			style: {
				fontSize: '12px',
			},
			y: {
				formatter: function(val) {
					return "$" + val + " thousands"
				}
			}
		}
		};

		var chartBar1 = new ApexCharts(document.querySelector("#kegiatan"), options);
		chartBar1.render();
	 
	}
	var jurusan = function(){
		var options = {
			series: [{
				name: 'Aplication Sent',
				data: [40, 55, 15,55]
			}, {
				name: 'Appllication Answered',
				data: [40, 55, 35,55]
			}, {
				name: 'Hired',
				data: [40, 17, 55, 55]
			}],
			chart: {
				type: 'bar',
				height: 150,
				stacked: true,
				toolbar: {
					show: false,
				}
			},
			responsive: [{
				breakpoint: 480,
				options: {
					legend: {
						position: 'bottom',
						offsetX: -10,
						offsetY: 0
					}
				}
			}],
			plotOptions: {
				bar: {
					horizontal: false,
					columnWidth: '20%',
					
					endingShape: "rounded",
					startingShape: "rounded",
					backgroundRadius: 20,
					colors: {
						backgroundBarColors: ['#ECECEC', '#ECECEC', '#ECECEC', '#ECECEC'],
						backgroundBarOpacity: 1,
						backgroundBarRadius: 10,
					},
				},
				
			},
			colors:['#ECECEC', '#886CC0', '#886CC0'],
			xaxis: {
				show: false,
				axisBorder: {
					show: false,
				},
				axisTicks:{
					show: false,
				},
				labels: {
					show: false,
					style: {
						colors: '#828282',
						fontSize: '14px',
						fontFamily: 'Poppins',
						fontWeight: 'light',
						cssClass: 'apexcharts-xaxis-label',
					},
				},
				
				crosshairs: {
					show: false,
				},
				
				categories: ['Sun', 'Mon', 'Tue'],
			},
			yaxis: {
				show: false
			},
			grid: {
				show: false,
			},
			toolbar: {
				enabled: false,
			},
			dataLabels: {
			  enabled: false
			},
			legend: {
				show:false
			},
			fill: {
				opacity: 1
			}
		};

		var chart = new ApexCharts(document.querySelector("#jurusan"), options);
		chart.render();
	 
	}
	
	var redial = function(){
		  var options = {
          series: [70],
          chart: {
          type: 'radialBar',
          offsetY: 0,
		  height:350,
          sparkline: {
            enabled: true
          }
        },
        plotOptions: {
          radialBar: {
            startAngle: -130,
            endAngle: 130,
            track: {
              background: "#F1EAFF",
              strokeWidth: '100%',
              margin: 5,
            },
			
			hollow: {
              margin: 30,
              size: '45%',
              background: '#F1EAFF',
              image: undefined,
              imageOffsetX: 0,
              imageOffsetY: 0,
              position: 'front',
            },
			
            dataLabels: {
              name: {
                show: false
              },
              value: {
                offsetY: 5,
                fontSize: '22px',
				color:'#886CC0',
				fontWeight:700,
              }
            }
          }
        },
		responsive: [{
          breakpoint: 1600,
          options: {
           chart: {
			  height:250
			},
          }
        }
		
		],
        grid: {
          padding: {
            top: -10
          }
        },
		/* stroke: {
          dashArray: 4,
		  colors:'#6EC51E'
        }, */
        fill: {
          type: 'gradient',
		  colors:'#FF63E6',
          gradient: {
              shade: 'white',
              shadeIntensity: 0.15,
              inverseColors: false,
              opacityFrom: 1,
              opacityTo: 1,
              stops: [0, 50, 65, 91]
          },
        },
        labels: ['Average Results'],
        };

        var chart = new ApexCharts(document.querySelector("#redial"), options);
        chart.render();
	
	
	}
	// var emailchart = function(){
	// 	 var options = {
    //       series: [27, 11, 22,15,25],
    //       chart: {
    //       type: 'donut',
	// 	  height:300
    //     },
	// 	dataLabels:{
	// 		enabled: false
	// 	},
	// 	stroke: {
    //       width: 0,
    //     },
	// 	colors:['var(--primary)', '#26E023', '#61CFF1','#FFDA7C','#FF86B1'],
	// 	legend: {
    //           position: 'bottom',
	// 		  show:false
    //         },
    //     responsive: [{
    //       breakpoint: 1800,
    //       options: {
    //        chart: {
	// 		  height:200
	// 		},
    //       }
    //     },
	// 	{
    //       breakpoint: 1800,
    //       options: {
    //        chart: {
	// 		  height:200
	// 		},
    //       }
    //     }
	// 	]
    //     };

    //     var chart = new ApexCharts(document.querySelector("#emailchart"), options);
    //     chart.render();
    
	// }

	// document.addEventListener("DOMContentLoaded", function() {
	// 	fetch('../api/get_chart_data.php')
	// 		.then(response => response.json()) // Ambil data JSON dari PHP
	// 		.then(data => {
	// 			var options = {
	// 				series: [data.approved, data.pending, data.declined],
	// 				chart: {
	// 					type: 'donut',
	// 					height: 300
	// 				},
	// 				dataLabels: {
	// 					enabled: false
	// 				},
	// 				stroke: {
	// 					width: 0
	// 				},
	// 				colors: ['#26E023', '#FFDA7C', '#FF86B1'], // Approved, Pending, Declined
	// 				legend: {
	// 					position: 'bottom',
	// 					show: false
	// 				},
	// 				responsive: [{
	// 					breakpoint: 1800,
	// 					options: {
	// 						chart: {
	// 							height: 200
	// 						}
	// 					}
	// 				}]
	// 			};
	
	// 			var chart = new ApexCharts(document.querySelector("#emailchart"), options);
	// 			chart.render();
	// 		})
	// 		.catch(error => console.error('Error fetching data:', error));
	// });
	
	var emailchart = function(chartData){
    var chartElement = document.querySelector("#emailchart");
    
    if (!chartElement) {
        console.error("Error: Element #emailchart tidak ditemukan.");
        return;
    }

    var options = {
        series: [chartData.approved, chartData.pending, chartData.canceled],
        chart: {
            type: 'donut',
            height: 400
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            width: 0
        },
        colors: ['#26E023', '#FFDA7C', '#FF86B1'],
        legend: {
            position: 'bottom',
            show: false
        },
        responsive: [{
            breakpoint: 1800,
            options: {
                chart: {
                    height: 230
                }
            }
        },
		{
			breakpoint: 1800,
			options: {
			 chart: {
				height:200
			  },
			}
		  }
		]
    };

    var chart = new ApexCharts(chartElement, options);
    chart.render();
}
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

var emailchart = function(chartData) {
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

    var chart = new ApexCharts(document.querySelector("#emailchart"), options);
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

var siswa = function(){
	var options = {
	  series: [
		{
			name: 'Jumlah siswa',
			data: [100,300, 200, 600, 400, 100],
			/* radius: 30,	 */
		}, 				
	],
		chart: {
		type: 'line',
		height: 50,
		width: 100,
		toolbar: {
			show: false,
		},
		zoom: {
			enabled: false
		},
		sparkline: {
			enabled: true
		}
		
	},
	
	colors:['var(--primary)'],
	dataLabels: {
	  enabled: false,
	},

	legend: {
		show: false,
	},
	stroke: {
	  show: true,
	  width: 6,
	  curve:'smooth',
	  colors:['var(--primary)'],
	},
	
	grid: {
		show:false,
		borderColor: '#eee',
		padding: {
			top: 0,
			right: 0,
			bottom: 0,
			left: 0

		}
	},
	states: {
			normal: {
				filter: {
					type: 'none',
					value: 0
				}
			},
			hover: {
				filter: {
					type: 'none',
					value: 0
				}
			},
			active: {
				allowMultipleDataPointsSelection: false,
				filter: {
					type: 'none',
					value: 0
				}
			}
		},
	xaxis: {
		categories: ['Jan', 'feb', 'Mar', 'Apr', 'May'],
		axisBorder: {
			show: false,
		},
		axisTicks: {
			show: false
		},
		labels: {
			show: false,
			style: {
				fontSize: '12px',
			}
		},
		crosshairs: {
			show: false,
			position: 'front',
			stroke: {
				width: 1,
				dashArray: 3
			}
		},
		tooltip: {
			enabled: true,
			formatter: undefined,
			offsetY: 0,
			style: {
				fontSize: '12px',
			}
		}
	},
	yaxis: {
		show: false,
	},
	fill: {
	  opacity: 1,
	  colors:'#FB3E7A'
	},
	tooltip: {
		enabled:false,
		style: {
			fontSize: '12px',
		},
		y: {
			formatter: function(val) {
				return "$" + val + " thousands"
			}
		}
	}
	};

	var chartBar1 = new ApexCharts(document.querySelector("#siswa"), options);
	chartBar1.render();
 
}
	

var kategori = function(){
	var options = {
	  series: [
		{
			name: 'Jumlah kategori',
			data: [400,200, 400, 100, 300, 100],
			/* radius: 30,	 */
		}, 				
	],
		chart: {
		type: 'line',
		height: 50,
		width: 100,
		toolbar: {
			show: false,
		},
		zoom: {
			enabled: false
		},
		sparkline: {
			enabled: true
		}
		
	},
	
	colors:['var(--primary)'],
	dataLabels: {
	  enabled: false,
	},

	legend: {
		show: false,
	},
	stroke: {
	  show: true,
	  width: 6,
	  curve:'smooth',
	  colors:['var(--primary)'],
	},
	
	grid: {
		show:false,
		borderColor: '#eee',
		padding: {
			top: 0,
			right: 0,
			bottom: 0,
			left: 0

		}
	},
	states: {
			normal: {
				filter: {
					type: 'none',
					value: 0
				}
			},
			hover: {
				filter: {
					type: 'none',
					value: 0
				}
			},
			active: {
				allowMultipleDataPointsSelection: false,
				filter: {
					type: 'none',
					value: 0
				}
			}
		},
	xaxis: {
		categories: ['Jan', 'feb', 'Mar', 'Apr', 'May'],
		axisBorder: {
			show: false,
		},
		axisTicks: {
			show: false
		},
		labels: {
			show: false,
			style: {
				fontSize: '12px',
			}
		},
		crosshairs: {
			show: false,
			position: 'front',
			stroke: {
				width: 1,
				dashArray: 3
			}
		},
		tooltip: {
			enabled: true,
			formatter: undefined,
			offsetY: 0,
			style: {
				fontSize: '12px',
			}
		}
	},
	yaxis: {
		show: false,
	},
	fill: {
	  opacity: 1,
	  colors:'#FB3E7A'
	},
	tooltip: {
		enabled:false,
		style: {
			fontSize: '12px',
		},
		y: {
			formatter: function(val) {
				return "$" + val + " thousands"
			}
		}
	}
	};

	var chartBar1 = new ApexCharts(document.querySelector("#kategori"), options);
	chartBar1.render();
 
}
	
	
	
	
	
	
 
	/* Function ============ */
		return {
			init:function(){
			},
			
			
			load:function(){
			donutChart1();	
			revenueMap();
			columnChart();
			kegiatan();
			jurusan();
			siswa();
			kategori();
			redial();
			fetch("../api/get_chart_data.php")
			.then(response => response.json())
			.then(chartData => {
				emailchart(chartData); // Kirim data ke fungsi emailchart
				chartBar(chartData);
				chartBar1(chartData);
				chartBar2(chartData);
				chartBarSiswa(chartData);
				document.querySelector("#emailchart").innerHTML = ""; 
				emailchart(chartData);
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