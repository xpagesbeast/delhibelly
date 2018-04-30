function highlightNavItem(resetGroup, itemId){
    console.log('highlight started looking for ' + resetGroup + " and " + itemId);

    var elements = document.getElementsByClassName(resetGroup);
    for(var i=0; i<elements.length; i++) {
        console.log(elements[i].id);
        if(elements[i].id == itemId){
            elements[i].classList.add("active");
            elements[i].classList.add("underline-red");
        }else{
            elements[i].classList.remove("active");
            elements[i].classList.remove("underline-red");
        }

    }
}