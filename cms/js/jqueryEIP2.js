$(document).ready(function(){
setClickable();
});

function setClickable() {
$('#editInPlace').click(function() {
var textarea = '<div><textarea rows="2" cols="30">'+$(this).html()+'</textarea>';
var button	 = '<div><input type="button" value="Salvar" class="saveButton" /> ou <input type="button" value="Cancelar" class="cancelButton" /></div></div>';
var revert = $(this).html();
$(this).after(textarea+button).remove();
$('.saveButton').click(function(){saveChanges(this, false);});
$('.cancelButton').click(function(){saveChanges(this, revert);});
})
.mouseover(function() {
$(this).addClass("editable");
})
.mouseout(function() {
$(this).removeClass("editable");
});
};

function saveChanges(obj, cancel) {
if(!cancel) {
var t = $(obj).parent().siblings(0).val();
$.post("save.php",{
  content: t
},function(txt){
alert( txt);
});
}
else {
var t = cancel;
}
if(t=='') t='(Clique para adicionar texto)';
$(obj).parent().parent().after('<div id="editInPlace">'+t+'</div>').remove();
setClickable();
}