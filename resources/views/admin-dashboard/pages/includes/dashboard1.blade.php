<script>
var ctx = document.getElementById("faculty");
var myChart = new Chart(ctx, {
    type: 'horizontalBar',
    data: {
        labels: ["College of Arts and Sciences", "College of Bus. and Mgt.",
                  "College of Education", "College of Eng. and Tech.",
                  "Caramoan Campus",  "Lagonoy Campus", "Salogon Campus", "San Jose Campus", "Tinambac Campus"],
        datasets: [{
            label: '# of Faculty per College',
            data: [windowvar.fcas, windowvar.fcbm, windowvar.fcoed, windowvar.fcet, windowvar.fcaramoan, windowvar.flagonoy,
                  windowvar.fsalogon, windowvar.fsanjose, windowvar.ftinambac],
            backgroundColor: ["#4285f4","#4285f4", "#4285f4", "#4285f4", "#4285f4", "#4285f4", "#4285f4", "#4285f4", "#4285f4"]
          },
          {
            label: '# of with participated in PD for the last 12 months',
            data: [windowvar.cas, windowvar.cbm, windowvar.coed, windowvar.cet, windowvar.caramoan, windowvar.lagonoy,
                  windowvar.salogon, windowvar.sanjose, windowvar.tinambac],
            backgroundColor: ["#FF9800","#FF9800", "#FF9800", "#FF9800", "#FF9800", "#FF9800", "#FF9800", "#FF9800", "#FF9800"]
          }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        }
    }
});
</script>
<script>
var ctx = document.getElementById("pd");
var myChart = new Chart(ctx, {
    type: 'horizontalBar',
    data: {
        labels: ["College of Arts and Sciences", "College of Bus. and Mgt.",
                  "College of Education", "College of Eng. and Tech.",
                  "Caramoan Campus",  "Lagonoy Campus", "Salogon Campus", "San Jose Campus", "Tinambac Campus"],
        datasets: [{
            label: '# of PD Activities for the last 12 months',
            data: [windowvar.caspd, windowvar.cbmpd, windowvar.coedpd, windowvar.cetpd, windowvar.caramoanpd, windowvar.lagonoypd,
                  windowvar.salogonpd, windowvar.sanjosepd, windowvar.tinambacpd],
            backgroundColor: ["#0D47A1","#1565C0", "#1976D2", "#1E88E5", "#2196F3", "#42A5F5", "#64B5F6", "#90CAF9", "#BBDEFB"]
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        }
    }
});
</script>
