window.onload = function (){
var searchCitizen = document.getElementById('search_citizen');

searchCitizen.addEventListener("input", function (){
   var searchValue = searchCitizen.value.toLowerCase();
   var tableItems  = document.getElementsByClassName('home_owner');
   // console.log(tableItems[0].textContent);

    for (i=0;i<=tableItems.length;i++){
        if (document.querySelectorAll('tr')[i].className != 'header-row'){
        document.querySelectorAll('tr')[i].style.display = 'none';
        }
    }
   for (i=0;i<=tableItems.length;i++){

       if (tableItems[i] != null){
       var itemText = tableItems[i].textContent.toLowerCase();
       if (itemText.includes(searchValue)){
           console.log(itemText);

           tableItems[i].parentNode.style.display = 'table-row';
       }
       }
   }
});
}
