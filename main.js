function capLock(e) {
    var input = document.getElementById('loginForm');
    var alert = document.getElementById("text");
    input.addEventListener("keyup", function (event) {

        if (event.getModifierState("CapsLock")) {
            text.style.visibility = "visible";
        } else {
            text.style.visibility = "hidden"
        }
    });
}

function validateLoginForm() {
    if (!checkLoginInputs())
        return false;
    else return true;
}

function validateRegisterForm() {
    if (!checkRegisterInputs())
        return false;
    else return true;
}

function trimInputs(data) {
    output = data.value.trim();
    return output;
}

function setErrorForRegister(input, message) {
    const formControl = input.parentElement;
    const small = formControl.querySelector('small');
    formControl.className = 'register-input error';
    small.innerText = message;
    return false;
}

function setSuccessForRegister(input) {
    const formControl = input.parentElement;
    formControl.className = 'register-input success';
}

function setErrorForLogin(input, message) {
    const formControl = input.parentElement;
    const small = formControl.querySelector('small');
    formControl.className = 'login-input error';
    small.innerText = message;
    return false;
}

function setSuccessForLogin(input) {
    const formControl = input.parentElement;
    formControl.className = 'login-input success';
}

function isEmail(email) {
    return /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(email);
}

function isPasswordValid(password) {
    return /^[a-zA-Z0-9_]*$/.test(password);
}

function checkLoginInputs() {
    let isValid = true;
    const email = document.getElementById('email');
    const password = document.getElementById('loginPassword');
    // trim to remove the whitespaces
    const emailValue = trimInputs(email);
    const passwordValue = trimInputs(password);
    if (emailValue === '' || emailValue === null) {
        setErrorForLogin(email, 'Email cannot be blank');
        isValid = false;
    } else if (!isEmail(emailValue)) {
        setErrorForLogin(email, 'Invalid email syntax');
        isValid = false;

    } else {
        setSuccessForLogin(email);
    }

    if (passwordValue === '' || passwordValue === null) {
        setErrorForLogin(password, 'Password cannot be blank');
        isValid = false;

    } else if (passwordValue.length < 8 || passwordValue.length > 20) {
        setErrorForLogin(password, 'Must contain 8÷20 charackters');
        isValid = false;

    } else if (!isPasswordValid(passwordValue)) {
        setErrorForLogin(password, 'Must contain only letters, numbers and underscores');
        isValid = false;
    } else {
        setSuccessForLogin(password);
    }
    return isValid;
}

function checkRegisterInputs() {
    let isValid = true;
    const username = document.getElementById('username');
    const email = document.getElementById('email');
    const password = document.getElementById('registerPassword');
    const password2 = document.getElementById('cRegisterPassword');
    //const captcha = document.getElementById('captcha');

    // trim to remove the whitespaces
    const usernameValue = trimInputs(username);
    const emailValue = trimInputs(email);
    const passwordValue = trimInputs(password);
    const password2Value = trimInputs(password2);
    //const captchaResponse = captcha.getResponse();

    if (usernameValue === '' || usernameValue === null || usernameValue.length < 3) {
        setErrorForRegister(username, 'Must contain at least 3 charakters !');
        isValid = false;
    } else {
        setSuccessForRegister(username);
    }

    if (emailValue === '' || emailValue === null) {
        setErrorForRegister(email, 'Email cannot be blank');
        isValid = false;
    } else if (!isEmail(emailValue)) {
        setErrorForRegister(email, 'Invalid email syntax');
        isValid = false;

    } else {
        setSuccessForRegister(email);
    }

    if (passwordValue === '' || passwordValue === null) {
        setErrorForRegister(password, 'Password cannot be blank');
        isValid = false;

    } else if (passwordValue.length < 8 || passwordValue.length > 20) {
        setErrorForRegister(password, 'Must contain 8÷20 charackters');
        isValid = false;

    } else if (!isPasswordValid(passwordValue)) {
        setErrorForRegister(password, 'Must contain only letters, numbers and underscores');
        isValid = false;
    } else {
        setSuccessForRegister(password);

    }
    if (password2Value === '' || password2Value === null) {
        setErrorForRegister(password2, 'Password cannot be blank');
        isValid = false;

    } else if (passwordValue !== password2Value) {
        setErrorForRegister(password2, 'Passwords do not match');
        isValid = false;
    } else {
        setSuccessForRegister(password2);
    }

   /* if(captchaResponse === '' || captchaValue === null){
        setErrorForRegister(captcha, 'Please verify that you are a Human');
        isValid = false;
    }*/

    return isValid;
}

$('#submit').on('click', function (e) {
    e.preventDefault();
    var form = $(this).parents('form');
    swal.fire({
        position: 'top-end',
        icon: 'success',
        title: 'New user has been added.',
        showConfirmButton: false,
        timer: 5000,
        closeOnConfirm: false
    }, function (isConfirm) {
        if (isConfirm) form.submit();
    });
})


