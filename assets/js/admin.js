document.addEventListener('DOMContentLoaded',function(){
  document.addEventListener('click',function(e){
    var rm=e.target.closest('[data-remove-rate]'); if(rm){rm.closest('tr').remove();}
    var edit=e.target.closest('[data-edit-rate]'); if(edit){edit.closest('tr').querySelectorAll('input').forEach(function(i){i.readOnly=false;});}
  });
  var add=document.querySelector('[data-add-rate]'), table=document.querySelector('[data-rates-table]');
  if(add&&table){add.addEventListener('click',function(){var tr=document.createElement('tr');tr.innerHTML='<td><input data-rate-city></td><td><input type="number" min="0" value="0" data-rate-auto></td><td><input type="number" min="0" value="0" data-rate-foot></td><td><input type="number" min="0" data-rate-limit placeholder="Без лимита"></td><td><button class="button small" type="button" data-edit-rate><i class="fa-solid fa-pen"></i></button><button class="button small danger" type="button" data-remove-rate>Удалить</button></td>';table.querySelector('tbody').appendChild(tr);});}
  document.querySelectorAll('[data-city-rates-form]').forEach(function(form){form.addEventListener('submit',function(){var rows=[];form.querySelectorAll('tbody tr').forEach(function(tr){rows.push({city:tr.querySelector('[data-rate-city]').value,auto:tr.querySelector('[data-rate-auto]').value,foot:tr.querySelector('[data-rate-foot]').value,limit:tr.querySelector('[data-rate-limit]').value});});form.querySelector('[data-rates-payload]').value=JSON.stringify(rows);});});
});
