const form = document.getElementById("form")
const oldpassword = document.getElementById("oldpass")
const newpassword = document.getElementById("newpass")
const confirmpassword = document.getElementById("cpass")

const sendData = (srate, count) => {
    if(srate === count){
      return true;
    }

}

const successmsg = () => {
  let formcon = document.getElementsByClassName('formcontrol');
  var count = formcon.length -1;
  let flag = false;
  for(var i = 0; i< formcon.length; i++)
  {
    if(formcon[i].className === "formcontrol success")
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
    const oldpasswordval = oldpassword.value.trim()
    const newpasswordval = newpassword.value.trim()
    const cpasswordval = confirmpassword.value.trim()

    
  //validate old password

  if(oldpasswordval==="")
  {
    seterrormsg(oldpassword,"password cannot be blank");
  }
  else
  {
    setsuccessmsg(oldpassword);
  }

  //validate new password
  if(newpasswordval==="")
    {
      seterrormsg(newpassword,"password cannot be blank");
    }
    else if(newpasswordval.length < 6)
    {
      seterrormsg(newpassword,"password must be minimum 6 characters long");
    }
    else if(newpasswordval.length > 30)
    {
      seterrormsg(newpassword,"password must be maximum 30 characters long");
    }
    else
    {
      setsuccessmsg(newpassword);
    }

  //validate cpassword
    if(cpasswordval === "")
    {
      seterrormsg(confirmpassword, `password cannot be blank`)
    }
    else if(newpasswordval!==cpasswordval)
    {
      seterrormsg(confirmpassword,"The two passwords do not match")
    }
    else
    {
      setsuccessmsg(confirmpassword);
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
  formcontrol.className = "formcontrol error";
}

function setsuccessmsg(input){
  const formcontrol = input.parentElement;
  formcontrol.className = "formcontrol success"; 
}