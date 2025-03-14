Dropzone.autoDiscover = false;
const dropzone = new Dropzone('#dropzone',{
    dictDefaultMessage:'Subir aquí tu imagen',
    acceptedFiles:".png, .jpg, .jpeg, .gif",
    addRemoveLinks: true,
    dictRemoveFile:'Borrar archivo',
    maxFiles:1,
    uploadMultiple: false,

    init: function(){
        console.log("Dropzone cargado")
        const imagenInput = document.querySelector('[name="imagen"]');

        if( imagenInput && imagenInput.value.trim()){
            const imagenPublicada = {}
            imagenPublicada.size = 1234;
            imagenPublicada.name = imagenInput.value;

            this.options.addedfile.call(this, imagenPublicada);
            this.options.thumbnail.call(this, imagenPublicada,`/uploads/${imagenPublicada.name}`)

            if (imagenPublicada.previewElement) {
                imagenPublicada.previewElement.classList.add("dz-success", "dz-complete");
            }
        } 
    }
});

//dropzone.on('sending',function(file,xhr,formData){ console.log(file)  })
dropzone.on('success',function(file ,response){
    console.log("Imagen success: "+response.imagen)
    document.querySelector('[name="imagen"]').value = response.imagen
})
//dropzone.on('error',function(file,message){ console.log(message) })
//dropzone.on('removedfile',function(){ console.log("Archivo eliminado") })
