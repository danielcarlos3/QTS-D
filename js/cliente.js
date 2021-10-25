function deleta_terminal(id) {
  let EditAcao = document.querySelector("#edtacao");
  let EditTerminal = document.querySelector("#edtidterminal");
  let acao = EditAcao.value;
  EditAcao.value = 'dt';
  EditTerminal.value = id;
  const formulario = document.getElementById('frmcliente');
  // Instância o FormData passando como parâmetro o formulário
  const formData = new FormData(formulario);
  $.ajax({
    type: "post",
    url: "controlecliente.php",
    data: formData,
    //dataType: 'json',
    processData: false,
    contentType: false,
    success: function(data) {
      EditAcao.value = acao;
      if (data == 'true') {
        document.getElementById('alerta').className = 'callout callout-success small';
        document.getElementById('palerta').className = 'progress d-none';
        document.getElementById("malerta").innerHTML = 'Registro removido com sucesso!';
        $("#" + id).remove();
        setTimeout(function() {
          document.getElementById('alerta').className = 'callout callout-warning small';
          document.getElementById('palerta').className = 'progress d-none';
          document.getElementById("malerta").innerHTML = 'Campos sinalizados com * são obrigatórios para o cadastro!';
        }, 3000);
      } else {
        document.getElementById('alerta').className = 'callout callout-success small';
        document.getElementById('palerta').className = 'progress d-none';
        document.getElementById("malerta").innerHTML = data;
      }
    }
  });
}
//mascara dop cpf cnpj
$("#edtcpfcnpj").inputmask({
  mask: ['999.999.999-99', '99.999.999/9999-99'],
  keepStatic: true
});
$("#edttelefone").inputmask({
  mask: ['(99)9999.9999', '(99)9 9999-9999'],
  keepStatic: true
});
$("#edtliberacao").inputmask({
  mask: '99/99/9999'
});
$('#edtliberacao').datepicker({
  language: "pt-BR",
  autoclose: true
});
$("#edtdataregistro").inputmask({
  mask: '99/99/9999'
});
$('#edtdataregistro').datepicker({
  language: "pt-BR",
  autoclose: true
});
$("#edtconsulta").inputmask({
  mask: '99/99/9999'
});
$('#edtconsulta').datepicker({
  language: "pt-BR",
  autoclose: true
});

$(document).ready(function() {
  if (document.getElementById("edtid").value != '') {
    document.getElementById("terminais-tab").className = 'nav-link';
  } else {
    document.getElementById("terminais-tab").className = 'nav-link disabled';
  }
  $('#frmcliente').validate({
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
  $("#btnsalvar").click(function() {
    let valida = $('#frmcliente').valid();
    // let acao = document.getElementById("edtacao");
    if (valida == true) {
      let acao = document.getElementById("edtacao");
      const formulario = document.getElementById('frmcliente');
      // Instância o FormData passando como parâmetro o formulário
      const formData = new FormData(formulario);
      $('html, body').animate({ scrollTop: 0 }, 800);
      $.ajax({
        type: "post",
        url: "controlecliente.php",
        data: formData,
        //dataType: 'json',
        processData: false,
        contentType: false,
        success: function(data) {
          if (data != 'Falha no cadastro') {
            document.getElementById('alerta').className = 'callout callout-success small';
            document.getElementById('palerta').className = 'progress d-none';
            if (acao.value == 'c') {
              document.getElementById("malerta").innerHTML = 'Cadastro realizado com sucesso!';
              setTimeout(function() {
                window.location.replace(location.href + '?id=' + data);
              }, 500);
            } else {
              document.getElementById("malerta").innerHTML = 'Alterações realizado com sucesso!';
              setTimeout(function() {
                window.location.replace('listacliente');
              }, 500);
            }
          } else {
            document.getElementById('alerta').className = 'callout callout-success small';
            document.getElementById('palerta').className = 'progress d-none';
            document.getElementById("malerta").innerHTML = data;
          }
        }
      });
    }
  });
  $("#btnterminal").click(function() {
    let valida = $('#frmcliente').valid();
    // let acao = document.getElementById("edtacao");
    if (valida == true) {
      let EditAcao = document.querySelector("#edtacao");
      let id = document.getElementById("edtid").value;
      let acao = EditAcao.value;
      EditAcao.value = 'ct';
      const formulario = document.getElementById('frmcliente');
      // Instância o FormData passando como parâmetro o formulário
      const formData = new FormData(formulario);
      $('html, body').animate({ scrollTop: 0 }, 800);
      $.ajax({
        type: "post",
        url: "controlecliente.php",
        data: formData,
        //dataType: 'json',
        processData: false,
        contentType: false,
        success: function(data) {
          if (data == 'true') {
            document.getElementById('edtnometerminal').value = '';
            document.getElementById('edtchave').value = '';
            document.getElementById('edtversaoterminal').value = '';
            $("#edtbloqueadoterminal").prop("checked", false);
            EditAcao.value = 'lt';
            $.ajax({
              url: 'controlecliente.php',
              type: 'post',
              data: $("#frmcliente").serialize(),
              success: function(data) {
                EditAcao.value = acao;
                document.getElementById("listaterminal" + id).innerHTML = data;
                document.getElementById('alerta').className = 'callout callout-success small';
                document.getElementById('palerta').className = 'progress d-none';
                document.getElementById("malerta").innerHTML = 'Dados de terminal salvo!';
                setTimeout(function() {
                  document.getElementById('alerta').className = 'callout callout-warning small';
                  document.getElementById('palerta').className = 'progress d-none';
                  document.getElementById("malerta").innerHTML = 'Campos sinalizados com * são obritórios para o cadastro!';
                }, 1000);
              }
            });
          } else {
            document.getElementById('alerta').className = 'callout callout-success small';
            document.getElementById('palerta').className = 'progress d-none';
            document.getElementById("malerta").innerHTML = data;
          }
        }
      });
    }
  });
});