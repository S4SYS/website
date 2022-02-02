class Helper {

    static getCpfMask(cpf) {
        if (this.getIntMask(cpf) == false) {
            event.returnValue = false;
        }
        return this.format(cpf, '000.000.000-00', event);
    }

    static getPhoneMask(phone) {
        if (this.getIntMask(phone) == false) {
            event.returnValue = false;
        }
        return this.format(phone, '(00) 0000-0000', event);
    }

    static getIntMask() {
        if (event.keyCode < 48 || event.keyCode > 57) {
            event.returnValue = false;
            return false;
        }
        return true;
    }

    static validateCpf(cpfElement) {
        var soma, resto;
        var cpf = cpfElement.value.replace('.', '').replace('.', '').replace('-', '');

        if (cpf.length !== 11 || ['00000000000', '11111111111', '22222222222',
            '33333333333', '44444444444', '55555555555', '66666666666',
            '77777777777', '88888888888', '99999999999'].includes(cpf)) {
            return false;
        }

        soma = 0;
        for (var i = 0; i < 9; i++) {
            soma += parseInt(cpf.charAt(i)) * (10 - i);
        }
        resto = 11 - (soma % 11);
        if (resto == 10 || resto == 11) {
            resto = 0;
        }
        if (resto != parseInt(cpf.charAt(9))) {
            return false;
        }
        soma = 0;
        for (var i = 0; i < 10; i++) {
            soma += parseInt(cpf.charAt(i)) * (11 - i);
        }
        resto = 11 - (soma % 11);
        if (resto == 10 || resto == 11) {
            resto = 0;
        }
        if (resto != parseInt(cpf.charAt(10))) {
            return false;
        }
        return true;
    }

    static format(campo, mascara, evento) {
        var boleanoMascara;

        var Digitato = evento.keyCode;
        var exp = /\-|\.|\/|\(|\)| /g
        var campoSoNumeros = campo.value.toString().replace(exp, "");

        var posicaoCampo = 0;
        var NovoValorCampo = "";
        var TamanhoMascara = campoSoNumeros.length;;

        if (Digitato != 8) { // backspace 
            for (var i = 0; i <= TamanhoMascara; i++) {
                boleanoMascara = ((mascara.charAt(i) == "-") || (mascara.charAt(i) == ".")
                    || (mascara.charAt(i) == "/"))
                boleanoMascara = boleanoMascara || ((mascara.charAt(i) == "(")
                    || (mascara.charAt(i) == ")") || (mascara.charAt(i) == " "))
                if (boleanoMascara) {
                    NovoValorCampo += mascara.charAt(i);
                    TamanhoMascara++;
                } else {
                    NovoValorCampo += campoSoNumeros.charAt(posicaoCampo);
                    posicaoCampo++;
                }
            }
            campo.value = NovoValorCampo;
            return true;
        } else {
            return true;
        }
    }

    static validateForm($formElement)
    {
        let counter = 0;
        $formElement.find('.required').each(function(){
            if(!$(this).val()){
                counter ++;
                $(this).css('border', '1px solid red');                        
            } else 
                $(this).css('border', '1px solid #ccc'); 
        });               
                
        if(parseInt(counter) > 0){
            alert('Por favor, preencha os campos obrigat\u00f3rios.');
            return false;
        } 

        if(!this.validateCpf(document.getElementById('cpf'))){
            alert('Por favor, informe um CPF v\u00e1lido.');
            $formElement.find('#cpf').css('border', '1px solid red');
            return false;
        }

        return true;
    }

}