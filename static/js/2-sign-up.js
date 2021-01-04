//For Image Preview
const inpFile = document.getElementById("imageUpload");
const previewContainer = document.getElementById("imagePreview");
const previewImage = previewContainer.querySelector(".image-preview__image");
const previewDefaultText = previewContainer.querySelector(".image-preview__default-text");

inpFile.addEventListener("change", function () {
    const file = this.files[0];

    if (file) {
        const reader = new FileReader();

        previewDefaultText.style.display = "none";
        previewImage.style.display = "block";

        reader.addEventListener("load", function () {
            previewImage.setAttribute("src", this.result);
        });
        reader.readAsDataURL(file);
    }   
    else {
        previewDefaultText.style.display = null;
        previewImage.style.display = null;
        previewImage.setAttribute("src", "");
    }
});


//For Form Validation:
const form = document.getElementById("form")
const fname = document.getElementById("fullname")
const username = document.getElementById("username")
const email = document.getElementById("email")
const password = document.getElementById("password")
const cpassword = document.getElementById("confirmpassword")


const isemail = (emailval) => {
  let atsymbol = emailval.indexOf('@');
  if(atsymbol < 1) return true;
  let dot = emailval.lastIndexOf('.');
  if(dot === -1) return true;
  if(dot <= atsymbol + 3) return true;
  if(dot === emailval.length-1) return true;
  return false;
}


const sendData = (srate, count) => {
    if(srate === count){
      // alert("Form Submitted!");
      return true;
    }

}

const successmsg = () => {
  let formcon = document.getElementsByClassName('form-control');
  var count = formcon.length -1;
  let flag = false;
  for(var i = 0; i<formcon.length; i++)
  {
    if(formcon[i].className === "form-control success")
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
    const fnameval = fname.value.trim()
    const usernameval = username.value.trim()
    const emailval = email.value.trim()
    const passwordval = password.value.trim()
    const cpasswordval = cpassword.value.trim()
  
    //validate fullname
    if(fnameval === ""){
      seterrormsg(fname, "name field cannot be left blank");
    }
    else if(fnameval.length <=1){
      seterrormsg(fname, "minimum length : 2 characters");
    }
    else
    {
      setsuccessmsg(fname);
    }
    

    //validate email
    if(emailval==="")
    {
      seterrormsg(email, "email cannot be left blank")
    }
    else if(isemail(emailval)){
      seterrormsg(email, "not a valid email")
    }
    else{
      setsuccessmsg(email);
    }
    

    //validate username
    if(usernameval === "")
    {
      seterrormsg(username, "Username cannot be blank");
    }
    else if(usernameval.length <=2)
    {
      seterrormsg(username, "minimum length: 3 characters")
    }
    else{
      setsuccessmsg(username);
    }

    //validate password

    if(passwordval==="")
    {
      seterrormsg(password,"password cannot be blank");
    }
    else if(passwordval.length < 6)
    {
      seterrormsg(password,"password must be minimum 6 characters long");
    }
    else
    {
      setsuccessmsg(password);
    }

    //validate cpassword
    if(cpasswordval == "")
    {
      seterrormsg(cpassword, `This field cannot be left blank`)
    }
    else if(passwordval!==cpasswordval)
    {
      seterrormsg(cpassword,"The two passwords do not match")
    }
    else
    {
      setsuccessmsg(cpassword);
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
  formcontrol.className = "form-control error";
}

function setsuccessmsg(input){
  const formcontrol = input.parentElement;
  formcontrol.className = "form-control success"; 
}