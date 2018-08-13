var login = 1;

function updateFormContainer(){
    console.log(login);
    if(login == 1){
        document.getElementById('login-form').style.display = "none";
        document.getElementById('register-form').style.display = "flex";
        login = 0;
    }else{
        document.getElementById('login-form').style.display = "flex";
        document.getElementById('register-form').style.display = "none";
        login = 1;
    }
}