today = new Date();
dd = String(today.getDate()).padStart(2, '0');
mm = today.toLocaleString('default', { month: 'long' });

for (let i = 1; i <= 31; i++) {
  if(i <= 9){
    count = "0" + i;
  } else{
    count = i;
  }

  helper = document.getElementById(count);

  tagId = "weekDay" + count;
  dayDiv = document.getElementById(tagId);

  currMonth = document.getElementById("currMonth");

  if(!currMonth){

  currMonth = document.getElementById("weekDay01");

  }

  removeLink = document.getElementById("A" + count);

  if(typeof helper === 'undefined' || helper === null){

    if(removeLink != null){
      removeLink.className = 'linkInactive';
    }

  } else{

    if((tagId == ("weekDay" + dd)) && (currMonth.innerText == mm)){

      dayDiv.className = "active item current slick-slide slick-active";

    } else {

      dayDiv.className = "active item slick-slide slick-active";

    }

  }

}

  var pTags = document.getElementsByClassName("cal-day-w");

  for(let i = 0; i <= pTags.length; i++){

    if(i <= 8){
      count = "0" + (i+1);
    } else{
      count = (i+1);
    }

  innerhtml = count + "\n\nSo.";

  if(pTags[i]?.innerText == "So."){

    parent = pTags[i].parentNode;

    childCol = parent.children;

    child = childCol[1];

    child.className = "cal-day-weekend"

  }

}