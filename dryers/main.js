
function formSubmit(e, id){

  var frm = $('#'+ $(this).data('name') +'');

  $.ajax({
      type: frm.attr('method'),
      url: 'main.php',
      data: frm.serialize(),      
      success: function (data) {
          console.log('Submission was successful.');
          console.log(data);
          
      },
      error: function (data) {
          console.log('An error occurred.');
          console.log(data);
      }


      
  });
  
 
  document.getElementById(id).src = "images/full-basket.svg";
  return false;
}

function clean(id){
  document.getElementById(id).src = "images/empty-basket.svg";
  document.getElementById('machine_name').value='';
}
