import {elements, showLoader, hideLoader, displayError} from "../views/base";
import {checkImage} from "../views/global";
import Swal from 'sweetalert2/dist/sweetalert2.js'

export const ProductController = () => {

    elements.btnGetDetails.on('click', ()=>{
       let barcode = elements.ebs_input.val();
      showLoader();
       $.ajax(`/get/product-details/${barcode}`,{
            type: 'GET'
       }).done( data =>{
            if(data.length > 0){
                $.each(data[0], function(key, value){
                     $(`#${key}`).val(value);
                });
                elements.btnAddProduct.prop('disabled', false);
            }else{
                 Swal.fire('Product not found!', 'Please check your barcode', 'error');
               //   alert("Product not found! Please check your barcode");
            }
            hideLoader();
       }).fail((jqXHR,textStatus,errorThrown) =>{
          if(jqXHR.status == 404){
               console.log("ERROR"+jqXHR.status+": PRODUCT NOT FOUND");
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
          let image_def = elements.productImage.data('img_def');
          // let benefits =  convertLines(elements.benefits);
          // let features = convertLines(elements.features);
           
          // elements.features.val(features);
          // elements.benefits.val(benefits);

          let formData = new FormData(e.target);
          showLoader();
          $.ajax('/add-product', {
               type: "POST",
               data: formData,
               contentType: false,
               cache: false,
               processData: false
          }).done(data =>{
               if(data.success){
                    Swal.fire('Done','Product Successfully Added', 'success');
                    // alert("Product Successfully Added");
                    elements.productImage.attr('src', image_def);
                    $(e.target).trigger('reset');
                    hideLoader();
               }else{
                    Swal.fire('Something went wrong!',data.response, 'error');
                   
                    hideLoader();
               }   
          }).fail(jqXHR=>{
               hideLoader();
          });
          
    });

    elements.modalSaveChanges.on('click', ()=>{ elements.frmupdateProduct.trigger('submit'); })
    elements.frmupdateProduct.on('submit', (e)=>{
          e.preventDefault();
          let formData = new FormData(e.target);
          showLoader();
          $.ajax('/update-product', {
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


   

   
}

 