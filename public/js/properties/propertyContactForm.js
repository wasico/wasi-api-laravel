// Inputs
const $name = $('#name');
const $lastName = $('#lastName');
const $email = $('#email');
const $subject = $('#subject');
const $message = $('#message');
const $recaptcha = $('.g-recaptcha');
const $recaptchaEl = $('.rc-anchor');
const $receiveNewsletter = $('#receive_newsletter');

// Spans
const $spanName = $('#name_error');
const $spanLastname = $('#lastname_error');
const $spanEmail = $('#email_error');
const $spanSubject = $('#subject_error');
const $spanMessage = $('#message_error');

const $sendContactRequest = $('#send_contact_request');

function validateEmail(email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}

$name.on('change', () => {
    if ($name.hasClass('invalid')) {
        if($name.val() != '') {
            $name.removeClass('invalid');
            $spanName.html('');
        } else {
            $spanName.html('Debe indicar su nombre.');
        }
    }
});

$lastName.on('change', () => {
    if ($lastName.hasClass('invalid')) {
        if($lastName.val() != '') {
            $lastName.removeClass('invalid');
            $spanLastname.html('');
        } else {
            $spanLastname.html('Debe indicar su apellido.');
        }
    }
});

$email.on('change', () => {
    if ($email.hasClass('invalid')) {
        if ($email.val() != '' && validateEmail($email.val())) {
            $email.removeClass('invalid');
            $spanEmail.html('');
        } else {
            $spanEmail.html('Debe indicar su email.');
        }
    }
});

$subject.on('change', () => {
    if ($subject.hasClass('invalid')) {
        if ($subject.val() != '') {
            $subject.removeClass('invalid');
            $spanSubject.html('');
        } else {
            $spanSubject.html('Debe indicar un asunto para el mensaje.');
        }
    }
});

$message.on('change', () => {
    if ($message.hasClass('invalid')) {
        if ($message.val() != '') {
            $message.removeClass('invalid');
            $spanMessage.html('');
        } else {
            $spanMessage.html('El campo de mensaje no debe estar vacío.');
        }
    }
});

$sendContactRequest.on('click', () => {
    let validate = { valid: true, messages: [], errorIn: [], elementsForErrorDisplay: [] };

    let name = $name.val();
    let lastName = $lastName.val();
    let email = $email.val();
    let subject = $subject.val();
    let message = $message.val();
    let recaptcha = grecaptcha.getResponse();
    let receiveNewsletter = $receiveNewsletter.is(':checked');

    if (name === '') {
        validate.valid = false;
        validate.messages.push('Debe indicar su nombre.');
        validate.errorIn.push($name);
        validate.elementsForErrorDisplay.push($spanName);
    } 

    if (lastName === '') {
        validate.valid = false;
        validate.messages.push('Debe indicar su apellido.');
        validate.errorIn.push($lastName);
        validate.elementsForErrorDisplay.push($spanLastname);
    }

    if (email === '') {
        validate.valid = false;
        validate.messages.push('Debe indicar su email.');
        validate.errorIn.push($email);
        validate.elementsForErrorDisplay.push($spanEmail);
    } else if (!validateEmail(email)) {
        validate.valid = false;
        validate.messages.push('Email con formato incorrecto (ej: correo@dominio.com).');
        validate.errorIn.push($email);
        validate.elementsForErrorDisplay.push($spanEmail);
    }
    
    if (subject === '') {
        validate.valid = false;
        validate.messages.push('Debe indicar un asunto a su mensaje.');
        validate.errorIn.push($subject);
        validate.elementsForErrorDisplay.push($spanSubject);
    }

    if (message === '') {
        validate.valid = false;
        validate.messages.push('El campo de mensaje no debe estar vacío.');
        validate.errorIn.push($message);
        validate.elementsForErrorDisplay.push($spanMessage);
    }

    if (recaptcha === '') {
        validate.valid = false;
        validate.errorIn.push($recaptchaEl);
    }

    validate.elementsForErrorDisplay.map(($spanError, index) => {
        validate.errorIn[index].addClass('invalid');
        if ($spanError.text() !== '') {
            $spanError.html(validate.messages[index]);
        }
    });

    if (validate.valid) {
        
        const params = {
            'name': {
                type: 'text',
                value: name
            },
            'lastname': {
                type: 'text',
                value: lastName
            },
            'email': {
                type: 'email',
                value: email
            },
            'subject': {
                type: 'text',
                value: subject
            },
            'message': {
                type: 'text',
                value: message
            },
            'receive_newsletter': {
                type: 'boolean',
                value: receiveNewsletter
            },
            'g-recaptcha-response': {
                type: 'recaptcha',
                value: grecaptcha.getResponse()
            },
            'realtor': {
                type: 'json',
                value: realtor
            }
        };

        $.ajax({
            url: route.send_contact_form,
            type: 'post',
            data: params,
            dataType: 'json',
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"').attr('content') },
            success: () => {
                    swal('¡Mensaje enviado!', 'Su mensaje será respondido pronto.', 'success');
            },
            error: (error) => {
                swal('¡Error!', 'Su mensaje no pudo ser enviado. Por favor, inténtelo más tarde.', 'error');
            }
        });
    }
});