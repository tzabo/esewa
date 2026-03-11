document.addEventListener("DOMContentLoaded", function(){

let keperluan = document.getElementById("keperluan");

if(keperluan){

keperluan.addEventListener("change", function(){

if(this.value === "Lainnya"){
document.getElementById("lainnya").style.display = "block";
}else{
document.getElementById("lainnya").style.display = "none";
}

});

}

});