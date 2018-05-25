//=============================================================================
// File input
//=============================================================================
document.querySelector('input[name="upload-btn"]').onchange = function () {
    document.querySelector('input[name="upload-file"]').value = this.files[0].name;
};

//=============================================================================
// Text fields with icons
//=============================================================================
document.addEventListener("DOMContentLoaded", function () {

    // Listening for input changes
    document.addEventListener("focus", function (e) {
        checkTextfieldInput(e.target);
    }, true);
    document.addEventListener("change", function (e) {
        checkTextfieldInput(e.target);
    }, true);
    document.addEventListener("input", function (e) {
        checkTextfieldInput(e.target);
    }, true);
    document.addEventListener("blur", function (e) {
        checkTextfieldInput(e.target);
    }, true);

    // Initializing inputs
    var inputs = document.getElementsByClassName("mdl-textfield__input");
    for (var i = 0; i < inputs.length; i++) {
        checkTextfieldInput(inputs[i]);
    }

});

function checkTextfieldInput(input) {
    // Getting the input and the textfield
    if (input instanceof Element && input.matches(".mdl-textfield__input") === true) {
        var field = input.closest(".mdl-textfield"),
            hasValue = input.value.toString().length !== 0;
        // If textfield found
        if (field !== null) {
            // Modifying icons
            var icons = field.getElementsByClassName("mdl-textfield__icon");
            for (var i = 0; i < icons.length; i++) {
                // If no value
                if (hasValue === false && input.isActive() !== true) {
                    icons[i].classList.remove("mdl-color-text--primary");
                }
                // Else if focus or value
                else {
                    icons[i].classList.add("mdl-color-text--primary");
                    // console.log(hasValue, input.isActive())
                }
            }
        }
    }
}

// Closest
Element.prototype.closest = function (selector) {
    // If is what we're looking for
    if (this.matches(selector) === true) {
        // Return element
        return this;
    }
    // Else
    else {
        // If parent is a valid element
        var parent = this.parentNode;
        if (parent instanceof Element) {
            // Checking parent node
            return parent.closest(selector);
        }
        // Else
        else {
            // Nothing matches
            parent = null;
        }
        return parent;
    }
};

// Is active
Element.prototype.isActive = function () {
    return this === document.activeElement;
};

//=================================================================
//To make required fields not red
//=================================================================
$(window).on('load', function () {
    $('input[data-required=true]').attr("required", "");
});

// //  push it to array and remove required attribute
// let requiredComponents = document.querySelectorAll("[required]");
// requiredComponents.forEach(function (e) {
//     e.removeAttribute('required');
// })
// // // when submit button click, add required attribute back
// document.querySelector(".submit-btn").addEventListener("click", function () {
//     requiredComponents.forEach(function (e) {
//         e.setAttribute('required', true)
//     })
// });
// // // also when form submit event
// document.querySelector(".curriculo-form").addEventListener("submit", function () {
//     requiredComponents.forEach(function (e) {
//         e.setAttribute('required', true)
//     })
// });


//To show loading when contact form is submited
$( '.curriculo-form' ).submit(function( event ) {
    // event.preventDefault();
    var recaptcha = $('#g-recaptcha-response').val();
    if (recaptcha === '') {
        event.preventDefault();
        $('.recaptcha-required').html('<p class="color-red font-12">Por favor, verifique o recaptcha.</p>');
    }
    else { 
        
    }
});