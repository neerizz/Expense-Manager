const form = document.getElementById("datewiseform")
const from = document.getElementById("dtwisefrom")
const to = document.getElementById("dtwiseto")


const sendData = (srate, count) => {
    if(srate === count){
      return true;
    }

}

const successmsg = () => {
  let formcon = document.getElementsByClassName('formsend');
  var count = formcon.length -1;
  let flag = false;
  for(var i = 0; i< formcon.length; i++)
  {
    if(formcon[i].className === "formsend success")
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
    const fromval = new Date(from.value) 
    const toval = new Date(to.value)
    
  

  if(fromval>toval)
  {
    seterrormsg(to,"Date Range Invalid");
  }
  else
  {
    setsuccessmsg(to);
  }

    let resultant = successmsg();
    if(resultant == true)
    return true;
    else
    return false;
}

function seterrormsg(input, msg){
  const f1 = input.parentElement;
  const small = f1.querySelector('small');
  small.innerText = msg;
  f1.className = "formsend error";
}

function setsuccessmsg(input){
  const formcontrol = input.parentElement;
  formcontrol.className = "formsend success"; 
}