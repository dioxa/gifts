<script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
<script>
    $(document).ready(function() {
        var password = document.getElementById("password");

        var pattern = {
            charLength: function() {
                if( password.value.length >= 8 ) {
                    return true;
                }
            },
            lowercase: function() {
                var regex = /^(?=.*[a-z]).+$/;
                if( regex.test(password.value) ) {
                    return true;
                }
            },
            uppercase: function() {
                var regex = /^(?=.*[A-Z]).+$/;
                if( regex.test(password.value) ) {
                    return true;
                }
            },
            special: function() {
                var regex = /^(?=.*[0-9_\W]).+$/;
                if( regex.test(password.value) ) {
                    return true;
                }
            },
            same: function() {
                if(password.value == document.getElementById("repeat").value) {
                    return true
                }
            }
        };

        $("#repeat").blur( function () {
            if( pattern.charLength() == true &&
            pattern.lowercase() &&
            pattern.uppercase() &&
            pattern.special() &&
            pattern.same()) {
                $("#check_pass").html("Сойдет");
            } else {
                $("#check_pass").html("Ошибка");
            }
        });

        $("#email").blur(function () {
            var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            if( re.test(document.getElementById("3").value)){
                $("#check_mail").html("Сойдет");
            } else {
                $("#check_mail").html("Ошибка");
            }
        });

        function check(id) {
            if(document.getElementById(id).value == ""){
                document.getElementById(id).style.borderColor= "red";
                return false;
            } else {
                document.getElementById(id).style.borderColor= "initial";
                return false;
            }
        }

        $("#button").addEventListener("click", function () {
            if(!check("firstname") &&
                !check("lastname") &&
                !check("login") &&
                !check("password") &&
                !check("repeat") &&
                !check("email")) {
                return false;
            } else {
                return true;
            }
        });
    });
</script>
<?php
    echo"<form method='POST' action='/Registration/load'>
    Имя: <input id='firstname' type='text' name='info[firstname]' /><br>
	Фамилия: <input id='lastname' type='text' name='info[lastname]' />
	Логин : <input id='login' type='text' name='info[login]' /><br>
	Пароль: <input id='password' type='password' name='info[password]'/>
	повторите пароль: <input id='repeat' type='password' name='pass'/><div id = 'check_pass'></div>
	email: <input id='email' type='text' name='info[email]' /><div id = 'check_mail'></div><br>
	день рождения: <select name='info[year]'>";

    for($i = 1940; $i < 2017; $i++) {
        echo "<option value=$i>$i</option>";
    }
    echo "</select><select name='info[month]'>";

    for($i = 1; $i < 13; $i++) {
        echo "<option value=$i>$i</option>";
    }
    echo "</select><select name='info[day]'>";

    for($i = 1; $i < 32; $i++) {
        echo "<option value=$i>$i</option>";
    }
    echo "</select>";

    echo "пол:<select name='info[sex]'>
    <option value='Ж'>Ж</option>
    <option value='М'>М</option>
    </select>
	<input id='button' type='submit' value='Зарегистрироваться'>
    </form>";
?>