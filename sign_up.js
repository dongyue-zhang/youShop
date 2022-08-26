const emailWrongFomat = "Please input a valid Email address";
const loginNameEmpty = "Please enter an user name";
const loginNameTooLong = "User Name must be less than 20 character long";
const passwdWrongFormat = "Password must have at least 1 uppercase letter and 1 lowercase letter";
const passwdLessThanSix = "Password must be longer than 6 characters";
const passwdNotMatched = "Passwords don't match. Please enter again.";
const postalcodeWrongFormat = "Postal Code must be like A1B2C3";
const phonenumberWrongFormate = "Phone Number must be like 123-456-7890";
const emailRegex = /\S+@\S+\.\S+/;
const postalRegex = /[A-Z][0-9][A-Z][0-9][A-Z][0-9]/;
const phoneRegex = /[0-9]{3}-[0-9]{3}-[0-9]{4}/;

const criterias = [{
  condition: () => password.value.length >= 6,
  element: password,
  message: passwdLessThanSix
}, {
  condition: () => password.value.toLowerCase() !== password.value && password.value !== password.value.toUpperCase(),
  element: password2,
  message: passwdWrongFormat
}, {
  condition: () => emailRegex.test(email.value),
  element: email,
  message: emailWrongFomat
}, {
  condition: () => username.value != '',
  element: username,
  message: loginNameEmpty
}, {
  condition: () => username.value.length <= 20 && username.value.length != 0,
  element: username,
  message: loginNameTooLong
}, {
  condition: () => password.value === password2.value && password2.value !== '',
  element: password2,
  message: passwdNotMatched
}, {
  condition: () => postalRegex.test(postalcode.value),
  element: postalcode,
  message: postalcodeWrongFormat
}, {
  condition: () => phoneRegex.test(phonenumber.value),
  element: phonenumber,
  message: phonenumberWrongFormate
}
]

const validated = () => {
  let validatedNum = false;
  criterias.forEach(criteria => {
      validatedNum += validateElement(criteria.condition(), criteria.element, criteria.message);
      
  });
  return validatedNum;
};

function validateElement (condition, element, message) {

  let isValidated = true;
  if (!condition) {

      setError(element, message);
      isValidated = false;
  } else {
    setSuccess(element);
  }

  return isValidated;
}

const setError = (element, message) => {
    const textfield = element.parentElement.parentElement;
    const errorDisplay = textfield.querySelector('.error');
  
    errorDisplay.innerText = message;

}
const setSuccess = (element) => {
  const textfield = element.parentElement;

}

function resetError() {
  document.querySelectorAll('.error').forEach(error => {
    error.innerText = '';
  });
}

function validate(event) {
  resetError();
  if ( validated() !== criterias.length ) {
    event.preventDefault();
  } 
}
function scrollDown() {
    window.scrollTo(0,document.body.scrollHeight);
}