
//This is what i found
function display_inputs(){

    //hide and show inputs
    //https://stackoverflow.com/questions/31799603/show-hide-multiple-divs-javascript
    $(".on-modification").slideToggle();

    //clear the inputs
    //https://stackoverflow.com/questions/11072031/clearing-multiple-text-input-boxes-with-one-name
    $(".clear").val("");
}

function stock_id_icon(id_icon){

    alert(id_icon)
     
    $.ajax({
        url: '/stock-id_icon/' + id_icon,
        type: 'GET',
    });
      
}


