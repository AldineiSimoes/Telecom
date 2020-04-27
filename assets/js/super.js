function graficoSup(){
Chart.defaults.global.legend.display = false;
$('#grafsuper').html('<canvas id="statusgraf" height="230"></canvas>');
var grafico = new Chart(document.getElementById('statusgraf'), {
	type: 'doughnut',
	label:'Grafico',
	data:{
		labels:lblsup,
		datasets:[{
			data:datasup,
			backgroundColor:['#FF0000','#00FF00','#FFA500','#FFFF00','#1E90FF','#2E8B57','#00FF7F','#DEB887','#FFE4E1','#1E90FF','#00FF7F'],
			borderColor:'#FFFFFF'
		}]
    }
});
}

