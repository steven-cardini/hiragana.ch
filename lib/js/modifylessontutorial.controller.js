CKEDITOR.replace('editor1');
loadData();
$("#lesson-tutorial-save").click(saveData);

function loadData() {
  $("#lesson-tutorial-feedback").hide();
  $.ajax({
    url: ROOT_DIR+"api/lesson.load.php",
    type: "POST",
    data: {
      course_id: courseId,
      lesson_id: lessonId
    }
  })
  .done(function(html){
    CKEDITOR.instances.editor1.setData(html);
  });
}

function saveData() {
  var data = CKEDITOR.instances.editor1.getData();
  $.ajax({
    url: ROOT_DIR+"api/lesson.save.php",
    type: "POST",
    data: {
      course_id: courseId,
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
