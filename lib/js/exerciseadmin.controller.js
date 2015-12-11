$('#exercise-add-btn').click(addRow);

function addRow () {
  $('div.alert').remove();
  var row = '<tr><td><input type="text" name="question[]" placeholder="New Question" /></td>';
  row += '<td><input type="text" name="answer_en[]" placeholder="Answer EN" /></td>';
  row += '<td><input type="text" name="answer_de[]" placeholder="Answer DE" /></td></tr>';
  $('#exercise-admin-table > tbody:last-child').append(row);
}
