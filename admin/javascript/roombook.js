var detailpanel = document.getElementById("guestdetailpanel");

openmodel = (modelpanel) => {
    modelpanel.style.display = "flex";
}
closemodel = (modelpanel) => {
    modelpanel.style.display = "none";
}
editOpenmodelArg = (modelpanel, bookingId) => {
    modelpanel.style.display = "flex";
    // Fetch booking data
    fetch('actions/php/get_booking_info.php?id=' + bookingId)
        .then(response => response.json())
        .then(data => {
            // Populate fields
            document.getElementById('editBookingId').value = data.id; // Use .value for input
            document.getElementById('editNameInput').value = data.Name;
            document.getElementById('editPhoneInput').value = data.Phone;
            document.getElementById('editNationalInput').value = data.National;
            document.getElementById('editMealInput').value = data.Meal;
            document.getElementById('editCinInput').value = data.cin;
            document.getElementById('editCoutInput').value = data.cout;
            document.getElementById('editMealInput').selected = data.Meal == 1 ? true : false;
            
            // Add more fields as needed
            // Populate reservation info if needed
        });
}


//search bar logic using js
const searchFun = () =>{
    let filter = document.getElementById('search_bar').value.toUpperCase();

    let myTable = document.getElementById("table-data");

    let tr = myTable.getElementsByTagName('tr');

    for(var i = 0; i< tr.length;i++){
        let td = tr[i].getElementsByTagName('td')[1];

        if(td){
            let textvalue = td.textContent || td.innerHTML;

            if(textvalue.toUpperCase().indexOf(filter) > -1){
                tr[i].style.display = "";
            }else{
                tr[i].style.display = "none";
            }
        }
    }

}
