function deleteProduct(id){
    var respuesta = confirm("¿Esta seguro(a) de eliminar este producto");
    if(respuesta === true){
        window.location.href = "?b=inventory&s=eliminar&idprod="+id; 
    } 
}