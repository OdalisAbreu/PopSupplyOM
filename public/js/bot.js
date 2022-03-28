function pasarId(id, user_id){
    console.log(id);
    document.getElementById('product_id').value = id;
    document.getElementById('user_id').value = user_id;
}

function aumentar(){
    cant = document.getElementById('quantity').value;
    cant++;
    document.getElementById('quantity').value = cant;

}
function disminuir(){
    cant = document.getElementById('quantity').value;
    cant--;
    document.getElementById('quantity').value = cant;

}