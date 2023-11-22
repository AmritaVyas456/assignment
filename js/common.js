var editData = function(id){
    //e.preventDefault();
    $.ajax({
    method:"GET",
    url: "create_post.php",
    data:{editId:id}, 
    dataType: "html",   
    success: function(data){
   alert(data); return false;
    if(data === 'success') {
        alert('success'); return false;
    } else {
        alert('success'); return false;
        $('#msg').html(data);
        $('#loginForm').find('input').val('')
    }
}});
}