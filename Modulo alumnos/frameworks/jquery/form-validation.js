$(document).ready(function() {
    // Generate a simple captcha
    function randomNumber(min, max) {
        return Math.floor(Math.random() * (max - min + 1) + min);
    };
    $('#captchaOperation').html([randomNumber(1, 20), '+', randomNumber(1, 30), '='].join(' '));
	
	$('#formLogin').bootstrapValidator({
        //message: 'This value is not valid',
        fields: {
            user: {
                validators: {
                    notEmpty: {
                        message: 'No puede estar vacío'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z0-9_\.]+$/,
                        message: 'Caracteres no válidos'
                    }
                }
            },
            password: {
                message: 'El nombre no es válido',
                validators: {
                    notEmpty: {
                        message: 'No puede estar vacío'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z0-9_\.]+$/,
                        message: 'Caracteres no válidos'
                    }
                }
            }
        }
    });
	
   
    $('#estudianteForm').bootstrapValidator({
        //message: 'Este valor es inválido',
        fields: {
            cedula: {
                validators: {
                    notEmpty: {
                        message: 'No puede estar vacío'
                    },
                    digits: {
                        message: 'Solo números'
                    }
                }
            },
            nombre1: {
                message: 'El nombre no es válido',
                validators: {
                    notEmpty: {
                        message: 'No puede estar vacío'
                    },
                    stringLength: {
                        min: 2,
                        message: 'El nombre no es válido'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z0-9_ \.]+$/,
                        message: 'Caracteres no válidos'
                    }
                }
            },
            nombre2: {
                message: 'El nombre no es válido',
                validators: {
                    stringLength: {
                        min: 2,
                        message: 'El nombre no es válido'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z0-9_ \.]+$/,
                        message: 'Caracteres no válidos'
                    }
                }
            },
            apellido1: {
                message: 'El apellido no es válido',
                validators: {
                    notEmpty: {
                        message: 'No puede estar vacío'
                    },
                    stringLength: {
                        min: 2,
                        message: 'El apellido no es válido'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z0-9_ \.]+$/,
                        message: 'Caracteres no válidos'
                    }
                }
            },
            apellido2: {
                message: 'El apellido no es válido',
                validators: {
                    stringLength: {
                        min: 2,
                        message: 'El apellido no es válido'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z0-9_ \.]+$/,
                        message: 'Caracteres no válidos'
                    }
                }
            },
            email: {
                validators: {
                    notEmpty: {
                        message: 'No puede estar vacío'
                    },
                    emailAddress: {
                        message: 'Formato no válido'
                    }
                }
            },
            telefono: {
                validators: {
                    notEmpty: {
                        message: 'No puede estar vacío'
                    },
                    digits: {
                        message: 'Solo números'
                    }
                }
            },
            tarjeta:{
                validators: {
                    notEmpty: {
                        message: 'No puede estar vacío'
                    }
                }
            },
            avatar:{
                validators: {
                    notEmpty: {
                        message: 'No puede estar vacío'
                    }
                }
            }/*,
            ren_cedula: {
                validators: {
                    notEmpty: {
                        message: 'No puede estar vacío'
                    },
                    digits: {
                        message: 'Solo números'
                    }
                }
            },
            ren_nombre1: {
                message: 'El nombre no es válido',
                validators: {
                    notEmpty: {
                        message: 'No puede estar vacío'
                    },
                    stringLength: {
                        min: 2,
                        message: 'El nombre no es válido'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z0-9_ \.]+$/,
                        message: 'Caracteres no válidos'
                    }
                }
            },
            ren_nombre2: {
                message: 'El nombre no es válido',
                validators: {
                    stringLength: {
                        min: 2,
                        message: 'El nombre no es válido'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z0-9_ \.]+$/,
                        message: 'Caracteres no válidos'
                    }
                }
            },
            ren_apellido1: {
                message: 'El nombre no es válido',
                validators: {
                    notEmpty: {
                        message: 'No puede estar vacío'
                    },
                    stringLength: {
                        min: 2,
                        message: 'El apellido no es válido'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z0-9_ \.]+$/,
                        message: 'Caracteres no válidos'
                    }
                }
            },
            ren_apellido2: {
                message: 'El nombre no es válido',
                validators: {
                    stringLength: {
                        min: 2,
                        message: 'El apellido no es válido'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z0-9_ \.]+$/,
                        message: 'Caracteres no válidos'
                    }
                }
            },
            ren_email: {
                validators: {
                    notEmpty: {
                        message: 'No puede estar vacío'
                    },
                    emailAddress: {
                        message: 'Formato no válido'
                    }
                }
            },
            ren_telefono: {
                validators: {
                    notEmpty: {
                        message: 'No puede estar vacío'
                    },
                    digits: {
                        message: 'Solo números'
                    }
                }
            },
            ren_direccion: {
                validators: {
                    notEmpty: {
                        message: 'No puede estar vacío'
                    },
                    digits: {
                        message: 'Solo números'
                    }
                }
            },
            select:{
                validators: {
                    notEmpty: {
                        message: 'No puede estar vacío'
                    }
                }
            }*/
        }
    });
	
	$('#personalForm').bootstrapValidator({
        //message: 'Este valor es inválido',
        fields: {
            per_cedula: {
                validators: {
                    notEmpty: {
                        message: 'No puede estar vacío'
                    },
                    digits: {
                        message: 'Solo números'
                    }
                }
            },
            per_nombre1: {
                message: 'El nombre no es válido',
                validators: {
                    notEmpty: {
                        message: 'No puede estar vacío'
                    },
                    stringLength: {
                        min: 2,
                        message: 'El nombre no es válido'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z0-9_ \.]+$/,
                        message: 'Caracteres no válidos'
                    }
                }
            },
            per_nombre2: {
                message: 'El nombre no es válido',
                validators: {
                    stringLength: {
                        min: 2,
                        message: 'El nombre no es válido'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z0-9_ \.]+$/,
                        message: 'Caracteres no válidos'
                    }
                }
            },
            per_apellido1: {
                message: 'El apellido no es válido',
                validators: {
                    notEmpty: {
                        message: 'No puede estar vacío'
                    },
                    stringLength: {
                        min: 2,
                        message: 'El apellido no es válido'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z0-9_ \.]+$/,
                        message: 'Caracteres no válidos'
                    }
                }
            },
            per_apellido2: {
                message: 'El apellido no es válido',
                validators: {
                    stringLength: {
                        min: 2,
                        message: 'El apellido no es válido'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z0-9_ \.]+$/,
                        message: 'Caracteres no válidos'
                    }
                }
            },
            per_email: {
                validators: {
                    notEmpty: {
                        message: 'No puede estar vacío'
                    },
                    emailAddress: {
                        message: 'Formato no válido'
                    }
                }
            },
            per_telefono: {
                validators: {
                    notEmpty: {
                        message: 'No puede estar vacío'
                    },
                    regexp: {
                        regexp: /^[0-9\.]+$/,
                        message: 'Caracteres no válidos'
                    }
                }
            },
            avatar: {
                validators: {
                    notEmpty: {
                        message: 'No puede estar vacío'
                    }
                }
            },
            per_direccion: {
                validators: {
                    regexp: {
                        regexp: /^[a-zA-Z0-9_ \.]+$/,
                        message: 'Caracteres no válidos'
                    }
                }
            }
        }
    });
    
	//CAMBIO DE CLAVE DEL USUARIO
    $('#usuarioForm').bootstrapValidator({
        //message: 'This value is not valid',
        fields: {
            usu_contras: {
                validators: {
                    notEmpty: {
                        message: 'No puede estar vacío'
                    },
                    identical: {
                        field: 'usu_contras2',
                        message: 'La contraseña debe ser igual'
                    }
                }
            },
            usu_contras2: {
                validators: {
                    notEmpty: {
                        message: 'No puede estar vacío'
                    },
                    identical: {
                        field: 'usu_contras',
                        message: 'La contraseña debe ser igual'
                    }
                }
            }
        }
    });
    
    $('#formCambioClave').bootstrapValidator({
        //message: 'This value is not valid',
        fields: {
            usu_clave: {
                validators: {
                    notEmpty: {
                        message: 'No puede estar vacío'
                    },
                    identical: {
                        field: 'usu_clave2',
                        message: 'La contraseña debe ser igual'
                    },
                    different: {
                        field: 'usu_contrasVieja',
                        message: 'No puede ser igual a la contraseña anterior'
                    }
                }
            },
            usu_clave2: {
                validators: {
                    notEmpty: {
                        message: 'No puede estar vacío'
                    },
                    identical: {
                        field: 'usu_clave',
                        message: 'La contraseña debe ser igual'
                    }
                }
            },
            usu_contrasVieja: {
                validators: {
                    notEmpty: {
                        message: 'No puede estar vacío'
                    },
                    different: {
                        field: 'usu_clave',
                        message: 'La contraseña debe ser igual'
                    }
                }
            }
        }
    });
    
    $('#formClave').bootstrapValidator({
        //message: 'This value is not valid',
        fields: {
            usu_cedula: {
                validators: {
                    notEmpty: {
                        message: 'No puede estar vacío'
                    }
                }
            }
        }
    });
    
    $('#perfilForm').bootstrapValidator({
        //message: 'Este valor es inválido',
        fields: {
            per_cedula: {
                validators: {
                    notEmpty: {
                        message: 'No puede estar vacío'
                    },
                    digits: {
                        message: 'Solo números'
                    }
                }
            },
            per_nombre1: {
                message: 'El nombre no es válido',
                validators: {
                    notEmpty: {
                        message: 'No puede estar vacío'
                    },
                    stringLength: {
                        min: 2,
                        message: 'El nombre no es válido'
                    }
                }
            },
            per_nombre2: {
                message: 'El nombre no es válido',
                validators: {
                    stringLength: {
                        min: 2,
                        message: 'El nombre no es válido'
                    }
                }
            },
            per_apellido1: {
                message: 'El apellido no es válido',
                validators: {
                    notEmpty: {
                        message: 'No puede estar vacío'
                    },
                    stringLength: {
                        min: 2,
                        message: 'El apellido no es válido'
                    }
                }
            },
            per_apellido2: {
                message: 'El apellido no es válido',
                validators: {
                    stringLength: {
                        min: 2,
                        message: 'El apellido no es válido'
                    }
                }
            },
            per_email: {
                validators: {
                    notEmpty: {
                        message: 'No puede estar vacío'
                    },
                    emailAddress: {
                        message: 'Formato no válido'
                    }
                }
            },
            per_telefono: {
                validators: {
                    notEmpty: {
                        message: 'No puede estar vacío'
                    },
                    regexp: {
                        regexp: /^[0-9\.]+$/,
                        message: 'Caracteres no válidos'
                    }
                }
            },
            per_direccion: {
                validators: {
                    regexp: {
                        regexp: /^[a-zA-Z0-9_ \.]+$/,
                        message: 'Caracteres no válidos'
                    }
                }
            }
        }
    });
});