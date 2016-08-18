var CARLOS = {

    proximoDisable: function () {
        $('#proximoProximo').closest('li').css('display', 'none')
    },
    proximoAtivo: function () {
        $('#proximoProximo').closest('li').css('display', 'block')
    },
    numeroDoisDigitos: function () {
        return (numero < 10 ? '0' + numero : numero);
    },
    dataParaExibicao: function (data) {
        var mes = data.getMonth() + 1;
        return (numeroDoisDigitos(data.getDate()) + "/" + numeroDoisDigitos(mes) + "/" + data.getFullYear());
    },
    criarObjetoData: function (mesAno) {
        var padraoMesAno = new RegExp("[0-9]{2}\/[0-9]{4}");
        var data = null;

        if (padraoMesAno.test(mesAno)) {
            var arrayPeriodo = mesAno.split('/');

            if (arrayPeriodo[0] >= 1 && arrayPeriodo[0] <= 12) {
                var mes = arrayPeriodo[0] - 1;
                var data = new Date();
                data.setFullYear(arrayPeriodo[1], mes, 1);
            }
        }

        return data;
    },
    primeiroDiaMes: function (periodo) {
        var data = criarObjetoData(periodo);
        var primeiroDia = null;

        if (data != null) {
            primeiroDia = new Date(data.getFullYear(), data.getMonth(), 1);
        }

        return primeiroDia;
    },
    ultimoDiaMes: function (periodo) {
        var data = criarObjetoData(periodo);
        var ultimoDia = null;

        if (data != null) {
            ultimoDia = new Date(data.getFullYear(), data.getMonth() + 1, 0);
        }

        return ultimoDia;
    },
    getView: function (method, callback, parameters, requestType, requestData) {

        var url = base_url() + "/" + method;

        if (base_url().substr(base_url().length - 1) == "/") {
            url = path_ajax() + "/" + method;
        }

        if (typeof parameters !== 'undefined' && parameters != null) {
            url += "/" + parameters;
        }

        if (typeof requestType === 'undefined') {
            $.get(url, callback);
        } else {
            $.post(url, requestData, callback, 'text');
        }
    },
    showModalPost: function (method, postData, callback, customModalId) {

        var modalId = typeof customModalId !== 'undefined' ? customModalId : '#modal';

        var modalAtual = $(modalId);

        if (modalAtual.length > 0) {
            $(modalId).remove();
        }

        VERTIGO.getView(method, function (data) {
            $('body').append(data);

            if (typeof callback === "function") {
                callback();
            }

            $(modalId).modal('show');

        }, null, 'post', postData);
    },
    showModal: function (method, id, callback, customModalId) {
        var url = method;

        if (parseInt(id, 10) > 0) {
            url += "/" + id;
        }

        var modalId = typeof customModalId !== 'undefined' ? customModalId : '#modal';

        var modalAtual = $(modalId);

        if (modalAtual.length > 0) {
            $(modalId).remove();
        }

        VERTIGO.getView(url, function (data) {
            $('body').append(data);

            if (typeof callback === "function") {
                callback();
            }

            $(modalId).modal('show');
        });
    },
    closeModal: function (callback, customModalId) {
        var modalId = typeof customModalId !== 'undefined' ? customModalId : '#modal';

        $(modalId).one('hidden.bs.modal', function () {
            $(modalId).remove();
            if (typeof callback === 'function') {
                callback();
            }
        });

        $(modalId).modal("hide");
    },
    aplicarMascarasPadrao: function () {
        $('input.campo-data').mask('99/99/9999');
        $('input.campo-hora').mask('99:99');
        $('input.campo-cnpj').mask('99.999.999/9999-99');
        $('input.campo-cep').mask('99.999-999');
        $('input.campo-telefone').mask('(99)99999999?9');
        $('input.campo-mes-ano').mask('99/9999');
        $('input.campo-numero').mask('9?9999');
        $('input.campo-numero-2').mask('9?9');
        $('input.campo-numero-inteiro7').mask('999?99999');
        $('input.campo-numero-inteiro1').mask('9?9999');
        $('input.campo-numero-decimal2').maskMoney('destroy');
        $('input.campo-numero-decimal2:not([readonly])').maskMoney({thousands: '', decimal: ',', allowZero: true, suffix: ''});
        $('input.campo-numero-decimal2-milhar').maskMoney('destroy');
        $('input.campo-numero-decimal2-milhar:not([readonly])').maskMoney({thousands: '.', decimal: ',', allowZero: true, suffix: ''});
        $('input.campo-cpf').mask('999.999.999-99');
        $('input.campo-uf').css('text-transform', 'uppercase');
    },
    ajaxPost: function (config) {

        /***
         * faz uma chamada ajax usando post
         * @param config objeto com parâmetros para o método, conforme abaixo:
         * arguments = {
         *     callback: função que será chamada ao concluir com sucesso o método
         *     baseUrl: permite customizar a url de onde será chamado o método - padrão é my_url_helper.urlPathClass()
         *     senderInput: objeto jquery que chamou a função - usado para localizar a toolbar e desabilitar os botões
         *                  durante o request
         * }
         */

        if (typeof config !== 'object') {
            showDebugMessage('base::ajaxPost => O parâmetro config não é do tipo esperado.');
        }
        else {
            var configObject = config;

            /**
             * configObject.senderInput = objeto jquery <button> que chamou essa função
             */
            var toolbar = null;

            if (typeof configObject.senderInput !== 'undefined') {
                toolbar = configObject.senderInput.closest("div.button-toolbar");
                toolbar.find("button").attr("disabled", true);
            }

            /**
             * configObject.baseUrl = url da chamada ajax
             */
            if (typeof configObject.baseUrl === 'undefined') {
                configObject.baseUrl = base_url();
            }

            /**
             * configObject.method = método da chamada ajax
             */
            if (typeof configObject.method !== 'undefined') {
                configObject.baseUrl += "/" + configObject.method;
            }

            /**
             * configObject.postData = dados que serão passados via POST
             */
            if (typeof configObject.postData === 'undefined') {
                configObject.postData = {};
            }

            /**
             * configObject.debugMode = true para exibir mensagens de debug no console
             */
            configObject.debugMode = false;

            if (typeof configObject.debug !== 'undefined' && configObject.debug == true) {
                configObject.debugMode = true;
            }

            /**
             * configObject.hasCallback = true quando vai chamar uma função de callback passada no parâmetro callback
             */
            configObject.hasCallback = false;

            if (typeof configObject.callback === 'function') {
                configObject.hasCallback = true;
            }

            var request = $.ajax({
                type: "POST",
                url: configObject.baseUrl,
                data: configObject.postData,
                dataType: "json",
                cache: false,
                async: typeof configObject.async !== 'undefined' ? configObject.async : true
            });

            /**
             * O retorno esperado é sempre um objeto JSON
             */
            request.success(function (returnObject) {
                if (typeof returnObject !== 'object') {
                    showDebugMessage('O retorno do servidor não foi do tipo esperado.');
                }
                else {
                    if (configObject.hasCallback) {
                        configObject.callback(returnObject);
                    }
                }
            });

            /**
             * Só exibibe mensagens de erro quando em modo debug
             */
            request.fail(function (jqXHR, textStatus, errorThrown) {
                var areaResultado = $("div.report-result-area");

                if (areaResultado.length > 0) {
                    areaResultado.empty();
                }

                if (typeof configObject.debug !== 'undefined') {
                    showDebugMessage(jqXHR);
                    showDebugMessage(textStatus);
                    showDebugMessage(errorThrown);
                }
            });

            /**
             * Executa quando der erro ou não. Habilita novamente o botão senderInput
             */
            request.always(function () {
                if (typeof configObject.senderInput !== 'undefined') {
                    toolbar = configObject.senderInput.closest("div.button-toolbar");
                    toolbar.find("button").attr("disabled", false);
                }
            });
        }
    }, dataParaGravacao: function (strData) {
        var arrData = strData.toString().split("/");
        var newData = new Date(parseInt(arrData[2], 10), parseInt(arrData[1], 10) - 1, parseInt(arrData[0], 10));
        return newData;
    },
    exibirMensagemSucesso: function (form, mensagens) {
        form.siblings('div.alert').remove();
        $('<div id="msg-sucesso" class="alert alert-success"><p class="text-align: center">' + mensagens + "</p></div>").insertBefore(form);

        setTimeout(function () {
            $('#msg-sucesso').fadeOut('slow');
        }, 1500);
    },
    criaNumeroDecimal: function (str) {
        var numero = 0.00;
        if (str) {
            var r1 = str.replace(/\./g, '');
            var r2 = r1.replace(/\,/g, '.');
            numero = parseFloat(r2);
        }

        return numero;
    },
    validarData: function (data) {
        var matches = /^(\d{2})[-\/](\d{2})[-\/](\d{4})$/.exec(date);
        if (matches === null) {
            return false;
        }

        var d = matches[1];
        var m = matches[2] - 1;
        var y = matches[3];
        var composedDate = new Date(y, m, d);
        return composedDate.getDate() == d &&
            composedDate.getMonth() == m &&
            composedDate.getFullYear() == y;
    }


}

function showLoader() {
    var loaderDiv = $('<div class="ajax-loader"></div>');
    $("body").append(loaderDiv);
}

function hideLoader() {
    $("div.ajax-loader").remove();
}

/***
 * Testa o suporte ao objeto console para mostrar mensagens de debug. Caso contrário, mostra um alert
 * @param msg = mensagem de debug a ser exibida
 */
function showDebugMessage(msg, exibeAlert) {
    if (window.console && window.console.log) {
        console.log(msg);
    }
    else {
        if (exibeAlert) {
            alert(msg);
        }
    }
}
