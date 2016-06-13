$(function () {


  $('.js-feedback-form').change(function () {
    validateAll();
  });

  function resetValidation() {
    $('.form-group').removeClass('has-error');
    $('.form-group').removeClass('has-warning');
    $('.form-group').removeClass('has-success');
    $('.help-block').remove();
  }

  // Parameters
  //   selector:   String, jQuery selector for bootstrap form-group
  //   value:      Object, form input value
  //   validator:  Function, validate function
  function setState(selector, validator) {
    var arr = validator();
    $(selector).append(arr[0]);
    $(selector).addClass(arr[1]);
  }

  function validateNameLength(name) {
    return /.{3,40}/.test(name);
  }

  function validateEmail(email) {
    return /^\S+@\S+\.\S+$/.test(email);
  }

  function validateText(text) {
    return /.{3,}/.test(text);
  }

  function validateAll() {
    var name = $('#name').val();
    var email = $('#email').val();
    var text = $('#text').val();

    resetValidation();

    setState('.form-group.name', function() {
      var msg, css = '';

      if(name === '') return [msg, css];

      if (validateNameLength(name)) {
        msg = '';
        css = 'has-success';
      }
      else {
        msg = '<span id="helpNickname" class="help-block">'+err_namelength+'</span>';
        css = 'has-error';
      }

      return [msg, css];
    });

    setState('.form-group.email', function() {
      var msg, css = '';

      if(email === '') return [msg, css];

      if(validateEmail(email)) {
        msg = '';
        css = 'has-success';
      }
      else {
        msg = '<span id="helpEmail" class="help-block">'+err_emailnotvalid+'</span>';
        css = 'has-error';
      }

      return [msg, css];
    });

    setState('.form-group.text', function() {
      var msg, css = '';

      if(text === '') return [msg, css];

      if(validateText(text)) {
        msg = '';
        css = 'has-success';
      }
      else {
        msg = '<span id="helpPW" class="help-block">'+err_textlength+'</span>';
        css = 'has-error';
      }

      return [msg, css];
    });
  }
});
