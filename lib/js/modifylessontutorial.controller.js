CKEDITOR.replace('editor1');
loadData();
$("#lesson-tutorial-save").click(saveData);

function loadData() {
  console.log("loading data");
  $("#lesson-tutorial-feedback").hide();
  $.ajax({
    url: ROOT_DIR+"api/lesson/load.php",
    type: "POST",
    data: {
      lesson_id: lessonId
    }
  })
  .done(function(html){
    CKEDITOR.instances.editor1.setData(html);
  });
}

function saveData() {
  console.log("saving data..");
  var data = CKEDITOR.instances.editor1.getData();
  console.log("data: "+data);
  $.ajax({
    url: ROOT_DIR+"api/lesson/save.php",
    type: "POST",
    data: {
      lesson_id: lessonId,
      content: data
    },
    dataType: "html"
  })
  .done(function(){
    $("#lesson-tutorial-feedback").removeClass("alert-danger").addClass("alert-success");
    $("#lesson-tutorial-feedback").text("Content was successfully saved!");
    $("#lesson-tutorial-feedback").show();
  })
  .fail(function(){
    $("#lesson-tutorial-feedback").addClass("alert-danger").removeClass("alert-success");
    $("#lesson-tutorial-feedback").text("Error saving the content, please try again..");
    $("#lesson-tutorial-feedback").show();
  });
}
