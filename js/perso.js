$(document).ready(function(){

$('a[data-confirm]').click(function(cv){
  var href= $(this).attr('href');
  if(!$('#confirm-delete').lenght){
    $('body').append('<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"> <div class="modal-dialog" role="document"><div class="modal-content"><div class="modal-header"><h5 class="modal-title" id="exampleModalLabel">Excluir</h5><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></div><div class="modal-body">Tem certeza que deseja excluir?</div><div class="modal-footer"><a type="button" class="btn btn-success" data-dismiss="modal">Cancelar</a><a class="btn btn-primary text-white" id="dataConfirmOK">Excluir</a></div></div></div></div>');
  }
  $('#dataConfirmOK').attr('href', href);
  $('#confirm-delete').modal({shown:true});
  return false;
})
});
