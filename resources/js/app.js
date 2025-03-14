//import './bootstrap';

import Dropzone from 'dropzone';

Dropzone.autoDiscover = false;

console.log('Dropzone cargando...')

const dropzone = new Dropzone('#dropzone',{
    dictDefaultMessage:'Subir aquí tu imagen',
    acceptedFiles:".png, .jpg, .jpeg, .gif",
    addRemoveLinks: true,
    dictRemoveFile:'Borrar archivo',
    maxFiles:1,
    uploadMultiple: false,
})

console.log('Dropzone cargado')