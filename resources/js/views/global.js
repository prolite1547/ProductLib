import {elements} from "./base";
import Swal from 'sweetalert2/dist/sweetalert2.js'

 export const checkImage = (imageElement, inputElement) =>{
    inputElement.on('change', (e)=>{
        try{
            var file = e.target.files[0];
            var fileType = file["type"];
            var validImageTypes = ["image/jpeg", "image/png"];
            if ($.inArray(fileType, validImageTypes) >= 0) {
                 var imgSrc = window.URL.createObjectURL(file);
                 var newImg = new Image();
                 newImg.src = imgSrc;
                 newImg.onload = function(){
                      if(newImg.width == 500 && newImg.height == 500){
                           imageElement.attr('src',imgSrc);
                           imageElement.css('height', '300px')
                           imageElement.css('width', '300px')
                      }else{
                           Swal.fire("Warning","Image dimension must be [500x500]px", "warning");
                         //   alert("Image dimension must be [500x500]px");
                           imageElement.attr('src', '../images/no-image.svg');
                           $(e.target).val('');
                      }
                 }
            }else{
                imageElement.attr('src', '../images/no-image.svg');
                 $(e.target).val('');
                 Swal.fire("Warning","Please upload an valid image (*.jpeg/*.png)", "warning");
               
            }
       }catch(err){
            console.log(err);
            $(e.target).val('');
       }
    });
 }