function togglePassword(id) {
    let password = document.getElementById(id);
    password.type === 'password' ?
        (password.type = 'text', $('#eyeIcon').text('visibility')) : (password.type = 'password',
            $('#eyeIcon').text('visibility_off'));
}

function togglePassword1(id) {
    let password = document.getElementById(id);
    password.type === 'password' ?
        (password.type = 'text', $('#ceyeIcon').text('visibility')) : (password.type = 'password',
            $('#ceyeIcon').text('visibility_off'));
}

function capLock(e) {
    var input = document.getElementById('registerForm');
    var alert = document.getElementById("text");
    input.addEventListener("keyup", function (event) {

        if (event.getModifierState("CapsLock")) {
            text.style.visibility = "visible";
        } else {
            text.style.visibility = "hidden"
        }
    });
}

function setTodaysDate() {
    var now = new Date();
    var day = ("0" + now.getDate()).slice(-2);
    var month = ("0" + (now.getMonth() + 1)).slice(-2);
    var today = now.getFullYear() + "-" + (month) + "-" + (day);
    $('input[type=date]').val(today);
}

$('#periodOfTime').change(function() {
    if (this.value == "customPeriod") {
        document.getElementById("periodOfTime").setAttribute("onclick", "");
        $('#dateModal').modal({
            show: true

        });
    } else {
        document.getElementById("periodOfTime").setAttribute("onclick", "this.form.submit()");
    }
});

function sortTableAlphabetically(idOfTable) {
    var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
    table = document.getElementById(idOfTable);
    switching = true;
    //Set the sorting direction to ascending:
    dir = "asc";
    /*Make a loop that will continue until
    no switching has been done:*/
    while (switching) {
        //start by saying: no switching is done:
        switching = false;
        rows = table.rows;
        /*Loop through all table rows (except the
        first, which contains table headers):*/
        for (i = 1; i < (rows.length - 1); i++) {
            //start by saying there should be no switching:
            shouldSwitch = false;
            /*Get the two elements you want to compare,
            one from current row and one from the next:*/
            x = rows[i].getElementsByTagName("TD")[0];
            y = rows[i + 1].getElementsByTagName("TD")[0];
            /*check if the two rows should switch place,
            based on the direction, asc or desc:*/
            if (dir == "asc") {
                if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                    //if so, mark as a switch and break the loop:
                    shouldSwitch = true;
                    break;
                }
            } else if (dir == "desc") {
                if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                    //if so, mark as a switch and break the loop:
                    shouldSwitch = true;
                    break;
                }
            }
        }
        if (shouldSwitch) {
            /*If a switch has been marked, make the switch
            and mark that a switch has been done:*/
            rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
            switching = true;
            //Each time a switch is done, increase this count by 1:
            switchcount++;
        } else {
            /*If no switching has been done AND the direction is "asc",
            set the direction to "desc" and run the while loop again.*/
            if (switchcount == 0 && dir == "asc") {
                dir = "desc";
                switching = true;
            }
        }
    }
};

function sortTableNumerically(idOfTable) {
    var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
    table = document.getElementById(idOfTable);
    switching = true;
    //Set the sorting direction to ascending:
    dir = "asc";
    /*Make a loop that will continue until
    no switching has been done:*/
    while (switching) {
        //start by saying: no switching is done:
        switching = false;
        rows = table.rows;
        /*Loop through all table rows (except the
        first, which contains table headers):*/
        for (i = 1; i < (rows.length - 1); i++) {
            //start by saying there should be no switching:
            shouldSwitch = false;
            /*Get the two elements you want to compare,
            one from current row and one from the next:*/
            x = rows[i].getElementsByTagName("TD")[1];
            y = rows[i + 1].getElementsByTagName("TD")[1];
            /*check if the two rows should switch place,
            based on the direction, asc or desc:*/
            if (dir == "asc") {
                if (Number(x.innerHTML) > Number(y.innerHTML)) {
                    //if so, mark as a switch and break the loop:
                    shouldSwitch = true;
                    break;
                }
            } else if (dir == "desc") {
                if (Number(x.innerHTML) < Number(y.innerHTML)) {
                    //if so, mark as a switch and break the loop:
                    shouldSwitch = true;
                    break;
                }
            }
        }
        if (shouldSwitch) {
            /*If a switch has been marked, make the switch
            and mark that a switch has been done:*/
            rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
            switching = true;
            //Each time a switch is done, increase this count by 1:
            switchcount++;
        } else {
            /*If no switching has been done AND the direction is "asc",
            set the direction to "desc" and run the while loop again.*/
            if (switchcount == 0 && dir == "asc") {
                dir = "desc";
                switching = true;
            }
        }
    }
}

