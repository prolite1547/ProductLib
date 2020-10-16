import {elements, showLoader, hideLoader, displayError} from "../views/base";
import {checkImage, clearForm} from "../views/global";
import Swal from 'sweetalert2/dist/sweetalert2.js'

export const ProductController = () => {
    var returnedData = null;

    elements.btnGetDetails.on('click', ()=>{
       let barcode = elements.ebs_input.val();
      showLoader();
       $.ajax(`/ProdLib/public/get/product-details/${barcode}`,{
            type: 'GET'
       }).done( data =>{
            if(data.length > 0){
                returnedData = data;
                $.each(data[0], function(key, value){
                     $(`#${key}`).val(value);
                });
                 elements.btnAddProduct.prop('disabled', false);
            }else{
                 Swal.fire('Product not found!', 'Please check your barcode', 'error');
                 clearForm();
               //   alert("Product not found! Please check your barcode");
            }
            hideLoader();
       }).fail((jqXHR,textStatus,errorThrown) =>{
          if(jqXHR.status == 404){
               console.log("ERROR"+jqXHR.status+": PRODUCT NOT FOUND");
          }else if(jqXHR.status == 500){
               Swal.fire('Cant connect to server!', 'Please check your network', 'error');
          }else{
               console.log("ERROR"+jqXHR.status+": UNABLE TO PROCESS REQUEST ");
          }
          // if(jqXHR){
          //      displayError(jqXHR);
          //    }else if(errorThrown) {
          //        alert(errorThrown);
          //    }else if(textStatus){
          //        alert(textStatus);
          //    }else{
          //        alert('Unable to process the request!')
          //    }
          hideLoader();
       });
    });

    elements.productImage.on('click', ()=>{
          elements.btnchooseImage.trigger('click');
          checkImage(elements.productImage, elements.btnchooseImage);
    });

    

    elements.img_modal.on('click', ()=>{
         elements.modal_image_choice.trigger('click');
         checkImage(elements.img_modal, elements.modal_image_choice);
    })




    elements.frmaddProduct.on('submit', (e) => {
          e.preventDefault();
          var defaultValues = checkInputDefaultValues(returnedData) 
          // let benefits =  convertLines(elements.benefits);
          // let features = convertLines(elements.features);
           
          // elements.features.val(features);
          // elements.benefits.val(benefits);
          if(defaultValues.length > 0){
               var defaults = "<br>";
               for(var x = 0 ; x<defaultValues.length; x++){
                   defaults = defaults.concat("<br><b>"+defaultValues[x]+"</b>");
               }
               Swal.fire('Invalid data','Please update fields with "DEFAULT" values' + defaults, 'error');
               return;
          } 
          if(ifImageHasValue()){
               let formData = new FormData(e.target);
               showLoader();
               $.ajax('/ProdLib/public/add-product', {
                    type: "POST",
                    data: formData,
                    contentType: false,
                    cache: false,
                    processData: false
               }).done(data =>{
                    if(data.success){
                         Swal.fire('Done','Product Successfully Added', 'success');
                         // alert("Product Successfully Added");
                         clearForm();
                         hideLoader();
                    }else{
                         Swal.fire('Something went wrong!',data.response, 'error');
                         hideLoader();
                    }   
               }).fail(jqXHR=>{
                    hideLoader();
               });
          }
    });

    elements.modalSaveChanges.on('click', ()=>{ elements.frmupdateProduct.trigger('submit'); })
    elements.frmupdateProduct.on('submit', (e)=>{
          e.preventDefault();
          if(elements.benefits_modal.val().trim().length <= 0 ||  elements.features_modal.val().trim().length <= 0 ){
               Swal.fire('Invalid data!',"Benefits/Features field is required", 'error');
               return;
          }
          let formData = new FormData(e.target);
          showLoader();
          $.ajax('/ProdLib/public/update-product', {
               type: "POST",
               data: formData,
               contentType: false,
               cache: false,
               processData: false
          }).done(data =>{
            
               if(data.success){
           
                    elements.modalClose.trigger('click');
                    hideLoader();
                    Swal.fire('Done','Product Successfully Updated', 'success').then(()=>{
                         location.reload();
                    });
               }else{
                    Swal.fire('Something went wrong!',data.response, 'error');
                    hideLoader();
               }
               
              
          }).fail(jqXHR=>{
               hideLoader();
          });

    });


   function ifImageHasValue(){
        var fileImage = elements.btnchooseImage.val();
        if(!fileImage){
            Swal.fire('Something went wrong!','Please upload an image', 'error');
            return false;
        }
        return true;
   }

   function checkInputDefaultValues(inputData){
        var arrayDefaults = [];
         $.each(inputData[0], function(key, value){
          if(value == 'DEFAULT'){
               var labelText  = $('label[for="' + key + '"]').text();
               arrayDefaults.push(labelText);
          }
     });
     return arrayDefaults;
   }  
}

 