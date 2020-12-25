<!-- start Simple Custom CSS and JS -->
<script type="text/javascript">
var xpattern = /^[А-Яа-я]$/i;
var digpattern = /^[0-9]$/i;
function ff(value) { var OK = xpattern.exec(value); if (!OK) { return 0; } else { return 1; } }
function dig(value) { var OK = digpattern.exec(value); if (!OK) { return 0; } else { return 1; } }
document.getElementsByClassName('wpforms-page-next')[2].style.display='none';

function MyFunction_2() {
  var x=1;
  var str=document.getElementsByClassName("TMSecret")[0].getElementsByTagName("input")[0].value;
  x1=ff(str[0]);
  x2=ff(str[1]);
  x3=ff(str[2]);
  x4=ff(str[3]);
  x5=dig(str[4]);
  x6=dig(str[5]);
  x7=dig(str[6]);
  x=x1*x2*x3*x4*x5*x6*x7;
  console.log(str);
  if(x>0) 
    {
        document.getElementsByClassName('wpforms-page-next')[2].style.display='inline-block';
        console.log(x);
    } 
  else
    {
        console.log(x);
        document.getElementsByClassName('wpforms-page-next')[2].style.display='none';
    }
}

function MyFunction_3() {
  var x=1;
  var str=document.getElementsByClassName("TMSecret")[0].getElementsByTagName("input")[0].value;
  x1=ff(str[0]);
  x2=ff(str[1]);
  x3=ff(str[2]);
  x4=ff(str[3]);
  x5=dig(str[4]);
  x6=dig(str[5]);
  x7=dig(str[6]);
  x=x1*x2*x3*x4*x5*x6*x7;
  console.log(str);
  if(x>0) 
    {
        document.getElementsByClassName('wpforms-page-next')[2].style.display='inline-block';
        console.log(x);
    } 
  else
    {
        console.log(x);
        document.getElementsByClassName('wpforms-page-next')[2].style.display='none';
    }
}


document.getElementsByClassName("TMSecret")[0].getElementsByTagName("input")[0].oninput = MyFunction_2;
document.getElementsByClassName("TMSecret")[1].getElementsByTagName("input")[0].oninput = MyFunction_3;
</script>
<!-- end Simple Custom CSS and JS -->
