//For Form Validation

const form = document.getElementById("form1")
const username = document.getElementById("user1")
const password = document.getElementById("pass1")

const sendData = (srate, count) => {
    if(srate === count){
      return true;
    }

}

const successmsg = () => {
  let formcon = document.getElementsByClassName('form-controller');
  var count = formcon.length -1;
  let flag = false;
  for(var i = 0; i< formcon.length; i++)
  {
    if(formcon[i].className === "form-controller successful")
    {
      var srate = 0+i;  
      flag = sendData(srate,count);  
    }
    else 
    {
      return false;
    }
  }
  return flag;
}

const validate = () => {
    const usernameval = username.value.trim()
    const passwordval = password.value.trim()
    
  //validate username
    if(usernameval === "")
    {
      seterrormsg(username, "Username cannot be blank");
    }
    else if(usernameval.length <=2)
    {
      seterrormsg(username, "Minimum length of username: 3 characters")
    }
    else{
      setsuccessmsg(username);
    }

  //validate password

    if(passwordval==="")
    {
      seterrormsg(password,"password cannot be blank");
    }
    else
    {
      setsuccessmsg(password);
    }

    let resultant = successmsg();
    if(resultant == true)
    return true;
    else
    return false;
}

function seterrormsg(input, msg){
  const formcontrol = input.parentElement;
  const small = formcontrol.querySelector('small');
  small.innerText = msg;
  formcontrol.className = "form-controller mistake";
}

function setsuccessmsg(input){
  const formcontrol = input.parentElement;
  formcontrol.className = "form-controller successful"; 
}