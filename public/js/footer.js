var nl = document.querySelector('.nl')
var news = document.querySelector('.nl__btn-footer')
var input = document.querySelector('.nl__input')

var regexEmail = /^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/

function newsBtn(e) {
    e.preventDefault();

    if (input.value != '' && nl.classList.contains('nl--focus'))
        nl.classList.add('nl--submit')

    if (nl.classList.contains('nl--submit')) {
        validation()
    } else if (!nl.classList.contains('nl--sent')) {
        nl.classList.toggle('nl--focus')

        setInterval(() => {
            nl.classList.contains('nl--focus') ? input.focus() : input.blur()
        }, 800);
    }
}

news.addEventListener('click', newsBtn);


input.addEventListener('keyup', (e) => {
    input.value != '' ? nl.classList.add('nl--submit') : nl.classList.remove('nl--submit')

    if (e.keyCode == 13 && input.value != '')
        validation();
})

document.addEventListener('click', (e) => {
    if (e.target != news && e.target != input && input.value == '')
        nl.classList.remove('nl--focus', 'nl--submit', 'nl--error');
});


function validation() {
    if (regexEmail.test(input.value)) {
        news.innerHTML = 'Check your inbox!';
        nl.classList.remove('nl--submit', 'nl--focus', 'nl--error');
        nl.classList.add('nl--sent');
    } else {
        nl.classList.add('nl--error');
    }
}
