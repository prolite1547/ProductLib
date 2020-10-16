import {elements} from "./base";
import Swal from 'sweetalert2/dist/sweetalert2.js'

 export const checkImage = (imageElement, inputElement) =>{
    inputElement.on('change', (e)=>{
        try{
            let image_def = imageElement.data('img_def');
            checkImageVal(elements.productImage, elements.btnchooseImage, image_def)
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
                           imageElement.attr('src', image_def);
                           $(e.target).val('');
                      }
                 }
            }else{
                imageElement.attr('src', image_def);
                 $(e.target).val('');
                 Swal.fire("Warning","Please upload a valid image (*.jpeg/*.png)", "warning");
               
            }
       }catch(err){
            console.log(err);
            $(e.target).val('');
       }
    });
 }

 function checkImageVal(imageElement, inputElement, image_def){
     
     if(inputElement[0].files.length === 0){
          imageElement.attr('src', image_def);
          $(inputElement).val('');
     }
 }


 export const clearForm = () =>{
     let image_def = elements.productImage.data('img_def');
     elements.btnAddProduct.prop('disabled', true);
     elements.frmaddProduct.trigger('reset');
     $(elements.btnchooseImage).val('');
     elements.productImage.attr('src', image_def);
 }