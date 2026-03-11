<footer class="main-footer">

<strong>E-Sewa System</strong>

</footer>

</div>

<script src="../assets/adminlte/plugins/jquery/jquery.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script src="../assets/adminlte/dist/js/adminlte.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

new Chart(document.getElementById("chartSewa"),{

type:'bar',

data:{
labels:['Jan','Feb','Mar','Apr'],
datasets:[{
label:'Jumlah Sewa',
data:[5,10,8,12]
}]
}

});

</script>

</body>
</html>