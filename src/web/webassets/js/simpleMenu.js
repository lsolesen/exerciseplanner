/************************************************
 * **Auto-magical click-deployed dropdown menu**
 * Use in conjunction with ulNav.css
 * Just add class of "expMenu" to any UL you want to make a dropdown, and voila!
 */


function expMenu()
{
	var sfEls = getElementsByClassName('expMenu', 'UL');
    for (i = 0; i < sfEls.length; i++)
    {
        sfEls[i] = sfEls[i].getElementsByTagName("LI");
    	for (var x=0; x<sfEls[i].length; x++)
        {
            sfEls[i][x].className +=" expMenuHide";
            sfEls[i][x].onclick=function()
            {
                if (this.className.indexOf("expMenuHover") >= 0)
                {
			        this.className=this.className.replace(new RegExp(" expMenuHover\\b"), "");
		        }
                else
                {
    			    this.className+=" expMenuHover";
                }
    		}
        }
	}
}



womAdd('expMenu()');


