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
                      'form.err.recaptcha-missing' => array(
                        'de' => 'Bitte bestätigen Sie, dass Sie ein Mensch sind!',
                        'en' => 'Please confirm that you are a human!'
                      ),
                      'form.err.recaptcha-invalid' => array(
                        'de' => 'Es gab ein Problem mit dem ReCaptcha. Bitte versuchen Sie es erneut.',
                        'en' => 'There was a problem with the ReCaptcha. Please try again.'
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
                      'feedback.title' => array(
                        'de' => 'Feedback',
                        'en' => 'Feedback'
                      ),
                      'feedback.text' => array(
                        'de' => 'Wir freuen uns über dein Feedback und auch über Vorschläge zur künftigen Erweiterung der Website.',
                        'en' => 'We are happy to receive your feedback and also ideas for the further development of the website.'
                      ),
                      'feedback.message' => array(
                        'de' => 'Mitteilung',
                        'en' => 'Message'
                      ),
                      'feedback.success' => array(
                        'de' => 'Deine Mitteilung wurde erfolgreich gesendet. Vielen Dank!',
                        'en' => 'Your message was successfully sent. Thank you!'
                      ),
                      'feedback.err.namelength' => array(
                        'de' => 'Der eingetippte Name ist zu kurz oder zu lang!',
                        'en' => 'The input name is too short or too long!'
                      ),
                      'feedback.err.textlength' => array(
                        'de' => 'Die eingetippte Nachricht ist zu kurz!',
                        'en' => 'The input message is too short!'
                      ),
                      'login.title' => array(
                        'de' => 'Anmeldung',
                        'en' => 'Sign in'
                      ),
                      'login.text' => array(
                        'de' => 'Bitte geben Sie unten Ihre Logindaten ein, um sich einzuloggen.',
                        'en' => 'Please enter your personal data below in order to sign in.'
                      ),
                      'login.pleaselogin' => array(
                        'de' => 'Sie müssen sich anmelden, bevor Sie auf die gewünschte Seite navigieren können.',
                        'en' => 'You have to sign in before you can access the desired page.'
                      ),
                      'login.youremail' => array(
                        'de' => 'Ihre E-Mail-Adresse',
                        'en' => 'Your e-mail address'
                      ),
                      'login.yourpwd' => array(
                        'de' => 'Ihr Passwort',
                        'en' => 'Your password'
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
                      'register.err.passwordmatch' => array(
                        'de' => 'Die Passwörter stimmen nicht überein.',
                        'en' => 'Please provide two identical passwords.'
                      ),
                      'register.err.passwordcomplexity' => array(
                        'de' => 'Passwort-Komplexität nicht erfüllt.',
                        'en' => 'Your password is not complex enough.'
                      ),
                      'register.err.nicknameexists' => array(
                        'de' => 'Dieser Nickname ist bereits vergeben.',
                        'en' => 'A user with this nickname already exists.'
                      ),
                      'register.err.nicknamenotvalid' => array(
                        'de' => 'Beim Nickname sind nur Buchstaben oder Zahlen erlaubt.',
                        'en' => 'The nickname may contain only letters or numbers.'
                      ),
                      'register.err.nicknamelength' => array(
                        'de' => 'Der Nickname muss 3 bis 20 Zeichen lang sein.',
                        'en' => 'Your nickname needs to contain 3 to 20 characters.'
                      ),
                      'register.err.emailexists' => array(
                        'de' => 'Diese E-Mail-Adresse ist bereits registriert.',
                        'en' => 'This e-mail address is already registered.'
                      ),
                      'register.err.emailnotvalid' => array(
                        'de' => 'Bitte überprüfen Sie Ihre E-Mail-Adresse.',
                        'en' => 'Please provide a valid e-mail address.'
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

                      'hiragana.learn.title' => array(
                        'de' => 'Hiragana lernen',
                        'en' => 'Learn hiragana'
                      ),
                      'hiragana.learn.a.lead' => array(
                        'de' => 'finde das "<em>a</em>" im Symbol!',
                        'en' => 'find the "<em>a</em>" within the symbol!'
                      ),

                      'hiragana.learn.i.lead' => array(
                        'de' => '<em>i</em>gitt, zwei gl<em>i</em>tsch<em>i</em>ge Aale!',
                        'en' => ''
                      ),

                      'hiragana.learn.u.lead' => array(
                        'de' => 'finde das "<em>u</em>" im Symbol!',
                        'en' => 'find the "<em>u</em>" within the symbol!'
                      ),

                      'hiragana.learn.e.lead' => array(
                        'de' => '<em>E</em>ddy der P<em>e</em>likan',
                        'en' => '<em>E</em>ddy the p<em>e</em>lican'
                      ),

                      'hiragana.learn.o.lead' => array(
                        'de' => 'finde die beiden "<em>o</em>" im Symbol!',
                        'en' => 'find both "<em>o</em>" within the symbol!'
                      ),

                      'hiragana.learn.ka.lead' => array(
                        'de' => '<em>Ca</em>rmen, die <em>ka</em>narische Tänzerin',
                        'en' => ''
                      ),

                      'hiragana.learn.ki.lead' => array(
                        'de' => '<em>key</em>, engl. für Schlüssel',
                        'en' => ''
                      ),

                      'hiragana.learn.ku.lead' => array(
                        'de' => '<em>Ku</em>c<em>ku</em>ck, ich wär gern ein <em>Ku</em>c<em>ku</em>ck!',
                        'en' => ''
                      ),

                      'hiragana.learn.ke.lead' => array(
                        'de' => 'das Weinfass im <em>Ke</em>ller',
                        'en' => ''
                      ),

                      'hiragana.learn.ko.lead' => array(
                        'de' => '<em>ko</em>-evolvierende Würmer',
                        'en' => ''
                      ),

                      'hiragana.learn.sa.lead' => array(
                        'de' => '<em>sa</em>g mal, wo gehts hier nach <em>Sa</em>n Francisco?',
                        'en' => ''
                      ),

                      'hiragana.learn.shi.lead' => array(
                        'de' => '<em>schi</em>ck, das gibt Su<em>shi</em>!',
                        'en' => ''
                      ),

                      'hiragana.learn.su.lead' => array(
                        'de' => 'die <em>Su</em>per-Schaukel',
                        'en' => ''
                      ),

                      'hiragana.learn.se.lead' => array(
                        'de' => 'schau, mein <em>se</em>xy Zahn!',
                        'en' => ''
                      ),

                      'hiragana.learn.so.lead' => array(
                        'de' => '<em>So</em>phie, <em>so</em> ein <em>So</em>ngbird!',
                        'en' => ''
                      ),

                      'hiragana.learn.ta.lead' => array(
                        'de' => '<em>ta</em>da! Finde das "<em>ta</em>" im Symbol!',
                        'en' => ''
                      ),

                      'hiragana.learn.chi.lead' => array(
                        'de' => 'Hat<em>chi</em>, das war zu viel <em>Chi</em>li!',
                        'en' => ''
                      ),

                      'hiragana.learn.tsu.lead' => array(
                        'de' => 'Das Fischen ist leicht nach einem <em>Tsu</em>nami..',
                        'en' => ''
                      ),

                      'hiragana.learn.te.lead' => array(
                        'de' => '<em>Te</em>n, engl. für zehn',
                        'en' => ''
                      ),

                      'hiragana.learn.to.lead' => array(
                        'de' => '<em>To</em>tal schmerzhaft..!',
                        'en' => ''
                      ),


                      'hiragana.learn.na.lead' => array(
                        'de' => '<em>Na</em>la, die <em>na</em>ive Priesterin',
                        'en' => ''
                      ),

                      'hiragana.learn.ni.lead' => array(
                        'de' => 'Nähe <em>ni</em>e ohne Faden!',
                        'en' => ''
                      ),

                      'hiragana.learn.nu.lead' => array(
                        'de' => 'die k<em>nu</em>sprige <em>Nu</em>del!',
                        'en' => ''
                      ),

                      'hiragana.learn.ne.lead' => array(
                        'de' => '<em>Ne</em>lly, die <em>ne</em>rvige Katze',
                        'en' => ''
                      ),

                      'hiragana.learn.no.lead' => array(
                        'de' => '<em>No</em> way! Hier kommst du nicht rein!',
                        'en' => ''
                      ),

                      'hiragana.learn.ha.lead' => array(
                        'de' => '<em>haha</em>! Finde das "<em>ha</em>" im Symbol!',
                        'en' => ''
                      ),

                      'hiragana.learn.hi.lead' => array(
                        'de' => '<em>Hi</em>cks! Das hat jemand zu viel gesoffen!',
                        'en' => ''
                      ),

                      'hiragana.learn.fu.lead' => array(
                        'de' => 'Die <em>Hu</em>la-Tänzerin aus <em>Fu</em>erteventura',
                        'en' => ''
                      ),

                      'hiragana.learn.he.lead' => array(
                        'de' => 'komm <em>he</em>runter vom Mt. Saints <em>He</em>lens!',
                        'en' => ''
                      ),

                      'hiragana.learn.ho.lead' => array(
                        'de' => '<em>ho</em>-<em>ho</em>-<em>ho</em>, heuer spiel ich den Weihnachtsmann!',
                        'en' => ''
                      ),

                      'hiragana.learn.ma.lead' => array(
                        'de' => '<em>Mama</em>, ich hab plötzlich vier Arme..!',
                        'en' => ''
                      ),

                      'hiragana.learn.mi.lead' => array(
                        'de' => '21. Jahrhundert, ein neues <em>Mi</em>llennium!',
                        'en' => ''
                      ),

                      'hiragana.learn.mu.lead' => array(
                        'de' => '<em>Mu</em>uuh macht die Kuh',
                        'en' => ''
                      ),

                      'hiragana.learn.me.lead' => array(
                        'de' => '<em>Me</em>ga Ani<em>me</em> Auge',
                        'en' => ''
                      ),

                      'hiragana.learn.mo.lead' => array(
                        'de' => '<em>Mo</em>e, der Eski<em>mo</em>',
                        'en' => ''
                      ),

                      'hiragana.learn.ya.lead' => array(
                        'de' => '<em>Ya</em>nnik, der <em>Ya</em>k',
                        'en' => ''
                      ),

                      'hiragana.learn.yu.lead' => array(
                        'de' => '<em>Yu</em>ri, der <em>ju</em>nge Fisch',
                        'en' => ''
                      ),

                      'hiragana.learn.yo.lead' => array(
                        'de' => '<em>Yo</em>, nimm mich mit Alter!',
                        'en' => ''
                      ),

                      'hiragana.learn.ra.lead' => array(
                        'de' => '<em>Ra</em>lph, der <em>Ra</em>pper',
                        'en' => ''
                      ),

                      'hiragana.learn.ri.lead' => array(
                        'de' => 'Hörst du das Getreide <em>ri</em>eseln?',
                        'en' => ''
                      ),

                      'hiragana.learn.ru.lead' => array(
                        'de' => 'Verrückte <em>Rou</em>te..',
                        'en' => ''
                      ),

                      'hiragana.learn.re.lead' => array(
                        'de' => '<em>Re</em>nnt, er mutiert zu einem Zombie!',
                        'en' => ''
                      ),

                      'hiragana.learn.ro.lead' => array(
                        'de' => '<em>Ro</em>boter <em>ro</em>deln heut!',
                        'en' => ''
                      ),

                      'hiragana.learn.wa.lead' => array(
                        'de' => '<em>Wa</em>be voller Wespen (engl. <em>wa</em>sp)',
                        'en' => ''
                      ),

                      'hiragana.learn.wo.lead' => array(
                        'de' => '<em>Wo</em> ist nur das Klo?!',
                        'en' => ''
                      ),


                      'hiragana.learn.n.lead' => array(
                        'de' => 'Finde das "<em>n</em>" im Symbol',
                        'en' => ''
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

    static function tl($key, $language) {
      return isset(I18n::$i18n[$key][$language]) ? I18n::$i18n[$key][$language]
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
