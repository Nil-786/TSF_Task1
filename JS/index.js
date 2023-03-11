var modal = document.getElementById("transfer-form");
var successV = document.getElementById("Tsuccess");

var close=document.getElementById("close");

close.onclick = function(){
  modal.style.display = "none";
}
function showForm(name){
    modal.style.display = "block";
    document.getElementById("from").value = name;

}
window.onclick = function(event) {
    if (event.target == modal) {
      modal.style.display = "none";
    }
}
function success(){
  successV.style.display="block";
}

