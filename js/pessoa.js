//SELECIONAMOS O CNPJ
const cnpj = document.querySelector("#cnpj");
//NESTA FUNÇÃO PERCORREMOS TODAS AS POSIÇÕES DOS CAMPO DO JSON E 
//TEMTAMOS ENCONTRAR O CAMPO COM MESMO ID NO FORME CASO ENCONTRE
//ERÁ PREENCHER COM O VALOR ORIUNDO DA API
$("#alerta-ok").hide();

const showData = (result) => {
        for (const campo in result) {
            if (document.querySelector("#" + campo)) {
                //VERIFICAMOS SE O CAMPO SE TRATA DE UMA DATA
                if (campo == "data_inicio_atividade") {
                    //CONVERTEMOS A DATA PARA O FORMATO BRASILEIRO
                    document.querySelector("#" + campo).value = result[campo].split('-').reverse().join('/');
                } else {
                    document.querySelector("#" + campo).value = result[campo];
                }
            }
        }
    }
    //SELECIONAMOS O CPNJ PARA EFETUAR A BUSCA PELO DADOS CADASTRAIS DA EMPRESA
cnpj.addEventListener("blur", (e) => {
    let search = cnpj.value.replace("-", "").replace(".", "").replace("/", "");
    //contamos a quantidade de caracteres
    if (search.length > 10) {
        const options = {
                method: "GET",
                mode: "cors",
                cache: "default"
            }
            //PESQUISAMOS OS DADOS DA EMPRESA BRASIL API
        fetch(`https://brasilapi.com.br/api/cnpj/v1/${search}`, options)
            .then(response => {
                response.json()
                    .then(data => showData(data))
            })
            .catch(e => console.log('Deu erro: ' + e.message()))
    }
});

$(document).ready(function() {
    //ocultar alerta de confirmacao

    //ADICIONANDO MASCARA DE CPF OU CNPJ DE FORMA DINAMICA.
    $("#cnpj").inputmask({
        mask: ['999.999.999-99', '99.999.999/9999-99'],
        keepStatic: true
    });
    //ADICIONAMOS A MASCARA DA DATA
    $("#data_inicio_atividade").inputmask({
        mask: '99/99/9999'
    });
    //ADICIONAMOS O PLUGIN DE CALENDARIO
    $('#data_inicio_atividade').datepicker({
        language: "pt-BR",
        autoclose: true
    });

    //CONFIGURAÇÕES DOS PARAMENTRO DE VALIDAÇÃO DO FORMULÁRIO
    $('#form').validate({
        rules: {
            edtimagems: {
                required: true,
                file: true,
            },
            agree: "required"
        },
        errorElement: 'span',
        errorPlacement: function(error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function(element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        }
    });
    //MAPEAMOS O EVENTO DE CLICK DO BOTÃO
    $("#btnsalvar").click(function(e) {
        e.preventDefault();
        //RECEBEMOS O RESULTADO DA VALIDAÇÃO DO FORMULARIO
        let valida = $('#form').valid();
        //SELECIONAMOS O FORMULÁRIO
        const form = document.querySelector("#form");
        //TRANSFORMAMOS OS DADOS DO FORM EM UM ARRAY
        let formData = new FormData(form);
        // let acao = document.getElementById("edtacao");
        if (valida == true) {
            const options = {
                    method: "POST",
                    mode: "cors",
                    cache: "default",
                    body: formData
                }
                //PESQUISAMOS OS DADOS DA EMPRESA BRASIL API
            fetch(`controlepessoa.php`, options)
                .then(response => {
                    response.json()
                        .then(data => {
                            if (data == true) {
                                window.scrollTo(0, 0);
                                $("#alerta-info").hide();
                                $("#alerta-ok").show();

                                window.setTimeout(function() {
                                    window.location.href = 'https://localhost/listapessoa';
                                }, 2000);

                            } else {
                                alert("erro")
                            }
                        })
                })
                .catch(e => console.log('Deu erro: ' + e.message()))
        }
    });



});
var btn = document.querySelector("#btnsalvar");
btn.addEventListener("click", function() {




});