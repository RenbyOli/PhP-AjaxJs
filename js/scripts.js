// Reg or auth

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
                        if( result == 'Всё заебись' ) {
                            location.reload();
                        } else {
                            alert(result);
                        }
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

// Logout

let exitProfile = document.querySelector('#exit');

exitProfile.addEventListener('click', () => {
    ajax('scripts/logout.php', 'POST', logoutResult, {'logout':true});

    function logoutResult(result) {
        if(result == '1') {
            location.reload();
        }
    }
});

// Add article

let formAddArticle = document.querySelector('#form_add_article');

formAddArticle.querySelector('.add-article__submit').addEventListener('click', (e) => {
    e.preventDefault();
    let title = formAddArticle.querySelector('.add-article__title').value,
        text = formAddArticle.querySelector('.add-article__text').value,
        image = formAddArticle.querySelector('.add-article__file input')

    let data = {
        title: title,
        text: text,
        image: image
    }

    console.log(data);
});

// Вывод превью загруженной картинки

let inputFile = formAddArticle.querySelector('.add-article__file input');

inputFile.addEventListener('change', function() {
    if (this.files[0]) {
        var fr = new FileReader();
    
        fr.addEventListener("load", function () {
          formAddArticle.querySelector('.add-article__file').innerHTML = `<img src="${fr.result}" alt="">`;
        }, false);
    
        fr.readAsDataURL(this.files[0]);
      }
        
    
});