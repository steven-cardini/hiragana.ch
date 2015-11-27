CKEDITOR.replace('editor1');
loadData();
$("#lesson-tutorial-save").click(saveData);

function loadData() {
  console.log("loading data");
  $.post(
    ROOT_DIR+"api/lesson/load.php",
    {
      lesson_id: '1'
    },
    function(result){
      CKEDITOR.instances.editor1.setData(result);
    }
  );
}

function saveData() {
  console.log("saving data..");
  var data = CKEDITOR.instances.editor1.getData();
  console.log("data: "+data);
  $.post(
    ROOT_DIR+"api/lesson/save.php",
    {
      lesson_id: '1',
      content: data
    },
    "html"
  );
}
