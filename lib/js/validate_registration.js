$(function () {

  $('button[type="submit"]').attr('disabled', 'disabled');

  $('.js-register-form').change(function () {
    validateAll();
  });

  function resetValidation() {
    $('.form-group').removeClass('has-error');
    $('.form-group').removeClass('has-warning');
    $('.form-group').removeClass('has-success');
  }

  // Parameters
  //   selector:   String, jQuery selector for bootstrap form-group
  //   value:      Object, form input value
  //   validator:  Function, validate function
  function setState(selector, validator) {
    var arr = validator();
    console.log(arr[0]);
    $(selector).addClass(arr[1]);
  }

  function validateName(name) {
    return /\w+/.test(name);
  }

  function validateEmail(email) {
    return /\S+@\S+\.\S+/.test(email);
  }

  function validatePW(pw, pwRepeat) {
    if (pw !== pwRepeat) return false;
    return /[a-z]+/.test(pw) &&
      /[A-Z]+/.test(pw) &&
      /\W+/.test(pw);
  }

  function validateAll() {
    var name = $('#nickname').val();
    var pw = $('#pw').val();
    var pwRepeat = $('#pw-repeat').val();
    var email = $('#email').val();

    if(validateName(name) &&
       validateEmail(email) &&
       validatePW(pw, pwRepeat)) {
      // activate submit button
      $('button[type="submit"]').removeAttr('disabled');
    }

    resetValidation();

    setState('.form-group.nickname', function() {
      var msg, css = '';

      if(name === '') return [msg, css];

      if(validateName(name)) {
        msg = '';
        css = 'has-success';
      }
      else {
        msg = 'Nur Alpanummerische Zeichen erlaubt!';
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
        msg = "Keine gültige Emailadresse";
        css = 'has-error';
      }

      return [msg, css];
    });

    setState('.form-group.pw', function() {
      var msg, css = '';

      if(pw === '' || pwRepeat === '') return [msg, css];

      if(pw !== pwRepeat) {
        msg = 'Passwörter müssen übereinstimmen!';
        css = 'has-error';
      }
      else if(validatePW(pw, pwRepeat)) {
        msg = '';
        css = 'has-success';
      }
      else {
        msg = 'Passwort komplexität nicht erfüllt!';
        css = 'has-error';
      }

      return [msg, css];
    });
  }
});
