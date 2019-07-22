let buttons = document.querySelectorAll('.btnRegAuth');
buttons.forEach((item) => {
    item.addEventListener('click', (e) => {
        event.preventDefault();
        let data = {
            "name": item.id,
        }
    
        ajax('scripts/reg_or_auth.php', 'POST', login, data);
    
        function login(result) {
            document.querySelector('#form').innerHTML = result;

            if(item.id == 'reg') {
                let reg = document.querySelector('#reg_user');
                reg.addEventListener('click', (e) => {
                    e.preventDefault();
                    let login = document.querySelector('#new_login').value,
                        pass = document.querySelector('#new_pass').value;

                    let data = {
                        'new_login': login,
                        'new_pass': pass,
                    }

                    ajax('scripts/reg.php', 'POST', regResult, data);

                    function regResult(result) {
                        console.log(result);

                        document.cookie = 'name=name';
                    }
                })
            }
            if(item.id == 'auth') {
                let auth = document.querySelector('#auth_user');
                auth.addEventListener('click', (e) => {
                    e.preventDefault();
                    let login = document.querySelector('#login').value,
                        pass = document.querySelector('#pass').value;

                    let data = {
                        'login': login,
                        'pass': pass,
                    }

                    ajax('scripts/auth.php', 'POST', authResult, data);

                    function authResult(result) {
                        if(result == '1') {
                            document.cookie = 'name=name';
                            location.reload();
                        } else {
                            alert('Такого пользователя нет!');
                        }
                    }
                })
            }
        }
    })
})

let exitProfile = document.querySelector('#exit');

exitProfile.addEventListener('click', () => {
    document.cookie = "name=;expires=15/02/2003";
    location.reload();
});