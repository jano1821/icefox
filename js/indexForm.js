  $(document).ready(function() {
    $('#contact_form').bootstrapValidator({
        // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            first_name: {
                validators: {
                        stringLength: {
                        min: 2,
                    },
                        notEmpty: {
                        message: 'Por favor Ingresa un nombre Válido'
                    }
                }
            },
            usuario: {
                validators: {
                        stringLength: {
                        min: 2,
                    },
                        notEmpty: {
                        message: 'Por favor Ingresa un Usuario'
                    }
                }
            },
            last_name: {
                validators: {
                     stringLength: {
                        min: 2,
                    },
                    notEmpty: {
                        message: 'Por favor Ingresa un Apellido Válido'
                    }
                }
            },
            email: {
                validators: {
                    notEmpty: {
                        message: 'Por favor Ingresa un mail'
                    },
                    emailAddress: {
                        message: 'Por favor Ingresa un mail Válido'
                    }
                }
            },
            phone: {
                validators: {
                    notEmpty: {
                        message: 'Por favor Ingresa un numero de Teléfono'
                    }
                }
            },
            address: {
                validators: {
                     stringLength: {
                        min: 8,
                    },
                    notEmpty: {
                        message: 'Por favor Ingresa un Direccion Válida'
                    }
                }
            },
            city: {
                validators: {
                     stringLength: {
                        min: 4,
                    },
                    notEmpty: {
                        message: 'Por favor Selecciona una Ciudad'
                    }
                }
            },
            state: {
                validators: {
                    notEmpty: {
                        message: 'Por favor Selecciona un Estado'
                    }
                }
            },
            zip: {
                validators: {
                    notEmpty: {
                        message: 'Por favor Ingresa un Número de Correspondencia'
                    },
                    zipCode: {
                        country: 'US',
                        message: 'Por favor Ingresa un Número de Correspondencia Válido'
                    }
                }
            },
            intentos: {
                validators: {
                    notEmpty: {
                        message: 'Por favor Ingresa Número de Intentos'
                    }
                }
            },
            comment: {
                validators: {
                    stringLength: {
                        min: 10,
                        max: 200,
                        message:'por favor Ingresa una Descripción Válida'
                    },
                    notEmpty: {
                        message: 'Por favor Ingresa una Descripcion'
                    }
                    }
                }
            }
        })
        .on('success.form.bv', function(e) {
            $('#success_message').slideDown({ opacity: "show" }, "slow") // Do something ...
                $('#contact_form').data('bootstrapValidator').resetForm();

            // Prevent form submission
            e.preventDefault();

            // Get the form instance
            var $form = $(e.target);

            // Get the BootstrapValidator instance
            var bv = $form.data('bootstrapValidator');

            // Use Ajax to submit form data
            $.post($form.attr('action'), $form.serialize(), function(result) {
                console.log(result);
            }, 'json');
        });
});