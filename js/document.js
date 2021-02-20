var file = document.getElementById("FileAdd");
var alert = document.getElementById("alert");
var ajout = document.getElementById("ajout");
file.addEventListener('change', function(){
    if(file.files.length > 0){
      var extension = file.value.split(".")[1]
      if(extension == "pdf" || extension == "docx"){
          ajout.innerHTML ='<input type="submit" name="submit" value="Ajouter" id="Add" class="btn btn-info"/>'
          alert.innerHTML ='';
      }
      else {
         alert.innerHTML = '<div class="alert alert-danger text-center">Vous avez mis une mauvaise extension de fichier, veuillez choisir soit .pdf ou .docx </div>';
         ajout.innerHTML = '';
      }
    }
});
