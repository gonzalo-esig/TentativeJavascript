var inputNom = document.getElementById("inputNom")
inputNom.addEventListener("keyup", verifierNom)

var divMsg = document.getElementById("errorMsg")

function btnGriser(condition){
  document.getElementById("btnEnvoyer").disabled = condition

}

function verifierNom(){
  var inputNomValue = document.getElementById("inputNom").value
  var pattern = new RegExp(/[~`!§#$°@$_£%\\^&*+=()@#¢\-¬¦\[\]\';,/{}|\":<>\?]/);
  if (inputNomValue != "") {
    if (pattern.test(inputNomValue)) {
      divMsg.innerHTML = '<div class="alert alert-danger" role="alert">Le format de votre nom est invalide</div>'
      btnGriser(true)
    }
    else {
      for (var i = 0; i < inputNomValue.length; i++){
        if (!isNaN(inputNomValue[i])){
          divMsg.innerHTML = '<div class="alert alert-danger" role="alert">Le format de votre nom est invalide</div>'
          btnGriser(true)
          break
        }
      }
    }
    if (i == inputNomValue.length){
      btnGriser(false)
      divMsg.innerHTML = ''
    }
  }
  else {
    btnGriser(true)
    divMsg.innerHTML = ''
  }
}
