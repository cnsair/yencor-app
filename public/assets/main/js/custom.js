/* 
    Written by Kenneth - It begins here
*/

// Select all form-check-inline elements
const formCheckElements = document.querySelectorAll('.form-check-inline');

// Add click event listeners to each element
formCheckElements.forEach((element) => {
    element.addEventListener('click', () => {
        // Remove "selected" class from all elements
        formCheckElements.forEach((el) => el.classList.remove('selected'));
        
        // Add "selected" class to the clicked element
        element.classList.add('selected');

        // Optionally, handle selected value
        const selectedValue = element.getAttribute('data-value');
        console.log('Selected payment option:', selectedValue);
    });
});

function selectCar(carId) {
    // Deselect all images first
    const allCars = document.querySelectorAll('.car-image');
    allCars.forEach(car => {
        car.classList.remove('selected');
    });

    // Select the clicked car
    const selectedCar = document.getElementById(carId);
    selectedCar.classList.add('selected');
}

/* 
    Written by Kenneth - It ends here
*/

//For FORMS
// Disable buttons when clicked
//SignIn
function signInF(form) {
    form.signIn.disabled = true;
    form.signIn.value = "Signing in...";
    return true;
}

//Register
function registerF(form) {
    form.register.disabled = true;
    form.register.value = "Please wait...";
    return true;
}