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

        dropZoneArtcile.datas.append(formAddArticle.querySelector('.add-article__title').name, formAddArticle.querySelector('.add-article__title').value);
        dropZoneArtcile.datas.append(formAddArticle.querySelector('.add-article__text').name, formAddArticle.querySelector('.add-article__text').value);
    
        ajax('scripts/add_article.php', 'POST', addArtResult, dropZoneArtcile.datas);
    
        function addArtResult(result) {
            if(result == 1) {
                location.reload();
            } else {
                alert(result);
            }
        }
    });
}

//Delete button article

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

class DropDropFck {
	constructor(dropArea, resultsBlock, cssClassPreviewArticle, maxFilesCount) {
        this.settings = {
            dropArea: dropArea,
            resultsBlock: resultsBlock,
            cssClassPreviewArticle: cssClassPreviewArticle,
            maxFilesCount: maxFilesCount
        };

		this.dropArea = document.querySelector(this.settings.dropArea);
		this.inputFile = this.dropArea == null ? false : this.dropArea.querySelector('input');
		this.resultsBlock = document.querySelector(this.settings.resultsBlock);
		this.j = 0;
		this.datas = new FormData();
	}

	addPreviewImage(filesArr) {
		if(filesArr.files.length + this.resultsBlock.childNodes.length > this.settings.maxFilesCount) {
			this.inputFile.value = '';
			console.log('error');
		} else {
			for(let i = 0; i < filesArr.files.length; i++) {
				let fr = new FileReader();
				fr.readAsDataURL(filesArr.files[i]);
				fr.addEventListener("load", () => {
					this.resultsBlock.innerHTML += `<div class="${this.settings.cssClassPreviewArticle}" id="image_${this.j}"><img src="${fr.result}"></div>`;
					this.datas.append("image_" + this.j, filesArr.files[i]);
					this.j++;
				});
			}
			console.log('add');
		}
	};

	deletePreviewImage(wrapp, datas, j) {
		if(wrapp !== null) {
			wrapp.addEventListener('click', (e) => {
				if(e.target.classList.contains(this.settings.cssClassPreviewArticle)) {
					e.target.classList.remove(this.settings.cssClassPreviewArticle);
					e.target.remove();
					this.datas.delete(e.target.id);
				} else {
					return false;
				}
			});
		}
	};

	init() {
		if(this.inputFile) {
			this.inputFile.addEventListener('change', (e) => {
				this.addPreviewImage(this.inputFile);
				this.deletePreviewImage(this.resultsBlock, this.datas, this.j);
			});
			
		
			['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
				this.dropArea.addEventListener(eventName, function (e) {
					e.preventDefault()
					e.stopPropagation()
				}, false);
			});
		
			['dragenter', 'dragover'].forEach(eventName => {
				this.dropArea.addEventListener(eventName, (e) => {
					this.dropArea.classList.add('add-article__file--file-active')
				}, false)
			});
		
			['dragleave', 'drop'].forEach(eventName => {
				this.dropArea.addEventListener(eventName, (e) => {
					this.dropArea.classList.remove('add-article__file--file-active')
				}, false)
			});
		
			this.dropArea.addEventListener('drop', (e) => {
				if(this.dropArea) {
					let dt = e.dataTransfer;
					this.addPreviewImage(dt);
					this.deletePreviewImage(this.resultsBlock, this.datas, this.j)
				}
			}, false);
		}
	}
}

let dropZoneArtcile = new DropDropFck('.add-article__file', '.add-article__result', 'add-article__preview', 1);
dropZoneArtcile.init();