<?php

  class I18n {

    private static $language;

    private static $i18n = array(
                      // generic text
                      'text.signin' => array(
                        'de' => 'Anmelden',
                        'en' => 'Sign in'
                      ),
                      'text.signout' => array(
                        'de' => 'Abmelden',
                        'en' => 'Sign out'
                      ),
                      'text.register' => array(
                        'de' => 'Registrieren',
                        'en' => 'Register'
                      ),
                      'text.email' => array(
                        'de' => 'E-Mail-Adresse',
                        'en' => 'E-mail address'
                      ),
                      'text.password' => array(
                        'de' => 'Passwort',
                        'en' => 'Password'
                      ),
                      'text.welcome' => array(
                        'de' => 'Willkommen',
                        'en' => 'Welcome'
                      ),
                      'text.new' => array(
                        'de' => 'Neu',
                        'en' => 'New'
                      ),
                      'text.edit' => array(
                        'de' => 'Bearbeiten',
                        'en' => 'Edit'
                      ),

                      // generic buttons
                      'button.selectall' => array(
                        'de' => 'Alle auswählen',
                        'en' => 'Select all'
                      ),
                      'button.deselectall' => array(
                        'de' => 'Alle abwählen',
                        'en' => 'Deselect all'
                      ),
                      'button.switchmode' => array(
                        'de' => 'Modus ändern',
                        'en' => 'Switch mode'
                      ),
                      'button.results' => array(
                        'de' => 'Resultate',
                        'en' => 'Results'
                      ),
                      'button.reset' => array(
                        'de' => 'Zurücksetzen',
                        'en' => 'Reset'
                      ),
                      'button.submit' => array(
                        'de' => 'Senden',
                        'en' => 'Submit'
                      ),
                      'button.save' => array(
                        'de' => 'Speichern',
                        'en' => 'Save'
                      ),
                      'button.delete' => array(
                        'de' => 'Löschen',
                        'en' => 'Delete'
                      ),
                      'button.cancel' => array(
                        'de' => 'Abbrechen',
                        'en' => 'Cancel'
                      ),
                      'button.add' => array(
                        'de' => 'Hinzufügen',
                        'en' => 'Add'
                      ),

                      // generic form text
                      'form.err.notallfields' => array(
                        'de' => 'Bitte füllen Sie alle Felder aus.',
                        'en' => 'Please fill out all fields.'
                      ),
                      'form.err.general' => array(
                        'de' => 'Es gab ein Problem mit der Formularübertragung. Bitte versuchen Sie es erneut.',
                        'en' => 'There was a problem with submitting the form. Please try again.'
                      ),

                      // page-specific text
                      'navigation.home' => array(
                        'de' => 'Startseite',
                        'en' => 'Home'
                      ),
                      'navigation.courses' => array(
                        'de' => 'Kurse',
                        'en' => 'Courses'
                      ),
                      'navigation.usersettings' => array(
                        'de' => 'Benutzereinstellungen',
                        'en' => 'User Settings'
                      ),
                      'navigation.admin.users' => array(
                        'de' => 'Benutzer',
                        'en' => 'Users'
                      ),
                      'navigation.admin.courses' => array(
                        'de' => 'Kurse',
                        'en' => 'Courses'
                      ),
                      'home.content' => array(
                        'de' => '<p>
                          Auf dieser Seite kannst du deine Hiragana- und Katakana-Kenntnisse testen und trainieren. Navigiere einfach im Menü oben auf Hiragana oder Katakana.
                        </p>
                        <p>
                          Diese Seite ist momentan in gewisser Weise noch ein Prototyp. Sie wird noch verbessert und weiter ausgebaut. Die Hiragana- und Katakana-Trainer können aber bereits benutzt werden.
                        </p>',
                        'en' => '<p>
                          On this page you can test and train your knowledge of Japanese hiragana and katakana. Simply navigate to the desired section in the navigation above.
                        </p>
                        <p>
                          Currently, this page is still somehow a prototype. It will be improved and the functionalitites will be extended. The hiragana and katakana trainers can however be used without limitation.
                        </p>'
                      ),
                      'about.title' => array(
                        'de' => 'Über uns',
                        'en' => 'About us'
                      ),
                      'about.content' => array(
                        'de' => '<p>
                        Hallo, wir sind Steven und Raphael. Wir studieren Informatik an der Berner Fachhochschule. Diese Website ist das Produkt eines Projektes,
                        welches wir gemeinsam während des fünften Studiumsemesters durchführten.
                        </p>',
                        'en' => '<p>
                        Hi, we\'re Steven and Raphael. We\'re currently studying computer science at Bern University of Applied Sciences. This website is a result of a project,
                        which we were pursuing in the course of our fifth semester.
                        </p>'
                      ),
                      'login.text' => array(
                        'de' => 'Bitte geben Sie unten Ihre Logindaten ein, um sich einzuloggen.',
                        'en' => 'Please enter your personal data below in order to sign in.'
                      ),
                      'login.err.notcorrect' => array(
                        'de' => 'Ihre Eingabe ist nicht korrekt. Bitte versuchen Sie es erneut.',
                        'en' => 'Your input is not correct. Please try again.'
                      ),
                      'register.title' => array(
                        'de' => 'Registrierung',
                        'en' => 'Registration'
                      ),
                      'register.text' => array(
                        'de' => 'Bitte füllen Sie die Angaben unten aus, um sich zu registrieren.',
                        'en' => 'Please enter your personal data below in order to register.'
                      ),
                      'register.repeatpw' => array(
                        'de' => 'Passwort wiederholen',
                        'en' => 'Repeat password'
                      ),
                      'register.err.twopasswords' => array(
                        'de' => 'Die Passwörter stimmen nicht überein.',
                        'en' => 'Please provide two identical passwords.'
                      ),
                      'register.err.nicknameexists' => array(
                        'de' => 'Dieser Nickname ist bereits vergeben.',
                        'en' => 'A user with this nickname already exists.'
                      ),
                      'register.err.emailexists' => array(
                        'de' => 'Diese E-Mail-Adresse ist bereits registriert.',
                        'en' => 'This e-mail address is already registered.'
                      ),
                      'register.err.emailnotvalid' => array(
                        'de' => 'Bitte überprüfen Sie Ihre E-Mail-Adresse.',
                        'en' => '"Please provide a valid e-mail address."'
                      ),
                      'register.err.notcreated' => array(
                        'de' => 'Es gab ein Problem beim Erstellen Ihres Kontos. Bitte versuchen Sie es nochmals.',
                        'en' => 'There was a problem creating your account. Please try again.'
                      ),
                      'register.success' => array(
                        'de' => 'Danke für die Registrierung! Sie können sich nun mit Ihrer E-Mail-Adresse und Ihrem Passwort anmelden.',
                        'en' => 'Thank you for your registration! You can now sign in with your e-mail address and password.'
                      ),
                      'kanaselector.text' => array(
                        'de' => 'Bitte wähle unten die gewünschten Trainingslevels und klicke anschliessend auf Start!',
                        'en' => 'Please choose the training levels below and then click Start!'
                      ),
                      'kanatrainer.wrong' => array(
                        'de' => 'Falsch',
                        'en' => 'Wrong'
                      ),
                      'kanatrainer.correct' => array(
                        'de' => 'Richtig',
                        'en' => 'Correct'
                      ),
                      'kanatrainer.try' => array(
                        'de' => 'Versuch',
                        'en' => 'Try'
                      ),
                      'kanatrainer.youranswer' => array(
                        'de' => 'Deine Antwort',
                        'en' => 'Your answer'
                      ),
                      'kanatrainer.correctanswer' => array(
                        'de' => 'Richtige Antwort',
                        'en' => 'Correct answer'
                      ),
                      'kanatrainer.hint' => array(
                        'de' => 'Tipp',
                        'en' => 'Hint'
                      ),
                      'kanatrainer.err.mc-switch' => array(
                        'de' => 'Nicht genügend Symbole für Multiple Choice!',
                        'en' => 'Not enough symbols to display multiple choice!'
                      ),
                      'kanatrainer.err.no-symbols' => array(
                        'de' => 'Bitte wähle die zu trainierenden Levels aus!',
                        'en' => 'Please choose the levels to be trained!'
                      ),
                      'courseoverview.title' => array(
                        'de' => 'Kurse',
                        'en' => 'Courses'
                      ),
                      'courseoverview.text' => array(
                        'de' => 'Alle verfügbare Kurse sind unten aufgelistet. Wählen Sie einen aus, um zu starten!',
                        'en' => 'Below, all available courses are listed. Please select one to get started!'
                      ),
                      'courseoverview.err.nologin' => array(
                        'de' => 'Bitte melden Sie sich an, um die Kurse zu sehen!',
                        'en' => 'Please sign in to view the courses!'
                      ),
                      'course.text' => array(
                        'de' => 'Alle verfügbaren Lektionen sind unten aufgelistet. Wählen Sie eine aus, um zu starten!',
                        'en' => 'Below, all lessons of the course are listed. Please select one to get started!'
                      ),
                      'lesson.startexercises' => array(
                        'de' => 'Übungen starten',
                        'en' => 'Start exercises'
                      ),
                      'exercises.title' => array(
                        'de' => 'Übungen',
                        'en' => 'Exercises'
                      ),
                      'exercise.youranswer' => array(
                        'de' => 'Ihre Antwort',
                        'en' => 'Your answer'
                      ),
                      'exercise.correct' => array(
                        'de' => 'Richtig!',
                        'en' => 'Correct!'
                      ),
                      'exercise.wrong' => array(
                        'de' => 'Falsch!',
                        'en' => 'Wrong!'
                      ),
                      'exercise.err.allanswered' => array(
                        'de' => 'Sie haben alle Übungen gelöst!',
                        'en' => 'You completed all exercises!'
                      ),

                      'admin.useroverview.title' => array(
                        'de' => 'Benutzerübersicht',
                        'en' => 'User overview'
                      ),
                      'admin.useroverview.admin' => array(
                        'de' => 'Admin-Rechte',
                        'en' => 'Admin rights'
                      ),
                      'admin.courseadmin.lessons' => array(
                        'de' => 'Lektionen',
                        'en' => 'Lessons'
                      ),
                      'admin.courseadmin.newcourse' => array(
                        'de' => 'Neuer Kurs',
                        'en' => 'Add course'
                      ),
                      'admin.lessonadmin.lessonnr' => array(
                        'de' => 'Lektion Nr.',
                        'en' => 'Lesson nr'
                      ),
                      'admin.lessonadmin.points' => array(
                        'de' => 'Punkte',
                        'en' => 'Points'
                      ),
                      'admin.lessonadmin.added' => array(
                        'de' => 'Hinzugefügt',
                        'en' => 'Added'
                      ),
                      'admin.lessonadmin.newlesson' => array(
                        'de' => 'Neue Lektion',
                        'en' => 'New lesson'
                      ),
                      'admin.exerciseadmin.question' => array(
                        'de' => 'Frage',
                        'en' => 'Question'
                      ),
                      'admin.exerciseadmin.answer' => array(
                        'de' => 'Antwort',
                        'en' => 'Answer'
                      ),
                      'admin.exerciseadmin.newquestion' => array(
                        'de' => 'Neue Frage',
                        'en' => 'New question'
                      )
                    );

    static function t($key) {
      return isset(I18n::$i18n[$key][self::$language]) ? I18n::$i18n[$key][self::$language]
                                       : "Missing translation [$key]";
    }

    static function getLang() {
      return self::$language;
    }

    static function initialize() {
      if(!isset($_COOKIE['lang'])) {
        self::$language = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
        setcookie('lang', self::$language);
      } else {
        self::$language = $_COOKIE['lang'];
      }
    }
  }

?>
