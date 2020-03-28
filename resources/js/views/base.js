export const elements = {
    productsTable : $('#table_products'),
    btnGetDetails : $('#btnGetDetails'),
    ebs_input : $('#ebs_input'),
    btnchooseImage : $('#image_choice'),
    productImage : $('#productImg'),
    btnAddProduct : $('#btnAddProduct'),

    frmaddProduct : $('#form-addProduct'),
    frmupdateProduct : $('#form-updateProduct'),
    frmGenerateReport : $('#form-genReport'),

    
    loading : $('.loading'),

    features : $('#features'),
    benefits : $('#benefits'),

    img_modal : $('#img_modal'),
    features_modal : $('#features_modal'),
    benefits_modal : $('#benefits_modal'),
    modalSaveChanges : $('#modalSaveChanges'),
    modalClose : $('#modalClose'),

    modal_image_choice : $('#modal_image_choice'),
    product_id : $('#product_id'),


    logoutMenu : $('#logoutMenu'),
    logoutForm : $('#logoutForm'),

    brandSelect2: $('.brandSelect2'),
    dimensionSelect2: $('.dimensionSelect2'),
    printDetailsSelect2 : $('.printDetailsSelect2'),
   
    reportResult : $('.reportResult'),

    floatButton: $('.float'),

    departmentSelect2 : $('.departmentSelect2'),
}


export const showLoader = () => {
    elements.loading.css('visibility', 'visible');
}

export const hideLoader = () => {
    elements.loading.css('visibility', 'hidden');
}

export const displayError = (jqXHR) => {
    let errorMessage = '';
    Object.entries(jqXHR.responseJSON.errors).forEach(([key, value]) => errorMessage+=value);
    alert(errorMessage);
};