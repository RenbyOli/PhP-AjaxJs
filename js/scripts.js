// Reg or auth

let buttons = document.querySelectorAll('.btnRegAuth');
buttons.forEach((item) => {
    item.addEventListener('click', (e) => {
        event.preventDefault();
        let formData = new FormData();

        formData.append('name', item.id);
    
        ajax('scripts/reg_or_auth.php', 'POST', login, formData);
    
        function login(result) {
            document.querySelector('#form').innerHTML = result;

            if(item.id == 'reg') {
                let reg = document.querySelector('#reg_user');
                reg.addEventListener('click', (e) => {
                    e.preventDefault();
                    let login = document.querySelector('#new_login').value,
                        pass = document.querySelector('#new_pass').value;
                        let formData = new FormData();

                        formData.append('new_login', login);
                        formData.append('new_pass', pass);

                    ajax('scripts/reg.php', 'POST', regResult, formData);

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
                    let formData = new FormData();

                    formData.append('login', login);
                    formData.append('pass', pass);

                    ajax('scripts/auth.php', 'POST', authResult, formData);

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
if(exitProfile !== null) {
    exitProfile.addEventListener('click', () => {
        let formData = new FormData();
        formData.append('logout', true);
        ajax('scripts/logout.php', 'POST', logoutResult, formData);
    
        function logoutResult(result) {
            if(result == '1') {
                location.reload();
            }
        }
    });
}

// Add article

let formAddArticle = document.querySelector('#form_add_article');

if(formAddArticle !== null) {
    formAddArticle.querySelector('.add-article__submit').addEventListener('click', (e) => {
        e.preventDefault();
    
        let formData = new FormData(formAddArticle);
    
        ajax('scripts/add_article.php', 'POST', addArtResult, formData);
    
        function addArtResult(result) {
            if(result == 1) {
                location.reload();
            } else {
                alert(result);
            }
        }
    });
}

//Delete article

let removeButtonArticle = document.querySelectorAll('.article__delete');

removeButtonArticle.forEach((item, i) => {
    item.addEventListener('click', () => {
        let idArticle = item.id.split('_');
        idArticle = idArticle[idArticle.length - 1]
        let data = new FormData();

        data.append('id', idArticle);

        ajax('scripts/delete_article.php', 'POST', delArtResult, data);

        function delArtResult(result) {
            console.log(result);
            location.reload();
        }
    });
});

// Вывод превью загруженной картинки

if(formAddArticle !== null) {
    let inputFile = formAddArticle.querySelector('.add-article__file input');

    inputFile.addEventListener('change', function() {
        if (this.files[0]) {
            let fr = new FileReader();
            let articleImage = document.createElement('img');
            articleImage.classList.add('add-article__preview-photo');
        
            fr.addEventListener("load", function () {
                if(formAddArticle.querySelector('.add-article__preview-photo') !== null) {
                    formAddArticle.querySelector('.add-article__preview-photo').setAttribute('src', fr.result);
                } else {
                    articleImage.setAttribute('src', fr.result);
                    formAddArticle.querySelector('.add-article__file').appendChild(articleImage);
                }
            }, false);
        
            fr.readAsDataURL(this.files[0]);
          }
    });
}